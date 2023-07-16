-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 03:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbuild`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `title`, `description`, `file`) VALUES
(30, 4, 'Cabinet', 'Proven experience as a Cabinet Maker or similar role Proficient in woodworking techniques and cabinet construction\\r\\nStrong knowledge of different wood types, materials, and hardware used in cabinet making Ability to read and interpret blueprints and design plans Excellent craftsmanship and attention to detail', '');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `jobId` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `user_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `fname`, `lname`, `mname`, `user_status`) VALUES
(1, '', 'dmajarais@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'David Roy', 'Majarais', '', 1),
(2, '', 'mdavidroy@yahoo.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'David Roy', 'Majarais', '', 1),
(3, '', 'vonpussylover@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Von', 'Pepeng masarap', '', 1),
(4, '', 'titinibenet@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'David', 'asdsasad', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `fullName` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` text NOT NULL,
  `experiences` text NOT NULL,
  `training` text NOT NULL,
  `expertise` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`fullName`, `age`, `address`, `experiences`, `training`, `expertise`) VALUES
('David Roy G. Majarais', 12, '62 Estanislao St', 'tite', 'tite', 'tite'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'tite', 'tite', 'tite'),
('David Roy G. Majarais', 20, '62 Estanislao St', 'kumain ng tite', 'chupa training', 'kumantot ng hamster'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 12, '62 Estanislao St', 'asasd', 'daad', 'asg'),
('David Roy G. Majarais', 21, '62 Estanislao St', 'asdasd', 'asdad', 'asdada');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `FK_jobs_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
