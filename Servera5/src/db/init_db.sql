CREATE DATABASE IF NOT EXISTS userDB;
USE userDB;

CREATE TABLE IF NOT EXISTS uploaded_files (
id bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
name varchar(64) NOT NULL,
type varchar(64) NOT NULL,
size int NOT NULL,
upload_date datetime NOT NULL
);
