-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2023 at 12:27 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sadASAS', 'dsada', 'admin@example.com', NULL, '$2y$10$TVEezuoshSv6QiXQx/rM8e2cavKKyVDUPqf6aZLx4gC2ridPBJeQO', 'c1pfYRzSPJo5S3bmhN4HshNMdYYxpiqyjwODnCrlOXAQUgO1zI1ibebjiE06', NULL, NULL),
(2, 'Nasrfdsf sfdsd', 'fdsfsdfs', 'yousefsimon@gmail.com', NULL, '$2y$10$h7A51NMMiE7VlLkbf0vo7e/4TFGqOFN0Mzbh4K4qgRjQ0.gf5zKgS', NULL, '2023-11-04 12:50:32', '2023-11-05 11:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`) VALUES
(1, 'departement 1', 'departement 2'),
(2, 'departemnt 2', 'departemnt 2'),
(3, 'sdffds', 'fsdfsd'),
(4, 'departement 10', 'sss');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_images`
--

DROP TABLE IF EXISTS `media_images`;
CREATE TABLE IF NOT EXISTS `media_images` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `legend` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_images`
--

INSERT INTO `media_images` (`id`, `path`, `name`, `extension`, `size`, `order`, `legend`, `copyright`, `alt`, `created_at`, `updated_at`) VALUES
(1, 'storage/media/D87RiX8JJW9Q4emztv6ESnOxCADslHzj0DsPjk2T.gif', 'mastercard.gif', 'gif', '0', 0, NULL, NULL, NULL, '2023-11-05 20:14:10', '2023-11-05 20:14:10'),
(2, 'storage/media/pq34PLLeOrKdpEoQ7iVVYPk3MIA9z2Svq8vxDLCJ.png', '٢ (1).png', 'png', '0', 0, NULL, NULL, NULL, '2023-11-05 20:14:17', '2023-11-05 20:14:17'),
(3, 'storage/media/fOqGWqmzf337pBrv0D1sCbynGu88AFOCzqY8seXK.jpg', 'payment_error (1).png', 'png', '0', 0, NULL, NULL, NULL, '2023-11-05 20:15:34', '2023-11-05 20:15:34'),
(4, 'storage/media/Ycux5s1KpANVTd7fa1todli3wOpE4EhTX6DCYYiU.jpg', 'payment_error (1).png', 'png', '0', 0, NULL, NULL, NULL, '2023-11-05 22:08:49', '2023-11-05 22:08:49'),
(5, 'storage/media/vUXtABrmfBe11H12jUGpPUKMOuqUGYWrKMMNVaHI.jpg', 'mobilewallet.jpg', 'jpg', '0', 0, NULL, NULL, NULL, '2023-11-05 22:08:58', '2023-11-05 22:08:58'),
(6, 'storage/media/2YkhBcIxbwXG4fHEfu60r8gmn6eWSvwXYgtxHPcm.jpg', 'mobilewallet.jpg', 'jpg', '0', 0, NULL, NULL, NULL, '2023-11-05 22:13:39', '2023-11-05 22:13:39'),
(7, 'storage/media/lxWQe5BsnPR2XkGnROiSJ9jSSf1xyISt9hARdcn3.jpg', 'mobilewallet.jpg', 'jpg', '0', 0, NULL, NULL, NULL, '2023-11-05 22:14:07', '2023-11-05 22:14:07'),
(8, 'storage/media/kXnG5MpbPMxnOWKqiybSoJxRPf8SKM5jrBBWJWKi.png', '٢ (1).png', 'png', '0', 0, NULL, NULL, NULL, '2023-11-05 22:14:58', '2023-11-05 22:14:58'),
(9, 'storage/media/33SfpiyasbUMESiEpj74wdMRCGzhNdfkFAQBIzUs.gif', 'mastercard.gif', 'gif', '0', 0, NULL, NULL, NULL, '2023-11-05 22:15:00', '2023-11-05 22:15:00'),
(10, 'storage/media/h6pJHgNfTzXOU0UCd8mkoJoghD7Se2T9GU3M4xyE.png', 'payment_error.png', 'png', '0', 0, NULL, NULL, NULL, '2023-11-05 22:19:50', '2023-11-05 22:19:50'),
(11, 'storage/media/uDGHzxj0tplWYPM4xAN0KVCYc4dF3njzUUKcNbYq.png', 'payment_error.png', 'png', '0', 0, NULL, NULL, NULL, '2023-11-05 22:22:14', '2023-11-05 22:22:14'),
(12, 'storage/media/FDMcYnzpiZF72A7Jpmx1xGU3bfOHrNINDD9tHXBc.jpg', 'payment_error (1).png', 'png', '0', 0, NULL, NULL, NULL, '2023-11-05 22:22:27', '2023-11-05 22:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2021_07_26_122951_create_media_images_table', 1),
(17, '2021_11_03_081129_create_sessions_table', 2),
(19, '2023_10_31_111601_create_departments_table', 3),
(20, '2023_10_31_114245_alter_users_table', 4),
(22, '2023_10_31_123340_create_task_status_table', 5),
(23, '2023_11_31_111642_create_tasks_table', 5),
(25, '2023_06_03_203533_create_admins_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5bTYmiDh22AURbDLWct9pCryoHzlPbmCgWuV7Iid', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSE1XMm5kT1pReFJiWmU1ck9pNkxic25ZalgwaG9lNW4xZHNXYnpUTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2VkaXQvMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1699230151),
('RYazjJVbtoPKqZUxEVQNYbOOcrEl7dFyT7CtlkSH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMVJxRHRrY2hWbDVZTW85ZXlhbEhKckFlVkNXZlVTSlhUVGFtRUhrYiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvZWRpdC8xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1699264062);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `task_status_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_user_id_foreign` (`user_id`),
  KEY `tasks_task_status_id_foreign` (`task_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `user_id`, `task_status_id`) VALUES
(2, 'fdss', 'fdsfsd', 2, 2),
(3, 'Nasr city', 'pizza', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

DROP TABLE IF EXISTS `task_status`;
CREATE TABLE IF NOT EXISTS `task_status` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`id`, `name`, `description`) VALUES
(1, 'pending', 'pending'),
(2, 'done', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `main_image_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_department_id_foreign` (`department_id`),
  KEY `users_main_image_id_foreign` (`main_image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `phone`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `created_at`, `updated_at`, `department_id`, `salary`, `main_image_id`) VALUES
(1, 'aaa', 'ddd', NULL, NULL, 'admin@admin.com', NULL, '$2y$10$segtqVyRryPXUPFJ.Nrpa.Ae4wfDcmKU.9RWnN59jMYq5js.5/IuC', NULL, NULL, NULL, NULL, NULL, '2023-11-01 11:51:16', '2023-11-05 22:22:29', 1, 50, 12),
(2, 'aaa 1', 'ddd 1', NULL, NULL, 'admin1@admin.com', NULL, '$2y$10$segtqVyRryPXUPFJ.Nrpa.Ae4wfDcmKU.9RWnN59jMYq5js.5/IuC', NULL, NULL, NULL, NULL, NULL, '2023-11-01 11:51:16', '2023-11-01 11:51:16', 1, 50, NULL),
(4, 'aaa 33', 'ddd 333', NULL, NULL, 'admin3@admin.com', NULL, '$2y$10$segtqVyRryPXUPFJ.Nrpa.Ae4wfDcmKU.9RWnN59jMYq5js.5/IuC', NULL, NULL, NULL, NULL, NULL, '2023-11-01 11:51:16', '2023-11-01 11:51:16', 1, 50, NULL),
(5, 'aaa 33', 'ddd 333', NULL, NULL, 'admin5@admin.com', NULL, '$2y$10$segtqVyRryPXUPFJ.Nrpa.Ae4wfDcmKU.9RWnN59jMYq5js.5/IuC', NULL, NULL, NULL, NULL, NULL, '2023-11-01 11:51:16', '2023-11-01 11:51:16', 2, 100, NULL),
(16, NULL, NULL, NULL, NULL, 'admin123123@admin.com', NULL, '$2y$10$DOOHrUTVv0Rfoq8CO.362.uLmD/9vEhBJctLu/qtwGWv/1UJSaC7e', NULL, NULL, NULL, NULL, NULL, '2023-11-01 17:51:28', '2023-11-01 17:51:28', 3, 12, NULL),
(17, NULL, NULL, NULL, NULL, 'admin123@admin.com', NULL, '$2y$10$.pvDdEQHspZHsNSnaLFcnOytiWHMgAoZf99D7va1SEGIkAqpyp5wS', NULL, NULL, NULL, NULL, NULL, '2023-11-01 17:52:35', '2023-11-01 17:52:35', 3, 20, NULL),
(19, 'youssef', 'simon', NULL, '1111111111111111111111111', 'admin123112323@admin.com', NULL, '$2y$10$5QQxkUwRM/Fc3LBkjSnwMegAvP.fJZCSoqdNeV0xAxttAzcBZdNBO', NULL, NULL, NULL, NULL, NULL, '2023-11-01 17:53:18', '2023-11-05 10:39:37', 4, 50, NULL),
(21, 'Nasr', 'city', NULL, NULL, 'admi234n@admin.com', NULL, '$2y$10$vhfLp4n8gtFG39HbLG87MOAv4mlYVcUiG4yPVCX2U1eYPwWMhoEvK', NULL, NULL, NULL, NULL, NULL, '2023-11-01 17:55:36', '2023-11-01 17:55:36', 1, 20, NULL),
(22, 'fdsfs', 'fsdfsd', NULL, NULL, 'admin1231@admin.com', NULL, '$2y$10$Aay//1SUjR1rKrekTpOHgehB5whyjvVpI2wsBuTXI3FAtbqj0Weym', NULL, NULL, NULL, NULL, NULL, '2023-11-05 09:01:08', '2023-11-05 09:01:08', 2, 3333, NULL),
(23, 'aaa', 'vvvvvv', NULL, NULL, 'adminvvv@admin.com', NULL, '$2y$10$09jPuEXymK7ZbuHuz2WeBuqWstjs1R/g4K7uNfpIKf.U2lb4xl9Ei', NULL, NULL, NULL, NULL, NULL, '2023-11-05 09:11:34', '2023-11-05 09:11:34', 1, 2333, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_task_status_id_foreign` FOREIGN KEY (`task_status_id`) REFERENCES `task_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_main_image_id_foreign` FOREIGN KEY (`main_image_id`) REFERENCES `media_images` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
