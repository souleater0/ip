-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 02:03 PM
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
-- Database: `ordersystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(9, 'PULUTAN  PALOOZA', '2024-06-21 08:40:31', NULL),
(10, 'BARKADA BEER TOWER', '2024-06-21 09:53:07', NULL),
(11, 'Beer Bucket', '2024-06-21 09:56:17', NULL),
(12, 'BILAO SET', '2024-06-21 09:59:26', NULL),
(13, 'Grill ala Carte', '2024-06-21 10:01:27', NULL),
(14, 'RICE', '2024-06-21 10:21:53', NULL),
(15, 'Juice Tower', '2024-06-21 10:23:10', NULL),
(16, 'JUICE', '2024-06-21 10:32:32', NULL),
(17, 'LIQUORS', '2024-06-21 10:35:39', NULL),
(18, 'Palayok Bundle', '2024-06-21 11:38:43', NULL),
(19, 'Putok-batok Bundle', '2024-06-21 11:49:47', NULL),
(20, 'Tower Combo', '2024-06-21 11:58:18', NULL),
(21, 'BEST SELLER', '2024-06-21 12:02:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_canceled`
--

CREATE TABLE `customer_canceled` (
  `order_no` int(11) NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_complete`
--

CREATE TABLE `customer_complete` (
  `order_no` int(11) NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE `customer_detail` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(11) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedback`
--

CREATE TABLE `customer_feedback` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_contact` varchar(11) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_rate` int(11) DEFAULT NULL,
  `customer_remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_feedback`
--

INSERT INTO `customer_feedback` (`id`, `customer_name`, `customer_contact`, `customer_email`, `customer_rate`, `customer_remarks`, `created_at`) VALUES
(1, 'Jerome De Lara', NULL, NULL, 10, 'Good Job', '2024-06-04 17:18:47'),
(2, 'jerome', '09608504726', 'ecxdev03@gmail.com', 5, '5', '2024-07-03 04:16:11'),
(3, 'jerome', '09608504726', 'ecxdev03@gmail.com', 5, '5', '2024-07-03 04:17:43'),
(4, 'jerome', '09608504726', 'ecxdev03@gmail.com', 5, 'aw', '2024-07-03 04:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `order_no` int(11) NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_no`, `table_no`, `customer_name`, `created_at`) VALUES
(1, 5, 'jerome de lara', '2024-07-01 03:21:31'),
(2, 1, 'jerome', '2024-07-03 08:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer_process`
--

CREATE TABLE `customer_process` (
  `order_no` int(11) NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_serve`
--

CREATE TABLE `customer_serve` (
  `order_no` int(11) NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_description` varchar(255) DEFAULT NULL,
  `menu_img` varchar(255) DEFAULT 'default.png',
  `category_id` int(11) NOT NULL,
  `isEnabled` tinyint(1) DEFAULT 1,
  `isArchive` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `menu_description`, `menu_img`, `category_id`, `isEnabled`, `isArchive`, `created_at`, `updated_at`) VALUES
(16, 'Isaw Manok', '1pc Chicken\r\n1pc Regular Rice', 'food1.png', 13, 1, 0, '2024-06-14 07:05:41', '2024-07-02 10:58:45'),
(21, 'Sizzling Sisig', NULL, 'default.png', 9, 1, 0, '2024-06-21 08:41:45', NULL),
(22, 'Sizzling Hotdog', NULL, 'default.png', 9, 1, 0, '2024-06-21 09:00:54', NULL),
(24, 'Chicken Skin', NULL, 'default.png', 9, 1, 0, '2024-06-21 09:47:49', NULL),
(25, 'Special Dinakdakan', NULL, 'default.png', 9, 1, 0, '2024-06-21 09:48:47', NULL),
(27, 'Lechon kawali', NULL, 'default.png', 9, 1, 0, '2024-06-21 09:49:18', NULL),
(29, 'Dynamite', NULL, 'default.png', 9, 1, 0, '2024-06-21 09:50:21', NULL),
(30, 'Spicy Gambas', NULL, 'default.png', 9, 1, 0, '2024-06-21 09:50:38', NULL),
(32, 'Barkada Beer Tower B', NULL, 'default.png', 10, 1, 0, '2024-06-21 09:54:23', NULL),
(33, 'Barkada Beer Tower C', NULL, 'default.png', 10, 1, 0, '2024-06-21 09:54:43', NULL),
(34, 'Barkada Beer Tower D', NULL, 'default.png', 10, 1, 0, '2024-06-21 09:55:04', NULL),
(35, 'Bucket 1', NULL, 'default.png', 11, 1, 0, '2024-06-21 09:56:52', NULL),
(36, 'Bucket 2', NULL, 'default.png', 11, 1, 0, '2024-06-21 09:57:11', NULL),
(37, 'Bucket 3', NULL, 'default.png', 11, 1, 0, '2024-06-21 09:57:50', NULL),
(38, 'Bucket 4', NULL, 'default.png', 11, 1, 0, '2024-06-21 09:58:19', NULL),
(39, 'Bucket 5', NULL, 'default.png', 11, 1, 0, '2024-06-21 09:58:54', NULL),
(40, 'Bilao A', '1 INASAL LEG QUARTER\r\n1 GRILLED LIEMPO\r\n1 ITLOG NA PULA\r\n1 ENSALADANG TALONG\r\n2 STICKS OF INIHAW OF YOUR CHOICE\r\n3 RICE', 'default.png', 12, 1, 0, '2024-06-21 09:59:56', '2024-06-24 11:53:09'),
(41, 'Bilao B', NULL, 'default.png', 12, 1, 0, '2024-06-21 10:00:25', NULL),
(42, 'Bilao C', NULL, 'default.png', 12, 1, 0, '2024-06-21 10:00:45', NULL),
(43, 'Isaw Baboy', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:04:55', NULL),
(44, 'Barbeque', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:05:16', NULL),
(45, 'Hotdog', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:05:35', NULL),
(46, 'Bulaklak', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:05:55', NULL),
(47, 'Tenga', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:06:11', NULL),
(48, 'Tumbong ', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:06:29', NULL),
(49, 'Tokong', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:06:43', NULL),
(50, 'Rice', NULL, 'default.png', 13, 1, 0, '2024-06-21 10:06:56', NULL),
(51, 'PLAIN RICE', NULL, 'default.png', 14, 1, 0, '2024-06-21 10:22:19', NULL),
(52, 'JUICE Tower 1', NULL, 'default.png', 15, 1, 0, '2024-06-21 10:23:39', NULL),
(53, 'JUICE Tower 2', NULL, 'default.png', 15, 1, 0, '2024-06-21 10:24:03', NULL),
(54, 'JUICE Tower 3', NULL, 'default.png', 15, 1, 0, '2024-06-21 10:24:18', NULL),
(55, 'Household Blend Iced Tea ', NULL, 'default.png', 16, 1, 0, '2024-06-21 10:32:55', NULL),
(56, 'Pink Lemonade ', NULL, 'default.png', 16, 1, 0, '2024-06-21 10:33:22', NULL),
(57, 'Blue Lemonade', NULL, 'default.png', 16, 1, 0, '2024-06-21 10:33:40', NULL),
(58, 'Red Iced Tea ', NULL, 'default.png', 16, 1, 0, '2024-06-21 10:34:27', NULL),
(59, 'Cucumber', NULL, 'default.png', 16, 1, 0, '2024-06-21 10:34:46', NULL),
(60, 'Gulaman ', NULL, 'default.png', 16, 1, 0, '2024-06-21 10:35:08', NULL),
(61, 'San Mig Light', NULL, 'default.png', 17, 1, 0, '2024-06-21 11:35:02', NULL),
(62, 'San Mig Flavored', NULL, 'default.png', 17, 1, 0, '2024-06-21 11:35:16', NULL),
(63, 'Original Pale Pilsen', NULL, 'default.png', 17, 1, 0, '2024-06-21 11:35:35', NULL),
(64, 'Pale Pilsen (long neck)', NULL, 'default.png', 17, 1, 0, '2024-06-21 11:36:50', NULL),
(65, 'Red Horse (500ml)', NULL, 'default.png', 17, 1, 0, '2024-06-21 11:37:20', NULL),
(66, 'Tinolang Native Manok', NULL, 'default.png', 18, 1, 0, '2024-06-21 11:39:17', NULL),
(67, 'Sinigang na Hipon', NULL, 'default.png', 18, 1, 0, '2024-06-21 11:39:36', NULL),
(68, 'Kare-Kareng Bagnet', NULL, 'default.png', 18, 1, 0, '2024-06-21 11:39:59', NULL),
(69, 'Bulalo', NULL, 'default.png', 18, 1, 0, '2024-06-21 11:40:14', NULL),
(70, 'Set A', NULL, 'default.png', 19, 1, 0, '2024-06-21 11:50:08', NULL),
(71, 'Set B', NULL, 'default.png', 19, 1, 0, '2024-06-21 11:50:35', NULL),
(72, 'Set C', NULL, 'default.png', 19, 1, 0, '2024-06-21 11:50:54', NULL),
(73, 'Grilled Tilapia', NULL, 'default.png', 13, 1, 0, '2024-06-21 11:52:43', NULL),
(74, 'Chicharong Bulaklak', NULL, 'default.png', 13, 1, 0, '2024-06-21 11:53:00', NULL),
(75, 'Grilled Bangus', NULL, 'default.png', 13, 1, 0, '2024-06-21 11:54:46', NULL),
(76, 'Grilled Pusit', NULL, 'default.png', 13, 1, 0, '2024-06-21 11:55:52', NULL),
(77, 'Crispy Pata', NULL, 'default.png', 13, 1, 0, '2024-06-21 11:57:01', NULL),
(78, 'Tower Combo 1', NULL, 'default.png', 20, 1, 0, '2024-06-21 11:59:14', NULL),
(79, 'Tower Combo 2', NULL, 'default.png', 20, 1, 0, '2024-06-21 11:59:29', NULL),
(80, 'Tower Combo 3', NULL, 'default.png', 20, 1, 0, '2024-06-21 11:59:46', NULL),
(81, 'Tower Combo 4', NULL, 'default.png', 20, 1, 0, '2024-06-21 12:00:20', NULL),
(82, 'Chicken Inasal + Rice', NULL, 'default.png', 21, 1, 0, '2024-06-21 12:05:02', NULL),
(83, 'Inihaw na liempo', NULL, 'default.png', 21, 1, 0, '2024-06-21 12:10:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_variations`
--

CREATE TABLE `menu_variations` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_variations`
--

INSERT INTO `menu_variations` (`id`, `menu_id`, `variation_id`, `price`) VALUES
(6, 16, 4, 25.00),
(11, 21, 4, 199.00),
(12, 22, 4, 199.00),
(14, 24, 4, 199.00),
(17, 27, 4, 199.00),
(18, 25, 4, 199.00),
(20, 29, 4, 199.00),
(22, 32, 4, 569.00),
(23, 33, 4, 539.00),
(24, 34, 4, 599.00),
(25, 30, 4, 199.00),
(26, 35, 4, 459.00),
(27, 36, 1, 519.00),
(28, 37, 1, 489.00),
(29, 38, 4, 549.00),
(30, 39, 4, 499.00),
(31, 40, 4, 359.00),
(32, 41, 4, 889.00),
(33, 42, 4, 1439.00),
(34, 43, 4, 30.00),
(35, 44, 4, 30.00),
(36, 45, 4, 25.00),
(37, 46, 4, 30.00),
(38, 47, 4, 30.00),
(39, 48, 4, 30.00),
(40, 49, 4, 25.00),
(41, 50, 4, 15.00),
(42, 51, 4, 15.00),
(43, 52, 4, 99.00),
(44, 53, 4, 120.00),
(45, 54, 4, 150.00),
(46, 55, 5, 30.00),
(47, 55, 6, 80.00),
(48, 56, 5, 30.00),
(49, 56, 6, 80.00),
(50, 57, 5, 30.00),
(51, 57, 6, 80.00),
(52, 58, 5, 30.00),
(53, 58, 6, 80.00),
(54, 59, 5, 30.00),
(55, 59, 6, 80.00),
(56, 60, 5, 30.00),
(57, 60, 6, 80.00),
(58, 61, 4, 55.00),
(59, 62, 4, 55.00),
(60, 63, 4, 60.00),
(61, 64, 4, 65.00),
(62, 65, 4, 70.00),
(63, 66, 4, 299.00),
(64, 67, 4, 349.00),
(65, 68, 4, 299.00),
(66, 69, 4, 349.00),
(67, 70, 4, 299.00),
(68, 71, 4, 359.00),
(69, 72, 4, 459.00),
(70, 73, 4, 80.00),
(71, 74, 4, 250.00),
(72, 75, 4, 169.00),
(73, 76, 1, 99.00),
(74, 76, 2, 149.00),
(75, 76, 3, 199.00),
(76, 77, 4, 599.00),
(77, 78, 4, 150.00),
(78, 79, 4, 199.00),
(79, 80, 4, 250.00),
(80, 81, 4, 350.00),
(81, 82, 4, 99.00),
(82, 82, 7, 139.00),
(83, 83, 4, 120.00),
(84, 83, 7, 160.00);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_menu`
--

CREATE TABLE `ordered_menu` (
  `id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered_menu`
--

INSERT INTO `ordered_menu` (`id`, `order_no`, `menu_id`, `variation_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 16, 4, 1, 25.00, '2024-07-01 03:21:31', NULL),
(2, 1, 82, 4, 1, 99.00, '2024-07-01 03:21:31', NULL),
(3, 1, 51, 4, 2, 15.00, '2024-07-01 03:21:31', NULL),
(4, 2, 16, 4, 1, 25.00, '2024-07-03 08:39:09', NULL);

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
(2, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `id` int(11) NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `is_occupied` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`id`, `table_no`, `is_occupied`, `updated_at`) VALUES
(1, 1, 1, '2024-06-06 04:37:21'),
(2, 2, 0, NULL),
(3, 3, 0, NULL),
(4, 4, 0, NULL),
(5, 5, 0, NULL),
(6, 6, 0, NULL),
(7, 7, 0, NULL),
(8, 8, 0, NULL);

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
(3, 'jhondell', '$2y$10$JRSUatHPUFuxnBTk2t1PzeHke3itwMQXgGiKJrvWT.55bKynetknq', 'Jhondell', 2, 1, '2024-05-22 07:11:58', '2024-05-24 03:50:30'),
(4, 'test', '$2y$10$F9iTNImdi7zYnh7Isqzy8uPGaj2akWWtxOErWQxKrC4VpHCxGQeBW', 'test', 1, 1, '2024-06-10 12:52:00', '2024-06-10 12:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` int(11) NOT NULL,
  `variation_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `variation_name`, `created_at`, `updated_at`) VALUES
(1, 'Large', '2024-06-14 06:26:44', '2024-06-14 06:32:37'),
(2, 'Extra Large', '2024-06-14 06:32:43', '2024-06-14 06:33:23'),
(3, '2X Extra Large', '2024-06-14 06:32:50', '2024-06-14 06:34:26'),
(4, 'Regular', '2024-06-14 07:38:21', '2024-06-14 07:38:21'),
(5, '16 OZ', '2024-06-21 10:31:38', NULL),
(6, 'PITCHER', '2024-06-21 10:31:45', NULL),
(7, '+40 UNLI RICE', '2024-06-21 12:03:19', '2024-06-21 12:08:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer_canceled`
--
ALTER TABLE `customer_canceled`
  ADD PRIMARY KEY (`order_no`) USING BTREE;

--
-- Indexes for table `customer_complete`
--
ALTER TABLE `customer_complete`
  ADD PRIMARY KEY (`order_no`) USING BTREE;

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_no`) USING BTREE;

--
-- Indexes for table `customer_process`
--
ALTER TABLE `customer_process`
  ADD PRIMARY KEY (`order_no`) USING BTREE;

--
-- Indexes for table `customer_serve`
--
ALTER TABLE `customer_serve`
  ADD PRIMARY KEY (`order_no`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_category` (`category_id`);

--
-- Indexes for table `menu_variations`
--
ALTER TABLE `menu_variations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_menu_variation` (`menu_id`,`variation_id`),
  ADD KEY `fr_variation_id` (`variation_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `ordered_menu`
--
ALTER TABLE `ordered_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_order_no` (`order_no`),
  ADD KEY `fr_menu_idss` (`menu_id`),
  ADD KEY `fr_variation_idss` (`variation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_role` (`role_id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_canceled`
--
ALTER TABLE `customer_canceled`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_complete`
--
ALTER TABLE `customer_complete`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_detail`
--
ALTER TABLE `customer_detail`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_process`
--
ALTER TABLE `customer_process`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_serve`
--
ALTER TABLE `customer_serve`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `menu_variations`
--
ALTER TABLE `menu_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `ordered_menu`
--
ALTER TABLE `ordered_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fr_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_variations`
--
ALTER TABLE `menu_variations`
  ADD CONSTRAINT `fr_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fr_variation_id` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ordered_menu`
--
ALTER TABLE `ordered_menu`
  ADD CONSTRAINT `fr_menu_idss` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fr_variation_idss` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
