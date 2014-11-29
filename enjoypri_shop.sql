-- phpMyAdmin SQL Dump
-- version 4.2.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2014 at 08:40 AM
-- Server version: 5.6.16-cll-lve
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enjoypri_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '-1',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `status`, `remember_token`) VALUES
(1, 'addasd', 'admin@127.0.0.1', '$2y$10$FK1YJNrHTF.b6A8MrZkOIOxdZrEziuspNlK.XgYqAhLj17l85aswO', 2, ''),
(2, 'test', 'test@test.com', '$2y$10$C76OIUiJ9QEtfMzIGjLsRe2lqtS2dLwhvuaDCP8p9eCCPDuFP0lfO', 1, 'Sc62ZWmv7xwXc5jG98pXlUiJS61R0tilS5NPakbGLugcROh2OUfjQVKWuF5v'),
(3, 'test01', 'test01@test.com', '$2y$10$fD4IfiDtIAzKTbq6UzypYOKzNxjqt4uT7e6nnSoF1UmQxt3cUmuea', 2, 'ndGbjyZQm00nYk7OHmaI4t93HWqzxtoDkJjJF1V6EpUOJHnj3k8YLr5QdAGQ'),
(4, 'test02', 'test2@test.com', '$2y$10$gE/PxrGO0WY3KQh2oXAGCO4QwRPNtYp.w.V20NarER2OLAF0QFS.i', 2, 'dq6xADbGV3rA4ztjbnaerXmPSlouFyd7kQoNaWU2GvEDlpkt0sfMOUuIUnTH'),
(12, '', '', '$2y$10$Zm5LbZfwAaJVtYRc6GRti.hDGz3m5iCJKBubyKDfsdZDWIPWCNgB6', 2, '3auln91R54Pu8W7qDoCpCH7DBIYFyeZ8zvSeS30amEY0QvnonrRSxSIlhRZe');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `is_show` int(1) NOT NULL DEFAULT '1',
  `main_category` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `priority`, `is_show`, `main_category`) VALUES
