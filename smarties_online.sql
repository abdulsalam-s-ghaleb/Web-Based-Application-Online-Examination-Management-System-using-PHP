-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 08:56 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smarties_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `admin_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`, `admin_type`) VALUES
(1, 613, 'Manager'),
(2, 614, 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_text` varchar(255) NOT NULL,
  `createdby_user_id` int(11) NOT NULL,
  `announcement_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_title`, `announcement_text`, `createdby_user_id`, `announcement_date`) VALUES
(3, 'you have test on 13/4/2021', 'please attend the test early , don\'t be late , answer all the question , good luck!', 613, '2021-04-12 04:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_record`
--

CREATE TABLE `announcement_record` (
  `Announcement_record_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_readed` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement_record`
--

INSERT INTO `announcement_record` (`Announcement_record_id`, `announcement_id`, `user_id`, `is_readed`) VALUES
(1, 3, 614, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(30) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_title`, `faculty_id`, `teacher_id`) VALUES
(18, 'Introduction to History', 5, 1),
(19, 'Introduction to Faculty of Arts', 6, 2),
(20, 'Introduction to Faculty of Classics', 7, 3),
(21, 'Introduction to Faculty of Commerce', 8, 4),
(22, 'Introduction to Faculty of Economics', 9, 5),
(23, 'Introduction to Faculty of Education', 10, 6),
(24, 'Introduction to Faculty of Engineering', 11, 7),
(25, 'Introduction to Faculty of Graduate Studies', 12, 8),
(26, 'Introduction to Faculty of Humanities', 13, 9),
(27, 'Introduction to Faculty of Information Technology', 14, 10),
(28, 'Introduction to Faculty of Law', 15, 11),
(29, 'Introduction to Faculty of Management Studies', 16, 12),
(30, 'Introduction to Faculty of Music', 17, 13),
(31, 'Introduction to Faculty of Natural Sciences', 18, 14),
(32, 'Introduction to Faculty of Philosophy', 19, 15),
(33, 'Introduction to Faculty of Political Science', 20, 16);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(30) NOT NULL,
  `exam_title` varchar(100) NOT NULL,
  `exam_datetime` datetime(6) NOT NULL,
  `exam_duration` varchar(100) NOT NULL,
  `total_question` int(100) NOT NULL,
  `created_on` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `status` int(50) NOT NULL,
  `course_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `exam_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_title`, `exam_datetime`, `exam_duration`, `total_question`, `created_on`, `status`, `course_id`, `teacher_id`, `faculty_id`, `exam_code`) VALUES
(2, 'Java', '2021-04-28 12:45:00.000000', '20', 6, '2021-04-11 22:44:15.149800', 1, 18, 1, 5, 'Java555'),
(4, 'C#', '2021-04-29 22:48:00.000000', '2', 2, '2021-04-04 22:49:51.969940', 1, 18, 1, 5, 'C123'),
(5, 'C++', '2021-04-22 22:55:00.000000', '20', 5, '2021-04-11 22:55:27.352493', 1, 18, 1, 5, 'C55123'),
(10, 'Rube', '2021-04-13 00:00:00.000000', '2', 2, '2021-04-12 17:49:09.020490', 1, 18, 1, 5, 'Rube123'),
(12, 'Rube333', '2021-04-21 00:00:00.000000', '3', 3, '2021-04-12 18:30:21.928178', 1, 18, 1, 5, 'Rube777'),
(13, 'Rube', '2021-04-14 00:00:00.000000', '3', 2, '2021-04-12 18:43:17.333617', 1, 18, 1, 7, 'hhh123'),
(14, 'Rube555555', '2021-04-29 00:00:00.000000', '4', 4, '2021-04-12 18:43:48.833725', 0, 28, 1, 15, 'Rube9999'),
(16, 'rrrr', '2021-04-14 15:10:00.000000', '2', 2, '2021-04-12 21:04:33.236727', 0, 18, 1, 5, 'rrrr123'),
(17, 'Go', '2021-04-22 21:46:00.000000', '3', 3, '2021-04-12 21:47:08.015957', 0, 18, 1, 5, 'go'),
(18, 'asd', '2021-04-21 21:47:00.000000', '3', 3, '2021-04-12 21:47:53.523300', 1, 18, 1, 5, 'hhh123'),
(19, 'tttt', '2021-04-14 21:49:00.000000', '3', 5, '2021-04-12 21:49:50.036042', 1, 18, 1, 5, 'Rube123');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(30) NOT NULL,
  `faculty_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_title`) VALUES
(5, 'History'),
(6, 'Faculty of Arts'),
(7, 'Faculty of Classics'),
(8, 'Faculty of Commerce'),
(9, 'Faculty of Economics'),
(10, 'Faculty of Education'),
(11, 'Faculty of Engineering'),
(12, 'Faculty of Graduate Studies'),
(13, 'Faculty of Humanities'),
(14, 'Faculty of Information Technology'),
(15, 'Faculty of Law'),
(16, 'Faculty of Management Studies'),
(17, 'Faculty of Music'),
(18, 'Faculty of Natural Sciences'),
(19, 'Faculty of Philosophy'),
(20, 'Faculty of Political Science'),
(21, 'Notes and References');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(30) NOT NULL,
  `question_title` varchar(200) NOT NULL,
  `answer_option` int(200) NOT NULL,
  `mark` varchar(20) NOT NULL,
  `exam_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_title`, `answer_option`, `mark`, `exam_id`) VALUES
(1, 'array', 1, '2', 2),
(3, 'arrayjava', 3, '2', 2),
(39, 'abc', 2, '2', 4),
(40, 'xyz', 3, '2', 4),
(41, 'what is your name', 1, '10', 17),
(42, 'what is your firend ', 4, '20', 17),
(43, 'what is your brother', 2, '30', 17);

-- --------------------------------------------------------

--
-- Table structure for table `question_opetions`
--

CREATE TABLE `question_opetions` (
  `opetion_id` int(30) NOT NULL,
  `question_id` int(30) NOT NULL,
  `opetion_title` varchar(100) NOT NULL,
  `opetion_number` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_opetions`
--

INSERT INTO `question_opetions` (`opetion_id`, `question_id`, `opetion_title`, `opetion_number`) VALUES
(87, 39, 'abc1', 1),
(88, 39, 'abc2', 2),
(89, 39, 'abc3', 3),
(90, 39, 'abc4', 4),
(91, 40, 'xyz1', 1),
(92, 40, 'xyz2', 2),
(93, 40, 'xyz3', 3),
(94, 40, 'xyz4', 4),
(95, 41, 'salam', 1),
(96, 41, 'hhhhh', 2),
(97, 41, 'qqqq', 3),
(98, 41, 'uuuu', 4),
(99, 42, 'ooooo1', 1),
(100, 42, 'xyz2', 2),
(101, 42, 'ooooo3', 3),
(102, 42, 'radman', 4),
(103, 43, 'uuuu', 1),
(104, 43, 'mohammed', 2),
(105, 43, 'iiiii', 3),
(106, 43, 'ooooo', 4);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `major` varchar(100) NOT NULL,
  `faculty_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`, `major`, `faculty_id`) VALUES
