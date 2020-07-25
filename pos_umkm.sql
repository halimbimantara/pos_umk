-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2020 at 06:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_umkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_kode_cetak`
--

CREATE TABLE `data_kode_cetak` (
  `id` int(11) NOT NULL,
  `id_cetak` varchar(2) NOT NULL,
  `cetak` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_kode_cetak`
--

INSERT INTO `data_kode_cetak` (`id`, `id_cetak`, `cetak`) VALUES
(1, 'CT', 'Cetak'),
(2, 'JL', 'Kasir'),
(3, 'BL', 'Pembelian'),
(4, 'BJ', 'Pengeluaran'),
(5, 'BR', 'Barang Rusak');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id` int(11) NOT NULL,
  `foto` varchar(256) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `kota` varchar(128) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tgl_masuk` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`id`, `foto`, `nama`, `alamat`, `kota`, `phone`, `username`, `password`, `tgl_masuk`, `level_id`, `aktif`) VALUES
(2, 'avatar.jpg', 'Bagos', 'Durian', 'Jakarta', '08256943245', 'Kasir', '$2y$10$UPuyaJmDVxIDTNylqK.eGu7EgOOy2MAv/RPa7xXHQtpM.1MyKqV9a', 1584098793, 2, 1),
(3, 'avatar.jpg', 'Selamet', 'Surabaya', '', '', 'Manager', '$2y$10$ZLkJfgiakApES3dN3T5NS.J6zhArc3a1M6yiOyodfbrEcFh.9Jrki', 1584105618, 4, 1),
(21, 'helloween.jpg', 'Dimas Andika', 'Semangka', 'Surabaya', '08145689555', 'Dimas', '$2y$10$x9j2l6cK0Qj3LbvI.1KWWOxEFPSo1Vy4k/klJmiiONzPIhsVho4/m', 1586276213, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggan`
--

CREATE TABLE `data_pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `kelurahan` varchar(128) NOT NULL,
  `kota` varchar(128) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_pelanggan`
--

INSERT INTO `data_pelanggan` (`id`, `nama`, `alamat`, `kelurahan`, `kota`, `phone`) VALUES
(1, 'Atik Sembiring', 'duku 15', 'Kejengkol', 'Surabaya', '08165487666'),
(2, 'Anton Tonaya', 'jagung 67', 'Hantu Tengah', 'Godam', '08165485555'),
(3, 'Anisa Suwing', 'Rambuta Panjang 45', 'Buahan', 'Gunukan', '08165487666'),
(4, 'Katijah Fatijah', 'Semangka 7', 'Lantungan', 'Surabaya', '08165487666'),
(5, 'Firnanda Siaman', 'Appel 1', 'Pontang', 'Surabaya', '08165485555'),
(6, 'Adinda Siapa', 'Pisang 2', 'Jati Lawas', 'Surabaya', '08165485555'),
(7, 'Nona Gombel', 'Gombel 9', 'Dantrasan', 'Surabaya', '08165487666');

-- --------------------------------------------------------

--
-- Table structure for table `data_suplier`
--

CREATE TABLE `data_suplier` (
  `id_suplier` int(5) NOT NULL,
  `nama_suplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_suplier`
--

INSERT INTO `data_suplier` (`id_suplier`, `nama_suplier`, `alamat`, `keterangan`) VALUES
(1, 'PT Abadi Jaya Telur', 'Jl A Yani No 90 Sindang Laya', 'suplier makanan');

-- --------------------------------------------------------

--
-- Stand-in structure for view `get_produk`
-- (See below for the actual view)
--
CREATE TABLE `get_produk` (
`kd_produk` varchar(50)
,`kd_barcode` varchar(100)
,`nama_produk` varchar(100)
,`gambar` varchar(255)
,`harga_promo` double
,`harga_grosir` double
,`batas_grosir` int(5)
,`harga_eceran` double
,`stok` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `get_produk_stok`
-- (See below for the actual view)
--
CREATE TABLE `get_produk_stok` (
`kd_produk` varchar(50)
,`kd_barcode` varchar(100)
,`nama_produk` varchar(100)
,`gambar` varchar(255)
,`harga_promo` double
,`harga_grosir` double
,`batas_grosir` int(5)
,`harga_eceran` double
,`stok` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `jual_harga_jual`
--

CREATE TABLE `jual_harga_jual` (
  `id` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `barcode` varchar(128) NOT NULL,
  `item` varchar(128) NOT NULL,
  `isi_grosir` varchar(128) NOT NULL,
  `harga_grosir` varchar(128) NOT NULL,
  `isi_eceran` varchar(128) NOT NULL,
  `harga_eceran` varchar(128) NOT NULL,
  `isi_satuan` varchar(128) NOT NULL,
  `harga_satuan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jual_harga_jual`
--

INSERT INTO `jual_harga_jual` (`id`, `image`, `barcode`, `item`, `isi_grosir`, `harga_grosir`, `isi_eceran`, `harga_eceran`, `isi_satuan`, `harga_satuan`) VALUES
(1, '', '', 'Aqua galon', '5', '14500', '1', '15000', '', ''),
(2, '', '', 'Aqua 1500', '12', '78000', '1', '9000', '', ''),
(3, '', '', 'Aqua 300', '24', '78000', '1', '4000', '', ''),
(4, '', '', 'Aqua Gelas', '48', '52000', '1', '1500', '', ''),
(5, '', '', 'Indomie Kare Ayam', '40', '35000', '1', '1250', '', ''),
(6, '', '', 'Indomie Ayang Pedas', '40', '36000', '1', '1300', '', ''),
(7, '', '', 'Indomie rasa soto', '40', '34000', '1', '1250', '', ''),
(8, '', '', 'supermie', '40', '35000', '1', '1250', '', ''),
(9, '', '', 'supermie Hot Pedas', '40', '38000', '1', '1500', '', ''),
(10, '', '', 'Supermie Rasa Bawang', '40', '35000', '1', '1300', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `master_delivery`
--

CREATE TABLE `master_delivery` (
  `id_delivery` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tarif` double NOT NULL,
  `jarak` double NOT NULL COMMENT 'Satuan KM',
  `create_date` date NOT NULL,
  `modified_date` date DEFAULT NULL,
  `create_by` int(3) DEFAULT NULL,
  `modified_by` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_delivery`
--

INSERT INTO `master_delivery` (`id_delivery`, `nama`, `tarif`, `jarak`, `create_date`, `modified_date`, `create_by`, `modified_by`) VALUES
(1, 'Potongan Ongkir Belanja 100.000', 1000, 1, '2020-04-25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_margin`
--

CREATE TABLE `master_margin` (
  `id` int(10) NOT NULL,
  `margin` double NOT NULL DEFAULT 0,
  `create_date` timestamp NULL DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_margin`
--

INSERT INTO `master_margin` (`id`, `margin`, `create_date`, `create_by`) VALUES
(1, 10, '2020-06-25 22:54:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_pembelian`
--

CREATE TABLE `master_pembelian` (
  `id_pembelian` int(12) NOT NULL,
  `kd_trx_pembelian` varchar(50) NOT NULL,
  `total_pembelian` double NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user yang menambah',
  `keterangan` text NOT NULL,
  `id_suplier` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`id_pembelian`, `kd_trx_pembelian`, `total_pembelian`, `created_date`, `created_by`, `keterangan`, `id_suplier`) VALUES
(1, 'BL200622201132', 580000, '2020-06-22 20:12:08', 21, '-', 1),
(2, 'BL200622201131', 290000, '2020-06-22 20:12:41', 21, '-', 1),
(3, 'BL200522063431', 200000, '2020-06-22 20:12:41', 21, '-', 1),
(16, 'BL200725102039', 200000, '2020-07-25 10:20:55', 21, '-', 1),
(17, 'BL200725102236', 400000, '2020-07-25 10:22:53', 21, '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_penjualan`
--

CREATE TABLE `master_penjualan` (
  `id_pembelian` int(12) NOT NULL DEFAULT 0,
  `kd_trx_penjualan` varchar(50) NOT NULL,
  `total_penjualan` double NOT NULL,
  `ongkir` double NOT NULL DEFAULT 0 COMMENT 'apabila ada ongkir',
  `diskon_nota` double NOT NULL,
  `delivery` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 Tidak 1 Ya',
  `id_pelanggan` int(5) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `id_kasir` int(5) NOT NULL,
  `keterangan` text NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user yang menambah',
  `created_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_produk`
--

CREATE TABLE `master_produk` (
  `kd_produk` varchar(50) NOT NULL,
  `kd_barcode` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `promo` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 aktif 0 tidak',
  `harga_promo` double NOT NULL DEFAULT 0,
  `gambar_produk` varchar(255) NOT NULL,
  `kd_satuan` int(2) DEFAULT NULL,
  `batas_grosir` int(5) NOT NULL DEFAULT 0,
  `harga_grosir` double NOT NULL DEFAULT 0,
  `eceran` int(5) NOT NULL,
  `harga_eceran` double NOT NULL DEFAULT 0,
  `stok` int(5) NOT NULL DEFAULT 0,
  `batas_min_stok` int(5) NOT NULL DEFAULT 0,
  `batas_max_stok` int(5) NOT NULL DEFAULT 0,
  `created_date` date NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `modified_by` int(5) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_produk`
--

INSERT INTO `master_produk` (`kd_produk`, `kd_barcode`, `nama_produk`, `id_kategori`, `promo`, `harga_promo`, `gambar_produk`, `kd_satuan`, `batas_grosir`, `harga_grosir`, `eceran`, `harga_eceran`, `stok`, `batas_min_stok`, `batas_max_stok`, `created_date`, `create_by`, `modified_by`, `keterangan`) VALUES
('8992222055499', '8992222055499', 'Styling Pomade', NULL, 0, 0, '', NULL, 10, 13400, 0, 14000, 0, 40, 100, '2020-07-19', 0, NULL, NULL),
('8992771002975', '8992771002975', 'Pigeon Baby Lotion', NULL, 0, 0, '', NULL, 10, 15500, 0, 16000, 0, 15, 15, '2020-07-19', 0, NULL, NULL),
('8993137681551', '8993137681551', 'Wardah Roll on', NULL, 0, 0, '', NULL, 12, 9000, 0, 10000, 0, 10, 60, '2020-07-19', 0, NULL, NULL),
('AQ00012', '09121092012', 'Aqua Gelas Dus', 1, 0, 0, '', 2, 10, 24000, 0, 0, 0, 5, 20, '2020-06-25', 0, NULL, NULL),
('BRS0001', '9786020814254', 'Beras Bramo 25Kg', 1, 0, 0, 'photo4.jpg', 1, 10, 55000, 1, 58000, 15, 0, 0, '2020-05-01', 1, 0, 'Beras Kualitas bramo 25kg'),
('LP00D1', 'M194467', 'Lampu Dobel Rem Belakang', 1, 0, 0, '-', 1, 10, 25000, 1, 27000, 0, 10, 50, '2020-05-14', 1, NULL, NULL);

--
-- Triggers `master_produk`
--
DELIMITER $$
CREATE TRIGGER `before_produk_update` AFTER UPDATE ON `master_produk` FOR EACH ROW BEGIN
    INSERT INTO trx_history_harga_jual
    set kd_produk = OLD.kd_produk,
    harga=new.harga_eceran,
    modified_by = new.modified_by,
    tanggal_modified = CURDATE();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_id`, `role`) VALUES
(1, 1, 'Pegawai'),
(2, 2, 'Kasir'),
(3, 3, 'Kabag'),
(4, 4, 'CEO');

-- --------------------------------------------------------

--
-- Table structure for table `role_akses`
--

CREATE TABLE `role_akses` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL,
  `info` text NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_akses`
--

INSERT INTO `role_akses` (`id`, `role_id`, `menu_id`, `submenu_id`, `info`, `aktif`) VALUES
(1, 1, 1, 1, '', 1),
(2, 1, 1, 2, '', 1),
(3, 1, 1, 3, '', 1),
(4, 1, 2, 1, '', 1),
(5, 1, 2, 2, '', 1),
(6, 1, 2, 3, '', 1),
(7, 1, 3, 1, '', 1),
(8, 1, 3, 2, '', 1),
(9, 1, 3, 3, '', 1),
(10, 1, 4, 1, '', 1),
(11, 1, 4, 2, '', 1),
(12, 1, 4, 3, '', 1),
(13, 1, 5, 1, '', 1),
(14, 1, 5, 2, '', 1),
(15, 1, 5, 3, '', 1),
(16, 2, 1, 1, '', 1),
(17, 2, 1, 2, '', 1),
(18, 2, 1, 3, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`id`, `menu_id`, `menu`) VALUES
(1, 1, 'PENJUALAN'),
(2, 2, 'PEMBELIAN'),
(3, 3, 'STOK'),
(4, 4, 'PEGAWAI'),
(5, 5, 'PEMBUKUAN'),
(6, 6, 'SETTING');

-- --------------------------------------------------------

--
-- Table structure for table `role_submenu`
--

CREATE TABLE `role_submenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_submenu`
--

INSERT INTO `role_submenu` (`id`, `menu_id`, `submenu`, `url`, `icon`) VALUES
(1, 1, 'Kasir', 'jual_kasir', 'far fa-circle'),
(2, 1, 'Harga Jual', '', ''),
(3, 1, 'Pelanggan', '', ''),
(4, 2, 'Pembelian', '', ''),
(5, 2, 'Pengeluaran', '', ''),
(6, 2, 'Pemasok', '', ''),
(7, 3, 'Stok', '', ''),
(8, 3, 'Kategori', '', ''),
(9, 3, 'Kemasan', '', ''),
(10, 4, 'Data Pegawai', '', ''),
(11, 5, 'Daftar', '', ''),
(12, 6, 'Kode Cetak', '', ''),
(13, 6, 'Role', '', ''),
(14, 6, 'Role Akses', '', ''),
(15, 6, 'Menu', '', ''),
(16, 6, 'Submenu', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(5) NOT NULL,
  `nama_apps` varchar(255) NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `alamat_usaha` varchar(255) NOT NULL,
  `no_tlpn` varchar(50) NOT NULL,
  `no_wa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_apps`, `nama_usaha`, `alamat_usaha`, `no_tlpn`, `no_wa`) VALUES
(1, 'MobieCash', 'Toko Makmur Jaya Abadi', 'Jl.Cikaso, Pasir impun ,Kab .Bandung', '9090909', '085127177999');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_produk`
--

CREATE TABLE `tb_kategori_produk` (
  `id` int(11) NOT NULL,
  `kategori` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kategori_produk`
--

INSERT INTO `tb_kategori_produk` (`id`, `kategori`, `slug`) VALUES
(1, 'Minuman', 'minuman'),
(2, 'Makanan Ringan', 'makanan-ringan'),
(3, 'Makanan Kaleng', 'makanan-kaleng'),
(4, 'Bumbu Masak', 'bumbu-masak'),
(5, 'Permen', 'permen'),
(6, 'Minuman Kotak', 'minuman-kotak'),
(7, 'Minuman Kaleng', 'minuman-kaleng'),
(8, 'Mie Instan', 'mie-instan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kemasan`
--

CREATE TABLE `tb_kemasan` (
  `id` int(11) NOT NULL,
  `kd_kemasan` varchar(50) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kemasan`
--

INSERT INTO `tb_kemasan` (`id`, `kd_kemasan`, `nama`) VALUES
(1, 'sak', 'Sak'),
(2, 'box', 'Box'),
(3, 'slp', 'Slop'),
(4, 'krt', 'Karton'),
(5, 'bal', 'Bal'),
(6, 'pak', 'Pak'),
(7, 'sct', 'Sachet'),
(8, 'btl', 'Botol'),
(9, 'klg', 'Kaleng'),
(10, 'bks', 'Bungkus'),
(11, 'gln', 'Galon');

-- --------------------------------------------------------

--
-- Table structure for table `trx_history_harga_jual`
--

CREATE TABLE `trx_history_harga_jual` (
  `id_history_jual` int(10) NOT NULL,
  `kd_produk` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `tanggal_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `keterangan` text DEFAULT NULL,
  `modified_by` int(5) DEFAULT NULL COMMENT 'user yang merubah'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_history_harga_jual`
--

INSERT INTO `trx_history_harga_jual` (`id_history_jual`, `kd_produk`, `harga`, `tanggal_modified`, `keterangan`, `modified_by`) VALUES
(1, 'BRS0001', 58000, '2020-05-01 00:00:00', NULL, 0),
(2, 'BRS0001', 58000, '2020-05-01 00:00:00', NULL, 0),
(3, 'BRS0001', 58000, '2020-05-01 00:00:00', NULL, 0),
(4, 'BRS0001', 58000, '2020-05-07 00:00:00', NULL, 0),
(5, 'BRS0001', 58000, '2020-05-07 00:00:00', NULL, 0),
(6, 'BRS0001', 58000, '2020-05-14 00:00:00', NULL, 0),
(7, 'LP00D1', 27000, '2020-05-17 00:00:00', NULL, NULL),
(8, '8992222055499', 14000, '2020-07-19 00:00:00', NULL, NULL),
(9, '8992771002975', 16000, '2020-07-19 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_pembelian`
--

CREATE TABLE `trx_pembelian` (
  `id_pembelian` int(12) NOT NULL,
  `kd_trx_pembelian` varchar(50) NOT NULL,
  `kd_produk` varchar(50) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga` double NOT NULL,
  `qty` int(10) NOT NULL,
  `stok` int(5) NOT NULL,
  `total` double NOT NULL DEFAULT 0,
  `diskon` double NOT NULL DEFAULT 0,
  `kd_satuan` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_pembelian`
--

INSERT INTO `trx_pembelian` (`id_pembelian`, `kd_trx_pembelian`, `kd_produk`, `nama_barang`, `harga`, `qty`, `stok`, `total`, `diskon`, `kd_satuan`, `keterangan`, `created_date`) VALUES
(1, 'BL200622201132', 'BRS0001', 'Beras Bramo', 58000, 10, 10, 580000, 0, NULL, '', '2020-04-25'),
(2, 'BL200622201131', 'BRS0001', NULL, 58000, 5, 5, 290000, 0, NULL, '', '2020-04-25'),
(3, 'BL200522063431', 'LP00D1', 'Lampu Dobel Rem Belakang', 20000, 10, 4, 200000, 0, NULL, NULL, '2020-05-22'),
(4, 'BL200622170732', 'BRS0001', 'Beras Bramo 25Kg', 60000, 10, 10, 600000, 0, NULL, NULL, '2020-06-22'),
(5, 'BL200725100304', '8992222055499', 'Styling Pomade', 15000, 20, 17, 300000, 0, NULL, NULL, '2020-07-25'),
(6, 'BL200725102236', '8992771002975', 'Pigeon Baby Lotion', 20000, 20, 17, 400000, 0, NULL, NULL, '2020-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `trx_pembelian_temp`
--

CREATE TABLE `trx_pembelian_temp` (
  `id_pembelian` int(12) NOT NULL,
  `kd_trx_pembelian` varchar(50) NOT NULL,
  `kd_produk` varchar(50) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga` double NOT NULL,
  `qty` int(10) NOT NULL,
  `total` double NOT NULL DEFAULT 0,
  `diskon` double NOT NULL DEFAULT 0,
  `kd_satuan` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trx_penjualan`
--

CREATE TABLE `trx_penjualan` (
  `id_penjualan` int(12) NOT NULL,
  `kd_trx_penjualan` varchar(50) NOT NULL,
  `kd_produk` varchar(50) NOT NULL,
  `kd_trx_pembelian` varchar(25) NOT NULL,
  `id_pembelian` int(10) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `qty` int(10) NOT NULL,
  `total` double NOT NULL DEFAULT 0,
  `diskon` double NOT NULL DEFAULT 0,
  `kd_satuan` int(11) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_penjualan`
--

INSERT INTO `trx_penjualan` (`id_penjualan`, `kd_trx_penjualan`, `kd_produk`, `kd_trx_pembelian`, `id_pembelian`, `nama_barang`, `harga`, `qty`, `total`, `diskon`, `kd_satuan`, `created_date`) VALUES
(1, 'JL200724142106', 'BRS0001', 'BL200622201132', 0, 'Beras Bramo 25Kg', 66000, 2, 132000, 0, 0, '2020-07-24'),
(2, 'JL200724145416', 'LP00D1', 'BL200522063431', 0, 'Lampu Dobel Rem Belakang', 22000, 1, 22000, 0, 0, '2020-07-24'),
(3, 'JL200724150405', 'BRS0001', 'BL200622201132', 0, 'Beras Bramo 25Kg', 66000, 3, 198000, 0, 0, '2020-07-24'),
(4, 'JL200724150704', 'BRS0001', 'BL200622201132', 0, 'Beras Bramo 25Kg', 66000, 1, 66000, 0, 0, '2020-07-24'),
(5, 'JL200724230126', 'BRS0001', 'BL200622201131', 0, 'Beras Bramo 25Kg', 66000, 1, 66000, 0, 0, '2020-07-24'),
(6, 'JL200724230144', 'BRS0001', 'BL200622201131', 0, 'Beras Bramo 25Kg', 66000, 1, 66000, 0, 0, '2020-07-24'),
(7, 'JL200724230144', 'BRS0001', 'BL200622170732', 0, 'Beras Bramo 25Kg', 66000, 1, 66000, 0, 0, '2020-07-24'),
(8, 'JL200725102545', '8992771002975', 'BL200725102236', 0, 'Pigeon Baby Lotion', 22000, 1, 22000, 0, 0, '2020-07-25'),
(9, 'JL200725102545', '8992222055499', 'BL200725100304', 0, 'Styling Pomade', 16500, 1, 16500, 0, 0, '2020-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `trx_penjualan_tmp`
--

CREATE TABLE `trx_penjualan_tmp` (
  `id_penjualan` int(12) NOT NULL,
  `kd_trx_penjualan` varchar(50) NOT NULL,
  `kd_produk` varchar(50) NOT NULL,
  `kd_trx_pembelian` varchar(25) NOT NULL,
  `id_pembelian` int(10) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `qty` int(10) NOT NULL,
  `sub_total` double NOT NULL,
  `diskon` double NOT NULL DEFAULT 0,
  `kd_satuan` int(11) NOT NULL DEFAULT 0,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `get_produk`
--
DROP TABLE IF EXISTS `get_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_produk`  AS  select `a`.`kd_produk` AS `kd_produk`,`b`.`kd_barcode` AS `kd_barcode`,`b`.`nama_produk` AS `nama_produk`,`b`.`gambar_produk` AS `gambar`,`b`.`harga_promo` AS `harga_promo`,`b`.`harga_grosir` AS `harga_grosir`,`b`.`batas_grosir` AS `batas_grosir`,`b`.`harga_eceran` AS `harga_eceran`,sum(`a`.`stok`) AS `stok` from (`master_produk` `b` left join `trx_pembelian` `a` on(`b`.`kd_produk` = `a`.`kd_produk`)) group by `a`.`kd_produk` ;

-- --------------------------------------------------------

--
-- Structure for view `get_produk_stok`
--
DROP TABLE IF EXISTS `get_produk_stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_produk_stok`  AS  select `b`.`kd_produk` AS `kd_produk`,`b`.`kd_barcode` AS `kd_barcode`,`b`.`nama_produk` AS `nama_produk`,`b`.`gambar_produk` AS `gambar`,`b`.`harga_promo` AS `harga_promo`,`b`.`harga_grosir` AS `harga_grosir`,`b`.`batas_grosir` AS `batas_grosir`,`b`.`harga_eceran` AS `harga_eceran`,sum(`a`.`stok`) AS `stok` from (`master_produk` `b` left join `trx_pembelian` `a` on(`b`.`kd_produk` = `a`.`kd_produk`)) group by `a`.`kd_produk` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_kode_cetak`
--
ALTER TABLE `data_kode_cetak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_suplier`
--
ALTER TABLE `data_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jual_harga_jual`
--
ALTER TABLE `jual_harga_jual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_delivery`
--
ALTER TABLE `master_delivery`
  ADD PRIMARY KEY (`id_delivery`);

--
-- Indexes for table `master_margin`
--
ALTER TABLE `master_margin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pembelian`
--
ALTER TABLE `master_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `master_produk`
--
ALTER TABLE `master_produk`
  ADD PRIMARY KEY (`kd_produk`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_akses`
--
ALTER TABLE `role_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_submenu`
--
ALTER TABLE `role_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kemasan`
--
ALTER TABLE `tb_kemasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_history_harga_jual`
--
ALTER TABLE `trx_history_harga_jual`
  ADD PRIMARY KEY (`id_history_jual`);

--
-- Indexes for table `trx_pembelian`
--
ALTER TABLE `trx_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `trx_pembelian_temp`
--
ALTER TABLE `trx_pembelian_temp`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `trx_penjualan`
--
ALTER TABLE `trx_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `trx_penjualan_tmp`
--
ALTER TABLE `trx_penjualan_tmp`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_kode_cetak`
--
ALTER TABLE `data_kode_cetak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_suplier`
--
ALTER TABLE `data_suplier`
  MODIFY `id_suplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jual_harga_jual`
--
ALTER TABLE `jual_harga_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_delivery`
--
ALTER TABLE `master_delivery`
  MODIFY `id_delivery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_margin`
--
ALTER TABLE `master_margin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_pembelian`
--
ALTER TABLE `master_pembelian`
  MODIFY `id_pembelian` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_akses`
--
ALTER TABLE `role_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_submenu`
--
ALTER TABLE `role_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kemasan`
--
ALTER TABLE `tb_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trx_history_harga_jual`
--
ALTER TABLE `trx_history_harga_jual`
  MODIFY `id_history_jual` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trx_pembelian`
--
ALTER TABLE `trx_pembelian`
  MODIFY `id_pembelian` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trx_pembelian_temp`
--
ALTER TABLE `trx_pembelian_temp`
  MODIFY `id_pembelian` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_penjualan`
--
ALTER TABLE `trx_penjualan`
  MODIFY `id_penjualan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trx_penjualan_tmp`
--
ALTER TABLE `trx_penjualan_tmp`
  MODIFY `id_penjualan` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
