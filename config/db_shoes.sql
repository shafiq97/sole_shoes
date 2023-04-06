-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2022 at 06:43 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_parent` int(11) DEFAULT NULL,
  `category_status` int(1) NOT NULL,
  `category_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_deleted_at` datetime DEFAULT NULL,
  `category_created_by` int(11) DEFAULT NULL,
  `category_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `shoes_id` int(11) NOT NULL,
  `shoes_name` varchar(255) NOT NULL,
  `shoes_category_id` int(11) NOT NULL,
  `shoes_image` varchar(255) NOT NULL,
  `shoes_description` text NOT NULL,
  `shoes_status` int(1) NOT NULL,
  `shoes_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shoes_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shoes_deleted_at` datetime DEFAULT NULL,
  `shoes_created_by` int(11) DEFAULT NULL,
  `shoes_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shoes_detail`
--

CREATE TABLE `shoes_detail` (
  `shoes_detail_id` int(11) NOT NULL,
  `shoes_detail_shoes_id` int(11) NOT NULL,
  `shoes_detail_variation_color_id` int(11) NOT NULL,
  `shoes_detail_variation_size_id` int(11) NOT NULL,
  `shoes_detail_quantity` int(11) NOT NULL,
  `shoes_detail_price` float(10,2) NOT NULL,
  `shoes_detail_status` int(1) NOT NULL,
  `shoes_detail_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shoes_detail_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shoes_detail_deleted_at` datetime DEFAULT NULL,
  `shoes_detail_created_by` int(11) DEFAULT NULL,
  `shoes_detail_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(14) DEFAULT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_status` int(1) NOT NULL,
  `user_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `user_cart_id` int(11) NOT NULL,
  `user_cart_user_id` int(11) NOT NULL,
  `user_cart_shoes_detail_id` int(11) NOT NULL,
  `user_cart_quantity` int(11) NOT NULL,
  `user_cart_status` int(1) NOT NULL,
  `user_cart_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_cart_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_cart_deleted_at` datetime DEFAULT NULL,
  `user_cart_created_by` int(11) DEFAULT NULL,
  `user_cart_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL,
  `user_log_ip` varchar(255) NOT NULL,
  `user_log_browser` varchar(255) DEFAULT NULL,
  `user_log_os` varchar(255) DEFAULT NULL,
  `user_log_device` varchar(255) DEFAULT NULL,
  `user_log_country` varchar(255) DEFAULT NULL,
  `user_log_city` varchar(255) DEFAULT NULL,
  `user_log_latitude` varchar(255) DEFAULT NULL,
  `user_log_longitude` varchar(255) DEFAULT NULL,
  `user_log_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `variation`
--

CREATE TABLE `variation` (
  `variation_id` int(11) NOT NULL,
  `variation_name` varchar(255) NOT NULL,
  `variation_type` int(1) NOT NULL,
  `variation_status` int(1) NOT NULL,
  `variation_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `variation_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `variation_deleted_at` datetime DEFAULT NULL,
  `variation_created_by` int(11) DEFAULT NULL,
  `variation_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_created_by` (`category_created_by`),
  ADD KEY `category_deleted_by` (`category_deleted_by`),
  ADD KEY `category_parent` (`category_parent`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`shoes_id`),
  ADD KEY `shoes_created_by` (`shoes_created_by`),
  ADD KEY `shoes_deleted_by` (`shoes_deleted_by`);

--
-- Indexes for table `shoes_detail`
--
ALTER TABLE `shoes_detail`
  ADD PRIMARY KEY (`shoes_detail_id`),
  ADD KEY `shoes_detail_shoes_id` (`shoes_detail_shoes_id`),
  ADD KEY `shoes_detail_variation_color_id` (`shoes_detail_variation_color_id`),
  ADD KEY `shoes_detail_variation_size_id` (`shoes_detail_variation_size_id`),
  ADD KEY `shoes_detail_created_by` (`shoes_detail_created_by`),
  ADD KEY `shoes_detail_deleted_by` (`shoes_detail_deleted_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`user_cart_id`),
  ADD KEY `user_cart_user_id` (`user_cart_user_id`),
  ADD KEY `user_cart_shoes_detail_id` (`user_cart_shoes_detail_id`),
  ADD KEY `user_cart_created_by` (`user_cart_created_by`),
  ADD KEY `user_cart_deleted_by` (`user_cart_deleted_by`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`user_log_id`);

--
-- Indexes for table `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`variation_id`),
  ADD KEY `variation_created_by` (`variation_created_by`),
  ADD KEY `variation_deleted_by` (`variation_deleted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `shoes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoes_detail`
--
ALTER TABLE `shoes_detail`
  MODIFY `shoes_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `user_cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation`
--
ALTER TABLE `variation`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`category_created_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`category_deleted_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_3` FOREIGN KEY (`category_parent`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `shoes`
--
ALTER TABLE `shoes`
  ADD CONSTRAINT `shoes_ibfk_1` FOREIGN KEY (`shoes_created_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shoes_ibfk_2` FOREIGN KEY (`shoes_deleted_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `shoes_detail`
--
ALTER TABLE `shoes_detail`
  ADD CONSTRAINT `shoes_detail_ibfk_1` FOREIGN KEY (`shoes_detail_shoes_id`) REFERENCES `shoes` (`shoes_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shoes_detail_ibfk_2` FOREIGN KEY (`shoes_detail_variation_color_id`) REFERENCES `variation` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shoes_detail_ibfk_3` FOREIGN KEY (`shoes_detail_variation_size_id`) REFERENCES `variation` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shoes_detail_ibfk_4` FOREIGN KEY (`shoes_detail_created_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shoes_detail_ibfk_5` FOREIGN KEY (`shoes_detail_deleted_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_cart_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`user_cart_shoes_detail_id`) REFERENCES `shoes_detail` (`shoes_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_ibfk_3` FOREIGN KEY (`user_cart_created_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_ibfk_4` FOREIGN KEY (`user_cart_deleted_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `variation`
--
ALTER TABLE `variation`
  ADD CONSTRAINT `variation_ibfk_1` FOREIGN KEY (`variation_created_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `variation_ibfk_2` FOREIGN KEY (`variation_deleted_by`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
