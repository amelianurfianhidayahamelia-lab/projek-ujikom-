-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2026 at 01:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('amelia', 'amel1234');

-- --------------------------------------------------------

--
-- Table structure for table `crud_anggota`
--

CREATE TABLE `crud_anggota` (
  `nama` varchar(25) NOT NULL,
  `nomor_anggota` int(25) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `kelas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud_anggota`
--

INSERT INTO `crud_anggota` (`nama`, `nomor_anggota`, `jenis_kelamin`, `tanggal_daftar`, `kelas`) VALUES
('Nazwa', 1, 'Perempuan', '2026-04-06', 'x mplb'),
('Thalita', 2, 'Perempuan', '2026-04-09', 'x mplb');

-- --------------------------------------------------------

--
-- Table structure for table `crud_buku`
--

CREATE TABLE `crud_buku` (
  `judul_buku` varchar(25) NOT NULL,
  `pengarang` varchar(25) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `jumlah_buku` int(25) NOT NULL,
  `lokasi_rak` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud_buku`
--

INSERT INTO `crud_buku` (`judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `jumlah_buku`, `lokasi_rak`) VALUES
('Bumi manusia', 'Pramoedya Ananta Toer', 'Lentera Dipantara', '1980', 4, 'A'),
('Gadis Kretek', 'Ratih Kumala', 'Gramedia Pustaka Utama', '2012', 5, 'B'),
('Laut Bercerita', 'Leila S. Chudori', 'Gramedia', '2017', 5, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `custumer`
--

CREATE TABLE `custumer` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custumer`
--

INSERT INTO `custumer` (`id`, `username`, `password`) VALUES
(1, 'Thalita', 'lita123'),
(2, 'Nazwa', 'nazwa123');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_buku`
--

CREATE TABLE `tabel_buku` (
  `id` int(5) NOT NULL,
  `judul` varchar(10) NOT NULL,
  `status` enum('proses','di pinjam','di kembalikan') NOT NULL,
  `pengarang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_buku`
--

INSERT INTO `tabel_buku` (`id`, `judul`, `status`, `pengarang`) VALUES
(1, 'gadis kret', 'di pinjam', 'Ratih Kuma');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_peminjaman`
--

CREATE TABLE `transaksi_peminjaman` (
  `nama_peminjam` varchar(25) NOT NULL,
  `judul_buku` varchar(25) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `status` enum('sedang di pinjam','proses','di kembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_peminjaman`
--

INSERT INTO `transaksi_peminjaman` (`nama_peminjam`, `judul_buku`, `kelas`, `tanggal_pinjam`, `tanggal_kembali`, `id_transaksi`, `status`) VALUES
('Thalita', 'gadis kretek', 'x mplb', '2026-02-12', '2026-02-15', 3, 'sedang di pinjam'),
('User', 'Bumi manusia', '', '2026-04-10', '0000-00-00', 5, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `custumer`
--
ALTER TABLE `custumer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_buku`
--
ALTER TABLE `tabel_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `custumer`
--
ALTER TABLE `custumer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabel_buku`
--
ALTER TABLE `tabel_buku`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
