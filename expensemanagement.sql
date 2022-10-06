-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 06:47 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expensemanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_table`
--

CREATE TABLE IF NOT EXISTS `expense_table` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `Exp_ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Date` date NOT NULL,
  `Type` int(11) NOT NULL,
  `Amt` decimal(10,2) NOT NULL,
  `Currency` varchar(3) NOT NULL,
  `Exchange_rate` decimal(10,5) NOT NULL,
  `SGD` decimal(10,2) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Member_portion` decimal(10,2) NOT NULL,
  `Member_paid` decimal(10,2) NOT NULL,
  `Member_owes` decimal(10,2) NOT NULL,
  `Member_paid_SGD` decimal(10,2) NOT NULL,
  `Remark` text NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=389 ;

--
-- Dumping data for table `expense_table`
--

INSERT INTO `expense_table` (`SN`, `Exp_ID`, `Description`, `Date`, `Type`, `Amt`, `Currency`, `Exchange_rate`, `SGD`, `Member_ID`, `Member_portion`, `Member_paid`, `Member_owes`, `Member_paid_SGD`, `Remark`) VALUES
(1, 1, 'Accumulated expenses until "Takoyaki atchiatchi"', '2020-01-16', 6, '172750.30', 'JPY', '0.01250', '2159.38', 1, '44183.20', '38852.00', '5331.20', '477.88', ''),
(2, 1, 'Accumulated expenses until "Takoyaki atchiatchi"', '2020-01-16', 6, '172750.30', 'JPY', '0.01250', '2159.38', 2, '45674.40', '44521.30', '1153.10', '547.60', ''),
(3, 1, 'Accumulated expenses until "Takoyaki atchiatchi"', '2020-01-16', 6, '172750.30', 'JPY', '0.01250', '2159.38', 3, '43370.00', '42384.00', '986.00', '521.32', ''),
(4, 1, 'Accumulated expenses until "Takoyaki atchiatchi"', '2020-01-16', 6, '172750.30', 'JPY', '0.01250', '2159.38', 4, '39522.70', '47238.00', '-7715.30', '581.00', ''),
(5, 2, 'usj minion sandwich', '2020-01-20', 1, '1000.00', 'JPY', '0.01250', '12.50', 4, '500.00', '0.00', '500.00', '0.00', ''),
(6, 2, 'usj minion sandwich', '2020-01-20', 1, '1000.00', 'JPY', '0.01250', '12.50', 3, '500.00', '1000.00', '-500.00', '12.50', ''),
(7, 3, 'tammy owe ler rynn', '2020-01-20', 6, '558.00', 'JPY', '0.01250', '6.98', 4, '558.00', '0.00', '558.00', '0.00', ''),
(8, 3, 'tammy owe ler rynn', '2020-01-20', 6, '558.00', 'JPY', '0.01250', '6.98', 3, '0.00', '558.00', '-558.00', '6.98', ''),
(9, 4, 'butter beer at usj', '2020-01-20', 1, '2600.00', 'JPY', '0.01250', '32.50', 1, '650.00', '2600.00', '-1950.00', '32.50', ''),
(10, 4, 'butter beer at usj', '2020-01-20', 1, '2600.00', 'JPY', '0.01250', '32.50', 3, '650.00', '0.00', '650.00', '0.00', ''),
(11, 4, 'butter beer at usj', '2020-01-20', 1, '2600.00', 'JPY', '0.01250', '32.50', 2, '650.00', '0.00', '650.00', '0.00', ''),
(12, 4, 'butter beer at usj', '2020-01-20', 1, '2600.00', 'JPY', '0.01250', '32.50', 4, '650.00', '0.00', '650.00', '0.00', ''),
(13, 5, 'drug store at osaka', '2020-01-20', 6, '9450.00', 'JPY', '0.01250', '118.13', 2, '1096.00', '0.00', '1096.00', '0.00', ''),
(14, 5, 'drug store at osaka', '2020-01-20', 6, '9450.00', 'JPY', '0.01250', '118.13', 1, '2874.00', '9450.00', '-6576.00', '118.13', ''),
(15, 5, 'drug store at osaka', '2020-01-20', 6, '9450.00', 'JPY', '0.01250', '118.13', 3, '1096.00', '0.00', '1096.00', '0.00', ''),
(16, 5, 'drug store at osaka', '2020-01-20', 6, '9450.00', 'JPY', '0.01250', '118.13', 4, '4384.00', '0.00', '4384.00', '0.00', ''),
(17, 6, '7 eleven', '2020-01-20', 1, '408.00', 'JPY', '0.01250', '5.10', 1, '258.12', '0.00', '258.12', '0.00', ''),
(18, 6, '7 eleven', '2020-01-20', 1, '408.00', 'JPY', '0.01250', '5.10', 2, '149.88', '408.00', '-258.12', '5.10', ''),
(19, 7, 'don quixote', '2020-01-20', 3, '15287.00', 'JPY', '0.01250', '191.09', 1, '7451.00', '0.00', '7451.00', '0.00', ''),
(20, 7, 'don quixote', '2020-01-20', 3, '15287.00', 'JPY', '0.01250', '191.09', 2, '7836.00', '15287.00', '-7451.00', '191.09', ''),
(21, 8, 'okonomiyaki', '2020-01-20', 1, '2150.00', 'JPY', '0.01250', '26.88', 1, '537.50', '2150.00', '-1612.50', '26.88', ''),
(22, 8, 'okonomiyaki', '2020-01-20', 1, '2150.00', 'JPY', '0.01250', '26.88', 2, '537.50', '0.00', '537.50', '0.00', ''),
(23, 8, 'okonomiyaki', '2020-01-20', 1, '2150.00', 'JPY', '0.01250', '26.88', 3, '537.50', '0.00', '537.50', '0.00', ''),
(24, 8, 'okonomiyaki', '2020-01-20', 1, '2150.00', 'JPY', '0.01250', '26.88', 4, '537.50', '0.00', '537.50', '0.00', ''),
(25, 9, 'gindaco at osaka', '2020-01-20', 1, '650.00', 'JPY', '0.01250', '8.13', 1, '216.70', '650.00', '-433.30', '8.13', ''),
(26, 9, 'gindaco at osaka', '2020-01-20', 1, '650.00', 'JPY', '0.01250', '8.13', 2, '216.70', '0.00', '216.70', '0.00', ''),
(27, 9, 'gindaco at osaka', '2020-01-20', 1, '650.00', 'JPY', '0.01250', '8.13', 3, '216.60', '0.00', '216.60', '0.00', ''),
(28, 10, 'gyoza at osaka', '2020-01-20', 1, '240.00', 'JPY', '0.01250', '3.00', 1, '80.00', '0.00', '80.00', '0.00', ''),
(29, 10, 'gyoza at osaka', '2020-01-20', 1, '240.00', 'JPY', '0.01250', '3.00', 3, '80.00', '240.00', '-160.00', '3.00', ''),
(30, 10, 'gyoza at osaka', '2020-01-20', 1, '240.00', 'JPY', '0.01250', '3.00', 4, '80.00', '0.00', '80.00', '0.00', ''),
(31, 11, 'gachapon for tammyâ€™s cat', '2020-01-19', 6, '300.00', 'JPY', '0.01250', '3.75', 4, '300.00', '0.00', '300.00', '0.00', ''),
(32, 11, 'gachapon for tammyâ€™s cat', '2020-01-19', 6, '300.00', 'JPY', '0.01250', '3.75', 1, '0.00', '300.00', '-300.00', '3.75', ''),
(385, 12, 'Airfare ', '2020-01-15', 2, '2844.00', 'SGD', '1.00000', '2844.00', 1, '711.00', '711.00', '0.00', '711.00', ''),
(386, 12, 'Airfare ', '2020-01-15', 2, '2844.00', 'SGD', '1.00000', '2844.00', 3, '711.00', '711.00', '0.00', '711.00', ''),
(387, 12, 'Airfare ', '2020-01-15', 2, '2844.00', 'SGD', '1.00000', '2844.00', 2, '711.00', '711.00', '0.00', '711.00', ''),
(388, 12, 'Airfare ', '2020-01-15', 2, '2844.00', 'SGD', '1.00000', '2844.00', 4, '711.00', '711.00', '0.00', '711.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `expense_table_kr`
--

CREATE TABLE IF NOT EXISTS `expense_table_kr` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `Exp_ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Date` date NOT NULL,
  `Type` int(11) NOT NULL,
  `Amt` decimal(10,2) NOT NULL,
  `Currency` varchar(3) NOT NULL,
  `Exchange_rate` decimal(10,5) NOT NULL,
  `SGD` decimal(10,2) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Member_portion` decimal(10,2) NOT NULL,
  `Member_paid` decimal(10,2) NOT NULL,
  `Member_owes` decimal(10,2) NOT NULL,
  `Member_paid_SGD` decimal(10,2) NOT NULL,
  `Remark` text NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expense_table_kr`
--

INSERT INTO `expense_table_kr` (`SN`, `Exp_ID`, `Description`, `Date`, `Type`, `Amt`, `Currency`, `Exchange_rate`, `SGD`, `Member_ID`, `Member_portion`, `Member_paid`, `Member_owes`, `Member_paid_SGD`, `Remark`) VALUES
(1, 1, 'test', '2020-01-10', 1, '10000.00', 'KRW', '0.00110', '11.00', 2, '5000.00', '10000.00', '-5000.00', '11.00', ''),
(2, 1, 'test', '2020-01-10', 1, '10000.00', 'KRW', '0.00110', '11.00', 1, '5000.00', '0.00', '5000.00', '0.00', ''),
(3, 2, 'test', '2020-01-10', 2, '2000.00', 'SGD', '1.00000', '2000.00', 2, '500.00', '0.00', '500.00', '0.00', ''),
(4, 2, 'test', '2020-01-10', 2, '2000.00', 'SGD', '1.00000', '2000.00', 3, '500.00', '1000.00', '-500.00', '1000.00', ''),
(5, 2, 'test', '2020-01-10', 2, '2000.00', 'SGD', '1.00000', '2000.00', 4, '500.00', '1000.00', '-500.00', '1000.00', ''),
(6, 2, 'test', '2020-01-10', 2, '2000.00', 'SGD', '1.00000', '2000.00', 1, '500.00', '0.00', '500.00', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `expense_table_tw`
--

CREATE TABLE IF NOT EXISTS `expense_table_tw` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `Exp_ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Date` date NOT NULL,
  `Type` int(11) NOT NULL,
  `Amt` decimal(10,2) NOT NULL,
  `Currency` varchar(3) NOT NULL,
  `Exchange_rate` decimal(10,5) NOT NULL,
  `SGD` decimal(10,2) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Member_portion` decimal(10,2) NOT NULL,
  `Member_paid` decimal(10,2) NOT NULL,
  `Member_owes` decimal(10,2) NOT NULL,
  `Member_paid_SGD` decimal(10,2) NOT NULL,
  `Remark` text NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_member`
--

CREATE TABLE IF NOT EXISTS `group_member` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Group_name` varchar(50) NOT NULL,
  `Group_ID` int(11) NOT NULL,
  `Members` varchar(50) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Remarks` text NOT NULL,
  `Selected` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `group_member`
--

INSERT INTO `group_member` (`ID`, `Group_name`, `Group_ID`, `Members`, `Member_ID`, `Remarks`, `Selected`) VALUES
(1, 'Group A', 1, 'Vernice', 1, '', 0),
(2, 'Group A', 1, 'Ee Ting', 2, '', 0),
(3, 'Group A', 1, 'Ler Rynn', 3, '', 0),
(4, 'Group A', 1, 'Tammy', 4, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `group_member_kr`
--

CREATE TABLE IF NOT EXISTS `group_member_kr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Group_name` varchar(50) NOT NULL,
  `Group_ID` int(11) NOT NULL,
  `Members` varchar(50) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Remarks` text NOT NULL,
  `Selected` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `group_member_kr`
--

INSERT INTO `group_member_kr` (`ID`, `Group_name`, `Group_ID`, `Members`, `Member_ID`, `Remarks`, `Selected`) VALUES
(1, 'Group A', 1, 'Vernice Thiam', 1, '', 0),
(2, 'Group A', 1, 'Celest ', 2, '', 0),
(3, 'Group A', 1, 'Phoebe', 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `group_member_tw`
--

CREATE TABLE IF NOT EXISTS `group_member_tw` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Group_name` varchar(50) NOT NULL,
  `Group_ID` int(11) NOT NULL,
  `Members` varchar(50) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Remarks` text NOT NULL,
  `Selected` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `group_member_tw`
--

INSERT INTO `group_member_tw` (`ID`, `Group_name`, `Group_ID`, `Members`, `Member_ID`, `Remarks`, `Selected`) VALUES
(1, 'Group A', 1, 'Vernice', 1, '', 0),
(2, 'Group A', 1, 'Celest', 2, '', 0),
(3, 'Group A', 1, 'Phoebe', 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_table`
--

CREATE TABLE IF NOT EXISTS `password_table` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `Trip` varchar(15) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `password_table`
--

INSERT INTO `password_table` (`SN`, `Trip`, `Password`) VALUES
(1, 'Japan', 'HCI2020'),
(2, 'Taiwan', 'NUS2020'),
(3, 'Korea', 'SMU2020');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
