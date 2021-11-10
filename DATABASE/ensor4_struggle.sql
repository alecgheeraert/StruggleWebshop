-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2020 at 11:49 PM
-- Server version: 10.3.13-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ensor4_struggle`
--
CREATE DATABASE IF NOT EXISTS `ensor4_struggle` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ensor4_struggle`;

-- --------------------------------------------------------

--
-- Table structure for table `bestelling`
--

CREATE TABLE `bestelling` (
  `bestelling_id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `datumVanBestelling` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bestelling`
--

INSERT INTO `bestelling` (`bestelling_id`, `klant_id`, `datumVanBestelling`) VALUES
(32, 32, '2020-05-25 19:26:59'),
(33, 37, '2020-05-25 22:53:41'),
(34, 23, '2020-05-25 22:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `categorie_id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `type`) VALUES
(1, 'Hoodies'),
(2, 'Shirts');

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE `klant` (
  `klant_id` int(11) NOT NULL,
  `voornaam` varchar(32) NOT NULL,
  `achternaam` varchar(64) NOT NULL,
  `adres` varchar(64) NOT NULL,
  `stad` varchar(32) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `land` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `vkey` varchar(45) NOT NULL,
  `geverifieerd` tinyint(1) DEFAULT NULL,
  `tijd_registratie` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`klant_id`, `voornaam`, `achternaam`, `adres`, `stad`, `postcode`, `land`, `email`, `wachtwoord`, `admin`, `vkey`, `geverifieerd`, `tijd_registratie`) VALUES
(23, 'alec', 'gheeraert', 'gerststraat 21', 'oostende', '8400', 'belgium', 'alec.gheeraert@gmail.com', '$2y$10$Xhfqh4dgEFwcPKdGap9xR.pVp2qvVr.p8I15cNe8b2TCf6SYO4MQm', 1, '7b3f56834254b03fc0e1cafe1835cc73', 1, '2020-04-15 20:04:43'),
(26, 'ares', 'popal', 'stenenstraat 32-2', 'oostende', '8400', 'belgium', 'ares.popal@hotmail.com', '$2y$10$wzlLtEpBUVgzcKTnjxne.OAM7jjYxo4g.zBMWIDR0fAYQnallUXJi', 1, 'a527f5990e19cd88af6cc5dc4c3ed2ff', 1, '2020-04-30 13:42:02'),
(28, 'lenn', 'crochart', 'poggers', 'oostende', '8400', 'belgiÃ«', 'lenn.crochart@gmail.com', '$2y$10$G4EEtvaHOzgkuHCpvonfsetyYl0JT17kzceGWi5P0L.3MAcTxBcfW', NULL, '37ab7e7b7afbe276619b8b30775eb14e', 1, '2020-04-30 13:53:12'),
(30, 'wim', 'donnay', 'bla', 'bla', 'bla', 'saint-barthÃ©lemy', 'wim.donnay@ensorinstituut.be', '$2y$10$y.E1kyJQwFAS4krviv7oV.gQ1Hy9AjGN9/vLzKcMEPHE84cgD2ucG', 1, '8295d8adda2a74972660e46498cc0c43', 1, '2020-05-01 11:06:09'),
(32, 'alec', 'gheeraert', 'gerststraat 21', 'oostende', '8400', 'belgiÃ«', 'gheeraert.alec@gmail.com', '$2y$10$5kondWgWtS3sVYuFQgy0aOqY5yMnIIitN2YO9CaxcgSF2WosWRZIG', NULL, 'c7f3a2cada0e3b924efcec8ea0d4b47a', 1, '2020-05-02 15:32:10'),
(33, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin@admin.be', '$2y$10$etnP3ANSKyGN93j2uh0MRO00aVX9RvZpglu6DP1GO7/GosF3mfdJe', 1, '7d972d7f2cc33955f29334e8b67b7e84', NULL, '2020-05-15 10:33:38'),
(34, 'lars', 'ostyn', 'sint-jansstraat 2', 'oostende', '8400', 'belgiÃ«', 'larsostyn79@gmail.com', '$2y$10$JLMSrpwm2YJaP78d07lbpu6NIDHdgZ5gRxvIr3/bIRJYM1ky9gJEC', 1, '3377267d439f7e51feb248fa9cf440bd', NULL, '2020-05-25 14:50:13'),
(37, 'alex', 'perneel', 'straat 8', 'roeselare', '8800', 'belgiÃ«', 'alexander.perneel@ensorinstituut.be', '$2y$10$wtwk71qMl0OQz68ypYqNPu8UbAt9Rq6kEZFhGvw1zWbx5rChiSxxi', NULL, '42f82e355e7eea2e09be162e5b2588f7', NULL, '2020-05-25 20:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `productnaam` varchar(64) NOT NULL,
  `prijs` decimal(11,2) NOT NULL,
  `kleur` varchar(32) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `fotoAchter` varchar(50) NOT NULL,
  `voorraad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `categorie_id`, `productnaam`, `prijs`, `kleur`, `foto`, `fotoAchter`, `voorraad`) VALUES
(1, 1, 'Rosa', '30.00', 'white', 'StruggleHoodieWhiteFront.jpg', 'StruggleHoodieWhiteBack.jpg', 100),
(2, 2, 'Luce', '20.00', 'black', 'StruggleShirtBlackFold.jpg', '', 50),
(3, 2, 'Luce', '20.00', 'pink', 'StruggleShirtPinkFold.jpg', '', 20),
(4, 1, 'Mente', '30.00', 'black', 'StruggleHoodieBlackFront.jpg', 'StruggleHoodieBlackBack.jpg', 70),
(5, 1, 'Mente', '30.00', 'bordeaux', 'StruggleHoodieRedFront.jpg', 'StruggleHoodieRedBack.jpg', 45),
(6, 1, 'Mente', '30.00', 'blue', 'StruggleHoodieBlueFront.jpg', 'StruggleHoodieBlueBack.jpg', 70),
(7, 1, 'Rosa', '30.00', 'yellow', 'StruggleHoodieYellowFront.jpg', 'StruggleHoodieYellowBack.jpg', 83);

-- --------------------------------------------------------

--
-- Table structure for table `productperbestelling`
--

CREATE TABLE `productperbestelling` (
  `bestelling_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `aantalProducten` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productperbestelling`
--

INSERT INTO `productperbestelling` (`bestelling_id`, `product_id`, `aantalProducten`) VALUES
(32, 5, 1),
(32, 4, 1),
(32, 5, 3),
(33, 1, 1),
(34, 5, 1),
(34, 6, 1),
(34, 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`bestelling_id`),
  ADD KEY `klant_id` (`klant_id`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Indexes for table `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klant_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `bestelling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `klant`
--
ALTER TABLE `klant`
  MODIFY `klant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `klant` FOREIGN KEY (`klant_id`) REFERENCES `klant` (`klant_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
