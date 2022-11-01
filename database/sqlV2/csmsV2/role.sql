-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 01:21 PM
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
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(150) NOT NULL,
  `sort_order` smallint(6) NOT NULL,
  `in_action` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `sort_order`, `in_action`) VALUES
(1, 'সুপার অ্যাডমিন', 0, 0),
(2, 'সচিব', 0, 0),
(3, 'অতিরিক্ত সচিব', 0, 0),
(4, 'ল্যান্ড ডিজিটাইজেশন সেল', 0, 0),
(5, 'অফিস সহকারী (আরএম)', 75, 1),
(6, 'জেলা প্রশাসক', 10, 1),
(7, 'অতিরিক্ত জেলা প্রশাসক (রেভিনিউ)', 20, 1),
(8, 'সহকারী কমিশনার (আরএম)', 30, 1),
(9, 'সহকারী কমিশনার (ভূমি)', 40, 1),
(10, 'সার্ভেয়র', 60, 1),
(11, 'কানুনগো', 50, 1),
(12, 'ইউনিয়ন ভূমি সহকারী কর্মকর্তা', 70, 1),
(13, 'জিপি', 80, 1),
(14, 'সলিসিটর', 90, 1),
(15, 'অ্যাটর্নি জেনারেল', 0, 0),
(16, 'এজিপি', 85, 1),
(17, 'অফিস প্রধান', 86, 1),
(18, 'ডেস্ক অফিসার', 87, 1),
(19, 'অফিস সহকারী', 88, 1),
(20, 'অ্যাডভোকেট ', 91, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
