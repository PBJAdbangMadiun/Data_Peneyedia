-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 04:55 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pendataan`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `merek`, `status`) VALUES
(5, 'alat 1', 'merek 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alat_pekerjaan`
--

CREATE TABLE `alat_pekerjaan` (
  `id` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_pekerjaan`
--

INSERT INTO `alat_pekerjaan` (`id`, `id_alat`, `id_pekerjaan`) VALUES
(11, 3, 3),
(12, 5, 3),
(14, 3, 4),
(15, 5, 4),
(16, 3, 5),
(18, 5, 6),
(22, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `pendidikan`, `alamat`) VALUES
(4, 'FEBRIAN INDRA SAPUTRA', 'SLTA', 'Miliran UH 2/219 RT 004 RW 002 Kel.Muja Muju, Kec.'),
(5, 'NAUFAL APRIANSYAH', 'S1', 'Miliran UH 2/219 RT 004 RW 002 Kel.Muja Muju, Kec.'),
(6, 'SRI MULYANINGSIH', 'D3', 'Cokrokusuman Baru JT II / 927, RT/RW 046/009, Cokr'),
(8, 'Baru 1', 'SLTA', 'asdfasdf'),
(9, 'Baru 2', 'SLTA', ''),
(10, 'Ya Ya', 'SLTA', ''),
(11, 'Yuli', 'SLTA', ''),
(12, 'Baru', 'D3', 'mojokerto'),
(13, 'Abcd', 'SLTA', 'abcd efgh'),
(14, 'Yang Lain', 'SLTA', 'alamat lain'),
(15, 'Asdfasdf', 'SLTA', 'lalala');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_pekerjaan`
--

CREATE TABLE `anggota_pekerjaan` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota_pekerjaan`
--

INSERT INTO `anggota_pekerjaan` (`id`, `id_anggota`, `id_pekerjaan`) VALUES
(43, 0, 3),
(44, 0, 3),
(45, 0, 3),
(46, 0, 3),
(56, 4, 4),
(61, 4, 3),
(64, 6, 3),
(65, 6, 5),
(67, 4, 5),
(68, 5, 5),
(69, 6, 6),
(71, 5, 7),
(72, 4, 7),
(74, 4, 9),
(75, 6, 9),
(76, 4, 13),
(77, 5, 13),
(78, 10, 13),
(79, 12, 13),
(82, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id_kelompok` int(11) NOT NULL,
  `nama_kelompok` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `wakil` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id_kelompok`, `nama_kelompok`, `alamat`, `no_telp`, `ketua`, `wakil`) VALUES
(5, 'Beruang', 'Jl karangbendo kulon no 45', '0898493434', 'Dimas', 'Ari'),
(6, 'Cendrawasi', 'Jl ahmad yani no 55', '0893834343', 'Lilian', 'Anwar');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama_bagian` varchar(100) NOT NULL,
  `tahun_anggaran` char(4) NOT NULL,
  `tanggal_kontrak` date NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `iuran1` bigint(20) NOT NULL,
  `iuran2` bigint(20) NOT NULL,
  `iuran3` bigint(20) NOT NULL,
  `kelompok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_bagian`, `tahun_anggaran`, `tanggal_kontrak`, `provinsi`, `status`, `iuran1`, `iuran2`, `iuran3`, `kelompok`) VALUES
(7, 'pemasaran', '2020', '2021-05-15', '91', 2, 1000, 20000, 50000, 6),
(8, 'keuangan', '2021', '2021-05-22', '35', 2, 10000, 10000, 10000, 6),
(9, 'tes ds', '2323', '2021-05-21', '51', 3, 2323, 23, 2323, 5),
(10, 'tes aja', '2021', '2021-05-22', '36', 1, 100, 1200, 2900, 5),
(11, 'Siapa aja', '2021', '2021-05-21', '36', 2, 1000, 2000, 4500, 5),
(12, 'Bagian Office', '2021', '2021-05-18', '36', 1, 1000, 1000, 10000, 6),
(13, 'rehab smp 1', '2022', '2021-05-20', '1.01.0.00.0.00.01.0000', 1, 25000000000, 34000, 34000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `kode_pengguna` char(9) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'foto_default.png',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `level` varchar(10) NOT NULL DEFAULT 'Pengguna',
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `kode_pengguna`, `nama_pengguna`, `email`, `foto`, `username`, `password`, `level`, `status`) VALUES
(39, 'U001', 'Administrator', 'admin@gmail.com', 'user_icon-icons.com_57997.png', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 1),
(52, 'U040', 'Arimurti', 'arimurti85@gmail.com', 'pengguna_default.png', 'arimurti54', '827ccb0eea8a706c4c34a16891f84e7b', 'Pengguna', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profil_aplikasi`
--

CREATE TABLE `profil_aplikasi` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil_aplikasi`
--

INSERT INTO `profil_aplikasi` (`id`, `nama_aplikasi`) VALUES
(0, 'Pedataan Pekerjaan');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_prov` int(11) NOT NULL,
  `nama` tinytext NOT NULL,
  `kode_opd` varchar(255) NOT NULL,
  `isdelete` varchar(45) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_prov`, `nama`, `kode_opd`, `isdelete`) VALUES
(12, 'Sumatera Utara', '', '1'),
(13, 'Sumatera Barat', '', '1'),
(14, 'Riau', '', '1'),
(15, 'Jambi', '', '1'),
(16, 'Sumatera Selatan', '', '1'),
(17, 'Bengkulu', '', '1'),
(18, 'Lampung', '', '1'),
(19, 'Kepulauan Bangka Belitung', '', '1'),
(21, 'Kepulauan Riau', '', '1'),
(31, 'DKI Jakarta', '', '1'),
(32, 'Jawa Barat', '', '1'),
(33, 'Jawa Tengah', '', '1'),
(34, 'DI Yogyakarta', '', '1'),
(35, 'Jawa Timur', '', '1'),
(36, 'Banten', '', '1'),
(51, 'Bali', '', '1'),
(52, 'Nusa Tenggara Barat', '', '1'),
(53, 'Nusa Tenggara Timur', '', '1'),
(61, 'Kalimantan Barat', '', '1'),
(62, 'Kalimantan Tengah', '', '1'),
(63, 'Kalimantan Selatan', '', '1'),
(64, 'Kalimantan Timur', '', '1'),
(65, 'Kalimantan Utara', '', '1'),
(71, 'Sulawesi Utara', '', '1'),
(72, 'Sulawesi Tengah', '', '1'),
(73, 'Sulawesi Selatan', '', '1'),
(74, 'Sulawesi Tenggara', '', '1'),
(75, 'Gorontalo', '', '1'),
(76, 'Sulawesi Barat', '', '1'),
(81, 'Maluku', '', '1'),
(82, 'Maluku Utara', '', '1'),
(91, 'Papua Barat', '', '1'),
(92, 'Papua', '', '1'),
(101, 'DINAS PENDIDIKAN', '1.01.0.00.0.00.01.0000', '2'),
(1001, 'Aceh', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
(1, 'Berjalan'),
(2, 'Cadangan'),
(3, 'Dibatalkan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `alat_pekerjaan`
--
ALTER TABLE `alat_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `anggota_pekerjaan`
--
ALTER TABLE `anggota_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `kode_pengguna` (`kode_pengguna`);

--
-- Indexes for table `profil_aplikasi`
--
ALTER TABLE `profil_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_prov`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `alat_pekerjaan`
--
ALTER TABLE `alat_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `anggota_pekerjaan`
--
ALTER TABLE `anggota_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
