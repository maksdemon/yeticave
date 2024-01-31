-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.30 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных yeticave
CREATE DATABASE IF NOT EXISTS `yeticave` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `yeticave`;

-- Дамп структуры для таблица yeticave.bets
CREATE TABLE IF NOT EXISTS `bets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bet_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `price` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `lot_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `lot_id` (`lot_id`),
  CONSTRAINT `bets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `bets_ibfk_2` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы yeticave.bets: ~3 rows (приблизительно)
INSERT INTO `bets` (`id`, `bet_date`, `price`, `user_id`, `lot_id`) VALUES
	(1, '2023-08-21 21:31:44', 550, 1, 25),
	(2, '2023-08-21 21:31:44', 77777, 2, 24),
	(3, '2023-08-21 21:31:44', 9999999, 3, 29);

-- Дамп структуры для таблица yeticave.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name_category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы yeticave.categories: ~6 rows (приблизительно)
INSERT INTO `categories` (`id`, `title`, `name_category`) VALUES
	(1, 'Доски и лыжи', 'boards'),
	(2, 'Крепления', 'attachment'),
	(3, 'Ботинки', 'boots'),
	(4, 'Одежда', 'clothing'),
	(5, 'Инструменты', 'tools'),
	(6, 'Разное', 'other');

-- Дамп структуры для таблица yeticave.lots
CREATE TABLE IF NOT EXISTS `lots` (
  `id` int NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `lot_name` varchar(255) DEFAULT NULL,
  `category` text,
  `picture` varchar(255) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `step` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `winner_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `description_lot` mediumtext,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `winner_id` (`winner_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`),
  CONSTRAINT `lots_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы yeticave.lots: ~8 rows (приблизительно)
INSERT INTO `lots` (`id`, `create_date`, `lot_name`, `category`, `picture`, `price`, `expiration_date`, `step`, `user_id`, `winner_id`, `category_id`, `description_lot`) VALUES
	(24, '2023-08-21 21:06:34', '2014 Rossignol District Snowboard', '1', 'img/lot-1.jpg', 10999, '2023-08-14', NULL, 2, NULL, NULL, NULL),
	(25, '2023-08-21 21:06:34', 'newname', '1', 'img/lot-2.jpg', 159999, '2023-08-17', NULL, 2, NULL, NULL, NULL),
	(26, '2023-08-21 21:06:34', 'Крепления Union Contact Pro 2015 года размер L/XL', '2', 'uploads/lot-3.jpg', 8000, '2023-12-28', NULL, 1, NULL, NULL, NULL),
	(27, '2023-08-21 21:06:34', 'Ботинки для сноуборда DC Mutiny Charocal', '3', 'img/lot-4.jpg', 10999, '2023-05-15', NULL, 3, NULL, NULL, NULL),
	(28, '2023-08-21 21:06:34', 'Куртка для сноуборда DC Mutiny Charocal', '4', 'img/lot-5.jpg', 7500, '2023-09-15', NULL, 2, NULL, NULL, NULL),
	(29, '2023-08-21 21:06:34', 'Маска Oakley Canopy', '5', 'img/lot-6.jpg', 5400, '2023-10-15', NULL, 1, NULL, NULL, NULL),
	(38, '2023-12-05 17:45:57', 'lot_name', '6', 'picture', 5, '2023-10-15', 6, 1, NULL, NULL, '0'),
	(39, '2023-12-05 17:48:20', 'lot_name', '1', 'picture', 5, '2023-10-15', 6, 1, NULL, NULL, 'description_укырукцрруцрlot');

-- Дамп структуры для таблица yeticave.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_email` varchar(128) NOT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `user_password` char(12) DEFAULT NULL,
  `contact` text,
  `lot_id` int DEFAULT NULL,
  `bet_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы yeticave.users: ~4 rows (приблизительно)
INSERT INTO `users` (`id`, `registration_date`, `user_email`, `user_name`, `user_password`, `contact`, `lot_id`, `bet_id`) VALUES
	(1, '2023-08-21 20:53:31', 'vasya@mail.ru', NULL, 'secret', NULL, NULL, NULL),
	(2, '2023-08-21 20:53:31', 'vlad@mail.ru', NULL, 'secretvlad', NULL, NULL, NULL),
	(3, '2023-08-21 20:54:26', 'vlad1@mail.ru', 'vlad', 'secretvlad', NULL, NULL, NULL),
	(4, '2023-08-21 20:54:26', 'vlad5@ma.ru', 'vlad7', 'secretvhhlad', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
