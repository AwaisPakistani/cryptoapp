-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 08:11 AM
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
  `email_verified_status` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `channel_name` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `verify_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `email_verified_status`, `password`, `photo`, `contact`, `channel_name`, `remember_token`, `verify_token`, `created_at`, `updated_at`) VALUES
(2, 'Muhammad Awais  Anjum', 'awais.invovision@gmail.com', '2024-01-16 05:44:43', 1, '$2y$10$EIMy8iVzu2n7j7hrdKmFfuwZCJp6jl6cmmebF6hur/o7QyQ9skzJ.', 'thumbnails/client-testi-dp-2.jpg', '03045098789', 'invo channel', '', '1155040', '2024-01-16 00:23:06', '2024-01-16 01:14:43');

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
  `visibility` enum('true','false') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signals`
--

INSERT INTO `signals` (`id`, `admin_id`, `admin_name`, `coin_name`, `image`, `risk_level`, `signal_type`, `channel_name`, `target_price`, `stop_loss_price`, `validity_period`, `additional_comments`, `visibility`, `created_at`, `updated_at`) VALUES
(4, 2, 'Muhammad Awais  Anjum', 'BNB', 'images/0_iqTJjBZanZfULbnW.png', 'mid', 'small', 'invo channel', '300,200,100', 199, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'true', '2024-01-16 02:00:26', '2024-01-16 02:07:16'),
(5, 2, 'Muhammad Awais  Anjum', 'BNB', 'images/circuit-7955446_1280.png', 'mid', 'small', 'invo channel', '300,200,100', 199, '0000-00-00 00:00:00', 'User should see the signalls time by time to take profit and to escape from losses', 'true', '2024-01-16 02:00:45', '2024-01-16 02:06:38');

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
  `trading_preferences` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `kyc_information` enum('nic','address_proof') DEFAULT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `email_verified_status`, `password`, `2fa`, `phone`, `security_settings`, `trading_preferences`, `profile_picture`, `kyc_information`, `verify_token`, `created_at`, `updated_at`) VALUES
(2, 'Muhammad Awais', 'awais.invovision@gmail.com', '2024-01-16 06:00:16', 1, '$2y$10$eG55IqWjVvodOPEnSdO.XuRUgASe11kOfOMON1GhhSz2.1EKunwQO', NULL, 2666266, NULL, NULL, 'profiles/client-testi-dp-2.jpg', NULL, '147640', '2024-01-16 01:18:21', '2024-01-16 01:20:46');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `signals`
--
ALTER TABLE `signals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
