#!/bin/bash

# Number of days to store the backup
keep_day=0.1
sqlfile=$backupfolder/database-$(date +%Y).sql
zipfile=$backupfolder/database-$(date +%Y).zip
logfile=/mnt/c/users/denis/Documents/TP-Epitech/TP-WEB-700/Backup-CountofMoneyTest/db_backup.log 
# Charge les variables du .env


echo Starting Backup [$(date +%Y-%m-%d_%H-%M-%S)] >> $logfile
 
# Create a backup
docker exec $container_name mysqldump -u${MARIADB_USER} -p${MARIADB_PASSWORD} ${MARIADB_DATABASE} >> $sqlfile
if [ $? == 0 ]; then
  echo 'Sql dump created' >> $logfile
else
  echo [error] mysqldump return non-zero code $? >> $logfile
  exit
fi

# Compress backup
#zip -j $zipfile $sqlfile
#if [ $? == 0 ]; then
#  echo 'The backup was successfully compressed' >> $logfile
#else
#  echo '[error] Error compressing backup' >> $logfile
#  exit
#fi
#rm $sqlfile
#echo $zipfile >> $logfile
#echo Backup complete [$(date +%Y-%m-%d_%H-%M-%S)] >> $logfile

# Delete old backups
#find $backupfolder -mtime +$keep_day -delete
