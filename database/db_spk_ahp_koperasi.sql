-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 29, 2021 at 07:46 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_ahp_koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE IF NOT EXISTS `akun` (
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`email`, `password`, `role`, `last_login`) VALUES
('kepaladinas@gmail.com', '09b568e9ac624f349c02559e9b856ab5', 3, '2021-04-30 02:39:28'),
('odd.akun@gmail.com', 'cc8fe1a350ce683f3e9218db14226d99', 2, '2021-04-29 20:46:54'),
('spkahp.koperasi@gmail.com', 'a2edd11710242c25f7767f7444dd0bd4', 1, '2021-04-30 02:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `dana_bantuan`
--

DROP TABLE IF EXISTS `dana_bantuan`;
CREATE TABLE IF NOT EXISTS `dana_bantuan` (
  `id_danabantuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jumlah_penerima` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_danabantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dana_bantuan`
--

INSERT INTO `dana_bantuan` (`id_danabantuan`, `nama`, `jumlah_penerima`, `tanggal`, `keterangan`, `status`) VALUES
(1, 'Dana Bantuan Bulan Ramadhan 2021', 2, '2021-04-27', '-', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ir`
--

DROP TABLE IF EXISTS `ir`;
CREATE TABLE IF NOT EXISTS `ir` (
  `jumlah` int(11) NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`jumlah`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ir`
--

INSERT INTO `ir` (`jumlah`, `nilai`) VALUES
(1, 0),
(2, 0),
(3, 0.58),
(4, 0.9),
(5, 1.12),
(6, 1.24),
(7, 1.32),
(8, 1.41),
(9, 1.45),
(10, 1.49),
(11, 1.51),
(12, 1.48),
(13, 1.56),
(14, 1.57),
(15, 1.59);

-- --------------------------------------------------------

--
-- Table structure for table `koperasi`
--

DROP TABLE IF EXISTS `koperasi`;
CREATE TABLE IF NOT EXISTS `koperasi` (
  `id_koperasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_koperasi` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_danabantuan` int(11) NOT NULL,
  `status` int(1) DEFAULT '0',
  `nilai` decimal(6,3) DEFAULT '0.000',
  PRIMARY KEY (`id_koperasi`),
  KEY `id_danabantuan` (`id_danabantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koperasi`
--

INSERT INTO `koperasi` (`id_koperasi`, `nama_koperasi`, `alamat`, `kontak`, `email`, `id_danabantuan`, `status`, `nilai`) VALUES
(1, 'KSU Imka Daya', '-', '-', 'alt1@gmail.com', 1, 0, '0.000'),
(2, 'KUD Sari Makmur', '-', '-', 'alt2@gmail.com', 1, 0, '0.000'),
(3, 'KSU Maju Makmur', '-', '-', 'alt3@gmail.com', 1, 0, '0.000'),
(4, 'KSU Tunas Muda', '-', '-', 'alt4@gmail.com', 1, 0, '0.000'),
(5, 'KSP Arta Karya Bersama', '-', '-', 'alt5@gmail.com', 1, 0, '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(50) NOT NULL,
  `inisial` varchar(4) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `inisial`) VALUES
(12, 'Organisasi', 'A'),
(13, 'Tata Laksana', 'B'),
(14, 'Produktifitas', 'C'),
(15, 'Manfaat Koperasi', 'D'),
(16, 'Dampak Koperasi Terhadap Wilayah', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `mp_kriteria`
--

DROP TABLE IF EXISTS `mp_kriteria`;
CREATE TABLE IF NOT EXISTS `mp_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `id_kriteria_2` int(11) NOT NULL,
  `nilai` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_kriteria_2` (`id_kriteria_2`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp_kriteria`
--

INSERT INTO `mp_kriteria` (`id`, `id_kriteria`, `id_kriteria_2`, `nilai`) VALUES
(52, 12, 12, '1.00'),
(53, 13, 12, '0.20'),
(54, 13, 13, '1.00'),
(55, 12, 13, '5.00'),
(56, 14, 12, '0.33'),
(57, 14, 13, '0.33'),
(58, 14, 14, '1.00'),
(59, 12, 14, '3.00'),
(60, 13, 14, '3.00'),
(61, 15, 12, '0.11'),
(62, 15, 13, '0.20'),
(63, 15, 14, '0.14'),
(64, 15, 15, '1.00'),
(65, 12, 15, '9.00'),
(66, 13, 15, '5.00'),
(67, 14, 15, '7.00'),
(68, 16, 12, '0.14'),
(69, 16, 13, '0.20'),
(70, 16, 14, '0.20'),
(71, 16, 15, '0.14'),
(72, 16, 16, '1.00'),
(73, 12, 16, '7.00'),
(74, 13, 16, '5.00'),
(75, 14, 16, '5.00'),
(76, 15, 16, '7.00');

-- --------------------------------------------------------

--
-- Table structure for table `mp_subkriteria`
--

DROP TABLE IF EXISTS `mp_subkriteria`;
CREATE TABLE IF NOT EXISTS `mp_subkriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_subkriteria` int(11) NOT NULL,
  `id_subkriteria_2` int(11) NOT NULL,
  `nilai` decimal(5,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`id`),
  KEY `id_subkriteria` (`id_subkriteria`),
  KEY `id_subkriteria_2` (`id_subkriteria_2`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp_subkriteria`
--

INSERT INTO `mp_subkriteria` (`id`, `id_subkriteria`, `id_subkriteria_2`, `nilai`) VALUES
(1, 5, 5, '1.000'),
(2, 6, 5, '0.330'),
(3, 6, 6, '1.000'),
(4, 5, 6, '3.000'),
(10, 8, 8, '1.000'),
(11, 9, 8, '0.330'),
(12, 9, 9, '1.000'),
(13, 8, 9, '3.000'),
(14, 10, 8, '0.250'),
(15, 10, 9, '0.330'),
(16, 10, 10, '1.000'),
(17, 8, 10, '4.000'),
(18, 9, 10, '3.000'),
(19, 11, 11, '1.000'),
(20, 12, 11, '0.500'),
(21, 12, 12, '1.000'),
(22, 11, 12, '2.000');

-- --------------------------------------------------------

--
-- Table structure for table `penilai`
--

DROP TABLE IF EXISTS `penilai`;
CREATE TABLE IF NOT EXISTS `penilai` (
  `id_penilai` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_penilai`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilai`
--

INSERT INTO `penilai` (`id_penilai`, `nama`, `jk`, `alamat`, `kontak`, `email`) VALUES
(2, 'Penilai 1', 'Laki - Laki', '-', '-', 'odd.akun@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penilai` int(11) NOT NULL,
  `id_koperasi` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `subkriteria` text,
  `nilai` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_koperasi` (`id_koperasi`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_penilai` (`id_penilai`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_penilai`, `id_koperasi`, `id_kriteria`, `subkriteria`, `nilai`) VALUES
(6, 2, 1, 12, 'Kinerja Pengurus', 100),
(7, 2, 1, 12, 'Peningkatan Jumlah Anggota', 100),
(8, 2, 1, 13, 'Sarana dan Prasarana', 75),
(9, 2, 1, 13, 'Laporan Keuangan', 75),
(10, 2, 1, 13, 'Peningkatan Usaha Koperasi', 50),
(11, 2, 1, 14, '-', 50),
(12, 2, 1, 15, 'Manfaat koperasi bagi anggota', 75),
(13, 2, 1, 15, 'Manfaat koperasi bagi masyarakat', 100),
(14, 2, 1, 16, '-', 50),
(141, 2, 2, 12, 'Kinerja Pengurus', 100),
(142, 2, 2, 12, 'Peningkatan Jumlah Anggota', 100),
(143, 2, 2, 13, 'Sarana dan Prasarana', 75),
(144, 2, 2, 13, 'Laporan Keuangan', 50),
(145, 2, 2, 13, 'Peningkatan Usaha Koperasi', 100),
(146, 2, 2, 14, '-', 100),
(147, 2, 2, 15, 'Manfaat koperasi bagi anggota', 50),
(148, 2, 2, 15, 'Manfaat koperasi bagi masyarakat', 100),
(149, 2, 2, 16, '-', 75),
(159, 2, 4, 12, 'Kinerja Pengurus', 100),
(160, 2, 4, 12, 'Peningkatan Jumlah Anggota', 50),
(161, 2, 4, 13, 'Sarana dan Prasarana', 75),
(162, 2, 4, 13, 'Laporan Keuangan', 75),
(163, 2, 4, 13, 'Peningkatan Usaha Koperasi', 50),
(164, 2, 4, 14, '-', 50),
(165, 2, 4, 15, 'Manfaat koperasi bagi anggota', 50),
(166, 2, 4, 15, 'Manfaat koperasi bagi masyarakat', 75),
(167, 2, 4, 16, '-', 100),
(177, 2, 3, 12, 'Kinerja Pengurus', 50),
(178, 2, 3, 12, 'Peningkatan Jumlah Anggota', 75),
(179, 2, 3, 13, 'Sarana dan Prasarana', 100),
(180, 2, 3, 13, 'Laporan Keuangan', 50),
(181, 2, 3, 13, 'Peningkatan Usaha Koperasi', 75),
(182, 2, 3, 14, '-', 100),
(183, 2, 3, 15, 'Manfaat koperasi bagi anggota', 75),
(184, 2, 3, 15, 'Manfaat koperasi bagi masyarakat', 75),
(185, 2, 3, 16, '-', 75),
(186, 2, 5, 12, 'Kinerja Pengurus', 50),
(187, 2, 5, 12, 'Peningkatan Jumlah Anggota', 50),
(188, 2, 5, 13, 'Sarana dan Prasarana', 75),
(189, 2, 5, 13, 'Laporan Keuangan', 50),
(190, 2, 5, 13, 'Peningkatan Usaha Koperasi', 50),
(191, 2, 5, 14, '-', 50),
(192, 2, 5, 15, 'Manfaat koperasi bagi anggota', 75),
(193, 2, 5, 15, 'Manfaat koperasi bagi masyarakat', 100),
(194, 2, 5, 16, '-', 50);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

DROP TABLE IF EXISTS `subkriteria`;
CREATE TABLE IF NOT EXISTS `subkriteria` (
  `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) NOT NULL,
  `inisial` varchar(5) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  PRIMARY KEY (`id_subkriteria`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `nama_sub`, `inisial`, `id_kriteria`) VALUES
(5, 'Kinerja Pengurus', 'A1', 12),
(6, 'Peningkatan Jumlah Anggota', 'A2', 12),
(8, 'Sarana dan Prasarana', 'B1', 13),
(9, 'Laporan Keuangan', 'B2', 13),
(10, 'Peningkatan Usaha Koperasi', 'B3', 13),
(11, 'Manfaat koperasi bagi anggota', 'D1', 15),
(12, 'Manfaat koperasi bagi masyarakat', 'D2', 15);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `koperasi`
--
ALTER TABLE `koperasi`
  ADD CONSTRAINT `koperasi_ibfk_1` FOREIGN KEY (`id_danabantuan`) REFERENCES `dana_bantuan` (`id_danabantuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp_kriteria`
--
ALTER TABLE `mp_kriteria`
  ADD CONSTRAINT `mp_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mp_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria_2`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp_subkriteria`
--
ALTER TABLE `mp_subkriteria`
  ADD CONSTRAINT `mp_subkriteria_ibfk_1` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mp_subkriteria_ibfk_2` FOREIGN KEY (`id_subkriteria_2`) REFERENCES `subkriteria` (`id_subkriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilai`
--
ALTER TABLE `penilai`
  ADD CONSTRAINT `penilai_ibfk_1` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_koperasi`) REFERENCES `koperasi` (`id_koperasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_penilai`) REFERENCES `penilai` (`id_penilai`);

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
