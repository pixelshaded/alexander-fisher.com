#!/bin/bash
docker exec -it portfolio mysqldump portfolio > portfolio-site-dump.sql
