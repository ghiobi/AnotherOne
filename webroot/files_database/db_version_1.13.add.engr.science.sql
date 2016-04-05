-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: us-cdbr-iron-east-03.cleardb.net
-- Generation Time: Feb 25, 2016 at 09:56 PM
-- Server version: 5.5.45-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heroku_77d1494b686e472`
--
CREATE DATABASE IF NOT EXISTS `heroku_77d1494b686e472` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `heroku_77d1494b686e472`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `coursecorequisite`
--

DROP TABLE IF EXISTS `coursecorequisite`;
CREATE TABLE `coursecorequisite` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `corequisite_course_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=192 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursecorequisite`
--

INSERT INTO `coursecorequisite` (`id`, `course_id`, `corequisite_course_id`) VALUES
(1, 37, 40),
(2, 40, 29),
(3, 62, 61),
(4, 6, 89),
(5, 8, 7),
(6, 10, 8),
(7, 14, 41),
(8, 15, 11),
(9, 20, 14);

-- --------------------------------------------------------

--
-- Table structure for table `courseprequisites`
--

DROP TABLE IF EXISTS `courseprequisites`;
CREATE TABLE `courseprequisites` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `prerequisite_course_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseprequisites`
--

INSERT INTO `courseprequisites` (`id`, `course_id`, `prerequisite_course_id`) VALUES
(1, 2, 31),
(2, 4, 38),
(3, 5, 29),
(4, 5, 32),
(5, 6, 40),
(6, 6, 89),
(7, 7, 6),
(8, 8, 6),
(9, 8, 7),
(10, 9, 8),
(11, 10, 8),
(12, 11, 7),
(13, 12, 89),
(14, 12, 6),
(15, 13, 69),
(16, 13, 70),
(17, 14, 41),
(18, 14, 42),
(19, 14, 6),
(20, 14, 2),
(21, 15, 9),
(22, 15, 11),
(23, 16, 38),
(24, 17, 38),
(25, 18, 7),
(26, 18, 8),
(27, 18, 9),
(28, 19, 9),
(29, 20, 14),
(30, 21, 15),
(31, 26, 24),
(32, 28, 31),
(33, 32, 31),
(34, 33, 27),
(35, 33, 31),
(36, 34, 38),
(37, 35, 29),
(38, 35, 32),
(39, 36, 29),
(40, 37, 40),
(41, 38, 28),
(42, 38, 1),
(43, 38, 40),
(44, 39, 32),
(45, 40, 29),
(46, 40, 32),
(47, 41, 29),
(48, 41, 40),
(49, 42, 40),
(50, 42, 89),
(51, 43, 29),
(52, 43, 32),
(53, 44, 29),
(54, 44, 31),
(55, 45, 29),
(56, 45, 40),
(57, 46, 45),
(58, 47, 38),
(59, 48, 38),
(60, 49, 1),
(61, 49, 28),
(62, 49, 35),
(63, 49, 40),
(64, 50, 38),
(65, 51, 38),
(66, 52, 41),
(67, 53, 29),
(68, 53, 36),
(69, 53, 40),
(70, 54, 40),
(71, 55, 40),
(72, 56, 40),
(73, 57, 43),
(74, 57, 82),
(75, 57, 46),
(76, 58, 43),
(77, 58, 82),
(78, 58, 45),
(79, 59, 40),
(80, 60, 30),
(81, 60, 81),
(82, 60, 40),
(83, 61, 89),
(84, 62, 61),
(85, 63, 89);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(11) NOT NULL,
  `number` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `passing_grade` varchar(11) NOT NULL DEFAULT 'C-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `number`, `name`, `credit`, `passing_grade`) VALUES
(1, 'SOEN', 228, 'System Hardware', '4.00', 'C-'),
(2, 'SOEN', 287, 'Web Programming', '3.00', 'C-'),
(3, 'SOEN', 298, 'System Hardware Lab', '1.00', 'C-'),
(4, 'SOEN', 321, 'Information Systems Security', '3.00', 'D-'),
(5, 'SOEN', 331, 'Introduction to Formal Methods for Software Engineering', '3.00', 'D-'),
(6, 'SOEN', 341, 'Software Process', '3.00', 'D-'),
(7, 'SOEN', 342, 'Software Requirements and Specifications', '3.00', 'D-'),
(8, 'SOEN', 343, 'Software Architecture and Design I', '3.00', 'D-'),
(9, 'SOEN', 344, 'Software Architecture and Design II', '3.00', 'D-'),
(10, 'SOEN', 345, 'Software Testing, Verification and Quality Assurance', '3.00', 'D-'),
(11, 'SOEN', 357, 'User Interface Design', '3.00', 'D-'),
(12, 'SOEN', 384, 'Management, Measurement and Quality Control', '3.00', 'D-'),
(13, 'SOEN', 385, 'Control Systems and Applications', '3.00', 'D-'),
(14, 'SOEN', 387, 'Web Based Enterprise Application Design', '3.00', 'D-'),
(15, 'SOEN', 390, 'Software Engineering Team Design Project', '3.50', 'D-'),
(16, 'SOEN', 422, 'Embedded Systems and Software', '4.00', 'D-'),
(17, 'SOEN', 423, 'Distributed Systems', '4.00', 'D-'),
(18, 'SOEN', 448, 'Management of Evolving Systems', '3.00', 'D-'),
(19, 'SOEN', 449, 'Component Engineering', '3.00', 'D-'),
(20, 'SOEN', 487, 'Web Services and Applications', '4.00', 'D-'),
(21, 'SOEN', 490, 'Capstone Software Engineering Design Project', '4.00', 'D-'),
(22, 'SOEN', 491, 'Software Engineering Project', '1.00', 'D-'),
(23, 'SOEN', 498, 'Topics in Software Engineering', '3.00', 'D-'),
(24, 'COMP', 108, 'Computer Science Industrial Experience Reflective Learning I', '3.00', 'C-'),
(25, 'COMP', 201, 'Introduction to Computing', '3.00', 'C-'),
(26, 'COMP', 208, 'Computer Science Industrial Experience Reflective Learning II', '3.00', 'C-'),
(27, 'COMP', 218, 'Fundamentals of Programming', '3.00', 'C-'),
(28, 'COMP', 228, 'System Hardware', '3.00', 'C-'),
(29, 'COMP', 232, 'Mathematics for Computer Science', '3.00', 'C-'),
(30, 'COMP', 233, 'Probability and Statistics for Computer Science', '3.00', 'C-'),
(31, 'COMP', 248, 'Object Oriented Programming I', '3.50', 'C-'),
(32, 'COMP', 249, 'Object Oriented Programming II', '3.50', 'C-'),
(33, 'COMP', 318, 'Introduction to Database Applications', '4.00', 'D-'),
(34, 'COMP', 326, 'Computer Architecture', '3.00', 'D-'),
(35, 'COMP', 335, 'Introduction to Theoretical Computer Science', '3.00', 'D-'),
(36, 'COMP', 339, 'Combinatorics', '3.00', 'D-'),
(37, 'COMP', 345, 'Advanced Program Design with C++', '4.00', 'D-'),
(38, 'COMP', 346, 'Operating Systems', '4.00', 'D-'),
(39, 'COMP', 348, 'Principles of Programming Languages', '3.00', 'D-'),
(40, 'COMP', 352, 'Data Structures and Algorithms', '3.00', 'D-'),
(41, 'COMP', 353, 'Databases', '4.00', 'D-'),
(42, 'COMP', 354, 'Introduction to Software Engineering', '4.00', 'D-'),
(43, 'COMP', 361, 'Elementary Numerical Methods', '3.00', 'D-'),
(44, 'COMP', 367, 'Techniques in Symbolic Computation', '3.00', 'D-'),
(45, 'COMP', 371, 'Computer Graphics', '4.00', 'D-'),
(46, 'COMP', 376, 'Introduction to Game Development', '4.00', 'D-'),
(47, 'COMP', 426, 'Multicore Programming', '4.00', 'D-'),
(48, 'COMP', 428, 'Parallel Programming', '4.00', 'D-'),
(49, 'COMP', 442, 'Compiler Design', '4.00', 'D-'),
(50, 'COMP', 444, 'System Software Design', '4.00', 'D-'),
(51, 'COMP', 445, 'Data Communication and Computer Networks', '4.00', 'D-'),
(52, 'COMP', 451, 'Database Design', '4.00', 'D-'),
(53, 'COMP', 465, 'Design and Analysis of Algorithms', '3.00', 'D-'),
(54, 'COMP', 472, 'Artificial Intelligence', '4.00', 'D-'),
(55, 'COMP', 473, 'Pattern Recognition', '4.00', 'D-'),
(56, 'COMP', 474, 'Intelligent Systems', '4.00', 'D-'),
(57, 'COMP', 476, 'Advanced Game Development', '4.00', 'D-'),
(58, 'COMP', 477, 'Animation for Computer Games', '4.00', 'D-'),
(59, 'COMP', 478, 'Image Processing', '4.00', 'D-'),
(60, 'COMP', 479, 'Information Retrieval and Web Search', '4.00', 'D-'),
(61, 'COMP', 490, 'Computer Science Project I', '3.00', 'D-'),
(62, 'COMP', 492, 'Computer Science Project II', '3.00', 'D-'),
(63, 'COMP', 495, 'Honours Seminar', '1.00', 'D-'),
(64, 'COMP', 498, 'Topics in Computer Science', '3.00', 'D-'),
(65, 'ENGR', 108, 'Engineering Industrial Experience Reflective Learning I', '3.00', 'C-'),
(66, 'ENGR', 201, 'Professional Practice and Responsibility', '1.50', 'C-'),
(67, 'ENGR', 202, 'Sustainable Development and Environmental Stewardship', '1.50', 'C-'),
(68, 'ENGR', 208, 'Engineering Industrial Experience Reflective Learning II', '3.00', 'C-'),
(69, 'ENGR', 213, 'Applied Ordinary Differential Equations', '3.00', 'C-'),
(70, 'ENGR', 233, 'Applied Advanced Calculus', '3.00', 'C-'),
(71, 'ENGR', 242, 'Statics', '3.00', 'C-'),
(72, 'ENGR', 243, 'Dynamics', '3.00', 'C-'),
(73, 'ENGR', 244, 'Mechanics of Materials', '3.75', 'C-'),
(74, 'ENGR', 245, 'Mechanical Analysis', '3.00', 'C-'),
(75, 'ENGR', 251, 'Thermodynamics I', '3.00', 'C-'),
(76, 'ENGR', 290, 'Introductory Engineering Team Design Project', '3.00', 'C-'),
(77, 'ENGR', 301, 'Engineering Management Principles and Economics', '3.00', 'D-'),
(78, 'ENGR', 308, 'Engineering Industrial Experience Reflective Learning III', '3.00', 'D-'),
(79, 'ENGR', 311, 'Transform Calculus and Partial Differential Equations', '3.00', 'D-'),
(80, 'ENGR', 361, 'Fluid Mechanics I', '3.00', 'D-'),
(81, 'ENGR', 371, 'Probability and Statistics in Engineering', '3.00', 'D-'),
(82, 'ENGR', 391, 'Numerical Methods in Engineering', '3.00', 'D-'),
(83, 'ENGR', 392, 'Impact of Technology on Society', '3.00', 'D-'),
(84, 'ENGR', 411, 'Special Technical Report', '1.00', 'D-'),
(85, 'ENGR', 412, 'Honours Research Project', '3.00', 'D-'),
(86, 'ENGR', 472, 'Robot Manipulators', '3.50', 'D-'),
(87, 'ENGR', 498, 'Topics in Engineering', '3.00', 'D-'),
(88, 'ENCS', 272, 'Composition and Argumentation for Engineers', '3.00', 'C-'),
(89, 'ENCS', 282, 'Technical Writing and Communication', '3.00', 'C-'),
(90, 'ENCS', 393, 'Social and Ethical Dimensions of Information and Communication Technologies', '3.00', 'D-'),
(91, 'ENCS', 483, 'Creativity, Innovation and Critical Thinking in Science and Technology', '3.00', 'D-'),
(92, 'ENCS', 484, 'Development and Global Engineering', '3.00', 'D-'),
(93, 'ENCS', 498, 'Topics in Engineering and Computer Science', '3.00', 'D-'),
(94, 'ELEC', 275, 'Principles of Electrical Engineering', '3.50', 'C-'),
(95, 'ELEC', 321, 'Introduction to Semiconductor Materials and Devices', '3.50', 'D-'),
(96, 'BIOL', 206, 'Elementary Genetics', '3.00', 'C-'),
(97, 'BIOL', 261, 'Molecular and General Genetics', '3.00', 'C-'),
(98, 'CHEM', 217, 'Introductory Analytical Chemistry I', '3.00', 'C-'),
(99, 'CHEM', 221, 'Introductory Organic Chemistry I', '3.00', 'C-'),
(100, 'CIVI', 231, 'Geology for Civil Engineers', '3.00', 'C-'),
(101, 'MECH', 221, 'Materials Science', '3.00', 'C-'),
(102, 'PHYS', 252, 'Optics', '3.00', 'C-'),
(103, 'PHYS', 384, 'Introduction to Astronomy', '3.00', 'D-'),
(104, 'PHYS', 385, 'Astrophysics', '3.00', 'D-');

-- --------------------------------------------------------

--
-- Table structure for table `laboratories`
--

DROP TABLE IF EXISTS `laboratories`;
CREATE TABLE `laboratories` (
  `id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `capacity` int(11) UNSIGNED NOT NULL,
  `letter` varchar(3) NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `room` varchar(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `weekday` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laboratories`
--

INSERT INTO `laboratories` (`id`, `section_id`, `capacity`, `letter`, `instructor`, `room`, `start`, `end`, `weekday`) VALUES
(1, 1, 15, 'I-X', 'Tadeusz Obuchowicz', 'TBA', '10:00:00', '12:00:00', 2),
(2, 1, 15, 'J-X', 'Tadeusz Obuchowicz', 'TBA', '10:00:00', '12:00:00', 1),
(3, 1, 15, 'K-X', 'Tadeusz Obuchowicz', 'TBA', '10:00:00', '12:00:00', 3),
(4, 1, 18, 'L-X', 'Tadeusz Obuchowicz', 'TBA', '10:00:00', '12:00:00', 1),
(5, 1, 19, 'M-X', 'Tadeusz Obuchowicz', 'TBA', '18:00:00', '20:00:00', 3),
(6, 2, 15, 'I-X', 'Donald Peter Davis', 'TBA', '10:00:00', '12:00:00', 2),
(7, 2, 21, 'J-X', 'Donald Peter Davis', 'TBA', '10:00:00', '12:00:00', 3),
(8, 2, 19, 'K-X', 'Donald Peter Davis', 'TBA', '18:00:00', '20:00:00', 3),
(9, 2, 30, 'L-X', 'Donald Peter Davis', 'TBA', '16:15:00', '18:15:00', 1),
(10, 2, 15, 'M-X', 'Donald Peter Davis', 'TBA', '10:00:00', '12:00:00', 2),
(11, 13, 35, 'I-X', 'Nikolaos Tsantalis', 'TBA', '15:45:00', '18:25:00', 4),
(12, 13, 35, 'K-X', 'Nikolaos Tsantalis', 'TBA', '15:45:00', '18:25:00', 2),
(13, 14, 25, 'I-X', 'Yuhong Yan', 'H 967', '20:30:00', '22:20:00', 3),
(14, 14, 25, 'J-X', 'Yuhong Yan', 'H 917', '20:30:00', '22:20:00', 3),
(15, 15, 30, 'SI', 'Peter Rigby', 'TBA', '08:45:00', '10:45:00', 2),
(16, 15, 30, 'SI', 'Peter Rigby', 'TBA', '08:45:00', '10:45:00', 4),
(17, 15, 30, 'SJ', 'Peter Rigby', 'TBA', '08:45:00', '10:45:00', 2),
(18, 15, 30, 'SJ', 'Peter Rigby', 'TBA', '08:45:00', '10:45:00', 4),
(19, 26, 25, 'I-X', 'Aiman Latif Hanna', 'TBA', '13:35:00', '14:35:00', 5),
(20, 26, 40, 'J-X', 'Aiman Latif Hanna', 'TBA', '13:35:00', '14:35:00', 3),
(21, 26, 40, 'K-X', 'Aiman Latif Hanna', 'TBA', '13:35:00', '14:35:00', 5),
(22, 27, 30, 'I-X', 'Aiman Latif Hanna', 'TBA', '12:00:00', '13:00:00', 1),
(23, 27, 30, 'J-X', 'Aiman Latif Hanna', 'TBA', '16:35:00', '17:35:00', 5),
(24, 27, 30, 'K-X', 'Aiman Latif Hanna', 'TBA', '12:00:00', '13:00:00', 1),
(25, 27, 25, 'L-X', 'Aiman Latif Hanna', 'TBA', '16:35:00', '17:35:00', 5),
(26, 28, 25, 'I-X', 'Mohamed Taleb', 'TBA', '16:30:00', '17:30:00', 4),
(27, 28, 25, 'J-X', 'Mohamed Taleb', 'TBA', '19:35:00', '20:35:00', 5),
(28, 28, 25, 'K-X', 'Mohamed Taleb', 'TBA', '19:35:00', '20:35:00', 5),
(29, 29, 20, 'I-X', 'Jeremy Clark', 'TBA', '17:45:00', '18:45:00', 1),
(30, 29, 31, 'J-X', 'Jeremy Clark', 'TBA', '16:30:00', '17:30:00', 4),
(31, 30, 40, 'I-X', 'Nancy Acemian', 'TBA', '12:10:00', '13:10:00', 1),
(32, 30, 40, 'J-X', 'Nancy Acemian', 'TBA', '12:10:00', '13:10:00', 3),
(33, 31, 35, 'I-X', 'Mohamed Taleb', 'TBA', '12:10:00', '13:10:00', 1),
(34, 31, 35, 'J-X', 'Mohamed Taleb', 'TBA', '13:35:00', '14:35:00', 3),
(35, 33, 50, 'SI', 'Nora Houari', 'TBA', '16:15:00', '18:05:00', 5),
(36, 33, 40, 'SJ', 'Nora Houari', 'TBA', '16:15:00', '18:05:00', 5),
(37, 34, 50, 'I-X', 'Aiman Latif Hanna', 'TBA', '09:30:00', '11:20:00', 3),
(38, 34, 50, 'J-X', 'Aiman Latif Hanna', 'TBA', '14:15:00', '16:05:00', 1),
(39, 35, 50, 'I-X', 'Aiman Latif Hanna', 'TBA', '09:30:00', '11:20:00', 2),
(40, 35, 50, 'J-X', 'Aiman Latif Hanna', 'TBA', '14:15:00', '16:05:00', 5),
(41, 106, 25, '06L', 'Jung Oh', 'SP 116', '13:30:00', '17:30:00', 1),
(42, 106, 25, '07L', 'Jung Oh', 'SP 116', '13:30:00', '17:30:00', 3),
(43, 106, 25, '08L', 'Jung Oh', 'SP 116', '13:30:00', '17:30:00', 4),
(44, 107, 25, '09L', 'Joanne Krupa', 'SP 116', '09:00:00', '13:00:00', 5),
(45, 107, 25, '10L', 'Joanne Krupa', 'SP 112', '09:00:00', '13:00:00', 1),
(46, 107, 25, '52L', 'Joanne Krupa', 'SP 116', '18:30:00', '22:30:00', 2),
(47, 111, 0, 'I-X', 'Sadegh Ghaderpanah', 'H 917', '19:45:00', '20:30:00', 1),
(48, 111, 0, 'I-J', 'Sadegh Ghaderpanah', 'H 831', '10:15:00', '11:00:00', 2),
(49, 111, 0, 'I-K', 'Sadegh Ghaderpanah', 'H 831', '20:30:00', '21:15:00', 5),
(50, 112, 0, 'I-X', 'Emad Shihab', 'H 831', '10:40:00', '11:40:00', 5),
(51, 112, 0, 'J-X', 'Emad Shihab', 'H 917', '12:10:00', '13:10:00', 1),
(52, 113, 0, 'I-X', 'Mohamed Taleb', 'H 831', '12:10:00', '13:10:00', 1),
(53, 113, 0, 'J-X', 'Mohamed Taleb', 'H 917', '12:10:00', '13:10:00', 3),
(54, 114, 0, 'I-X', 'Nancy Acemian', 'H 905', '10:40:00', '11:40:00', 5),
(55, 114, 0, 'J-X', 'Nancy Acemian', 'H 917', '10:40:00', '11:40:00', 5),
(56, 114, 0, 'K-X', 'Nancy Acemian', 'H 831', '12:10:00', '13:10:00', 3),
(57, 102, 20, 'I-X', 'Pouya Valizadeh', 'H 822', '08:45:00', '11:30:00', 1),
(58, 102, 20, 'J-X', 'Pouya Valizadeh', 'H 822', '08:45:00', '11:30:00', 1),
(59, 102, 20, 'K-X', 'Pouya Valizadeh', 'H 822', '17:45:00', '20:30:00', 4),
(60, 102, 20, 'L-X', 'Pouya Valizadeh', 'H 822', '17:45:00', '20:30:00', 3),
(61, 102, 20, 'M-X', 'Pouya Valizadeh', 'H 822', '17:45:00', '20:30:00', 1),
(62, 102, 20, 'N-X', 'Pouya Valizadeh', 'H 822', '17:45:00', '20:30:00', 4),
(63, 103, 16, 'I-X', 'Mojtaba Kahrizi', 'H 823', '17:45:00', '20:30:00', 1),
(64, 103, 16, 'J-X', 'Mojtaba Kahrizi', 'H 823', '17:45:00', '20:30:00', 1),
(65, 103, 16, 'K-X', 'Mojtaba Kahrizi', 'H 823', '17:45:00', '20:30:00', 3),
(66, 103, 16, 'L-X', 'Mojtaba Kahrizi', 'H 823', '17:45:00', '20:30:00', 3),
(67, 137, 16, 'I-X', 'Pouya Valizadeh', 'H 823', '17:45:00', '20:30:00', 4),
(68, 137, 16, 'J-X', 'Pouya Valizadeh', 'H 823', '17:45:00', '20:30:00', 4),
(69, 137, 16, 'K-X', 'Pouya Valizadeh', 'H 823', '13:15:00', '16:00:00', 4),
(70, 137, 16, 'L-X', 'Pouya Valizadeh', 'H 823', '13:15:00', '16:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

DROP TABLE IF EXISTS `lectures`;
CREATE TABLE `lectures` (
  `id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `room` varchar(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `weekday` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `section_id`, `room`, `start`, `end`, `weekday`) VALUES
(1, 1, 'MB S2.330 ', '17:45:00', '20:15:00', 2),
(2, 2, 'MB S2.210 ', '14:45:00', '16:00:00', 1),
(3, 2, 'MB S2.210 ', '14:45:00', '16:00:00', 3),
(4, 3, 'H 967', '08:45:00', '10:00:00', 2),
(5, 3, 'H 967', '08:45:00', '10:00:00', 4),
(6, 4, 'H 920', '14:45:00', '16:00:00', 2),
(7, 4, 'H 920', '14:45:00', '16:00:00', 4),
(8, 5, 'FG B040', '14:45:00', '16:00:00', 2),
(9, 5, 'FG B040', '14:45:00', '16:00:00', 4),
(10, 6, 'FG C080', '16:15:00', '17:30:00', 2),
(11, 6, 'FG C080', '16:15:00', '17:30:00', 4),
(12, 7, 'H 420', '16:15:00', '17:30:00', 2),
(13, 7, 'H 420', '16:15:00', '17:30:00', 4),
(14, 8, 'MB S2.210', '08:45:00', '10:00:00', 3),
(15, 8, 'MB S2.210', '08:45:00', '10:00:00', 5),
(16, 9, 'H 407', '13:15:00', '14:30:00', 2),
(17, 9, 'H 407', '13:15:00', '14:30:00', 4),
(18, 10, 'H 620', '14:45:00', '16:00:00', 1),
(19, 10, 'H 620', '14:45:00', '16:00:00', 3),
(20, 11, 'FG C070', '10:15:00', '11:30:00', 3),
(21, 11, 'FG C070', '10:15:00', '11:30:00', 5),
(22, 12, 'FG B050', '11:45:00', '13:00:00', 2),
(23, 12, 'FG B050', '11:45:00', '13:00:00', 4),
(24, 13, 'H 431', '16:15:00', '17:55:00', 1),
(25, 14, 'FG B055', '17:45:00', '20:15:00', 3),
(26, 15, 'H 521', '18:25:00', '19:25:00', 5),
(27, 16, 'TBA', '00:00:00', '00:00:00', 0),
(28, 17, 'MB S1.105', '17:45:50', '20:15:00', 2),
(29, 18, 'Online', '00:00:00', '00:00:00', 0),
(30, 19, 'H 1070', '17:45:00', '20:15:00', 3),
(31, 20, 'H 507', '17:45:00', '20:15:00', 1),
(32, 21, 'H 520', '17:45:00', '20:15:00', 4),
(33, 22, 'H 620', '13:15:00', '14:30:00', 2),
(34, 22, 'H 620', '13:15:00', '14:30:00', 4),
(35, 23, 'H 633', '17:45:00', '20:15:00', 4),
(36, 24, 'H 820', '17:45:00', '20:15:00', 2),
(37, 25, 'H 535', '13:15:00', '14:30:00', 3),
(38, 26, 'H 820', '10:15:00', '11:30:00', 3),
(39, 26, 'H 820', '10:15:00', '11:30:00', 5),
(40, 27, 'MB S2.210', '11:45:00', '13:00:00', 3),
(41, 27, 'MB S2.210', '11:45:00', '13:00:00', 5),
(42, 28, 'H 535', '17:45:00', '20:15:00', 4),
(43, 29, 'MB 5.275', '17:45:00', '20:15:00', 4),
(44, 30, 'H 820', '08:45:00', '10:00:00', 1),
(45, 30, 'H 820', '08:45:00', '10:00:00', 3),
(46, 31, 'H 535', '10:15:00', '11:30:00', 3),
(47, 31, 'H 535', '10:15:00', '11:30:00', 5),
(48, 32, 'H 520', '11:45:00', '13:00:00', 2),
(49, 32, 'H520', '11:45:00', '13:00:00', 4),
(50, 33, 'MB S2.330', '14:45:00', '16:00:00', 3),
(51, 33, 'MB S2.330', '14:45:00', '16:00:00', 5),
(52, 34, 'FG C070', '05:45:00', '20:15:00', 3),
(53, 35, 'H 407', '05:45:00', '20:15:00', 2),
(54, 52, 'Online', '00:00:00', '00:00:00', 0),
(55, 53, 'H 937', '14:45:00', '16:00:00', 2),
(56, 53, 'H 937', '14:45:00', '16:00:00', 4),
(57, 54, 'H 553', '14:45:00', '16:00:00', 2),
(58, 54, 'H 553', '14:45:00', '16:00:00', 4),
(59, 55, 'FG B060', '14:45:00', '16:00:00', 2),
(60, 55, 'FG B060', '14:45:00', '16:00:00', 4),
(61, 56, 'H 531', '16:15:00', '17:30:00', 1),
(62, 56, 'H 531', '16:15:00', '17:30:00', 3),
(63, 57, 'H 411', '11:45:00', '13:00:00', 2),
(64, 57, 'H 411', '11:45:00', '13:00:00', 4),
(65, 58, 'H 435', '08:45:00', '10:00:00', 3),
(66, 58, 'H 435', '08:45:00', '10:00:00', 5),
(67, 59, 'MB S2.330', '10:15:00', '11:30:00', 3),
(68, 59, 'MB S2.330', '10:15:00', '11:30:00', 5),
(69, 60, 'H 553', '08:45:00', '10:00:00', 2),
(70, 60, 'H 553', '08:45:00', '10:00:00', 4),
(71, 61, 'FG B060', '08:45:00', '10:00:00', 2),
(72, 61, 'FG B060', '08:45:00', '10:00:00', 4),
(73, 62, 'MB S2.210', '10:15:00', '11:30:00', 3),
(74, 62, 'MB S2.210', '10:15:00', '11:30:00', 5),
(75, 104, 'MB S2.330', '11:45:00', '13:00:00', 1),
(76, 104, 'MB S2.330', '11:45:00', '13:00:00', 3),
(77, 105, 'SP S110 ', '11:45:00', '13:00:00', 3),
(78, 105, 'SP S110 ', '11:45:00', '13:00:00', 5),
(79, 106, 'CC 310', '10:15:00', '11:30:00', 2),
(80, 106, 'CC 310', '10:15:00', '11:30:00', 4),
(81, 107, 'CC 321', '18:00:00', '20:30:00', 4),
(82, 108, 'H 531', '10:15:00', '11:30:00', 2),
(83, 108, 'H 531', '10:15:00', '11:30:00', 4),
(84, 109, 'CC 112', '10:15:00', '11:30:00', 2),
(85, 109, 'CC 112', '10:15:00', '11:30:00', 4),
(86, 36, 'H 531', '14:45:00', '16:00:00', 1),
(87, 36, 'H 531', '14:45:00', '16:00:00', 3),
(88, 37, 'H 937', '13:15:00', '14:30:00', 1),
(89, 37, 'H 937', '13:15:00', '14:30:00', 3),
(90, 111, 'H 553', '17:45:00', '20:00:00', 5),
(91, 112, 'H 937', '13:15:00', '14:15:00', 1),
(92, 112, 'H 937', '13:15:00', '14:30:00', 3),
(93, 113, 'FG C070', '13:15:00', '14:30:00', 1),
(94, 113, 'FG C070', '13:15:00', '14:30:00', 3),
(95, 114, 'H 920', '08:45:00', '10:00:00', 1),
(96, 114, 'H 920', '08:45:00', '10:00:00', 3),
(97, 115, 'H 937', '17:45:00', '20:15:00', 3),
(98, 116, 'H 435', '13:15:00', '14:30:00', 2),
(99, 116, 'H 435', '13:15:00', '14:30:00', 4),
(100, 117, 'FG C080	', '13:15:00', '14:30:00', 2),
(101, 117, 'FG C080', '13:15:00', '14:30:00', 4),
(102, 118, 'Online', '00:00:00', '00:00:00', 0),
(103, 119, 'MB S2.210	', '11:45:00', '13:00:00', 1),
(104, 119, 'MB S2.210', '11:45:00', '13:00:00', 3),
(105, 120, 'MB S2.210', '08:45:00', '10:00:00', 3),
(106, 120, 'MB S2.210', '08:45:00', '10:00:00', 5),
(107, 121, 'FG C070', '10:15:00', '11:30:00', 2),
(108, 121, 'FG C070', '10:15:00', '11:30:00', 4),
(109, 122, 'FG C080', '11:45:00', '13:00:00', 3),
(110, 122, 'FG C080', '11:45:00', '13:00:00', 5),
(111, 123, 'FG C080', '08:45:00', '10:00:00', 3),
(112, 123, 'FG C080', '08:45:00', '10:00:00', 5),
(113, 124, 'H 531', '10:15:00', '11:30:00', 2),
(114, 124, 'H 531', '10:15:00', '11:30:00', 4),
(115, 125, 'H 435', '17:45:00', '20:15:00', 5),
(116, 25, 'H 535', '13:15:00', '14:30:00', 1),
(117, 135, 'H 937', '16:15:00', '17:30:00', 4),
(118, 136, 'H 110', '17:45:00', '19:00:00', 3),
(119, 83, 'FG C080', '14:45:00', '16:00:00', 2),
(120, 83, 'FG C080', '14:45:00', '16:00:00', 4),
(121, 84, 'H 507', '17:45:00', '20:15:00', 5),
(122, 85, 'H 920', '10:15:00', '11:30:00', 3),
(123, 85, 'H 920', '10:15:00', '11:30:00', 5),
(124, 86, 'H 531', '17:45:00', '20:15:00', 4),
(125, 87, 'H 415', '13:15:00', '14:30:00', 2),
(126, 87, 'H 415', '13:15:00', '14:30:00', 4),
(127, 88, 'H 535', '08:45:00', '10:00:00', 3),
(128, 88, 'H 535', '08:45:00', '10:00:00', 5),
(129, 80, 'H 553', '16:15:00', '17:30:00', 2),
(130, 80, 'H 553', '16:15:00', '17:30:00', 4),
(131, 81, 'H 553', '17:45:00', '20:15:00', 1),
(132, 89, 'H 407', '08:45:00', '11:30:00', 5),
(133, 90, 'H 420', '16:15:00', '17:30:00', 1),
(134, 90, 'H 420', '16:15:00', '17:30:00', 3),
(135, 91, 'FG B030', '17:45:00', '20:15:00', 2),
(136, 96, 'FG B060', '17:45:00', '20:15:00', 2),
(137, 97, 'MB S2.210', '14:45:00', '17:30:00', 2),
(138, 98, 'H 553', '17:45:00', '20:15:00', 2),
(139, 99, 'H 507', '14:45:00', '16:00:00', 2),
(140, 99, 'H 507', '14:45:00', '16:00:00', 4),
(141, 102, 'FG C080', '17:45:00', '20:15:00', 2),
(142, 103, 'Online', '00:00:00', '00:00:00', 0),
(143, 137, 'FG B030', '16:15:00', '17:30:00', 2),
(144, 137, 'FG B030', '16:15:00', '17:30:00', 4),
(145, 104, 'MB S2.330', '11:45:00', '13:00:00', 1),
(146, 104, 'MB S2.330', '11:45:00', '13:00:00', 3),
(147, 107, 'CC 321', '18:00:00', '20:30:00', 4),
(148, 63, 'H 553', '11:45:00', '13:00:00', 2),
(149, 63, 'H 553', '11:45:00', '13:00:00', 4),
(150, 64, 'FG B060', '11:45:00', '13:00:00', 2),
(151, 64, 'FG B060', '11:45:00', '13:00:00', 4),
(152, 65, 'MB S2.285', '17:45:00', '20:15:00', 4),
(153, 66, 'FG C070', '11:45:00', '13:00:00', 2),
(154, 66, 'FG C070', '11:45:00', '13:00:00', 4),
(155, 67, 'FG C080', '17:45:00', '20:15:00', 4),
(156, 68, 'MB 3.210', '10:15:00', '11:30:00', 3),
(157, 68, 'MB 3.210', '10:15:00', '11:30:00', 5),
(158, 69, 'FG C080', '11:45:00', '13:00:00', 2),
(159, 69, 'FG C080', '11:45:00', '13:00:00', 4),
(160, 76, 'H 411', '10:15:00', '11:30:00', 2),
(161, 76, 'H 411', '10:15:00', '11:30:00', 4),
(162, 77, 'H 415', '08:45:00', '10:00:00', 3),
(163, 77, 'H 415', '08:45:00', '10:00:00', 5),
(164, 78, 'H 407', '17:45:00', '20:15:00', 5),
(165, 82, 'Online ', '00:00:00', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE `program` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `name`) VALUES
(1, 'Bachelor of Software Engineering'),
(2, 'Bachelor of Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `programsequence`
--

DROP TABLE IF EXISTS `programsequence`;
CREATE TABLE `programsequence` (
  `id` int(11) UNSIGNED NOT NULL,
  `program_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programsequence`
--

INSERT INTO `programsequence` (`id`, `program_id`, `course_id`) VALUES
(1, 1, 29),
(2, 1, 31),
(3, 1, 66),
(4, 1, 69),
(6, 1, 32),
(7, 1, 70),
(8, 1, 1),
(9, 1, 2),
(10, 1, 39),
(11, 1, 40),
(12, 1, 89),
(13, 1, 67),
(14, 1, 38),
(15, 1, 94),
(16, 1, 81),
(17, 1, 5),
(18, 1, 6),
(20, 1, 35),
(21, 1, 7),
(22, 1, 8),
(23, 1, 12),
(24, 1, 82),
(25, 1, 9),
(26, 1, 10),
(27, 1, 11),
(28, 1, 15),
(29, 1, 21),
(30, 1, 77),
(31, 1, 4),
(32, 1, 13),
(33, 1, 83),
(34, 2, 29),
(35, 2, 31),
(36, 2, 28),
(37, 2, 30),
(38, 2, 32),
(39, 2, 89),
(40, 2, 39),
(41, 2, 40),
(42, 2, 38),
(43, 2, 35),
(44, 2, 42),
(45, 2, 90);

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

DROP TABLE IF EXISTS `registered`;
CREATE TABLE `registered` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED DEFAULT NULL,
  `tutorial_id` int(11) UNSIGNED DEFAULT NULL,
  `laboratory_id` int(11) UNSIGNED DEFAULT NULL,
  `grade` varchar(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`id`, `student_id`, `section_id`, `tutorial_id`, `laboratory_id`, `grade`) VALUES
(2, 1001, 110, NULL, NULL, 'A+'),
(12, 1001, 30, 59, 31, ''),
(22, 1001, 55, 86, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` int(11) UNSIGNED NOT NULL,
  `semester_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `letter` varchar(2) CHARACTER SET latin1 NOT NULL,
  `capacity` smallint(6) UNSIGNED NOT NULL,
  `professor` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `semester_id`, `course_id`, `letter`, `capacity`, `professor`) VALUES
(1, 8, 1, 'DD', 82, 'Tadeusz Obuchowicz'),
(2, 8, 1, 'H', 100, 'Donald Peter Davis'),
(3, 8, 2, 'S', 50, 'Nancy Acemian'),
(4, 8, 2, 'U', 90, 'Javad Sadri'),
(5, 8, 2, 'W', 80, 'Yuhong Yan'),
(6, 8, 5, 'U', 60, 'Constantinos Constantinides'),
(7, 8, 5, 'W', 60, 'Olga Ormandjieva'),
(8, 8, 6, 'S', 125, 'Weiyi Shang'),
(9, 8, 9, 'S', 90, 'Constantinos Constantinides'),
(10, 8, 10, 'S', 75, 'Daniel Sinnig'),
(11, 8, 11, 'S', 80, 'Rajagopalan Jayakumar'),
(12, 8, 13, 'S', 75, 'Javad Sadri'),
(13, 8, 15, 'S', 70, 'Nikolaos Tsantalis'),
(14, 8, 20, 'NN', 50, 'Yuhong Yan'),
(15, 8, 21, 'SS', 60, 'Peter Rigby'),
(16, 8, 22, 'W', 2, 'Terrill Fancott'),
(17, 8, 25, 'OO', 30, 'Stanislas Klasa'),
(18, 8, 27, 'EC', 120, 'Nancy Acemian'),
(19, 8, 28, 'DD', 90, 'David K Probst'),
(20, 8, 28, 'PP', 95, 'David K Probst'),
(21, 8, 29, 'NN', 65, 'Gosta Grahne'),
(22, 8, 29, 'S', 90, 'Sabine Bergler'),
(23, 8, 29, 'WW', 52, 'Troy Jason Taillefer'),
(24, 8, 30, 'DD', 80, 'Adam Krzyzak'),
(25, 8, 30, 'N', 90, 'Eusebius Doedel'),
(26, 8, 31, 'U', 90, 'Aiman Latif Hanna'),
(27, 8, 31, 'W', 110, 'Aiman Latif Hanna'),
(28, 8, 32, 'PP', 75, 'Mohamed Taleb'),
(29, 8, 32, 'QQ', 50, 'Jeremy Clark'),
(30, 8, 32, 'S', 80, 'Nancy Acemian'),
(31, 8, 32, 'U', 70, 'Mohamed Taleb'),
(32, 8, 35, 'N', 90, 'Gosta Grahne'),
(33, 8, 37, 'S', 90, 'Nora Houari'),
(34, 8, 38, 'NN', 100, 'Aiman Latif Hanna'),
(35, 8, 38, 'WW', 100, 'Aiman Latif Hanna'),
(36, 8, 39, 'E', 110, 'Mohamed Taleb'),
(37, 8, 40, 'X', 113, 'Dhrubajyoti Goswami'),
(38, 8, 41, 'X', 100, 'Nematollaah Shiri Varnaamkhaasti'),
(39, 8, 42, 'PP', 70, 'Gregory Butler'),
(40, 8, 43, 'NN', 70, 'Adam Krzyzak'),
(41, 8, 44, 'A', 50, 'Armen Atoyan'),
(42, 8, 45, 'WW', 81, 'Charalambos Poullis, '),
(43, 8, 49, 'NN', 60, 'Joey Paquet'),
(44, 8, 51, 'W', 60, 'Javad Sadri'),
(45, 8, 54, 'NN', 75, 'Nora Houari'),
(46, 8, 56, 'UU', 40, 'Sabine Bergler'),
(47, 8, 57, 'N', 60, 'Sudhir Mudur, Thomas Fevens'),
(48, 8, 61, 'P', 20, 'David K Probst'),
(49, 8, 62, 'P', 20, 'David K Probst'),
(50, 8, 63, 'P', 5, 'David K Probst'),
(51, 8, 64, 'GG', 30, 'Charalambos Poullis'),
(52, 8, 66, 'EC', 500, 'ARTUR DE MATOS ALVES'),
(53, 8, 69, 'F', 250, 'Nataliia Rossokhata'),
(54, 8, 69, 'G', 100, 'Venkatanarayana Ramachandran'),
(55, 8, 69, 'J', 100, 'Dmitry Korotkin'),
(56, 8, 70, 'J', 120, 'Dmitry Korotkin'),
(57, 8, 70, 'R', 100, 'Alexander Shnirelman'),
(58, 8, 70, 'S', 120, 'Dimiter Dryanov'),
(59, 8, 70, 'T', 120, 'Iman Gohar'),
(60, 8, 70, 'U', 100, 'Alexander Shnirelman'),
(61, 8, 70, 'V', 100, 'ALI NAZEMI'),
(62, 8, 70, 'X', 120, 'Nataliia Rossokhata'),
(63, 8, 71, 'J', 100, 'Theodore Stathopoulos'),
(64, 8, 71, 'L', 100, 'FERAWATI GANI'),
(65, 8, 71, 'WW', 50, 'Ehab Ahmed'),
(66, 8, 72, 'T', 150, 'Alexandre Paradis'),
(67, 8, 72, 'TT', 150, 'Alexandre Paradis'),
(68, 8, 72, 'V', 150, 'Chellaiyah Rajalingham'),
(69, 8, 72, 'X', 150, 'HANY ALAA ELDIN GOMAA'),
(70, 8, 73, 'LL', 96, 'FERAWATI GANI'),
(71, 8, 73, 'M', 96, 'Carole El Ayoubi'),
(72, 8, 73, 'T', 96, 'A K Waizuddin Ahmed'),
(73, 8, 73, 'V', 96, 'FERAWATI GANI'),
(74, 8, 73, 'X', 53, 'Chellaiyah Rajalingham'),
(75, 8, 74, 'V', 90, 'Rolf Wuthrich'),
(76, 8, 75, 'V', 100, 'Chellaiyah Rajalingham'),
(77, 8, 75, 'W', 100, 'Alexandre Paradis'),
(78, 8, 75, 'XX', 100, 'Chellaiyah Rajalingham'),
(79, 8, 76, 'U', 60, 'Khashayar Khorasani'),
(80, 8, 77, 'R', 100, 'Mohammed Mawlana'),
(81, 8, 77, 'SS', 100, 'Gerard Gouw'),
(82, 8, 80, 'EC', 218, 'Marius Paraschivoiu'),
(83, 8, 81, 'T', 120, 'Ketra Schmitt'),
(84, 8, 81, 'UU', 100, 'STEVE SHIH'),
(85, 8, 81, 'W', 90, 'Dongyu Qiu'),
(86, 8, 82, 'UU', 100, 'Charles Kiyanda'),
(87, 8, 82, 'V', 100, 'Rahim Tadayon	'),
(88, 8, 82, 'X', 100, 'Rolf Wuthrich'),
(89, 8, 83, 'P', 75, 'Ketra Schmitt'),
(90, 8, 83, 'D', 75, 'ARTUR DE MATOS ALVES'),
(91, 8, 83, 'RR', 65, 'ARTUR DE MATOS ALVES'),
(92, 8, 84, 'W', 20, 'Deborah Dysart-Gale'),
(93, 8, 84, 'X', 1, 'Deborah Dysart-Gale'),
(94, 8, 85, 'M', 1, ''),
(95, 8, 88, 'II', 80, 'Stuart Macmillan'),
(96, 8, 89, 'EE', 100, 'Bruno Grenier'),
(97, 8, 89, 'U', 100, 'Laurie Lamoureux Scholes'),
(98, 8, 89, 'WW', 100, 'Laurie Lamoureux Scholes'),
(99, 8, 89, 'Y', 100, 'Brandiff Caron'),
(100, 8, 90, 'WW', 100, 'Brandiff Caron'),
(101, 8, 91, 'W', 75, 'Deborah Dysart-Gale'),
(102, 8, 94, 'JJ', 120, 'Pouya Valizadeh'),
(103, 8, 95, 'EC', 64, 'Mojtaba Kahrizi'),
(104, 8, 96, 'B', 130, 'Aida Abu-Baker'),
(105, 8, 97, '02', 175, 'Malcolm Whiteway'),
(106, 8, 99, '02', 75, 'Jung Oh'),
(107, 8, 99, '53', 75, 'Joanne Krupa'),
(108, 8, 101, 'W', 89, 'Robin Drew'),
(109, 8, 102, '01', 58, 'Valter Zazubovits'),
(110, 7, 31, 'A', 54, 'Sander Knockerbelts'),
(111, 7, 31, 'EE', 0, 'Sadegh Ghaderpanah'),
(112, 7, 31, 'P', 0, 'Emad Shihab'),
(113, 7, 31, 'Q', 0, 'Mohamed Taleb'),
(114, 7, 31, 'R', 0, 'Nancy Acemian'),
(115, 7, 29, 'DD', 0, 'Eusebius Doedel'),
(116, 7, 29, 'Q', 0, 'Gosta Grahne'),
(117, 7, 29, 'R', 0, 'Pankaj Kamthan'),
(118, 7, 66, 'EC', 0, 'Remi Alaurent'),
(119, 7, 69, 'P', 0, 'Dmitry Korotkin'),
(120, 7, 69, 'R', 0, 'Nataliia Rossokhata'),
(121, 7, 69, 'T', 0, 'Georgi Vatistas'),
(122, 7, 69, 'U', 0, 'Alexei Kokotov'),
(123, 7, 69, 'V', 0, 'Ciprian Alecsandru'),
(124, 7, 69, 'X', 0, 'Pawel Gora'),
(125, 7, 69, 'XX', 0, 'Dimiter Dryanov'),
(126, 7, 97, '01', 0, 'Donald Gray Stirling'),
(127, 7, 98, '01', 0, 'Yves Gelinas'),
(128, 7, 98, '51', 0, 'Joanne Krupa'),
(129, 7, 99, '01', 0, 'Sébastien Robidoux'),
(130, 7, 99, '52', 0, 'Sébastien Robidoux'),
(131, 7, 100, 'LL', 0, 'Pejman Nekoovaght Motlagh'),
(132, 7, 101, 'T', 0, 'Robin Drew'),
(133, 7, 101, 'X', 0, 'Martin Pugh'),
(134, 7, 101, 'Y', 0, 'Dmytro Kevorkov'),
(135, 8, 67, 'R', 200, 'John Hadjinicolaou'),
(136, 8, 67, 'SS', 200, 'Rahim Tadayon'),
(137, 8, 95, 'H', 64, 'Pouya Valizadeh');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

DROP TABLE IF EXISTS `semesters`;
CREATE TABLE `semesters` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `active` tinyint(3) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `start`, `end`, `active`) VALUES
(1, 'Fall 2013', '2013-09-08', '2013-12-07', 0),
(2, 'Winter 2014', '2014-01-06', '2014-04-12', 0),
(3, 'Summer 2014', '2014-06-06', '2014-08-17', 0),
(4, 'Fall 2014', '2014-09-08', '2014-12-07', 0),
(5, 'Winter 2015', '2015-01-06', '2015-04-12', 0),
(6, 'Summer 2015', '2015-06-06', '2015-08-17', 0),
(7, 'Fall 2015', '2015-09-08', '2015-12-07', 0),
(8, 'Winter 2016', '2016-01-06', '2016-04-12', 0),
(9, 'Summer 2016', '2016-06-06', '2016-08-17', 0),
(10, 'Fall 2016', '2016-09-08', '2016-12-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `program_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `program_id`) VALUES
(1001, 1, 1),
(1002, 2, 1),
(1003, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `code` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`code`) VALUES
('BIOL'),
('CHEM'),
('CIVI'),
('COMP'),
('ELEC'),
('ENCS'),
('ENGR'),
('GEN'),
('MATH'),
('MECH'),
('PHYS'),
('SOEN');

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

DROP TABLE IF EXISTS `tutorials`;
CREATE TABLE `tutorials` (
  `id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `capacity` int(11) UNSIGNED NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `letter` varchar(2) NOT NULL,
  `room` varchar(255) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `weekday` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`id`, `section_id`, `capacity`, `instructor`, `letter`, `room`, `start`, `end`, `weekday`) VALUES
(1, 1, 42, 'Tadeusz Obuchowicz', 'DA', 'H 849', '20:30:00', '22:10:00', 2),
(2, 1, 40, 'Tadeusz Obuchowicz', 'DB', 'H 917', '20:30:00', '22:10:00', 2),
(3, 2, 31, 'Donald Peter Davis', 'HA', 'H 821', '16:15:00', '17:55:00', 3),
(4, 2, 33, 'Donald Peter Davis', 'HB', 'H 817', '16:15:00', '17:55:00', 3),
(5, 2, 36, 'Donald Peter Davis', 'HC', 'H 825', '16:15:00', '17:55:00', 3),
(6, 3, 25, 'Nancy Acemian', 'SA', 'H 917', '10:15:00', '11:55:00', 2),
(7, 3, 25, 'Nancy Acemian', 'SB', 'H 917', '10:15:00', '11:55:00', 4),
(8, 4, 45, 'Javad Sadri', 'UA', 'H 929', '16:15:00', '17:55:00', 2),
(9, 4, 45, 'Javad Sadri', 'UB', 'H 905', '16:15:00', '17:55:00', 4),
(10, 5, 45, 'Yuhong Yan', 'WA', 'H 905', '15:15:00', '16:55:00', 5),
(11, 5, 35, 'Yuhong Yan', 'WB', 'H 905', '16:15:00', '17:55:00', 2),
(12, 6, 30, 'Constantinos Constantinides', 'UA', 'H 605', '14:15:00', '16:05:00', 5),
(13, 6, 30, 'Constantinos Constantinides', 'UB', 'H 513', '14:15:00', '16:05:00', 5),
(14, 7, 30, 'Olga Ormandjieva', 'WA', 'H 521', '14:15:00', '16:05:00', 5),
(15, 7, 30, 'Olga Ormandjieva', 'WB', 'H 611', '14:15:00', '16:05:00', 5),
(16, 8, 50, 'Weiyi Shang', 'SA', 'H 929', '12:15:00', '13:05:00', 5),
(17, 8, 45, 'Weiyi Shang', 'SB', 'H 929', '13:15:00', '14:05:00', 5),
(18, 8, 30, 'Weiyi Shang', 'SC', 'H 929', '14:15:00', '15:05:00', 5),
(19, 9, 50, 'Constantinos Constantinides', 'SA', 'H 435', '14:45:00', '15:35:00', 4),
(20, 9, 40, 'Constantinos Constantinides', 'SB', 'H 544', '14:45:00', '15:35:00', 4),
(21, 10, 40, 'Daniel Sinnig', 'SA', 'H 905', '16:15:00', '17:05:00', 3),
(22, 10, 35, 'Daniel Sinnig', 'SB', 'H 905', '17:45:00', '18:35:00', 3),
(23, 11, 40, 'Rajagopalan Jayakumar', 'SA', 'H 627', '11:45:00', '12:35:00', 5),
(24, 11, 40, 'Rajagopalan Jayakumar', 'SB', 'H 619', '11:45:00', '12:35:00', 5),
(25, 12, 25, 'Javad Sadri', 'SA', 'H 831', '10:45:00', '11:35:00', 2),
(26, 12, 25, 'Javad Sadri', 'SB', 'H 831', '10:45:00', '11:35:00', 4),
(27, 12, 25, 'Javad Sadri', 'SC', 'H 817', '10:45:00', '11:35:00', 1),
(28, 13, 35, 'Nikolaos Tsantalis', 'SA', '', '18:15:00', '19:05:00', 1),
(29, 13, 35, 'Nikolaos Tsantalis', 'SB', '', '18:15:00', '19:05:00', 1),
(30, 14, 30, 'Yuhong Yan', 'NA', 'H 831', '16:15:00', '17:05:00', 3),
(31, 14, 20, 'Yuhong Yan', 'NB', 'H 843', '16:15:00', '17:05:00', 3),
(32, 17, 30, 'Stanislas Klasa', 'QA', 'MB S1.255', '20:30:00', '21:20:00', 2),
(33, 18, 60, 'Nancy Acemian', 'EA', 'H 521', '20:30:00', '22:10:00', 2),
(34, 18, 60, 'Nancy Acemian', 'EB', 'MB 5.275', '10:15:00', '11:55:00', 4),
(35, 19, 30, 'David K Probst', 'DA', 'H 1070', '20:30:00', '22:10:00', 3),
(36, 19, 30, 'David K Probst', 'DB', 'H 603', '20:30:00', '22:10:00', 3),
(37, 19, 30, 'David K Probst', 'DC', 'H 1070', '20:30:00', '22:10:00', 1),
(38, 20, 33, 'David K Probst', 'PA', 'H 540', '20:30:00', '22:10:00', 1),
(39, 20, 30, 'David K Probst', 'PB', 'H 544', '20:30:00', '22:10:00', 1),
(40, 20, 32, 'David K Probst', 'PC', 'H 562', '20:30:00', '22:10:00', 1),
(41, 21, 65, 'Gosta Grahne', 'NA', 'H 520', '20:30:00', '22:10:00', 4),
(42, 22, 45, 'Sabine Bergler', 'SA', 'H 609', '14:45:00', '16:25:00', 2),
(43, 22, 45, 'Sabine Bergler', 'SB', 'H 441', '14:45:00', '16:25:00', 2),
(44, 23, 52, 'Troy Jason Taillefer', 'WA', 'H 633', '20:30:00', '22:10:00', 2),
(45, 24, 40, 'Adam Krzyzak', 'DA', 'H 540', '11:45:00', '13:35:00', 4),
(46, 24, 40, 'Adam Krzyzak', 'DB', 'H 537', '11:45:00', '13:35:00', 2),
(47, 25, 50, 'Eusebius Doedel', 'NA', 'MB 2.445', '14:45:00', '16:35:00', 3),
(48, 25, 40, 'Eusebius Doedel', 'NB', 'H 540', '14:45:00', '16:35:00', 3),
(49, 26, 46, 'Aiman Latif Hanna', 'UA', 'TBA', '11:45:00', '13:25:00', 5),
(50, 26, 46, 'Aiman Latif Hanna', 'UB', 'TBA', '11:45:00', '13:25:00', 3),
(51, 27, 40, 'Aiman Latif Hanna', 'WA', 'TBA', '10:15:00', '11:50:00', 1),
(52, 27, 25, 'Aiman Latif Hanna', 'WB', 'TBA', '14:45:00', '16:25:00', 3),
(53, 27, 25, 'Aiman Latif Hanna', 'WC', 'TBA', '14:45:00', '16:25:00', 3),
(54, 27, 20, 'Aiman Latif Hanna', 'WD', 'TBA', '10:15:00', '11:50:00', 1),
(55, 28, 38, 'Mohamed Taleb', 'PA', 'TBA', '20:30:00', '22:10:00', 4),
(56, 28, 37, 'Mohamed Taleb', 'PB', 'TBA', '17:45:00', '19:25:00', 5),
(57, 29, 31, 'Jeremy Clark', 'QA', 'TBA', '20:30:00', '22:10:00', 4),
(58, 29, 20, 'Jeremy Clark', 'QB', 'TBA', '17:45:00', '19:25:00', 5),
(59, 30, 40, 'Nancy Acemian', 'SA', 'TBA', '10:15:00', '11:55:00', 3),
(60, 30, 40, 'Nancy Acemian', 'BA', 'TBA', '10:15:00', '11:55:00', 1),
(61, 31, 35, 'Mohamed Taleb', 'UA', 'TBA', '10:15:00', '11:55:00', 1),
(62, 31, 35, 'Mohamed Taleb', 'UB', 'TBA', '11:45:00', '13:25:00', 3),
(63, 32, 50, 'Gosta Grahne', 'NA', 'H 420', '13:15:00', '14:05:00', 2),
(64, 32, 40, 'Gosta Grahne', 'NB', 'H 501', '13:15:00', '14:05:00', 4),
(65, 34, 50, 'Aiman Latif Hanna', 'NA', 'TBA', '20:30:00', '21:20:00', 3),
(66, 34, 50, 'Aiman Latif Hanna', 'NB', 'TBA', '13:15:00', '14:05:00', 1),
(67, 35, 50, 'Aiman Latif Hanna', 'WA', 'TBA', '20:30:00', '21:20:00', 2),
(68, 35, 50, 'Aiman Latif Hanna', 'WB', 'TBA', '13:15:00', '14:05:00', 5),
(69, 52, 50, 'ARTUR DE MATOS ALVES', 'EA', 'FG B080', '08:45:00', '09:35:00', 5),
(70, 52, 50, 'ARTUR DE MATOS ALVES', 'EB', 'FG B080', '08:45:00', '09:35:00', 5),
(71, 52, 50, 'ARTUR DE MATOS ALVES', 'EC', 'H 501 ', '16:15:00', '17:05:00', 2),
(72, 52, 50, 'ARTUR DE MATOS ALVES', 'ED', 'FG B080', '16:15:00', '17:05:00', 2),
(73, 52, 50, 'ARTUR DE MATOS ALVES', 'EE', 'FG B080', '08:45:00', '09:35:00', 3),
(74, 52, 50, 'ARTUR DE MATOS ALVES', 'EF', 'FG B080', '08:45:00', '09:35:00', 3),
(75, 52, 50, 'ARTUR DE MATOS ALVES', 'EG', 'FG B080', '16:15:00', '17:05:00', 4),
(76, 52, 50, 'ARTUR DE MATOS ALVES', 'EH', 'FG B080', '16:15:00', '17:05:00', 4),
(77, 52, 50, 'ARTUR DE MATOS ALVES', 'EI', 'H 401', '16:15:00', '17:05:00', 4),
(78, 52, 50, 'ARTUR DE MATOS ALVES', 'EJ', 'H 423', '16:15:00', '17:05:00', 4),
(79, 53, 50, 'Nataliia Rossokhata', 'FA', 'FG B080', '18:00:00', '19:40:00', 1),
(80, 53, 50, 'Nataliia Rossokhata', 'FB', 'H 535', '17:45:00', '19:25:00', 5),
(81, 53, 50, 'Nataliia Rossokhata', 'FC', 'H 627', '16:10:00', '17:50:00', 1),
(82, 53, 50, 'Nataliia Rossokhata', 'FD', 'H 625', '18:00:00', '19:40:00', 1),
(83, 53, 50, 'Nataliia Rossokhata', 'FG', 'H 631', '15:45:00', '17:25:00', 5),
(84, 54, 50, 'Venkatanarayana Ramachandran', 'GA', 'FG B080', '16:10:00', '17:50:00', 1),
(85, 54, 50, 'Venkatanarayana Ramachandran', 'GB', 'H 423', '17:45:00', '19:25:00', 5),
(86, 55, 50, 'Dmitry Korotkin', 'JA', 'FG B055', '15:45:00', '17:25:00', 5),
(87, 55, 50, 'Dmitry Korotkin', 'JB', 'FG B080', '15:45:00', '17:25:00', 5),
(88, 56, 40, 'Dmitry Korotkin', 'JA', 'H 564', '15:45:00', '17:25:00', 1),
(89, 56, 40, 'Dmitry Korotkin', 'JB', 'H 564', '19:40:00', '21:20:00', 1),
(90, 56, 40, 'Dmitry Korotkin', 'JC', 'H 603-1', '13:15:00', '15:05:00', 1),
(91, 57, 35, 'Alexander Shnirelman', 'RA', 'H 603-1', '14:15:00', '15:55:00', 5),
(92, 57, 35, 'Alexander Shnirelman', 'RB', 'H 400', '14:15:00', '15:55:00', 5),
(93, 57, 30, 'Alexander Shnirelman', 'RC', 'MB S1.105', '14:15:00', '15:55:00', 5),
(94, 58, 40, 'Dimiter Dryanov', 'SA', 'H 423', '08:20:00', '10:00:00', 1),
(95, 58, 40, 'Dimiter Dryanov', 'SB', 'H 439', '13:15:00', '14:55:00', 3),
(96, 58, 40, 'Dimiter Dryanov', 'SC', 'H 631', '08:20:00', '10:00:00', 1),
(97, 59, 40, 'Iman Gohar', 'TA', 'H 540', '09:45:00', '11:25:00', 4),
(98, 59, 40, 'Iman Gohar', 'TB', 'MB 6.245', '09:45:00', '11:25:00', 4),
(99, 59, 40, 'Iman Gohar', 'TC', 'MB 6.235', '09:45:00', '11:25:00', 4),
(100, 60, 35, 'Alexander Shnirelman', 'UA', 'H 603-1', '09:45:00', '11:25:00', 1),
(101, 60, 35, 'Alexander Shnirelman', 'UB', 'H 615', '13:15:00', '14:55:00', 1),
(102, 60, 30, 'Alexander Shnirelman', 'UC', 'H 400', '09:45:00', '11:25:00', 1),
(103, 61, 35, 'ALI NAZEMI', 'VA', 'H 513', '08:20:00', '10:00:00', 1),
(104, 61, 35, 'ALI NAZEMI', 'VB', 'H 615', '08:20:00', '10:00:00', 1),
(105, 61, 30, 'ALI NAZEMI', 'VC', 'MB S2.105', '08:20:00', '10:00:00', 1),
(106, 62, 40, 'Nataliia Rossokhata', 'XA', 'H 423', '14:15:00', '15:55:00', 5),
(107, 62, 40, 'Nataliia Rossokhata', 'XB', 'H 403', '14:15:00', '15:55:00', 5),
(108, 62, 40, 'Nataliia Rossokhata', 'XC', 'MB S2.285', '14:15:00', '15:55:00', 5),
(109, 105, 22, 'Malcolm Whiteway', '01', 'CC 301', '13:30:00', '15:30:00', 2),
(110, 105, 21, 'Malcolm Whiteway', '02', 'CC 301', '15:30:00', '17:30:00', 2),
(111, 105, 21, 'Malcolm Whiteway', '03', 'CJ 1.125', '13:30:00', '15:30:00', 3),
(112, 105, 21, 'Malcolm Whiteway', '04', 'CJ 1.125', '15:30:00', '17:30:00', 3),
(113, 105, 21, 'Malcolm Whiteway', '05', 'CC 101', '13:30:00', '15:30:00', 4),
(114, 105, 22, 'Malcolm Whiteway', '06', 'CC 101', '15:30:00', '17:30:00', 4),
(115, 105, 21, 'Malcolm Whiteway', '07', 'CC 106', '13:30:00', '15:30:00', 4),
(116, 105, 22, 'Malcolm Whiteway', '08', 'CC 106', '15:30:00', '17:30:00', 4),
(117, 108, 44, 'Robin Drew', 'WA', 'H 427', '15:15:00', '16:05:00', 5),
(118, 108, 45, 'Robin Drew', 'EB', 'H 523', '15:15:00', '16:05:00', 5),
(119, 36, 40, 'Mohamed Taleb', 'EI', 'TBA', '16:15:00', '17:05:00', 1),
(120, 36, 40, 'Mohamed Taleb', 'EJ', 'TBA', '16:15:00', '17:05:00', 3),
(121, 36, 30, 'Mohamed Taleb', 'EK', 'TBA', '16:15:00', '17:05:00', 3),
(122, 37, 38, 'Dhrubajyoti Goswami', 'XA', 'H 929', '16:15:00', '17:05:00', 1),
(123, 37, 50, 'Dhrubajyoti Goswami', 'XB', 'H 929', '16:15:00', '17:05:00', 3),
(124, 37, 25, 'Dhrubajyoti Goswami', 'XC', 'TBA', '16:15:00', '17:05:00', 1),
(125, 111, 0, 'Sadegh Ghaderpanah', 'EA', 'H 917', '11:45:00', '13:15:00', 2),
(126, 111, 0, 'Sadegh Ghaderpanah', 'EB', 'H 917', '11:45:00', '13:15:00', 4),
(127, 111, 0, 'Sadegh Ghaderpanah', 'EC', 'H 929', '17:45:00', '19:15:00', 1),
(128, 112, 0, 'Emad Shihab', 'PA', 'H 917', '08:45:00', '10:25:00', 5),
(129, 112, 0, 'Emad Shihab', 'PB', 'H 917', '10:15:00', '11:45:00', 1),
(130, 113, 0, 'Mohamed Taleb', 'QA', 'H 831', '10:15:00', '11:55:00', 1),
(131, 113, 0, 'Mohamed Taleb', 'QB', 'H 831', '10:15:00', '11:55:00', 3),
(132, 114, 0, 'Nancy Acemian', 'RA', 'H 905', '10:15:00', '11:55:00', 1),
(133, 114, 0, 'Nancy Acemian', 'RB', 'H 917', '10:15:00', '11:55:00', 3),
(134, 114, 0, 'Nancy Acemian', 'RC', 'H 831', '08:45:00', '10:25:00', 5),
(135, 115, 0, 'Eusebius Doedel', 'DA', 'H 431', '20:30:00', '22:10:00', 3),
(136, 115, 0, 'Eusebius Doedel', 'DB', 'H 433', '20:30:00', '22:10:00', 3),
(137, 115, 0, 'Eusebius Doedel', 'DC', 'H 411', '20:30:00', '22:10:00', 3),
(138, 115, 0, 'Eusebius Doedel', 'DD', 'H 415', '20:30:00', '22:10:00', 3),
(139, 116, 0, 'Gosta Grahne', 'QA', 'H 631', '16:15:00', '17:55:00', 2),
(140, 116, 0, 'Gosta Grahne', 'QB', 'MB 2.445', '14:45:00', '16:25:00', 4),
(141, 117, 0, 'Pankaj Kamthan', 'RA', 'H 420', '16:15:00', '17:55:00', 2),
(142, 117, 0, 'Pankaj Kamthan', 'RB', 'H 633', '16:15:00', '17:55:00', 2),
(143, 118, 0, 'Remi Alaurent', 'EA', 'H 423', '08:45:00', '09:35:00', 3),
(144, 118, 0, 'Remi Alaurent', 'EB', 'H 423', '08:45:00', '09:35:00', 3),
(145, 118, 0, 'Remi Alaurent', 'EC', 'H 423', '16:15:00', '17:05:00', 4),
(146, 118, 0, 'Remi Alaurent', 'ED', 'H 423', '16:15:00', '17:05:00', 4),
(147, 118, 0, 'Remi Alaurent', 'EE', 'H 401', '17:45:00', '18:35:00', 4),
(148, 118, 0, 'Remi Alaurent', 'EF', 'H 401', '17:45:00', '18:35:00', 4),
(149, 118, 0, 'Remi Alaurent', 'EG', 'FG B055', '16:15:00', '17:05:00', 2),
(150, 118, 0, 'Remi Alaurent', 'EH', 'H 423', '08:45:00', '09:35:00', 1),
(151, 119, 0, 'Dmitry Korotkin', 'PA', 'H 920', '13:15:00', '14:55:00', 5),
(152, 119, 0, 'Dmitry Korotkin', 'PB', 'H 1070', '13:15:00', '14:55:00', 5),
(153, 120, 0, 'Nataliia Rossokhata', 'RA', 'H 561', '08:20:00', '10:00:00', 1),
(154, 120, 0, 'Nataliia Rossokhata', 'RB', 'H 557', '08:20:00', '10:00:00', 1),
(155, 121, 0, 'Georgi Vatistas', 'TA', 'MB 3.430', '13:15:00', '14:55:00', 1),
(156, 121, 0, 'Georgi Vatistas', 'TB', 'MB 2.430', '13:15:00', '14:55:00', 1),
(157, 122, 0, 'Alexei Kokotov', 'UA', 'MB S2.115', '14:15:00', '15:55:00', 5),
(158, 122, 0, 'Alexei Kokotov', 'UB', 'MB 5.265', '14:15:00', '15:55:00', 1),
(159, 123, 0, 'Ciprian Alecsandru', 'VA', 'FG B030', '13:45:00', '15:25:00', 4),
(160, 123, 0, 'Ciprian Alecsandru', 'VB', 'FG B070', '13:45:00', '15:25:00', 4),
(161, 124, 0, 'Pawel Gora', 'XA', 'H 521', '13:15:00', '14:55:00', 1),
(162, 124, 0, 'Pawel Gora', 'XB', 'FG B070', '13:15:00', '14:55:00', 1),
(163, 125, 0, 'Dimiter Dryanov', 'XE', 'H 507', '15:45:00', '17:25:00', 5),
(164, 125, 0, 'Dimiter Dryanov', 'XF', 'H 411', '15:45:00', '17:25:00', 5),
(165, 83, 60, 'Ketra Schmitt', 'TA', 'MB S2.115', '10:15:00', '11:05:00', 5),
(166, 83, 60, 'Ketra Schmitt', 'TB', 'MB S1.401', '10:15:00', '11:05:00', 5),
(167, 84, 50, 'Steve Shih', 'UA', 'H 401', '14:45:00', '15:35:00', 5),
(168, 84, 50, 'Steve Shih', 'UB', 'FG B080', '14:45:00', '15:35:00', 1),
(169, 85, 45, 'Dongyu Qiu', 'WA', 'H 523', '08:45:00', '09:35:00', 3),
(170, 85, 45, 'Dongyu Qiu', 'WB', 'H 523', '08:45:00', '09:35:00', 5),
(171, 86, 50, 'Charles Kiyanda', 'UA', 'TBA', '20:30:00', '21:20:00', 4),
(172, 86, 50, 'Charles Kiyanda', 'UB', 'TBA', '20:30:00', '21:20:00', 4),
(173, 87, 50, 'Rahim Tadayon', 'VA', 'H 629', '11:45:00', '12:35:00', 5),
(174, 87, 50, 'Rahim Tadayon', 'VB', 'H 629', '13:15:00', '14:05:00', 5),
(175, 88, 50, 'Rolf Wuthrich', 'XA', 'TBA', '13:15:00', '14:05:00', 4),
(176, 88, 50, 'Rolf Wuthrich', 'XB', 'TBA', '15:15:00', '16:05:00', 4),
(177, 80, 25, 'Mohammed Mawlana', 'RA', 'EV 1.162', '17:45:00', '18:35:00', 2),
(178, 80, 25, 'Mohammed Mawlana', 'RB', 'EV 3.309', '17:45:00', '18:35:00', 2),
(179, 80, 25, 'Mohammed Mawlana', 'RC', 'EV 1.162', '18:45:00', '19:35:00', 4),
(180, 80, 25, 'Mohammed Mawlana', 'RD', 'EV 3.309', '18:45:00', '19:35:00', 4),
(181, 81, 25, 'Gerard Gouw', 'SA', 'EV 1.162', '17:45:00', '18:35:00', 4),
(182, 81, 25, 'Gerard Gouw', 'SB', 'EV 3.309', '17:45:00', '18:35:00', 4),
(183, 81, 25, 'Gerard Gouw', 'SC', 'EV 1.162', '18:45:00', '19:35:00', 2),
(184, 81, 25, 'Gerard Gouw', 'SD', 'EV 3.309', '18:45:00', '19:35:00', 2),
(185, 96, 25, 'Bruno Grenier', 'EN', 'MB 2.255', '16:15:00', '17:55:55', 1),
(186, 96, 25, 'Bruno Grenier', 'EO', 'MB 2.255', '16:15:00', '17:55:55', 4),
(187, 96, 25, 'Bruno Grenier', 'EP', 'MB 1.301', '16:15:00', '17:55:55', 5),
(188, 96, 25, 'Bruno Grenier', 'EQ', 'H 529', '20:30:00', '22:10:00', 2),
(189, 97, 25, 'Laurie Lamoureux Scholes', 'UA', 'H 501', '14:45:00', '16:25:00', 4),
(190, 97, 25, 'Laurie Lamoureux Scholes', 'UB', 'H 609', '14:45:00', '16:25:00', 4),
(191, 97, 25, 'Laurie Lamoureux Scholes', 'UC', 'MB S1.105', '17:45:00', '19:25:00', 1),
(192, 97, 25, 'Laurie Lamoureux Scholes', 'UD', 'H 603-1', '17:45:00', '19:25:00', 1),
(193, 98, 25, 'Laurie Lamoureux Scholes', 'WA', 'MB 2.265', '20:30:00', '22:10:00', 2),
(194, 98, 25, 'Laurie Lamoureux Scholes', 'WB', 'MB 2.255', '17:55:00', '19:35:00', 5),
(195, 98, 25, 'Laurie Lamoureux Scholes', 'WC', 'MB 3.255', '17:55:00', '19:35:00', 4),
(196, 98, 25, 'Laurie Lamoureux Scholes', 'WD', 'MB S1.105', '20:30:00', '22:10:00', 2),
(197, 99, 25, 'Brandiff Caron', 'YA', 'MB 2.255', '16:15:00', '17:55:00', 5),
(198, 99, 25, 'Brandiff Caron', 'YB', 'MB 2.265', '16:15:00', '17:55:00', 2),
(199, 99, 25, 'Brandiff Caron', 'YC', 'MB 2.265', '16:15:00', '17:55:00', 1),
(200, 99, 25, 'Brandiff Caron', 'YD', 'MB 2.265', '16:15:00', '17:55:00', 5),
(201, 102, 60, 'Pouya Valizadeh', 'JA', 'MB S1.235', '09:45:00', '11:25:00', 3),
(202, 102, 60, 'Pouya Valizadeh', 'JB', 'H 521', '10:15:00', '11:55:00', 3),
(203, 103, 64, 'Mojtaba Kahrizi', 'EA', 'H 605', '13:15:00', '16:05:00', 2),
(204, 137, 64, 'Pouya Valizadeh', 'HA', 'H 557', '13:15:00', '14:05:00', 2),
(205, 105, 22, 'Malcolm Whiteway', '01', 'CC 301', '13:30:00', '15:30:00', 2),
(206, 105, 21, 'Malcolm Whiteway', '02', 'CC 301', '15:30:00', '17:30:00', 2),
(207, 105, 22, 'Malcolm Whiteway', '03', 'CJ 1.125', '13:30:00', '15:30:00', 3),
(208, 105, 21, 'Malcolm Whiteway', '04', 'CJ 1.125', '15:30:00', '17:30:00', 3),
(209, 105, 21, 'Malcolm Whiteway', '05', 'CC 101', '13:30:00', '15:30:00', 4),
(210, 105, 22, 'Malcolm Whiteway', '06', 'CC 101', '15:30:00', '17:30:00', 4),
(211, 105, 21, 'Malcolm Whiteway', '07', 'CC 106', '13:30:00', '15:30:00', 4),
(212, 105, 22, 'Malcolm Whiteway', '08', 'CC 106', '15:30:00', '17:30:00', 4),
(213, 63, 50, 'Theodore Stathopoulos', 'JA', 'FG B055', '13:45:00', '15:25:00', 5),
(214, 63, 50, 'Theodore Stathopoulos', 'JB', 'FG B080', '13:45:00', '15:25:00', 5),
(215, 64, 50, 'Ferawati Gani', 'LA', 'FG B055', '17:45:00', '19:25:00', 5),
(216, 64, 50, 'Ferawati Gani', 'LB', 'FG B080', '17:45:00', '19:25:00', 5),
(217, 65, 50, 'Ehab Ahmed', 'WA', 'MB S2.285', '20:30:00', '22:10:00', 4),
(218, 66, 50, 'Alexandre Paradis', 'TA', 'FG B055', '11:45:00', '13:25:00', 3),
(219, 66, 50, 'Alexandre Paradis', 'TB', 'FG B055', '10:05:00', '11:45:00', 3),
(220, 66, 50, 'Alexandre Paradis', 'TC', 'FG B080', '11:45:00', '13:25:00', 3),
(221, 67, 50, 'Alexandre Paradis', 'TE', 'FG B080', '20:30:00', '22:10:00', 4),
(222, 67, 50, 'Alexandre Paradis', 'TF', 'FG B080', '10:05:00', '11:45:00', 3),
(223, 67, 50, 'Alexandre Paradis', 'TG', 'FG B055', '08:30:00', '10:10:00', 4),
(224, 68, 50, 'Chellaiyah Rajalingham', 'VA', 'FG B055', '14:45:00', '16:25:00', 3),
(225, 68, 50, 'Chellaiyah Rajalingham', 'VB', 'FG B055', '11:45:00', '13:25:00', 1),
(226, 68, 50, 'Chellaiyah Rajalingham', 'VC', 'H 423', '14:45:00', '16:25:00', 3),
(227, 69, 50, 'Hany Alaa Eldin Gomaa', 'XA', 'FG B080', '11:45:00', '13:25:00', 1),
(228, 69, 50, 'Hany Alaa Eldin Gomaa', 'XB', 'FG B080', '14:45:00', '16:25:00', 3),
(229, 69, 50, 'Hany Alaa Eldin Gomaa', 'XC', 'H 459', '11:45:00', '13:25:00', 1),
(230, 76, 50, 'Chellaiyah Rajalingham', 'VA', 'FG B055', '11:45:00', '13:25:00', 5),
(231, 76, 50, 'Chellaiyah Rajalingham', 'VB', 'FG B080', '11:45:00', '13:25:00', 5),
(232, 77, 50, 'Alexandre Paradis', 'WA', 'H 403', '11:45:00', '13:25:00', 5),
(233, 77, 50, 'Alexandre Paradis', 'WB', 'H 423', '11:45:00', '13:25:00', 5),
(234, 78, 50, 'Chellaiyah Rajalingham', 'XE', 'H 459', '15:30:00', '17:10:00', 5),
(235, 78, 50, 'Chellaiyah Rajalingham', 'XF', 'H 629', '15:30:00', '17:10:00', 5),
(236, 82, 52, 'Marius Paraschivoiu', 'EA', 'H 603', '15:15:00', '16:05:00', 5),
(237, 82, 50, 'Marius Paraschivoiu', 'EB', 'H 403', '16:15:00', '17:05:00', 5),
(238, 82, 58, 'Marius Paraschivoiu', 'EC', 'H 539', '15:15:00', '16:05:00', 5),
(239, 82, 58, 'Marius Paraschivoiu', 'ED', 'H 565', '16:15:00', '17:05:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login_name`, `password`, `firstname`, `lastname`, `email`) VALUES
(1, 'john_smith', '$2y$10$Uibceicm1kNxSVEo0qe49Ok6wjsWPmwl/0wsroB5CD0d5ox2EeP12', 'John', 'Smith', 'john_smith@email.com'),
(2, 'bob_smith', '$2y$10$xw8Sxk/CUG31FjlaFGQFKuCaowIgpnf0iR4JQHEjeDfwrLp3NuVGC', 'Bob', 'Smith', 'bob_smith@email.com'),
(3, 'sin_smith', '$2y$10$95nt236o4qaQQsxQyaFd5Oi.m3AU7j6qUAgO.WnPldl1n3makAO7.', 'Sin', 'Smith', 'sin_smith@email.com'),
(4, 'mrs_smith', '$2y$10$tqg/9hd5et0j9l.iFA/kYOA.FXnleRHXopDkLCkkDWqpDBfPiGOku', 'Mrs', 'Smith', 'mrs_smith@email.com'),
(5, 'john_cena', '$2y$10$ovXAW6yEiCnlOy.QTvcJBOha1RV22FDH21QsTk6BR.NYFCYBbHn2W', 'John', 'Cena', 'john_cena@email.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `coursecorequisite`
--
ALTER TABLE `coursecorequisite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coursecorequisite_courses_id` (`course_id`),
  ADD KEY `coursecorequisite_courses_code` (`corequisite_course_id`);

--
-- Indexes for table `courseprequisites`
--
ALTER TABLE `courseprequisites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `prerequisite_course_id` (`prerequisite_course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses` (`code`,`number`);

--
-- Indexes for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programsequence`
--
ALTER TABLE `programsequence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `tutorial_id` (`tutorial_id`),
  ADD KEY `laboratory_id` (`laboratory_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_name` (`login_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `coursecorequisite`
--
ALTER TABLE `coursecorequisite`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `courseprequisites`
--
ALTER TABLE `courseprequisites`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=813;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `programsequence`
--
ALTER TABLE `programsequence`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;
--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2063;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `coursecorequisite`
--
ALTER TABLE `coursecorequisite`
  ADD CONSTRAINT `coursecorequisite_courses_code` FOREIGN KEY (`corequisite_course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `coursecorequisite_courses_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `courseprequisites`
--
ALTER TABLE `courseprequisites`
  ADD CONSTRAINT `courseprequisites_ibfk_2` FOREIGN KEY (`prerequisite_course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courseprequisites_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_subject_code` FOREIGN KEY (`code`) REFERENCES `subject` (`code`);

--
-- Constraints for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD CONSTRAINT `laboratories_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `programsequence`
--
ALTER TABLE `programsequence`
  ADD CONSTRAINT `programsequence_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `programsequence_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`);

--
-- Constraints for table `registered`
--
ALTER TABLE `registered`
  ADD CONSTRAINT `registered_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `registered_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `registered_ibfk_3` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`),
  ADD CONSTRAINT `registered_ibfk_4` FOREIGN KEY (`laboratory_id`) REFERENCES `laboratories` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`);

--
-- Constraints for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD CONSTRAINT `tutorials_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
