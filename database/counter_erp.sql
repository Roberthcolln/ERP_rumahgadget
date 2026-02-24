-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2026 pada 06.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counter_erp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-042b0bfc82ea08979ea1ba083bf4b6d3', 'i:1;', 1771721231),
('laravel-cache-042b0bfc82ea08979ea1ba083bf4b6d3:timer', 'i:1771721231;', 1771721231),
('laravel-cache-3e163eed328d91a543f0374de32513f5', 'i:1;', 1771725718),
('laravel-cache-3e163eed328d91a543f0374de32513f5:timer', 'i:1771725718;', 1771725718),
('laravel-cache-97ea0d204888a3914ddcab4360fd1c43', 'i:1;', 1771734811),
('laravel-cache-97ea0d204888a3914ddcab4360fd1c43:timer', 'i:1771734811;', 1771734811),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1771717304),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a:timer', 'i:1771717304;', 1771717304),
('laravel-cache-f980f13938d0ea754f5c742b4bba363b', 'i:1;', 1771718160),
('laravel-cache-f980f13938d0ea754f5c742b4bba363b:timer', 'i:1771718160;', 1771718160);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departement`
--

CREATE TABLE `departement` (
  `id_departement` int(10) UNSIGNED NOT NULL,
  `nama_departement` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departement`
--

