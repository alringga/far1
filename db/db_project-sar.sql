-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 17, 2018 at 12:10 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project-sar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daftar_korban`
--

DROP TABLE IF EXISTS `tbl_daftar_korban`;
CREATE TABLE IF NOT EXISTS `tbl_daftar_korban` (
  `id_daftar_korban` int(10) NOT NULL AUTO_INCREMENT,
  `nama_korban` text,
  `foto_korban` text,
  `kondisi_korban` text,
  `kartu_triase` varchar(10) DEFAULT NULL,
  `id_timsar` int(10) DEFAULT NULL,
  `tgl_daftar_korban` datetime DEFAULT NULL,
  PRIMARY KEY (`id_daftar_korban`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_daftar_korban`
--

INSERT INTO `tbl_daftar_korban` (`id_daftar_korban`, `nama_korban`, `foto_korban`, `kondisi_korban`, `kartu_triase`, `id_timsar`, `tgl_daftar_korban`) VALUES
(46, '', NULL, 'a,c', 'hijau', 2, '2018-12-17 16:48:36'),
(45, 'sdg', NULL, 'Sumbatan jalan nafas (Distress nafas),b', 'merah', 2, '2018-12-17 16:48:28'),
(44, '', NULL, 'a,c', 'hijau', 2, '2018-12-17 16:48:21'),
(43, '', NULL, 'Sumbatan jalan nafas (Distress nafas),luka tusuk dada/perut dengan shock dan sesak', 'merah', 2, '2018-12-17 16:48:05'),
(47, '', NULL, 'luka tusuk dada/perut dengan shock dan sesak,a,b,c', 'merah', 2, '2018-12-17 16:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timsar`
--

DROP TABLE IF EXISTS `tbl_timsar`;
CREATE TABLE IF NOT EXISTS `tbl_timsar` (
  `id_timsar` int(10) NOT NULL AUTO_INCREMENT,
  `posko` text,
  `desa` text,
  `nama` text,
  `email` text,
  `foto` text,
  `tgl_timsar` datetime DEFAULT NULL,
  PRIMARY KEY (`id_timsar`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_timsar`
--

INSERT INTO `tbl_timsar` (`id_timsar`, `posko`, `desa`, `nama`, `email`, `foto`, `tgl_timsar`) VALUES
(2, 'a', 'b', 'c', 'd@sd.sg', 'img/profile/0f9de7a1bd558ae4f4e5019af9a43b46.png', '2018-12-16 17:40:52'),
(3, 'abcd', 'efgh', 'anfi', 'anfi@gmail.com', 'img/profile/ef7027e7805c407398875405e6867efe.jpg', '2018-12-17 16:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_triase`
--

DROP TABLE IF EXISTS `tbl_triase`;
CREATE TABLE IF NOT EXISTS `tbl_triase` (
  `id_triase` int(10) NOT NULL AUTO_INCREMENT,
  `jenis_kartu` text,
  `kondisi_pasien` text,
  `deskripsi` text,
  `tgl_triase` datetime DEFAULT NULL,
  PRIMARY KEY (`id_triase`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_triase`
--

INSERT INTO `tbl_triase` (`id_triase`, `jenis_kartu`, `kondisi_pasien`, `deskripsi`, `tgl_triase`) VALUES
(1, 'merah', 'Sumbatan jalan nafas (Distress nafas),luka tusuk dada/perut dengan shock dan sesak', '-', '2018-12-15 19:06:32'),
(3, 'hijau', 'a,b,c', 'abcd', '2018-12-17 15:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` text,
  `id_timsar` int(10) DEFAULT NULL,
  `foto_user` text,
  `level` varchar(30) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  `dihapus` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_lengkap`, `username`, `password`, `id_timsar`, `foto_user`, `level`, `tgl_daftar`, `dihapus`) VALUES
(1, 'anwar saputra', 'diskes', 'diskes', NULL, 'img/profile/8e064b4a29e016ab274bb453ac128031.jpg', '1', '2018-12-14 16:00:00', 'tidak'),
(5, 'anfi', 'timsar2', 'timsar2', 3, 'img/profile/ef7027e7805c407398875405e6867efe.jpg', '2', '2018-12-17 16:18:49', 'tidak'),
(4, 'c', 'timsar', 'timsar', 2, 'img/profile/0f9de7a1bd558ae4f4e5019af9a43b46.png', '2', '2018-12-16 17:40:52', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_web`
--

DROP TABLE IF EXISTS `tbl_web`;
CREATE TABLE IF NOT EXISTS `tbl_web` (
  `id_web` int(10) NOT NULL AUTO_INCREMENT,
  `nama_web` text,
  `ket_web` text,
  PRIMARY KEY (`id_web`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_web`
--

INSERT INTO `tbl_web` (`id_web`, `nama_web`, `ket_web`) VALUES
(1, 'SISTEM PEMETAAN TRIASE KORBAN BENCANA', '(SIMPATI)');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
