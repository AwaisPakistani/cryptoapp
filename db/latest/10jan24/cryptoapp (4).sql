-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 01:32 PM
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
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `channel_name` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `contact`, `address`, `role`, `channel_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Muhammad Awais Anjum', 'awais.invovision@gmail.com', '2024-01-10 11:52:30', '$2y$10$0GcHQ2sDcpgt0HuJhwYsY.HS.39kKCBUgI/2p0Ek7/Thn6of.R6xK', 'thumbnails/360_F_123709226_ocZ8yS8i8kZhYiHLwuKSfdPfq4NopbZU.jpg', '03045098789', 'sohan Islamabad', 'user', 'channel one', '', '2024-01-07 20:03:10', '2024-01-10 07:22:30'),
(5, 'Muhammad Awais', 'awaisprojects1@gmail.com', '2024-01-09 10:52:25', '$2y$10$VGraTp6HtKjqA2lD0bgn9eQHGPtSgwTDNS/vaVpbXzHCmAbP.1ufe', 'thumbnails/client-testi-dp-2.jpg', '03045098789', 'sohan Islamabad', 'user', 'channel two', '', '2024-01-09 02:15:07', '2024-01-09 05:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `signals`
--

CREATE TABLE `signals` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `coin_name` varchar(255) NOT NULL,
  `risk_level` enum('high','mid','low') DEFAULT NULL,
  `signal_type` enum('long','small') DEFAULT NULL,
  `channel_name` varchar(255) NOT NULL,
  `Target Price` bigint(20) NOT NULL,
  `stop_loss_price` bigint(20) DEFAULT NULL,
  `take_profit_price` bigint(20) DEFAULT NULL,
  `signal_strength` enum('high','medium','low') NOT NULL,
  `validity_period` timestamp NULL DEFAULT NULL,
  `additional_comments` longtext DEFAULT NULL,
  `visibility_settings` varchar(255) DEFAULT NULL,
  `strategy_tag` varchar(255) DEFAULT NULL,
  `charts_anaylysis` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signals`
--

INSERT INTO `signals` (`id`, `admin_id`, `coin_name`, `risk_level`, `signal_type`, `channel_name`, `Target Price`, `stop_loss_price`, `take_profit_price`, `signal_strength`, `validity_period`, `additional_comments`, `visibility_settings`, `strategy_tag`, `charts_anaylysis`, `created_at`, `updated_at`) VALUES
(1, 5, 'mycoin', 'low', 'long', '', 0, NULL, NULL, 'high', NULL, NULL, NULL, NULL, NULL, '2024-01-08 19:50:52', '2024-01-08 19:50:52'),
(2, 4, 'cryptocoin', 'low', 'long', '', 0, NULL, NULL, 'high', NULL, NULL, NULL, NULL, NULL, '2024-01-08 20:05:00', '2024-01-08 20:05:00'),
(3, 4, 'cryptocoin', 'mid', 'small', '', 0, NULL, NULL, 'high', NULL, NULL, NULL, NULL, NULL, '2024-01-09 23:31:50', '2024-01-09 23:31:50'),
(4, 4, 'cryptocoin', 'mid', 'small', 'channel one', 0, NULL, NULL, 'high', NULL, NULL, NULL, NULL, NULL, '2024-01-09 23:33:34', '2024-01-09 23:33:34'),
(5, 4, 'cryptocoin', 'mid', 'small', 'channel one', 0, NULL, NULL, 'high', NULL, NULL, NULL, NULL, NULL, '2024-01-09 23:45:17', '2024-01-09 23:45:17');

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
  `wallet_addresses` longtext NOT NULL,
  `account_balance` bigint(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `transaction_history` longtext DEFAULT NULL,
  `security_settings` varchar(255) DEFAULT NULL,
  `notification_preferences` enum('email') DEFAULT NULL,
  `trading_preferences` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `linked_bank_account` varchar(255) DEFAULT NULL,
  `kyc_information` enum('nic','address_proof') DEFAULT NULL,
  `portfolio_overview` longtext DEFAULT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `email_verified_status`, `password`, `2fa`, `wallet_addresses`, `account_balance`, `phone`, `transaction_history`, `security_settings`, `notification_preferences`, `trading_preferences`, `profile_picture`, `linked_bank_account`, `kyc_information`, `portfolio_overview`, `verify_token`, `created_at`, `updated_at`) VALUES
(4, 'Muhammad Awais', 'awais.invovision@gmail.com', '2024-01-10 07:10:27', 1, '$2y$10$vAyUNcY05iVrFUD1w1l5Vu.G0pQzBDh82ZYqfkUWKmRYGW9D5iJ5G', NULL, '1', 0, 2666266, NULL, NULL, 'email', NULL, 'profiles/client-testi-dp-2.jpg', 'HBL', NULL, 'lorem ipsum lorem ipsum portfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overviewportfolio_overview', '198597', '2024-01-10 07:02:22', '2024-01-10 07:10:27');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signals`
--
ALTER TABLE `signals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
