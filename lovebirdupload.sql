-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 09:43 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lovebirdupload`
--

-- --------------------------------------------------------

--
-- Table structure for table `dropfiles`
--

CREATE TABLE `dropfiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dropfiles`
--

INSERT INTO `dropfiles` (`id`, `file_name`, `file_type`, `file_size`, `created_at`, `updated_at`) VALUES
(1, '5d41cb2f1e274.png', 'png', '7556', '2019-07-31 10:09:07', '2019-07-31 10:09:07'),
(2, '5d41cc5da3c25.png', 'png', '7556', '2019-07-31 10:14:14', '2019-07-31 10:14:14'),
(3, '5d41ce8f5e0be.png', 'png', '7556', '2019-07-31 10:23:31', '2019-07-31 10:23:31'),
(4, '5d41d2bf422ed.png', 'png', '7556', '2019-07-31 10:41:27', '2019-07-31 10:41:27'),
(5, '5d41d30098cd0.png', 'png', '7556', '2019-07-31 10:42:30', '2019-07-31 10:42:30'),
(6, '5d41d32f646f0.png', 'png', '7556', '2019-07-31 10:43:17', '2019-07-31 10:43:17'),
(7, '5d41d3ed497b4.png', 'png', '7556', '2019-07-31 10:46:28', '2019-07-31 10:46:28'),
(8, '5d41d435e9816.png', 'png', '7556', '2019-07-31 10:47:39', '2019-07-31 10:47:39'),
(9, '5d41d46818fe9.png', 'png', '7556', '2019-07-31 10:48:30', '2019-07-31 10:48:30'),
(10, '5d41d4a516054.png', 'png', '7556', '2019-07-31 10:49:32', '2019-07-31 10:49:32'),
(11, '5d41d4dcea2fe.png', 'png', '7556', '2019-07-31 10:50:26', '2019-07-31 10:50:26'),
(12, '5d41d7135342d.png', 'png', '7556', '2019-07-31 10:59:52', '2019-07-31 10:59:52'),
(13, '5d41d73827604.png', 'png', '7556', '2019-07-31 11:00:28', '2019-07-31 11:00:28'),
(14, '5d41d74c0c537.png', 'png', '7556', '2019-07-31 11:00:49', '2019-07-31 11:00:49'),
(15, '5d41de5ada874.png', 'png', '7556', '2019-07-31 11:30:56', '2019-07-31 11:30:56'),
(16, '5d4245e73750d.png', 'png', '18140', '2019-07-31 18:52:45', '2019-07-31 18:52:45'),
(17, '5d4249742e779.jpg', 'jpg', '60729', '2019-07-31 19:08:06', '2019-07-31 19:08:06'),
(18, '5d4249dabc305.jpg', 'jpg', '60729', '2019-07-31 19:09:35', '2019-07-31 19:09:35'),
(19, '5d424a1c98cbf.jpg', 'jpg', '60729', '2019-07-31 19:10:44', '2019-07-31 19:10:44'),
(20, '5d424a6f270f7.jpg', 'jpg', '60729', '2019-07-31 19:12:04', '2019-07-31 19:12:04'),
(21, '5d424a95ec258.jpg', 'jpg', '60729', '2019-07-31 19:12:42', '2019-07-31 19:12:42'),
(22, '5d663372baae7.jpg', 'jpg', '42936', '2019-08-28 00:55:36', '2019-08-28 00:55:36'),
(23, '5db9a89024f2d.jpg', 'jpg', '42936', '2019-10-30 08:13:26', '2019-10-30 08:13:26'),
(24, '5db9aa4d216f6.jpg', 'jpg', '323743', '2019-10-30 08:21:11', '2019-10-30 08:21:11'),
(25, '5db9acd6369ef.jpg', 'jpg', '323743', '2019-10-30 08:31:42', '2019-10-30 08:31:42'),
(26, '5db9ad5f7c412.jpg', 'jpg', '30074', '2019-10-30 08:33:56', '2019-10-30 08:33:56'),
(27, '5db9aea5656f8.jpg', 'jpg', '42936', '2019-10-30 08:39:23', '2019-10-30 08:39:23'),
(28, '5db9af4c47d3b.jpg', 'jpg', '42936', '2019-10-30 08:42:10', '2019-10-30 08:42:10'),
(29, '5db9bce044415.jpg', 'jpg', '42936', '2019-10-30 09:40:06', '2019-10-30 09:40:06'),
(30, '5dc131a0a7185.jpg', 'jpg', '5194', '2019-11-05 01:24:06', '2019-11-05 01:24:06'),
(31, '5dc131d79b5b3.jpg', 'jpg', '5194', '2019-11-05 01:25:02', '2019-11-05 01:25:02'),
(32, '5dc1329712955.jpg', 'jpg', '5194', '2019-11-05 01:28:12', '2019-11-05 01:28:12'),
(33, '5dc132eb6b75a.jpg', 'jpg', '5194', '2019-11-05 01:29:36', '2019-11-05 01:29:36'),
(34, '5dc133555f791.jpg', 'jpg', '5194', '2019-11-05 01:31:21', '2019-11-05 01:31:21'),
(35, '5dcb83c58d319.jpg', 'jpg', '50772', '2019-11-12 21:17:15', '2019-11-12 21:17:15'),
(36, '5dcb87790027f.jpg', 'jpg', '50772', '2019-11-12 21:33:01', '2019-11-12 21:33:01'),
(37, '5dcb87cc0ee7c.jpg', 'jpg', '50772', '2019-11-12 21:34:23', '2019-11-12 21:34:23'),
(38, '5dce511e2aa2e.jpg', 'jpg', '50772', '2019-11-15 00:17:54', '2019-11-15 00:17:54'),
(39, '5ddc9d035d18a.jpg', 'jpg', '97392', '2019-11-25 20:33:27', '2019-11-25 20:33:27'),
(40, '5ddc9db53a80d.jpg', 'jpg', '5255', '2019-11-25 20:36:25', '2019-11-25 20:36:25'),
(41, '5ddc9df8d6970.jpg', 'jpg', '5255', '2019-11-25 20:37:32', '2019-11-25 20:37:32'),
(42, '5ddca0413ddcd.jpg', 'jpg', '26519', '2019-11-25 20:47:16', '2019-11-25 20:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_31_160029_create_dropfiles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dropfiles`
--
ALTER TABLE `dropfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dropfiles`
--
ALTER TABLE `dropfiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
