-- Adminer 4.8.1 MySQL 8.3.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `reply_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `comments` (`id`, `email`, `text`, `reply_id`, `created_at`) VALUES
(19,	'john.cook@smartadminwebapp.com',	'Hello!!!',	NULL,	'2024-02-29 15:41:00'),
(21,	'Alita@smartadminwebapp.com',	'Hey! How are you?',	NULL,	'2024-02-29 16:32:00'),
(23,	'oliver.kopyov@smartadminwebapp.com',	'Hello John and Alita!!!!',	NULL,	'2024-02-29 17:00:00'),
(24,	'john.cook@smartadminwebapp.com',	'Oliver!!!! I glad to see you',	NULL,	'2024-02-29 17:14:00');

-- 2024-03-04 10:00:40