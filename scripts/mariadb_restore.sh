#!/bin/bash

echo Starting Restore [$(date +%Y-%m-%d_%H-%M-%S)] >> ${logfile}

#mysql -u my_user -p my_database < C:\Users\denis\Documents\TP-Epitech\TP-WEB-700\Sauvegarde\all_databases_2023.sql
docker exec ${container_name mysql} -u${MARIADB_USER} -p${MARIADB_PASSWORD} ${MARIADB_DATABASE} < ${sqlfile} 

if [ $? == 0 ]; then
  echo 'Sql restore finished' >> ${logfile}
else
  echo [error] mysqlrestore return non-zero code $? >> ${logfile}
  exit
fi