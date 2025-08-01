#!/usr/bin/env bash

# .env 스크립트가 있는 디렉터리 경로 계산
CURR_DIR="$(cd "$(dirname "$0")" && pwd)"

# .env 수동 로딩 (POSIX 호환)
if [ -f "$CURR_DIR/.env" ]; then
  while IFS='=' read -r key value || [ -n "$key" ]; do
    case "$key" in
      ''|\#*) ;; # Ignore blank lines or comments
      *)
        # Remove quotes and export
        clean_key="$(echo "$key" | sed -e 's/^\s*//' -e 's/\s*$//')"
        clean_value=$(echo "$value" | sed -e 's/^\\s*[\"\\'\\']//' -e 's/[\"\\'\\']\\s*$//')
        export "$clean_key=$clean_value"
        ;;
    esac
  done < "$CURR_DIR/.env"

  # values.yaml 존재 여부 확인
  if [ -e "$CURR_DIR/values.yaml" ]; then
    # Helm repo 등록 여부 확인 후 추가
    if ! helm repo list | grep -q 'nfs-subdir-external-provisioner'; then
        helm repo add nfs-subdir-external-provisioner https://kubernetes-sigs.github.io/nfs-subdir-external-provisioner
    fi
    # Helm nfs-provisioner 설치 여부 확인 후 설치
    if ! helm status rhymix-nfs-external-provisioner -n kube-system >/dev/null 2>&1; then
      helm upgrade --install rhymix-nfs-external-provisioner \
      nfs-subdir-external-provisioner/nfs-subdir-external-provisioner \
            -n kube-system \
            --set nfs.server=${NFS_HOST} \
            --set nfs.path=${NFS_PATH}/volume/data \
            --set storageClass.name=nfs-rhymix
    fi

    # Role 적용 및 Helm 배포
    kubectl apply -f ../kubectl/cluster-role.yaml
    helm upgrade rhymix . -f ./values.yaml \
      --install -n rhymix --create-namespace --history-max 5 --wait --timeout 10m \
      --set mariadb.auth.rootPassword=${MARIADB_PASSWORD} \
      --set mariadb.auth.password=${MARIADB_PASSWORD} \
      --atomic --cleanup-on-fail
  else
    echo "values-dev-custom.yaml file not found in Current directory."
    exit 1
  fi
else
  echo ".env file not found in $CURR_DIR"
  exit 1
fi
