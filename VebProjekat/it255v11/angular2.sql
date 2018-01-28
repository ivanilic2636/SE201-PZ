-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2017 at 06:15 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angular2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bolid`
--

CREATE TABLE `bolid` (
  `id_bolida` int(11) NOT NULL,
  `ime_bolida` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bolid`
--

INSERT INTO `bolid` (`id_bolida`, `ime_bolida`) VALUES
(1, 'mcclaren'),
(3, 'force india'),
(4, 'ferari');

-- --------------------------------------------------------

--
-- Table structure for table `staza`
--

CREATE TABLE `staza` (
  `id` int(11) NOT NULL,
  `ime_staze` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `grad` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `drzava` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staza`
--

INSERT INTO `staza` (`id`, `ime_staze`, `grad`, `drzava`) VALUES
(4, 'novi beograd', 'NBG', 'NBGD');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `token`) VALUES
(10, 'Ivan', 'Ilic', 'Ivan', 'c61fbef63df5ff317aecdc3670094472', '64ae31d93674cb5f4f0e504c6cec95aa5debe45c');

-- --------------------------------------------------------

--
-- Table structure for table `vozac`
--

CREATE TABLE `vozac` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `id_b` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vozac`
--

INSERT INTO `vozac` (`id`, `ime`, `prezime`, `id_b`) VALUES
(3, 'Ranzo', 'Zicja', 3),
(5, 'Ivan', 'ILic', 1),
(6, 'nemanja ', 'kuzmanovic', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bolid`
--
ALTER TABLE `bolid`
  ADD PRIMARY KEY (`id_bolida`);

--
-- Indexes for table `staza`
--
ALTER TABLE `staza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vozac`
--
ALTER TABLE `vozac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_b` (`id_b`),
  ADD KEY `id_b_2` (`id_b`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bolid`
--
ALTER TABLE `bolid`
  MODIFY `id_bolida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staza`
--
ALTER TABLE `staza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vozac`
--
ALTER TABLE `vozac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `vozac`
--
ALTER TABLE `vozac`
  ADD CONSTRAINT `vozac_ibfk_1` FOREIGN KEY (`id_b`) REFERENCES `bolid` (`id_bolida`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
