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
-- Table structure for table `at_case_register`
--

CREATE TABLE `at_case_register` (
  `id` int(10) UNSIGNED NOT NULL,
  `case_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_date` date DEFAULT NULL,
  `action_user_id` tinyint(4) DEFAULT NULL,
  `court_id` tinyint(4) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `notice_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_scan1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_scan2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `result_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_deadline` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_favour_govt` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `govt_lost_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advocate_id` int(11) DEFAULT NULL,
  `is_appeal` tinyint(4) DEFAULT NULL,
  `column_23` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `at_case_register`
--

INSERT INTO `at_case_register` (`id`, `case_no`, `case_date`, `action_user_id`, `court_id`, `district_id`, `division_id`, `notice_file`, `sf_scan1`, `sf_scan2`, `result`, `result_file`, `case_reason`, `sf_deadline`, `status`, `comments`, `in_favour_govt`, `user_id`, `govt_lost_reason`, `advocate_id`, `is_appeal`, `column_23`, `created_at`, `updated_at`) VALUES
(12, '২২৩/২০২১', '2021-10-10', NULL, 7, 13, 3, 'D:\\xampp74\\tmp\\php4856.tmp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Need to done', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 06:13:15', '2021-10-09 06:13:15'),
(13, '২২৩/২০২১', '2021-10-10', NULL, 7, 13, 3, 'D:\\xampp74\\tmp\\phpB6.tmp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Need to done', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 06:15:08', '2021-10-09 06:15:08'),
(14, '2001/2021', '2021-10-11', NULL, 2, 13, 3, 'D:\\xampp74\\tmp\\phpCCB0.tmp', NULL, NULL, NULL, NULL, 'Bad Charecter', NULL, NULL, 'Very Suspicious', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 06:24:44', '2021-10-09 06:24:44'),
(15, '2001/2021', '2021-10-11', NULL, 2, 13, 3, 'D:\\xampp74\\tmp\\php4FBC.tmp', NULL, NULL, NULL, NULL, 'Bad Charecter', NULL, NULL, 'Very Suspicious', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 06:25:18', '2021-10-09 06:25:18'),
(16, '2001/2021', '2021-10-11', NULL, 2, 13, 3, 'D:\\xampp74\\tmp\\php471D.tmp', NULL, NULL, NULL, NULL, 'Bad Charecter', NULL, NULL, 'Very Suspicious', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 06:26:21', '2021-10-09 06:26:21'),
(17, '5006/21', '2021-10-11', NULL, 16, 35, 3, '16_1633773412.pdf', NULL, NULL, NULL, NULL, 'Money Laundering act.', NULL, NULL, 'No Comments', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 09:56:52', '2021-10-09 09:56:52'),
(18, '5016/21', '2021-10-12', NULL, 1, 15, 3, 'uploads/at_case/notice//1_1633774680.pdf', NULL, NULL, NULL, NULL, 'Corruption', '2021-10-19', NULL, 'No Comments', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 10:18:00', '2021-10-09 10:18:00'),
(19, '2221/2021', '2021-10-11', NULL, 1, 35, 3, 'uploads/at_case/notice//1_1633783488.pdf', NULL, NULL, NULL, NULL, 'Money Laundering', '2021-10-11', NULL, 'Comments no need', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 12:44:48', '2021-10-09 12:44:48'),
(20, '2221/2021', '2021-10-11', NULL, 1, 35, 3, 'uploads/at_case/notice//1_1633859437.pdf', NULL, NULL, NULL, NULL, 'Money Laundering', '2021-10-11', NULL, 'Comments no need', NULL, NULL, NULL, 38, NULL, NULL, '2021-10-09 12:46:53', '2021-10-10 09:50:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `at_case_register`
--
ALTER TABLE `at_case_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `at_case_register`
--
ALTER TABLE `at_case_register`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
