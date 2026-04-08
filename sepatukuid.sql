-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2026 at 03:35 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sepatukuid`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Lifestyle', 'lifestyle', 'Sepatu kasual untuk gaya hidup sehari-hari', 'https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=800', NULL, 1, '2026-02-25 10:49:01', '2026-02-25 10:54:40'),
(2, 'Running', 'running', 'Sepatu khusus lari dengan performa tinggi', 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=800', NULL, 1, '2026-02-25 10:49:01', '2026-02-25 10:54:40'),
(3, 'Basketball', 'basketball', 'Sepatu basket dengan dukungan ankle maksimal', 'https://images.unsplash.com/photo-1518002171953-a080ee817e1f?q=80&w=800', NULL, 1, '2026-02-25 10:49:01', '2026-02-25 10:54:40'),
(4, 'Training', 'training', 'Sepatu untuk gym dan fitness', 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=800', NULL, 1, '2026-02-25 10:49:01', '2026-02-25 12:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(12,2) NOT NULL,
  `min_purchase` decimal(12,2) NOT NULL DEFAULT '0.00',
  `valid_until` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_09_130115_add_role_to_users_table', 1),
(5, '2026_02_09_130712_create_products_table', 1),
(6, '2026_02_09_130721_create_categories_table', 1),
(7, '2026_02_09_130731_create_orders_table', 1),
(8, '2026_02_09_130740_create_order_items_table', 1),
(9, '2026_02_23_014736_create_settings_table', 2),
(10, '2026_02_23_023907_add_category_id_to_products_table', 3),
(11, '2026_02_23_024447_add_payment_proof_to_orders_and_address_details_to_users', 4),
(12, '2026_02_23_025218_add_shipping_method_and_notes_to_orders_table', 5),
(13, '2026_02_23_044346_add_image_to_products_table', 6),
(14, '2026_02_25_020829_create_reviews_table', 7),
(15, '2026_02_25_024816_add_gender_to_products_table', 8),
(16, '2026_02_25_025352_add_image_to_categories_table', 9),
(17, '2026_04_06_004453_create_order_tracks_table', 10),
(18, '2026_04_06_004453_create_tickets_table', 10),
(19, '2026_04_06_004454_create_product_sizes_table', 10),
(20, '2026_04_06_004454_create_ticket_replies_table', 10),
(21, '2026_04_06_004455_create_coupons_table', 10),
(22, '2026_04_06_004455_create_wishlists_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `shipping_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `shipping_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total`, `status`, `payment_status`, `shipping_status`, `shipping_method`, `notes`, `shipping_address`, `payment_method`, `payment_proof`, `created_at`, `updated_at`) VALUES
(1, 3, 'ORD-20260223-699BC113847C0', 35000.00, 'cancelled', 'pending_verification', 'pending', 'JNE', NULL, 'Surabaya, Indonesia, DDD, Depok, jawa, 12121\nTelepon: 081234567892\nNama: User Biasa', 'BCA', 'payment_proofs/proof-ORD-20260223-699BC113847C0-1771815205.png', '2026-02-23 10:53:07', '2026-02-23 12:48:31'),
(2, 3, 'ORD-20260224-699CFD01C61CC', 2110000.00, 'pending', 'failed', 'pending', 'JNE', NULL, 'Surabaya, Indonesia, DDD, Depok, jawa, 12121\nTelepon: 081234567892\nNama: User Biasa', 'BCA', NULL, '2026-02-24 09:21:05', '2026-02-25 07:53:06'),
(3, 3, 'ORD-20260224-699E3B327947E', 2110000.00, 'delivered', 'paid', 'pending', 'JNE', NULL, 'Surabaya, Indonesia, DDD, Depok, jawa, 12121\nTelepon: 081234567892\nNama: User Biasa', 'QRIS', 'payment_proofs/proof-ORD-20260224-699E3B327947E-1771981566.jpeg', '2026-02-25 07:58:42', '2026-02-25 11:28:49'),
(4, 3, 'ORD-20260406-69D300903F504', 1124000.00, 'delivered', 'paid', 'pending', 'JNE', NULL, 'Surabaya, Indonesia, DDD, Depok, Jawa Barat, 16433\nTelepon: 081234567892\nNama: User Biasa', 'QRIS', 'payment_proofs/proof-ORD-20260406-69D300903F504-1775435950.jfif', '2026-04-06 07:38:40', '2026-04-06 08:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `discount`, `size`, `color`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 10000.00, 0.00, NULL, NULL, '2026-02-23 10:53:07', '2026-02-23 10:53:07'),
(2, 2, 3, 1, 2085000.00, 0.00, NULL, NULL, '2026-02-24 09:21:05', '2026-02-24 09:21:05'),
(3, 3, 3, 1, 2085000.00, 0.00, NULL, NULL, '2026-02-25 07:58:42', '2026-02-25 07:58:42'),
(4, 4, 5, 1, 1099000.00, 0.00, NULL, NULL, '2026-04-06 07:38:40', '2026-04-06 07:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_tracks`
--

DROP TABLE IF EXISTS `order_tracks`;
CREATE TABLE IF NOT EXISTS `order_tracks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `status_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_tracks_order_id_foreign` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_tracks`
--

INSERT INTO `order_tracks` (`id`, `order_id`, `status_title`, `description`, `created_at`, `updated_at`) VALUES
(1, 4, 'Paket Di Serahkan Ke Kurir', 'Nama Kurir : Ahmung', '2026-04-06 07:55:49', '2026-04-06 07:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(15,2) NOT NULL,
  `discount_price` decimal(15,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('pria','wanita','unisex') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unisex',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sizes` json DEFAULT NULL,
  `colors` json DEFAULT NULL,
  `specifications` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `discount_price`, `stock`, `sku`, `brand`, `gender`, `image`, `category_id`, `category`, `sizes`, `colors`, `specifications`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'NIKE AIR JORDAN 1 RETRO HIGH OG', 'nike-air-jordan-1-retro-high-og', 'Brand New In Box - Fullset\r\nOriginal Guarantee 100%\r\n\r\nSize\r\n(Tertera di variant product)\r\n\r\nUntuk menjaga agar produkmu tetap aman, silahkan gunakan Additional Double Box dari Department. Cuman 5rb!\r\n\r\nIt\'s totally worth to buy,', 2085000.00, 800000.00, 8, 'RSP-2026-02', 'NIKE', 'unisex', 'products/wKhvmrSEFmEJBrOOKqc5Rgi3xLL6Fpkte98OwXMU.webp', NULL, NULL, '[\"39\", \"40\", \"41\", \"42\", \"43\", \"44\"]', '[\"Coklat\"]', 'Men\'s Footwear Sneakers - DZ5485071', 0, 1, '2026-02-24 08:01:44', '2026-02-25 09:42:45'),
(4, 'ADIDAS GAZELLE', 'adidas-gazelle', 'Brand New In Box - Fullset\r\nOriginal Guarantee 100%\r\n\r\nSize\r\n(Tertera di variant product)\r\n\r\nUntuk menjaga agar produkmu tetap aman, silahkan gunakan Additional Double Box dari Department. Cuman 5rb!\r\n\r\nIt\'s totally worth to buy,\r\nso what are you waiting for? Contact us!\r\n\r\nCustomer Service :\r\nSenin - Minggu: 09.00-18.00 WIB\r\n\r\nNote :\r\nApabila produk yang diterima tidak sesuai, silahkan chat ke customer service kami dengan melampirkan bukti video unboxing. Tim kami dengan senang hati akan membantu setiap prosesnya :)\r\n\r\nHurry up, only 1 item left in stock.', 1700000.00, 510000.00, 15, 'RSP-2026-003', 'ADIDAS', 'unisex', 'products/L70x9FdZVubjnfQEvsxyfoYX4DkWne6DfS37pwSf.webp', NULL, NULL, '[\"39\", \"40\", \"41\", \"42\", \"43\", \"44\"]', '[\"Hitam\", \"Putih\"]', NULL, 0, 1, '2026-02-25 09:50:20', '2026-02-25 09:50:20'),
(5, 'PUMA SOFTRIDE ENZO 5', 'puma-softride-enzo-5', 'Brand New In Box - Fullset\r\nOriginal Guarantee 100%\r\n\r\nSize\r\n(Tertera di variant product)\r\n\r\nUntuk menjaga agar produkmu tetap aman, silahkan gunakan Additional Double Box dari Department. Cuman 5rb!\r\n\r\nIt\'s totally worth to buy,\r\nso what are you waiting for? Contact us!\r\n\r\nCustomer Service :\r\nSenin - Minggu: 09.00-18.00 WIB\r\n\r\nNote :\r\nApabila produk yang diterima tidak sesuai, silahkan chat ke customer service kami dengan melampirkan bukti video unboxing. Tim kami dengan senang hati akan membantu setiap prosesnya :)\r\n\r\nHurry up, only 1 item left in stock.', 1099000.00, 1000000.00, 9, 'Men\'s Footwear Running - 31109802', 'PUMA', 'unisex', 'products/vactJ9BNMQClglUcSesZR16fkYcY2Wuo7BzG8uEd.webp', 4, 'Training', '[\"39\", \"40\", \"41\", \"42\", \"43\", \"44\"]', '[\"Hitam\"]', NULL, 0, 1, '2026-02-25 10:31:48', '2026-04-06 07:38:40'),
(6, 'Adidas Samba OG Footwear White Grey', 'adidas-samba-og-footwear-white-grey', 'Adidas Samba OG Footwear White Grey merupakan representasi sempurna dari estetika minimalis yang tak lekang oleh waktu, mempertahankan warisan desain klasik yang kini menjadi ikon streetwear. Sepatu ini didominasi oleh material kulit premium berwarna putih bersih yang dipadukan secara kontras dengan panel suede berwarna abu-abu muda di bagian depan (T-toe), memberikan tekstur yang kaya sekaligus proteksi ekstra. Detail tiga garis khas Adidas dan bagian tumit hadir dengan warna putih senada atau abu-abu lembut yang senada, menciptakan transisi warna monokromatik yang sangat rapi dan elegan. Dilengkapi dengan sol karet gum berwarna cokelat gelap yang ikonik, sepatu ini menawarkan keseimbangan antara gaya kasual yang sleek dan kenyamanan fungsional yang menjadikannya koleksi wajib bagi pecinta gaya busana retro-klasik.', 1999000.00, NULL, 10, 'ji3206', 'Adidas', 'unisex', 'products/6GItnNkADIZGt4k2dGLyVijzEf49bVYMwFeqGd5r.jpg', 1, 'Lifestyle', '[\"42.5\", \"43\", \"44\"]', '[\"Putih\"]', NULL, 0, 1, '2026-04-06 07:54:42', '2026-04-06 07:54:42'),
(7, 'New Balance 530 Moonbeam Beige', 'new-balance-530-moonbeam-beige', 'New Balance 530 Moonbeam Beige adalah sepatu yang menawarkan desain elegan dengan nuansa netral yang sangat cocok untuk gaya sehari-hari. Warna Moonbeam Beige yang dominan memberikan kesan kalem, elegan, dan mudah dipadupadankan dengan berbagai outfit. Sepatu ini mengusung gaya retro namun tetap mempertahankan tampilan yang segar dan modern, menjadikannya pilihan ideal bagi mereka yang mencari sepatu dengan desain timeless. Kombinasi warna beige pada bagian upper dengan aksen putih pada sol memberikan kesan bersih dan minimalis, menjadikannya mudah untuk dipadukan dengan pakaian kasual maupun semi-formal. Desain sepatu ini sangat cocok untuk para pecinta fashion yang mencari kenyamanan tanpa mengorbankan gaya. Bagian atas sepatu ini terbuat dari kombinasi material mesh dan kulit sintetis premium, yang memberikan keseimbangan antara kenyamanan dan ketahanan. Material mesh memungkinkan sirkulasi udara yang baik, menjaga kaki tetap kering dan sejuk saat dipakai dalam waktu lama. Sementara itu, kulit sintetis pada bagian tertentu memberi kesan mewah dan kokoh. Kualitas material yang digunakan pada sepatu ini memastikan bahwa New Balance 530 Moonbeam Beige cukup tahan lama dan mudah dirawat.\r\n\r\nDesain New Balance 530 Moonbeam Beige mempertahankan elemen-elemen klasik dari seri 530, seperti logo N yang ikonik di sisi sepatu dan detail jahitan yang rapi pada bagian upper. Logo ini menjadi simbol yang mudah dikenali, menambah kesan sporty pada sepatu ini. Dengan desain yang cukup simpel namun tetap mencolok, sepatu ini memberi kesan modern tanpa kehilangan identitas New Balance yang sudah lama dikenal. Desain ini sangat cocok untuk mereka yang mencari sepatu dengan tampilan retro namun tetap relevan dengan tren fashion saat ini. Pada midsole, sepatu ini menggunakan teknologi ABZORB yang memberikan bantalan ringan dan responsif. Teknologi ini membantu meredam guncangan saat kaki menyentuh tanah, sehingga sepatu ini memberikan kenyamanan ekstra dalam setiap langkah. ABZORB juga memberikan tingkat dukungan yang baik, menjadikan sepatu ini sangat nyaman digunakan untuk aktivitas sepanjang hari. Dengan teknologi ini, New Balance 530 Moonbeam Beige menawarkan kenyamanan yang tak hanya diharapkan dari sepatu fashion, tetapi juga dari sepatu yang mendukung kebutuhan aktivitas fisik ringan.\r\n\r\nBagian sol sepatu ini menggunakan sol karet yang tahan lama dan fleksibel, memberikan traksi yang sangat baik di berbagai permukaan. Pola cengkeram pada sol karet ini memastikan kestabilan kaki saat berjalan, memberikan kenyamanan lebih saat bergerak. Sol karet yang digunakan cukup tahan lama, menjamin sepatu ini tetap awet meski sering digunakan. Desain sol ini juga dirancang dengan detail yang meningkatkan kenyamanan, sehingga sepatu ini cocok digunakan di berbagai situasi, baik itu untuk jalan-jalan santai ataupun aktivitas sehari-hari lainnya.\r\nSecara keseluruhan, New Balance 530 Moonbeam Beige adalah sepatu yang menggabungkan desain retro dengan nuansa modern yang segar. Dengan material berkualitas tinggi seperti mesh dan kulit sintetis, sepatu ini memberikan kenyamanan, ketahanan, dan sirkulasi udara yang baik. Teknologi ABZORB pada midsole memberikan kenyamanan maksimal, sedangkan sol karet yang fleksibel memberikan traksi yang baik di berbagai permukaan. Desainnya yang minimalis dengan warna Moonbeam Beige yang elegan membuat sepatu ini cocok untuk digunakan dalam berbagai kesempatan, menjadikannya pilihan sempurna bagi mereka yang menginginkan sepatu yang stylish, nyaman, dan fungsional. New Balance 530 Moonbeam Beige adalah pilihan tepat untuk para penggemar sneaker yang mencari sepatu dengan desain klasik namun tetap modern dan nyaman.', 1999000.00, NULL, 5, 'MR530AA1', 'New Balance', 'unisex', 'products/Ywe5mdqRQVHwUUBJybELWgIZvsQAYmY4U8lqhKFi.jpg', 1, 'Lifestyle', '[\"36\", \"37\", \"38\", \"39.5\", \"40\", \"40.5\", \"42\"]', '[\"Cream\"]', NULL, 0, 1, '2026-04-06 08:26:03', '2026-04-06 08:26:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_sizes_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  KEY `reviews_order_id_foreign` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bQFcFB861iArjOKJWylN00YhDzuzEtRjtjxDYMlS', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnJBNmRhd2RKclIyNEh2SWZxak9CemV6M21IbUlDbTVHdzhqRXB0SiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1775446029);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'store_name', 'baksi', '2026-02-23 09:51:11', '2026-02-23 10:05:45'),
(2, 'store_description', 'Toko sepatu online termahal dan tidak terpercaya nomor 1 di Indonesia', '2026-02-23 09:51:11', '2026-02-23 10:06:15'),
(3, 'store_phone', '08123456789', '2026-02-23 09:51:11', '2026-02-23 09:51:11'),
(4, 'store_email', 'admin@sepatuwara.com', '2026-02-23 09:51:11', '2026-02-23 09:51:11'),
(5, 'store_address', 'Jl. Kebon Jeruk No. 123, Jakarta Barat', '2026-02-23 09:51:11', '2026-02-23 09:51:11'),
(6, 'social_instagram', 'https://instagram.com/', '2026-02-23 09:51:11', '2026-02-23 09:51:11'),
(7, 'social_facebook', 'https://facebook.com/', '2026-02-23 09:51:11', '2026-02-23 09:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `ticket_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`),
  KEY `tickets_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `ticket_number`, `subject`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'TKT-69D308CD41647', 'Pesanan saya belum di proses', 'pesanan', 'in_progress', '2026-04-06 08:13:49', '2026-04-06 08:41:45'),
(2, 3, 'TKT-69D31CC1615E2', 'halo', 'lainnya', 'closed', '2026-04-06 09:38:57', '2026-04-06 10:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

DROP TABLE IF EXISTS `ticket_replies`;
CREATE TABLE IF NOT EXISTS `ticket_replies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_replies_ticket_id_foreign` (`ticket_id`),
  KEY `ticket_replies_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_replies`
--

INSERT INTO `ticket_replies` (`id`, `ticket_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'saya belum menerima pesanan saya', '2026-04-06 08:13:49', '2026-04-06 08:13:49'),
(2, 1, 3, 'halo', '2026-04-06 08:39:26', '2026-04-06 08:39:26'),
(3, 1, 2, 'halo bisa informasikan kode pesanan anda ?', '2026-04-06 08:42:00', '2026-04-06 08:42:00'),
(4, 2, 3, 'halo', '2026-04-06 09:38:57', '2026-04-06 09:38:57'),
(5, 2, 3, 'halo amba ada ?', '2026-04-06 10:25:36', '2026-04-06 10:25:36'),
(6, 2, 2, 'p\r\np\r\np', '2026-04-06 10:26:16', '2026-04-06 10:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `phone`, `address`, `province`, `city`, `district`, `postal_code`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@sepatukuid.com', 'admin', '081234567890', 'Jakarta, Indonesia', NULL, NULL, NULL, NULL, 1, NULL, 'admin123', 'yNjnf3aIdGcCkU0UG3yHrVyJcgWASkZaqkGtZcbWgGATUaI4Wc4oMjLyaVj3', '2026-04-06 07:11:31', '2026-04-06 07:11:31'),
(2, 'Petugas Customer Service', 'petugas@sepatukuid.com', 'petugas', '081234567891', 'Bandung, Indonesia', NULL, NULL, NULL, NULL, 1, NULL, 'petugas123', 'g8X8T6FxYgH2N8IngqNCQR0lzbUyphpayZKveV7wxguckSpgyechHZAauPu8', '2026-04-06 07:11:31', '2026-04-06 07:11:31'),
(3, 'User Biasa', 'user@sepatukuid.com', 'user', '081234567892', 'Surabaya, Indonesia', 'Jawa Barat', 'Depok', 'DDD', '16433', 1, NULL, 'user123', 'TImC01b4vEkeADWvJUZ6I9GV375XyHOw6fgmdolI4UNgzKcb0gbJEeWPVm9t', '2026-04-06 07:11:31', '2026-04-06 07:38:40'),
(4, 'Raki Aranda', 'raki@example.com', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'raki123', NULL, '2026-04-06 07:11:31', '2026-04-06 07:11:31'),
(5, 'Andi Pratama', 'andi@example.com', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'andi123', NULL, '2026-04-06 07:11:31', '2026-04-06 07:11:31'),
(6, 'Sinta Wijaya', 'sinta@example.com', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'sinta123', NULL, '2026-04-06 07:11:31', '2026-04-06 07:11:31'),
(7, 'Budi Santoso', 'budi@example.com', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'budi123', NULL, '2026-04-06 07:11:31', '2026-04-06 07:11:31'),
(8, 'Cici Amelia', 'cici@example.com', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'cici123', NULL, '2026-04-06 07:11:31', '2026-04-06 07:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlists_user_id_foreign` (`user_id`),
  KEY `wishlists_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 3, 6, '2026-04-06 08:08:30', '2026-04-06 08:08:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
