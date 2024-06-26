-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 02:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

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
(1, 'ITM00001', 'MLWITK', 5, '2026-05-05', 'F00001', '2024-06-26 04:04:45'),
(2, 'ITM00002', 'MLWITL', 20, '2026-02-05', 'F00001', '2024-06-26 04:10:06'),
(3, 'ITM00003', 'NCHDWHDG', 10, '2027-01-08', 'SRP00001', '2024-06-26 04:40:54'),
(4, 'ITM00004', 'NCHDWHDF', 5, '2028-05-05', 'SRP00001', '2024-06-26 04:41:53'),
(5, 'ITM00005', 'NCHDWHDC', 5, '2027-05-05', 'SRP00001', '2024-06-26 04:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `description`) VALUES
(1, 'Dashboard Management', NULL),
(2, 'Product Management', NULL),
(3, 'Category Management', NULL),
(4, 'Brand Management', NULL),
(5, 'Unit Management', NULL),
(6, 'Tax Management', NULL),
(7, 'Stock In Management', NULL),
(8, 'Stock Out Management', NULL),
(9, 'Pending Inventory', NULL),
(10, 'Costing Management', NULL),
(11, 'User Management', NULL),
(12, 'Role Management', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pending_item`
--

CREATE TABLE `pending_item` (
  `id` int(11) NOT NULL,
  `series_number` varchar(255) DEFAULT NULL,
  `item_sku` varchar(255) DEFAULT NULL,
  `item_barcode` varchar(255) DEFAULT NULL,
  `item_qty` int(11) DEFAULT NULL,
  `item_expiry` date DEFAULT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_item`
--

INSERT INTO `pending_item` (`id`, `series_number`, `item_sku`, `item_barcode`, `item_qty`, `item_expiry`, `product_sku`, `created_at`) VALUES
(1, 'STK_IN00001', NULL, 'MLWITK', 5, '2026-05-05', 'F00001', '2024-06-26 04:04:45'),
(2, 'STK_IN00002', NULL, 'MLWITL', 20, '2026-02-05', 'F00001', '2024-06-26 04:10:06'),
(3, 'STK_IN00003', NULL, 'MLWITC', 20, '2027-05-20', 'F00001', '2024-06-26 04:10:23'),
(4, 'STK_IN00004', NULL, 'NCHDWHDG', 10, '2027-01-08', 'SRP00001', '2024-06-26 04:40:54'),
(5, 'STK_IN00005', NULL, 'NCHDWHDF', 5, '2028-05-05', 'SRP00001', '2024-06-26 04:41:53'),
(6, 'STK_IN00005', NULL, 'NCHDWHDC', 5, '2027-05-05', 'SRP00001', '2024-06-26 04:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `pending_stock_out`
--

CREATE TABLE `pending_stock_out` (
  `id` int(11) NOT NULL,
  `series_number` varchar(255) DEFAULT NULL,
  `item_sku` varchar(255) DEFAULT NULL,
  `item_barcode` varchar(255) DEFAULT NULL,
  `item_qty` int(11) DEFAULT NULL,
  `item_expiry` date DEFAULT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `description`, `module_id`) VALUES
(1, 'Manage Dashboard', 'Manage', 1),
(2, 'Manage Product', 'Manage', 2),
(3, 'View Product', 'View', 2),
(4, 'Create Product', 'Create', 2),
(5, 'Update Product', 'Update', 2),
(6, 'Delete Product', 'Delete', 2),
(7, 'Manage Category', 'Manage', 3),
(8, 'Create Category', 'Create', 3),
(9, 'Update Category', 'Update', 3),
(10, 'Delete Category', 'Delete', 3),
(11, 'Manage Brand', 'Manage', 4),
(12, 'Create Brand', 'Create', 4),
(13, 'Update Brand', 'Update', 4),
(14, 'Delete Brand', 'Delete', 4),
(15, 'Manage Unit', 'Manage', 5),
(16, 'Create Unit', 'Create', 5),
(17, 'Update Unit', 'Update', 5),
(18, 'Delete Unit', 'Delete', 5),
(19, 'Manage Tax', 'Manage', 6),
(20, 'Create Tax', 'Create', 6),
(21, 'Update Tax', 'Update', 6),
(22, 'Delete Tax', 'Delete', 6),
(23, 'Manage Stock In', 'Manage', 7),
(25, 'Create Stock In', 'Create', 7),
(26, 'Update Stock In', 'Update', 7),
(27, 'Delete Stock In', 'Delete', 7),
(28, 'Manage Stock Out', 'Manage', 8),
(29, 'Create Stock Out', 'Create', 8),
(30, 'Update Stock Out', 'Update', 8),
(31, 'Delete Stock Out', 'Delete', 8),
(32, 'Manage Pending Inventory', 'Manage', 9),
(33, 'Create Pending Inventory', 'Create', 9),
(34, 'Update Pending Inventory', 'Update', 9),
(35, 'Delete Pending Inventory', 'Delete', 9),
(36, 'Manage Costing', 'Manage', 10),
(37, 'Create Costing', 'Create', 10),
(38, 'Update Costing', 'Update', 10),
(39, 'Delete Costing', 'Delete', 10),
(40, 'Manage User', 'Manage', 11),
(41, 'Create User', 'Create', 11),
(42, 'Update User', 'Update', 11),
(43, 'Delete User', 'Delete', 11),
(44, 'Manage Role', 'Manage', 12),
(45, 'Create Role', 'Create', 12),
(46, 'Update Role', 'Update', 12),
(47, 'Delete Role', 'Delete', 12);

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
(3, 'Milo 45', 'milo pawdir', 1, 4, NULL, 'F00001', 15, NULL, 20, 30, 1, 1, '2024-05-14 06:50:52', '2024-06-26 11:47:53'),
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

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

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
-- Table structure for table `stockin_history`
--

CREATE TABLE `stockin_history` (
  `id` int(11) NOT NULL,
  `series_number` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `isAdded` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockin_history`
--

INSERT INTO `stockin_history` (`id`, `series_number`, `date`, `isAdded`) VALUES
(1, 'STK_IN00001', '2024-06-26 10:04:45', 1),
(3, 'STK_IN00002', '2024-06-26 10:10:06', 1),
(4, 'STK_IN00003', '2024-06-26 10:10:23', 0),
(5, 'STK_IN00004', '2024-06-26 10:40:54', 1),
(6, 'STK_IN00005', '2024-06-26 10:41:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stockout_history`
--

CREATE TABLE `stockout_history` (
  `id` int(11) NOT NULL,
  `series_number` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `isAdded` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `isEnabled` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `display_name`, `role_id`, `isEnabled`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Yvn5wPKG1D1ovcMe5wM2lemqHaX40cKBJ7ybknP0rtYFkVSYt0MmK', 'Jerome De Lara', 1, 1, '2024-05-08 12:30:37', '2024-05-24 03:49:31'),
(3, 'jhondell', '$2y$10$JRSUatHPUFuxnBTk2t1PzeHke3itwMQXgGiKJrvWT.55bKynetknq', 'Jhondell', 2, 1, '2024-05-22 07:11:58', '2024-05-24 03:50:30');

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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_item`
--
ALTER TABLE `pending_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_series_no` (`series_number`);

--
-- Indexes for table `pending_stock_out`
--
ALTER TABLE `pending_stock_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`),
  ADD KEY `fr_moduleid` (`module_id`);

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
-- Indexes for table `stockin_history`
--
ALTER TABLE `stockin_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_number` (`series_number`);

--
-- Indexes for table `stockout_history`
--
ALTER TABLE `stockout_history`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pending_item`
--
ALTER TABLE `pending_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pending_stock_out`
--
ALTER TABLE `pending_stock_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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
-- AUTO_INCREMENT for table `stockin_history`
--
ALTER TABLE `stockin_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stockout_history`
--
ALTER TABLE `stockout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pending_item`
--
ALTER TABLE `pending_item`
  ADD CONSTRAINT `fr_series_no` FOREIGN KEY (`series_number`) REFERENCES `stockin_history` (`series_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `fr_moduleid` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `fr_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `fr_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fr_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
