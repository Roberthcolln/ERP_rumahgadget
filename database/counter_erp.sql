-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Feb 2026 pada 04.54
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
-- Struktur dari tabel `aksesoris`
--

CREATE TABLE `aksesoris` (
  `id_aksesoris` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_aksesoris` bigint(20) UNSIGNED NOT NULL,
  `id_supplier` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_aksesoris` varchar(255) NOT NULL,
  `deskripsi_aksesoris` text DEFAULT NULL,
  `harga_aksesoris` double NOT NULL,
  `harga_jual_aksesoris` double NOT NULL,
  `harga_promo_aksesoris` double DEFAULT NULL,
  `gambar_aksesoris` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aksesoris`
--

INSERT INTO `aksesoris` (`id_aksesoris`, `id_kategori_aksesoris`, `id_supplier`, `nama_aksesoris`, `deskripsi_aksesoris`, `harga_aksesoris`, `harga_jual_aksesoris`, `harga_promo_aksesoris`, `gambar_aksesoris`, `created_at`, `updated_at`) VALUES
(14, 10, 1, 'Motif Character', '<p>Mantap</p>', 20000, 25000, 0, '1772082501_699fd5454b2f3.png', '2026-02-26 05:08:21', '2026-02-26 05:08:21'),
(15, 11, 2, 'Jisu Handheld Life 5', '<p>Bagus</p>', 200000, 229000, 0, '1772084859_699fde7bb967c.jpg', '2026-02-26 05:47:39', '2026-02-26 05:47:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(10) UNSIGNED NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi_berita` text NOT NULL,
  `gambar_berita` varchar(255) NOT NULL,
  `slug_berita` varchar(255) NOT NULL,
  `tgl_berita` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `isi_berita`, `gambar_berita`, `slug_berita`, `tgl_berita`, `created_at`, `updated_at`) VALUES