INSERT INTO `departement` (`id_departement`, `nama_departement`, `created_at`, `updated_at`) VALUES
(1, 'Departemen Penjualan & Pemasaran', '2026-02-18 20:03:30', '2026-02-18 20:03:30'),
(2, 'Departemen Operasional', '2026-02-18 20:03:39', '2026-02-18 20:03:39'),
(3, 'Departemen Keuangan', '2026-02-18 20:03:50', '2026-02-18 20:03:50'),
(4, 'Departemen HRD', '2026-02-18 20:03:59', '2026-02-18 20:03:59'),
(5, 'Departemen Logistik', '2026-02-18 20:04:10', '2026-02-18 20:04:10'),
(6, 'Departemen IT', '2026-02-18 20:04:21', '2026-02-18 20:04:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(10) UNSIGNED NOT NULL,
  `nama_divisi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Divisi Penjualan Retail', '2026-02-18 20:04:49', '2026-02-18 20:04:49'),
(2, 'Divisi Toko / Store', '2026-02-18 20:05:03', '2026-02-18 20:05:03'),
(3, 'Divisi Akuntansi', '2026-02-18 20:05:13', '2026-02-18 20:05:13'),
(4, 'Divisi Pelatihan & Pengembangan', '2026-02-18 20:05:26', '2026-02-18 20:05:26'),
(5, 'Divisi Pergudangan', '2026-02-18 20:05:38', '2026-02-18 20:05:38'),
(6, 'Divisi Sistem & Database', '2026-02-18 20:05:48', '2026-02-18 20:05:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` bigint(20) UNSIGNED NOT NULL,
  `nama_gudang` varchar(255) NOT NULL,
  `kode_gudang` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `alamat_gudang` text DEFAULT NULL,
  `penanggung_jawab` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`, `kode_gudang`, `lokasi`, `alamat_gudang`, `penanggung_jawab`, `no_telp`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'Gudang GA', 'GNAG00A1', NULL, 'Gunung Agung', 'Fadli Marantika', NULL, 'aktif', NULL, '2026-02-18 15:50:12', '2026-02-18 15:50:12'),
(3, 'Gudang TU', 'TKUMRC003', NULL, 'Teuku Umar', 'Rama Widana', NULL, 'aktif', NULL, '2026-02-18 15:51:08', '2026-02-18 15:51:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_movement`
--

CREATE TABLE `inventory_movement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `id_gudang` bigint(20) UNSIGNED NOT NULL,
  `tipe` enum('IN','OUT','ADJUST') NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `inventory_movement`
--

INSERT INTO `inventory_movement` (`id`, `id_produk`, `id_gudang`, `tipe`, `qty`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'IN', 10, '10 PCS', '2026-02-18 14:36:55', '2026-02-18 14:36:55'),
(2, 1, 2, 'IN', 15, '15 PCS', '2026-02-18 14:38:09', '2026-02-18 14:38:09'),
(3, 1, 2, 'IN', 15, '15 PCS', '2026-02-18 14:40:04', '2026-02-18 14:40:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `id_kategori`, `nama_jenis`, `created_at`, `updated_at`) VALUES
(4, 3, 'IPhone New', '2026-02-17 10:09:37', '2026-02-17 10:09:37'),
(5, 3, 'IPhone Ex Ibox', '2026-02-17 10:10:10', '2026-02-17 10:10:10'),
(6, 4, 'Samsung', '2026-02-17 10:10:32', '2026-02-17 10:10:32'),
(7, 4, 'Vivo', '2026-02-17 10:10:45', '2026-02-17 10:10:45'),
(8, 4, 'OPPO', '2026-02-21 17:34:29', '2026-02-21 17:34:29'),
(9, 5, 'Pelindung (Protection)', '2026-02-21 17:41:44', '2026-02-21 17:41:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(3, 'Apple', '2026-02-17 09:49:33', '2026-02-17 09:49:33'),
(4, 'Android', '2026-02-17 09:49:42', '2026-02-17 09:49:42'),
(5, 'Aksesoris', '2026-02-21 17:40:37', '2026-02-21 17:40:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_admin`
--

CREATE TABLE `kategori_admin` (
  `id_kategori_admin` int(10) UNSIGNED NOT NULL,
  `nama_kategori_admin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_admin`
--

INSERT INTO `kategori_admin` (`id_kategori_admin`, `nama_kategori_admin`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2023-05-02 05:33:46', '2023-05-02 05:33:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_anggota`
--

CREATE TABLE `kategori_anggota` (
  `id_kategori_anggota` int(10) UNSIGNED NOT NULL,
  `nama_kategori_anggota` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_anggota`
--

INSERT INTO `kategori_anggota` (`id_kategori_anggota`, `nama_kategori_anggota`, `created_at`, `updated_at`) VALUES
(1, 'Karyawan Tetap (Permanent Employee)', '2026-02-18 20:01:28', '2026-02-18 20:01:28'),
(2, 'Karyawan Kontrak / Freelance', '2026-02-18 20:01:40', '2026-02-18 20:01:40'),
(3, 'Magang / Internship', '2026-02-18 20:01:50', '2026-02-18 20:01:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_15_170214_add_two_factor_columns_to_users_table', 1),
(5, '2026_01_15_170312_create_personal_access_tokens_table', 1),
(6, '2026_02_17_185658_create_produks_table', 2),
(7, '2026_02_17_193533_create_penjualan_table', 3),
(8, '2026_02_17_193611_create_penjualan_detail_table', 3),
(9, '2026_02_18_213059_create_gudangs_table', 4),
(10, '2026_02_18_213133_create_inventories_table', 4),
(11, '2026_02_18_213157_create_inventory_movements_table', 4),
(12, '2026_02_18_231337_add_field_2_to_setting_table', 5),
(13, '2026_02_18_234840_create_gudang_table', 6),
(14, '2026_02_19_012808_create_stok_table', 7),
(15, '2026_02_22_004928_create_supplier_table', 8),
(16, '2026_02_22_005040_add_supplier_to_produk_table', 9),
(17, '2026_02_22_023819_add_id_user_to_penjualan_table', 10),
(18, '2026_02_22_074809_create_pelanggans_table', 11),
(19, '2026_02_22_074836_add_customer_to_penjualan_table', 11),
(20, '2026_02_22_125211_create_offering_letters_table', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi_stok`
--

CREATE TABLE `mutasi_stok` (
  `id_mutasi` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_gudang` int(11) DEFAULT NULL,
  `tipe` enum('MASUK','KELUAR') DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `offering_letters`
--

CREATE TABLE `offering_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `nama_kandidat` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `status_kerja` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `penempatan` varchar(255) NOT NULL,
  `masa_training` int(11) NOT NULL,
  `maks_training` int(11) NOT NULL,
  `min_training` int(11) NOT NULL,
  `gaji_training` decimal(15,2) NOT NULL,
  `gaji_lulus` decimal(15,2) NOT NULL,
  `ruang_lingkup` text NOT NULL,
  `nda_klausul` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `offering_letters`
--

INSERT INTO `offering_letters` (`id`, `nomor_surat`, `nama_kandidat`, `posisi`, `status_kerja`, `tanggal_mulai`, `penempatan`, `masa_training`, `maks_training`, `min_training`, `gaji_training`, `gaji_lulus`, `ruang_lingkup`, `nda_klausul`, `created_at`, `updated_at`) VALUES
(1, 'RG/02-2026/001', 'Thania Pears', 'IT Staff Development', 'PKWT/PKWTT', '2026-02-23', 'Rumah Gadget Teuku Umar', 3, 4, 2, 3200000.00, 3700000.00, '<ul><li>Mengembangkan dan memelihara website perusahaan.</li><li>Melakukan perbaikan bug serta peningkatan performa sistem.</li><li>Berkolaborasi dengan tim desain/front-end dan tim operasional dalam pengembangan fitur.</li><li>Memastikan keamanan, stabilitas, serta optimalisasi website perusahaan.</li></ul>', '<ul><li>Data pelanggan dan supplier</li><li>Data penjualan dan strategi bisnis</li><li>Informasi sistem, source code, database, dan akses server</li><li>Informasi keuangan, kebijakan internal, dan dokumen perusahaan lainnya</li></ul>', '2026-02-22 05:02:46', '2026-02-22 05:02:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_hp`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Roberth', '082245782682', 'pattroberth13@gmail.com', '2026-02-21 23:56:21', '2026-02-21 23:56:21'),
(3, 'Colln', '082124944770', NULL, '2026-02-22 00:48:43', '2026-02-22 00:48:43'),
(4, 'Colln', '082124944773', 'kasir2@gmail.com', '2026-02-22 03:06:37', '2026-02-22 03:06:37'),
(5, 'Roberth', '082245782681', 'pattpolly16@gmail.com', '2026-02-22 03:09:40', '2026-02-22 03:09:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_pelanggan` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_invoice` varchar(255) NOT NULL,
  `tanggal_penjualan` datetime DEFAULT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('draft','selesai','batal') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bayar` bigint(20) DEFAULT NULL,
  `kembali` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_user`, `id_pelanggan`, `kode_invoice`, `tanggal_penjualan`, `total`, `status`, `created_at`, `updated_at`, `bayar`, `kembali`) VALUES
(1, 13, 1, 'INV1771718181', '2026-02-22 07:56:00', 91895000.00, 'selesai', '2026-02-21 23:56:21', '2026-02-21 23:56:21', 91895000, 0),
(2, 13, 1, 'INV1771719995', '2026-02-22 08:26:00', 43399000.00, 'selesai', '2026-02-22 00:26:35', '2026-02-22 00:26:35', 43399000, 0),
(4, 14, 3, 'INV1771721323', '2026-02-22 08:47:00', 72396000.00, 'selesai', '2026-02-22 00:48:43', '2026-02-22 00:48:43', 72400000, 4000),
(5, 14, 4, 'INV1771729597', '2026-02-22 11:06:00', 25499000.00, 'selesai', '2026-02-22 03:06:37', '2026-02-22 03:06:37', 25500000, 1000),
(6, 13, 5, 'INV1771729780', '2026-02-22 11:08:00', 3398000.00, 'selesai', '2026-02-22 03:09:40', '2026-02-22 03:09:40', 3400000, 2000),
(7, 14, 1, 'INV1771729857', '2026-02-22 11:10:00', 86798000.00, 'selesai', '2026-02-22 03:10:57', '2026-02-22 03:10:57', 86800000, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_penjualan` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_detail`, `id_penjualan`, `id_produk`, `qty`, `harga`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2, 43399000.00, 86798000.00, '2026-02-21 23:56:21', '2026-02-21 23:56:21'),
(2, 1, 5, 3, 1699000.00, 5097000.00, '2026-02-21 23:56:21', '2026-02-21 23:56:21'),
(3, 2, 4, 1, 43399000.00, 43399000.00, '2026-02-22 00:26:35', '2026-02-22 00:26:35'),
(8, 4, 8, 1, 25499000.00, 25499000.00, '2026-02-22 00:48:43', '2026-02-22 00:48:43'),
(9, 4, 3, 1, 43399000.00, 43399000.00, '2026-02-22 00:48:43', '2026-02-22 00:48:43'),
(10, 4, 6, 2, 1699000.00, 3398000.00, '2026-02-22 00:48:43', '2026-02-22 00:48:43'),
(11, 4, 7, 1, 100000.00, 100000.00, '2026-02-22 00:48:43', '2026-02-22 00:48:43'),
(12, 5, 8, 1, 25499000.00, 25499000.00, '2026-02-22 03:06:37', '2026-02-22 03:06:37'),
(13, 6, 5, 2, 1699000.00, 3398000.00, '2026-02-22 03:09:40', '2026-02-22 03:09:40'),
(14, 7, 3, 2, 43399000.00, 86798000.00, '2026-02-22 03:10:57', '2026-02-22 03:10:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `id_jenis` bigint(20) UNSIGNED NOT NULL,
  `id_tipe` bigint(20) UNSIGNED NOT NULL,
  `id_supplier` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `harga_produk` double NOT NULL,
  `harga_jual_produk` double NOT NULL,
  `harga_promo_produk` double DEFAULT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `id_jenis`, `id_tipe`, `id_supplier`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `harga_jual_produk`, `harga_promo_produk`, `gambar_produk`, `created_at`, `updated_at`) VALUES
(2, 3, 4, 3, 1, 'iPhone 13', '<p>Varian : 128gb<br>Color : Midnight</p>', 7999000, 8249000, 7999000, '1771436312.jpg', '2026-02-18 17:38:32', '2026-02-21 17:10:15'),
(3, 3, 4, 5, 1, 'iPhone 17 Pro Max', '<p>Varian : 2TB<br>Color : Cosmic Orange</p>', 43399000, 43999000, 43399000, '1771437184.jpg', '2026-02-18 17:53:04', '2026-02-21 17:10:32'),
(4, 3, 4, 5, 1, 'iPhone 17 Pro Max', '<p>Varian : 2TB<br>Color : Midnight</p>', 43399000, 43999000, 43399000, '1771438662.jpg', '2026-02-18 18:17:42', '2026-02-21 17:10:52'),
(5, 4, 8, 6, 2, 'OPPO A3X', '<p><strong>Varian </strong>: 4/128GB<br><strong>Warna</strong> : Nebula Red</p>', 1199000, 1699000, 0, '1771695413.png', '2026-02-21 17:36:53', '2026-02-21 17:36:53'),
(6, 4, 8, 6, 2, 'OPPO A3X', '<p><strong>Varian </strong>: 4/128GB<br>Warna : Nebula Red</p>', 1199000, 1699000, 0, '1771695547.png', '2026-02-21 17:39:07', '2026-02-21 17:39:07'),
(7, 5, 9, 7, 2, 'Casing Cover Hard Case HP iPhone 13 Pro Max', '<p>Case Motif Custom Gambar / Foto Desain Otomotif Mobil BMW Mercy Honda Mazda Toyota</p>', 75000, 125000, 100000, '1771695867.jpeg', '2026-02-21 17:44:27', '2026-02-21 17:44:27'),
(8, 3, 4, 5, 2, 'iPhone 17 Pro Max', '<p><strong>Varian </strong>: 256GB<br><strong>Warna </strong>: Silver</p>', 22499000, 25749000, 25499000, '1771696647.jpeg', '2026-02-21 17:57:27', '2026-02-21 17:57:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pusat`
--

CREATE TABLE `pusat` (
  `id_pusat` int(10) UNSIGNED NOT NULL,
  `nama_pusat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pusat`
--

INSERT INTO `pusat` (`id_pusat`, `nama_pusat`, `created_at`, `updated_at`) VALUES
(1, 'Rumah Gadget Bali', '2026-02-18 19:58:24', '2026-02-18 19:58:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `region`
--

CREATE TABLE `region` (
  `id_region` int(10) UNSIGNED NOT NULL,
  `id_pusat` int(11) NOT NULL,
  `nama_region` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `region`
--

INSERT INTO `region` (`id_region`, `id_pusat`, `nama_region`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gunung Agung', '2026-02-18 19:58:51', '2026-02-21 18:24:48'),
(2, 1, 'Teuku Umar', '2026-02-18 19:59:04', '2026-02-21 18:24:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BAc54B8zSMmpeFPfT4KOdmFY0vsmwuiNvnoqAW4T', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiajhrWHJJSDBKbkpPaVdDNFZjQmhGZDhaR1VoTDJtV3JoZGoyY3JpTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9vZmZlcmluZy1sZXR0ZXIiO3M6NToicm91dGUiO3M6MjE6Im9mZmVyaW5nLWxldHRlci5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE2O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2NDoiNTQ2MWY1YmQ4OWUzOGJmZmQzOGEyZWQ3MmMwNjAxOTU4M2JmM2M5ZDNkNjI0YWIyOWNlZTgzNWY5MjFhY2RiOSI7fQ==', 1771736862),
('BBk47VzofdC4ZZOIM8Ll1BbTV4pAXIAQfSunxhSd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiczVRb0F3emMwNEtjSk5ZZTdobUQwN3ptYkk0V2lZWVJPRjBEMXc4eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdXBwbGllciI7czo1OiJyb3V0ZSI7czoxNDoic3VwcGxpZXIuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2NDoiYTNlMjc0ZWNkN2U0OGQxNWJhOGE0ZjY0NDA5YzAzYTIyNzY1MWI3MGFhMjFhODU0YTRlNGE5YTQ1NDU1Y2MyNyI7fQ==', 1771736851),
('m403j9fVz5k1CsrjE3cNnw611ja542MPStGlq8GA', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ2NvY3pRNnNJaEIzaHpGWFhoNlF1SUV2QTZPVmJnTGw4dURVS1NYbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImRhc2hib2FyZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2NDoiODM0MWY0YmQyYTk0NThiNjY0MjBmODI3NDdmZWMxOTQyMGRjNGE5NWRmZjM0NTI3ZWViYTc1YzIxOTBhYjI1NiI7fQ==', 1771732539),
('mnzKEQpEXJwVYjOqKto197lSoJcXlz0ceEfKuqZF', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQnJoSlJnSHQ1T09XdmJPY04zMTlSMUlGZW1VRm05UTVwVkdzMVRociI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImRhc2hib2FyZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEzO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2NDoiNmMzNmJkZTA5MTlmNjBkZGUyYzk3YzQ3ZWRlMmE3YmQyY2IyYTAzY2E2ZTlmNTA5ZWVlYzU4YzAwYTc0ZWRlYiI7fQ==', 1771734460);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `instansi_setting` varchar(255) NOT NULL,
  `pimpinan_setting` varchar(255) NOT NULL,
  `logo_setting` varchar(255) NOT NULL,
  `favicon_setting` varchar(255) NOT NULL,
  `tentang_setting` text NOT NULL,
  `keyword_setting` varchar(255) NOT NULL,
  `alamat_setting` varchar(255) NOT NULL,
  `instagram_setting` varchar(255) NOT NULL,
  `youtube_setting` varchar(255) NOT NULL,
  `email_setting` varchar(255) NOT NULL,
  `no_hp_setting` varchar(255) NOT NULL,
  `maps_setting` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alamat_setting_2` varchar(255) DEFAULT NULL,
  `no_hp_setting_2` varchar(255) DEFAULT NULL,
  `email_setting_2` varchar(255) DEFAULT NULL,
  `maps_setting_2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `instansi_setting`, `pimpinan_setting`, `logo_setting`, `favicon_setting`, `tentang_setting`, `keyword_setting`, `alamat_setting`, `instagram_setting`, `youtube_setting`, `email_setting`, `no_hp_setting`, `maps_setting`, `created_at`, `updated_at`, `alamat_setting_2`, `no_hp_setting_2`, `email_setting_2`, `maps_setting_2`) VALUES
(1, 'Rumah Gadget', 'Roberth Colln', '1771350679_512x512.png', '1771350679_512x512.png', '<p>CRM Rumah Gadget Bali</p>', 'CRM Rumah Gadget Bali', 'Jl. Gn. Agung No.140A, Tegal Kertha, Kec. Denpasar Bar., Kota Denpasar, Bali 80111', 'https://www.instagram.com/robertj_colln/', 'https://www.youtube.com/watch?v=Mb_98vAimsw', 'rggunungagung@gmail.com', '081297600976', 'https://www.google.com/maps/embed?pb=!4v1771428148809!6m8!1m7!1sRHTujwMHpdlVMGdP6uA5Wg!2m2!1d-8.651670852486884!2d115.1966507223476!3f20.242256!4f0!5f0.7820865974627469', NULL, '2026-02-18 15:33:59', 'Jl. Teuku Umar No.63, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80113', '081297600976', 'rgteukuumar@gmail.com', 'https://www.google.com/maps/embed?pb=!4v1771428092619!6m8!1m7!1s8epLolCOFu-GnGvVr6hmtw!2m2!1d-8.671935486547097!2d115.2089626783986!3f112.8887!4f0!5f0.7820865974627469');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slip_gaji`
--

CREATE TABLE `slip_gaji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `periode` varchar(255) NOT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL,
  `tunjangan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `biaya_layanan` decimal(15,2) NOT NULL,
  `total_gaji` decimal(15,2) NOT NULL,
  `tanggal_cetak` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `slip_gaji`
--

INSERT INTO `slip_gaji` (`id`, `user_id`, `periode`, `gaji_pokok`, `tunjangan`, `potongan`, `biaya_layanan`, `total_gaji`, `tanggal_cetak`, `created_at`, `updated_at`) VALUES
(4, 13, '2026-02', 3747800.00, 1200345.00, 150000.00, 220500.00, 5018645.00, '2026-02-22', '2026-02-22 01:32:46', '2026-02-22 01:32:46'),
(6, 12, '2026-02', 2500000.00, 0.00, 0.00, 450000.00, 2950000.00, '2026-02-22', '2026-02-22 02:09:02', '2026-02-22 02:09:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `id_gudang` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id`, `id_produk`, `id_gudang`, `qty`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 0, NULL, '2026-02-19 19:00:49'),
(3, 3, 3, 2, NULL, '2026-02-22 03:10:57'),
(4, 4, 2, 9, NULL, '2026-02-22 00:26:35'),
(5, 5, 2, 16, NULL, '2026-02-22 03:09:40'),
(6, 6, 3, 8, NULL, '2026-02-22 00:48:43'),
(7, 7, 3, 0, NULL, '2026-02-22 00:48:43'),
(8, 8, 3, 10, NULL, '2026-02-22 03:06:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` bigint(20) UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `kode_supplier`, `email`, `telepon`, `alamat`, `perusahaan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PT Distributor Gadget Indonesia', 'PTDGI010', 'ptdgindonesia@gmail.com', '082245782682', 'Jl. KH. Hasyim Ashari No.35, RT.1/RW.11, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150', 'PT Distributor Gadget Indonesia', 'aktif', '2026-02-21 17:06:52', '2026-02-21 17:06:52'),
(2, 'Sinar Mutiara Cell', 'SMC0020', 'smcindo@gmail.com', '081181446698', 'Jl. Teuku Umar Kel. Daud No.88, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80113', 'Sinar Mutiara Cell', 'aktif', '2026-02-21 17:15:21', '2026-02-22 00:40:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `therapist`
--

CREATE TABLE `therapist` (
  `id_therapist` int(10) UNSIGNED NOT NULL,
  `nama_therapist` varchar(255) NOT NULL,
  `jenis_therapist` varchar(255) NOT NULL,
  `gambar_therapist` varchar(255) NOT NULL,
  `keterangan_therapist` text NOT NULL,
  `slug_therapist` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `therapist`
--

INSERT INTO `therapist` (`id_therapist`, `nama_therapist`, `jenis_therapist`, `gambar_therapist`, `keterangan_therapist`, `slug_therapist`, `created_at`, `updated_at`) VALUES
(1, 'Tannia', 'Complementary Therapy', 'therapist_20260115214747.jpg', '<p>It encompasses a variety of approaches such as massage, meditation, yoga, tai chi, and acupuncture, often used alongside conventional medical treatments.</p>', 'tannia', '2026-01-15 13:47:47', '2026-01-15 14:21:31'),
(2, 'Anabell Chelsea', 'Physical Therapy (Physiotherapy)', 'therapist_20260115221121.jpg', '<p>Helps restore movement and function after injury or illness, often using exercise, traction, or aquatic therapy.</p>', 'anabell-chelsea', '2026-01-15 14:11:21', '2026-01-15 14:11:21'),
(3, 'Sharoon', 'Speech Therapy', 'therapist_20260115221828.jpg', '<p>Assisting individuals with communication disorders, such as difficulties with speech, language, or swallowing.</p>', 'sharoon', '2026-01-15 14:18:28', '2026-01-15 14:18:28'),
(4, 'Elizabeth', 'Occupational Therapy', 'therapist_20260115222007.jpeg', '<p>Helping patients with physical, mental, or developmental limitations to carry out daily activities independently.</p>', 'elizabeth', '2026-01-15 14:20:07', '2026-01-15 14:20:07'),
(5, 'Bendenita', 'Psychotherapy (Mental Health Therapy)', 'therapist_20260115222403.jpeg', '<p>Focuses on mental and emotional health. Some types include:</p><ul><li>Cognitive Behavioral Therapy (CBT): Helps identify and change negative thought patterns and behaviors.</li><li>Interpersonal Therapy: Helps manage problems in relationships.</li><li>Family Therapy: Involves all family members to improve relationship dynamics.</li></ul>', 'bendenita', '2026-01-15 14:24:03', '2026-01-15 14:25:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe`
--

CREATE TABLE `tipe` (
  `id_tipe` int(10) UNSIGNED NOT NULL,
  `nama_tipe` varchar(255) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tipe`
--

INSERT INTO `tipe` (`id_tipe`, `nama_tipe`, `id_jenis`, `created_at`, `updated_at`) VALUES
(3, 'iPhone 13', 4, '2026-02-17 10:39:47', '2026-02-17 10:52:08'),
(4, 'Y04S', 7, '2026-02-17 11:12:34', '2026-02-17 11:12:34'),
(5, 'iPhone 17 Pro Max', 4, '2026-02-17 21:13:30', '2026-02-17 21:13:30'),
(6, 'OPPO A3X', 8, '2026-02-21 17:34:42', '2026-02-21 17:34:42'),
(7, 'Casing/Cover', 9, '2026-02-21 17:42:20', '2026-02-21 17:42:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `jenis_kelamin` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `id_kategori_anggota` int(11) DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `id_departement` int(11) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `tanggal_gabung` date DEFAULT NULL,
  `id_pusat` int(11) DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL,
  `id_chapter` int(11) DEFAULT NULL,
  `id_community` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `no_hp`, `id_provinsi`, `id_kota`, `alamat`, `status`, `jenis_kelamin`, `tanggal_lahir`, `id_kategori_anggota`, `id_divisi`, `id_departement`, `nik`, `jabatan`, `tanggal_gabung`, `id_pusat`, `id_region`, `id_chapter`, `id_community`, `foto`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin Rumah Gadget', 'admin@gmail.com', NULL, 1, '$2y$12$.VEO2SqE4s/s9Yp17KX0wOLNZAxklh1ajBlVP9JlFr2/1bK4hS11e', '8222222', 1, 2, 'Jl. Dr. Sitanala No. 9', 'Verifikasi', 'Laki-laki', '1972-01-21', 3, 1, 1, '811111', 'Admin', NULL, 1, 1, 1, 1, '1.png', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-17 13:00:22', '2026-02-18 18:40:08'),
(12, 'Roberth_ colln', 'pattroberth13@gmail.com', NULL, 0, '$2y$12$RxFrw40XTanLNBYn8qRM..T5qU1wUq52zKueQw183dd21c/hKfvP6', '82245782682', NULL, NULL, 'Jl. Bhuana Surya IC No. 27 Dalung', 'Verifikasi', 'Laki-laki', '1997-09-13', 2, 6, 6, '1234567890123456', 'Web Developer / E-commerce Specialist', '2026-02-23', 1, 1, NULL, NULL, 'Foto20260219044404.png', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:44:04', '2026-02-18 20:44:04'),
(13, 'Chelsea Marsia June', 'kasir@gmail.com', NULL, 0, '$2y$12$65TGWR/pULeJuffID2gatuyYrpLSzM4OdRbxvIrjViLvwGbw7KZpi', '82247568902', NULL, NULL, 'Jl. Jalan Jalan Menuju Roma', 'Verifikasi', 'Perempuan', '2002-12-12', 1, 2, NULL, '1234567890123456', 'Kasir', '2026-02-03', 1, 1, NULL, NULL, 'Foto20260220020406.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 18:04:07', '2026-02-22 01:50:11'),
(14, 'Thania Sharon', 'kasir2@gmail.com', NULL, 0, '$2y$12$u1X.FfobehPVtWTNQ1OAKOVa5TPT1yHMYovO.//lGDNeQW2Kbd6FO', '82123568907', NULL, NULL, 'Jalan Tegal Permai No. 22, Dalung', 'Verifikasi', 'Perempuan', '2005-08-13', 1, 2, 2, '1234567890123454', 'Kasir', '2026-02-17', 1, 2, NULL, NULL, 'Foto_1771530471.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 18:31:31', '2026-02-19 19:47:51'),
(15, 'Colln Junifel', 'collnjun@gmail.com', NULL, 0, '$2y$12$.DwDUTE490nDfy88tZCHdeHsM2KrmPfh/5FjWkD.CjnOEwsFeGj2G', '82254672290', NULL, NULL, 'Jl. Bhuana Surya IC No. 27 Dalung', 'Verifikasi', 'Laki-laki', '2012-01-28', 1, 5, 5, '123213544578945', 'Driver', '2026-02-04', 1, 2, NULL, NULL, 'Foto20260222112112.png', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-22 03:21:13', '2026-02-22 03:21:13'),
(16, 'Rian', 'rian@gmail.com', NULL, 0, '$2y$12$xpTi6a6nexXzIUB.M9OmleB.zWH4C0p5Sf92u8IfvIWN3m/OY8ICm', '82356739976', NULL, NULL, 'Desa Ayunan, Abiansemal, badung - Bali', 'Verifikasi', 'Laki-laki', '1996-02-24', 1, 4, 4, '1234567890123454', 'HRD', '2026-02-02', 1, 2, NULL, NULL, 'Foto20260222122654.png', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-22 04:26:54', '2026-02-22 04:26:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD UNIQUE KEY `gudang_kode_gudang_unique` (`kode_gudang`);

--
-- Indeks untuk tabel `inventory_movement`
--
ALTER TABLE `inventory_movement`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kategori_admin`
--
ALTER TABLE `kategori_admin`
  ADD PRIMARY KEY (`id_kategori_admin`);

--
-- Indeks untuk tabel `kategori_anggota`
--
ALTER TABLE `kategori_anggota`
  ADD PRIMARY KEY (`id_kategori_anggota`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  ADD PRIMARY KEY (`id_mutasi`);

--
-- Indeks untuk tabel `offering_letters`
--
ALTER TABLE `offering_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `penjualan_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_supplier_foreign` (`id_supplier`);

--
-- Indeks untuk tabel `pusat`
--
ALTER TABLE `pusat`
  ADD PRIMARY KEY (`id_pusat`);

--
-- Indeks untuk tabel `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slip_gaji_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `supplier_kode_supplier_unique` (`kode_supplier`);

--
-- Indeks untuk tabel `therapist`
--
ALTER TABLE `therapist`
  ADD PRIMARY KEY (`id_therapist`);

--
-- Indeks untuk tabel `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `inventory_movement`
--
ALTER TABLE `inventory_movement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_admin`
--
ALTER TABLE `kategori_admin`
  MODIFY `id_kategori_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_anggota`
--
ALTER TABLE `kategori_anggota`
  MODIFY `id_kategori_anggota` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `offering_letters`
--
ALTER TABLE `offering_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pusat`
--
ALTER TABLE `pusat`
  MODIFY `id_pusat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `slip_gaji`
--
ALTER TABLE `slip_gaji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `therapist`
--
ALTER TABLE `therapist`
  MODIFY `id_therapist` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id_tipe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
