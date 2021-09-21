-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2021 at 06:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interview2`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dob`, `email`, `img`, `created_at`) VALUES
(1, 'moiit', '2021-09-07', 'test@gmail.com', 'index.jpg', '2021-09-20 15:36:19'),
(2, 'moiit', '2021-09-07', 'test@gmail.com', 'index1.jpg', '2021-09-20 15:37:06'),
(3, 'etsts', '2021-09-08', 'test@gmail.com', 'e1.jpg', '2021-09-20 15:38:06'),
(4, 'test', '2021-08-31', 'test@gmail.com', 'index3.jpg', '2021-09-20 16:02:56'),
(5, 'test', '2021-08-31', 'test@gmail.com', 'index4.jpg', '2021-09-20 16:02:59'),
(6, 'test', '2021-09-14', 'test@gmail.com', 'index5.jpg', '2021-09-20 16:15:45'),
(7, 'test', '2021-09-07', 'test@gmail.com', 'index6.jpg', '2021-09-20 16:23:42'),
(8, 'test', '2021-09-13', 'test@gmail.com', 'index9.jpg', '2021-09-20 16:31:06'),
(9, 'test', '2021-09-13', 'test@gmail.com', 'index10.jpg', '2021-09-20 16:33:16'),
(10, 'test', '2021-09-03', 'test@gmail.com', 'index11.jpg', '2021-09-20 16:35:27'),
(11, 'test', '2021-09-03', 'test@gmail.com', 'index12.jpg', '2021-09-20 16:35:27'),
(12, 'test', '2021-09-15', 'test@gmail.com', 'index13.jpg', '2021-09-21 04:30:08'),
(13, 'test', '2021-09-02', 'test@gmail.com', 'index14.jpg', '2021-09-21 04:33:07'),
(14, 'test', '2021-09-18', 'etst@gmail.com', 'index15.jpg', '2021-09-21 04:33:30'),
(15, 'testss', '2021-09-08', 'etst@gmail.com', 'e.jpg', '2021-09-21 05:17:10'),
(16, 'test', '2021-09-08', 'test@gmail.com', 'e2.jpg', '2021-09-21 16:15:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
