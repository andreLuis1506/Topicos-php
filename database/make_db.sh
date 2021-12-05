#!/bin/bash
docker-compose run mysqldb sh -c "mysql -u $1 -h mysqldb -p < mysql/db.sql && rm mysql/db.sql"