-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2026 at 09:50 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0; -- Nonaktifkan sementara foreign key checks
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u610382372_siakad_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `conf_app`
--

CREATE TABLE `conf_app` (
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `app_nama` varchar(255) NOT NULL,
  `app_desc` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_logo_w` varchar(255) DEFAULT NULL,
  `app_icon` varchar(255) NOT NULL,
  `app_author` varchar(100) NOT NULL,
  `app_alamat` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_tlp` varchar(255) NOT NULL,
  `app_set_penawaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conf_app`
--

INSERT INTO `conf_app` (`app_id`, `app_nama`, `app_desc`, `app_logo`, `app_logo_w`, `app_icon`, `app_author`, `app_alamat`, `app_email`, `app_tlp`, `app_set_penawaran`, `created_at`, `updated_at`) VALUES
(1, 'SI ADEK - STIKES Pelita Ibu', 'Sistem Informasi Akademik STIKES Pelita Ibu', 'komponen/assets/images/logo_1742715970.png', 'komponen/assets/images/logo_1717987360.png', 'komponen/assets/images/logo_1688627546.png', 'Sekolah Tinggi Ilmu Kesehatan Pelita Ibu', 'Jln. Kampung Baru Anduonohu, Kendari, Sulawesi Tenggara', 'info@pelitaibu.ac.id', '081221090122', 0, '2022-12-20 13:55:25', '2025-03-23 15:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_18_072725_create_fakultas_table', 1),
(6, '2022_12_18_072835_create_jurusans_table', 1),
(7, '2022_12_18_073549_create_dosens_table', 1),
(8, '2022_12_18_073817_create_mahasiswas_table', 1),
(9, '2022_12_18_074708_create_matkuls_table', 1),
(10, '2022_12_18_075030_create_tahun_ajars_table', 1),
(11, '2022_12_18_075037_create_krs_table', 1),
(12, '2022_12_18_075713_create_nilais_table', 1),
(13, '2022_12_18_080142_create_apps_table', 1),
(14, '2022_12_18_080343_create_agamas_table', 1),
(15, '2022_12_18_081838_update_fakultas', 2),
(16, '2022_12_18_081846_update_jurusan', 2),
(17, '2022_12_21_120645_create_ruangs_table', 3),
(18, '2023_01_08_111255_update_table_dosen', 4),
(19, '2023_01_08_112331_update_table_mhs', 4),
(20, '2023_01_08_143244_create_kecamatans_table', 5),
(21, '2023_01_08_143314_create_keldes_table', 5),
(22, '2023_02_27_212341_create_waktus_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_agama`
--

CREATE TABLE `ref_agama` (
  `agm_id` bigint(20) UNSIGNED NOT NULL,
  `agm_nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_agama`
--

INSERT INTO `ref_agama` (`agm_id`, `agm_nama`, `created_at`, `updated_at`) VALUES
(1, 'Islam', NULL, NULL),
(2, 'Katolik', NULL, NULL),
(3, 'Kristen', NULL, NULL),
(4, 'Hindu', NULL, NULL),
(5, 'Budha', NULL, NULL),
(6, 'Konghucu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_kecamatan`
--

CREATE TABLE `ref_kecamatan` (
  `kec_id` bigint(20) UNSIGNED NOT NULL,
  `kec_kode` varchar(50) DEFAULT NULL,
  `kec_nama` varchar(255) NOT NULL,
  `kec_kabkota` varchar(255) NOT NULL,
  `kec_prov` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_kecamatan`
--

INSERT INTO `ref_kecamatan` (`kec_id`, `kec_kode`, `kec_nama`, `kec_kabkota`, `kec_prov`, `created_at`, `updated_at`) VALUES
(1, '010101', 'Kec. Kepulauan Seribu Selatan', 'Kab. Kepulauan Seribu', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(2, '010102', 'Kec. Kepulauan Seribu Utara', 'Kab. Kepulauan Seribu', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(3, '016001', 'Kec. Tanah Abang', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(4, '016002', 'Kec. Menteng', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(5, '016003', 'Kec. Senen', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(6, '016004', 'Kec. Johar Baru', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(7, '016005', 'Kec. Cempaka Putih', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(8, '016006', 'Kec. Kemayoran', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(9, '016007', 'Kec. Sawah Besar', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(10, '016008', 'Kec. Gambir', 'Kota Jakarta Pusat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(11, '016101', 'Kec. Penjaringan', 'Kota Jakarta Utara', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(12, '016102', 'Kec. Pademangan', 'Kota Jakarta Utara', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(13, '016103', 'Kec. Tanjung Priok', 'Kota Jakarta Utara', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(14, '016104', 'Kec. Koja', 'Kota Jakarta Utara', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(15, '016105', 'Kec. Kelapa Gading', 'Kota Jakarta Utara', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(16, '016106', 'Kec. Cilincing', 'Kota Jakarta Utara', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(17, '016201', 'Kec. Kembangan', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(18, '016202', 'Kec. Kebon Jeruk', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(19, '016203', 'Kec. Palmerah', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(20, '016204', 'Kec. Grogol Petamburan', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(21, '016205', 'Kec. Tambora', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(22, '016206', 'Kec. Taman Sari', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(23, '016207', 'Kec. Cengkareng', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(24, '016208', 'Kec. Kali Deres', 'Kota Jakarta Barat', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(25, '016301', 'Kec. Jagakarsa', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(26, '016302', 'Kec. Pasar Minggu', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(27, '016303', 'Kec. Cilandak', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(28, '016304', 'Kec. Pesanggrahan', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(29, '016305', 'Kec. Kebayoran Lama', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(30, '016306', 'Kec. Kebayoran Baru', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(31, '016307', 'Kec. Mampang Prapatan', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(32, '016308', 'Kec. Pancoran', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(33, '016309', 'Kec. Tebet', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(34, '016310', 'Kec. Setia Budi', 'Kota Jakarta Selatan', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(35, '016401', 'Kec. Pasar Rebo', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(36, '016402', 'Kec. Ciracas', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(37, '016403', 'Kec. Cipayung', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(38, '016404', 'Kec. Makasar', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(39, '016405', 'Kec. Kramat Jati', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(40, '016406', 'Kec. Jatinegara', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(41, '016407', 'Kec. Duren Sawit', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(42, '016408', 'Kec. Cakung', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(43, '016409', 'Kec. Pulo Gadung', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(44, '016410', 'Kec. Matraman', 'Kota Jakarta Timur', 'Prov. D.K.I. Jakarta', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(45, '020501', 'Kec. Nanggung', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(46, '020502', 'Kec. Leuwiliang', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(47, '020503', 'Kec. Pamijahan', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(48, '020504', 'Kec. Cibungbulang', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(49, '020505', 'Kec. Ciampea', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(50, '020506', 'Kec. Dramaga', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(51, '020507', 'Kec. Ciomas', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(52, '020508', 'Kec. Cijeruk', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(53, '020509', 'Kec. Caringin', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(54, '020510', 'Kec. Ciawi', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(55, '020511', 'Kec. Cisarua', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(56, '020512', 'Kec. Megamendung', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(57, '020513', 'Kec. Sukaraja', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(58, '020514', 'Kec. Babakan Madang', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(59, '020515', 'Kec. Sukamakmur', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(60, '020516', 'Kec. Cariu', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(61, '020517', 'Kec. Jonggol', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(62, '020518', 'Kec. Cileungsi', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(63, '020519', 'Kec. Gunungputri', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(64, '020520', 'Kec. Citeureup', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(65, '020521', 'Kec. Cibinong', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(66, '020522', 'Kec. Bojong Gede', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(67, '020523', 'Kec. Kemang', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(68, '020524', 'Kec. Parung', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(69, '020525', 'Kec. Gunung Sindur', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(70, '020526', 'Kec. Rumpin', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(71, '020527', 'Kec. Cigudeg', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(72, '020528', 'Kec. Jasinga', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(73, '020529', 'Kec. Tenjo', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(74, '020530', 'Kec. Parungpanjang', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(75, '020531', 'Kec. Tamansari', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(76, '020532', 'Kec. Ciseeng', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(77, '020533', 'Kec. Kelapa Nunggal', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(78, '020534', 'Kec. Sukajaya', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(79, '020535', 'Kec. Ranca Bungur', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(80, '020536', 'Kec. Tanjung Sari', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(81, '020537', 'Kec. Tajurhalang', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(82, '020538', 'Kec. Cigombong', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(83, '020539', 'Kec. Leuwisadeng', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(84, '020540', 'Kec. Tenjolaya', 'Kab. Bogor', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(85, '020601', 'Kec. Ciemas', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(86, '020602', 'Kec. Ciracap', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(87, '020603', 'Kec. Surade', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(88, '020604', 'Kec. Jampang Kulon', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(89, '020605', 'Kec. Kalibunder', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(90, '020606', 'Kec. Tegalbuleud', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(91, '020607', 'Kec. Cidolog', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(92, '020608', 'Kec. Sagaranten', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(93, '020609', 'Kec. Pabuaran', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(94, '020610', 'Kec. Lengkong', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(95, '020611', 'Kec. Pelabuhan Ratu', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(96, '020612', 'Kec. Warung Kiara', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(97, '020613', 'Kec. Jampang Tengah', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(98, '020614', 'Kec. Cikembar', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(99, '020615', 'Kec. Nyalindung', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(100, '020616', 'Kec. Gegerbitung', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(101, '020617', 'Kec. Sukaraja', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(102, '020618', 'Kec. Sukabumi', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(103, '020619', 'Kec. Kadudampit', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(104, '020620', 'Kec. Cisaat', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(105, '020621', 'Kec. Cibadak', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(106, '020622', 'Kec. Nagrak', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(107, '020623', 'Kec. Cicurug', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(108, '020624', 'Kec. Cidahu', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(109, '020625', 'Kec. Parakansalak', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(110, '020626', 'Kec. Parungkuda', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(111, '020627', 'Kec. Kalapa Nunggal', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(112, '020628', 'Kec. Cikidang', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(113, '020629', 'Kec. Cisolok', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(114, '020630', 'Kec. Kabandungan', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(115, '020631', 'Kec. Gunung Guruh', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(116, '020632', 'Kec. Cikakak', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(117, '020633', 'Kec. Bantar Gadung', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(118, '020634', 'Kec. Cicantayan', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(119, '020635', 'Kec. Simpenan', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(120, '020636', 'Kec. Kebon Pedes', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(121, '020637', 'Kec. Cidadap', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(122, '020638', 'Kec. Cibitung', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(123, '020639', 'Kec. Curugkembar', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(124, '020640', 'Kec. Purabaya', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(125, '020641', 'Kec. Cireunghas', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(126, '020642', 'Kec. Sukalarang', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(127, '020643', 'Kec. Caringin', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(128, '020644', 'Kec. Bojong Genteng', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(129, '020645', 'Kec. Waluran', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(130, '020646', 'Kec. Cimanggu', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(131, '020647', 'Kec. Ciambar', 'Kab. Sukabumi', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(132, '020701', 'Kec. Agrabinta', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(133, '020702', 'Kec. Sindang Barang', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(134, '020703', 'Kec. Cidaun', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(135, '020704', 'Kec. Naringgul', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(136, '020705', 'Kec. Cibinong', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(137, '020706', 'Kec. Tanggeung', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(138, '020707', 'Kec. Kadupandak', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(139, '020708', 'Kec. Takokak', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(140, '020709', 'Kec. Sukanagara', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(141, '020710', 'Kec. Pagelaran', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(142, '020711', 'Kec. Campaka', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(143, '020712', 'Kec. Cibeber', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(144, '020713', 'Kec. Warungkondang', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(145, '020714', 'Kec. Cilaku', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(146, '020715', 'Kec. Sukaluyu', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(147, '020717', 'Kec. Ciranjang', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(148, '020718', 'Kec. Mande', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(149, '020719', 'Kec. Karang Tengah', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(150, '020720', 'Kec. Cianjur', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(151, '020721', 'Kec. Cugenang', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(152, '020722', 'Kec. Pacet', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(153, '020723', 'Kec. Sukaresmi', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(154, '020724', 'Kec. Cikalong Kulon', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(155, '020725', 'Kec. Bojong Picung', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(156, '020726', 'Kec. Campaka Mulya', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(157, '020727', 'Kec. Cikadu', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(158, '020728', 'Kec. Leles', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(159, '020729', 'Kec. Haurwangi', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(160, '020730', 'Kec. Pagelaran', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(161, '020731', 'Kec. Cijati', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(162, '020732', 'Kec. Cikalong', 'Kab. Cianjur', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(163, '020801', 'Kec. Cipanas', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(164, '020802', 'Kec. Cikalong Wetan', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(165, '020803', 'Kec. Ngamprah', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(166, '020804', 'Kec. Cipatat', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(167, '020805', 'Kec. Padalarang', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(168, '020806', 'Kec. Batujajar', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(169, '020807', 'Kec. Cihampelas', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(170, '020808', 'Kec. Cililin', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(171, '020809', 'Kec. Cipeundeuy', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(172, '020810', 'Kec. Parongpong', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(173, '020811', 'Kec. Lembang', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(174, '020812', 'Kec. Saguling', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(175, '020813', 'Kec. Cisarua', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(176, '020814', 'Kec. Cikalong', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(177, '020815', 'Kec. Cipongkor', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(178, '020816', 'Kec. Rongga', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(179, '020817', 'Kec. Sindangkerta', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(180, '020818', 'Kec. Gununghalu', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(181, '020819', 'Kec. Klari', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(182, '020820', 'Kec. Jayakerta', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(183, '020821', 'Kec. Lemahabang', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(184, '020822', 'Kec. Cilamay', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(185, '020823', 'Kec. Karawang', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(186, '020824', 'Kec. Rawamerta', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(187, '020825', 'Kec. Tempuran', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(188, '020826', 'Kec. Kotabaru', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(189, '020827', 'Kec. Majalaya', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(190, '020828', 'Kec. Cikampek', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(191, '020829', 'Kec. Jatisari', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(192, '020830', 'Kec. Cilodong', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(193, '020831', 'Kec. Karawang Timur', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(194, '020832', 'Kec. Telukjambe Timur', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(195, '020833', 'Kec. Telukjambe Barat', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(196, '020834', 'Kec. Klari', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(197, '020835', 'Kec. Rengasdengklok', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(198, '020836', 'Kec. Jayakerta', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(199, '020837', 'Kec. Lemahabang', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14'),
(200, '020838', 'Kec. Cilamay', 'Kab. Bandung', 'Prov. Jawa Barat', '2023-01-09 13:11:14', '2023-01-09 13:11:14');

-- 
-- Lanjutan dari file asli akan disisipkan di sini
-- 

COMMIT;

-- Aktifkan kembali foreign key checks
SET FOREIGN_KEY_CHECKS = 1;