#!/bin/bash

set -e

cd /app/db/move/applications

echo "Exporting data from Mongo"
mongoexport --host=mongodb-01,mongodb-02,mongodb-03 --ssl --sslAllowInvalidCertificates --username opglpa-api \
--password $OPG_LPA_API_MONGODB_PASSWORD \
--db opglpa-api --authenticationDatabase opglpa-api --collection lpa --type csv \
--fields _id,user,updatedAt,startedAt,createdAt,completedAt,lockedAt,locked,whoAreYouAnswered,seed,repeatCaseNumber,document,payment,metadata,search \
> applications-dump.csv

rm -f errors.txt

echo "Exporting list of users"
export PGPASSWORD=$OPG_LPA_POSTGRES_PASSWORD
psql --username=$OPG_LPA_POSTGRES_USERNAME --host=$OPG_LPA_POSTGRES_HOSTNAME --dbname=$OPG_LPA_POSTGRES_NAME --file=get.sql

echo "Converting data Mongo -> Postgres"
php process-applications2.php > applications-converted.csv

echo "Import the data into Postgres"
psql --username=$OPG_LPA_POSTGRES_USERNAME --host=$OPG_LPA_POSTGRES_HOSTNAME --dbname=$OPG_LPA_POSTGRES_NAME --file=copy.sql

echo "Removing CSV files"
rm *.csv
