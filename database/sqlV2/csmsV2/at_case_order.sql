-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 01:19 PM
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
-- Table structure for table `at_case_order`
--

CREATE TABLE `at_case_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `at_case_id` int(11) DEFAULT NULL,
  `order_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `at_case_order`
--

INSERT INTO `at_case_order` (`id`, `at_case_id`, `order_by`, `section`, `date`, `updated_at`, `created_at`) VALUES
(1, 8, 'dsadsdfdgfdgdfg', 'fdsfdsfs', '0000-00-00 00:00:00', '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(2, 8, 'dsadsd', 'fgfdg', '0000-00-00 00:00:00', '2021-10-07 12:14:45', '2021-10-07 12:14:45'),
(3, 9, 'Fozlul', NULL, '0000-00-00 00:00:00', '2021-10-09 06:01:22', '2021-10-09 06:01:22'),
(4, 10, 'Fozlul', NULL, '0000-00-00 00:00:00', '2021-10-09 06:06:46', '2021-10-09 06:06:46'),
(5, 11, 'Fozlul', NULL, '0000-00-00 00:00:00', '2021-10-09 06:11:09', '2021-10-09 06:11:09'),
(6, 12, 'Fozlul', NULL, '0000-00-00 00:00:00', '2021-10-09 06:13:15', '2021-10-09 06:13:15'),
(7, 13, 'Fozlul', NULL, '0000-00-00 00:00:00', '2021-10-09 06:15:08', '2021-10-09 06:15:08'),
(8, 14, 'Fozlul', 'Sec-1', '0000-00-00 00:00:00', '2021-10-09 06:24:45', '2021-10-09 06:24:45'),
(9, 15, 'Fozlul', 'Sec-1', '0000-00-00 00:00:00', '2021-10-09 06:25:18', '2021-10-09 06:25:18'),
(10, 16, 'Fozlul', 'Sec-1', '0000-00-00 00:00:00', '2021-10-09 06:26:21', '2021-10-09 06:26:21'),
(11, 17, 'Fozlul', 'Sec-1', '0000-00-00 00:00:00', '2021-10-09 09:56:52', '2021-10-09 09:56:52'),
(12, 18, 'Fozlul', 'Sec-1', '0000-00-00 00:00:00', '2021-10-09 10:18:00', '2021-10-09 10:18:00'),
(13, 19, 'Fozlul', 'Sec-1', '0000-00-00 00:00:00', '2021-10-09 12:44:48', '2021-10-09 12:44:48'),
(14, 19, 'Nazmul', 'Sec-1', '0000-00-00 00:00:00', '2021-10-09 12:44:48', '2021-10-09 12:44:48'),
(15, 20, 'Fozlul', 'Sec-1', '2021-10-10 00:00:00', '2021-10-09 12:46:53', '2021-10-09 12:46:53'),
(17, 20, 'Nazmul', 'Sec-2', '2021-10-07 00:00:00', '2021-10-10 06:17:12', '2021-10-10 06:17:12'),
(18, 20, 'Nozrul', 'Sec-3', '2021-10-10 00:00:00', '2021-10-10 06:41:21', '2021-10-10 06:41:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `at_case_order`
--
ALTER TABLE `at_case_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `at_case_order`
--
ALTER TABLE `at_case_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
