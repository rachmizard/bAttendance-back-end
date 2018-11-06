-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 12:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi_battendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(10) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `verifikasi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_duration` time DEFAULT NULL,
  `late_duration` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `karyawan_id`, `verifikasi_id`, `status`, `alasan`, `work_duration`, `late_duration`, `created_at`, `updated_at`) VALUES
(1, 7, '1', 'masuk', NULL, NULL, NULL, '2018-11-06 06:47:22', '2018-11-06 06:47:22'),
(2, 7, '2', 'keluar', NULL, NULL, NULL, '2018-11-06 08:55:15', '2018-11-06 08:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(10) UNSIGNED NOT NULL,
  `pin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unauthorized',
  `fp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `pin`, `nama`, `jabatan`, `divisi`, `jenis_kelamin`, `nik`, `status`, `fp`, `device_token`, `created_at`, `updated_at`) VALUES
(5, NULL, 'Ismail Azhafir Rohaga', 'Android Developer', 'Programmer', 'L', 1805007, 'authorized', 'Ytg74HoOp1A00XD.jpg', NULL, '2018-10-28 12:54:52', '2018-11-06 08:33:54'),
(6, NULL, 'Rachmizard', 'Web Developer', 'Programmer', 'L', 1805009, 'authorized', 'Nynu1aAQV0GxGuT.jpg', NULL, '2018-10-28 13:06:30', '2018-11-06 08:33:54'),
(7, NULL, 'Muhammad Ikhsan', 'Web Developer', 'Programmer', 'L', 1805008, 'authorized', 'GfwNwlqO2sibPsH.jpg', NULL, '2018-10-28 13:06:30', '2018-11-06 08:33:54'),
(8, NULL, 'Dinda Amelia Ol''i', 'Admin', 'Administrasi Perkantoran', 'P', 1805010, 'authorized', NULL, NULL, '2018-10-28 13:06:31', '2018-11-06 08:33:54'),
(9, NULL, 'Dede Hery', 'Designer Graphic', 'UI/UX', 'L', 1601003, 'authorized', NULL, NULL, '2018-10-28 13:06:31', '2018-11-06 08:33:54'),
(10, NULL, 'Faldy', 'System Tester', 'Bug Fixing Analyst', 'L', 1809011, 'authorized', 'tbYN0G2MFD78Npj.jpg', NULL, '2018-10-28 13:06:31', '2018-11-06 08:33:54'),
(11, NULL, 'Aldiansyah', 'General Affair', '-', 'L', 1809012, 'authorized', NULL, NULL, '2018-10-28 13:06:31', '2018-11-06 08:33:54'),
(12, NULL, 'Ryan Permana G', 'Project Manager', 'System Analyst', 'L', 1604004, 'authorized', 'NF7UdXaH25yLitY.jpeg', NULL, '2018-10-28 13:06:31', '2018-11-06 08:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `lemburs`
--

CREATE TABLE `lemburs` (
  `id` int(10) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `durasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_filters`
--

CREATE TABLE `master_filters` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_history` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_filters`
--

INSERT INTO `master_filters` (`id`, `tgl_history`, `created_at`, `updated_at`) VALUES
(1, '2018-11-06', '2018-10-26 00:22:22', '2018-11-06 05:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `master_jam`
--

CREATE TABLE `master_jam` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` time NOT NULL,
  `tolerance` time DEFAULT NULL,
  `end` time NOT NULL,
  `status` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_jam`
--

INSERT INTO `master_jam` (`id`, `start`, `tolerance`, `end`, `status`, `created_at`, `updated_at`) VALUES
(1, '08:00:00', '08:15:00', '17:00:00', '1', '2018-10-27 16:25:27', '2018-10-27 16:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `master_rekap`
--

CREATE TABLE `master_rekap` (
  `id` int(10) NOT NULL,
  `tanggal_aktif_rekap` varchar(90) DEFAULT NULL,
  `start` varchar(90) DEFAULT NULL,
  `end` varchar(90) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_rekap`
--

INSERT INTO `master_rekap` (`id`, `tanggal_aktif_rekap`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, 'November', 'first day of November 2018', 'last day of November 2018', '2018-10-20 17:00:00', '2018-11-05 08:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(23, '2014_10_12_000000_create_users_table', 1),
(24, '2018_09_24_084221_create_verifikasis_table', 1),
(25, '2018_09_24_084322_create_absen_table', 1),
(26, '2018_09_24_084459_create_lemburs_table', 1),
(27, '2018_09_24_084549_create_karyawans_table', 1),
(28, '2018_10_08_160949_create_table_master_jam', 1),
(29, '2018_10_26_101823_create_master_filters_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekap`
--

CREATE TABLE `rekap` (
  `id` int(11) NOT NULL,
  `absen_id` int(10) NOT NULL,
  `jml_hadir` int(10) NOT NULL,
  `jml_izin` int(10) NOT NULL,
  `jml_sakit` int(10) NOT NULL,
  `jml_alfa` int(10) NOT NULL,
  `tgl_rekap` date NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekap_durasi`
--

CREATE TABLE `rekap_durasi` (
  `id` int(11) NOT NULL,
  `durasi_kerja` time NOT NULL,
  `durasi_telat` time NOT NULL,
  `karyawan_id` varchar(90) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap_durasi`
--

INSERT INTO `rekap_durasi` (`id`, `durasi_kerja`, `durasi_telat`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(1, '02:08:29', '05:31:46', '7', '2018-11-06 08:55:15', '2018-11-06 08:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$yZ8AvYbPBdHe3QV1ZVhnD.F.W1fgQ1Upwh.mEn7jDoIlny7ZxO4.O', 'WJJW7Aq841jutXgNAWPE14ohapKbkcK17PEP7g1hqpvHG1f74HPaLQdBRf6b', '2018-10-26 23:57:01', '2018-10-26 23:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasis`
--

CREATE TABLE `verifikasis` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verifikasis`
--

INSERT INTO `verifikasis` (`id`, `status`, `pin`, `created_at`, `updated_at`) VALUES
(1, '0', '5466', '2018-11-06 06:46:46', '2018-11-06 06:46:46'),
(2, '2', '4255', '2018-11-06 08:55:15', '2018-11-06 08:55:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lemburs`
--
ALTER TABLE `lemburs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_filters`
--
ALTER TABLE `master_filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jam`
--
ALTER TABLE `master_jam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_rekap`
--
ALTER TABLE `master_rekap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap_durasi`
--
ALTER TABLE `rekap_durasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifikasis`
--
ALTER TABLE `verifikasis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `lemburs`
--
ALTER TABLE `lemburs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_filters`
--
ALTER TABLE `master_filters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_jam`
--
ALTER TABLE `master_jam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_rekap`
--
ALTER TABLE `master_rekap`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rekap_durasi`
--
ALTER TABLE `rekap_durasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `verifikasis`
--
ALTER TABLE `verifikasis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
