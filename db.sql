-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bagisto`
--

DELIMITER $$
--
-- 関数
--
CREATE DEFINER=`Bagisto`@`localhost` FUNCTION `get_url_path_of_category` (`categoryId` INT, `localeCode` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET utf8mb4 BEGIN
            
                DECLARE urlPath VARCHAR(255);
                -- Category with id 1 is root by default
                IF categoryId <> 1
                THEN
                    SELECT
                        GROUP_CONCAT(parent_translations.slug SEPARATOR '/') INTO urlPath
                    FROM
                        categories AS node,
                        categories AS parent
                        JOIN category_translations AS parent_translations ON parent.id = parent_translations.category_id
                    WHERE
                        node._lft >= parent._lft
                        AND node._rgt <= parent._rgt
                        AND node.id = categoryId
                        AND parent.id <> 1
                        AND parent_translations.locale = localeCode
                    GROUP BY
                        node.id;
                        
                    IF urlPath IS NULL
                    THEN
                        SET urlPath = (SELECT slug FROM category_translations WHERE category_translations.category_id = categoryId);
                    END IF;
                 ELSE
                    SET urlPath = '';
                 END IF;
                 
                 RETURN urlPath;
            END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- テーブルの構造 `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `status`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Example', 'admin@example.com', '$2y$10$FvBEaTpn0IB6wNIdHt8hQuN6I3AyyPOAcieKMdHKqm87EgQM3UEkC', 1, 1, '91i1WdQPH7Z9fVR0FLO6V3c8f4gAz6MdIHH1M8brFdiMzXGJzu9ZOYl6iM0L', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `agent_password_resets`
--

CREATE TABLE `agent_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `agent_roles`
--

CREATE TABLE `agent_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `agent_roles`
--

