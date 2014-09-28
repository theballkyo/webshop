-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2014 at 06:02 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '-1',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `status`, `remember_token`) VALUES
(1, 'addasd', 'admin@127.0.0.1', '$2y$10$FK1YJNrHTF.b6A8MrZkOIOxdZrEziuspNlK.XgYqAhLj17l85aswO', 2, ''),
(2, 'test', 'test@test.com', '$2y$10$C76OIUiJ9QEtfMzIGjLsRe2lqtS2dLwhvuaDCP8p9eCCPDuFP0lfO', 1, 'GJeDA66gzc02Y1Bt0bhDjWL1oyKtpM8LuZv6WeCJQcmYenqWrgzUbR5UvWzH'),
(3, 'test01', 'test01@test.com', '$2y$10$fD4IfiDtIAzKTbq6UzypYOKzNxjqt4uT7e6nnSoF1UmQxt3cUmuea', 2, 'ndGbjyZQm00nYk7OHmaI4t93HWqzxtoDkJjJF1V6EpUOJHnj3k8YLr5QdAGQ'),
(4, 'test02', 'test2@test.com', '$2y$10$gE/PxrGO0WY3KQh2oXAGCO4QwRPNtYp.w.V20NarER2OLAF0QFS.i', 2, 'dq6xADbGV3rA4ztjbnaerXmPSlouFyd7kQoNaWU2GvEDlpkt0sfMOUuIUnTH'),
(12, '', '', '$2y$10$Zm5LbZfwAaJVtYRc6GRti.hDGz3m5iCJKBubyKDfsdZDWIPWCNgB6', 2, '3auln91R54Pu8W7qDoCpCH7DBIYFyeZ8zvSeS30amEY0QvnonrRSxSIlhRZe');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `is_show` int(1) NOT NULL DEFAULT '1',
  `main_category` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `priority`, `is_show`, `main_category`) VALUES
