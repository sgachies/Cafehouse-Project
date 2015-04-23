-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2015 at 11:39 AM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;




CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `time_sent` timestamp NULL DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------




CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` varchar(45) DEFAULT NULL,
  `national_id` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `age`, `national_id`, `phone`, `session_id`) VALUES
(1, 'steve', '', '', '25', '27816668', '121212', 0),
(3, 'brian', '', '', '30', '123456789', '12121212', 0),
(4, 'joel', '', '', '26', '123000', '12121212', 0),
(5, 'David', '', '', '25', '27090090', '12121212', 0),
(6, NULL, '', '', NULL, '', 'Array', 0),
(7, NULL, '', '', NULL, '', ' 121212', 0),
(8, NULL, '', '', NULL, '', ' 12212212', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ussd_logs`
--

CREATE TABLE IF NOT EXISTS `ussd_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL,
  `text` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `ussd_logs`
--

INSERT INTO `ussd_logs` (`id`, `phone`, `text`) VALUES
(2, ' 254728355429', ''),
(3, ' 254728355429', '1'),
(4, ' 254728355429', '1*2345'),
(5, ' 254723401197', ''),
(6, ' 254723401197', '1'),
(7, ' 254723401197', '1*1233'),
(8, ' 254728355429', ''),
(9, ' 254728355429', '1'),
(10, ' 254728355429', '1*2333'),
(11, ' 254728355429', '1*2333*ddfhhh'),
(12, ' 254728355429', ''),
(13, ' 254723401197', ''),
(14, ' 254728355429', '1'),
(15, ' 254728355429', '1*235'),
(16, ' 254728355429', '1*235*srtg'),
(17, ' 254728355429', '1*235*srtg*dffgh'),
(18, ' 254728355429', ''),
(19, ' 254728355429', '1'),
(20, ' 254728355429', '1*12345'),
(21, ' 254728355429', '1*12345*Leo'),
(22, ' 254728355429', '1*12345*Leo*Mobidev'),
(23, ' 254728355429', ''),
(24, ' 254728355429', '1'),
(25, ' 254728355429', '1*12345'),
(26, ' 254728355429', '1*12345*Leo'),
(27, ' 254728355429', '1*12345*Leo*Mobidev'),
(28, ' 254728355429', ''),
(29, ' 254728355429', '1'),
(30, ' 254728355429', '1*12345'),
(31, ' 254728355429', '1*12345*Leo'),
(32, ' 254728355429', '1*12345*Leo*Mobidev'),
(33, ' 254723401197', ''),
(34, ' 254723401197', '1'),
(35, ' 254723401197', '1*2755'),
(36, ' 254723401197', '1*2755*77'),
(37, ' 254723401197', '1*2755*77*55'),
(38, ' 254723401197', ''),
(39, ' 254723401197', '1'),
(40, ' 254723401197', '1*22'),
(41, ' 254723401197', '1*22*22'),
(42, ' 254723401197', '1*22*22*22'),
(43, ' 254723401197', ''),
(44, ' 254723401197', '1'),
(45, ' 254723401197', '1*22'),
(46, ' 254723401197', '1*22*56'),
(47, ' 254723401197', '1*22*56*22587'),
(48, ' 254723401197', ''),
(49, ' 254723401197', '1'),
(50, ' 254723401197', '1*227816668'),
(51, ' 254723401197', '1*227816668*888'),
(52, ' 254723401197', '1*227816668*888*88');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
