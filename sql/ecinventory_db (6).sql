-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 02:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecinventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(1, 'Nescafe'),
(2, 'YS Quality'),
(3, 'Apple'),
(4, 'Starbucks'),
(5, 'Jack N Jill'),
(6, 'Lucky Me'),
(7, 'Chupa Chups'),
(8, 'Mixed Nuts'),
(9, 'Mat\'s Donut');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_prefix` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_category_id`, `category_name`, `category_prefix`) VALUES
(1, NULL, 'Food', 'F'),
(2, NULL, 'Dairy', 'D'),
(3, 2, 'Yogurt Drink', 'YD'),
(4, NULL, 'Fruit Preserves', 'FP'),
(5, 4, 'Syrup', 'SRP'),
(6, 1, 'Peanuts', 'PNS'),
(7, NULL, 'Box of 6', 'BX');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_sku` varchar(255) DEFAULT NULL,
  `item_barcode` varchar(255) DEFAULT NULL,
  `item_qty` int(11) DEFAULT NULL,
  `item_expiry` date DEFAULT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_sku`, `item_barcode`, `item_qty`, `item_expiry`, `product_sku`, `created_at`) VALUES
(1, 'ITM00001', 'IGWDZX', 5, '2024-05-30', 'SRP00001', '2024-05-10 08:26:11'),
(2, 'ITM00002', 'IGWDZY', 5, '2024-05-30', 'SRP00001', '2024-05-10 08:26:54'),
(3, 'ITM00003', 'IGWDZD', 9, '2024-05-31', 'SRP00002', '2024-05-10 11:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`) VALUES
(6, 'Create Brand'),
(2, 'Create Category'),
(14, 'Create Tax'),
(10, 'Create Unit'),
(8, 'Delete Brand'),
(4, 'Delete Category'),
(16, 'Delete Tax'),
(12, 'Delete Unit'),
(7, 'Edit Brand'),
(3, 'Edit Category'),
(15, 'Edit Tax'),
(11, 'Edit Unit'),
(5, 'Manage Brand'),
(1, 'Manage Category'),
(13, 'Manage Tax'),
(9, 'Manage Unit');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `product_pp` int(11) DEFAULT NULL,
  `product_sp` int(11) DEFAULT NULL,
  `product_min` int(11) DEFAULT NULL,
  `product_max` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `brand_id`, `category_id`, `status_id`, `product_sku`, `product_pp`, `product_sp`, `product_min`, `product_max`, `unit_id`, `tax_id`, `created_at`, `updated_at`) VALUES
(1, 'Red Mongo 340g', 'Red Mongo 340g 12oz', 2, 5, NULL, 'SRP00001', 102, 102, 10, 20, 1, 1, '2024-05-10 07:47:44', '2024-05-21 08:15:35'),
(2, 'Green Kaong 340g', 'Green Kaong 340g 12oz', 2, 5, NULL, 'SRP00002', 102, 110, 10, 20, 1, 1, '2024-05-10 11:52:30', '2024-05-15 11:02:13'),
(3, 'Milo 45', 'milo pawdir', 1, 5, NULL, 'F00001', 15, NULL, 20, 30, 1, 1, '2024-05-14 06:50:52', '2024-05-21 07:32:51'),
(4, 'Ding Dong', 'Mix Nuts 100g', 8, 5, NULL, 'PNS00001', 72, 78, 20, 30, 1, 1, '2024-05-15 07:09:05', '2024-05-21 08:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Purchasing'),
(3, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'In Stock'),
(2, 'Low Stock'),
(3, 'Out of Stock');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(255) DEFAULT NULL,
  `tax_percentage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_name`, `tax_percentage`) VALUES
(1, 'No Tax', 0),
(2, '1% Tax', 1),
(3, '3% Tax', 3),
(4, '5% Tax', 5),
(5, '10% Tax', 10),
(6, '4% Tax', 4);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_type` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_type`, `short_name`) VALUES
(1, 'Pieces', 'pcs'),
(2, 'Set', 'set'),
(3, 'Pack', 'pks'),
(4, 'Box', 'bx'),
(5, 'Kilogram', 'kgs'),
(6, 'Ounce', 'oz'),
(7, 'Pair', 'pr'),
(8, 'Slice', 'slc'),
(9, 'Pair', 'pr'),
(10, 'Grams', 'gr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `display_name`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$R0gp0MB5zbbOjnMCF4O1R.xdYTxMnWRMZrD4.Ll2egd1eJBtIXKE2', 'Jerome De Lara', 1, '2024-05-08 12:30:37', '2024-05-21 11:10:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fr_prod_sku` (`product_sku`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fr_brand_id` (`brand_id`),
  ADD KEY `fr_category_id` (`category_id`),
  ADD KEY `fr_status_id` (`status_id`),
  ADD KEY `fr_unit_id` (`unit_id`),
  ADD KEY `fr_tax_id` (`tax_id`),
  ADD KEY `product_sku` (`product_sku`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `fr_permission` (`permission_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fr_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