(1, 631, 'History', 5),
(2, 632, 'Faculty of Arts', 6),
(3, 633, 'Faculty of Classics', 7),
(4, 634, 'Faculty of Commerce', 8),
(5, 635, 'Faculty of Economics', 9),
(6, 636, 'Faculty of Education', 10),
(7, 637, 'Faculty of Engineering', 11),
(8, 638, 'Faculty of Graduate Studies', 12),
(9, 639, 'Faculty of Humanities', 13),
(10, 640, 'Faculty of Information Technology', 14),
(11, 641, 'Faculty of Law', 15),
(12, 642, 'Faculty of Management Studies', 16),
(13, 643, 'Faculty of Music', 17),
(14, 644, 'Faculty of Natural Sciences', 18),
(15, 645, 'Faculty of Philosophy', 19),
(16, 646, 'Faculty of Political Science', 20),
(17, 647, 'Notes and References', 21),
(18, 648, 'History', 5),
(19, 649, 'Faculty of Arts', 6),
(20, 650, 'Faculty of Classics', 7),
(21, 651, 'Faculty of Commerce', 8),
(22, 652, 'Faculty of Economics', 9),
(23, 653, 'Faculty of Education', 10),
(24, 654, 'Faculty of Engineering', 11),
(25, 655, 'Faculty of Graduate Studies', 12),
(26, 656, 'Faculty of Humanities', 13),
(27, 657, 'Faculty of Information Technology', 14),
(28, 658, 'Faculty of Law', 15),
(29, 659, 'Faculty of Management Studies', 16),
(30, 660, 'Faculty of Music', 17),
(31, 661, 'Faculty of Natural Sciences', 18),
(32, 662, 'Faculty of Philosophy', 19),
(33, 663, 'Faculty of Political Science', 20),
(34, 664, 'Notes and References', 21),
(35, 665, 'Faculty of Commerce', 8),
(36, 666, 'Faculty of Economics', 9),
(37, 667, 'Faculty of Education', 10),
(38, 668, 'Faculty of Engineering', 11),
(39, 669, 'Faculty of Graduate Studies', 12),
(40, 670, 'Faculty of Humanities', 13),
(41, 671, 'Faculty of Law', 15),
(42, 672, 'Faculty of Management Studies', 16),
(43, 673, 'Faculty of Music', 17),
(44, 674, 'Faculty of Natural Sciences', 18),
(45, 675, 'Faculty of Philosophy', 19),
(46, 676, 'History', 5),
(47, 677, 'Faculty of Arts', 6),
(48, 678, 'Faculty of Classics', 7),
(49, 679, 'Faculty of Commerce', 8),
(50, 680, 'Faculty of Economics', 9),
(51, 681, 'Faculty of Education', 10),
(52, 682, 'Faculty of Engineering', 11),
(53, 683, 'Faculty of Graduate Studies', 12),
(54, 684, 'Faculty of Humanities', 13),
(55, 685, 'Faculty of Information Technology', 14),
(56, 686, 'Faculty of Law', 15),
(57, 687, 'Faculty of Management Studies', 16),
(58, 688, 'Faculty of Music', 17),
(59, 689, 'Faculty of Natural Sciences', 18),
(60, 690, 'Faculty of Philosophy', 19),
(61, 691, 'Faculty of Political Science', 20),
(62, 692, 'Notes and References', 21),
(63, 693, 'History', 5),
(64, 694, 'Faculty of Arts', 6),
(65, 695, 'Faculty of Classics', 7),
(66, 696, 'Faculty of Commerce', 8),
(67, 697, 'Faculty of Economics', 9),
(68, 698, 'Faculty of Education', 10),
(69, 699, 'Faculty of Engineering', 11),
(70, 700, 'Faculty of Graduate Studies', 12),
(71, 701, 'Faculty of Humanities', 13),
(72, 702, 'Faculty of Information Technology', 14),
(73, 703, 'Faculty of Law', 15),
(74, 704, 'Faculty of Management Studies', 16),
(75, 705, 'Faculty of Music', 17),
(76, 706, 'Faculty of Natural Sciences', 18),
(77, 707, 'Faculty of Philosophy', 19),
(78, 708, 'Faculty of Political Science', 20),
(79, 709, 'Notes and References', 21),
(80, 710, 'Faculty of Commerce', 8),
(81, 711, 'Faculty of Engineering', 11),
(82, 712, 'Faculty of Graduate Studies', 12),
(83, 713, 'Faculty of Humanities', 13),
(84, 714, 'Faculty of Law', 15);

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `student_record_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `exam_id` int(30) NOT NULL,
  `question_id` int(30) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `mark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_record`
--

INSERT INTO `student_record` (`student_record_id`, `user_id`, `exam_id`, `question_id`, `answer`, `mark`) VALUES
(2, 716, 4, 39, '1', '0'),
(3, 716, 4, 40, '1', '0'),
(4, 716, 4, 39, '2', '2'),
(5, 716, 4, 40, '3', '2'),
(6, 613, 4, 39, '2', '2'),
(7, 613, 4, 40, '3', '2'),
(8, 613, 4, 39, '3', '0'),
(9, 613, 4, 40, '3', '0'),
(10, 613, 17, 41, '2', '0'),
(11, 613, 17, 42, '4', '0'),
(12, 613, 17, 43, '2', '0'),
(13, 616, 17, 41, '2', '0'),
(14, 616, 17, 42, '4', '20'),
(15, 616, 17, 43, '2', '30'),
(16, 616, 4, 39, '1', '0'),
(17, 616, 4, 40, '1', '0'),
(18, 616, 4, 39, '1', '0'),
(19, 616, 4, 40, '1', '0'),
(20, 616, 4, 39, '1', '0'),
(21, 616, 4, 40, '1', '0'),
(22, 616, 4, 39, '1', '0'),
(23, 616, 4, 40, '1', '0'),
(24, 616, 4, 39, '1', '0'),
(25, 616, 4, 40, '1', '0'),
(26, 616, 4, 39, '1', '0'),
(27, 616, 4, 40, '1', '0'),
(28, 616, 4, 39, '1', '0'),
(29, 616, 4, 40, '1', '0'),
(30, 616, 4, 39, '1', '0'),
(31, 616, 4, 40, '1', '0'),
(32, 616, 4, 39, '1', '0'),
(33, 616, 4, 40, '1', '0'),
(34, 616, 4, 39, '1', '0'),
(35, 616, 4, 40, '1', '0'),
(36, 616, 4, 39, '1', '0'),
(37, 616, 4, 40, '1', '0'),
(38, 616, 4, 39, '1', '0'),
(39, 616, 4, 40, '1', '0'),
(40, 616, 4, 39, '1', '0'),
(41, 616, 4, 40, '1', '0'),
(42, 616, 4, 39, '1', '0'),
(43, 616, 4, 40, '1', '0'),
(44, 616, 4, 39, '1', '0'),
(45, 616, 4, 40, '1', '0'),
(46, 616, 4, 39, '1', '0'),
(47, 616, 4, 40, '1', '0'),
(48, 616, 4, 39, '1', '0'),
(49, 616, 4, 40, '1', '0'),
(50, 616, 4, 39, '1', '0'),
(51, 616, 4, 40, '1', '0'),
(52, 616, 4, 39, '1', '0'),
(53, 616, 4, 40, '1', '0'),
(54, 616, 4, 39, '1', '0'),
(55, 616, 4, 40, '1', '0'),
(56, 616, 4, 39, '1', '0'),
(57, 616, 4, 40, '1', '0'),
(58, 616, 4, 39, '1', '0'),
(59, 616, 4, 40, '1', '0'),
(60, 616, 4, 39, '1', '0'),
(61, 616, 4, 40, '1', '0'),
(62, 616, 4, 39, '1', '0'),
(63, 616, 4, 40, '1', '0'),
(64, 616, 4, 39, '1', '0'),
(65, 616, 4, 40, '1', '0'),
(66, 616, 4, 39, '1', '0'),
(67, 616, 4, 40, '1', '0'),
(68, 616, 4, 39, '1', '0'),
(69, 616, 4, 40, '1', '0'),
(70, 616, 4, 39, '1', '0'),
(71, 616, 4, 40, '1', '0'),
(72, 616, 4, 39, '1', '0'),
(73, 616, 4, 40, '1', '0'),
(74, 616, 4, 39, '1', '0'),
(75, 616, 4, 40, '1', '0'),
(76, 616, 4, 39, '1', '0'),
(77, 616, 4, 40, '1', '0'),
(78, 616, 4, 39, '1', '0'),
(79, 616, 4, 40, '1', '0'),
(80, 616, 4, 39, '1', '0'),
(81, 616, 4, 40, '1', '0'),
(82, 616, 4, 39, '1', '0'),
(83, 616, 4, 40, '1', '0'),
(84, 616, 4, 39, '1', '0'),
(85, 616, 4, 40, '1', '0'),
(86, 616, 4, 39, '1', '0'),
(87, 616, 4, 40, '1', '0'),
(88, 616, 4, 39, '1', '0'),
(89, 616, 4, 40, '1', '0'),
(90, 616, 4, 39, '1', '0'),
(91, 616, 4, 40, '1', '0'),
(92, 616, 4, 39, '1', '0'),
(93, 616, 4, 40, '1', '0'),
(94, 616, 4, 39, '1', '0'),
(95, 616, 4, 40, '1', '0'),
(96, 616, 4, 39, '1', '0'),
(97, 616, 4, 40, '1', '0'),
(98, 616, 4, 39, '1', '0'),
(99, 616, 4, 40, '1', '0'),
(100, 616, 4, 39, '1', '0'),
(101, 616, 4, 40, '1', '0'),
(102, 616, 4, 39, '1', '0'),
(103, 616, 4, 40, '1', '0'),
(104, 616, 4, 39, '1', '0'),
(105, 616, 4, 40, '1', '0'),
(106, 616, 4, 39, '1', '0'),
(107, 616, 4, 40, '1', '0'),
(108, 616, 4, 39, '1', '0'),
(109, 616, 4, 40, '1', '0'),
(110, 616, 4, 39, '1', '0'),
(111, 616, 4, 40, '1', '0'),
(112, 616, 4, 39, '1', '0'),
(113, 616, 4, 40, '1', '0'),
(114, 616, 4, 39, '1', '0'),
(115, 616, 4, 40, '1', '0'),
(116, 616, 4, 39, '1', '0'),
(117, 616, 4, 40, '1', '0'),
(118, 616, 4, 39, '1', '0'),
(119, 616, 4, 40, '1', '0'),
(120, 616, 4, 39, '1', '0'),
(121, 616, 4, 40, '1', '0'),
(122, 616, 4, 39, '1', '0'),
(123, 616, 4, 40, '1', '0'),
(124, 616, 4, 39, '1', '0'),
(125, 616, 4, 40, '1', '0'),
(126, 616, 4, 39, '1', '0'),
(127, 616, 4, 40, '1', '0'),
(128, 616, 4, 39, '1', '0'),
(129, 616, 4, 40, '1', '0'),
(130, 616, 4, 39, '1', '0'),
(131, 616, 4, 40, '1', '0'),
(132, 616, 4, 39, '1', '0'),
(133, 616, 4, 40, '1', '0'),
(134, 616, 4, 39, '1', '0'),
(135, 616, 4, 40, '1', '0'),
(136, 616, 4, 39, '1', '0'),
(137, 616, 4, 40, '1', '0'),
(138, 616, 4, 39, '1', '0'),
(139, 616, 4, 40, '1', '0'),
(140, 616, 4, 39, '1', '0'),
(141, 616, 4, 40, '1', '0'),
(142, 616, 4, 39, '1', '0'),
(143, 616, 4, 40, '1', '0'),
(144, 616, 4, 39, '1', '0'),
(145, 616, 4, 40, '1', '0'),
(146, 616, 4, 39, '1', '0'),
(147, 616, 4, 40, '1', '0'),
(148, 616, 4, 39, '1', '0'),
(149, 616, 4, 40, '1', '0'),
(150, 616, 4, 39, '1', '0'),
(151, 616, 4, 40, '1', '0'),
(152, 616, 4, 39, '1', '0'),
(153, 616, 4, 40, '1', '0'),
(154, 616, 4, 39, '1', '0'),
(155, 616, 4, 40, '1', '0'),
(156, 616, 4, 39, '1', '0'),
(157, 616, 4, 40, '1', '0'),
(158, 616, 4, 39, '1', '0'),
(159, 616, 4, 40, '1', '0'),
(160, 616, 4, 39, '1', '0'),
(161, 616, 4, 40, '1', '0'),
(162, 616, 4, 39, '1', '0'),
(163, 616, 4, 40, '1', '0'),
(164, 616, 4, 39, '1', '0'),
(165, 616, 4, 40, '1', '0'),
(166, 616, 4, 39, '1', '0'),
(167, 616, 4, 40, '1', '0'),
(168, 616, 4, 39, '1', '0'),
(169, 616, 4, 40, '1', '0'),
(170, 616, 4, 39, '1', '0'),
(171, 616, 4, 40, '1', '0'),
(172, 616, 4, 39, '1', '0'),
(173, 616, 4, 40, '1', '0'),
(174, 616, 4, 39, '1', '0'),
(175, 616, 4, 40, '1', '0'),
(176, 616, 4, 39, '3', '0'),
(177, 616, 4, 40, '3', '2'),
(178, 616, 4, 39, '1', '0'),
(179, 616, 4, 40, '1', '0'),
(180, 616, 4, 39, '1', '0'),
(181, 616, 4, 40, '1', '0'),
(182, 616, 4, 39, '1', '0'),
(183, 616, 4, 40, '1', '0'),
(184, 616, 4, 39, '1', '0'),
(185, 616, 4, 40, '1', '0'),
(186, 616, 4, 39, '1', '0'),
(187, 616, 4, 40, '1', '0'),
(188, 616, 4, 39, '1', '0'),
(189, 616, 4, 40, '1', '0'),
(190, 616, 4, 39, '1', '0'),
(191, 616, 4, 40, '1', '0'),
(192, 616, 4, 39, '1', '0'),
(193, 616, 4, 40, '1', '0'),
(194, 616, 4, 39, '1', '0'),
(195, 616, 4, 40, '1', '0'),
(196, 616, 4, 39, '1', '0'),
(197, 616, 4, 40, '1', '0'),
(198, 616, 4, 39, '1', '0'),
(199, 616, 4, 40, '1', '0'),
(200, 616, 4, 39, '1', '0'),
(201, 616, 4, 40, '1', '0'),
(202, 616, 4, 39, '1', '0'),
(203, 616, 4, 40, '1', '0'),
(204, 616, 4, 39, '1', '0'),
(205, 616, 4, 40, '1', '0'),
(206, 616, 4, 39, '1', '0'),
(207, 616, 4, 40, '1', '0'),
(208, 616, 4, 39, '1', '0'),
(209, 616, 4, 40, '1', '0'),
(210, 616, 4, 39, '1', '0'),
(211, 616, 4, 40, '1', '0'),
(212, 616, 4, 39, '1', '0'),
(213, 616, 4, 40, '1', '0'),
(214, 616, 4, 39, '1', '0'),
(215, 616, 4, 40, '1', '0'),
(216, 616, 4, 39, '1', '0'),
(217, 616, 4, 40, '1', '0'),
(218, 616, 4, 39, '1', '0'),
(219, 616, 4, 40, '1', '0'),
(220, 616, 4, 39, '1', '0'),
(221, 616, 4, 40, '1', '0'),
(222, 616, 4, 39, '1', '0'),
(223, 616, 4, 40, '1', '0'),
(224, 616, 4, 39, '1', '0'),
(225, 616, 4, 40, '1', '0'),
(226, 616, 4, 39, '1', '0'),
(227, 616, 4, 40, '1', '0'),
(228, 616, 4, 39, '1', '0'),
(229, 616, 4, 40, '1', '0'),
(230, 616, 4, 39, '1', '0'),
(231, 616, 4, 40, '1', '0'),
(232, 616, 4, 39, '1', '0'),
(233, 616, 4, 40, '1', '0'),
(234, 616, 4, 39, '1', '0'),
(235, 616, 4, 40, '1', '0'),
(236, 616, 4, 39, '1', '0'),
(237, 616, 4, 40, '1', '0'),
(238, 616, 4, 39, '1', '0'),
(239, 616, 4, 40, '1', '0'),
(240, 616, 4, 39, '1', '0'),
(241, 616, 4, 40, '1', '0'),
(242, 616, 4, 39, '1', '0'),
(243, 616, 4, 40, '1', '0'),
(244, 616, 4, 39, '1', '0'),
(245, 616, 4, 40, '1', '0'),
(246, 616, 4, 39, '1', '0'),
(247, 616, 4, 40, '1', '0'),
(248, 616, 4, 39, '1', '0'),
(249, 616, 4, 40, '1', '0'),
(250, 616, 4, 39, '1', '0'),
(251, 616, 4, 40, '1', '0'),
(252, 614, 4, 39, '1', '0'),
(253, 614, 4, 40, '1', '0'),
(254, 614, 4, 39, '1', '0'),
(255, 614, 4, 40, '1', '0'),
(256, 614, 4, 39, '4', '0'),
(257, 614, 4, 40, '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `teacher_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `user_id`, `faculty_id`, `teacher_type`) VALUES
(1, 615, 5, 'Lecturer'),
(2, 616, 6, 'Lecturer'),
(3, 617, 7, 'Lecturer'),
(4, 618, 8, 'Lecturer'),
(5, 619, 9, 'Lecturer'),
(6, 620, 10, 'Lecturer'),
(7, 621, 11, 'Lecturer'),
(8, 622, 12, 'Lecturer'),
(9, 623, 13, 'Lecturer'),
(10, 624, 14, 'Lecturer'),
(11, 625, 15, 'Lecturer'),
(12, 626, 16, 'Lecturer'),
(13, 627, 17, 'Lecturer'),
(14, 628, 18, 'Lecturer'),
(15, 629, 19, 'Lecturer'),
(16, 630, 20, 'Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(30) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile_No` varchar(30) NOT NULL,
  `user_image` varchar(30) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `username`, `password`, `gender`, `address`, `mobile_No`, `user_image`, `role`) VALUES
