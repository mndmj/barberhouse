-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jan 2023 pada 13.29
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barberhouse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bb`
--

CREATE TABLE `tbl_bb` (
  `id_bb` int(11) NOT NULL,
  `nama_bb` varchar(50) NOT NULL,
  `pemilik_bb` varchar(50) NOT NULL,
  `foto_bb` varchar(255) NOT NULL,
  `telepon_bb` varchar(15) NOT NULL,
  `alamat_bb` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `ket_bb` varchar(255) NOT NULL,
  `id_detail_pemilik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bb`
--

INSERT INTO `tbl_bb` (`id_bb`, `nama_bb`, `pemilik_bb`, `foto_bb`, `telepon_bb`, `alamat_bb`, `latitude`, `longitude`, `ket_bb`, `id_detail_pemilik`) VALUES
(1, 'Soetarmo Barbershop', 'Agus Dono', 'S', '0895620488000', 'Gambaruwi, Sewurejo', '-7.571944700611977', '111.02362637015008', 'Melayani Anda sepuas hati', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bb`
--
ALTER TABLE `tbl_bb`
  ADD PRIMARY KEY (`id_bb`),
  ADD KEY `id_detail_pemilik` (`id_detail_pemilik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_bb`
--
ALTER TABLE `tbl_bb`
  MODIFY `id_bb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_bb`
--
ALTER TABLE `tbl_bb`
  ADD CONSTRAINT `tbl_bb_ibfk_1` FOREIGN KEY (`id_detail_pemilik`) REFERENCES `tbl_detail_pemilik` (`id_detail_pemilik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
