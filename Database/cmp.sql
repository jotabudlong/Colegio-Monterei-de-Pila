-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2016 at 10:46 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`id` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `grade_1` int(3) NOT NULL DEFAULT '-1',
  `grade_2` int(3) NOT NULL DEFAULT '-1',
  `grade_3` int(3) NOT NULL DEFAULT '-1',
  `grade_4` int(3) NOT NULL DEFAULT '-1',
  `remarks` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `subject`, `section`, `student`, `grade_1`, `grade_2`, `grade_3`, `grade_4`, `remarks`) VALUES
(18, 35, 22, 32, 94, 92, 95, -1, 'Passed'),
(19, 36, 22, 32, 95, -1, -1, -1, ''),
(20, 40, 24, 32, -1, -1, -1, -1, ''),
(21, 41, 25, 36, 98, -1, -1, -1, ''),
(22, 42, 25, 36, -1, -1, -1, -1, ''),
(23, 43, 25, 36, -1, -1, -1, -1, ''),
(24, 44, 25, 36, -1, -1, -1, -1, ''),
(25, 45, 25, 36, -1, -1, -1, -1, ''),
(26, 46, 25, 36, -1, -1, -1, -1, ''),
(27, 47, 25, 36, -1, -1, -1, -1, ''),
(28, 48, 25, 36, -1, -1, -1, -1, ''),
(29, 89, 31, 37, -1, -1, -1, -1, ''),
(30, 90, 31, 37, -1, -1, -1, -1, ''),
(31, 91, 31, 37, -1, -1, -1, -1, ''),
(32, 92, 31, 37, -1, -1, -1, -1, ''),
(33, 93, 31, 37, -1, -1, -1, -1, ''),
(34, 94, 31, 37, -1, -1, -1, -1, ''),
(35, 95, 31, 37, -1, -1, -1, -1, ''),
(36, 96, 31, 37, -1, -1, -1, -1, ''),
(37, 97, 31, 37, -1, -1, -1, -1, '');

-- --------------------------------------------------------

--
-- Table structure for table `predefine_subject`
--

CREATE TABLE IF NOT EXISTS `predefine_subject` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year_level` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `predefine_subject`
--

INSERT INTO `predefine_subject` (`id`, `name`, `year_level`) VALUES
(1, 'Math', 2),
(2, 'Mother Tongue', 2),
(3, 'Filipino', 2),
(4, 'English', 2),
(5, 'Science', 2),
(6, 'MAPEH', 2),
(7, 'Computer', 2),
(8, 'Araling Panlipunan', 2),
(9, 'Math', 3),
(10, 'Mother Tongue', 3),
(11, 'Filipino', 3),
(12, 'English', 3),
(13, 'Science', 3),
(14, 'MAPEH', 3),
(15, 'Computer', 3),
(16, 'Araling Panlipunan', 3),
(17, 'Math', 4),
(18, 'Mother Tongue', 4),
(19, 'Filipino', 4),
(20, 'English', 4),
(21, 'Science', 4),
(22, 'MAPEH', 4),
(23, 'Computer', 4),
(24, 'Araling Panlipunan', 4),
(25, 'Math', 5),
(26, 'Mother Tongue', 5),
(27, 'Filipino', 5),
(28, 'English', 5),
(29, 'Science', 5),
(30, 'MAPEH', 5),
(31, 'Computer', 5),
(32, 'Araling Panlipunan', 5),
(60, 'Math', 1),
(61, 'Mother Tongue', 1),
(62, 'Filipino', 1),
(63, 'English', 1),
(64, 'Science', 1),
(65, 'MAPEH', 1),
(66, 'Computer', 1),
(67, 'Araling Panlipunan', 1),
(68, 'Math', 6),
(69, 'Mother Tongue', 6),
(70, 'Filipino', 6),
(71, 'English', 6),
(72, 'Science', 6),
(73, 'MAPEH', 6),
(74, 'Computer', 6),
(75, 'Araling Panlipunan', 6),
(76, 'Filipino', 7),
(77, 'English', 7),
(78, 'Math', 7),
(79, 'Science', 7),
(80, 'AP', 7),
(81, 'TLE', 7),
(82, 'MAPEH', 7),
(83, 'Computer', 7);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year_level` int(2) NOT NULL DEFAULT '1',
  `school_year` int(4) NOT NULL,
  `adviser` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `year_level`, `school_year`, `adviser`) VALUES
