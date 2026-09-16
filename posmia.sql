-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk posmia
CREATE DATABASE IF NOT EXISTS `posmia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `posmia`;

-- membuang struktur untuk table posmia.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.cache: ~0 rows (lebih kurang)

-- membuang struktur untuk table posmia.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.cache_locks: ~0 rows (lebih kurang)

-- membuang struktur untuk table posmia.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table posmia.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `kuantitas` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.item_penjualan: ~7 rows (lebih kurang)
INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 12344556, 24689112, '2026-08-31 07:10:05', '2026-08-31 07:10:07'),
	(3, 4, 9, 1, 7000000, 7000000, '2026-09-09 02:36:50', '2026-09-09 02:36:50'),
	(4, 5, 9, 1, 7000000, 7000000, '2026-09-09 02:55:23', '2026-09-09 02:55:23'),
	(5, 6, 9, 1, 7000000, 7000000, '2026-09-09 03:01:54', '2026-09-09 03:01:54'),
	(6, 6, 10, 1, 55000000, 55000000, '2026-09-09 03:01:55', '2026-09-09 03:01:55'),
	(7, 7, 10, 1, 55000000, 55000000, '2026-09-09 03:04:21', '2026-09-09 03:04:21'),
	(8, 8, 9, 1, 7000000, 7000000, '2026-09-10 06:56:18', '2026-09-10 06:56:18'),
	(12, 15, 9, 1, 7000000, 7000000, '2026-09-16 03:34:03', '2026-09-16 03:34:03'),
	(13, 16, 10, 2, 55000000, 110000000, '2026-09-16 03:42:43', '2026-09-16 03:42:46'),
	(14, 16, 1, 1, 8000000, 8000000, '2026-09-16 03:42:45', '2026-09-16 03:42:45'),
	(15, 17, 9, 1, 7000000, 7000000, '2026-09-16 03:43:39', '2026-09-16 03:43:39');

-- membuang struktur untuk table posmia.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_user_id_foreign` (`user_id`),
  CONSTRAINT `jenis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.jenis: ~5 rows (lebih kurang)
INSERT INTO `jenis` (`id`, `user_id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
	(2, 7, 'Pakaian', '2026-08-31 03:03:22', '2026-08-31 03:03:22'),
	(3, 7, 'Sepatu', '2026-08-31 03:03:30', '2026-08-31 03:03:30'),
	(10, 7, 'Barang', '2026-09-16 03:32:08', '2026-09-16 03:32:08');

-- membuang struktur untuk table posmia.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table posmia.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.job_batches: ~0 rows (lebih kurang)

-- membuang struktur untuk table posmia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.migrations: ~10 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '0001_01_01_000004_create_jenis_table', 1),
	(6, '2026_04_20_072227_create_produk_table', 1),
	(7, '2026_04_20_072927_create_penjualan_table', 1),
	(8, '2026_04_20_073614_create_item_penjualan_table', 1),
	(9, '2026_08_21_084356_add_jenis_id_to_produk_table', 1),
	(10, '2026_09_09_094801_add_uang_diterima_kembalian_to_sales_table', 2);

