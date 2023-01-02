-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2023 at 11:16 AM
-- Server version: 5.7.33
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `binary_commissions`
--

CREATE TABLE `binary_commissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `left_total` int(11) NOT NULL,
  `right_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `binary_commission_logs`
--

CREATE TABLE `binary_commission_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `side` int(11) NOT NULL,
  `oder_id` int(11) NOT NULL,
  `reference_oder_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_wallets`
--

CREATE TABLE `cash_wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `hold_amount` int(11) DEFAULT NULL,
  `wallet_balance` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_wallet_logs`
--

CREATE TABLE `cash_wallet_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `oder_id` int(11) DEFAULT NULL,
  `reference_oder_id` int(11) DEFAULT NULL,
  `trx_direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_commission_logs`
--

CREATE TABLE `daily_commission_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `oder_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `direct_commission_logs`
--

CREATE TABLE `direct_commission_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `oder_id` int(11) NOT NULL,
  `reference_oder_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direct_commission_logs`
--

INSERT INTO `direct_commission_logs` (`id`, `user_id`, `amount`, `oder_id`, `reference_oder_id`, `created_at`, `updated_at`) VALUES
(15, 20, 2000.00, 8, 13, '2023-01-02 05:10:05', '2023-01-02 05:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kycs`
--

CREATE TABLE `kycs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile_number1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_docs_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_doc_front` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_doc_back` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_acount_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citizen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crypto_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level_commission_logs`
--

CREATE TABLE `level_commission_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `oder_id` int(11) NOT NULL,
  `reference_oder_id` int(11) NOT NULL,
  `relative_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id` int(10) UNSIGNED NOT NULL,
  `daily` double(8,3) NOT NULL,
  `level` double(8,2) NOT NULL,
  `direct` double(8,2) NOT NULL,
  `cash` double(8,2) NOT NULL,
  `p2p` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `daily`, `level`, `direct`, `cash`, `p2p`, `created_at`, `updated_at`) VALUES
(1, 0.005, 0.01, 0.10, 0.20, 0.10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(26, '2014_10_12_000000_create_users_table', 1),
(27, '2014_10_12_100000_create_password_resets_table', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(30, '2022_12_15_080207_add_google_2fa_columns', 1),
(31, '2022_12_16_101441_create_kycs_table', 1),
(32, '2022_12_18_032705_create_binary_commission_logs_table', 1),
(33, '2022_12_18_033720_create_direct_commission_logs_table', 1),
(34, '2022_12_18_034050_create_level_commission_logs_table', 1),
(35, '2022_12_18_034515_create_daily_commission_logs_table', 1),
(36, '2022_12_18_034833_create_user_oder_counts_table', 1),
(37, '2022_12_18_035043_create_oders_table', 1),
(38, '2022_12_18_035914_create_products_table', 1),
(39, '2022_12_18_040154_create_binary_commissions_table', 1),
(40, '2022_12_18_040401_create_shadow_maps_table', 1),
(41, '2022_12_18_040937_create_product_wallets_table', 1),
(42, '2022_12_18_041103_create_product_wallet_logs_table', 1),
(43, '2022_12_18_041437_create_cash_wallets_table', 1),
(44, '2022_12_18_042211_create_cash_wallet_logs_table', 1),
(45, '2022_12_19_131908_create_product_buy_requests_table', 1),
(46, '2022_12_21_071616_create_withdrawals_table', 1),
(47, '2022_12_21_093239_create_p2p_transection_table', 1),
(48, '2022_12_21_111054_create_cashes_table', 1),
(49, '2022_12_21_134947_create_master_table', 1),
(50, '2022_12_23_184001_create_shadow_map_models_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oders`
--

CREATE TABLE `oders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_value` int(11) NOT NULL,
  `product_point` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_pay_amount` int(11) DEFAULT NULL,
  `cash_pay_amount` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `max_value` int(11) NOT NULL,
  `total_package_earnings` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oders`
--

