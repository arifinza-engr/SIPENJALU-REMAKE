-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2023 pada 08.37
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
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `jenis`) VALUES
(3, 'Perbaikan Lampu Jalan'),
(6, 'Penambahan Lampu Jalan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengadu`
--

CREATE TABLE `tb_pengadu` (
  `id_pengadu` varchar(255) NOT NULL,
  `nama_pengadu` varchar(255) NOT NULL,
  `jekel` varchar(10) NOT NULL CHECK (`jekel` in ('Laki-Laki','Perempuan')),
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pengadu`
--

INSERT INTO `tb_pengadu` (`id_pengadu`, `nama_pengadu`, `jekel`, `no_hp`, `alamat`) VALUES
('111fae3b-cce3-4ce9-b115-6f31717826cc', 'Masyarakat', 'Laki-Laki', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
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
  `lng` double(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_pengaduan`, `judul`, `no_telpon`, `jenis`, `alamat`, `keterangan`, `foto`, `waktu_aduan`, `status`, `tanggapan`, `author`, `lat`, `lng`) VALUES
(91, 'Roni', '081226052136', 6, '', 'Segera diproses', '0918181353.mp4', '2023-10-30 13:13:08', 'Selesai', 'Oke', '111fae3b-cce3-4ce9-b115-6f31717826cc', -7.010293, 110.389002);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` varchar(255) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `level` varchar(50) NOT NULL CHECK (`level` in ('Administrator','Petugas','Pengadu')),
  `grup` varchar(10) NOT NULL CHECK (`grup` in ('A','B'))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `whatsapp`, `level`, `grup`) VALUES
('111fae3b-cce3-4ce9-b115-6f31717826cc', 'Masyarakat', 'pengadu', '123', '', 'Pengadu', 'B'),
('5351949a-6598-11eb-96e0-60eb69a13690', 'Reffrains', 'petugas', '123', '0897675745357', 'Petugas', 'A'),
('766b07b7-658e-11eb-96e0-60eb69a13690', 'Arifinza Eska Nugraha', 'admin', '123', '0895377897675', 'Administrator', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_whatsapp`
--

CREATE TABLE `tb_whatsapp` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_whatsapp`
--

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
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `tb_whatsapp`
--
ALTER TABLE `tb_whatsapp`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD CONSTRAINT `tb_pengaduan_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `tb_jenis` (`id_jenis`),
  ADD CONSTRAINT `tb_pengaduan_ibfk_2` FOREIGN KEY (`author`) REFERENCES `tb_pengadu` (`id_pengadu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
