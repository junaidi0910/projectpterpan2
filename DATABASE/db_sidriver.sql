-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Des 2022 pada 06.10
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sidriver`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(50) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `bahan_bakar` varchar(35) NOT NULL,
  `foto_mobil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `nama_mobil`, `no_plat`, `bahan_bakar`, `foto_mobil`) VALUES
(4, 'Pajero Sport', 'DT 6121 AK', 'Pertamax', '1224441406_pajero.jpeg'),
(5, 'Kijang Inova', 'DT 4567', 'Pertamax', '1042619440_download.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_aplikasi` varchar(50) NOT NULL,
  `bg` text NOT NULL,
  `copyright` varchar(50) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `nama_aplikasi`, `bg`, `copyright`, `logo`) VALUES
(1, 'SI DRIVER', '281018430_bg.jpg', 'sourcecode28', '1030989766_stir.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kegiatan`
--

CREATE TABLE `tbl_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `unit_kerja` varchar(50) NOT NULL,
  `kegiatan` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `mulai_jam` time NOT NULL,
  `sampai_jam` time NOT NULL,
  `jumlah_penumpang` int(11) NOT NULL,
  `nama_driver` varchar(50) NOT NULL,
  `status_read` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kegiatan`
--

INSERT INTO `tbl_kegiatan` (`id_kegiatan`, `id_pegawai`, `unit_kerja`, `kegiatan`, `tujuan`, `tgl`, `mulai_jam`, `sampai_jam`, `jumlah_penumpang`, `nama_driver`, `status_read`) VALUES
(6, 10, 'Manajemen unit', 'Kunjungan', 'Kolaka timur', '2022-11-11', '22:19:00', '23:19:00', 3, 'Ahmad Junair', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(20) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `status` varchar(50) NOT NULL,
  `foto_user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `nip`, `username`, `password`, `level`, `no_telp`, `status`, `foto_user`) VALUES
(1, 'jevi alvenosa', '', 'jevi', '8542516f8870173d7d1daba1daaaf0a1', 'admin', '085281618966', 'Stand By Kantor', '870086506_businessman.png'),
(2, 'Ahmad Junair', '', 'juna', '8542516f8870173d7d1daba1daaaf0a1', 'driver', '085251426755', 'Stand By Kantor', '75289892_man (2).png'),
(10, 'Andi', '27567', 'andi', '8542516f8870173d7d1daba1daaaf0a1', 'pegawai', '345656567', '', ''),
(11, 'Rudi Setiawan', '', 'rudi', '8542516f8870173d7d1daba1daaaf0a1', 'driver', '085234212344', 'Stand By Kantor', ''),
(13, 'Ratna', '45678', 'ratna', '8542516f8870173d7d1daba1daaaf0a1', 'pegawai', '263725323', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
