
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2016 at 11:54 PM
-- Server version: 10.0.20-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u581456581_gelva`
--

-- --------------------------------------------------------

--
-- Table structure for table `inprogress_temp`
--

CREATE TABLE IF NOT EXISTS `inprogress_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp1` double NOT NULL,
  `temp2` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inprogress_temp`
--

INSERT INTO `inprogress_temp` (`id`, `temp1`, `temp2`, `date`) VALUES
(1, 150.25, 45.3, '2016-03-22 01:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `relay_trigger`
--

CREATE TABLE IF NOT EXISTS `relay_trigger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relay1_state` int(11) NOT NULL,
  `relay2_state` int(11) NOT NULL,
  `machine_state` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `relay_trigger`
--

INSERT INTO `relay_trigger` (`id`, `relay1_state`, `relay2_state`, `machine_state`, `date`) VALUES
(1, 0, 0, 1, '2016-03-22 01:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `temp1_sensor`
--

CREATE TABLE IF NOT EXISTS `temp1_sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_read` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temp2_sensor`
--

CREATE TABLE IF NOT EXISTS `temp2_sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_read` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
