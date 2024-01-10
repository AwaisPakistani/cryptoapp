-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 01:45 PM
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
-- Table structure for table `signals`
--

CREATE TABLE `signals` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `coin_name` varchar(255) NOT NULL,
  `risk_level` enum('high','mid','low') DEFAULT NULL,
  `signal_type` enum('long','small') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signals`
--

INSERT INTO `signals` (`id`, `admin_id`, `coin_name`, `risk_level`, `signal_type`, `created_at`, `updated_at`) VALUES
(1, 5, 'mycoin', 'low', 'long', '2024-01-08 19:50:52', '2024-01-08 19:50:52'),
(2, 4, 'cryptocoin', 'low', 'long', '2024-01-08 20:05:00', '2024-01-08 20:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `contact`, `address`, `role`, `channel_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Muhammad Awais Anjum', 'awais.invovision@gmail.com', '2024-01-09 10:52:17', '$2y$10$YW0uR7TwuW7nWttwnh0D3upKOgrklHnCyiNEddGToTudP5MpQPwly', 'thumbnails/360_F_123709226_ocZ8yS8i8kZhYiHLwuKSfdPfq4NopbZU.jpg', '03045098789', 'sohan Islamabad', 'user', 'channel one', '', '2024-01-07 20:03:10', '2024-01-07 20:03:10'),
(5, 'Muhammad Awais', 'awaisprojects1@gmail.com', '2024-01-09 10:52:25', '$2y$10$VGraTp6HtKjqA2lD0bgn9eQHGPtSgwTDNS/vaVpbXzHCmAbP.1ufe', 'thumbnails/client-testi-dp-2.jpg', '03045098789', 'sohan Islamabad', 'user', 'channel two', '', '2024-01-09 02:15:07', '2024-01-09 05:57:23');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `signals`
--
ALTER TABLE `signals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
