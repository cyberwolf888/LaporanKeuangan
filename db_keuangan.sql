-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Jul 2016 pada 20.21
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
('DG1606000002', 'PS01', 1, 'Kios Petra', 'KS', 'lantai 2', 'PD', '2016-06-21 19:13:09', '2016-07-01 08:44:14', 1, NULL, NULL),
('DG1606000003', 'PS03', 1, 'Kios Jagung', 'KS', 'lantai 3', 'AP', '2016-06-21 19:13:53', '2016-06-21 19:18:55', 1, 1, NULL),
('DG1606000004', 'PS02', 9, 'Dagang Ransel', 'PN', 'parkiran', 'PD', '2016-06-29 15:03:13', '2016-06-29 15:03:34', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komoditas`
--

CREATE TABLE `komoditas` (
  `id` int(10) NOT NULL,
  `nama_komoditas` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
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
('PS01', 'Pasar Badung', '2016-04-29 04:37:26', '2016-07-01 06:59:55', 1, 3, NULL),
('PS02', 'Pasar Kreneng', '2016-04-29 04:37:41', '2016-06-21 18:08:11', 1, NULL, NULL),
('PS03', 'Pasar Sanglah', '2016-04-29 04:37:47', '2016-04-30 18:57:32', 1, 1, NULL),
('PS04', 'Pasar Sempidi', '2016-05-07 11:10:04', '2016-05-07 11:10:04', 1, NULL, NULL),
('PS05', 'Pasar Anyarsari', '2016-06-22 14:27:07', '2016-06-22 14:27:13', 1, NULL, NULL),
('PS06', 'Pasar Kuning Sari', '2016-06-22 14:27:17', '2016-07-01 07:02:21', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('wijaya.imd@gmail.com', '0218cb9ef2a9a8e86cdafd50daec81a1372bc72403676752f626d3794f9b1466', '2016-07-02 17:25:21');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `id_users`, `id_pasar`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `no_telp`, `photo`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
('PG1604001', 1, NULL, 'Manik Operator', 'L', 'Jalan Nangka Utara', '082247464196', 'PG1604001pJZmWTnkn3.jpg', '2016-07-02 16:22:22', '2016-07-08 06:02:19', 1, NULL, NULL),
('PG1604002', 2, 'PS03', 'Windu Petugas Jele', 'L', 'Jalan Ayani Utara', '085474121363', 'PG1604002HE5Ut06qzQ.jpg', '2016-07-02 16:43:53', '2016-07-08 06:07:01', 1, NULL, NULL),
('PG1604003', 3, NULL, 'Hendra Awesome', 'L', 'Jalan Awesome No.888', '085737353569', 'PG1604003UwoRMQmw6x.jpg', '2016-07-01 16:24:26', '2016-07-07 07:19:55', 1, NULL, NULL),
('PG1604004', 12, NULL, 'Test Operator', 'L', 'Jalan Test asd', '082247464196', NULL, '2016-07-02 16:24:43', NULL, 3, NULL, NULL),
('PG1604005', 13, 'PS06', 'Gusti Bagus', 'L', 'Jalan Ayani', '082247464196', NULL, '2016-07-02 16:44:33', NULL, 3, NULL, NULL),
('PG1604006', 10, NULL, 'Dirut Mahesa 2', 'L', 'Jalan Kematian 2', '082247464196', NULL, '2016-07-02 16:05:14', NULL, 3, NULL, NULL),
('PG1604007', 11, NULL, 'Awesome Dirut', 'L', 'Jalan Raya Bedugul', '082247464196', NULL, '2016-07-02 16:08:41', NULL, 3, NULL, NULL),
('PG1607001', 14, NULL, 'New Operator', 'L', 'Jalan Gak Jelas', '084637362726', NULL, '2016-07-02 16:59:29', '2016-07-02 16:59:29', 3, NULL, NULL);

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
(12, 'PS03', 'DG1606000001', '2016-06-27', 'PG', NULL, 1, 'HR', '2016-06-27 12:23:23', 2, '2016-06-30 06:31:32', NULL),
(13, 'PS03', 'DG1606000003', '2016-06-27', 'PG', '2016-06-30 06:31:32', 1, 'HR', '2016-06-27 12:23:43', 2, '2016-06-30 06:31:32', NULL),
(14, 'PS03', 'DG1606000003', '2016-06-26', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-27 16:21:52', 2, '2016-06-29 15:52:51', NULL),
(16, 'PS03', 'DG1606000001', '2016-06-26', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-27 16:25:06', 2, '2016-06-29 15:52:51', NULL),
(18, 'PS03', 'DG1606000001', '2016-06-21', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:10:33', 2, '2016-06-29 15:52:51', NULL),
(19, 'PS03', 'DG1606000003', '2016-06-21', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:10:37', 2, '2016-06-29 15:52:51', NULL),
(20, 'PS03', 'DG1606000001', '2016-06-20', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:11:41', 2, '2016-06-29 15:52:51', NULL),
(21, 'PS03', 'DG1606000003', '2016-06-20', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:11:49', 2, '2016-06-29 15:52:51', NULL),
(22, 'PS03', 'DG1606000001', '2016-06-15', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:13:58', 2, '2016-06-29 15:52:51', NULL),
(23, 'PS03', 'DG1606000003', '2016-06-15', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:14:50', 2, '2016-06-29 15:52:51', NULL),
(24, 'PS03', 'DG1606000003', '2016-06-16', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:15:45', 2, '2016-06-29 15:52:51', NULL),
(25, 'PS03', 'DG1606000001', '2016-06-28', 'PG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:18:03', 2, '2016-06-29 15:52:51', NULL),
(26, 'PS03', 'DG1606000003', '2016-06-28', 'PG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 06:18:06', 2, '2016-06-29 15:52:51', NULL),
(27, 'PS03', 'DG1606000001', '2016-06-06', 'TG', '2016-06-29 15:52:51', 1, 'HR', '2016-06-28 07:15:06', 2, '2016-06-29 15:52:51', NULL),
(28, 'PS03', 'DG1606000001', '2016-06-28', 'PG', '2016-06-29 15:52:51', 1, 'BL', '2016-06-28 07:15:47', 2, '2016-06-29 15:52:51', NULL),
(29, 'PS03', 'DG1606000003', '2016-06-28', 'PG', '2016-06-29 15:52:51', 1, 'BL', '2016-06-28 07:24:51', 2, '2016-06-29 15:52:51', NULL),
(30, 'PS03', 'DG1606000001', '2016-05-28', 'TG', '2016-06-29 15:52:51', 1, 'BL', '2016-06-28 08:04:35', 2, '2016-06-29 15:52:51', NULL),
(31, 'PS03', 'DG1606000003', '2016-05-28', 'TG', '2016-06-29 15:52:51', 1, 'BL', '2016-06-28 08:04:51', 2, '2016-06-29 15:52:51', NULL);

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
(2, 1, 2, '2016-04-22 08:39:06', '2016-04-22 08:39:06'),
(3, 3, 3, '2016-06-30 17:13:56', '2016-06-30 17:13:58'),
(4, 3, 10, '2016-07-02 16:05:14', '2016-07-02 16:05:14'),
(5, 3, 11, '2016-07-02 16:08:41', '2016-07-02 16:08:41'),
(6, 2, 12, '2016-07-02 16:24:43', '2016-07-02 16:24:43'),
(7, 1, 13, '2016-07-02 16:44:33', '2016-07-02 16:44:33'),
(8, 2, 14, '2016-07-02 16:59:29', '2016-07-02 16:59:29');

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
  `jenis_dagang` enum('PN','KS') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id`, `label`, `tarif`, `type`, `jenis_dagang`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'Tempat Berjualan', 2500, 'HR', 'KS', '2016-06-24 04:31:55', '2016-07-01 08:10:56', 1, NULL, NULL),
