-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2015 at 08:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bank_marketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `age` int(11) NOT NULL,
  `job` varchar(20) NOT NULL,
  `marital` varchar(20) NOT NULL,
  `education` varchar(20) NOT NULL,
  `default_credit` varchar(3) NOT NULL,
  `housing_loan` varchar(3) NOT NULL,
  `personal_loan` varchar(3) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `day` varchar(20) NOT NULL,
  `duration` int(11) NOT NULL,
  `campaign` int(11) NOT NULL,
  `prev_days` int(11) NOT NULL,
  `prev_num_contact` int(11) NOT NULL,
  `prev_outcome` varchar(20) NOT NULL,
  `decision` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41057 ;

--
-- Dumping data for table `customer`
--
-- Insert row sample
INSERT INTO `customer` (`id`, `age`, `job`, `marital`, `education`, `default_credit`, `housing_loan`, `personal_loan`, `contact`, `month`, `day`, `duration`, `campaign`, `prev_days`, `prev_num_contact`, `prev_outcome`, `decision`) VALUES
(1, 56, 'housemaid', 'married', 'basic', 'no', 'no', 'no', 'telephone', 'may', 'mon', 261, 1, 999, 0, 'nonexistent', 'no');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
