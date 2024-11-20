CREATE USER admin WITH PASSWORD 'admin_microservices' IF NOT EXISTS;;

-- create work databases
CREATE DATABASE curency_db;
CREATE DATABASE currency_db_test;

GRANT ALL PRIVILEGES ON DATABASE curency_db TO admin;
GRANT ALL PRIVILEGES ON DATABASE currency_db_test TO admin;
