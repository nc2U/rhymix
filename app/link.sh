#!/bin/bash

# 스크립트 실행 위치를 기준으로 경로 설정
BASE_DIR=$(pwd)
RHYMIX_PATH="${BASE_DIR}/_rhymix"
CUSTOM_PATH="${BASE_DIR}/custom"

echo "🔗 심볼릭 링크 생성을 시작합니다..."

# 1. 커스텀 레이아웃 링크 생성
# 원본: custom/layouts/ibs-layout
# 링크: _rhymix/layouts/ibs-layout
ln -sf "${CUSTOM_PATH}/layouts/ibs_layout" "${RHYMIX_PATH}/layouts/ibs_layout"

# 2. 커스텀 모듈 링크 생성 (예시)
# ln -sf "${CUSTOM_PATH}/modules/ibs_module" "${RHYMIX_PATH}/modules/ibs_module"

echo "✅ 모든 링크가 성공적으로 생성되었습니다."