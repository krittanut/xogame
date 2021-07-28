-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 09:51 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xogame`
--

-- --------------------------------------------------------

--
-- Table structure for table `game_1`
--

CREATE TABLE `game_1` (
  `id` int(5) NOT NULL,
  `win` int(5) NOT NULL,
  `move` varchar(50) NOT NULL,
  `size` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game_1`
--

INSERT INTO `game_1` (`id`, `win`, `move`, `size`) VALUES
(13, 0, '0,4,6,3,5,1,7,8,2,', 3),
(14, 0, '0,4,6,3,5,1,7,8,2,', 3),
(15, 0, '0,4,6,3,5,1,7,8,2,', 3),
(16, 0, '3,0,4,5,1,7,6,2,8,', 3),
(17, 0, '6,4,0,3,5,1,7,8,2,', 3),
(18, -1, '4,0,3,5,6,2,7,1,', 3),
(19, -1, '0,4,6,3,7,5,', 3),
(20, -1, '3,0,4,5,6,2,7,1,', 3),
(21, 0, '0,4,6,3,5,1,7,8,2,', 3),
(22, 0, '0,4,6,3,5,1,7,8,2,', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_1`
--
ALTER TABLE `game_1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_1`
--
ALTER TABLE `game_1`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
