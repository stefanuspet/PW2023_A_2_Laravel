INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email_user`, `email_verified_at`, `verify_key`, `no_telp_user`, `alamat`, `kecamatan`, `kota_kabupaten`, `provinsi`, `kode_pos`, `negara`, `profile_pic`) VALUES
(1, 'Rhoma Irama', 'roma22', '$2y$10$05wVEWIWTAWLOQN20XxT8OSDwuKv4OoLzDSCdGs4tn54YFnhcMNyi', 'roma@gmail.com', '2023-12-20 10:23:44', 'sKzwJNphastzZjV6VLtLaVU6ZIWi9IttigOIJgpCFc4fIY2f86m4SvHitTUPdlMtLkC6uOjA7ub1W2NIjWK7E08htZZETTuqqNaR', '087253874638', 'Jl. Hamtaro no.9', 'Condongcatur', 'Sleman', 'DIY', '78855', 'Indonesia', 'V7U0YB53WV111x26mPulX1cSSLZEfDOvETg6AXPt.jpg'),
(2, 'Marquez', 'mmarcc', '$2y$10$VoMuDs3PaD5jv6FKBUz8juHXEApupUWtShKojBuIzZOz3K8UOo7TG', 'marquez@gmail.com', '2023-12-20 10:55:20', 'jeG0P2zquAWPEcHbCP6ok1wMgRIJXFZv8pdZiTjJXQzlRSJIYbTffRYXoEqnrzUlskctyrz3JSfEoCohgeH3apsdvPJS1G1M5rmh', '087253874638', 'Jl. Hongkong no.99', 'Caringin', 'Fakfak', 'Papua Barat', '55555', 'Indonesia', NULL);

INSERT INTO `shipment` (`id_shipment`, `status`, `harga`, `jenis_shipment`) VALUES
(1, 'dikemas', 300000, 'Tiki');

INSERT INTO `produk` (`id_produk`, `id_kategori_produk`, `nama_produk`, `deskripsi`, `harga_start`, `minimal_inkremen_bid`, `sertifikat`) VALUES
(1, 1, 'Patung Zeus', 'Patung dari batu marmer', 50000000, 5000000, NULL);

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-12-20 10:01:30', '2023-12-20 10:01:30');

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'nG5L8LDaIsHMFRY5f35AQdtk0VhuNnzWtNRgsox1', NULL, 'http://localhost', 1, 0, 0, '2023-12-20 10:01:30', '2023-12-20 10:01:30'),
(2, NULL, 'Laravel Password Grant Client', '3xOyKDeEOHR7V3UR2qBy8FA1LrHA4pJZuWwHkaVB', 'users', 'http://localhost', 0, 1, 0, '2023-12-20 10:01:30', '2023-12-20 10:01:30');

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('2bc95a6e000f7615bd65c57163565f605cb3f72015894285c1a6d8d7a80a072245968b8da3aac22e', 1, 1, 'Authentication Token', '[]', 1, '2023-12-20 10:33:23', '2023-12-20 10:37:27', '2024-12-20 17:33:23'),
('9fb0837fdfd3f66ffe649d12f2f1f9c57c560f5d2ac651444f69b164a926a9360de87986fadaf3dc', 1, 1, 'Authentication Token', '[]', 1, '2023-12-20 10:39:07', '2023-12-20 10:40:43', '2024-12-20 17:39:07'),
('f307a556470423aae0df973b52f316a1a1b73a9ad38743980b8eb3f10143e511b1d0242d82459545', 2, 1, 'Authentication Token', '[]', 1, '2023-12-20 10:55:59', '2023-12-20 11:00:27', '2024-12-20 17:55:59'),
('f50fcc678acc7d80d486ec84197381838400b4f6f2e0795507078674637f17aabd95109980a8c1fa', 1, 1, 'Authentication Token', '[]', 1, '2023-12-20 10:24:42', '2023-12-20 10:32:09', '2024-12-20 17:24:42');

INSERT INTO `list_gambar` (`id`, `id_produk_gambar`, `gambar`) VALUES
(1, 1, 'xs1u36er6RFcOkyFS34V0CG3BRHfgtzN0O2Xw8RY.jpg');

INSERT INTO `auction` (`id_auction`, `id_produk_auctioned`, `id_shipment_auction`, `id_seller`, `time_start`, `time_end`, `verified`) VALUES
(1, 1, 1, 1, '2023-12-28 17:30:00', '2023-12-31 20:30:00', '1');