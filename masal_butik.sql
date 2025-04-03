-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Nis 2025, 02:03:04
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `masal_butik`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_ad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_ad`) VALUES
(1, 'Kız Bebek'),
(2, 'Erkek Bebek'),
(3, 'Kız Çocuk'),
(4, 'Erkek Çocuk'),
(5, 'Fırsat Ürünleri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `k_id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `urun_kodu` varchar(255) NOT NULL,
  `urun_baslik` varchar(255) NOT NULL,
  `urun_fiyati` decimal(10,0) NOT NULL,
  `urun_eski_fiyat` decimal(10,0) DEFAULT NULL,
  `ana_resim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`urun_kodu`, `urun_baslik`, `urun_fiyati`, `urun_eski_fiyat`, `ana_resim`) VALUES
('12938456', 'Yeşil Pantolon', 265, 300, 'img/e4.jpeg'),
('23874210', 'Yılbaşı Takımı', 350, 400, 'img/e7.jpeg'),
('2896784', 'Jogger Pantolon', 200, 270, 'img/urunler/e3.jpeg'),
('289684', 'Takım Elbise', 199, 269, 'img/e4.jpeg'),
('34892156', 'Yeşil Pantolon', 220, 270, 'img/e5.jpeg'),
('49820573', 'Yılbaşı Takımı', 375, 400, 'img/e7.jpeg'),
('57283904', 'Beyaz Kaban', 310, NULL, 'img/e5.jpeg'),
('65748391', 'Beyaz Kaban', 280, NULL, 'img/e5.jpeg'),
('75928437', 'Eşofman Takımı', 330, NULL, 'img/e5.jpeg'),
('7816592', 'Beyaz Kaban', 260, 290, 'img/e5.jpeg'),
('78987952', 'Eşofman Takımı', 300, NULL, 'img/e4.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_kaydet`
--

CREATE TABLE `urun_kaydet` (
  `urun_kodu` varchar(255) NOT NULL,
  `kullanici_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`k_id`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`urun_kodu`);

--
-- Tablo için indeksler `urun_kaydet`
--
ALTER TABLE `urun_kaydet`
  ADD PRIMARY KEY (`urun_kodu`,`kullanici_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `urun_kaydet`
--
ALTER TABLE `urun_kaydet`
  ADD CONSTRAINT `urun_kaydet_ibfk_1` FOREIGN KEY (`urun_kodu`) REFERENCES `urun` (`urun_kodu`),
  ADD CONSTRAINT `urun_kaydet_ibfk_2` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici` (`k_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
