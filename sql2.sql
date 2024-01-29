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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы yeticave.bets: ~3 rows (приблизительно)
INSERT INTO `bets` (`id`, `bet_date`, `price`, `user_id`, `lot_id`) VALUES
	(1, '2023-08-21 21:31:44', 5, 1, 25),
	(2, '2023-08-21 21:31:44', 7, 15, 24),
	(5, '2024-01-27 14:37:30', 9, 15, 25),
	(11, '2024-01-27 15:05:39', 333333, 15, 25),
	(12, '2024-01-27 15:06:29', 1717777, 15, 25),
	(13, '2024-01-28 21:07:11', 99, 15, 79),
	(14, '2024-01-28 21:20:37', 100, 15, 79),
	(15, '2024-01-28 21:27:03', 11, 15, 25),
	(16, '2024-01-28 21:56:16', 10, 15, 24),
	(17, '2024-01-28 21:56:20', 15, 15, 24),
	(18, '2024-01-28 21:56:29', 25, 15, 24);

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
  FULLTEXT KEY `yeti_search` (`lot_name`,`description_lot`),
  CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`),
  CONSTRAINT `lots_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы yeticave.lots: ~19 rows (приблизительно)
INSERT INTO `lots` (`id`, `create_date`, `lot_name`, `category`, `picture`, `price`, `expiration_date`, `step`, `user_id`, `winner_id`, `category_id`, `description_lot`) VALUES
	(24, '2023-08-21 21:06:34', '2014 Rossignol District Snowboard', '1', 'lot-1.jpg', 10999, '2023-08-14', NULL, 2, NULL, NULL, NULL),
	(25, '2023-08-21 21:06:34', 'newname', '1', 'lot-2.jpg', 159999, '2023-08-17', NULL, 2, NULL, NULL, NULL),
	(26, '2023-08-21 21:06:34', 'Крепления Union Contact Pro 2015 года размер L/XL', '2', 'lot-3.jpg', 8000, '2023-12-28', NULL, 1, NULL, NULL, NULL),
	(27, '2023-08-21 21:06:34', 'Ботинки для сноуборда DC Mutiny Charocal', '3', 'lot-4.jpg', 10999, '2023-05-15', NULL, 3, NULL, NULL, NULL),
	(28, '2023-08-21 21:06:34', 'Куртка для сноуборда DC Mutiny Charocal', '4', 'lot-5.jpg', 7500, '2023-09-15', NULL, 2, NULL, NULL, NULL),
	(29, '2023-08-21 21:06:34', 'Маска Oakley Canopy', '5', 'lot-6.jpg', 5400, '2023-10-15', NULL, 1, NULL, NULL, NULL),
	(38, '2023-12-05 17:45:57', 'lot_name', '6', 'picture', 5, '2023-10-15', 6, 1, NULL, NULL, '0'),
	(39, '2023-12-05 17:48:20', 'lot_name', '1', 'picture', 5, '2023-10-15', 6, 1, NULL, NULL, 'description_укырукцрруцрlot'),
	(50, '2023-12-20 22:49:44', '1212', '1', '', 2, '2023-12-20', 2, 1, NULL, NULL, 'awesfvewqae'),
	(51, '2023-12-20 22:50:10', '1212', '1', '', 2, '2023-12-20', 2, 1, NULL, NULL, 'awesfvewqae'),
	(52, '2023-12-20 22:50:18', '1212', '1', '', 2, '2023-12-20', 2, 1, NULL, NULL, 'awesfvewqae'),
	(53, '2024-01-22 22:21:25', '1213', '1', 'lot-1.jpg', 13, '2023-12-20', 3, 1, NULL, NULL, 'awesfvewqae'),
	(67, '2023-12-26 22:25:48', 'ываи', '2', 'Снимок экрана 2023-08-14 205410.png', 44, '2023-12-27', 4, 1, NULL, NULL, 'ывкпцукп'),
	(68, '2023-12-26 22:28:04', '4444444', '1', '658b294420ec8.jpg', 444, '2023-12-27', 4, 1, NULL, NULL, '444444444444444'),
	(69, '2023-12-26 22:29:28', '666666666', '4', '658b299876318.jpg', 666, '2023-12-27', 6, 1, NULL, NULL, '6666666'),
	(70, '2024-01-11 22:39:50', '234', '3', '65a04406085e2.jpg', 44, '2024-01-12', 4, 1, NULL, NULL, '342t32t'),
	(71, '2024-01-21 19:32:20', '3333', '1', '65ad471476801.jpg', 33333, '2024-01-21', 3, 1, NULL, NULL, '33333333'),
	(72, '2024-01-21 19:32:46', '5555', '1', '65ad472e716ca.jpg', 55, '2024-01-22', 5, 1, NULL, NULL, '555'),
	(73, '2024-01-21 19:45:42', '777777', '1', '65ad4a36efc1e.jpg', 7777, '2024-01-21', 777, 15, NULL, NULL, '77777777777779'),
	(78, '2024-01-28 21:05:18', '44444444', '1', '65b6975e3766f.jpg', 4444444, '2024-01-31', 44, 15, NULL, NULL, '444444444444'),
	(79, '2024-01-28 21:11:47', '555555555555', '2', '65b698e389ede.jpg', 55, '2024-01-31', 55, 15, NULL, NULL, '5555555555555');

-- Дамп структуры для таблица yeticave.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_email` varchar(128) NOT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `contact` text,
  `lot_id` int DEFAULT NULL,
  `bet_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы yeticave.users: ~9 rows (приблизительно)
INSERT INTO `users` (`id`, `registration_date`, `user_email`, `user_name`, `user_password`, `contact`, `lot_id`, `bet_id`) VALUES
	(1, '2023-08-21 20:53:31', 'vasya@mail.ru', 'den', 'secret', NULL, NULL, NULL),
	(2, '2023-08-21 20:53:31', 'vlad@mail.ru', 'neden', 'secretvlad', NULL, NULL, NULL),
	(3, '2023-08-21 20:54:26', 'vlad1@mail.ru', 'vlad', 'secretvlad', NULL, NULL, NULL),
	(4, '2023-08-21 20:54:26', 'vlad5@ma.ru', 'vlad7', 'secretvhhlad', NULL, NULL, NULL),
	(5, '2024-01-17 19:14:52', 'test', 'test', 'test', 'test', NULL, NULL),
	(6, '2024-01-17 20:24:45', 'demo@ya.ru', ' demo', 'sdavasdv', 'demo', NULL, NULL),
	(13, '2024-01-17 22:32:48', 'demo3@ya.ru', 'demo3', '$2y$10$pIMTxaY8A2tXUe0CL8zEFOPut8BdqBeTDYGHtwpCaDWrK.9ykCKf.', ' demo3', NULL, NULL),
	(14, '2024-01-17 22:44:04', 'demo1@ya.ru', 'demo1', '$2y$10$Vshf8xxOIlkayQZb7eua7OY6OcsooY4Oi/v36JUI6mMSwUerMSXz2', 'demo1', NULL, NULL),
	(15, '2024-01-17 22:51:50', 'demo22@ya.ru', 'demo22', '$2y$10$PMNljnmBITFrK1A8zeUhxOUoaRZQap3Fp1vgcMcTGIhJbObYNpV6G', 'demo22', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
