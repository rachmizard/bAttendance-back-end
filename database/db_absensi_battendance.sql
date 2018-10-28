-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Okt 2018 pada 17.19
-- Versi Server: 10.1.13-MariaDB
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
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id` int(10) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `verifikasi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id`, `karyawan_id`, `verifikasi_id`, `status`, `alasan`, `created_at`, `updated_at`) VALUES
(1, 3, '1', 'izin', 'Ke bekasi sama keluarga', '2018-10-28 06:20:23', '2018-10-28 06:20:23'),
(2, 4, '2', 'izin', 'CHECKUP KE RS', '2018-10-28 06:24:29', '2018-10-28 06:24:29'),
(6, 11, '6', 'izin', 'Buat SIM', '2018-10-28 13:32:39', '2018-10-28 13:32:39'),
(8, 6, '8', 'sakit', 'Dilengkapi surat dokter', '2018-10-28 13:41:46', '2018-10-28 13:41:46'),
(9, 12, '9', 'dinas', 'Meeting Aiwa ke jakarta', '2018-10-28 13:49:21', '2018-10-28 13:49:21'),
(10, 8, '10', 'dinas', 'Meeting DAPENBI SA INVESTASI ke jakarta', '2018-10-28 13:53:35', '2018-10-28 13:53:35'),
(11, 9, '11', 'dinas', 'Meeting mockupers se-dunia di jakarta', '2018-10-28 14:48:45', '2018-10-28 14:48:45'),
(12, 5, '12', 'sakit', 'Dilengkapi surat dokter', '2018-10-28 14:49:14', '2018-10-28 14:49:14'),
(13, 10, '13', 'masuk', NULL, '2018-10-28 00:49:14', '2018-10-28 00:49:14'),
(14, 10, '13', 'keluar', NULL, '2018-10-28 10:49:14', '2018-10-28 10:49:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unauthorized',
  `fp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karyawans`
--

INSERT INTO `karyawans` (`id`, `nama`, `jabatan`, `divisi`, `jenis_kelamin`, `nik`, `status`, `fp`, `created_at`, `updated_at`) VALUES
(5, 'Ismail Azhafir Rohaga', 'Android Developer', 'Teknisi', 'L', 18105452, 'authorized', NULL, '2018-10-28 12:54:52', '2018-10-28 15:53:46'),
(6, 'Rachmizard', 'Web Developer', 'Back-End Service', 'L', 18100630, 'authorized', 'uJp2DQN62d7H7gT.png', '2018-10-28 13:06:30', '2018-10-28 16:06:52'),
(7, 'Muhammad Ikhsan', 'Web Developer', 'Front-End Service', 'L', 18100630, 'authorized', NULL, '2018-10-28 13:06:30', '2018-10-28 13:21:37'),
(8, 'Dinda Amelia Ol''i', 'Admin', 'Administrasi Perkantoran', 'P', 18100631, 'authorized', NULL, '2018-10-28 13:06:31', '2018-10-28 13:06:31'),
(9, 'Dede Hery', 'Designer Graphic', 'Mockup & Design', 'L', 18100631, 'authorized', NULL, '2018-10-28 13:06:31', '2018-10-28 13:06:31'),
(10, 'Faldy', 'System Tester', 'Bug Fixing Analyst', 'L', 18100631, 'authorized', NULL, '2018-10-28 13:06:31', '2018-10-28 16:05:16'),
(11, 'Aldiansyah', 'General Affair', '-', 'L', 18100631, 'authorized', NULL, '2018-10-28 13:06:31', '2018-10-28 13:06:31'),
(12, 'Ryan Ujang Bedil', 'Project Manager', 'System Analyst', 'L', 18100631, 'authorized', NULL, '2018-10-28 13:06:31', '2018-10-28 16:03:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lemburs`
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
-- Struktur dari tabel `master_filters`
--

CREATE TABLE `master_filters` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_history` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_filters`
--

INSERT INTO `master_filters` (`id`, `tgl_history`, `created_at`, `updated_at`) VALUES
(1, '2018-10-28', '2018-10-26 00:22:22', '2018-10-28 14:51:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jam`
--

CREATE TABLE `master_jam` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_jam`
--

INSERT INTO `master_jam` (`id`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(1, '08:00', '17:00', '1', '2018-10-27 16:25:27', '2018-10-27 16:26:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_rekap`
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
-- Dumping data untuk tabel `master_rekap`
--

INSERT INTO `master_rekap` (`id`, `tanggal_aktif_rekap`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, 'October', 'first day of October 2018', 'last day of October 2018', '2018-10-20 17:00:00', '2018-10-25 18:20:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap`
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
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$yZ8AvYbPBdHe3QV1ZVhnD.F.W1fgQ1Upwh.mEn7jDoIlny7ZxO4.O', NULL, '2018-10-26 23:57:01', '2018-10-26 23:57:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasis`
--

CREATE TABLE `verifikasis` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `verifikasis`
--

INSERT INTO `verifikasis` (`id`, `status`, `pin`, `created_at`, `updated_at`) VALUES
(1, '2', '4230', '2018-10-28 06:20:23', '2018-10-28 06:20:23'),
(2, '2', '8094', '2018-10-28 06:24:29', '2018-10-28 06:24:29'),
(3, '2', '3665', '2018-10-28 13:25:16', '2018-10-28 13:25:16'),
(4, '2', '6288', '2018-10-28 13:28:38', '2018-10-28 13:28:38'),
(5, '2', '2220', '2018-10-28 13:30:02', '2018-10-28 13:30:02'),
(6, '2', '7392', '2018-10-28 13:32:39', '2018-10-28 13:32:39'),
(7, '2', '5590', '2018-10-28 13:40:29', '2018-10-28 13:40:29'),
(8, '2', '6061', '2018-10-28 13:41:46', '2018-10-28 13:41:46'),
(9, '2', '2219', '2018-10-28 13:49:21', '2018-10-28 13:49:21'),
(10, '2', '2553', '2018-10-28 13:53:35', '2018-10-28 13:53:35'),
(11, '2', '9958', '2018-10-28 14:48:45', '2018-10-28 14:48:45'),
(12, '2', '4849', '2018-10-28 14:49:14', '2018-10-28 14:49:14'),
(13, '2', '4652', '2018-10-28 00:49:14', '2018-10-28 14:49:14');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `verifikasis`
--
ALTER TABLE `verifikasis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
