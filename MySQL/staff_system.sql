-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time:  3 ное 2019 в 22:30
-- Версия на сървъра: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staff_system`
--

-- --------------------------------------------------------

--
-- Структура на таблица `currency`
--

CREATE TABLE `currency` (
  `id` int(11) UNSIGNED NOT NULL,
  `currency_name` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `currency`
--

INSERT INTO `currency` (`id`, `currency_name`, `created_at`, `updated_at`) VALUES
(1, 'USD', '2019-11-02 15:39:04', '2019-11-02 15:39:04'),
(2, 'EUR', '2019-11-02 15:39:04', '2019-11-02 15:39:04'),
(3, 'BGN', '2019-11-02 15:39:04', '2019-11-02 15:39:04'),
(4, 'RUB', '2019-11-02 15:39:04', '2019-11-02 15:39:04'),
(5, 'CAD', '2019-11-02 15:39:04', '2019-11-02 15:39:04');

-- --------------------------------------------------------

--
-- Структура на таблица `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `salary` int(5) UNSIGNED NOT NULL,
  `birth_date` date NOT NULL DEFAULT current_timestamp(),
  `gender` char(6) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура на таблица `staff_position`
--

CREATE TABLE `staff_position` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_name` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `staff_position`
--

INSERT INTO `staff_position` (`id`, `position_name`, `created_at`, `updated_at`) VALUES
(1, 'Cloud Architect', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(2, 'Cloud Consultant', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(3, 'Cloud System Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(4, 'Cloud System Engineer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(5, 'Network Engineer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(6, 'Network Systems Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(7, 'Senior Network Architect', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(8, 'Senior Network Engineer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(9, 'Senior Network System Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(10, 'Telecommunications Specialist', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(11, 'Customer Support Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(12, 'Desktop Support Manager', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(13, 'Help Desk Specialist', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(14, 'Help Desk Technician', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(15, 'IT Support Manager', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(16, 'IT Support Specialist', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(17, 'IT Systems Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(18, 'Senior Support Specialist', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(19, 'Systems Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(20, 'Data Quality Manager', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(21, 'Database Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(22, 'Application Support Analyst', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(23, 'Systems Analyst', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(24, 'Systems Designer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(25, 'Chief Information Officer (CIO)', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(26, 'Chief Technology Officer (CTO)', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(27, 'Director of Technology', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(28, 'IT Director', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(29, 'IT Manager', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(30, 'Security Specialist', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(31, 'Application Developer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(32, 'Applications Engineer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(33, 'Java Developer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(34, 'Junior Software Engineer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(35, '.NET Developer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(36, 'Senior Software Engineer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(37, 'Front End Developer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(38, 'Senior Web Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(39, 'Senior Web Developer', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(40, 'Web Administrator', '2019-11-02 16:32:48', '2019-11-02 16:32:48'),
(41, 'Web Developer', '2019-11-02 16:32:48', '2019-11-02 16:32:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_position`
--
ALTER TABLE `staff_position`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_position`
--
ALTER TABLE `staff_position`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
