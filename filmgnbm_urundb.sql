-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 29 Mar 2022, 14:12:22
-- Sunucu sürümü: 10.3.34-MariaDB-cll-lve
-- PHP Sürümü: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `filmgnbm_urundb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `uisim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `uaciklama` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `ufiyat` int(11) NOT NULL,
  `ukategori` tinyint(4) NOT NULL,
  `ufoto` varchar(100) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'default.jpg',
  `urenk` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `ureklam` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `utarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `uisim`, `uaciklama`, `ufiyat`, `ukategori`, `ufoto`, `urenk`, `ureklam`, `utarih`) VALUES
(5, 'Şehzade Tatlısı', 'kuru üzümden yapılır', 10, 4, 'sehzade-tatlisi.jpg_39862217361ba4ce740d7e8.40029819.jpg', 'taksit', 'Tatlı', '2021-12-15 20:15:35'),
(17, 'Manisa Kebabı', 'Leziz', 20, 1, 'kebap.png_143132217561b7e342bedc08.01456529.png', 'pesin', 'Sos Tursu', '2021-12-14 00:20:18'),
(19, 'Manisa Kebabı', 'Yöresel pideli kebap', 30, 1, 'kebap.png_183934062661b8a9e9b931c2.84201567.png', 'pesin', 'Sos Tursu', '2021-12-14 14:27:53'),
(21, 'Sultan Çayı', 'Bol baharatlı tam bir şifa kaynağı', 10, 3, 'mesir-cayi.jpg_63513963361b8abf2f358c7.62336203.jpg', 'pesin', 'Tatlı', '2021-12-14 14:36:34'),
(23, 'Akhisar Köfte', 'Akhisar ilçesinin ustalarının eseri', 20, 1, 'kofte.jpg_89660513861b8adc69e8a90.48772590.jpg', 'pesin', 'Tursu', '2021-12-14 14:44:22'),
(24, 'Mesir Macunu', 'Mesir macunu, 41 çeşit baharat ve şifalı olduğuna inanılan ottan oluşan bir macun çeşidi.', 15, 4, 'mesir.jpg_211146352161b8af8ddd35e7.70150636.jpg', 'taksit', 'Sos Tatlı', '2021-12-14 14:51:57'),
(27, 'Sultani Üzüm', 'Sultaniye &quot;beyaz&quot;, oval çekirdeksiz üzüm çeşididir aynı zamanda sultanina, Thompson çekirdeksiz, Lady de Coverly ve oval meyveli Kishmish olarak adlandırılır.', 10, 4, 'uzum.jpg_22121210361ba4da1224089.94056288.jpg', 'taksit', 'Tatlı', '2021-12-15 20:18:41'),
(37, 'Portakal', 'C vitamini', 50, 4, '1647190726388816629552889952521.jpg_304032355622e22eaa97929.82479819.jpg', 'pesin', 'Tatlı', '2022-03-13 16:59:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `AdiSoyadi` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `Sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `UyelikSozlesmesi` varchar(5) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `AdiSoyadi`, `Email`, `Sifre`, `UyelikSozlesmesi`) VALUES
(5, '', 'kader@gmail.com', '1848e732214cce460f9b24f0c80f5e72', '1'),
(6, '', 'admin@hazirodev.cf', '595f26ebd57fb11c7c8db8632f40e216', '1'),
(8, '', 'halicioglu@gmail.com', '1d72310edc006dadf2190caad5802983', '1'),
(9, '', 'dvadvad@gmail.com', '00a1f187721c63501356bf791e69382c', '1'),
(10, '', 'etertger@gfgddfgb', 'b0baee9d279d34fa1dfd71aadb908c3f', '1'),
(11, '', 'sikerler@gmail.com', '33f73278e397cc7bcee0b5d0c7f94bb8', '1'),
(12, '', 'mertpekkk@gmail.com', 'c8837b23ff8aaa8a2dde915473ce0991', '1'),
(13, '', 'sikerler2@hotmail.com', '9c32165b252bc57cdd0b6e55d4d514f7', '1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