INSERT INTO `oders` (`id`, `user_id`, `sponsor_id`, `product_id`, `product_value`, `product_point`, `payment_method`, `wallet_pay_amount`, `cash_pay_amount`, `status`, `max_value`, `total_package_earnings`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 20000, 2, 'Real Cash', 0, 20000, 1, 60000, 220, '2022-12-26 09:53:36', '2023-01-01 23:40:05'),
(2, 3, NULL, 1, 20000, 2, 'Real Cash', 0, 20000, 1, 60000, 0, '2022-12-26 11:10:48', '2022-12-26 11:10:48'),
(3, 4, NULL, 2, 30000, 3, 'Real Cash', 0, 30000, 1, 90000, 220, '2022-12-27 11:10:21', '2023-01-01 23:40:05'),
(4, 5, NULL, 2, 30000, 3, 'Real Cash', 0, 30000, 1, 90000, 0, '2022-12-27 11:15:59', '2022-12-27 11:15:59'),
(5, 6, NULL, 3, 50000, 5, 'Real Cash', 0, 50000, 1, 150000, 0, '2022-12-27 11:49:54', '2022-12-27 11:49:54'),
(6, 7, NULL, 1, 20000, 2, 'Real Cash', 0, 20000, 1, 60000, 0, '2022-12-28 10:29:54', '2022-12-28 10:39:56'),
(7, 8, NULL, 1, 20000, 2, 'Real Cash', 0, 20000, 1, 60000, 220, '2022-12-29 14:56:25', '2023-01-01 23:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `p2p_transection`
--

CREATE TABLE `p2p_transection` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_user_id` int(11) NOT NULL,
  `request_amount` double(8,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@sonrich.com', '$2y$10$nrqeWXWVuqdynQaFI3VyxOVuyPUm8OyQfOlWeUFd.SWsIvhShiAqC', '2022-12-25 08:59:00'),
('admin@sonrich.net', '$2y$10$Y8XWWDEFQ6vxNY6S9XdjP.j8WYVNdTBD8gOuUwqKGXUCnHsfxc/v.', '2022-12-25 09:00:07'),
('lucianmacwolf@gmail.com', '$2y$10$GOJmoKvqTq/UnNeoRpDHv.RhbiPJPcKoJ/iJLJZBRvEmE0WkRRyW.', '2022-12-25 09:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_price` int(11) NOT NULL,
  `point_value` int(11) NOT NULL,
  `product_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_price`, `point_value`, `product_title`, `product_description`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 20000, 2, 'test', 'test case', '', NULL, NULL),
