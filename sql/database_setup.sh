#!/bin/bash

db_name="interpromos"

# Create database
psql -U postgres -d $db_name -a -f model.sql
psql -U postgres -d $db_name -a -f data.sql

# Connect to the database
psql -U postgres -d $db_name