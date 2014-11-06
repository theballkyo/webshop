-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2014 at 05:09 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
`id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '-1',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `is_show` int(1) NOT NULL DEFAULT '1',
  `main_category` int(11) NOT NULL DEFAULT '0'
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
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `ac_id` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `name`, `address`, `email`, `tel`, `note`, `ac_id`) VALUES
(1, 'Sommai Tester', '123 Sommai TH 10000', 'sommai@localhost', '0901230000', 'Created By Admin\r\nEiei', -1),
(2, 'John ชาวไร่', 'ไร่แถวบ้าน', 'john@localhost', '029008000', 'Created by user\r\n#01', 2),
(3, 'tester001', '', '', '', 'Created By Admin', -1),
(4, 'John ชาวนา', '', '', '', 'Created By Admin', -1),
(5, 'John ชาวสวน', 'สวนยาง', '', '', 'Created By Admin', -1),
(11, 'John Ja', '213213', 'sommai@localhost', '0901230000', 'Created By Admin', -1),
(12, 'tan', '', '', '', '', -1),
(13, 'ทดสอบจอง', '', '', '', '', -1),
(14, 'ball', '', '', '', '', -1),
(15, 'Sommai', 'asdas 213 asd 1 sad\r\nasd 21 asd 2 asd', 'asdlk@ff.com', '0213123123', 'efwrewr', -1);

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
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `reserve_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `cus_id`, `reserve_id`, `created_at`, `updated_at`, `type`) VALUES
(1, 4, '20', '2014-11-04 13:10:09', '2014-11-05 16:53:33', 1),
(2, 4, '21,22', '2014-11-04 13:11:08', '0000-00-00 00:00:00', 1),
(3, 5, '23', '2014-11-04 13:12:13', '0000-00-00 00:00:00', 1),
(4, 4, '24', '2014-11-04 13:12:54', '2014-11-05 16:53:24', 2),
(5, 2, '25', '2014-11-04 13:13:24', '2014-11-05 16:43:05', 1),
(6, 4, '26', '2014-11-04 13:13:37', '2014-11-05 13:21:44', 1),
(7, 11, '27', '2014-11-04 13:13:47', '2014-11-05 13:20:58', 1),
(8, 1, '28', '2014-11-04 13:14:17', '2014-11-05 13:20:07', 1),
(9, 2, '17,18,19', '2014-11-05 11:53:16', '2014-11-05 16:52:52', 1),
(10, 1, '20,21,22,23,24,25,26,27', '2014-11-05 12:15:59', '2014-11-05 16:43:20', 1),
(11, 12, '28', '2014-11-05 12:32:38', '2014-11-05 12:32:38', 1),
(12, 13, '29,30,31', '2014-11-05 15:42:19', '2014-11-05 15:42:33', 2),
(13, 14, '32', '2014-11-05 15:57:38', '2014-11-05 15:58:43', 1),
(14, 15, '33,34,35,36', '2014-11-05 16:54:43', '2014-11-05 16:54:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
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
`id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

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
(19, 1, 2, 'XL', NULL),
(20, 1, 2, '24', NULL),
(21, 1, 2, '26', NULL),
(23, 1, 1, 'Yellow', ''),
(24, 1, 2, 'l', NULL),
(25, 1, 2, '38', NULL),
(26, 1, 1, 'Pink', '');

-- --------------------------------------------------------

--
-- Table structure for table `products_detail_fields`
--

DROP TABLE IF EXISTS `products_detail_fields`;
CREATE TABLE IF NOT EXISTS `products_detail_fields` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `type` int(2) NOT NULL
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
`id` int(11) NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `products_reserve`
--

INSERT INTO `products_reserve` (`id`, `cus_id`, `stock_id`, `code_id`, `amount`, `payment`, `sent`, `discount`, `discount_type`, `type`, `created_at`, `updated_at`) VALUES
(17, 2, 1, '1-1-3', 4, 0, 0, 199, 3, 1, '2014-11-05 13:07:26', '2014-09-27 09:58:48'),
(18, 2, 1, '1-1-3', 5, 1, 0, 200, 1, 1, '2014-11-05 16:52:52', '2014-11-05 16:52:52'),
(19, 2, 1, '1-1-3', 2, 0, 0, 0, 0, 1, '2014-11-05 16:52:52', '2014-11-05 16:52:52'),
(20, 1, 1, '1-1-3', 1, 0, 0, 0, 0, 1, '2014-11-05 16:43:20', '2014-11-05 16:43:20'),
(21, 1, 3, '1-1-19', 7, 0, 0, 0, 0, 1, '2014-11-05 16:43:20', '2014-11-05 16:43:20'),
(22, 1, 8, '1-6-4', 2, 0, 0, 0, 0, 1, '2014-11-05 16:43:20', '2014-11-05 16:43:20'),
(23, 1, 16, '1-7-4', 1, 0, 0, 0, 0, 1, '2014-11-05 16:43:20', '2014-11-05 16:43:20'),
(24, 1, 20, '1-7-20', 8, 0, 0, 0, 0, 2, '2014-11-05 16:53:24', '2014-11-05 16:53:24'),
(25, 1, 21, '1-11-20', 21, 0, 0, 0, 0, 1, '2014-11-05 16:43:05', '2014-11-05 16:43:05'),
(26, 1, 32, '1-23-19', 9, 0, 0, 0, 0, 1, '2014-11-05 13:21:44', '2014-11-05 13:21:44'),
(27, 1, 33, '1-23-20', 2, 0, 0, 0, 0, 1, '2014-11-05 13:20:58', '0000-00-00 00:00:00'),
(28, 12, 1, '1-1-3', 1, 0, 0, 0, 0, 1, '2014-11-05 13:20:06', '0000-00-00 00:00:00'),
(29, 13, 1, '1-1-3', 4, 0, 0, 0, 0, 2, '2014-11-05 15:42:33', '2014-11-05 15:42:33'),
(30, 13, 9, '1-6-19', 2, 0, 0, 0, 0, 2, '2014-11-05 15:42:33', '2014-11-05 15:42:33'),
(31, 13, 20, '1-7-20', 2, 0, 0, 0, 0, 2, '2014-11-05 15:42:33', '2014-11-05 15:42:33'),
(32, 14, 10, '1-11-3', 2, 0, 0, 0, 0, 1, '2014-11-05 15:58:43', '2014-11-05 15:58:43'),
(33, 15, 1, '1-1-3', 2, 0, 0, 0, 0, 0, '2014-11-05 16:54:43', '2014-11-05 16:54:43'),
(34, 15, 7, '1-6-3', 2, 0, 0, 0, 0, 0, '2014-11-05 16:54:43', '2014-11-05 16:54:43'),
(35, 15, 15, '1-7-3', 2, 0, 0, 0, 0, 0, '2014-11-05 16:54:43', '2014-11-05 16:54:43'),
(36, 15, 16, '1-7-4', 2, 0, 0, 0, 0, 0, '2014-11-05 16:54:43', '2014-11-05 16:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `products_reserve_cancel`
--

DROP TABLE IF EXISTS `products_reserve_cancel`;
CREATE TABLE IF NOT EXISTS `products_reserve_cancel` (
`id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `code_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT '0',
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
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
`id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `show` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Dumping data for table `products_stock`
--

INSERT INTO `products_stock` (`id`, `code`, `stock`, `show`, `price`, `pid`) VALUES
(1, '1-1-3', 8, 1, 299, 1),
(2, '1-1-4', 2, 1, 0, 1),
(3, '1-1-19', 2, 0, 250, 1),
(4, '1-14-3', 0, 0, 0, 1),
(5, '1-14-4', 0, 0, 0, 1),
(6, '1-14-19', 0, 0, 0, 1),
(7, '1-6-3', 4, 1, 0, 1),
(8, '1-6-4', 3, 1, 0, 1),
(9, '1-6-19', -2, 1, 0, 1),
(10, '1-11-3', 3, 0, 0, 1),
(11, '1-11-4', 3, 0, 0, 1),
(12, '1-11-19', 3, 0, 0, 1),
(13, '2-2-5', 3, 0, 0, 2),
(14, '2-2-17', 0, 0, 0, 2),
(15, '1-7-3', 5, 0, 0, 1),
(16, '1-7-4', 5, 0, 0, 1),
(17, '1-7-19', 6, 0, 0, 1),
(18, '1-1-20', 2, 0, 0, 1),
(19, '1-6-20', 0, 0, 0, 1),
(20, '1-7-20', 3, 0, 0, 1),
(21, '1-11-20', 3, 0, 0, 1),
(22, '1-1-21', 2, 0, 0, 1),
(23, '1-6-21', 0, 0, 0, 1),
(24, '1-7-21', 3, 0, 0, 1),
(25, '1-11-21', 3, 0, 0, 1),
(26, '1-1-22', 0, 0, 0, 1),
(27, '1-6-22', 0, 0, 0, 1),
(28, '1-7-22', 0, 0, 0, 1),
(29, '1-11-22', 0, 0, 0, 1),
(30, '1-23-3', 3, 0, 0, 1),
(31, '1-23-4', 3, 0, 0, 1),
(32, '1-23-19', 3, 0, 0, 1),
(33, '1-23-20', 3, 0, 0, 1),
(34, '1-23-21', 3, 0, 0, 1),
(35, '1-23-22', 0, 0, 0, 1),
(36, '1-1-24', 2, 0, 0, 1),
(37, '1-6-24', 0, 0, 0, 1),
(38, '1-7-24', 3, 0, 0, 1),
(39, '1-23-24', 3, 0, 0, 1),
(40, '1-11-24', 3, 0, 0, 1),
(41, '1-1-25', 2, 0, 0, 1),
(42, '1-6-25', 0, 0, 0, 1),
(43, '1-7-25', 3, 0, 0, 1),
(44, '1-11-25', 3, 0, 0, 1),
(45, '1-23-25', 3, 0, 0, 1),
(46, '1-26-3', 3, 0, 0, 1),
(47, '1-26-4', 3, 0, 0, 1),
(48, '1-26-19', 3, 0, 0, 1),
(49, '1-26-20', 3, 0, 0, 1),
(50, '1-26-21', 3, 0, 0, 1),
(51, '1-26-24', 3, 0, 0, 1),
(52, '1-26-25', 3, 0, 0, 1),
(53, '2-12-5', 0, 0, 0, 2),
(54, '2-12-17', 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
('30f6535d50eb22dbced2b127f27c24e8a999cf9e', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUNUU28yOHdSRTNCOUlFWm9FVW9vTndxeFkwZnRQWWVvZzJUMmVLdCI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQxNTE5MDQyMjtzOjE6ImMiO2k6MTQxNTE5MDQyMjtzOjE6ImwiO3M6MToiMCI7fX0=', 1415190422),
('90f1fe8b052970deaeb8b8fe693d63aae3ae65a4', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWkcwbGN6NWdSMmRtSjJiRTRkZnJ0VmRnMTZyWjR2Y1RoekRVaXprYiI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YToxOntpOjA7czo1OiJlcnJvciI7fXM6MzoibmV3IjthOjA6e319czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO2k6MjtzOjU6ImVycm9yIjthOjE6e3M6MzoibXNnIjthOjI6e2k6MDtzOjEwOiJkZXZlbG9wZXJzIjtpOjE7czoxMToiZGV2ZWxvcGVyczIiO319czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTUxODQ5MzU7czoxOiJjIjtpOjE0MTUxODQ5Mjk7czoxOiJsIjtzOjE6IjAiO319', 1415184935),
('e67a30adb3f4a584d528390d1418701418bc70e5', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSU9GUEt2QnprWkRJYUNFd0dzcGZzUmxvR0VyVWdUNXJsMEh4cG1meiI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQxNTIwODk2NztzOjE6ImMiO2k6MTQxNTE3NTUyOTtzOjE6ImwiO3M6MToiMCI7fX0=', 1415208967);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(4096) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `uid`, `name`, `address`, `note`) VALUES
(1, 3, 'Testter', 'No Address', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_category_id` (`category_id`);

--
-- Indexes for table `products_detail_data`
--
ALTER TABLE `products_detail_data`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_detail_fields`
--
ALTER TABLE `products_detail_fields`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_reserve`
--
ALTER TABLE `products_reserve`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_reserve_cancel`
--
ALTER TABLE `products_reserve_cancel`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_stock`
--
ALTER TABLE `products_stock`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
 ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products_detail_data`
--
ALTER TABLE `products_detail_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `products_detail_fields`
--
ALTER TABLE `products_detail_fields`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products_reserve`
--
ALTER TABLE `products_reserve`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `products_reserve_cancel`
--
ALTER TABLE `products_reserve_cancel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products_stock`
--
ALTER TABLE `products_stock`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
