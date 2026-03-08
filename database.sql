-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2026 at 03:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techzone_mvc`
--
CREATE DATABASE IF NOT EXISTS `techzone_mvc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `techzone_mvc`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, -- Hashed password
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
-- (Password is: admin123)
--

INSERT INTO `admins` (`id`, `username`, `password`, `full_name`) VALUES
(1, 'admin', '$2y$10$wT4n.9WjH.W4Y8lZl/MWeOgV/u00p2O7mJ1t87gJ1l/.Y8h1Y1mJ.', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`) VALUES
(1, 'Điện thoại', 'dien-thoai', '📱'),
(2, 'Laptop', 'laptop', '💻'),
(3, 'Máy tính bảng', 'may-tinh-bang', '📟'),
(4, 'Tivi', 'tivi', '📺'),
(5, 'Đồng hồ', 'dong-ho', '⌚'),
(6, 'Tai nghe', 'tai-nghe', '🎧'),
(7, 'Phụ kiện', 'phu-kien', '📡'),
(8, 'Sạc dự phòng', 'sac-du-phong', '🔋'),
(9, 'Camera', 'camera', '📷'),
(10, 'Gaming', 'gaming', '🎮');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `sale_price` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `specs` json DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL, -- Comma separated like 'Mới,Hot'
  `is_featured` tinyint(1) DEFAULT '0',
  `is_flash_sale` tinyint(1) DEFAULT '0',
  `sold_count` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `sale_price`, `image`, `tags`, `is_featured`, `is_flash_sale`) VALUES
(1, 1, 'iPhone 16 Pro Max 256GB', 'iphone-16-pro-max-256gb', 34990000, 34490000, 'https://cdn.tgdd.vn/Products/Images/42/329149/iphone-16-pro-max-sa-1-1.jpg', 'Mới,Trả góp 0%', 1, 0),
(2, 1, 'Samsung Galaxy S24 Ultra 12GB/256GB', 'samsung-galaxy-s24-ultra-12gb-256gb', 33990000, 26990000, 'https://cdn.tgdd.vn/Products/Images/42/307130/samsung-galaxy-s24-ultra-xam-1-1.jpg', 'Hot,Mới', 1, 0),
(3, 1, 'Xiaomi Redmi Note 13 Pro 8GB/256GB', 'xiaomi-redmi-note-13-pro-8gb-256gb', 9490000, 7990000, 'https://cdn.tgdd.vn/Products/Images/42/311634/xiaomi-redmi-note-13-pro-8gb-256gb-den-1-1.jpg', 'Bán chạy', 1, 0),
(4, 1, 'OPPO Reno12 F 5G 8GB/256GB', 'oppo-reno12-f-5g-8gb-256gb', 9490000, 8990000, 'https://cdn.tgdd.vn/Products/Images/42/325700/oppo-reno12-f-xanh-1-1.jpg', 'Mới', 1, 0),
(5, 1, 'vivo V30e 5G 8GB/256GB', 'vivo-v30e-5g-8gb-256gb', 10490000, 9490000, 'https://cdn.tgdd.vn/Products/Images/42/322971/vivo-v30e-tim-1-1.jpg', 'Giảm sốc', 1, 0),
(6, 2, 'MacBook Air 13 inch M3 8GB/256GB', 'macbook-air-13-inch-m3-8gb-256gb', 27990000, 25990000, 'https://cdn.tgdd.vn/Products/Images/44/322629/macbook-air-13-inch-m3-8gb-256gb-7-core-gpu-xam-1-1.jpg', 'Mới,Hot', 1, 0),
(7, 2, 'Laptop ASUS Vivobook 15 X1504VA i5 1335U', 'laptop-asus-vivobook-15-x1504va-i5-1335u', 17990000, 15490000, 'https://cdn.tgdd.vn/Products/Images/44/313364/asus-vivobook-15-x1504va-i5-nj070w-1-1.jpg', 'AI PC,Mới', 1, 0),
(8, 2, 'Laptop HP 15 fd0079TU i5 1335U', 'laptop-hp-15-fd0079tu-i5-1335u', 18690000, 16990000, 'https://cdn.tgdd.vn/Products/Images/44/311175/hp-15-fd0079tu-i5-8w104pa-1-1.jpg', 'Bán chạy', 1, 0),
(9, 2, 'Laptop Acer Nitro V ANV15 51 57B2 i5 13420H', 'laptop-acer-nitro-v-anv15-51-57b2-i5-13420h', 21490000, 19990000, 'https://cdn.tgdd.vn/Products/Images/44/316931/acer-nitro-v-anv15-51-57b2-i5-nhqn8sv001-1-1.jpg', 'Gaming', 1, 0),
(10, 3, 'iPad Pro M4 11 inch WiFi 256GB', 'ipad-pro-m4-11-inch-wifi-256gb', 28990000, 27490000, 'https://cdn.tgdd.vn/Products/Images/522/324151/ipad-pro-m4-11-inch-wifi-space-black-1.jpg', 'Mới 2024', 1, 0),
(11, 3, 'Samsung Galaxy Tab S9 FE WiFi', 'samsung-galaxy-tab-s9-fe-wifi', 9990000, 8490000, 'https://cdn.tgdd.vn/Products/Images/522/314111/samsung-galaxy-tab-s9-fe-wifi-xanh-1-1.jpg', 'Bán chạy', 1, 0),
(12, 6, 'Tai nghe Bluetooth True Wireless Rezo Air', 'tai-nghe-bluetooth-true-wireless-rezo-air', 900000, 450000, 'https://cdn.tgdd.vn/Products/Images/54/292770/bluetooth-true-wireless-rezo-air-den-1.jpg', 'Sale', 0, 1),
(13, 7, 'Chuột không dây Silent Logitech M220', 'chuot-khong-day-silent-logitech-m220', 399000, 299000, 'https://cdn.tgdd.vn/Products/Images/54/90246/chuot-khong-day-silent-logitech-m220-den-1-1.jpg', 'Sale', 0, 1),
(14, 7, 'Loa Bluetooth Sony SRS-XB100', 'loa-bluetooth-sony-srs-xb100', 1290000, 1090000, 'https://cdn.tgdd.vn/Products/Images/2162/310461/Sony-SRS-XB100-xanh-duong-1.jpg', 'Sale', 0, 1),
(15, 8, 'Sạc dự phòng 10000mAh Xmobile PowerLite P106WD', 'sac-du-phong-10000mah-xmobile-powerlite-p106wd', 600000, 300000, 'https://cdn.tgdd.vn/Products/Images/57/233816/xmobile-powerlite-p106wd-den-1.jpg', 'Sale', 0, 1),
(16, 7, 'Bàn phím không dây Logitech K380', 'ban-phim-khong-day-logitech-k380', 790000, 590000, 'https://cdn.tgdd.vn/Products/Images/4547/190885/ban-phim-bluetooth-logitech-k380-xam-1-1.jpg', 'Sale', 0, 1),
(17, 5, 'Apple Watch Series 9 GPS 41mm', 'apple-watch-series-9-gps-41mm', 10490000, 8990000, 'https://cdn.tgdd.vn/Products/Images/7077/314545/apple-watch-s9-41mm-vien-nhom-day-the-thao-hong-1.jpg', 'Sale', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `total_price` int NOT NULL,
  `status` enum('pending','processing','shipped','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL, -- Price at the time of purchase
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