(7, 'Cara Mengetahui HP Disadap, Ciri-Ciri dan Cara Mengatasinya', '<p>Di era digital seperti sekarang, banyak orang mulai khawatir soal keamanan privasi. Tidak sedikit yang bertanya, <strong>bagaimana cara mengetahui HP disadap atau tidak</strong>. Apalagi dengan maraknya kasus kebocoran data, phishing, hingga penyadapan lewat aplikasi tertentu, rasa curiga itu jadi masuk akal.</p><p>Sebenarnya, penyadapan HP bukan sekadar mitos. Tapi kabar baiknya, ada tanda-tanda yang bisa kita kenali sejak awal. Kalau kamu merasa ada yang aneh dengan ponselmu, simak penjelasan lengkap berikut ini.</p><h2>Apakah HP Bisa Disadap?</h2><p>Jawabannya: bisa.</p><p>Penyadapan bisa terjadi melalui:</p><ul><li>Aplikasi berbahaya (spyware)</li><li>Link phishing</li><li>WiFi publik yang tidak aman</li><li>Akses fisik ke perangkat</li><li>Clone akun WhatsApp</li></ul><p>Bahkan, menurut imbauan keamanan digital dari Kementerian Komunikasi dan Informatika Republik Indonesia, masyarakat diminta lebih waspada terhadap aplikasi tidak resmi dan tautan mencurigakan yang berpotensi mencuri data pribadi.</p><p>Artinya, memahami cara mengetahui HP disadap itu penting sebagai langkah pencegahan.</p><h2>Ciri-Ciri HP Disadap yang Paling Umum</h2><p>Berikut tanda-tanda yang sering muncul jika HP kamu terindikasi disadap:</p><h3>1. Baterai Cepat Habis Padahal Tidak Dipakai Berat</h3><p>Spyware biasanya berjalan di latar belakang dan terus mengirim data. Ini membuat baterai lebih boros dari biasanya.</p><h3>2. HP Terasa Panas Tanpa Alasan Jelas</h3><p>Kalau ponsel terasa panas padahal tidak dipakai gaming atau streaming, bisa jadi ada proses tersembunyi yang aktif.</p><h3>3. Muncul Aplikasi Asing yang Tidak Pernah Diinstal</h3><p>Cek daftar aplikasi. Kalau ada yang mencurigakan, jangan langsung diabaikan.</p><h3>4. Kuota Internet Cepat Habis</h3><p>Aplikasi penyadap bekerja dengan mengirim data ke server tertentu, yang membuat konsumsi data meningkat drastis.</p><h3>5. Muncul SMS atau Notifikasi Aneh</h3><p>Kode OTP atau SMS asing tanpa kamu minta bisa jadi tanda akun sedang diakses orang lain.</p><h2>Cara Mengetahui HP Disadap Secara Manual</h2><p>Sekarang kita masuk ke bagian paling penting: <strong>cara mengetahui HP disadap dengan langkah sederhana.</strong></p><h3>1. Cek Penggunaan Baterai</h3><p>Masuk ke:<br>Pengaturan → Baterai → Penggunaan Baterai</p><p>Lihat aplikasi mana yang paling boros. Jika ada aplikasi tidak dikenal mengonsumsi daya besar, patut dicurigai.</p><h3>2. Cek Penggunaan Data Internet</h3><p>Masuk ke:<br>Pengaturan → Jaringan → Penggunaan Data</p><p>Perhatikan aplikasi yang aktif di latar belakang tanpa kamu buka.</p><h3>3. Gunakan Kode USSD</h3><p>Beberapa kode yang bisa dicoba:</p><p>*#21# → untuk cek pengalihan panggilan</p><p>*#62# → untuk cek nomor pengalihan saat tidak aktif</p><p>##002# → untuk menonaktifkan semua pengalihan</p><p>Jika muncul pengalihan ke nomor asing yang tidak kamu kenal, segera nonaktifkan.</p><h3>4. Periksa WhatsApp Web</h3><p>Buka:<br>WhatsApp → Titik tiga → Perangkat Tertaut</p><p>Pastikan tidak ada perangkat asing yang login tanpa izin.</p><h2>Cara Mengatasi Jika HP Terindikasi Disadap</h2><p>Kalau kamu merasa ada tanda-tanda mencurigakan, lakukan ini:</p><h3>✅ Hapus Aplikasi Mencurigakan</h3><p>Uninstall aplikasi yang tidak jelas asal-usulnya.</p><h3>✅ Ganti Semua Password</h3><p>Mulai dari email, media sosial, hingga mobile banking.</p><h3>✅ Update Sistem Operasi</h3><p>Update biasanya menutup celah keamanan.</p><h3>✅ Reset Pabrik (Factory Reset)</h3><p>Ini cara paling ampuh untuk menghilangkan spyware. Pastikan backup data penting dulu.</p><h3>✅ Aktifkan Verifikasi Dua Langkah</h3><p>Terutama untuk WhatsApp, Gmail, dan akun penting lainnya.</p><h2>Cara Mencegah HP Disadap</h2><p>Lebih baik mencegah daripada mengatasi. Berikut tipsnya:</p><ul><li>Jangan klik link sembarangan</li><li>Hindari install aplikasi dari luar Play Store / App Store</li><li>Jangan pakai WiFi publik tanpa VPN</li><li>Kunci HP dengan PIN atau biometrik</li><li>Jangan pernah meminjamkan HP ke orang sembarangan</li></ul><p>Menurut panduan keamanan dari Badan Siber dan Sandi Negara, kesadaran pengguna adalah pertahanan pertama terhadap serangan siber.</p><h2>FAQ Seputar HP Disadap</h2><h3>Apakah HP bisa disadap tanpa kita tahu?</h3><p>Bisa. Itulah kenapa penting memahami cara mengetahui HP disadap sejak dini.</p><h3>Apakah reset HP bisa menghilangkan penyadapan?</h3><p>Ya, dalam banyak kasus spyware akan hilang setelah reset pabrik.</p><h3>Apakah WhatsApp bisa disadap?</h3><p>Bisa jika kode OTP bocor atau WhatsApp Web diakses tanpa izin.</p><h2>Kesimpulan</h2><p>Cara mengetahui HP disadap sebenarnya tidak serumit yang dibayangkan. Kuncinya adalah peka terhadap perubahan kecil pada perangkat: baterai boros, data cepat habis, atau muncul aktivitas aneh.</p><p>Kalau kamu menemukan satu atau dua tanda, jangan panik. Lakukan pengecekan bertahap dan amankan akun pentingmu segera.</p><p>Privasi itu bukan hal sepele. Di dunia digital, yang lengah biasanya jadi korban pertama.</p><p>Cek <a href=\"http://localhost:8000/harga\"><strong>Pricelist Kami</strong></a> Sekarang! Temukan Rekomendasi Gadget Terbaru yang Fenomenal Setiap Hari.</p>', 'Berita20260227104526.png', 'cara-mengetahui-hp-disadap-ciri-ciri-dan-cara-mengatasinya', '2026-02-27', '2026-02-27 02:45:26', '2026-02-27 02:46:41');

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
('laravel-cache-c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1772155425),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a:timer', 'i:1772155425;', 1772155425),
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
-- Struktur dari tabel `gudang_aksesoris`
--

