-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 04:20 PM
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
(1, 'Burger', '2018-05-14 06:31:27'),
(2, 'Fingertips', '2018-05-13 14:20:23'),
(3, 'Dessert', '2018-05-14 04:31:59'),
(4, 'Pasta', '2018-05-13 14:20:27'),
(5, 'Premium', '2018-05-13 14:20:11'),
(6, 'Healthy Options', '2018-05-13 14:19:23');

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
  `menu_name` varchar(255) NOT NULL,
  `menu_price` double NOT NULL,
  `menu_quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `menu_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_table`
--

INSERT INTO `menu_table` (`menu_id`, `menu_name`, `menu_price`, `menu_quantity`, `category_id`, `menu_timestamp`) VALUES
(8, 'Hundred Islands Salad', 74, 0, 9, '2018-05-14 14:17:20'),
(9, 'Hungarian Sausage', 99, 8, 10, '2018-05-14 08:33:57'),
(10, 'Sweet Baby Ribs', 175, 9, 10, '2018-05-14 08:33:57'),
(11, 'Burger Steak', 99, 10, 10, '2018-05-13 12:47:11'),
(12, 'Buffalo Chicken', 120, 9, 10, '2018-05-14 08:33:56'),
(13, 'Peppered Pork', 99, 10, 10, '2018-05-13 12:47:53'),
(14, 'Chipotle Pork Steak', 99, 7, 10, '2018-05-13 17:30:37'),
(15, 'Grilled Chicken with Peri Peri Sauce', 89, 7, 9, '2018-05-13 16:59:39'),
(16, 'Boneless Bangus', 99, 4, 9, '2018-05-14 14:06:53'),
(17, 'Smoked Boneless Bangus', 99, 2, 9, '2018-05-14 14:18:13'),
(18, 'Italian Sausage Anglio Olio', 95, 4, 11, '2018-05-13 17:30:37'),
(19, 'Healthy Tuna Pesto', 89, 7, 11, '2018-05-13 17:30:37'),
(20, 'Hawaiian Burger', 99, 0, 13, '2018-05-14 14:06:53'),
(21, 'Triple Brownie', 59, 0, 12, '2018-05-14 06:25:12'),
(22, 'All American Burger', 99, 1, 13, '2018-05-14 14:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `table_order_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_table`
--

CREATE TABLE `transaction_table` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_quantity` int(11) NOT NULL,
  `menu_price_single` float NOT NULL,
  `transaction_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'samuel', '1234', 0, 'Samuel', 'Quinto', '2018-05-13 14:11:26'),
(2, 'jan', '1234', 0, 'Jan Darwin', 'Reyes', '2018-05-13 14:24:13');

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
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`table_order_id`);

--
-- Indexes for table `transaction_table`
--
ALTER TABLE `transaction_table`
  ADD PRIMARY KEY (`transaction_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `dtr_table`
--
ALTER TABLE `dtr_table`
  MODIFY `log_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inventory_table`
--
ALTER TABLE `inventory_table`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_table`
--
ALTER TABLE `menu_table`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `table_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
--
-- AUTO_INCREMENT for table `transaction_table`
--
ALTER TABLE `transaction_table`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
