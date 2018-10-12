-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 04:57 PM
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
  `verifikasi_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `karyawan_id`, `verifikasi_id`, `status`, `alasan`, `created_at`, `updated_at`) VALUES
(1, 20, '5', 'masuk', NULL, '2018-10-04 03:57:00', '2018-10-04 03:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` int(11) NOT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'unauthorized',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `nama`, `divisi`, `jenis_kelamin`, `nik`, `pin`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Ismail Azhafir', 'Android Developer & System Analyst', 'L', 180500, NULL, 'unauthorized', '2018-10-02 09:13:10', '2018-10-03 04:41:50'),
(11, 'Muhammad Ikhsan Aziz', 'Web Developer', 'L', 180502, NULL, 'unauthorized', '2018-10-02 09:14:22', '2018-10-03 04:39:15'),
(12, 'Dinda Amelia O''li', 'Administrasi', 'L', 180504, NULL, 'unauthorized', '2018-10-02 09:17:48', '2018-10-12 12:17:00'),
(13, 'Derry', 'Mockup & Designer', 'L', 180121, NULL, 'unauthorized', '2018-10-02 09:18:25', '2018-10-10 03:19:23'),
(20, 'Rachmizard Ryacudu', 'Web Developer', 'L', 180501, NULL, 'unauthorized', '2018-10-03 02:00:55', '2018-10-04 04:29:59'),
(21, 'Faldy', 'System Tester', 'L', 180951, NULL, 'unauthorized', '2018-10-03 02:03:47', '2018-10-04 06:33:39'),
(27, 'Wulandari', 'HRD', 'L', 129012, NULL, 'authorized', '2018-10-03 03:51:31', '2018-10-12 07:57:47'),
(41, 'Muhammad Kertayasa', 'Web Developer', 'L', 909090, NULL, 'unauthorized', '2018-10-03 08:21:53', '2018-10-03 09:03:23'),
(46, 'Kertayasa', 'CS', 'L', 1920192, NULL, 'unauthorized', '2018-10-06 05:38:13', '2018-10-06 05:38:13'),
(48, 'Muhammad Naqsi', 'Web Dev', 'L', 90190901, NULL, 'unauthorized', '2018-10-10 03:52:09', '2018-10-10 03:52:09'),
(49, 'Abdul Ghani', 'Web', 'L', 141351, NULL, 'unauthorized', '2018-10-12 03:07:23', '2018-10-12 08:17:37'),
(50, 'Beron', 'CS', 'L', 85172, NULL, 'authorized', '2018-10-12 06:48:56', '2018-10-12 07:57:20'),
(51, 'Ujang Devs', 'Web Developer', 'L', 3456789, NULL, 'unauthorized', '2018-10-12 06:50:49', '2018-10-12 06:51:33'),
(52, 'Ghani Akbar', 'Web Developer', 'L', 821212, NULL, 'unauthorized', '2018-10-12 08:17:17', '2018-10-12 08:17:17'),
(53, 'Usep Kertayasa', 'Web Developer', 'L', 345678, NULL, 'authorized', '2018-10-12 09:47:06', '2018-10-12 09:47:06'),
(54, 'Yayan Soerapno', 'Project Manager & IT Consultant', 'L', 180973, NULL, 'authorized', '2018-10-12 12:10:59', '2018-10-12 12:11:28');

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
-- Table structure for table `master_jam`
--

CREATE TABLE `master_jam` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_jam`
--

INSERT INTO `master_jam` (`id`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(6, '08:00', '17:00', 1, '2018-10-12 12:06:09', '2018-10-12 12:06:48');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2018_09_24_084221_create_verifikasis_table', 1),
(3, '2018_09_24_084322_create_absen_table', 1),
(4, '2018_09_24_084459_create_lemburs_table', 1),
(5, '2018_09_24_084549_create_karyawans_table', 1),
(6, '2018_10_08_160949_create_table_master_jam', 2);

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
(1, 'Admin', 'admin@admin.com', '$2y$10$tryCxVjWUsgzHZnORZZWV.GC6T0QF/xbzLwVfBwZKWVzXiEutBan2', '1AQyoTeaAUMRY8BmxxlNPFraIN3FxUHOWQBRM1uGDeXI4ANP3BRppDzGSHz5', '2018-10-02 02:51:21', '2018-10-02 02:51:21');

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
(4, '2', '3580', '2018-10-02 03:10:30', '2018-10-02 03:10:16'),
(5, '2', '7319', '2018-10-04 03:55:00', '2018-10-04 03:55:00');

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
-- Indexes for table `master_jam`
--
ALTER TABLE `master_jam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `lemburs`
--
ALTER TABLE `lemburs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_jam`
--
ALTER TABLE `master_jam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `verifikasis`
--
ALTER TABLE `verifikasis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
