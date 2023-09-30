-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 02:18 AM
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
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `sifre`) VALUES
(1, 'taha', '$2y$10$PjcQ6vZFk76VFBzK0QFaeuz8pBG1IQ4CN7sZjuUd7R.F9DhFpjioe'),
(2, 'taha21', '$2y$10$lf9SrQ360PL3cJbs/9H5Bu2/ck9GSwV4oCUQVRYzl4c1mBbTD0tQ2'),
(3, 'taha212212', '$2y$10$8T6tJpRABwiAkxh6nvzQhOMnl0z6G15Z2Gj9Q/CI1v6nUdo6n2S9a'),
(4, 'ss', '$2y$10$4jCIBPr2gSzRJ8UqcfHm5OdgXX.AcyUOiNrfnvDnB2KgFZ2UT8SjK'),
(5, 'ssss', '$2y$10$I1h5VJRl4Zo42H2x5ShKwOSDNxwKQXCRYGdOthOKF92tFTYWWDHE.'),
(6, 'admin21', '$2y$10$EIcRIN1bVt4pnvdekc7b.OvT9MqX.FOL6.GkgSZOLSkpbn5a.Ja4q'),
(7, 'hanim', '$2y$10$JU4G.0/oU1wlgqPIkgGRH.J33wdtU1KuImuiPs.tb8fuZ5D/pIWU.'),
(8, 'senisevmek', '$2y$10$MPS69cbFlukwY.E4rKVev.DrA..5SvkEfPuMgDKAyA8I91ylRYb4q'),
(9, 'qqwqw', '$2y$10$9sTZxHfUXeaNfARiaDnzm..PQU6.ajI/vzj90wtgizBF3NmLDHCDK'),
(10, 's', '$2y$10$sItjy3HuSYiyayqep2.w4eRbdJDC0unqvy5EnVvFoXgipI7RpEYW.'),
(11, 'hanim3', '$2y$10$k23anH4Ja1m0PHxtut1.g.77fAtAIvhb7cmhg4sDNrb/vJjJ/0Aky'),
(12, 'sswww', '$2y$10$TYIME7MiOg6va3k0YhtFveLAbzdHPDMA7SNEdUoeaZqVMZtU99c5G'),
(13, '12131', '$2y$10$ugOAC5fChE.rt0gJaRn.P.D/k.Z3kg2ZFLc.e6noDNUYsaspWXFcK'),
(14, 'denemson', '$2y$10$mlB530rGV7MsSzdby2ZpYOyPEtiFNcp3x6MOjir896k5ZhZAKKX06'),
(15, 'ww', '$2y$10$ncFOXGczZ591uk45l6pOeO2f.lXsGDyv6GQb5hy9PwvIOtuZF1VwW'),
(16, 'wwwwwwwwwwwwwwwwwwwwwww', '$2y$10$KxP1fWLsjIAUdrOPG4r3JOkCevV2UaLZgakAjyrJWG6BwvQ9pdPIW'),
(17, 'sondeneme', '$2y$10$PmqPKTG3Q7TASWcXbnq/nOjfRb/FYyNQiLu4vDIoN5UUyhS671vL6');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `is_completed`, `created_at`) VALUES
(51, 'hanims <3 tahass', 0, '2023-09-26 01:55:40'),
(52, 'taha 32 taha  sq', 0, '2023-09-26 01:55:52'),
(53, 'www', 0, '2023-09-29 23:45:28');

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
