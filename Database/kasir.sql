-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2025 at 06:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `DetailID` int(11) NOT NULL,
  `PenjualanID` int(11) NOT NULL,
  `ProdukID` int(11) NOT NULL,
  `JumlahProduk` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`DetailID`, `PenjualanID`, `ProdukID`, `JumlahProduk`, `Subtotal`, `update_at`) VALUES
(1, 1, 13578016, 2, 36000.00, '2025-02-08 05:15:34'),
(2, 13575001, 13578015, 3, 114000.00, '2025-02-08 05:22:22'),
(3, 13575002, 13578074, 4, 72000.00, '2025-02-08 07:40:01'),
(4, 13575003, 13578007, 2, 56000.00, '2025-02-08 08:49:30'),
(5, 13575003, 13578038, 4, 80000.00, '2025-02-08 08:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `PelangganID` int(11) NOT NULL,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` varchar(15) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`PelangganID`, `NamaPelanggan`, `Alamat`, `NomorTelepon`, `update_at`) VALUES
(802054234, 'Muhammad Udin', 'Yogyakarta, Central Java, ID', '08912345678', '2025-02-08 04:42:58'),
(802060240, 'Ahmad Khoi', 'Bandung, West Java, ID', '081234567890', '2025-02-08 05:03:09'),
(802120738, 'Daffa Suprianto', 'Semarang, Central Java, ID', '08912345678', '2025-02-08 05:07:55'),
(802121228, 'Ahmad Subarjo', 'Yogyakarta, Central Java, ID', '081234567888', '2025-02-08 05:12:47'),
(802121455, 'Muhammad Udin', 'Yogyakarta, Central Java, ID', '081234567888', '2025-02-08 05:15:11'),
(802143930, 'Fauzy Saputra', 'Bandung, West Java, ID', '08912345678', '2025-02-08 07:39:46'),
(802154843, 'Daffa Suprianto', 'Semarang, Central Java, ID', '08912345678', '2025-02-08 08:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `PenjualanID` int(11) NOT NULL,
  `TanggalPenjualan` datetime NOT NULL,
  `TotalHarga` decimal(16,2) NOT NULL,
  `UangBayar` decimal(10,2) NOT NULL,
  `Kembalian` decimal(10,2) NOT NULL,
  `PelangganID` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`PenjualanID`, `TanggalPenjualan`, `TotalHarga`, `UangBayar`, `Kembalian`, `PelangganID`, `update_at`) VALUES
(13575001, '2025-02-08 12:14:55', 114000.00, 150000.00, 36000.00, 802121455, '2025-02-08 08:11:45'),
(13575002, '2025-02-08 14:39:30', 72000.00, 100000.00, 28000.00, 802143930, '2025-02-08 07:40:17'),
(13575003, '2025-02-08 15:48:43', 136000.00, 150000.00, 14000.00, 802154843, '2025-02-08 08:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `level`, `update_at`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2025-02-02 05:26:52'),
(3, 'Petugas', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 2, '2025-02-02 05:26:52'),
(7, 'Muhammad Udin', 'udin', '202cb962ac59075b964b07152d234b70', 2, '2025-02-08 17:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ProdukID` int(11) NOT NULL,
  `NamaProduk` varchar(255) NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `Stok` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ProdukID`, `NamaProduk`, `Harga`, `Stok`, `update_at`) VALUES
(13578001, 'Nasi Liwet', 45000.00, 34, '2025-02-08 04:40:51'),
(13578002, 'Jus Mangga', 20000.00, 22, '2025-02-08 04:41:32'),
(13578003, 'Sate Ayam Madura', 30000.00, 25, '2025-02-08 04:41:32'),
(13578004, 'Teh Tarik Aceh', 20000.00, 16, '2025-02-08 04:41:32'),
(13578005, 'Bakso Malang', 25000.00, 18, '2025-02-08 04:41:32'),
(13578006, 'Lahang (Minuman Nira)', 12000.00, 22, '2025-02-08 05:08:14'),
(13578007, 'Rujak Cingur Surabaya', 28000.00, 12, '2025-02-08 08:49:30'),
(13578008, 'Martabak Manis Bangka', 25000.00, 18, '2025-02-08 04:41:32'),
(13578009, 'Soto Medan', 32000.00, 14, '2025-02-08 04:41:32'),
(13578010, 'Bir Pletok Betawi', 15000.00, 20, '2025-02-08 04:41:32'),
(13578011, 'Nasi Liwet Solo', 25000.00, 18, '2025-02-08 04:41:32'),
(13578012, 'Kopi Tubruk', 12000.00, 25, '2025-02-08 04:41:32'),
(13578013, 'Jus Alpukat', 22000.00, 18, '2025-02-08 04:49:22'),
(13578014, 'Pecel Lele Lamongan', 22000.00, 19, '2025-02-08 05:03:31'),
(13578015, 'Ayam Taliwang Lombok', 38000.00, 9, '2025-02-08 05:22:22'),
(13578016, 'Wedang Ronde Solo', 18000.00, 15, '2025-02-08 05:15:34'),
(13578017, 'Es Kopi Susu Gula Aren', 22000.00, 17, '2025-02-08 05:03:35'),
(13578018, 'Pempek Palembang', 28000.00, 19, '2025-02-08 04:41:32'),
(13578019, 'Soto Kudus', 30000.00, 14, '2025-02-08 04:44:23'),
(13578020, 'Sirup Markisa Medan', 18000.00, 15, '2025-02-08 04:41:32'),
(13578021, 'Rawon Surabaya', 38000.00, 12, '2025-02-08 04:41:32'),
(13578022, 'Es Doger', 15000.00, 22, '2025-02-08 04:41:32'),
(13578023, 'Ayam Kalasan', 35000.00, 17, '2025-02-08 04:41:32'),
(13578024, 'Wedang Uwuh Jogja', 20000.00, 16, '2025-02-08 04:41:32'),
(13578025, 'Jus Jambu', 15000.00, 20, '2025-02-08 04:41:32'),
(13578026, 'Lontong Sayur Padang', 22000.00, 20, '2025-02-08 04:41:32'),
(13578027, 'Es Oyen Bandung', 18000.00, 18, '2025-02-08 04:41:32'),
(13578028, 'Rendang Padang', 50000.00, 17, '2025-02-08 04:44:35'),
(13578029, 'Gado-Gado Jakarta', 22000.00, 20, '2025-02-08 04:41:32'),
(13578030, 'Tahu Gejrot Cirebon', 15000.00, 22, '2025-02-08 04:41:32'),
(13578031, 'Es Cendol Bandung', 15000.00, 20, '2025-02-08 04:41:32'),
(13578032, 'Kopi Gayo Aceh', 25000.00, 9, '2025-02-08 05:08:18'),
(13578033, 'Nasi Uduk Betawi', 20000.00, 22, '2025-02-08 04:41:32'),
(13578034, 'Susu Jahe', 15000.00, 18, '2025-02-08 04:41:32'),
(13578035, 'Es Jeruk', 12000.00, 25, '2025-02-08 04:41:32'),
(13578036, 'Ayam Betutu Bali', 40000.00, 10, '2025-02-08 04:41:32'),
(13578037, 'Nasi Pecel Madiun', 18000.00, 22, '2025-02-08 04:41:32'),
(13578038, 'Es Teler', 20000.00, 15, '2025-02-08 08:49:35'),
(13578039, 'Kopi Kintamani Bali', 30000.00, 9, '2025-02-08 04:41:32'),
(13578040, 'Nasi Kuning Manado', 26000.00, 19, '2025-02-08 04:41:32'),
(13578041, 'Bandrek', 17000.00, 15, '2025-02-08 04:41:32'),
(13578042, 'Ketoprak Jakarta', 18000.00, 22, '2025-02-08 04:41:32'),
(13578043, 'Soto Banjar Kalimantan', 28000.00, 17, '2025-02-08 04:41:32'),
(13578044, 'Ikan Bakar Cianjur', 45000.00, 10, '2025-02-08 04:41:32'),
(13578045, 'Es Campur', 18000.00, 22, '2025-02-08 04:41:32'),
(13578046, 'Teh Poci Tegal', 18000.00, 18, '2025-02-08 04:41:32'),
(13578047, 'Soto Betawi', 35000.00, 15, '2025-02-08 04:41:32'),
(13578048, 'Jus Sirsak', 18000.00, 17, '2025-02-08 04:41:32'),
(13578049, 'Mie Aceh', 32000.00, 20, '2025-02-08 04:41:32'),
(13578050, 'Nasi Goreng Jawa', 25000.00, 21, '2025-02-08 04:41:32'),
(13578051, 'Kopi Toraja', 35000.00, 12, '2025-02-08 06:49:38'),
(13578052, 'Lontong Balap Surabaya', 20000.00, 29, '2025-02-08 06:49:38'),
(13578053, 'Ayam Rica-Rica Manado', 27000.00, 12, '2025-02-08 06:49:38'),
(13578054, 'Es Kuwut Bali', 15000.00, 25, '2025-02-08 06:49:38'),
(13578055, 'Nasi Grombyang Pemalang', 22000.00, 17, '2025-02-08 06:49:38'),
(13578056, 'Jus Terong Belanda', 18000.00, 22, '2025-02-08 06:49:38'),
(13578057, 'Soto Makassar', 30000.00, 16, '2025-02-08 06:49:38'),
(13578058, 'Nasi Goreng Jawa', 20000.00, 25, '2025-02-08 06:49:38'),
(13578059, 'Bubur Pedas Sambas', 20000.00, 20, '2025-02-08 06:49:38'),
(13578060, 'Tinutuan (Bubur Manado)', 23000.00, 19, '2025-02-08 06:49:38'),
(13578061, 'Gulai Ikan Patin', 28000.00, 18, '2025-02-08 06:49:38'),
(13578062, 'Sate Lilit Bali', 32000.00, 20, '2025-02-08 06:49:38'),
(13578063, 'Es Kacang Merah', 18000.00, 22, '2025-02-08 06:49:38'),
(13578064, 'Sate Kambing Tegal', 35000.00, 15, '2025-02-08 06:49:38'),
(13578065, 'Es Nona Pontianak', 20000.00, 18, '2025-02-08 06:49:38'),
(13578066, 'Kopi Aceh', 25000.00, 16, '2025-02-08 06:49:38'),
(13578067, 'Ayam Bakar Wong Solo', 30000.00, 22, '2025-02-08 06:49:38'),
(13578068, 'Binte Biluhuta Gorontalo', 28000.00, 15, '2025-02-08 06:49:38'),
(13578069, 'Kupat Tahu Magelang', 17000.00, 15, '2025-02-08 06:49:38'),
(13578070, 'Es Pisang Ijo', 25000.00, 15, '2025-02-08 06:49:38'),
(13578071, 'Nasi Campur Bali', 28000.00, 17, '2025-02-08 06:49:38'),
(13578072, 'Papeda Ikan Kuah Kuning', 30000.00, 10, '2025-02-08 06:49:38'),
(13578073, 'Nasi Tutug Oncom', 20000.00, 20, '2025-02-08 06:49:38'),
(13578074, 'Es Goyobod', 18000.00, 16, '2025-02-08 07:40:01'),
(13578075, 'Empal Gentong Cirebon', 30000.00, 14, '2025-02-08 06:49:38'),
(13578076, 'Jus Kedondong', 17000.00, 19, '2025-02-08 06:49:38'),
(13578077, 'Ayam Taliwang Lombok', 38000.00, 12, '2025-02-08 06:49:38'),
(13578078, 'Kopi Luwak', 50000.00, 8, '2025-02-08 06:49:38'),
(13578079, 'Sop Konro Makassar', 50000.00, 10, '2025-02-08 06:49:38'),
(13578080, 'Sanger Coffee', 22000.00, 20, '2025-02-08 06:49:38'),
(13578081, 'Mie Goreng Jawa', 18000.00, 30, '2025-02-08 06:49:38'),
(13578082, 'Soto Lamongan', 22000.00, 25, '2025-02-08 06:49:38'),
(13578083, 'Bajigur Bandung', 12000.00, 25, '2025-02-08 06:49:38'),
(13578084, 'Wedang Pokak', 12000.00, 30, '2025-02-08 06:49:38'),
(13578085, 'Jamu Beras Kencur', 10000.00, 35, '2025-02-08 06:49:38'),
(13578086, 'Nasi Tempong Banyuwangi', 25000.00, 18, '2025-02-08 06:49:38'),
(13578087, 'Es Kopyor', 20000.00, 18, '2025-02-08 06:49:38'),
(13578088, 'Cendol Durian', 25000.00, 20, '2025-02-08 06:49:38'),
(13578089, 'Bebek Goreng Madura', 32000.00, 18, '2025-02-08 06:49:38'),
(13578090, 'Ayam Cincane', 32000.00, 14, '2025-02-08 06:49:38'),
(13578091, 'Kerak Telor Betawi', 22000.00, 18, '2025-02-08 06:49:38'),
(13578092, 'Tahu Tek Surabaya', 15000.00, 40, '2025-02-08 06:49:38'),
(13578093, 'Jus Jambu', 15000.00, 20, '2025-02-08 06:49:38'),
(13578094, 'Soda Gembira', 15000.00, 20, '2025-02-08 06:49:38'),
(13578095, 'Sarabba Makassar', 17000.00, 19, '2025-02-08 06:49:38'),
(13578096, 'Nasi Uduk Jakarta', 12000.00, 50, '2025-02-08 06:49:38'),
(13578097, 'Rujak Cingur Surabaya', 28000.00, 14, '2025-02-08 06:49:38'),
(13578098, 'Ayam Tangkap Aceh', 35000.00, 13, '2025-02-08 06:49:38'),
(13578099, 'Lahang (Minuman Nira)', 12000.00, 23, '2025-02-08 06:49:38'),
(13578100, 'Bakmi Jawa', 25000.00, 18, '2025-02-08 07:01:00'),
(13578101, 'Nasi Gandul Pati', 22000.00, 25, '2025-02-08 07:01:00'),
(13578102, 'Es Cincau Hitam Pontianak', 15000.00, 30, '2025-02-08 07:01:00'),
(13578103, 'Bebek Sinjay Madura', 35000.00, 15, '2025-02-08 07:01:00'),
(13578104, 'Sate Maranggi Purwakarta', 28000.00, 22, '2025-02-08 07:01:00'),
(13578105, 'Jus Belimbing Depok', 17000.00, 20, '2025-02-08 07:01:00'),
(13578106, 'Ikan Asam Padeh Padang', 30000.00, 12, '2025-02-08 07:01:00'),
(13578107, 'Jamu Kunyit Asam Jawa Tengah', 12000.00, 40, '2025-02-08 07:01:00'),
(13578108, 'Sayur Asem Betawi Jakarta', 20000.00, 18, '2025-02-08 07:01:00'),
(13578109, 'Gulai Kambing Sumatra Barat', 38000.00, 12, '2025-02-08 07:01:00'),
(13578110, 'Es Campur Betawi Jakarta', 20000.00, 22, '2025-02-08 07:01:00'),
(13578111, 'Mie Titi Makassar', 25000.00, 20, '2025-02-08 07:01:00'),
(13578112, 'Pindang Patin Palembang', 28000.00, 16, '2025-02-08 07:01:00'),
(13578113, 'Wedang Angsle Malang', 18000.00, 25, '2025-02-08 07:01:00'),
(13578114, 'Pempek Lenggang Palembang', 30000.00, 15, '2025-02-08 07:01:00'),
(13578115, 'Coto Makassar', 35000.00, 14, '2025-02-08 07:01:00'),
(13578116, 'Jus Sawo Jakarta', 16000.00, 24, '2025-02-08 07:01:00'),
(13578117, 'Nasi Krawu Gresik', 25000.00, 18, '2025-02-08 07:01:00'),
(13578118, 'Es Legen Tuban', 15000.00, 22, '2025-02-08 07:01:00'),
(13578119, 'Soto Sokaraja Banyumas', 28000.00, 15, '2025-02-08 07:01:00'),
(13578120, 'Kopi Sanger Aceh', 18000.00, 23, '2025-02-08 07:01:00'),
(13578121, 'Ikan Bakar Manado', 45000.00, 12, '2025-02-08 07:01:00'),
(13578122, 'Tahu Sumedang', 12000.00, 35, '2025-02-08 07:01:00'),
(13578123, 'Nasi Kapau Bukittinggi', 32000.00, 17, '2025-02-08 07:01:00'),
(13578124, 'Es Podeng Jakarta', 17000.00, 18, '2025-02-08 07:01:00'),
(13578125, 'Buntil Jawa Tengah', 20000.00, 20, '2025-02-08 07:01:00'),
(13578126, 'Ronde Jahe Semarang', 12000.00, 25, '2025-02-08 07:01:00'),
(13578127, 'Dawet Ireng Purworejo', 15000.00, 28, '2025-02-08 07:01:00'),
(13578128, 'Nasi Bebek Surabaya', 28000.00, 16, '2025-02-08 07:01:00'),
(13578129, 'Serabi Notosuman Solo', 18000.00, 30, '2025-02-08 07:01:00'),
(13578130, 'Es Lilin Bandung', 10000.00, 35, '2025-02-08 07:01:00'),
(13578131, 'Ayam Goreng Kalasan Yogyakarta', 32000.00, 15, '2025-02-08 07:01:00'),
(13578132, 'Sate Klathak Yogyakarta', 28000.00, 12, '2025-02-08 07:01:00'),
(13578133, 'Jus Melon Surabaya', 14000.00, 25, '2025-02-08 07:01:00'),
(13578134, 'Lontong Tuyuhan Rembang', 25000.00, 15, '2025-02-08 07:01:00'),
(13578135, 'Es Kunyit Asam Jawa Barat', 12000.00, 30, '2025-02-08 07:01:00'),
(13578136, 'Cimplung Tasikmalaya', 15000.00, 22, '2025-02-08 07:01:00'),
(13578137, 'Nasi Ceker Malang', 22000.00, 18, '2025-02-08 07:01:00'),
(13578138, 'Teh Talua Padang', 15000.00, 25, '2025-02-08 07:01:00'),
(13578139, 'Udang Galah Bakar Riau', 45000.00, 12, '2025-02-08 07:01:00'),
(13578140, 'Otak-Otak Palembang', 18000.00, 28, '2025-02-08 07:01:00'),
(13578141, 'Asinan Bogor', 16000.00, 20, '2025-02-08 07:01:00'),
(13578142, 'Es Gempol Semarang', 15000.00, 23, '2025-02-08 07:01:00'),
(13578143, 'Jus Sirsak Jakarta', 18000.00, 25, '2025-02-08 07:01:00'),
(13578144, 'Bakwan Malang', 25000.00, 18, '2025-02-08 07:01:00'),
(13578145, 'Ayam Penyet Surabaya', 22000.00, 20, '2025-02-08 07:01:00'),
(13578146, 'Es Jeruk Kunci Bangka Belitung', 14000.00, 22, '2025-02-08 07:01:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`DetailID`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`PelangganID`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`PenjualanID`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ProdukID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `PenjualanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13575004;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ProdukID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13578147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