INSERT INTO `agent_roles` (`id`, `name`, `description`, `permission_type`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator rolem', 'all', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `agent_sources`
--

CREATE TABLE `agent_sources` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '代理店ID',
  `vendor_id` int(11) NOT NULL COMMENT 'ベンダーID',
  `agency_group_id` int(11) NOT NULL COMMENT '代理店グループID',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '代理店名',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(10) UNSIGNED NOT NULL,
  `postal_code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '郵便番号',
  `pref` int(11) NOT NULL COMMENT '都道府県',
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '市町村',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '番地',
  `building_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '建物名',
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電話番号',
  `fax` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FAX番号',
  `agency_denki_shop_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SmartCIS代理店ID',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時',
  `created_user_id` int(11) NOT NULL COMMENT '作成ユーザーID',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `updated_user_id` int(11) NOT NULL COMMENT '更新ユーザーID',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `agent_sources`
--

INSERT INTO `agent_sources` (`id`, `vendor_id`, `agency_group_id`, `name`, `email`, `password`, `status`, `role_id`, `postal_code`, `pref`, `city`, `address`, `building_name`, `tel`, `fax`, `agency_denki_shop_code`, `created_at`, `created_user_id`, `updated_at`, `updated_user_id`, `del_flg`, `remember_token`) VALUES
(1, 1, 1, 'ld', 'ld@example.com', '$2y$10$VlJDOOaLV1JcXeA4mHU3U.IutCAmHg0vJR00M1.zkkWcc221tEoR2', 1, 1, '1234567', 0, '東京', '新宿', 'パークタワー', '0312345678', '0312345679', '', '2019-12-11 15:00:00', 1, '2020-01-09 15:02:52', 1, 0, '41Heb3vz2gJXV4XluLfbfjpdYMYEnInSSF318ehlTDtytWBrDfcZDl0F9xRH');

-- --------------------------------------------------------

--
-- テーブルの構造 `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `is_unique` tinyint(1) NOT NULL DEFAULT 0,
  `value_per_locale` tinyint(1) NOT NULL DEFAULT 0,
  `value_per_channel` tinyint(1) NOT NULL DEFAULT 0,
  `is_filterable` tinyint(1) NOT NULL DEFAULT 0,
  `is_configurable` tinyint(1) NOT NULL DEFAULT 0,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT 1,
  `is_visible_on_front` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `swatch_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_in_flat` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `attributes`
--

INSERT INTO `attributes` (`id`, `code`, `admin_name`, `type`, `validation`, `position`, `is_required`, `is_unique`, `value_per_locale`, `value_per_channel`, `is_filterable`, `is_configurable`, `is_user_defined`, `is_visible_on_front`, `created_at`, `updated_at`, `swatch_type`, `use_in_flat`) VALUES
(1, 'sku', 'SKU', 'text', NULL, 1, 1, 1, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(2, 'name', 'Name', 'text', NULL, 2, 1, 0, 1, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(3, 'url_key', 'URL Key', 'text', NULL, 3, 1, 1, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(4, 'tax_category_id', 'Tax Category', 'select', NULL, 4, 0, 0, 0, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(5, 'new', 'New', 'boolean', NULL, 5, 0, 0, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(6, 'featured', 'Featured', 'boolean', NULL, 6, 0, 0, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(7, 'visible_individually', 'Visible Individually', 'boolean', NULL, 7, 1, 0, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(8, 'status', 'Status', 'boolean', NULL, 8, 1, 0, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(9, 'short_description', 'Short Description', 'textarea', NULL, 9, 1, 0, 1, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(10, 'description', 'Description', 'textarea', NULL, 10, 1, 0, 1, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(11, 'price', 'Price', 'price', 'decimal', 11, 1, 0, 0, 0, 1, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(12, 'cost', 'Cost', 'price', 'decimal', 12, 0, 0, 0, 1, 0, 0, 1, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(13, 'special_price', 'Special Price', 'price', 'decimal', 13, 0, 0, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(14, 'special_price_from', 'Special Price From', 'date', NULL, 14, 0, 0, 0, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(15, 'special_price_to', 'Special Price To', 'date', NULL, 15, 0, 0, 0, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(16, 'meta_title', 'Meta Title', 'textarea', NULL, 16, 0, 0, 1, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(17, 'meta_keywords', 'Meta Keywords', 'textarea', NULL, 17, 0, 0, 1, 1, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(18, 'meta_description', 'Meta Description', 'textarea', NULL, 18, 0, 0, 1, 1, 0, 0, 1, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(19, 'width', 'Width', 'text', 'decimal', 19, 0, 0, 0, 0, 0, 0, 1, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(20, 'height', 'Height', 'text', 'decimal', 20, 0, 0, 0, 0, 0, 0, 1, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(21, 'depth', 'Depth', 'text', 'decimal', 21, 0, 0, 0, 0, 0, 0, 1, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(22, 'weight', 'Weight', 'text', 'decimal', 22, 1, 0, 0, 0, 0, 0, 0, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(23, 'color', 'Color', 'select', NULL, 23, 0, 0, 0, 0, 1, 1, 1, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(24, 'size', 'Size', 'select', NULL, 24, 0, 0, 0, 0, 1, 1, 1, 0, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1),
(25, 'brand', 'Brand', 'select', NULL, 25, 0, 0, 0, 0, 1, 0, 0, 1, '2020-01-08 11:45:35', '2020-01-08 11:45:35', NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `attribute_families`
--

CREATE TABLE `attribute_families` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `attribute_families`
--

INSERT INTO `attribute_families` (`id`, `code`, `name`, `status`, `is_user_defined`) VALUES
(1, 'default', 'Default', 0, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `attribute_groups`
--

CREATE TABLE `attribute_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT 1,
  `attribute_family_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `attribute_groups`
--

INSERT INTO `attribute_groups` (`id`, `name`, `position`, `is_user_defined`, `attribute_family_id`) VALUES
(1, 'General', 1, 0, 1),
(2, 'Description', 2, 0, 1),
(3, 'Meta Description', 3, 0, 1),
(4, 'Price', 4, 0, 1),
(5, 'Shipping', 5, 0, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `attribute_group_mappings`
--

CREATE TABLE `attribute_group_mappings` (
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `attribute_group_id` int(10) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `attribute_group_mappings`
--

INSERT INTO `attribute_group_mappings` (`attribute_id`, `attribute_group_id`, `position`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 2, 1),
(10, 2, 2),
(11, 4, 1),
(12, 4, 2),
(13, 4, 3),
(14, 4, 4),
(15, 4, 5),
(16, 3, 1),
(17, 3, 2),
(18, 3, 3),
(19, 5, 1),
(20, 5, 2),
(21, 5, 3),
(22, 5, 4),
(23, 1, 9),
(24, 1, 10),
(25, 1, 11);

-- --------------------------------------------------------

--
-- テーブルの構造 `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `swatch_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `admin_name`, `sort_order`, `attribute_id`, `swatch_value`) VALUES
(1, 'Red', 1, 23, NULL),
(2, 'Green', 2, 23, NULL),
(3, 'Yellow', 3, 23, NULL),
(4, 'Black', 4, 23, NULL),
(5, 'White', 5, 23, NULL),
(6, 'S', 1, 24, NULL),
(7, 'M', 2, 24, NULL),
(8, 'L', 3, 24, NULL),
(9, 'XL', 4, 24, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `attribute_option_translations`
--

CREATE TABLE `attribute_option_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_option_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `attribute_option_translations`
--

INSERT INTO `attribute_option_translations` (`id`, `locale`, `label`, `attribute_option_id`) VALUES
(1, 'en', 'Red', 1),
(2, 'en', 'Green', 2),
(3, 'en', 'Yellow', 3),
(4, 'en', 'Black', 4),
(5, 'en', 'White', 5),
(6, 'en', 'S', 6),
(7, 'en', 'M', 7),
(8, 'en', 'L', 8),
(9, 'en', 'XL', 9);

-- --------------------------------------------------------

--
-- テーブルの構造 `attribute_translations`
--

CREATE TABLE `attribute_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `attribute_translations`
--

INSERT INTO `attribute_translations` (`id`, `locale`, `name`, `attribute_id`) VALUES
(1, 'en', 'SKU', 1),
(2, 'en', 'Name', 2),
(3, 'en', 'URL Key', 3),
(4, 'en', 'Tax Category', 4),
(5, 'en', 'New', 5),
(6, 'en', 'Featured', 6),
(7, 'en', 'Visible Individually', 7),
(8, 'en', 'Status', 8),
(9, 'en', 'Short Description', 9),
(10, 'en', 'Description', 10),
(11, 'en', 'Price', 11),
(12, 'en', 'Cost', 12),
(13, 'en', 'Special Price', 13),
(14, 'en', 'Special Price From', 14),
(15, 'en', 'Special Price To', 15),
(16, 'en', 'Meta Description', 16),
(17, 'en', 'Meta Keywords', 17),
(18, 'en', 'Meta Description', 18),
(19, 'en', 'Width', 19),
(20, 'en', 'Height', 20),
(21, 'en', 'Depth', 21),
(22, 'en', 'Weight', 22),
(23, 'en', 'Color', 23),
(24, 'en', 'Size', 24),
(25, 'en', 'Brand', 25);

-- --------------------------------------------------------

--
-- テーブルの構造 `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_gift` tinyint(1) NOT NULL DEFAULT 0,
  `items_count` int(11) DEFAULT NULL,
  `items_qty` decimal(12,4) DEFAULT NULL,
  `exchange_rate` decimal(12,4) DEFAULT NULL,
  `global_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` decimal(12,4) DEFAULT 0.0000,
  `base_grand_total` decimal(12,4) DEFAULT 0.0000,
  `sub_total` decimal(12,4) DEFAULT 0.0000,
  `base_sub_total` decimal(12,4) DEFAULT 0.0000,
  `tax_total` decimal(12,4) DEFAULT 0.0000,
  `base_tax_total` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) DEFAULT 0.0000,
  `checkout_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `conversion_time` datetime DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_address`
--

CREATE TABLE `cart_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `total_weight` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_total_weight` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `price` decimal(12,4) NOT NULL DEFAULT 1.0000,
  `base_price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `tax_percent` decimal(12,4) DEFAULT 0.0000,
  `tax_amount` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount` decimal(12,4) DEFAULT 0.0000,
  `discount_percent` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `discount_amount` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`)),
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `tax_category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `custom_price` decimal(12,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_item_inventories`
--

CREATE TABLE `cart_item_inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `inventory_source_id` int(10) UNSIGNED DEFAULT NULL,
  `cart_item_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_payment`
--

CREATE TABLE `cart_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rules`
--

CREATE TABLE `cart_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starts_from` datetime DEFAULT NULL,
  `ends_till` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `per_customer` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `use_coupon` tinyint(1) NOT NULL DEFAULT 0,
  `usage_limit` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conditions`)),
  `actions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`actions`)),
  `end_other_rules` tinyint(1) NOT NULL DEFAULT 0,
  `priority` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `uses_attribute_conditions` tinyint(1) NOT NULL DEFAULT 0,
  `product_ids` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `action_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disc_amount` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `disc_quantity` decimal(12,4) NOT NULL DEFAULT 1.0000,
  `disc_threshold` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `coupon_type` int(11) NOT NULL DEFAULT 1,
  `auto_generation` tinyint(1) NOT NULL DEFAULT 0,
  `apply_to_shipping` tinyint(1) NOT NULL DEFAULT 0,
  `free_shipping` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `products_selection` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`products_selection`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rule_cart`
--

CREATE TABLE `cart_rule_cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_rule_id` int(10) UNSIGNED DEFAULT NULL,
  `cart_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rule_channels`
--

CREATE TABLE `cart_rule_channels` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_rule_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rule_coupons`
--

CREATE TABLE `cart_rule_coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_rule_id` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usage_limit` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `usage_per_customer` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `usage_throttle` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `type` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rule_coupons_usage`
--

CREATE TABLE `cart_rule_coupons_usage` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `usage` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `expired_on` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rule_customers`
--

CREATE TABLE `cart_rule_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_rule_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `usage_throttle` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rule_customer_groups`
--

CREATE TABLE `cart_rule_customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_rule_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_rule_labels`
--

CREATE TABLE `cart_rule_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL,
  `locale_id` int(10) UNSIGNED DEFAULT NULL,
  `cart_rule_id` int(10) UNSIGNED DEFAULT NULL,
  `label` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cart_shipping_rates`
--

CREATE TABLE `cart_shipping_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `carrier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT 0,
  `base_price` double DEFAULT 0,
  `cart_address_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `catalog_rules`
--

CREATE TABLE `catalog_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_from` datetime DEFAULT NULL,
  `ends_till` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conditions`)),
  `actions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`actions`)),
  `end_other_rules` tinyint(1) NOT NULL DEFAULT 0,
  `action_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `catalog_rule_channels`
--

CREATE TABLE `catalog_rule_channels` (
  `id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `catalog_rule_customer_groups`
--

CREATE TABLE `catalog_rule_customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL,
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `catalog_rule_products`
--

CREATE TABLE `catalog_rule_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `starts_from` datetime DEFAULT NULL,
  `ends_till` datetime DEFAULT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `action_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `catalog_rule_products_price`
--

CREATE TABLE `catalog_rule_products_price` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `rule_price` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `starts_from` datetime DEFAULT NULL,
  `ends_till` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'products_and_description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `position`, `image`, `status`, `_lft`, `_rgt`, `parent_id`, `created_at`, `updated_at`, `display_mode`) VALUES
(1, 1, NULL, 1, 1, 14, NULL, '2020-01-08 11:45:35', '2020-01-08 11:45:35', 'products_and_description'),
(2, 2, NULL, 1, 15, 16, NULL, '2020-01-08 19:28:35', '2020-01-08 19:28:35', 'products_and_description');

--
-- トリガ `categories`
--
DELIMITER $$
CREATE TRIGGER `trig_categories_insert` AFTER INSERT ON `categories` FOR EACH ROW BEGIN
                            DECLARE urlPath VARCHAR(255);
            DECLARE localeCode VARCHAR(255);
            DECLARE done INT;
            DECLARE curs CURSOR FOR (SELECT category_translations.locale
                    FROM category_translations 
                    WHERE category_id = NEW.id);
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

            
            IF EXISTS (
                SELECT *
                FROM category_translations 
                WHERE category_id = NEW.id
            )
            THEN
            
                OPEN curs;
            
            	SET done = 0;
                REPEAT 
                	FETCH curs INTO localeCode;
                    
                    SELECT get_url_path_of_category(NEW.id, localeCode) INTO urlPath;
                    
                    UPDATE category_translations 
                    SET url_path = urlPath 
                    WHERE category_translations.category_id = NEW.id;
                
                UNTIL done END REPEAT;
                
                CLOSE curs;
                
            END IF;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig_categories_update` AFTER UPDATE ON `categories` FOR EACH ROW BEGIN
                            DECLARE urlPath VARCHAR(255);
            DECLARE localeCode VARCHAR(255);
            DECLARE done INT;
            DECLARE curs CURSOR FOR (SELECT category_translations.locale
                    FROM category_translations 
                    WHERE category_id = NEW.id);
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

            
            IF EXISTS (
                SELECT *
                FROM category_translations 
                WHERE category_id = NEW.id
            )
            THEN
            
                OPEN curs;
            
            	SET done = 0;
                REPEAT 
                	FETCH curs INTO localeCode;
                    
                    SELECT get_url_path_of_category(NEW.id, localeCode) INTO urlPath;
                    
                    UPDATE category_translations 
                    SET url_path = urlPath 
                    WHERE category_translations.category_id = NEW.id;
                
                UNTIL done END REPEAT;
                
                CLOSE curs;
                
            END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- テーブルの構造 `category_filterable_attributes`
--

CREATE TABLE `category_filterable_attributes` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `category_filterable_attributes`
--

INSERT INTO `category_filterable_attributes` (`category_id`, `attribute_id`) VALUES
(2, 11),
(2, 23);

-- --------------------------------------------------------

--
-- テーブルの構造 `category_translations`
--

CREATE TABLE `category_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale_id` int(10) UNSIGNED DEFAULT NULL,
  `url_path` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'maintained by database triggers'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `category_translations`
--

INSERT INTO `category_translations` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `category_id`, `locale`, `locale_id`, `url_path`) VALUES
(1, 'Root', 'root', 'Root', '', '', '', 1, 'en', 1, ''),
(2, '日本語', 'test', '<p>test</p>', '', '', '', 2, 'ja', 2, 'test'),
(3, '日本語', 'test', '<p>test</p>', '', '', '', 2, 'en', 1, 'test');

--
-- トリガ `category_translations`
--
DELIMITER $$
CREATE TRIGGER `trig_category_translations_insert` BEFORE INSERT ON `category_translations` FOR EACH ROW BEGIN
                            DECLARE parentUrlPath varchar(255);
            DECLARE urlPath varchar(255);
            
            -- Category with id 1 is root by default
            IF NEW.category_id <> 1
            THEN
                
                SELECT
                    GROUP_CONCAT(parent_translations.slug SEPARATOR '/') INTO parentUrlPath
                FROM
                    categories AS node,
                    categories AS parent
                    JOIN category_translations AS parent_translations ON parent.id = parent_translations.category_id
                WHERE
                    node._lft >= parent._lft
                    AND node._rgt <= parent._rgt
                    AND node.id = (SELECT parent_id FROM categories WHERE id = NEW.category_id)
                    AND parent.id <> 1
                    AND parent_translations.locale = NEW.locale
                GROUP BY
                    node.id;
                
                IF parentUrlPath IS NULL 
                THEN
                    SET urlPath = NEW.slug;
                ELSE
                    SET urlPath = concat(parentUrlPath, '/', NEW.slug);
                END IF;
                
                SET NEW.url_path = urlPath;
                
            END IF;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig_category_translations_update` BEFORE UPDATE ON `category_translations` FOR EACH ROW BEGIN
                            DECLARE parentUrlPath varchar(255);
            DECLARE urlPath varchar(255);
            
            -- Category with id 1 is root by default
            IF NEW.category_id <> 1
            THEN
                
                SELECT
                    GROUP_CONCAT(parent_translations.slug SEPARATOR '/') INTO parentUrlPath
                FROM
                    categories AS node,
                    categories AS parent
                    JOIN category_translations AS parent_translations ON parent.id = parent_translations.category_id
                WHERE
                    node._lft >= parent._lft
                    AND node._rgt <= parent._rgt
                    AND node.id = (SELECT parent_id FROM categories WHERE id = NEW.category_id)
                    AND parent.id <> 1
                    AND parent_translations.locale = NEW.locale
                GROUP BY
                    node.id;
                
                IF parentUrlPath IS NULL 
                THEN
                    SET urlPath = NEW.slug;
                ELSE
                    SET urlPath = concat(parentUrlPath, '/', NEW.slug);
                END IF;
                
                SET NEW.url_path = urlPath;
                
            END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- テーブルの構造 `channels`
--

CREATE TABLE `channels` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hostname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_page_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_locale_id` int(10) UNSIGNED NOT NULL,
  `base_currency_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `root_category_id` int(10) UNSIGNED DEFAULT NULL,
  `home_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`home_seo`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `channels`
--

INSERT INTO `channels` (`id`, `code`, `name`, `description`, `timezone`, `theme`, `hostname`, `logo`, `favicon`, `home_page_content`, `footer_content`, `default_locale_id`, `base_currency_id`, `created_at`, `updated_at`, `root_category_id`, `home_seo`) VALUES
(1, 'default', 'Default', '', NULL, 'default', '', NULL, NULL, '<p>@include(\"shop::home.slider\") @include(\"shop::home.featured-products\") @include(\"shop::home.new-products\")</p>\r\n<div class=\"banner-container\">\r\n<div class=\"left-banner\"><img src=\"https://s3-ap-southeast-1.amazonaws.com/cdn.uvdesk.com/website/1/201902045c581f9494b8a1.png\" /></div>\r\n<div class=\"right-banner\"><img src=\"https://s3-ap-southeast-1.amazonaws.com/cdn.uvdesk.com/website/1/201902045c581fb045cf02.png\" /> <img src=\"https://s3-ap-southeast-1.amazonaws.com/cdn.uvdesk.com/website/1/201902045c581fc352d803.png\" /></div>\r\n</div>', '<div class=\"list-container\"><span class=\"list-heading\">Quick Links</span>\r\n<ul class=\"list-group\">\r\n<li><a href=\"@php echo route(\'shop.cms.page\', \'about-us\') @endphp\">About Us</a></li>\r\n<li><a href=\"@php echo route(\'shop.cms.page\', \'return-policy\') @endphp\">Return Policy</a></li>\r\n<li><a href=\"@php echo route(\'shop.cms.page\', \'refund-policy\') @endphp\">Refund Policy</a></li>\r\n<li><a href=\"@php echo route(\'shop.cms.page\', \'terms-conditions\') @endphp\">Terms and conditions</a></li>\r\n<li><a href=\"@php echo route(\'shop.cms.page\', \'terms-of-use\') @endphp\">Terms of Use</a></li>\r\n<li><a href=\"@php echo route(\'shop.cms.page\', \'contact-us\') @endphp\">Contact Us</a></li>\r\n</ul>\r\n</div>\r\n<div class=\"list-container\"><span class=\"list-heading\">Connect With Us</span>\r\n<ul class=\"list-group\">\r\n<li><a href=\"#\"><span class=\"icon icon-facebook\"></span>Facebook </a></li>\r\n<li><a href=\"#\"><span class=\"icon icon-twitter\"></span> Twitter </a></li>\r\n<li><a href=\"#\"><span class=\"icon icon-instagram\"></span> Instagram </a></li>\r\n<li><a href=\"#\"> <span class=\"icon icon-google-plus\"></span>Google+ </a></li>\r\n<li><a href=\"#\"> <span class=\"icon icon-linkedin\"></span>LinkedIn </a></li>\r\n</ul>\r\n</div>', 2, 1, NULL, '2020-01-08 19:36:42', 2, '{\"meta_title\":\"ss\",\"meta_description\":\"sss\",\"meta_keywords\":\"ss\"}');

-- --------------------------------------------------------

--
-- テーブルの構造 `channel_currencies`
--

CREATE TABLE `channel_currencies` (
  `channel_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `channel_currencies`
--

INSERT INTO `channel_currencies` (`channel_id`, `currency_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `channel_inventory_sources`
--

CREATE TABLE `channel_inventory_sources` (
  `channel_id` int(10) UNSIGNED NOT NULL,
  `inventory_source_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `channel_inventory_sources`
--

INSERT INTO `channel_inventory_sources` (`channel_id`, `inventory_source_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `channel_locales`
--

CREATE TABLE `channel_locales` (
  `channel_id` int(10) UNSIGNED NOT NULL,
  `locale_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `channel_locales`
--

INSERT INTO `channel_locales` (`channel_id`, `locale_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `charges`
--

CREATE TABLE `charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `charge_id` bigint(20) NOT NULL,
  `test` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `capped_amount` decimal(8,2) DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `billing_on` timestamp NULL DEFAULT NULL,
  `activated_on` timestamp NULL DEFAULT NULL,
  `trial_ends_on` timestamp NULL DEFAULT NULL,
  `cancelled_on` timestamp NULL DEFAULT NULL,
  `expires_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `shop_id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_charge` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `url_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `layout` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `locale_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `url_key`, `html_content`, `page_title`, `meta_title`, `meta_description`, `meta_keywords`, `content`, `layout`, `channel_id`, `locale_id`, `created_at`, `updated_at`) VALUES
(1, 'about-us', '<div class=\"static-container one-column\">\n                                   <div class=\"mb-5\">About us page content</div>\n                                   </div>', 'About Us', 'about us', '', 'aboutus', '{\"html\": \"<div class=\\\"static-container one-column\\\">\\r\\n<div class=\\\"mb-5\\\">About us page content</div>\\r\\n</div>\",\n                            \"meta_title\": \"about us\",\n                            \"page_title\": \"About Us\",\n                            \"meta_keywords\": \"aboutus \", \"meta_description\": \"\"}', NULL, 1, 1, NULL, NULL),
(2, 'return-policy', '<div class=\"static-container one-column\">\n                                   <div class=\"mb-5\">Return policy page content</div>\n                                   </div>', 'Return Policy', 'return policy', '', 'return, policy', '{\"html\": \"<div class=\\\"static-container one-column\\\">\\r\\n<div class=\\\"mb-5\\\">Return policy page content</div>\\r\\n</div>\",\n                            \"meta_title\": \"return policy\",\n                            \"page_title\": \"Return Policy\",\n                            \"meta_keywords\": \"return, policy \", \"meta_description\": \"\"}', NULL, 1, 1, NULL, NULL),
(3, 'refund-policy', '<div class=\"static-container one-column\">\n                                   <div class=\"mb-5\">Refund policy page content</div>\n                                   </div>', 'Refund Policy', 'Refund policy', '', 'refund, policy', '{\"html\": \"<div class=\\\"static-container one-column\\\">\\r\\n<div class=\\\"mb-5\\\">Refund policy page content</div>\\r\\n</div>\",\n                            \"meta_title\": \"Refund policy\",\n                            \"page_title\": \"Refund Policy\",\n                            \"meta_keywords\": \"refund,policy \", \"meta_description\": \"\"}', NULL, 1, 1, NULL, NULL),
(4, 'terms-conditions', '<div class=\"static-container one-column\">\n                                   <div class=\"mb-5\">Terms & conditions page content</div>\n                                   </div>', 'Terms & Conditions', 'Terms & Conditions', '', 'term, conditions', '{\"html\": \"<div class=\\\"static-container one-column\\\">\\r\\n<div class=\\\"mb-5\\\">Terms & conditions page content</div>\\r\\n</div>\",\n                            \"meta_title\": \"Terms & Conditions\",\n                            \"page_title\": \"Terms & Conditions\",\n                            \"meta_keywords\": \"terms, conditions \", \"meta_description\": \"\"}', NULL, 1, 1, NULL, NULL),
(5, 'terms-of-use', '<div class=\"static-container one-column\">\n                                   <div class=\"mb-5\">Terms of use page content</div>\n                                   </div>', 'Terms of use', 'Terms of use', '', 'term, use', '{\"html\": \"<div class=\\\"static-container one-column\\\">\\r\\n<div class=\\\"mb-5\\\">Terms of use page content</div>\\r\\n</div>\",\n                            \"meta_title\": \"Terms of use\",\n                            \"page_title\": \"Terms of use\",\n                            \"meta_keywords\": \"terms, use \", \"meta_description\": \"\"}', NULL, 1, 1, NULL, NULL),
(6, 'contact-us', '<div class=\"static-container one-column\">\n                                   <div class=\"mb-5\">Contact us page content</div>\n                                   </div>', 'Contact Us', 'Contact Us', '', 'contact, us', '{\"html\": \"<div class=\\\"static-container one-column\\\">\\r\\n<div class=\\\"mb-5\\\">Contact us page content</div>\\r\\n</div>\",\n                            \"meta_title\": \"Contact Us\",\n                            \"page_title\": \"Contact Us\",\n                            \"meta_keywords\": \"contact, us \", \"meta_description\": \"\"}', NULL, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `core_config`
--

CREATE TABLE `core_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Åland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua & Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AC', 'Ascension Island'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia & Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BR', 'Brazil'),
(32, 'IO', 'British Indian Ocean Territory'),
(33, 'VG', 'British Virgin Islands'),
(34, 'BN', 'Brunei'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CA', 'Canada'),
(41, 'IC', 'Canary Islands'),
(42, 'CV', 'Cape Verde'),
(43, 'BQ', 'Caribbean Netherlands'),
(44, 'KY', 'Cayman Islands'),
(45, 'CF', 'Central African Republic'),
(46, 'EA', 'Ceuta & Melilla'),
(47, 'TD', 'Chad'),
(48, 'CL', 'Chile'),
(49, 'CN', 'China'),
(50, 'CX', 'Christmas Island'),
(51, 'CC', 'Cocos (Keeling) Islands'),
(52, 'CO', 'Colombia'),
(53, 'KM', 'Comoros'),
(54, 'CG', 'Congo - Brazzaville'),
(55, 'CD', 'Congo - Kinshasa'),
(56, 'CK', 'Cook Islands'),
(57, 'CR', 'Costa Rica'),
(58, 'CI', 'Côte d’Ivoire'),
(59, 'HR', 'Croatia'),
(60, 'CU', 'Cuba'),
(61, 'CW', 'Curaçao'),
(62, 'CY', 'Cyprus'),
(63, 'CZ', 'Czechia'),
(64, 'DK', 'Denmark'),
(65, 'DG', 'Diego Garcia'),
(66, 'DJ', 'Djibouti'),
(67, 'DM', 'Dominica'),
(68, 'DO', 'Dominican Republic'),
(69, 'EC', 'Ecuador'),
(70, 'EG', 'Egypt'),
(71, 'SV', 'El Salvador'),
(72, 'GQ', 'Equatorial Guinea'),
(73, 'ER', 'Eritrea'),
(74, 'EE', 'Estonia'),
(75, 'ET', 'Ethiopia'),
(76, 'EZ', 'Eurozone'),
(77, 'FK', 'Falkland Islands'),
(78, 'FO', 'Faroe Islands'),
(79, 'FJ', 'Fiji'),
(80, 'FI', 'Finland'),
(81, 'FR', 'France'),
(82, 'GF', 'French Guiana'),
(83, 'PF', 'French Polynesia'),
(84, 'TF', 'French Southern Territories'),
(85, 'GA', 'Gabon'),
(86, 'GM', 'Gambia'),
(87, 'GE', 'Georgia'),
(88, 'DE', 'Germany'),
(89, 'GH', 'Ghana'),
(90, 'GI', 'Gibraltar'),
(91, 'GR', 'Greece'),
(92, 'GL', 'Greenland'),
(93, 'GD', 'Grenada'),
(94, 'GP', 'Guadeloupe'),
(95, 'GU', 'Guam'),
(96, 'GT', 'Guatemala'),
(97, 'GG', 'Guernsey'),
(98, 'GN', 'Guinea'),
(99, 'GW', 'Guinea-Bissau'),
(100, 'GY', 'Guyana'),
(101, 'HT', 'Haiti'),
(102, 'HN', 'Honduras'),
(103, 'HK', 'Hong Kong SAR China'),
(104, 'HU', 'Hungary'),
(105, 'IS', 'Iceland'),
(106, 'IN', 'India'),
(107, 'ID', 'Indonesia'),
(108, 'IR', 'Iran'),
(109, 'IQ', 'Iraq'),
(110, 'IE', 'Ireland'),
(111, 'IM', 'Isle of Man'),
(112, 'IL', 'Israel'),
(113, 'IT', 'Italy'),
(114, 'JM', 'Jamaica'),
(115, 'JP', 'Japan'),
(116, 'JE', 'Jersey'),
(117, 'JO', 'Jordan'),
(118, 'KZ', 'Kazakhstan'),
(119, 'KE', 'Kenya'),
(120, 'KI', 'Kiribati'),
(121, 'XK', 'Kosovo'),
(122, 'KW', 'Kuwait'),
(123, 'KG', 'Kyrgyzstan'),
(124, 'LA', 'Laos'),
(125, 'LV', 'Latvia'),
(126, 'LB', 'Lebanon'),
(127, 'LS', 'Lesotho'),
(128, 'LR', 'Liberia'),
(129, 'LY', 'Libya'),
(130, 'LI', 'Liechtenstein'),
(131, 'LT', 'Lithuania'),
(132, 'LU', 'Luxembourg'),
(133, 'MO', 'Macau SAR China'),
(134, 'MK', 'Macedonia'),
(135, 'MG', 'Madagascar'),
(136, 'MW', 'Malawi'),
(137, 'MY', 'Malaysia'),
(138, 'MV', 'Maldives'),
(139, 'ML', 'Mali'),
(140, 'MT', 'Malta'),
(141, 'MH', 'Marshall Islands'),
(142, 'MQ', 'Martinique'),
(143, 'MR', 'Mauritania'),
(144, 'MU', 'Mauritius'),
(145, 'YT', 'Mayotte'),
(146, 'MX', 'Mexico'),
(147, 'FM', 'Micronesia'),
(148, 'MD', 'Moldova'),
(149, 'MC', 'Monaco'),
(150, 'MN', 'Mongolia'),
(151, 'ME', 'Montenegro'),
(152, 'MS', 'Montserrat'),
(153, 'MA', 'Morocco'),
(154, 'MZ', 'Mozambique'),
(155, 'MM', 'Myanmar (Burma)'),
(156, 'NA', 'Namibia'),
(157, 'NR', 'Nauru'),
(158, 'NP', 'Nepal'),
(159, 'NL', 'Netherlands'),
(160, 'NC', 'New Caledonia'),
(161, 'NZ', 'New Zealand'),
(162, 'NI', 'Nicaragua'),
(163, 'NE', 'Niger'),
(164, 'NG', 'Nigeria'),
(165, 'NU', 'Niue'),
(166, 'NF', 'Norfolk Island'),
(167, 'KP', 'North Korea'),
(168, 'MP', 'Northern Mariana Islands'),
(169, 'NO', 'Norway'),
(170, 'OM', 'Oman'),
(171, 'PK', 'Pakistan'),
(172, 'PW', 'Palau'),
(173, 'PS', 'Palestinian Territories'),
(174, 'PA', 'Panama'),
(175, 'PG', 'Papua New Guinea'),
(176, 'PY', 'Paraguay'),
(177, 'PE', 'Peru'),
(178, 'PH', 'Philippines'),
(179, 'PN', 'Pitcairn Islands'),
(180, 'PL', 'Poland'),
(181, 'PT', 'Portugal'),
(182, 'PR', 'Puerto Rico'),
(183, 'QA', 'Qatar'),
(184, 'RE', 'Réunion'),
(185, 'RO', 'Romania'),
(186, 'RU', 'Russia'),
(187, 'RW', 'Rwanda'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'São Tomé & Príncipe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SX', 'Sint Maarten'),
(198, 'SK', 'Slovakia'),
(199, 'SI', 'Slovenia'),
(200, 'SB', 'Solomon Islands'),
(201, 'SO', 'Somalia'),
(202, 'ZA', 'South Africa'),
(203, 'GS', 'South Georgia & South Sandwich Islands'),
(204, 'KR', 'South Korea'),
(205, 'SS', 'South Sudan'),
(206, 'ES', 'Spain'),
(207, 'LK', 'Sri Lanka'),
(208, 'BL', 'St. Barthélemy'),
(209, 'SH', 'St. Helena'),
(210, 'KN', 'St. Kitts & Nevis'),
(211, 'LC', 'St. Lucia'),
(212, 'MF', 'St. Martin'),
(213, 'PM', 'St. Pierre & Miquelon'),
(214, 'VC', 'St. Vincent & Grenadines'),
(215, 'SD', 'Sudan'),
(216, 'SR', 'Suriname'),
(217, 'SJ', 'Svalbard & Jan Mayen'),
(218, 'SZ', 'Swaziland'),
(219, 'SE', 'Sweden'),
(220, 'CH', 'Switzerland'),
(221, 'SY', 'Syria'),
(222, 'TW', 'Taiwan'),
(223, 'TJ', 'Tajikistan'),
(224, 'TZ', 'Tanzania'),
(225, 'TH', 'Thailand'),
(226, 'TL', 'Timor-Leste'),
(227, 'TG', 'Togo'),
(228, 'TK', 'Tokelau'),
(229, 'TO', 'Tonga'),
(230, 'TT', 'Trinidad & Tobago'),
(231, 'TA', 'Tristan da Cunha'),
(232, 'TN', 'Tunisia'),
(233, 'TR', 'Turkey'),
(234, 'TM', 'Turkmenistan'),
(235, 'TC', 'Turks & Caicos Islands'),
(236, 'TV', 'Tuvalu'),
(237, 'UM', 'U.S. Outlying Islands'),
(238, 'VI', 'U.S. Virgin Islands'),
(239, 'UG', 'Uganda'),
(240, 'UA', 'Ukraine'),
(241, 'AE', 'United Arab Emirates'),
(242, 'GB', 'United Kingdom'),
(243, 'UN', 'United Nations'),
(244, 'US', 'United States'),
(245, 'UY', 'Uruguay'),
(246, 'UZ', 'Uzbekistan'),
(247, 'VU', 'Vanuatu'),
(248, 'VA', 'Vatican City'),
(249, 'VE', 'Venezuela'),
(250, 'VN', 'Vietnam'),
(251, 'WF', 'Wallis & Futuna'),
(252, 'EH', 'Western Sahara'),
(253, 'YE', 'Yemen'),
(254, 'ZM', 'Zambia'),
(255, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- テーブルの構造 `country_states`
--

CREATE TABLE `country_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `country_states`
--

INSERT INTO `country_states` (`id`, `country_code`, `code`, `default_name`, `country_id`) VALUES
(1, 'US', 'AL', 'Alabama', 244),
(2, 'US', 'AK', 'Alaska', 244),
(3, 'US', 'AS', 'American Samoa', 244),
(4, 'US', 'AZ', 'Arizona', 244),
(5, 'US', 'AR', 'Arkansas', 244),
(6, 'US', 'AE', 'Armed Forces Africa', 244),
(7, 'US', 'AA', 'Armed Forces Americas', 244),
(8, 'US', 'AE', 'Armed Forces Canada', 244),
(9, 'US', 'AE', 'Armed Forces Europe', 244),
(10, 'US', 'AE', 'Armed Forces Middle East', 244),
(11, 'US', 'AP', 'Armed Forces Pacific', 244),
(12, 'US', 'CA', 'California', 244),
(13, 'US', 'CO', 'Colorado', 244),
(14, 'US', 'CT', 'Connecticut', 244),
(15, 'US', 'DE', 'Delaware', 244),
(16, 'US', 'DC', 'District of Columbia', 244),
(17, 'US', 'FM', 'Federated States Of Micronesia', 244),
(18, 'US', 'FL', 'Florida', 244),
(19, 'US', 'GA', 'Georgia', 244),
(20, 'US', 'GU', 'Guam', 244),
(21, 'US', 'HI', 'Hawaii', 244),
(22, 'US', 'ID', 'Idaho', 244),
(23, 'US', 'IL', 'Illinois', 244),
(24, 'US', 'IN', 'Indiana', 244),
(25, 'US', 'IA', 'Iowa', 244),
(26, 'US', 'KS', 'Kansas', 244),
(27, 'US', 'KY', 'Kentucky', 244),
(28, 'US', 'LA', 'Louisiana', 244),
(29, 'US', 'ME', 'Maine', 244),
(30, 'US', 'MH', 'Marshall Islands', 244),
(31, 'US', 'MD', 'Maryland', 244),
(32, 'US', 'MA', 'Massachusetts', 244),
(33, 'US', 'MI', 'Michigan', 244),
(34, 'US', 'MN', 'Minnesota', 244),
(35, 'US', 'MS', 'Mississippi', 244),
(36, 'US', 'MO', 'Missouri', 244),
(37, 'US', 'MT', 'Montana', 244),
(38, 'US', 'NE', 'Nebraska', 244),
(39, 'US', 'NV', 'Nevada', 244),
(40, 'US', 'NH', 'New Hampshire', 244),
(41, 'US', 'NJ', 'New Jersey', 244),
(42, 'US', 'NM', 'New Mexico', 244),
(43, 'US', 'NY', 'New York', 244),
(44, 'US', 'NC', 'North Carolina', 244),
(45, 'US', 'ND', 'North Dakota', 244),
(46, 'US', 'MP', 'Northern Mariana Islands', 244),
(47, 'US', 'OH', 'Ohio', 244),
(48, 'US', 'OK', 'Oklahoma', 244),
(49, 'US', 'OR', 'Oregon', 244),
(50, 'US', 'PW', 'Palau', 244),
(51, 'US', 'PA', 'Pennsylvania', 244),
(52, 'US', 'PR', 'Puerto Rico', 244),
(53, 'US', 'RI', 'Rhode Island', 244),
(54, 'US', 'SC', 'South Carolina', 244),
(55, 'US', 'SD', 'South Dakota', 244),
(56, 'US', 'TN', 'Tennessee', 244),
(57, 'US', 'TX', 'Texas', 244),
(58, 'US', 'UT', 'Utah', 244),
(59, 'US', 'VT', 'Vermont', 244),
(60, 'US', 'VI', 'Virgin Islands', 244),
(61, 'US', 'VA', 'Virginia', 244),
(62, 'US', 'WA', 'Washington', 244),
(63, 'US', 'WV', 'West Virginia', 244),
(64, 'US', 'WI', 'Wisconsin', 244),
(65, 'US', 'WY', 'Wyoming', 244),
(66, 'CA', 'AB', 'Alberta', 40),
(67, 'CA', 'BC', 'British Columbia', 40),
(68, 'CA', 'MB', 'Manitoba', 40),
(69, 'CA', 'NL', 'Newfoundland and Labrador', 40),
(70, 'CA', 'NB', 'New Brunswick', 40),
(71, 'CA', 'NS', 'Nova Scotia', 40),
(72, 'CA', 'NT', 'Northwest Territories', 40),
(73, 'CA', 'NU', 'Nunavut', 40),
(74, 'CA', 'ON', 'Ontario', 40),
(75, 'CA', 'PE', 'Prince Edward Island', 40),
(76, 'CA', 'QC', 'Quebec', 40),
(77, 'CA', 'SK', 'Saskatchewan', 40),
(78, 'CA', 'YT', 'Yukon Territory', 40),
(79, 'DE', 'NDS', 'Niedersachsen', 88),
(80, 'DE', 'BAW', 'Baden-Württemberg', 88),
(81, 'DE', 'BAY', 'Bayern', 88),
(82, 'DE', 'BER', 'Berlin', 88),
(83, 'DE', 'BRG', 'Brandenburg', 88),
(84, 'DE', 'BRE', 'Bremen', 88),
(85, 'DE', 'HAM', 'Hamburg', 88),
(86, 'DE', 'HES', 'Hessen', 88),
(87, 'DE', 'MEC', 'Mecklenburg-Vorpommern', 88),
(88, 'DE', 'NRW', 'Nordrhein-Westfalen', 88),
(89, 'DE', 'RHE', 'Rheinland-Pfalz', 88),
(90, 'DE', 'SAR', 'Saarland', 88),
(91, 'DE', 'SAS', 'Sachsen', 88),
(92, 'DE', 'SAC', 'Sachsen-Anhalt', 88),
(93, 'DE', 'SCN', 'Schleswig-Holstein', 88),
(94, 'DE', 'THE', 'Thüringen', 88),
(95, 'AT', 'WI', 'Wien', 16),
(96, 'AT', 'NO', 'Niederösterreich', 16),
(97, 'AT', 'OO', 'Oberösterreich', 16),
(98, 'AT', 'SB', 'Salzburg', 16),
(99, 'AT', 'KN', 'Kärnten', 16),
(100, 'AT', 'ST', 'Steiermark', 16),
(101, 'AT', 'TI', 'Tirol', 16),
(102, 'AT', 'BL', 'Burgenland', 16),
(103, 'AT', 'VB', 'Vorarlberg', 16),
(104, 'CH', 'AG', 'Aargau', 220),
(105, 'CH', 'AI', 'Appenzell Innerrhoden', 220),
(106, 'CH', 'AR', 'Appenzell Ausserrhoden', 220),
(107, 'CH', 'BE', 'Bern', 220),
(108, 'CH', 'BL', 'Basel-Landschaft', 220),
(109, 'CH', 'BS', 'Basel-Stadt', 220),
(110, 'CH', 'FR', 'Freiburg', 220),
(111, 'CH', 'GE', 'Genf', 220),
(112, 'CH', 'GL', 'Glarus', 220),
(113, 'CH', 'GR', 'Graubünden', 220),
(114, 'CH', 'JU', 'Jura', 220),
(115, 'CH', 'LU', 'Luzern', 220),
(116, 'CH', 'NE', 'Neuenburg', 220),
(117, 'CH', 'NW', 'Nidwalden', 220),
(118, 'CH', 'OW', 'Obwalden', 220),
(119, 'CH', 'SG', 'St. Gallen', 220),
(120, 'CH', 'SH', 'Schaffhausen', 220),
(121, 'CH', 'SO', 'Solothurn', 220),
(122, 'CH', 'SZ', 'Schwyz', 220),
(123, 'CH', 'TG', 'Thurgau', 220),
(124, 'CH', 'TI', 'Tessin', 220),
(125, 'CH', 'UR', 'Uri', 220),
(126, 'CH', 'VD', 'Waadt', 220),
(127, 'CH', 'VS', 'Wallis', 220),
(128, 'CH', 'ZG', 'Zug', 220),
(129, 'CH', 'ZH', 'Zürich', 220),
(130, 'ES', 'A Coruсa', 'A Coruña', 206),
(131, 'ES', 'Alava', 'Alava', 206),
(132, 'ES', 'Albacete', 'Albacete', 206),
(133, 'ES', 'Alicante', 'Alicante', 206),
(134, 'ES', 'Almeria', 'Almeria', 206),
(135, 'ES', 'Asturias', 'Asturias', 206),
(136, 'ES', 'Avila', 'Avila', 206),
(137, 'ES', 'Badajoz', 'Badajoz', 206),
(138, 'ES', 'Baleares', 'Baleares', 206),
(139, 'ES', 'Barcelona', 'Barcelona', 206),
(140, 'ES', 'Burgos', 'Burgos', 206),
(141, 'ES', 'Caceres', 'Caceres', 206),
(142, 'ES', 'Cadiz', 'Cadiz', 206),
(143, 'ES', 'Cantabria', 'Cantabria', 206),
(144, 'ES', 'Castellon', 'Castellon', 206),
(145, 'ES', 'Ceuta', 'Ceuta', 206),
(146, 'ES', 'Ciudad Real', 'Ciudad Real', 206),
(147, 'ES', 'Cordoba', 'Cordoba', 206),
(148, 'ES', 'Cuenca', 'Cuenca', 206),
(149, 'ES', 'Girona', 'Girona', 206),
(150, 'ES', 'Granada', 'Granada', 206),
(151, 'ES', 'Guadalajara', 'Guadalajara', 206),
(152, 'ES', 'Guipuzcoa', 'Guipuzcoa', 206),
(153, 'ES', 'Huelva', 'Huelva', 206),
(154, 'ES', 'Huesca', 'Huesca', 206),
(155, 'ES', 'Jaen', 'Jaen', 206),
(156, 'ES', 'La Rioja', 'La Rioja', 206),
(157, 'ES', 'Las Palmas', 'Las Palmas', 206),
(158, 'ES', 'Leon', 'Leon', 206),
(159, 'ES', 'Lleida', 'Lleida', 206),
(160, 'ES', 'Lugo', 'Lugo', 206),
(161, 'ES', 'Madrid', 'Madrid', 206),
(162, 'ES', 'Malaga', 'Malaga', 206),
(163, 'ES', 'Melilla', 'Melilla', 206),
(164, 'ES', 'Murcia', 'Murcia', 206),
(165, 'ES', 'Navarra', 'Navarra', 206),
(166, 'ES', 'Ourense', 'Ourense', 206),
(167, 'ES', 'Palencia', 'Palencia', 206),
(168, 'ES', 'Pontevedra', 'Pontevedra', 206),
(169, 'ES', 'Salamanca', 'Salamanca', 206),
(170, 'ES', 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', 206),
(171, 'ES', 'Segovia', 'Segovia', 206),
(172, 'ES', 'Sevilla', 'Sevilla', 206),
(173, 'ES', 'Soria', 'Soria', 206),
(174, 'ES', 'Tarragona', 'Tarragona', 206),
(175, 'ES', 'Teruel', 'Teruel', 206),
(176, 'ES', 'Toledo', 'Toledo', 206),
(177, 'ES', 'Valencia', 'Valencia', 206),
(178, 'ES', 'Valladolid', 'Valladolid', 206),
(179, 'ES', 'Vizcaya', 'Vizcaya', 206),
(180, 'ES', 'Zamora', 'Zamora', 206),
(181, 'ES', 'Zaragoza', 'Zaragoza', 206),
(182, 'FR', '1', 'Ain', 81),
(183, 'FR', '2', 'Aisne', 81),
(184, 'FR', '3', 'Allier', 81),
(185, 'FR', '4', 'Alpes-de-Haute-Provence', 81),
(186, 'FR', '5', 'Hautes-Alpes', 81),
(187, 'FR', '6', 'Alpes-Maritimes', 81),
(188, 'FR', '7', 'Ardèche', 81),
(189, 'FR', '8', 'Ardennes', 81),
(190, 'FR', '9', 'Ariège', 81),
(191, 'FR', '10', 'Aube', 81),
(192, 'FR', '11', 'Aude', 81),
(193, 'FR', '12', 'Aveyron', 81),
(194, 'FR', '13', 'Bouches-du-Rhône', 81),
(195, 'FR', '14', 'Calvados', 81),
(196, 'FR', '15', 'Cantal', 81),
(197, 'FR', '16', 'Charente', 81),
(198, 'FR', '17', 'Charente-Maritime', 81),
(199, 'FR', '18', 'Cher', 81),
(200, 'FR', '19', 'Corrèze', 81),
(201, 'FR', '2A', 'Corse-du-Sud', 81),
(202, 'FR', '2B', 'Haute-Corse', 81),
(203, 'FR', '21', 'Côte-d\'Or', 81),
(204, 'FR', '22', 'Côtes-d\'Armor', 81),
(205, 'FR', '23', 'Creuse', 81),
(206, 'FR', '24', 'Dordogne', 81),
(207, 'FR', '25', 'Doubs', 81),
(208, 'FR', '26', 'Drôme', 81),
(209, 'FR', '27', 'Eure', 81),
(210, 'FR', '28', 'Eure-et-Loir', 81),
(211, 'FR', '29', 'Finistère', 81),
(212, 'FR', '30', 'Gard', 81),
(213, 'FR', '31', 'Haute-Garonne', 81),
(214, 'FR', '32', 'Gers', 81),
(215, 'FR', '33', 'Gironde', 81),
(216, 'FR', '34', 'Hérault', 81),
(217, 'FR', '35', 'Ille-et-Vilaine', 81),
(218, 'FR', '36', 'Indre', 81),
(219, 'FR', '37', 'Indre-et-Loire', 81),
(220, 'FR', '38', 'Isère', 81),
(221, 'FR', '39', 'Jura', 81),
(222, 'FR', '40', 'Landes', 81),
(223, 'FR', '41', 'Loir-et-Cher', 81),
(224, 'FR', '42', 'Loire', 81),
(225, 'FR', '43', 'Haute-Loire', 81),
(226, 'FR', '44', 'Loire-Atlantique', 81),
(227, 'FR', '45', 'Loiret', 81),
(228, 'FR', '46', 'Lot', 81),
(229, 'FR', '47', 'Lot-et-Garonne', 81),
(230, 'FR', '48', 'Lozère', 81),
(231, 'FR', '49', 'Maine-et-Loire', 81),
(232, 'FR', '50', 'Manche', 81),
(233, 'FR', '51', 'Marne', 81),
(234, 'FR', '52', 'Haute-Marne', 81),
(235, 'FR', '53', 'Mayenne', 81),
(236, 'FR', '54', 'Meurthe-et-Moselle', 81),
(237, 'FR', '55', 'Meuse', 81),
(238, 'FR', '56', 'Morbihan', 81),
(239, 'FR', '57', 'Moselle', 81),
(240, 'FR', '58', 'Nièvre', 81),
(241, 'FR', '59', 'Nord', 81),
(242, 'FR', '60', 'Oise', 81),
(243, 'FR', '61', 'Orne', 81),
(244, 'FR', '62', 'Pas-de-Calais', 81),
(245, 'FR', '63', 'Puy-de-Dôme', 81),
(246, 'FR', '64', 'Pyrénées-Atlantiques', 81),
(247, 'FR', '65', 'Hautes-Pyrénées', 81),
(248, 'FR', '66', 'Pyrénées-Orientales', 81),
(249, 'FR', '67', 'Bas-Rhin', 81),
(250, 'FR', '68', 'Haut-Rhin', 81),
(251, 'FR', '69', 'Rhône', 81),
(252, 'FR', '70', 'Haute-Saône', 81),
(253, 'FR', '71', 'Saône-et-Loire', 81),
(254, 'FR', '72', 'Sarthe', 81),
(255, 'FR', '73', 'Savoie', 81),
(256, 'FR', '74', 'Haute-Savoie', 81),
(257, 'FR', '75', 'Paris', 81),
(258, 'FR', '76', 'Seine-Maritime', 81),
(259, 'FR', '77', 'Seine-et-Marne', 81),
(260, 'FR', '78', 'Yvelines', 81),
(261, 'FR', '79', 'Deux-Sèvres', 81),
(262, 'FR', '80', 'Somme', 81),
(263, 'FR', '81', 'Tarn', 81),
(264, 'FR', '82', 'Tarn-et-Garonne', 81),
(265, 'FR', '83', 'Var', 81),
(266, 'FR', '84', 'Vaucluse', 81),
(267, 'FR', '85', 'Vendée', 81),
(268, 'FR', '86', 'Vienne', 81),
(269, 'FR', '87', 'Haute-Vienne', 81),
(270, 'FR', '88', 'Vosges', 81),
(271, 'FR', '89', 'Yonne', 81),
(272, 'FR', '90', 'Territoire-de-Belfort', 81),
(273, 'FR', '91', 'Essonne', 81),
(274, 'FR', '92', 'Hauts-de-Seine', 81),
(275, 'FR', '93', 'Seine-Saint-Denis', 81),
(276, 'FR', '94', 'Val-de-Marne', 81),
(277, 'FR', '95', 'Val-d\'Oise', 81),
(278, 'RO', 'AB', 'Alba', 185),
(279, 'RO', 'AR', 'Arad', 185),
(280, 'RO', 'AG', 'Argeş', 185),
(281, 'RO', 'BC', 'Bacău', 185),
(282, 'RO', 'BH', 'Bihor', 185),
(283, 'RO', 'BN', 'Bistriţa-Năsăud', 185),
(284, 'RO', 'BT', 'Botoşani', 185),
(285, 'RO', 'BV', 'Braşov', 185),
(286, 'RO', 'BR', 'Brăila', 185),
(287, 'RO', 'B', 'Bucureşti', 185),
(288, 'RO', 'BZ', 'Buzău', 185),
(289, 'RO', 'CS', 'Caraş-Severin', 185),
(290, 'RO', 'CL', 'Călăraşi', 185),
(291, 'RO', 'CJ', 'Cluj', 185),
(292, 'RO', 'CT', 'Constanţa', 185),
(293, 'RO', 'CV', 'Covasna', 185),
(294, 'RO', 'DB', 'Dâmboviţa', 185),
(295, 'RO', 'DJ', 'Dolj', 185),
(296, 'RO', 'GL', 'Galaţi', 185),
(297, 'RO', 'GR', 'Giurgiu', 185),
(298, 'RO', 'GJ', 'Gorj', 185),
(299, 'RO', 'HR', 'Harghita', 185),
(300, 'RO', 'HD', 'Hunedoara', 185),
(301, 'RO', 'IL', 'Ialomiţa', 185),
(302, 'RO', 'IS', 'Iaşi', 185),
(303, 'RO', 'IF', 'Ilfov', 185),
(304, 'RO', 'MM', 'Maramureş', 185),
(305, 'RO', 'MH', 'Mehedinţi', 185),
(306, 'RO', 'MS', 'Mureş', 185),
(307, 'RO', 'NT', 'Neamţ', 185),
(308, 'RO', 'OT', 'Olt', 185),
(309, 'RO', 'PH', 'Prahova', 185),
(310, 'RO', 'SM', 'Satu-Mare', 185),
(311, 'RO', 'SJ', 'Sălaj', 185),
(312, 'RO', 'SB', 'Sibiu', 185),
(313, 'RO', 'SV', 'Suceava', 185),
(314, 'RO', 'TR', 'Teleorman', 185),
(315, 'RO', 'TM', 'Timiş', 185),
(316, 'RO', 'TL', 'Tulcea', 185),
(317, 'RO', 'VS', 'Vaslui', 185),
(318, 'RO', 'VL', 'Vâlcea', 185),
(319, 'RO', 'VN', 'Vrancea', 185),
(320, 'FI', 'Lappi', 'Lappi', 80),
(321, 'FI', 'Pohjois-Pohjanmaa', 'Pohjois-Pohjanmaa', 80),
(322, 'FI', 'Kainuu', 'Kainuu', 80),
(323, 'FI', 'Pohjois-Karjala', 'Pohjois-Karjala', 80),
(324, 'FI', 'Pohjois-Savo', 'Pohjois-Savo', 80),
(325, 'FI', 'Etelä-Savo', 'Etelä-Savo', 80),
(326, 'FI', 'Etelä-Pohjanmaa', 'Etelä-Pohjanmaa', 80),
(327, 'FI', 'Pohjanmaa', 'Pohjanmaa', 80),
(328, 'FI', 'Pirkanmaa', 'Pirkanmaa', 80),
(329, 'FI', 'Satakunta', 'Satakunta', 80),
(330, 'FI', 'Keski-Pohjanmaa', 'Keski-Pohjanmaa', 80),
(331, 'FI', 'Keski-Suomi', 'Keski-Suomi', 80),
(332, 'FI', 'Varsinais-Suomi', 'Varsinais-Suomi', 80),
(333, 'FI', 'Etelä-Karjala', 'Etelä-Karjala', 80),
(334, 'FI', 'Päijät-Häme', 'Päijät-Häme', 80),
(335, 'FI', 'Kanta-Häme', 'Kanta-Häme', 80),
(336, 'FI', 'Uusimaa', 'Uusimaa', 80),
(337, 'FI', 'Itä-Uusimaa', 'Itä-Uusimaa', 80),
(338, 'FI', 'Kymenlaakso', 'Kymenlaakso', 80),
(339, 'FI', 'Ahvenanmaa', 'Ahvenanmaa', 80),
(340, 'EE', 'EE-37', 'Harjumaa', 74),
(341, 'EE', 'EE-39', 'Hiiumaa', 74),
(342, 'EE', 'EE-44', 'Ida-Virumaa', 74),
(343, 'EE', 'EE-49', 'Jõgevamaa', 74),
(344, 'EE', 'EE-51', 'Järvamaa', 74),
(345, 'EE', 'EE-57', 'Läänemaa', 74),
(346, 'EE', 'EE-59', 'Lääne-Virumaa', 74),
(347, 'EE', 'EE-65', 'Põlvamaa', 74),
(348, 'EE', 'EE-67', 'Pärnumaa', 74),
(349, 'EE', 'EE-70', 'Raplamaa', 74),
(350, 'EE', 'EE-74', 'Saaremaa', 74),
(351, 'EE', 'EE-78', 'Tartumaa', 74),
(352, 'EE', 'EE-82', 'Valgamaa', 74),
(353, 'EE', 'EE-84', 'Viljandimaa', 74),
(354, 'EE', 'EE-86', 'Võrumaa', 74),
(355, 'LV', 'LV-DGV', 'Daugavpils', 125),
(356, 'LV', 'LV-JEL', 'Jelgava', 125),
(357, 'LV', 'Jēkabpils', 'Jēkabpils', 125),
(358, 'LV', 'LV-JUR', 'Jūrmala', 125),
(359, 'LV', 'LV-LPX', 'Liepāja', 125),
(360, 'LV', 'LV-LE', 'Liepājas novads', 125),
(361, 'LV', 'LV-REZ', 'Rēzekne', 125),
(362, 'LV', 'LV-RIX', 'Rīga', 125),
(363, 'LV', 'LV-RI', 'Rīgas novads', 125),
(364, 'LV', 'Valmiera', 'Valmiera', 125),
(365, 'LV', 'LV-VEN', 'Ventspils', 125),
(366, 'LV', 'Aglonas novads', 'Aglonas novads', 125),
(367, 'LV', 'LV-AI', 'Aizkraukles novads', 125),
(368, 'LV', 'Aizputes novads', 'Aizputes novads', 125),
(369, 'LV', 'Aknīstes novads', 'Aknīstes novads', 125),
(370, 'LV', 'Alojas novads', 'Alojas novads', 125),
(371, 'LV', 'Alsungas novads', 'Alsungas novads', 125),
(372, 'LV', 'LV-AL', 'Alūksnes novads', 125),
(373, 'LV', 'Amatas novads', 'Amatas novads', 125),
(374, 'LV', 'Apes novads', 'Apes novads', 125),
(375, 'LV', 'Auces novads', 'Auces novads', 125),
(376, 'LV', 'Babītes novads', 'Babītes novads', 125),
(377, 'LV', 'Baldones novads', 'Baldones novads', 125),
(378, 'LV', 'Baltinavas novads', 'Baltinavas novads', 125),
(379, 'LV', 'LV-BL', 'Balvu novads', 125),
(380, 'LV', 'LV-BU', 'Bauskas novads', 125),
(381, 'LV', 'Beverīnas novads', 'Beverīnas novads', 125),
(382, 'LV', 'Brocēnu novads', 'Brocēnu novads', 125),
(383, 'LV', 'Burtnieku novads', 'Burtnieku novads', 125),
(384, 'LV', 'Carnikavas novads', 'Carnikavas novads', 125),
(385, 'LV', 'Cesvaines novads', 'Cesvaines novads', 125),
(386, 'LV', 'Ciblas novads', 'Ciblas novads', 125),
(387, 'LV', 'LV-CE', 'Cēsu novads', 125),
(388, 'LV', 'Dagdas novads', 'Dagdas novads', 125),
(389, 'LV', 'LV-DA', 'Daugavpils novads', 125),
(390, 'LV', 'LV-DO', 'Dobeles novads', 125),
(391, 'LV', 'Dundagas novads', 'Dundagas novads', 125),
(392, 'LV', 'Durbes novads', 'Durbes novads', 125),
(393, 'LV', 'Engures novads', 'Engures novads', 125),
(394, 'LV', 'Garkalnes novads', 'Garkalnes novads', 125),
(395, 'LV', 'Grobiņas novads', 'Grobiņas novads', 125),
(396, 'LV', 'LV-GU', 'Gulbenes novads', 125),
(397, 'LV', 'Iecavas novads', 'Iecavas novads', 125),
(398, 'LV', 'Ikšķiles novads', 'Ikšķiles novads', 125),
(399, 'LV', 'Ilūkstes novads', 'Ilūkstes novads', 125),
(400, 'LV', 'Inčukalna novads', 'Inčukalna novads', 125),
(401, 'LV', 'Jaunjelgavas novads', 'Jaunjelgavas novads', 125),
(402, 'LV', 'Jaunpiebalgas novads', 'Jaunpiebalgas novads', 125),
(403, 'LV', 'Jaunpils novads', 'Jaunpils novads', 125),
(404, 'LV', 'LV-JL', 'Jelgavas novads', 125),
(405, 'LV', 'LV-JK', 'Jēkabpils novads', 125),
(406, 'LV', 'Kandavas novads', 'Kandavas novads', 125),
(407, 'LV', 'Kokneses novads', 'Kokneses novads', 125),
(408, 'LV', 'Krimuldas novads', 'Krimuldas novads', 125),
(409, 'LV', 'Krustpils novads', 'Krustpils novads', 125),
(410, 'LV', 'LV-KR', 'Krāslavas novads', 125),
(411, 'LV', 'LV-KU', 'Kuldīgas novads', 125),
(412, 'LV', 'Kārsavas novads', 'Kārsavas novads', 125),
(413, 'LV', 'Lielvārdes novads', 'Lielvārdes novads', 125),
(414, 'LV', 'LV-LM', 'Limbažu novads', 125),
(415, 'LV', 'Lubānas novads', 'Lubānas novads', 125),
(416, 'LV', 'LV-LU', 'Ludzas novads', 125),
(417, 'LV', 'Līgatnes novads', 'Līgatnes novads', 125),
(418, 'LV', 'Līvānu novads', 'Līvānu novads', 125),
(419, 'LV', 'LV-MA', 'Madonas novads', 125),
(420, 'LV', 'Mazsalacas novads', 'Mazsalacas novads', 125),
(421, 'LV', 'Mālpils novads', 'Mālpils novads', 125),
(422, 'LV', 'Mārupes novads', 'Mārupes novads', 125),
(423, 'LV', 'Naukšēnu novads', 'Naukšēnu novads', 125),
(424, 'LV', 'Neretas novads', 'Neretas novads', 125),
(425, 'LV', 'Nīcas novads', 'Nīcas novads', 125),
(426, 'LV', 'LV-OG', 'Ogres novads', 125),
(427, 'LV', 'Olaines novads', 'Olaines novads', 125),
(428, 'LV', 'Ozolnieku novads', 'Ozolnieku novads', 125),
(429, 'LV', 'LV-PR', 'Preiļu novads', 125),
(430, 'LV', 'Priekules novads', 'Priekules novads', 125),
(431, 'LV', 'Priekuļu novads', 'Priekuļu novads', 125),
(432, 'LV', 'Pārgaujas novads', 'Pārgaujas novads', 125),
(433, 'LV', 'Pāvilostas novads', 'Pāvilostas novads', 125),
(434, 'LV', 'Pļaviņu novads', 'Pļaviņu novads', 125),
(435, 'LV', 'Raunas novads', 'Raunas novads', 125),
(436, 'LV', 'Riebiņu novads', 'Riebiņu novads', 125),
(437, 'LV', 'Rojas novads', 'Rojas novads', 125),
(438, 'LV', 'Ropažu novads', 'Ropažu novads', 125),
(439, 'LV', 'Rucavas novads', 'Rucavas novads', 125),
(440, 'LV', 'Rugāju novads', 'Rugāju novads', 125),
(441, 'LV', 'Rundāles novads', 'Rundāles novads', 125),
(442, 'LV', 'LV-RE', 'Rēzeknes novads', 125),
(443, 'LV', 'Rūjienas novads', 'Rūjienas novads', 125),
(444, 'LV', 'Salacgrīvas novads', 'Salacgrīvas novads', 125),
(445, 'LV', 'Salas novads', 'Salas novads', 125),
(446, 'LV', 'Salaspils novads', 'Salaspils novads', 125),
(447, 'LV', 'LV-SA', 'Saldus novads', 125),
(448, 'LV', 'Saulkrastu novads', 'Saulkrastu novads', 125),
(449, 'LV', 'Siguldas novads', 'Siguldas novads', 125),
(450, 'LV', 'Skrundas novads', 'Skrundas novads', 125),
(451, 'LV', 'Skrīveru novads', 'Skrīveru novads', 125),
(452, 'LV', 'Smiltenes novads', 'Smiltenes novads', 125),
(453, 'LV', 'Stopiņu novads', 'Stopiņu novads', 125),
(454, 'LV', 'Strenču novads', 'Strenču novads', 125),
(455, 'LV', 'Sējas novads', 'Sējas novads', 125),
(456, 'LV', 'LV-TA', 'Talsu novads', 125),
(457, 'LV', 'LV-TU', 'Tukuma novads', 125),
(458, 'LV', 'Tērvetes novads', 'Tērvetes novads', 125),
(459, 'LV', 'Vaiņodes novads', 'Vaiņodes novads', 125),
(460, 'LV', 'LV-VK', 'Valkas novads', 125),
(461, 'LV', 'LV-VM', 'Valmieras novads', 125),
(462, 'LV', 'Varakļānu novads', 'Varakļānu novads', 125),
(463, 'LV', 'Vecpiebalgas novads', 'Vecpiebalgas novads', 125),
(464, 'LV', 'Vecumnieku novads', 'Vecumnieku novads', 125),
(465, 'LV', 'LV-VE', 'Ventspils novads', 125),
(466, 'LV', 'Viesītes novads', 'Viesītes novads', 125),
(467, 'LV', 'Viļakas novads', 'Viļakas novads', 125),
(468, 'LV', 'Viļānu novads', 'Viļānu novads', 125),
(469, 'LV', 'Vārkavas novads', 'Vārkavas novads', 125),
(470, 'LV', 'Zilupes novads', 'Zilupes novads', 125),
(471, 'LV', 'Ādažu novads', 'Ādažu novads', 125),
(472, 'LV', 'Ērgļu novads', 'Ērgļu novads', 125),
(473, 'LV', 'Ķeguma novads', 'Ķeguma novads', 125),
(474, 'LV', 'Ķekavas novads', 'Ķekavas novads', 125),
(475, 'LT', 'LT-AL', 'Alytaus Apskritis', 131),
(476, 'LT', 'LT-KU', 'Kauno Apskritis', 131),
(477, 'LT', 'LT-KL', 'Klaipėdos Apskritis', 131),
(478, 'LT', 'LT-MR', 'Marijampolės Apskritis', 131),
(479, 'LT', 'LT-PN', 'Panevėžio Apskritis', 131),
(480, 'LT', 'LT-SA', 'Šiaulių Apskritis', 131),
(481, 'LT', 'LT-TA', 'Tauragės Apskritis', 131),
(482, 'LT', 'LT-TE', 'Telšių Apskritis', 131),
(483, 'LT', 'LT-UT', 'Utenos Apskritis', 131),
(484, 'LT', 'LT-VL', 'Vilniaus Apskritis', 131),
(485, 'BR', 'AC', 'Acre', 31),
(486, 'BR', 'AL', 'Alagoas', 31),
(487, 'BR', 'AP', 'Amapá', 31),
(488, 'BR', 'AM', 'Amazonas', 31),
(489, 'BR', 'BA', 'Bahia', 31),
(490, 'BR', 'CE', 'Ceará', 31),
(491, 'BR', 'ES', 'Espírito Santo', 31),
(492, 'BR', 'GO', 'Goiás', 31),
(493, 'BR', 'MA', 'Maranhão', 31),
(494, 'BR', 'MT', 'Mato Grosso', 31),
(495, 'BR', 'MS', 'Mato Grosso do Sul', 31),
(496, 'BR', 'MG', 'Minas Gerais', 31),
(497, 'BR', 'PA', 'Pará', 31),
(498, 'BR', 'PB', 'Paraíba', 31),
(499, 'BR', 'PR', 'Paraná', 31),
(500, 'BR', 'PE', 'Pernambuco', 31),
(501, 'BR', 'PI', 'Piauí', 31),
(502, 'BR', 'RJ', 'Rio de Janeiro', 31),
(503, 'BR', 'RN', 'Rio Grande do Norte', 31),
(504, 'BR', 'RS', 'Rio Grande do Sul', 31),
(505, 'BR', 'RO', 'Rondônia', 31),
(506, 'BR', 'RR', 'Roraima', 31),
(507, 'BR', 'SC', 'Santa Catarina', 31),
(508, 'BR', 'SP', 'São Paulo', 31),
(509, 'BR', 'SE', 'Sergipe', 31),
(510, 'BR', 'TO', 'Tocantins', 31),
(511, 'BR', 'DF', 'Distrito Federal', 31),
(512, 'HR', 'HR-01', 'Zagrebačka županija', 59),
(513, 'HR', 'HR-02', 'Krapinsko-zagorska županija', 59),
(514, 'HR', 'HR-03', 'Sisačko-moslavačka županija', 59),
(515, 'HR', 'HR-04', 'Karlovačka županija', 59),
(516, 'HR', 'HR-05', 'Varaždinska županija', 59),
(517, 'HR', 'HR-06', 'Koprivničko-križevačka županija', 59),
(518, 'HR', 'HR-07', 'Bjelovarsko-bilogorska županija', 59),
(519, 'HR', 'HR-08', 'Primorsko-goranska županija', 59),
(520, 'HR', 'HR-09', 'Ličko-senjska županija', 59),
(521, 'HR', 'HR-10', 'Virovitičko-podravska županija', 59),
(522, 'HR', 'HR-11', 'Požeško-slavonska županija', 59),
(523, 'HR', 'HR-12', 'Brodsko-posavska županija', 59),
(524, 'HR', 'HR-13', 'Zadarska županija', 59),
(525, 'HR', 'HR-14', 'Osječko-baranjska županija', 59),
(526, 'HR', 'HR-15', 'Šibensko-kninska županija', 59),
(527, 'HR', 'HR-16', 'Vukovarsko-srijemska županija', 59),
(528, 'HR', 'HR-17', 'Splitsko-dalmatinska županija', 59),
(529, 'HR', 'HR-18', 'Istarska županija', 59),
(530, 'HR', 'HR-19', 'Dubrovačko-neretvanska županija', 59),
(531, 'HR', 'HR-20', 'Međimurska županija', 59),
(532, 'HR', 'HR-21', 'Grad Zagreb', 59),
(533, 'IN', 'AN', 'Andaman and Nicobar Islands', 106),
(534, 'IN', 'AP', 'Andhra Pradesh', 106),
(535, 'IN', 'AR', 'Arunachal Pradesh', 106),
(536, 'IN', 'AS', 'Assam', 106),
(537, 'IN', 'BR', 'Bihar', 106),
(538, 'IN', 'CH', 'Chandigarh', 106),
(539, 'IN', 'CT', 'Chhattisgarh', 106),
(540, 'IN', 'DN', 'Dadra and Nagar Haveli', 106),
(541, 'IN', 'DD', 'Daman and Diu', 106),
(542, 'IN', 'DL', 'Delhi', 106),
(543, 'IN', 'GA', 'Goa', 106),
(544, 'IN', 'GJ', 'Gujarat', 106),
(545, 'IN', 'HR', 'Haryana', 106),
(546, 'IN', 'HP', 'Himachal Pradesh', 106),
(547, 'IN', 'JK', 'Jammu and Kashmir', 106),
(548, 'IN', 'JH', 'Jharkhand', 106),
(549, 'IN', 'KA', 'Karnataka', 106),
(550, 'IN', 'KL', 'Kerala', 106),
(551, 'IN', 'LD', 'Lakshadweep', 106),
(552, 'IN', 'MP', 'Madhya Pradesh', 106),
(553, 'IN', 'MH', 'Maharashtra', 106),
(554, 'IN', 'MN', 'Manipur', 106),
(555, 'IN', 'ML', 'Meghalaya', 106),
(556, 'IN', 'MZ', 'Mizoram', 106),
(557, 'IN', 'NL', 'Nagaland', 106),
(558, 'IN', 'OR', 'Odisha', 106),
(559, 'IN', 'PY', 'Puducherry', 106),
(560, 'IN', 'PB', 'Punjab', 106),
(561, 'IN', 'RJ', 'Rajasthan', 106),
(562, 'IN', 'SK', 'Sikkim', 106),
(563, 'IN', 'TN', 'Tamil Nadu', 106),
(564, 'IN', 'TG', 'Telangana', 106),
(565, 'IN', 'TR', 'Tripura', 106),
(566, 'IN', 'UP', 'Uttar Pradesh', 106),
(567, 'IN', 'UT', 'Uttarakhand', 106),
(568, 'IN', 'WB', 'West Bengal', 106);

-- --------------------------------------------------------

--
-- テーブルの構造 `country_state_translations`
--

CREATE TABLE `country_state_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_state_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `country_translations`
--

CREATE TABLE `country_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `created_at`, `updated_at`, `symbol`) VALUES
(1, 'USD', 'US Dollar', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `currency_exchange_rates`
--

CREATE TABLE `currency_exchange_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` decimal(24,12) NOT NULL,
  `target_currency` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_group_id` int(10) UNSIGNED DEFAULT NULL,
  `subscribed_to_news_letter` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_address` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `name`, `is_user_defined`, `created_at`, `updated_at`, `code`) VALUES
(1, 'Guest', 0, NULL, NULL, 'guest'),
(2, 'General', 0, NULL, NULL, 'general'),
(3, 'Wholesale', 0, NULL, NULL, 'wholesale');

-- --------------------------------------------------------

--
-- テーブルの構造 `customer_password_resets`
--

CREATE TABLE `customer_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `downloadable_link_purchased`
--

CREATE TABLE `downloadable_link_purchased` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_bought` int(11) NOT NULL DEFAULT 0,
  `download_used` int(11) NOT NULL DEFAULT 0,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_item_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `inventory_sources`
--

CREATE TABLE `inventory_sources` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `latitude` decimal(10,5) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `inventory_sources`
--

INSERT INTO `inventory_sources` (`id`, `code`, `name`, `description`, `contact_name`, `contact_email`, `contact_number`, `contact_fax`, `country`, `state`, `city`, `street`, `postcode`, `priority`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 'default', 'Default', NULL, 'Detroit Warehouse', 'warehouse@example.com', '1234567899', NULL, 'US', 'MI', 'Detroit', '12th Street', '48127', 0, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `increment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `total_qty` int(11) DEFAULT NULL,
  `base_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` decimal(12,4) DEFAULT 0.0000,
  `base_sub_total` decimal(12,4) DEFAULT 0.0000,
  `grand_total` decimal(12,4) DEFAULT 0.0000,
  `base_grand_total` decimal(12,4) DEFAULT 0.0000,
  `shipping_amount` decimal(12,4) DEFAULT 0.0000,
  `base_shipping_amount` decimal(12,4) DEFAULT 0.0000,
  `tax_amount` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) DEFAULT 0.0000,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `order_address_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `tax_amount` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount` decimal(12,4) DEFAULT 0.0000,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_percent` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `locales`
--

CREATE TABLE `locales` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `direction` enum('ltr','rtl') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `locales`
--

INSERT INTO `locales` (`id`, `code`, `name`, `created_at`, `updated_at`, `direction`) VALUES
(1, 'en', 'English', NULL, NULL, 'ltr'),
(2, 'ja', '日本語', '2020-01-08 11:49:35', '2020-01-08 11:49:35', 'ltr');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_admin_password_resets_table', 1),
(3, '2014_10_12_100000_create_agent_password_resets_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2014_10_12_100000_create_vendor_password_resets_table', 1),
(6, '2018_06_12_111907_create_admins_table', 1),
(7, '2018_06_13_055341_create_agent_roles_table', 1),
(8, '2018_06_13_055341_create_roles_table', 1),
(9, '2018_06_13_055341_create_vendor_roles_table', 1),
(10, '2018_07_05_130148_create_attributes_table', 1),
(11, '2018_07_05_132854_create_attribute_translations_table', 1),
(12, '2018_07_05_135150_create_attribute_families_table', 1),
(13, '2018_07_05_135152_create_attribute_groups_table', 1),
(14, '2018_07_05_140832_create_attribute_options_table', 1),
(15, '2018_07_05_140856_create_attribute_option_translations_table', 1),
(16, '2018_07_05_142820_create_categories_table', 1),
(17, '2018_07_10_055143_create_locales_table', 1),
(18, '2018_07_20_054426_create_countries_table', 1),
(19, '2018_07_20_054502_create_currencies_table', 1),
(20, '2018_07_20_054542_create_currency_exchange_rates_table', 1),
(21, '2018_07_20_064849_create_channels_table', 1),
(22, '2018_07_21_142836_create_category_translations_table', 1),
(23, '2018_07_23_110040_create_agent_sources_table', 1),
(24, '2018_07_23_110040_create_inventory_sources_table', 1),
(25, '2018_07_23_110040_create_vendor_sources_table', 1),
(26, '2018_07_24_082635_create_customer_groups_table', 1),
(27, '2018_07_24_082930_create_customers_table', 1),
(28, '2018_07_24_083025_create_customer_addresses_table', 1),
(29, '2018_07_27_065727_create_products_table', 1),
(30, '2018_07_27_070011_create_product_attribute_values_table', 1),
(31, '2018_07_27_092623_create_product_reviews_table', 1),
(32, '2018_07_27_113941_create_product_images_table', 1),
(33, '2018_07_27_113956_create_product_inventories_table', 1),
(34, '2018_08_03_114203_create_sliders_table', 1),
(35, '2018_08_30_064755_create_tax_categories_table', 1),
(36, '2018_08_30_065042_create_tax_rates_table', 1),
(37, '2018_08_30_065840_create_tax_mappings_table', 1),
(38, '2018_09_05_150444_create_cart_table', 1),
(39, '2018_09_05_150915_create_cart_items_table', 1),
(40, '2018_09_11_064045_customer_password_resets', 1),
(41, '2018_09_19_092845_create_cart_address', 1),
(42, '2018_09_19_093453_create_cart_payment', 1),
(43, '2018_09_19_093508_create_cart_shipping_rates_table', 1),
(44, '2018_09_20_060658_create_core_config_table', 1),
(45, '2018_09_27_113154_create_orders_table', 1),
(46, '2018_09_27_113207_create_order_items_table', 1),
(47, '2018_09_27_113405_create_order_address_table', 1),
(48, '2018_09_27_115022_create_shipments_table', 1),
(49, '2018_09_27_115029_create_shipment_items_table', 1),
(50, '2018_09_27_115135_create_invoices_table', 1),
(51, '2018_09_27_115144_create_invoice_items_table', 1),
(52, '2018_10_01_095504_create_order_payment_table', 1),
(53, '2018_10_03_025230_create_wishlist_table', 1),
(54, '2018_10_12_101803_create_country_translations_table', 1),
(55, '2018_10_12_101913_create_country_states_table', 1),
(56, '2018_10_12_101923_create_country_state_translations_table', 1),
(57, '2018_11_15_153257_alter_order_table', 1),
(58, '2018_11_15_163729_alter_invoice_table', 1),
(59, '2018_11_16_173504_create_subscribers_list_table', 1),
(60, '2018_11_17_165758_add_is_verified_column_in_customers_table', 1),
(61, '2018_11_21_144411_create_cart_item_inventories_table', 1),
(62, '2018_11_26_110500_change_gender_column_in_customers_table', 1),
(63, '2018_11_27_174449_change_content_column_in_sliders_table', 1),
(64, '2018_12_05_132625_drop_foreign_key_core_config_table', 1),
(65, '2018_12_05_132629_alter_core_config_table', 1),
(66, '2018_12_06_185202_create_product_flat_table', 1),
(67, '2018_12_21_101307_alter_channels_table', 1),
(68, '2018_12_24_123812_create_channel_inventory_sources_table', 1),
(69, '2018_12_24_184402_alter_shipments_table', 1),
(70, '2018_12_26_165327_create_product_ordered_inventories_table', 1),
(71, '2018_12_31_161114_alter_channels_category_table', 1),
(72, '2019_01_11_122452_add_vendor_id_column_in_product_inventories_table', 1),
(73, '2019_01_25_124522_add_updated_at_column_in_product_flat_table', 1),
(74, '2019_01_29_123053_add_min_price_and_max_price_column_in_product_flat_table', 1),
(75, '2019_01_31_164117_update_value_column_type_to_text_in_core_config_table', 1),
(76, '2019_02_21_145238_alter_product_reviews_table', 1),
(77, '2019_02_21_152709_add_swatch_type_column_in_attributes_table', 1),
(78, '2019_02_21_153035_alter_customer_id_in_product_reviews_table', 1),
(79, '2019_02_21_153851_add_swatch_value_columns_in_attribute_options_table', 1),
(80, '2019_03_15_123337_add_display_mode_column_in_categories_table', 1),
(81, '2019_03_28_103658_add_notes_column_in_customers_table', 1),
(82, '2019_04_24_155820_alter_product_flat_table', 1),
(83, '2019_05_13_024326_create_cart_rule_table', 1),
(84, '2019_05_13_024340_create_cart_rule_channels_table', 1),
(85, '2019_05_13_024419_create_cart_rule_customer_groups_table', 1),
(86, '2019_05_16_094238_create_cart_rule_labels_table', 1),
(87, '2019_05_22_165833_update_zipcode_column_type_to_varchar_in_cart_address_table', 1),
(88, '2019_05_23_113407_add_remaining_column_in_product_flat_table', 1),
(89, '2019_05_23_155520_add_discount_columns_in_invoice_items_table', 1),
(90, '2019_05_23_175727_create_cart_rule_customers_table', 1),
(91, '2019_05_23_180457_create_cart_rule_coupons_table', 1),
(92, '2019_05_23_184029_rename_discount_columns_in_cart_table', 1),
(93, '2019_05_24_113949_create_cart_rule_coupons_usage_table', 1),
(94, '2019_05_30_141207_create_cart_rule_cart_table', 1),
(95, '2019_06_04_114009_add_phone_column_in_customers_table', 1),
(96, '2019_06_06_195905_update_custom_price_to_nullable_in_cart_items', 1),
(97, '2019_06_15_183412_add_code_column_in_customer_groups_table', 1),
(98, '2019_06_17_180258_create_product_downloadable_samples_table', 1),
(99, '2019_06_17_180314_create_product_downloadable_sample_translations_table', 1),
(100, '2019_06_17_180325_create_product_downloadable_links_table', 1),
(101, '2019_06_17_180346_create_product_downloadable_link_translations_table', 1),
(102, '2019_06_19_162817_remove_unique_in_phone_column_in_customers_table', 1),
(103, '2019_06_21_130512_update_weight_column_deafult_value_in_cart_items_table', 1),
(104, '2019_06_21_202249_create_downloadable_link_purchased_table', 1),
(105, '2019_06_25_110122_remove_is_guest_from_cart_rules_table', 1),
(106, '2019_07_05_114157_add_symbol_column_in_currencies_table', 1),
(107, '2019_07_11_151210_add_locale_id_in_category_translations', 1),
(108, '2019_07_14_070809_add_products_selection_column_in_cart_rules_table', 1),
(109, '2019_07_23_033128_alter_locales_table', 1),
(110, '2019_07_29_142734_add_use_in_flat_column_in_attributes_table', 1),
(111, '2019_07_30_153530_create_cms_pages_table', 1),
(112, '2019_07_31_143339_create_category_filterable_attributes_table', 1),
(113, '2019_08_02_105320_create_product_grouped_products_table', 1),
(114, '2019_08_08_130433_create_catalog_rules_table', 1),
(115, '2019_08_08_130451_create_catalog_rule_customer_groups_table', 1),
(116, '2019_08_08_130458_create_catalog_rule_channels_table', 1),
(117, '2019_08_08_130550_create_catalog_rule_products_table', 1),
(118, '2019_08_08_130583_create_catalog_rule_products_price_table', 1),
(119, '2019_08_12_184925_add_additional_cloumn_in_wishlist_table', 1),
(120, '2019_08_20_170510_create_product_bundle_options_table', 1),
(121, '2019_08_20_170520_create_product_bundle_option_translations_table', 1),
(122, '2019_08_20_170528_create_product_bundle_option_products_table', 1),
(123, '2019_08_21_123707_add_seo_column_in_channels_table', 1),
(124, '2019_09_11_184511_create_refunds_table', 1),
(125, '2019_09_11_184519_create_refund_items_table', 1),
(126, '2019_09_26_163950_remove_channel_id_from_customers_table', 1),
(127, '2019_10_03_105451_change_rate_column_in_currency_exchange_rates_table', 1),
(128, '2019_10_24_173358_change_postcode_column_type_in_order_address_table', 1),
(129, '2019_10_24_173437_change_postcode_column_type_in_cart_address_table', 1),
(130, '2019_10_24_173507_change_postcode_column_type_in_customer_addresses_table', 1),
(131, '2019_11_21_194541_add_column_url_path_to_category_translations', 1),
(132, '2019_11_21_194608_add_stored_function_to_get_url_path_of_category', 1),
(133, '2019_11_21_194627_add_trigger_to_category_translations', 1),
(134, '2019_11_21_194648_add_url_path_to_existing_category_translations', 1),
(135, '2019_11_21_194703_add_trigger_to_categories', 1),
(136, '2017_07_07_171903_create_shops_table', 2),
(137, '2018_01_23_153809_add_billing_to_shops_table', 2),
(138, '2018_06_03_184733_add_soft_delete_to_shops_table', 2),
(139, '2018_06_03_185902_create_charges_table', 2),
(140, '2018_06_03_190233_remove_charge_id_from_shops_table', 2),
(141, '2018_08_16_123209_modify_charge_id_type', 2),
(142, '2018_08_30_114021_add_namespace_to_shops_table', 2),
(143, '2018_08_31_153154_create_plans_table', 2),
(144, '2018_08_31_154001_add_plan_to_shops_table_and_charges_table', 2),
(145, '2018_08_31_154502_add_freemium_flag_to_shops_table', 2),
(146, '2018_09_11_101333_add_usage_charge_support_to_charges_table', 2),
(147, '2018_09_12_101645_add_default_to_test_on_charges_table', 2),
(148, '2019_06_20_091212_add_charges_table_expires_on', 2),
(149, '2020_01_15_170929_create_failed_jobs_table', 3),
(150, '2020_01_19_072104_create_jobs_table', 4);

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `increment_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint(1) DEFAULT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_gift` tinyint(1) NOT NULL DEFAULT 0,
  `total_item_count` int(11) DEFAULT NULL,
  `total_qty_ordered` int(11) DEFAULT NULL,
  `base_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` decimal(12,4) DEFAULT 0.0000,
  `base_grand_total` decimal(12,4) DEFAULT 0.0000,
  `grand_total_invoiced` decimal(12,4) DEFAULT 0.0000,
  `base_grand_total_invoiced` decimal(12,4) DEFAULT 0.0000,
  `grand_total_refunded` decimal(12,4) DEFAULT 0.0000,
  `base_grand_total_refunded` decimal(12,4) DEFAULT 0.0000,
  `sub_total` decimal(12,4) DEFAULT 0.0000,
  `base_sub_total` decimal(12,4) DEFAULT 0.0000,
  `sub_total_invoiced` decimal(12,4) DEFAULT 0.0000,
  `base_sub_total_invoiced` decimal(12,4) DEFAULT 0.0000,
  `sub_total_refunded` decimal(12,4) DEFAULT 0.0000,
  `base_sub_total_refunded` decimal(12,4) DEFAULT 0.0000,
  `discount_percent` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) DEFAULT 0.0000,
  `discount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `base_discount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `discount_refunded` decimal(12,4) DEFAULT 0.0000,
  `base_discount_refunded` decimal(12,4) DEFAULT 0.0000,
  `tax_amount` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount` decimal(12,4) DEFAULT 0.0000,
  `tax_amount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `tax_amount_refunded` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount_refunded` decimal(12,4) DEFAULT 0.0000,
  `shipping_amount` decimal(12,4) DEFAULT 0.0000,
  `base_shipping_amount` decimal(12,4) DEFAULT 0.0000,
  `shipping_invoiced` decimal(12,4) DEFAULT 0.0000,
  `base_shipping_invoiced` decimal(12,4) DEFAULT 0.0000,
  `shipping_refunded` decimal(12,4) DEFAULT 0.0000,
  `base_shipping_refunded` decimal(12,4) DEFAULT 0.0000,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_address`
--

CREATE TABLE `order_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(12,4) DEFAULT 0.0000,
  `total_weight` decimal(12,4) DEFAULT 0.0000,
  `qty_ordered` int(11) DEFAULT 0,
  `qty_shipped` int(11) DEFAULT 0,
  `qty_invoiced` int(11) DEFAULT 0,
  `qty_canceled` int(11) DEFAULT 0,
  `qty_refunded` int(11) DEFAULT 0,
  `price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `total_invoiced` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_total_invoiced` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `amount_refunded` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_amount_refunded` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `discount_percent` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) DEFAULT 0.0000,
  `discount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `base_discount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `discount_refunded` decimal(12,4) DEFAULT 0.0000,
  `base_discount_refunded` decimal(12,4) DEFAULT 0.0000,
  `tax_percent` decimal(12,4) DEFAULT 0.0000,
  `tax_amount` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount` decimal(12,4) DEFAULT 0.0000,
  `tax_amount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount_invoiced` decimal(12,4) DEFAULT 0.0000,
  `tax_amount_refunded` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount_refunded` decimal(12,4) DEFAULT 0.0000,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_payment`
--

CREATE TABLE `order_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `capped_amount` decimal(8,2) DEFAULT NULL,
  `terms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `test` tinyint(1) NOT NULL DEFAULT 0,
  `on_install` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `attribute_family_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` int(11) DEFAULT NULL,
  `float_value` double DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `date_value` date DEFAULT NULL,
  `json_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_value`)),
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_bundle_options`
--

CREATE TABLE `product_bundle_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_bundle_option_products`
--

CREATE TABLE `product_bundle_option_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `product_bundle_option_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_bundle_option_translations`
--

CREATE TABLE `product_bundle_option_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_bundle_option_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_cross_sells`
--

CREATE TABLE `product_cross_sells` (
  `parent_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_downloadable_links`
--

CREATE TABLE `product_downloadable_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `sample_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downloads` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(11) DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_downloadable_link_translations`
--

CREATE TABLE `product_downloadable_link_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_downloadable_link_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_downloadable_samples`
--

CREATE TABLE `product_downloadable_samples` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_downloadable_sample_translations`
--

CREATE TABLE `product_downloadable_sample_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_downloadable_sample_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_flat`
--

CREATE TABLE `product_flat` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new` tinyint(1) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(12,4) DEFAULT NULL,
  `cost` decimal(12,4) DEFAULT NULL,
  `special_price` decimal(12,4) DEFAULT NULL,
  `special_price_from` date DEFAULT NULL,
  `special_price_to` date DEFAULT NULL,
  `weight` decimal(12,4) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `color_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `size_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `visible_individually` tinyint(1) DEFAULT NULL,
  `min_price` decimal(12,4) DEFAULT NULL,
  `max_price` decimal(12,4) DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` decimal(12,4) DEFAULT NULL,
  `height` decimal(12,4) DEFAULT NULL,
  `depth` decimal(12,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_grouped_products`
--

CREATE TABLE `product_grouped_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL,
  `associated_product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_inventories`
--

CREATE TABLE `product_inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL,
  `inventory_source_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_ordered_inventories`
--

CREATE TABLE `product_ordered_inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_relations`
--

CREATE TABLE `product_relations` (
  `parent_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_super_attributes`
--

CREATE TABLE `product_super_attributes` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_up_sells`
--

CREATE TABLE `product_up_sells` (
  `parent_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `refunds`
--

CREATE TABLE `refunds` (
  `id` int(10) UNSIGNED NOT NULL,
  `increment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `total_qty` int(11) DEFAULT NULL,
  `base_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adjustment_refund` decimal(12,4) DEFAULT 0.0000,
  `base_adjustment_refund` decimal(12,4) DEFAULT 0.0000,
  `adjustment_fee` decimal(12,4) DEFAULT 0.0000,
  `base_adjustment_fee` decimal(12,4) DEFAULT 0.0000,
  `sub_total` decimal(12,4) DEFAULT 0.0000,
  `base_sub_total` decimal(12,4) DEFAULT 0.0000,
  `grand_total` decimal(12,4) DEFAULT 0.0000,
  `base_grand_total` decimal(12,4) DEFAULT 0.0000,
  `shipping_amount` decimal(12,4) DEFAULT 0.0000,
  `base_shipping_amount` decimal(12,4) DEFAULT 0.0000,
  `tax_amount` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount` decimal(12,4) DEFAULT 0.0000,
  `discount_percent` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) DEFAULT 0.0000,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `refund_items`
--

CREATE TABLE `refund_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_price` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `base_total` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `tax_amount` decimal(12,4) DEFAULT 0.0000,
  `base_tax_amount` decimal(12,4) DEFAULT 0.0000,
  `discount_percent` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `base_discount_amount` decimal(12,4) DEFAULT 0.0000,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` int(10) UNSIGNED DEFAULT NULL,
  `refund_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `permission_type`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator rolem', 'all', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `shipments`
--

CREATE TABLE `shipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_weight` int(11) DEFAULT NULL,
  `carrier_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carrier_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_address_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inventory_source_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `shipment_items`
--

CREATE TABLE `shipment_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `price` decimal(12,4) DEFAULT 0.0000,
  `base_price` decimal(12,4) DEFAULT 0.0000,
  `total` decimal(12,4) DEFAULT 0.0000,
  `base_total` decimal(12,4) DEFAULT 0.0000,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` int(10) UNSIGNED DEFAULT NULL,
  `shipment_id` int(10) UNSIGNED NOT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `shops`
--

CREATE TABLE `shops` (
  `id` int(10) UNSIGNED NOT NULL,
  `shopify_domain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grandfathered` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `namespace` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `freemium` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `subscribers_list`
--

CREATE TABLE `subscribers_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_subscribed` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `tax_categories`
--

CREATE TABLE `tax_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `tax_categories_tax_rates`
--

CREATE TABLE `tax_categories_tax_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_category_id` int(10) UNSIGNED NOT NULL,
  `tax_rate_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_zip` tinyint(1) NOT NULL DEFAULT 0,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate` decimal(12,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `vendor_password_resets`
--

CREATE TABLE `vendor_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- テーブルの構造 `vendor_roles`
--

CREATE TABLE `vendor_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `vendor_roles`
--

INSERT INTO `vendor_roles` (`id`, `name`, `description`, `permission_type`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator rolem', 'all', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `vendor_sources`
--

CREATE TABLE `vendor_sources` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(10) UNSIGNED NOT NULL,
  `name_kana` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creditcard_main_apikey` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creditcard_denki_apikey` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_transfer_company_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smartcis_my_auth_id` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smartcis_my_auth_key` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_denki_shop_code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `gmo_main_site_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmo_main_site_pass` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmo_main_shop_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmo_main_shop_pass` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmo_denki_site_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmo_denki_site_pass` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmo_denki_shop_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmo_denki_shop_pass` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplus_bank_consignor_number` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplus_division` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplus_conveni_consignor_number` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplus_transfer_date` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- テーブルのデータのダンプ `vendor_sources`
--

INSERT INTO `vendor_sources` (`id`, `name`, `email`, `password`, `status`, `role_id`, `name_kana`, `creditcard_main_apikey`, `creditcard_denki_apikey`, `account_transfer_company_code`, `smartcis_my_auth_id`, `smartcis_my_auth_key`, `vendor_denki_shop_code`, `updated_at`, `updated_user_id`, `created_at`, `created_user_id`, `gmo_main_site_id`, `gmo_main_site_pass`, `gmo_main_shop_id`, `gmo_main_shop_pass`, `gmo_denki_site_id`, `gmo_denki_site_pass`, `gmo_denki_shop_id`, `gmo_denki_shop_pass`, `aplus_bank_consignor_number`, `aplus_division`, `aplus_conveni_consignor_number`, `aplus_transfer_date`, `remember_token`) VALUES
(1, 'wp', 'wp@example.com', '$2y$10$giUE2baHiSbg/Ij9A07muOeA1nLQQmawhuQiv1tIiLMhCoe7vnnaG', 1, 1, 'ou hou', '123456789', '1234567899', '123', '1', 'MI', '1', '2001-12-20 00:00:00', 1, '2001-12-20 00:00:00', 1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'z5b0i46REU9mhfmyC37VYCcNzdacXgQ0GCq0XoL3qEJCbclf1XSv6bYhwL4C');

-- --------------------------------------------------------

--
-- テーブルの構造 `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `item_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`item_options`)),
  `moved_to_cart` date DEFAULT NULL,
  `shared` tinyint(1) DEFAULT NULL,
  `time_of_moving` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- テーブルのインデックス `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- テーブルのインデックス `agent_password_resets`
--
ALTER TABLE `agent_password_resets`
  ADD KEY `agent_password_resets_email_index` (`email`);

--
-- テーブルのインデックス `agent_roles`
--
ALTER TABLE `agent_roles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `agent_sources`
--
ALTER TABLE `agent_sources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agent_sources_email_unique` (`email`);

--
-- テーブルのインデックス `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_code_unique` (`code`);

--
-- テーブルのインデックス `attribute_families`
--
ALTER TABLE `attribute_families`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_groups_attribute_family_id_name_unique` (`attribute_family_id`,`name`);

--
-- テーブルのインデックス `attribute_group_mappings`
--
ALTER TABLE `attribute_group_mappings`
  ADD PRIMARY KEY (`attribute_id`,`attribute_group_id`),
  ADD KEY `attribute_group_mappings_attribute_group_id_foreign` (`attribute_group_id`);

--
-- テーブルのインデックス `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_options_attribute_id_foreign` (`attribute_id`);

--
-- テーブルのインデックス `attribute_option_translations`
--
ALTER TABLE `attribute_option_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_option_translations_attribute_option_id_locale_unique` (`attribute_option_id`,`locale`);

--
-- テーブルのインデックス `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_translations_attribute_id_locale_unique` (`attribute_id`,`locale`);

--
-- テーブルのインデックス `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_customer_id_foreign` (`customer_id`),
  ADD KEY `cart_channel_id_foreign` (`channel_id`);

--
-- テーブルのインデックス `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_address_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_address_customer_id_foreign` (`customer_id`);

--
-- テーブルのインデックス `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_tax_category_id_foreign` (`tax_category_id`),
  ADD KEY `cart_items_parent_id_foreign` (`parent_id`);

--
-- テーブルのインデックス `cart_item_inventories`
--
ALTER TABLE `cart_item_inventories`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `cart_payment`
--
ALTER TABLE `cart_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_payment_cart_id_foreign` (`cart_id`);

--
-- テーブルのインデックス `cart_rules`
--
ALTER TABLE `cart_rules`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `cart_rule_cart`
--
ALTER TABLE `cart_rule_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_cart_cart_rule_id_foreign` (`cart_rule_id`),
  ADD KEY `cart_rule_cart_cart_id_foreign` (`cart_id`);

--
-- テーブルのインデックス `cart_rule_channels`
--
ALTER TABLE `cart_rule_channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_channels_cart_rule_id_foreign` (`cart_rule_id`),
  ADD KEY `cart_rule_channels_channel_id_foreign` (`channel_id`);

--
-- テーブルのインデックス `cart_rule_coupons`
--
ALTER TABLE `cart_rule_coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_coupons_cart_rule_id_foreign` (`cart_rule_id`);

--
-- テーブルのインデックス `cart_rule_coupons_usage`
--
ALTER TABLE `cart_rule_coupons_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_coupons_usage_coupon_id_foreign` (`coupon_id`),
  ADD KEY `cart_rule_coupons_usage_channel_id_foreign` (`channel_id`),
  ADD KEY `cart_rule_coupons_usage_customer_id_foreign` (`customer_id`);

--
-- テーブルのインデックス `cart_rule_customers`
--
ALTER TABLE `cart_rule_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_customers_cart_rule_id_foreign` (`cart_rule_id`),
  ADD KEY `cart_rule_customers_customer_id_foreign` (`customer_id`);

--
-- テーブルのインデックス `cart_rule_customer_groups`
--
ALTER TABLE `cart_rule_customer_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_customer_groups_cart_rule_id_foreign` (`cart_rule_id`),
  ADD KEY `cart_rule_customer_groups_customer_group_id_foreign` (`customer_group_id`);

--
-- テーブルのインデックス `cart_rule_labels`
--
ALTER TABLE `cart_rule_labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_labels_channel_id_foreign` (`channel_id`),
  ADD KEY `cart_rule_labels_locale_id_foreign` (`locale_id`),
  ADD KEY `cart_rule_labels_cart_rule_id_foreign` (`cart_rule_id`);

--
-- テーブルのインデックス `cart_shipping_rates`
--
ALTER TABLE `cart_shipping_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_shipping_rates_cart_address_id_foreign` (`cart_address_id`);

--
-- テーブルのインデックス `catalog_rules`
--
ALTER TABLE `catalog_rules`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `catalog_rule_channels`
--
ALTER TABLE `catalog_rule_channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_rule_channels_channel_id_foreign` (`channel_id`),
  ADD KEY `catalog_rule_channels_catalog_rule_id_foreign` (`catalog_rule_id`);

--
-- テーブルのインデックス `catalog_rule_customer_groups`
--
ALTER TABLE `catalog_rule_customer_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_rule_customer_groups_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `catalog_rule_customer_groups_catalog_rule_id_foreign` (`catalog_rule_id`);

--
-- テーブルのインデックス `catalog_rule_products`
--
ALTER TABLE `catalog_rule_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_rule_products_catalog_rule_id_foreign` (`catalog_rule_id`),
  ADD KEY `catalog_rule_products_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `catalog_rule_products_channel_id_foreign` (`channel_id`),
  ADD KEY `catalog_rule_products_product_id_foreign` (`product_id`);

--
-- テーブルのインデックス `catalog_rule_products_price`
--
ALTER TABLE `catalog_rule_products_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_rule_products_price_channel_id_foreign` (`channel_id`),
  ADD KEY `catalog_rule_products_price_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `catalog_rule_products_price_product_id_foreign` (`product_id`),
  ADD KEY `catalog_rule_products_price_catalog_rule_id_foreign` (`catalog_rule_id`);

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- テーブルのインデックス `category_filterable_attributes`
--
ALTER TABLE `category_filterable_attributes`
  ADD KEY `category_filterable_attributes_category_id_foreign` (`category_id`),
  ADD KEY `category_filterable_attributes_attribute_id_foreign` (`attribute_id`);

--
-- テーブルのインデックス `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_slug_locale_unique` (`category_id`,`slug`,`locale`),
  ADD KEY `category_translations_locale_id_foreign` (`locale_id`);

--
-- テーブルのインデックス `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channels_default_locale_id_foreign` (`default_locale_id`),
  ADD KEY `channels_base_currency_id_foreign` (`base_currency_id`),
  ADD KEY `channels_root_category_id_foreign` (`root_category_id`);

--
-- テーブルのインデックス `channel_currencies`
--
ALTER TABLE `channel_currencies`
  ADD PRIMARY KEY (`channel_id`,`currency_id`),
  ADD KEY `channel_currencies_currency_id_foreign` (`currency_id`);

--
-- テーブルのインデックス `channel_inventory_sources`
--
ALTER TABLE `channel_inventory_sources`
  ADD UNIQUE KEY `channel_inventory_sources_channel_id_inventory_source_id_unique` (`channel_id`,`inventory_source_id`),
  ADD KEY `channel_inventory_sources_inventory_source_id_foreign` (`inventory_source_id`);

--
-- テーブルのインデックス `channel_locales`
--
ALTER TABLE `channel_locales`
  ADD PRIMARY KEY (`channel_id`,`locale_id`),
  ADD KEY `channel_locales_locale_id_foreign` (`locale_id`);

--
-- テーブルのインデックス `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `charges_charge_id_unique` (`charge_id`),
  ADD KEY `charges_shop_id_foreign` (`shop_id`),
  ADD KEY `charges_plan_id_foreign` (`plan_id`),
  ADD KEY `charges_reference_charge_foreign` (`reference_charge`);

--
-- テーブルのインデックス `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_pages_channel_id_foreign` (`channel_id`),
  ADD KEY `cms_pages_locale_id_foreign` (`locale_id`);

--
-- テーブルのインデックス `core_config`
--
ALTER TABLE `core_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `core_config_channel_id_foreign` (`channel_code`);

--
-- テーブルのインデックス `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `country_states`
--
ALTER TABLE `country_states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_states_country_id_foreign` (`country_id`);

--
-- テーブルのインデックス `country_state_translations`
--
ALTER TABLE `country_state_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_state_translations_country_state_id_foreign` (`country_state_id`);

--
-- テーブルのインデックス `country_translations`
--
ALTER TABLE `country_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_translations_country_id_foreign` (`country_id`);

--
-- テーブルのインデックス `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_exchange_rates_target_currency_unique` (`target_currency`);

--
-- テーブルのインデックス `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_customer_group_id_foreign` (`customer_group_id`);

--
-- テーブルのインデックス `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_customer_id_foreign` (`customer_id`);

--
-- テーブルのインデックス `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_groups_code_unique` (`code`);

--
-- テーブルのインデックス `customer_password_resets`
--
ALTER TABLE `customer_password_resets`
  ADD KEY `customer_password_resets_email_index` (`email`);

--
-- テーブルのインデックス `downloadable_link_purchased`
--
ALTER TABLE `downloadable_link_purchased`
  ADD PRIMARY KEY (`id`),
  ADD KEY `downloadable_link_purchased_customer_id_foreign` (`customer_id`),
  ADD KEY `downloadable_link_purchased_order_id_foreign` (`order_id`),
  ADD KEY `downloadable_link_purchased_order_item_id_foreign` (`order_item_id`);

--
-- テーブルのインデックス `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `inventory_sources`
--
ALTER TABLE `inventory_sources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_sources_code_unique` (`code`);

--
-- テーブルのインデックス `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_order_id_foreign` (`order_id`),
  ADD KEY `invoices_order_address_id_foreign` (`order_address_id`);

--
-- テーブルのインデックス `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_items_parent_id_foreign` (`parent_id`);

--
-- テーブルのインデックス `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- テーブルのインデックス `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locales_code_unique` (`code`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_channel_id_foreign` (`channel_id`);

--
-- テーブルのインデックス `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_address_order_id_foreign` (`order_id`),
  ADD KEY `order_address_customer_id_foreign` (`customer_id`);

--
-- テーブルのインデックス `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_parent_id_foreign` (`parent_id`);

--
-- テーブルのインデックス `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_payment_order_id_foreign` (`order_id`);

--
-- テーブルのインデックス `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- テーブルのインデックス `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_attribute_family_id_foreign` (`attribute_family_id`),
  ADD KEY `products_parent_id_foreign` (`parent_id`);

--
-- テーブルのインデックス `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chanel_locale_attribute_value_index_unique` (`channel`,`locale`,`attribute_id`,`product_id`),
  ADD KEY `product_attribute_values_product_id_foreign` (`product_id`),
  ADD KEY `product_attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- テーブルのインデックス `product_bundle_options`
--
ALTER TABLE `product_bundle_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_bundle_options_product_id_foreign` (`product_id`);

--
-- テーブルのインデックス `product_bundle_option_products`
--
ALTER TABLE `product_bundle_option_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_bundle_option_products_product_bundle_option_id_foreign` (`product_bundle_option_id`),
  ADD KEY `product_bundle_option_products_product_id_foreign` (`product_id`);

--
-- テーブルのインデックス `product_bundle_option_translations`
--
ALTER TABLE `product_bundle_option_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_bundle_option_translations_option_id_locale_unique` (`product_bundle_option_id`,`locale`);

--
-- テーブルのインデックス `product_categories`
--
ALTER TABLE `product_categories`
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- テーブルのインデックス `product_cross_sells`
--
ALTER TABLE `product_cross_sells`
  ADD KEY `product_cross_sells_parent_id_foreign` (`parent_id`),
  ADD KEY `product_cross_sells_child_id_foreign` (`child_id`);

--
-- テーブルのインデックス `product_downloadable_links`
--
ALTER TABLE `product_downloadable_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_downloadable_links_product_id_foreign` (`product_id`);

--
-- テーブルのインデックス `product_downloadable_link_translations`
--
ALTER TABLE `product_downloadable_link_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_translations_link_id_foreign` (`product_downloadable_link_id`);

--
-- テーブルのインデックス `product_downloadable_samples`
--
ALTER TABLE `product_downloadable_samples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_downloadable_samples_product_id_foreign` (`product_id`);

--
-- テーブルのインデックス `product_downloadable_sample_translations`
--
ALTER TABLE `product_downloadable_sample_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sample_translations_sample_id_foreign` (`product_downloadable_sample_id`);

--
-- テーブルのインデックス `product_flat`
--
ALTER TABLE `product_flat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_flat_unique_index` (`product_id`,`channel`,`locale`),
  ADD KEY `product_flat_parent_id_foreign` (`parent_id`);

--
-- テーブルのインデックス `product_grouped_products`
--
ALTER TABLE `product_grouped_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_grouped_products_product_id_foreign` (`product_id`),
  ADD KEY `product_grouped_products_associated_product_id_foreign` (`associated_product_id`);

--
-- テーブルのインデックス `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- テーブルのインデックス `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_source_vendor_index_unique` (`product_id`,`inventory_source_id`,`vendor_id`),
  ADD KEY `product_inventories_inventory_source_id_foreign` (`inventory_source_id`);

--
-- テーブルのインデックス `product_ordered_inventories`
--
ALTER TABLE `product_ordered_inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_ordered_inventories_product_id_channel_id_unique` (`product_id`,`channel_id`),
  ADD KEY `product_ordered_inventories_channel_id_foreign` (`channel_id`);

--
-- テーブルのインデックス `product_relations`
--
ALTER TABLE `product_relations`
  ADD KEY `product_relations_parent_id_foreign` (`parent_id`),
  ADD KEY `product_relations_child_id_foreign` (`child_id`);

--
-- テーブルのインデックス `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_customer_id_foreign` (`customer_id`);

--
-- テーブルのインデックス `product_super_attributes`
--
ALTER TABLE `product_super_attributes`
  ADD KEY `product_super_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_super_attributes_attribute_id_foreign` (`attribute_id`);

--
-- テーブルのインデックス `product_up_sells`
--
ALTER TABLE `product_up_sells`
  ADD KEY `product_up_sells_parent_id_foreign` (`parent_id`),
  ADD KEY `product_up_sells_child_id_foreign` (`child_id`);

--
-- テーブルのインデックス `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_order_id_foreign` (`order_id`);

--
-- テーブルのインデックス `refund_items`
--
ALTER TABLE `refund_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refund_items_order_item_id_foreign` (`order_item_id`),
  ADD KEY `refund_items_refund_id_foreign` (`refund_id`),
  ADD KEY `refund_items_parent_id_foreign` (`parent_id`);

--
-- テーブルのインデックス `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_order_id_foreign` (`order_id`),
  ADD KEY `shipments_order_address_id_foreign` (`order_address_id`),
  ADD KEY `shipments_inventory_source_id_foreign` (`inventory_source_id`);

--
-- テーブルのインデックス `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_items_shipment_id_foreign` (`shipment_id`);

--
-- テーブルのインデックス `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shops_plan_id_foreign` (`plan_id`);

--
-- テーブルのインデックス `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_channel_id_foreign` (`channel_id`);

--
-- テーブルのインデックス `subscribers_list`
--
ALTER TABLE `subscribers_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscribers_list_channel_id_foreign` (`channel_id`);

--
-- テーブルのインデックス `tax_categories`
--
ALTER TABLE `tax_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tax_categories_code_unique` (`code`),
  ADD UNIQUE KEY `tax_categories_name_unique` (`name`),
  ADD KEY `tax_categories_channel_id_foreign` (`channel_id`);

--
-- テーブルのインデックス `tax_categories_tax_rates`
--
ALTER TABLE `tax_categories_tax_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tax_map_index_unique` (`tax_category_id`,`tax_rate_id`),
  ADD KEY `tax_categories_tax_rates_tax_rate_id_foreign` (`tax_rate_id`);

--
-- テーブルのインデックス `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tax_rates_identifier_unique` (`identifier`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- テーブルのインデックス `vendor_password_resets`
--
ALTER TABLE `vendor_password_resets`
  ADD KEY `vendor_password_resets_email_index` (`email`);

--
-- テーブルのインデックス `vendor_roles`
--
ALTER TABLE `vendor_roles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `vendor_sources`
--
ALTER TABLE `vendor_sources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendor_sources_email_unique` (`email`);

--
-- テーブルのインデックス `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_channel_id_foreign` (`channel_id`),
  ADD KEY `wishlist_product_id_foreign` (`product_id`),
  ADD KEY `wishlist_customer_id_foreign` (`customer_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `agent_roles`
--
ALTER TABLE `agent_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `agent_sources`
--
ALTER TABLE `agent_sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '代理店ID', AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルのAUTO_INCREMENT `attribute_families`
--
ALTER TABLE `attribute_families`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `attribute_groups`
--
ALTER TABLE `attribute_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルのAUTO_INCREMENT `attribute_option_translations`
--
ALTER TABLE `attribute_option_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルのAUTO_INCREMENT `attribute_translations`
--
ALTER TABLE `attribute_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルのAUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_item_inventories`
--
ALTER TABLE `cart_item_inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_payment`
--
ALTER TABLE `cart_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rules`
--
ALTER TABLE `cart_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rule_cart`
--
ALTER TABLE `cart_rule_cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rule_channels`
--
ALTER TABLE `cart_rule_channels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rule_coupons`
--
ALTER TABLE `cart_rule_coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rule_coupons_usage`
--
ALTER TABLE `cart_rule_coupons_usage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rule_customers`
--
ALTER TABLE `cart_rule_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rule_customer_groups`
--
ALTER TABLE `cart_rule_customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_rule_labels`
--
ALTER TABLE `cart_rule_labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cart_shipping_rates`
--
ALTER TABLE `cart_shipping_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `catalog_rules`
--
ALTER TABLE `catalog_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `catalog_rule_channels`
--
ALTER TABLE `catalog_rule_channels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `catalog_rule_customer_groups`
--
ALTER TABLE `catalog_rule_customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `catalog_rule_products`
--
ALTER TABLE `catalog_rule_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `catalog_rule_products_price`
--
ALTER TABLE `catalog_rule_products_price`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルのAUTO_INCREMENT `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルのAUTO_INCREMENT `core_config`
--
ALTER TABLE `core_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- テーブルのAUTO_INCREMENT `country_states`
--
ALTER TABLE `country_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;

--
-- テーブルのAUTO_INCREMENT `country_state_translations`
--
ALTER TABLE `country_state_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `country_translations`
--
ALTER TABLE `country_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `downloadable_link_purchased`
--
ALTER TABLE `downloadable_link_purchased`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `inventory_sources`
--
ALTER TABLE `inventory_sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルのAUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- テーブルのAUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `order_address`
--
ALTER TABLE `order_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_bundle_options`
--
ALTER TABLE `product_bundle_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_bundle_option_products`
--
ALTER TABLE `product_bundle_option_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_bundle_option_translations`
--
ALTER TABLE `product_bundle_option_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_downloadable_links`
--
ALTER TABLE `product_downloadable_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_downloadable_link_translations`
--
ALTER TABLE `product_downloadable_link_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_downloadable_samples`
--
ALTER TABLE `product_downloadable_samples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_downloadable_sample_translations`
--
ALTER TABLE `product_downloadable_sample_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_flat`
--
ALTER TABLE `product_flat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_grouped_products`
--
ALTER TABLE `product_grouped_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_inventories`
--
ALTER TABLE `product_inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_ordered_inventories`
--
ALTER TABLE `product_ordered_inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `refund_items`
--
ALTER TABLE `refund_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `shipment_items`
--
ALTER TABLE `shipment_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `subscribers_list`
--
ALTER TABLE `subscribers_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `tax_categories`
--
ALTER TABLE `tax_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `tax_categories_tax_rates`
--
ALTER TABLE `tax_categories_tax_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `vendor_roles`
--
ALTER TABLE `vendor_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `vendor_sources`
--
ALTER TABLE `vendor_sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD CONSTRAINT `attribute_groups_attribute_family_id_foreign` FOREIGN KEY (`attribute_family_id`) REFERENCES `attribute_families` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `attribute_group_mappings`
--
ALTER TABLE `attribute_group_mappings`
  ADD CONSTRAINT `attribute_group_mappings_attribute_group_id_foreign` FOREIGN KEY (`attribute_group_id`) REFERENCES `attribute_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_group_mappings_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `attribute_option_translations`
--
ALTER TABLE `attribute_option_translations`
  ADD CONSTRAINT `attribute_option_translations_attribute_option_id_foreign` FOREIGN KEY (`attribute_option_id`) REFERENCES `attribute_options` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD CONSTRAINT `attribute_translations_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_address_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `cart_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_tax_category_id_foreign` FOREIGN KEY (`tax_category_id`) REFERENCES `tax_categories` (`id`);

--
-- テーブルの制約 `cart_payment`
--
ALTER TABLE `cart_payment`
  ADD CONSTRAINT `cart_payment_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_rule_cart`
--
ALTER TABLE `cart_rule_cart`
  ADD CONSTRAINT `cart_rule_cart_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_cart_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_rule_channels`
--
ALTER TABLE `cart_rule_channels`
  ADD CONSTRAINT `cart_rule_channels_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_channels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_rule_coupons`
--
ALTER TABLE `cart_rule_coupons`
  ADD CONSTRAINT `cart_rule_coupons_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_rule_coupons_usage`
--
ALTER TABLE `cart_rule_coupons_usage`
  ADD CONSTRAINT `cart_rule_coupons_usage_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_coupons_usage_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_coupons_usage_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_rule_customers`
--
ALTER TABLE `cart_rule_customers`
  ADD CONSTRAINT `cart_rule_customers_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_customers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_rule_customer_groups`
--
ALTER TABLE `cart_rule_customer_groups`
  ADD CONSTRAINT `cart_rule_customer_groups_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_customer_groups_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_rule_labels`
--
ALTER TABLE `cart_rule_labels`
  ADD CONSTRAINT `cart_rule_labels_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_labels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_labels_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cart_shipping_rates`
--
ALTER TABLE `cart_shipping_rates`
  ADD CONSTRAINT `cart_shipping_rates_cart_address_id_foreign` FOREIGN KEY (`cart_address_id`) REFERENCES `cart_address` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `catalog_rule_channels`
--
ALTER TABLE `catalog_rule_channels`
  ADD CONSTRAINT `catalog_rule_channels_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_channels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `catalog_rule_customer_groups`
--
ALTER TABLE `catalog_rule_customer_groups`
  ADD CONSTRAINT `catalog_rule_customer_groups_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_customer_groups_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `catalog_rule_products`
--
ALTER TABLE `catalog_rule_products`
  ADD CONSTRAINT `catalog_rule_products_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `catalog_rule_products_price`
--
ALTER TABLE `catalog_rule_products_price`
  ADD CONSTRAINT `catalog_rule_products_price_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_price_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_price_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_price_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `category_filterable_attributes`
--
ALTER TABLE `category_filterable_attributes`
  ADD CONSTRAINT `category_filterable_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_filterable_attributes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_translations_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_base_currency_id_foreign` FOREIGN KEY (`base_currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `channels_default_locale_id_foreign` FOREIGN KEY (`default_locale_id`) REFERENCES `locales` (`id`),
  ADD CONSTRAINT `channels_root_category_id_foreign` FOREIGN KEY (`root_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- テーブルの制約 `channel_currencies`
--
ALTER TABLE `channel_currencies`
  ADD CONSTRAINT `channel_currencies_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `channel_currencies_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `channel_inventory_sources`
--
ALTER TABLE `channel_inventory_sources`
  ADD CONSTRAINT `channel_inventory_sources_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `channel_inventory_sources_inventory_source_id_foreign` FOREIGN KEY (`inventory_source_id`) REFERENCES `inventory_sources` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `channel_locales`
--
ALTER TABLE `channel_locales`
  ADD CONSTRAINT `channel_locales_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `channel_locales_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `charges`
--
ALTER TABLE `charges`
  ADD CONSTRAINT `charges_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  ADD CONSTRAINT `charges_reference_charge_foreign` FOREIGN KEY (`reference_charge`) REFERENCES `charges` (`charge_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `charges_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD CONSTRAINT `cms_pages_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_pages_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `country_states`
--
ALTER TABLE `country_states`
  ADD CONSTRAINT `country_states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `country_state_translations`
--
ALTER TABLE `country_state_translations`
  ADD CONSTRAINT `country_state_translations_country_state_id_foreign` FOREIGN KEY (`country_state_id`) REFERENCES `country_states` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `country_translations`
--
ALTER TABLE `country_translations`
  ADD CONSTRAINT `country_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  ADD CONSTRAINT `currency_exchange_rates_target_currency_foreign` FOREIGN KEY (`target_currency`) REFERENCES `currencies` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE SET NULL;

--
-- テーブルの制約 `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `downloadable_link_purchased`
--
ALTER TABLE `downloadable_link_purchased`
  ADD CONSTRAINT `downloadable_link_purchased_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `downloadable_link_purchased_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `downloadable_link_purchased_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_address_id_foreign` FOREIGN KEY (`order_address_id`) REFERENCES `order_address` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `invoice_items` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- テーブルの制約 `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_address_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `order_payment`
--
ALTER TABLE `order_payment`
  ADD CONSTRAINT `order_payment_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_attribute_family_id_foreign` FOREIGN KEY (`attribute_family_id`) REFERENCES `attribute_families` (`id`),
  ADD CONSTRAINT `products_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `product_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attribute_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_bundle_options`
--
ALTER TABLE `product_bundle_options`
  ADD CONSTRAINT `product_bundle_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_bundle_option_products`
--
ALTER TABLE `product_bundle_option_products`
  ADD CONSTRAINT `product_bundle_option_products_product_bundle_option_id_foreign` FOREIGN KEY (`product_bundle_option_id`) REFERENCES `product_bundle_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_bundle_option_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_bundle_option_translations`
--
ALTER TABLE `product_bundle_option_translations`
  ADD CONSTRAINT `product_bundle_option_translations_option_id_foreign` FOREIGN KEY (`product_bundle_option_id`) REFERENCES `product_bundle_options` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_cross_sells`
--
ALTER TABLE `product_cross_sells`
  ADD CONSTRAINT `product_cross_sells_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_cross_sells_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_downloadable_links`
--
ALTER TABLE `product_downloadable_links`
  ADD CONSTRAINT `product_downloadable_links_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_downloadable_link_translations`
--
ALTER TABLE `product_downloadable_link_translations`
  ADD CONSTRAINT `link_translations_link_id_foreign` FOREIGN KEY (`product_downloadable_link_id`) REFERENCES `product_downloadable_links` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_downloadable_samples`
--
ALTER TABLE `product_downloadable_samples`
  ADD CONSTRAINT `product_downloadable_samples_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_downloadable_sample_translations`
--
ALTER TABLE `product_downloadable_sample_translations`
  ADD CONSTRAINT `sample_translations_sample_id_foreign` FOREIGN KEY (`product_downloadable_sample_id`) REFERENCES `product_downloadable_samples` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_flat`
--
ALTER TABLE `product_flat`
  ADD CONSTRAINT `product_flat_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `product_flat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_flat_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_grouped_products`
--
ALTER TABLE `product_grouped_products`
  ADD CONSTRAINT `product_grouped_products_associated_product_id_foreign` FOREIGN KEY (`associated_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_grouped_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD CONSTRAINT `product_inventories_inventory_source_id_foreign` FOREIGN KEY (`inventory_source_id`) REFERENCES `inventory_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_ordered_inventories`
--
ALTER TABLE `product_ordered_inventories`
  ADD CONSTRAINT `product_ordered_inventories_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ordered_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_relations`
--
ALTER TABLE `product_relations`
  ADD CONSTRAINT `product_relations_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_relations_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_super_attributes`
--
ALTER TABLE `product_super_attributes`
  ADD CONSTRAINT `product_super_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `product_super_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `product_up_sells`
--
ALTER TABLE `product_up_sells`
  ADD CONSTRAINT `product_up_sells_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_up_sells_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `refund_items`
--
ALTER TABLE `refund_items`
  ADD CONSTRAINT `refund_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `refund_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_items_refund_id_foreign` FOREIGN KEY (`refund_id`) REFERENCES `refunds` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_inventory_source_id_foreign` FOREIGN KEY (`inventory_source_id`) REFERENCES `inventory_sources` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shipments_order_address_id_foreign` FOREIGN KEY (`order_address_id`) REFERENCES `order_address` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shipments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD CONSTRAINT `shipment_items_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`);

--
-- テーブルの制約 `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `subscribers_list`
--
ALTER TABLE `subscribers_list`
  ADD CONSTRAINT `subscribers_list_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `tax_categories`
--
ALTER TABLE `tax_categories`
  ADD CONSTRAINT `tax_categories_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `tax_categories_tax_rates`
--
ALTER TABLE `tax_categories_tax_rates`
  ADD CONSTRAINT `tax_categories_tax_rates_tax_category_id_foreign` FOREIGN KEY (`tax_category_id`) REFERENCES `tax_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tax_categories_tax_rates_tax_rate_id_foreign` FOREIGN KEY (`tax_rate_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
