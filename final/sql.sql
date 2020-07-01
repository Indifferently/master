CREATE DATABASE media;
USE media;
CREATE TABLE Users
(
id int AUTO_INCREMENT,
login varchar(50) null,
email varchar(150) null,
password varchar(150) null,
CONSTRAINT media_pk
PRIMARY KEY (id)
) ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;
CREATE TABLE photos
(
id int AUTO_INCREMENT,
user_id int null,
path text null,
created_at varchar(150),
tags text null,
views int DEFAULT(0),
title text null,
CONSTRAINT media_pk
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES Users(id)
) ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;
