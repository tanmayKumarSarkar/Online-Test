-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2015 at 06:47 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_test_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`Admin_Id` int(10) NOT NULL,
  `Admin_Username` varchar(30) NOT NULL,
  `Admin_Pwd` varchar(32) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Id`, `Admin_Username`, `Admin_Pwd`) VALUES
(1, 'Admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `primary_result`
--

CREATE TABLE IF NOT EXISTS `primary_result` (
`PR_Id` int(20) NOT NULL,
  `PR_Stud_Id` varchar(20) NOT NULL,
  `PR_Test_Id` int(10) NOT NULL,
  `PR_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PR_Right` int(10) NOT NULL,
  `PR_Wrong` int(10) NOT NULL,
  `serial_id` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `primary_result`
--

INSERT INTO `primary_result` (`PR_Id`, `PR_Stud_Id`, `PR_Test_Id`, `PR_Time`, `PR_Right`, `PR_Wrong`, `serial_id`) VALUES
(46, '12101106050', 8, '2015-06-17 20:48:34', 1, 4, 25),
(48, '12101106050', 8, '2015-06-18 06:35:51', 1, 4, 27);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`Qstn_Id` int(10) NOT NULL,
  `Qstn_Qstn` varchar(40) NOT NULL,
  `Qstn_Op1` varchar(30) NOT NULL,
  `Qstn_Op2` varchar(30) NOT NULL,
  `Qstn_Op3` varchar(30) NOT NULL,
  `Qstn_Op4` varchar(30) NOT NULL,
  `Qstn_Ans` varchar(30) NOT NULL,
  `Qstn_Type` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Qstn_Id`, `Qstn_Qstn`, `Qstn_Op1`, `Qstn_Op2`, `Qstn_Op3`, `Qstn_Op4`, `Qstn_Ans`, `Qstn_Type`) VALUES
(16, 'q1', 'a1', 'b1', 'c1', 'd1', 'A', 'Phy'),
(18, 'q3', 'a3', 'b3', 'c3', 'd3', 'A', 'Aptitude'),
(19, 'q4', 'a4', 'b4', 'c4', 'd4', 'B', 'Aptitude'),
(20, 'q5', 'a5', 'b5', 'c5', 'd5', 'C', 'Aptitude'),
(21, 'q6', 'a6', 'b6', 'c6', 'd6', 'D', 'Aptitude'),
(22, 'q7', 'a7', 'b7', 'c7', 'd7', 'A', 'Aptitude'),
(23, 'q8', 'a8', 'b8', 'c8', 'd8', 'D', 'Aptitude'),
(24, 'q9', 'a9', 'b9', 'c9', 'd9', 'C', 'Phy');

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE IF NOT EXISTS `question_type` (
`type_Id` int(10) NOT NULL,
  `type_Name` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`type_Id`, `type_Name`) VALUES
(8, 'Maths'),
(9, 'Aptitude'),
(10, 'Phy');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
`Res_Id` int(10) NOT NULL,
  `Res_Stud_Id` int(10) NOT NULL,
  `Res_Test_Id` int(10) NOT NULL,
  `Res_Qstn_Id` int(10) NOT NULL,
  `Res_Ans_Given` varchar(30) NOT NULL,
  `Res_Ans_Correct` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `serialize_result`
--

CREATE TABLE IF NOT EXISTS `serialize_result` (
`id` int(20) NOT NULL,
  `data` varchar(999) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `serialize_result`
--

INSERT INTO `serialize_result` (`id`, `data`) VALUES
(25, 'a:5:{i:0;a:3:{i:0;s:1:"8";i:1;s:2:"18";i:2;s:1:"B";}i:1;a:3:{i:0;s:1:"8";i:1;s:2:"23";i:2;s:1:"B";}i:2;a:3:{i:0;s:1:"8";i:1;s:2:"21";i:2;s:1:"B";}i:3;a:3:{i:0;s:1:"8";i:1;s:2:"20";i:2;s:1:"B";}i:4;a:3:{i:0;s:1:"8";i:1;s:2:"19";i:2;s:1:"B";}}'),
(27, 'a:5:{i:0;a:3:{i:0;s:1:"8";i:1;s:2:"19";i:2;s:1:"D";}i:1;a:3:{i:0;s:1:"8";i:1;s:2:"22";i:2;s:1:"D";}i:2;a:3:{i:0;s:1:"8";i:1;s:2:"23";i:2;s:1:"D";}i:3;a:3:{i:0;s:1:"8";i:1;s:2:"20";i:2;s:1:"B";}i:4;a:3:{i:0;s:1:"8";i:1;s:2:"21";i:2;s:1:"B";}}');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`Stud_Id` int(10) NOT NULL,
  `Stud_Name` varchar(30) NOT NULL,
  `Stud_Roll` varchar(20) NOT NULL,
  `Stud_Dept` varchar(30) NOT NULL,
  `Stud_Year` varchar(30) NOT NULL,
  `Stud_Pwd` varchar(32) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Stud_Id`, `Stud_Name`, `Stud_Roll`, `Stud_Dept`, `Stud_Year`, `Stud_Pwd`) VALUES
(6, 'Sumit Pal', '12101106050', 'IT', 'Undergraduate_4th_year', '1d623b89683f9ce4e074de1676d12416'),
(7, 'Biswajit Mahato', '12101106010', 'IT', 'Undergraduate_4th_year', '3def82404810d98aa619a6b6c4d51576');

-- --------------------------------------------------------

--
-- Table structure for table `testpaper`
--

CREATE TABLE IF NOT EXISTS `testpaper` (
`Test_Id` int(10) NOT NULL,
  `Test_Name` varchar(30) NOT NULL,
  `Test_Time` varchar(30) NOT NULL,
  `Test_Qno` int(10) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `testpaper`
--

INSERT INTO `testpaper` (`Test_Id`, `Test_Name`, `Test_Time`, `Test_Qno`, `type`) VALUES
(8, 'Apti_cse', '5', 5, 'Aptitude'),
(9, 'New Apti Test', '5', 4, 'Maths');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `primary_result`
--
ALTER TABLE `primary_result`
 ADD PRIMARY KEY (`PR_Id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`Qstn_Id`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
 ADD PRIMARY KEY (`type_Id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
 ADD PRIMARY KEY (`Res_Id`);

--
-- Indexes for table `serialize_result`
--
ALTER TABLE `serialize_result`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`Stud_Id`);

--
-- Indexes for table `testpaper`
--
ALTER TABLE `testpaper`
 ADD PRIMARY KEY (`Test_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `Admin_Id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `primary_result`
--
ALTER TABLE `primary_result`
MODIFY `PR_Id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `Qstn_Id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
MODIFY `type_Id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
MODIFY `Res_Id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `serialize_result`
--
ALTER TABLE `serialize_result`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `Stud_Id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `testpaper`
--
ALTER TABLE `testpaper`
MODIFY `Test_Id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
