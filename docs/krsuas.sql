-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 01:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `krsuas`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(10) UNSIGNED NOT NULL,
  `nama_kelas` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(15) DEFAULT NULL,
  `kode_mk` varchar(10) DEFAULT NULL,
  `id_smt` int(10) UNSIGNED DEFAULT NULL,
  `id_kelas` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id`, `nim`, `kode_mk`, `id_smt`, `id_kelas`) VALUES
(1, '220101114', '41010008', 3, 2),
(10, '220101114', '41010006', 3, 1),
(11, '220101114', '41010007', 3, 2),
(12, '220101114', '41010009', 3, 1),
(13, '220101114', '41010010', 3, 1),
(14, '220101114', '41010013', 3, 1),
(15, '220101114', '41010003', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Pasif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `password`, `status`) VALUES
('220101113', 'Dummy 2', '$2y$10$jIFMMk.pkTb3Cr4ekaE45e/BHufJkkPCMnsLYLgHt8GMWkNGXeAPu', 'Pasif'),
('220101114', 'Rahman Fuad', '$2y$10$50GmmeK8LMpmTWms2WijVeokfcsPi0F5HfnqulzPREct2WOzag.3W', 'Aktif'),
('220101115', 'Ardiansyah Putraman Rukua', '$2y$10$lIjjBg1xwgPJguhVA8gzuOD60Io9bh5sj0jUnDYy2.G5SZhoTHCl.', 'Aktif'),
('220101234', 'Dummy mahasiswa', '$2y$10$wK7UL5.oG.ylJZgrrQYZRuUIGY/HMMKs2e.8p7a30h381p1MI2Hn.', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(50) DEFAULT NULL,
  `semester` int(10) UNSIGNED DEFAULT NULL,
  `sks` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `semester`, `sks`) VALUES
('41010001', 'Logika dan Algoritma', 1, 3),
('41010002', 'Agama', 1, 2),
('41010003', 'Bahasa Inggris', 1, 2),
('41010004', 'Bahasa Pemrograman', 2, 3),
('41010005', 'Pemrograman Web', 3, 3),
('41010006', 'Pemrograman Web Lanjut', 5, 3),
('41010007', 'Testing Implementasi', 5, 2),
('41010008', 'Jaringan Komputer', 5, 4),
('41010009', 'Teori Komputasi', 5, 3),
('41010010', 'Sistem Tertanam', 5, 4),
('41010011', 'Pemrograman Basis Data', 4, 3),
('41010012', 'Rekayasa Perangkat Lunak', 4, 3),
('41010013', 'Basis Data', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_smt` int(10) UNSIGNED NOT NULL,
  `tahun` varchar(9) DEFAULT NULL,
  `semester` enum('Ganjil','Genap') DEFAULT NULL,
  `status` enum('Aktif','Pasif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_smt`, `tahun`, `semester`, `status`) VALUES
(1, '2017/2018', 'Ganjil', 'Pasif'),
(2, '2017/2018', 'Genap', 'Pasif'),
(3, '2018/2019', 'Ganjil', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IXFK_KRS_MAHASISWA` (`nim`),
  ADD KEY `IXFK_KRS_MK` (`kode_mk`),
  ADD KEY `IXFK_KRS_SEMESTER` (`id_smt`),
  ADD KEY `IXFK_KRS_KELAS` (`id_kelas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_mk`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_smt`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_smt` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `IXFK_KRS_KELAS` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IXFK_KRS_MAHASISWA` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IXFK_KRS_MK` FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah` (`kode_mk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IXFK_KRS_SEMESTER` FOREIGN KEY (`id_smt`) REFERENCES `semester` (`id_smt`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
