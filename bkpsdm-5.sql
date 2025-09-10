-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 10, 2025 at 08:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkpsdm-5`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `description`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 21:48:56', '2025-08-25 21:48:56'),
(2, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:17:17', '2025-08-25 23:17:17'),
(3, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:17:40', '2025-08-25 23:17:40'),
(4, 1, 'CREATE', 'App\\Models\\User', 2, 'Menambahkan user baru: dep (dep@gmail.com)', NULL, '{\"id\": 2, \"name\": \"dep\", \"email\": \"dep@gmail.com\", \"created_at\": \"2025-08-26T06:18:13.000000Z\", \"updated_at\": \"2025-08-26T06:18:13.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:18:13', '2025-08-25 23:18:13'),
(5, 1, 'UPDATE', 'App\\Models\\User', 2, 'Mengubah nama user: depp', '{\"id\": 2, \"name\": \"dep\", \"email\": \"dep@gmail.com\", \"created_at\": \"2025-08-26T06:18:13.000000Z\", \"updated_at\": \"2025-08-26T06:18:13.000000Z\", \"email_verified_at\": null}', '{\"id\": 2, \"name\": \"depp\", \"email\": \"dep@gmail.com\", \"created_at\": \"2025-08-26T06:18:13.000000Z\", \"updated_at\": \"2025-08-26T06:18:35.000000Z\", \"email_verified_at\": null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:18:35', '2025-08-25 23:18:35'),
(6, 1, 'DELETE', 'App\\Models\\Pejabat', 1, 'Menghapus data pejabat: Dr. Ahmad Suryadi, M.Si - Kepala Badan', '{\"id\": 1, \"nip\": \"196512121990031001\", \"name\": \"Dr. Ahmad Suryadi, M.Si\", \"order\": 1, \"photo\": \"pejabat/kepala.jpg\", \"jabatan\": \"Kepala Badan\", \"created_at\": \"2025-08-26T04:55:14.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:18:51', '2025-08-25 23:18:51'),
(7, 1, 'DELETE', 'App\\Models\\Pejabat', 2, 'Menghapus data pejabat: Dra. Siti Nurhasanah, M.AP - Sekretaris', '{\"id\": 2, \"nip\": \"197203151995032001\", \"name\": \"Dra. Siti Nurhasanah, M.AP\", \"order\": 2, \"photo\": \"pejabat/sekretaris.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-08-26T04:55:14.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:18:54', '2025-08-25 23:18:54'),
(8, 1, 'DELETE', 'App\\Models\\Pejabat', 3, 'Menghapus data pejabat: Ir. Budi Santoso, M.M - Kepala Bidang A', '{\"id\": 3, \"nip\": \"196808201993031002\", \"name\": \"Ir. Budi Santoso, M.M\", \"order\": 3, \"photo\": \"pejabat/kabid1.jpg\", \"jabatan\": \"Kepala Bidang A\", \"created_at\": \"2025-08-26T04:55:14.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:18:56', '2025-08-25 23:18:56'),
(9, 1, 'DELETE', 'App\\Models\\Pejabat', 4, 'Menghapus data pejabat: S.Sos. Maya Indrawati, M.AP - Kepala Bidang B', '{\"id\": 4, \"nip\": \"197505101998032001\", \"name\": \"S.Sos. Maya Indrawati, M.AP\", \"order\": 4, \"photo\": \"pejabat/kabid2.jpg\", \"jabatan\": \"Kepala Bidang B\", \"created_at\": \"2025-08-26T04:55:14.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:19:00', '2025-08-25 23:19:00'),
(10, 1, 'CREATE', 'App\\Models\\Pejabat', 5, 'Menambahkan pejabat: Test 1 - Kepala Badan', NULL, '{\"id\": 5, \"nip\": \"43789501231231313144\", \"name\": \"Test 1\", \"order\": \"0\", \"photo\": \"pejabat/toVSIWVUrsxAaVsxmkZ2LXtlMPvobanVXePAXQQQ.jpg\", \"jabatan\": \"Kepala Badan\", \"created_at\": \"2025-08-26T06:20:07.000000Z\", \"updated_at\": \"2025-08-26T06:20:07.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:20:07', '2025-08-25 23:20:07'),
(11, 1, 'CREATE', 'App\\Models\\Pejabat', 6, 'Menambahkan pejabat: Mamat - Sekretaris', NULL, '{\"id\": 6, \"nip\": \"198512345678901250\", \"name\": \"Mamat\", \"order\": \"0\", \"photo\": \"pejabat/HNE4moZGtLfeE8bOFFSYtsCTlMw8isqwuWmZUwvR.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-08-26T06:20:58.000000Z\", \"updated_at\": \"2025-08-26T06:20:58.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:20:59', '2025-08-25 23:20:59'),
(12, 1, 'CREATE', 'App\\Models\\Pejabat', 7, 'Menambahkan pejabat: Test - Kepala Bidang A', NULL, '{\"id\": 7, \"nip\": \"43789501231231313133\", \"name\": \"Test\", \"order\": \"0\", \"photo\": \"pejabat/TI7gxPAE9rrl2hWmsemP9r7Uo9UAPLdXJXf5JAOE.jpg\", \"jabatan\": \"Kepala Bidang A\", \"created_at\": \"2025-08-26T06:21:55.000000Z\", \"updated_at\": \"2025-08-26T06:21:55.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:21:55', '2025-08-25 23:21:55'),
(13, 1, 'CREATE', 'App\\Models\\Pejabat', 8, 'Menambahkan pejabat: Test 2 - Kepala Bidang B', NULL, '{\"id\": 8, \"nip\": \"43789501231231313123\", \"name\": \"Test 2\", \"order\": \"0\", \"photo\": \"pejabat/sfzvcywlrdJK3fZv8OOtC8sna2R7dnRq93wVaao9.jpg\", \"jabatan\": \"Kepala Bidang B\", \"created_at\": \"2025-08-26T06:23:33.000000Z\", \"updated_at\": \"2025-08-26T06:23:33.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:23:33', '2025-08-25 23:23:33'),
(14, 1, 'CREATE', 'App\\Models\\Pejabat', 9, 'Menambahkan pejabat: Test 3 - Staf Ahli', NULL, '{\"id\": 9, \"nip\": \"4378950123123131356\", \"name\": \"Test 3\", \"order\": \"1\", \"photo\": \"pejabat/Nqm3AORLzT2Z5gzlMJooRIfG4dYKwwiL33xKRKrI.jpg\", \"jabatan\": \"Staf Ahli\", \"created_at\": \"2025-08-26T06:24:36.000000Z\", \"updated_at\": \"2025-08-26T06:24:36.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:24:36', '2025-08-25 23:24:36'),
(15, 1, 'CREATE', 'App\\Models\\Hero', 3, 'Menambahkan slide hero: Contoh Slide Atas', NULL, '{\"id\": 3, \"order\": \"1\", \"title\": \"Contoh Slide Atas\", \"subtitle\": \"contoh Judul\", \"created_at\": \"2025-08-26T06:25:40.000000Z\", \"updated_at\": \"2025-08-26T06:25:40.000000Z\", \"button_link\": null, \"button_text\": \"contoh teks\", \"background_image\": \"hero/ki10kzADzyGlhI7zfwMUAggEr9NgMsDq0SjGo2zn.jpg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:25:40', '2025-08-25 23:25:40'),
(16, 1, 'UPDATE', 'App\\Models\\Hero', 1, 'Mengubah slide hero: Selamat Datang di BKPSDM Katingan', '{\"id\": 1, \"order\": 1, \"title\": \"Selamat Datang di BKPSDM Katingan\", \"subtitle\": \"Membangun Aparatur yang Kompeten dan Berintegritas\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-26T04:54:16.000000Z\", \"button_link\": \"/profil/visi-misi\", \"button_text\": \"Selengkapnya\", \"background_image\": \"hero/hero1.jpg\"}', '{\"id\": 1, \"order\": \"1\", \"title\": \"Selamat Datang di BKPSDM Katingan\", \"subtitle\": \"Membangun Aparatur yang Kompeten dan Berintegritas\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-26T06:27:35.000000Z\", \"button_link\": null, \"button_text\": \"Selengkapnya\", \"background_image\": \"hero/IX56UvPAJVMOEisFDT6zea24i6qz0ZSEQSJ2N8N8.jpg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:27:35', '2025-08-25 23:27:35'),
(17, 1, 'UPDATE', 'App\\Models\\Hero', 2, 'Mengubah slide hero: Pelayanan Prima untuk Masyarakat', '{\"id\": 2, \"order\": 2, \"title\": \"Pelayanan Prima untuk Masyarakat\", \"subtitle\": \"Transparansi dan Akuntabilitas dalam Setiap Layanan\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-26T04:54:16.000000Z\", \"button_link\": \"/kontak\", \"button_text\": \"Hubungi Kami\", \"background_image\": \"hero/hero2.jpg\"}', '{\"id\": 2, \"order\": \"2\", \"title\": \"Pelayanan Prima untuk Masyarakat\", \"subtitle\": \"Transparansi dan Akuntabilitas dalam Setiap Layanan\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-26T06:28:15.000000Z\", \"button_link\": null, \"button_text\": \"Hubungi Kami\", \"background_image\": \"hero/7tnlsVTIbB5cDaaocts4DQcuaeneJaRBcT2emy90.jpg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:28:15', '2025-08-25 23:28:15'),
(18, 1, 'UPDATE', 'App\\Models\\Berita', 1, 'Mengubah berita: Pelantikan Pejabat Struktural BKPSDM Katingan', '{\"id\": 1, \"slug\": \"pelantikan-pejabat-struktural-bkpsdm-katingan\", \"title\": \"Pelantikan Pejabat Struktural BKPSDM Katingan\", \"status\": \"published\", \"content\": \"<p>Pada hari ini telah dilaksanakan pelantikan pejabat struktural di lingkungan BKPSDM Kabupaten Katingan. Acara pelantikan dipimpin langsung oleh Bupati Katingan dan dihadiri oleh seluruh jajaran pemerintahan daerah.</p><p>Pejabat yang dilantik diharapkan dapat menjalankan tugas dan tanggung jawabnya dengan penuh amanah untuk kemajuan aparatur sipil negara di Kabupaten Katingan.</p>\", \"user_id\": 1, \"thumbnail\": null, \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\", \"published_at\": \"2025-08-21 04:55:14\"}', '{\"id\": 1, \"slug\": \"pelantikan-pejabat-struktural-bkpsdm-katingan\", \"title\": \"Pelantikan Pejabat Struktural BKPSDM Katingan\", \"status\": \"published\", \"content\": \"<p>Pada hari ini telah dilaksanakan pelantikan pejabat struktural di lingkungan BKPSDM Kabupaten Katingan. Acara pelantikan dipimpin langsung oleh Bupati Katingan dan dihadiri oleh seluruh jajaran pemerintahan daerah.</p>\\r\\n<p>Pejabat yang dilantik diharapkan dapat menjalankan tugas dan tanggung jawabnya dengan penuh amanah untuk kemajuan aparatur sipil negara di Kabupaten Katingan.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad548291ce3_1756189826.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:30:26.000000Z\", \"published_at\": \"2025-08-21 04:55:14\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:30:26', '2025-08-25 23:30:26'),
(19, 1, 'UPDATE', 'App\\Models\\Berita', 2, 'Mengubah berita: Sosialisasi Peraturan Disiplin PNS Terbaru', '{\"id\": 2, \"slug\": \"sosialisasi-peraturan-disiplin-pns-terbaru\", \"title\": \"Sosialisasi Peraturan Disiplin PNS Terbaru\", \"status\": \"published\", \"content\": \"<p>BKPSDM Kabupaten Katingan menggelar sosialisasi peraturan disiplin PNS terbaru kepada seluruh ASN di lingkungan Pemerintah Kabupaten Katingan.</p><p>Kegiatan ini bertujuan untuk memberikan pemahaman yang komprehensif tentang hak, kewajiban, dan sanksi disiplin yang berlaku bagi PNS sesuai dengan peraturan terbaru.</p>\", \"user_id\": 1, \"thumbnail\": null, \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\", \"published_at\": \"2025-08-16 04:55:14\"}', '{\"id\": 2, \"slug\": \"sosialisasi-peraturan-disiplin-pns-terbaru\", \"title\": \"Sosialisasi Peraturan Disiplin PNS Terbaru\", \"status\": \"published\", \"content\": \"<p>BKPSDM Kabupaten Katingan menggelar sosialisasi peraturan disiplin PNS terbaru kepada seluruh ASN di lingkungan Pemerintah Kabupaten Katingan.</p>\\r\\n<p>Kegiatan ini bertujuan untuk memberikan pemahaman yang komprehensif tentang hak, kewajiban, dan sanksi disiplin yang berlaku bagi PNS sesuai dengan peraturan terbaru.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad548e79ff2_1756189838.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:30:38.000000Z\", \"published_at\": \"2025-08-16 04:55:14\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:30:38', '2025-08-25 23:30:38'),
(20, 1, 'UPDATE', 'App\\Models\\Berita', 3, 'Mengubah berita: Pelatihan Kepemimpinan untuk Pejabat Eselon III dan IV', '{\"id\": 3, \"slug\": \"pelatihan-kepemimpinan-untuk-pejabat-eselon-iii-dan-iv\", \"title\": \"Pelatihan Kepemimpinan untuk Pejabat Eselon III dan IV\", \"status\": \"published\", \"content\": \"<p>Dalam rangka meningkatkan kompetensi kepemimpinan, BKPSDM Kabupaten Katingan menyelenggarakan pelatihan kepemimpinan bagi pejabat eselon III dan IV.</p><p>Pelatihan ini mencakup materi tentang kepemimpinan transformasional, manajemen konflik, dan komunikasi efektif dalam organisasi pemerintahan.</p>\", \"user_id\": 1, \"thumbnail\": null, \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\", \"published_at\": \"2025-08-11 04:55:14\"}', '{\"id\": 3, \"slug\": \"pelatihan-kepemimpinan-untuk-pejabat-eselon-iii-dan-iv\", \"title\": \"Pelatihan Kepemimpinan untuk Pejabat Eselon III dan IV\", \"status\": \"published\", \"content\": \"<p>Dalam rangka meningkatkan kompetensi kepemimpinan, BKPSDM Kabupaten Katingan menyelenggarakan pelatihan kepemimpinan bagi pejabat eselon III dan IV.</p>\\r\\n<p>Pelatihan ini mencakup materi tentang kepemimpinan transformasional, manajemen konflik, dan komunikasi efektif dalam organisasi pemerintahan.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad549b227b9_1756189851.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:30:51.000000Z\", \"published_at\": \"2025-08-11 04:55:14\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:30:51', '2025-08-25 23:30:51'),
(21, 1, 'UPDATE', 'App\\Models\\Berita', 4, 'Mengubah berita: Workshop Penyusunan SKP dan Penilaian Kinerja', '{\"id\": 4, \"slug\": \"workshop-penyusunan-skp-dan-penilaian-kinerja\", \"title\": \"Workshop Penyusunan SKP dan Penilaian Kinerja\", \"status\": \"published\", \"content\": \"<p>BKPSDM Kabupaten Katingan menyelenggarakan workshop penyusunan SKP dan penilaian kinerja untuk seluruh ASN guna meningkatkan kualitas perencanaan dan evaluasi kinerja.</p>\", \"user_id\": 1, \"thumbnail\": null, \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\", \"published_at\": \"2025-08-06 04:55:14\"}', '{\"id\": 4, \"slug\": \"workshop-penyusunan-skp-dan-penilaian-kinerja\", \"title\": \"Workshop Penyusunan SKP dan Penilaian Kinerja\", \"status\": \"published\", \"content\": \"<p>BKPSDM Kabupaten Katingan menyelenggarakan workshop penyusunan SKP dan penilaian kinerja untuk seluruh ASN guna meningkatkan kualitas perencanaan dan evaluasi kinerja.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad54b630028_1756189878.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:31:18.000000Z\", \"published_at\": \"2025-08-06 04:55:14\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:31:18', '2025-08-25 23:31:18'),
(22, 1, 'UPDATE', 'App\\Models\\Berita', 5, 'Mengubah berita: Rapat Koordinasi Evaluasi Program Kerja', '{\"id\": 5, \"slug\": \"rapat-koordinasi-evaluasi-program-kerja\", \"title\": \"Rapat Koordinasi Evaluasi Program Kerja\", \"status\": \"published\", \"content\": \"<p>Rapat koordinasi evaluasi program kerja dilaksanakan untuk mengevaluasi capaian kinerja selama periode berjalan dan menyusun rencana tindak lanjut program kerja.</p>\", \"user_id\": 1, \"thumbnail\": null, \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T04:55:14.000000Z\", \"published_at\": \"2025-08-01 04:55:14\"}', '{\"id\": 5, \"slug\": \"rapat-koordinasi-evaluasi-program-kerja\", \"title\": \"Rapat Koordinasi Evaluasi Program Kerja\", \"status\": \"published\", \"content\": \"<p>Rapat koordinasi evaluasi program kerja dilaksanakan untuk mengevaluasi capaian kinerja selama periode berjalan dan menyusun rencana tindak lanjut program kerja.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad54c081957_1756189888.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:31:28.000000Z\", \"published_at\": \"2025-08-01 04:55:14\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:31:28', '2025-08-25 23:31:28'),
(23, 1, 'DELETE', 'App\\Models\\Unduhan', 1, 'Menghapus file unduhan: Peraturan Disiplin PNS 2024', '{\"id\": 1, \"title\": \"Peraturan Disiplin PNS 2024\", \"file_path\": null, \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\", \"description\": \"Peraturan terbaru tentang disiplin pegawai negeri sipil tahun 2024\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:31:44', '2025-08-25 23:31:44'),
(24, 1, 'DELETE', 'App\\Models\\Unduhan', 2, 'Menghapus file unduhan: Pedoman Penilaian Kinerja ASN', '{\"id\": 2, \"title\": \"Pedoman Penilaian Kinerja ASN\", \"file_path\": null, \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\", \"description\": \"Pedoman lengkap untuk penilaian kinerja aparatur sipil negara\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:31:47', '2025-08-25 23:31:47'),
(25, 1, 'DELETE', 'App\\Models\\Unduhan', 3, 'Menghapus file unduhan: Formulir Usulan Pengembangan Kompetensi', '{\"id\": 3, \"title\": \"Formulir Usulan Pengembangan Kompetensi\", \"file_path\": null, \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\", \"description\": \"Formulir untuk mengajukan usulan pengembangan kompetensi pegawai\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:31:49', '2025-08-25 23:31:49'),
(26, 1, 'DELETE', 'App\\Models\\Galeri', 1, 'Menghapus gambar galeri: Kegiatan Pelantikan Pejabat', '{\"id\": 1, \"image\": \"galeri/placeholder1.jpg\", \"title\": \"Kegiatan Pelantikan Pejabat\", \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:19', '2025-08-25 23:32:19'),
(27, 1, 'DELETE', 'App\\Models\\Galeri', 2, 'Menghapus gambar galeri: Sosialisasi Peraturan PNS', '{\"id\": 2, \"image\": \"galeri/placeholder2.jpg\", \"title\": \"Sosialisasi Peraturan PNS\", \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:22', '2025-08-25 23:32:22'),
(28, 1, 'DELETE', 'App\\Models\\Galeri', 3, 'Menghapus gambar galeri: Pelatihan Kepemimpinan', '{\"id\": 3, \"image\": \"galeri/placeholder3.jpg\", \"title\": \"Pelatihan Kepemimpinan\", \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:24', '2025-08-25 23:32:24'),
(29, 1, 'DELETE', 'App\\Models\\Galeri', 4, 'Menghapus gambar galeri: Rapat Koordinasi Bulanan', '{\"id\": 4, \"image\": \"galeri/placeholder4.jpg\", \"title\": \"Rapat Koordinasi Bulanan\", \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:26', '2025-08-25 23:32:26'),
(30, 1, 'DELETE', 'App\\Models\\Galeri', 5, 'Menghapus gambar galeri: Workshop Penyusunan SKP', '{\"id\": 5, \"image\": \"galeri/placeholder5.jpg\", \"title\": \"Workshop Penyusunan SKP\", \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:28', '2025-08-25 23:32:28'),
(31, 1, 'DELETE', 'App\\Models\\Galeri', 6, 'Menghapus gambar galeri: Evaluasi Program Kerja', '{\"id\": 6, \"image\": \"galeri/placeholder6.jpg\", \"title\": \"Evaluasi Program Kerja\", \"created_at\": \"2025-08-26T04:53:21.000000Z\", \"updated_at\": \"2025-08-26T04:53:21.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:30', '2025-08-25 23:32:30'),
(32, 1, 'CREATE', 'App\\Models\\Galeri', 7, 'Menambahkan gambar galeri: ', NULL, '{\"id\": 7, \"image\": \"galeri/68ad550867f4c_1756189960.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:32:40.000000Z\", \"updated_at\": \"2025-08-26T06:32:40.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:40', '2025-08-25 23:32:40'),
(33, 1, 'CREATE', 'App\\Models\\Galeri', 8, 'Menambahkan gambar galeri: ', NULL, '{\"id\": 8, \"image\": \"galeri/68ad5512a6384_1756189970.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:32:50.000000Z\", \"updated_at\": \"2025-08-26T06:32:50.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:50', '2025-08-25 23:32:50'),
(34, 1, 'CREATE', 'App\\Models\\Galeri', 9, 'Menambahkan gambar galeri: ', NULL, '{\"id\": 9, \"image\": \"galeri/68ad551aad9c0_1756189978.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:32:58.000000Z\", \"updated_at\": \"2025-08-26T06:32:58.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:32:58', '2025-08-25 23:32:58'),
(35, 1, 'CREATE', 'App\\Models\\Galeri', 10, 'Menambahkan gambar galeri: ', NULL, '{\"id\": 10, \"image\": \"galeri/68ad55258a078_1756189989.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:33:09.000000Z\", \"updated_at\": \"2025-08-26T06:33:09.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:33:09', '2025-08-25 23:33:09'),
(36, 1, 'CREATE', 'App\\Models\\Unduhan', 4, 'Menambahkan file unduhan: Contoh File Rapat terbaru', NULL, '{\"id\": 4, \"title\": \"Contoh File Rapat terbaru\", \"file_path\": \"unduhan/rVfiDHrh9qJKjVLKVtoFHzdvUePmuwz4von8Zisq.pdf\", \"created_at\": \"2025-08-26T06:36:18.000000Z\", \"updated_at\": \"2025-08-26T06:36:18.000000Z\", \"description\": \"REST\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:36:18', '2025-08-25 23:36:18'),
(37, 1, 'CREATE', 'App\\Models\\Unduhan', 5, 'Menambahkan file unduhan: Contoh File Rapat Terbaru', NULL, '{\"id\": 5, \"title\": \"Contoh File Rapat Terbaru\", \"file_path\": \"unduhan/TWLV5NbI1QEcssHOc7s1lugoxxJX1ks5CXv5rqwh.pdf\", \"created_at\": \"2025-08-26T06:37:00.000000Z\", \"updated_at\": \"2025-08-26T06:37:00.000000Z\", \"description\": null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:37:00', '2025-08-25 23:37:00'),
(38, 1, 'DELETE', 'App\\Models\\Agenda', 1, 'Menghapus agenda: Rapat Koordinasi Bulanan BKPSDM', '{\"id\": 1, \"slug\": null, \"title\": \"Rapat Koordinasi Bulanan BKPSDM\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T04:47:27.000000Z\", \"updated_at\": \"2025-08-26T04:47:27.000000Z\", \"description\": \"Rapat koordinasi bulanan untuk membahas evaluasi kinerja pegawai, program pelatihan, dan rencana kegiatan bulan berikutnya. Kegiatan ini dilaksanakan setiap bulan untuk memastikan koordinasi yang baik antar bidang.\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:45:47', '2025-08-25 23:45:47'),
(39, 1, 'CREATE', 'App\\Models\\Agenda', 4, 'Menambahkan agenda baru: Contoh Agenda', NULL, '{\"id\": 4, \"slug\": \"contoh-agenda\", \"title\": \"Contoh Agenda\", \"created_at\": \"2025-08-26T06:46:16.000000Z\", \"updated_at\": \"2025-08-26T06:46:16.000000Z\", \"description\": \"Contoh deskripsi Agenda\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:46:16', '2025-08-25 23:46:16'),
(40, 1, 'UPDATE', 'App\\Models\\Agenda', 4, 'Mengubah agenda: Contoh Agenda', '{\"id\": 4, \"title\": \"Contoh Agenda\", \"file_path\": null, \"created_at\": \"2025-08-26T06:46:16.000000Z\", \"updated_at\": \"2025-08-26T06:46:16.000000Z\", \"description\": \"Contoh deskripsi Agenda\"}', '{\"id\": 4, \"title\": \"Contoh Agenda\", \"file_path\": null, \"created_at\": \"2025-08-26T06:46:16.000000Z\", \"updated_at\": \"2025-08-26T06:50:08.000000Z\", \"description\": \"Contoh deskripsi Agenda\\r\\ncontoh ada perbaikan\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:50:08', '2025-08-25 23:50:08'),
(41, 1, 'CREATE', 'App\\Models\\Agenda', 5, 'Menambahkan agenda baru: contoh Agenda untuk hapus', NULL, '{\"id\": 5, \"slug\": \"contoh-agenda-untuk-hapus\", \"title\": \"contoh Agenda untuk hapus\", \"created_at\": \"2025-08-26T06:55:33.000000Z\", \"updated_at\": \"2025-08-26T06:55:33.000000Z\", \"description\": \"contoh hapus deskripsi\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:55:33', '2025-08-25 23:55:33'),
(42, 1, 'CREATE', 'App\\Models\\Agenda', 6, 'Menambahkan agenda baru: contoh agenda 2', NULL, '{\"id\": 6, \"slug\": \"contoh-agenda-2\", \"title\": \"contoh agenda 2\", \"created_at\": \"2025-08-26T06:57:03.000000Z\", \"updated_at\": \"2025-08-26T06:57:03.000000Z\", \"description\": \"deskripsi kegiatan dari contoh agenda yang akan di lakukan\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 23:57:03', '2025-08-25 23:57:03'),
(43, 1, 'CREATE', 'App\\Models\\Agenda', 7, 'Menambahkan agenda baru: contoh', NULL, '{\"id\": 7, \"slug\": \"contoh\", \"title\": \"contoh\", \"created_at\": \"2025-08-26T07:03:31.000000Z\", \"updated_at\": \"2025-08-26T07:03:31.000000Z\", \"description\": \"test contoh juga\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:03:31', '2025-08-26 00:03:31'),
(44, 1, 'CREATE', 'App\\Models\\Agenda', 8, 'Menambahkan agenda baru: Contoh Agenda rapat', NULL, '{\"id\": 8, \"slug\": \"contoh-agenda-rapat\", \"title\": \"Contoh Agenda rapat\", \"created_at\": \"2025-08-26T07:17:21.000000Z\", \"updated_at\": \"2025-08-26T07:17:21.000000Z\", \"description\": \"Beri deskripsi di sini yang jelas\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:17:21', '2025-08-26 00:17:21'),
(45, 1, 'DELETE', 'App\\Models\\Agenda', 5, 'Menghapus agenda: contoh Agenda untuk hapus', '{\"id\": 5, \"slug\": \"contoh-agenda-untuk-hapus\", \"title\": \"contoh Agenda untuk hapus\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T06:55:33.000000Z\", \"updated_at\": \"2025-08-26T06:55:33.000000Z\", \"description\": \"contoh hapus deskripsi\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:35:29', '2025-08-26 00:35:29'),
(46, 1, 'CREATE', 'App\\Models\\Agenda', 9, 'Menambahkan agenda baru: test', NULL, '{\"id\": 9, \"slug\": \"test\", \"title\": \"test\", \"created_at\": \"2025-08-26T07:37:17.000000Z\", \"updated_at\": \"2025-08-26T07:37:17.000000Z\", \"description\": \"adfadfadfadfaf\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:37:17', '2025-08-26 00:37:17'),
(47, 1, 'UPDATE', 'App\\Models\\Agenda', 9, 'Mengubah agenda: test edit', '{\"id\": 9, \"slug\": \"test\", \"title\": \"test\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T07:37:17.000000Z\", \"updated_at\": \"2025-08-26T07:37:17.000000Z\", \"description\": \"adfadfadfadfaf\"}', '{\"id\": 9, \"slug\": \"test\", \"title\": \"test edit\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T07:37:17.000000Z\", \"updated_at\": \"2025-08-26T07:37:29.000000Z\", \"description\": \"adfadfadfadfaf\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:37:29', '2025-08-26 00:37:29'),
(48, 1, 'UPDATE', 'App\\Models\\Agenda', 9, 'Mengubah agenda: test edit', '{\"id\": 9, \"slug\": \"test\", \"title\": \"test edit\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T07:37:17.000000Z\", \"updated_at\": \"2025-08-26T07:37:29.000000Z\", \"description\": \"adfadfadfadfaf\"}', '{\"id\": 9, \"slug\": \"test\", \"title\": \"test edit\", \"tanggal\": null, \"file_path\": \"unduhan/1756193863_rapat.pdf\", \"created_at\": \"2025-08-26T07:37:17.000000Z\", \"updated_at\": \"2025-08-26T07:37:43.000000Z\", \"description\": \"adfadfadfadfaf edt\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:37:43', '2025-08-26 00:37:43'),
(49, 1, 'DELETE', 'App\\Models\\Agenda', 8, 'Menghapus agenda: Contoh Agenda rapat', '{\"id\": 8, \"slug\": \"contoh-agenda-rapat\", \"title\": \"Contoh Agenda rapat\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T07:17:21.000000Z\", \"updated_at\": \"2025-08-26T07:17:21.000000Z\", \"description\": \"Beri deskripsi di sini yang jelas\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:38:03', '2025-08-26 00:38:03'),
(50, 1, 'DELETE', 'App\\Models\\Agenda', 6, 'Menghapus agenda: contoh agenda 2', '{\"id\": 6, \"slug\": \"contoh-agenda-2\", \"title\": \"contoh agenda 2\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T06:57:03.000000Z\", \"updated_at\": \"2025-08-26T06:57:03.000000Z\", \"description\": \"deskripsi kegiatan dari contoh agenda yang akan di lakukan\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:38:21', '2025-08-26 00:38:21'),
(51, 1, 'CREATE', 'App\\Models\\Berita', 6, 'Menambahkan berita baru: Tes Berita Baru', NULL, '{\"id\": 6, \"slug\": \"tes-berita-baru\", \"title\": \"Tes Berita Baru\", \"status\": \"draft\", \"content\": \"<p style=\\\"text-align: right;\\\">Berita baru, baru di buat dan di kerjakan tadi banget, test test test dan test</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad64ce0ee4b_1756193998.jpg\", \"created_at\": \"2025-08-26T07:39:58.000000Z\", \"updated_at\": \"2025-08-26T07:39:58.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:39:58', '2025-08-26 00:39:58'),
(52, 1, 'UPDATE', 'App\\Models\\Berita', 6, 'Mengubah berita: Tes Berita Baru', '{\"id\": 6, \"slug\": \"tes-berita-baru\", \"title\": \"Tes Berita Baru\", \"status\": \"draft\", \"content\": \"<p style=\\\"text-align: right;\\\">Berita baru, baru di buat dan di kerjakan tadi banget, test test test dan test</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad64ce0ee4b_1756193998.jpg\", \"created_at\": \"2025-08-26T07:39:58.000000Z\", \"updated_at\": \"2025-08-26T07:39:58.000000Z\", \"published_at\": null}', '{\"id\": 6, \"slug\": \"tes-berita-baru\", \"title\": \"Tes Berita Baru\", \"status\": \"published\", \"content\": \"<p style=\\\"text-align: right;\\\">Berita baru, baru di buat dan di kerjakan tadi banget, test test test dan test</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad64ce0ee4b_1756193998.jpg\", \"created_at\": \"2025-08-26T07:39:58.000000Z\", \"updated_at\": \"2025-08-26T07:40:06.000000Z\", \"published_at\": null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:40:06', '2025-08-26 00:40:06'),
(53, 1, 'DELETE', 'App\\Models\\Berita', 1, 'Menghapus berita: Pelantikan Pejabat Struktural BKPSDM Katingan', '{\"id\": 1, \"slug\": \"pelantikan-pejabat-struktural-bkpsdm-katingan\", \"title\": \"Pelantikan Pejabat Struktural BKPSDM Katingan\", \"status\": \"published\", \"content\": \"<p>Pada hari ini telah dilaksanakan pelantikan pejabat struktural di lingkungan BKPSDM Kabupaten Katingan. Acara pelantikan dipimpin langsung oleh Bupati Katingan dan dihadiri oleh seluruh jajaran pemerintahan daerah.</p>\\r\\n<p>Pejabat yang dilantik diharapkan dapat menjalankan tugas dan tanggung jawabnya dengan penuh amanah untuk kemajuan aparatur sipil negara di Kabupaten Katingan.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad548291ce3_1756189826.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:30:26.000000Z\", \"published_at\": \"2025-08-21 04:55:14\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:40:16', '2025-08-26 00:40:16'),
(54, 1, 'UPDATE', 'App\\Models\\Galeri', 8, 'Mengubah gambar galeri: Judul test', '{\"id\": 8, \"image\": \"galeri/68ad5512a6384_1756189970.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:32:50.000000Z\", \"updated_at\": \"2025-08-26T06:32:50.000000Z\"}', '{\"id\": 8, \"image\": \"galeri/68ad5512a6384_1756189970.jpg\", \"title\": \"Judul test\", \"created_at\": \"2025-08-26T06:32:50.000000Z\", \"updated_at\": \"2025-08-26T07:40:39.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:40:39', '2025-08-26 00:40:39'),
(55, 1, 'DELETE', 'App\\Models\\Kontak', 1, 'Menghapus pesan kontak dari:  (a@a.com)', '{\"id\": 1, \"name\": \"mamat\", \"email\": \"a@a.com\", \"message\": \"adfadfafd\", \"subject\": \"test\", \"created_at\": \"2025-08-26T06:34:59.000000Z\", \"updated_at\": \"2025-08-26T06:34:59.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:40:55', '2025-08-26 00:40:55'),
(56, 1, 'CREATE', 'App\\Models\\Hero', 4, 'Menambahkan slide hero: test Judu hero hapus', NULL, '{\"id\": 4, \"order\": \"0\", \"title\": \"test Judu hero hapus\", \"subtitle\": \"dadfad hapus\", \"created_at\": \"2025-08-26T07:44:12.000000Z\", \"updated_at\": \"2025-08-26T07:44:12.000000Z\", \"button_link\": null, \"button_text\": \"dadfadffadf\", \"background_image\": \"hero/3csnNd2KaybIatewX6G0EfcZOMq0orGZTv0GTLiB.png\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:44:12', '2025-08-26 00:44:12'),
(57, 1, 'DELETE', 'App\\Models\\Hero', 4, 'Menghapus slide hero: test Judu hero hapus', '{\"id\": 4, \"order\": 0, \"title\": \"test Judu hero hapus\", \"subtitle\": \"dadfad hapus\", \"created_at\": \"2025-08-26T07:44:12.000000Z\", \"updated_at\": \"2025-08-26T07:44:12.000000Z\", \"button_link\": null, \"button_text\": \"dadfadffadf\", \"background_image\": \"hero/3csnNd2KaybIatewX6G0EfcZOMq0orGZTv0GTLiB.png\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:44:19', '2025-08-26 00:44:19'),
(58, 1, 'CREATE', 'App\\Models\\User', 3, 'Menambahkan user baru: admin (admin@bkpsdm.com)', NULL, '{\"id\": 3, \"name\": \"admin\", \"email\": \"admin@bkpsdm.com\", \"created_at\": \"2025-08-26T07:44:55.000000Z\", \"updated_at\": \"2025-08-26T07:44:55.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:44:55', '2025-08-26 00:44:55'),
(59, 1, 'CREATE', 'App\\Models\\User', 4, 'Menambahkan user baru: Penulis (penulis@gmail.com)', NULL, '{\"id\": 4, \"name\": \"Penulis\", \"email\": \"penulis@gmail.com\", \"created_at\": \"2025-08-26T07:45:13.000000Z\", \"updated_at\": \"2025-08-26T07:45:13.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:45:13', '2025-08-26 00:45:13'),
(60, 1, 'CREATE', 'App\\Models\\Pejabat', 10, 'Menambahkan pejabat: Mamat - Staf Ahli', NULL, '{\"id\": 10, \"nip\": \"43789501231231313122\", \"name\": \"Mamat\", \"order\": \"0\", \"photo\": \"pejabat/Bv9kpRDNPnpIkdgXxb1H8gvDvij58INvoJI9DYHW.jpg\", \"jabatan\": \"Staf Ahli\", \"created_at\": \"2025-08-26T07:47:17.000000Z\", \"updated_at\": \"2025-08-26T07:47:17.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 00:47:17', '2025-08-26 00:47:17'),
(61, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 01:10:50', '2025-08-26 01:10:50'),
(62, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 01:18:59', '2025-08-26 01:18:59'),
(63, 1, 'CREATE', 'App\\Models\\VisiMisi', 1, 'Menambahkan visi misi baru', NULL, '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-26T08:41:15.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 01:41:15', '2025-08-26 01:41:15'),
(64, 1, 'UPDATE', 'App\\Models\\VisiMisi', 1, 'Mengubah visi misi', '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-26T08:41:15.000000Z\"}', '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\", \"ggggggggggggggggggggggggggggggggggggggggggggggg\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-26T09:00:05.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 02:00:05', '2025-08-26 02:00:05'),
(65, 1, 'UPDATE', 'App\\Models\\VisiMisi', 1, 'Mengubah visi misi', '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\", \"ggggggggggggggggggggggggggggggggggggggggggggggg\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-26T09:00:05.000000Z\"}', '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\", \"adfasdf sadfasdfa adfasdfa adfadf adfadfa adfadf adfasdfa adfa fa af dfadfsa dfsdfsadf adfadf adfadf\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-26T09:00:51.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 02:00:51', '2025-08-26 02:00:51'),
(66, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:32:52', '2025-08-26 18:32:52'),
(67, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:33:11', '2025-08-26 18:33:11'),
(68, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:37:31', '2025-08-26 18:37:31'),
(69, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:37:40', '2025-08-26 18:37:40'),
(70, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:38:17', '2025-08-26 18:38:17'),
(71, 1, 'UPDATE', 'App\\Models\\VisiMisi', 1, 'Menonaktifkan visi misi', '{\"is_active\": true}', '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\", \"adfasdf sadfasdfa adfasdfa adfadf adfadfa adfadf adfasdfa adfa fa af dfadfsa dfsdfsadf adfadf adfadf\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": false, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-27T01:46:57.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:46:57', '2025-08-26 18:46:57'),
(72, 1, 'UPDATE', 'App\\Models\\VisiMisi', 1, 'Mengaktifkan visi misi', '{\"is_active\": false}', '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\", \"adfasdf sadfasdfa adfasdfa adfadf adfadfa adfadf adfasdfa adfa fa af dfadfsa dfsdfsadf adfadf adfadf\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-27T01:55:22.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:55:22', '2025-08-26 18:55:22'),
(73, 1, 'UPDATE', 'App\\Models\\VisiMisi', 1, 'Mengubah visi misi', '{\"id\": 1, \"misi\": [\"Bekerja dengan baik dan benar dan baik nya misin ini di selesaikan dengan baik\", \"misi misi dan ketika apa dan satu dua tiga empat\", \"adfasdf sadfasdfa adfasdfa adfadf adfadfa adfadf adfasdfa adfa fa af dfadfsa dfsdfsadf adfadf adfadf\"], \"visi\": \"Misi kita menjalankan\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-27T01:55:22.000000Z\"}', '{\"id\": 1, \"misi\": [\"Menyelenggarakan Pelayanan Administrasi Kepegawaian yang Cepat, Tepat, dan Responsif: Memberikan layanan prima kepada seluruh ASN terkait urusan kepegawaian, seperti kenaikan pangkat, gaji berkala, pensiun, dan layanan lainnya dengan memanfaatkan teknologi informasi.\", \"Mengoptimalkan Perencanaan dan Pemenuhan Kebutuhan Pegawai: Melaksanakan analisis jabatan dan analisis beban kerja secara berkala untuk menyusun formasi pegawai yang efisien dan sesuai dengan kebutuhan strategis organisasi perangkat daerah (OPD).\", \"Mengembangkan Sistem Karier ASN yang Terbuka dan Kompetitif: Membangun pola karier yang jelas, transparan, dan berdasarkan pada rekam jejak kinerja serta potensi pegawai melalui manajemen talenta.\", \"Membina dan Menegakkan Disiplin serta Kode Etik Pegawai: Melakukan pembinaan secara berkelanjutan dan penegakan aturan disiplin secara tegas dan adil untuk menjaga martabat dan integritas ASN.\", \"Meningkatkan Kualitas Data dan Informasi Kepegawaian: Menyajikan data kepegawaian yang valid, mutakhir, dan terpercaya sebagai dasar utama dalam setiap pengambilan kebijakan di bidang sumber daya manusia.\"], \"visi\": \"Menjadi Lembaga Pengelola Kepegawaian yang Andal, Modern, dan Akuntabel demi Terciptanya Sumber Daya Manusia Aparatur yang Melayani dan Profesional.\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-08-27T02:02:19.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 19:02:19', '2025-08-26 19:02:19'),
(74, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 19:16:07', '2025-08-26 19:16:07'),
(75, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 19:16:43', '2025-08-26 19:16:43'),
(76, 1, 'CREATE', 'App\\Models\\Pejabat', 11, 'Menambahkan pejabat: Test 3 - Staf Ahli', NULL, '{\"id\": 11, \"nip\": \"43789501231231313123\", \"name\": \"Test 3\", \"order\": \"0\", \"photo\": \"pejabat/3zLQ1HmMdEznUZLBhpnrpzDUISpIp5eHKZNRIz0H.jpg\", \"jabatan\": \"Staf Ahli\", \"created_at\": \"2025-08-27T03:10:28.000000Z\", \"updated_at\": \"2025-08-27T03:10:28.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:10:28', '2025-08-26 20:10:28'),
(77, 1, 'CREATE', 'App\\Models\\Pejabat', 12, 'Menambahkan pejabat: Test 4 - Staf Ahli', NULL, '{\"id\": 12, \"nip\": \"43789501231231313155\", \"name\": \"Test 4\", \"order\": \"0\", \"photo\": \"pejabat/fb9PYoGVUqtbQbt6cJHcEfUqbWCKViXeeHwZCupZ.jpg\", \"jabatan\": \"Staf Ahli\", \"created_at\": \"2025-08-27T03:11:15.000000Z\", \"updated_at\": \"2025-08-27T03:11:15.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:11:15', '2025-08-26 20:11:15'),
(78, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 21:37:41', '2025-08-26 21:37:41'),
(79, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 21:44:39', '2025-08-26 21:44:39'),
(80, 1, 'UPDATE', 'App\\Models\\Hero', 1, 'Mengubah slide hero: Selamat Datang di BKPSDM Katingan', '{\"id\": 1, \"order\": 1, \"title\": \"Selamat Datang di BKPSDM Katingan\", \"subtitle\": \"Membangun Aparatur yang Kompeten dan Berintegritas\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-26T06:27:35.000000Z\", \"button_link\": null, \"button_text\": \"Selengkapnya\", \"background_image\": \"hero/IX56UvPAJVMOEisFDT6zea24i6qz0ZSEQSJ2N8N8.jpg\"}', '{\"id\": 1, \"order\": \"1\", \"title\": \"Selamat Datang di BKPSDM Katingan\", \"subtitle\": \"Membangun Aparatur yang Kompeten dan Berintegritas\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-27T06:43:00.000000Z\", \"button_link\": null, \"button_text\": \"Selengkapnya\", \"background_image\": \"hero/iHJMh7sEVc6nTQ7flJmfb5WjR7Q4awMIB3TkG3oC.jpg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 23:43:00', '2025-08-26 23:43:00');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `description`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(81, 1, 'UPDATE', 'App\\Models\\Hero', 2, 'Mengubah slide hero: Pelayanan Prima untuk Masyarakat', '{\"id\": 2, \"order\": 2, \"title\": \"Pelayanan Prima untuk Masyarakat\", \"subtitle\": \"Transparansi dan Akuntabilitas dalam Setiap Layanan\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-26T06:28:15.000000Z\", \"button_link\": null, \"button_text\": \"Hubungi Kami\", \"background_image\": \"hero/7tnlsVTIbB5cDaaocts4DQcuaeneJaRBcT2emy90.jpg\"}', '{\"id\": 2, \"order\": \"3\", \"title\": \"Pelayanan Prima untuk Masyarakat\", \"subtitle\": \"Transparansi dan Akuntabilitas dalam Setiap Layanan\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-27T06:43:18.000000Z\", \"button_link\": null, \"button_text\": \"Hubungi Kami\", \"background_image\": \"hero/3OPN5hl0u3XGb2Vs5viI0ZCXD75M17CqhGxh4SuZ.jpg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 23:43:18', '2025-08-26 23:43:18'),
(82, 1, 'UPDATE', 'App\\Models\\Pejabat', 6, 'Mengubah data pejabat: Mamat', '{\"id\": 6, \"nip\": \"198512345678901250\", \"name\": \"Mamat\", \"order\": 0, \"photo\": \"pejabat/HNE4moZGtLfeE8bOFFSYtsCTlMw8isqwuWmZUwvR.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-08-26T06:20:58.000000Z\", \"updated_at\": \"2025-08-26T06:20:58.000000Z\"}', '{\"id\": 6, \"nip\": \"198512345678901250\", \"name\": \"Mamat\", \"order\": \"0\", \"photo\": \"pejabat/gF2XAbcvzEGZ1POUbtviHqRqukzDoXTFGxcBj802.jpg\", \"jabatan\": \"Kepala Badan\", \"created_at\": \"2025-08-26T06:20:58.000000Z\", \"updated_at\": \"2025-08-27T06:44:43.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 23:44:43', '2025-08-26 23:44:43'),
(83, 1, 'UPDATE', 'App\\Models\\Pejabat', 6, 'Mengubah data pejabat: Mamat', '{\"id\": 6, \"nip\": \"198512345678901250\", \"name\": \"Mamat\", \"order\": 0, \"photo\": \"pejabat/gF2XAbcvzEGZ1POUbtviHqRqukzDoXTFGxcBj802.jpg\", \"jabatan\": \"Kepala Badan\", \"created_at\": \"2025-08-26T06:20:58.000000Z\", \"updated_at\": \"2025-08-27T06:44:43.000000Z\"}', '{\"id\": 6, \"nip\": \"198512345678901250\", \"name\": \"Mamat\", \"order\": \"0\", \"photo\": \"pejabat/gF2XAbcvzEGZ1POUbtviHqRqukzDoXTFGxcBj802.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-08-26T06:20:58.000000Z\", \"updated_at\": \"2025-08-27T06:49:15.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 23:49:15', '2025-08-26 23:49:15'),
(84, 1, 'CREATE', 'App\\Models\\Pejabat', 13, 'Menambahkan pejabat: test - Sekretaris', NULL, '{\"id\": 13, \"nip\": \"43789501231231313123\", \"name\": \"test\", \"order\": \"0\", \"photo\": \"pejabat/xCyB3rEPzdTgAzgFgFGp4nP79SjJaHGJ5FL8AZc3.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-08-27T06:49:44.000000Z\", \"updated_at\": \"2025-08-27T06:49:44.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 23:49:44', '2025-08-26 23:49:44'),
(85, 1, 'DELETE', 'App\\Models\\Pejabat', 13, 'Menghapus data pejabat: test - Sekretaris', '{\"id\": 13, \"nip\": \"43789501231231313123\", \"name\": \"test\", \"order\": 0, \"photo\": \"pejabat/xCyB3rEPzdTgAzgFgFGp4nP79SjJaHGJ5FL8AZc3.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-08-27T06:49:44.000000Z\", \"updated_at\": \"2025-08-27T06:49:44.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 23:50:56', '2025-08-26 23:50:56'),
(86, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 00:27:54', '2025-08-27 00:27:54'),
(87, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 00:28:14', '2025-08-27 00:28:14'),
(88, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 00:55:56', '2025-08-27 00:55:56'),
(89, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 00:56:26', '2025-08-27 00:56:26'),
(90, 3, 'UPDATE', 'App\\Models\\Pejabat', 5, 'Mengubah data pejabat: Test new', '{\"id\": 5, \"nip\": \"43789501231231313144\", \"name\": \"Test 1\", \"order\": 0, \"photo\": \"pejabat/toVSIWVUrsxAaVsxmkZ2LXtlMPvobanVXePAXQQQ.jpg\", \"jabatan\": \"Kepala Badan\", \"created_at\": \"2025-08-26T06:20:07.000000Z\", \"updated_at\": \"2025-08-26T06:20:07.000000Z\"}', '{\"id\": 5, \"nip\": \"43789501231231313144\", \"name\": \"Test new\", \"order\": \"0\", \"photo\": \"pejabat/toVSIWVUrsxAaVsxmkZ2LXtlMPvobanVXePAXQQQ.jpg\", \"jabatan\": \"Kepala Badan\", \"created_at\": \"2025-08-26T06:20:07.000000Z\", \"updated_at\": \"2025-08-27T07:56:58.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 00:56:58', '2025-08-27 00:56:58'),
(91, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 00:57:28', '2025-08-27 00:57:28'),
(92, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 18:33:57', '2025-08-27 18:33:57'),
(93, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-31 19:31:35', '2025-08-31 19:31:35'),
(94, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-31 19:38:27', '2025-08-31 19:38:27'),
(95, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-01 20:13:42', '2025-09-01 20:13:42'),
(96, 1, 'DELETE', 'App\\Models\\User', 2, 'Menghapus user: depp (dep@gmail.com)', '{\"id\": 2, \"name\": \"depp\", \"email\": \"dep@gmail.com\", \"created_at\": \"2025-08-26T06:18:13.000000Z\", \"updated_at\": \"2025-08-26T06:18:35.000000Z\", \"email_verified_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-01 20:13:54', '2025-09-01 20:13:54'),
(97, 1, 'DELETE', 'App\\Models\\User', 4, 'Menghapus user: Penulis (penulis@gmail.com)', '{\"id\": 4, \"name\": \"Penulis\", \"email\": \"penulis@gmail.com\", \"created_at\": \"2025-08-26T07:45:13.000000Z\", \"updated_at\": \"2025-08-26T07:45:13.000000Z\", \"email_verified_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-01 20:13:58', '2025-09-01 20:13:58'),
(98, 1, 'CREATE', 'App\\Models\\Agenda', 11, 'Menambahkan agenda baru: Test Agenda', NULL, '{\"id\": 11, \"slug\": \"test-agenda\", \"title\": \"Test Agenda\", \"created_at\": \"2025-09-02T03:16:32.000000Z\", \"updated_at\": \"2025-09-02T03:16:32.000000Z\", \"description\": \"Deskripsi Agenda\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-01 20:16:32', '2025-09-01 20:16:32'),
(99, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-01 20:16:40', '2025-09-01 20:16:40'),
(100, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:01:01', '2025-09-02 20:01:01'),
(101, 3, 'CREATE', 'App\\Models\\Pejabat', 14, 'Menambahkan pejabat: Nama - Kepala Dinas', NULL, '{\"id\": 14, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/j2h14hzkLHHlLpMfaoIro5u9o6bGEOZ7lSLpXtQe.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-03T03:06:31.000000Z\", \"updated_at\": \"2025-09-03T03:06:31.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:06:31', '2025-09-02 20:06:31'),
(102, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:11:24', '2025-09-02 20:11:24'),
(103, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:13:26', '2025-09-02 20:13:26'),
(104, 3, 'CREATE', 'App\\Models\\Pejabat', 15, 'Menambahkan pejabat: Nama - Sekretaris', NULL, '{\"id\": 15, \"nip\": \"43789501231231313144\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/63iBuIYrkzmHTLaHNZKnsZBONCjlUyhTHLcut9rY.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-03T03:15:42.000000Z\", \"updated_at\": \"2025-09-03T03:15:42.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:15:42', '2025-09-02 20:15:42'),
(105, 3, 'DELETE', 'App\\Models\\Pejabat', 15, 'Menghapus data pejabat: Nama - Sekretaris', '{\"id\": 15, \"nip\": \"43789501231231313144\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/63iBuIYrkzmHTLaHNZKnsZBONCjlUyhTHLcut9rY.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-03T03:15:42.000000Z\", \"updated_at\": \"2025-09-03T03:15:42.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:17:05', '2025-09-02 20:17:05'),
(106, 3, 'CREATE', 'App\\Models\\Pejabat', 16, 'Menambahkan pejabat: Nama - Sekretaris', NULL, '{\"id\": 16, \"nip\": \"43789501231231313144\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/Nn8vPRHZH0PGwQuQ4WCTMwJ1whuiC1gTYQwFjs6o.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-03T03:17:26.000000Z\", \"updated_at\": \"2025-09-03T03:17:26.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:17:26', '2025-09-02 20:17:26'),
(107, 3, 'CREATE', 'App\\Models\\Pejabat', 17, 'Menambahkan pejabat: Nama - Kepala Bidang', NULL, '{\"id\": 17, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/iZuk6GRKPqytS2bAgdXZ6WlRdFqYBeX6LwM7OLRi.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:21:15.000000Z\", \"updated_at\": \"2025-09-03T03:21:15.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:21:15', '2025-09-02 20:21:15'),
(108, 3, 'CREATE', 'App\\Models\\Pejabat', 18, 'Menambahkan pejabat: Nama 1 - Kepala Bidang', NULL, '{\"id\": 18, \"nip\": \"43789501231231313123\", \"name\": \"Nama 1\", \"order\": \"0\", \"photo\": \"pejabat/vzvFGj2TLupKZjQINGsJyJ47uAKpGcadSMLDofYw.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:28:13.000000Z\", \"updated_at\": \"2025-09-03T03:28:13.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:28:13', '2025-09-02 20:28:13'),
(109, 3, 'CREATE', 'App\\Models\\Pejabat', 19, 'Menambahkan pejabat: Nama 2 - Kepala Bidang', NULL, '{\"id\": 19, \"nip\": \"43789501231231313123\", \"name\": \"Nama 2\", \"order\": \"0\", \"photo\": \"pejabat/JAisAnCDIhqAEWGgW2IE3SKxXQmztDJt3VAYxphy.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:28:52.000000Z\", \"updated_at\": \"2025-09-03T03:28:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:28:53', '2025-09-02 20:28:53'),
(110, 3, 'DELETE', 'App\\Models\\Pejabat', 19, 'Menghapus data pejabat: Nama 2 - Kepala Bidang', '{\"id\": 19, \"nip\": \"43789501231231313123\", \"name\": \"Nama 2\", \"order\": 0, \"photo\": \"pejabat/JAisAnCDIhqAEWGgW2IE3SKxXQmztDJt3VAYxphy.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:28:52.000000Z\", \"updated_at\": \"2025-09-03T03:28:52.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:34:50', '2025-09-02 20:34:50'),
(111, 3, 'CREATE', 'App\\Models\\Pejabat', 20, 'Menambahkan pejabat: Nama - Kepala Bidang', NULL, '{\"id\": 20, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/NvKpiSBCPVYJHdCG264kguX605kf8UyRNVd32c46.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:35:20.000000Z\", \"updated_at\": \"2025-09-03T03:35:20.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:35:20', '2025-09-02 20:35:20'),
(112, 3, 'UPDATE', 'App\\Models\\Pejabat', 20, 'Mengubah data pejabat: Nama 2', '{\"id\": 20, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/NvKpiSBCPVYJHdCG264kguX605kf8UyRNVd32c46.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:35:20.000000Z\", \"updated_at\": \"2025-09-03T03:35:20.000000Z\"}', '{\"id\": 20, \"nip\": \"43789501231231313123\", \"name\": \"Nama 2\", \"order\": \"0\", \"photo\": \"pejabat/NvKpiSBCPVYJHdCG264kguX605kf8UyRNVd32c46.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-03T03:35:20.000000Z\", \"updated_at\": \"2025-09-03T03:35:55.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:35:55', '2025-09-02 20:35:55'),
(113, 3, 'DELETE', 'App\\Models\\Pejabat', 20, 'Menghapus data pejabat: Nama 2 - Kepala Dinas', '{\"id\": 20, \"nip\": \"43789501231231313123\", \"name\": \"Nama 2\", \"order\": 0, \"photo\": \"pejabat/NvKpiSBCPVYJHdCG264kguX605kf8UyRNVd32c46.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-03T03:35:20.000000Z\", \"updated_at\": \"2025-09-03T03:35:55.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 20:57:28', '2025-09-02 20:57:28'),
(114, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:41:33', '2025-09-03 00:41:33'),
(115, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:51:28', '2025-09-03 00:51:28'),
(116, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:52:03', '2025-09-03 00:52:03'),
(117, 3, 'CREATE', 'App\\Models\\Unduhan', 6, 'Menambahkan file unduhan: test judul yg panjang bangettttttttttttttttttttttttttttttttttttttttttttt ttadfafdas dfafkkdfadf dfkdllkdjfafd jsalfdafd ladjfaldkfj', NULL, '{\"id\": 6, \"title\": \"test judul yg panjang bangettttttttttttttttttttttttttttttttttttttttttttt ttadfafdas dfafkkdfadf dfkdllkdjfafd jsalfdafd ladjfaldkfj\", \"file_path\": \"unduhan/fzK1aCd1aF4oQPMrR1siqFZi7YHAd8ziPuL7vz77.pdf\", \"created_at\": \"2025-09-03T08:44:16.000000Z\", \"updated_at\": \"2025-09-03T08:44:16.000000Z\", \"description\": \"yytyjjggggghhhggghjgadflk;a\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 01:44:16', '2025-09-03 01:44:16'),
(118, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 02:20:09', '2025-09-03 02:20:09'),
(119, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 02:21:55', '2025-09-03 02:21:55'),
(120, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-04 10:44:44', '2025-09-04 10:44:44'),
(121, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-04 10:51:57', '2025-09-04 10:51:57'),
(122, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 18:44:03', '2025-09-07 18:44:03'),
(123, 3, 'CREATE', 'App\\Models\\Pejabat', 21, 'Menambahkan pejabat: Nama - Kasubag', NULL, '{\"id\": 21, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/ptpWyIHjG7KwhqqvU0TPwka2D7sjWtWIgXpucdEi.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-08T01:46:33.000000Z\", \"updated_at\": \"2025-09-08T01:46:33.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 18:46:33', '2025-09-07 18:46:33'),
(124, 3, 'DELETE', 'App\\Models\\Unduhan', 6, 'Menghapus file unduhan: test judul yg panjang bangettttttttttttttttttttttttttttttttttttttttttttt ttadfafdas dfafkkdfadf dfkdllkdjfafd jsalfdafd ladjfaldkfj', '{\"id\": 6, \"title\": \"test judul yg panjang bangettttttttttttttttttttttttttttttttttttttttttttt ttadfafdas dfafkkdfadf dfkdllkdjfafd jsalfdafd ladjfaldkfj\", \"file_path\": \"unduhan/fzK1aCd1aF4oQPMrR1siqFZi7YHAd8ziPuL7vz77.pdf\", \"created_at\": \"2025-09-03T08:44:16.000000Z\", \"updated_at\": \"2025-09-03T08:44:16.000000Z\", \"description\": \"yytyjjggggghhhggghjgadflk;a\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 18:55:28', '2025-09-07 18:55:28'),
(125, 3, 'CREATE', 'App\\Models\\Berita', 7, 'Menambahkan berita baru: test baru', NULL, '{\"id\": 7, \"slug\": \"test-baru\", \"title\": \"test baru\", \"status\": \"draft\", \"content\": \"<p style=\\\"text-align: center;\\\">test berita.</p>\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68be384caf3c3_1757296716.jpg\", \"created_at\": \"2025-09-08T01:58:37.000000Z\", \"updated_at\": \"2025-09-08T01:58:37.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 18:58:37', '2025-09-07 18:58:37'),
(126, 3, 'UPDATE', 'App\\Models\\Berita', 7, 'Mengubah berita: test baru', '{\"id\": 7, \"slug\": \"test-baru\", \"title\": \"test baru\", \"status\": \"draft\", \"content\": \"<p style=\\\"text-align: center;\\\">test berita.</p>\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68be384caf3c3_1757296716.jpg\", \"created_at\": \"2025-09-08T01:58:37.000000Z\", \"updated_at\": \"2025-09-08T01:58:37.000000Z\", \"published_at\": null}', '{\"id\": 7, \"slug\": \"test-baru\", \"title\": \"test baru\", \"status\": \"published\", \"content\": \"<p style=\\\"text-align: center;\\\">test berita.</p>\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68be384caf3c3_1757296716.jpg\", \"created_at\": \"2025-09-08T01:58:37.000000Z\", \"updated_at\": \"2025-09-08T01:58:52.000000Z\", \"published_at\": null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 18:58:52', '2025-09-07 18:58:52'),
(127, 3, 'UPDATE', 'App\\Models\\Berita', 5, 'Mengubah berita: Rapat Koordinasi Evaluasi Program Kerja', '{\"id\": 5, \"slug\": \"rapat-koordinasi-evaluasi-program-kerja\", \"title\": \"Rapat Koordinasi Evaluasi Program Kerja\", \"status\": \"published\", \"content\": \"<p>Rapat koordinasi evaluasi program kerja dilaksanakan untuk mengevaluasi capaian kinerja selama periode berjalan dan menyusun rencana tindak lanjut program kerja.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad54c081957_1756189888.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:31:28.000000Z\", \"published_at\": \"2025-08-01 04:55:14\"}', '{\"id\": 5, \"slug\": \"rapat-koordinasi-evaluasi-program-kerja\", \"title\": \"Rapat Koordinasi Evaluasi Program Kerja\", \"status\": \"draft\", \"content\": \"<p>Rapat koordinasi evaluasi program kerja dilaksanakan untuk mengevaluasi capaian kinerja selama periode berjalan dan menyusun rencana tindak lanjut program kerja.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad54c081957_1756189888.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-09-08T01:59:28.000000Z\", \"published_at\": \"2025-08-01 04:55:14\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 18:59:28', '2025-09-07 18:59:28'),
(128, 3, 'CREATE', 'App\\Models\\Galeri', 11, 'Menambahkan gambar galeri: Kucing', NULL, '{\"id\": 11, \"image\": \"galeri/68be39bf463d3_1757297087.jpg\", \"title\": \"Kucing\", \"created_at\": \"2025-09-08T02:04:47.000000Z\", \"updated_at\": \"2025-09-08T02:04:47.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 19:04:47', '2025-09-07 19:04:47'),
(129, 3, 'CREATE', 'App\\Models\\Unduhan', 7, 'Menambahkan file unduhan: Jurnal', NULL, '{\"id\": 7, \"title\": \"Jurnal\", \"file_path\": \"unduhan/CqpktiUxo4v68OvqrnfjEEDmu3VekJCqGXpskMoQ.pdf\", \"created_at\": \"2025-09-08T02:05:29.000000Z\", \"updated_at\": \"2025-09-08T02:05:29.000000Z\", \"description\": \"Deskripsi test\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 19:05:29', '2025-09-07 19:05:29'),
(130, 3, 'CREATE', 'App\\Models\\Agenda', 12, 'Menambahkan agenda baru: Rapat Evaluasi Kerja', NULL, '{\"id\": 12, \"slug\": \"rapat-evaluasi-kerja\", \"title\": \"Rapat Evaluasi Kerja\", \"file_path\": \"unduhan/1757297320_jurnal-5.pdf\", \"created_at\": \"2025-09-08T02:08:40.000000Z\", \"updated_at\": \"2025-09-08T02:08:40.000000Z\", \"description\": \"Rapat evaluasi kerja akan dilaksanakan pada 29 Desember 2025\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 19:08:40', '2025-09-07 19:08:40'),
(131, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:03:20', '2025-09-07 20:03:20'),
(132, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:07:58', '2025-09-07 20:07:58'),
(133, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:17:24', '2025-09-07 20:17:24'),
(134, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:17:39', '2025-09-07 20:17:39'),
(135, 1, 'CREATE', 'App\\Models\\User', 5, 'Menambahkan user baru: Penulis (penulis@gmail.com)', NULL, '{\"id\": 5, \"name\": \"Penulis\", \"email\": \"penulis@gmail.com\", \"created_at\": \"2025-09-08T03:18:33.000000Z\", \"updated_at\": \"2025-09-08T03:18:33.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:18:33', '2025-09-07 20:18:33'),
(136, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:18:39', '2025-09-07 20:18:39'),
(139, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:33:34', '2025-09-07 20:33:34'),
(140, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:39:01', '2025-09-07 20:39:01'),
(141, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:47:37', '2025-09-07 20:47:37'),
(142, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:47:43', '2025-09-07 20:47:43'),
(143, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:52:50', '2025-09-07 20:52:50'),
(144, 3, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-07 20:52:57', '2025-09-07 20:52:57'),
(145, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 01:35:36', '2025-09-08 01:35:36'),
(146, 1, 'CREATE', 'App\\Models\\User', 6, 'Menambahkan user baru: Testing (achmad091102@gmail.com)', NULL, '{\"id\": 6, \"name\": \"Testing\", \"email\": \"achmad091102@gmail.com\", \"created_at\": \"2025-09-08T08:36:50.000000Z\", \"updated_at\": \"2025-09-08T08:36:50.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 01:36:50', '2025-09-08 01:36:50'),
(147, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 01:37:01', '2025-09-08 01:37:01'),
(148, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 02:00:28', '2025-09-08 02:00:28'),
(149, 1, 'CREATE', 'App\\Models\\User', 7, 'Menambahkan user baru: dep (deprowinoto3690@gmail.com)', NULL, '{\"id\": 7, \"name\": \"dep\", \"email\": \"deprowinoto3690@gmail.com\", \"created_at\": \"2025-09-08T09:01:29.000000Z\", \"updated_at\": \"2025-09-08T09:01:29.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 02:01:29', '2025-09-08 02:01:29'),
(150, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 02:01:42', '2025-09-08 02:01:42'),
(151, 7, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 19:26:07', '2025-09-08 19:26:07'),
(152, 7, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 19:26:49', '2025-09-08 19:26:49'),
(153, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 19:28:05', '2025-09-08 19:28:05'),
(154, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:49:34', '2025-09-08 20:49:34'),
(155, 1, 'DELETE', 'App\\Models\\Berita', 7, 'Menghapus berita: test baru', '{\"id\": 7, \"slug\": \"test-baru\", \"title\": \"test baru\", \"status\": \"published\", \"content\": \"<p style=\\\"text-align: center;\\\">test berita.</p>\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68be384caf3c3_1757296716.jpg\", \"created_at\": \"2025-09-08T01:58:37.000000Z\", \"updated_at\": \"2025-09-08T01:58:52.000000Z\", \"published_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:50:20', '2025-09-08 20:50:20'),
(156, 1, 'DELETE', 'App\\Models\\Berita', 6, 'Menghapus berita: Tes Berita Baru', '{\"id\": 6, \"slug\": \"tes-berita-baru\", \"title\": \"Tes Berita Baru\", \"status\": \"published\", \"content\": \"<p style=\\\"text-align: right;\\\">Berita baru, baru di buat dan di kerjakan tadi banget, test test test dan test</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad64ce0ee4b_1756193998.jpg\", \"created_at\": \"2025-08-26T07:39:58.000000Z\", \"updated_at\": \"2025-08-26T07:40:06.000000Z\", \"published_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:50:24', '2025-09-08 20:50:24'),
(157, 1, 'DELETE', 'App\\Models\\Berita', 5, 'Menghapus berita: Rapat Koordinasi Evaluasi Program Kerja', '{\"id\": 5, \"slug\": \"rapat-koordinasi-evaluasi-program-kerja\", \"title\": \"Rapat Koordinasi Evaluasi Program Kerja\", \"status\": \"draft\", \"content\": \"<p>Rapat koordinasi evaluasi program kerja dilaksanakan untuk mengevaluasi capaian kinerja selama periode berjalan dan menyusun rencana tindak lanjut program kerja.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad54c081957_1756189888.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-09-08T01:59:28.000000Z\", \"published_at\": \"2025-08-01 04:55:14\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:50:28', '2025-09-08 20:50:28'),
(158, 1, 'DELETE', 'App\\Models\\Berita', 2, 'Menghapus berita: Sosialisasi Peraturan Disiplin PNS Terbaru', '{\"id\": 2, \"slug\": \"sosialisasi-peraturan-disiplin-pns-terbaru\", \"title\": \"Sosialisasi Peraturan Disiplin PNS Terbaru\", \"status\": \"published\", \"content\": \"<p>BKPSDM Kabupaten Katingan menggelar sosialisasi peraturan disiplin PNS terbaru kepada seluruh ASN di lingkungan Pemerintah Kabupaten Katingan.</p>\\r\\n<p>Kegiatan ini bertujuan untuk memberikan pemahaman yang komprehensif tentang hak, kewajiban, dan sanksi disiplin yang berlaku bagi PNS sesuai dengan peraturan terbaru.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad548e79ff2_1756189838.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:30:38.000000Z\", \"published_at\": \"2025-08-16 04:55:14\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:50:31', '2025-09-08 20:50:31'),
(159, 1, 'DELETE', 'App\\Models\\Berita', 3, 'Menghapus berita: Pelatihan Kepemimpinan untuk Pejabat Eselon III dan IV', '{\"id\": 3, \"slug\": \"pelatihan-kepemimpinan-untuk-pejabat-eselon-iii-dan-iv\", \"title\": \"Pelatihan Kepemimpinan untuk Pejabat Eselon III dan IV\", \"status\": \"published\", \"content\": \"<p>Dalam rangka meningkatkan kompetensi kepemimpinan, BKPSDM Kabupaten Katingan menyelenggarakan pelatihan kepemimpinan bagi pejabat eselon III dan IV.</p>\\r\\n<p>Pelatihan ini mencakup materi tentang kepemimpinan transformasional, manajemen konflik, dan komunikasi efektif dalam organisasi pemerintahan.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad549b227b9_1756189851.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:30:51.000000Z\", \"published_at\": \"2025-08-11 04:55:14\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:50:34', '2025-09-08 20:50:34'),
(160, 1, 'DELETE', 'App\\Models\\Berita', 4, 'Menghapus berita: Workshop Penyusunan SKP dan Penilaian Kinerja', '{\"id\": 4, \"slug\": \"workshop-penyusunan-skp-dan-penilaian-kinerja\", \"title\": \"Workshop Penyusunan SKP dan Penilaian Kinerja\", \"status\": \"published\", \"content\": \"<p>BKPSDM Kabupaten Katingan menyelenggarakan workshop penyusunan SKP dan penilaian kinerja untuk seluruh ASN guna meningkatkan kualitas perencanaan dan evaluasi kinerja.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68ad54b630028_1756189878.jpg\", \"created_at\": \"2025-08-26T04:52:18.000000Z\", \"updated_at\": \"2025-08-26T06:31:18.000000Z\", \"published_at\": \"2025-08-06 04:55:14\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:50:37', '2025-09-08 20:50:37'),
(161, 1, 'DELETE', 'App\\Models\\Galeri', 11, 'Menghapus gambar galeri: Kucing', '{\"id\": 11, \"image\": \"galeri/68be39bf463d3_1757297087.jpg\", \"title\": \"Kucing\", \"created_at\": \"2025-09-08T02:04:47.000000Z\", \"updated_at\": \"2025-09-08T02:04:47.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:51:47', '2025-09-08 20:51:47'),
(162, 1, 'DELETE', 'App\\Models\\Galeri', 10, 'Menghapus gambar galeri: Tanpa judul', '{\"id\": 10, \"image\": \"galeri/68ad55258a078_1756189989.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:33:09.000000Z\", \"updated_at\": \"2025-08-26T06:33:09.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:51:52', '2025-09-08 20:51:52'),
(163, 1, 'DELETE', 'App\\Models\\Galeri', 8, 'Menghapus gambar galeri: Judul test', '{\"id\": 8, \"image\": \"galeri/68ad5512a6384_1756189970.jpg\", \"title\": \"Judul test\", \"created_at\": \"2025-08-26T06:32:50.000000Z\", \"updated_at\": \"2025-08-26T07:40:39.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:51:55', '2025-09-08 20:51:55'),
(164, 1, 'DELETE', 'App\\Models\\Galeri', 9, 'Menghapus gambar galeri: Tanpa judul', '{\"id\": 9, \"image\": \"galeri/68ad551aad9c0_1756189978.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:32:58.000000Z\", \"updated_at\": \"2025-08-26T06:32:58.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:51:58', '2025-09-08 20:51:58'),
(165, 1, 'DELETE', 'App\\Models\\Galeri', 7, 'Menghapus gambar galeri: Tanpa judul', '{\"id\": 7, \"image\": \"galeri/68ad550867f4c_1756189960.jpg\", \"title\": null, \"created_at\": \"2025-08-26T06:32:40.000000Z\", \"updated_at\": \"2025-08-26T06:32:40.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:52:02', '2025-09-08 20:52:02'),
(166, 1, 'DELETE', 'App\\Models\\Hero', 1, 'Menghapus slide hero: Selamat Datang di BKPSDM Katingan', '{\"id\": 1, \"order\": 1, \"title\": \"Selamat Datang di BKPSDM Katingan\", \"subtitle\": \"Membangun Aparatur yang Kompeten dan Berintegritas\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-27T06:43:00.000000Z\", \"button_link\": null, \"button_text\": \"Selengkapnya\", \"background_image\": \"hero/iHJMh7sEVc6nTQ7flJmfb5WjR7Q4awMIB3TkG3oC.jpg\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:53:27', '2025-09-08 20:53:27'),
(167, 1, 'DELETE', 'App\\Models\\Hero', 3, 'Menghapus slide hero: Contoh Slide Atas', '{\"id\": 3, \"order\": 1, \"title\": \"Contoh Slide Atas\", \"subtitle\": \"contoh Judul\", \"created_at\": \"2025-08-26T06:25:40.000000Z\", \"updated_at\": \"2025-08-26T06:25:40.000000Z\", \"button_link\": null, \"button_text\": \"contoh teks\", \"background_image\": \"hero/ki10kzADzyGlhI7zfwMUAggEr9NgMsDq0SjGo2zn.jpg\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:53:41', '2025-09-08 20:53:41'),
(168, 1, 'DELETE', 'App\\Models\\Hero', 2, 'Menghapus slide hero: Pelayanan Prima untuk Masyarakat', '{\"id\": 2, \"order\": 3, \"title\": \"Pelayanan Prima untuk Masyarakat\", \"subtitle\": \"Transparansi dan Akuntabilitas dalam Setiap Layanan\", \"created_at\": \"2025-08-26T04:54:16.000000Z\", \"updated_at\": \"2025-08-27T06:43:18.000000Z\", \"button_link\": null, \"button_text\": \"Hubungi Kami\", \"background_image\": \"hero/3OPN5hl0u3XGb2Vs5viI0ZCXD75M17CqhGxh4SuZ.jpg\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:54:42', '2025-09-08 20:54:42'),
(169, 1, 'DELETE', 'App\\Models\\Unduhan', 7, 'Menghapus file unduhan: Jurnal', '{\"id\": 7, \"title\": \"Jurnal\", \"file_path\": \"unduhan/CqpktiUxo4v68OvqrnfjEEDmu3VekJCqGXpskMoQ.pdf\", \"created_at\": \"2025-09-08T02:05:29.000000Z\", \"updated_at\": \"2025-09-08T02:05:29.000000Z\", \"description\": \"Deskripsi test\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:55:57', '2025-09-08 20:55:57'),
(170, 1, 'DELETE', 'App\\Models\\Unduhan', 5, 'Menghapus file unduhan: Contoh File Rapat Terbaru', '{\"id\": 5, \"title\": \"Contoh File Rapat Terbaru\", \"file_path\": \"unduhan/TWLV5NbI1QEcssHOc7s1lugoxxJX1ks5CXv5rqwh.pdf\", \"created_at\": \"2025-08-26T06:37:00.000000Z\", \"updated_at\": \"2025-08-26T06:37:00.000000Z\", \"description\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:55:59', '2025-09-08 20:55:59'),
(171, 1, 'DELETE', 'App\\Models\\Unduhan', 4, 'Menghapus file unduhan: Contoh File Rapat terbaru', '{\"id\": 4, \"title\": \"Contoh File Rapat terbaru\", \"file_path\": \"unduhan/rVfiDHrh9qJKjVLKVtoFHzdvUePmuwz4von8Zisq.pdf\", \"created_at\": \"2025-08-26T06:36:18.000000Z\", \"updated_at\": \"2025-08-26T06:36:18.000000Z\", \"description\": \"REST\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:56:02', '2025-09-08 20:56:02'),
(172, 1, 'DELETE', 'App\\Models\\Pejabat', 14, 'Menghapus data pejabat: Nama - Kepala Dinas', '{\"id\": 14, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/j2h14hzkLHHlLpMfaoIro5u9o6bGEOZ7lSLpXtQe.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-03T03:06:31.000000Z\", \"updated_at\": \"2025-09-03T03:06:31.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:01:10', '2025-09-08 21:01:10'),
(173, 1, 'DELETE', 'App\\Models\\Pejabat', 16, 'Menghapus data pejabat: Nama - Sekretaris', '{\"id\": 16, \"nip\": \"43789501231231313144\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/Nn8vPRHZH0PGwQuQ4WCTMwJ1whuiC1gTYQwFjs6o.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-03T03:17:26.000000Z\", \"updated_at\": \"2025-09-03T03:17:26.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:01:14', '2025-09-08 21:01:14'),
(174, 1, 'DELETE', 'App\\Models\\Pejabat', 17, 'Menghapus data pejabat: Nama - Kepala Bidang', '{\"id\": 17, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/iZuk6GRKPqytS2bAgdXZ6WlRdFqYBeX6LwM7OLRi.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:21:15.000000Z\", \"updated_at\": \"2025-09-03T03:21:15.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:01:21', '2025-09-08 21:01:21'),
(175, 1, 'DELETE', 'App\\Models\\Pejabat', 18, 'Menghapus data pejabat: Nama 1 - Kepala Bidang', '{\"id\": 18, \"nip\": \"43789501231231313123\", \"name\": \"Nama 1\", \"order\": 0, \"photo\": \"pejabat/vzvFGj2TLupKZjQINGsJyJ47uAKpGcadSMLDofYw.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-03T03:28:13.000000Z\", \"updated_at\": \"2025-09-03T03:28:13.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:01:25', '2025-09-08 21:01:25'),
(176, 1, 'DELETE', 'App\\Models\\Pejabat', 21, 'Menghapus data pejabat: Nama - Kasubag', '{\"id\": 21, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/ptpWyIHjG7KwhqqvU0TPwka2D7sjWtWIgXpucdEi.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-08T01:46:33.000000Z\", \"updated_at\": \"2025-09-08T01:46:33.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:01:30', '2025-09-08 21:01:30'),
(177, 1, 'CREATE', 'App\\Models\\Hero', 5, 'Menambahkan slide hero: Foto Bersama BKPSDM', NULL, '{\"id\": 5, \"order\": \"0\", \"title\": \"Foto Bersama BKPSDM\", \"subtitle\": \"Foto Bersama seluruh pegawai BKPSDM\", \"created_at\": \"2025-09-09T04:11:05.000000Z\", \"updated_at\": \"2025-09-09T04:11:05.000000Z\", \"button_link\": null, \"button_text\": null, \"background_image\": \"hero/Ivo27zjkz1GhsKDdjSxSupNld9mbteDbvgPLwzlD.jpg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:11:05', '2025-09-08 21:11:05'),
(178, 1, 'CREATE', 'App\\Models\\Hero', 6, 'Menambahkan slide hero: UNTUK HAPUS', NULL, '{\"id\": 6, \"order\": \"0\", \"title\": \"UNTUK HAPUS\", \"subtitle\": \"TEST\", \"created_at\": \"2025-09-09T04:11:55.000000Z\", \"updated_at\": \"2025-09-09T04:11:55.000000Z\", \"button_link\": null, \"button_text\": null, \"background_image\": \"hero/jzAOM3VGEMY4q7IW1NSzpCyoU026lyXWVIKxMFPT.jpg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:11:55', '2025-09-08 21:11:55'),
(179, 1, 'DELETE', 'App\\Models\\Hero', 6, 'Menghapus slide hero: UNTUK HAPUS', '{\"id\": 6, \"order\": 0, \"title\": \"UNTUK HAPUS\", \"subtitle\": \"TEST\", \"created_at\": \"2025-09-09T04:11:55.000000Z\", \"updated_at\": \"2025-09-09T04:11:55.000000Z\", \"button_link\": null, \"button_text\": null, \"background_image\": \"hero/jzAOM3VGEMY4q7IW1NSzpCyoU026lyXWVIKxMFPT.jpg\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:12:15', '2025-09-08 21:12:15'),
(180, 1, 'CREATE', 'App\\Models\\Berita', 8, 'Menambahkan berita baru: Berita nih yee', NULL, '{\"id\": 8, \"slug\": \"berita-nih-yee\", \"title\": \"Berita nih yee\", \"status\": \"draft\", \"content\": \"testadfad\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68bfa9606e49d_1757391200.jpg\", \"created_at\": \"2025-09-09T04:13:20.000000Z\", \"updated_at\": \"2025-09-09T04:13:20.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:13:20', '2025-09-08 21:13:20'),
(181, 1, 'DELETE', 'App\\Models\\Berita', 8, 'Menghapus berita: Berita nih yee', '{\"id\": 8, \"slug\": \"berita-nih-yee\", \"title\": \"Berita nih yee\", \"status\": \"draft\", \"content\": \"testadfad\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68bfa9606e49d_1757391200.jpg\", \"created_at\": \"2025-09-09T04:13:20.000000Z\", \"updated_at\": \"2025-09-09T04:13:20.000000Z\", \"published_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:14:06', '2025-09-08 21:14:06'),
(182, 1, 'CREATE', 'App\\Models\\Berita', 9, 'Menambahkan berita baru: teafafd', NULL, '{\"id\": 9, \"slug\": \"teafafd\", \"title\": \"teafafd\", \"status\": \"draft\", \"content\": \"adfadfad\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68bfa9ae1ee9d_1757391278.jpg\", \"created_at\": \"2025-09-09T04:14:38.000000Z\", \"updated_at\": \"2025-09-09T04:14:38.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:14:38', '2025-09-08 21:14:38'),
(183, 1, 'DELETE', 'App\\Models\\Berita', 9, 'Menghapus berita: teafafd', '{\"id\": 9, \"slug\": \"teafafd\", \"title\": \"teafafd\", \"status\": \"draft\", \"content\": \"adfadfad\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68bfa9ae1ee9d_1757391278.jpg\", \"created_at\": \"2025-09-09T04:14:38.000000Z\", \"updated_at\": \"2025-09-09T04:14:38.000000Z\", \"published_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:14:55', '2025-09-08 21:14:55'),
(184, 1, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:22:26', '2025-09-08 21:22:26'),
(185, 3, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:22:48', '2025-09-08 21:22:48'),
(186, 3, 'CREATE', 'App\\Models\\Berita', 10, 'Menambahkan berita baru: adfadsfasd', NULL, '{\"id\": 10, \"slug\": \"adfadsfasd\", \"title\": \"adfadsfasd\", \"status\": \"draft\", \"content\": \"adfad\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68bfabb064d82_1757391792.jpg\", \"created_at\": \"2025-09-09T04:23:12.000000Z\", \"updated_at\": \"2025-09-09T04:23:12.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:23:12', '2025-09-08 21:23:12');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `description`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(187, 3, 'UPDATE', 'App\\Models\\Berita', 10, 'Mengubah berita: adfadsfasd', '{\"id\": 10, \"slug\": \"adfadsfasd\", \"title\": \"adfadsfasd\", \"status\": \"draft\", \"content\": \"adfad\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68bfabb064d82_1757391792.jpg\", \"created_at\": \"2025-09-09T04:23:12.000000Z\", \"updated_at\": \"2025-09-09T04:23:12.000000Z\", \"published_at\": null}', '{\"id\": 10, \"slug\": \"adfadsfasd\", \"title\": \"adfadsfasd\", \"status\": \"published\", \"content\": \"adfad\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68bfabb064d82_1757391792.jpg\", \"created_at\": \"2025-09-09T04:23:12.000000Z\", \"updated_at\": \"2025-09-09T04:23:27.000000Z\", \"published_at\": null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:23:27', '2025-09-08 21:23:27'),
(188, 3, 'DELETE', 'App\\Models\\Berita', 10, 'Menghapus berita: adfadsfasd', '{\"id\": 10, \"slug\": \"adfadsfasd\", \"title\": \"adfadsfasd\", \"status\": \"published\", \"content\": \"adfad\", \"user_id\": 3, \"thumbnail\": \"thumbnails/berita/68bfabb064d82_1757391792.jpg\", \"created_at\": \"2025-09-09T04:23:12.000000Z\", \"updated_at\": \"2025-09-09T04:23:27.000000Z\", \"published_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:26:30', '2025-09-08 21:26:30'),
(189, 7, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:47:53', '2025-09-09 00:47:53'),
(190, 7, 'DELETE', 'App\\Models\\Kontak', 5, 'Menghapus pesan kontak dari:  (a@a.com)', '{\"id\": 5, \"name\": \"tes\", \"email\": \"a@a.com\", \"message\": \"adfadf\", \"subject\": \"adfad\", \"created_at\": \"2025-09-09T07:49:49.000000Z\", \"updated_at\": \"2025-09-09T07:49:49.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:20', '2025-09-09 00:50:20'),
(191, 7, 'DELETE', 'App\\Models\\Kontak', 4, 'Menghapus pesan kontak dari:  (dep@gmail.com)', '{\"id\": 4, \"name\": \"ADFA\", \"email\": \"dep@gmail.com\", \"message\": \"ADFAD\", \"subject\": \"ADFA\", \"created_at\": \"2025-09-03T09:08:20.000000Z\", \"updated_at\": \"2025-09-03T09:08:20.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:24', '2025-09-09 00:50:24'),
(192, 7, 'DELETE', 'App\\Models\\Kontak', 3, 'Menghapus pesan kontak dari:  (dep@gmail.com)', '{\"id\": 3, \"name\": \"adfadfada\", \"email\": \"dep@gmail.com\", \"message\": \"asdfasdfa\", \"subject\": \"adfa\", \"created_at\": \"2025-09-03T09:07:25.000000Z\", \"updated_at\": \"2025-09-03T09:07:25.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:26', '2025-09-09 00:50:26'),
(193, 7, 'DELETE', 'App\\Models\\Kontak', 2, 'Menghapus pesan kontak dari:  (dep@gmail.com)', '{\"id\": 2, \"name\": \"ADF\", \"email\": \"dep@gmail.com\", \"message\": \"ADFA LADFK KDFA KDAFN KE SINI DAN BISA SAJA\", \"subject\": \"DFDFD\", \"created_at\": \"2025-09-03T08:51:16.000000Z\", \"updated_at\": \"2025-09-03T08:51:16.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:28', '2025-09-09 00:50:28'),
(194, 7, 'DELETE', 'App\\Models\\Agenda', 4, 'Menghapus agenda: Contoh Agenda', '{\"id\": 4, \"slug\": \"contoh-agenda\", \"title\": \"Contoh Agenda\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T06:46:16.000000Z\", \"updated_at\": \"2025-08-26T08:51:19.000000Z\", \"description\": \"Contoh deskripsi Agenda\\r\\ncontoh ada perbaikan\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:43', '2025-09-09 00:50:43'),
(195, 7, 'DELETE', 'App\\Models\\Agenda', 9, 'Menghapus agenda: test edit', '{\"id\": 9, \"slug\": \"test-edit\", \"title\": \"test edit\", \"tanggal\": null, \"file_path\": \"unduhan/1756193863_rapat.pdf\", \"created_at\": \"2025-08-26T07:37:17.000000Z\", \"updated_at\": \"2025-08-26T08:51:19.000000Z\", \"description\": \"adfadfadfadfaf edt\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:46', '2025-09-09 00:50:46'),
(196, 7, 'DELETE', 'App\\Models\\Agenda', 10, 'Menghapus agenda: Rapat Koordinasi Bulanan API', '{\"id\": 10, \"slug\": \"rapat-koordinasi-bulanan-api\", \"title\": \"Rapat Koordinasi Bulanan API\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-08-26T08:11:27.000000Z\", \"updated_at\": \"2025-08-26T08:51:19.000000Z\", \"description\": \"Rapat koordinasi bulanan untuk evaluasi kinerja pegawai dan pembahasan program kerja bulan depan. API\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:49', '2025-09-09 00:50:49'),
(197, 7, 'DELETE', 'App\\Models\\Agenda', 11, 'Menghapus agenda: Test Agenda', '{\"id\": 11, \"slug\": \"test-agenda\", \"title\": \"Test Agenda\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-09-02T03:16:32.000000Z\", \"updated_at\": \"2025-09-02T03:16:32.000000Z\", \"description\": \"Deskripsi Agenda\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:50:52', '2025-09-09 00:50:52'),
(198, 7, 'UPDATE', 'App\\Models\\VisiMisi', 1, 'Menonaktifkan visi misi', '{\"is_active\": true}', '{\"id\": 1, \"misi\": [\"Menyelenggarakan Pelayanan Administrasi Kepegawaian yang Cepat, Tepat, dan Responsif: Memberikan layanan prima kepada seluruh ASN terkait urusan kepegawaian, seperti kenaikan pangkat, gaji berkala, pensiun, dan layanan lainnya dengan memanfaatkan teknologi informasi.\", \"Mengoptimalkan Perencanaan dan Pemenuhan Kebutuhan Pegawai: Melaksanakan analisis jabatan dan analisis beban kerja secara berkala untuk menyusun formasi pegawai yang efisien dan sesuai dengan kebutuhan strategis organisasi perangkat daerah (OPD).\", \"Mengembangkan Sistem Karier ASN yang Terbuka dan Kompetitif: Membangun pola karier yang jelas, transparan, dan berdasarkan pada rekam jejak kinerja serta potensi pegawai melalui manajemen talenta.\", \"Membina dan Menegakkan Disiplin serta Kode Etik Pegawai: Melakukan pembinaan secara berkelanjutan dan penegakan aturan disiplin secara tegas dan adil untuk menjaga martabat dan integritas ASN.\", \"Meningkatkan Kualitas Data dan Informasi Kepegawaian: Menyajikan data kepegawaian yang valid, mutakhir, dan terpercaya sebagai dasar utama dalam setiap pengambilan kebijakan di bidang sumber daya manusia.\"], \"visi\": \"Menjadi Lembaga Pengelola Kepegawaian yang Andal, Modern, dan Akuntabel demi Terciptanya Sumber Daya Manusia Aparatur yang Melayani dan Profesional.\", \"is_active\": false, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-09-09T07:59:57.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 00:59:57', '2025-09-09 00:59:57'),
(199, 7, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:41:08', '2025-09-09 18:41:08'),
(200, 7, 'DELETE', 'App\\Models\\Agenda', 12, 'Menghapus agenda: Rapat Evaluasi Kerja', '{\"id\": 12, \"slug\": \"rapat-evaluasi-kerja\", \"title\": \"Rapat Evaluasi Kerja\", \"tanggal\": null, \"file_path\": \"unduhan/1757297320_jurnal-5.pdf\", \"created_at\": \"2025-09-08T02:08:40.000000Z\", \"updated_at\": \"2025-09-08T02:08:40.000000Z\", \"description\": \"Rapat evaluasi kerja akan dilaksanakan pada 29 Desember 2025\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:45:34', '2025-09-09 18:45:34'),
(201, 7, 'CREATE', 'App\\Models\\Berita', 11, 'Menambahkan berita baru: Judul Berita', NULL, '{\"id\": 11, \"slug\": \"judul-berita\", \"title\": \"Judul Berita\", \"status\": \"draft\", \"content\": \"<p data-start=\\\"23\\\" data-end=\\\"437\\\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\\r\\n<p data-start=\\\"439\\\" data-end=\\\"811\\\" data-is-last-node=\\\"\\\" data-is-only-node=\\\"\\\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>\", \"user_id\": 7, \"thumbnail\": \"thumbnails/berita/68c0d9a19c632_1757469089.jpg\", \"created_at\": \"2025-09-10T01:51:29.000000Z\", \"updated_at\": \"2025-09-10T01:51:29.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:51:29', '2025-09-09 18:51:29'),
(202, 7, 'UPDATE', 'App\\Models\\Berita', 11, 'Mengubah berita: Judul Berita', '{\"id\": 11, \"slug\": \"judul-berita\", \"title\": \"Judul Berita\", \"status\": \"draft\", \"content\": \"<p data-start=\\\"23\\\" data-end=\\\"437\\\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\\r\\n<p data-start=\\\"439\\\" data-end=\\\"811\\\" data-is-last-node=\\\"\\\" data-is-only-node=\\\"\\\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>\", \"user_id\": 7, \"thumbnail\": \"thumbnails/berita/68c0d9a19c632_1757469089.jpg\", \"created_at\": \"2025-09-10T01:51:29.000000Z\", \"updated_at\": \"2025-09-10T01:51:29.000000Z\", \"published_at\": null}', '{\"id\": 11, \"slug\": \"judul-berita\", \"title\": \"Judul Berita\", \"status\": \"published\", \"content\": \"<p data-start=\\\"23\\\" data-end=\\\"437\\\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\\r\\n<p data-start=\\\"439\\\" data-end=\\\"811\\\" data-is-last-node=\\\"\\\" data-is-only-node=\\\"\\\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>\", \"user_id\": 7, \"thumbnail\": \"thumbnails/berita/68c0d9a19c632_1757469089.jpg\", \"created_at\": \"2025-09-10T01:51:29.000000Z\", \"updated_at\": \"2025-09-10T01:51:45.000000Z\", \"published_at\": null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:51:45', '2025-09-09 18:51:45'),
(203, 7, 'DELETE', 'App\\Models\\Berita', 11, 'Menghapus berita: Judul Berita', '{\"id\": 11, \"slug\": \"judul-berita\", \"title\": \"Judul Berita\", \"status\": \"published\", \"content\": \"<p data-start=\\\"23\\\" data-end=\\\"437\\\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\\r\\n<p data-start=\\\"439\\\" data-end=\\\"811\\\" data-is-last-node=\\\"\\\" data-is-only-node=\\\"\\\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>\", \"user_id\": 7, \"thumbnail\": \"thumbnails/berita/68c0d9a19c632_1757469089.jpg\", \"created_at\": \"2025-09-10T01:51:29.000000Z\", \"updated_at\": \"2025-09-10T01:51:45.000000Z\", \"published_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:53:29', '2025-09-09 18:53:29'),
(204, 7, 'CREATE', 'App\\Models\\Galeri', 12, 'Menambahkan gambar galeri: Judul Galeri', NULL, '{\"id\": 12, \"image\": \"galeri/68c0da5f53789_1757469279.jpg\", \"title\": \"Judul Galeri\", \"created_at\": \"2025-09-10T01:54:39.000000Z\", \"updated_at\": \"2025-09-10T01:54:39.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:54:39', '2025-09-09 18:54:39'),
(205, 7, 'CREATE', 'App\\Models\\Unduhan', 8, 'Menambahkan file unduhan: Judul File', NULL, '{\"id\": 8, \"title\": \"Judul File\", \"file_path\": \"unduhan/n5LYTXYDmZqj0Inmb4aBBAt6ASsTiTpVUdV8Iuaz.pdf\", \"created_at\": \"2025-09-10T01:57:32.000000Z\", \"updated_at\": \"2025-09-10T01:57:32.000000Z\", \"description\": \"file test\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:57:32', '2025-09-09 18:57:32'),
(206, 7, 'CREATE', 'App\\Models\\Agenda', 13, 'Menambahkan agenda baru: Rapat Organisasi Terbaru', NULL, '{\"id\": 13, \"slug\": \"rapat-organisasi-terbaru\", \"title\": \"Rapat Organisasi Terbaru\", \"file_path\": \"unduhan/1757469541_jurnal-5.pdf\", \"created_at\": \"2025-09-10T01:59:01.000000Z\", \"updated_at\": \"2025-09-10T01:59:01.000000Z\", \"description\": \"Rapat akan dilaksanakan 2025 Desember 20\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:59:01', '2025-09-09 18:59:01'),
(207, 7, 'UPDATE', 'App\\Models\\VisiMisi', 1, 'Mengaktifkan visi misi', '{\"is_active\": false}', '{\"id\": 1, \"misi\": [\"Menyelenggarakan Pelayanan Administrasi Kepegawaian yang Cepat, Tepat, dan Responsif: Memberikan layanan prima kepada seluruh ASN terkait urusan kepegawaian, seperti kenaikan pangkat, gaji berkala, pensiun, dan layanan lainnya dengan memanfaatkan teknologi informasi.\", \"Mengoptimalkan Perencanaan dan Pemenuhan Kebutuhan Pegawai: Melaksanakan analisis jabatan dan analisis beban kerja secara berkala untuk menyusun formasi pegawai yang efisien dan sesuai dengan kebutuhan strategis organisasi perangkat daerah (OPD).\", \"Mengembangkan Sistem Karier ASN yang Terbuka dan Kompetitif: Membangun pola karier yang jelas, transparan, dan berdasarkan pada rekam jejak kinerja serta potensi pegawai melalui manajemen talenta.\", \"Membina dan Menegakkan Disiplin serta Kode Etik Pegawai: Melakukan pembinaan secara berkelanjutan dan penegakan aturan disiplin secara tegas dan adil untuk menjaga martabat dan integritas ASN.\", \"Meningkatkan Kualitas Data dan Informasi Kepegawaian: Menyajikan data kepegawaian yang valid, mutakhir, dan terpercaya sebagai dasar utama dalam setiap pengambilan kebijakan di bidang sumber daya manusia.\"], \"visi\": \"Menjadi Lembaga Pengelola Kepegawaian yang Andal, Modern, dan Akuntabel demi Terciptanya Sumber Daya Manusia Aparatur yang Melayani dan Profesional.\", \"is_active\": true, \"created_at\": \"2025-08-26T08:41:15.000000Z\", \"updated_at\": \"2025-09-10T01:59:31.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 18:59:31', '2025-09-09 18:59:31'),
(208, 7, 'DELETE', 'App\\Models\\User', 5, 'Menghapus user: Penulis (penulis@gmail.com)', '{\"id\": 5, \"name\": \"Penulis\", \"email\": \"penulis@gmail.com\", \"created_at\": \"2025-09-08T03:18:33.000000Z\", \"updated_at\": \"2025-09-08T03:18:33.000000Z\", \"email_verified_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:00:12', '2025-09-09 19:00:12'),
(209, 7, 'DELETE', 'App\\Models\\User', 6, 'Menghapus user: Testing (achmad091102@gmail.com)', '{\"id\": 6, \"name\": \"Testing\", \"email\": \"achmad091102@gmail.com\", \"created_at\": \"2025-09-08T08:36:50.000000Z\", \"updated_at\": \"2025-09-08T08:36:50.000000Z\", \"email_verified_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:00:21', '2025-09-09 19:00:21'),
(210, 7, 'CREATE', 'App\\Models\\Pejabat', 22, 'Menambahkan pejabat: Nama - Kepala Dinas', NULL, '{\"id\": 22, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/MFis9uYYj1C5VMywHcxoOKRvTiddqCenhRBws7yp.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-10T02:02:32.000000Z\", \"updated_at\": \"2025-09-10T02:02:32.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:02:32', '2025-09-09 19:02:32'),
(211, 7, 'DELETE', 'App\\Models\\Pejabat', 22, 'Menghapus data pejabat: Nama - Kepala Dinas', '{\"id\": 22, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/MFis9uYYj1C5VMywHcxoOKRvTiddqCenhRBws7yp.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-10T02:02:32.000000Z\", \"updated_at\": \"2025-09-10T02:02:32.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:08:35', '2025-09-09 19:08:35'),
(212, 7, 'DELETE', 'App\\Models\\Agenda', 13, 'Menghapus agenda: Rapat Organisasi Terbaru', '{\"id\": 13, \"slug\": \"rapat-organisasi-terbaru\", \"title\": \"Rapat Organisasi Terbaru\", \"tanggal\": null, \"file_path\": \"unduhan/1757469541_jurnal-5.pdf\", \"created_at\": \"2025-09-10T01:59:01.000000Z\", \"updated_at\": \"2025-09-10T01:59:01.000000Z\", \"description\": \"Rapat akan dilaksanakan 2025 Desember 20\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:47:05', '2025-09-09 19:47:05'),
(213, 7, 'CREATE', 'App\\Models\\Agenda', 14, 'Menambahkan agenda baru: tea', NULL, '{\"id\": 14, \"slug\": \"tea\", \"title\": \"tea\", \"created_at\": \"2025-09-10T02:47:37.000000Z\", \"updated_at\": \"2025-09-10T02:47:37.000000Z\", \"description\": \"adfadf adfadf kdkdk adsdf\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:47:37', '2025-09-09 19:47:37'),
(214, 7, 'UPDATE', 'App\\Models\\Agenda', 14, 'Mengubah agenda: tea', '{\"id\": 14, \"slug\": \"tea\", \"title\": \"tea\", \"tanggal\": null, \"file_path\": null, \"created_at\": \"2025-09-10T02:47:37.000000Z\", \"updated_at\": \"2025-09-10T02:47:37.000000Z\", \"description\": \"adfadf adfadf kdkdk adsdf\"}', '{\"id\": 14, \"slug\": \"tea\", \"title\": \"tea\", \"tanggal\": null, \"file_path\": \"unduhan/1757472470_jurnal-3.pdf\", \"created_at\": \"2025-09-10T02:47:37.000000Z\", \"updated_at\": \"2025-09-10T02:47:50.000000Z\", \"description\": \"adfadf adfadf kdkdk adsdf\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:47:50', '2025-09-09 19:47:50'),
(215, 7, 'DELETE', 'App\\Models\\Agenda', 14, 'Menghapus agenda: tea', '{\"id\": 14, \"slug\": \"tea\", \"title\": \"tea\", \"tanggal\": null, \"file_path\": \"unduhan/1757472470_jurnal-3.pdf\", \"created_at\": \"2025-09-10T02:47:37.000000Z\", \"updated_at\": \"2025-09-10T02:47:50.000000Z\", \"description\": \"adfadf adfadf kdkdk adsdf\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:48:07', '2025-09-09 19:48:07'),
(216, 7, 'DELETE', 'App\\Models\\Unduhan', 8, 'Menghapus file unduhan: Judul File', '{\"id\": 8, \"title\": \"Judul File\", \"file_path\": \"unduhan/n5LYTXYDmZqj0Inmb4aBBAt6ASsTiTpVUdV8Iuaz.pdf\", \"created_at\": \"2025-09-10T01:57:32.000000Z\", \"updated_at\": \"2025-09-10T01:57:32.000000Z\", \"description\": \"file test\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:48:18', '2025-09-09 19:48:18'),
(217, 7, 'CREATE', 'App\\Models\\Agenda', 15, 'Menambahkan agenda baru: dddasdfdf;dfkadflkadf', NULL, '{\"id\": 15, \"slug\": \"dddasdfdfdfkadflkadf\", \"title\": \"dddasdfdf;dfkadflkadf\", \"file_path\": \"agenda/1757472577_jurnal-3.pdf\", \"created_at\": \"2025-09-10T02:49:37.000000Z\", \"updated_at\": \"2025-09-10T02:49:37.000000Z\", \"description\": \"adfadfadfa adfadfa adfa\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:49:37', '2025-09-09 19:49:37'),
(218, 7, 'CREATE', 'App\\Models\\Unduhan', 9, 'Menambahkan file unduhan: Jurnal', NULL, '{\"id\": 9, \"title\": \"Jurnal\", \"file_path\": \"unduhan/FAVfC1DDRRHGPxP8mqhv3SEoE77H2b3vCgUL9weL.pdf\", \"created_at\": \"2025-09-10T02:58:14.000000Z\", \"updated_at\": \"2025-09-10T02:58:14.000000Z\", \"description\": \"deskripsi dokument\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 19:58:14', '2025-09-09 19:58:14'),
(219, 7, 'DELETE', 'App\\Models\\Agenda', 15, 'Menghapus agenda: dddasdfdf;dfkadflkadf', '{\"id\": 15, \"slug\": \"dddasdfdfdfkadflkadf\", \"title\": \"dddasdfdf;dfkadflkadf\", \"tanggal\": null, \"file_path\": \"agenda/1757472577_jurnal-3.pdf\", \"created_at\": \"2025-09-10T02:49:37.000000Z\", \"updated_at\": \"2025-09-10T02:49:37.000000Z\", \"description\": \"adfadfadfa adfadfa adfa\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:01:50', '2025-09-09 20:01:50'),
(220, 7, 'CREATE', 'App\\Models\\Agenda', 16, 'Menambahkan agenda baru: Judul', NULL, '{\"id\": 16, \"slug\": \"judul\", \"title\": \"Judul\", \"file_path\": \"agenda/1757473346_jurnal-5.pdf\", \"created_at\": \"2025-09-10T03:02:26.000000Z\", \"updated_at\": \"2025-09-10T03:02:26.000000Z\", \"description\": \"adsdfdada ddfadfad adfdffff\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:02:26', '2025-09-09 20:02:26'),
(221, 7, 'UPDATE', 'App\\Models\\Agenda', 16, 'Mengubah agenda: Judul', '{\"id\": 16, \"slug\": \"judul\", \"title\": \"Judul\", \"tanggal\": null, \"file_path\": \"agenda/1757473346_jurnal-5.pdf\", \"created_at\": \"2025-09-10T03:02:26.000000Z\", \"updated_at\": \"2025-09-10T03:02:26.000000Z\", \"description\": \"adsdfdada ddfadfad adfdffff\"}', '{\"id\": 16, \"slug\": \"judul\", \"title\": \"Judul\", \"tanggal\": null, \"file_path\": \"agenda/1757473387_jurnal-3.pdf\", \"created_at\": \"2025-09-10T03:02:26.000000Z\", \"updated_at\": \"2025-09-10T03:03:07.000000Z\", \"description\": \"adsdfdada ddfadfad adfdffff\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:03:07', '2025-09-09 20:03:07'),
(222, 7, 'CREATE', 'App\\Models\\Pejabat', 23, 'Menambahkan pejabat: Nama - Kepala Bidang', NULL, '{\"id\": 23, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/MynEw1mswJjnjRUk5IXCs2v6dD87ZJQ0BLPNuMHy.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-10T03:05:10.000000Z\", \"updated_at\": \"2025-09-10T03:05:10.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:05:10', '2025-09-09 20:05:10'),
(223, 7, 'CREATE', 'App\\Models\\Pejabat', 24, 'Menambahkan pejabat: Nama - Kasubag', NULL, '{\"id\": 24, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/W3r2bSPIuXOfssNuJjI9fnOkSJG6w9ObUe2XVk3r.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:07:49.000000Z\", \"updated_at\": \"2025-09-10T03:07:49.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:07:49', '2025-09-09 20:07:49'),
(224, 7, 'CREATE', 'App\\Models\\Pejabat', 25, 'Menambahkan pejabat: nama - Kasubag', NULL, '{\"id\": 25, \"nip\": \"adfa\", \"name\": \"nama\", \"order\": \"0\", \"photo\": \"pejabat/QDL0EKGbAtXlFeei9OTdYvjFsj6isXdFGLL4268W.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:16:11.000000Z\", \"updated_at\": \"2025-09-10T03:16:11.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:16:11', '2025-09-09 20:16:11'),
(225, 7, 'DELETE', 'App\\Models\\Pejabat', 25, 'Menghapus data pejabat: nama - Kasubag', '{\"id\": 25, \"nip\": \"adfa\", \"name\": \"nama\", \"order\": 0, \"photo\": \"pejabat/QDL0EKGbAtXlFeei9OTdYvjFsj6isXdFGLL4268W.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:16:11.000000Z\", \"updated_at\": \"2025-09-10T03:16:11.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:18:58', '2025-09-09 20:18:58'),
(226, 7, 'DELETE', 'App\\Models\\Pejabat', 23, 'Menghapus data pejabat: Nama - Kepala Bidang', '{\"id\": 23, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/MynEw1mswJjnjRUk5IXCs2v6dD87ZJQ0BLPNuMHy.jpg\", \"jabatan\": \"Kepala Bidang\", \"created_at\": \"2025-09-10T03:05:10.000000Z\", \"updated_at\": \"2025-09-10T03:05:10.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:20:00', '2025-09-09 20:20:00'),
(227, 7, 'CREATE', 'App\\Models\\Pejabat', 26, 'Menambahkan pejabat: Nama 2 - Sekretaris', NULL, '{\"id\": 26, \"nip\": \"12\", \"name\": \"Nama 2\", \"order\": \"1\", \"photo\": \"pejabat/FvC6u0cxf1dC0qsvp1LpNjkgqUzrFdSz5Y2LATjw.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-10T03:22:12.000000Z\", \"updated_at\": \"2025-09-10T03:22:12.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:22:12', '2025-09-09 20:22:12'),
(228, 7, 'DELETE', 'App\\Models\\Pejabat', 26, 'Menghapus data pejabat: Nama 2 - Sekretaris', '{\"id\": 26, \"nip\": \"12\", \"name\": \"Nama 2\", \"order\": 1, \"photo\": \"pejabat/FvC6u0cxf1dC0qsvp1LpNjkgqUzrFdSz5Y2LATjw.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-10T03:22:12.000000Z\", \"updated_at\": \"2025-09-10T03:22:12.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:22:21', '2025-09-09 20:22:21'),
(229, 7, 'CREATE', 'App\\Models\\Pejabat', 27, 'Menambahkan pejabat: adfadsf - Kepala Dinas', NULL, '{\"id\": 27, \"nip\": \"1234567890\", \"name\": \"adfadsf\", \"order\": \"0\", \"photo\": \"pejabat/cEGobcY0n7F4AK5Z6CBdZ208TpixpUMtbBENpS9t.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-10T03:31:03.000000Z\", \"updated_at\": \"2025-09-10T03:31:03.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:31:03', '2025-09-09 20:31:03'),
(230, 7, 'DELETE', 'App\\Models\\Pejabat', 27, 'Menghapus data pejabat: adfadsf - Kepala Dinas', '{\"id\": 27, \"nip\": \"1234567890\", \"name\": \"adfadsf\", \"order\": 0, \"photo\": \"pejabat/cEGobcY0n7F4AK5Z6CBdZ208TpixpUMtbBENpS9t.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-10T03:31:03.000000Z\", \"updated_at\": \"2025-09-10T03:31:03.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:31:14', '2025-09-09 20:31:14'),
(231, 7, 'UPDATE', 'App\\Models\\Pejabat', 24, 'Mengubah data pejabat: Nama', '{\"id\": 24, \"nip\": \"43789501231231313123\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/W3r2bSPIuXOfssNuJjI9fnOkSJG6w9ObUe2XVk3r.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:07:49.000000Z\", \"updated_at\": \"2025-09-10T03:07:49.000000Z\"}', '{\"id\": 24, \"nip\": \"437895012312313131\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/W3r2bSPIuXOfssNuJjI9fnOkSJG6w9ObUe2XVk3r.jpg\", \"jabatan\": \"Kepala Dinas\", \"created_at\": \"2025-09-10T03:07:49.000000Z\", \"updated_at\": \"2025-09-10T03:31:32.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:31:32', '2025-09-09 20:31:32'),
(232, 7, 'CREATE', 'App\\Models\\Pejabat', 28, 'Menambahkan pejabat: Nama - Sekretaris', NULL, '{\"id\": 28, \"nip\": \"437895012312313132\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/tOby6Db3MFGTwoW3sdP6KfpKMhSB13DohOuEhJFP.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-10T03:32:55.000000Z\", \"updated_at\": \"2025-09-10T03:32:55.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:32:55', '2025-09-09 20:32:55'),
(233, 7, 'CREATE', 'App\\Models\\Pejabat', 29, 'Menambahkan pejabat: Nama - Kasubag', NULL, '{\"id\": 29, \"nip\": \"437895012312313131\", \"name\": \"Nama\", \"order\": \"1\", \"photo\": \"pejabat/XtJqbk7Ni4UioXIlKWvKlxLhuAQ42LziVrQd7yZ2.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:33:26.000000Z\", \"updated_at\": \"2025-09-10T03:33:26.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:33:26', '2025-09-09 20:33:26'),
(234, 7, 'CREATE', 'App\\Models\\Pejabat', 30, 'Menambahkan pejabat: Nama - Kasubag', NULL, '{\"id\": 30, \"nip\": \"437895012312313131\", \"name\": \"Nama\", \"order\": \"0\", \"photo\": \"pejabat/GZ96cJGsMa4XLH04D9AUKmXQLDowhMARSB2P7tBw.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:34:00.000000Z\", \"updated_at\": \"2025-09-10T03:34:00.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:34:00', '2025-09-09 20:34:00'),
(235, 7, 'UPDATE', 'App\\Models\\Pejabat', 29, 'Mengubah data pejabat: Nama 1', '{\"id\": 29, \"nip\": \"437895012312313131\", \"name\": \"Nama\", \"order\": 1, \"photo\": \"pejabat/XtJqbk7Ni4UioXIlKWvKlxLhuAQ42LziVrQd7yZ2.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:33:26.000000Z\", \"updated_at\": \"2025-09-10T03:33:26.000000Z\"}', '{\"id\": 29, \"nip\": \"437895012312313131\", \"name\": \"Nama 1\", \"order\": \"1\", \"photo\": \"pejabat/XtJqbk7Ni4UioXIlKWvKlxLhuAQ42LziVrQd7yZ2.jpg\", \"jabatan\": \"Kasubag\", \"created_at\": \"2025-09-10T03:33:26.000000Z\", \"updated_at\": \"2025-09-10T03:34:37.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:34:37', '2025-09-09 20:34:37'),
(236, 7, 'DELETE', 'App\\Models\\Pejabat', 28, 'Menghapus data pejabat: Nama - Sekretaris', '{\"id\": 28, \"nip\": \"437895012312313132\", \"name\": \"Nama\", \"order\": 0, \"photo\": \"pejabat/tOby6Db3MFGTwoW3sdP6KfpKMhSB13DohOuEhJFP.jpg\", \"jabatan\": \"Sekretaris\", \"created_at\": \"2025-09-10T03:32:55.000000Z\", \"updated_at\": \"2025-09-10T03:32:55.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 20:43:00', '2025-09-09 20:43:00'),
(237, 7, 'CREATE', 'App\\Models\\Berita', 12, 'Menambahkan berita baru: test judul', NULL, '{\"id\": 12, \"slug\": \"test-judul\", \"title\": \"test judul\", \"status\": \"draft\", \"content\": \"<p>test dan test kita menggunakan sekarang dan pasti bisa</p>\", \"user_id\": 7, \"thumbnail\": \"thumbnails/berita/68c0fc25c7a5f_1757477925.jpg\", \"created_at\": \"2025-09-10T04:18:45.000000Z\", \"updated_at\": \"2025-09-10T04:18:45.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:18:45', '2025-09-09 21:18:45'),
(238, 7, 'UPDATE', 'App\\Models\\Agenda', 16, 'Mengubah agenda: Judul', '{\"id\": 16, \"slug\": \"judul\", \"title\": \"Judul\", \"tanggal\": null, \"file_path\": \"agenda/1757473387_jurnal-3.pdf\", \"created_at\": \"2025-09-10T03:02:26.000000Z\", \"updated_at\": \"2025-09-10T03:03:07.000000Z\", \"description\": \"adsdfdada ddfadfad adfdffff\"}', '{\"id\": 16, \"slug\": \"judul\", \"title\": \"Judul\", \"tanggal\": null, \"file_path\": \"agenda/1757473387_jurnal-3.pdf\", \"created_at\": \"2025-09-10T03:02:26.000000Z\", \"updated_at\": \"2025-09-10T04:28:47.000000Z\", \"description\": \"agenda dan sebagainyaaaaa\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:28:47', '2025-09-09 21:28:47'),
(239, 7, 'CREATE', 'App\\Models\\Berita', 13, 'Menambahkan berita baru: Judul berita', NULL, '{\"id\": 13, \"slug\": \"judul-berita\", \"title\": \"Judul berita\", \"status\": \"draft\", \"content\": \"<p>aal;dfladfjladfjak akdfadf dadfadfk dfkadfakdfj a</p>\", \"user_id\": 7, \"thumbnail\": \"thumbnails/berita/68c0ff4c39ab3_1757478732.jpg\", \"created_at\": \"2025-09-10T04:32:12.000000Z\", \"updated_at\": \"2025-09-10T04:32:12.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:32:12', '2025-09-09 21:32:12'),
(240, 7, 'LOGOUT', NULL, NULL, 'User berhasil logout dari sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:35:15', '2025-09-09 21:35:15'),
(241, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:35:34', '2025-09-09 21:35:34'),
(242, 1, 'CREATE', 'App\\Models\\Berita', 14, 'Menambahkan berita baru: Berita Katingan', NULL, '{\"id\": 14, \"slug\": \"berita-katingan\", \"title\": \"Berita Katingan\", \"status\": \"draft\", \"content\": \"<p data-start=\\\"23\\\" data-end=\\\"437\\\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\\r\\n<p data-start=\\\"439\\\" data-end=\\\"811\\\" data-is-last-node=\\\"\\\" data-is-only-node=\\\"\\\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68c100648c0ee_1757479012.jpg\", \"created_at\": \"2025-09-10T04:36:52.000000Z\", \"updated_at\": \"2025-09-10T04:36:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:36:52', '2025-09-09 21:36:52'),
(243, 1, 'DELETE', 'App\\Models\\Berita', 13, 'Menghapus berita: Judul berita', '{\"id\": 13, \"slug\": \"judul-berita\", \"title\": \"Judul berita\", \"status\": \"draft\", \"content\": \"<p>aal;dfladfjladfjak akdfadf dadfadfk dfkadfakdfj a</p>\", \"user_id\": 7, \"thumbnail\": \"thumbnails/berita/68c0ff4c39ab3_1757478732.jpg\", \"created_at\": \"2025-09-10T04:32:12.000000Z\", \"updated_at\": \"2025-09-10T04:32:12.000000Z\", \"published_at\": null}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:36:57', '2025-09-09 21:36:57'),
(244, 1, 'UPDATE', 'App\\Models\\Berita', 14, 'Mengubah berita: Berita Katingan', '{\"id\": 14, \"slug\": \"berita-katingan\", \"title\": \"Berita Katingan\", \"status\": \"draft\", \"content\": \"<p data-start=\\\"23\\\" data-end=\\\"437\\\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\\r\\n<p data-start=\\\"439\\\" data-end=\\\"811\\\" data-is-last-node=\\\"\\\" data-is-only-node=\\\"\\\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68c100648c0ee_1757479012.jpg\", \"created_at\": \"2025-09-10T04:36:52.000000Z\", \"updated_at\": \"2025-09-10T04:36:52.000000Z\", \"published_at\": null}', '{\"id\": 14, \"slug\": \"berita-katingan\", \"title\": \"Berita Katingan\", \"status\": \"published\", \"content\": \"<p data-start=\\\"23\\\" data-end=\\\"437\\\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\\r\\n<p data-start=\\\"439\\\" data-end=\\\"811\\\" data-is-last-node=\\\"\\\" data-is-only-node=\\\"\\\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>\", \"user_id\": 1, \"thumbnail\": \"thumbnails/berita/68c100648c0ee_1757479012.jpg\", \"created_at\": \"2025-09-10T04:36:52.000000Z\", \"updated_at\": \"2025-09-10T04:37:06.000000Z\", \"published_at\": null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:37:06', '2025-09-09 21:37:06'),
(245, 1, 'DELETE', 'App\\Models\\Galeri', 12, 'Menghapus gambar galeri: Judul Galeri', '{\"id\": 12, \"image\": \"galeri/68c0da5f53789_1757469279.jpg\", \"title\": \"Judul Galeri\", \"created_at\": \"2025-09-10T01:54:39.000000Z\", \"updated_at\": \"2025-09-10T01:54:39.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:37:28', '2025-09-09 21:37:28'),
(246, 1, 'CREATE', 'App\\Models\\Galeri', 13, 'Menambahkan gambar galeri: Judul Gambar', NULL, '{\"id\": 13, \"image\": \"galeri/68c100bd69d86_1757479101.jpg\", \"title\": \"Judul Gambar\", \"created_at\": \"2025-09-10T04:38:21.000000Z\", \"updated_at\": \"2025-09-10T04:38:21.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:38:21', '2025-09-09 21:38:21'),
(247, 1, 'DELETE', 'App\\Models\\Unduhan', 9, 'Menghapus file unduhan: Jurnal', '{\"id\": 9, \"title\": \"Jurnal\", \"file_path\": \"unduhan/FAVfC1DDRRHGPxP8mqhv3SEoE77H2b3vCgUL9weL.pdf\", \"created_at\": \"2025-09-10T02:58:14.000000Z\", \"updated_at\": \"2025-09-10T02:58:14.000000Z\", \"description\": \"deskripsi dokument\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:38:34', '2025-09-09 21:38:34'),
(248, 1, 'CREATE', 'App\\Models\\Unduhan', 10, 'Menambahkan file unduhan: Jurnal', NULL, '{\"id\": 10, \"title\": \"Jurnal\", \"file_path\": \"unduhan/hd6enThtRVBMkXx9yl233b9HlIN5qPv2dM68XtL5.pdf\", \"created_at\": \"2025-09-10T04:39:59.000000Z\", \"updated_at\": \"2025-09-10T04:39:59.000000Z\", \"description\": \"Jurnal tentang ilmu pemerintahan\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:39:59', '2025-09-09 21:39:59'),
(249, 1, 'CREATE', 'App\\Models\\Agenda', 17, 'Menambahkan agenda baru: Rapa tahunan', NULL, '{\"id\": 17, \"slug\": \"rapa-tahunan\", \"title\": \"Rapa tahunan\", \"file_path\": \"agenda/1757479255_jurnal-5.pdf\", \"created_at\": \"2025-09-10T04:40:55.000000Z\", \"updated_at\": \"2025-09-10T04:40:55.000000Z\", \"description\": \"Rapat tahunan akan dilaksanakan pada 20 November 2025\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 21:40:55', '2025-09-09 21:40:55'),
(250, 1, 'DELETE', 'App\\Models\\Galeri', 13, 'Menghapus gambar galeri: Judul Gambar', '{\"id\": 13, \"image\": \"galeri/68c100bd69d86_1757479101.jpg\", \"title\": \"Judul Gambar\", \"created_at\": \"2025-09-10T04:38:21.000000Z\", \"updated_at\": \"2025-09-10T04:38:21.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 22:00:42', '2025-09-09 22:00:42'),
(251, 1, 'DELETE', 'App\\Models\\Agenda', 16, 'Menghapus agenda: Judul', '{\"id\": 16, \"slug\": \"judul\", \"title\": \"Judul\", \"tanggal\": null, \"file_path\": \"agenda/1757473387_jurnal-3.pdf\", \"created_at\": \"2025-09-10T03:02:26.000000Z\", \"updated_at\": \"2025-09-10T04:28:47.000000Z\", \"description\": \"agenda dan sebagainyaaaaa\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 22:00:51', '2025-09-09 22:00:51'),
(252, 1, 'LOGIN', NULL, NULL, 'User berhasil login ke sistem', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 22:47:45', '2025-09-09 22:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `title`, `slug`, `description`, `tanggal`, `file_path`, `created_at`, `updated_at`) VALUES
(17, 'Rapa tahunan', 'rapa-tahunan', 'Rapat tahunan akan dilaksanakan pada 20 November 2025', NULL, 'agenda/1757479255_jurnal-5.pdf', '2025-09-09 21:40:55', '2025-09-09 21:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `title`, `slug`, `content`, `thumbnail`, `published_at`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'test judul', 'test-judul', '<p>test dan test kita menggunakan sekarang dan pasti bisa</p>', 'thumbnails/berita/68c0fc25c7a5f_1757477925.jpg', NULL, 7, 'draft', '2025-09-09 21:18:45', '2025-09-09 21:18:45'),
(14, 'Berita Katingan', 'berita-katingan', '<p data-start=\"23\" data-end=\"437\">Pemerintah Kabupaten Katingan terus mendorong berbagai program pembangunan yang berfokus pada peningkatan kualitas hidup masyarakat, mulai dari infrastruktur, pendidikan, hingga pemberdayaan ekonomi lokal. Salah satu langkah nyata terlihat dari upaya pemeliharaan lingkungan melalui program penghijauan serta perbaikan fasilitas umum yang diharapkan mampu menciptakan daerah yang lebih hijau, bersih, dan nyaman.</p>\r\n<p data-start=\"439\" data-end=\"811\" data-is-last-node=\"\" data-is-only-node=\"\">Selain itu, kolaborasi antara pemerintah daerah, masyarakat, dan pihak swasta semakin diperkuat untuk mempercepat pemerataan pembangunan di seluruh wilayah Katingan. Dengan semangat gotong royong, berbagai agenda pembangunan dan sosial diharapkan dapat menjadikan Katingan sebagai daerah yang maju, berdaya saing, sekaligus tetap menjaga kelestarian lingkungan hidupnya.</p>', 'thumbnails/berita/68c100648c0ee_1757479012.jpg', NULL, 1, 'published', '2025-09-09 21:36:52', '2025-09-09 21:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:7:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"manage news\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"manage gallery\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:16:\"manage downloads\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"manage contacts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"manage hero\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"manage officials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:7:\"penulis\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}}}', 1757567704);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `heroes`
--

INSERT INTO `heroes` (`id`, `title`, `subtitle`, `background_image`, `button_text`, `button_link`, `order`, `created_at`, `updated_at`) VALUES
(5, 'Foto Bersama BKPSDM', 'Foto Bersama seluruh pegawai BKPSDM', 'hero/Ivo27zjkz1GhsKDdjSxSupNld9mbteDbvgPLwzlD.jpg', NULL, NULL, 0, '2025-09-08 21:11:05', '2025-09-08 21:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontaks`
--

