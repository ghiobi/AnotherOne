-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2016 at 03:12 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytiernary`
--
DROP DATABASE `mytiernary`;
CREATE DATABASE IF NOT EXISTS `mytiernary` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mytiernary`;

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
-- Table structure for table `courseprequisites`
--

DROP TABLE IF EXISTS `courseprequisites`;
CREATE TABLE `courseprequisites` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `prerequisite_couse_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `credit` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `number`, `name`, `credit`) VALUES
(1, 'SOEN', 228, 'System Hardware', '4.00'),
(2, 'SOEN', 287, 'Web Programming', '3.00'),
(3, 'SOEN', 298, 'System Hardware Lab', '1.00'),
(4, 'SOEN', 321, 'Information Systems Security', '3.00'),
(5, 'SOEN', 331, 'Introduction to Formal Methods for Software Engineering', '3.00'),
(6, 'SOEN', 341, 'Software Process', '3.00'),
(7, 'SOEN', 342, 'Software Requirements and Specifications', '3.00'),
(8, 'SOEN', 343, 'Software Architecture and Design I', '3.00'),
(9, 'SOEN', 344, 'Software Architecture and Design II', '3.00'),
(10, 'SOEN', 345, 'Software Testing, Verification and Quality Assurance', '3.00'),
(11, 'SOEN', 357, 'User Interface Design', '3.00'),
(12, 'SOEN', 384, 'Management, Measurement and Quality Control', '3.00'),
(13, 'SOEN', 385, 'Control Systems and Applications', '3.00'),
(14, 'SOEN', 387, 'Web Based Enterprise Application Design', '3.00'),
(15, 'SOEN', 390, 'Software Engineering Team Design Project', '3.50'),
(16, 'SOEN', 422, 'Embedded Systems and Software', '4.00'),
(17, 'SOEN', 423, 'Distributed Systems', '4.00'),
(18, 'SOEN', 448, 'Management of Evolving Systems', '3.00'),
(19, 'SOEN', 449, 'Component Engineering', '3.00'),
(20, 'SOEN', 487, 'Web Services and Applications', '4.00'),
(21, 'SOEN', 490, 'Capstone Software Engineering Design Project', '4.00'),
(22, 'SOEN', 491, 'Software Engineering Project', '1.00'),
(23, 'SOEN', 498, 'Topics in Software Engineering', '3.00'),
(24, 'COMP', 108, 'Computer Science Industrial Experience Reflective Learning I', '3.00'),
(25, 'COMP', 201, 'Introduction to Computing', '3.00'),
(26, 'COMP', 208, 'Computer Science Industrial Experience Reflective Learning II', '3.00'),
(27, 'COMP', 218, 'Fundamentals of Programming', '3.00'),
(28, 'COMP', 228, 'System Hardware', '3.00'),
(29, 'COMP', 232, 'Mathematics for Computer Science', '3.00'),
(30, 'COMP', 233, 'Probability and Statistics for Computer Science', '3.00'),
(31, 'COMP', 248, 'Objectâ€‘Oriented Programming I', '3.50'),
(32, 'COMP', 249, 'Objectâ€‘Oriented Programming II', '3.50'),
(33, 'COMP', 318, 'Introduction to Database Applications', '4.00'),
(34, 'COMP', 326, 'Computer Architecture', '3.00'),
(35, 'COMP', 335, 'Introduction to Theoretical Computer Science', '3.00'),
(36, 'COMP', 339, 'Combinatorics', '3.00'),
(37, 'COMP', 345, 'Advanced Program Design with C++', '4.00'),
(38, 'COMP', 346, 'Operating Systems', '4.00'),
(39, 'COMP', 348, 'Principles of Programming Languages', '3.00'),
(40, 'COMP', 352, 'Data Structures and Algorithms', '3.00'),
(41, 'COMP', 353, 'Databases', '4.00'),
(42, 'COMP', 354, 'Introduction to Software Engineering', '4.00'),
(43, 'COMP', 361, 'Elementary Numerical Methods', '3.00'),
(44, 'COMP', 367, 'Techniques in Symbolic Computation', '3.00'),
(45, 'COMP', 371, 'Computer Graphics', '4.00'),
(46, 'COMP', 376, 'Introduction to Game Development', '4.00'),
(47, 'COMP', 426, 'Multicore Programming', '4.00'),
(48, 'COMP', 428, 'Parallel Programming', '4.00'),
(49, 'COMP', 442, 'Compiler Design', '4.00'),
(50, 'COMP', 444, 'System Software Design', '4.00'),
(51, 'COMP', 445, 'Data Communication and Computer Networks', '4.00'),
(52, 'COMP', 451, 'Database Design', '4.00'),
(53, 'COMP', 465, 'Design and Analysis of Algorithms', '3.00'),
(54, 'COMP', 472, 'Artificial Intelligence', '4.00'),
(55, 'COMP', 473, 'Pattern Recognition', '4.00'),
(56, 'COMP', 474, 'Intelligent Systems', '4.00'),
(57, 'COMP', 476, 'Advanced Game Development', '4.00'),
(58, 'COMP', 477, 'Animation for Computer Games', '4.00'),
(59, 'COMP', 478, 'Image Processing', '4.00'),
(60, 'COMP', 479, 'Information Retrieval and Web Search', '4.00'),
(61, 'COMP', 490, 'Computer Science Project I', '3.00'),
(62, 'COMP', 492, 'Computer Science Project II', '3.00'),
(63, 'COMP', 495, 'Honours Seminar', '1.00'),
(64, 'COMP', 498, 'Topics in Computer Science', '3.00'),
(65, 'ENGR', 108, 'Engineering Industrial Experience Reflective Learning I', '3.00'),
(66, 'ENGR', 201, 'Professional Practice and Responsibility', '1.50'),
(67, 'ENGR', 202, 'Sustainable Development and Environmental Stewardship', '1.50'),
(68, 'ENGR', 208, 'Engineering Industrial Experience Reflective Learning II', '3.00'),
(69, 'ENGR', 213, 'Applied Ordinary Differential Equations', '3.00'),
(70, 'ENGR', 233, 'Applied Advanced Calculus', '3.00'),
(71, 'ENGR', 242, 'Statics', '3.00'),
(72, 'ENGR', 243, 'Dynamics', '3.00'),
(73, 'ENGR', 244, 'Mechanics of Materials', '3.75'),
(74, 'ENGR', 245, 'Mechanical Analysis', '3.00'),
(75, 'ENGR', 251, 'Thermodynamics I', '3.00'),
(76, 'ENGR', 290, 'Introductory Engineering Team Design Project', '3.00'),
(77, 'ENGR', 301, 'Engineering Management Principles and Economics', '3.00'),
(78, 'ENGR', 308, 'Engineering Industrial Experience Reflective Learning III', '3.00'),
(79, 'ENGR', 311, 'Transform Calculus and Partial Differential Equations', '3.00'),
(80, 'ENGR', 361, 'Fluid Mechanics I', '3.00'),
(81, 'ENGR', 371, 'Probability and Statistics in Engineering', '3.00'),
(82, 'ENGR', 391, 'Numerical Methods in Engineering', '3.00'),
(83, 'ENGR', 392, 'Impact of Technology on Society', '3.00'),
(84, 'ENGR', 411, 'Special Technical Report', '1.00'),
(85, 'ENGR', 412, 'Honours Research Project', '3.00'),
(86, 'ENGR', 472, 'Robot Manipulators', '3.50'),
(87, 'ENGR', 498, 'Topics in Engineering', '3.00'),
(88, 'ENCS', 272, 'Composition and Argumentation for Engineers', '3.00'),
(89, 'ENCS', 282, 'Technical Writing and Communication', '3.00'),
(90, 'ENCS', 393, 'Social and Ethical Dimensions of Information and Communication Technologies', '3.00'),
(91, 'ENCS', 483, 'Creativity, Innovation and Critical Thinking in Science and Technology', '3.00'),
(92, 'ENCS', 484, 'Development and Global Engineering', '3.00'),
(93, 'ENCS', 498, 'Topics in Engineering and Computer Science', '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `laboratories`
--

DROP TABLE IF EXISTS `laboratories`;
CREATE TABLE `laboratories` (
  `id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `capacity` int(11) UNSIGNED NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `room` varchar(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

DROP TABLE IF EXISTS `lectures`;
CREATE TABLE `lectures` (
  `id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `room` varchar(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

DROP TABLE IF EXISTS `registered`;
CREATE TABLE `registered` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `tutorial_id` int(11) UNSIGNED NOT NULL,
  `laboratory_id` int(11) UNSIGNED NOT NULL,
  `grade` varchar(255) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` int(11) UNSIGNED NOT NULL,
  `semester_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `capacity` smallint(6) UNSIGNED NOT NULL,
  `professor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

DROP TABLE IF EXISTS `semesters`;
CREATE TABLE `semesters` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `start`, `end`) VALUES
(1, 'Fall 2015', '2015-09-08', '2015-12-07');

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
(1, 1, 1),
(2, 2, 2),
(3, 3, 1);

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
  `room` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'john_smith', '5f4dcc3b5aa765d61d8327deb882cf99', 'John', 'Smith', 'john_smith@email.com'),
(2, 'bob_smith', '5f4dcc3b5aa765d61d8327deb882cf99', 'Bob', 'Smith', 'bob_smith@email.com'),
(3, 'sin_smith', '5f4dcc3b5aa765d61d8327deb882cf99', 'Sin', 'Smith', 'sin_smith@email.com'),
(4, 'mrs_smith', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Smith', 'mrs_smith@email.com');

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
-- Indexes for table `courseprequisites`
--
ALTER TABLE `courseprequisites`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programsequence`
--
ALTER TABLE `programsequence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `courseprequisites`
--
ALTER TABLE `courseprequisites`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `programsequence`
--
ALTER TABLE `programsequence`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
