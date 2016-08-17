-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: 127.11.144.2:3306
-- Generation Time: Jul 27, 2016 at 10:49 PM
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

--
-- Dumping data for table `ActiveBlueTooth`
--

INSERT INTO `ActiveBlueTooth` (`timestamp`, `MAC`, `DeviceName`, `SensorID`) VALUES
('2016-07-27 22:48:11', '00:11:22:33:44:55', 'Marines', '512'),
('2016-07-27 22:48:43', '12:34:56:78:90:df', 'CoastGuard', '512'),
('2016-07-27 17:23:40', 'aa:bb:cc:dd:ee:00', 'Blue1', '512'),
('2016-07-27 22:49:09', 'aa:bb:cc:dd:ee:11', 'Army', '512');

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

--
-- Dumping data for table `ActiveWIFI`
--

INSERT INTO `ActiveWIFI` (`Timestamp`, `MAC`, `SSID`, `DeviceName`, `SensorID`) VALUES
('2016-07-27 22:45:47', 'aa:11:22:33:44:00', 'AirForce', 'ThunderCats', '512'),
('2016-07-27 17:22:59', 'aa:11:22:33:44:55', 'DoD', 'Round1', '512'),
('2016-07-27 22:44:49', 'aa:11:22:33:44:66', 'KAOS', 'Sigfried', '512'),
('2016-07-27 22:45:19', 'aa:11:22:33:44:99', 'Navy', 'Gridley', '512');

-- --------------------------------------------------------

--
-- Table structure for table `Practice`
--

CREATE TABLE IF NOT EXISTS `Practice` (
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Name` char(24) NOT NULL,
  `SensorID` int(5) NOT NULL,
  PRIMARY KEY (`Timestamp`)
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

--
-- Dumping data for table `UserMACs`
--

INSERT INTO `UserMACs` (`MAC`, `User`) VALUES
('00:11:22:33:44:55', 'Happy GO Lucky'),
('00:11:22:33:44:66', 'NewOne'),
('01:23:45:67:89:ab', 'Sample1'),
('01:23:45:67:89:ac', 'Sample4'),
('01:23:45:67:89:cd', 'Sample2'),
('12:34:56:78:90:cf', 'Jason M'),
('12:34:56:78:90:df', 'XZY'),
('12:34:56:78:90:ef', 'Sample3'),
('12:34:aa:78:ac:df', 'Andy'),
('1b:34:56:78:ac:aa', 'ANdy G'),
('1b:34:56:78:ac:db', 'Piper'),
('1b:34:56:78:ac:ee', 'Andy'),
('1b:34:a6:78:ac:ee', 'ANdyNow'),
('ab:34:56:78:90:df', 'Jason M'),
('ad:34:56:78:90:ef', 'Andy G');

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

--
-- Dumping data for table `WIFIMACs`
--

INSERT INTO `WIFIMACs` (`MAC`, `SSID`, `User`) VALUES
('aa:11:22:33:44:55', 'SPAWARDemo', 'FirstOne'),
('aa:11:22:33:44:66', '2ndSPAWAR', 'Testing'),
('aa:11:22:33:44:77', 'Another', 'GoGoGadgetGo'),
('aa:11:22:33:44:88', 'GetSmart', 'Agent86');

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`admin4waTiTK`@`127.11.144.2` EVENT `DeleteOldEntries` ON SCHEDULE EVERY 1 MINUTE STARTS '2016-07-27 00:00:00' ENDS '2016-08-03 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM Practice WHERE `timestamp` < DATE_SUB( NOW(), INTERVAL 10 MINUTE)$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
GRANT ALL PRIVILEGES ON * . * TO 'admin'@'%';
FLUSH PRIVILEGES;
