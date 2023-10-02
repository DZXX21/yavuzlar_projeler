-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2023 at 12:08 AM
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
-- Database: `e_sistem`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullancilar`
--

CREATE TABLE `kullancilar` (
  `id` int(11) NOT NULL,
  `isim` varchar(50) DEFAULT NULL,
  `soyisim` varchar(50) DEFAULT NULL,
  `tc` varchar(11) DEFAULT NULL,
  `eposta` varchar(100) DEFAULT NULL,
  `ogretmen` varchar(50) DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kullancilar`
--

INSERT INTO `kullancilar` (`id`, `isim`, `soyisim`, `tc`, `eposta`, `ogretmen`, `sifre`) VALUES
(9, 'taha', 'ozen', '49513074474', 'tahaoze23@gmail.com', 'Öğretmen', '$2y$10$f3ddCw7gbVghZLgCkjvC0.vwNwMIoPG69caI.N3HNx0WKrNRNkW/e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kullancilar`
--
ALTER TABLE `kullancilar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kullancilar`
--
ALTER TABLE `kullancilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
