-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2018 at 04:56 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`, `timestamp`) VALUES
(1, 'Burger', '2018-05-11 10:25:49'),
(2, 'Pasta', '2018-05-11 10:25:52'),
(3, 'Fingertips', '2018-05-11 10:26:19'),
(4, 'Dessert', '2018-05-11 10:26:23'),
(5, 'Premium', '2018-05-11 10:26:06'),
(6, 'Healthy', '2018-05-11 10:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `dtr_table`
--

CREATE TABLE `dtr_table` (
  `log_id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtr_table`
--

INSERT INTO `dtr_table` (`log_id`, `user_id`, `log_timestamp`, `log_type`) VALUES
(9, 0, '2018-05-10 17:14:41', 1),
(10, 1, '2018-05-10 17:17:10', 1),
(11, 1, '2018-05-10 17:17:17', 0),
(12, 1, '2018-05-10 17:17:22', 1),
(13, 1, '2018-05-10 17:17:27', 0),
(14, 1, '2018-05-11 07:28:57', 1),
(22, 1, '2018-05-11 08:22:01', 0),
(23, 1, '2018-05-11 08:23:25', 1),
(24, 1, '2018-05-11 09:07:42', 0),
(25, 1, '2018-05-11 09:10:09', 1),
(26, 1, '2018-05-11 10:30:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_table`
--

CREATE TABLE `inventory_table` (
  `inventory_id` int(11) NOT NULL,
  `inventory_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_table`
--

CREATE TABLE `menu_table` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_price` double NOT NULL,
  `menu_quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `menu_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_table`
--

INSERT INTO `menu_table` (`menu_id`, `menu_name`, `menu_price`, `menu_quantity`, `category_id`, `menu_timestamp`) VALUES
(4, 'Hundred Islands Salad', 75, 10, 5, '2018-05-11 08:52:06'),
(6, 'Hawaiian Burger', 100, 10, 1, '2018-05-11 09:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_password`, `isAdmin`, `user_first_name`, `user_last_name`, `user_timestamp`) VALUES
(1, 'samuel', '1234', 0, 'Samuel', 'Quinto', '2018-05-11 14:39:13'),
(7, 'hazel', '1234', 1, 'Hazel', 'Noceja', '2018-05-11 14:53:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `dtr_table`
--
ALTER TABLE `dtr_table`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `inventory_table`
--
ALTER TABLE `inventory_table`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `menu_table`
--
ALTER TABLE `menu_table`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `dtr_table`
--
ALTER TABLE `dtr_table`
  MODIFY `log_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `inventory_table`
--
ALTER TABLE `inventory_table`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_table`
--
ALTER TABLE `menu_table`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
