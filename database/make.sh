#!/bin/bash
################################################
# Quasidea Database Build Script
# Copyright 2008-2009, Quasidea Development, LLC
################################################

# Specify Path to DB Scripts and DB Name here
dbpath=/var/www/qcodo-api/database
dbname=qcodo_api

# Perform DB Tasks
echo -n "Building [$dbname]... "
mysql -uroot mysql -e "DROP DATABASE IF EXISTS $dbname"
mysql -uroot mysql -e "CREATE DATABASE $dbname DEFAULT CHARACTER SET UTF8"
mysql -uroot $dbname < $dbpath/create.sql
mysql -uroot $dbname < $dbpath/data.sql
mysql -uroot $dbname < $dbpath/qcodo_api-2009-10-08.sql
echo "Done."
