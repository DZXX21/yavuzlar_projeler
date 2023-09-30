-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 Eyl 2023, 00:49:47
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `uyelik`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` varchar(2000) NOT NULL,
  `kayit_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `email`, `parola`, `kayit_tarihi`) VALUES
(45, 'sa', '', '$2y$10$ZbMy2QGFi63XVpcEoV3yj.IU1yQr1UaqD5rWL/mGQnzvg65t9wjsm', '2023-09-22 17:53:25'),
(46, 'as', '', '$2y$10$HLh37DYKrza5YGWCoTKq2u8Q16Q3tM9vPNmQtVXQE2k7AKo/RhDpW', '2023-09-22 18:09:00'),
(47, 'ass', '', '$2y$10$ovWm6fYirNNKHRxIr7ipse/2HM7GSYT7dnTRdoiZ7GrYe1eSWP6ja', '2023-09-23 23:24:21'),
(48, 'asss', '', '$2y$10$gy3St2rGR7ZVwRjMXH8esuYn/TJi.mBHT8Pj8nhQV5I4z9Ft5OJH2', '2023-09-23 23:31:49'),
(49, 'admin', '', '$2y$10$AOpYqNQ4/jXcJ4o/PqpUc.GIQI0./y06qTFMU/Wifi8oqMZzbR4h.', '2023-09-24 21:54:21'),
(50, 'veli', '', '$2y$10$/YEXPCopDE000aix8MweMutgdVpf1FE1PRqTNTkX92vvd/nIa6KvK', '2023-09-24 23:35:44'),
(51, 'ye', '', '$2y$10$vkZUXwV51PPrj0.uy7UB/.55TPdGAMLgBsYF6lXhc.Pmuvn1.DHlS', '2023-09-25 00:09:06'),
(52, 'saaa', '', '$2y$10$2gykbrk8wTThftBDorLsfuXhqeBnJ4si8BfoztTL6Vcb.qmFvEyFK', '2023-09-25 13:40:51'),
(53, 'mm', '', '$2y$10$b9GcRKOVxGINkCgALvee/uESC41fR8KCO8irWyBvgo7hbcp9EJwPu', '2023-09-25 13:42:25'),
(54, 'ay', '', '$2y$10$NXOEUSTMKLyt8On7luaQJuqOCsKihLwAnxaa7dHnhFKAMfp36PcvO', '2023-09-26 00:49:24'),
(55, 'yeni', '', '$2y$10$Oie4PoidREsMhYgXLsdOG.F3ZKEPqV5Iig9gwKDmhn2/Uo7IHSAb2', '2023-09-26 01:37:14'),
(56, 'lol', '', '$2y$10$weHsMjRX1BMG2a2Zrib1wevCuhKFMweUW27frR4sYXKTHBVVbuzle', '2023-09-26 01:43:47'),
(57, 'cs', '', '$2y$10$Gxn/e5g9uneINZ0yuOzHGO/LD.QXkHZpRI1.UQgJZNLWPn9qsNlby', '2023-09-26 01:46:09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `notlar`
--

INSERT INTO `notlar` (`id`, `kullanici_adi`, `baslik`, `icerik`, `tarih`) VALUES
(111, 'ali', '', 'eve git', '2023-09-24 20:27:34'),
(114, 'veli', '', 'adsadas', '2023-09-24 20:36:06'),
(115, 'veli', '', 'veliiiiiiii', '2023-09-24 20:36:11'),
(121, 'mm', '', 'dsfdsf', '2023-09-25 10:44:31'),
(122, 'mm', '', 'dsfdsfds', '2023-09-25 10:44:34'),
(123, 'mm', '', 'sdfdsf', '2023-09-25 10:44:35'),
(149, 'admin', '', 'sa', '2023-09-25 21:34:00'),
(150, 'admin', '', 'dfasdfdsafdsfsdfdsfdaf', '2023-09-25 21:34:02'),
(151, 'admin', '', 'dfasdfdsafdsfsdfdsfdaf', '2023-09-25 21:34:10'),
(152, 'admin', '', 'dsffsfda', '2023-09-25 21:44:03'),
(154, 'ay', '', 'sa', '2023-09-25 22:10:50'),
(155, 'ay', '', 'meraba', '2023-09-25 22:10:59'),
(156, 'ay', '', 'assss', '2023-09-25 22:12:35'),
(157, 'ay', '', 'as', '2023-09-25 22:12:38'),
(158, 'ay', '', 'as', '2023-09-25 22:13:00'),
(159, 'ay', '', 'as', '2023-09-25 22:17:25'),
(160, 'ay', '', 'as', '2023-09-25 22:20:10'),
(161, 'yeni', '', 'bittttiiii', '2023-09-25 22:37:42'),
(162, 'yeni', '', 'asda', '2023-09-25 22:37:48'),
(163, 'yeni', '', 'gdfgddfgdfgdhdshfghfgh', '2023-09-25 22:38:06'),
(167, 'lol', '', 'dsfsdfdsfd', '2023-09-25 22:44:07'),
(168, 'lol', '', 'sdsfsa', '2023-09-25 22:44:11'),
(169, 'lol', '', 'ds', '2023-09-25 22:44:13'),
(170, 'lol', '', 'sa', '2023-09-25 22:44:16'),
(171, 'lol', '', 'sa', '2023-09-25 22:44:27'),
(172, 'lol', '', 'sa', '2023-09-25 22:44:35'),
(173, 'lol', '', 'ss', '2023-09-25 22:44:45'),
(174, 'lol', '', 'sdgdgdfsgdf', '2023-09-25 22:44:49'),
(175, 'lol', '', 'xczxcxzxcxczczx', '2023-09-25 22:45:38'),
(176, 'lol', '', 'sdgdgdfsgdf', '2023-09-25 22:45:46'),
(178, 'cs', '', 'adas', '2023-09-25 22:46:24'),
(179, 'cs', '', 'sdfsdf', '2023-09-25 22:47:43');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
