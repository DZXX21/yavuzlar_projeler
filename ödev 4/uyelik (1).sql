-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 10:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uyelik`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` varchar(2000) NOT NULL,
  `kayit_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `email`, `parola`, `kayit_tarihi`) VALUES
(52, 'saaa', '', '$2y$10$2gykbrk8wTThftBDorLsfuXhqeBnJ4si8BfoztTL6Vcb.qmFvEyFK', '2023-09-25 13:40:51'),
(59, 'taha21', '', '$2y$10$Of7b2naAKNzoAiE4DRbbWOR3wd0F61O3DaAPOycTwxVliBgtTblhq', '2023-09-30 11:28:57'),
(60, 'namim', '', '$2y$10$YQuRyzq9IftNZ2dAizVKh.idsfVH2QOde.NySyNWufc/4OnWo1SWO', '2023-09-30 11:29:24'),
(61, 'hanim1', '', '$2y$10$4PQEBF4BtG1hgk/LMOeZM.h.5RT67WTNcye/BmKJQ.gd0meUQK.rq', '2023-09-30 11:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notlar`
--

INSERT INTO `notlar` (`id`, `kullanici_adi`, `baslik`, `icerik`, `tarih`) VALUES
(183, 'taha21', '', 'denem21', '2023-09-30 08:29:18'),
(184, 'hanim1', '', 'wwwwww', '2023-09-30 08:29:55'),
(185, 'hanim1', '', 'denem2123', '2023-09-30 08:29:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Indexes for table `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
