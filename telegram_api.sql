-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308:3308
-- Generation Time: Jul 31, 2022 at 05:39 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telegram_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

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
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(35) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FOC', 1, '2022-07-16 05:59:33', '2022-07-16 05:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keluhan`
--

CREATE TABLE `tbl_keluhan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `penyebab` text NOT NULL,
  `status` int(11) NOT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_keluhan`
--

INSERT INTO `tbl_keluhan` (`id`, `id_pelanggan`, `id_kategori`, `deskripsi`, `penyebab`, `status`, `id_teknisi`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'dZtySjpSmi', 1, 'TESTTTTT', 'A', 1, 1, NULL, '2022-07-16 10:55:35', '2022-07-16 10:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id`, `nama_pelanggan`, `no_hp`, `alamat`, `id_wilayah`, `status`, `created_at`, `updated_at`) VALUES
('dZtySjpSmi', 'h', '087720729291', 'DUTA MEKAR, RT/RW 005/015, Kel/Desa ECILEUNGSIKIDUL, Kecamatan CILEUNGSI', 1, 1, '2022-07-16 10:18:30', '2022-07-16 10:18:30'),
('ZCChI8OyFb', 'Bagus', '081218477162', 'DUTA MEKAR, RT/RW 005/015, Kel/Desa ECILEUNGSIKIDUL, Kecamatan CILEUNGSI', 1, 1, '2022-07-16 10:34:28', '2022-07-16 10:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teknisi`
--

CREATE TABLE `tbl_teknisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teknisi`
--

INSERT INTO `tbl_teknisi` (`id`, `nama`, `jabatan`, `nik`, `no_hp`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Radya1', 1, 123123, '087720729291', 'DUTA MEKAR, RT/RW 005/015, Kel/Desa ECILEUNGSIKIDUL, Kecamatan CILEUNGSI', 1, '2022-07-16 10:43:49', '2022-07-16 10:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wilayah`
--

CREATE TABLE `tbl_wilayah` (
  `id` int(11) NOT NULL,
  `wilayah` varchar(35) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wilayah`
--

INSERT INTO `tbl_wilayah` (`id`, `wilayah`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', 1, '2022-07-16 05:53:21', '2022-07-16 05:53:21'),
(2, 'Jakarta', 1, '2022-07-16 05:53:51', '2022-07-16 05:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_keluhan`
--
ALTER TABLE `tbl_keluhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wilayah`
--
ALTER TABLE `tbl_wilayah`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_keluhan`
--
ALTER TABLE `tbl_keluhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_wilayah`
--
ALTER TABLE `tbl_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- ALTER table `users` add column
--

-- ALTER table `users`
-- ADD `username` varchar(255) AFTER `name`,
-- ADD `role` varchar(255) AFTER `password`;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `username`, `email`, `password`, `role`) VALUES 
('admin', 'admin1', 'admin@admin.com', '$2a$12$pXIYa9Ld/AFl65QNAmWV/uSVj2C5WzyKVhrBwSqXOhIlsHfoMq3W6', '0'),
('teknisi1', 'teknisi1', 'teknisi@gmail.com', '$2a$12$pXIYa9Ld/AFl65QNAmWV/uSVj2C5WzyKVhrBwSqXOhIlsHfoMq3W6', '1');

--
--
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