(1, 'ทดสอบ Category', 'ทดสอบเฉยๆ', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE IF NOT EXISTS `customer_profile` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `ac_id` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(14, 'ball', 'dssdsdfdsf\r\nqdsd', '', '', '', -1),
(15, 'Sommai', 'asdas 213 asd 1 sad\r\nasd 21 asd 2 asd', 'asdlk@ff.com', '0213123123', 'efwrewr', -1),
(16, 'test', '', '', '', '', -1),
(17, 'ทดสอบที่มา', 'test\r\n ทดสอบ', '', '', '', -1),
(18, 'ทดสอบ ที่มา แก้บัค', '', '', '', '', -1),
(19, 'ทดสอบ SKU', '', '', '', '', -1),
(20, 'Sommai', 'ทดสอบจอง\r\nทดสอบ\r\nทดสอบ', '', '', '', -1),
(21, 'ทดสอบ2', '', '', '', '', -1),
(22, 'ทดสอบ Cancel', 'sad', 'asdasd@test.com', '021234567', 'sadsad', -1),
(23, 'ทดสอบ 3', 'Tester3', '', '', '', -1),
(24, 'tester1', 'ทดสอบแก้ที่อยู่ #1', 'ttt@t.com', '021231231', 'test', -1),
(25, 'Sommai1', '', '', '', '', -1),
(26, 'twes', '', '', '', '', -1),
(27, 'ทดลองลบ', '', '', '', '', -1),
(28, 'test', '', '', '', '', -1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

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

CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `reserve_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `cus_id`, `reserve_id`, `source`, `created_at`, `updated_at`, `type`) VALUES
(1, 20, '1', 'Line', '2014-11-11 07:12:50', '2014-11-11 07:15:22', 3),
(2, 21, '2,3,4,5', 'สมหมาย', '2014-11-11 07:13:30', '2014-11-11 07:15:22', 3),
(3, 22, '6,7,8', 'ขายกางเกง', '2014-11-11 07:14:03', '2014-11-11 07:14:42', 2),
(4, 23, '9,10', 'Web', '2014-11-11 07:14:34', '2014-11-11 18:23:52', 3),
(5, 24, '11,27,28,29,30', 'Line', '2014-11-11 07:23:39', '2014-11-18 06:46:16', 0),
(6, 25, '13,14,15,16,17', 'สมหมาย', '2014-11-11 18:32:17', '2014-11-18 11:57:22', 3),
(7, 26, '18', 'Line', '2014-11-17 16:13:46', '2014-11-24 20:25:26', 2),
(8, 27, '', 'Line', '2014-11-18 05:46:28', '2014-11-18 06:44:30', 0),
(9, 28, '31,32', 'Line', '2014-11-18 08:22:38', '2014-11-18 08:22:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `print_log`
--

CREATE TABLE IF NOT EXISTS `print_log` (
`id` int(11) NOT NULL,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `print_log`
--

INSERT INTO `print_log` (`id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, '1,2', '2014-11-11 07:15:22', '2014-11-11 07:15:22'),
(2, '4', '2014-11-11 18:23:52', '2014-11-11 18:23:52'),
(3, '6', '2014-11-18 11:57:22', '2014-11-18 11:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE IF NOT EXISTS `products_detail_data` (
`id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products_detail_data`
--

INSERT INTO `products_detail_data` (`id`, `pid`, `fid`, `text`, `imgurl`, `code`) VALUES
(27, 1, 2, '28', NULL, '0'),
(28, 1, 2, '30', NULL, '0'),
(29, 1, 2, '32', NULL, '0'),
(30, 1, 2, '34', NULL, '0'),
(31, 1, 2, '36', NULL, '0'),
(32, 1, 2, '38', NULL, '0'),
(33, 1, 2, '40', NULL, '0'),
(34, 1, 2, '42', NULL, '0'),
(35, 1, 1, '01ครีม', '', '01'),
(36, 1, 1, '02กากี', '', '02'),
(37, 1, 1, '03-อิฐ', '', '03'),
(38, 1, 1, '04-เหลือง', '', '04'),
(39, 1, 1, '05-เลือดหมู', '', '05'),
(40, 1, 1, '06-น้ำเงิน', '', '06'),
(41, 1, 1, '07-ทะเล', '', '07'),
(42, 1, 1, '08-กรม', '', '08'),
(43, 1, 1, '09-เทาอ่อน', '', '09'),
(44, 1, 1, '10-เทาเข้ม', '', '10'),
(45, 1, 1, '11-ขาวเทา', '', '11'),
(46, 1, 1, '12-น้ำตาล', '', '12'),
(47, 1, 1, '13-ขี้ม้า', '', '13'),
(48, 1, 1, '14-ทหาร', '', '14'),
(49, 1, 1, '15-เทาดำ', '', '15'),
(50, 1, 1, '16-เทาควัน', '', '16'),
(51, 1, 1, '17-แดง', '', '17'),
(52, 1, 1, '18-มิ้น', '', '18'),
(53, 1, 1, '19-ทะเลอ่อน', '', '19'),
(54, 1, 1, '20-ทหารเขียว', '', '20'),
(55, 1, 1, '21-ชมพู', '', '21'),
(56, 1, 1, '22-ขาว', '', '22');

-- --------------------------------------------------------

--
-- Table structure for table `products_detail_fields`
--

CREATE TABLE IF NOT EXISTS `products_detail_fields` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `type` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products_reserve`
--

INSERT INTO `products_reserve` (`id`, `cus_id`, `stock_id`, `code_id`, `amount`, `payment`, `sent`, `discount`, `discount_type`, `type`, `created_at`, `updated_at`) VALUES
(1, 20, 1, '1-35-27', 2, 0, 0, 0, 0, 1, '2014-11-11 07:15:19', '2014-11-11 07:15:19'),
(2, 21, 2, '1-35-28', 2, 0, 0, 0, 0, 1, '2014-11-11 07:15:18', '2014-11-11 07:15:18'),
(3, 21, 4, '1-35-30', 2, 0, 0, 0, 0, 1, '2014-11-11 07:15:18', '2014-11-11 07:15:18'),
(4, 21, 6, '1-35-32', 1, 0, 0, 0, 0, 1, '2014-11-11 07:15:18', '2014-11-11 07:15:18'),
(5, 21, 11, '1-36-29', 1, 0, 0, 0, 0, 1, '2014-11-11 07:15:18', '2014-11-11 07:15:18'),
(6, 22, 5, '1-35-31', 1, 0, 0, 0, 0, 2, '2014-11-11 07:14:42', '2014-11-11 07:14:42'),
(7, 22, 11, '1-36-29', 3, 0, 0, 0, 0, 2, '2014-11-11 07:14:42', '2014-11-11 07:14:42'),
(8, 22, 18, '1-37-28', 2, 0, 0, 0, 0, 2, '2014-11-11 07:14:42', '2014-11-11 07:14:42'),
(9, 23, 9, '1-36-27', 2, 0, 0, 0, 0, 1, '2014-11-11 07:16:47', '2014-11-11 07:16:47'),
(10, 23, 10, '1-36-28', 2, 0, 0, 0, 0, 1, '2014-11-11 07:16:47', '2014-11-11 07:16:47'),
(11, 24, 3, '1-35-29', 2, 0, 0, 0, 0, 0, '2014-11-11 07:23:39', '2014-11-11 07:23:39'),
(12, 24, 1, '1-35-27', 1, 0, 0, 0, 0, 0, '2014-11-11 18:19:50', '2014-11-11 18:19:50'),
(13, 25, 1, '1-35-27', 2, 0, 0, 0, 0, 1, '2014-11-11 18:32:26', '2014-11-11 18:32:26'),
(14, 25, 2, '1-35-28', 1, 0, 0, 0, 0, 1, '2014-11-11 18:32:26', '2014-11-11 18:32:26'),
(15, 25, 9, '1-36-27', 2, 0, 0, 0, 0, 1, '2014-11-11 18:32:26', '2014-11-11 18:32:26'),
(16, 25, 10, '1-36-28', 3, 0, 0, 0, 0, 1, '2014-11-11 18:32:26', '2014-11-11 18:32:26'),
(17, 25, 11, '1-36-29', 4, 0, 0, 0, 0, 1, '2014-11-11 18:32:26', '2014-11-11 18:32:26'),
(18, 26, 18, '1-37-28', 1, 0, 0, 0, 0, 2, '2014-11-24 20:25:26', '2014-11-24 20:25:26'),
(19, 27, 1, '1-35-27', 1, 0, 0, 0, 0, 0, '2014-11-18 05:46:28', '2014-11-18 05:46:28'),
(20, 27, 2, '1-35-28', 1, 0, 0, 0, 0, 0, '2014-11-18 05:46:28', '2014-11-18 05:46:28'),
(21, 27, 3, '1-35-29', 1, 0, 0, 0, 0, 0, '2014-11-18 05:46:28', '2014-11-18 05:46:28'),
(22, 27, 4, '1-35-30', 1, 0, 0, 0, 0, 0, '2014-11-18 05:46:28', '2014-11-18 05:46:28'),
(23, 27, 6, '1-35-32', 1, 0, 0, 0, 0, 0, '2014-11-18 05:46:28', '2014-11-18 05:46:28'),
(24, 27, 7, '1-35-33', 1, 0, 0, 0, 0, 0, '2014-11-18 05:46:28', '2014-11-18 05:46:28'),
(25, 27, 8, '1-35-34', 1, 0, 0, 0, 0, 0, '2014-11-18 05:46:28', '2014-11-18 05:46:28'),
(26, 27, 2, '1-35-28', 3, 0, 0, 0, 0, 2, '2014-11-18 06:44:30', '2014-11-18 06:44:30'),
(27, 24, 9, '1-36-27', 1, 0, 0, 0, 0, 0, '2014-11-18 06:46:15', '2014-11-18 06:46:15'),
(28, 24, 12, '1-36-30', 2, 0, 0, 0, 0, 0, '2014-11-18 06:46:15', '2014-11-18 06:46:15'),
(29, 24, 9, '1-36-27', 1, 0, 0, 0, 0, 0, '2014-11-18 06:46:16', '2014-11-18 06:46:16'),
(30, 24, 12, '1-36-30', 2, 0, 0, 0, 0, 0, '2014-11-18 06:46:16', '2014-11-18 06:46:16'),
(31, 28, 28, '1-38-30', 1, 0, 0, 0, 0, 0, '2014-11-18 08:22:38', '2014-11-18 08:22:38'),
(32, 28, 60, '1-42-30', 1, 0, 0, 0, 0, 0, '2014-11-18 08:22:38', '2014-11-18 08:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `products_reserve_cancel`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE IF NOT EXISTS `products_stock` (
`id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `show` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products_stock`
--

INSERT INTO `products_stock` (`id`, `code`, `stock`, `show`, `price`, `pid`) VALUES
(1, '1-35-27', 6, 0, 20, 1),
(2, '1-35-28', 6, 0, 0, 1),
(3, '1-35-29', 7, 0, 0, 1),
(4, '1-35-30', 7, 0, 0, 1),
(5, '1-35-31', 9, 0, 0, 1),
(6, '1-35-32', 8, 0, 0, 1),
(7, '1-35-33', 9, 0, 0, 1),
(8, '1-35-34', 9, 0, 0, 1),
(9, '1-36-27', 4, 0, 0, 1),
(10, '1-36-28', 5, 0, 0, 1),
(11, '1-36-29', 2, 0, 0, 1),
(12, '1-36-30', 6, 0, 0, 1),
(13, '1-36-31', 10, 0, 0, 1),
(14, '1-36-32', 10, 0, 0, 1),
(15, '1-36-33', 10, 0, 0, 1),
(16, '1-36-34', 10, 0, 0, 1),
(17, '1-37-27', 10, 0, 0, 1),
(18, '1-37-28', 7, 0, 0, 1),
(19, '1-37-29', 0, 0, 0, 1),
(20, '1-37-30', 0, 0, 0, 1),
(21, '1-37-31', 0, 0, 0, 1),
(22, '1-37-32', 0, 0, 0, 1),
(23, '1-37-33', 0, 0, 0, 1),
(24, '1-37-34', 0, 0, 0, 1),
(25, '1-38-27', 0, 0, 0, 1),
(26, '1-38-28', 0, 0, 0, 1),
(27, '1-38-29', 0, 0, 0, 1),
(28, '1-38-30', -1, 0, 0, 1),
(29, '1-38-31', 0, 0, 0, 1),
(30, '1-38-32', 0, 0, 0, 1),
(31, '1-38-33', 0, 0, 0, 1),
(32, '1-38-34', 0, 0, 0, 1),
(33, '1-39-27', 0, 0, 0, 1),
(34, '1-39-28', 0, 0, 0, 1),
(35, '1-39-29', 0, 0, 0, 1),
(36, '1-39-30', 0, 0, 0, 1),
(37, '1-39-31', 0, 0, 0, 1),
(38, '1-39-32', 0, 0, 0, 1),
(39, '1-39-33', 0, 0, 0, 1),
(40, '1-39-34', 0, 0, 0, 1),
(41, '1-40-27', 0, 0, 0, 1),
(42, '1-40-28', 0, 0, 0, 1),
(43, '1-40-29', 0, 0, 0, 1),
(44, '1-40-30', 0, 0, 0, 1),
(45, '1-40-31', 0, 0, 0, 1),
(46, '1-40-32', 0, 0, 0, 1),
(47, '1-40-33', 0, 0, 0, 1),
(48, '1-40-34', 0, 0, 0, 1),
(49, '1-41-27', 0, 0, 0, 1),
(50, '1-41-28', 0, 0, 0, 1),
(51, '1-41-29', 0, 0, 0, 1),
(52, '1-41-30', 0, 0, 0, 1),
(53, '1-41-31', 0, 0, 0, 1),
(54, '1-41-32', 0, 0, 0, 1),
(55, '1-41-33', 0, 0, 0, 1),
(56, '1-41-34', 0, 0, 0, 1),
(57, '1-42-27', 0, 0, 0, 1),
(58, '1-42-28', 0, 0, 0, 1),
(59, '1-42-29', 0, 0, 0, 1),
(60, '1-42-30', -1, 0, 0, 1),
(61, '1-42-31', 0, 0, 0, 1),
(62, '1-42-32', 0, 0, 0, 1),
(63, '1-42-33', 0, 0, 0, 1),
(64, '1-42-34', 0, 0, 0, 1),
(65, '1-43-27', 0, 0, 0, 1),
(66, '1-43-28', 0, 0, 0, 1),
(67, '1-43-29', 0, 0, 0, 1),
(68, '1-43-30', 0, 0, 0, 1),
(69, '1-43-31', 0, 0, 0, 1),
(70, '1-43-32', 0, 0, 0, 1),
(71, '1-43-33', 0, 0, 0, 1),
(72, '1-43-34', 0, 0, 0, 1),
(73, '1-44-27', 0, 0, 0, 1),
(74, '1-44-28', 0, 0, 0, 1),
(75, '1-44-29', 0, 0, 0, 1),
(76, '1-44-30', 0, 0, 0, 1),
(77, '1-44-31', 0, 0, 0, 1),
(78, '1-44-32', 0, 0, 0, 1),
(79, '1-44-33', 0, 0, 0, 1),
(80, '1-44-34', 0, 0, 0, 1),
(81, '1-45-27', 0, 0, 0, 1),
(82, '1-45-28', 0, 0, 0, 1),
(83, '1-45-29', 0, 0, 0, 1),
(84, '1-45-30', 0, 0, 0, 1),
(85, '1-45-31', 0, 0, 0, 1),
(86, '1-45-32', 0, 0, 0, 1),
(87, '1-45-33', 0, 0, 0, 1),
(88, '1-45-34', 0, 0, 0, 1),
(89, '1-46-27', 0, 0, 0, 1),
(90, '1-46-28', 0, 0, 0, 1),
(91, '1-46-29', 0, 0, 0, 1),
(92, '1-46-30', 0, 0, 0, 1),
(93, '1-46-31', 0, 0, 0, 1),
(94, '1-46-32', 0, 0, 0, 1),
(95, '1-46-33', 0, 0, 0, 1),
(96, '1-46-34', 0, 0, 0, 1),
(97, '1-47-27', 0, 0, 0, 1),
(98, '1-47-28', 0, 0, 0, 1),
(99, '1-47-29', 0, 0, 0, 1),
(100, '1-47-30', 0, 0, 0, 1),
(101, '1-47-31', 0, 0, 0, 1),
(102, '1-47-32', 0, 0, 0, 1),
(103, '1-47-33', 0, 0, 0, 1),
(104, '1-47-34', 0, 0, 0, 1),
(105, '1-48-27', 0, 0, 0, 1),
(106, '1-48-28', 0, 0, 0, 1),
(107, '1-48-29', 0, 0, 0, 1),
(108, '1-48-30', 0, 0, 0, 1),
(109, '1-48-31', 0, 0, 0, 1),
(110, '1-48-32', 0, 0, 0, 1),
(111, '1-48-33', 0, 0, 0, 1),
(112, '1-48-34', 0, 0, 0, 1),
(113, '1-49-27', 0, 0, 0, 1),
(114, '1-49-28', 0, 0, 0, 1),
(115, '1-49-29', 0, 0, 0, 1),
(116, '1-49-30', 0, 0, 0, 1),
(117, '1-49-31', 0, 0, 0, 1),
(118, '1-49-32', 0, 0, 0, 1),
(119, '1-49-33', 0, 0, 0, 1),
(120, '1-49-34', 0, 0, 0, 1),
(121, '1-50-27', 0, 0, 0, 1),
(122, '1-50-28', 0, 0, 0, 1),
(123, '1-50-29', 0, 0, 0, 1),
(124, '1-50-30', 0, 0, 0, 1),
(125, '1-50-31', 0, 0, 0, 1),
(126, '1-50-32', 0, 0, 0, 1),
(127, '1-50-33', 0, 0, 0, 1),
(128, '1-50-34', 0, 0, 0, 1),
(129, '1-51-27', 0, 0, 0, 1),
(130, '1-51-28', 0, 0, 0, 1),
(131, '1-51-29', 0, 0, 0, 1),
(132, '1-51-30', 0, 0, 0, 1),
(133, '1-51-31', 0, 0, 0, 1),
(134, '1-51-32', 0, 0, 0, 1),
(135, '1-51-33', 0, 0, 0, 1),
(136, '1-51-34', 0, 0, 0, 1),
(137, '1-52-27', 0, 0, 0, 1),
(138, '1-52-28', 0, 0, 0, 1),
(139, '1-52-29', 0, 0, 0, 1),
(140, '1-52-30', 0, 0, 0, 1),
(141, '1-52-31', 0, 0, 0, 1),
(142, '1-52-32', 0, 0, 0, 1),
(143, '1-52-33', 0, 0, 0, 1),
(144, '1-52-34', 0, 0, 0, 1),
(145, '1-53-27', 0, 0, 0, 1),
(146, '1-53-28', 0, 0, 0, 1),
(147, '1-53-29', 0, 0, 0, 1),
(148, '1-53-30', 0, 0, 0, 1),
(149, '1-53-31', 0, 0, 0, 1),
(150, '1-53-32', 0, 0, 0, 1),
(151, '1-53-33', 0, 0, 0, 1),
(152, '1-53-34', 0, 0, 0, 1),
(153, '1-54-27', 0, 0, 0, 1),
(154, '1-54-28', 0, 0, 0, 1),
(155, '1-54-29', 0, 0, 0, 1),
(156, '1-54-30', 0, 0, 0, 1),
(157, '1-54-31', 0, 0, 0, 1),
(158, '1-54-32', 0, 0, 0, 1),
(159, '1-54-33', 0, 0, 0, 1),
(160, '1-54-34', 0, 0, 0, 1),
(161, '1-55-27', 0, 0, 0, 1),
(162, '1-55-28', 0, 0, 0, 1),
(163, '1-55-29', 0, 0, 0, 1),
(164, '1-55-30', 0, 0, 0, 1),
(165, '1-55-31', 0, 0, 0, 1),
(166, '1-55-32', 0, 0, 0, 1),
(167, '1-55-33', 0, 0, 0, 1),
(168, '1-55-34', 0, 0, 0, 1),
(169, '1-56-27', 0, 0, 0, 1),
(170, '1-56-28', 0, 0, 0, 1),
(171, '1-56-29', 0, 0, 0, 1),
(172, '1-56-30', 0, 0, 0, 1),
(173, '1-56-31', 0, 0, 0, 1),
(174, '1-56-32', 0, 0, 0, 1),
(175, '1-56-33', 0, 0, 0, 1),
(176, '1-56-34', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
('080a0df88c9e57fd29d700d15dd88772e5a472a1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWFvQWJnRzJFczFJVDF0UlliMHhsS2FTbjE5aHM1akZpbEFTNnZuTiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTcwODc4MjI7czoxOiJjIjtpOjE0MTcwODc4MjI7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1417087822),
('0b4bdfb391583c78d7b6306331e9454ec16fa7b2', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHRudEpWTlB0bUpaNHV6b0JoaHN6Y0JNTXMxYXdlYlUzSmhzbHBsRCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTY3NjcxNjE7czoxOiJjIjtpOjE0MTY3NjcxNjE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1416767161),
('0f4b6775ff06968698446aa57759d01d9fc99a43', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVBGU0UzNGJ0QTkxUDV4bGNvRWN4NHkxTjF1N0Exc2VHMmtOWE1mYiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTY3NjcxNTk7czoxOiJjIjtpOjE0MTY3NjcxNTk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1416767160),
('24daecb71a7479576df7dc418dece204f5987771', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3FmaEhTc3NkZm1BZzV5ZnphUjFhMmhGbER2T0JaYXpQNkxkT1AxeiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTY3NjcxNjA7czoxOiJjIjtpOjE0MTY3NjcxNjA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1416767160),
('4557cd246dbc2a1d27af6e3aa2eaff9a5a3167a9', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWVySW5oYXRKYVpDN05BWFRYWU1zQW1SUXlsT285WkkzSGlUdUJ0RCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTY3NjcxNjE7czoxOiJjIjtpOjE0MTY3NjcxNjE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1416767161),
('6733c0a54a3831b38302fd5c92dd2cd64c99d3a3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTk8wVjd4NHBHWDhRUjJwd0N3dGVZY29Zbkl3YXV0U2pRZjdFN1l4TyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTY3Mjc3MDA7czoxOiJjIjtpOjE0MTY3Mjc3MDA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1416727702),
('683e443214342caeee8c445047f5c1712187d8d0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWpRakdGOTdSeWNRNkVXc3ZrY2VTamd1VEJNVW1EeGcwaHFLdmgzdiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTY4NjMwMTU7czoxOiJjIjtpOjE0MTY4NjMwMTU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1416863016),
('7015922ce061d45a61a592d33604be40c0c7baaf', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEpJWTBMbWdZMFBVb0dKQ2tLTE1mcm1PU2Rud1FlWVl3a0RzekRycCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTcwODc3NzQ7czoxOiJjIjtpOjE0MTcwODc3NzQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1417087774),
('884ddf6d6b81a87a77a4967305db447e7a844a1d', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0xZMmgwb09kbzdIbEZvZFpuUGRLT2psOGpvUDloUFc5RGNxbDRTayI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTcwODc3NzM7czoxOiJjIjtpOjE0MTcwODc3NzM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1417087774),
('b51c88e4eb0613b1d6f9f05f83d3ad219812908a', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemtWbXZyTDZHeGdYR25obGtyME4wZUJ2YVdneXFFVzVDdzk3VFpkbCI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQxNjkwMDUxMztzOjE6ImMiO2k6MTQxNjkwMDI3NTtzOjE6ImwiO3M6MToiMCI7fX0=', 1416900514),
('c97ded8ed94cbb193bccbd8025f16100de39116a', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1d4dnZJSlFXTWZKQTVYVEtld3BTMVMxZ2xKVGVYTlBXdlFuQm95TSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTcwODc3NzM7czoxOiJjIjtpOjE0MTcwODc3NzM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1417087773),
('d268fdf08b5b973687b4ab077fab969cc1c94afb', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY2N5NjZqMEtMaGRibFdsaXdQQk9BbzNqdG9YYU0zblIycVpRRENPZiI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7czoxOiIyIjtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQxNjc4MzYyNTtzOjE6ImMiO2k6MTQxNjc4MzEzMTtzOjE6ImwiO3M6MToiMCI7fX0=', 1416783625),
('d6d7fbad7e652a9e00425104240f0e9a5eee583d', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNG5OSktyRUtrMGNzSkpDOVZyM09HaHRyaUdrankxUFllcUQ1emF4aCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTcwMTAwMTU7czoxOiJjIjtpOjE0MTcwMTAwMTU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1417010015),
('da48eb0c79842dbbf5260d7f072cd857eb5139fe', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFgxRlprTEtSbWFrWkV6QzJ4bkVaY0xiVWJQS1lRZEI0MjNJcWN3VCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTY4NjA0Mzg7czoxOiJjIjtpOjE0MTY4NjA0Mzg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1416860439),
('e0206eb35daa922887fb7d1362a355ec0a7781ae', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVJIV0hzZGMzQk56MTBzeVZZaFZaN2F5SzNwVjUyTzc0UENYV01MbiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTcwODc3NzQ7czoxOiJjIjtpOjE0MTcwODc3NzQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1417087774),
('fee2b474f33f79c6264120f8b51b9f6c2df3f879', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXB2QzEzRG9OdER1R2NEaEFQUlo0WEUzY292eno0ODZSVXFJcDBLQiI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQxNjg2MTMyMDtzOjE6ImMiO2k6MTQxNjg2MDY5MTtzOjE6ImwiO3M6MToiMCI7fX0=', 1416861320);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(4096) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `print_log`
--
ALTER TABLE `print_log`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `print_log`
--
ALTER TABLE `print_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products_detail_data`
--
ALTER TABLE `products_detail_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `products_detail_fields`
--
ALTER TABLE `products_detail_fields`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products_reserve`
--
ALTER TABLE `products_reserve`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `products_reserve_cancel`
--
ALTER TABLE `products_reserve_cancel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products_stock`
--
ALTER TABLE `products_stock`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=177;
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
