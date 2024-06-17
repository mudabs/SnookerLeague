-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 01:13 PM
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
  `estdate` date NOT NULL,
  `location` varchar(30) NOT NULL,
  `numplayers` int(11) NOT NULL,
  `logo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `estdate`, `location`, `numplayers`, `logo`) VALUES
(41, 'Ellusion 73', '2024-05-04', 'DZ Extension', 130, 'Ellusion 73.jpg'),
(42, 'HIT', '2024-05-04', 'Harare Institute Of Technology', 20, 'HIT.png'),
(43, 'UZ Vikings', '2024-05-04', 'University of Zimbabwe', 20, 'UZ Vikings.jpeg'),
(44, 'USB', '2024-05-04', 'DZ Extension', 20, 'USB.jpg'),
(45, 'Mega 1 Pool Club', '2024-05-05', 'Granite Side', 130, 'Mega 1 Pool Club.jpg'),
(46, 'Players Pool Club', '2024-05-05', 'CBD- Big Bite', 130, 'Mega 1 Pool Club.jpg'),
(47, 'Muridzi Wenyaya', '2024-05-05', 'Parktown Waterfalls', 130, 'Muridzi Wenyaya.jpg'),
(48, 'Legends Pool Club', '2024-05-05', 'Zindoga', 130, 'Legends Pool Club.jpg'),
(49, 'Paukama', '2024-06-04', 'Warren Park 1', 50, 'Paukama.jpg'),
(50, 'BnB', '2024-06-04', 'Ruwa', 50, 'BnB.jpg'),
(51, 'Killarz', '2024-06-04', 'Hatfield', 30, 'Killarz.jpg'),
(52, 'Leisure Center', '2024-06-04', 'Harare', 30, 'Leisure Center.jpg'),
(53, 'Nice Day Select', '2024-06-04', 'Southlea Park', 30, 'Nice Day Select.jpg'),
(54, 'BnB Magafa', '2024-06-04', 'Mabvuku Tafara', 30, 'BnB Magafa.jpg'),
(55, 'Old Timers', '2024-06-04', 'Chadcomb', 30, 'Old Timers.jpg'),
(56, 'Blazers', '2024-06-04', 'Budiriro', 30, 'Blazers.jpg'),
(57, 'Top Snipers', '2024-06-04', 'CBD', 30, 'Top Snipers.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `executives`
--

CREATE TABLE `executives` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `role` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `executives`
--

INSERT INTO `executives` (`id`, `name`, `role`, `image`) VALUES
(3, 'Munashe Mudabura', '', '.png'),
(7, 'Tomas Mangwana', '', 'image.png'),
(8, 'John Chingwaru', '', '.jpg'),
(9, 'Michael Magz', '', '.png'),
(11, 'Old Timers', 'Marketing', 'Old Timers.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL,
  `team1id` int(11) NOT NULL,
  `team2id` int(11) NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `team1id`, `team2id`, `date`, `venue`) VALUES
(29, 42, 45, '2024-05-29', 'Townn'),
(30, 45, 45, '2024-05-29', 'Town'),
(31, 43, 46, '2024-05-29', 'CBD'),
(37, 47, 46, '2024-06-04', 'Mutare');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `clubId` int(11) NOT NULL,
  `played` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `loses` int(11) NOT NULL,
  `ff` int(11) NOT NULL,
  `fa` int(11) NOT NULL,
  `fd` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `position`, `clubId`, `played`, `wins`, `draws`, `loses`, `ff`, `fa`, `fd`, `points`) VALUES
(1, 1, 41, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 42, 1, 0, 0, 1, 4, 5, -1, 0),
(3, 1, 43, 1, 1, 0, 0, 6, 5, 1, 3),
(4, 1, 44, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 1, 45, 1, 1, 0, 0, 5, 4, 1, 3),
(6, 1, 46, 2, 0, 1, 1, 11, 12, -1, 1),
(7, 1, 47, 1, 0, 1, 0, 6, 6, 0, 1),
(8, 1, 48, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 1, 49, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 1, 50, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 1, 51, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 1, 52, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 1, 53, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 1, 54, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 1, 55, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 1, 56, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 1, 57, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `clubid` int(11) NOT NULL,
  `played` int(11) DEFAULT NULL,
  `goal_difference` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `position`, `clubid`, `played`, `goal_difference`, `points`) VALUES
(1, 1, 0, 10, 5, 30),
(2, 2, 0, 10, 2, 25),
(3, 3, 0, 10, 0, 20),
(4, 4, 0, 10, -3, 15),
(5, 5, 0, 10, -5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `feed` text NOT NULL,
  `date` date NOT NULL,
  `coverImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `feed`, `date`, `coverImage`) VALUES
