-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 08:02 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carz_driver`
--

-- --------------------------------------------------------

--
-- Table structure for table `commission_report`
--

CREATE TABLE `commission_report` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `countryCode` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countryName` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currencyCode` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_status`
--

CREATE TABLE `driver_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_22_053947_create_country_table_seeder', 1),
(4, '2018_05_23_045712_create_table_setting', 1),
(5, '2018_05_23_051141_create_tree_table', 1),
(6, '2018_05_23_053852_create_commission_report_table', 1),
(7, '2018_05_23_054906_create_table_user_activity', 1),
(8, '2018_05_23_112425_create_driver_status_table', 1),
(9, '2018_05_24_092852_create_user_invites_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `env` enum('local','staging','production') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '2 = delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `user_id`, `parent_id`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(2, 2, 1, 1, '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(3, 4, 2, 1, '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(4, 5, 2, 2, '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(5, 6, 4, 1, '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(6, 7, 4, 2, '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(7, 8, 5, 1, '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(8, 9, 5, 2, '0', '2018-07-16 18:30:00', '2018-07-18 01:38:39'),
(9, 10, 8, 1, '0', '2018-07-16 18:30:00', '2018-07-18 01:38:20'),
(10, 11, 8, 2, '0', '2018-07-16 18:30:00', '2018-07-18 01:38:13'),
(11, 12, 1, 2, '0', '2018-07-16 18:30:00', '2018-07-18 01:33:39'),
(12, 13, 1, 1, '2', '2018-07-16 18:30:00', '2018-07-18 01:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `driver_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_cal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `active` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `driver_num`, `url`, `name`, `first_name`, `last_name`, `country`, `city`, `address`, `postcode`, `telephone`, `email`, `password`, `profile_img`, `user_ip`, `commission_cal`, `driver_status`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'http://localhost/driver-system/register?ref=NG04eHRoeXg', 'emple', 'office', 'emple', NULL, NULL, NULL, NULL, NULL, 'empleoffice@gmail.com', '$2y$10$xER/h4jc60NbzNTVBcHEs.hGARgg1bWCa3Vkxk3fqjexdToBFFsZS', '1531748041.png', NULL, NULL, '1', '1', 'atteMvtcIpRfGpo76UG2yjzAZap72K2DZaFT7p3SB3oiPdnvc2eQPJxDS062', '2018-07-15 18:30:00', '2018-07-16 08:04:52'),
(2, NULL, NULL, 'sanjay yadav', 'sanjay', 'yadav', NULL, NULL, NULL, NULL, NULL, 'sanjay@gmail.com', '$2y$10$xER/h4jc60NbzNTVBcHEs.hGARgg1bWCa3Vkxk3fqjexdToBFFsZS', NULL, NULL, NULL, '1', '1', 'KhjTY25DtULVsBgxLTZwx2W8OCCOKbGxNtF6lU2JbxVUin2lfq7tmBPIZ0zM', NULL, NULL),
(3, NULL, NULL, 'samuals', 'samuals', 'sam', NULL, NULL, NULL, NULL, NULL, 'samulas@gmail.com', '$2y$10$xER/h4jc60NbzNTVBcHEs.hGARgg1bWCa3Vkxk3fqjexdToBFFsZS', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(4, NULL, NULL, 'sachin', 'sachin ', 'tendulakar', NULL, NULL, NULL, NULL, NULL, 'sachin@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(5, NULL, NULL, 'ramesh tendulkar', 'ramesh', 'tendulkar', NULL, NULL, NULL, NULL, NULL, 'ramesh@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, NULL, NULL),
(6, NULL, NULL, 'rahul dravid', 'rahul', 'dravid', NULL, NULL, NULL, NULL, NULL, 'rahul@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(7, NULL, NULL, 'suresh raina', 'suresh ', 'raina', NULL, NULL, NULL, NULL, NULL, 'suresh@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(8, NULL, NULL, 'Virendra Sehwag', 'virendra', 'sehwag', NULL, NULL, NULL, NULL, NULL, 'sehwag@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(9, NULL, NULL, 'mahendra singh dhoni', 'mahendra singh', 'dhoni', NULL, NULL, NULL, NULL, NULL, 'dhoni@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, NULL, '2018-07-18 01:38:39'),
(10, NULL, NULL, 'balaji', 'balaji', 'bowl', NULL, NULL, NULL, NULL, NULL, 'balaji@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-18 01:38:20'),
(11, NULL, NULL, 'munaf patel', 'munaf ', 'patel', NULL, NULL, NULL, NULL, NULL, 'munaf@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-18 01:38:13'),
(12, NULL, NULL, 'piyush', 'piyush', 'chawala', NULL, NULL, NULL, NULL, NULL, 'piyush@gmail.com', '', NULL, NULL, NULL, '1', '1', NULL, '2018-07-16 18:30:00', '2018-07-18 01:33:39'),
(13, NULL, NULL, 'kohli', 'virat', 'kohli', NULL, NULL, NULL, NULL, NULL, 'kohli@gmail.com', '', NULL, NULL, NULL, '1', '2', NULL, '2018-07-16 18:30:00', '2018-07-18 01:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_invites`
--

CREATE TABLE `user_invites` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_registed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_invites`
--

INSERT INTO `user_invites` (`id`, `name`, `email`, `is_registed`, `created_at`, `updated_at`) VALUES
(1, 'sanajy yadav', 'sanjay@gmail.com', '0', '2018-07-17 04:50:43', '2018-07-17 04:50:43'),
(2, 'samuals', 'samulas@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(3, 'sachin', 'sachin@gmail.com', '0', '2018-07-17 05:37:15', '2018-07-17 05:37:15'),
(4, 'ramesh', 'ramesh@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(5, 'rahul', 'rahul@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(6, 'suresh', 'suresh@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(7, 'sehwag', 'sehwag@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(8, 'dhoni', 'dhoni@gmail.com', '0', NULL, NULL),
(9, 'balaji', 'balaji@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(10, 'munaf ', 'munaf@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(11, 'piyush', 'piyush@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00'),
(12, 'kohli', 'kohli@gmail.com', '0', '2018-07-16 18:30:00', '2018-07-16 18:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commission_report`
--
ALTER TABLE `commission_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_status`
--
ALTER TABLE `driver_status`
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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_invites`
--
ALTER TABLE `user_invites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commission_report`
--
ALTER TABLE `commission_report`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `driver_status`
--
ALTER TABLE `driver_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_invites`
--
ALTER TABLE `user_invites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
