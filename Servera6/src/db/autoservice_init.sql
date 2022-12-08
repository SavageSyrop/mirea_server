CREATE DATABASE IF NOT EXISTS userDB;
CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON userDB.* TO 'admin'@'%';
FLUSH PRIVILEGES;

USE userDB;

CREATE TABLE IF NOT EXISTS auth (
    ID int(11) NOT NULL AUTO_INCREMENT,
    username varchar(64) NOT NULL,
    role_id int(11) NOT NULL,
    pass varchar(64) NOT NULL,
    PRIMARY KEY (ID)
);


INSERT INTO auth (username, role_id, pass) VALUES
("admin", 1, "{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc="), # password: admin
("user",2,"{SHA}Et6pb+wgWTVmq3VpLJlJWWgzrck="); # password: user
