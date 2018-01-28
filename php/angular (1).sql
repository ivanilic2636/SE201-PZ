-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2017 at 07:20 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

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
-- Table structure for table `band`
--

CREATE TABLE `band` (
  `band_id` int(11) NOT NULL,
  `band_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `band`
--

INSERT INTO `band` (`band_id`, `band_name`) VALUES
(1, 'AC/DC'),
(2, 'Biggie Smalls'),
(3, 'Solomun'),
(4, 'The Weekend'),
(5, 'Ice Cube'),
(6, 'Dino Dvornik'),
(7, 'Mint Royale'),
(8, 'Gramatik');

-- --------------------------------------------------------

--
-- Table structure for table `genere`
--

CREATE TABLE `genere` (
  `genere_id` int(11) NOT NULL,
  `genere_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genere`
--

INSERT INTO `genere` (`genere_id`, `genere_name`) VALUES
(1, 'Rock'),
(2, 'Rap'),
(3, 'Techno'),
(4, 'Pop'),
(5, 'Old school'),
(6, 'Electro swing ');

-- --------------------------------------------------------

--
-- Table structure for table `my_music`
--

CREATE TABLE `my_music` (
  `my_music_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_music`
--

INSERT INTO `my_music` (`my_music_id`, `user_id`, `song_id`) VALUES
(9, 2, 8),
(11, 1, 9),
(12, 1, 6),
(13, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `song_id` int(11) NOT NULL,
  `song_name` varchar(50) DEFAULT NULL,
  `song_runtime` varchar(50) DEFAULT NULL,
  `song_link` varchar(300) DEFAULT NULL,
  `id_b` int(30) DEFAULT NULL,
  `id_g` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `song_name`, `song_runtime`, `song_link`, `id_b`, `id_g`) VALUES
(6, 'Nadahnuce', '4:03', 'https://www.youtube.com/watch?v=gf2SU2BEVzE', 6, 4),
(7, 'Back in black', '4:12', 'https://www.youtube.com/watch?v=KjJe1rBdm9U', 1, 1),
(8, 'Gangsta rap made me do it', '5:25', 'https://www.youtube.com/watch?v=HzeZhCt5PVA', 5, 2),
(9, 'Hit that jive', '3:24', 'https://www.youtube.com/watch?v=_m2zGncgLjw', 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(50) DEFAULT NULL,
  `user_lastname` varchar(50) DEFAULT NULL,
  `user_username` varchar(50) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_firstname`, `user_lastname`, `user_username`, `user_password`, `token`) VALUES
(1, 'Ivan', 'Ilic', 'Ivan', '202cb962ac59075b964b07152d234b70', 'ccb5fffbead796e46eb3310913a3f01cbb077811'),
(2, 'Zoran', 'Jazic', 'Zoki', '202cb962ac59075b964b07152d234b70', '4c7f521ea9e93a3715e5853a9c8648a3054872d5'),
(3, 'Aksel', 'Vicel', 'Aksel', '202cb962ac59075b964b07152d234b70', 'd797bb639cf1e3f231254f9cfee086b4ea926992');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `band`
--
ALTER TABLE `band`
  ADD PRIMARY KEY (`band_id`);

--
-- Indexes for table `genere`
--
ALTER TABLE `genere`
  ADD PRIMARY KEY (`genere_id`);

--
-- Indexes for table `my_music`
--
ALTER TABLE `my_music`
  ADD PRIMARY KEY (`my_music_id`),
  ADD KEY `FK_Relationship_1` (`song_id`),
  ADD KEY `FK_Relationship_2` (`user_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `id_b` (`id_b`),
  ADD KEY `id_g` (`id_g`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `band`
--
ALTER TABLE `band`
  MODIFY `band_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `genere`
--
ALTER TABLE `genere`
  MODIFY `genere_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `my_music`
--
ALTER TABLE `my_music`
  MODIFY `my_music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `my_music`
--
ALTER TABLE `my_music`
  ADD CONSTRAINT `FK_Relationship_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`),
  ADD CONSTRAINT `FK_Relationship_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`id_g`) REFERENCES `genere` (`genere_id`),
  ADD CONSTRAINT `song_ibfk_2` FOREIGN KEY (`id_b`) REFERENCES `band` (`band_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
