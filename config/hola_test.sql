-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 06:10 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hola_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `role`) VALUES
(45, 'Roy Gutierrez', 'roy', '$2y$10$/5gvG5XkPv.rQXj0Nw6VA.25yI7XsnI8y/IMVMBt87sCcxajywOJi', 'ADMIN'),
(57, 'Roger Gonzalez', 'rogergonz', '$2y$10$QjQ/dk2870txgB96l5xlOeMfkuTvX4.JoWd/IRewmTVIv8S9ob1vm', 'ADMIN'),
(58, 'test', 'testing', '$2y$10$KjnQI1zAw2RnFF0HGBr.Oun1dOlWmj6YMgEqrtFPx7Hkwh5v4xOKK', 'PAGE_1'),
(59, 'Marco Ferrari', 'marco', '$2y$10$RYzZXwt5jQZZhkTozz89TOI9WvlS.4sJKv37D9VDRO6.9XgWnXhKW', 'ADMIN'),
(60, 'roy', 'roy123', '$2y$10$lerRsGzmNjhQn5Ifg/3hseySy5ivX/O5MLRp7b4KHGhCPD8wWs7ze', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