-- membuang struktur untuk table posmia.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table posmia.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total_pembayaran` int NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_diterima` bigint unsigned DEFAULT NULL,
  `kembalian` bigint unsigned DEFAULT NULL,
  `status` enum('OPEN','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.penjualan: ~7 rows (lebih kurang)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `uang_diterima`, `kembalian`, `status`, `created_at`, `updated_at`) VALUES
	(1, 7, 24689112, 'QRIS', NULL, NULL, 'COMPLETED', '2026-08-31 07:10:03', '2026-08-31 07:10:13'),
	(4, 7, 7000000, 'CASH', NULL, NULL, 'COMPLETED', '2026-09-09 02:36:48', '2026-09-09 02:37:03'),
	(5, 7, 7000000, 'CASH', NULL, NULL, 'COMPLETED', '2026-09-09 02:47:48', '2026-09-09 02:55:34'),
	(6, 7, 62000000, 'CASH', 70000000, 8000000, 'COMPLETED', '2026-09-09 03:01:53', '2026-09-09 03:02:32'),
	(7, 10, 55000000, 'CASH', 60000000, 5000000, 'COMPLETED', '2026-09-09 03:04:19', '2026-09-09 03:04:35'),
	(8, 7, 7000000, 'CASH', 10000000, 3000000, 'COMPLETED', '2026-09-10 06:56:16', '2026-09-10 06:56:56'),
	(15, 7, 7000000, 'QRIS', NULL, NULL, 'COMPLETED', '2026-09-16 03:34:00', '2026-09-16 03:34:11'),
	(16, 7, 118000000, 'CASH', 200000000, 82000000, 'COMPLETED', '2026-09-16 03:42:40', '2026-09-16 03:43:02'),
	(17, 10, 7000000, 'QRIS', NULL, NULL, 'COMPLETED', '2026-09-16 03:43:37', '2026-09-16 03:43:45');

-- membuang struktur untuk table posmia.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_id` bigint unsigned DEFAULT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_jenis_id_foreign` (`jenis_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.produk: ~0 rows (lebih kurang)
INSERT INTO `produk` (`id`, `user_id`, `foto`, `nama`, `jenis_id`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 7, 'products/ferkhsudeqxo3H0ECAu6u6oGb8fWzPzP4ej5Zbo3.jpg', 'Puma Speedcat OG in Light Pink', 3, 5000000, 8000000, 999, '2026-08-31 07:09:40', '2026-09-16 03:42:45'),
	(2, 7, 'products/pStGMJ1lCV8vcqbyJGW4GGXhlw1YvZ7ISgV5UZ4z.jpg', 'Puma Speedcat OG in Light Pink', 3, 6000000, 9000000, 1000, '2026-09-01 07:10:51', '2026-09-01 07:10:51'),
	(3, 7, 'products/i4G0sb9W61leqHVJm2kbUqir2WTYn8y5m9a6qMnp.jpg', 'Wispie Money Magnet Fitted Shirt', 2, 150000, 180000, 1000, '2026-09-01 07:13:18', '2026-09-01 07:13:18'),
	(4, 7, 'products/lLUiOEStJSK7CXUKCmPK6waWL8EmlSCxkjCObjjA.jpg', 'Wispie Love Letter Pants', 2, 190000, 200000, 1000, '2026-09-01 07:15:12', '2026-09-01 07:15:12'),
	(5, 7, 'products/ZzAPtG9g6M6EdkqpnQbpNENfLJxWDlOvHXW33vDh.jpg', 'Wispie Shawty Top', 2, 100000, 160000, 1000, '2026-09-01 07:16:28', '2026-09-01 07:16:28'),
	(9, 7, 'products/Ku286DFYgDLdGXOLlf6hH8IYegbAnohBdPApqgyc.jpg', 'Adidas Samba OG Lucid Pink Cream', 3, 5000000, 7000000, 994, '2026-09-01 07:21:55', '2026-09-16 03:43:39'),
	(10, 7, 'products/9aLeuqRStkKC368CgPKEeMmovwHoNfc1AzkBkERk.jpg', 'Adidas Sneakers', 3, 4000000, 55000000, 996, '2026-09-01 07:25:13', '2026-09-16 03:42:46');

-- membuang struktur untuk table posmia.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.roles: ~0 rows (lebih kurang)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-08-31 02:44:50', '2026-08-31 02:44:50'),
	(2, 'kasir', '2026-08-31 02:44:50', '2026-08-31 02:44:50');

-- membuang struktur untuk table posmia.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.sessions: ~0 rows (lebih kurang)

-- membuang struktur untuk table posmia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posmia.users: ~4 rows (lebih kurang)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(7, 1, 'Mia Sumiati', 'miasumiati@gmail.com', NULL, '$2y$12$PEC1zRPiW..blqxYsmbXo.vTgZyALpH5l06nkEIysKV0PR7WrSflW', NULL, '2026-08-31 03:00:56', '2026-08-31 03:00:56'),
	(10, 2, 'Citra', 'inong@gmail.com', NULL, '$2y$12$S/QRTHa80bKz0bxYfeflpuH2kfMMZ2ojM9wMAp8k2Ju1YG6fZRKMS', NULL, '2026-09-03 04:08:28', '2026-09-09 03:04:01'),
	(11, 1, 'miasumiati', 'miamia2@gmail.com', NULL, '$2y$12$D8uHr/AdNs7BC/M9oge0ruqHeHh6Za8kHoZOBEFQOFnjb/Og3V6Ve', NULL, '2026-09-10 06:44:10', '2026-09-16 03:24:04');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
