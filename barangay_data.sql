-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 01:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangay_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password_users`
--

CREATE TABLE `forgot_password_users` (
  `resident_reset_id` bigint(20) NOT NULL,
  `resident_id` bigint(20) NOT NULL,
  `otp` int(6) NOT NULL,
  `is_otp_matching` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnel_users`
--

CREATE TABLE `personnel_users` (
  `personnel_id` bigint(11) NOT NULL,
  `personnel_username` varchar(255) NOT NULL,
  `personnel_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resident_users`
--

CREATE TABLE `resident_users` (
  `resident_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT 'Not Applicable',
  `place_of_birth` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` varchar(7) NOT NULL,
  `civil_status` varchar(8) NOT NULL,
  `street_building_house` varchar(255) NOT NULL DEFAULT 'Not Applicable',
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `zipcode` int(4) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `valid_id_type` varchar(255) NOT NULL,
  `valid_id_number` varchar(255) NOT NULL,
  `valid_id_expiry` int(11) NOT NULL,
  `account_activated` tinyint(1) NOT NULL DEFAULT 0,
  `time_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_session` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forgot_password_users`
--
ALTER TABLE `forgot_password_users`
  ADD PRIMARY KEY (`resident_reset_id`);

--
-- Indexes for table `personnel_users`
--
ALTER TABLE `personnel_users`
  ADD PRIMARY KEY (`personnel_id`);

--
-- Indexes for table `resident_users`
--
ALTER TABLE `resident_users`
  ADD PRIMARY KEY (`resident_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forgot_password_users`
--
ALTER TABLE `forgot_password_users`
  MODIFY `resident_reset_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personnel_users`
--
ALTER TABLE `personnel_users`
  MODIFY `personnel_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resident_users`
--
ALTER TABLE `resident_users`
  MODIFY `resident_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
