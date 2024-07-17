/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `barangay` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brgy` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `latitude` decimal(11,4) DEFAULT NULL,
  `longitude` decimal(11,4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `beneficiary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ch_favorites` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ch_messages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `program` int DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `failed_jobs` (
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

CREATE TABLE `focal_persons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `notify` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `program_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date DEFAULT NULL,
  `cash` decimal(11,2) DEFAULT NULL,
  `status` int NOT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `payroll` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `programtype_id` int DEFAULT NULL,
  `balance` decimal(11,2) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `program` int DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `personal_access_tokens` (
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

CREATE TABLE `program_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `control_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `program` int DEFAULT NULL,
  `disability` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `programs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `focal_person` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `sms_token_identity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_identity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `transaction_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `program` int NOT NULL,
  `programtype_id` int NOT NULL,
  `cash` decimal(11,2) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` int NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `barangay` (`id`, `brgy`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Talisay', '124.9658', '10.3636', '2023-07-30 06:04:31', NULL);
INSERT INTO `barangay` (`id`, `brgy`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(2, 'Anahao', '124.9190', '10.3002', '2023-07-30 06:04:55', NULL);
INSERT INTO `barangay` (`id`, `brgy`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(3, 'Banahao', '124.9010', '10.4207', '2023-07-30 06:06:20', NULL);
INSERT INTO `barangay` (`id`, `brgy`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(4, 'Baugo', '124.9203', '10.3824', '2023-07-30 06:06:20', NULL),
(5, 'Beniton', '124.9190', '10.3670', '2023-07-30 06:06:20', NULL),
(6, 'Buenavista', '124.9259', '10.3339', '2023-07-30 06:11:44', NULL),
(7, 'Bunga', '124.9314', '10.3094', '2023-07-30 06:11:45', NULL),
(8, 'Casao', '124.9631', '10.3688', '2023-07-30 06:11:45', NULL),
(9, 'Catmon', '124.9148', '10.3449', '2023-07-30 06:11:45', NULL),
(10, 'Catoogan', '124.8983', '10.3708', '2023-07-30 06:11:45', NULL),
(11, 'Cawayanan', '124.9443', '10.3439', '2023-07-30 06:11:45', NULL),
(12, 'Dao', '124.9438', '10.3258', '2023-07-30 06:11:45', NULL),
(13, 'Divisoria', '124.9638', '10.3426', '2023-07-30 06:11:45', NULL),
(14, 'Esperanza', '124.9306', '10.3592', '2023-07-30 06:11:45', NULL),
(15, 'Guinsangaan', '124.9548', '10.3554', '2023-07-30 06:11:45', NULL),
(16, 'Hibagwan', '124.9093', '10.3551', '2023-07-30 06:14:51', NULL),
(17, 'Hilaan', '124.8985', '10.4055', '2023-07-30 06:14:51', NULL),
(18, 'Himakilo', '124.9404', '10.3647', '2023-07-30 06:14:51', NULL),
(19, 'Hitawos', '124.8987', '10.4401', '2023-07-30 06:14:51', NULL),
(20, 'Lanao', '124.8928', '10.3906', '2023-07-30 06:14:51', NULL),
(21, 'Lawgawan', '124.9211', '10.4212', '2023-07-30 06:14:51', NULL),
(22, 'Mahayahay', '124.9124', '10.3091', '2023-07-30 06:14:51', NULL),
(23, 'Malbago', '124.9206', '10.3819', '2023-07-30 06:15:09', NULL),
(24, 'Mauylab', '124.9524', '10.3315', '2023-07-30 06:16:13', NULL),
(25, 'Olisihan', '124.9143', '10.4759', '2023-07-30 06:16:13', NULL),
(26, 'Paku', '124.9259', '10.3196', '2023-07-30 06:16:13', NULL),
(27, 'Pamahawan', '124.9093', '10.3216', '2023-07-30 06:18:19', NULL),
(28, 'Pamigsian', '124.9259', '10.4248', '2023-07-30 06:18:19', NULL),
(29, 'Pangi', '124.9556', '10.3806', '2023-07-30 06:18:19', NULL),
(30, 'Poblacion', '124.9706', '10.3541', '2023-07-30 06:18:19', NULL),
(31, 'Pong-on', '124.9093', '10.3933', '2023-07-30 06:18:19', NULL),
(32, 'Sampongon', '124.9369', '10.3326', '2023-07-30 06:18:19', NULL),
(33, 'San Ramon', '124.9631', '10.3568', '2023-07-30 06:18:19', NULL),
(34, 'San Vicente', '124.9482', '10.3339', '2023-07-30 06:20:35', NULL),
(35, 'Santa Cruz', '124.9658', '10.3756', '2023-07-30 06:20:35', NULL),
(36, 'Santo Nino', '124.9644', '10.3483', '2023-07-30 06:20:35', NULL),
(37, 'Taa', '124.9369', '10.3851', '2023-07-30 06:20:35', NULL),
(38, 'Taytagan', '124.9465', '10.3589', '2023-07-30 06:20:35', NULL),
(39, 'Tuburan', '124.9369', '10.3708', '2023-07-30 06:20:35', NULL),
(40, 'Union', '124.9700', '10.3330', '2023-07-30 06:20:35', NULL);

INSERT INTO `beneficiary` (`id`, `name`, `gender`, `contact_number`, `address`, `birthdate`, `created_at`, `updated_at`) VALUES
(67, 'Juanito Ocio Acedo', 'M', '09764612406', '1', '1940-06-24', '2023-11-17 10:31:00', '2024-01-06 09:56:29');
INSERT INTO `beneficiary` (`id`, `name`, `gender`, `contact_number`, `address`, `birthdate`, `created_at`, `updated_at`) VALUES
(68, 'Emma R. Aguilar', 'F', '09516620497', '1', '1947-03-12', '2023-11-17 10:35:21', '2024-01-06 09:56:32');
INSERT INTO `beneficiary` (`id`, `name`, `gender`, `contact_number`, `address`, `birthdate`, `created_at`, `updated_at`) VALUES
(69, 'Melchor Aquino', 'M', '09516620497', '7', '1956-11-05', '2023-11-22 13:07:53', '2024-01-06 21:28:58');
INSERT INTO `beneficiary` (`id`, `name`, `gender`, `contact_number`, `address`, `birthdate`, `created_at`, `updated_at`) VALUES
(70, 'Vilma Santos', 'F', '09509463473', '2', '1998-05-25', '2023-11-22 14:17:26', '2024-01-06 09:55:57'),
(71, 'Jarnel Casono Mandi', 'M', '09631864178', '2', '1987-12-04', '2023-11-22 14:43:14', '2024-01-06 09:56:00'),
(73, 'Sharon Cuneta', 'F', '09215676908', '5', '1998-03-17', '2023-12-20 21:01:08', '2024-01-06 09:56:06'),
(74, 'Estifany Jornales', 'F', '09054857066', '3', '1989-04-02', '2023-12-22 10:15:50', '2024-01-06 11:43:14'),
(75, 'Janice Jimenez', 'F', '09631864178', '4', '2001-05-01', '2024-01-08 11:35:21', '2024-01-08 11:35:21'),
(76, 'lesley ann vilbar', 'F', '09516620497', '3', '2001-06-20', '2024-01-08 11:46:17', '2024-01-08 11:46:17'),
(77, 'Estifany Jornales', 'F', '09509463473', '3', '1989-04-02', '2024-01-08 11:47:53', '2024-01-08 11:47:53');



INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('0d830409-c6be-4ddf-9bb1-bac0897f1eba', 57, 6, 'Hi', NULL, 1, '2023-11-28 11:39:10', '2023-11-28 11:39:38');
INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('5b721a26-0d29-4f4f-9081-2e70e41e4bcf', 57, 1, 'Hi', NULL, 1, '2023-11-28 11:38:41', '2023-11-28 11:40:13');
INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('63e49338-d1ca-4fcb-9751-c3caac2332e0', 1, 2, 'hi\\', NULL, 0, '2023-12-21 17:47:47', '2023-12-21 17:47:47');
INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('7edf1e41-14ab-41ef-8bba-9465746f021e', 6, 1, 'hi', NULL, 1, '2023-12-21 12:40:10', '2023-12-21 12:40:24'),
('82e43dde-8ee0-4aa7-8a12-2dbccc557cb0', 1, 60, 'hi', NULL, 1, '2023-12-22 10:23:49', '2023-12-22 11:00:36'),
('a06e2728-4fa1-40cb-8b23-2533cc914fc4', 57, 57, 'hi maam', NULL, 0, '2023-11-28 11:34:57', '2023-11-28 11:34:57'),
('e68c27d5-4390-422d-9538-282e3b581a4b', 53, 1, 'hi', NULL, 1, '2023-12-21 12:43:26', '2023-12-21 12:43:41');

INSERT INTO `event` (`id`, `title`, `date`, `program`, `location`, `time`, `status`, `created_at`, `updated_at`) VALUES
(98, 'Cash Assistance Release', '2024-01-08', 5, 'Bontoc Gym', '8:00', '1', '2024-01-08 11:49:27', '2024-01-08 11:49:27');




INSERT INTO `focal_persons` (`id`, `name`, `address`, `contact_number`, `created_at`, `updated_at`) VALUES
(22, 'AICS - Sample Person', 'Sogod Southern Leyte', '09661195690', '2023-08-01 00:27:58', '2023-12-21 17:33:50');
INSERT INTO `focal_persons` (`id`, `name`, `address`, `contact_number`, `created_at`, `updated_at`) VALUES
(23, 'ECCD - Sample Person', 'Bontoc Southern Leyte', '09661195690', '2023-08-01 00:29:05', '2023-11-14 17:59:07');
INSERT INTO `focal_persons` (`id`, `name`, `address`, `contact_number`, `created_at`, `updated_at`) VALUES
(24, 'SENIOR - Sample Person', 'Bontoc Southern Leyte', '09661195690', '2023-08-01 00:30:24', NULL);
INSERT INTO `focal_persons` (`id`, `name`, `address`, `contact_number`, `created_at`, `updated_at`) VALUES
(25, 'SPP - Sample Person', 'Bontoc Southern Leyte', '09661195690', '2023-08-01 00:31:35', '2023-12-15 19:29:20'),
(26, 'PWD - Sample Person', 'Bontoc Southern Leyte', '09664667612', '2023-08-01 00:33:57', '2023-11-25 06:23:56');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_06_999999_add_active_status_to_users', 2),
(6, '2023_08_06_999999_add_avatar_to_users', 2),
(7, '2023_08_06_999999_add_dark_mode_to_users', 2),
(8, '2023_08_06_999999_add_messenger_color_to_users', 2),
(9, '2023_08_06_999999_create_chatify_favorites_table', 2),
(10, '2023_08_06_999999_create_chatify_messages_table', 2);

INSERT INTO `notify` (`id`, `userid`, `program_id`, `title`, `date`, `cash`, `status`, `type`, `created_at`, `updated_at`) VALUES
(415, 69, 5, '98', '2024-01-08', NULL, 1, 1, '2024-01-08 11:49:28', '2024-01-08 11:49:28');
INSERT INTO `notify` (`id`, `userid`, `program_id`, `title`, `date`, `cash`, `status`, `type`, `created_at`, `updated_at`) VALUES
(416, 70, 5, '98', '2024-01-08', NULL, 1, 1, '2024-01-08 11:49:29', '2024-01-08 11:49:29');
INSERT INTO `notify` (`id`, `userid`, `program_id`, `title`, `date`, `cash`, `status`, `type`, `created_at`, `updated_at`) VALUES
(417, 71, 5, '98', '2024-01-08', NULL, 1, 1, '2024-01-08 11:49:29', '2024-01-08 11:49:29');
INSERT INTO `notify` (`id`, `userid`, `program_id`, `title`, `date`, `cash`, `status`, `type`, `created_at`, `updated_at`) VALUES
(418, 73, 5, '98', '2024-01-08', NULL, 1, 1, '2024-01-08 11:49:30', '2024-01-08 11:49:30'),
(419, 77, 5, '98', '2024-01-08', NULL, 1, 1, '2024-01-08 11:49:31', '2024-01-08 11:49:31'),
(420, 77, 5, 'Cash Received', NULL, '1000.00', 1, 2, '2024-01-08 11:51:07', '2024-01-08 11:51:07'),
(421, 69, 5, 'Cash Received', NULL, '1000.00', 1, 2, '2024-01-08 11:51:08', '2024-01-08 11:51:08'),
(422, 73, 5, 'Cash Received', NULL, '1000.00', 1, 2, '2024-01-08 11:51:08', '2024-01-08 11:51:08'),
(423, 71, 5, 'Cash Received', NULL, '1000.00', 1, 2, '2024-01-08 11:51:09', '2024-01-08 11:51:09'),
(424, 70, 5, 'Cash Received', NULL, '1000.00', 1, 2, '2024-01-08 11:51:10', '2024-01-08 11:51:10');



INSERT INTO `payroll` (`id`, `userid`, `programtype_id`, `balance`, `status`, `month`, `program`, `event`, `created_at`, `updated_at`) VALUES
(54, 75, 79, '0.00', 0, NULL, 1, NULL, '2024-01-08 11:35:21', '2024-01-08 11:35:21');
INSERT INTO `payroll` (`id`, `userid`, `programtype_id`, `balance`, `status`, `month`, `program`, `event`, `created_at`, `updated_at`) VALUES
(55, 76, 80, '0.00', 0, NULL, 4, NULL, '2024-01-08 11:46:17', '2024-01-08 11:46:17');
INSERT INTO `payroll` (`id`, `userid`, `programtype_id`, `balance`, `status`, `month`, `program`, `event`, `created_at`, `updated_at`) VALUES
(56, 77, 81, '0.00', 0, NULL, 5, NULL, '2024-01-08 11:47:53', '2024-01-08 11:47:53');
INSERT INTO `payroll` (`id`, `userid`, `programtype_id`, `balance`, `status`, `month`, `program`, `event`, `created_at`, `updated_at`) VALUES
(57, 77, 81, '1000.00', NULL, '01', 5, '98', '2024-01-08 11:51:06', '2024-01-08 11:51:06'),
(58, 69, 72, '1000.00', NULL, '01', 5, '98', '2024-01-08 11:51:07', '2024-01-08 11:51:07'),
(59, 73, 76, '1000.00', NULL, '01', 5, '98', '2024-01-08 11:51:08', '2024-01-08 11:51:08'),
(60, 71, 74, '1000.00', NULL, '01', 5, '98', '2024-01-08 11:51:08', '2024-01-08 11:51:08'),
(61, 70, 73, '1000.00', NULL, '01', 5, '98', '2024-01-08 11:51:09', '2024-01-08 11:51:09');



INSERT INTO `program_type` (`id`, `userid`, `name`, `control_number`, `program`, `disability`, `address`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(70, 67, 'Juanito Ocio Acedo', '1112', 3, NULL, '1', 1, NULL, '2023-11-17 10:31:00', '2024-01-06 09:56:29');
INSERT INTO `program_type` (`id`, `userid`, `name`, `control_number`, `program`, `disability`, `address`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(71, 68, 'Emma R. Aguilar', '1802', 3, NULL, '1', 1, NULL, '2023-11-17 10:35:21', '2024-01-06 09:56:32');
INSERT INTO `program_type` (`id`, `userid`, `name`, `control_number`, `program`, `disability`, `address`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(72, 69, 'Melchor Aquino', '0275', 5, 'blind', '7', 1, NULL, '2023-11-22 13:07:53', '2024-01-06 21:28:58');
INSERT INTO `program_type` (`id`, `userid`, `name`, `control_number`, `program`, `disability`, `address`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(73, 70, 'Vilma Santos', '5248', 5, 'visually impaired', '2', 1, NULL, '2023-11-22 14:17:26', '2024-01-06 09:55:57'),
(74, 71, 'Jarnel Casono Mandi', '084-2', 5, 'Physical Disability', '2', 1, NULL, '2023-11-22 14:43:14', '2024-01-06 09:56:00'),
(76, 73, 'Sharon Cuneta', '0275', 5, 'visually impaired', '5', 1, NULL, '2023-12-20 21:01:08', '2024-01-06 09:56:06'),
(77, 68, NULL, NULL, 1, NULL, '1', 1, NULL, '2023-12-21 17:41:20', '2023-12-21 17:41:20'),
(78, 74, 'Estifany Jornales', '1111', 5, 'Visually Impaired', '3', 0, 'Deceased', '2023-12-22 10:15:50', '2024-01-06 11:43:14'),
(79, 75, 'Janice Jimenez', '02541', 1, NULL, '4', 1, NULL, '2024-01-08 11:35:21', '2024-01-08 11:35:21'),
(80, 76, 'lesley ann vilbar', '2541', 4, NULL, '3', 1, NULL, '2024-01-08 11:46:17', '2024-01-08 11:46:17'),
(81, 77, 'Estifany Jornales', '0001', 5, 'visually impaired', '3', 1, NULL, '2024-01-08 11:47:53', '2024-01-08 11:47:53');

INSERT INTO `programs` (`id`, `program`, `description`, `focal_person`, `created_at`, `updated_at`) VALUES
(1, 'Assistance to Individuals in Crisis (AICS)', 'A social safety net or a stop-gap mechanism to support the recovery of individuals and families from unexpected crisis such as illness or death of a family member, and other crisis situations.', 22, '2023-08-01 00:27:58', '2023-12-21 17:33:50');
INSERT INTO `programs` (`id`, `program`, `description`, `focal_person`, `created_at`, `updated_at`) VALUES
(2, 'Early Childhood Care and Development', 'Quality nurturing care during this period - adequate nutrition, good health care, protection, play and early education - is vital for children\'s physical, cognitive, linguistic and social-emotional development.', 23, '2023-08-01 00:29:05', '2023-11-14 17:59:07');
INSERT INTO `programs` (`id`, `program`, `description`, `focal_person`, `created_at`, `updated_at`) VALUES
(3, 'Social Pension Program for Indigent Senior Citizens', 'The program seeks to improve the condition of indigent senior citizens by augmenting their daily subsistence and medical needs; reduce incidence of hunger; and protect them from neglect, abuse, deprivation, and natural and man-made disasters.', 24, '2023-08-01 00:30:24', NULL);
INSERT INTO `programs` (`id`, `program`, `description`, `focal_person`, `created_at`, `updated_at`) VALUES
(4, 'Solo Parent Program', 'The Solo Parent Cash Assistance is intended to help solo parents cover their basic needs, such as food, shelter, and clothing.', 25, '2023-08-01 00:31:36', '2023-12-15 19:29:20'),
(5, 'Person with Disabilities', 'It is intended to enhance PWDs capacity to attain a more meaningful, productive and satisfying way of life and ultimately become self-reliant, productive and contributing members of society.', 26, '2023-08-01 00:33:57', '2023-11-25 06:23:56');

INSERT INTO `sms_token_identity` (`id`, `url`, `access_token`, `mobile_identity`, `created_at`, `updated_at`) VALUES
(1, 'https://api.pushbullet.com/v2/texts', 'o.yylGoVtrdUYpeYhU3R7XqvxxjSjQQiuc', 'ujzJlp3qjNAsjvJx7JHYDQ', '2023-08-15 01:50:31', '2024-01-06 18:44:18');




INSERT INTO `users` (`id`, `userid`, `name`, `email`, `email_verified_at`, `phone`, `location`, `about`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 0, 'BONTOC MSWDO', 'bontoc@admin.com', '2023-07-31 16:16:55', '09664667612', 'Bontoc Southern Leyte', 'MSWDO Administrator', '$2y$10$1TnQO/F2kFHWsJCksS00We5f11Gj5k61TqkZyyHPtPzpH5Y/19/7y', 'HybjA7fu6tTXTCt24S1gH3gzF3gqoOjXytC81phtzNFR7VgbBdqEmM7satsN', '2023-07-31 16:16:55', '2023-12-21 12:43:59', 1, 0, '', 0, '#2180f3');
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `email_verified_at`, `phone`, `location`, `about`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(2, 22, 'AICS - Sample Person', 'aics@gmail.com', NULL, '09661195690', 'Sogod Southern Leyte', 'Focal Person', '$2y$10$us/VOHr6h.wvL4fcGrDdquOsG9tq9YfI8D/1VYzqk0l4v6fRlSz7.', NULL, '2023-07-31 16:27:58', '2023-12-21 17:33:50', 2, 1, '', 0, '#2180f3');
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `email_verified_at`, `phone`, `location`, `about`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(3, 23, 'ECCD - Sample Person', 'eccd@gmail.com', NULL, '09661195690', 'Bontoc Southern Leyte', 'Focal Person', '$2y$10$0HkKYhaEKAZFgzlhzSOBkeSyi1idyxToIfUQEmWGZbRWZ9.lTPK9S', NULL, '2023-07-31 16:29:05', '2023-11-14 17:59:07', 2, 0, '', 0, NULL);
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `email_verified_at`, `phone`, `location`, `about`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(4, 24, 'SENIOR - Sample Person', 'senior@gmail.com', NULL, '09661195690', 'Bontoc Southern Leyte', 'Focal Person', '$2y$10$EPtSDEZEgn4MGl5mdeBu4OkBjur2OIJRY6I6CMXE6X6ir3M5hJH8.', NULL, '2023-07-31 16:30:24', '2023-10-31 20:41:25', 2, 0, '', 0, NULL),
(5, 25, 'SPP - Sample Person', 'spp@gmail.com', NULL, '09661195690', 'Bontoc Southern Leyte', 'Focal Person', '$2y$10$d2IwpUd8cWG6ZXM5rj8XjOifulo5H43wAq6Nus8aB1gl60IvB2MBa', NULL, '2023-07-31 16:31:36', '2023-12-15 19:29:20', 2, 1, '', 0, NULL),
(6, 26, 'PWD - Sample Person', 'pwd@gmail.com', NULL, '09664667612', 'Bontoc Southern Leyte', 'Focal Person', '$2y$10$/nrqadS/ZyTVgVepLX1u5O05DjDt.zQx/6cR01llg503.wt93B1.i', NULL, '2023-07-31 16:33:57', '2023-12-21 12:40:04', 2, 1, '', 0, '#4CAF50'),
(53, 67, 'Juanito Ocio Acedo', 'acedojuanito@gmail.com', NULL, '09764612406', NULL, NULL, '$2y$10$9wVZrqdhug9AT91PAHTS3OmXO6zbAhs8RIjdZtPrlwhEe.W/lFM8O', NULL, '2023-11-17 10:31:00', '2024-01-06 09:56:29', 3, 1, '', 0, NULL),
(54, 68, 'Emma R. Aguilar', 'aguilaremma@gmail.com', NULL, '09516620497', NULL, NULL, '$2y$10$SzDY1ioQJszF/D8cMXOdLeFLHM/6whiKhY56oMTs30y/Lvv8nSHTK', NULL, '2023-11-17 10:35:21', '2024-01-06 09:56:32', 3, 0, '', 0, NULL),
(55, 69, 'Melchor Aquino', 'melchor@gmail.com', NULL, '09516620497', NULL, NULL, '$2y$10$5Otze6DVdxZLINIx2zfoqOC2cxghbcC06.zJVMZ30vhl8vF5dREmO', NULL, '2023-11-22 13:07:53', '2024-01-06 21:28:58', 3, 0, '', 0, NULL),
(56, 70, 'Vilma Santos', 'santos@gmail.com', NULL, '09509463473', NULL, NULL, '$2y$10$j6UTYQbp4xtqgZCQ92jhT.YHW4OVEfo/ZXI1MVfiqLWz.DAAaKqc6', NULL, '2023-11-22 14:17:26', '2024-01-06 09:55:57', 3, 0, '', 0, NULL),
(57, 71, 'Jarnel Casono Mandi', 'mandi@gmail.com', NULL, '09631864178', NULL, NULL, '$2y$10$dEWM8Ib4PxQN4GHbvu2VvOkc8rEMfV3UpBEBh1SCOzpvYZRrZgGr2', NULL, '2023-11-22 14:43:14', '2024-01-06 09:56:00', 3, 1, '', 0, NULL),
(59, 73, 'Sharon Cuneta', 'cuneta@gmail.com', NULL, '09215676908', NULL, NULL, '$2y$10$leTqZQtQbKhQ.BdKlOB9HOl4a6cEip4Zq5mzcDLEMs7k/UR1w.sBC', NULL, '2023-12-20 21:01:08', '2024-01-06 09:56:06', 3, 0, '', 0, NULL),
(60, 74, 'Estifany Jornales', 'jornales@gmail.com', NULL, '09054857066', NULL, NULL, '$2y$10$GsdxdjemsBAUu1qEwPWhfuSTTvqq8jKv2O5UXaSJ7Oi9hs3G99TUq', NULL, '2023-12-22 10:15:50', '2024-01-06 11:43:14', 3, 0, '', 0, NULL),
(61, 75, 'Janice Jimenez', 'janice@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$xmvlEnm0SX3DtuZBaeVf9eCDKYOEYuwmKwc2C.yuP2le9XnWprmje', NULL, '2024-01-08 11:35:21', '2024-01-08 11:35:21', 3, 0, '', 0, NULL),
(62, 76, 'lesley ann vilbar', 'lesley@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$2eUQwtpgu59A3ThzRl8O7OOXlKJLuBoVUsBYXLulWC0Ot1ZZkDvY.', NULL, '2024-01-08 11:46:17', '2024-01-08 11:46:17', 3, 0, '', 0, NULL),
(63, 77, 'Estifany Jornales', 'estifany@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$6gH5qEebwUGT.zgP/Og5LOo8QY2zVtjJRTh7nvQ3ipP7XG6PcFhbO', NULL, '2024-01-08 11:47:53', '2024-01-08 11:47:53', 3, 0, '', 0, NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;