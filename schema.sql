CREATE DATABASE yeticave
    DEFAULT CHAR SET utf8
    DEFAULT COLLATE utf8_general_ci;






CREATE TABLE categories (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            title VARCHAR(255),
                            symbol_code VARCHAR(255)

);

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       registration_date DATETIME  DEFAULT CURRENT_TIMESTAMP,
                       user_email VARCHAR(128) NOT NULL UNIQUE,
                       user_name VARCHAR(128),
                       user_password CHAR(12),
                       contact TEXT,
                       lot_id INT,
                       bet_id INT

);

CREATE TABLE lots (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
                      lot_name VARCHAR (255),
                      description TEXT,
                      image VARCHAR (255),
                      initial_price INT,
                      end_date DATE,
                      step INT,
                      user_id INT,
                      winner_id INT,
                      category_id INT,
                      FOREIGN KEY (user_id) REFERENCES users(id),
                      FOREIGN KEY (winner_id) REFERENCES users(id),
                      FOREIGN KEY (category_id) REFERENCES categories(id)

);

CREATE TABLE bets (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      bet_date DATETIME DEFAULT CURRENT_TIMESTAMP,
                      price INT,
                      user_id INT,
                      lot_id INT,
                      FOREIGN KEY (user_id) REFERENCES users(id),
                      FOREIGN KEY  (lot_id) REFERENCES lots(id)

);