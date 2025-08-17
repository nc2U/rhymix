# 라이믹스 이메일 설정 가이드

이 디렉터리의 `.env` 파일을 통해 라이믹스 설치 시 이메일 관련 설정을 자동으로 구성할 수 있습니다.

## 설정 방법

### 1. .env 파일 준비

```bash
# .env.example 파일을 .env로 복사
cp .env.example .env

# 또는 기존 .env 파일 수정
vi .env
```

### 2. 이메일 서버 정보 입력

#### Gmail 사용 시:

```bash
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_SECURE=tls
SMTP_USERNAME=your-email@gmail.com
SMTP_PASSWORD=your-app-password
```

**Gmail 사용 시 주의사항:**

- 2단계 인증 활성화 필요
- 앱 비밀번호 생성 후 사용
- 일반 계정 비밀번호가 아닌 앱 전용 비밀번호 사용

#### Naver 메일 사용 시:

```bash
SMTP_HOST=smtp.naver.com
SMTP_PORT=587
SMTP_SECURE=tls
SMTP_USERNAME=your-naver-id
SMTP_PASSWORD=your-naver-password
```

#### 회사 메일 서버 사용 시:

```bash
SMTP_HOST=mail.yourcompany.com
SMTP_PORT=587
SMTP_SECURE=tls
SMTP_USERNAME=your-company-email
SMTP_PASSWORD=your-company-password
```

### 3. 발신자 정보 설정

```bash
SENDER_NAME=조합명 또는 회사명
SENDER_EMAIL=noreply@yourdomain.com
REPLY_TO_EMAIL=admin@yourdomain.com
WEBMASTER_EMAIL=admin@yourdomain.com
ADMIN_EMAIL=admin@yourdomain.com
```

## 설정 항목 설명

| 항목             | 설명           | 예시                     |
|----------------|--------------|------------------------|
| SMTP_HOST      | SMTP 서버 주소   | smtp.gmail.com         |
| SMTP_PORT      | SMTP 포트 번호   | 587 (TLS), 465 (SSL)   |
| SMTP_SECURE    | 보안 연결 방식     | tls, ssl               |
| SMTP_USERNAME  | SMTP 인증 사용자명 | 이메일 주소 또는 아이디          |
| SMTP_PASSWORD  | SMTP 인증 비밀번호 | 실제 비밀번호 또는 앱 비밀번호      |
| SENDER_EMAIL   | 발신자 이메일      | noreply@yourdomain.com |
| REPLY_TO_EMAIL | 답장받을 이메일     | admin@yourdomain.com   |

## 설치 후 확인 방법

1. **라이믹스 관리자 페이지 접속**
2. **시스템 설정 > 알림 설정 > 이메일** 메뉴에서 설정 확인
3. **테스트 메일 발송으로 동작 확인**

## 문제 해결

### SMTP 설정이 관리자 페이지에 반영되지 않는 경우:

1. 브라우저 캐시 삭제
2. 라이믹스 캐시 삭제: `files/cache/*` 폴더 내용 삭제
3. 관리자 페이지 강력 새로고침 (Ctrl+F5)

### Gmail 사용 시 인증 오류:

1. 2단계 인증 활성화 확인
2. 앱 비밀번호 생성 및 사용
3. "보안 수준이 낮은 앱의 액세스" 허용 (필요시)

### 메일 발송 실패:

1. SMTP 서버 정보 재확인
2. 방화벽 설정 확인
3. 포트 번호 확인 (587, 465, 25)
4. 인증 정보 확인

## 보안 주의사항

- `.env` 파일에는 민감한 정보가 포함되어 있으므로 버전 관리 시스템에 포함하지 마세요
- `.gitignore`에 `.env` 파일을 추가하세요
- 서버 권한을 적절히 설정하여 외부 접근을 차단하세요

```bash
# .gitignore에 추가
.env
```

## 파일 구조

```
script/
├── ko.install.php     # 설치 스크립트
├── .env              # 실제 설정 파일 (수정 필요)
├── .env.example      # 설정 예시 파일
└── README.md         # 이 파일
```
