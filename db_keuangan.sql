-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Jun 2016 pada 10.12
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dagang`
--

CREATE TABLE `dagang` (
  `id` char(12) NOT NULL,
  `id_pasar` char(5) NOT NULL,
  `id_komoditas` int(10) NOT NULL,
  `nama_dagang` varchar(100) NOT NULL,
  `jenis_dagang` enum('PN','KS') NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `status` enum('AP','PD','DL') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dagang`
--

INSERT INTO `dagang` (`id`, `id_pasar`, `id_komoditas`, `nama_dagang`, `jenis_dagang`, `lokasi`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
('DG1606000001', 'PS03', 3, 'Dagang Bunga', 'PN', 'deket parkiran', 'AP', '2016-06-21 19:03:41', '2016-06-23 06:22:12', 1, 1, NULL),
('DG1606000002', 'PS01', 1, 'Kios Petra', 'KS', 'lantai 2', 'PD', '2016-06-21 19:13:09', '2016-06-23 06:14:17', 1, NULL, NULL),
('DG1606000003', 'PS03', 1, 'Kios Jagung', 'KS', 'lantai 3', 'PD', '2016-06-21 19:13:53', '2016-06-21 19:18:55', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komoditas`
--

CREATE TABLE `komoditas` (
  `id` int(10) NOT NULL,
  `nama_komoditas` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komoditas`
--

INSERT INTO `komoditas` (`id`, `nama_komoditas`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'Sembako', '2016-04-30 18:41:04', '2016-04-30 10:41:04', 1, 1, NULL),
(2, 'Canang', '2016-04-30 10:13:06', '2016-04-30 10:13:06', 1, NULL, NULL),
(3, 'Bunga', '2016-06-23 06:22:31', '2016-06-23 06:22:12', 1, NULL, NULL),
(8, 'Beras', '2016-04-30 10:51:28', '2016-04-30 10:51:28', 1, NULL, NULL),
(9, 'Ransel', '2016-06-10 17:53:41', '2016-06-10 17:53:41', 1, 1, NULL),
(10, 'Pangan', '2016-06-21 18:05:56', '2016-06-21 18:05:42', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_01_145345_create_roles_table', 2),
('2016_01_01_145745_create_role_user_table', 2),
('2016_01_01_150253_create_permissions_table', 2),
('2016_01_01_154441_create_permission_role_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasar`
--

CREATE TABLE `pasar` (
  `id` char(4) NOT NULL,
  `nama_pasar` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasar`
--

INSERT INTO `pasar` (`id`, `nama_pasar`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
('PS01', 'Pasar Badung', '2016-04-29 04:37:26', '2016-06-23 06:14:17', 1, 1, NULL),
('PS02', 'Pasar Kreneng', '2016-04-29 04:37:41', '2016-06-21 18:08:11', 1, NULL, NULL),
('PS03', 'Pasar Sanglah', '2016-04-29 04:37:47', '2016-04-30 18:57:32', 1, 1, NULL),
('PS04', 'Pasar Sempidi', '2016-05-07 11:10:04', '2016-05-07 11:10:04', 1, NULL, NULL),
('PS05', 'Pasar Anyarsari', '2016-06-22 14:27:07', '2016-06-22 14:27:13', 1, NULL, NULL),
('PS06', 'Pasar Kuning Sari', '2016-06-22 14:27:17', '2016-06-22 14:27:29', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` char(9) NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `id_pasar` char(5) DEFAULT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `id_users`, `id_pasar`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `no_telp`, `photo`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
('PG1604001', 1, NULL, 'Manik Anggara', 'L', 'Jalan Nangka Utara', '082247464196', NULL, '2016-06-21 17:36:15', NULL, 1, NULL, NULL),
('PG1604002', 2, 'PS03', 'Petugas Manik', 'L', 'Jalan Ayani Utara', '085474121363', NULL, '2016-06-23 16:20:39', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pungutan`
--

CREATE TABLE `pungutan` (
  `id` bigint(20) NOT NULL,
  `id_pasar` char(4) NOT NULL,
  `id_dagang` char(12) NOT NULL,
  `tgl_pungutan` date NOT NULL,
  `type` enum('PG','TG') NOT NULL,
  `deposited` timestamp NULL DEFAULT NULL,
  `deposited_to` int(10) DEFAULT NULL,
  `detail` enum('HR','BL') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pungutan`
--

INSERT INTO `pungutan` (`id`, `id_pasar`, `id_dagang`, `tgl_pungutan`, `type`, `deposited`, `deposited_to`, `detail`, `created_at`, `created_by`, `updated_at`, `deleted_at`) VALUES
(12, 'PS03', 'DG1606000001', '2016-06-27', 'PG', NULL, NULL, 'HR', '2016-06-27 12:23:23', 2, '2016-06-27 12:23:23', NULL),
(13, 'PS03', 'DG1606000003', '2016-06-27', 'PG', NULL, NULL, 'HR', '2016-06-27 12:23:43', 2, '2016-06-27 12:23:43', NULL),
(14, 'PS03', 'DG1606000003', '2016-06-26', 'TG', NULL, NULL, 'HR', '2016-06-27 16:21:52', 2, '2016-06-27 16:21:52', NULL),
(16, 'PS03', 'DG1606000001', '2016-06-26', 'TG', NULL, NULL, 'HR', '2016-06-27 16:25:06', 2, '2016-06-27 16:25:06', NULL),
(18, 'PS03', 'DG1606000001', '2016-06-21', 'TG', NULL, NULL, 'HR', '2016-06-28 06:10:33', 2, '2016-06-28 06:10:33', NULL),
(19, 'PS03', 'DG1606000003', '2016-06-21', 'TG', NULL, NULL, 'HR', '2016-06-28 06:10:37', 2, '2016-06-28 06:10:37', NULL),
(20, 'PS03', 'DG1606000001', '2016-06-20', 'TG', NULL, NULL, 'HR', '2016-06-28 06:11:41', 2, '2016-06-28 06:11:41', NULL),
(21, 'PS03', 'DG1606000003', '2016-06-20', 'TG', NULL, NULL, 'HR', '2016-06-28 06:11:49', 2, '2016-06-28 06:11:49', NULL),
(22, 'PS03', 'DG1606000001', '2016-06-15', 'TG', NULL, NULL, 'HR', '2016-06-28 06:13:58', 2, '2016-06-28 06:13:58', NULL),
(23, 'PS03', 'DG1606000003', '2016-06-15', 'TG', NULL, NULL, 'HR', '2016-06-28 06:14:50', 2, '2016-06-28 06:14:50', NULL),
(24, 'PS03', 'DG1606000003', '2016-06-16', 'TG', NULL, NULL, 'HR', '2016-06-28 06:15:45', 2, '2016-06-28 06:15:45', NULL),
(25, 'PS03', 'DG1606000001', '2016-06-28', 'PG', NULL, NULL, 'HR', '2016-06-28 06:18:03', 2, '2016-06-28 06:18:03', NULL),
(26, 'PS03', 'DG1606000003', '2016-06-28', 'PG', NULL, NULL, 'HR', '2016-06-28 06:18:06', 2, '2016-06-28 06:18:06', NULL),
(27, 'PS03', 'DG1606000001', '2016-06-06', 'TG', NULL, NULL, 'HR', '2016-06-28 07:15:06', 2, '2016-06-28 07:15:06', NULL),
(28, 'PS03', 'DG1606000001', '2016-06-28', 'PG', NULL, NULL, 'BL', '2016-06-28 07:15:47', 2, '2016-06-28 07:15:47', NULL),
(29, 'PS03', 'DG1606000003', '2016-06-28', 'PG', NULL, NULL, 'BL', '2016-06-28 07:24:51', 2, '2016-06-28 07:24:51', NULL),
(30, 'PS03', 'DG1606000001', '2016-05-28', 'TG', NULL, NULL, 'BL', '2016-06-28 08:04:35', 2, '2016-06-28 08:04:35', NULL),
(31, 'PS03', 'DG1606000003', '2016-05-28', 'TG', NULL, NULL, 'BL', '2016-06-28 08:04:51', 2, '2016-06-28 08:04:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pungutan_bulanan`
--

CREATE TABLE `pungutan_bulanan` (
  `id` bigint(20) NOT NULL,
  `id_pungutan` bigint(20) NOT NULL,
  `sewa_tempat` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pungutan_bulanan`
--

INSERT INTO `pungutan_bulanan` (`id`, `id_pungutan`, `sewa_tempat`, `ppn`, `total`, `created_at`, `created_by`, `updated_at`, `deleted_at`) VALUES
(1, 28, 54000, 5400, 59400, '2016-06-28 07:15:47', 2, '2016-06-28 07:15:47', NULL),
(2, 29, 54000, 5400, 59400, '2016-06-28 07:24:51', 2, '2016-06-28 07:24:51', NULL),
(3, 30, 54000, 5400, 59400, '2016-06-28 08:04:35', 2, '2016-06-28 08:04:35', NULL),
(4, 31, 54000, 5400, 59400, '2016-06-28 08:04:51', 2, '2016-06-28 08:04:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pungutan_harian`
--

CREATE TABLE `pungutan_harian` (
  `id` bigint(20) NOT NULL,
  `id_pungutan` bigint(20) NOT NULL,
  `tempat_berjualan` int(11) NOT NULL,
  `listrik` int(11) NOT NULL,
  `air` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pungutan_harian`
--

INSERT INTO `pungutan_harian` (`id`, `id_pungutan`, `tempat_berjualan`, `listrik`, `air`, `jumlah`, `ppn`, `total`, `created_at`, `created_by`, `updated_at`, `deleted_at`) VALUES
(1, 12, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-27 12:23:23', 2, '2016-06-27 12:23:23', NULL),
(2, 13, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-27 12:23:43', 2, '2016-06-27 12:23:43', NULL),
(3, 14, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-27 16:21:52', 2, '2016-06-27 16:21:52', NULL),
(5, 16, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-27 16:25:06', 2, '2016-06-27 16:25:06', NULL),
(7, 18, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:10:33', 2, '2016-06-28 06:10:33', NULL),
(8, 19, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:10:37', 2, '2016-06-28 06:10:37', NULL),
(9, 20, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:11:41', 2, '2016-06-28 06:11:41', NULL),
(10, 21, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:11:49', 2, '2016-06-28 06:11:49', NULL),
(11, 22, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:13:58', 2, '2016-06-28 06:13:58', NULL),
(12, 23, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:14:50', 2, '2016-06-28 06:14:50', NULL),
(13, 24, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:15:45', 2, '2016-06-28 06:15:45', NULL),
(14, 25, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:18:03', 2, '2016-06-28 06:18:03', NULL),
(15, 26, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 06:18:06', 2, '2016-06-28 06:18:06', NULL),
(16, 27, 2500, 2000, 1000, 5500, 550, 6050, '2016-06-28 07:15:06', 2, '2016-06-28 07:15:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Petugas', 'petugas', 'Petugas lapangan', '2016-04-22 08:36:40', '2016-04-22 08:36:40'),
(2, 'Operator', 'operator', 'Editor data pusat', '2016-04-22 08:36:40', '2016-04-22 08:36:40'),
(3, 'Dirut', 'dirut', 'Pimpinan tertinggi', '2016-04-22 08:36:40', '2016-04-22 08:36:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2016-04-22 08:39:06', '2016-04-22 08:39:06'),
(2, 1, 2, '2016-04-22 08:39:06', '2016-04-22 08:39:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL,
  `type` enum('HR','BL') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id`, `label`, `tarif`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'Tempat Berjualan', 2500, 'HR', '2016-06-24 04:31:55', NULL, 1, NULL, NULL),
(2, 'Listrik', 2000, 'HR', '2016-06-24 04:36:51', NULL, 1, NULL, NULL),
(3, 'Air', 1000, 'HR', '2016-06-24 04:37:30', NULL, 1, NULL, NULL),
(4, 'Sewa Tempat', 54000, 'BL', '2016-06-28 06:38:01', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('P','O','D') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('200','303','666') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'operator@mail.com', '$2y$10$SBGUtP4jIp5aOnt1HgVwU.D8uASzapMM3Zry5MasszxqkATwFqeDC', 'Qhzm8tVWKzRYpWZlKglWYHgwR1Glm9CCv0Beg8egBcw3QorhvEB3zgzgB3YD', 'O', '200', '2016-04-22 06:20:11', '2016-06-27 12:33:05', NULL),
(2, 'petugas@mail.com', '$2y$10$8hFOBK0r7mTVUGQgYT5g8.901Ngw/YncTfZrSOxEwQhRBtJiuxr.u', '2ktdbhterXXGdNageGOtLrZ5023pPauUKh6OLsLVD9ZH3Lz3rXK7b20QH8LO', 'P', '200', '2016-04-22 08:46:14', '2016-06-28 08:06:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dagang`
--
ALTER TABLE `dagang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_dagang_komuditas` (`id_komoditas`),
  ADD KEY `FK_dagang_pasar` (`id_pasar`);

--
-- Indexes for table `komoditas`
--
ALTER TABLE `komoditas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_komoditas` (`nama_komoditas`);

--
-- Indexes for table `pasar`
--
ALTER TABLE `pasar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pegawai_users` (`id_users`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `pungutan`
--
ALTER TABLE `pungutan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pungutan_bulanan`
--
ALTER TABLE `pungutan_bulanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pungutan_bulanan_pungutan` (`id_pungutan`);

--
-- Indexes for table `pungutan_harian`
--
ALTER TABLE `pungutan_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pungutan_harian_pungutan` (`id_pungutan`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komoditas`
--
ALTER TABLE `komoditas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pungutan`
--
ALTER TABLE `pungutan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `pungutan_bulanan`
--
ALTER TABLE `pungutan_bulanan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pungutan_harian`
--
ALTER TABLE `pungutan_harian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dagang`
--
ALTER TABLE `dagang`
  ADD CONSTRAINT `FK_dagang_komoditas` FOREIGN KEY (`id_komoditas`) REFERENCES `komoditas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_dagang_pasar` FOREIGN KEY (`id_pasar`) REFERENCES `pasar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_pegawai_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pungutan_bulanan`
--
ALTER TABLE `pungutan_bulanan`
  ADD CONSTRAINT `FK_pungutan_bulanan_pungutan` FOREIGN KEY (`id_pungutan`) REFERENCES `pungutan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pungutan_harian`
--
ALTER TABLE `pungutan_harian`
  ADD CONSTRAINT `FK_pungutan_harian_pungutan` FOREIGN KEY (`id_pungutan`) REFERENCES `pungutan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
