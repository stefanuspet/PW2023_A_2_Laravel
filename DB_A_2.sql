-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 06:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `millenial_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `id_auction` bigint(20) UNSIGNED NOT NULL,
  `id_produk_auctioned` bigint(20) UNSIGNED NOT NULL,
  `id_shipment_auction` bigint(20) UNSIGNED NOT NULL,
  `id_seller` bigint(20) UNSIGNED NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `verified` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`id_auction`, `id_produk_auctioned`, `id_shipment_auction`, `id_seller`, `time_start`, `time_end`, `verified`) VALUES
(1, 1, 1, 1, '2023-12-28 17:30:00', '2023-12-31 20:30:00', '1'),
(2, 4, 2, 1, '2023-12-20 12:30:00', '2023-12-25 12:30:00', '1'),
(3, 5, 3, 1, '2023-12-26 12:30:00', '2023-12-29 15:30:00', '0'),
(4, 6, 4, 2, '2023-12-08 11:50:00', '2023-12-13 11:51:00', '1'),
(6, 7, 5, 2, '2023-12-19 18:00:00', '2023-12-23 15:00:00', '0'),
(7, 8, 6, 2, '2023-12-04 12:05:00', '2023-12-07 12:05:00', '0'),
(8, 9, 7, 2, '2023-12-18 13:00:00', '2023-12-23 18:30:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id_bid` bigint(20) UNSIGNED NOT NULL,
  `id_bidder` bigint(20) UNSIGNED NOT NULL,
  `id_auction_to_bid` bigint(20) UNSIGNED NOT NULL,
  `harga_bid` double NOT NULL,
  `waktu_bid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id_bid`, `id_bidder`, `id_auction_to_bid`, `harga_bid`, `waktu_bid`) VALUES
