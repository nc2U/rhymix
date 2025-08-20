# PowerShell deployment script for Rhymix Helm chart

# Get current directory
$CURR_DIR = Split-Path -Parent $MyInvocation.MyCommand.Path

# Load .env file
$envFile = Join-Path $CURR_DIR ".env"
if (Test-Path $envFile) {
    Get-Content $envFile | ForEach-Object {
        if ($_ -match "^\s*([^#][^=]*)\s*=\s*(.*)$") {
            $key = $matches[1].Trim()
            $value = $matches[2].Trim().Trim('"').Trim("'")
            [Environment]::SetEnvironmentVariable($key, $value, "Process")
        }
    }
    
    # Check if values.yaml exists
    $valuesFile = Join-Path $CURR_DIR "values.yaml"
    if (Test-Path $valuesFile) {
        # Check and add Helm repo
        $repoList = helm repo list 2>$null
        if (-not ($repoList -match 'nfs-subdir-external-provisioner')) {
            helm repo add nfs-subdir-external-provisioner https://kubernetes-sigs.github.io/nfs-subdir-external-provisioner
        }
        
        # Check and install nfs-provisioner
        $status = helm status rhymix-nfs-external-provisioner -n kube-system 2>$null
        if ($LASTEXITCODE -ne 0) {
            helm upgrade --install rhymix-nfs-external-provisioner `
                nfs-subdir-external-provisioner/nfs-subdir-external-provisioner `
                -n kube-system `
                --set nfs.server=$env:NFS_HOST `
                --set nfs.path="$env:NFS_PATH/volume/data" `
                --set storageClass.name=nfs-rhymix
        }
        
        # Apply cluster role and deploy with Helm
        kubectl apply -f ../kubectl/cluster-role.yaml
        helm upgrade rhymix . -f ./values.yaml `
            --install -n rhymix --create-namespace --history-max 5 --wait --timeout 10m `
            --set mariadb.auth.rootPassword=$env:MARIADB_PASSWORD `
            --set mariadb.auth.password=$env:MARIADB_PASSWORD `
            --atomic --cleanup-on-fail
    } else {
        Write-Error "values.yaml file not found in current directory."
        exit 1
    }
} else {
    Write-Error ".env file not found in $CURR_DIR"
    exit 1
}