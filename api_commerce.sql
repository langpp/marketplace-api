-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 06:05 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `deskripsi` text NOT NULL,
  `total_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `snaptoken` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `order_id`, `id_produk`, `id_toko`, `id_user`, `tanggal`, `deskripsi`, `total_barang`, `harga`, `status`, `first_name`, `last_name`, `address`, `city`, `postal_code`, `phone`, `country_code`, `snaptoken`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 1, '2021-01-20 10:44:46', '123', 1, 0, '1', '', '', '', '', '', '', '', '', '2021-01-27 03:45:09', '2021-01-27 07:55:50'),
(2, 0, 1, 1, 1, '2021-01-20 10:44:46', 'packing yg rapih', 1, 0, '1', '', '', '', '', '', '', '', '', '2021-01-27 07:52:56', '2021-01-27 07:52:56'),
(3, 1744160686, 1, 2, 1, '2021-01-20 10:44:46', 'Packing yg rapih', 2, 20000, '1', 'Gilang', 'permana', 'cilodong', 'depok', '16414', '12456', 'IDN', '35bfdf00-cef3-43b5-bf89-f3cb71df67a5', '2021-01-28 04:59:16', '2021-01-28 04:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `id_toko` int(11) NOT NULL,
  `user_beli` text NOT NULL,
  `gambar_lain` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `gambar`, `id_toko`, `user_beli`, `gambar_lain`, `created_at`, `updated_at`) VALUES
(1, 'barang baru', 10000, 'produk-1611729216.png', 1, '1', 'produk_lain-1611729216.png', '2021-01-26 17:17:19', '2021-01-27 06:33:36'),
(2, 'barang2', 200000, './uploads/produk/produk-1611728335.png', 1, '1,2,3,4', './uploads/produk/produk_lain-1611728335.png', '2021-01-27 06:18:55', '2021-01-27 06:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `logo` text NOT NULL,
  `background` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `deskripsi`, `id_user`, `logo`, `background`, `created_at`, `updated_at`) VALUES
(1, 'toko c', 'update toko', 1, 'logo-1611733278.png', 'background-1611733278.png', '2021-01-26 17:14:49', '2021-01-27 07:41:19'),
(2, 'toko a', 'toko jual barang', 1, 'logo-1611733216.png', 'background-1611733216.png', '2021-01-27 07:40:16', '2021-01-27 07:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `role` int(5) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `role`, `first_name`, `last_name`, `address`, `city`, `postal_code`, `country_code`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin@admin.com', '$2y$10$z9xQ4Gl01bzHrBzOLwHkQOQzXthonpiEwnvUjN4d6Fzo154ssPIRK', 1, '', '', '', '', 0, '', 1234567890, '2021-01-26 09:40:55.000000', '2021-01-26 09:40:55.000000'),
(2, 'admin2', 'admin2@admin.com', '$2y$10$nstX/s7otJUWEwcW5NjPaenSvMafnAgKqGwEPqFY7/YrMwwBtmZ8G', 1, '', '', '', '', 0, '', 1234567890, '2021-01-26 18:33:28.000000', '2021-01-26 18:33:28.000000'),
(4, 'admin4', 'admin3@admin.com', '$2y$10$IMojkgDkzWkVotFm7fsEeu.WM2iIb.pcilJMGJlslkShGG0qLMxFO', 1, 'admin3', 'adm', 'cilodong', 'depok', 16414, 'IDN', 1234567890, '2021-01-28 04:29:31.000000', '2021-01-28 04:29:31.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
