-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               12.3.3-MariaDB - MariaDB Server
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for posmia
CREATE DATABASE IF NOT EXISTS `posmia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `posmia`;

-- Dumping structure for table posmia.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.cache: ~0 rows (approximately)

-- Dumping structure for table posmia.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.cache_locks: ~0 rows (approximately)

-- Dumping structure for table posmia.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table posmia.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint(20) unsigned NOT NULL,
  `produk_id` bigint(20) unsigned NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.item_penjualan: ~1 rows (approximately)
INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 12344556, 24689112, '2026-08-31 07:10:05', '2026-08-31 07:10:07');

-- Dumping structure for table posmia.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_user_id_foreign` (`user_id`),
  CONSTRAINT `jenis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.jenis: ~5 rows (approximately)
INSERT INTO `jenis` (`id`, `user_id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
	(1, 7, 'Elektronik', '2026-08-31 03:03:08', '2026-08-31 03:03:08'),
	(2, 7, 'Pakaian', '2026-08-31 03:03:22', '2026-08-31 03:03:22'),
	(3, 7, 'Sepatu', '2026-08-31 03:03:30', '2026-08-31 03:03:30'),
	(6, 7, 'Skincare', '2026-09-03 02:39:50', '2026-09-03 02:39:50'),
	(7, 7, 'Make Up', '2026-09-03 02:39:58', '2026-09-03 02:39:58');

-- Dumping structure for table posmia.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.jobs: ~0 rows (approximately)

-- Dumping structure for table posmia.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.job_batches: ~0 rows (approximately)

-- Dumping structure for table posmia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '0001_01_01_000004_create_jenis_table', 1),
	(6, '2026_04_20_072227_create_produk_table', 1),
	(7, '2026_04_20_072927_create_penjualan_table', 1),
	(8, '2026_04_20_073614_create_item_penjualan_table', 1),
	(9, '2026_08_21_084356_add_jenis_id_to_produk_table', 1);

-- Dumping structure for table posmia.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table posmia.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `status` enum('OPEN','COMPLETED') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.penjualan: ~1 rows (approximately)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
	(1, 7, 24689112, 'QRIS', 'COMPLETED', '2026-08-31 07:10:03', '2026-08-31 07:10:13');

-- Dumping structure for table posmia.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_id` bigint(20) unsigned DEFAULT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_jenis_id_foreign` (`jenis_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.produk: ~13 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `foto`, `nama`, `jenis_id`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 7, 'products/ferkhsudeqxo3H0ECAu6u6oGb8fWzPzP4ej5Zbo3.jpg', 'Puma Speedcat OG in Light Pink', 3, 5000000, 8000000, 1000, '2026-08-31 07:09:40', '2026-09-01 07:09:21'),
	(2, 7, 'products/pStGMJ1lCV8vcqbyJGW4GGXhlw1YvZ7ISgV5UZ4z.jpg', 'Puma Speedcat OG in Light Pink', 3, 6000000, 9000000, 1000, '2026-09-01 07:10:51', '2026-09-01 07:10:51'),
	(3, 7, 'products/i4G0sb9W61leqHVJm2kbUqir2WTYn8y5m9a6qMnp.jpg', 'Wispie Money Magnet Fitted Shirt', 2, 150000, 180000, 1000, '2026-09-01 07:13:18', '2026-09-01 07:13:18'),
	(4, 7, 'products/lLUiOEStJSK7CXUKCmPK6waWL8EmlSCxkjCObjjA.jpg', 'Wispie Love Letter Pants', 2, 190000, 200000, 1000, '2026-09-01 07:15:12', '2026-09-01 07:15:12'),
	(5, 7, 'products/ZzAPtG9g6M6EdkqpnQbpNENfLJxWDlOvHXW33vDh.jpg', 'Wispie Shawty Top', 2, 100000, 160000, 1000, '2026-09-01 07:16:28', '2026-09-01 07:16:28'),
	(6, 7, 'products/fTVL2lKDdlb8czwSJCOoPL6yRH4ajA0vLo4ACiGS.jpg', 'FAB5 RETRO FRIDGE 38 LITRE PINK', 1, 10000000, 20000000, 1000, '2026-09-01 07:18:42', '2026-09-01 07:18:42'),
	(7, 7, 'products/zj7eeryyhZ3PDkwaVHKPkR1cbOxO1c77ReCM1KDA.jpg', 'SMEG ELECTRIC JUG KLF03PKUK-PINK', 1, 5000000, 10000000, 1000, '2026-09-01 07:19:48', '2026-09-01 07:19:48'),
	(8, 7, 'products/EyWJTiU8h79EqYAqQ15U8cMeqYyKYx8430WGRs7v.jpg', 'SMEG Pink Retro Drip Coffee Maker', 1, 11000000, 12000000, 1000, '2026-09-01 07:20:51', '2026-09-01 07:20:51'),
	(9, 7, 'products/Ku286DFYgDLdGXOLlf6hH8IYegbAnohBdPApqgyc.jpg', 'Adidas Samba OG Lucid Pink Cream', 3, 5000000, 7000000, 1000, '2026-09-01 07:21:55', '2026-09-01 07:21:55'),
	(10, 7, 'products/9aLeuqRStkKC368CgPKEeMmovwHoNfc1AzkBkERk.jpg', 'Adidas Sneakers', 3, 4000000, 55000000, 1000, '2026-09-01 07:25:13', '2026-09-01 07:25:13'),
	(12, 7, 'products/x92UUA0D9PCUeGSm9ckTnvCepmuQ5KPeW24CORHL.jpg', 'POREMIZING LIGHT GEL CREAM', 6, 150000, 200000, 1000, '2026-09-03 02:45:43', '2026-09-03 02:45:43'),
	(13, 7, 'products/7fe0yV75Y6Te4sul9Lxkga1fWiyFlFgeSeWzGOtl.jpg', 'POREMIZING QUICK CLAY STICK MASK', 6, 100000, 150000, 1000, '2026-09-03 02:49:52', '2026-09-03 02:49:52'),
	(14, 7, 'products/qjTBQ7MP5EeSu6mOQeAZHEu3qojBqry8iyNgR5xJ.jpg', 'POREMIZING FRESH AMPOULE', 6, 200000, 250000, 1000, '2026-09-03 02:52:08', '2026-09-03 02:52:08');

-- Dumping structure for table posmia.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-08-31 02:44:50', '2026-08-31 02:44:50'),
	(2, 'kasir', '2026-08-31 02:44:50', '2026-08-31 02:44:50');

-- Dumping structure for table posmia.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.sessions: ~0 rows (approximately)

-- Dumping structure for table posmia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table posmia.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(7, 1, 'Mia Sumiati', 'miasumiati@gmail.com', NULL, '$2y$12$PEC1zRPiW..blqxYsmbXo.vTgZyALpH5l06nkEIysKV0PR7WrSflW', NULL, '2026-08-31 03:00:56', '2026-08-31 03:00:56'),
	(10, 2, 'Citra', 'inong@gmail.com', NULL, '$2y$12$ufov/OW0MFBVa7L9KTqQOOw1yemYHjeU.IretwrzzTbbmFSJICj8S', NULL, '2026-09-03 04:08:28', '2026-09-03 04:08:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
