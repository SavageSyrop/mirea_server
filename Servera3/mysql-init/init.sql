CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
SET names 'utf8';

CREATE TABLE IF NOT EXISTS users (
    user varchar(64) primary key not null, 
    passwd varchar(255)
);

INSERT INTO users VALUES ('desertfox', '{SHA}xGZvZHCShHzQUg9XLrB1fC2yJWo='); 

CREATE TABLE IF NOT EXISTS orders (
    id bigint primary key not null AUTO_INCREMENT,
    client_name varchar(64) not null,
    coffee_type varchar (64) not null,
    cost int not null
);

INSERT INTO orders (client_name, coffee_type, cost) VALUES ('MARS', 'Руссиано','228'); 
INSERT INTO orders (client_name, coffee_type, cost) VALUES ('TWIX', 'Американо', '54');
INSERT INTO orders (client_name, coffee_type, cost) VALUES ('SNIKERS', 'Чернь', '88');