-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2024 at 10:38 AM
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
-- Database: `ngo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Ahmedabad', 1, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(2, 'Surat', 1, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(3, 'Baroda', 1, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(4, 'Mumbai', 2, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(5, 'Pune', 2, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(6, 'Nagpur', 2, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(7, 'Jaipur', 3, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(8, 'Jodhpur', 3, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(9, 'Kota', 3, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(10, 'Indore', 4, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(11, 'Ujjain', 4, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(12, 'Devas', 4, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(13, 'Chennai', 5, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(14, 'Tiruchirappalli', 5, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(15, 'Coimbatore', 5, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(16, 'Bengaluru', 6, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(17, 'Udupi', 6, '2024-01-27 05:27:02', '2024-01-27 05:27:02'),
(18, 'Mangaluru', 6, '2024-01-27 05:27:02', '2024-01-27 05:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `ngo_id` varchar(25) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ngos`
--

CREATE TABLE `ngos` (
  `id` int(11) NOT NULL,
  `ngo_id` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` text NOT NULL,
  `banner` varchar(50) NOT NULL,
  `photos` text NOT NULL,
  `documents` text NOT NULL,
  `certifications` text NOT NULL,
  `note` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ngos`
--

INSERT INTO `ngos` (`id`, `ngo_id`, `name`, `email`, `phone`, `state`, `city`, `address`, `banner`, `photos`, `documents`, `certifications`, `note`, `is_approved`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, '2', 'NAMO', 'namo@gmail.com', 7845123690, 1, 1, 'Ahmedabad, Gujarat, India', 'banner_1707529359_512316e1b0d63e03ad5b.jpg', '[{\"item_id\":\"1707529359_1\",\"avatar\":\"170752935929777_1.jpg\"},{\"item_id\":\"1707530554_0\",\"avatar\":\"170753055446035_0.jpg\"}]', '[{\"item_id\":\"1707529360_0\",\"avatar\":\"170752936072050_0_doc.jpg\"},{\"item_id\":\"1707530554_0\",\"avatar\":\"170753055432522_0_doc.jpg\"}]', '[{\"item_id\":\"1707529360_3\",\"avatar\":\"170752936088407_3_certi.jpg\"},{\"item_id\":\"1707530554_0\",\"avatar\":\"170753055428944_0_certi.jpg\"}]', 'This is it.', 1, 1, 1, '2024-02-10 01:42:39', '2024-02-10 02:02:34'),
(3, '2', 'Vande Bharat', 'vandebharat@gmail.com', 7845123690, 1, 1, 'Rajkot, Gujarat, India', 'banner_1707529359_512316e1b0d63e03ad5b.jpg', '[{\"item_id\":\"1707529359_1\",\"avatar\":\"170752935929777_1.jpg\"},{\"item_id\":\"1707530554_0\",\"avatar\":\"170753055446035_0.jpg\"}]', '[{\"item_id\":\"1707529360_0\",\"avatar\":\"170752936072050_0_doc.jpg\"},{\"item_id\":\"1707530554_0\",\"avatar\":\"170753055432522_0_doc.jpg\"}]', '[{\"item_id\":\"1707529360_3\",\"avatar\":\"170752936088407_3_certi.jpg\"},{\"item_id\":\"1707530554_0\",\"avatar\":\"170753055428944_0_certi.jpg\"}]', 'This is it.', 1, 1, 1, '2024-02-10 01:42:39', '2024-02-10 02:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_docs`
--

CREATE TABLE `ngo_docs` (
  `id` int(11) NOT NULL,
  `ngo_id` varchar(25) NOT NULL,
  `certificate_name` varchar(100) NOT NULL,
  `certificate_avatar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ngo_works`
--

CREATE TABLE `ngo_works` (
  `id` int(11) NOT NULL,
  `ngo_id` varchar(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `ngo_id` varchar(25) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `ngo_id`, `amount`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2', 500.00, 1, 6, 6, '2024-02-10 03:36:47', '2024-02-10 03:36:47'),
(2, '2', 500.00, 1, 7, 7, '2024-02-09 03:36:47', '2024-02-10 03:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gujarat', '2024-01-27 05:25:57', '2024-01-27 05:25:57'),
(2, 'Maharasthra', '2024-01-27 05:25:57', '2024-01-27 05:25:57'),
(3, 'Rajasthan', '2024-01-27 05:26:14', '2024-01-27 05:26:14'),
(4, 'Madhya Pradesh ', '2024-01-27 05:26:14', '2024-01-27 05:26:14'),
(5, 'Tamilnadu', '2024-01-27 05:26:35', '2024-01-27 05:26:35'),
(6, 'Karnataka', '2024-01-27 05:26:35', '2024-01-27 05:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1-donor,2-ngo,3-SA',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 'Tejas Shrigondekar', 'tejas@gmail.com', 1234567890, 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '2024-02-10 02:19:48', '2024-02-10 02:19:48'),
(2, 'Super Admin', 'sa@gmail.com', 1234567890, 'e10adc3949ba59abbe56e057f20f883e', 3, 1, '2024-01-27 04:08:25', '2024-01-27 04:08:25'),
(6, 'Donor 1', 'donor_1@gmail.com', 1234567890, 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2024-02-10 02:39:32', '2024-02-10 03:17:12'),
(7, 'Donor 2', 'donor_2@gmail.com', 1234567890, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '2024-02-10 02:39:53', '2024-02-10 03:17:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngos`
--
ALTER TABLE `ngos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngo_docs`
--
ALTER TABLE `ngo_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngo_works`
--
ALTER TABLE `ngo_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
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
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ngos`
--
ALTER TABLE `ngos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ngo_docs`
--
ALTER TABLE `ngo_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ngo_works`
--
ALTER TABLE `ngo_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
