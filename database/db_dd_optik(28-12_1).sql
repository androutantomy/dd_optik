-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2020 at 03:21 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dd_optik`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_cairan`
--

CREATE TABLE `data_cairan` (
  `id` int(11) NOT NULL,
  `id_cairan` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1:gudang 2:toko',
  `id_toko` int(11) NOT NULL COMMENT '0:gudang',
  `stok` int(11) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_cairan`
--

INSERT INTO `data_cairan` (`id`, `id_cairan`, `status`, `id_toko`, `stok`, `tanggal_update`) VALUES
(2, 1, 1, 0, 2, '2020-11-19 11:23:01'),
(8, 1, 2, 1, 4, '2020-11-21 12:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `data_frame`
--

CREATE TABLE `data_frame` (
  `id` int(11) NOT NULL,
  `id_frame` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1: gudang 2: toko',
  `id_toko` int(11) NOT NULL COMMENT '0:gudang',
  `stok` int(11) NOT NULL,
  `harga_jual` varchar(20) NOT NULL,
  `harga_beli` varchar(20) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_frame`
--

INSERT INTO `data_frame` (`id`, `id_frame`, `status`, `id_toko`, `stok`, `harga_jual`, `harga_beli`, `tanggal_update`) VALUES
(3, 3, 1, 1, 2, '', '', '2020-11-21 09:56:07'),
(6, 3, 2, 1, 2, '', '', '2020-11-21 12:27:33'),
(7, 4, 1, 3, 9, '', '', '2020-11-29 08:12:21'),
(8, 5, 1, 0, 100, '', '', '2020-12-08 12:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `data_lensa`
--

CREATE TABLE `data_lensa` (
  `id` int(11) NOT NULL,
  `id_lensa` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1:gudang 2:toko',
  `id_toko` int(11) NOT NULL COMMENT '0:gudang',
  `stok` int(11) NOT NULL,
  `type_lensa` int(11) NOT NULL,
  `sph` varchar(30) DEFAULT NULL,
  `cyl` varchar(30) DEFAULT NULL,
  `addl` varchar(30) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_lensa`
--

INSERT INTO `data_lensa` (`id`, `id_lensa`, `status`, `id_toko`, `stok`, `type_lensa`, `sph`, `cyl`, `addl`, `tanggal_update`) VALUES
(2, 1, 1, 0, 3, 3, '', '', '', '2020-11-21 06:59:44'),
(3, 2, 1, 0, 14, 1, '', '', '', '2020-11-21 10:04:00'),
(4, 2, 1, 0, 2, 5, '', '', '', '2020-11-21 13:31:06'),
(6, 1, 1, 0, 1, 4, '', '', '', '2020-11-21 13:37:32'),
(7, 1, 1, 0, 15, 2, '', '', '', '2020-11-29 08:11:32'),
(8, 3, 1, 0, 14, 4, '12', '4', '2,5', '2020-12-19 08:12:19'),
(9, 3, 1, 0, 6, 3, '2', '1,5', '2,5', '2020-12-19 08:38:55'),
(15, 5, 1, 0, 1, 3, '1', '2', '1,5', '2020-12-21 03:22:26'),
(16, 0, 1, 0, 2, 3, '1,5', '1', '2,5', '2020-12-23 13:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `data_softlense`
--

CREATE TABLE `data_softlense` (
  `id` int(11) NOT NULL,
  `id_softlense` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1: gudang, 2:toko',
  `id_toko` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `sph` varchar(10) NOT NULL,
  `cyl` varchar(10) NOT NULL,
  `addl` varchar(10) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_softlense`
--

INSERT INTO `data_softlense` (`id`, `id_softlense`, `status`, `id_toko`, `stok`, `sph`, `cyl`, `addl`, `tanggal_update`) VALUES
(1, 2, 1, 0, 10, '', '', '', '2020-12-23 13:49:15'),
(2, 2, 1, 0, 11, '1,3', '1,3', '1', '2020-12-23 13:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `master_cairan`
--

CREATE TABLE `master_cairan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga_beli` varchar(15) NOT NULL,
  `harga_jual` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_cairan`
--

INSERT INTO `master_cairan` (`id`, `nama`, `harga_beli`, `harga_jual`) VALUES
(1, 'A+ Cairan', '1500', '2000'),
(3, 'A Biasa', '800', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `master_frame`
--

CREATE TABLE `master_frame` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga_beli` varchar(15) NOT NULL,
  `harga_jual` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_frame`
--

INSERT INTO `master_frame` (`id`, `nama`, `harga_beli`, `harga_jual`) VALUES
(3, 'Loiue Viuton', '10000', '12000'),
(4, 'Lavender', '5000', '8000'),
(5, 'Tag Heuer', '200000', '300000'),
(6, 'hahaha', '500000', '70000');

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_barang`
--

CREATE TABLE `master_jenis_barang` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_jenis_barang`
--

INSERT INTO `master_jenis_barang` (`id`, `nama_kategori`) VALUES
(1, 'Lensa'),
(6, 'Frame'),
(7, 'Softlens');

-- --------------------------------------------------------

--
-- Table structure for table `master_lensa`
--

CREATE TABLE `master_lensa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tipe_lensa` int(11) DEFAULT NULL,
  `harga_beli` varchar(15) NOT NULL,
  `harga_jual` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_lensa`
--

INSERT INTO `master_lensa` (`id`, `nama`, `tipe_lensa`, `harga_beli`, `harga_jual`) VALUES
(1, 'Biasa single', NULL, '0', '12000'),
(3, 'Kriptok', 2, '200000', '70000'),
(5, 'Aquas Multi', 2, '450000', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `master_softlense`
--

CREATE TABLE `master_softlense` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga_beli` varchar(15) NOT NULL,
  `harga_jual` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_softlense`
--

INSERT INTO `master_softlense` (`id`, `nama`, `harga_beli`, `harga_jual`) VALUES
(2, 'Softlense Baru', '45000', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `master_toko`
--

CREATE TABLE `master_toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_toko`
--

INSERT INTO `master_toko` (`id`, `nama_toko`, `alamat`, `telp`, `logo`) VALUES
(1, 'Toko A', 'alamat toko a', '0855555555', 'http://localhost/dd_optik-master/uploads/logo/_114557.jpg'),
(3, 'Toko C', 'alamat toko c', '2147483647', 'http://localhost/dd-optik/uploads/logo/Toko_C_170824.png'),
(5, 'OPTIK 66', 'Jl Pramuka', '2147483647', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_user_level`
--

CREATE TABLE `master_user_level` (
  `id` int(5) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_user_level`
--

INSERT INTO `master_user_level` (`id`, `nama_level`) VALUES
(3, 'Superadmin'),
(4, 'Admin Toko'),
(5, 'Penjaga toko');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `id_jenis_barang` int(11) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `uang_muka` varchar(15) NOT NULL,
  `sisa` varchar(15) NOT NULL,
  `tanggal_nota` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` text NOT NULL,
  `bukti_pembelian` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `nama`, `alamat`, `telp`, `id_jenis_barang`, `harga`, `uang_muka`, `sisa`, `tanggal_nota`, `keterangan`, `bukti_pembelian`) VALUES
(1, 'mamamamama', '', '', 0, '', '', '', '2020-12-17 08:57:38', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(15) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `lsph` varchar(15) NOT NULL,
  `lcyl` varchar(15) NOT NULL,
  `laxis` varchar(15) NOT NULL,
  `ladd` varchar(15) NOT NULL,
  `rsph` varchar(50) NOT NULL,
  `rcyl` varchar(50) NOT NULL,
  `raxis` varchar(50) NOT NULL,
  `radd` varchar(50) NOT NULL,
  `pd_jauh` varchar(15) NOT NULL,
  `pd_dekat` varchar(15) NOT NULL,
  `id_frame` int(11) NOT NULL,
  `id_lensa` int(11) NOT NULL,
  `nama_frame` varchar(50) DEFAULT NULL,
  `nama_lensa` varchar(50) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `harga_keterangan` varchar(15) NOT NULL DEFAULT '0',
  `potongan_frame` varchar(15) NOT NULL DEFAULT '0',
  `potongan_lensa` varchar(15) NOT NULL DEFAULT '0',
  `harga_frame` varchar(15) NOT NULL DEFAULT '0',
  `harga_lensa` varchar(15) NOT NULL DEFAULT '0',
  `uang_muka` varchar(15) NOT NULL,
  `sisa` varchar(15) NOT NULL,
  `tipe_pembelian` int(11) NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tanggal_nota` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_bpjs` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1: selesai 2: menunngu lensa 3:lensa sampai\r\n',
  `id_toko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `nama`, `alamat`, `telp`, `lsph`, `lcyl`, `laxis`, `ladd`, `rsph`, `rcyl`, `raxis`, `radd`, `pd_jauh`, `pd_dekat`, `id_frame`, `id_lensa`, `nama_frame`, `nama_lensa`, `keterangan`, `harga_keterangan`, `potongan_frame`, `potongan_lensa`, `harga_frame`, `harga_lensa`, `uang_muka`, `sisa`, `tipe_pembelian`, `tgl_selesai`, `tanggal_nota`, `is_bpjs`, `status`, `id_toko`) VALUES
(1, 'Tomy ', 'Jl. kemiri cand', '094817383737', '2', '3', '2,3', '1,9', '2', '3', '2,4', '2', '2,2', '1', 3, 2, NULL, '', 'Dikurangin bagian atas', '10000', '0', '0', '12000', '12000', '34000', '0', 1, '2020-12-03', '2020-11-28 11:43:42', '0000-00-00 00:00:00', 0, 0),
(2, 'Biasa single', 'yogyakarta', '6281227058001', '-1.00', '-2.00', '90', '2.00', '-0.75', '-1.00', '90', '2.00', '65', '63', 3, 2, NULL, '', '', '0', '0', '0', '12000', '12000', '12000', '', 1, '2020-12-12', '2020-12-15 08:35:44', '0000-00-00 00:00:00', 0, 0),
(3, 'Biasa single', 'bjh', 'jghjgug', '-10', '-10', '', '-10', '-10', '-10', '', '-10', '65', '65', 3, 6, NULL, '', '', '0', '10000', '10000', '12000', '12000', '10000', '', 1, '2020-12-18', '2020-12-15 08:50:57', '0000-00-00 00:00:00', 0, 0),
(14, 'Tomy UMKM', 'alamat toko a', '094817383737', '-10', '-10', '', '-10', '-10', '-10', '', '-10', '', '', 3, 15, NULL, '', '', '100000', '10000', '50000', '12000', '500000', '150000', '402000', 2, '2020-12-18', '2020-12-19 14:38:20', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_barang`
--

CREATE TABLE `penjualan_barang` (
  `id` int(11) NOT NULL,
  `id_jenis` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` varchar(4) NOT NULL,
  `sph` varchar(10) DEFAULT NULL,
  `nominal` varchar(15) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_barang`
--

INSERT INTO `penjualan_barang` (`id`, `id_jenis`, `nama`, `nama_barang`, `alamat`, `telp`, `id_barang`, `qty`, `sph`, `nominal`, `id_toko`, `tgl_transaksi`) VALUES
(1, 2, 'Tomy Belanja softlense', '0', 'waingapu', '084937173737', 2, '5', '1,2', '250000', 0, '2020-12-24 04:25:05'),
(2, 1, 'Tomy Belanja Cairan', 'A+ Cairan', 'waingapu, hambala', '085647382617', 2, '1', '', '2000', 0, '2020-12-24 12:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_lensa`
--

CREATE TABLE `pesan_lensa` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `tgl_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL COMMENT '0: pesan 1: selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL COMMENT 'jika superadmin nilai nya 0',
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL COMMENT 'pakai sha1(md5())',
  `logo` varchar(200) NOT NULL COMMENT 'folder images/foto_profil/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `id_toko`, `nama_lengkap`, `username`, `password`, `logo`) VALUES
(1, 3, 1, 'MAHADHIKA DARMA KUSUMA', 'admin', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'http://localhost/dd_optik-master/assets/images/foto_profil/_055101.jpg'),
(2, 5, 3, 'aman aman aman', 'yanto', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'http://localhost/dd_optik-master/assets/images/foto_profil/_102538.jpg'),
(4, 4, 1, 'dwooooooo', 'zzz', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'http://localhost/dd_optik-master/assets/images/foto_profil/_102632.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_cairan`
--
ALTER TABLE `data_cairan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_frame`
--
ALTER TABLE `data_frame`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_lensa`
--
ALTER TABLE `data_lensa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_softlense`
--
ALTER TABLE `data_softlense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_cairan`
--
ALTER TABLE `master_cairan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_frame`
--
ALTER TABLE `master_frame`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_lensa`
--
ALTER TABLE `master_lensa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_softlense`
--
ALTER TABLE `master_softlense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_toko`
--
ALTER TABLE `master_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_user_level`
--
ALTER TABLE `master_user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_barang`
--
ALTER TABLE `penjualan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_lensa`
--
ALTER TABLE `pesan_lensa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_cairan`
--
ALTER TABLE `data_cairan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_frame`
--
ALTER TABLE `data_frame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_lensa`
--
ALTER TABLE `data_lensa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_softlense`
--
ALTER TABLE `data_softlense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_cairan`
--
ALTER TABLE `master_cairan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_frame`
--
ALTER TABLE `master_frame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_lensa`
--
ALTER TABLE `master_lensa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_softlense`
--
ALTER TABLE `master_softlense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_toko`
--
ALTER TABLE `master_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_user_level`
--
ALTER TABLE `master_user_level`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penjualan_barang`
--
ALTER TABLE `penjualan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan_lensa`
--
ALTER TABLE `pesan_lensa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
