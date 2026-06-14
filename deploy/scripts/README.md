# Rhymix Packaging Script

이 디렉토리에 포함된 `package_rhymix.sh` 스크립트는 Rhymix 코어 소스와 프로젝트별 커스텀 파일을 하나로 병합하여 배포 가능한 압축 파일을 생성합니다.

## 기능

1. `app/_rhymix` 디렉토리의 코어 소스를 `rhymix_source` 폴더로 복사합니다.
2. `app/custom` 디렉토리의 파일을 동일한 구조로 `rhymix_source`에 병합(Overwrite)합니다.
3. 복사 시 `.git` 관련 파일 및 디렉토리는 자동으로 제외됩니다.
4. 최종 결과를 `rhymix_source.tar.gz` 파일로 압축합니다.
5. 압축 완료 후 임시로 생성했던 `rhymix_source` 디렉토리를 삭제하여 정리합니다.

## 사전 요구 사항

- **Bash Shell**: 스크립트 실행 환경
- **rsync**: 파일 복사 및 병합용
- **tar**: 압축용

## 사용 방법

스크립트가 위치한 디렉토리에서 아래 명령어를 실행합니다.

```bash
cd deploy/scripts
./package_rhymix.sh
```

## 출력 결과

스크립트 실행이 완료되면 현재 디렉토리에 다음과 같은 파일이 생성됩니다.

- `rhymix_source.tar.gz`: 코어와 커스텀 소스가 합쳐진 최종 압축 파일

## 소스 구조 병합 방식

스크립트는 다음과 같이 파일을 병합합니다.

- `app/_rhymix/` -> `rhymix_source/` (기본 구조)
- `app/custom/` -> `rhymix_source/` (커스텀 덮어쓰기 및 추가)

따라서 `app/custom/modules/board`와 같은 경로에 파일이 있다면, 코어의 `modules/board`와 자연스럽게 합쳐지거나 커스텀 파일로 대체됩니다.
