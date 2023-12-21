-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 يوليو 2023 الساعة 12:04
-- إصدار الخادم: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- بنية الجدول `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `street_address` varchar(191) NOT NULL,
  `area` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-06-29 23:07:46', '2023-06-29 23:07:46'),
(2, 15, '2023-07-20 15:14:17', '2023-07-20 15:14:17'),
(3, 16, '2023-07-20 15:17:22', '2023-07-20 15:17:22');

-- --------------------------------------------------------

--
-- بنية الجدول `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `variation_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(10, 1, 1, 25000, 1, '2023-06-30 14:17:57', '2023-06-30 14:17:57'),
(11, 1, 2, 30000, 1, '2023-06-30 14:18:10', '2023-06-30 14:18:10'),
(13, 2, 10, 25000, 1, '2023-07-20 19:07:47', '2023-07-20 19:07:47'),
(14, 2, 1, 25000, 2, '2023-07-22 11:33:16', '2023-07-22 11:33:16');

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Man', '2023-06-29 22:20:39', '2023-06-29 22:21:31'),
(2, NULL, 'Woman', '2023-06-29 22:21:54', '2023-06-29 22:21:54'),
(3, NULL, 'Baby', '2023-06-29 22:22:39', '2023-06-29 22:22:39');

-- --------------------------------------------------------

--
-- بنية الجدول `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `hex_code` varchar(7) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `colors`
--

