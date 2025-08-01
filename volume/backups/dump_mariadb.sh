#!/bin/bash
DATE=$(date +"%Y-%m-%d")
SQL_FILE=/var/backups/backup-mariadb-${DATE}.sql

# (2) in case you run this more than once a day,
# remove the previous version of the file
# shellcheck disable=SC2046
find /var/backups \( -name "*.sql" -o -name "*.log" \) -type f -ctime +2 -delete

if [ -f "$SQL_FILE" ]; then
    rm "$SQL_FILE"
fi

# (3) do the mysql database backup (dump)
PASSWORD="$( [ -f "$MARIADB_PASSWORD_FILE" ] && cat "$MARIADB_PASSWORD_FILE" || echo '')"
mariadb-dump -u"${MARIADB_USER}" -p"${PASSWORD}" "${MARIADB_DATABASE}" > "${SQL_FILE}"

# 백업이 성공했는지 확인
if [ $? -eq 0 ]; then
    echo "MARIADB Backup completed successfully: ${SQL_FILE}"
else
    echo "MARIADB Backup failed"
fi
