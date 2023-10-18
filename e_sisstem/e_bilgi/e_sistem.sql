-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Eki 2023, 01:32:46
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `e_sistem`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '12345'),
(2, 'admin', '$2y$10$KEmijpfDk3F9ZCh15jZYYOA3axKp7/JeD/dXwAuiETulvQhAlLXi2'),
(3, 'admin21', '$2y$10$WAaNeiWd5.4Q/hcB0Wh0YuW08xH4UdeODtIY6Gm4Xj8j6JZP1ShR.'),
(4, 'sss', '$2y$10$PshfwyW.qGmUGkEe7o6qsOSl0JBPX2RtxC7Z4KlXcjOvgNcaxpYcm');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `isim` varchar(50) NOT NULL,
  `soyisim` varchar(50) NOT NULL,
  `numara` varchar(20) NOT NULL,
  `sinif` varchar(50) NOT NULL,
  `tc_kimlik` varchar(20) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `student_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `students`
--

INSERT INTO `students` (`id`, `isim`, `soyisim`, `numara`, `sinif`, `tc_kimlik`, `student_username`, `student_password`) VALUES
(2, 'taha', 'ozen', '2100002121', '7/a', '111111111', '', ''),
(3, 'hanim', 'ünsal', '1234', '8/a', '1223', '', ''),
(4, 'taha2121', 'ozen', '2121', '7/b', '2112312321', 'taha21', '12345'),
(5, 'abbas', 'yanbasa', '2121', '2121', '12212', 'taha812', '$2y$10$jgqvIfyaGzxTp7UmKpzKkeFTTowJJPiLpQ6kMoGkUd6OZKkOHy.EG');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `teacher_username` varchar(255) NOT NULL,
  `teacher_password` varchar(255) NOT NULL,
  `teacher_class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `password`, `class`, `teacher_username`, `teacher_password`, `teacher_class`) VALUES
(1, 'taha21', '1234', '7/a', '', '', ''),
(2, 'taha', '12345', '7/a', '', '', ''),
(3, 'hanim', '$2y$10$eYHuqaDiurF1tKHop55.JulgoNddN5a3Gw/dARTzuyqVD/RiMFgqG', '', '', '', ''),
(4, '', '', '', 'taha', '$2y$10$goMj1.oBntHxIANWIPDnc.w2a8TmT1YVSxQMEBhOdbhCtGRdsaVIi', '7/b'),
(5, 'taha', '', '', 'taha', '$2y$10$GFSbSVPFRt1G4DRaq2GXjOrNzH/p9FWQYA2SG0awEOV/E3g18tzC6', '7/a');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
