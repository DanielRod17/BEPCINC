-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 09:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bepcinc`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `ID` int(11) NOT NULL,
  `Name` varchar(70) NOT NULL,
  `BR` decimal(10,2) NOT NULL,
  `PR` decimal(10,2) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `PO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`ID`, `Name`, `BR`, `PR`, `ProjectID`, `PO`) VALUES
(1, 'Incapacidad', '0.00', '0.00', 0, 0),
(2, 'Permiso sin goce de sueldo', '0.00', '0.00', 0, 0),
(3, 'Vacaciones', '0.00', '0.00', 0, 0),
(4, 'Vacaciones - Mex', '0.00', '0.00', 0, 0),
(5, 'Creacion de Uwus', '56.78', '65.23', 1, 1),
(6, 'Creacion de Lolonios', '80.00', '12.65', 2, 1),
(7, 'Toscana', '9.00', '9.00', 1, 1),
(8, 'Test', '12.00', '23.00', 1, 1),
(9, 'PoloPolo', '987.23', '34.10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consultor2project`
--

CREATE TABLE `consultor2project` (
  `ID` int(11) NOT NULL,
  `ConsultorID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultor2project`
--

INSERT INTO `consultor2project` (`ID`, `ConsultorID`, `ProjectID`) VALUES
(1, 2, 1),
(2, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consultors`
--

CREATE TABLE `consultors` (
  `ID` int(11) NOT NULL,
  `SN` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Firstname` varchar(25) NOT NULL,
  `Lastname` varchar(25) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Roster` varchar(25) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `Schedule` int(11) NOT NULL DEFAULT '0',
  `Hash` varchar(40) NOT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Logged` tinyint(4) NOT NULL DEFAULT '0',
  `SessionID` varchar(100) DEFAULT NULL,
  `DailyHours` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultors`
--

INSERT INTO `consultors` (`ID`, `SN`, `Firstname`, `Lastname`, `Email`, `Phone`, `Roster`, `State`, `Type`, `Schedule`, `Hash`, `Status`, `LastLogin`, `Logged`, `SessionID`, `DailyHours`) VALUES
(1, 'Admin', 'Administrator', '', '', '', '', '', 0, 0, '665fbe0df3645ad2de231f7a242b2f5007df1309', 1, '2018-11-20 18:43:44', 1, '0ktbuntpot09afn2kfoum1kl3b', 0),
(2, 'Daniel', 'Daniel', 'Rodriguez', 'daniel.rod.vega@hotmail.com', '65667523926', 'MX', '', 1, 1, '7b63da936a368ea61b30bdc35956ef735cdc467c', 1, '2018-11-20 20:18:29', 1, 'qlm6jrdlq2nnv2odlid2ugoj6k', 0),
(3, 'Lemango', 'Lemango', 'Kai', 'LemangoKai@hotmail.com', '6566752392', 'MX', '', 1, 1, '7b63da936a368ea61b30bdc35956ef735cdc467c', 1, '2018-10-22 15:31:51', 0, '', 0),
(4, 'Admina', 'Admina', 'Admina', 'Admina', 'Admina', 'MX', '', 1, 1, 'c14248beaf00e460e4024fe99e3b80e550573fa4', 1, '2018-11-07 19:31:53', 1, '8vtliqgpqd2hedmpcm3lh2bu35', 0),
(5, 'luichave', 'Luis', 'Chavez', 'lchavez@bepcinc.com', '6563728136', 'MX', '', 1, 1, 'fc23d152a037446108f5ef19ed685dc951b0a953', 1, '2018-11-20 16:04:30', 1, 't5hbfd6g7tl2qbldnecppcs4e3', 0),
(6, 'Palafox', 'Palafox', 'Palafox', 'Palafox', '6768768', 'MX', '', 1, 1, '9a25c728cbab9547e53ff8ed5729930fa3ee7118', 1, '2018-11-20 18:22:34', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lineas`
--

CREATE TABLE `lineas` (
  `ID` int(11) NOT NULL,
  `AssignmentID` int(11) NOT NULL,
  `ConsultorID` int(11) NOT NULL,
  `TimecardID` int(11) NOT NULL,
  `Mon` tinyint(4) NOT NULL,
  `Tue` tinyint(4) NOT NULL,
  `Wed` tinyint(4) NOT NULL,
  `Thu` tinyint(4) NOT NULL,
  `Fri` tinyint(4) NOT NULL,
  `Sat` tinyint(4) NOT NULL,
  `Sun` tinyint(4) NOT NULL,
  `StartingDay` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CreatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lineas`
--

INSERT INTO `lineas` (`ID`, `AssignmentID`, `ConsultorID`, `TimecardID`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `Sun`, `StartingDay`, `CreatedDate`) VALUES
(1, 1, 1, 2, 1, 1, 2, 0, 3, 5, 6, '2018-10-30 17:18:30', '2018-10-30 01:58:53'),
(2, 1, 1, 2, 8, 0, 6, 0, 5, 1, 1, '2018-10-30 16:52:01', '2018-10-30 02:00:26'),
(3, 3, 1, 3, 0, 6, 0, 6, 0, 0, 0, '2018-10-29 22:00:56', '2018-10-30 02:00:55'),
(4, 1, 1, 4, 8, 0, 9, 9, 5, 0, 0, '2018-10-30 17:31:40', '2018-10-30 21:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `ID` int(11) NOT NULL,
  `NoPO` varchar(100) NOT NULL,
  `Ammount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`ID`, `NoPO`, `Ammount`) VALUES
(1, '123456', '56.67'),
(2, '993927896 et', '29250.00'),
(3, '56565tetetetet', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `SponsorID` int(11) NOT NULL,
  `PLeader` varchar(70) NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ID`, `Name`, `SponsorID`, `PLeader`, `Status`) VALUES
(1, 'Creacion de Uwus', 1, 'C. Carrillo', 0),
(2, 'Uwuland', 1, 'asasf', 0),
(3, 'Tester', 1, 'Pelob', 0),
(4, 'Testers', 1, 'Peloba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Country` varchar(2) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Sun` tinyint(4) NOT NULL,
  `Mon` tinyint(4) NOT NULL,
  `Tue` tinyint(4) NOT NULL,
  `Wed` tinyint(4) NOT NULL,
  `Thu` tinyint(4) NOT NULL,
  `Fri` tinyint(4) NOT NULL,
  `Sat` tinyint(4) NOT NULL,
  `DoubleAfter` tinyint(4) NOT NULL,
  `TripleAfter` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`ID`, `Name`, `Country`, `State`, `Sun`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `DoubleAfter`, `TripleAfter`) VALUES
(1, 'Diurna', 'MX', '', 0, 9, 9, 9, 9, 9, 0, 48, 57),
(2, 'Diurna_Normal_1', 'MX', '', 0, 8, 8, 8, 8, 8, 8, 48, 57),
(3, 'Diurna_Normal_2', 'MX', '', 0, 9, 9, 9, 9, 9, 0, 48, 57),
(4, 'Test_de_Schedule', 'US', 'Rhode Island', 3, 6, 0, 0, 3, 0, 5, 48, 59),
(5, 'Schedule_Parkaisote', 'MX', '', 2, 0, 6, 5, 7, 0, 0, 48, 57);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Company` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`ID`, `Name`, `Email`, `Company`) VALUES
(1, 'Daniel', 'daniel.rod.vega@hotmail.com', 'LeRP'),
(2, 'Duncan', 'duncan@duncanister.com', 'Duncangre Jo');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `abbr` varchar(2) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `abbr`, `name`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AZ', 'Arizona'),
(4, 'AR', 'Arkansas'),
(5, 'CA', 'California'),
(6, 'CO', 'Colorado'),
(7, 'CT', 'Connecticut'),
(8, 'DE', 'Delaware'),
(9, 'DC', 'District of Columbia'),
(10, 'FL', 'Florida'),
(11, 'GA', 'Georgia'),
(12, 'HI', 'Hawaii'),
(13, 'ID', 'Idaho'),
(14, 'IL', 'Illinois'),
(15, 'IN', 'Indiana'),
(16, 'IA', 'Iowa'),
(17, 'KS', 'Kansas'),
(18, 'KY', 'Kentucky'),
(19, 'LA', 'Louisiana'),
(20, 'ME', 'Maine'),
(21, 'MD', 'Maryland'),
(22, 'MA', 'Massachusetts'),
(23, 'MI', 'Michigan'),
(24, 'MN', 'Minnesota'),
(25, 'MS', 'Mississippi'),
(26, 'MO', 'Missouri'),
(27, 'MT', 'Montana'),
(28, 'NE', 'Nebraska'),
(29, 'NV', 'Nevada'),
(30, 'NH', 'New Hampshire'),
(31, 'NJ', 'New Jersey'),
(32, 'NM', 'New Mexico'),
(33, 'NY', 'New York'),
(34, 'NC', 'North Carolina'),
(35, 'ND', 'North Dakota'),
(36, 'OH', 'Ohio'),
(37, 'OK', 'Oklahoma'),
(38, 'OR', 'Oregon'),
(39, 'PA', 'Pennsylvania'),
(40, 'RI', 'Rhode Island'),
(41, 'SC', 'South Carolina'),
(42, 'SD', 'South Dakota'),
(43, 'TN', 'Tennessee'),
(44, 'TX', 'Texas'),
(45, 'UT', 'Utah'),
(46, 'VT', 'Vermont'),
(47, 'VA', 'Virginia'),
(48, 'WA', 'Washington'),
(49, 'WV', 'West Virginia'),
(50, 'WI', 'Wisconsin'),
(51, 'WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `timecards`
--

CREATE TABLE `timecards` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `ConsultorID` int(11) NOT NULL,
  `StartingDay` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CreatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Dailycount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timecards`
--

INSERT INTO `timecards` (`ID`, `Name`, `ConsultorID`, `StartingDay`, `CreatedDate`, `Dailycount`) VALUES
(1, 'Dummy', 0, '2018-10-29 21:52:38', '2018-10-30 01:51:18', 0),
(2, 'Test2', 2, '2018-11-19 17:12:02', '2018-10-30 02:00:32', 0),
(3, 'Test3', 1, '2018-10-28 06:00:00', '2018-10-30 02:00:56', 0),
(4, 'TCH-2018-10-30-1', 2, '2018-11-19 17:12:05', '2018-10-30 21:31:40', 1),
(5, 'TCH-2018-10-30-2', 1, '2018-09-02 06:00:00', '2018-10-30 21:32:44', 2),
(6, 'TCH-2018-10-30-2', 2, '2018-11-19 17:12:08', '2018-10-30 21:33:29', 2),
(7, 'TCH-2018-10-30-2', 1, '2018-09-23 06:00:00', '2018-10-30 21:33:39', 2),
(8, 'TCH-2018-10-30-3', 2, '2018-11-19 17:12:10', '2018-10-30 21:34:02', 3),
(9, 'TCH-2018-10-30-4', 2, '2018-11-19 17:12:12', '2018-10-30 21:34:23', 4),
(10, 'TCH-2018-11-20-1', 2, '2018-11-04 06:00:00', '2018-11-21 00:24:04', 1),
(11, 'TCH-2018-11-20-2', 2, '2018-11-18 07:00:00', '2018-11-21 00:44:41', 2),
(12, 'TCH-2018-11-20-3', 2, '2018-11-11 07:00:00', '2018-11-21 00:47:20', 3),
(13, 'TCH-2018-11-20-4', 2, '2018-11-25 07:00:00', '2018-11-21 00:50:07', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `consultor2project`
--
ALTER TABLE `consultor2project`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `consultors`
--
ALTER TABLE `consultors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timecards`
--
ALTER TABLE `timecards`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