CREATE TABLE `kontaks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kontaks`
--

INSERT INTO `kontaks` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(6, 'TEST', 'dep@gmail.com', 'dfa', 'a', '2025-09-09 22:36:22', '2025-09-09 22:36:22'),
(7, 'ADFA', 'a@a.com', 'ADF', 'PESAN', '2025-09-09 22:37:29', '2025-09-09 22:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_13_015920_create_permission_tables', 1),
(5, '2025_08_13_035719_create_beritas_table', 1),
(6, '2025_08_13_135605_create_galeris_table', 1),
(7, '2025_08_14_015948_add_title_to_galeris_table', 1),
(8, '2025_08_14_020307_add_image_to_galeris_table', 1),
(9, '2025_08_14_022142_create_unduhans_table', 1),
(10, '2025_08_14_040237_create_kontaks_table', 1),
(11, '2025_08_14_042022_create_heroes_table', 1),
(12, '2025_08_14_082311_create_pejabats_table', 1),
(13, '2025_08_16_115639_create_personal_access_tokens_table', 1),
(14, '2025_08_19_043529_create_activity_logs_table', 1),
(15, '2025_08_21_015029_add_nip_to_pejabats_table', 1),
(16, '2025_08_25_044808_make_file_path_nullable_in_unduhans_table', 1),
(17, '2025_08_25_073159_add_description_column_to_unduhans_table', 1),
(18, '2025_08_25_083503_add_type_to_unduhans_table', 1),
(19, '2025_08_25_084455_create_agendas_table', 1),
(20, '2025_08_25_084519_transfer_agenda_data_to_agendas_table', 1),
(21, '2025_08_25_084602_remove_type_column_from_unduhans_table', 1),
(22, '2025_08_25_085640_make_description_nullable_in_unduhans_table', 1),
(27, '2025_08_26_043200_add_slug_to_agendas_table', 2),
(28, '2025_08_26_082757_create_visi_misis_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('achmad091102@gmail.com', '$2y$12$vF9UCKNKac9ceMzfrf7VkO5hMVCsnlsVy4sdE4F4ZoaMcjTVA9TwG', '2025-09-08 19:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `pejabats`
--

CREATE TABLE `pejabats` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pejabats`
--

INSERT INTO `pejabats` (`id`, `name`, `nip`, `jabatan`, `photo`, `order`, `created_at`, `updated_at`) VALUES
(24, 'Nama', '437895012312313131', 'Kepala Dinas', 'pejabat/W3r2bSPIuXOfssNuJjI9fnOkSJG6w9ObUe2XVk3r.jpg', 0, '2025-09-09 20:07:49', '2025-09-09 20:31:32'),
(29, 'Nama 1', '437895012312313131', 'Kasubag', 'pejabat/XtJqbk7Ni4UioXIlKWvKlxLhuAQ42LziVrQd7yZ2.jpg', 1, '2025-09-09 20:33:26', '2025-09-09 20:34:37'),
(30, 'Nama', '437895012312313131', 'Kasubag', 'pejabat/GZ96cJGsMa4XLH04D9AUKmXQLDowhMARSB2P7tBw.jpg', 0, '2025-09-09 20:34:00', '2025-09-09 20:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage news', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(2, 'manage gallery', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(3, 'manage downloads', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(4, 'manage contacts', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(5, 'manage hero', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(6, 'manage officials', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(7, 'manage users', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', 'b8a8c38e934f2aac347ffc1819dc041999c48744fa43b939f886ac8d50a48d00', '[\"*\"]', '2025-08-26 01:14:16', NULL, '2025-08-26 01:10:50', '2025-08-26 01:14:16'),
(2, 'App\\Models\\User', 1, 'auth_token', '2effe19154a50bf3ccad0a1f4d3d9572ebb117721ba8496fb74791adbd938198', '[\"*\"]', '2025-08-26 01:20:07', NULL, '2025-08-26 01:18:59', '2025-08-26 01:20:07'),
(3, 'App\\Models\\User', 1, 'auth_token', 'feb281e05ddbd08c8142e20cd82bd8e6cb0b9ff76bf6643016cdb3341577bf7c', '[\"*\"]', NULL, NULL, '2025-09-08 19:28:05', '2025-09-08 19:28:05'),
(4, 'App\\Models\\User', 1, 'auth_token', 'a16b5cbd6424ae5c29ee7efce9538e024e7aed0a156877dcf58dc996a70657b0', '[\"*\"]', '2025-09-09 22:50:54', NULL, '2025-09-09 22:47:45', '2025-09-09 22:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'penulis', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(2, 'admin', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(3, 'super-admin', 'web', '2025-08-25 21:47:19', '2025-08-25 21:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SgQDgx822PlSjDH8C1LTUHlZWKqrQgv54IkWAxVu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU1FLaTlGd3Y2NWgwektBcVNySVA3TVZNZFMxeUZYeXROUnpaTTQzZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1757483142);

-- --------------------------------------------------------

--
-- Table structure for table `unduhans`
--

CREATE TABLE `unduhans` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unduhans`
--

INSERT INTO `unduhans` (`id`, `title`, `description`, `file_path`, `created_at`, `updated_at`) VALUES
(10, 'Jurnal', 'Jurnal tentang ilmu pemerintahan', 'unduhan/hd6enThtRVBMkXx9yl233b9HlIN5qPv2dM68XtL5.pdf', '2025-09-09 21:39:59', '2025-09-09 21:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'superadmin@example.com', NULL, '$2y$12$Pzb/8HouDl5mblg9dMAPX.QGhQpFwu7nr3.ASnC/5.azWtwRj4ftm', 'PKPE2jN3YdpgIiuasjdchQ7ZKJP2EA2ID6NN1DSw6xCrWhFMpDxAS91MPSsX', '2025-08-25 21:47:19', '2025-08-25 21:47:19'),
(3, 'admin', 'admin@bkpsdm.com', NULL, '$2y$12$yElUHaVjIeYwSlIgN6qA5ukfdS4YCk3KprKPROhe2R43OCc.PnIMW', '0YqyornmTc2TnsBaVNFrBJNjUKFb15KvDNOhtKMGP7IIYnWKPONG7keQSen2', '2025-08-26 00:44:55', '2025-09-07 20:52:35'),
(7, 'dep', 'deprowinoto3690@gmail.com', NULL, '$2y$12$3E.IdZ/osdDPTt2gZJdvGORUa0vdr.xG306oFW7I5IWsf7hOIWtZS', 'yVZwFwkF4oCcT8K6tuHKG7NW5Wbe60czFdiq6XhHCTRO1wB8bwIdSLwhCEBH', '2025-09-08 02:01:29', '2025-09-08 19:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `visi_misis`
--

CREATE TABLE `visi_misis` (
  `id` bigint UNSIGNED NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` json NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visi_misis`
--

INSERT INTO `visi_misis` (`id`, `visi`, `misi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Menjadi Lembaga Pengelola Kepegawaian yang Andal, Modern, dan Akuntabel demi Terciptanya Sumber Daya Manusia Aparatur yang Melayani dan Profesional.', '[\"Menyelenggarakan Pelayanan Administrasi Kepegawaian yang Cepat, Tepat, dan Responsif: Memberikan layanan prima kepada seluruh ASN terkait urusan kepegawaian, seperti kenaikan pangkat, gaji berkala, pensiun, dan layanan lainnya dengan memanfaatkan teknologi informasi.\", \"Mengoptimalkan Perencanaan dan Pemenuhan Kebutuhan Pegawai: Melaksanakan analisis jabatan dan analisis beban kerja secara berkala untuk menyusun formasi pegawai yang efisien dan sesuai dengan kebutuhan strategis organisasi perangkat daerah (OPD).\", \"Mengembangkan Sistem Karier ASN yang Terbuka dan Kompetitif: Membangun pola karier yang jelas, transparan, dan berdasarkan pada rekam jejak kinerja serta potensi pegawai melalui manajemen talenta.\", \"Membina dan Menegakkan Disiplin serta Kode Etik Pegawai: Melakukan pembinaan secara berkelanjutan dan penegakan aturan disiplin secara tegas dan adil untuk menjaga martabat dan integritas ASN.\", \"Meningkatkan Kualitas Data dan Informasi Kepegawaian: Menyajikan data kepegawaian yang valid, mutakhir, dan terpercaya sebagai dasar utama dalam setiap pengambilan kebijakan di bidang sumber daya manusia.\"]', 1, '2025-08-26 01:41:15', '2025-09-09 18:59:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `activity_logs_action_created_at_index` (`action`,`created_at`);

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beritas_slug_unique` (`slug`),
  ADD KEY `beritas_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontaks`
--
ALTER TABLE `kontaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pejabats`
--
ALTER TABLE `pejabats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `unduhans`
--
ALTER TABLE `unduhans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visi_misis`
--
ALTER TABLE `visi_misis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontaks`
--
ALTER TABLE `kontaks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pejabats`
--
ALTER TABLE `pejabats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unduhans`
--
ALTER TABLE `unduhans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visi_misis`
--
ALTER TABLE `visi_misis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beritas`
--
ALTER TABLE `beritas`
  ADD CONSTRAINT `beritas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
