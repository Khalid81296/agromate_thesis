-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 01:18 PM
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
-- Table structure for table `at_case_bibadi`
--

CREATE TABLE `at_case_bibadi` (
  `id` int(10) UNSIGNED NOT NULL,
  `at_case_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `at_case_bibadi`
--

INSERT INTO `at_case_bibadi` (`id`, `at_case_id`, `name`, `designation`, `address`, `updated_at`, `created_at`) VALUES
(1, 3, 'জেলা প্রশাসক', NULL, 'মুনশিগঞ্জ', '2021-10-07 11:46:07', '2021-10-07 11:46:07'),
(2, 4, 'জেলা প্রশাসক', NULL, 'মুনশিগঞ্জ', '2021-10-07 11:47:12', '2021-10-07 11:47:12'),
(3, 5, 'জেলা প্রশাসক', NULL, 'মুনশিগঞ্জ', '2021-10-07 11:47:53', '2021-10-07 11:47:53'),
(4, 6, 'জেলা প্রশাসক', NULL, 'মুনশিগঞ্জ', '2021-10-07 11:49:07', '2021-10-07 11:49:07'),
(5, 7, 'fgfdgdfg', NULL, 'fdgdfgfd', '2021-10-07 12:13:55', '2021-10-07 12:13:55'),
(6, 7, 'fdgdfgdfg', NULL, 'dfgdfgfdg', '2021-10-07 12:13:55', '2021-10-07 12:13:55'),
(7, 8, 'fgfdgdfg', NULL, 'fdgdfgfd', '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(8, 8, 'fdgdfgdfg', NULL, 'dfgdfgfdg', '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(9, 9, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:01:22', '2021-10-09 06:01:22'),
(10, 10, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:06:46', '2021-10-09 06:06:46'),
(11, 11, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:11:08', '2021-10-09 06:11:08'),
(12, 12, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:13:15', '2021-10-09 06:13:15'),
(13, 13, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:15:08', '2021-10-09 06:15:08'),
(14, 14, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:24:44', '2021-10-09 06:24:44'),
(15, 15, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:25:18', '2021-10-09 06:25:18'),
(16, 16, 'Managing Director', NULL, 'Mysoft', '2021-10-09 06:26:21', '2021-10-09 06:26:21'),
(17, 17, 'Managing Director', NULL, 'Mysoft', '2021-10-09 09:56:52', '2021-10-09 09:56:52'),
(18, 18, 'Managing Director', NULL, 'Mysoft', '2021-10-09 10:18:00', '2021-10-09 10:18:00'),
(19, 19, 'Managing Director', NULL, 'Mysoft', '2021-10-09 12:44:48', '2021-10-09 12:44:48'),
(20, 20, 'Managing Director', NULL, 'Mysoft', '2021-10-09 12:46:53', '2021-10-09 12:46:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `at_case_bibadi`
--
ALTER TABLE `at_case_bibadi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `at_case_bibadi`
--
ALTER TABLE `at_case_bibadi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
