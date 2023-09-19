-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Eyl 2023, 10:58:59
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
-- Veritabanı: `ecrt`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `ogrenci_no` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `bolum` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `deneyim` text NOT NULL,
  `ilgi` text NOT NULL,
  `ilgi_alanlari` text NOT NULL,
  `kulup_deneyim` text NOT NULL,
  `haftalik_calisma_saatleri` varchar(255) NOT NULL,
  `isbirligi_deneyim` text NOT NULL,
  `programlama_dilleri` text NOT NULL,
  `ozgecmis` text NOT NULL,
  `bilgi_paylasimi` text NOT NULL,
  `kendini_gelistirme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `ad`, `soyad`, `ogrenci_no`, `telefon`, `bolum`, `email`, `deneyim`, `ilgi`, `ilgi_alanlari`, `kulup_deneyim`, `haftalik_calisma_saatleri`, `isbirligi_deneyim`, `programlama_dilleri`, `ozgecmis`, `bilgi_paylasimi`, `kendini_gelistirme`) VALUES
(1, 'qwqwqw', 'qwqw', 'qwqwqwqw', '2qweqweqw', 'qweqw', 'taha@qweqw.com', 'qweqw', 'qweqwew', 'qweqwe', 'qweqwe', 'qweqweqw', 'qweqweqw', 'qweqweqw', 'qweqweqw', 'qweqweqw', '211'),
(2, 'taha ', 'ozen ', '21000000010', '5314950098', 'bilgi guvenligi ', 'tahaoze23@gmail.comm', 'qwqw', 'qqq', 'qqq', 'qq', 'qq', 'qq', 'qqq', 'qqqq', 'qqq', 'qqq');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'taha', '12345'),
(2, 'admin', '$2y$10$jgOBy7oox2PhhqsvS3Lrxu.rk4hwOXpwv63NeUBB.SbGuydWaZqSC');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `secilen_kullanicilar`
--

CREATE TABLE `secilen_kullanicilar` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `secilen_kullanicilar`
--
ALTER TABLE `secilen_kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `secilen_kullanicilar`
--
ALTER TABLE `secilen_kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
