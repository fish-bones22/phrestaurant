-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2018 at 12:47 PM
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
(7, 'qwer', '2018-05-13 10:27:16'),
(8, 'asdf', '2018-05-13 10:27:19'),
(9, 'zxcv', '2018-05-13 10:27:23');

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
(7, 'qwer', 12, 116, 7, '2018-05-13 10:44:39');

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
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `transaction_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_table`
--

INSERT INTO `transaction_table` (`transaction_id`, `user_id`, `order_id`, `menu_id`, `transaction_timestamp`) VALUES
(1, 8, 1, 7, '2018-05-13 10:28:45'),
(2, 8, 2, 7, '2018-05-13 10:36:06'),
(3, 8, 3, 7, '2018-05-13 10:37:52'),
(4, 8, 4, 7, '2018-05-13 10:38:31'),
(5, 8, 5, 7, '2018-05-13 10:42:21'),
(6, 8, 6, 7, '2018-05-13 10:44:39');

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
(8, 'asdf', 'asdf', 0, 'asdf', 'asdf', '2018-05-13 10:26:45');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `dtr_table`
--
ALTER TABLE `dtr_table`
  MODIFY `log_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `inventory_table`
--
ALTER TABLE `inventory_table`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_table`
--
ALTER TABLE `menu_table`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `table_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `transaction_table`
--
ALTER TABLE `transaction_table`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
