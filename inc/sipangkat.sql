-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Sep 2023 pada 22.51
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipangkat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_jenis` (`id_jenis`, `jenis`) VALUES
(3, 'Perbaikan Lampu Jalan'),
(6, 'Penambahan Lampu Jalan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengadu`
--

CREATE TABLE `tb_pengadu` (
  `id_pengadu` varchar(255) NOT NULL PRIMARY KEY,
  `nama_pengadu` varchar(255) NOT NULL,
  `jekel` varchar(10) NOT NULL CHECK (jekel IN ('Laki-Laki', 'Perempuan')),
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_pengadu` (`id_pengadu`, `nama_pengadu`, `jekel`, `no_hp`, `alamat`) VALUES
('111fae3b-cce3-4ce9-b115-6f31717826cc', 'Masyarakat', 'Laki-Laki', '-', '-');


-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `judul` varchar(255) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `jenis` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(500) NOT NULL,
  `waktu_aduan` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Proses',
  `tanggapan` text DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `lat` double(10,6) NOT NULL,
  `lng` double(10,6) NOT NULL,
  FOREIGN KEY (`jenis`) REFERENCES `tb_jenis` (`id_jenis`),
  FOREIGN KEY (`author`) REFERENCES `tb_pengadu` (`id_pengadu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_pengaduan` (`id_pengaduan`, `judul`, `no_telpon`, `jenis`, `alamat`, `keterangan`, `foto`, `waktu_aduan`, `status`, `tanggapan`, `author`, `lat`, `lng`) VALUES
(71, 'Finza Ganteng', '0895377897675', 3, '', 'Jl Menoreh VIII PAk sunardi', 'WhatsApp Image 2023-09-08 at 09.47.40.jpeg', '2023-09-21 13:36:40', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.010286, 110.388980),
(73, 'keceng', '087742006161', 3, '', 'lampune rusak', 'BA00325F-D6A3-4BEF-82C6-C4D2091AD963.jpeg', '2023-09-21 13:47:05', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc', -6.985193, 110.425908),
(75, 'Jintoelll', '087742006161', 3, '', 'lampu rusak bol', '16952792862238224378973618400625.jpg', '2023-09-21 13:55:00', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.010290, 110.388975),
(78, 'Jem', '081226052136', 6, '', 'seg', 'ap.png', '2023-09-25 08:28:42', 'Tanggapi', 'edsaytsd', '111fae3b-cce3-4ce9-b115-6f31717826cc', -6.990865, 110.422040),
(80, 'AGSFHSGH', '3452543764768', 3, '', 'eu8fti', 'BSS.jpg', '2023-09-27 05:18:19', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.380876, 110.628025),
(81, 'Jem', '081227208060', 3, '', 'tyi', '989904.png', '2023-09-27 05:25:34', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.010289, 110.388976),
(83, 'AGSFHSGH', '081226052136', 3, '', 'srh', 'ap.png', '2023-09-27 05:48:19', 'Selesai', 'cgjik', '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.331844, 109.375583),
(85, 'Kopet', '081226052136', 6, '', 'aetat', 'ap.png', '2023-09-27 05:56:06', 'Tanggapi', 'fyi', '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.010287, 110.388972),
(87, 'Jem', '081226052136', 6, '', 'rtryt', 'awas-ketauan.png', '2023-09-29 01:14:39', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.010295, 110.388980);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` varchar(255) NOT NULL PRIMARY KEY,
  `nama_pengguna` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL CHECK (level IN ('Administrator', 'Petugas', 'Pengadu')),
  `grup` varchar(10) NOT NULL CHECK (grup IN ('A', 'B'))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`, `grup`) VALUES
('111fae3b-cce3-4ce9-b115-6f31717826cc', 'Masyarakat', 'pengadu', '123', 'Pengadu', 'B'),
('5351949a-6598-11eb-96e0-60eb69a13690', 'Reffrains', 'petugas', '123', 'Petugas', 'A'),
('70f4ea86-5ccc-11ee-850e-1418c3400e2e', 'Jem', 'jem', '123', 'Petugas', 'A'),
('766b07b7-658e-11eb-96e0-60eb69a13690', 'Finza', 'admin', '123', 'Administrator', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_whatsapp`
--

CREATE TABLE `tb_whatsapp` (
  `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nama` varchar(100) NOT NULL,
  `nomor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_whatsapp` (`id`, `nama`, `nomor`) VALUES
(1, 'akun 1', '0895377897675');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tb_pengadu`
--
ALTER TABLE `tb_pengadu`
  ADD PRIMARY KEY (`id_pengadu`);

--
-- Indeks untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `author` (`author`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tb_whatsapp`
--
ALTER TABLE `tb_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `tb_whatsapp`
--
ALTER TABLE `tb_whatsapp`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD CONSTRAINT `tb_pengaduan_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `tb_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengaduan_ibfk_2` FOREIGN KEY (`author`) REFERENCES `tb_pengadu` (`id_pengadu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
