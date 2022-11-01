-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 01:17 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `civilsuit_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `at_case_badi`
--

CREATE TABLE `at_case_badi` (
  `id` int(10) UNSIGNED NOT NULL,
  `at_case_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `at_case_badi`
--

INSERT INTO `at_case_badi` (`id`, `at_case_id`, `name`, `designation`, `address`, `updated_at`, `created_at`) VALUES
(1, 3, 'এনায়েত সর্দার', 'বেলায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:46:06', '2021-10-07 11:46:06'),
(2, 3, 'বেলায়েত সর্দার', 'এনায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:46:06', '2021-10-07 11:46:06'),
(3, 4, 'এনায়েত সর্দার', 'বেলায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:47:12', '2021-10-07 11:47:12'),
(4, 4, 'বেলায়েত সর্দার', 'এনায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:47:12', '2021-10-07 11:47:12'),
(5, 5, 'এনায়েত সর্দার', 'বেলায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:47:53', '2021-10-07 11:47:53'),
(6, 5, 'বেলায়েত সর্দার', 'এনায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:47:53', '2021-10-07 11:47:53'),
(7, 6, 'এনায়েত সর্দার', 'বেলায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:49:07', '2021-10-07 11:49:07'),
(8, 6, 'বেলায়েত সর্দার', 'এনায়েত সর্দার', 'মুনশিগঞ্জ', '2021-10-07 11:49:07', '2021-10-07 11:49:07'),
(9, 7, 'dfgfdgfdg', 'fdgdfgdfg', 'dfgdfgd', '2021-10-07 12:13:55', '2021-10-07 12:13:55'),
(10, 7, 'fdgdfgdf', 'fgfdgdf', 'fdgdfgfdgdfg', '2021-10-07 12:13:55', '2021-10-07 12:13:55'),
(11, 8, 'dfgfdgfdg', 'fdgdfgdfg', 'dfgdfgd', '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(12, 8, 'fdgdfgdf', 'fgfdgdf', 'fdgdfgfdgdfg', '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(13, 9, 'Shamim Khan', NULL, 'Mysoft', '2021-10-09 06:01:22', '2021-10-09 06:01:22'),
(14, 10, 'Shamim Khan', NULL, 'Mysoft', '2021-10-09 06:06:46', '2021-10-09 06:06:46'),
(15, 11, 'Shamim Khan', NULL, 'Mysoft', '2021-10-09 06:11:08', '2021-10-09 06:11:08'),
(16, 12, 'Shamim Khan', NULL, 'Mysoft', '2021-10-09 06:13:15', '2021-10-09 06:13:15'),
(17, 13, 'Shamim Khan', NULL, 'Mysoft', '2021-10-09 06:15:08', '2021-10-09 06:15:08'),
(18, 14, 'Moaref Billah', NULL, 'Mysoft', '2021-10-09 06:24:44', '2021-10-09 06:24:44'),
(19, 15, 'Moaref Billah', NULL, 'Mysoft', '2021-10-09 06:25:18', '2021-10-09 06:25:18'),
(20, 16, 'Moaref Billah', NULL, 'Mysoft', '2021-10-09 06:26:21', '2021-10-09 06:26:21'),
(21, 17, 'Shusmita Sarkar', 'support', 'Mysoft', '2021-10-09 09:56:52', '2021-10-09 09:56:52'),
(22, 18, 'Sazedul Isalm', 'support', 'Mysoft', '2021-10-09 10:18:00', '2021-10-09 10:18:00'),
(23, 19, 'Saiful Islam', 'Executive Officer', 'Mysoft', '2021-10-09 12:44:48', '2021-10-09 12:44:48'),
(24, 20, 'Saiful Islam', 'Executive Officer', 'Mysoft', '2021-10-09 12:46:53', '2021-10-09 12:46:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `at_case_badi`
--
ALTER TABLE `at_case_badi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `at_case_badi`
--
ALTER TABLE `at_case_badi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
