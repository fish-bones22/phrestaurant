-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2018 at 05:17 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Burger', '2018-05-10 17:35:18'),
(2, 'Fingertips', '2018-05-10 17:35:18'),
(3, 'Pasta', '2018-05-10 17:35:18'),
(4, 'Premium', '2018-05-10 17:35:18'),
(5, 'Healthy', '2018-05-10 17:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `dtr_table`
--

CREATE TABLE `dtr_table` (
  `log_id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_in_timestamp` timestamp NULL DEFAULT NULL,
  `time_out_timestamp` timestamp NULL DEFAULT NULL,
  `logged_in` int(11) NOT NULL
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
  `menu_name` varchar(50) NOT NULL,
  `menu_price` int(11) NOT NULL,
  `menu_quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `menu_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_table`
--

INSERT INTO `menu_table` (`menu_id`, `menu_name`, `menu_price`, `menu_quantity`, `category_id`, `menu_timestamp`) VALUES
(1, 'Burger1', 50, 11, 1, '2018-05-10 17:33:25'),
(2, 'Pasta1', 99, 11, 3, '2018-05-10 17:40:02'),
(3, 'Fingertips', 55, 11, 2, '2018-05-10 17:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `table_order_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`table_order_id`, `order_id`, `menu_id`, `order_quantity`, `order_timestamp`) VALUES
(11, 2, 3, 1, '2018-05-12 15:17:20'),
(12, 2, 2, 1, '2018-05-12 15:17:21'),
(13, 2, 1, 1, '2018-05-12 15:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_table`
--

CREATE TABLE `transaction_table` (
  `transaction_id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `transaction_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_table`
--

INSERT INTO `transaction_table` (`transaction_id`, `user_id`, `order_id`, `transaction_timestamp`) VALUES
(1, 1, '1', '2018-05-12 15:14:09'),
(2, 1, '1', '2018-05-12 15:14:09'),
(3, 1, '1', '2018-05-12 15:15:15'),
(4, 1, '1', '2018-05-12 15:15:15'),
(5, 1, '1', '2018-05-12 15:15:21'),
(6, 1, '1', '2018-05-12 15:15:21'),
(7, 1, '1', '2018-05-12 15:17:16'),
(8, 1, '1', '2018-05-12 15:17:16');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dtr_table`
--
ALTER TABLE `dtr_table`
  MODIFY `log_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventory_table`
--
ALTER TABLE `inventory_table`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_table`
--
ALTER TABLE `menu_table`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `table_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transaction_table`
--
ALTER TABLE `transaction_table`
  MODIFY `transaction_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
