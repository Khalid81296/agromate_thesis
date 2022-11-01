-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 01:20 PM
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
-- Table structure for table `judge_panel`
--

CREATE TABLE `judge_panel` (
  `id` int(10) UNSIGNED NOT NULL,
  `justis_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `at_case_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `judge_panel`
--

INSERT INTO `judge_panel` (`id`, `justis_name`, `designation`, `at_case_id`, `updated_at`, `created_at`) VALUES
(1, 'বেলায়েত', 'dsasadsd', 6, '2021-10-07 11:49:07', '2021-10-07 11:49:07'),
(2, 'sdsdsdsasd', 'yhtsyetg', 6, '2021-10-07 11:49:07', '2021-10-07 11:49:07'),
(3, 'fdgfdy5rtyfgfty', 'cfgfgyrtdfgh', 7, '2021-10-07 12:13:55', '2021-10-07 12:13:55'),
(4, 'fgdfgdgdf', 'gfdgdfgdfg', 7, '2021-10-07 12:13:55', '2021-10-07 12:13:55'),
(5, 'fdgfdy5rtyfgfty', 'cfgfgyrtdfgh', 8, '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(6, 'fgdfgdgdf', 'gfdgdfgdfg', 8, '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(7, 'Mafiz', 'Chief Judge', 9, '2021-10-09 06:01:22', '2021-10-09 06:01:22'),
(8, 'Mafiz', 'Chief Judge', 10, '2021-10-09 06:06:46', '2021-10-09 06:06:46'),
(9, 'Mafiz', 'Chief Judge', 11, '2021-10-09 06:11:08', '2021-10-09 06:11:08'),
(10, 'Mafiz', 'Chief Judge', 12, '2021-10-09 06:13:15', '2021-10-09 06:13:15'),
(11, 'Mafiz', 'Chief Judge', 13, '2021-10-09 06:15:08', '2021-10-09 06:15:08'),
(12, 'Mafiz', 'Chief Judge', 14, '2021-10-09 06:24:45', '2021-10-09 06:24:45'),
(13, 'Mafiz', 'Chief Judge', 15, '2021-10-09 06:25:18', '2021-10-09 06:25:18'),
(14, 'Mafiz', 'Chief Judge', 16, '2021-10-09 06:26:21', '2021-10-09 06:26:21'),
(15, 'Mafiz', 'Chief Judge', 17, '2021-10-09 09:56:52', '2021-10-09 09:56:52'),
(16, 'Mafiz', 'Chief Judge', 18, '2021-10-09 10:18:00', '2021-10-09 10:18:00'),
(17, 'Mafiz', 'Chief Judge', 19, '2021-10-09 12:44:48', '2021-10-09 12:44:48'),
(18, 'Mafiz', 'Chief Judge', 20, '2021-10-09 12:46:53', '2021-10-09 12:46:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `judge_panel`
--
ALTER TABLE `judge_panel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `judge_panel`
--
ALTER TABLE `judge_panel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
