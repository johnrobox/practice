-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2016 at 03:28 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar-app`
--
CREATE DATABASE IF NOT EXISTS `seminar-app` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `seminar-app`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `is_active` int(1) NOT NULL,
  `d_o_c` datetime NOT NULL,
  `is_logged_in` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `firstname`, `middlename`, `lastname`, `username`, `user_email`, `password`, `role`, `is_active`, `d_o_c`, `is_logged_in`) VALUES
(11, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', '7488e331b8b64e5794da3fa4eb10ad5d', 'superAdmin', 1, '2015-12-26 00:00:00', 1),
(15, 'mike', 'mike', 'mike', 'mike', 'mike@gmail.com', '3e3542ed34205ec89dbd4dfa3b009b6c', 'Regular', 1, '2016-01-03 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE `seminar` (
  `seminar_id` int(11) NOT NULL,
  `seminar_creator_username` varchar(100) NOT NULL,
  `seminar_pic` varchar(255) NOT NULL,
  `seminar_name` varchar(255) NOT NULL,
  `seminar_location` varchar(255) NOT NULL,
  `seminar_location_url` varchar(255) NOT NULL,
  `seminar_time` varchar(255) NOT NULL,
  `seminar_d_o_c` date NOT NULL,
  `seminar_is_active` int(2) NOT NULL,
  `seminar_date` date NOT NULL,
  `seminar_starts` date NOT NULL,
  `seminar_ends` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seminar`
--

INSERT INTO `seminar` (`seminar_id`, `seminar_creator_username`, `seminar_pic`, `seminar_name`, `seminar_location`, `seminar_location_url`, `seminar_time`, `seminar_d_o_c`, `seminar_is_active`, `seminar_date`, `seminar_starts`, `seminar_ends`) VALUES
(21, 'admin', './images/seminar/293257566738de7a2.png', 'Free Orientation Seminar', 'Tungkop Minglanilla Cebu City', 'tungkop-minglanilla-cebu-city', '11:00 am - 5:00 pm', '2016-06-07', 1, '2016-07-31', '2016-06-15', '2016-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `con_number` varchar(20) NOT NULL,
  `found` varchar(255) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `firstname`, `middlename`, `lastname`, `age`, `address`, `email`, `con_number`, `found`, `s_id`) VALUES
(10, 'Michael', 'Angelo Prahinog', 'Larrubis', 23, 'Anislag Canlumampao Toledo City', 'email@gma.cc', '09222229991', 'Tarpaulin/Poster', 21),
(11, 'Michael', 'Angelo Prahinog', 'Larrubis', 23, 'Anislag Canlumampao Toledo City', 'email@gma.cc', '09222229991', 'Tarpaulin/Poster', 21),
(12, 'Michael', 'Angelo Prahinog', 'Larrubis', 23, 'Anislag Canlumampao Toledo City', 'email@gma.cc', '09222229991', 'Tarpaulin/Poster', 21),
(13, 'Michael', 'Angelo Prahinog', 'Larrubis', 23, 'Anislag Canlumampao Toledo City', 'email@gma.cc', '09222229991', 'Tarpaulin/Poster', 21),
(14, 'Michael', 'Angelo Prahinog', 'Larrubis', 23, 'Anislag Canlumampao Toledo City', 'email@gma.cc', '09222229991', 'Tarpaulin/Poster', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`seminar_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `seminar`
--
ALTER TABLE `seminar`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
