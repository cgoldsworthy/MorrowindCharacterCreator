-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2018 at 08:09 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database:
--

-- --------------------------------------------------------

--
-- Table structure for table `build`
--

CREATE TABLE `build` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `sign` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `race` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `prefattr1` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `prefattr2` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `str` int(3) DEFAULT NULL,
  `endu` int(3) DEFAULT NULL,
  `agi` int(3) DEFAULT NULL,
  `spd` int(3) DEFAULT NULL,
  `per` int(3) DEFAULT NULL,
  `intel` int(3) DEFAULT NULL,
  `wis` int(3) DEFAULT NULL,
  `lck` int(3) DEFAULT NULL,
  `majskill1` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `majskill2` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `majskill3` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `majskill4` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `majskill5` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `minskill1` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `minskill2` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `minskill3` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `minskill4` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `minskill5` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `heavyarm` int(3) DEFAULT NULL,
  `mediumarm` int(3) DEFAULT NULL,
  `spear` int(3) DEFAULT NULL,
  `acrobatics` int(3) DEFAULT NULL,
  `armorer` int(3) DEFAULT NULL,
  `axe` int(3) DEFAULT NULL,
  `blunt` int(3) DEFAULT NULL,
  `longblade` int(3) DEFAULT NULL,
  `block` int(3) DEFAULT NULL,
  `lightarm` int(3) DEFAULT NULL,
  `marksman` int(3) DEFAULT NULL,
  `sneak` int(3) DEFAULT NULL,
  `athletics` int(3) DEFAULT NULL,
  `handtohand` int(3) DEFAULT NULL,
  `shortblade` int(3) DEFAULT NULL,
  `unarmored` int(3) DEFAULT NULL,
  `illusion` int(3) DEFAULT NULL,
  `mercantile` int(3) DEFAULT NULL,
  `speechcraft` int(3) DEFAULT NULL,
  `alchemy` int(3) DEFAULT NULL,
  `conjuration` int(3) DEFAULT NULL,
  `enchant` int(3) DEFAULT NULL,
  `secur` int(3) DEFAULT NULL,
  `alteration` int(3) DEFAULT NULL,
  `destruction` int(3) DEFAULT NULL,
  `mysticism` int(3) DEFAULT NULL,
  `restoration` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `articleid` int(11) DEFAULT NULL,
  `text` varchar(500) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



--
-- Indexes for table `build`
--
ALTER TABLE `build`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT for table `build`
--
ALTER TABLE `build`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
