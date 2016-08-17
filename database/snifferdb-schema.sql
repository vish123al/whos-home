-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: 127.11.144.2:3306
-- Generation Time: Jul 28, 2016 at 09:09 PM
-- Server version: 5.5.45
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `snifferdb`
--
CREATE DATABASE IF NOT EXISTS `snifferdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `snifferdb`;

-- --------------------------------------------------------

--
-- Table structure for table `ActiveBlueTooth`
--

CREATE TABLE IF NOT EXISTS `ActiveBlueTooth` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MAC` char(17) NOT NULL,
  `DeviceName` char(24) NOT NULL,
  `SensorID` char(24) NOT NULL,
  PRIMARY KEY (`MAC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ActiveWIFI`
--

CREATE TABLE IF NOT EXISTS `ActiveWIFI` (
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MAC` char(17) NOT NULL,
  `SSID` char(17) NOT NULL,
  `DeviceName` char(24) NOT NULL,
  `SensorID` char(24) NOT NULL,
  PRIMARY KEY (`MAC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `UserMACs`
--

CREATE TABLE IF NOT EXISTS `UserMACs` (
  `MAC` char(17) NOT NULL,
  `User` char(24) NOT NULL,
  PRIMARY KEY (`MAC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `WIFIMACs`
--

CREATE TABLE IF NOT EXISTS `WIFIMACs` (
  `MAC` char(17) NOT NULL,
  `SSID` char(24) NOT NULL,
  `User` char(24) NOT NULL,
  PRIMARY KEY (`MAC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registerd WIFI devices';

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`admin4waTiTK`@`127.11.144.2` EVENT `DeleteOldEntries` ON SCHEDULE EVERY 1 MINUTE STARTS '2016-07-27 00:00:00' ENDS '2016-08-03 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM Practice WHERE `timestamp` < DATE_SUB( NOW(), INTERVAL 10 MINUTE)$$

DELIMITER ;

GRANT ALL PRIVILEGES ON * . * TO 'admin'@'%';
FLUSH PRIVILEGES;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
