CREATE DATABASE IF NOT EXISTS coffeeDB;
CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON coffeeDB.* TO 'admin'@'%';
FLUSH PRIVILEGES;

USE coffeeDB;

CREATE TABLE IF NOT EXISTS auth (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(64) NOT NULL,
    email varchar(64) NOT NULL,
    role_id int(11) NOT NULL,
    pass varchar(64) NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
    id bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    description varchar (64) NOT NULL,
    price int NOT NULL,
    client_id bigint REFERENCES auth(id),
    worker_id bigint REFERENCES workers(id),
    creation_time datetime NOT NULL,
    ready_time datetime,
    closed_time datetime
);

CREATE TABLE IF NOT EXISTS workers (
    id bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(64) NOT NULL,
    position varchar (64) NOT NULL
);

INSERT INTO auth (username, email, role_id, pass) VALUES
("admin", "fess.2002@mail.ru", 1, "{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc="), # password: admin
("user","fess.2002@mail.ru",2,"{SHA}Et6pb+wgWTVmq3VpLJlJWWgzrck="); # password: user


INSERT INTO orders (description, price, client_id, worker_id ,creation_time, ready_time, closed_time) VALUES
("sussy balls", 228, 2, 2, STR_TO_DATE("24.10.2022 23:20", "%d.%m.%Y %H:%i"), STR_TO_DATE("24.10.2022 23:39", "%d.%m.%Y %H:%i"), STR_TO_DATE("24.10.2022 23:40", "%d.%m.%Y %H:%i")),
("abamka obezyanka", 54, 2, 2, STR_TO_DATE("24.10.2022 23:32", "%d.%m.%Y %H:%i"), NULL, NULL);

INSERT INTO workers (name, position) VALUES
("Dyadya Bogdan", "Boss of the GYM"),
("Vitaliy Zahl", "Barista Asket");


