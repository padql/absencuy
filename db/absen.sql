-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2025 pada 10.48
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `kode_a` char(3) NOT NULL,
  `nis` char(8) DEFAULT NULL,
  `nip` char(18) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `ket` char(1) DEFAULT NULL,
  `infaq` int(5) DEFAULT NULL,
  `kelas` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`kode_a`, `nis`, `nip`, `tgl`, `ket`, `infaq`, `kelas`) VALUES
('A13', '22231023', '332122245679911991', '2025-01-22', '0', 2000, '3'),
('A17', '22231026', '222211157777784411', '2025-01-22', '0', 2000, '2'),
('A20', '22231022', '332122245679911991', '2025-01-22', '1', 0, '3'),
('A22', '22231008', '111255779111198111', '2025-01-22', '1', 0, '1'),
('A25', '22231018', '111255779111198111', '2025-01-22', '0', 2000, '1'),
('A27', '22231011', '222211157777784411', '2025-01-22', '3', 0, '2'),
('A32', '22231010', '222211157777784411', '2025-01-22', '0', 5000, '2'),
('A35', '22231116', '222211157777784411', '2025-01-22', '0', 2000, '2'),
('A36', '22231019', '111255779111198111', '2025-01-22', '0', 10000, '1'),
('A38', '22231505', '332122245679911991', '2025-01-22', '0', 2000, '3'),
('A39', '22231652', '332122245679911991', '2025-01-22', '0', 2000, '3'),
('A42', '22231017', '111255779111198111', '2025-01-22', '0', 10000, '1'),
('A43', '22231024', '222211157777784411', '2025-01-22', '0', 5000, '2'),
('A45', '22231028', '111255779111198111', '2025-01-22', '0', 5000, '1'),
('A46', '22231505', '332122245679911991', '2025-01-22', '0', 2000, '3'),
('A47', '22231003', '111255779111198111', '2025-01-22', '0', 2000, '1'),
('A49', '22231025', '111255779111198111', '2025-01-22', '0', 10000, '1'),
('A51', '22231996', '332122245679911991', '2025-01-22', '0', 10000, '3'),
('A53', '22231130', '111255779111198111', '2025-01-22', '0', 10000, '1'),
('A54', '22231015', '332122245679911991', '2025-01-22', '0', 5000, '3'),
('A56', '22231027', '111255779111198111', '2025-01-22', '0', 5000, '1'),
('A57', '22231012', '222211157777784411', '2025-01-22', '2', 0, '2'),
('A60', '22231029', '332122245679911991', '2025-01-22', '1', 0, '3'),
('A63', '22231013', '222211157777784411', '2025-01-22', '0', 10000, '2'),
('A65', '22231004', '111255779111198111', '2025-01-22', '0', 5000, '1'),
('A67', '22231021', '332122245679911991', '2025-01-22', '0', 5000, '3'),
('A70', '22231020', '332122245679911991', '2025-01-22', '0', 10000, '3'),
('A71', '22231030', '332122245679911991', '2025-01-22', '0', 5000, '3'),
('A75', '22231777', '332122245679911991', '2025-01-22', '0', 10000, '3'),
('A83', '22231001', '111255779111198111', '2025-01-28', '0', 2000, '1'),
('A90', '22231009', '111255779111198111', '2025-01-22', '0', 2000, '1'),
('A93', '22231005', '222211157777784411', '2025-01-22', '0', 2000, '2'),
('A97', '22231016', '111255779111198111', '2025-01-22', '0', 2000, '1'),
('A98', '22231014', '222211157777784411', '2025-01-22', '0', 5000, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` char(8) NOT NULL,
  `nama` varchar(11) DEFAULT NULL,
  `kelas` varchar(8) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `agama` char(8) DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL,
  `kota` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `kelas`, `jk`, `agama`, `no_hp`, `kota`) VALUES
('22231001', 'Joko', '1', '0', '4', '082356353123', 'Bogor'),
('22231003', 'Rian', '1', '0', '4', '089096733497', 'Jakarta'),
('22231004', 'Fikri', '1', '0', '6', '082790324411', 'Bekasi'),
('22231005', 'Ilon', '2', '0', '4', '086143425193', 'Jakarta'),
('22231006', 'Udin', '3', '0', '4', '087482272864', 'Bogor'),
('22231008', 'Dodo', '1', '0', '5', '085684368637', 'Surabaya'),
('22231009', 'Riski', '1', '0', '5', '081284883943', 'Indramayu'),
('22231010', 'Dea', '2', '1', '7', '081631648102', 'Majalengka'),
('22231011', 'Susanti', '2', '1', '7', '083614130596', 'Surabaya'),
('22231012', 'Tuti', '2', '1', '4', '084817197647', 'Cianjur'),
('22231013', 'Yuliana', '2', '1', '4', '083188342994', 'Surabaya'),
('22231014', 'Pudidi', '2', '0', '8', '084227500041', 'Cirebon'),
('22231015', 'Fadly', '3', '0', '5', '087926811272', 'Cirebon'),
('22231016', 'RIska', '1', '1', '4', '082854137038', 'Jakarta'),
('22231017', 'Siti', '1', '1', '4', '082641916033', 'Bekasi'),
('22231018', 'Dadang', '1', '0', '5', '081819989807', 'Jakarta'),
('22231019', 'Tufik', '1', '0', '4', '083840249315', 'Tangerang'),
('22231020', 'Jhono', '3', '0', '6', '081015606049', 'Indramayu'),
('22231021', 'Putra', '3', '0', '4', '082156458039', 'Cianjur'),
('22231022', 'Fatir', '3', '0', '4', '084256950418', 'Surabaya'),
('22231023', 'Bulan', '3', '1', '4', '084825336625', 'Tangerang'),
('22231024', 'Lala', '2', '1', '4', '086457935329', 'Jakarta'),
('22231025', 'Adam', '1', '0', '4', '087378444344', 'Jakarta'),
('22231026', 'Kelly', '2', '1', '5', '081940038310', 'Bekasi'),
('22231027', 'Alok', '1', '0', '6', '085686299607', 'Tangerang'),
('22231028', 'Maxim', '1', '0', '7', '083225394409', 'Surabaya'),
('22231029', 'Olivia', '3', '1', '5', '088272865707', 'Surabaya'),
('22231030', 'Cici', '3', '1', '5', '087222147027', 'Cirebon'),
('22231116', 'Andri', '2', '0', '4', '085197857470', 'Medan'),
('22231130', 'Jot', '1', '0', '4', '0800009511558', 'Bogor'),
('22231505', 'Walid', '3', '0', '4', '0800074253495', 'Surabaya'),
('22231652', 'Ipad', '3', '0', '4', '0800008664807', 'Semarang'),
('22231777', 'Iann', '3', '0', '4', '0800026863227', 'Bogor'),
('22231996', 'Ghio', '3', '0', '4', '0800022182882', 'Tangerang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'elgato', '$2y$10$desYtcxc9Y6RfzGZVFgQR.cOqgLxq4y4b154GFnvJkVwRx0lWIHsK', 'guru'),
(2, 'joko', '$2y$10$fEaTxM4cedo//.XTB/9ff.xPvFqxoZTTKf1BvVITUBq.BAj23EUDq', 'siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wakel`
--

CREATE TABLE `wakel` (
  `nip` char(18) NOT NULL,
  `nama` varchar(10) DEFAULT NULL,
  `kelas` varchar(1) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `agama` char(1) DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wakel`
--

INSERT INTO `wakel` (`nip`, `nama`, `kelas`, `jk`, `agama`, `no_hp`) VALUES
('000000000045432175', 'Zaenal', '3', '0', '4', '082466431746'),
('111255779111198111', 'El Gato', '1', '0', '5', '087733156574'),
('222211157777784411', 'Siregar', '2', '0', '5', '0891888591914'),
('332122245679911991', 'Wilson', '3', '0', '7', '0882145677912');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`kode_a`),
  ADD KEY `nisn` (`nis`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `wakel`
--
ALTER TABLE `wakel`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