CREATE TABLE `gudang_aksesoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_aksesoris` bigint(20) UNSIGNED NOT NULL,
  `id_gudang` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gudang_aksesoris`
--

INSERT INTO `gudang_aksesoris` (`id`, `id_aksesoris`, `id_gudang`, `qty`, `created_at`, `updated_at`) VALUES
(1, 14, 2, 10, '2026-02-26 05:08:21', '2026-02-26 05:08:21'),
(2, 15, 2, 10, '2026-02-26 05:47:39', '2026-02-26 05:47:39');

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
(4, 3, 'iPhone New', '2026-02-17 10:09:37', '2026-02-26 14:41:09'),
(5, 3, 'iPhone Ex Ibox', '2026-02-17 10:10:10', '2026-02-26 14:41:19'),
(6, 4, 'Samsung', '2026-02-17 10:10:32', '2026-02-17 10:10:32'),
(7, 4, 'Vivo', '2026-02-17 10:10:45', '2026-02-17 10:10:45'),
(8, 4, 'OPPO', '2026-02-21 17:34:29', '2026-02-21 17:34:29'),
(9, 5, 'Pelindung (Protection)', '2026-02-21 17:41:44', '2026-02-21 17:41:44'),
(10, 3, 'iPhone Second', '2026-02-26 14:24:21', '2026-02-26 14:24:21'),
(11, 4, 'Android Second', '2026-02-26 14:24:47', '2026-02-26 14:24:47');

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
-- Struktur dari tabel `kategori_aksesoris`
--

CREATE TABLE `kategori_aksesoris` (
  `id_kategori_aksesoris` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori_aksesoris` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_aksesoris`
--

INSERT INTO `kategori_aksesoris` (`id_kategori_aksesoris`, `nama_kategori_aksesoris`, `created_at`, `updated_at`) VALUES
(10, 'Case iPhone', '2026-02-26 04:54:49', '2026-02-26 04:54:49'),
(11, 'Mini Fan', '2026-02-26 05:46:33', '2026-02-26 05:46:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_service`
--