(613, 'Mohammed', 'Radman', 'mohammedrdmn5@gmail.com', 'rdmn', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Male', 'nilai', '18018018', '3470-1835-blackboard.jpg', 0),
(614, 'salam222', 'salam2333', 'salam@ggg.com1', 'salam', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Male', 'nilai11', '123', 'null.png', 0),
(615, 'Brynn', 'Isaac', '', 'Brynn', 'a2c1f717a381ac60b4527cbdbce30ac4fc2392ba', 'Male', 'P.O. Box 436, 3161 Parturient Ave', '(595) 896-3012', 'null.png', 1),
(616, 'Tanner', 'Jason', '', 'Tanner', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Female', 'Ap #688-6518 Hendrerit Rd.', '(181) 186-9780', 'null.png', 1),
(617, 'Donna', 'Branden', '', 'Donna', 'e5abce0af5b1bb579b2a18b3de4a9cbfc26e5eda', 'Male', '4348 Aliquam, Av.', '(108) 884-5621', 'null.png', 1),
(618, 'Fritz', 'Brian', '', 'Fritz', '74287911e74087a7dc2f933d226e772e988cc820', 'Female', 'P.O. Box 783, 7023 Parturient Street', '(994) 664-3841', 'null.png', 1),
(619, 'Hasad', 'Cyrus', '', 'Hasad', '6dc7d9eac0a1f7c181f8f2d7b0476985794787ae', 'Male', 'Ap #375-898 Non Rd.', '(435) 831-7781', 'null.png', 1),
(620, 'Ignatius', 'Zachary', '', 'Ignatius', '106d24e81c378af5fb4a276571bc940d1947bb6c', 'Female', '2364 Id, Rd.', '(803) 622-4886', 'null.png', 1),
(621, 'Kay', 'Keith', '', 'Kay', '6d3ebd3641bc7213fbc55f7bfe55cba241f8332b', 'Male', '621-5231 Lobortis Road', '(918) 139-5025', 'null.png', 1),
(622, 'Malachi', 'Daquan', '', 'Malachiii', 'd6a0090f1a24f4e5224a3bc5dda92af9d0c63374', 'Female', '2217 Eu, St.', '(255) 508-2557', 'null.png', 1),
(623, 'Blaine', 'Luke', '', 'Blaine', '728f52ca0108063342eb215f13dc8081395db390', 'Male', '981-2917 Commodo Ave', '(729) 675-7727', 'null.png', 1),
(624, 'Chelsea', 'Alexander', '', 'Chelsea', 'e60a0065464bed446f4ed374227c700a5fb5914d', 'Female', '494-2006 Duis Rd.', '(689) 462-2355', 'null.png', 1),
(625, 'Kibo', 'Marshall', '', 'Kiboo', '4daa0ad1e7e9e68a017ca5020f40676d60773c47', 'Male', 'P.O. Box 260, 955 Elit St.', '(131) 850-2461', 'null.png', 1),
(626, 'Noah', 'Tanek', '', 'Noah', '5d1cf52b151ae36dbf1f20df985a6cd9d6831896', 'Female', '529-4973 Mi Road', '(119) 967-1236', 'null.png', 1),
(627, 'Christopher', 'Beck', '', 'Christopher', 'a9f68714c80c5754b8a7c913b78920940a369f80', 'Male', 'Ap #851-9406 Id, Road', '(422) 592-6695', 'null.png', 1),
(628, 'Cade', 'Ivan', '', 'Cade', 'c30a558ef78b8f8ea362393763f37e6e64662f08', 'Female', 'P.O. Box 974, 2771 Ac Road', '(256) 931-4752', 'null.png', 1),
(629, 'Imelda', 'Kenneth', '', 'Imelda', '30a1aa4ce865a888812f45f8a76200eec46752f8', 'Male', 'Ap #242-7305 Dictum St.', '(324) 696-2142', 'null.png', 1),
(630, 'Porter', 'Graiden', '', 'Porter', 'd5593663575266cb46e332f64789dc1bcb50a5a3', 'Female', 'P.O. Box 518, 1990 Pretium Av.', '(915) 316-9500', 'null.png', 1),
(631, 'Grady', 'Kato', '', 'Grady', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Male', '903-704 Quisque Street', '(213) 332-6964', 'null.png', 2),
(632, 'Beverly', 'Neville', '', 'Beverlyy', 'fafb3058a58a30b07e9fa8d81beb1df12c8b0dce', 'Female', 'Ap #382-2794 Risus. Rd.', '(502) 695-3916', 'null.png', 2),
(633, 'Charles', 'Richard', '', 'Charles', 'f6883c6a39c79314577e974ecf14cd1a9ae17cee', 'Male', 'Ap #156-7449 Eros. Av.', '(582) 539-3486', 'null.png', 2),
(634, 'Serena', 'Amal', '', 'Serena', 'e87352099e1acb5d5399adfc9639b48c27f3d64d', 'Female', '2552 Dolor St.', '(509) 630-3774', 'null.png', 2),
(635, 'Lenore', 'Joel', '', 'Lenore', 'b309b43a05bdbde54d02bbac481be7aef82b3196', 'Male', '798-5606 Nunc St.', '(242) 425-1886', 'null.png', 2),
(636, 'Aladdin', 'Jermaine', '', 'Aladdin', '727c10c941b6219712da1a7525f696f837b1c6a1', 'Female', '472-6130 Consectetuer Rd.', '(210) 533-5263', 'null.png', 2),
(637, 'Jelani', 'Trevor', '', 'Jelani', 'd268f45e1a7c693e4a2c2fd925672116a2a55da6', 'Male', 'P.O. Box 796, 1072 Est, Rd.', '(298) 731-9838', 'null.png', 2),
(638, 'Garrett', 'Logan', '', 'Garrett', '6ae5bd09258a15042e51db798ae5cdc995655c8e', 'Female', '918-720 Accumsan Avenue', '(456) 157-3137', 'null.png', 2),
(639, 'Ashely', 'Quinlan', '', 'Ashely', 'd6eed35567af8ead8fb2556e3c2090f73290763e', 'Male', 'P.O. Box 413, 8410 Curabitur Rd.', '(349) 649-0096', 'null.png', 2),
(640, 'Zeus', 'Connor', '', 'Zeus', 'dcccad8e21dcc80ec5fe5d4b5f4e15687a882938', 'Female', 'Ap #669-2567 Aenean Street', '(492) 245-1877', 'null.png', 2),
(641, 'Garth', 'Aristotle', '', 'Garth', 'd6b976eadc79c0bbfb5dc8016b5d9b9d1d9690a5', 'Male', 'Ap #934-8150 Neque. St.', '(456) 124-0448', 'null.png', 2),
(642, 'Dexter', 'Carlos', '', 'Dexter', '752cf76615c3bb32ade8802dff0d154d4eb594f4', 'Female', 'P.O. Box 347, 4910 Donec Avenue', '(383) 862-3725', 'null.png', 2),
(643, 'Steven', 'Ulysses', '', 'Steven', 'd8614f7ddb75600da7585bf56e5f52ff44224592', 'Male', 'Ap #274-4645 Dictum St.', '(551) 382-4812', 'null.png', 2),
(644, 'Herman', 'Basil', '', 'Herman', 'e40bf677a12025b6ef8dc3e4283bc86edb48862a', 'Female', 'Ap #297-3170 Nisl. St.', '(725) 270-1249', 'null.png', 2),
(645, 'Quamar', 'Gavin', '', 'Quamar', '9cd1baa1c4be928f0a0b3fcc33c7f6a593233271', 'Male', '621 Et, Ave', '(236) 251-9835', 'null.png', 2),
(646, 'Davis', 'Ahmed', '', 'Davis', 'c1528f98c5cfa615d67410affd36554dcbfc740d', 'Female', '535-2049 Donec Rd.', '(912) 896-4601', 'null.png', 2),
(647, 'Orla', 'Patrick', '', 'Orla', 'd84af993cc895069452d0b01ab6d872bcd60fc24', 'Male', 'P.O. Box 140, 7056 Metus. Ave', '(167) 806-8188', 'null.png', 2),
(648, 'Kerry', 'Edward', '', 'Kerry', 'bbb0982af184a7c1ba3d7d050cf5ca8bc3489797', 'Female', 'P.O. Box 122, 5965 Magna Rd.', '(834) 493-7511', 'null.png', 2),
(649, 'Abdul', 'Levi', '', 'Abdul', '970ad1f6f1082b5f1f9aae84c5d03b648760b03d', 'Male', '300-2591 Quam. St.', '(211) 578-4283', 'null.png', 2),
(650, 'Sean', 'Wayne', '', 'Sean', 'f719bc1a25cb068e92363eccdaffdb2f48c61009', 'Female', 'Ap #344-3351 Orci Rd.', '(567) 675-0080', 'null.png', 2),
(651, 'Blythe', 'Talon', '', 'Blythe', '20c8688a1e981c9277114b649fc2529333e9bb02', 'Male', '423-9926 Vel Rd.', '(334) 179-3640', 'null.png', 2),
(652, 'Alec', 'Jeremy', '', 'Alec', 'cb6bf2d657c76c566b440a6fd7444e5aa5979535', 'Female', 'Ap #143-3444 Sagittis St.', '(950) 902-3574', 'null.png', 2),
(653, 'Quinlan', 'Perry', '', 'Quinlan', 'a67322323fbc26c35b0bbce5e61d306ec2a5f132', 'Male', '176-3114 Cursus. Ave', '(557) 807-9699', 'null.png', 2),
(654, 'Inez', 'Carlos', '', 'Inez', '752cf76615c3bb32ade8802dff0d154d4eb594f4', 'Female', '4421 Curabitur Av.', '(586) 937-9107', 'null.png', 2),
(655, 'Alma', 'Stuart', '', 'Alma', 'f99810d3d538b901da8d5818621afd17efc2cf57', 'Male', 'Ap #189-7047 Cras Road', '(519) 466-3846', 'null.png', 2),
(656, 'Charlotte', 'Ezra', '', 'Charlotte', '8e6694cbe102b7ef8bbb0a7f83d675d9e6dad543', 'Female', 'P.O. Box 227, 3340 Est. St.', '(356) 783-2095', 'null.png', 2),
(657, 'Curran', 'Felix', '', 'Curran', 'a7b55d09d0ff2a114fe8d62b354048ce19966d0a', 'Male', '2173 Luctus Ave', '(615) 605-6509', 'null.png', 2),
(658, 'Andrew', 'Cameron', '', 'Andrew', '1e9d8845662dec7eeb2537fa13e031a812cd0651', 'Female', 'Ap #558-8758 Quisque Av.', '(913) 815-0624', 'null.png', 2),
(659, 'Fuller', 'Otto', '', 'Fuller', '70d635f3a6f286b252b3a47ae106e6b31dae1598', 'Male', '2663 Eget Street', '(706) 755-1022', 'null.png', 2),
(660, 'Stewart', 'Wylie', '', 'Stewart', 'ad8a768f3877b1e462f7d3e8b5acc387437d6a56', 'Female', '765-8100 Tincidunt Rd.', '(187) 693-4365', 'null.png', 2),
(661, 'Amos', 'Isaiah', '', 'Amos', '89f6d4f449a4e2293e40842c410a3a3187bc74f3', 'Male', 'P.O. Box 974, 1928 Morbi St.', '(265) 348-3734', 'null.png', 2),
(662, 'Kimberley', 'Phelan', '', 'Kimberley', '30c64837deb2d392d82a1cf569b1202fb5643444', 'Female', 'Ap #967-4326 Nisi Road', '(817) 220-0049', 'null.png', 2),
(663, 'Summer', 'Harrison', '', 'Summer', 'dee5f5e6bdfc319c9e45e5a441b0d60ad25682f8', 'Male', '336-7422 Tincidunt, Street', '(930) 449-2174', 'null.png', 2),
(664, 'Edan', 'Porter', '', 'Edan', '4925638b23b3ac259c458b4157ba7fa8a8253d40', 'Female', '7526 Phasellus Street', '(900) 359-2593', 'null.png', 2),
(665, 'Ciara', 'August', '', 'Ciara', '1ad63e0c2c051526ea357e949246fadc756b9693', 'Male', 'Ap #181-2271 Amet, Avenue', '(566) 305-2384', 'null.png', 2),
(666, 'Steel', 'Warren', '', 'Steel', 'a303ab76cc03f59b3332e826160e6f4cd9a37053', 'Female', 'Ap #124-2994 Nonummy Avenue', '(749) 317-4681', 'null.png', 2),
(667, 'Sophia', 'Berk', '', 'Sophia', '77b90262ccdb9e01add544955e40526cd30ad391', 'Male', 'P.O. Box 126, 5073 Quisque Road', '(331) 177-1312', 'null.png', 2),
(668, 'Chaim', 'Odysseus', '', 'Chaim', '8b5283ccbdbf0013aeac96c815c2e3f40ff0f3e3', 'Female', 'Ap #740-8069 Pede Street', '(417) 972-3165', 'null.png', 2),
(669, 'Jin', 'Graham', '', 'Jin', '749688f3b57f3bfcf2d279eaf44a651f10282524', 'Male', 'P.O. Box 583, 5776 Odio. Rd.', '(492) 356-4010', 'null.png', 2),
(670, 'Yuli', 'Sylvester', '', 'Yuli', 'fd7020696add5d529345daefdd283ce78a7fc0ef', 'Female', '345-9584 Aenean Rd.', '(927) 125-6354', 'null.png', 2),
(671, 'Jameson', 'Quentin', '', 'Jameson', '998a7c147b834ab0d5e6f50dea67514012778e43', 'Male', 'Ap #461-4451 Turpis. Street', '(222) 404-1983', 'null.png', 2),
(672, 'Ezekiel', 'Allistair', '', 'Ezekiel', '6cd72914832380a401dac49af738405fef221de7', 'Female', '420-9871 Sed Rd.', '(994) 727-2391', 'null.png', 2),
(673, 'Zeph', 'Aidan', '', 'Zeph', 'ac6d2a72937e3cbf7acdcd40d884d4616af59a77', 'Male', 'P.O. Box 805, 9057 Nisl. Av.', '(827) 239-0539', 'null.png', 2),
(674, 'Olympia', 'Malachi', '', 'Olympia', '79f65e033a75e3e36f625e5d535d64d4cd3917d9', 'Female', '7139 Eget, Road', '(299) 397-0248', 'null.png', 2),
(675, 'Megan', 'Ferdinand', '', 'Megan', 'd5d5bcf3ad194b1f224c6ee067225b81e72d71cb', 'Male', 'Ap #312-2749 Nec Rd.', '(321) 583-8365', 'null.png', 2),
(676, 'Lacey', 'Kennedy', '', 'Lacey', 'ace08e1f6acc2ae89f147ae716585caa1de1fa28', 'Female', 'P.O. Box 288, 7402 Elit, Avenue', '(164) 890-9419', 'null.png', 2),
(677, 'Giselle', 'Micah', '', 'Giselle', '832c83362bbd05192c52527520489c90218a8f07', 'Male', 'P.O. Box 346, 6420 Eget St.', '(865) 335-6208', 'null.png', 2),
(678, 'Conan', 'Thomas', '', 'Conan', '598ff88e2f5f157038d4c2e8cd3bc29747bee303', 'Female', 'P.O. Box 561, 2090 Morbi St.', '(821) 445-2951', 'null.png', 2),
(679, 'Odette', 'Todd', '', 'Odette', 'dae7a106cd3c455d304ffa941753557993c04590', 'Male', 'P.O. Box 836, 3914 Cursus Rd.', '(925) 554-8700', 'null.png', 2),
(680, 'Jescie', 'Lionel', '', 'Jescie', '22462717f4c6ddc53ecab079cef81867b10a8e48', 'Female', 'P.O. Box 267, 2450 Sem Road', '(584) 557-7001', 'null.png', 2),
(681, 'Burke', 'Reese', '', 'Burke', '4ca2c39e8e4812e4c6097ac3f101b24f69b74faa', 'Male', '8336 Non, St.', '(594) 326-3317', 'null.png', 2),
(682, 'Berk', 'Carl', '', 'Berk', 'a9eec2731703a50446ae2bdfa31f5fab5998e85a', 'Female', 'Ap #651-6218 Ultrices Road', '(958) 724-3571', 'null.png', 2),
(683, 'Alexandra', 'Graiden', '', 'Alexandra', 'd5593663575266cb46e332f64789dc1bcb50a5a3', 'Male', 'P.O. Box 730, 9763 Erat St.', '(569) 395-3465', 'null.png', 2),
(684, 'Avye', 'Dieter', '', 'Avye', 'c08f51ae716b4c9f28394c4168be75b086cea44a', 'Female', 'P.O. Box 942, 5733 Vel, Rd.', '(469) 907-6404', 'null.png', 2),
(685, 'Edward', 'Nero', '', 'Edward', '947f542f5e4e623d99af50104efd23a15cd81aa7', 'Male', 'P.O. Box 820, 2057 Mauris Road', '(321) 695-9418', 'null.png', 2),
(686, 'Yasir', 'Ivan', '', 'Yasir', 'c30a558ef78b8f8ea362393763f37e6e64662f08', 'Female', 'P.O. Box 279, 5038 Dolor. St.', '(228) 773-5618', 'null.png', 2),
(687, 'Velma', 'Driscoll', '', 'Velma', 'b0b095c7e671fe7cde2828fa0e5c0eaea10ad8e6', 'Male', '110-8859 Mollis St.', '(582) 402-9517', 'null.png', 2),
(688, 'Louis', 'Bevis', '', 'Louis', 'd751e068da0634d6147d385ffb8aac57765c31fb', 'Female', 'Ap #841-3392 Ultrices. Rd.', '(616) 242-4185', 'null.png', 2),
(689, 'Orson', 'Benjamin', '', 'Orson', '38a89b01477ac45cb051d74fed022aaa6904858a', 'Male', 'Ap #448-9040 Nascetur Road', '(907) 125-1870', 'null.png', 2),
(690, 'Malachi', 'Gil', '', 'Malachi', 'e5e28267a9098e1e1b96e9349cc0633ab863e295', 'Female', 'Ap #765-9770 Facilisis St.', '(462) 678-7897', 'null.png', 2),
(691, 'Vielka', 'Eric', '', 'Vielka', '7c2df89907d529b20e600bb06fff825233986519', 'Male', '171-6580 Litora Street', '(483) 631-9020', 'null.png', 2),
(692, 'Abel', 'Dillon', '', 'Abel', '2b809361bb905172348a96dc6b14724e39baa05e', 'Female', '960-9469 Ullamcorper, Street', '(500) 738-9979', 'null.png', 2),
(693, 'Yeo', 'Daniel', '', 'Yeo', '0f8da7d601f96476d68203abfaf294cb98776526', 'Male', 'Ap #239-6422 Sed Rd.', '(352) 488-2564', 'null.png', 2),
(694, 'Daphne', 'Omar', '', 'Daphne', '8e16e09e8b888b67262ce241fe872582f079cc60', 'Female', '4733 Dolor Avenue', '(501) 387-8404', 'null.png', 2),
(695, 'Blaze', 'Abel', '', 'Blaze', '1798e432fdc9dfc30a84ff03ba9b43aeb2ad53bc', 'Male', 'Ap #422-1394 Amet Rd.', '(119) 865-9280', 'null.png', 2),
(696, 'Damon', 'Kane', '', 'Damon', '8592fc794697373e0099bfdb43beaa8ce00b4bed', 'Female', '842 Sed Road', '(871) 856-2301', 'null.png', 2),
(697, 'Florence', 'Deacon', '', 'Florence', '7bf056d5302ab4ec0af0907e52436273c9998897', 'Male', 'Ap #981-617 Et Street', '(424) 398-9005', 'null.png', 2),
(698, 'Cally', 'Nathan', '', 'Cally', '1d13d14798fa095e066208d5d6d12ea01a810f6e', 'Female', '7404 Augue Ave', '(648) 267-2968', 'null.png', 2),
(699, 'Leila', 'Malik', '', 'Leila', '5aa4c40df885c02512c568f05888a59ac03baad3', 'Male', 'Ap #339-2548 Vehicula. Av.', '(967) 343-5353', 'null.png', 2),
(700, 'Dominic', 'Rahim', '', 'Dominic', 'baf727119b8c5e4610d223fd071ed8e5a5ee25fc', 'Female', 'P.O. Box 730, 829 Iaculis, St.', '(388) 643-2626', 'null.png', 2),
(701, 'Fletcher', 'Samuel', '', 'Fletcher', '5e9ccf9d1fd0aa580b20d07ed0c912eb47701d05', 'Male', 'P.O. Box 177, 4507 Lorem. Street', '(684) 872-2694', 'null.png', 2),
(702, 'Kibo', 'Maxwell', '', 'Kibo', '5a36d4e629c8496a27a0c4ebfe18c09c81bb0dfe', 'Female', 'Ap #449-2726 Rutrum Ave', '(842) 787-6100', 'null.png', 2),
(703, 'Darrel', 'Gregory', '', 'Darrel', 'c20bffe2f611eae97a2dae1dc1537c4337a8e998', 'Male', 'P.O. Box 391, 8384 Sit St.', '(422) 951-4133', 'null.png', 2),
(704, 'Octavius', 'Ezra', '', 'Octavius', '8e6694cbe102b7ef8bbb0a7f83d675d9e6dad543', 'Female', '567 Turpis Street', '(515) 839-4238', 'null.png', 2),
(705, 'Freya', 'Grady', '', 'Freya', '9960d3e8704756fad13f19c8c6f070b05d4172a6', 'Male', 'P.O. Box 645, 4342 Ut St.', '(557) 793-4371', 'null.png', 2),
(706, 'Kato', 'Rahim', '', 'Kato', 'baf727119b8c5e4610d223fd071ed8e5a5ee25fc', 'Female', 'P.O. Box 975, 9707 Lobortis Av.', '(177) 385-8410', 'null.png', 2),
(707, 'Echo', 'Tucker', '', 'Echo', 'e058cc1a8b57152e07cc94c37a142314a330c89e', 'Male', 'Ap #489-5035 Enim. Av.', '(279) 981-1343', 'null.png', 2),
(708, 'Joy', 'Beau', '', 'Joy', 'd72d5f16a880827c83be0bcb748660cf91854041', 'Female', 'P.O. Box 592, 2125 Lorem Road', '(163) 904-9300', 'null.png', 2),
(709, 'Fitzgerald', 'Victor', '', 'Fitzgerald', '906551c1e2561860b7f0c0b62d862a40ebd8aadc', 'Male', 'P.O. Box 590, 6954 Donec Ave', '(465) 521-2150', 'null.png', 2),
(710, 'Lara', 'Aristotle', '', 'Lara', 'd6b976eadc79c0bbfb5dc8016b5d9b9d1d9690a5', 'Female', '626-6993 Commodo St.', '(860) 565-0519', 'null.png', 2),
(711, 'Kim', 'Sawyer', '', 'Kim', 'a81ba0a827c6b18e6b40d23d7ce93349d4b830c2', 'Male', '933-2259 Congue Av.', '(738) 562-8556', 'null.png', 2),
(712, 'Beverly', 'Chaim', '', 'Beverly', '1ece43b75e2ae626948e67c722a9678b8dcc712d', 'Female', 'P.O. Box 187, 5324 Convallis Rd.', '(175) 221-0586', 'null.png', 2),
(713, 'Mira', 'Perry', '', 'Mira', 'a67322323fbc26c35b0bbce5e61d306ec2a5f132', 'Male', 'Ap #286-1655 Diam Avenue', '(299) 757-4334', 'null.png', 2),
(714, 'Jessamine', 'Isaac', '', 'Jessamine', 'a2c1f717a381ac60b4527cbdbce30ac4fc2392ba', 'Female', '520-301 Ipsum. Road', '(528) 647-2430', 'null.png', 2),
(715, 'ad', 'asdsa', '313@wqeq.com', 'salam22', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '123', '', 2),
(716, 'Abdulsalam', 'sultan', 'ads@asd.asd', 'salam11', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '123', 'null.png', 2),
(717, 'salam', 'asdsa', 'a00m6783429@gmail.com', 'salam20', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '123', 'null.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `FK_Announcement_user_user_id` (`createdby_user_id`);

--
-- Indexes for table `announcement_record`
--
ALTER TABLE `announcement_record`
  ADD PRIMARY KEY (`Announcement_record_id`),
  ADD KEY `FK_Announcement_record_announcement_announcement_id` (`announcement_id`),
  ADD KEY `FK_Announcement_record_user_user_id` (`user_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `UK_faculty_faculty_id` (`faculty_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `question_opetions`
--
ALTER TABLE `question_opetions`
  ADD PRIMARY KEY (`opetion_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`student_record_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement_record`
--
ALTER TABLE `announcement_record`
  MODIFY `Announcement_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `question_opetions`
--
ALTER TABLE `question_opetions`
  MODIFY `opetion_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_record_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=718;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `FK_Announcement_user_user_id` FOREIGN KEY (`createdby_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `announcement_record`
--
ALTER TABLE `announcement_record`
  ADD CONSTRAINT `FK_Announcement_record_announcement_announcement_id` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`announcement_id`),
  ADD CONSTRAINT `FK_Announcement_record_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_course_faculty_faculty_id` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `FK_course_teacher_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `FK_exam_course_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_exam_faculty_faculty_id` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `FK_exam_teacher_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_question_exam_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`);

--
-- Constraints for table `question_opetions`
--
ALTER TABLE `question_opetions`
  ADD CONSTRAINT `FK_question_opetions_question_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_student_faculty_faculty_id` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `FK_student_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `student_record`
--
ALTER TABLE `student_record`
  ADD CONSTRAINT `FK_student_record_exam_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`),
  ADD CONSTRAINT `FK_student_record_question_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`),
  ADD CONSTRAINT `FK_student_record_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `FK_teacher_faculty_faculty_id` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `FK_teacher_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