(1, 'ทดสอบ Category', 'ทดสอบเฉยๆ', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

DROP TABLE IF EXISTS `customer_profile`;
CREATE TABLE IF NOT EXISTS `customer_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `ac_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `name`, `address`, `email`, `tel`, `note`, `ac_id`) VALUES
(1, 'Sommai Tester', '123 Sommai TH 10000', 'sommai@localhost', '0901230000', 'Created By Admin\r\nEiei', -1),
(2, 'John ชาวไร่', 'ไร่แถวบ้าน', 'john@localhost', '029008000', 'Created by user\r\n#01', 2),
(3, 'tester001', '', '', '', 'Created By Admin', -1),
(4, 'John ชาวนา', '', '', '', 'Created By Admin', -1),
(5, 'John ชาวสวน', 'สวนยาง', '', '', 'Created By Admin', -1),
(11, 'John Ja', '213213', 'sommai@localhost', '0901230000', 'Created By Admin', -1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_09_26_165916_create_session_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`) VALUES
(1, 'กางเกง Sommai', 'นี่คือกางเกงโว้ยยยยย', 1),
(2, 'test00002', 'test test test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_detail_data`
--

DROP TABLE IF EXISTS `products_detail_data`;
CREATE TABLE IF NOT EXISTS `products_detail_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products_detail_data`
--

INSERT INTO `products_detail_data` (`id`, `pid`, `fid`, `text`, `imgurl`) VALUES
(1, 1, 1, 'White', NULL),
(2, 2, 1, 'Black', NULL),
(3, 1, 2, 'S', NULL),
(4, 1, 2, 'M', NULL),
(5, 2, 2, 'L', NULL),
(6, 1, 1, 'Blank', NULL),
(7, 1, 1, 'Red', NULL),
(11, 1, 1, 'Blue', NULL),
(12, 2, 1, 'White', NULL),
(17, 2, 2, 'XL', NULL),
(19, 1, 2, 'XL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_detail_fields`
--

DROP TABLE IF EXISTS `products_detail_fields`;
CREATE TABLE IF NOT EXISTS `products_detail_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products_detail_fields`
--

INSERT INTO `products_detail_fields` (`id`, `name`, `pid`, `type`) VALUES
(1, 'color', 0, 0),
(2, 'size', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_reserve`
--

DROP TABLE IF EXISTS `products_reserve`;
CREATE TABLE IF NOT EXISTS `products_reserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `code_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `payment` tinyint(1) DEFAULT '0',
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `products_reserve`
--

INSERT INTO `products_reserve` (`id`, `cus_id`, `stock_id`, `code_id`, `amount`, `payment`, `sent`, `discount`, `discount_type`, `type`, `created_at`, `updated_at`) VALUES
(17, 2, 1, '1-1-3', 4, 0, 0, 199, 3, 0, '2014-09-27 16:58:48', '2014-09-27 09:58:48'),
(18, 2, 1, '1-1-3', 5, 1, 0, 200, 1, 0, '2014-09-27 16:57:36', '2014-09-27 09:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `products_reserve_cancel`
--

DROP TABLE IF EXISTS `products_reserve_cancel`;
CREATE TABLE IF NOT EXISTS `products_reserve_cancel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL,
  `code_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT '0',
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products_reserve_cancel`
--

INSERT INTO `products_reserve_cancel` (`id`, `cus_id`, `code_id`, `amount`, `price`, `discount`, `discount_type`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 2, '1-1-3', 0, 0, 0, 0, 0, '2014-09-27 03:15:14', '2014-09-27 03:15:14'),
(2, 2, '1-1-3', 0, 0, 0, 0, 0, '2014-09-27 03:15:31', '2014-09-27 03:15:31'),
(3, 2, '1-1-3', 1, 0, 0, 0, 0, '2014-09-27 03:19:38', '2014-09-27 03:19:38'),
(4, 2, '1-1-3', 2, 299, 0, 0, 0, '2014-09-27 03:24:18', '2014-09-27 03:24:18'),
(5, 2, '1-1-3', 1, 299, 0, 0, 0, '2014-09-27 03:28:33', '2014-09-27 03:28:33'),
(6, 11, '1-1-3', 1, 299, 0, 0, 0, '2014-09-27 03:29:31', '2014-09-27 03:29:31'),
(7, 2, '1-1-3', 1, 299, 0, 0, 0, '2014-09-27 03:30:08', '2014-09-27 03:30:08'),
(8, 2, '1-1-3', 2, 299, 20, 1, 0, '2014-09-27 03:31:13', '2014-09-27 03:31:13'),
(9, 2, '1-1-3', 1, 299, 20, 2, 0, '2014-09-27 09:58:51', '2014-09-27 09:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `products_stock`
--

DROP TABLE IF EXISTS `products_stock`;
CREATE TABLE IF NOT EXISTS `products_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `show` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products_stock`
--

INSERT INTO `products_stock` (`id`, `code`, `stock`, `show`, `price`, `pid`) VALUES
(1, '1-1-3', 12, 1, 299, 1),
(2, '1-1-4', 0, 1, 0, 1),
(3, '1-1-19', 0, 0, 0, 1),
(4, '1-14-3', 0, 0, 0, 1),
(5, '1-14-4', 0, 0, 0, 1),
(6, '1-14-19', 0, 0, 0, 1),
(7, '1-6-3', 0, 1, 0, 1),
(8, '1-6-4', 0, 1, 0, 1),
(9, '1-6-19', 0, 1, 0, 1),
(10, '1-11-3', 0, 0, 0, 1),
(11, '1-11-4', 0, 0, 0, 1),
(12, '1-11-19', 0, 0, 0, 1),
(13, '2-2-5', 0, 0, 0, 2),
(14, '2-2-17', 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
('ad91a349a84d1f7c03ebabfb05a3734dd007b9f6', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiclN6SzdmWHFBT2pSTjB2SndZTTBjV2ZnVFFRdlZ2bG5nVVFMd01kYiI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7aToyO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDExODM3MTMyO3M6MToiYyI7aToxNDExODMxMTgzO3M6MToibCI7czoxOiIwIjt9fQ==', 1411837132),
('e8f60fbcf977b6e7f4d669aaf30d1b84f7f69f70', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWkdXbVRyYVBYejlzN2VVeXRnZjFYQ3haRGVwMWx1dlJQcHM2SDhIcCI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7aToyO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDExODEzOTA3O3M6MToiYyI7aToxNDExODA4MDk0O3M6MToibCI7czoxOiIwIjt9fQ==', 1411813908);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `uid`, `name`, `address`, `note`) VALUES
(1, 3, 'Testter', 'No Address', 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