CREATE TABLE `kategori_service` (
  `id_kategori_service` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori_service` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_service`
--

INSERT INTO `kategori_service` (`id_kategori_service`, `nama_kategori_service`, `created_at`, `updated_at`) VALUES
(6, 'Service iPhone', '2026-02-25 07:27:33', '2026-02-25 07:27:33'),
(7, 'Service iPad', '2026-02-25 07:27:50', '2026-02-25 07:27:50'),
(8, 'Service iWatch', '2026-02-25 07:28:07', '2026-02-25 07:28:07'),
(9, 'Service MacBook', '2026-02-25 07:28:19', '2026-02-25 07:28:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit_produk`
--

CREATE TABLE `kredit_produk` (
  `id_kredit` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `id_jenis` int(10) UNSIGNED NOT NULL,
  `id_tipe` int(10) UNSIGNED NOT NULL,
  `id_varian` int(10) UNSIGNED NOT NULL,
  `id_warna` int(10) UNSIGNED NOT NULL,
  `harga_kredit` decimal(15,2) NOT NULL,
  `dp` decimal(15,2) NOT NULL,
  `cicilan` enum('6','9','12') NOT NULL,
  `harga_cicilan` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kredit_produk`
--

INSERT INTO `kredit_produk` (`id_kredit`, `id_kategori`, `id_jenis`, `id_tipe`, `id_varian`, `id_warna`, `harga_kredit`, `dp`, `cicilan`, `harga_cicilan`, `created_at`, `updated_at`) VALUES
(2, 3, 4, 3, 3, 13, 10999000.00, 0.00, '12', 1567000.00, '2026-02-26 08:51:16', '2026-02-26 08:51:16');

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
(20, '2026_02_22_125211_create_offering_letters_table', 12),
(21, '2026_02_24_165252_create_barang_masuks_table', 13),
(22, '2026_02_24_165258_create_barang_keluars_table', 13),
(23, '2026_02_23_150600_add_details_to_pelanggan_table', 14),
(24, '2026_02_23_154611_add_points_to_pelanggans_table', 14),
(25, '2026_02_23_164402_create_transaksi_stoks_table', 14),
(26, '2026_02_23_164407_create_detail_transaksi_stoks_table', 14),
(27, '2026_02_24_034452_add_qty_to_produk_table', 14),
(28, '2026_02_25_154329_create_services_table', 15),
(29, '2026_02_26_130640_create_gudang_aksesoris_table', 16),
(30, '2026_02_26_162526_create_kredits_table', 17),
(31, '2026_02_27_091736_create_sewa_produk_table', 18);

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
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `id_provinsi` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kota` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kecamatan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kelurahan` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `level` enum('Bronze','Silver','Platinum') NOT NULL DEFAULT 'Bronze'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_hp`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `id_provinsi`, `id_kota`, `id_kecamatan`, `id_kelurahan`, `status`, `email`, `created_at`, `updated_at`, `point`, `level`) VALUES
(1, 'Roberth', '082245782682', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', 'pattroberth13@gmail.com', '2026-02-21 23:56:21', '2026-02-21 23:56:21', 0, 'Bronze'),
(3, 'Colln', '082124944770', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, '2026-02-22 00:48:43', '2026-02-22 00:48:43', 0, 'Bronze'),
(4, 'Colln', '082124944773', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', 'kasir2@gmail.com', '2026-02-22 03:06:37', '2026-02-22 03:06:37', 0, 'Bronze'),
(5, 'Roberth', '082245782681', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', 'pattpolly16@gmail.com', '2026-02-22 03:09:40', '2026-02-22 03:09:40', 0, 'Bronze');

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
  `id_warna` bigint(20) NOT NULL,
  `id_varian` bigint(20) NOT NULL,
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

INSERT INTO `produk` (`id_produk`, `id_kategori`, `id_jenis`, `id_tipe`, `id_warna`, `id_varian`, `id_supplier`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `harga_jual_produk`, `harga_promo_produk`, `gambar_produk`, `created_at`, `updated_at`) VALUES
(2, 3, 4, 3, 11, 3, 1, 'iPhone 13', '<p>Varian : 128gb<br>Color : Midnight</p>', 7999000, 8249000, 7999000, '1771436312.jpg', '2026-02-18 17:38:32', '2026-02-25 03:00:09'),
(3, 3, 4, 5, 13, 3, 1, 'iPhone 17 Pro Max', '<p>Varian : 2TB<br>Color : Cosmic Orange</p>', 43399000, 43999000, 43399000, '1771437184.jpg', '2026-02-18 17:53:04', '2026-02-25 03:01:15'),
(4, 3, 4, 5, 11, 4, 1, 'iPhone 17 Pro Max', '<p>Varian : 2TB<br>Color : Midnight</p>', 43399000, 43999000, 43399000, '1771438662.jpg', '2026-02-18 18:17:42', '2026-02-25 03:03:06'),
(9, 4, 7, 4, 11, 3, 1, 'Vivo Y04S', '<p>tes</p>', 1000000, 2000000, 1500000, '1771991273.jpeg', '2026-02-25 03:47:53', '2026-02-25 05:11:59'),
(10, 3, 5, 8, 11, 3, 1, 'iPhone 13', '<p>Mantap</p>', 6999000, 9299000, 0, '1772117071.jpeg', '2026-02-26 14:44:31', '2026-02-26 14:44:31'),
(11, 3, 10, 9, 11, 5, 1, 'iPhone XR', '<p>Oke lah</p>', 2000000, 3399000, 0, '1772117200.jpeg', '2026-02-26 14:46:40', '2026-02-26 14:46:40'),
(12, 4, 11, 10, 13, 5, 1, 'Samsung a37', '<p>Bisa lahhh !</p>', 3500000, 5000000, 0, '1772117365.jpg', '2026-02-26 14:49:25', '2026-02-26 14:49:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_service` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `macbook` varchar(255) DEFAULT NULL,
  `lcd_oem` double NOT NULL DEFAULT 0,
  `lcd_original` double NOT NULL DEFAULT 0,
  `lcd_ori_premium_oled` double NOT NULL DEFAULT 0,
  `lcd_ori_apple` double NOT NULL DEFAULT 0,
  `pindah_chip_lcd` double NOT NULL DEFAULT 0,
  `adhesive_lcd` double NOT NULL DEFAULT 0,
  `battery_garansi_1_tahun` double NOT NULL DEFAULT 0,
  `battery_garansi_lifetime` double NOT NULL DEFAULT 0,
  `battery_apple_chip` double NOT NULL DEFAULT 0,
  `battery_pindah_chip` double NOT NULL DEFAULT 0,
  `back_cam_ori` double NOT NULL DEFAULT 0,
  `back_cam_ori_copotan` double NOT NULL DEFAULT 0,
  `front_cam` double NOT NULL DEFAULT 0,
  `flex_on_off` double NOT NULL DEFAULT 0,
  `flex_volume` double NOT NULL DEFAULT 0,
  `flex_on_off_volume` double NOT NULL DEFAULT 0,
  `flex_charger` double NOT NULL DEFAULT 0,
  `flex_charger_ori_apple` double NOT NULL DEFAULT 0,
  `home_button` double NOT NULL DEFAULT 0,
  `taptic_engine` double NOT NULL DEFAULT 0,
  `buzzer_atas` double NOT NULL DEFAULT 0,
  `buzzer_bawah` double NOT NULL DEFAULT 0,
  `sensor_proximity` double NOT NULL DEFAULT 0,
  `antena_wifi` double NOT NULL DEFAULT 0,
  `housing_body` double NOT NULL DEFAULT 0,
  `swap_part` double NOT NULL DEFAULT 0,
  `back_door` double NOT NULL DEFAULT 0,
  `kaca_kamera` double NOT NULL DEFAULT 0,
  `water_damage` double NOT NULL DEFAULT 0,
  `face_id` double NOT NULL DEFAULT 0,
  `lcd_bercak` double NOT NULL DEFAULT 0,
  `battery` double NOT NULL DEFAULT 0,
  `lcd` double NOT NULL DEFAULT 0,
  `charger_port` double NOT NULL DEFAULT 0,
  `flexible_lcd` double NOT NULL DEFAULT 0,
  `repair_glass` double NOT NULL DEFAULT 0,
  `keyboard` double NOT NULL DEFAULT 0,
  `speaker` double NOT NULL DEFAULT 0,
  `trackpad` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id_service`, `id_kategori_service`, `type`, `macbook`, `lcd_oem`, `lcd_original`, `lcd_ori_premium_oled`, `lcd_ori_apple`, `pindah_chip_lcd`, `adhesive_lcd`, `battery_garansi_1_tahun`, `battery_garansi_lifetime`, `battery_apple_chip`, `battery_pindah_chip`, `back_cam_ori`, `back_cam_ori_copotan`, `front_cam`, `flex_on_off`, `flex_volume`, `flex_on_off_volume`, `flex_charger`, `flex_charger_ori_apple`, `home_button`, `taptic_engine`, `buzzer_atas`, `buzzer_bawah`, `sensor_proximity`, `antena_wifi`, `housing_body`, `swap_part`, `back_door`, `kaca_kamera`, `water_damage`, `face_id`, `lcd_bercak`, `battery`, `lcd`, `charger_port`, `flexible_lcd`, `repair_glass`, `keyboard`, `speaker`, `trackpad`, `created_at`, `updated_at`) VALUES
(2, 6, '5G', NULL, 168986, 199000, 249000, 399000, 0, 0, 79000, 89000, 0, 0, 69000, 109000, 69000, 0, 0, 99000, 99000, 0, 89000, 99000, 75000, 75000, 0, 99000, 118999, 49000, 0, 0, 99000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-02-26 03:49:26', '2026-02-26 03:49:26'),
(3, 7, 'iPad 2', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120000, 0, 0, 0, 0, 180000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 189000, 449000, 135000, 0, 0, 0, 0, 0, '2026-02-26 04:00:37', '2026-02-26 04:04:46'),
(4, 8, 'AW S1 38MM', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55000, 639000, 0, 149000, 599000, 0, 0, 0, '2026-02-26 04:06:13', '2026-02-26 04:06:13'),
(5, 9, 'A1534', 'Macbook 12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1900000, 1100000, 1600000, '2026-02-26 04:07:25', '2026-02-26 04:07:25');

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
('hfm8eGvaqBFSTxU6GM2zTl450joz8gTpN9ATOMEQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN3ZQWndoSllCdjBsT2JlbXBabFc2aHVNOEdvUWdmRDFqaU9yREtJMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9nZXQtcHJvZHVrLWRldGFpbC8zIjtzOjU6InJvdXRlIjtzOjI3OiJnZW5lcmF0ZWQ6OmRZTkJuRVBaclBiVUc3V08iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2NDoiOTEwMTk3MTdmOTEyY2MwNGJlOGVkNjZlNmYxM2RlZmVlMDZlYzkxYjc4YzNhODk3M2QxNTA5ZDU1NGY1YWM5MCI7fQ==', 1772164413),
('YW3hIo0TMuur8D8NmVJDDMh4JbrfOFKJJHglZRrx', NULL, '192.168.0.171', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU3JIN0ppVWN2bU1vTFBvMlU3Vm9oS0tUREhmcXJidGZhcHE5SUtOZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xOTIuMTY4LjAuMTI0OjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzM6Imh0dHA6Ly8xOTIuMTY4LjAuMTI0OjgwMDAvc2VydmljZSI7fX0=', 1772161251);

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
(1, 'Rumah Gadget', 'Roberth Colln', '1771350679_512x512.png', '1771350679_512x512.png', '<p>Cari iPhone Ex-iBox atau Android Second berkualitas? Kunjungi <strong>Rumah Gadget</strong>! Melayani tukar tambah (Trade-In) dengan harga kompetitif, unit siap pakai, dan bergaransi resmi toko.</p>', 'CRM Rumah Gadget Bali', 'Jl. Gn. Agung No.140A, Tegal Kertha, Kec. Denpasar Bar., Kota Denpasar, Bali 80111', 'https://www.instagram.com/robertj_colln/', 'https://www.youtube.com/watch?v=Mb_98vAimsw', 'rggunungagung@gmail.com', '081297600976', 'https://www.google.com/maps/embed?pb=!4v1771428148809!6m8!1m7!1sRHTujwMHpdlVMGdP6uA5Wg!2m2!1d-8.651670852486884!2d115.1966507223476!3f20.242256!4f0!5f0.7820865974627469', NULL, '2026-02-27 02:19:57', 'Jl. Teuku Umar No.63, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80113', '081297600976', 'rgteukuumar@gmail.com', 'https://www.google.com/maps/embed?pb=!4v1771428092619!6m8!1m7!1s8epLolCOFu-GnGvVr6hmtw!2m2!1d-8.671935486547097!2d115.2089626783986!3f112.8887!4f0!5f0.7820865974627469');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sewa_produk`
--

CREATE TABLE `sewa_produk` (
  `id_sewa` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `harga_24_jam` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_2_hari` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_3_hari` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_7_hari` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_14_hari` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_1_bulan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_per_jam` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sewa_produk`
--

INSERT INTO `sewa_produk` (`id_sewa`, `id_produk`, `harga_24_jam`, `harga_2_hari`, `harga_3_hari`, `harga_7_hari`, `harga_14_hari`, `harga_1_bulan`, `harga_per_jam`, `created_at`, `updated_at`) VALUES
(1, 11, 99000.00, 159000.00, 239000.00, 449000.00, 799000.00, 1199000.00, 100000.00, '2026-02-27 01:24:10', '2026-02-27 01:24:10');

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
(1, 2, 2, 10, NULL, '2026-02-25 03:25:26'),
(3, 3, 3, 0, NULL, '2026-02-22 03:10:57'),
(4, 4, 2, 23, NULL, '2026-02-22 00:26:35'),
(9, 9, 2, 5, '2026-02-25 03:47:53', '2026-02-25 05:11:59'),
(10, 10, 2, 10, '2026-02-26 14:44:31', '2026-02-26 14:44:31'),
(11, 11, 2, 10, '2026-02-26 14:46:40', '2026-02-26 14:46:40'),
(12, 12, 2, 10, '2026-02-26 14:49:25', '2026-02-26 14:49:25');

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
(7, 'Casing/Cover', 9, '2026-02-21 17:42:20', '2026-02-21 17:42:20'),
(8, 'iPhone 13', 5, '2026-02-26 14:42:39', '2026-02-26 14:42:39'),
(9, 'iPhone XR', 10, '2026-02-26 14:45:02', '2026-02-26 14:45:02'),
(10, 'Samsung a37', 11, '2026-02-26 14:47:48', '2026-02-26 14:47:48');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `varian`
--

CREATE TABLE `varian` (
  `id_varian` int(10) UNSIGNED NOT NULL,
  `nama_varian` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `varian`
--

INSERT INTO `varian` (`id_varian`, `nama_varian`, `created_at`, `updated_at`) VALUES
(3, '128GB', '2026-02-17 09:49:33', '2026-02-25 02:42:08'),
(4, '256GB', '2026-02-17 09:49:42', '2026-02-25 02:42:17'),
(5, '64GB', '2026-02-21 17:40:37', '2026-02-25 02:42:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warna`
--

CREATE TABLE `warna` (
  `id_warna` int(10) UNSIGNED NOT NULL,
  `nama_warna` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `warna`
--

INSERT INTO `warna` (`id_warna`, `nama_warna`, `created_at`, `updated_at`) VALUES
(11, 'Ultramarine', '2026-02-25 02:51:12', '2026-02-25 02:51:12'),
(13, 'Midnight', '2026-02-25 02:53:00', '2026-02-25 02:53:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aksesoris`
--
ALTER TABLE `aksesoris`
  ADD PRIMARY KEY (`id_aksesoris`),
  ADD KEY `aksesoris_id_supplier_foreign` (`id_supplier`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

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
-- Indeks untuk tabel `gudang_aksesoris`
--
ALTER TABLE `gudang_aksesoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gudang_aksesoris_id_aksesoris_foreign` (`id_aksesoris`),
  ADD KEY `gudang_aksesoris_id_gudang_foreign` (`id_gudang`);

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
-- Indeks untuk tabel `kategori_aksesoris`
--
ALTER TABLE `kategori_aksesoris`
  ADD PRIMARY KEY (`id_kategori_aksesoris`);

--
-- Indeks untuk tabel `kategori_service`
--
ALTER TABLE `kategori_service`
  ADD PRIMARY KEY (`id_kategori_service`);

--
-- Indeks untuk tabel `kredit_produk`
--
ALTER TABLE `kredit_produk`
  ADD PRIMARY KEY (`id_kredit`),
  ADD KEY `kredit_produk_id_kategori_foreign` (`id_kategori`),
  ADD KEY `kredit_produk_id_jenis_foreign` (`id_jenis`),
  ADD KEY `kredit_produk_id_tipe_foreign` (`id_tipe`),
  ADD KEY `kredit_produk_id_varian_foreign` (`id_varian`),
  ADD KEY `kredit_produk_id_warna_foreign` (`id_warna`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
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
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `services_id_kategori_service_foreign` (`id_kategori_service`);

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
-- Indeks untuk tabel `sewa_produk`
--
ALTER TABLE `sewa_produk`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `sewa_produk_id_produk_foreign` (`id_produk`);

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
-- Indeks untuk tabel `varian`
--
ALTER TABLE `varian`
  ADD PRIMARY KEY (`id_varian`);

--
-- Indeks untuk tabel `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id_warna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aksesoris`
--
ALTER TABLE `aksesoris`
  MODIFY `id_aksesoris` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT untuk tabel `gudang_aksesoris`
--
ALTER TABLE `gudang_aksesoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT untuk tabel `kategori_aksesoris`
--
ALTER TABLE `kategori_aksesoris`
  MODIFY `id_kategori_aksesoris` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kategori_service`
--
ALTER TABLE `kategori_service`
  MODIFY `id_kategori_service` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kredit_produk`
--
ALTER TABLE `kredit_produk`
  MODIFY `id_kredit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id_service` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sewa_produk`
--
ALTER TABLE `sewa_produk`
  MODIFY `id_sewa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id_tipe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `varian`
--
ALTER TABLE `varian`
  MODIFY `id_varian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `warna`
--
ALTER TABLE `warna`
  MODIFY `id_warna` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aksesoris`
--
ALTER TABLE `aksesoris`
  ADD CONSTRAINT `aksesoris_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gudang_aksesoris`
--
ALTER TABLE `gudang_aksesoris`
  ADD CONSTRAINT `gudang_aksesoris_id_aksesoris_foreign` FOREIGN KEY (`id_aksesoris`) REFERENCES `aksesoris` (`id_aksesoris`) ON DELETE CASCADE,
  ADD CONSTRAINT `gudang_aksesoris_id_gudang_foreign` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kredit_produk`
--
ALTER TABLE `kredit_produk`
  ADD CONSTRAINT `kredit_produk_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE,
  ADD CONSTRAINT `kredit_produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `kredit_produk_id_tipe_foreign` FOREIGN KEY (`id_tipe`) REFERENCES `tipe` (`id_tipe`) ON DELETE CASCADE,
  ADD CONSTRAINT `kredit_produk_id_varian_foreign` FOREIGN KEY (`id_varian`) REFERENCES `varian` (`id_varian`) ON DELETE CASCADE,
  ADD CONSTRAINT `kredit_produk_id_warna_foreign` FOREIGN KEY (`id_warna`) REFERENCES `warna` (`id_warna`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_id_kategori_service_foreign` FOREIGN KEY (`id_kategori_service`) REFERENCES `kategori_service` (`id_kategori_service`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sewa_produk`
--
ALTER TABLE `sewa_produk`
  ADD CONSTRAINT `sewa_produk_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
