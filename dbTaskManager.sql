-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 08, 2024 at 06:26 PM
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
-- Database: `dbtaskmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `task_date` date NOT NULL,
  `task_time` time DEFAULT NULL,
  `status` enum('ToDo','Ongoing','Done') NOT NULL DEFAULT 'ToDo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `task_date`, `task_time`, `status`) VALUES
(2, 'asda', 'ada434', '2024-03-11', NULL, 'Done'),
(3, 'Testing', 'asdasda', '2024-02-27', NULL, 'Ongoing'),
(4, 'Testing 1.5', 'Testooo', '2024-04-03', NULL, 'Done'),
(5, 'Testing 5.5.5', 'adadad', '2024-03-28', '00:59:00', 'ToDo'),
(6, 'aaaaaaaaa', 'adad', '2024-03-26', NULL, 'Done'),
(7, 'adad', '34', '2024-03-21', NULL, 'ToDo'),
(8, 'ada', 'asdasd', '2024-03-22', NULL, 'Ongoing'),
(9, 'asda54', 'asdad', '2024-03-05', NULL, 'Ongoing'),
(10, 'asdaasdad', 'asdad', '2024-03-05', NULL, 'Ongoing'),
(11, 'Yes', 'Testing', '2024-03-25', '03:52:00', 'ToDo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
