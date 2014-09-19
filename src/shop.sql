-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2014 at 03:10 PM
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
(2, 'test', 'test@test.com', '$2y$10$C76OIUiJ9QEtfMzIGjLsRe2lqtS2dLwhvuaDCP8p9eCCPDuFP0lfO', 1, '6QRyA3Ho6euRluiQGu9N6SFNPOA5Etni0jGtcDZQpeBekPIatRQ5vlPx15ip'),
(3, 'test01', 'test01@test.com', '$2y$10$fD4IfiDtIAzKTbq6UzypYOKzNxjqt4uT7e6nnSoF1UmQxt3cUmuea', 2, 'jEf6v5FeaDozAZoDtzETtwmjtt5Kw6SadPmO0SZ11yZRc3LXTfGymf2pQFj6'),
(4, 'test02', 'test2@test.com', '$2y$10$gE/PxrGO0WY3KQh2oXAGCO4QwRPNtYp.w.V20NarER2OLAF0QFS.i', 2, 'dq6xADbGV3rA4ztjbnaerXmPSlouFyd7kQoNaWU2GvEDlpkt0sfMOUuIUnTH'),
(12, '', '', '$2y$10$Zm5LbZfwAaJVtYRc6GRti.hDGz3m5iCJKBubyKDfsdZDWIPWCNgB6', 2, '3auln91R54Pu8W7qDoCpCH7DBIYFyeZ8zvSeS30amEY0QvnonrRSxSIlhRZe');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

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
-- Table structure for table `color_code`
--

CREATE TABLE IF NOT EXISTS `color_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `color_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `color_code`
--

INSERT INTO `color_code` (`id`, `color_name`, `color_code`) VALUES
(1, 'White', '#FFF'),
(2, 'Black', '#000');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `price_discount` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `description` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `reserve` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `price_discount`, `discount_type`, `description`, `category_id`, `stock`, `reserve`) VALUES
(1, 'test00001', 5000, 4000, 1, 'kajdkasjdkl lkajdkl', 1, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_colors`
--

CREATE TABLE IF NOT EXISTS `products_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(16) NOT NULL,
  `color_id` int(2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products_detail_data`
--

CREATE TABLE IF NOT EXISTS `products_detail_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `products_detail_data`
--

INSERT INTO `products_detail_data` (`id`, `pid`, `fid`, `data`, `stock`) VALUES
(1, 1, 1, '1', 0),
(2, 1, 1, '2', 0),
(3, 1, 2, '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_detail_fields`
--

CREATE TABLE IF NOT EXISTS `products_detail_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products_detail_fields`
--

INSERT INTO `products_detail_fields` (`id`, `name`, `type`) VALUES
(1, 'color', 0),
(2, 'size', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_size`
--

CREATE TABLE IF NOT EXISTS `products_size` (
  `id` int(11) NOT NULL,
  `size` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

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
(1, 2, 'Testter', 'No Address', 'Admin');

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
