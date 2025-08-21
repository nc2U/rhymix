
# Customized Rhymix

## Deploy Using Docker

#### Requirement ins your system

- docker
- docker-compose
- git

### Usage

#### 1. Clone this Repository
```bash
git clone https://github.com/nc2u/rhymix
cd rhymix/app/_rhymix
git clone https://github.com/rhymix/rhymix .
```

#### 2. Copy docker-compose.yml
```bash
cd ../../deploy
cp docker-compose.yml.tmpl docker-compose.yml
```

#### 3. Write environments in docker-compose.yml

Check what must be defined in docker-compose.yml file.

Enter the actual data for your environment as described in the following items.

- mariadb - required
  - MYSQL_DATABASE            # mysql database information
  - MYSQL_USER                # mysql database information
  - MYSQL_PASSWORD            # mysql database information
  - MARIADB_ROOT_PASSWORD     # mysql database information

#### 4. Build & Run Docker Compose

Build and run
```bash
docker-compose up -d --build
```

#### 5. Set environment
```bash
cd ../app/custom/modules/install/script
cp .env.example .env
vi .env # ... & Set each setting value as below. You should replace the value of each item with your own value.
```

```dotenv
# Set default sender
SENDER_EMAIL=noreply@yourdomain.com
REPLY_TO_EMAIL=your-gmail@gmail.com

# SMTP server settings
SMTP_HOST=your.smtp.server.com
SMTP_SECURE=tls
SMTP_PORT=587
SMTP_AUTH=Y
SMTP_USERNAME=your-username
SMTP_PASSWORD=your-password
```

##### Description of settings items

| items            | description  | example                |
|-------------|--------------|------------------------|
| SENDER_EMAIL | 발신자 이메일      | noreply@yourdomain.com |
| REPLY_TO_EMAIL | 답장받을 이메일     | admin@yourdomain.com   |
| SMTP_HOST   | SMTP 서버 주소   | smtp.gmail.com         |
| SMTP_SECURE | 보안 연결 방식     | tls, ssl               |
| SMTP_PORT   | SMTP 포트 번호   | 587 (TLS), 465 (SSL)   |
| SMTP_USERNAME | SMTP 인증 사용자명 | 이메일 주소 또는 아이디          |
| SMTP_PASSWORD | SMTP 인증 비밀번호 | 실제 비밀번호 또는 앱 비밀번호      |

##### How to check after installation

1. **Access the Remix Manager page**
2. **System Settings > Notification Settings > Email** Check the settings in the menu
3. **Verify operation by sending a test email**


##### If you use FCM push notifications

```bash
vi firebase-key.json
# After generating a private key in the "Service Accounts" menu of the Firebase console,
# paste the contents of the downloaded JSON file into this file.
```