(14, 'News Feed 1', 'awxdrbuhjnimko,l;. Hello awxdrbuhjnimko,l;. Hello awxdrbuhjnimko,l;. Hello awxdrbuhjnimko,l;. Hello awxdrbuhjnimko,l;. Hello awxdrbuhjnimko,l;. Hello', '2024-05-07', 'image.png'),
(15, 'News Feed 2', ' Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello', '2024-05-01', 'image.png'),
(17, 'asfdgg', 'edhdgsfasdfndvcvbvc', '2024-05-09', 'asfdgg.jpg'),
(27, 'Sink the Colors: A Quick Guide to Snooker', 'Php code to create a news article with form to enter name of article, the article feed along with a cover image and the date. The feed should have no limit on text and provide code to create the database table for articles. Php code to create a news article with form to enter name of article, the article feed along with a cover image and the date. The feed should have no limit on text and provide code to create the database table for articles. Php code to create a news article with form to enter name of article, the article feed along with a cover image and the date. The feed should have no limit on text and provide code to create the database table for articles\r\n', '2024-05-27', 'Sink the C.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `old_fixtures`
--

CREATE TABLE `old_fixtures` (
  `id` int(11) NOT NULL,
  `team1id` int(11) NOT NULL,
  `team2id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `venue` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `old_fixtures`
--

INSERT INTO `old_fixtures` (`id`, `team1id`, `team2id`, `date`, `venue`) VALUES
(1, 41, 42, '2024-05-29 00:00:00', 'CBD'),
(2, 42, 45, '2024-05-29 00:00:00', 'Town'),
(3, 45, 45, '2024-05-29 00:00:00', 'Town'),
(4, 43, 46, '2024-05-29 00:00:00', 'CBD'),
(5, 43, 46, '2024-05-29 00:00:00', 'CBD'),
(6, 45, 45, '2024-05-29 00:00:00', 'Town'),
(7, 41, 43, '2024-05-30 00:00:00', 'CBD'),
(8, 42, 45, '2024-05-30 00:00:00', 'Town'),
(9, 42, 43, '2024-05-30 00:00:00', 'UZ'),
(10, 47, 46, '2024-06-04 00:00:00', 'Mutare'),
(11, 49, 42, '2024-06-04 00:00:00', 'Harare'),
(12, 53, 54, '2024-06-05 00:00:00', 'Marondera'),
(13, 42, 45, '2024-05-29 00:00:00', 'CBBBBD');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `clubid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `clubid`, `name`) VALUES
(16, 42, 'Munashe Sam Mudabura'),
(17, 42, 'Simbarashe Manene'),
(18, 47, 'Sam Mudabs');

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
(9, 29, 4, 5),
(13, 31, 6, 5),
(14, 37, 6, 6);

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
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clubid` (`clubId`);

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
-- Indexes for table `old_fixtures`
--
ALTER TABLE `old_fixtures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clubid` (`clubid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `executives`
--
ALTER TABLE `executives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `old_fixtures`
--
ALTER TABLE `old_fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_clubid` FOREIGN KEY (`clubId`) REFERENCES `clubs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_fixtureId` FOREIGN KEY (`fixtureId`) REFERENCES `fixtures` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