INSERT INTO `colors` (`id`, `name`, `hex_code`, `created_at`, `updated_at`) VALUES
(1, 'RED', '#FF0000', NULL, NULL),
(2, 'GREEN', '#00FF00', NULL, NULL),
(3, 'BLUE', '#0000FF', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `delivery_orders`
--

CREATE TABLE `delivery_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_driver_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `order_id`, `delivery_driver_id`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, 12, 4, '2023-07-22 18:52:26', '2023-07-22 18:52:26', '2023-07-22 18:52:26');

-- --------------------------------------------------------

--
-- بنية الجدول `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2010_05_13_123030_create_categories_table', 1),
(2, '2011_05_13_123012_create_products_table', 1),
(3, '2012_05_13_123130_create_colors_table', 1),
(4, '2012_05_14_123111_create_variations_table', 1),
(5, '2013_05_13_120826_create_roles_table', 1),
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_04_13_141144_create_order_addresses_table', 1),
(11, '2023_05_13_120843_create_carts_table', 1),
(12, '2023_05_13_120901_create_cart_items_table', 1),
(13, '2023_05_13_120924_create_orders_table', 1),
(14, '2023_05_13_120944_create_order_items_table', 1),
(15, '2023_05_13_122904_create_reviews_table', 1),
(16, '2023_05_13_122942_create_discounts_table', 1),
(17, '2023_05_13_123149_create_wish_lists_table', 1),
(18, '2023_05_13_123204_create_wish_list_items_table', 1),
(19, '2023_05_13_123322_create_payment_methods_table', 1),
(20, '2023_05_13_141002_create_addresses_table', 1),
(21, '2023_05_15_125245_create_images_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_address_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` double UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_address_id`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(12, 15, 12, 80000, 'processing', '2023-07-22 07:02:02', '2023-07-22 19:23:27'),
(11, 15, 11, 80000, 'pending', '2023-07-21 05:49:24', '2023-07-21 05:49:24'),
(13, 15, 13, 80000, 'pending', '2023-07-22 07:09:11', '2023-07-22 07:09:11'),
(14, 15, 14, 80000, 'pending', '2023-07-22 07:39:11', '2023-07-22 07:39:11'),
(15, 15, 15, 80000, 'pending', '2023-07-22 07:47:52', '2023-07-22 07:47:52'),
(16, 15, 16, 80000, 'pending', '2023-07-22 07:51:18', '2023-07-22 07:51:18'),
(17, 15, 17, 80000, 'pending', '2023-07-22 08:13:35', '2023-07-22 08:13:35'),
(18, 15, 18, 80000, 'pending', '2023-07-22 08:21:47', '2023-07-22 08:21:47'),
(19, 15, 19, 80000, 'pending', '2023-07-22 08:26:22', '2023-07-22 08:26:22'),
(20, 15, 20, 80000, 'pending', '2023-07-22 08:40:49', '2023-07-22 08:40:49'),
(21, 15, 21, 3090, 'pending', '2023-07-22 13:24:53', '2023-07-22 13:24:53');

-- --------------------------------------------------------

--
-- بنية الجدول `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street_address` varchar(191) NOT NULL,
  `area` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_addresses`
--

INSERT INTO `order_addresses` (`id`, `street_address`, `area`, `city`, `created_at`, `updated_at`) VALUES
(11, 'damascase', 'midalest', 'damascase', '2023-07-21 05:49:24', '2023-07-21 05:49:24'),
(12, 'barza', 'barza', 'Damascase', '2023-07-22 07:02:02', '2023-07-22 07:02:02'),
(13, 'barza', 'barza', 'Damascase', '2023-07-22 07:09:11', '2023-07-22 07:09:11'),
(14, 'barza', 'midalest', 'Stockholm', '2023-07-22 07:39:11', '2023-07-22 07:39:11'),
(15, 'barza', 'midalest', 'Stockholm', '2023-07-22 07:47:52', '2023-07-22 07:47:52'),
(16, 'damascase', 'barza', 'damascase', '2023-07-22 07:51:18', '2023-07-22 07:51:18'),
(17, 'barza', 'barza', 'damascase', '2023-07-22 08:13:35', '2023-07-22 08:13:35'),
(18, 'damascase', 'midalest', 'Stockholm', '2023-07-22 08:21:47', '2023-07-22 08:21:47'),
(19, 'damascase', 'midalest', 'damascase', '2023-07-22 08:26:22', '2023-07-22 08:26:22'),
(20, 'damascase', 'midalest', 'damascase', '2023-07-22 08:40:49', '2023-07-22 08:40:49'),
(21, 'damascase', 'midalest', 'Stockholm', '2023-07-22 13:24:53', '2023-07-22 13:24:53'),
(22, 'inkel', 'inlkel', 'inkehl', '2023-07-22 13:26:50', '2023-07-22 13:26:50'),
(23, '1', '1', '1', '2023-07-22 13:27:43', '2023-07-22 13:27:43'),
(24, '1', '1', '1', '2023-07-22 13:35:52', '2023-07-22 13:35:52'),
(25, '1', '1', '1', '2023-07-22 13:36:44', '2023-07-22 13:36:44');

-- --------------------------------------------------------

--
-- بنية الجدول `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `total_price` double UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_items`
--

INSERT INTO `order_items` (`id`, `variation_id`, `order_id`, `price`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 25000, 1, 25000, '2023-07-21 05:49:24', '2023-07-21 05:49:24'),
(2, 2, 11, 30000, 1, 30000, '2023-07-21 05:49:24', '2023-07-21 05:49:24'),
(3, 10, 11, 25000, 1, 25000, '2023-07-21 05:49:24', '2023-07-21 05:49:24'),
(4, 1, 12, 25000, 1, 25000, '2023-07-22 07:02:02', '2023-07-22 07:02:02'),
(5, 2, 12, 30000, 1, 30000, '2023-07-22 07:02:02', '2023-07-22 07:02:02'),
(6, 10, 12, 25000, 1, 25000, '2023-07-22 07:02:02', '2023-07-22 07:02:02'),
(7, 1, 13, 25000, 1, 25000, '2023-07-22 07:09:11', '2023-07-22 07:09:11'),
(8, 2, 13, 30000, 1, 30000, '2023-07-22 07:09:11', '2023-07-22 07:09:11'),
(9, 10, 13, 25000, 1, 25000, '2023-07-22 07:09:11', '2023-07-22 07:09:11'),
(10, 1, 14, 25000, 1, 25000, '2023-07-22 07:39:11', '2023-07-22 07:39:11'),
(11, 2, 14, 30000, 1, 30000, '2023-07-22 07:39:11', '2023-07-22 07:39:11'),
(12, 10, 14, 25000, 1, 25000, '2023-07-22 07:39:11', '2023-07-22 07:39:11'),
(13, 1, 15, 25000, 1, 25000, '2023-07-22 07:47:52', '2023-07-22 07:47:52'),
(14, 2, 15, 30000, 1, 30000, '2023-07-22 07:47:52', '2023-07-22 07:47:52'),
(15, 10, 15, 25000, 1, 25000, '2023-07-22 07:47:52', '2023-07-22 07:47:52'),
(16, 1, 16, 25000, 1, 25000, '2023-07-22 07:51:18', '2023-07-22 07:51:18'),
(17, 2, 16, 30000, 1, 30000, '2023-07-22 07:51:18', '2023-07-22 07:51:18'),
(18, 10, 16, 25000, 1, 25000, '2023-07-22 07:51:18', '2023-07-22 07:51:18'),
(19, 1, 17, 25000, 1, 25000, '2023-07-22 08:13:35', '2023-07-22 08:13:35'),
(20, 2, 17, 30000, 1, 30000, '2023-07-22 08:13:35', '2023-07-22 08:13:35'),
(21, 10, 17, 25000, 1, 25000, '2023-07-22 08:13:35', '2023-07-22 08:13:35'),
(22, 1, 18, 25000, 1, 25000, '2023-07-22 08:21:47', '2023-07-22 08:21:47'),
(23, 2, 18, 30000, 1, 30000, '2023-07-22 08:21:47', '2023-07-22 08:21:47'),
(24, 10, 18, 25000, 1, 25000, '2023-07-22 08:21:47', '2023-07-22 08:21:47'),
(25, 1, 19, 25000, 1, 25000, '2023-07-22 08:26:22', '2023-07-22 08:26:22'),
(26, 2, 19, 30000, 1, 30000, '2023-07-22 08:26:22', '2023-07-22 08:26:22'),
(27, 10, 19, 25000, 1, 25000, '2023-07-22 08:26:22', '2023-07-22 08:26:22'),
(28, 1, 20, 25000, 1, 25000, '2023-07-22 08:40:49', '2023-07-22 08:40:49'),
(29, 2, 20, 30000, 1, 30000, '2023-07-22 08:40:49', '2023-07-22 08:40:49'),
(30, 10, 20, 25000, 1, 25000, '2023-07-22 08:40:49', '2023-07-22 08:40:49'),
(31, 10, 21, 3090, 1, 3090, '2023-07-22 13:24:53', '2023-07-22 13:24:53'),
(32, 10, 22, 3090, 1, 3090, '2023-07-22 13:26:50', '2023-07-22 13:26:50'),
(33, 10, 23, 3090, 3, 9270, '2023-07-22 13:27:43', '2023-07-22 13:27:43'),
(34, 1, 24, 25000, 4, 100000, '2023-07-22 13:35:52', '2023-07-22 13:35:52');

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Token Name', '674af7d5e48623ce47e2a0c9a0c66b9e11f4b5155572dd1cc73589852e1a1db2', '[\"*\"]', '2023-06-29 23:00:14', NULL, '2023-06-29 22:38:02', '2023-06-29 23:00:14'),
(2, 'App\\Models\\User', 1, 'auth_token', '84b0a1414dc4be25800bea5be4eabc01a76850d0167ded1958af3f11eeda3e41', '[\"*\"]', '2023-06-30 14:19:54', NULL, '2023-06-29 23:01:39', '2023-06-30 14:19:54'),
(3, 'App\\Models\\User', 1, 'auth_token', '6a4ea1b9ae379902eacf15ab060ceb841f8235cae0713202bba29b22fe3a945d', '[\"*\"]', '2023-07-01 12:41:21', NULL, '2023-06-30 23:08:48', '2023-07-01 12:41:21');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `created_at`, `updated_at`, `image`) VALUES
(1, 2, 'Tishert', 'Lacost', '2023-06-29 22:28:57', '2023-07-17 13:59:39', NULL),
(2, 2, 'Adres', 'Coton', '2023-06-29 22:30:12', '2023-06-29 22:30:12', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `variation_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, 'good', '2023-07-23 05:25:02', '2023-07-23 05:25:02'),
(2, 2, 1, 0, 'Nice', '2023-07-23 05:27:08', '2023-07-23 05:27:08'),
(3, 2, 1, 0, 'good', '2023-07-23 05:30:25', '2023-07-23 05:30:25'),
(4, 2, 1, 0, 'Nice', '2023-07-23 05:31:22', '2023-07-23 05:31:22'),
(5, 2, 1, 0, 'المنتج رائع', '2023-07-23 05:34:38', '2023-07-23 05:34:38');

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2023-07-17 12:09:55', '2023-07-17 12:09:55'),
(2, 'User', '2023-07-17 12:09:55', '2023-07-17 12:09:55'),
(3, 'Delivery', '2023-07-17 12:09:55', '2023-07-17 12:09:55');

-- --------------------------------------------------------

--
-- بنية الجدول `system_settings`
--

CREATE TABLE `system_settings` (
  `website_name` varchar(255) NOT NULL,
  `website_title` varchar(255) NOT NULL,
  `website_keywords` text DEFAULT NULL,
  `website_description` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) NOT NULL,
  `system_email` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_channel` varchar(255) NOT NULL,
  `store` varchar(255) NOT NULL,
  `purchase_code` varchar(255) NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `footer_link` varchar(255) DEFAULT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `system_settings`
--

INSERT INTO `system_settings` (`website_name`, `website_title`, `website_keywords`, `website_description`, `author`, `slogan`, `system_email`, `address`, `phone`, `facebook_url`, `linkedin_url`, `youtube_channel`, `store`, `purchase_code`, `language`, `footer_text`, `footer_link`, `id`) VALUES
('store Website', 'Welcome to Aloklah Website', 'website, keywords, store , system', 'This is an example website', 'Mohammed Aloklah', 'Your Slogan Here', 'info@example.com', '123 Street, City, Country', '+123456789', 'https://www.facebook.com/example', 'https://www.linkedin.com/example', 'https://www.youtube.com/channel/example', 'My Store', '232563', 'ar', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `phone_number` varchar(191) NOT NULL,
  `birth` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `gender`, `password`, `phone_number`, `birth`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 1, 'Admin', 'admin@example.com', 'male', '$2a$12$57Se8vzOoQXHMR7WwU95UOCbIOm2VW0tTZ4sfIJhvASe5537EvwHK', '123456789', '1990-01-01', NULL, 'xcszBDpLWrePsnkRcnWqASnN5ZPduoTshxNiqL72FhcLo7CknFzrTDm1apZV', '2023-07-17 12:13:05', '2023-07-17 12:13:05'),
(4, 3, 'Delivery1', 'delivery@example.com', 'male', '$2a$12$57Se8vzOoQXHMR7WwU95UOCbIOm2VW0tTZ4sfIJhvASe5537EvwHK', '555555556', '1992-09-15', NULL, NULL, '2023-07-17 12:13:05', '2023-07-18 14:10:03'),
(15, 2, 'adnan mohammed1', 'adnan@ex.com', 'male', '$2y$10$ZPrLozTxIPfjWFxiOoGgKOv0o85FjYHxpVzrSp1e7qUJaVfmNwiXC', '0523724514', '1999-02-10', NULL, NULL, '2023-07-20 15:14:17', '2023-07-22 10:44:17'),
(22, 3, 'Bailal Zeadan', 'b@example.com', 'male', '$2y$10$VzvOPsUXuv961pvNOdlTteTZxiF7ih2cZ1mCmAKpRIvc3WtyGNlTS', '052372451121', '2023-07-27', NULL, NULL, '2023-07-22 20:30:49', '2023-07-22 20:31:01');

-- --------------------------------------------------------

--
-- بنية الجدول `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `size` enum('L','XL','XXL','M','S') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `variations`
--

INSERT INTO `variations` (`id`, `product_id`, `color_id`, `quantity`, `price`, `size`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 62, 25000, 'S', NULL, '2023-07-19 14:08:31'),
(2, 2, 2, 599, 30000, 'XL', NULL, '2023-06-30 14:18:10'),
(8, 1, 1, 29, 26000, 'L', '2023-07-18 19:55:24', '2023-07-18 19:55:24'),
(10, 2, 3, 29, 3090, 'M', '2023-07-19 12:29:52', '2023-07-19 12:29:52');

-- --------------------------------------------------------

--
-- بنية الجدول `wish_lists`
--

CREATE TABLE `wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `wish_lists`
--

INSERT INTO `wish_lists` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-06-29 22:38:01', '2023-06-29 22:38:01');

-- --------------------------------------------------------

--
-- بنية الجدول `wish_list_items`
--

CREATE TABLE `wish_list_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wish_list_id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_orders_order_id_foreign` (`order_id`),
  ADD KEY `delivery_orders_delivery_driver_id_foreign` (`delivery_driver_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_order_address_id_foreign` (`order_address_id`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_variation_id_foreign` (`variation_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variations_product_id_foreign` (`product_id`),
  ADD KEY `variations_color_id_foreign` (`color_id`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wish_lists_user_id_foreign` (`user_id`);

--
-- Indexes for table `wish_list_items`
--
ALTER TABLE `wish_list_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wish_list_items_wish_list_id_foreign` (`wish_list_id`),
  ADD KEY `wish_list_items_variation_id_foreign` (`variation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wish_list_items`
--
ALTER TABLE `wish_list_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
