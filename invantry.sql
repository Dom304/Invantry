-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 05:42 AM
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
-- Database: `invantry`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `store_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 11, 3, 1, '2023-11-04 12:27:34', '2023-11-04 12:27:34'),
(2, 3, 11, 6, 1, '2023-11-04 12:27:37', '2023-11-04 12:27:37'),
(3, 2, 11, 3, 1, '2023-11-04 12:34:44', '2023-11-04 12:34:44'),
(4, 2, 11, 3, 1, '2023-11-06 08:53:24', '2023-11-06 08:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `user_id`, `collection_name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Gym Bro', NULL, NULL),
(3, 2, 'Beach Fun Items!', NULL, NULL),
(4, 2, 'School Ready', NULL, NULL),
(5, 2, 'Winter Mountain Getaway', NULL, NULL),
(6, 3, 'Moderator\'s Essentials', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collection_items`
--

CREATE TABLE `collection_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collection_items`
--

INSERT INTO `collection_items` (`id`, `collection_id`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 5, 5, NULL, NULL),
(3, 6, 4, NULL, NULL),
(4, 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_quantity` bigint(20) UNSIGNED NOT NULL,
  `item_price` double(15,2) NOT NULL,
  `item_logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `store_id`, `item_name`, `item_description`, `item_quantity`, `item_price`, `item_logo`, `created_at`, `updated_at`) VALUES
(1, 11, 'Television', '65in screen', 1, 699.99, '', NULL, NULL),
(3, 11, 'Apple Airpods', 'Listen to music!', 1, 99.99, '', NULL, NULL),
(4, 11, 'Refrigerator', '2 Doors!', 1, 1299.49, '', NULL, NULL),
(5, 11, 'GTA 5 Videogame', 'Rated M for mature', 1, 69.99, '', NULL, NULL),
(6, 11, 'Laptop', 'Lenovo, 13in screen', 1, 429.99, '', NULL, NULL),
(7, 11, 'Iphone 15 Pro Case', 'Protect your phone', 1, 39.29, '', NULL, NULL),
(8, 11, 'Samsung S23 Ultra case', 'Protect your phone', 1, 39.29, '', NULL, NULL),
(9, 11, 'Call Of Duty Videogame', 'Rated M for mature', 1, 69.99, '', NULL, NULL),
(10, 10, 'Nike Sweatshirt', 'Keeps you warm', 1, 89.99, '', NULL, NULL),
(11, 10, 'Nike Tracksuit', 'Available in several colors', 1, 129.99, '', NULL, NULL),
(12, 10, 'Under Armour Joggers', 'Nice and cozy', 1, 39.19, '', NULL, NULL),
(13, 10, 'Hollister 3-Pack T-Shirts', 'Variety pack', 1, 43.99, '', NULL, NULL),
(14, 10, 'Denim Jeans', 'For all occasions', 20, 79.00, '', NULL, NULL),
(15, 10, 'Graphic Button-Up Shirt', 'Ready to party', 1, 19.29, '', NULL, NULL),
(16, 10, 'Designer Pants', 'Very expensive', 1, 229.29, '', NULL, NULL),
(17, 10, 'North Face Windbreaker', 'Good for cold and stormy nights', 1, 55.35, '', NULL, NULL),
(18, 12, 'Refrigerator', '2 Doors!', 1, 1349.49, '', NULL, NULL),
(19, 12, 'Can Of Paint', 'Pick out your color today', 1, 10.49, '', NULL, NULL),
(20, 12, 'Outdoor Gas Grill', 'Use for your next cookout', 1, 255.49, '', NULL, NULL),
(21, 12, 'Box Of Nails', 'Very durable', 1, 7.99, '', NULL, NULL),
(22, 12, 'Riding Lawnmower', 'Make yard days easier', 1, 379.99, '', NULL, NULL),
(23, 12, 'Power Drill', 'Build stuff quickly', 1, 88.29, '', NULL, NULL),
(24, 12, 'Box Of Screws', 'Works well with power drill', 1, 8.99, '', NULL, NULL),
(25, 12, 'Box Of LED Bulbs', 'Very bright', 1, 10.35, '', NULL, NULL),
(26, 13, 'Television', '65in screen', 1, 659.99, '', NULL, NULL),
(27, 13, 'GTA 5 Videogame', 'Rated M for mature', 1, 65.99, '', NULL, NULL),
(28, 13, 'Nike Tracksuit', 'Available in several colors', 1, 119.49, '', NULL, NULL),
(29, 13, 'Denim Jeans', 'For all occasions', 25, 99.00, '', NULL, NULL),
(30, 13, 'North Face Windbreaker', 'Good for cold and stormy nights', 1, 45.45, '', NULL, NULL),
(31, 13, 'Native Body Wash & Shampoo', 'All natural cleaning product', 1, 15.29, '', NULL, NULL),
(32, 13, 'Monopoly Boardgame', 'Fun with friends or family', 1, 21.49, '', NULL, NULL),
(33, 13, 'Box Of LED Bulbs', 'Very bright', 1, 15.35, '', NULL, NULL),
(34, 14, 'North Face Windbreaker', 'Good for cold and stormy nights', 1, 42.45, '', NULL, NULL),
(35, 14, 'Nike Sweatshirt', 'Keeps you warm', 1, 85.99, '', NULL, NULL),
(36, 14, 'Baseball Bat', 'Home run!', 1, 15.49, '', NULL, NULL),
(37, 14, 'Golf Club Set', 'Full 14 Club Set', 1, 799.00, '', NULL, NULL),
(38, 14, 'Kayak', 'Good in rough waters', 1, 1199.99, '', NULL, NULL),
(39, 14, 'Basketball', 'Full sized', 1, 21.79, '', NULL, NULL),
(40, 14, 'Baseball Pack', 'Pack of 3 baseballs', 1, 11.99, '', NULL, NULL),
(41, 14, 'Box Of Golf Balls', 'Works well with golf clubs', 1, 35.55, '', NULL, NULL),
(42, 15, 'Sour Patch Kids', '5lb Bag', 1, 5.00, '', NULL, NULL),
(43, 15, 'Pack Of Gum', 'Long lasting flavor', 1, 1.50, '', NULL, NULL),
(44, 15, 'Bouncy Ball', 'Fun to throw around', 1, 0.99, '', NULL, NULL),
(45, 15, 'Plushy', 'Very soft to squeeze', 1, 4.00, '', NULL, NULL),
(46, 15, 'Flip Flops', 'Good for a nice pool day', 1, 5.00, '', NULL, NULL),
(47, 15, 'Sticker Pack', 'Multiple different designs', 1, 2.00, '', NULL, NULL),
(48, 15, 'Baseball Hat', 'Stylish', 1, 4.00, '', NULL, NULL),
(49, 15, 'Frisbee', 'Throw around with friends', 1, 2.50, '', NULL, NULL),
(50, 16, 'Fake Blood', 'Used for makeup only', 1, 7.99, '', NULL, NULL),
(51, 16, 'Fake Knife', 'Used for costumes', 1, 3.59, '', NULL, NULL),
(52, 16, 'Fairy Costume', 'For small children', 1, 30.99, '', NULL, NULL),
(53, 16, 'Zombie Mackup Kit', 'Makes you look like the undead', 1, 15.50, '', NULL, NULL),
(54, 16, 'Outdoor Witch Decoration', 'Make your front yard skoopy', 1, 129.99, '', NULL, NULL),
(55, 16, 'Halloween Sticker Pack', 'Sppoky sticker', 1, 5.00, '', NULL, NULL),
(56, 16, 'Michael Myers Mask', 'Costume mask', 1, 22.39, '', NULL, NULL),
(57, 16, 'Bloody White Shirt', 'Can be used for multiple costumes', 1, 8.99, '', NULL, NULL),
(58, 17, 'North Face Windbreaker', 'Good for cold and stormy nights', 1, 58.35, '', NULL, NULL),
(59, 17, 'Bike Helmet', 'Used for protection when riding', 1, 29.49, '', NULL, NULL),
(60, 17, 'Kayak', 'Good in rough waters', 1, 1159.99, '', NULL, NULL),
(61, 17, 'Mountain Bike', 'Good for offroad adventures', 1, 399.00, '', NULL, NULL),
(62, 17, 'Sports Bike', 'Made with an 8 speed gear', 1, 259.99, '', NULL, NULL),
(63, 17, 'Nike Sweatshirt', 'Keeps you warm', 1, 69.99, '', NULL, NULL),
(64, 17, 'Lawn Chair', 'Comfy outdoor seating', 1, 30.39, '', NULL, NULL),
(65, 17, 'Multi-Purpose Utility Knife', 'Comes with several tools', 1, 109.99, '', NULL, NULL),
(66, 18, 'Can Of Paint', 'Pick out your color today', 1, 11.49, '', NULL, NULL),
(67, 18, 'Power Drill', 'Build stuff quickly', 1, 91.29, '', NULL, NULL),
(68, 18, 'Box Of Screws', 'Works well with power drill', 1, 9.59, '', NULL, NULL),
(69, 18, 'Box Of LED Bulbs', 'Very bright', 1, 16.55, '', NULL, NULL),
(70, 18, 'Box Of Nails', 'Very durable', 1, 8.59, '', NULL, NULL),
(71, 18, 'Hammer', 'Used to put nails into wood', 1, 20.99, '', NULL, NULL),
(72, 18, 'Lawn Chair', 'Comfy outdoor seating', 1, 35.39, '', NULL, NULL),
(73, 18, 'Utility Light', 'Bright light for lighting up work spaces', 1, 84.99, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manager_request`
--

CREATE TABLE `manager_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manager_request`
--

INSERT INTO `manager_request` (`id`, `user_id`, `store_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'Home Depot', 'Hardware Store', '2023-11-04 00:03:12', '2023-11-04 00:03:12');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_02_020533_create_store_table', 1),
(6, '2023_10_02_020549_create_items_table', 1),
(7, '2023_10_02_020624_create_collections_table', 1),
(8, '2023_10_02_053618_create_collection_items_table', 1),
(9, '2023_10_31_174859_create_cart_table', 1),
(10, '2023_10_31_222208_[create_store_table]', 1),
(11, '2023_10_31_230609_[create_store_table]', 1),
(12, '2023_10_31_231300_[create_users_table]', 1),
(13, '2023_11_03_190449_create_manager_request_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_description` varchar(255) NOT NULL,
  `store_logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `manager_id`, `store_name`, `store_description`, `store_logo`, `created_at`, `updated_at`) VALUES
(10, 4, 'Droegemeier Drip', 'Modern clothing store with the best drip', '', NULL, NULL),
(11, 4, 'Best Buy', 'Electronic store with all your technology essentials', '../images/store-logos/BestBuy-logo.png', NULL, NULL),
(12, 4, 'Lowe\'s', 'Hardware and renovations store', '../images/store-logos/Lowes-logo.png', NULL, NULL),
(13, 4, 'Target', 'Modern multi-purpose store', '../images/store-logos/Target-logo.png', NULL, NULL),
(14, 4, 'Dick\'s', 'Sporting goods store', '../images/store-logos/Dicks-Sporting-Goods-logo.png', NULL, NULL),
(15, 4, 'Five & Below', 'Store where everything is $5 or less', '../images/store-logos/Five-Below-logo.png', NULL, NULL),
(16, 4, 'Spirit Halloween', 'Seasonal store full of spooky surprises', '../images/store-logos/Spirit-Halloween-logo.png', '0000-00-00 00:00:00', NULL),
(17, 4, 'Get Outside', 'Outdoor Bike shop', '../images/store-logos/GetOutside-logo.png', NULL, NULL),
(18, 4, 'Hector\'s Hardware', 'Hardware store with all essentials for building structures', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'buyer',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'admin', 'admin@gmail.com', NULL, '$2y$10$0HDa3DFTm0tGT0K9uN.LvOnMULF5fm2KIzrb/5gVSoGEX849WjjLW', NULL, '2023-10-20 01:49:15', '2023-11-01 04:13:06'),
(2, 'BUYER', 'buyer', 'buyer@gmail.com', NULL, '$2y$10$thxHunu.3M9KgYHJs5bV/OdI5iJSsWogExlC4qkzNNw0fT1tzDHj2', NULL, '2023-10-20 02:31:26', '2023-10-20 02:31:26'),
(3, 'MODERATOR', 'moderator', 'moderator@gmail.com', NULL, '$2y$10$F/auRIGbf5HsfHP7hLHAAuG3pEGd2645UqFzGRp75MsH3sTX40eYa', NULL, '2023-11-01 04:35:58', '2023-11-01 04:36:09'),
(4, 'MANAGER', 'manager', 'manager@gmail.com', NULL, '$2y$10$9OatfcMJSszli/kNUqXpDuBwlsk/E1w3Jij6wHR2dxOGsJsvFqENW', NULL, '2023-11-01 04:36:54', '2023-11-01 04:37:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_store_id_foreign` (`store_id`),
  ADD KEY `carts_item_id_foreign` (`item_id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collections_user_id_index` (`user_id`);

--
-- Indexes for table `collection_items`
--
ALTER TABLE `collection_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_items_collection_id_index` (`collection_id`),
  ADD KEY `collection_items_item_id_index` (`item_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_store_id_index` (`store_id`);

--
-- Indexes for table `manager_request`
--
ALTER TABLE `manager_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_request_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_manager_id_index` (`manager_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `collection_items`
--
ALTER TABLE `collection_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `manager_request`
--
ALTER TABLE `manager_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `carts_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collection_items`
--
ALTER TABLE `collection_items`
  ADD CONSTRAINT `collection_items_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collection_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `manager_request`
--
ALTER TABLE `manager_request`
  ADD CONSTRAINT `manager_request_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