(25, 'Test1', 1, 2014, 35),
(26, 'Test2', 1, 2014, 31),
(27, 'Test3', 1, 2014, 31),
(28, 'Test4', 2, 2014, 31),
(29, 'Test5', 2, 2014, 31),
(30, 'Test6', 2, 2014, 31),
(31, 'Test7', 10, 2014, 31),
(32, 'Test8', 2, 2014, 31),
(33, 'Test9', 7, 2014, 31);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year_level` int(2) NOT NULL DEFAULT '1',
  `teacher` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `year_level`, `teacher`, `section`, `is_deleted`) VALUES
(35, 'Math', 1, 31, 22, 0),
(36, 'Science', 1, 31, 22, 0),
(37, 'Math', 1, 31, 23, 0),
(38, 'Science', 1, 31, 23, 0),
(39, 'English', 1, 31, 23, 0),
(40, 'Science', 1, 31, 24, 0),
(41, 'Math', 1, 33, 25, 0),
(42, 'Mother Tongue', 1, 35, 25, 0),
(43, 'Filipino', 1, 34, 25, 0),
(44, 'English', 1, 31, 25, 0),
(45, 'Science', 1, 31, 25, 0),
(46, 'MAPEH', 1, 31, 25, 0),
(47, 'Computer', 1, 31, 25, 0),
(48, 'Araling Panlipunan', 1, 31, 25, 0),
(49, 'Math', 1, 31, 26, 0),
(50, 'Mother Tongue', 1, 31, 26, 0),
(51, 'Filipino', 1, 31, 26, 0),
(52, 'English', 1, 31, 26, 0),
(53, 'Science', 1, 31, 26, 0),
(54, 'MAPEH', 1, 31, 26, 0),
(55, 'Computer', 1, 31, 26, 0),
(56, 'Araling Panlipunan', 1, 31, 26, 0),
(57, 'Math', 1, 31, 27, 0),
(58, 'Mother Tongue', 1, 31, 27, 0),
(59, 'Filipino', 1, 31, 27, 0),
(60, 'English', 1, 31, 27, 0),
(61, 'Science', 1, 31, 27, 0),
(62, 'MAPEH', 1, 31, 27, 0),
(63, 'Computer', 1, 31, 27, 0),
(64, 'Araling Panlipunan', 1, 31, 27, 0),
(65, 'Math', 2, 31, 28, 0),
(66, 'Mother Tongue', 2, 31, 28, 0),
(67, 'Filipino', 2, 31, 28, 0),
(68, 'English', 2, 31, 28, 0),
(69, 'Science', 2, 31, 28, 0),
(70, 'MAPEH', 2, 31, 28, 0),
(71, 'Computer', 2, 31, 28, 0),
(72, 'Araling Panlipunan', 2, 31, 28, 0),
(73, 'Math', 2, 31, 29, 0),
(74, 'Mother Tongue', 2, 31, 29, 0),
(75, 'Filipino', 2, 31, 29, 0),
(76, 'English', 2, 31, 29, 0),
(77, 'Science', 2, 31, 29, 0),
(78, 'MAPEH', 2, 31, 29, 0),
(79, 'Computer', 2, 31, 29, 0),
(80, 'Araling Panlipunan', 2, 31, 29, 0),
(81, 'Math', 2, 31, 30, 0),
(82, 'Mother Tongue', 2, 31, 30, 0),
(83, 'Filipino', 2, 31, 30, 0),
(84, 'English', 2, 31, 30, 0),
(85, 'Science', 2, 31, 30, 0),
(86, 'MAPEH', 2, 31, 30, 0),
(87, 'Computer', 2, 31, 30, 0),
(88, 'Araling Panlipunan', 2, 31, 30, 0),
(89, 'TLE', 10, 31, 31, 0),
(90, 'MAPEH', 10, 31, 31, 0),
(91, 'French', 10, 31, 31, 0),
(92, 'Advanced Statistics', 10, 31, 31, 0),
(93, 'Robotics', 10, 31, 31, 0),
(94, 'Research', 10, 31, 31, 0),
(95, 'Computer', 10, 31, 31, 0),
(96, 'AP', 10, 31, 31, 0),
(97, 'Physics', 10, 31, 31, 0),
(98, 'Math', 2, 31, 32, 0),
(99, 'Mother Tongue', 2, 31, 32, 0),
(100, 'Filipino', 2, 31, 32, 0),
(101, 'English', 2, 31, 32, 0),
(102, 'Science', 2, 31, 32, 0),
(103, 'MAPEH', 2, 31, 32, 0),
(104, 'Computer', 2, 31, 32, 0),
(105, 'Araling Panlipunan', 2, 31, 32, 0),
(106, 'Filipino', 7, 31, 33, 0),
(107, 'English', 7, 31, 33, 0),
(108, 'Math', 7, 31, 33, 0),
(109, 'Science', 7, 31, 33, 0),
(110, 'AP', 7, 31, 33, 0),
(111, 'TLE', 7, 31, 33, 0),
(112, 'MAPEH', 7, 31, 33, 0),
(113, 'Computer', 7, 31, 33, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `m_name` varchar(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(2) NOT NULL COMMENT '1 = admin, 2 = student, 3 = teacher, 4 = registrar',
  `section` int(11) NOT NULL,
  `year_level` int(2) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `f_name`, `l_name`, `m_name`, `email`, `username`, `password`, `type`, `section`, `year_level`) VALUES
(1, 'Jhun', 'Tabudlong', 'E', '', 'admin', 'admin', 1, 0, -1),
(29, 'registrar', 'registrar', 'r', '', 'reg', 'reg', 4, 0, -1),
(30, 'reg', 'reg', 'r', '', 'regis', 'password', 4, 0, -1),
(31, 'teacher', 'teacher', 't', '', 'teacher', 'Password', 3, 0, -1),
(32, 'student', 'student', 's', '', 'student', 'qwerty', 2, 24, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `predefine_subject`
--
ALTER TABLE `predefine_subject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `predefine_subject`
--
ALTER TABLE `predefine_subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
