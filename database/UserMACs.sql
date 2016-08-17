-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: 127.11.144.2:3306
-- Generation Time: Jul 14, 2016 at 08:14 PM
-- Server version: 5.5.45
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpwork`
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
