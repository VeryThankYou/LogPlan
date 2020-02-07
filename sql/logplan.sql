-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2020 at 08:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logplan`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_element_id` int(11) NOT NULL,
  `text` varchar(2056) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `time_element_id`, `text`) VALUES
(28, 2, 1, 'Write your LogComment here...'),
(29, 2, 1, 'Write your LogComment here...'),
(30, 2, 1, 'Write your LogComment here...'),
(31, 2, 1, 'Write your LogComment here...'),
(43, 1, 2, 'Write your LogComment here...'),
(44, 1, 2, 'Write your LogComment here...'),
(45, 1, 2, 'Write your LogComment here...'),
(46, 1, 2, 'Write your LogComment here...'),
(47, 1, 2, 'Write your LogComment here...'),
(48, 1, 13, 'William er gennemsnitlig'),
(49, 1, 13, 'Jeg har færdiggjort iteration 5 i dag'),
(50, 1, 13, 'Write your LogComment here...');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `user_id`) VALUES
(13, '', 3),
(14, '1', 3),
(22, 'halløj', 2),
(23, 'jeg hader william', 1);

-- --------------------------------------------------------

--
-- Table structure for table `time_element`
--

CREATE TABLE `time_element` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `description` varchar(2056) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_element`
--

INSERT INTO `time_element` (`id`, `project_id`, `description`, `user_id`, `start_time`, `end_time`) VALUES
(2, 12, 'Vi skal bage kage', 1, '2020-12-31 23:58:00', '2020-01-01 00:01:00'),
(3, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 12, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 22, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 23, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 14, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `firstname` text NOT NULL,
  `surname` text NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `firstname`, `surname`, `password`) VALUES
(1, 'erikbuur@hotmail.com', 'Erik', 'Christensen', '$2y$10$0ZK22PIVpdktbNg3BUQZwu.r6hlG.wOhwN6lTkcNa1zUN02n99pY6'),
(2, 'julemand@jul.dk', 'Julemand', 'Julendal', '$2y$10$wk5g6wHVDYaSMCqTy.BJUuS8lNYsrCCeeP/9HFbjG2bZJ/DgW9Cx2'),
(3, 'olivergeneser1@gmail.com', 'Oliver', 'Geneser', '$2y$10$lVjElyri2LKWkpxN2mdVUutHNGLTwjir2Cnc9rQZWYhKQ.BWpbXQO');

-- --------------------------------------------------------

--
-- Table structure for table `user_project`
--

CREATE TABLE `user_project` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_project`
--

INSERT INTO `user_project` (`user_id`, `project_id`) VALUES
(1, 10),
(1, 11),
(1, 12),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(2, 10),
(2, 11),
(2, 12),
(2, 14),
(2, 22),
(3, 13),
(3, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_element`
--
ALTER TABLE `time_element`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_project`
--
ALTER TABLE `user_project`
  ADD PRIMARY KEY (`user_id`,`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_element`
--
ALTER TABLE `time_element`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
