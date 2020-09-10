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
CREATE DATABASE IF NOT EXISTS `koperasi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `koperasi`;

-- Dumping structure for table koperasi.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `login_id` varchar(25) NOT NULL,
  `nomor_nasabah` varchar(50) DEFAULT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.admin: ~1 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`login_id`, `nomor_nasabah`, `nama`, `email`, `PASSWORD`) VALUES
	('adi', '123', 'Adi', 'chef.fajar11@gmail.com', 'admin'),
	('admin', '124', 'Fajar', 'fajar.karuni12.fk@gmail.com', 'admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table koperasi.nasabah
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

-- Dumping data for table koperasi.nasabah: ~0 rows (approximately)
DELETE FROM `nasabah`;
/*!40000 ALTER TABLE `nasabah` DISABLE KEYS */;
/*!40000 ALTER TABLE `nasabah` ENABLE KEYS */;

-- Dumping structure for table koperasi.pelunasan
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
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `nomor_pengajuan` varchar(25) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `nomor_pinjam` varchar(25) NOT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `nominal` decimal(10,0) DEFAULT NULL,
  `cicilan` decimal(10,0) DEFAULT NULL,
  `bunga` int(11) DEFAULT NULL,
  `kredit_bulan` decimal(10,0) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_pinjam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.peminjaman: ~0 rows (approximately)
DELETE FROM `peminjaman`;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table koperasi.pengajuan
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
	('123', '2020-09-10', '123', '2020-10-16', 'sasfasfaefawfa', 'Allowed'),
	('2222', '2020-09-10', '124', '2020-10-31', 'fvvvvvvvv', '');
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;

-- Dumping structure for table koperasi.transaksi_tabungan
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
