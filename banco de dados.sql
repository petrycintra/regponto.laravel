/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laravel`;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `inicios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(23, '2014_10_12_000000_create_users_table', 1),
	(24, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(25, '2019_08_19_000000_create_failed_jobs_table', 1),
	(26, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(27, '2023_10_17_014410_create_inicios_table', 1),
	(28, '2023_10_18_041527_create_registros_table', 1);

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `registros` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` date NOT NULL,
  `entrada` datetime NOT NULL,
  `intervalo` datetime DEFAULT NULL,
  `volta` datetime DEFAULT NULL,
  `final` datetime DEFAULT NULL,
  `controle` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `registros` (`name`, `data`, `entrada`, `intervalo`, `volta`, `final`, `controle`) VALUES
	('Julie Hevellyn de Oliveira', '2023-10-17', '2023-10-17 10:22:13', '2023-10-18 10:56:17', '2023-10-17 19:46:45', '2023-10-17 19:46:45', 4),
	('Julie Hevellyn de Oliveira', '2023-10-16', '2023-10-16 10:22:16', '2023-10-18 10:56:17', '2023-10-16 19:46:43', '2023-10-16 19:46:44', 4),
	('Julie Hevellyn de Oliveira', '2023-10-18', '2023-10-18 22:10:16', '2023-10-18 22:10:28', '2023-10-18 22:17:32', '2023-10-18 22:17:37', 4),
	('Petry Cintra Amaral', '2023-10-19', '2023-10-19 21:10:17', '2023-10-19 21:10:19', '2023-10-19 21:10:20', '2023-10-19 21:10:21', 4),
	('Petry Cintra Amaral', '2023-10-20', '2023-10-20 21:57:27', '2023-10-20 21:57:29', '2023-10-20 21:57:30', '2023-10-20 21:57:31', 4),
	('Petry Cintra Amaral', '2023-10-21', '2023-10-21 22:35:49', '2023-10-21 22:35:55', '2023-10-21 22:35:56', '2023-10-21 22:35:58', 4);

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `position`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Petry Cintra Amaral', 'Gerente', 'petry@regponto.com', '2023-10-19 01:22:00', '$2y$10$Ezc.rYxspHMZejJ/jrvO9.ibSmmrX2Y8viGoQB2V0WAqHxeI3Spt.', 'bnyzXGREvuKN4wBKjThEhnGQxntEErrMB2BrcRVvjHGdFcB5I0EBsvAWEA82', '2023-10-19 01:22:00', '2023-10-21 03:41:33'),
	(2, 'Julie Hevellyn de Oliveira', 'Jornalista', 'julie@regponto.com', '2023-10-19 01:22:00', '$2y$10$U8/Qf0I.jguLDR2cTUUZ1uBb/4GXvAjnioYigTsLY0eHb61Oj1xvu', 'bYZelJHhR4k7ljCtwlx0hwtT72Xeofpdy6vtTEgzPoSqYeSrUDMyjeqmbFQZ', '2023-10-19 01:22:00', '2023-10-21 04:09:51'),
	(3, 'Yngra Cintra Amaral', 'Gestao-RH', 'yngra@regponto.com', '2023-10-19 01:22:00', '$2y$10$p1HetbCUGj1xE07mvWi3Y.TWAJ56irN410SJpn409mS.vd/7zErLa', 'wefot5tne1sgVacIdnyimmH50yz0FEzKgQgnVH5BUsOTCrXB7mtbitMf7CjG', '2023-10-19 01:22:00', '2023-10-21 01:49:27'),
	(4, 'Arya De Oliveira', 'Mascote', 'arya@regponto.com', '2023-10-19 01:22:00', '$2y$10$iWd7xDgcAJxwRldKDWZDT..96aT1ig4y/ci.vcV9tIqxJBbHS8U4C', 'SipMC75FFu', '2023-10-19 01:22:00', '2023-10-19 01:22:00'),
	(5, 'Neblino Cintra', 'Mascote', 'neblino@regponto.com', '2023-10-19 01:22:00', '$2y$10$fftFgPY4zOgyOO8fmf4ncu2KhLuS8rXJJq0l/UxrR3Iby2h2BxwoG', 'TcCOppohmK', '2023-10-19 01:22:00', '2023-10-19 01:22:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
