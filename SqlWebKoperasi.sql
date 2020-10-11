-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for koperasi
DROP DATABASE IF EXISTS `koperasi`;
CREATE DATABASE IF NOT EXISTS `koperasi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `koperasi`;

-- Dumping structure for table koperasi.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(25) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `nomor_nasabah` varchar(50) DEFAULT NULL,
  `namadepan` varchar(25) DEFAULT NULL,
  `namabelakang` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `active` varchar(100) DEFAULT NULL,
  `hak_akses` varchar(100) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.login: ~3 rows (approximately)
DELETE FROM `login`;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`login_id`, `username`, `nomor_nasabah`, `namadepan`, `namabelakang`, `email`, `PASSWORD`, `active`, `hak_akses`, `code`) VALUES
	(1, 'adi', '123', 'Adi', 'saputra', 'chef.fajar11@gmail.com', 'admin', '', NULL, NULL),
	(2, 'fajar', '124', 'Fajar', 'karunia', 'fajar.karunia12.fk@gmail.com', '4297f44b13955235245b2497399d7a93', 'true', '1', NULL),
	(3, 'safii', '1211', 'Safi`i', 'muhammad', 'fajar.karunia05.fk@gmail.com', 'admin', NULL, NULL, NULL);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

-- Dumping structure for table koperasi.nasabah
DROP TABLE IF EXISTS `nasabah`;
CREATE TABLE IF NOT EXISTS `nasabah` (
  `nomor_nasabah` varchar(25) NOT NULL,
  `nama_nasabah` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` datetime DEFAULT NULL,
  `usia` int(11) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `type_identitas` varchar(25) DEFAULT NULL,
  `no_identitas` varchar(25) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `Bank` varchar(15) DEFAULT NULL,
  `no_rek` int(11) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `Gaji` int(11) DEFAULT NULL,
  `total_tabungan` int(11) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Foto_Identitas` varchar(255) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`nomor_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.nasabah: ~2 rows (approximately)
DELETE FROM `nasabah`;
/*!40000 ALTER TABLE `nasabah` DISABLE KEYS */;
INSERT INTO `nasabah` (`nomor_nasabah`, `nama_nasabah`, `tempat_lahir`, `tanggal_lahir`, `usia`, `jenis_kelamin`, `type_identitas`, `no_identitas`, `alamat`, `Bank`, `no_rek`, `telepon`, `Gaji`, `total_tabungan`, `Foto`, `Foto_Identitas`, `status`) VALUES
	('1', '2', '3', '2020-09-20 00:00:00', 0, 'Laki-Laki', 'KTP', 'a', 'f', 'f', 3, '1', 2, NULL, NULL, NULL, NULL),
	('124', 'Adi', 'jkt', '2020-09-20 11:39:14', 24, 'Laki-Laki', 'KTP', '999', 'p', 'bd', 99, '999', 5000000, 1000000, NULL, NULL, NULL);
/*!40000 ALTER TABLE `nasabah` ENABLE KEYS */;

-- Dumping structure for table koperasi.pelunasan
DROP TABLE IF EXISTS `pelunasan`;
CREATE TABLE IF NOT EXISTS `pelunasan` (
  `nomor_pelunasan` varchar(25) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_pelunasan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.pelunasan: ~0 rows (approximately)
DELETE FROM `pelunasan`;
/*!40000 ALTER TABLE `pelunasan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelunasan` ENABLE KEYS */;

-- Dumping structure for table koperasi.peminjaman
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `nomor_pengajuan` varchar(25) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `nomor_pinjam` varchar(25) NOT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `nominal` decimal(10,0) DEFAULT NULL,
  `cicilan` decimal(10,0) DEFAULT NULL,
  `bunga` decimal(10,4) DEFAULT NULL,
  `kredit_bulan` decimal(10,0) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `admin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_pinjam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.peminjaman: ~3 rows (approximately)
DELETE FROM `peminjaman`;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` (`nomor_pengajuan`, `tanggal_transaksi`, `nomor_pinjam`, `nomor_nasabah`, `nominal`, `cicilan`, `bunga`, `kredit_bulan`, `keterangan`, `admin`) VALUES
	('a', '0000-00-00', '', '', 1, 0, 0.0000, 0, '', NULL),
	('12', '2020-09-20', '1223', '124', 50000000, 5000000, 0.2000, 1200000, 'a', 'fajar'),
	('14', '0000-00-00', '14', '1254', 15000000, 0, 0.0000, 0, '', NULL);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table koperasi.pengajuan
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE IF NOT EXISTS `pengajuan` (
  `nomor_transaksi` varchar(25) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`nomor_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.pengajuan: ~3 rows (approximately)
DELETE FROM `pengajuan`;
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
INSERT INTO `pengajuan` (`nomor_transaksi`, `tanggal_transaksi`, `nomor_nasabah`, `tanggal_peminjaman`, `keterangan`, `status`) VALUES
	('1111', '2020-09-09', '1211', '2020-10-10', 'aaaaa', 'Allowed'),
	('123', '2020-09-10', '123', '2020-10-16', 'sasfasfaefawfa', 'Not Allowed'),
	('2222', '2020-09-10', '124', '2020-10-31', 'fvvvvvvvv', 'Not Allowed');
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;

-- Dumping structure for table koperasi.transaksi_tabungan
DROP TABLE IF EXISTS `transaksi_tabungan`;
CREATE TABLE IF NOT EXISTS `transaksi_tabungan` (
  `nomor_tabungan` varchar(10) NOT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_tabungan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.transaksi_tabungan: ~0 rows (approximately)
DELETE FROM `transaksi_tabungan`;
/*!40000 ALTER TABLE `transaksi_tabungan` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_tabungan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
nasabahnasabahtransaksi_tabungan