(2, 'Listrik', 2000, 'HR', 'KS', '2016-06-24 04:36:51', '2016-07-01 08:11:02', 1, NULL, NULL),
(3, 'Air', 1000, 'HR', 'KS', '2016-06-24 04:37:30', '2016-07-01 08:11:07', 1, NULL, NULL),
(4, 'Sewa Tempat', 54000, 'BL', 'KS', '2016-06-28 06:38:01', '2016-07-01 08:11:13', 1, NULL, NULL),
(6, 'Tempat Berjualan', 2500, 'HR', 'PN', '2016-06-28 06:38:01', '2016-06-28 06:38:01', 1, NULL, NULL),
(7, 'Listrik', 2000, 'HR', 'PN', '2016-06-28 06:38:01', '2016-06-28 06:38:01', 1, NULL, NULL),
(8, 'Air', 1000, 'HR', 'PN', '2016-06-28 06:38:01', '2016-06-28 06:38:01', 1, NULL, NULL),
(9, 'Sewa Tempat', 54000, 'BL', 'PN', '2016-06-28 06:38:01', '2016-06-28 06:38:01', 1, NULL, NULL);

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
(1, 'operator@mail.com', '$2y$10$SBGUtP4jIp5aOnt1HgVwU.D8uASzapMM3Zry5MasszxqkATwFqeDC', 'J5FDBjqPl6PqyjfzDQXaEcRM7KpKb7PREi4yECZD1sSa5gaTIN3zIZAO433a', 'O', '200', '2016-04-22 06:20:11', '2016-07-09 18:21:03', NULL),
(2, 'petugas@mail.com', '$2y$10$8hFOBK0r7mTVUGQgYT5g8.901Ngw/YncTfZrSOxEwQhRBtJiuxr.u', '343dE7YenTuQaT6jmoJDH9ZfGtBqH4Dwdnwy3HFjzU9vwYSSp5vXbyyckn1k', 'P', '200', '2016-04-22 08:46:14', '2016-06-29 15:58:42', NULL),
(3, 'dirut@mail.com', '$2y$10$UW0THjM3mkUkB.YI4lkW9unWuyDG1jsiVCvE3H3C2ZTWcv7uzEz3i', 'eEE0AxkCEmHbWhgAjNpJreDbUdmmSxSqQmZm7dz3P7BlrE3FRdBVnMme8nbm', 'D', '200', '2016-06-30 17:12:31', '2016-07-09 18:19:37', NULL),
(10, 'dirut2@gmail.com', '$2y$10$pByyBk5xwhVNKMz2r1W3..mXaRtI5bP7wIDhMI5EjOm6nHc0y/P0e', NULL, 'D', '200', '2016-07-02 16:05:14', '2016-07-02 16:07:27', NULL),
(11, 'dirut3@gmail.com', '$2y$10$xxKzMBBd1evD5d1QXVjt0.BNcPIScAqkekfvg3M8YzuUzBa6zWmC2', NULL, 'D', '200', '2016-07-02 16:08:41', '2016-07-02 16:08:41', NULL),
(12, 'operator2@gmail.com', '$2y$10$lfSAuvdVmGQjPg4sS0YIcet.4J7jW2JJ6Sz0.ujDMVoEk3rxB4ica', NULL, 'O', '200', '2016-07-02 16:24:43', '2016-07-02 16:24:43', NULL),
(13, 'petugas2@gmail.com', '$2y$10$6XgAlX95J3xndWK00p0WyuOD/faYoBAroK5D/QISngIFGEqufyNc6', NULL, 'P', '200', '2016-07-02 16:44:33', '2016-07-02 16:44:33', NULL),
(14, 'wijaya.imd@gmail.com', '$2y$10$D77DNKh3.QuPR0vQJLDBuO8hsLNYXAjIvW0Q7pISInhnyOnchcla2', NULL, 'O', '200', '2016-07-02 16:59:29', '2016-07-02 16:59:29', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
