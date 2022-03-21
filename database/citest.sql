-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2022 at 10:14 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `qty`, `title`, `price`) VALUES
(1, 8, 4, 1, 'Tshirt', 100),
(2, 5, 3, 3, 'Jacket and assesories', 50),
(3, 9, 5, 5, 'Black T-shirt', 100),
(4, 9, 3, 2, 'Jacket and assesories', 300);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `status`, `timestamp`) VALUES
(3, 'Jacket and assesories', 'Jacket and assesories with new items', '1647690682.jpg', 1, '2022-03-21 09:43:56'),
(4, 'Tshirt', 'Tshirt', '1647691314.jpg', 1, '2022-03-21 07:53:45'),
(5, 'Black T-shirt', 'Black T-shirt', '1647691283.jpg', 1, '2022-03-21 06:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `verification_key` varchar(255) NOT NULL,
  `is_email_verified` enum('no','yes') NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `verification_key`, `is_email_verified`, `user_type`) VALUES
(3, 'administrator', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2a6a574b17b22eb28fdf7a5a6360d591', 'yes', 1),
(5, 'Tarun', 'tarunsharpdeveloper@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '812c460fd3979fc8ab474e01deea2190', 'yes', 0),
(9, 'Balwan', 'balwansingh.eway@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'd6db3b15a835055cc06ed3e101cb54ef', 'yes', 0),
(8, 'nadeem', 'nadeem.eway@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '004e8658baecf2e39b21d86f093cd371', 'yes', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
