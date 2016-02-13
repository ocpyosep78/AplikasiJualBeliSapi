-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2013 at 02:31 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbsapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `faktur_pembelian`
--

CREATE TABLE IF NOT EXISTS `faktur_pembelian` (
  `no_faktur_pembelian` varchar(10) NOT NULL,
  `kode_penyuplai` varchar(5) NOT NULL,
  `tgl_faktur_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  PRIMARY KEY (`no_faktur_pembelian`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faktur_pembelian`
--

INSERT INTO `faktur_pembelian` (`no_faktur_pembelian`, `kode_penyuplai`, `tgl_faktur_pembelian`, `total_pembelian`) VALUES
('BL000001', 'PY002', '2013-09-01', 40000000),
('BL000002', 'PY001', '2013-09-02', 37500000),
('BL000003', 'PY002', '2013-09-03', 42500000),
('BL000004', 'PY001', '2013-09-04', 24000000),
('BL000005', 'PY002', '2013-09-05', 30000000),
('BL000006', 'PY001', '2013-09-06', 25500000),
('BL000007', 'PY001', '2013-09-07', 48000000),
('BL000008', 'PY001', '2013-09-08', 17000000),
('BL000009', 'PY002', '2013-09-09', 8000000),
('BL000010', 'PY001', '2013-09-10', 30000000),
('BL000011', 'PY001', '2013-09-11', 8000000),
('BL000012', 'PY002', '2013-09-12', 16000000),
('BL000013', 'PY002', '2013-09-13', 25500000),
('BL000014', 'PY001', '2013-09-14', 30000000),
('BL000015', 'PY001', '2013-09-15', 42500000),
('BL000016', 'PY001', '2013-09-16', 48000000),
('BL000017', 'PY002', '2013-09-17', 52500000),
('BL000018', 'PY001', '2013-09-18', 8000000),
('BL000019', 'PY001', '2013-09-19', 17000000),
('BL000020', 'PY001', '2013-09-20', 85000000),
('BL000021', 'PY001', '2013-09-21', 15000000),
('BL000022', 'PY001', '2013-09-22', 16000000),
('BL000023', 'PY001', '2013-09-23', 24000000),
('BL000024', 'PY001', '2013-09-24', 24000000),
('BL000025', 'PY001', '2013-10-05', 32000000),
('BL000026', 'PY001', '2013-10-06', 48000000),
('BL000027', 'PY001', '2013-10-07', 37500000),
('BL000028', 'PY001', '2013-10-09', 59500000),
('BL000029', 'PY001', '2013-10-08', 72000000);

-- --------------------------------------------------------

--
-- Table structure for table `faktur_penjualan`
--

CREATE TABLE IF NOT EXISTS `faktur_penjualan` (
  `no_faktur_penjualan` varchar(10) NOT NULL,
  `kode_pembeli` varchar(5) NOT NULL,
  `tgl_faktur_penjualan` date NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  PRIMARY KEY (`no_faktur_penjualan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faktur_penjualan`
--

INSERT INTO `faktur_penjualan` (`no_faktur_penjualan`, `kode_pembeli`, `tgl_faktur_penjualan`, `total_penjualan`) VALUES
('JL000001', 'PB001', '2013-09-01', 8000000),
('JL000002', 'PB001', '2013-09-02', 16000000),
('JL000003', 'PB002', '2013-09-03', 24000000),
('JL000004', 'PB001', '2013-09-04', 32000000),
('JL000005', 'PB001', '2013-09-05', 40000000),
('JL000006', 'PB002', '2013-09-06', 48000000),
('JL000007', 'PB001', '2013-09-07', 32000000),
('JL000008', 'PB001', '2013-09-08', 45000000),
('JL000009', 'PB002', '2013-09-09', 42500000),
('JL000010', 'PB001', '2013-09-10', 24000000),
('JL000011', 'PB001', '2013-09-11', 32000000),
('JL000012', 'PB001', '2013-09-12', 37500000),
('JL000013', 'PB001', '2013-09-13', 51000000),
('JL000014', 'PB001', '2013-09-14', 32000000),
('JL000015', 'PB001', '2013-09-15', 22500000),
('JL000016', 'PB002', '2013-09-16', 17000000),
('JL000017', 'PB002', '2013-09-17', 7500000),
('JL000018', 'PB001', '2013-09-18', 22500000),
('JL000019', 'PB001', '2013-09-19', 48000000),
('JL000020', 'PB001', '2013-09-20', 30000000),
('JL000021', 'PB001', '2013-09-21', 22500000),
('JL000022', 'PB002', '2013-09-22', 15000000),
('JL000023', 'PB001', '2013-09-23', 16000000),
('JL000024', 'PB001', '2013-09-24', 24000000),
('JL000025', 'PB001', '2013-09-25', 22500000),
('JL000026', 'PB001', '2013-09-26', 25500000),
('JL000027', 'PB001', '2013-10-07', 34000000),
('JL000028', 'PB001', '2013-10-08', 15000000),
('JL000029', 'PB002', '2013-10-09', 16000000),
('JL000030', 'PB002', '2013-10-10', 24000000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE IF NOT EXISTS `jenis` (
  `kode_jenis_sapi` varchar(5) NOT NULL,
  `keterangan_sapi` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_jenis_sapi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`kode_jenis_sapi`, `keterangan_sapi`) VALUES
('JS001', 'Sapi Australia'),
('JS002', 'Sapi Perah'),
('JS003', 'Sapi Adu'),
('JS004', 'garut');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE IF NOT EXISTS `pembeli` (
  `kode_pembeli` varchar(5) NOT NULL,
  `nama_pembeli` varchar(20) NOT NULL,
  `alamat_pembeli` varchar(100) NOT NULL,
  `no_telp_pembeli` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_pembeli`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`kode_pembeli`, `nama_pembeli`, `alamat_pembeli`, `no_telp_pembeli`) VALUES
('PB002', 'Ohang', 'Ciamis', '234567891'),
('PB001', 'Ableh', 'Tasik', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(10) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `level`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('gisell', '4bdb86b5b6a9dca2019d101745d34374', 'admin'),
('kabag', '1a50ef14d0d75cd795860935ee0918af', 'kabag'),
('citra', 'e260eab6a7c45d139631f72b55d8506b', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `penyuplai`
--

CREATE TABLE IF NOT EXISTS `penyuplai` (
  `kode_penyuplai` varchar(5) NOT NULL,
  `nama_penyuplai` varchar(25) NOT NULL,
  `alamat_penyuplai` varchar(100) NOT NULL,
  `no_telp_penyuplai` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_penyuplai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyuplai`
--

INSERT INTO `penyuplai` (`kode_penyuplai`, `nama_penyuplai`, `alamat_penyuplai`, `no_telp_penyuplai`) VALUES
('PY001', 'Pa Akew', 'Tasik', '234234234'),
('PY002', 'CV. Sapi Jaya', 'Tasik', '1234'),
('PY003', 'aden', 'mangkubumi', '087725555043');

-- --------------------------------------------------------

--
-- Table structure for table `sapi`
--

CREATE TABLE IF NOT EXISTS `sapi` (
  `kode_sapi` varchar(5) NOT NULL,
  `kode_jenis_sapi` varchar(5) NOT NULL,
  `harga_sapi` int(11) NOT NULL,
  `berat_sapi` decimal(10,0) NOT NULL,
  `jumlah_sapi` int(11) NOT NULL,
  PRIMARY KEY (`kode_sapi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sapi`
--

INSERT INTO `sapi` (`kode_sapi`, `kode_jenis_sapi`, `harga_sapi`, `berat_sapi`, `jumlah_sapi`) VALUES
('SP001', 'JS001', 8000000, '400', 19),
('SP002', 'JS002', 7500000, '350', 4),
('SP003', 'JS003', 8500000, '450', 27);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembelian`
--

CREATE TABLE IF NOT EXISTS `transaksi_pembelian` (
  `no_trans_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur_pembelian` varchar(10) NOT NULL,
  `kode_sapi` varchar(5) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `jumlah_sapi_pembelian` int(11) NOT NULL,
  PRIMARY KEY (`no_trans_pembelian`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `transaksi_pembelian`
--

INSERT INTO `transaksi_pembelian` (`no_trans_pembelian`, `no_faktur_pembelian`, `kode_sapi`, `tgl_pembelian`, `jumlah_sapi_pembelian`) VALUES
(1, 'BL000001', 'SP001', '2013-07-01', 5),
(2, 'BL000002', 'SP002', '2013-07-02', 5),
(3, 'BL000003', 'SP003', '2013-07-03', 5),
(4, 'BL000004', 'SP001', '2013-07-04', 3),
(5, 'BL000005', 'SP002', '2013-07-05', 4),
(6, 'BL000006', 'SP003', '2013-07-06', 3),
(7, 'BL000007', 'SP001', '2013-07-07', 6),
(8, 'BL000008', 'SP003', '2013-07-08', 2),
(9, 'BL000009', 'SP001', '2013-07-09', 1),
(10, 'BL000010', 'SP002', '2013-07-10', 4),
(11, 'BL000011', 'SP001', '2013-07-11', 1),
(12, 'BL000012', 'SP001', '2013-07-12', 2),
(13, 'BL000013', 'SP003', '2013-07-13', 3),
(14, 'BL000014', 'SP002', '2013-07-14', 4),
(15, 'BL000015', 'SP003', '2013-07-15', 5),
(16, 'BL000016', 'SP001', '2013-07-16', 6),
(17, 'BL000017', 'SP002', '2013-07-17', 7),
(18, 'BL000018', 'SP001', '2013-07-18', 1),
(19, 'BL000019', 'SP003', '2013-07-19', 2),
(20, 'BL000020', 'SP003', '2013-07-20', 10),
(21, 'BL000021', 'SP002', '2013-07-21', 2),
(22, 'BL000022', 'SP001', '2013-07-22', 2),
(23, 'BL000023', 'SP001', '2013-07-23', 3),
(24, 'BL000024', 'SP001', '2013-07-24', 3),
(25, 'BL000025', 'SP001', '2013-10-05', 4),
(26, 'BL000026', 'SP001', '2013-10-06', 6),
(27, 'BL000027', 'SP002', '2013-10-07', 5),
(28, 'BL000028', 'SP003', '2013-10-09', 7),
(29, 'BL000029', 'SP001', '2013-10-09', 9);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE IF NOT EXISTS `transaksi_penjualan` (
  `no_trans_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur_penjualan` varchar(10) NOT NULL,
  `kode_sapi` varchar(5) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `jumlah_sapi_penjualan` int(11) NOT NULL,
  PRIMARY KEY (`no_trans_penjualan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`no_trans_penjualan`, `no_faktur_penjualan`, `kode_sapi`, `tgl_penjualan`, `jumlah_sapi_penjualan`) VALUES
(1, 'JL000001', 'SP001', '2013-09-01', 1),
(2, 'JL000002', 'SP001', '2013-09-02', 2),
(3, 'JL000003', 'SP001', '2013-09-03', 3),
(4, 'JL000004', 'SP001', '2013-09-04', 4),
(5, 'JL000005', 'SP001', '2013-09-05', 5),
(6, 'JL000006', 'SP001', '2013-09-06', 6),
(7, 'JL000007', 'SP001', '2013-09-07', 4),
(8, 'JL000008', 'SP002', '2013-09-08', 6),
(9, 'JL000009', 'SP003', '2013-09-09', 5),
(10, 'JL000010', 'SP001', '2013-09-10', 3),
(11, 'JL000011', 'SP001', '2013-09-11', 4),
(12, 'JL000012', 'SP002', '2013-09-12', 5),
(13, 'JL000013', 'SP003', '2013-09-13', 6),
(14, 'JL000014', 'SP001', '2013-09-14', 4),
(15, 'JL000015', 'SP002', '2013-09-15', 3),
(16, 'JL000016', 'SP003', '2013-09-16', 2),
(17, 'JL000017', 'SP002', '2013-09-17', 1),
(18, 'JL000018', 'SP002', '2013-09-18', 3),
(19, 'JL000019', 'SP001', '2013-09-19', 6),
(20, 'JL000020', 'SP002', '2013-09-20', 4),
(21, 'JL000021', 'SP002', '2013-09-21', 3),
(22, 'JL000022', 'SP002', '2013-09-22', 2),
(23, 'JL000023', 'SP001', '2013-09-23', 2),
(24, 'JL000024', 'SP001', '2013-09-24', 3),
(25, 'JL000025', 'SP002', '2013-09-25', 3),
(26, 'JL000026', 'SP003', '2013-09-26', 3),
(27, 'JL000027', 'SP003', '2013-10-07', 4),
(28, 'JL000028', 'SP002', '2013-10-08', 2),
(29, 'JL000029', 'SP001', '2013-10-09', 2),
(30, 'JL000030', 'SP001', '2013-10-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_pembelian`
--

CREATE TABLE IF NOT EXISTS `_tmp_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_sapi` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `_tmp_pembelian`
--


-- --------------------------------------------------------

--
-- Table structure for table `_tmp_penjualan`
--

CREATE TABLE IF NOT EXISTS `_tmp_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_sapi` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `_tmp_penjualan`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
