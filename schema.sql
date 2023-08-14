

CREATE DATABASE yeticave
    DEFAULT CHAR SET utf8
    DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       email VARCHAR(128),
                       password CHAR(64)
);
INSERT INTO users SET email = 'vasya@mail.ru', password = 'secret';