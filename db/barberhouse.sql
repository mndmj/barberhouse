-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Mar 2023 pada 19.43
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
-- Struktur dari tabel `tbl_antrian`
--

CREATE TABLE `tbl_antrian` (
  `id_antrian` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_bb` int(11) NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `status_antrian` enum('Menunggu','Diproses','Selesai') NOT NULL,
  `tgl_antrian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_antrian`
--

INSERT INTO `tbl_antrian` (`id_antrian`, `id_user`, `id_bb`, `no_antrian`, `status_antrian`, `tgl_antrian`) VALUES
(1, NULL, 4, 1, 'Diproses', '2023-03-12 12:41:36'),
(2, NULL, 4, 1, 'Menunggu', '2023-03-13 12:49:37'),
(3, NULL, 4, 2, 'Menunggu', '2023-03-13 12:49:40'),
(4, NULL, 4, 2, 'Menunggu', '2023-03-12 12:51:45'),
(5, NULL, 4, 1, 'Diproses', '2023-03-16 09:46:51'),
(6, NULL, 4, 1, 'Menunggu', '2023-03-17 12:29:50'),
(7, NULL, 4, 1, 'Diproses', '2023-03-20 23:49:46'),
(8, NULL, 4, 1, 'Diproses', '2023-03-21 00:02:49'),
(9, NULL, 4, 2, 'Menunggu', '2023-03-21 00:02:50'),
(10, NULL, 5, 1, 'Diproses', '2023-03-22 13:02:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bb`
--

CREATE TABLE `tbl_bb` (
  `id_bb` int(11) NOT NULL,
  `nama_bb` varchar(50) NOT NULL,
  `telepon_bb` varchar(15) NOT NULL,
  `foto_bb` varchar(255) NOT NULL,
  `alamat_bb` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `ket_bb` varchar(255) NOT NULL,
  `id_detail_pemilik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bb`
--

INSERT INTO `tbl_bb` (`id_bb`, `nama_bb`, `telepon_bb`, `foto_bb`, `alamat_bb`, `latitude`, `longitude`, `jam_buka`, `jam_tutup`, `ket_bb`, `id_detail_pemilik`) VALUES
(4, 'hj', '90888', '1677311257_bcf7a52cd9f3d0c7856f.jpg', 'hjhjh', '-908', '-8989', '00:00:00', '00:00:00', 'hjhjhj', 1),
(5, 'Soetarmo Barbershop', '09786435768', '1679508096_43a3fb96d1e3b131af78.jpg', 'Sewurejo', '-7.0979679', '110.09690', '00:00:00', '00:00:00', 'Bagus Efisien', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_pelanggan`
--

CREATE TABLE `tbl_detail_pelanggan` (
  `id_detail_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_pemilik`
--

CREATE TABLE `tbl_detail_pemilik` (
  `id_detail_pemilik` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_pemilik`
--

INSERT INTO `tbl_detail_pemilik` (`id_detail_pemilik`, `nama_lengkap`, `telepon`, `jk`, `alamat`, `foto`, `id_user`) VALUES
(1, 'hj', '986797654457', 'Laki-laki', 'hjhj', '1677311057_0daa677a48936e3f21e0.png', 2),
(2, 'Agus Soetarmo', '098876975674', 'Laki-laki', 'Gambarwi, Sewurejo, Mojogedang', '1679507268_9e4e7145a144dd8ff442.jpg', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_transaksi`
--

CREATE TABLE `tbl_detail_transaksi` (
  `id_dt` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah_dt` int(11) DEFAULT NULL,
  `harga_dt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_transaksi`
--

INSERT INTO `tbl_detail_transaksi` (`id_dt`, `id_transaksi`, `id_menu`, `jumlah_dt`, `harga_dt`) VALUES
(2, 1, 2, 2, '25000'),
(3, 7, 1, 4, '15000'),
(4, 7, 3, 4, '25000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_user`
--

CREATE TABLE `tbl_detail_user` (
  `id_detail_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat_user` varchar(255) DEFAULT NULL,
  `jk` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `id_bb` int(11) NOT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `jenis_menu` enum('Haircut','Haircare') DEFAULT NULL,
  `harga_menu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `id_bb`, `nama_menu`, `jenis_menu`, `harga_menu`) VALUES
(1, 4, 'Cepmek', 'Haircut', '15000'),
(2, 4, 'Haircut Dewasa', 'Haircut', '25000'),
(3, 4, 'Mohawk', 'Haircut', '25000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_role`
--

INSERT INTO `tbl_role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_antrian` int(11) DEFAULT NULL,
  `id_bb` int(11) NOT NULL,
  `tanggal_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_antrian`, `id_bb`, `tanggal_transaksi`) VALUES
(1, NULL, 4, 0),
(2, NULL, 4, 0),
(3, NULL, 4, 0),
(4, NULL, 4, 0),
(5, NULL, 4, 0),
(6, NULL, 4, 0),
(7, 8, 4, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(6) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `email`, `token`, `status`, `id_role`) VALUES
(2, 'hg', 'hjhjhjhj', 'hg@g.g', 'wmykje', '0', 1),
(3, 'aji', '12345678', 'aj@g.c', 'zrYAQm', '0', 1),
(4, 'Babayo', '`12345678', 'b@g.v', 'V3k0bx', '0', 1),
(5, 'Agus', '12345678', 'agus@gmail.com', '6KAn1Z', '0', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `tbl_antrian_ibfk_1` (`id_bb`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_bb`
--
ALTER TABLE `tbl_bb`
  ADD PRIMARY KEY (`id_bb`),
  ADD KEY `id_detail_pemilik` (`id_detail_pemilik`);

--
-- Indeks untuk tabel `tbl_detail_pelanggan`
--
ALTER TABLE `tbl_detail_pelanggan`
  ADD PRIMARY KEY (`id_detail_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_detail_pemilik`
--
ALTER TABLE `tbl_detail_pemilik`
  ADD PRIMARY KEY (`id_detail_pemilik`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD PRIMARY KEY (`id_dt`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_detail_user`
--
ALTER TABLE `tbl_detail_user`
  ADD PRIMARY KEY (`id_detail_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_bb` (`id_bb`);

--
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `tbl_transaksi_ibfk_1` (`id_antrian`),
  ADD KEY `id_bb` (`id_bb`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_bb`
--
ALTER TABLE `tbl_bb`
  MODIFY `id_bb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_pelanggan`
--
ALTER TABLE `tbl_detail_pelanggan`
  MODIFY `id_detail_pelanggan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_pemilik`
--
ALTER TABLE `tbl_detail_pemilik`
  MODIFY `id_detail_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  MODIFY `id_dt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_user`
--
ALTER TABLE `tbl_detail_user`
  MODIFY `id_detail_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  ADD CONSTRAINT `tbl_antrian_ibfk_1` FOREIGN KEY (`id_bb`) REFERENCES `tbl_bb` (`id_bb`),
  ADD CONSTRAINT `tbl_antrian_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_bb`
--
ALTER TABLE `tbl_bb`
  ADD CONSTRAINT `tbl_bb_ibfk_1` FOREIGN KEY (`id_detail_pemilik`) REFERENCES `tbl_detail_pemilik` (`id_detail_pemilik`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_pelanggan`
--
ALTER TABLE `tbl_detail_pelanggan`
  ADD CONSTRAINT `tbl_detail_pelanggan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_pemilik`
--
ALTER TABLE `tbl_detail_pemilik`
  ADD CONSTRAINT `tbl_detail_pemilik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD CONSTRAINT `tbl_detail_transaksi_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menu` (`id_menu`),
  ADD CONSTRAINT `tbl_detail_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_user`
--
ALTER TABLE `tbl_detail_user`
  ADD CONSTRAINT `tbl_detail_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD CONSTRAINT `tbl_menu_ibfk_1` FOREIGN KEY (`id_bb`) REFERENCES `tbl_bb` (`id_bb`);

--
-- Ketidakleluasaan untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_ibfk_1` FOREIGN KEY (`id_antrian`) REFERENCES `tbl_antrian` (`id_antrian`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_2` FOREIGN KEY (`id_bb`) REFERENCES `tbl_bb` (`id_bb`);

--
-- Ketidakleluasaan untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `tbl_role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
