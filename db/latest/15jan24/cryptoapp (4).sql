-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 01:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptoapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `channel_name` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `contact`, `channel_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Muhammad Awais Anjum', '50techcompany@gmail.com', '2024-01-12 05:20:24', '$2y$10$0GcHQ2sDcpgt0HuJhwYsY.HS.39kKCBUgI/2p0Ek7/Thn6of.R6xK', 'thumbnails/360_F_123709226_ocZ8yS8i8kZhYiHLwuKSfdPfq4NopbZU.jpg', '03045098789', 'channel one', '', '2024-01-07 20:03:10', '2024-01-10 07:22:30'),
(5, 'Muhammad Awais', 'awaisprojects1@gmail.com', '2024-01-09 10:52:25', '$2y$10$VGraTp6HtKjqA2lD0bgn9eQHGPtSgwTDNS/vaVpbXzHCmAbP.1ufe', 'thumbnails/client-testi-dp-2.jpg', '03045098789', 'channel two', '', '2024-01-09 02:15:07', '2024-01-09 05:57:23'),
(6, 'Awais', 'awais.invovision@gmail.com', '0000-00-00 00:00:00', '$2y$10$LmjqZ9MtDVFCdvxrgK29VuamVsFEOW4.j/wYGNFyuFl3sOLOegL4O', 'thumbnails/client-testi-dp-5.jpg', '03045098789', 'invo channel', '', '2024-01-15 06:55:16', '2024-01-15 06:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `signals`
--

CREATE TABLE `signals` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `coin_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `risk_level` enum('high','mid','low') DEFAULT NULL,
  `signal_type` enum('long','small') DEFAULT NULL,
  `channel_name` varchar(255) NOT NULL,
  `target_price` longtext NOT NULL,
  `stop_loss_price` bigint(20) DEFAULT NULL,
  `validity_period` timestamp NULL DEFAULT NULL,
  `additional_comments` longtext DEFAULT NULL,
  `visibility` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signals`
--

INSERT INTO `signals` (`id`, `admin_id`, `admin_name`, `coin_name`, `image`, `risk_level`, `signal_type`, `channel_name`, `target_price`, `stop_loss_price`, `validity_period`, `additional_comments`, `visibility`, `created_at`, `updated_at`) VALUES
(4, 4, '', 'cryptocoin', 'images/bitcoin-3137150_1280.jpg', 'mid', 'small', 'channel one', '300', 250, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'channel', '2024-01-09 23:33:34', '2024-01-15 00:47:02'),
(5, 4, '', 'cryptocoin', 'images/0_iqTJjBZanZfULbnW.png', 'mid', 'small', 'channel one', '300', 250, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'channel', '2024-01-09 23:45:17', '2024-01-15 00:56:09'),
(6, 4, '', 'cryptocoin', 'images/circuit-7955446_1280.png', 'mid', 'small', 'channel one', '300', 250, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'channel', '2024-01-12 00:37:17', '2024-01-15 00:50:31'),
(7, 4, '', 'cryptocoin', 'images/New-Article-Dark-1200x628-1-1.jpg', 'mid', 'small', 'channel one', '300', 250, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'channel', '2024-01-12 00:50:34', '2024-01-15 00:57:58'),
(9, 5, '', 'BTC', 'images/bitcoin-3290060_1280.jpg', 'mid', 'small', 'channel two', '300,400,500', 250, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'channel', '2024-01-15 01:40:08', '2024-01-15 01:40:08'),
(10, 5, '', 'BNB', 'images/bitcoin-3137150_1280.jpg', 'mid', 'small', 'channel two', '300,200,100', 250, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'channel', '2024-01-15 04:54:26', '2024-01-15 04:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `email_verified_status` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `2fa` longtext DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
  `security_settings` varchar(255) DEFAULT NULL,
  `notification_preferences` enum('email') DEFAULT NULL,
  `trading_preferences` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `kyc_information` enum('nic','address_proof') DEFAULT NULL,
  `portfolio_overview` longtext DEFAULT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `email_verified_status`, `password`, `2fa`, `phone`, `security_settings`, `notification_preferences`, `trading_preferences`, `profile_picture`, `kyc_information`, `portfolio_overview`, `verify_token`, `created_at`, `updated_at`) VALUES
(4, 'Muhammad Awais', 'awais.invovision@gmail.com', '2024-01-10 07:10:27', 1, '$2y$10$vAyUNcY05iVrFUD1w1l5Vu.G0pQzBDh82ZYqfkUWKmRYGW9D5iJ5G', NULL, 2666266, NULL, 'email', NULL, 'profiles/client-testi-dp-2.jpg', NULL, 'lorem ipsum lorem ipsum portfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overview', '198597', '2024-01-10 07:02:22', '2024-01-10 07:10:27'),
(5, 'Awais', 'anjumawais296@gmail.com', '2024-01-15 03:08:45', 1, '$2y$10$/o7oD/Xhlgm1I8ZZcUiU8ebya1e.OVRxtnNHHeiJ6iHJwBURbh5Fu', NULL, 2666266, NULL, 'email', NULL, 'profiles/client-testi-dp-2.jpg', NULL, 'lorem ipsum lorem ipsum portfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overview', '161402', '2024-01-15 03:04:27', '2024-01-15 03:08:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signals`
--
ALTER TABLE `signals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `signals`
--
ALTER TABLE `signals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