(2, 30000, 3, 'test 03', 'test', '', NULL, NULL),
(3, 50000, 5, 'test 01', 'test', '', NULL, NULL),
(4, 100000, 10, 'test 02', 'test', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_buy_requests`
--

CREATE TABLE `product_buy_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `request_amount` double(8,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_buy_requests`
--

INSERT INTO `product_buy_requests` (`id`, `user_id`, `sponsor_id`, `product_id`, `request_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 19, 18, 1, 20000.00, 0, '2022-12-29 20:53:07', '2022-12-29 20:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_wallets`
--

CREATE TABLE `product_wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_balance` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_wallet_logs`
--

CREATE TABLE `product_wallet_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `oder_id` int(11) DEFAULT NULL,
  `reference_oder_id` int(11) DEFAULT NULL,
  `trx_direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_wallet_logs`
--

INSERT INTO `product_wallet_logs` (`id`, `user_id`, `amount`, `oder_id`, `reference_oder_id`, `trx_direction`, `description`, `created_at`, `updated_at`) VALUES
(45, 20, 2000.00, 8, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(46, 20, 20.00, 8, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(47, 20, 200.00, 8, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(48, 8, 20.00, 7, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(49, 8, 200.00, 7, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(50, 4, 20.00, 3, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(51, 4, 200.00, 3, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(52, 2, 20.00, 1, 13, 'IN', '1/3 Binary commission', NULL, NULL),
(53, 2, 200.00, 1, 13, 'IN', '1/3 Binary commission', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shadow_maps`
--

CREATE TABLE `shadow_maps` (
  `id` int(10) UNSIGNED NOT NULL,
  `y` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `parent_node` int(11) NOT NULL,
  `reference_node_side` int(11) NOT NULL,
  `x_max` int(11) DEFAULT NULL,
  `x_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shadow_maps`
--

INSERT INTO `shadow_maps` (`id`, `y`, `x`, `user_id`, `status`, `parent_node`, `reference_node_side`, `x_max`, `x_count`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 2, 1, 0, 1, 1, 1, '2022-12-28 07:32:59', '2023-01-01 21:16:16'),
(2, 1, 1, 3, 1, 1, 0, 2, 1, '2022-12-28 07:21:25', '2022-12-28 07:21:25'),
(3, 1, 2, 4, 1, 1, 1, 2, 2, '2022-12-28 07:36:09', '2022-12-28 17:38:13'),
(4, 2, 1, 5, 1, 2, 0, 4, 1, '2022-12-28 07:40:56', '2022-12-28 07:40:56'),
(5, 2, 2, 6, 1, 2, 1, 4, 2, '2022-12-28 07:42:14', '2022-12-28 07:42:14'),
(6, 2, 3, 7, 1, 3, 0, 4, 3, '2022-12-28 07:42:14', '2022-12-28 07:42:14'),
(7, 2, 4, 8, 1, 3, 1, 4, 4, '2022-12-28 07:42:14', '2022-12-28 07:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `shadow_map_models`
--

CREATE TABLE `shadow_map_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `virtual_level` int(11) NOT NULL,
  `value_array` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shadow_map_models`
--

INSERT INTO `shadow_map_models` (`id`, `virtual_level`, `value_array`, `created_at`, `updated_at`) VALUES
(1, 0, '[1]', NULL, NULL),
(2, 1, '[1, 2]', NULL, NULL),
(3, 2, '[1, 3, 2, 4]', NULL, NULL),
(4, 3, '[1, 5, 3, 7, 2, 6, 4, 8]', NULL, NULL),
(5, 4, '[1, 9, 5, 13, 3, 11, 7, 15, 2, 10, 6, 14, 4, 12, 8, 16]', NULL, NULL),
(6, 5, '[1, 17, 9, 25, 5, 21, 13, 29, 3, 19, 11, 27, 7, 23, 15, 31, 2, 18, 10, 26, 6, 22, 14, 30, 4, 20, 12, 28, 8, 24, 16, 32]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google2fa_secret` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `parent`, `email_verified_at`, `role`, `password`, `last_login_at`, `last_login_ip_address`, `remember_token`, `created_at`, `updated_at`, `google2fa_secret`, `status`) VALUES
(1, 'Super', 'Admin', 'superadmin@sonrich.com', '0', NULL, 2, '$2y$10$nsz5tbEYUboFJXwXYqFvV.pz1wSX.bRKlJNSok4Qh6yw7647BPGVC', NULL, NULL, NULL, '2022-12-17 19:17:37', '2022-12-17 19:17:37', 'NG64TM6R5BKFLN53', 1),
(2, 'Admin', 'Admin', 'admin@sonrich.net', '1', NULL, 1, '$2y$10$nsz5tbEYUboFJXwXYqFvV.pz1wSX.bRKlJNSok4Qh6yw7647BPGVC', NULL, NULL, NULL, '2022-12-17 19:23:05', '2022-12-21 07:03:39', 'PUDAIK42I4GPH6ZN', 1),
(3, 'Level 1', 'Left', 'level1left@sonrich.com', '2', NULL, 0, '$2y$10$TY756BcoxiWKSP5SbkLZHeGPIZZI.msZK186ePPyBNHJvPzJMo.P2', NULL, NULL, NULL, '2022-12-17 19:28:08', '2022-12-17 19:28:08', '7SAKSJY2Y4H4T33N', 1),
(4, 'Level 1', 'Right', 'level1right@sonrich.com', '3', NULL, 0, '$2y$10$9U27evQYNjvizHlbfHQNz.lRomup134dguUCkzTM7OCvNQVpUYRwC', NULL, NULL, NULL, '2022-12-17 19:39:52', '2022-12-17 19:39:52', 'WQTAWCR2PISLP3FX', 1),
(5, 'Level 2', 'Left-4', 'level2left3@sonrich.com', '3', NULL, 0, '$2y$10$D6VnyJO1FTlwwXWnIqRee.lE3bqDYCp6XPcuW1MUQUaxW29Z2kIr2', NULL, NULL, NULL, '2022-12-26 09:44:48', '2022-12-26 09:44:48', 'Q57DVUZHZNHSABKZ', 1),
(6, 'Level 2', 'Right-4', 'level2right3@sonrich.com', '5', NULL, 0, '$2y$10$CNQWzywbQqOPuwf8o5UZce3XhVLydJEJPEZkxRTP2YGB1W9863UQi', NULL, NULL, NULL, '2022-12-27 11:09:28', '2022-12-27 11:09:28', 'C752F3GTJDR4CHIN', 1),
(7, 'Level 2', 'Left-5', 'level2left4@sonrich.com', '6', NULL, 0, '$2y$10$QoRr1maHRSJTlUxzMEwu3exYc56twyT546MbgiDB8AlFVaCf0upze', NULL, NULL, NULL, '2022-12-27 11:15:15', '2022-12-27 11:15:15', 'BK3JXJIT3LXX77E3', 1),
(8, 'Level 2', 'Right-5', 'level2right4@sonrich.com', '7', NULL, 0, '$2y$10$6da2QjNnetK.jXJge9Nyx.gp9BoVscMeNzM2PWLF7MYoZu0ax6pw.', NULL, NULL, NULL, '2022-12-27 11:49:34', '2022-12-27 11:49:34', 'Q7WSHRKJBBYT6GXB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_oder_counts`
--

CREATE TABLE `user_oder_counts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `oder_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_oder_counts`
--

INSERT INTO `user_oder_counts` (`id`, `user_id`, `oder_id`, `count`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, NULL, NULL),
(2, 3, 2, 1, NULL, NULL),
(3, 4, 3, 1, NULL, NULL),
(4, 5, 4, 1, NULL, NULL),
(5, 6, 5, 1, NULL, NULL),
(6, 7, 6, 1, NULL, NULL),
(7, 8, 7, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_amount` double NOT NULL,
  `company_fee` double NOT NULL,
  `tranfer_amount` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binary_commissions`
--
ALTER TABLE `binary_commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binary_commission_logs`
--
ALTER TABLE `binary_commission_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_wallets`
--
ALTER TABLE `cash_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_wallet_logs`
--
ALTER TABLE `cash_wallet_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_commission_logs`
--
ALTER TABLE `daily_commission_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `direct_commission_logs`
--
ALTER TABLE `direct_commission_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_commission_logs`
--
ALTER TABLE `level_commission_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oders`
--
ALTER TABLE `oders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p2p_transection`
--
ALTER TABLE `p2p_transection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_buy_requests`
--
ALTER TABLE `product_buy_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_wallets`
--
ALTER TABLE `product_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_wallet_logs`
--
ALTER TABLE `product_wallet_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shadow_maps`
--
ALTER TABLE `shadow_maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shadow_map_models`
--
ALTER TABLE `shadow_map_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_oder_counts`
--
ALTER TABLE `user_oder_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binary_commissions`
--
ALTER TABLE `binary_commissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `binary_commission_logs`
--
ALTER TABLE `binary_commission_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_wallets`
--
ALTER TABLE `cash_wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_wallet_logs`
--
ALTER TABLE `cash_wallet_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_commission_logs`
--
ALTER TABLE `daily_commission_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `direct_commission_logs`
--
ALTER TABLE `direct_commission_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level_commission_logs`
--
ALTER TABLE `level_commission_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `oders`
--
ALTER TABLE `oders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `p2p_transection`
--
ALTER TABLE `p2p_transection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_buy_requests`
--
ALTER TABLE `product_buy_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_wallets`
--
ALTER TABLE `product_wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_wallet_logs`
--
ALTER TABLE `product_wallet_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `shadow_maps`
--
ALTER TABLE `shadow_maps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shadow_map_models`
--
ALTER TABLE `shadow_map_models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_oder_counts`
--
ALTER TABLE `user_oder_counts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
