-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 10:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snooker_league`
--

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `estdate` datetime NOT NULL,
  `location` varchar(30) NOT NULL,
  `numplayers` int(11) NOT NULL,
  `logo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `estdate`, `location`, `numplayers`, `logo`) VALUES
(34, 'USB', '2024-04-06 00:00:00', 'DZ Extension', 20, 'USB.jpg'),
(37, 'UZ Vikings', '2024-04-06 00:00:00', 'UZ', 200, 'UZ Vikings.jpg'),
(38, 'HIT', '2023-09-07 00:00:00', 'HIT', 15, 'HIT.jpg'),
(39, 'Ellusion 73', '2024-04-24 00:00:00', 'Mutare', 24, 'Ellusion 73.png');

-- --------------------------------------------------------

--
-- Table structure for table `executives`
--

CREATE TABLE `executives` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `executives`
--

INSERT INTO `executives` (`id`, `name`, `image`) VALUES
(3, 'Munashe Mudabura', '.png');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL,
  `team1id` int(11) NOT NULL,
  `team2id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `venue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `team1id`, `team2id`, `date`, `venue`) VALUES
(8, 38, 37, '2024-04-18 00:00:00', 'Mutare'),
(9, 38, 37, '2024-04-18 00:00:00', 'Mutare'),
(10, 37, 34, '2024-04-25 00:00:00', 'Mutare'),
(11, 37, 34, '2024-04-25 00:00:00', 'Mutare'),
(19, 39, 38, '2024-05-11 00:00:00', 'Harare');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `team_logo` varchar(255) DEFAULT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `played` int(11) DEFAULT NULL,
  `goal_difference` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `position`, `team_logo`, `team_name`, `played`, `goal_difference`, `points`) VALUES
(1, 1, 'path/to/team1_logo.png', 'Team 1', 10, 5, 30),
(2, 2, 'path/to/team2_logo.png', 'Team 2', 10, 2, 25),
(3, 3, 'path/to/team3_logo.png', 'Team 3', 10, 0, 20),
(4, 4, 'path/to/team4_logo.png', 'Team 4', 10, -3, 15),
(5, 5, 'path/to/team5_logo.png', 'Team 5', 10, -5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `feed` varchar(1000) NOT NULL,
  `date` datetime NOT NULL,
  `coverImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `feed`, `date`, `coverImage`) VALUES
(10, 'ertygdtr', 'swdetgyuj', '2024-04-17 00:00:00', 'ertygdtr.png');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `fixtureId` int(11) NOT NULL,
  `team1Score` int(11) NOT NULL,
  `team2Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `fixtureId`, `team1Score`, `team2Score`) VALUES
(2, 10, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` int(30) NOT NULL,
  `username` int(30) NOT NULL,
  `password` int(30) NOT NULL,
  `email` int(30) NOT NULL,
  `phone` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `executives`
--
ALTER TABLE `executives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_team1Id` (`team1id`),
  ADD KEY `fk_team2Id` (`team2id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fixtureId` (`fixtureId`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `executives`
--
ALTER TABLE `executives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD CONSTRAINT `fk_team1Id` FOREIGN KEY (`team1id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_team2Id` FOREIGN KEY (`team2id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_fixtureId` FOREIGN KEY (`fixtureId`) REFERENCES `fixtures` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