(1, 2, 1, 30000000, '2023-12-20 22:20:52'),
(2, 1, 1, 10000000, '2023-12-21 01:37:10'),
(3, 3, 2, 150000000, '2023-12-21 12:14:15'),
(4, 2, 2, 200000000, '2023-12-21 12:17:10'),
(5, 1, 8, 600000000, '2023-12-21 12:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `jenis_kategori`) VALUES
(1, 'Art and Collectibles'),
(2, 'Fashion'),
(3, 'Otomotif'),
(4, 'Real Estate'),
(5, 'Sport'),
(6, 'Jewelry');

-- --------------------------------------------------------

--
-- Table structure for table `list_gambar`
--

CREATE TABLE `list_gambar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk_gambar` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_gambar`
--

INSERT INTO `list_gambar` (`id`, `id_produk_gambar`, `gambar`) VALUES
(1, 1, 'xs1u36er6RFcOkyFS34V0CG3BRHfgtzN0O2Xw8RY.jpg'),
(4, 4, 'sdAXxNnH1P90rA2ZAr80midfD0tAZ1oBW8MrLvN5.jpg'),
(5, 4, 'CAuoLC5lDlkGYHS8bVB33KlleR061a89O966B6bD.jpg'),
(6, 5, '2WlyhYYDtBTaQ3oBZzkl4Ucz0W4rBdw3JnwyjFmX.jpg'),
(7, 5, 'dASu8AbDcC8lyyaH938TNoWvu5p6wqiAP4i93tQW.jpg'),
(8, 6, 'f6t0YbtW9iYrJfLbBfjzaRougQ4CvjYygEcfwIn8.jpg'),
(9, 6, 'kQPwKpa7LtKKHHVgpaINyGgHKK0W1Sb3tPzwjkxT.jpg'),
(10, 6, 'D6F8mbQvCJvVkaedzb7KaBgHJqSbkgtx7hSX0iXj.jpg'),
(11, 7, 'wUesN5yfUVs5iPqpjfscd4mqBnt2dTmJ1yrrOJVi.jpg'),
(12, 7, 'r0XJnnIJJtAAkurrpnpCif7RXHdSBOFpYKwNnWFe.png'),
(13, 8, 'GuOegue0okQsYOS91JNm3kHoWD6AEhEHXuCZgvCO.jpg'),
(14, 8, 'PiPoBdeB6LSK2oi6K8pY1PqoAE5PQouWK3RbIPb8.jpg'),
(15, 9, '6mBVVGxgWVvGxDZ3N4lmZ2ku7GMe1F9p1u8svKAP.jpg');

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
(15, '2014_10_12_000000_create_users_table', 1),
(21, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(22, '2023_12_16_040127_create_admins_table', 1),
(23, '2023_12_16_144203_create_kategori', 1),
(24, '2023_12_16_150651_create_produk_table', 1),
(25, '2023_12_16_150725_create_list_gambar_table', 1),
(26, '2023_12_16_175242_shipment', 1),
(27, '2023_12_16_175905_auction', 1),
(28, '2023_12_17_070816_bid', 1);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_produk` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga_start` double NOT NULL,
  `minimal_inkremen_bid` double NOT NULL,
  `sertifikat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori_produk`, `nama_produk`, `deskripsi`, `harga_start`, `minimal_inkremen_bid`, `sertifikat`) VALUES
(1, 1, 'Patung Zeus', 'Patung dari batu marmer', 50000000, 5000000, NULL),
(4, 1, 'Monalisa', 'Monalisa, lukisan ikonik karya Leonardo da Vinci, menawan mata dengan pesona misteriusnya.', 100000000, 5000000, 'vaUR2BpPoXZmL7iWL8T4AeiLCjyzIyBm07MurzQa.jpg'),
(5, 3, 'Lambhorgini aventador ultimate', 'For sale! Barang langka, masih mulus.', 6000000000, 10000000, 'shgRddHexsAwkJLz9b3CL18Y1QvAM8FXYGNeE7RE.jpg'),
(6, 4, 'Rumah Mewah Beverly Hills', 'Fasilitas lengkap, tersedia swimming pool. Sudah bisa langsung ditinggali!', 5000000000, 100000000, NULL),
(7, 6, 'Hope Diamond', 'The legendary cursed diamond! Guaranteed to be Authentic !', 10000000000, 300000000, '1o05dpnXTxNfWt6QEmpdpx6kfol9WT0F4FPtOwH5.jpg'),
(8, 2, 'Marilyn Monroe Material Girl Dress', 'THE iconic pink dress from material girl', 300000000, 10000000, NULL),
(9, 1, 'Starry Night Van Gogh Lukisan', 'Lukisan Van Gogh dengan nama Starry Night.', 500000000, 20000000, 'CvGKIIiUaBdAGwjvkn4zPW67j8GrVR1uaeCvHOZT.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `id_shipment` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `jenis_shipment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`id_shipment`, `status`, `harga`, `jenis_shipment`) VALUES
(1, 'dikemas', 300000, 'Tiki'),
(2, 'dikemas', 500000, 'JNE'),
(3, 'dikemas', 10000000, 'Tiki'),
(4, 'dikemas', 400000, 'Tiki'),
(5, 'dikemas', 5000000, 'JNE'),
(6, 'dikemas', 1000000, 'Pos Indonesia'),
(7, 'dikemas', 7000000, 'Pos Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verify_key` varchar(255) DEFAULT NULL,
  `no_telp_user` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kota_kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email_user`, `email_verified_at`, `verify_key`, `no_telp_user`, `alamat`, `kecamatan`, `kota_kabupaten`, `provinsi`, `kode_pos`, `negara`, `profile_pic`) VALUES
(1, 'Rhoma Irama', 'roma22', '$2y$10$05wVEWIWTAWLOQN20XxT8OSDwuKv4OoLzDSCdGs4tn54YFnhcMNyi', 'roma@gmail.com', '2023-12-20 10:23:44', 'sKzwJNphastzZjV6VLtLaVU6ZIWi9IttigOIJgpCFc4fIY2f86m4SvHitTUPdlMtLkC6uOjA7ub1W2NIjWK7E08htZZETTuqqNaR', '087253874638', 'Jl. Hamtaro no.9', 'Condongcatur', 'Sleman', 'DIY', '78855', 'Indonesia', 'V7U0YB53WV111x26mPulX1cSSLZEfDOvETg6AXPt.jpg'),
(2, 'Marquez', 'mmarcc', '$2y$10$ecAAx02Ky82/JjcZ9gTjsun8s18AlFCMX8SyTgIjfyhFGJ8CrvLZ.', 'marquez@gmail.com', '2023-12-20 10:55:20', 'jeG0P2zquAWPEcHbCP6ok1wMgRIJXFZv8pdZiTjJXQzlRSJIYbTffRYXoEqnrzUlskctyrz3JSfEoCohgeH3apsdvPJS1G1M5rmh', '087253874638', 'Jl. Hongkong no.99', 'Caringin', 'Fakfak', 'Papua Barat', '55555', 'Indonesia', 'f8lOpjEJSySDUGhyU1Z13s1iWQwKEXpAwX8GOQ40.jpg'),
(3, 'Nobita', 'bitanooo', '$2y$10$6eajoRtuRBnbsG/EOuMgzOkoOm.aLzJlRKUphnNj8u86GsAVybDRS', 'nobitakun@gmail.com', '2023-12-21 05:11:56', 'tG1uol4hGD3eaGCDVShWxkzjPLoTXzF2CR7hLGcaeADoZ5QXNKIHvYTUcaIcmF3oJdETBpQLJYO38N40BtxK3a3EnPsIYvf0KPd5', '087253874638', 'Jl. Jitpeng Gg. Dimana No. 77', 'Lubuk Kilangan', 'Padang', 'Sumatera Barat', '71234', 'Indonesia', NULL);

--
-- Indexes for dumped tables

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_user_unique` (`email_user`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `admin_id_user_foreign` (`id_user`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_kategori_produk_foreign` (`id_kategori_produk`);

--
-- Indexes for table `list_gambar`
--
ALTER TABLE `list_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_gambar_id_produk_gambar_foreign` (`id_produk_gambar`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`id_shipment`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id_auction`),
  ADD KEY `auction_id_produk_auctioned_foreign` (`id_produk_auctioned`),
  ADD KEY `auction_id_shipment_auction_foreign` (`id_shipment_auction`),
  ADD KEY `auction_id_seller_foreign` (`id_seller`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id_bid`),
  ADD KEY `bid_id_bidder_foreign` (`id_bidder`),
  ADD KEY `bid_id_auction_to_bid_foreign` (`id_auction_to_bid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id_auction` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id_bid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `list_gambar`
--
ALTER TABLE `list_gambar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `id_shipment` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `auction_id_produk_auctioned_foreign` FOREIGN KEY (`id_produk_auctioned`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auction_id_seller_foreign` FOREIGN KEY (`id_seller`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auction_id_shipment_auction_foreign` FOREIGN KEY (`id_shipment_auction`) REFERENCES `shipment` (`id_shipment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_id_auction_to_bid_foreign` FOREIGN KEY (`id_auction_to_bid`) REFERENCES `auction` (`id_auction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_id_bidder_foreign` FOREIGN KEY (`id_bidder`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list_gambar`
--
ALTER TABLE `list_gambar`
  ADD CONSTRAINT `list_gambar_id_produk_gambar_foreign` FOREIGN KEY (`id_produk_gambar`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_produk_foreign` FOREIGN KEY (`id_kategori_produk`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
