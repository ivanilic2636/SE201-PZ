-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 05:25 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angular`
--

-- --------------------------------------------------------

--
-- Table structure for table `staza`
--

CREATE TABLE `staza` (
  `id` int(11) NOT NULL,
  `ime_staze` varchar(50) NOT NULL,
  `grad` varchar(50) NOT NULL,
  `drzava` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staza`
--

INSERT INTO `staza` (`id`, `ime_staze`, `grad`, `drzava`) VALUES
(1, 'asdasd', 'asdassd', 'asfdasda');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `token`) VALUES
(1, 'asd', 'asd', 'asd', '7815696ecbf1c96e6894b779456d330e', 'ca9454aa1206eed919bb7fb4b0688a4567064411'),
(2, 'akhk', 'asghkgd', 'gerasd', '4d2abf229da58ff661a4617c6e81fa8f', 'a32e5a8c76e5e6713c52d913873a5d7bffa61bdd'),
(3, 'Ivan', 'ILic ', 'nevera', '202cb962ac59075b964b07152d234b70', 'd721038e8dc1bb4dc18c2c9dc22d403e1a3d5091'),
(4, 'Zoki', 'Zoki', 'Zoki', '202cb962ac59075b964b07152d234b70', '7ac400d7fc557b1154634b79918d2f82100e4811');

-- --------------------------------------------------------

--
-- Table structure for table `vozac`
--

CREATE TABLE `vozac` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `bolid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vozac`
--

INSERT INTO `vozac` (`id`, `ime`, `prezime`, `bolid`) VALUES
(1, 'Max', 'Verstappen', 'Red Bull'),
(2, 'Mika ', 'Häkkinen', 'McLaren ');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staza`
--
ALTER TABLE `staza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vozac`
--
ALTER TABLE `vozac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
