1. **`local-path` StorageClass가 있는지 확인**: `local-path` StorageClass가 없다면, 로컬 경로 프로비저너(예: [https://github.com/rancher/local-path-provisioner](https://github.com/rancher/local-path-provisioner))를 설치해야 합니다.
2. **`values.yaml` 업데이트**: `deploy/helm/charts/mariadb/values.yaml` 파일을 열어 `"your_root_password"`와 `"your_rhymix_password"`를 강력하고 안전한 비밀번호로 변경하십시오.
3. **Helm 차트 설치**:
    ```bash
    helm upgrade --install mariadb deploy/helm/charts/mariadb -n rhymix --create-namespace
    ```