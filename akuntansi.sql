-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2019 at 02:14 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akuntansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_jurnalumum`
--

CREATE TABLE `db_jurnalumum` (
  `id` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `uraian` text NOT NULL,
  `no_akun` int(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `js` int(11) NOT NULL,
  `rec_group` int(11) NOT NULL,
  `rec_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_jurnalumum`
--

INSERT INTO `db_jurnalumum` (`id`, `tanggal`, `uraian`, `no_akun`, `debet`, `kredit`, `js`, `rec_group`, `rec_module`) VALUES
(398, '2019/01/01', 'Kas', 11, 110000000, 0, 0, 1547712699, 31),
(399, '2019/01/01', 'Modal Awal Usaha', 31, 0, 110000000, 0, 1547712699, 31),
(400, '2019/01/01', 'Sewa Tempat Usaha ( 4 Bulan )', 14, 8000000, 0, 0, 1547712763, 0),
(401, '2019/01/01', 'Sewa Tempat Usaha ( 4 Bulan )', 11, 0, 8000000, 0, 1547712763, 0),
(402, '2019/01/02', 'Membeli Perlengkapan usaha', 13, 20000000, 0, 0, 1547712789, 0),
(403, '2019/01/02', 'Membeli Perlengkapan usaha', 11, 0, 20000000, 0, 1547712789, 0),
(404, '2019/01/05', 'Pembelian Mobil Secara Kredit', 15, 150000000, 0, 0, 1547712917, 21),
(405, '2019/01/05', 'Pembelian Mobil Secara Kredit', 11, 0, 10000000, 0, 1547712917, 21),
(406, '2019/01/05', 'Pembelian Mobil Secara Kredit', 21, 0, 140000000, 0, 1547712917, 21),
(407, '2019/01/10', 'Pembelian Mesin Fotocopy secara kredit', 15, 25000000, 0, 0, 1547712957, 21),
(408, '2019/01/10', 'Pembelian Mesin Fotocopy secara kredit', 11, 0, 10000000, 0, 1547712957, 21),
(409, '2019/01/10', 'Pembelian Mesin Fotocopy secara kredit', 21, 0, 15000000, 0, 1547712957, 21),
(410, '2019/01/10', 'Penerimaan Pendapatan', 11, 15000000, 0, 0, 1547713093, 0),
(411, '2019/01/10', 'Penerimaan Pendapatan', 41, 0, 15000000, 0, 1547713093, 0),
(412, '2019/01/14', 'Beban Perlengkapan', 51, 5000000, 0, 0, 1547713113, 51),
(413, '2019/01/14', 'Beban Perlengkapan', 13, 0, 5000000, 0, 1547713113, 51),
(414, '2019/01/20', 'Penerimaan Pendapatan', 11, 10000000, 0, 0, 1547713217, 0),
(415, '2019/01/20', 'Penerimaan Pendapatan', 41, 0, 10000000, 0, 1547713217, 0),
(416, '2019/01/25', 'Pembayaran Angsuran pembelian Mobil', 21, 5000000, 0, 0, 1547713254, 21),
(417, '2019/01/25', 'Pembayaran Angsuran pembelian Mobil', 11, 0, 5000000, 0, 1547713254, 21),
(418, '2019/01/29', 'Beban Perlengkapan', 51, 12000000, 0, 0, 1547713274, 51),
(419, '2019/01/29', 'Beban Perlengkapan', 13, 0, 12000000, 0, 1547713274, 51),
(420, '2019/01/30', 'Tagihan Telephone', 55, 500000, 0, 0, 1547713311, 0),
(421, '2019/01/30', 'Tagihan Telephone', 11, 0, 500000, 0, 1547713311, 0),
(422, '2019/01/30', 'Tagihan Listrik', 54, 3500000, 0, 0, 1547713333, 0),
(423, '2019/01/30', 'Tagihan Listrik', 11, 0, 3500000, 0, 1547713333, 0),
(424, '2019/01/30', 'Penerimaan Pendapatan', 11, 12500000, 0, 0, 1547713368, 0),
(425, '2019/01/30', 'Penerimaan Pendapatan', 41, 0, 12500000, 0, 1547713368, 0),
(426, '2019/01/31', 'pembayaran Gajih Pegawai', 52, 7000000, 0, 0, 1547713409, 0),
(427, '2019/01/31', 'pembayaran Gajih Pegawai', 11, 0, 7000000, 0, 1547713409, 0),
(428, '2019/01/31', 'Pengambilan Uang untuk Pribadi', 32, 8000000, 0, 0, 1547713456, 0),
(429, '2019/01/31', 'Pengambilan Uang untuk Pribadi', 11, 0, 8000000, 0, 1547713456, 0),
(432, '2019/01/31', 'Rokok Filter', 12, 800000, 0, 0, 1548113321, 12),
(433, '2019/01/31', 'Rokok Filter', 11, 200000, 0, 0, 1548113321, 12),
(434, '2019/01/31', 'Rokok Filter', 15, 0, 1000000, 0, 1548113321, 12);

-- --------------------------------------------------------

--
-- Table structure for table `db_noakun`
--

CREATE TABLE `db_noakun` (
  `id` int(11) NOT NULL,
  `no_akun` text NOT NULL,
  `nama_akun` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_noakun`
--

INSERT INTO `db_noakun` (`id`, `no_akun`, `nama_akun`) VALUES
(2, '12', 'Piutang'),
(3, '13', 'Perlengkapan'),
(4, '14', 'Sewa Dibayar Dimuka'),
(5, '15', 'Peralatan'),
(6, '19', 'Akumulasi Penyusutan'),
(7, '21', 'Hutang'),
(8, '31', 'Modal'),
(9, '32', 'Prive'),
(10, '41', 'Pendapatan'),
(11, '51', 'Beban Perlengkapan'),
(12, '52', 'Beban Gaji'),
(13, '53', 'Beban Sewa'),
(14, '54', 'Beban Listrik'),
(15, '55', 'Beban Telepon'),
(20, '11', 'Kas'),
(22, '56', 'Beban Air'),
(23, '57', 'Beban Penyusutan'),
(24, '58', 'Beban Rupa Rupa');

-- --------------------------------------------------------

--
-- Table structure for table `db_setting`
--

CREATE TABLE `db_setting` (
  `id` int(11) NOT NULL,
  `title` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `conf` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_setting`
--

INSERT INTO `db_setting` (`id`, `title`, `conf`) VALUES
(1, 'nama_usaha', 'Pt. Trijaya Fotocopy'),
(2, 'alamat', 'Jl. Akses Jambu 2, Sawangan Bogor'),
(3, 'bidang_usaha', 'Jasa Percetakan'),
(4, 'email', 'admin@trijaya.com'),
(5, 'tlp', '08561319324'),
(6, 'cur', 'Indonesia Rupiah'),
(7, 'cur_id', 'IDR'),
(8, 'symbol', 'Rp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_jurnalumum`
--
ALTER TABLE `db_jurnalumum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_noakun`
--
ALTER TABLE `db_noakun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_setting`
--
ALTER TABLE `db_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_jurnalumum`
--
ALTER TABLE `db_jurnalumum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435;
--
-- AUTO_INCREMENT for table `db_noakun`
--
ALTER TABLE `db_noakun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `db_setting`
--
ALTER TABLE `db_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
