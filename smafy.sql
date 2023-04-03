-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table smafy.failed_jobs
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

-- Dumping data for table smafy.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table smafy.jawaban
CREATE TABLE IF NOT EXISTS `jawaban` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `u_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.jawaban: ~137 rows (approximately)
INSERT INTO `jawaban` (`id`, `u_id`, `package_id`, `soal_id`, `answer`, `result`, `created_at`, `updated_at`) VALUES
	(1, 'E3bkufzl', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 03:05:22', '2023-03-27 03:05:22'),
	(2, 'E3bkufzl', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 03:05:25', '2023-03-27 03:05:25'),
	(3, 'E3bkufzl', '05oO-O5w-37G', '3', 'a', 1, '2023-03-27 03:05:33', '2023-03-27 03:05:33'),
	(4, 'E3bkufzl', '05oO-O5w-37G', '4', 'b', 1, '2023-03-27 03:05:37', '2023-03-27 03:05:37'),
	(5, 'E3bkufzl', '05oO-O5w-37G', '5', 'c', 1, '2023-03-27 03:05:44', '2023-03-27 03:05:44'),
	(6, 'E3bkufzl', '05oO-O5w-37G', '6', 'd', 1, '2023-03-27 03:05:53', '2023-03-27 03:05:53'),
	(7, 'E3bkufzl', '05oO-O5w-37G', '7', 'c', 1, '2023-03-27 03:05:58', '2023-03-27 03:05:58'),
	(8, 'E3bkufzl', '05oO-O5w-37G', '8', 'a', 1, '2023-03-27 03:06:08', '2023-03-27 03:06:08'),
	(9, 'E3bkufzl', '05oO-O5w-37G', '9', 'b', 1, '2023-03-27 03:06:14', '2023-03-27 03:06:19'),
	(10, 'E3bkufzl', '05oO-O5w-37G', '10', 'b', 1, '2023-03-27 03:06:32', '2023-03-27 03:06:32'),
	(11, 'qBjQbf8z', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 03:25:37', '2023-03-27 03:25:37'),
	(12, 'qBjQbf8z', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 03:25:41', '2023-03-27 03:25:41'),
	(13, 'qBjQbf8z', '05oO-O5w-37G', '3', 'a', 1, '2023-03-27 03:25:44', '2023-03-27 03:25:45'),
	(14, 'qBjQbf8z', '05oO-O5w-37G', '4', 'b', 1, '2023-03-27 03:25:54', '2023-03-27 03:25:54'),
	(15, 'qBjQbf8z', '05oO-O5w-37G', '5', 'c', 1, '2023-03-27 03:25:57', '2023-03-27 03:25:57'),
	(16, 'qBjQbf8z', '05oO-O5w-37G', '6', 'd', 1, '2023-03-27 03:26:00', '2023-03-27 03:26:00'),
	(17, 'qBjQbf8z', '05oO-O5w-37G', '7', 'c', 1, '2023-03-27 03:26:03', '2023-03-27 03:26:03'),
	(18, 'qBjQbf8z', '05oO-O5w-37G', '8', 'd', 1, '2023-03-27 03:26:07', '2023-03-27 03:26:07'),
	(19, 'qBjQbf8z', '05oO-O5w-37G', '9', 'd', 0, '2023-03-27 03:26:31', '2023-03-27 03:26:31'),
	(20, 'qBjQbf8z', '05oO-O5w-37G', '10', 'b', 1, '2023-03-27 03:26:34', '2023-03-27 03:27:19'),
	(21, 'OG5SsoJ0', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 12:22:54', '2023-03-27 12:22:54'),
	(22, 'OG5SsoJ0', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 12:23:10', '2023-03-27 12:23:10'),
	(23, 'OG5SsoJ0', '05oO-O5w-37G', '3', 'a', 1, '2023-03-27 12:23:43', '2023-03-27 12:23:43'),
	(24, 'OG5SsoJ0', '05oO-O5w-37G', '4', 'b', 1, '2023-03-27 12:23:49', '2023-03-27 12:23:49'),
	(25, 'OG5SsoJ0', '05oO-O5w-37G', '5', 'c', 1, '2023-03-27 12:23:52', '2023-03-27 12:23:52'),
	(26, 'OG5SsoJ0', '05oO-O5w-37G', '6', 'd', 1, '2023-03-27 12:24:11', '2023-03-27 12:24:11'),
	(27, 'OG5SsoJ0', '05oO-O5w-37G', '7', 'c', 1, '2023-03-27 12:24:14', '2023-03-27 12:24:14'),
	(28, 'OG5SsoJ0', '05oO-O5w-37G', '8', 'd', 1, '2023-03-27 12:24:17', '2023-03-27 12:24:17'),
	(29, 'OG5SsoJ0', '05oO-O5w-37G', '9', 'b', 1, '2023-03-27 12:24:27', '2023-03-27 12:24:27'),
	(30, 'DjfQhHCH', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 12:27:26', '2023-03-27 12:29:26'),
	(31, 'RxA7DsUE', '05oO-O5w-37G', '1', 'a', 0, '2023-03-27 12:30:39', '2023-03-27 12:31:39'),
	(32, 'dXGo8Z1j', '05oO-O5w-37G', '1', 'd', 0, '2023-03-27 12:33:11', '2023-03-27 12:35:07'),
	(33, '80drrwV9', '05oO-O5w-37G', '1', 'b', 0, '2023-03-27 12:35:34', '2023-03-27 12:35:51'),
	(34, 'jdqA9Gdk', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 12:38:58', '2023-03-27 12:39:13'),
	(35, 'jdqA9Gdk', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 12:39:29', '2023-03-27 12:39:29'),
	(36, 'jdqA9Gdk', '05oO-O5w-37G', '3', 'a', 1, '2023-03-27 12:39:33', '2023-03-27 12:39:33'),
	(37, 'jdqA9Gdk', '05oO-O5w-37G', '4', 'b', 1, '2023-03-27 12:40:29', '2023-03-27 12:40:30'),
	(38, 'jdqA9Gdk', '05oO-O5w-37G', '5', 'a', 0, '2023-03-27 12:40:38', '2023-03-27 12:40:38'),
	(39, 'nyLxB6EV', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 12:47:23', '2023-03-27 12:47:23'),
	(40, 'nyLxB6EV', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 12:47:27', '2023-03-27 12:47:27'),
	(41, 'nyLxB6EV', '05oO-O5w-37G', '3', 'a', 1, '2023-03-27 12:47:31', '2023-03-27 12:47:31'),
	(42, 'nyLxB6EV', '05oO-O5w-37G', '4', 'b', 1, '2023-03-27 12:47:33', '2023-03-27 12:47:33'),
	(43, 'nyLxB6EV', '05oO-O5w-37G', '5', 'c', 1, '2023-03-27 12:47:38', '2023-03-27 12:47:38'),
	(44, 'nyLxB6EV', '05oO-O5w-37G', '6', 'd', 1, '2023-03-27 12:47:40', '2023-03-27 12:47:41'),
	(45, 'nyLxB6EV', '05oO-O5w-37G', '7', 'c', 1, '2023-03-27 12:47:51', '2023-03-27 12:47:51'),
	(46, 'nyLxB6EV', '05oO-O5w-37G', '8', 'd', 1, '2023-03-27 12:47:54', '2023-03-27 12:47:54'),
	(47, 'nyLxB6EV', '05oO-O5w-37G', '9', 'b', 1, '2023-03-27 12:47:58', '2023-03-27 12:47:58'),
	(48, 'nyLxB6EV', '05oO-O5w-37G', '10', 'b', 1, '2023-03-27 12:48:06', '2023-03-27 12:48:06'),
	(49, 'tJFc5eMu', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 12:48:34', '2023-03-27 12:48:36'),
	(50, 'tJFc5eMu', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 12:48:38', '2023-03-27 12:48:38'),
	(51, 'tJFc5eMu', '05oO-O5w-37G', '3', 'a', 1, '2023-03-27 12:48:44', '2023-03-27 12:48:44'),
	(52, 'tJFc5eMu', '05oO-O5w-37G', '4', 'b', 1, '2023-03-27 12:48:49', '2023-03-27 12:48:49'),
	(53, 'tJFc5eMu', '05oO-O5w-37G', '5', 'c', 1, '2023-03-27 12:50:10', '2023-03-27 12:50:10'),
	(54, 'tJFc5eMu', '05oO-O5w-37G', '6', 'd', 1, '2023-03-27 12:50:15', '2023-03-27 12:50:15'),
	(55, 'tJFc5eMu', '05oO-O5w-37G', '7', 'c', 1, '2023-03-27 12:50:19', '2023-03-27 12:50:19'),
	(56, 'BxKasf2z', 'jyyJ-gZK-OXG', '15', 'c', 1, '2023-03-27 12:58:58', '2023-03-27 12:58:58'),
	(57, 'BxKasf2z', 'jyyJ-gZK-OXG', '17', '-6', 1, '2023-03-27 12:59:14', '2023-03-27 12:59:14'),
	(58, 'pRHHiol6', 'jyyJ-gZK-OXG', '15', 'c', 1, '2023-03-27 13:01:06', '2023-03-27 13:01:06'),
	(59, 'pRHHiol6', 'jyyJ-gZK-OXG', '17', '-6', 1, '2023-03-27 13:01:19', '2023-03-27 13:01:19'),
	(60, 'POjitV18', 'jyyJ-gZK-OXG', '15', 'c', 1, '2023-03-27 13:03:20', '2023-03-27 13:03:20'),
	(61, 'POjitV18', 'jyyJ-gZK-OXG', '17', 'wa', 0, '2023-03-27 13:03:24', '2023-03-27 13:03:24'),
	(62, 'POjitV18', 'jyyJ-gZK-OXG', '18', 'c', 0, '2023-03-27 13:03:32', '2023-03-27 13:03:32'),
	(63, 'POjitV18', 'jyyJ-gZK-OXG', '19', '20', 1, '2023-03-27 13:03:37', '2023-03-27 13:03:37'),
	(64, 'l92vPfUd', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 13:12:43', '2023-03-27 13:12:43'),
	(65, 'l92vPfUd', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 13:12:46', '2023-03-27 13:12:46'),
	(66, 'l92vPfUd', '05oO-O5w-37G', '3', 'a', 1, '2023-03-27 13:12:50', '2023-03-27 13:12:50'),
	(67, 'l92vPfUd', '05oO-O5w-37G', '4', 'b', 1, '2023-03-27 13:12:52', '2023-03-27 13:12:52'),
	(68, 'l92vPfUd', '05oO-O5w-37G', '5', 'c', 1, '2023-03-27 13:13:01', '2023-03-27 13:13:01'),
	(69, 'l92vPfUd', '05oO-O5w-37G', '6', 'd', 1, '2023-03-27 13:13:03', '2023-03-27 13:13:08'),
	(70, 'l92vPfUd', '05oO-O5w-37G', '7', 'c', 1, '2023-03-27 13:13:17', '2023-03-27 13:13:17'),
	(71, 'l92vPfUd', '05oO-O5w-37G', '8', 'd', 1, '2023-03-27 13:13:20', '2023-03-27 13:13:20'),
	(72, 'l92vPfUd', '05oO-O5w-37G', '9', 'b', 1, '2023-03-27 13:13:22', '2023-03-27 13:13:22'),
	(73, 'l92vPfUd', '05oO-O5w-37G', '10', 'b', 1, '2023-03-27 13:13:26', '2023-03-27 13:13:26'),
	(74, 'IjkW9ANQ', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 13:16:08', '2023-03-27 13:16:28'),
	(75, 'IjkW9ANQ', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 13:16:14', '2023-03-27 13:16:14'),
	(76, 'PhiSFRAG', 'jyyJ-gZK-OXG', '15', 'a', 0, '2023-03-27 13:16:57', '2023-03-27 13:16:57'),
	(77, 'PhiSFRAG', 'jyyJ-gZK-OXG', '17', '-6', 1, '2023-03-27 13:17:14', '2023-03-27 13:17:14'),
	(78, 'K30e0Xk7', '05oO-O5w-37G', '1', 'c', 1, '2023-03-27 13:18:41', '2023-03-27 13:18:41'),
	(79, 'K30e0Xk7', '05oO-O5w-37G', '2', 'a', 1, '2023-03-27 13:18:51', '2023-03-27 13:18:51'),
	(80, 'K30e0Xk7', '05oO-O5w-37G', '4', 'a', 0, '2023-03-27 13:18:59', '2023-03-27 13:19:04'),
	(81, 'K30e0Xk7', '05oO-O5w-37G', '5', 'b', 0, '2023-03-27 13:19:07', '2023-03-27 13:19:07'),
	(82, 'K30e0Xk7', '05oO-O5w-37G', '6', 'd', 1, '2023-03-27 13:19:08', '2023-03-27 13:19:09'),
	(83, 'K30e0Xk7', '05oO-O5w-37G', '7', 'd', 0, '2023-03-27 13:19:11', '2023-03-27 13:19:11'),
	(84, 'K30e0Xk7', '05oO-O5w-37G', '20', 'b', 0, '2023-03-27 13:19:17', '2023-03-27 13:19:17'),
	(85, 'K30e0Xk7', '05oO-O5w-37G', '10', 'd', 0, '2023-03-27 13:19:19', '2023-03-27 13:19:19'),
	(86, 'K30e0Xk7', '05oO-O5w-37G', '9', 'a', 0, '2023-03-27 13:19:20', '2023-03-27 13:19:20'),
	(87, 'K30e0Xk7', '05oO-O5w-37G', '8', 'd', 1, '2023-03-27 13:19:21', '2023-03-27 13:19:21'),
	(88, 'K30e0Xk7', '05oO-O5w-37G', '3', 'd', 0, '2023-03-27 13:19:31', '2023-03-27 13:19:31'),
	(89, 'my9dP2e5', 'jyyJ-gZK-OXG', '15', 'c', 1, '2023-03-27 13:21:06', '2023-03-27 13:21:06'),
	(90, 'my9dP2e5', 'jyyJ-gZK-OXG', '17', '-6', 1, '2023-03-27 13:21:18', '2023-03-27 13:21:18'),
	(91, 'my9dP2e5', 'jyyJ-gZK-OXG', '18', 'd', 0, '2023-03-27 13:21:32', '2023-03-27 13:21:32'),
	(92, 'rZ80vL8p', '05oO-O5w-37G', '1', 'c', 1, '2023-03-28 02:35:58', '2023-03-28 02:35:58'),
	(93, 'rZ80vL8p', '05oO-O5w-37G', '2', 'a', 1, '2023-03-28 02:36:09', '2023-03-28 02:36:09'),
	(94, 'RjfYy24F', 'yhnN-N5e-eS9', '66', 'c', 1, '2023-03-31 02:39:11', '2023-03-31 02:39:11'),
	(95, 'RjfYy24F', 'yhnN-N5e-eS9', '68', '-6', 1, '2023-03-31 02:39:19', '2023-03-31 02:39:19'),
	(96, 'RjfYy24F', 'yhnN-N5e-eS9', '69', 'e', 1, '2023-03-31 02:39:29', '2023-03-31 02:39:29'),
	(97, 'h3BpVHSK', '2HfH-rOG-y4a', '70', 'c', 1, '2023-03-31 02:42:45', '2023-03-31 02:42:45'),
	(98, 'h3BpVHSK', '2HfH-rOG-y4a', '71', 'a', 1, '2023-03-31 02:42:50', '2023-03-31 02:42:50'),
	(99, 'h3BpVHSK', '2HfH-rOG-y4a', '72', 'a', 1, '2023-03-31 02:43:01', '2023-03-31 02:43:01'),
	(100, 'h3BpVHSK', '2HfH-rOG-y4a', '73', 'b', 1, '2023-03-31 02:43:04', '2023-03-31 02:43:04'),
	(101, 'h3BpVHSK', '2HfH-rOG-y4a', '74', 'c', 1, '2023-03-31 02:43:08', '2023-03-31 02:43:08'),
	(102, 'h3BpVHSK', '2HfH-rOG-y4a', '75', 'd', 1, '2023-03-31 02:43:12', '2023-03-31 02:43:12'),
	(103, 'h3BpVHSK', '2HfH-rOG-y4a', '76', 'c', 1, '2023-03-31 02:43:15', '2023-03-31 02:43:15'),
	(104, 'h3BpVHSK', '2HfH-rOG-y4a', '77', 'd', 1, '2023-03-31 02:43:21', '2023-03-31 02:43:21'),
	(105, 'h3BpVHSK', '2HfH-rOG-y4a', '78', 'b', 1, '2023-03-31 02:43:24', '2023-03-31 02:43:24'),
	(106, 'h3BpVHSK', '2HfH-rOG-y4a', '79', 'b', 1, '2023-03-31 02:43:27', '2023-03-31 02:43:27'),
	(107, 'h3BpVHSK', '2HfH-rOG-y4a', '80', 'c', 1, '2023-03-31 02:43:30', '2023-03-31 02:43:30'),
	(110, 'UQ1zBAKs', '2HfH-rOG-y4a', '70', 'b', 0, '2023-03-31 02:50:33', '2023-03-31 02:50:33'),
	(122, 'DrRw98la', 'jyyJ-gZK-OXG', '15', 'a', 0, '2023-03-31 08:15:06', '2023-03-31 08:15:06'),
	(123, 'DrRw98la', 'jyyJ-gZK-OXG', '17', '1', 0, '2023-03-31 08:15:11', '2023-03-31 08:15:11'),
	(124, 'DrRw98la', 'jyyJ-gZK-OXG', '18', 'b', 0, '2023-03-31 08:15:17', '2023-03-31 08:15:17'),
	(125, '7rAp0GXt', '05oO-O5w-37G', '1', 'c', 1, '2023-03-31 08:30:41', '2023-03-31 08:30:41'),
	(126, '7rAp0GXt', '05oO-O5w-37G', '2', 'a', 1, '2023-03-31 08:30:43', '2023-03-31 08:30:43'),
	(127, '7rAp0GXt', '05oO-O5w-37G', '3', 'a', 1, '2023-03-31 08:30:47', '2023-03-31 08:30:47'),
	(128, '7rAp0GXt', '05oO-O5w-37G', '4', 'b', 1, '2023-03-31 08:30:49', '2023-03-31 08:30:49'),
	(129, '7rAp0GXt', '05oO-O5w-37G', '5', 'c', 1, '2023-03-31 08:30:53', '2023-03-31 08:30:53'),
	(130, '7rAp0GXt', '05oO-O5w-37G', '6', 'd', 1, '2023-03-31 08:30:55', '2023-03-31 08:30:55'),
	(131, '7rAp0GXt', '05oO-O5w-37G', '7', 'c', 1, '2023-03-31 08:30:58', '2023-03-31 08:30:58'),
	(132, '7rAp0GXt', '05oO-O5w-37G', '8', 'd', 1, '2023-03-31 08:31:03', '2023-03-31 08:31:03'),
	(133, '7rAp0GXt', '05oO-O5w-37G', '9', 'b', 1, '2023-03-31 08:31:08', '2023-03-31 08:31:08'),
	(134, '7rAp0GXt', '05oO-O5w-37G', '10', 'b', 1, '2023-03-31 08:31:12', '2023-03-31 08:31:12'),
	(135, '7rAp0GXt', '05oO-O5w-37G', '20', 'c', 1, '2023-03-31 08:31:14', '2023-03-31 08:31:14'),
	(136, 'RwUo6LNm', 'jyyJ-gZK-OXG', '15', 'c', 1, '2023-03-31 08:43:04', '2023-03-31 08:43:04'),
	(137, 'RwUo6LNm', 'jyyJ-gZK-OXG', '17', '6', 0, '2023-03-31 08:43:17', '2023-03-31 08:43:17'),
	(138, 'RwUo6LNm', 'jyyJ-gZK-OXG', '18', 'c', 0, '2023-03-31 08:43:23', '2023-03-31 08:43:23'),
	(139, 'MChKE0DS', '05oO-O5w-37G', '1', 'b', 0, '2023-03-31 08:49:47', '2023-03-31 08:49:47'),
	(140, 'MChKE0DS', '05oO-O5w-37G', '2', 'c', 0, '2023-03-31 08:49:48', '2023-03-31 08:49:48'),
	(141, 'MChKE0DS', '05oO-O5w-37G', '3', 'c', 0, '2023-03-31 08:49:49', '2023-03-31 08:49:49'),
	(142, 'MChKE0DS', '05oO-O5w-37G', '4', 'c', 0, '2023-03-31 08:49:50', '2023-03-31 08:49:50'),
	(143, 'MChKE0DS', '05oO-O5w-37G', '6', 'c', 0, '2023-03-31 08:49:56', '2023-03-31 08:49:56'),
	(144, 'MChKE0DS', '05oO-O5w-37G', '7', 'c', 1, '2023-03-31 08:49:58', '2023-03-31 08:49:58'),
	(145, 'MChKE0DS', '05oO-O5w-37G', '8', 'c', 0, '2023-03-31 08:49:59', '2023-03-31 08:49:59'),
	(146, 'MChKE0DS', '05oO-O5w-37G', '9', 'a', 0, '2023-03-31 08:50:00', '2023-03-31 08:50:00'),
	(147, 'MChKE0DS', '05oO-O5w-37G', '10', 'c', 0, '2023-03-31 08:50:01', '2023-03-31 08:50:01'),
	(148, 'MChKE0DS', '05oO-O5w-37G', '20', 'd', 0, '2023-03-31 08:50:03', '2023-03-31 08:50:03'),
	(149, 'MChKE0DS', '05oO-O5w-37G', '5', 'c', 1, '2023-03-31 08:50:09', '2023-03-31 08:50:09'),
	(150, 'D5AVgpoQ', 'jyyJ-gZK-OXG', '15', 'c', 1, '2023-03-31 08:58:32', '2023-03-31 08:58:32'),
	(151, 'D5AVgpoQ', 'jyyJ-gZK-OXG', '17', '6', 0, '2023-03-31 08:58:40', '2023-03-31 08:58:40'),
	(152, 'D5AVgpoQ', 'jyyJ-gZK-OXG', '18', 'c', 0, '2023-03-31 08:58:44', '2023-03-31 08:58:44'),
	(153, 'VNYArLzN', 'jyyJ-gZK-OXG', '15', 'c', 1, '2023-04-01 12:07:39', '2023-04-01 12:07:39'),
	(154, 'VNYArLzN', 'jyyJ-gZK-OXG', '17', '-6', 1, '2023-04-01 12:07:45', '2023-04-01 12:07:45'),
	(155, 'VNYArLzN', 'jyyJ-gZK-OXG', '18', 'e', 1, '2023-04-01 12:07:50', '2023-04-01 12:07:50'),
	(156, 'RA5BLREK', '05oO-O5w-37G', '1', 'c', 1, '2023-04-01 12:08:33', '2023-04-01 12:08:33'),
	(157, 'RA5BLREK', '05oO-O5w-37G', '2', 'a', 1, '2023-04-01 12:08:36', '2023-04-01 12:08:36'),
	(158, 'RA5BLREK', '05oO-O5w-37G', '3', 'a', 1, '2023-04-01 12:08:43', '2023-04-01 12:08:43'),
	(159, 'RA5BLREK', '05oO-O5w-37G', '4', 'b', 1, '2023-04-01 12:08:45', '2023-04-01 12:08:45'),
	(160, 'RA5BLREK', '05oO-O5w-37G', '5', 'c', 1, '2023-04-01 12:08:49', '2023-04-01 12:08:49'),
	(161, 'RA5BLREK', '05oO-O5w-37G', '6', 'd', 1, '2023-04-01 12:08:52', '2023-04-01 12:08:52'),
	(162, 'RA5BLREK', '05oO-O5w-37G', '7', 'c', 1, '2023-04-01 12:08:55', '2023-04-01 12:08:55'),
	(163, 'RA5BLREK', '05oO-O5w-37G', '8', 'd', 1, '2023-04-01 12:08:58', '2023-04-01 12:08:58'),
	(164, 'RA5BLREK', '05oO-O5w-37G', '9', 'b', 1, '2023-04-01 12:09:02', '2023-04-01 12:09:02'),
	(165, 'RA5BLREK', '05oO-O5w-37G', '10', 'b', 1, '2023-04-01 12:09:08', '2023-04-01 12:09:08'),
	(166, 'RA5BLREK', '05oO-O5w-37G', '20', 'c', 1, '2023-04-01 12:09:10', '2023-04-01 12:09:10');

-- Dumping structure for table smafy.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2022_10_28_092812_make_soal_table', 1),
	(7, '2022_10_31_223712_make_siswa_table', 1),
	(8, '2022_10_31_230820_make_jawaban_table', 1),
	(9, '2022_11_10_133406_create_package_table', 1),
	(10, '2023_04_01_193416_make_reports_table', 2);

-- Dumping structure for table smafy.package
CREATE TABLE IF NOT EXISTS `package` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_correction_lesson` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_correction_quiz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` int NOT NULL,
  `show_result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_public` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_responses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_duplicated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.package: ~3 rows (approximately)
INSERT INTO `package` (`id`, `slug`, `user_id`, `title`, `description`, `topic_type`, `show_correction_lesson`, `show_correction_quiz`, `timer`, `show_result`, `show_public`, `accept_responses`, `is_duplicated`, `created_at`, `updated_at`) VALUES
	(1, '05oO-O5w-37G', '1', 'Bilangan Bulat', 'Kuis Bilangan Bulat', 'kuis', '1', '1', 120, '1', '1', '1', 0, '2023-03-27 02:48:03', '2023-04-01 12:10:27'),
	(2, 'jyyJ-gZK-OXG', '1', 'Bilangan Bulat', 'Apa itu Bilangan Bulat', 'materi', '1', '1', 0, '1', '1', '1', 0, '2023-03-27 12:51:52', '2023-03-28 03:01:31'),
	(8, 'yhnN-N5e-eS9', '2', 'Bilangan Bulat', 'Apa itu Bilangan Bulat', 'materi', '1', '1', 0, '1', '0', '1', 1, '2023-03-31 02:27:43', '2023-03-31 02:27:43'),
	(9, '2HfH-rOG-y4a', '2', 'Bilangan Bulat', 'Kuis Bilangan Bulat', 'kuis', '1', '1', 0, '1', '0', '1', 1, '2023-03-31 02:42:25', '2023-04-01 05:25:42');

-- Dumping structure for table smafy.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.password_resets: ~0 rows (approximately)

-- Dumping structure for table smafy.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table smafy.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table smafy.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reasons` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.questions: ~36 rows (approximately)
INSERT INTO `questions` (`id`, `user_id`, `package_slug`, `type`, `order_id`, `title`, `content`, `image_path`, `youtube_link`, `a`, `b`, `c`, `d`, `e`, `correct_answer`, `reasons`, `created_at`, `updated_at`) VALUES
	(1, '1', '05oO-O5w-37G', 'pilihan_ganda', 1, '1', '<p>$$10 - (-10)=…$$</p>', NULL, NULL, '-10', '-20', '20', '10', NULL, 'c', '20', '2023-03-27 02:48:55', '2023-03-27 02:51:58'),
	(2, '1', '05oO-O5w-37G', 'pilihan_ganda', 2, '2', '<p>$$ x + 10 = 15$$<br>Berapa x?</p>', NULL, NULL, '5', '10', '-5', '-10', NULL, 'a', '5', '2023-03-27 02:52:36', '2023-03-27 02:52:36'),
	(3, '1', '05oO-O5w-37G', 'pilihan_ganda', 3, '3', '<p>$$-10 \\times (-2-4)=...$$</p>', NULL, NULL, '60', '-60', '16', '-15', NULL, 'a', '60', '2023-03-27 02:53:42', '2023-03-27 02:53:42'),
	(4, '1', '05oO-O5w-37G', 'pilihan_ganda', 4, '4', '<p>$$\\frac{25}{-5}=...$$</p>', NULL, NULL, '5', '-5', '10', '-10', NULL, 'b', '-5', '2023-03-27 02:57:59', '2023-03-27 02:57:59'),
	(5, '1', '05oO-O5w-37G', 'pilihan_ganda', 5, '5', '<p>berapa angka yang hilang?</p>', 'storage/user/img/TPcDgrDoDMiCQKhbo6bOT2WRuvtTxwdQ9a3a7BQ2.png', NULL, '6', '-6', '9', '-9', NULL, 'c', '9', '2023-03-27 02:58:36', '2023-03-27 02:58:36'),
	(6, '1', '05oO-O5w-37G', 'pilihan_ganda', 6, '6', '<p>$$10 &nbsp;\\times (-30) =...$$</p>', NULL, NULL, '600', '-600', '300', '-300', NULL, 'd', '-300', '2023-03-27 02:59:23', '2023-03-27 02:59:51'),
	(7, '1', '05oO-O5w-37G', 'pilihan_ganda', 7, '7', '<p>$$-15 + 10 = …$$</p>', NULL, NULL, '25', '-25', '-5', '5', NULL, 'c', '-5', '2023-03-27 03:00:50', '2023-03-27 03:00:50'),
	(8, '1', '05oO-O5w-37G', 'pilihan_ganda', 8, '8', '<p>$$300 + x = 5$$</p><p>berapa nilai x ?</p>', NULL, NULL, '5', '-5', '295', '-295', NULL, 'd', '-295', '2023-03-27 03:01:39', '2023-03-27 03:30:17'),
	(9, '1', '05oO-O5w-37G', 'pilihan_ganda', 9, '9', '<p>berapa nilai angka yang hilang?</p>', 'storage/user/img/v9g3vSvdJkK8RjrvlzTHlfTx7MpoDzXkRlYIXHuu.png', NULL, '7', '-7', '6', '-9', NULL, 'b', '-7', '2023-03-27 03:03:17', '2023-03-27 03:03:17'),
	(10, '1', '05oO-O5w-37G', 'pilihan_ganda', 10, '10', '<p>$$5(2 - 5)=…$$</p>', NULL, NULL, '15', '-15', '20', '-20', NULL, 'b', '-15', '2023-03-27 03:04:06', '2023-03-27 03:04:06'),
	(12, '1', 'jyyJ-gZK-OXG', 'materi', 1, 'Pendahuluan', '<p>Bilangan Bulat adalah seluruh bilangan dan kebalikannya</p>', 'storage/user/img/wD4sm9bvZ0jyNARRksR3l6iiQblruVcH4oKNwD6Q.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-27 12:54:13', '2023-03-27 12:54:13'),
	(13, '1', 'jyyJ-gZK-OXG', 'materi', 2, 'Pengertian', '<p>.</p>', 'storage/user/img/P6Z884csy5sV6WzSl0bzID68xVQ90qcoCPSXvox7.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-27 12:54:51', '2023-03-27 12:54:51'),
	(14, '1', 'jyyJ-gZK-OXG', 'materi', 3, 'Kebalikan atau berlawanan', '<p>-</p>', 'storage/user/img/DPPoZjuVJmqARCv2KOKQ9yAWQr8G13MnAjvvEtLH.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-27 12:55:20', '2023-03-27 12:55:20'),
	(15, '1', 'jyyJ-gZK-OXG', 'pilihan_ganda', 4, 'Latihan 1', '<p>Apa kebalikan dari -7?</p>', NULL, NULL, '6', '-6', '7', '-7', NULL, 'c', 'Kebalikan dari -7 adalah 7', '2023-03-27 12:56:12', '2023-03-27 12:56:12'),
	(16, '1', 'jyyJ-gZK-OXG', 'materi', 5, 'Garis bilangan', '<p>Perhatiknan gambar diatas</p>', 'storage/user/img/IsCI2d4MbdRPVEcZbNLW92tS7a7HKRnRVgY4qv4J.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-27 12:57:06', '2023-03-27 12:57:06'),
	(17, '1', 'jyyJ-gZK-OXG', 'isian', 6, 'Latihan 2', '<p>angka yang paling kecil dari himpunan di bawah ini adalah …<br><br>$$ -6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6$$</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-6', '-6 adah yang terkecil', '2023-03-27 12:58:20', '2023-03-27 12:58:20'),
	(18, '1', 'jyyJ-gZK-OXG', 'pilihan_ganda', 7, 'Latihan 3', '<p>Nilai terbesar dari angka berikut adalah</p><p>$$ -6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6$$</p>', NULL, NULL, '-6', '-5', '4', '5', '6', 'e', 'Terbesar adalah 6', '2023-03-27 13:02:24', '2023-03-27 13:02:24'),
	(20, '1', '05oO-O5w-37G', 'pilihan_ganda', 11, '11', '<p>$$ 100 + 200 = …$$</p>', NULL, NULL, '100', '200', '300', '400', '500', 'c', '300', '2023-03-27 13:18:30', '2023-03-27 13:18:30'),
	(63, '2', 'yhnN-N5e-eS9', 'materi', 1, 'Pendahuluan', '<p>Bilangan Bulat adalah seluruh bilangan dan kebalikannya</p>', 'storage/user/img/ZCuhg2rIartB5OZG.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-31 02:27:42', '2023-03-31 02:27:42'),
	(64, '2', 'yhnN-N5e-eS9', 'materi', 2, 'Pengertian', '<p>.</p>', 'storage/user/img/j3mF9mjXduPDuLfg.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-31 02:27:43', '2023-03-31 02:27:43'),
	(65, '2', 'yhnN-N5e-eS9', 'materi', 3, 'Kebalikan atau berlawanan', '<p>-</p>', 'storage/user/img/CMogZvudhtK2HpfS.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-31 02:27:43', '2023-03-31 02:27:43'),
	(66, '2', 'yhnN-N5e-eS9', 'pilihan_ganda', 4, 'Latihan 1', '<p>Apa kebalikan dari -7?</p>', NULL, NULL, '6', '-6', '7', '-7', NULL, 'c', 'Kebalikan dari -7 adalah 7', '2023-03-31 02:27:43', '2023-03-31 02:27:43'),
	(67, '2', 'yhnN-N5e-eS9', 'materi', 5, 'Garis bilangan', '<p>Perhatiknan gambar diatas</p>', 'storage/user/img/QczMXxhoJzwWD3ll.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-31 02:27:43', '2023-03-31 02:27:43'),
	(68, '2', 'yhnN-N5e-eS9', 'isian', 6, 'Latihan 2', '<p>angka yang paling kecil dari himpunan di bawah ini adalah …<br><br>$$ -6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6$$</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-6', '-6 adah yang terkecil', '2023-03-31 02:27:43', '2023-03-31 02:27:43'),
	(69, '2', 'yhnN-N5e-eS9', 'pilihan_ganda', 7, 'Latihan 3', '<p>Nilai terbesar dari angka berikut adalah</p><p>$$ -6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6$$</p>', NULL, NULL, '-6', '-5', '4', '5', '6', 'e', 'Terbesar adalah 6', '2023-03-31 02:27:43', '2023-03-31 02:27:43'),
	(70, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 1, '1', '<p>$$10 - (-10)=…$$</p>', NULL, NULL, '-10', '-20', '20', '10', NULL, 'c', '20', '2023-03-31 02:42:24', '2023-03-31 02:42:24'),
	(71, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 2, '2', '<p>$$ x + 10 = 15$$<br>Berapa x?</p>', NULL, NULL, '5', '10', '-5', '-10', NULL, 'a', '5', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(72, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 3, '3', '<p>$$-10 \\times (-2-4)=...$$</p>', NULL, NULL, '60', '-60', '16', '-15', NULL, 'a', '60', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(73, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 4, '4', '<p>$$\\frac{25}{-5}=...$$</p>', NULL, NULL, '5', '-5', '10', '-10', NULL, 'b', '-5', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(74, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 5, '5', '<p>berapa angka yang hilang?</p>', 'storage/user/img/6oNE2AFnnJvlxA0A.png', NULL, '6', '-6', '9', '-9', NULL, 'c', '9', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(75, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 6, '6', '<p>$$10 &nbsp;\\times (-30) =...$$</p>', NULL, NULL, '600', '-600', '300', '-300', NULL, 'd', '-300', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(76, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 7, '7', '<p>$$-15 + 10 = …$$</p>', NULL, NULL, '25', '-25', '-5', '5', NULL, 'c', '-5', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(77, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 8, '8', '<p>$$300 + x = 5$$</p><p>berapa nilai x ?</p>', NULL, NULL, '5', '-5', '295', '-295', NULL, 'd', '-295', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(78, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 9, '9', '<p>berapa nilai angka yang hilang?</p>', 'storage/user/img/csI29g5zg9MyQ1ZO.png', NULL, '7', '-7', '6', '-9', NULL, 'b', '-7', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(79, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 10, '10', '<p>$$5(2 - 5)=…$$</p>', NULL, NULL, '15', '-15', '20', '-20', NULL, 'b', '-15', '2023-03-31 02:42:25', '2023-03-31 02:42:25'),
	(80, '2', '2HfH-rOG-y4a', 'pilihan_ganda', 11, '11', '<p>$$ 100 + 200 = …$$</p>', NULL, NULL, '100', '200', '300', '400', '500', 'c', '300', '2023-03-31 02:42:25', '2023-03-31 02:42:25');

-- Dumping structure for table smafy.reports
CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reporter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.reports: ~0 rows (approximately)

-- Dumping structure for table smafy.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `u_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_left` int NOT NULL DEFAULT '0',
  `package_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_u_id_unique` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.siswa: ~29 rows (approximately)
INSERT INTO `siswa` (`id`, `u_id`, `name`, `kelas`, `score`, `time_left`, `package_id`, `created_at`, `updated_at`) VALUES
	(1, 'E3bkufzl', 'Tester', '1', '100', 25, '05oO-O5w-37G', '2023-03-27 03:05:00', '2023-03-27 03:06:35'),
	(2, 'qBjQbf8z', 'Fkry', '4', '90', 0, '05oO-O5w-37G', '2023-03-27 03:25:19', '2023-03-27 03:27:38'),
	(3, 'OG5SsoJ0', 'Fkry', '1', '90', 0, '05oO-O5w-37G', '2023-03-27 12:22:28', '2023-03-27 12:24:35'),
	(4, 'DjfQhHCH', 'Fkry', '1', '10', 0, '05oO-O5w-37G', '2023-03-27 12:27:21', '2023-03-27 12:29:28'),
	(5, 'RxA7DsUE', 'Fkry', '1', '0', 0, '05oO-O5w-37G', '2023-03-27 12:30:34', '2023-03-27 12:30:34'),
	(6, 'dXGo8Z1j', 'Fkry', '1', '0', 0, '05oO-O5w-37G', '2023-03-27 12:33:05', '2023-03-27 12:33:05'),
	(7, '80drrwV9', 'Fkry', '1', '0', 0, '05oO-O5w-37G', '2023-03-27 12:35:31', '2023-03-27 12:35:31'),
	(8, 'jdqA9Gdk', 'Fkry', '1', '40', 0, '05oO-O5w-37G', '2023-03-27 12:38:38', '2023-03-27 12:40:30'),
	(9, 'nyLxB6EV', 'Fkry', '1', '100', 68, '05oO-O5w-37G', '2023-03-27 12:47:19', '2023-03-27 12:48:11'),
	(10, 'tJFc5eMu', 'Fkry', '1', '70', 0, '05oO-O5w-37G', '2023-03-27 12:48:30', '2023-03-27 12:50:19'),
	(11, 'BxKasf2z', 'Fkry', '1', '0', 0, 'jyyJ-gZK-OXG', '2023-03-27 12:58:39', '2023-03-27 12:58:39'),
	(12, 'pRHHiol6', 'Fkry', '1', '100', 0, 'jyyJ-gZK-OXG', '2023-03-27 13:00:57', '2023-03-27 13:01:19'),
	(13, 'POjitV18', 'Fkry', '1', '50', 0, 'jyyJ-gZK-OXG', '2023-03-27 13:03:10', '2023-03-27 13:03:37'),
	(14, 'l92vPfUd', 'Fkry', '1', '100', 11, '05oO-O5w-37G', '2023-03-27 13:12:38', '2023-03-27 13:14:27'),
	(15, 'IjkW9ANQ', 'Fkry', '1', '20', 0, '05oO-O5w-37G', '2023-03-27 13:15:59', '2023-03-27 13:16:28'),
	(16, 'PhiSFRAG', 'Fkry', '1', '25', 0, 'jyyJ-gZK-OXG', '2023-03-27 13:16:46', '2023-03-27 13:17:14'),
	(17, 'K30e0Xk7', 'Fkry', '1', '36.36', 63, '05oO-O5w-37G', '2023-03-27 13:18:38', '2023-03-27 13:19:35'),
	(18, 'my9dP2e5', 'Fkry', '1', '66.67', 0, 'jyyJ-gZK-OXG', '2023-03-27 13:21:00', '2023-03-27 13:21:19'),
	(19, 'rZ80vL8p', 'fkkk', '1', '18.18', 0, '05oO-O5w-37G', '2023-03-28 02:35:47', '2023-03-28 02:36:09'),
	(20, 'Moe9TmyH', 'Fkry', '1', '0', 0, 'jyyJ-gZK-OXG', '2023-03-28 03:01:42', '2023-03-28 03:01:42'),
	(21, 'KmZtWYjp', 'Fkry', '1', '0', 0, '05oO-O5w-37G', '2023-03-28 03:07:52', '2023-03-28 03:07:52'),
	(22, 'yTj0dPGv', 'Ahmad', '1', '0', 0, '05oO-O5w-37G', '2023-03-28 03:09:31', '2023-03-28 03:09:31'),
	(23, 'jJ7jlBEa', 'Ahmad', '1', '0', 0, 'jyyJ-gZK-OXG', '2023-03-28 03:11:25', '2023-03-28 03:11:25'),
	(24, 'RjfYy24F', 'Ahmad Fikri Akbar', '1', '100', 0, 'yhnN-N5e-eS9', '2023-03-31 02:39:03', '2023-03-31 02:39:29'),
	(25, 'h3BpVHSK', 'Ahmad Fikri Akbar', '1', '100', 63, '2HfH-rOG-y4a', '2023-03-31 02:42:36', '2023-03-31 02:43:33'),
	(28, '00Z93kHI', 'Fkry', '1', '0', 0, '05oO-O5w-37G', '2023-03-31 07:52:20', '2023-03-31 07:52:20'),
	(29, 'OTwwDTZR', 'fkkk', '1', '0', 0, 'jyyJ-gZK-OXG', '2023-03-31 07:52:42', '2023-03-31 07:52:42'),
	(30, '0zWmGzvB', 'Fkry', '1', '0', 0, '05oO-O5w-37G', '2023-03-31 08:00:04', '2023-03-31 08:00:04'),
	(31, 'DrRw98la', 'Fkry', '1', '0', 0, 'jyyJ-gZK-OXG', '2023-03-31 08:14:58', '2023-03-31 08:14:58'),
	(32, '7rAp0GXt', 'Ahmad', '1', '100', 77, '05oO-O5w-37G', '2023-03-31 08:30:34', '2023-03-31 08:31:17'),
	(33, 'RwUo6LNm', 'Ahmad Fikri', '1', '33.33', 0, 'jyyJ-gZK-OXG', '2023-03-31 08:42:47', '2023-03-31 08:43:04'),
	(34, 'MChKE0DS', 'Ahmad', '1', '18.18', 36, '05oO-O5w-37G', '2023-03-31 08:49:44', '2023-03-31 08:51:08'),
	(35, 'D5AVgpoQ', 'Ahmad', '1', '33.33', 0, 'jyyJ-gZK-OXG', '2023-03-31 08:58:19', '2023-03-31 08:58:32'),
	(36, 'VNYArLzN', 'Fikri', '123', '100', 0, 'jyyJ-gZK-OXG', '2023-04-01 12:07:32', '2023-04-01 12:07:51'),
	(37, 'RA5BLREK', 'Ahmad Fkry', '1', '100', 66, '05oO-O5w-37G', '2023-04-01 12:08:28', '2023-04-01 12:09:22');

-- Dumping structure for table smafy.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smafy.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Fkry', 'fikriafa289@gmail.com', 'user', '$2y$10$0sPVwh07ZXOCoaWS2u66wut/ZKcoNA9No8pSHnKS5g2Q/HqoUYCky', 'Vst2oEOBp9zXSGmGSjS4h2sE3UBiOrumx0WALgez4aJ1uw5wvhNJe9XliIp9', '2023-03-27 02:47:40', '2023-03-31 11:59:53'),
	(2, 'Ahmad', 'fikri@gmail.com', 'user', '$2y$10$BeAwGa3we2Q7AFdYvg418OX/0AaNVxAklcwQZe0IzOJcnD2QA5MjW', 'klrrT0gurBp9Dj5RLklsrIPkiA5iazl3JOmIDm0Oo8ECzY0fsNr6EMusr1Wc', '2023-03-31 01:23:16', '2023-03-31 01:23:16'),
	(3, 'Admin', 'admin@smafy', 'admin', '$2y$10$cYLnWYdHahv7baw5KJF4V.C40Jroum3qm/gv0l36Fkf9v3/ZuMQMC', '99vv5h1M3JFQgezd3BbJNyjYlIgLD3xYEJA7nqH7LlyccFZLvRjjJE9NNGhC', '2023-03-31 10:21:06', '2023-03-31 10:21:06');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
