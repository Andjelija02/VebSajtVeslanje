-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 06:02 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veslanje`
--

-- --------------------------------------------------------

--
-- Table structure for table `klubovi`
--

CREATE TABLE `klubovi` (
  `id_kluba` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL,
  `grad` varchar(20) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `veb_sajt` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klubovi`
--

INSERT INTO `klubovi` (`id_kluba`, `naziv`, `grad`, `adresa`, `veb_sajt`) VALUES
(1, 'Galeb', 'Beograd', 'Kej Oslobođenja 73', NULL),
(2, 'Partizan', 'Beograd', 'Ada Ciganlija 1', 'http://www.vkp.rs/'),
(3, 'Danubius 1885', 'Novi Sad', 'Sunčani kej', 'http://www.danubius1885.org/');

-- --------------------------------------------------------

--
-- Table structure for table `reprezentativci`
--

CREATE TABLE `reprezentativci` (
  `id_veslaca` int(11) NOT NULL,
  `godina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reprezentativci`
--

INSERT INTO `reprezentativci` (`id_veslaca`, `godina`) VALUES
(101, 2020),
(101, 2021),
(102, 2021),
(104, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `veslaci`
--

CREATE TABLE `veslaci` (
  `id_veslaca` int(11) NOT NULL,
  `ime_i_prezime` varchar(25) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `id_kluba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `veslaci`
--

INSERT INTO `veslaci` (`id_veslaca`, `ime_i_prezime`, `datum_rodjenja`, `id_kluba`) VALUES
(101, 'Andja Simic', '2002-08-23', 1),
(102, 'Jana Bugarski', '2006-05-03', 2),
(103, 'Filip Peric', '2008-04-14', 3),
(104, 'Ugljesa Isakovic', '2006-06-08', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klubovi`
--
ALTER TABLE `klubovi`
  ADD PRIMARY KEY (`id_kluba`);

--
-- Indexes for table `reprezentativci`
--
ALTER TABLE `reprezentativci`
  ADD PRIMARY KEY (`id_veslaca`,`godina`);

--
-- Indexes for table `veslaci`
--
ALTER TABLE `veslaci`
  ADD PRIMARY KEY (`id_veslaca`),
  ADD KEY `id_kluba` (`id_kluba`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reprezentativci`
--
ALTER TABLE `reprezentativci`
  ADD CONSTRAINT `id_veslaca` FOREIGN KEY (`id_veslaca`) REFERENCES `veslaci` (`id_veslaca`);

--
-- Constraints for table `veslaci`
--
ALTER TABLE `veslaci`
  ADD CONSTRAINT `veslaci_ibfk_1` FOREIGN KEY (`id_kluba`) REFERENCES `klubovi` (`id_kluba`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
