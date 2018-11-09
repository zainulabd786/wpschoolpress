-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 07:29 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `indo_nepal_dir`
--

CREATE TABLE `indo_nepal_dir` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `product` varchar(250) NOT NULL,
  `trade` varchar(100) NOT NULL,
  `business_nature` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2018-03-12 14:22:34', '2018-03-12 14:22:34', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href="https://gravatar.com">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_cache`
--

CREATE TABLE `wp_ffi_cache` (
  `feed_id` varchar(20) NOT NULL,
  `last_update` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `errors` blob,
  `settings` blob,
  `enabled` tinyint(1) DEFAULT '0',
  `system_enabled` tinyint(1) DEFAULT '1',
  `changed_time` int(11) DEFAULT '0',
  `cache_lifetime` int(11) DEFAULT '60'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_ffi_cache`
--

INSERT INTO `wp_ffi_cache` (`feed_id`, `last_update`, `status`, `errors`, `settings`, `enabled`, `system_enabled`, `changed_time`, `cache_lifetime`) VALUES
('wz96029', 1538229923, 1, 0x613a303a7b7d, 0x4f3a383a22737464436c617373223a373a7b733a31333a2274696d656c696e652d74797065223b733a31333a22757365725f74696d656c696e65223b733a373a22636f6e74656e74223b733a31323a227a61696e756c616264373836223b733a353a22706f737473223b733a313a2235223b733a333a226d6f64223b733a343a226e6f7065223b733a343a2274797065223b733a393a22696e7374616772616d223b733a373a22696e636c756465223b733a303a22223b733a31353a2266696c7465722d62792d776f726473223b733a303a22223b7d, 1, 1, 1538221932, 30);

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_comments`
--

CREATE TABLE `wp_ffi_comments` (
  `id` varchar(50) NOT NULL,
  `post_id` varchar(50) NOT NULL,
  `from` blob,
  `text` longblob,
  `created_time` int(11) DEFAULT NULL,
  `updated_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_image_cache`
--

CREATE TABLE `wp_ffi_image_cache` (
  `url` varchar(50) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `original_url` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_options`
--

CREATE TABLE `wp_ffi_options` (
  `id` varchar(50) NOT NULL,
  `value` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_ffi_options`
--

INSERT INTO `wp_ffi_options` (`id`, `value`) VALUES
('insta_flow_db_version', 0x312e31),
('insta_flow_options', 0x613a383a7b733a32383a2267656e6572616c2d73657474696e67732d646174652d666f726d6174223b733a31323a2261676f5374796c6544617465223b733a33323a2267656e6572616c2d73657474696e67732d666565642d706f73742d636f756e74223b733a323a223830223b733a32323a22696e7374616772616d5f6163636573735f746f6b656e223b733a35313a22313435313536363939312e393430373264372e3835323730363434346332623436316238376266313666623266373837613137223b733a34313a2267656e6572616c2d73657474696e67732d6f70656e2d6c696e6b732d696e2d6e65772d77696e646f77223b733a343a226e6f7065223b733a33373a2267656e6572616c2d73657474696e67732d64697361626c652d70726f78792d736572766572223b733a343a226e6f7065223b733a34303a2267656e6572616c2d73657474696e67732d64697361626c652d666f6c6c6f772d6c6f636174696f6e223b733a343a226e6f7065223b733a32313a2267656e6572616c2d73657474696e67732d69707634223b733a343a226e6f7065223b733a32323a2267656e6572616c2d73657474696e67732d6874747073223b733a343a226e6f7065223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_posts`
--

CREATE TABLE `wp_ffi_posts` (
  `feed_id` varchar(20) NOT NULL,
  `post_id` varchar(50) NOT NULL,
  `post_type` varchar(10) NOT NULL,
  `post_text` blob,
  `post_permalink` varchar(300) DEFAULT NULL,
  `post_header` varchar(200) DEFAULT NULL,
  `user_nickname` varchar(100) DEFAULT NULL,
  `user_screenname` varchar(200) DEFAULT NULL,
  `user_pic` varchar(300) NOT NULL,
  `user_link` varchar(300) DEFAULT NULL,
  `rand_order` double DEFAULT NULL,
  `creation_index` int(11) NOT NULL DEFAULT '0',
  `image_url` text,
  `image_width` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `media_url` text,
  `media_width` int(11) DEFAULT NULL,
  `media_height` int(11) DEFAULT NULL,
  `media_type` varchar(100) DEFAULT NULL,
  `post_timestamp` int(11) DEFAULT NULL,
  `smart_order` int(11) DEFAULT NULL,
  `post_status` varchar(15) DEFAULT NULL,
  `post_source` varchar(300) DEFAULT NULL,
  `post_additional` varchar(300) DEFAULT NULL,
  `user_bio` varchar(200) DEFAULT NULL,
  `user_counts_media` int(11) DEFAULT NULL,
  `user_counts_follows` int(11) DEFAULT NULL,
  `user_counts_followed_by` int(11) DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `carousel_size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_post_media`
--

CREATE TABLE `wp_ffi_post_media` (
  `id` int(11) NOT NULL,
  `feed_id` varchar(20) NOT NULL,
  `post_id` varchar(50) NOT NULL,
  `post_type` varchar(10) NOT NULL,
  `media_url` text,
  `media_width` int(11) DEFAULT NULL,
  `media_height` int(11) DEFAULT NULL,
  `media_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_snapshots`
--

CREATE TABLE `wp_ffi_snapshots` (
  `id` int(11) NOT NULL,
  `description` varchar(20) DEFAULT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `settings` longtext NOT NULL,
  `fb_settings` longtext,
  `version` varchar(10) NOT NULL DEFAULT '2.0',
  `dump` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_streams`
--

CREATE TABLE `wp_ffi_streams` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `value` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_ffi_streams`
--

INSERT INTO `wp_ffi_streams` (`id`, `name`, `value`) VALUES
(1, '', 0x4f3a383a22737464436c617373223a3131373a7b733a343a226e616d65223b733a303a22223b733a31303a226d6f6465726174696f6e223b733a343a226e6f7065223b733a353a226f72646572223b733a31323a22736d617274436f6d70617265223b733a353a22706f737473223b733a323a223330223b733a343a2264617973223b733a303a22223b733a31303a22706167652d706f737473223b733a313a2233223b733a353a226361636865223b733a333a22796570223b733a31343a2263616368655f6c69666574696d65223b733a323a223130223b733a373a2267616c6c657279223b733a333a22796570223b733a373a2270726976617465223b733a343a226e6f7065223b733a31353a22686964652d6f6e2d6465736b746f70223b733a343a226e6f7065223b733a31343a22686964652d6f6e2d6d6f62696c65223b733a343a226e6f7065223b733a373a226d61782d726573223b733a343a226e6f7065223b733a32313a2273686f772d6f6e6c792d6d656469612d706f737473223b733a343a226e6f7065223b733a363a227469746c6573223b733a343a226e6f7065223b733a383a22686964656d657461223b733a343a226e6f7065223b733a383a226869646574657874223b733a343a226e6f7065223b733a373a2268656164696e67223b733a303a22223b733a31323a2268656164696e67636f6c6f72223b733a31353a227267622835392c2036312c20363429223b733a31303a2273756268656164696e67223b733a303a22223b733a31353a2273756268656164696e67636f6c6f72223b733a31383a22726762283131342c203131322c2031313429223b733a373a226868616c69676e223b733a363a2263656e746572223b733a373a226267636f6c6f72223b733a31383a22726762283234302c203234302c2032343029223b733a363a2266696c746572223b733a333a22796570223b733a31313a2266696c746572636f6c6f72223b733a31383a22726762283230352c203230352c2032303529223b733a31323a226d6f62696c65736c69646572223b733a343a226e6f7065223b733a31303a2276696577706f7274696e223b733a333a22796570223b733a353a227769647468223b733a333a22323630223b733a363a226d617267696e223b733a323a223230223b733a363a226c61796f7574223b733a373a226d61736f6e7279223b733a353a227468656d65223b733a373a22636c6173736963223b733a383a2267632d7374796c65223b733a373a227374796c652d31223b733a383a22757069632d706f73223b733a393a2274696d657374616d70223b733a31303a22757069632d7374796c65223b733a353a22726f756e64223b733a31303a2269636f6e2d7374796c65223b733a363a226c6162656c31223b733a393a2263617264636f6c6f72223b733a31353a227267622837362c2037362c20373629223b733a393a226e616d65636f6c6f72223b733a31383a22726762283234302c203234302c2032343029223b733a393a2274657874636f6c6f72223b733a31383a22726762283234312c203234322c2032343329223b733a31303a226c696e6b73636f6c6f72223b733a31373a227267622838392c203231312c2032343329223b733a393a2272657374636f6c6f72223b733a31383a22726762283234312c203233392c2032343029223b733a363a22736861646f77223b733a31363a227267626128302c20302c20302c203029223b733a363a2262636f6c6f72223b733a31383a227267626128302c20302c20302c20302e3529223b733a363a2274616c69676e223b733a343a226c656674223b733a31313a2269636f6e732d7374796c65223b733a373a226f75746c696e65223b733a393a2263617264732d6e756d223b733a313a2233223b733a393a227363726f6c6c746f70223b733a333a22796570223b733a31313a22632d632d6465736b746f70223b733a313a2235223b733a31303a22632d632d6c6170746f70223b733a313a2234223b733a31323a22632d632d7461626c65742d6c223b733a313a2233223b733a31323a22632d632d7461626c65742d70223b733a313a2233223b733a31313a22632d632d736d6172742d6c223b733a313a2232223b733a31313a22632d632d736d6172742d70223b733a313a2232223b733a31313a22632d722d6465736b746f70223b733a313a2232223b733a31303a22632d722d6c6170746f70223b733a313a2232223b733a31323a22632d722d7461626c65742d6c223b733a313a2232223b733a31323a22632d722d7461626c65742d70223b733a313a2232223b733a31313a22632d722d736d6172742d6c223b733a313a2232223b733a31313a22632d722d736d6172742d70223b733a313a2232223b733a31313a22632d732d6465736b746f70223b733a313a2230223b733a31303a22632d732d6c6170746f70223b733a313a2230223b733a31323a22632d732d7461626c65742d6c223b733a313a2230223b733a31323a22632d732d7461626c65742d70223b733a313a2230223b733a31313a22632d732d736d6172742d6c223b733a313a2230223b733a31313a22632d732d736d6172742d70223b733a313a2230223b733a363a22632d726f7773223b733a313a2232223b733a363a22632d636f6c73223b733a313a2235223b733a31353a22632d6172726f77732d616c77617973223b733a333a22796570223b733a393a22732d6465736b746f70223b733a323a223135223b733a383a22732d6c6170746f70223b733a323a223135223b733a31303a22732d7461626c65742d6c223b733a323a223130223b733a31303a22732d7461626c65742d70223b733a323a223130223b733a393a22732d736d6172742d6c223b733a313a2235223b733a393a22732d736d6172742d70223b733a313a2235223b733a31313a226d2d632d6465736b746f70223b733a313a2235223b733a31303a226d2d632d6c6170746f70223b733a313a2234223b733a31323a226d2d632d7461626c65742d6c223b733a313a2233223b733a31323a226d2d632d7461626c65742d70223b733a313a2232223b733a31313a226d2d632d736d6172742d6c223b733a313a2232223b733a31313a226d2d632d736d6172742d70223b733a313a2231223b733a31313a226d2d732d6465736b746f70223b733a323a223135223b733a31303a226d2d732d6c6170746f70223b733a323a223135223b733a31323a226d2d732d7461626c65742d6c223b733a323a223130223b733a31323a226d2d732d7461626c65742d70223b733a323a223130223b733a31313a226d2d732d736d6172742d6c223b733a313a2235223b733a31313a226d2d732d736d6172742d70223b733a313a2235223b733a31313a226a2d682d6465736b746f70223b733a333a22323630223b733a31303a226a2d682d6c6170746f70223b733a333a22323430223b733a31323a226a2d682d7461626c65742d6c223b733a333a22323230223b733a31323a226a2d682d7461626c65742d70223b733a333a22323030223b733a31313a226a2d682d736d6172742d6c223b733a333a22313830223b733a31313a226a2d682d736d6172742d70223b733a333a22313630223b733a31313a226a2d732d6465736b746f70223b733a313a2230223b733a31303a226a2d732d6c6170746f70223b733a313a2230223b733a31323a226a2d732d7461626c65742d6c223b733a313a2230223b733a31323a226a2d732d7461626c65742d70223b733a313a2230223b733a31313a226a2d732d736d6172742d6c223b733a313a2230223b733a31313a226a2d732d736d6172742d70223b733a313a2230223b733a393a22672d726174696f2d77223b733a313a2231223b733a393a22672d726174696f2d68223b733a313a2232223b733a31313a22672d726174696f2d696d67223b733a333a22312f32223b733a393a22672d6f7665726c6179223b733a343a226e6f7065223b733a393a226d2d6f7665726c6179223b733a343a226e6f7065223b733a333a22637373223b733a303a22223b733a383a2274656d706c617465223b613a333a7b693a303b733a353a22696d616765223b693a313b733a343a2274657874223b693a323b733a343a226d657461223b7d733a323a227476223b733a343a226e6f7065223b733a363a2274762d696e74223b733a313a2235223b733a373a2274762d6c6f676f223b733a303a22223b733a353a2274762d6267223b733a303a22223b733a333a22626967223b733a343a226e6f7065223b733a393a22632d6465736b746f70223b733a313a2235223b733a383a22632d6c6170746f70223b733a313a2234223b733a31303a22632d7461626c65742d6c223b733a313a2233223b733a31303a22632d7461626c65742d70223b733a313a2232223b733a393a22632d736d6172742d6c223b733a313a2232223b733a393a22632d736d6172742d70223b733a313a2231223b733a323a226964223b733a313a2231223b733a31323a226c6173745f6368616e676573223b693a313533383232323132393b7d);

-- --------------------------------------------------------

--
-- Table structure for table `wp_ffi_streams_sources`
--

CREATE TABLE `wp_ffi_streams_sources` (
  `feed_id` varchar(20) NOT NULL,
  `stream_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_ffi_streams_sources`
--

INSERT INTO `wp_ffi_streams_sources` (`feed_id`, `stream_id`) VALUES
('wz96029', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/SMS', 'yes'),
(2, 'home', 'http://localhost/SMS', 'yes'),
(3, 'blogname', 'SMS', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'zainulabd786@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:86:{s:11:"^wp-json/?$";s:22:"index.php?rest_route=/";s:14:"^wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:21:"^index.php/wp-json/?$";s:22:"index.php?rest_route=/";s:24:"^index.php/wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:23:"category/(.+?)/embed/?$";s:46:"index.php?category_name=$matches[1]&embed=true";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:20:"tag/([^/]+)/embed/?$";s:36:"index.php?tag=$matches[1]&embed=true";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:21:"type/([^/]+)/embed/?$";s:44:"index.php?post_format=$matches[1]&embed=true";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:8:"embed/?$";s:21:"index.php?&embed=true";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:17:"comments/embed/?$";s:21:"index.php?&embed=true";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:20:"search/(.+)/embed/?$";s:34:"index.php?s=$matches[1]&embed=true";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:23:"author/([^/]+)/embed/?$";s:44:"index.php?author_name=$matches[1]&embed=true";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:45:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$";s:74:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:32:"([0-9]{4})/([0-9]{1,2})/embed/?$";s:58:"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:19:"([0-9]{4})/embed/?$";s:37:"index.php?year=$matches[1]&embed=true";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";s:27:"[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:"[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:"[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"([^/]+)/embed/?$";s:37:"index.php?name=$matches[1]&embed=true";s:20:"([^/]+)/trackback/?$";s:31:"index.php?name=$matches[1]&tb=1";s:40:"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:35:"([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:28:"([^/]+)/page/?([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&paged=$matches[2]";s:35:"([^/]+)/comment-page-([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&cpage=$matches[2]";s:24:"([^/]+)(?:/([0-9]+))?/?$";s:43:"index.php?name=$matches[1]&page=$matches[2]";s:16:"[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:26:"[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:46:"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:22:"[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:1:{i:0;s:31:"wpschoolpress/wpschoolpress.php";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'twentyseventeen', 'yes'),
(41, 'stylesheet', 'twentyseventeen', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(79, 'widget_text', 'a:0:{}', 'yes'),
(80, 'widget_rss', 'a:0:{}', 'yes'),
(81, 'uninstall_plugins', 'a:1:{s:33:"instagram-feed/instagram-feed.php";s:22:"sb_instagram_uninstall";}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'initial_db_version', '38590', 'yes'),
(92, 'wp_user_roles', 'a:8:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:61:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}s:7:"teacher";a:2:{s:4:"name";s:7:"Teacher";s:12:"capabilities";a:3:{s:11:"add_student";b:1;s:11:"upload_mark";b:1;s:16:"attendance_entry";b:1;}}s:7:"student";a:2:{s:4:"name";s:8:" Student";s:12:"capabilities";a:1:{s:12:"send_message";b:1;}}s:6:"parent";a:2:{s:4:"name";s:6:"Parent";s:12:"capabilities";a:1:{s:12:"send_message";b:1;}}}', 'yes'),
(93, 'fresh_site', '0', 'yes'),
(94, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(96, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(97, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(98, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(99, 'sidebars_widgets', 'a:5:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}s:13:"array_version";i:3;}', 'yes'),
(100, 'widget_pages', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(101, 'widget_calendar', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(102, 'widget_media_audio', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(103, 'widget_media_image', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(104, 'widget_media_gallery', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(105, 'widget_media_video', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(106, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(107, 'widget_nav_menu', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(108, 'widget_custom_html', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(109, 'cron', 'a:7:{i:1540664217;a:1:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1540664554;a:1:{s:34:"wp_privacy_delete_old_export_files";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"hourly";s:4:"args";a:0:{}s:8:"interval";i:3600;}}}i:1540666285;a:1:{s:17:"make_monthly_dues";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1540693356;a:2:{s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1540709876;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1540736580;a:2:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}s:25:"delete_expired_transients";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(110, 'theme_mods_twentyseventeen', 'a:1:{s:18:"custom_css_post_id";i:-1;}', 'yes'),
(123, 'can_compress_scripts', '1', 'no'),
(128, 'recently_activated', 'a:3:{s:33:"instagram-feed/instagram-feed.php";i:1538591802;s:57:"accesspress-instagram-feed/accesspress-instagram-feed.php";i:1538591798;s:25:"insta-flow/insta-flow.php";i:1538230176;}', 'yes'),
(141, 'plugin_error', '', 'yes'),
(391, 'auto_core_update_notified', 'a:4:{s:4:"type";s:7:"success";s:5:"email";s:22:"zainulabd786@gmail.com";s:7:"version";s:5:"4.9.8";s:9:"timestamp";i:1534409337;}', 'no'),
(1314, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.9.8.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.9.8.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.9.8-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.9.8-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.9.8";s:7:"version";s:5:"4.9.8";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.7";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1540664204;s:15:"version_checked";s:5:"4.9.8";s:12:"translations";a:0:{}}', 'no'),
(1733, 'sbi_rating_notice', 'pending', 'yes'),
(1773, 'widget_ffi_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(1775, 'insta_flow_general_uninstall', 'nope', 'no'),
(1830, 'apif_settings', 'a:6:{s:8:"username";s:12:"zainulabd786";s:12:"access_token";s:51:"1451566991.54da896.608f19c46f15478aa2f37849de6800f5";s:16:"instagram_mosaic";s:6:"mosaic";s:12:"followmetext";s:0:"";s:7:"user_id";s:0:"";s:6:"active";s:1:" ";}', 'yes'),
(1831, 'widget_apif_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(1832, 'widget_apif_sidewidget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(1854, '_site_transient_update_plugins', 'O:8:"stdClass":5:{s:12:"last_checked";i:1540664223;s:7:"checked";a:2:{s:31:"wpschoolpress/wpschoolpress.php";s:3:"1.0";s:39:"wpschoolpress-sms/wpschoolpress-sms.php";s:3:"1.0";}s:8:"response";a:0:{}s:12:"translations";a:0:{}s:9:"no_update";a:0:{}}', 'no'),
(1964, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1540664225;s:7:"checked";a:3:{s:13:"twentyfifteen";s:3:"1.9";s:15:"twentyseventeen";s:3:"1.4";s:13:"twentysixteen";s:3:"1.4";}s:8:"response";a:3:{s:13:"twentyfifteen";a:4:{s:5:"theme";s:13:"twentyfifteen";s:11:"new_version";s:3:"2.0";s:3:"url";s:43:"https://wordpress.org/themes/twentyfifteen/";s:7:"package";s:59:"https://downloads.wordpress.org/theme/twentyfifteen.2.0.zip";}s:15:"twentyseventeen";a:4:{s:5:"theme";s:15:"twentyseventeen";s:11:"new_version";s:3:"1.7";s:3:"url";s:45:"https://wordpress.org/themes/twentyseventeen/";s:7:"package";s:61:"https://downloads.wordpress.org/theme/twentyseventeen.1.7.zip";}s:13:"twentysixteen";a:4:{s:5:"theme";s:13:"twentysixteen";s:11:"new_version";s:3:"1.5";s:3:"url";s:43:"https://wordpress.org/themes/twentysixteen/";s:7:"package";s:59:"https://downloads.wordpress.org/theme/twentysixteen.1.5.zip";}}s:12:"translations";a:0:{}}', 'no'),
(1978, '_site_transient_timeout_theme_roots', '1540666024', 'no'),
(1979, '_site_transient_theme_roots', 'a:3:{s:13:"twentyfifteen";s:7:"/themes";s:15:"twentyseventeen";s:7:"/themes";s:13:"twentysixteen";s:7:"/themes";}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 9, '_edit_lock', '1520925503:1'),
(3, 16, '_edit_lock', '1520925460:1'),
(9, 27, '_edit_lock', '1525162121:1'),
(10, 27, '_edit_last', '1'),
(11, 42, '_wp_attached_file', '2018/09/@WhoIsMuhammad-Ibrahim-Jaaber_HD.mp4'),
(12, 42, '_wp_attachment_metadata', 'a:10:{s:8:"filesize";i:33719990;s:9:"mime_type";s:9:"video/mp4";s:6:"length";i:193;s:16:"length_formatted";s:4:"3:13";s:5:"width";i:1280;s:6:"height";i:720;s:10:"fileformat";s:3:"mp4";s:10:"dataformat";s:9:"quicktime";s:5:"audio";a:7:{s:10:"dataformat";s:3:"mp4";s:5:"codec";s:19:"ISO/IEC 14496-3 AAC";s:11:"sample_rate";d:44100;s:8:"channels";i:2;s:15:"bits_per_sample";i:16;s:8:"lossless";b:0;s:11:"channelmode";s:6:"stereo";}s:17:"created_timestamp";i:1422860817;}'),
(13, 1, '_edit_lock', '1538228129:1'),
(14, 1, '_edit_last', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2018-03-12 14:22:34', '2018-03-12 14:22:34', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writi\r\n\r\n&nbsp;\r\n\r\n[grace id="1"]', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2018-09-29 11:56:02', '2018-09-29 11:56:02', '', 0, 'http://localhost/SMS/?p=1', 0, 'post', '', 1),
(2, 1, '2018-03-12 14:22:34', '2018-03-12 14:22:34', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://localhost/SMS/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2018-03-12 14:22:34', '2018-03-12 14:22:34', '', 0, 'http://localhost/SMS/?page_id=2', 0, 'page', '', 0),
(4, 1, '2018-03-12 14:23:14', '2018-03-12 14:23:14', '', 'TeacherAttendance', 'Teacher Attendance', 'publish', 'closed', 'closed', '', 'sch-teacherattendance', '', '', '2018-03-12 14:23:14', '2018-03-12 14:23:14', '', 0, 'http://localhost/SMS/sch-teacherattendance/', 0, 'page', '', 0),
(5, 1, '2018-03-12 14:23:15', '2018-03-12 14:23:15', '', 'Marks', 'Student marks are entered and viewed ! ', 'publish', 'closed', 'closed', '', 'sch-marks', '', '', '2018-03-12 14:23:15', '2018-03-12 14:23:15', '', 0, 'http://localhost/SMS/sch-marks/', 0, 'page', '', 0),
(6, 1, '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 'Teacher', 'Teacher profile and author page details page ! ', 'publish', 'closed', 'closed', '', 'sch-teacher', '', '', '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 0, 'http://localhost/SMS/sch-teacher/', 0, 'page', '', 0),
(7, 1, '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 'Transport', 'Transport details page ! ', 'publish', 'closed', 'closed', '', 'sch-transport', '', '', '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 0, 'http://localhost/SMS/sch-transport/', 0, 'page', '', 0),
(8, 1, '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 'Dashboard', 'Dashboard contains all the overview ! ', 'publish', 'closed', 'closed', '', 'sch-dashboard', '', '', '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 0, 'http://localhost/SMS/sch-dashboard/', 0, 'page', '', 0),
(9, 1, '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 'Student', 'Student profile and author page details page ! ', 'publish', 'closed', 'closed', '', 'sch-student', '', '', '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 0, 'http://localhost/SMS/sch-student/', 0, 'page', '', 0),
(10, 1, '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 'Parent', 'Parent profile and author page details page ! ', 'publish', 'closed', 'closed', '', 'sch-parent', '', '', '2018-03-12 14:23:16', '2018-03-12 14:23:16', '', 0, 'http://localhost/SMS/sch-parent/', 0, 'page', '', 0),
(11, 1, '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 'Class', 'Class details page ! ', 'publish', 'closed', 'closed', '', 'sch-class', '', '', '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 0, 'http://localhost/SMS/sch-class/', 0, 'page', '', 0),
(12, 1, '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 'Settings', 'Settings page ! ', 'publish', 'closed', 'closed', '', 'sch-settings', '', '', '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 0, 'http://localhost/SMS/sch-settings/', 0, 'page', '', 0),
(13, 1, '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 'Subject', 'Subject details page ! ', 'publish', 'closed', 'closed', '', 'sch-subject', '', '', '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 0, 'http://localhost/SMS/sch-subject/', 0, 'page', '', 0),
(14, 1, '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 'Events', 'School Events page ! ', 'publish', 'closed', 'closed', '', 'sch-events', '', '', '2018-03-12 14:23:17', '2018-03-12 14:23:17', '', 0, 'http://localhost/SMS/sch-events/', 0, 'page', '', 0),
(15, 1, '2018-03-12 14:23:18', '2018-03-12 14:23:18', '', 'Timetable', 'Academic daily Timetable ! ', 'publish', 'closed', 'closed', '', 'sch-timetable', '', '', '2018-03-12 14:23:18', '2018-03-12 14:23:18', '', 0, 'http://localhost/SMS/sch-timetable/', 0, 'page', '', 0),
(16, 1, '2018-03-12 14:23:18', '2018-03-12 14:23:18', '', 'Attendance', 'Student attendance page ! ', 'publish', 'closed', 'closed', '', 'sch-attendance', '', '', '2018-03-12 14:23:18', '2018-03-12 14:23:18', '', 0, 'http://localhost/SMS/sch-attendance/', 0, 'page', '', 0),
(17, 1, '2018-03-12 14:23:19', '2018-03-12 14:23:19', '', 'Exams', 'Exam details page ! ', 'publish', 'closed', 'closed', '', 'sch-exams', '', '', '2018-03-12 14:23:19', '2018-03-12 14:23:19', '', 0, 'http://localhost/SMS/sch-exams/', 0, 'page', '', 0),
(18, 1, '2018-03-12 14:23:20', '2018-03-12 14:23:20', '', 'Messages', 'Messages page ! ', 'publish', 'closed', 'closed', '', 'sch-messages', '', '', '2018-03-12 14:23:20', '2018-03-12 14:23:20', '', 0, 'http://localhost/SMS/sch-messages/', 0, 'page', '', 0),
(19, 1, '2018-03-12 14:23:20', '2018-03-12 14:23:20', '', 'Notify', 'Send notification page ! ', 'publish', 'closed', 'closed', '', 'sch-notify', '', '', '2018-03-12 14:23:20', '2018-03-12 14:23:20', '', 0, 'http://localhost/SMS/sch-notify/', 0, 'page', '', 0),
(20, 1, '2018-03-12 14:23:21', '2018-03-12 14:23:21', '', 'ImportHistory', 'Import history page ! ', 'publish', 'closed', 'closed', '', 'sch-importhistory', '', '', '2018-03-12 14:23:21', '2018-03-12 14:23:21', '', 0, 'http://localhost/SMS/sch-importhistory/', 0, 'page', '', 0),
(21, 1, '2018-03-12 14:23:21', '2018-03-12 14:23:21', '', 'LeaveCalendar', 'Leave calendar page ! ', 'publish', 'closed', 'closed', '', 'sch-leavecalendar', '', '', '2018-03-12 14:23:21', '2018-03-12 14:23:21', '', 0, 'http://localhost/SMS/sch-leavecalendar/', 0, 'page', '', 0),
(22, 1, '2018-03-12 14:23:21', '2018-03-12 14:23:21', '', 'Change Password', 'Change Password', 'publish', 'closed', 'closed', '', 'sch-changepassword', '', '', '2018-03-12 14:23:21', '2018-03-12 14:23:21', '', 0, 'http://localhost/SMS/sch-changepassword/', 0, 'page', '', 0),
(23, 1, '2018-03-12 14:23:22', '2018-03-12 14:23:22', '', 'Payment', 'Fees', 'publish', 'closed', 'closed', '', 'sch-payment', '', '', '2018-03-12 14:23:22', '2018-03-12 14:23:22', '', 0, 'http://localhost/SMS/sch-payment/', 0, 'page', '', 0),
(27, 1, '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 'Fee', '', 'publish', 'closed', 'closed', '', 'sch-fee-man', '', '', '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 0, 'http://localhost/SMS/?page_id=27', 0, 'page', '', 0),
(28, 1, '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 'Fee', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 27, 'http://localhost/SMS/27-revision-v1/', 0, 'revision', '', 0),
(37, 1, '2018-05-15 05:30:44', '2018-05-15 05:30:44', '', 'Inventory Management', 'Inventory Management', 'publish', 'closed', 'closed', '', 'sch-inv-management', '', '', '2018-05-15 05:30:44', '2018-05-15 05:30:44', '', 0, 'http://localhost/SMS/sch-inv-management/', 0, 'page', '', 0),
(38, 1, '2018-05-15 06:33:24', '2018-05-15 06:33:24', '', 'Enquiry', 'Enquiry', 'publish', 'closed', 'closed', '', 'sch-enquiry', '', '', '2018-05-15 06:33:24', '2018-05-15 06:33:24', '', 0, 'http://localhost/SMS/sch-enquiry/', 0, 'page', '', 0),
(42, 1, '2018-09-07 17:36:41', '2018-09-07 17:36:41', '', '@WhoIsMuhammad - Ibrahim Jaaber_HD', '', 'inherit', 'open', 'closed', '', 'whoismuhammad-ibrahim-jaaber_hd', '', '', '2018-09-07 17:38:53', '2018-09-07 17:38:53', '', 1, 'http://localhost/SMS/wp-content/uploads/2018/09/@WhoIsMuhammad-Ibrahim-Jaaber_HD.mp4', 0, 'attachment', 'video/mp4', 0),
(43, 1, '2018-09-07 17:39:00', '2018-09-07 17:39:00', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!\r\n\r\n[video width="1280" height="720" mp4="http://localhost/SMS/wp-content/uploads/2018/09/@WhoIsMuhammad-Ibrahim-Jaaber_HD.mp4"][/video]', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2018-09-07 17:39:00', '2018-09-07 17:39:00', '', 1, 'http://localhost/SMS/1-revision-v1/', 0, 'revision', '', 0),
(45, 1, '2018-09-23 12:40:50', '2018-09-23 12:40:50', '', 'Accounting', 'Accounting', 'publish', 'closed', 'closed', '', 'sch-accounting', '', '', '2018-09-23 12:40:50', '2018-09-23 12:40:50', '', 0, 'http://localhost/SMS/sch-accounting/', 0, 'page', '', 0),
(46, 1, '2018-09-28 15:50:18', '2018-09-28 15:50:18', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writi\r\n\r\n&nbsp;\r\n\r\n[instagram-feed]', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2018-09-28 15:50:18', '2018-09-28 15:50:18', '', 1, 'http://localhost/SMS/1-revision-v1/', 0, 'revision', '', 0),
(47, 1, '2018-09-29 11:56:02', '2018-09-29 11:56:02', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writi\r\n\r\n&nbsp;\r\n\r\n[grace id="1"]', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2018-09-29 11:56:02', '2018-09-29 11:56:02', '', 1, 'http://localhost/SMS/1-revision-v1/', 0, 'revision', '', 0),
(51, 1, '2018-10-26 16:53:01', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2018-10-26 16:53:01', '0000-00-00 00:00:00', '', 0, 'http://localhost/SMS/?p=51', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wp496_privacy'),
(15, 1, 'show_welcome_panel', '1'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '51'),
(18, 1, 'community-events-location', 'a:1:{s:2:"ip";s:2:"::";}'),
(19, 2, 'nickname', 'Wolfie'),
(20, 2, 'first_name', 'Wolfie'),
(21, 2, 'last_name', ''),
(22, 2, 'description', ''),
(23, 2, 'rich_editing', 'true'),
(24, 2, 'syntax_highlighting', 'true'),
(25, 2, 'comment_shortcuts', 'false'),
(26, 2, 'admin_color', 'fresh'),
(27, 2, 'use_ssl', '0'),
(28, 2, 'show_admin_bar_front', 'true'),
(29, 2, 'locale', ''),
(30, 2, 'wp_capabilities', 'a:1:{s:7:"teacher";b:1;}'),
(31, 2, 'wp_user_level', '0'),
(32, 2, 'dismissed_wp_pointers', ''),
(33, 3, 'nickname', 'Judye'),
(34, 3, 'first_name', 'Judye'),
(35, 3, 'last_name', ''),
(36, 3, 'description', ''),
(37, 3, 'rich_editing', 'true'),
(38, 3, 'syntax_highlighting', 'true'),
(39, 3, 'comment_shortcuts', 'false'),
(40, 3, 'admin_color', 'fresh'),
(41, 3, 'use_ssl', '0'),
(42, 3, 'show_admin_bar_front', 'true'),
(43, 3, 'locale', ''),
(44, 3, 'wp_capabilities', 'a:1:{s:7:"teacher";b:1;}'),
(45, 3, 'wp_user_level', '0'),
(46, 3, 'dismissed_wp_pointers', ''),
(47, 4, 'nickname', 'Erna'),
(48, 4, 'first_name', 'Erna'),
(49, 4, 'last_name', ''),
(50, 4, 'description', ''),
(51, 4, 'rich_editing', 'true'),
(52, 4, 'syntax_highlighting', 'true'),
(53, 4, 'comment_shortcuts', 'false'),
(54, 4, 'admin_color', 'fresh'),
(55, 4, 'use_ssl', '0'),
(56, 4, 'show_admin_bar_front', 'true'),
(57, 4, 'locale', ''),
(58, 4, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(59, 4, 'wp_user_level', '0'),
(60, 4, 'dismissed_wp_pointers', ''),
(61, 5, 'nickname', 'Joli'),
(62, 5, 'first_name', 'Joli'),
(63, 5, 'last_name', ''),
(64, 5, 'description', ''),
(65, 5, 'rich_editing', 'true'),
(66, 5, 'syntax_highlighting', 'true'),
(67, 5, 'comment_shortcuts', 'false'),
(68, 5, 'admin_color', 'fresh'),
(69, 5, 'use_ssl', '0'),
(70, 5, 'show_admin_bar_front', 'true'),
(71, 5, 'locale', ''),
(72, 5, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(73, 5, 'wp_user_level', '0'),
(74, 5, 'dismissed_wp_pointers', ''),
(75, 6, 'nickname', 'Karilynn'),
(76, 6, 'first_name', 'Karilynn'),
(77, 6, 'last_name', ''),
(78, 6, 'description', ''),
(79, 6, 'rich_editing', 'true'),
(80, 6, 'syntax_highlighting', 'true'),
(81, 6, 'comment_shortcuts', 'false'),
(82, 6, 'admin_color', 'fresh'),
(83, 6, 'use_ssl', '0'),
(84, 6, 'show_admin_bar_front', 'true'),
(85, 6, 'locale', ''),
(86, 6, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(87, 6, 'wp_user_level', '0'),
(88, 6, 'dismissed_wp_pointers', ''),
(89, 7, 'nickname', 'Aurelia'),
(90, 7, 'first_name', 'Aurelia'),
(91, 7, 'last_name', ''),
(92, 7, 'description', ''),
(93, 7, 'rich_editing', 'true'),
(94, 7, 'syntax_highlighting', 'true'),
(95, 7, 'comment_shortcuts', 'false'),
(96, 7, 'admin_color', 'fresh'),
(97, 7, 'use_ssl', '0'),
(98, 7, 'show_admin_bar_front', 'true'),
(99, 7, 'locale', ''),
(100, 7, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(101, 7, 'wp_user_level', '0'),
(102, 7, 'dismissed_wp_pointers', ''),
(103, 8, 'nickname', 'student_1520930127'),
(104, 8, 'first_name', 'Zainul'),
(105, 8, 'last_name', ''),
(106, 8, 'description', ''),
(107, 8, 'rich_editing', 'true'),
(108, 8, 'syntax_highlighting', 'true'),
(109, 8, 'comment_shortcuts', 'false'),
(110, 8, 'admin_color', 'fresh'),
(111, 8, 'use_ssl', '0'),
(112, 8, 'show_admin_bar_front', 'true'),
(113, 8, 'locale', ''),
(114, 8, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(115, 8, 'wp_user_level', '0'),
(116, 8, 'dismissed_wp_pointers', ''),
(117, 9, 'nickname', 'shahidazeem'),
(118, 9, 'first_name', ''),
(119, 9, 'last_name', ''),
(120, 9, 'description', ''),
(121, 9, 'rich_editing', 'true'),
(122, 9, 'syntax_highlighting', 'true'),
(123, 9, 'comment_shortcuts', 'false'),
(124, 9, 'admin_color', 'fresh'),
(125, 9, 'use_ssl', '0'),
(126, 9, 'show_admin_bar_front', 'true'),
(127, 9, 'locale', ''),
(128, 9, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(129, 9, 'wp_user_level', '0'),
(130, 9, 'dismissed_wp_pointers', ''),
(131, 10, 'nickname', 'student_1520948684'),
(132, 10, 'first_name', 'WAEEZ'),
(133, 10, 'last_name', ''),
(134, 10, 'description', ''),
(135, 10, 'rich_editing', 'true'),
(136, 10, 'syntax_highlighting', 'true'),
(137, 10, 'comment_shortcuts', 'false'),
(138, 10, 'admin_color', 'fresh'),
(139, 10, 'use_ssl', '0'),
(140, 10, 'show_admin_bar_front', 'true'),
(141, 10, 'locale', ''),
(142, 10, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(143, 10, 'wp_user_level', '0'),
(144, 10, 'dismissed_wp_pointers', ''),
(145, 11, 'nickname', 'student_1521001564'),
(146, 11, 'first_name', 'Muhammad'),
(147, 11, 'last_name', ''),
(148, 11, 'description', ''),
(149, 11, 'rich_editing', 'true'),
(150, 11, 'syntax_highlighting', 'true'),
(151, 11, 'comment_shortcuts', 'false'),
(152, 11, 'admin_color', 'fresh'),
(153, 11, 'use_ssl', '0'),
(154, 11, 'show_admin_bar_front', 'true'),
(155, 11, 'locale', ''),
(156, 11, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(157, 11, 'wp_user_level', '0'),
(158, 11, 'dismissed_wp_pointers', ''),
(159, 12, 'nickname', 'shahid'),
(160, 12, 'first_name', ''),
(161, 12, 'last_name', ''),
(162, 12, 'description', ''),
(163, 12, 'rich_editing', 'true'),
(164, 12, 'syntax_highlighting', 'true'),
(165, 12, 'comment_shortcuts', 'false'),
(166, 12, 'admin_color', 'fresh'),
(167, 12, 'use_ssl', '0'),
(168, 12, 'show_admin_bar_front', 'true'),
(169, 12, 'locale', ''),
(170, 12, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(171, 12, 'wp_user_level', '0'),
(172, 12, 'dismissed_wp_pointers', ''),
(173, 13, 'nickname', 'student_1521261829'),
(174, 13, 'first_name', 'Muhammad'),
(175, 13, 'last_name', ''),
(176, 13, 'description', ''),
(177, 13, 'rich_editing', 'true'),
(178, 13, 'syntax_highlighting', 'true'),
(179, 13, 'comment_shortcuts', 'false'),
(180, 13, 'admin_color', 'fresh'),
(181, 13, 'use_ssl', '0'),
(182, 13, 'show_admin_bar_front', 'true'),
(183, 13, 'locale', ''),
(184, 13, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(185, 13, 'wp_user_level', '0'),
(186, 13, 'dismissed_wp_pointers', ''),
(187, 14, 'nickname', 'shahzad'),
(188, 14, 'first_name', ''),
(189, 14, 'last_name', ''),
(190, 14, 'description', ''),
(191, 14, 'rich_editing', 'true'),
(192, 14, 'syntax_highlighting', 'true'),
(193, 14, 'comment_shortcuts', 'false'),
(194, 14, 'admin_color', 'fresh'),
(195, 14, 'use_ssl', '0'),
(196, 14, 'show_admin_bar_front', 'true'),
(197, 14, 'locale', ''),
(198, 14, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(199, 14, 'wp_user_level', '0'),
(200, 14, 'dismissed_wp_pointers', ''),
(201, 15, 'nickname', 'student_1521262978'),
(202, 15, 'first_name', 'Zainul'),
(203, 15, 'last_name', ''),
(204, 15, 'description', ''),
(205, 15, 'rich_editing', 'true'),
(206, 15, 'syntax_highlighting', 'true'),
(207, 15, 'comment_shortcuts', 'false'),
(208, 15, 'admin_color', 'fresh'),
(209, 15, 'use_ssl', '0'),
(210, 15, 'show_admin_bar_front', 'true'),
(211, 15, 'locale', ''),
(212, 15, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(213, 15, 'wp_user_level', '0'),
(214, 15, 'dismissed_wp_pointers', ''),
(215, 16, 'nickname', 'student_1521263129'),
(216, 16, 'first_name', 'WAEEZ'),
(217, 16, 'last_name', ''),
(218, 16, 'description', ''),
(219, 16, 'rich_editing', 'true'),
(220, 16, 'syntax_highlighting', 'true'),
(221, 16, 'comment_shortcuts', 'false'),
(222, 16, 'admin_color', 'fresh'),
(223, 16, 'use_ssl', '0'),
(224, 16, 'show_admin_bar_front', 'true'),
(225, 16, 'locale', ''),
(226, 16, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(227, 16, 'wp_user_level', '0'),
(228, 16, 'dismissed_wp_pointers', ''),
(229, 17, 'nickname', 'student_1521263699'),
(230, 17, 'first_name', 'Zainul'),
(231, 17, 'last_name', ''),
(232, 17, 'description', ''),
(233, 17, 'rich_editing', 'true'),
(234, 17, 'syntax_highlighting', 'true'),
(235, 17, 'comment_shortcuts', 'false'),
(236, 17, 'admin_color', 'fresh'),
(237, 17, 'use_ssl', '0'),
(238, 17, 'show_admin_bar_front', 'true'),
(239, 17, 'locale', ''),
(240, 17, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(241, 17, 'wp_user_level', '0'),
(242, 17, 'dismissed_wp_pointers', ''),
(243, 18, 'nickname', 'student_1521263867'),
(244, 18, 'first_name', 'WAEEZ'),
(245, 18, 'last_name', ''),
(246, 18, 'description', ''),
(247, 18, 'rich_editing', 'true'),
(248, 18, 'syntax_highlighting', 'true'),
(249, 18, 'comment_shortcuts', 'false'),
(250, 18, 'admin_color', 'fresh'),
(251, 18, 'use_ssl', '0'),
(252, 18, 'show_admin_bar_front', 'true'),
(253, 18, 'locale', ''),
(254, 18, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(255, 18, 'wp_user_level', '0'),
(256, 18, 'dismissed_wp_pointers', ''),
(257, 19, 'nickname', 'student_1521369623'),
(258, 19, 'first_name', 'M'),
(259, 19, 'last_name', ''),
(260, 19, 'description', ''),
(261, 19, 'rich_editing', 'true'),
(262, 19, 'syntax_highlighting', 'true'),
(263, 19, 'comment_shortcuts', 'false'),
(264, 19, 'admin_color', 'fresh'),
(265, 19, 'use_ssl', '0'),
(266, 19, 'show_admin_bar_front', 'true'),
(267, 19, 'locale', ''),
(268, 19, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(269, 19, 'wp_user_level', '0'),
(270, 19, 'dismissed_wp_pointers', ''),
(271, 20, 'nickname', 'student_1521443120'),
(272, 20, 'first_name', 'Zainul'),
(273, 20, 'last_name', ''),
(274, 20, 'description', ''),
(275, 20, 'rich_editing', 'true'),
(276, 20, 'syntax_highlighting', 'true'),
(277, 20, 'comment_shortcuts', 'false'),
(278, 20, 'admin_color', 'fresh'),
(279, 20, 'use_ssl', '0'),
(280, 20, 'show_admin_bar_front', 'true'),
(281, 20, 'locale', ''),
(282, 20, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(283, 20, 'wp_user_level', '0'),
(284, 20, 'dismissed_wp_pointers', ''),
(285, 21, 'nickname', 'student_1521444238'),
(286, 21, 'first_name', 'WAEEZ'),
(287, 21, 'last_name', ''),
(288, 21, 'description', ''),
(289, 21, 'rich_editing', 'true'),
(290, 21, 'syntax_highlighting', 'true'),
(291, 21, 'comment_shortcuts', 'false'),
(292, 21, 'admin_color', 'fresh'),
(293, 21, 'use_ssl', '0'),
(294, 21, 'show_admin_bar_front', 'true'),
(295, 21, 'locale', ''),
(296, 21, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(297, 21, 'wp_user_level', '0'),
(298, 21, 'dismissed_wp_pointers', ''),
(299, 22, 'nickname', 'shshid'),
(300, 22, 'first_name', ''),
(301, 22, 'last_name', ''),
(302, 22, 'description', ''),
(303, 22, 'rich_editing', 'true'),
(304, 22, 'syntax_highlighting', 'true'),
(305, 22, 'comment_shortcuts', 'false'),
(306, 22, 'admin_color', 'fresh'),
(307, 22, 'use_ssl', '0'),
(308, 22, 'show_admin_bar_front', 'true'),
(309, 22, 'locale', ''),
(310, 22, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(311, 22, 'wp_user_level', '0'),
(312, 22, 'dismissed_wp_pointers', ''),
(313, 23, 'nickname', 'student_1522548125'),
(314, 23, 'first_name', 'Zainul'),
(315, 23, 'last_name', ''),
(316, 23, 'description', ''),
(317, 23, 'rich_editing', 'true'),
(318, 23, 'syntax_highlighting', 'true'),
(319, 23, 'comment_shortcuts', 'false'),
(320, 23, 'admin_color', 'fresh'),
(321, 23, 'use_ssl', '0'),
(322, 23, 'show_admin_bar_front', 'true'),
(323, 23, 'locale', ''),
(324, 23, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(325, 23, 'wp_user_level', '0'),
(326, 23, 'dismissed_wp_pointers', ''),
(327, 24, 'nickname', 'shahidazeem'),
(328, 24, 'first_name', ''),
(329, 24, 'last_name', ''),
(330, 24, 'description', ''),
(331, 24, 'rich_editing', 'true'),
(332, 24, 'syntax_highlighting', 'true'),
(333, 24, 'comment_shortcuts', 'false'),
(334, 24, 'admin_color', 'fresh'),
(335, 24, 'use_ssl', '0'),
(336, 24, 'show_admin_bar_front', 'true'),
(337, 24, 'locale', ''),
(338, 24, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(339, 24, 'wp_user_level', '0'),
(340, 24, 'dismissed_wp_pointers', ''),
(341, 25, 'nickname', 'student_1522548230'),
(342, 25, 'first_name', 'Muhammad'),
(343, 25, 'last_name', ''),
(344, 25, 'description', ''),
(345, 25, 'rich_editing', 'true'),
(346, 25, 'syntax_highlighting', 'true'),
(347, 25, 'comment_shortcuts', 'false'),
(348, 25, 'admin_color', 'fresh'),
(349, 25, 'use_ssl', '0'),
(350, 25, 'show_admin_bar_front', 'true'),
(351, 25, 'locale', ''),
(352, 25, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(353, 25, 'wp_user_level', '0'),
(354, 25, 'dismissed_wp_pointers', ''),
(355, 26, 'nickname', 'student_1522572330'),
(356, 26, 'first_name', 'Muhammad'),
(357, 26, 'last_name', ''),
(358, 26, 'description', ''),
(359, 26, 'rich_editing', 'true'),
(360, 26, 'syntax_highlighting', 'true'),
(361, 26, 'comment_shortcuts', 'false'),
(362, 26, 'admin_color', 'fresh'),
(363, 26, 'use_ssl', '0'),
(364, 26, 'show_admin_bar_front', 'true'),
(365, 26, 'locale', ''),
(366, 26, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(367, 26, 'wp_user_level', '0'),
(368, 26, 'dismissed_wp_pointers', ''),
(369, 27, 'nickname', 'mhssd'),
(370, 27, 'first_name', ''),
(371, 27, 'last_name', ''),
(372, 27, 'description', ''),
(373, 27, 'rich_editing', 'true'),
(374, 27, 'syntax_highlighting', 'true'),
(375, 27, 'comment_shortcuts', 'false'),
(376, 27, 'admin_color', 'fresh'),
(377, 27, 'use_ssl', '0'),
(378, 27, 'show_admin_bar_front', 'true'),
(379, 27, 'locale', ''),
(380, 27, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(381, 27, 'wp_user_level', '0'),
(382, 27, 'dismissed_wp_pointers', ''),
(383, 28, 'nickname', 'student_1522572463'),
(384, 28, 'first_name', 'Muhammad'),
(385, 28, 'last_name', ''),
(386, 28, 'description', ''),
(387, 28, 'rich_editing', 'true'),
(388, 28, 'syntax_highlighting', 'true'),
(389, 28, 'comment_shortcuts', 'false'),
(390, 28, 'admin_color', 'fresh'),
(391, 28, 'use_ssl', '0'),
(392, 28, 'show_admin_bar_front', 'true'),
(393, 28, 'locale', ''),
(394, 28, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(395, 28, 'wp_user_level', '0'),
(396, 28, 'dismissed_wp_pointers', ''),
(397, 29, 'nickname', 'shahzad'),
(398, 29, 'first_name', ''),
(399, 29, 'last_name', ''),
(400, 29, 'description', ''),
(401, 29, 'rich_editing', 'true'),
(402, 29, 'syntax_highlighting', 'true'),
(403, 29, 'comment_shortcuts', 'false'),
(404, 29, 'admin_color', 'fresh'),
(405, 29, 'use_ssl', '0'),
(406, 29, 'show_admin_bar_front', 'true'),
(407, 29, 'locale', ''),
(408, 29, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(409, 29, 'wp_user_level', '0'),
(410, 29, 'dismissed_wp_pointers', ''),
(411, 30, 'nickname', 'student_1522843283'),
(412, 30, 'first_name', 'Zainul'),
(413, 30, 'last_name', ''),
(414, 30, 'description', ''),
(415, 30, 'rich_editing', 'true'),
(416, 30, 'syntax_highlighting', 'true'),
(417, 30, 'comment_shortcuts', 'false'),
(418, 30, 'admin_color', 'fresh'),
(419, 30, 'use_ssl', '0'),
(420, 30, 'show_admin_bar_front', 'true'),
(421, 30, 'locale', ''),
(422, 30, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(423, 30, 'wp_user_level', '0'),
(424, 30, 'dismissed_wp_pointers', ''),
(425, 31, 'nickname', 'student_1522843551'),
(426, 31, 'first_name', 'Muhammad'),
(427, 31, 'last_name', ''),
(428, 31, 'description', ''),
(429, 31, 'rich_editing', 'true'),
(430, 31, 'syntax_highlighting', 'true'),
(431, 31, 'comment_shortcuts', 'false'),
(432, 31, 'admin_color', 'fresh'),
(433, 31, 'use_ssl', '0'),
(434, 31, 'show_admin_bar_front', 'true'),
(435, 31, 'locale', ''),
(436, 31, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(437, 31, 'wp_user_level', '0'),
(438, 31, 'dismissed_wp_pointers', ''),
(439, 32, 'nickname', 'hammad'),
(440, 32, 'first_name', ''),
(441, 32, 'last_name', ''),
(442, 32, 'description', ''),
(443, 32, 'rich_editing', 'true'),
(444, 32, 'syntax_highlighting', 'true'),
(445, 32, 'comment_shortcuts', 'false'),
(446, 32, 'admin_color', 'fresh'),
(447, 32, 'use_ssl', '0'),
(448, 32, 'show_admin_bar_front', 'true'),
(449, 32, 'locale', ''),
(450, 32, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(451, 32, 'wp_user_level', '0'),
(452, 32, 'dismissed_wp_pointers', ''),
(453, 33, 'nickname', 'student_1523082187'),
(454, 33, 'first_name', 'Zainul'),
(455, 33, 'last_name', ''),
(456, 33, 'description', ''),
(457, 33, 'rich_editing', 'true'),
(458, 33, 'syntax_highlighting', 'true'),
(459, 33, 'comment_shortcuts', 'false'),
(460, 33, 'admin_color', 'fresh'),
(461, 33, 'use_ssl', '0'),
(462, 33, 'show_admin_bar_front', 'true'),
(463, 33, 'locale', ''),
(464, 33, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(465, 33, 'wp_user_level', '0'),
(466, 33, 'dismissed_wp_pointers', ''),
(467, 34, 'nickname', 'shahidazeem'),
(468, 34, 'first_name', ''),
(469, 34, 'last_name', ''),
(470, 34, 'description', ''),
(471, 34, 'rich_editing', 'true'),
(472, 34, 'syntax_highlighting', 'true'),
(473, 34, 'comment_shortcuts', 'false'),
(474, 34, 'admin_color', 'fresh'),
(475, 34, 'use_ssl', '0'),
(476, 34, 'show_admin_bar_front', 'true'),
(477, 34, 'locale', ''),
(478, 34, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(479, 34, 'wp_user_level', '0'),
(480, 34, 'dismissed_wp_pointers', ''),
(481, 35, 'nickname', 'student_1523083291'),
(482, 35, 'first_name', 'Zainul'),
(483, 35, 'last_name', ''),
(484, 35, 'description', ''),
(485, 35, 'rich_editing', 'true'),
(486, 35, 'syntax_highlighting', 'true'),
(487, 35, 'comment_shortcuts', 'false'),
(488, 35, 'admin_color', 'fresh'),
(489, 35, 'use_ssl', '0'),
(490, 35, 'show_admin_bar_front', 'true'),
(491, 35, 'locale', ''),
(492, 35, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(493, 35, 'wp_user_level', '0'),
(494, 35, 'dismissed_wp_pointers', ''),
(495, 36, 'nickname', 'student_1523083313'),
(496, 36, 'first_name', 'Zainul'),
(497, 36, 'last_name', ''),
(498, 36, 'description', ''),
(499, 36, 'rich_editing', 'true'),
(500, 36, 'syntax_highlighting', 'true'),
(501, 36, 'comment_shortcuts', 'false'),
(502, 36, 'admin_color', 'fresh'),
(503, 36, 'use_ssl', '0'),
(504, 36, 'show_admin_bar_front', 'true'),
(505, 36, 'locale', ''),
(506, 36, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(507, 36, 'wp_user_level', '0'),
(508, 36, 'dismissed_wp_pointers', ''),
(509, 37, 'nickname', 'student_1523083329'),
(510, 37, 'first_name', 'Zainul'),
(511, 37, 'last_name', ''),
(512, 37, 'description', ''),
(513, 37, 'rich_editing', 'true'),
(514, 37, 'syntax_highlighting', 'true'),
(515, 37, 'comment_shortcuts', 'false'),
(516, 37, 'admin_color', 'fresh'),
(517, 37, 'use_ssl', '0'),
(518, 37, 'show_admin_bar_front', 'true'),
(519, 37, 'locale', ''),
(520, 37, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(521, 37, 'wp_user_level', '0'),
(522, 37, 'dismissed_wp_pointers', ''),
(523, 38, 'nickname', 'student_1523083524'),
(524, 38, 'first_name', 'Zainul'),
(525, 38, 'last_name', ''),
(526, 38, 'description', ''),
(527, 38, 'rich_editing', 'true'),
(528, 38, 'syntax_highlighting', 'true'),
(529, 38, 'comment_shortcuts', 'false'),
(530, 38, 'admin_color', 'fresh'),
(531, 38, 'use_ssl', '0'),
(532, 38, 'show_admin_bar_front', 'true'),
(533, 38, 'locale', ''),
(534, 38, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(535, 38, 'wp_user_level', '0'),
(536, 38, 'dismissed_wp_pointers', ''),
(537, 39, 'nickname', 'student_1523083779'),
(538, 39, 'first_name', 'Zainul'),
(539, 39, 'last_name', ''),
(540, 39, 'description', ''),
(541, 39, 'rich_editing', 'true'),
(542, 39, 'syntax_highlighting', 'true'),
(543, 39, 'comment_shortcuts', 'false'),
(544, 39, 'admin_color', 'fresh'),
(545, 39, 'use_ssl', '0'),
(546, 39, 'show_admin_bar_front', 'true'),
(547, 39, 'locale', ''),
(548, 39, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(549, 39, 'wp_user_level', '0'),
(550, 39, 'dismissed_wp_pointers', ''),
(551, 40, 'nickname', 'student_1523266821'),
(552, 40, 'first_name', 'WAEEZ'),
(553, 40, 'last_name', ''),
(554, 40, 'description', ''),
(555, 40, 'rich_editing', 'true'),
(556, 40, 'syntax_highlighting', 'true'),
(557, 40, 'comment_shortcuts', 'false'),
(558, 40, 'admin_color', 'fresh'),
(559, 40, 'use_ssl', '0'),
(560, 40, 'show_admin_bar_front', 'true'),
(561, 40, 'locale', ''),
(562, 40, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(563, 40, 'wp_user_level', '0'),
(564, 40, 'dismissed_wp_pointers', ''),
(566, 34, 'session_tokens', 'a:1:{s:64:"3f9371cff72adc8b075f8a0dd9a23e9b8b7ed8a4d30f27a9fef456dd6eb6855d";a:4:{s:10:"expiration";i:1524477196;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36";s:5:"login";i:1524304396;}}'),
(568, 41, 'nickname', 'student_1524357589'),
(569, 41, 'first_name', 'Zainul'),
(570, 41, 'last_name', ''),
(571, 41, 'description', ''),
(572, 41, 'rich_editing', 'true'),
(573, 41, 'syntax_highlighting', 'true'),
(574, 41, 'comment_shortcuts', 'false'),
(575, 41, 'admin_color', 'fresh'),
(576, 41, 'use_ssl', '0'),
(577, 41, 'show_admin_bar_front', 'true'),
(578, 41, 'locale', ''),
(579, 41, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(580, 41, 'wp_user_level', '0'),
(581, 41, 'dismissed_wp_pointers', ''),
(582, 42, 'nickname', 'shahidazeem'),
(583, 42, 'first_name', ''),
(584, 42, 'last_name', ''),
(585, 42, 'description', ''),
(586, 42, 'rich_editing', 'true'),
(587, 42, 'syntax_highlighting', 'true'),
(588, 42, 'comment_shortcuts', 'false'),
(589, 42, 'admin_color', 'fresh'),
(590, 42, 'use_ssl', '0'),
(591, 42, 'show_admin_bar_front', 'true'),
(592, 42, 'locale', ''),
(593, 42, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(594, 42, 'wp_user_level', '0'),
(595, 42, 'dismissed_wp_pointers', ''),
(596, 42, 'displaypicture', 'a:1:{s:4:"full";s:99:"http://localhost/SMS/wp-content/uploads/2018/04/15235615_1203747699717990_4140993882121739032_o.jpg";}'),
(597, 42, 'simple_local_avatar', 'a:1:{s:4:"full";s:99:"http://localhost/SMS/wp-content/uploads/2018/04/15235615_1203747699717990_4140993882121739032_o.jpg";}'),
(598, 41, 'displaypicture', 'a:1:{s:4:"full";s:108:"http://localhost/SMS/wp-content/uploads/2018/04/1-AdobePhotoshopExpress_e90803656f204497b076a4b76c750948.jpg";}'),
(599, 41, 'simple_local_avatar', 'a:1:{s:4:"full";s:108:"http://localhost/SMS/wp-content/uploads/2018/04/1-AdobePhotoshopExpress_e90803656f204497b076a4b76c750948.jpg";}'),
(600, 43, 'nickname', 'waeez'),
(601, 43, 'first_name', 'WAEEZ'),
(602, 43, 'last_name', ''),
(603, 43, 'description', ''),
(604, 43, 'rich_editing', 'true'),
(605, 43, 'syntax_highlighting', 'true'),
(606, 43, 'comment_shortcuts', 'false'),
(607, 43, 'admin_color', 'fresh'),
(608, 43, 'use_ssl', '0'),
(609, 43, 'show_admin_bar_front', 'true'),
(610, 43, 'locale', ''),
(611, 43, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(612, 43, 'wp_user_level', '0'),
(613, 43, 'dismissed_wp_pointers', ''),
(623, 44, 'nickname', 'student_1524644385'),
(624, 44, 'first_name', 'Muhammad'),
(625, 44, 'last_name', ''),
(626, 44, 'description', ''),
(627, 44, 'rich_editing', 'true'),
(628, 44, 'syntax_highlighting', 'true'),
(629, 44, 'comment_shortcuts', 'false'),
(630, 44, 'admin_color', 'fresh'),
(631, 44, 'use_ssl', '0'),
(632, 44, 'show_admin_bar_front', 'true'),
(633, 44, 'locale', ''),
(634, 44, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(635, 44, 'wp_user_level', '0'),
(636, 44, 'dismissed_wp_pointers', ''),
(637, 45, 'nickname', 'smuhammad'),
(638, 45, 'first_name', ''),
(639, 45, 'last_name', ''),
(640, 45, 'description', ''),
(641, 45, 'rich_editing', 'true'),
(642, 45, 'syntax_highlighting', 'true'),
(643, 45, 'comment_shortcuts', 'false'),
(644, 45, 'admin_color', 'fresh'),
(645, 45, 'use_ssl', '0'),
(646, 45, 'show_admin_bar_front', 'true'),
(647, 45, 'locale', ''),
(648, 45, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(649, 45, 'wp_user_level', '0'),
(650, 45, 'dismissed_wp_pointers', ''),
(651, 46, 'nickname', 'student_1524714329'),
(652, 46, 'first_name', 'Bisma'),
(653, 46, 'last_name', ''),
(654, 46, 'description', ''),
(655, 46, 'rich_editing', 'true'),
(656, 46, 'syntax_highlighting', 'true'),
(657, 46, 'comment_shortcuts', 'false'),
(658, 46, 'admin_color', 'fresh'),
(659, 46, 'use_ssl', '0'),
(660, 46, 'show_admin_bar_front', 'true'),
(661, 46, 'locale', ''),
(662, 46, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(663, 46, 'wp_user_level', '0'),
(664, 46, 'dismissed_wp_pointers', ''),
(665, 47, 'nickname', 'student_1524801711'),
(666, 47, 'first_name', 'Abdullah'),
(667, 47, 'last_name', ''),
(668, 47, 'description', ''),
(669, 47, 'rich_editing', 'true'),
(670, 47, 'syntax_highlighting', 'true'),
(671, 47, 'comment_shortcuts', 'false'),
(672, 47, 'admin_color', 'fresh'),
(673, 47, 'use_ssl', '0'),
(674, 47, 'show_admin_bar_front', 'true'),
(675, 47, 'locale', ''),
(676, 47, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(677, 47, 'wp_user_level', '0'),
(678, 47, 'dismissed_wp_pointers', ''),
(679, 48, 'nickname', 'student_1524807311'),
(680, 48, 'first_name', 'Yasmin'),
(681, 48, 'last_name', ''),
(682, 48, 'description', ''),
(683, 48, 'rich_editing', 'true'),
(684, 48, 'syntax_highlighting', 'true'),
(685, 48, 'comment_shortcuts', 'false'),
(686, 48, 'admin_color', 'fresh'),
(687, 48, 'use_ssl', '0'),
(688, 48, 'show_admin_bar_front', 'true'),
(689, 48, 'locale', ''),
(690, 48, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(691, 48, 'wp_user_level', '0'),
(692, 48, 'dismissed_wp_pointers', ''),
(693, 49, 'nickname', 'student_1524808187'),
(694, 49, 'first_name', 'Abdul'),
(695, 49, 'last_name', ''),
(696, 49, 'description', ''),
(697, 49, 'rich_editing', 'true'),
(698, 49, 'syntax_highlighting', 'true'),
(699, 49, 'comment_shortcuts', 'false'),
(700, 49, 'admin_color', 'fresh'),
(701, 49, 'use_ssl', '0'),
(702, 49, 'show_admin_bar_front', 'true'),
(703, 49, 'locale', ''),
(704, 49, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(705, 49, 'wp_user_level', '0'),
(706, 49, 'dismissed_wp_pointers', ''),
(707, 50, 'nickname', 'student_1524808741'),
(708, 50, 'first_name', 'Hanzala'),
(709, 50, 'last_name', ''),
(710, 50, 'description', ''),
(711, 50, 'rich_editing', 'true'),
(712, 50, 'syntax_highlighting', 'true'),
(713, 50, 'comment_shortcuts', 'false'),
(714, 50, 'admin_color', 'fresh'),
(715, 50, 'use_ssl', '0'),
(716, 50, 'show_admin_bar_front', 'true'),
(717, 50, 'locale', ''),
(718, 50, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(719, 50, 'wp_user_level', '0'),
(720, 50, 'dismissed_wp_pointers', ''),
(721, 51, 'nickname', 'student_1524809035'),
(722, 51, 'first_name', 'Alqama'),
(723, 51, 'last_name', ''),
(724, 51, 'description', ''),
(725, 51, 'rich_editing', 'true'),
(726, 51, 'syntax_highlighting', 'true'),
(727, 51, 'comment_shortcuts', 'false'),
(728, 51, 'admin_color', 'fresh'),
(729, 51, 'use_ssl', '0'),
(730, 51, 'show_admin_bar_front', 'true'),
(731, 51, 'locale', ''),
(732, 51, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(733, 51, 'wp_user_level', '0'),
(734, 51, 'dismissed_wp_pointers', ''),
(735, 52, 'nickname', 'student_1524813188'),
(736, 52, 'first_name', 'Abdul'),
(737, 52, 'last_name', ''),
(738, 52, 'description', ''),
(739, 52, 'rich_editing', 'true'),
(740, 52, 'syntax_highlighting', 'true'),
(741, 52, 'comment_shortcuts', 'false'),
(742, 52, 'admin_color', 'fresh'),
(743, 52, 'use_ssl', '0'),
(744, 52, 'show_admin_bar_front', 'true'),
(745, 52, 'locale', ''),
(746, 52, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(747, 52, 'wp_user_level', '0'),
(748, 52, 'dismissed_wp_pointers', ''),
(749, 53, 'nickname', 'student_1524814763'),
(750, 53, 'first_name', 'Abuzar'),
(751, 53, 'last_name', ''),
(752, 53, 'description', ''),
(753, 53, 'rich_editing', 'true'),
(754, 53, 'syntax_highlighting', 'true'),
(755, 53, 'comment_shortcuts', 'false'),
(756, 53, 'admin_color', 'fresh'),
(757, 53, 'use_ssl', '0'),
(758, 53, 'show_admin_bar_front', 'true'),
(759, 53, 'locale', ''),
(760, 53, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(761, 53, 'wp_user_level', '0'),
(762, 53, 'dismissed_wp_pointers', ''),
(763, 54, 'nickname', 'student_1524878374'),
(764, 54, 'first_name', 'Muhammad'),
(765, 54, 'last_name', ''),
(766, 54, 'description', ''),
(767, 54, 'rich_editing', 'true'),
(768, 54, 'syntax_highlighting', 'true'),
(769, 54, 'comment_shortcuts', 'false'),
(770, 54, 'admin_color', 'fresh'),
(771, 54, 'use_ssl', '0'),
(772, 54, 'show_admin_bar_front', 'true'),
(773, 54, 'locale', ''),
(774, 54, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(775, 54, 'wp_user_level', '0'),
(776, 54, 'dismissed_wp_pointers', ''),
(777, 55, 'nickname', 'student_1524878506'),
(778, 55, 'first_name', 'Saquib'),
(779, 55, 'last_name', ''),
(780, 55, 'description', ''),
(781, 55, 'rich_editing', 'true'),
(782, 55, 'syntax_highlighting', 'true'),
(783, 55, 'comment_shortcuts', 'false'),
(784, 55, 'admin_color', 'fresh'),
(785, 55, 'use_ssl', '0'),
(786, 55, 'show_admin_bar_front', 'true'),
(787, 55, 'locale', ''),
(788, 55, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(789, 55, 'wp_user_level', '0'),
(790, 55, 'dismissed_wp_pointers', ''),
(791, 56, 'nickname', 'student_1524889140'),
(792, 56, 'first_name', 'Zainul'),
(793, 56, 'last_name', ''),
(794, 56, 'description', ''),
(795, 56, 'rich_editing', 'true'),
(796, 56, 'syntax_highlighting', 'true'),
(797, 56, 'comment_shortcuts', 'false'),
(798, 56, 'admin_color', 'fresh'),
(799, 56, 'use_ssl', '0'),
(800, 56, 'show_admin_bar_front', 'true'),
(801, 56, 'locale', ''),
(802, 56, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(803, 56, 'wp_user_level', '0'),
(804, 56, 'dismissed_wp_pointers', ''),
(805, 57, 'nickname', 'shahidazeem'),
(806, 57, 'first_name', ''),
(807, 57, 'last_name', ''),
(808, 57, 'description', ''),
(809, 57, 'rich_editing', 'true'),
(810, 57, 'syntax_highlighting', 'true'),
(811, 57, 'comment_shortcuts', 'false'),
(812, 57, 'admin_color', 'fresh'),
(813, 57, 'use_ssl', '0'),
(814, 57, 'show_admin_bar_front', 'true'),
(815, 57, 'locale', ''),
(816, 57, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(817, 57, 'wp_user_level', '0'),
(818, 57, 'dismissed_wp_pointers', ''),
(819, 57, 'session_tokens', 'a:1:{s:64:"66ef028845b7966ed87a1ea0593f06ae3ea4ccafebbd65616341416d5cd6df5f";a:4:{s:10:"expiration";i:1525062060;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36";s:5:"login";i:1524889260;}}'),
(820, 58, 'nickname', 'student_1525000973'),
(821, 58, 'first_name', 'Zainul'),
(822, 58, 'last_name', ''),
(823, 58, 'description', ''),
(824, 58, 'rich_editing', 'true'),
(825, 58, 'syntax_highlighting', 'true'),
(826, 58, 'comment_shortcuts', 'false'),
(827, 58, 'admin_color', 'fresh'),
(828, 58, 'use_ssl', '0'),
(829, 58, 'show_admin_bar_front', 'true'),
(830, 58, 'locale', ''),
(831, 58, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(832, 58, 'wp_user_level', '0'),
(833, 58, 'dismissed_wp_pointers', ''),
(834, 59, 'nickname', 'shahidazeem'),
(835, 59, 'first_name', ''),
(836, 59, 'last_name', ''),
(837, 59, 'description', ''),
(838, 59, 'rich_editing', 'true'),
(839, 59, 'syntax_highlighting', 'true'),
(840, 59, 'comment_shortcuts', 'false'),
(841, 59, 'admin_color', 'fresh'),
(842, 59, 'use_ssl', '0'),
(843, 59, 'show_admin_bar_front', 'true'),
(844, 59, 'locale', ''),
(845, 59, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(846, 59, 'wp_user_level', '0'),
(847, 59, 'dismissed_wp_pointers', ''),
(850, 60, 'nickname', 'student_1525002011'),
(851, 60, 'first_name', 'Zainul'),
(852, 60, 'last_name', ''),
(853, 60, 'description', ''),
(854, 60, 'rich_editing', 'true'),
(855, 60, 'syntax_highlighting', 'true'),
(856, 60, 'comment_shortcuts', 'false'),
(857, 60, 'admin_color', 'fresh'),
(858, 60, 'use_ssl', '0'),
(859, 60, 'show_admin_bar_front', 'true'),
(860, 60, 'locale', ''),
(861, 60, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(862, 60, 'wp_user_level', '0'),
(863, 60, 'dismissed_wp_pointers', ''),
(864, 61, 'nickname', 'shahidazeem'),
(865, 61, 'first_name', ''),
(866, 61, 'last_name', ''),
(867, 61, 'description', ''),
(868, 61, 'rich_editing', 'true'),
(869, 61, 'syntax_highlighting', 'true'),
(870, 61, 'comment_shortcuts', 'false'),
(871, 61, 'admin_color', 'fresh'),
(872, 61, 'use_ssl', '0'),
(873, 61, 'show_admin_bar_front', 'true'),
(874, 61, 'locale', ''),
(875, 61, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(876, 61, 'wp_user_level', '0'),
(877, 61, 'dismissed_wp_pointers', ''),
(880, 1, 'session_tokens', 'a:1:{s:64:"4101de22389c795507bba177d7625ac45172670f3e959798a2f9809a5db7a1ed";a:4:{s:10:"expiration";i:1540745577;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36";s:5:"login";i:1540572777;}}'),
(881, 62, 'nickname', 'student_1526517529'),
(882, 62, 'first_name', 'Zainul'),
(883, 62, 'last_name', ''),
(884, 62, 'description', ''),
(885, 62, 'rich_editing', 'true'),
(886, 62, 'syntax_highlighting', 'true'),
(887, 62, 'comment_shortcuts', 'false'),
(888, 62, 'admin_color', 'fresh'),
(889, 62, 'use_ssl', '0'),
(890, 62, 'show_admin_bar_front', 'true'),
(891, 62, 'locale', ''),
(892, 62, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(893, 62, 'wp_user_level', '0'),
(894, 62, 'dismissed_wp_pointers', ''),
(896, 63, 'nickname', 'student_1534960792'),
(897, 63, 'first_name', 'abdullah'),
(898, 63, 'last_name', ''),
(899, 63, 'description', ''),
(900, 63, 'rich_editing', 'true'),
(901, 63, 'syntax_highlighting', 'true'),
(902, 63, 'comment_shortcuts', 'false'),
(903, 63, 'admin_color', 'fresh'),
(904, 63, 'use_ssl', '0'),
(905, 63, 'show_admin_bar_front', 'true'),
(906, 63, 'locale', ''),
(907, 63, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(908, 63, 'wp_user_level', '0'),
(909, 63, 'dismissed_wp_pointers', 'wp496_privacy'),
(910, 64, 'nickname', 'rshdazm'),
(911, 64, 'first_name', ''),
(912, 64, 'last_name', ''),
(913, 64, 'description', ''),
(914, 64, 'rich_editing', 'true'),
(915, 64, 'syntax_highlighting', 'true'),
(916, 64, 'comment_shortcuts', 'false'),
(917, 64, 'admin_color', 'fresh'),
(918, 64, 'use_ssl', '0'),
(919, 64, 'show_admin_bar_front', 'true'),
(920, 64, 'locale', ''),
(921, 64, 'wp_capabilities', 'a:1:{s:6:"parent";b:1;}'),
(922, 64, 'wp_user_level', '0'),
(923, 64, 'dismissed_wp_pointers', 'wp496_privacy'),
(924, 65, 'nickname', 'student_1535131718'),
(925, 65, 'first_name', 'Zainul'),
(926, 65, 'last_name', ''),
(927, 65, 'description', ''),
(928, 65, 'rich_editing', 'true'),
(929, 65, 'syntax_highlighting', 'true'),
(930, 65, 'comment_shortcuts', 'false'),
(931, 65, 'admin_color', 'fresh'),
(932, 65, 'use_ssl', '0'),
(933, 65, 'show_admin_bar_front', 'true'),
(934, 65, 'locale', ''),
(935, 65, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(936, 65, 'wp_user_level', '0'),
(937, 65, 'dismissed_wp_pointers', 'wp496_privacy'),
(938, 66, 'nickname', 'student_1535132185'),
(939, 66, 'first_name', 'Muhammad'),
(940, 66, 'last_name', ''),
(941, 66, 'description', ''),
(942, 66, 'rich_editing', 'true'),
(943, 66, 'syntax_highlighting', 'true'),
(944, 66, 'comment_shortcuts', 'false'),
(945, 66, 'admin_color', 'fresh'),
(946, 66, 'use_ssl', '0'),
(947, 66, 'show_admin_bar_front', 'true'),
(948, 66, 'locale', ''),
(949, 66, 'wp_capabilities', 'a:1:{s:7:"student";b:1;}'),
(950, 66, 'wp_user_level', '0'),
(951, 66, 'dismissed_wp_pointers', 'wp496_privacy'),
(952, 1, 'wp_user-settings', 'libraryContent=browse'),
(953, 1, 'wp_user-settings-time', '1536341947'),
(954, 61, 'session_tokens', 'a:1:{s:64:"eef14f6ff1c3f3d2280a90541abe8d0f0a65dbba76ddde26c0f9fb1226c09a67";a:4:{s:10:"expiration";i:1539082407;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36";s:5:"login";i:1538909607;}}');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BRKBl8hcX4sqiJXQBztBSF6C4npgJm0', 'admin', 'zainulabd786@gmail.com', '', '2018-03-12 14:22:32', '', 0, 'admin'),
(60, 'student_1525002011', '$P$BknBs6WUUOqSrhhLqmtQg9.RC3wUCf.', 'student_1525002011', 'student_1525002011@spischool.org', '', '2018-04-29 11:40:11', '1525002014:$P$B68mzmq0302B9tFxBB87OVRBkt8ncq0', 0, 'Zainul'),
(61, 'shahidazeem', '$2y$10$BcaXqlZzwjdS7JxDfshSaum4G5.n45cq11/31T169Q2VTIFaAp9aS', 'shahidazeem', 'shahid@gmail.com', '', '2018-04-29 11:40:12', '', 0, 'shahidazeem'),
(62, 'student_1526517529', '$P$BRimd8886cASkGpxEfWKgXgUvXSSmd/', 'student_1526517529', 'student_1526517529@spischool.org', '', '2018-05-17 00:38:49', '1526517533:$P$BLLyl5/t35syFJMyj.SyhVfyLNsvCu1', 0, 'Zainul'),
(63, 'student_1534960792', '$P$ByohCVGxQ.gV.C6mu28rTNWPB09Jvn0', 'student_1534960792', 'student_1534960792@spischool.org', '', '2018-08-22 17:59:52', '1534960796:$P$BCaALjpAgHaWJzbWIT6CVb5kBDTIfX.', 0, 'abdullah'),
(64, 'rshdazm', '$P$Buqdq6YICV1Dx6E8gu9ZyfQrCuFyDL1', 'rshdazm', 'rashid@eden.com', '', '2018-08-22 17:59:53', '', 0, 'rshdazm'),
(65, 'student_1535131718', '$P$ByQWE5RXgxaV6sjQACgtJZGvzAzDDi0', 'student_1535131718', 'student_1535131718@spischool.org', '', '2018-08-24 17:28:38', '1535131720:$P$BIuLiXvHkQrzhbH/v0QbKEro.zZeal0', 0, 'Zainul'),
(66, 'student_1535132185', '$P$BLhImgGgdjjHlGZb08nFjG0.csTz3v0', 'student_1535132185', 'student_1535132185@spischool.org', '', '2018-08-24 17:36:25', '1535132186:$P$Blwlm4zoxJBFwHZUE3fQdG8bEg9la8.', 0, 'Muhammad');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_assigned_inventory`
--

CREATE TABLE `wp_wpsp_assigned_inventory` (
  `sno` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `staff_uid` int(11) DEFAULT NULL,
  `session` varchar(12) DEFAULT NULL,
  `consumed` int(1) NOT NULL,
  `reassigned_from` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_assigned_inventory`
--

INSERT INTO `wp_wpsp_assigned_inventory` (`sno`, `master_id`, `date`, `quantity`, `staff_uid`, `session`, `consumed`, `reassigned_from`) VALUES
(19, 2, '2018-09-10', 38, 3, '2018-19', 0, 0),
(22, 2, '1970-01-01', 4, 2, '2018-19', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_attendance`
--

CREATE TABLE `wp_wpsp_attendance` (
  `aid` int(15) UNSIGNED NOT NULL,
  `class_id` varchar(15) DEFAULT NULL,
  `absents` text,
  `date` date DEFAULT NULL,
  `entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_attendance`
--

INSERT INTO `wp_wpsp_attendance` (`aid`, `class_id`, `absents`, `date`, `entry`) VALUES
(3, '1', '[{"sid":"39","reason":""}]', '2018-04-19', '2018-04-19 07:50:38'),
(7, '1', '[{"sid":"66","reason":""},{"sid":"60","reason":""}]', '2018-09-06', '2018-09-06 17:30:10'),
(8, '1', '[{"sid":"66","reason":""},{"sid":"60","reason":""}]', '2018-09-07', '2018-09-07 17:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_bank_transactions`
--

CREATE TABLE `wp_wpsp_bank_transactions` (
  `tid` int(11) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `reference` varchar(99) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_bank_transactions`
--

INSERT INTO `wp_wpsp_bank_transactions` (`tid`, `date_time`, `reference`, `type`, `group_id`, `remarks`, `amount`, `balance`) VALUES
(1810040, '2018-10-04 15:32:26', '', 1, 0, 'Rent Received', 2000, 2000),
(1810041, '2018-10-04 15:33:07', '', 0, 0, 'Paid Bill', 700, 1300),
(1810070, '2018-10-07 11:05:05', '20', 1, 1, 'Onlin Fees Payment by Shahid  Azeem', 2000, 3300);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_cash_transactions`
--

CREATE TABLE `wp_wpsp_cash_transactions` (
  `tid` int(11) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `reference` varchar(99) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_cash_transactions`
--

INSERT INTO `wp_wpsp_cash_transactions` (`tid`, `date_time`, `reference`, `type`, `group_id`, `remarks`, `amount`, `balance`) VALUES
(1810100, '2018-10-10 15:49:56', '', 1, 1, 'Collected Fees', 10000, 10000),
(1810101, '2018-10-10 15:50:29', '', 0, 4, 'Electricity', 2000, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_class`
--

CREATE TABLE `wp_wpsp_class` (
  `cid` int(15) NOT NULL,
  `c_numb` varchar(128) DEFAULT NULL,
  `c_name` varchar(128) DEFAULT NULL,
  `teacher_id` int(15) DEFAULT NULL,
  `c_capacity` int(5) DEFAULT NULL,
  `c_loc` varchar(60) DEFAULT NULL,
  `c_sdate` date DEFAULT NULL,
  `c_edate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_class`
--

INSERT INTO `wp_wpsp_class` (`cid`, `c_numb`, `c_name`, `teacher_id`, `c_capacity`, `c_loc`, `c_sdate`, `c_edate`) VALUES
(1, '1', 'wpsp standard-1', 2, NULL, 'France', '2018-03-12', '2018-09-12'),
(2, '2', 'wpsp standard-2', 3, NULL, 'India', '2018-03-12', '2018-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_events`
--

CREATE TABLE `wp_wpsp_events` (
  `id` bigint(15) UNSIGNED NOT NULL,
  `start` varchar(50) DEFAULT NULL,
  `end` varchar(50) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `title` text,
  `description` longtext,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_events`
--

INSERT INTO `wp_wpsp_events` (`id`, `start`, `end`, `type`, `title`, `description`, `color`) VALUES
(1, '2018-08-09 05:00:00', '2018-08-09 06:00:00', '0', 'Some event', 'desc', '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_exam`
--

CREATE TABLE `wp_wpsp_exam` (
  `eid` int(15) NOT NULL,
  `classid` int(15) DEFAULT NULL,
  `subject_id` varchar(128) DEFAULT NULL,
  `e_name` varchar(128) DEFAULT NULL,
  `e_s_date` date DEFAULT NULL,
  `e_e_date` date DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees`
--

CREATE TABLE `wp_wpsp_fees` (
  `fees_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fees_amount` float NOT NULL,
  `description` text NOT NULL,
  `duration` text NOT NULL,
  `paymentType` text NOT NULL,
  `due_time` int(2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_dues`
--

CREATE TABLE `wp_wpsp_fees_dues` (
  `date` date DEFAULT NULL,
  `id` int(15) NOT NULL,
  `uid` int(15) DEFAULT NULL,
  `month` int(2) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `fees_type` varchar(11) DEFAULT NULL,
  `session` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_payment`
--

CREATE TABLE `wp_wpsp_fees_payment` (
  `fees_pay_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `fees_id` int(11) NOT NULL,
  `fees_paid_amount` float NOT NULL,
  `payment_status` varchar(10) NOT NULL,
  `paid_due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_payment_record`
--

CREATE TABLE `wp_wpsp_fees_payment_record` (
  `tid` varchar(50) NOT NULL,
  `slip_no` int(9) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `uid` int(15) DEFAULT NULL,
  `month` int(2) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `session` varchar(20) DEFAULT NULL,
  `fees_type` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_fees_payment_record`
--

INSERT INTO `wp_wpsp_fees_payment_record` (`tid`, `slip_no`, `date_time`, `uid`, `month`, `amount`, `session`, `fees_type`, `status`) VALUES
('120818080210', 5, '2018-08-15 15:08:02', 60, 10, 1200, '2018-19', 'ttn', 0),
('120818080211', 5, '2018-08-15 15:08:02', 60, 11, 1200, '2018-19', 'ttn', 0),
('120818080212', 5, '2018-08-15 15:08:02', 60, 12, 1200, '2018-19', 'ttn', 0),
('120818080213', 5, '2018-08-15 15:08:02', 60, 13, 1200, '2018-19', 'ttn', 0),
('120818080214', 5, '2018-08-15 15:08:02', 60, 14, 1200, '2018-19', 'ttn', 0),
('120818080215', 5, '2018-08-15 15:08:02', 60, 15, 1200, '2018-19', 'ttn', 0),
('120818080216', 5, '2018-08-15 15:08:02', 60, 16, 1200, '2018-19', 'ttn', 0),
('1208180802161', 5, '2018-08-15 15:08:02', 60, 16, 200, '2018-19', 'trn', 0),
('120818080260', 5, '2018-08-15 15:08:02', 60, 6, 1200, '2018-19', 'ttn', 0),
('12081808027', 5, '2018-08-15 15:08:02', 60, 7, 1200, '2018-19', 'ttn', 0),
('12081808028', 5, '2018-08-15 15:08:02', 60, 8, 1200, '2018-19', 'ttn', 0),
('12081808029', 5, '2018-08-15 15:08:02', 60, 9, 1200, '2018-19', 'ttn', 0),
('150818010410', 7, '2018-08-15 12:01:04', 60, 10, 1200, '2018-19', 'ttn', 1),
('150818010411', 7, '2018-08-15 12:01:04', 60, 11, 1200, '2018-19', 'ttn', 1),
('150818010412', 7, '2018-08-15 12:01:04', 60, 12, 1200, '2018-19', 'ttn', 1),
('150818010413', 7, '2018-08-15 12:01:04', 60, 13, 1200, '2018-19', 'ttn', 1),
('150818010414', 7, '2018-08-15 12:01:04', 60, 14, 1200, '2018-19', 'ttn', 1),
('150818010415', 7, '2018-08-15 12:01:04', 60, 15, 1200, '2018-19', 'ttn', 1),
('150818010416', 7, '2018-08-15 12:01:04', 60, 16, 1200, '2018-19', 'ttn', 1),
('150818010480', 7, '2018-08-15 12:01:04', 60, 8, 1200, '2018-19', 'ttn', 1),
('15081801049', 7, '2018-08-15 12:01:04', 60, 9, 1200, '2018-19', 'ttn', 1),
('150818583410', 6, '2018-08-15 11:58:34', 60, 10, 1200, '2018-19', 'ttn', 0),
('150818583411', 6, '2018-08-15 11:58:34', 60, 11, 1200, '2018-19', 'ttn', 0),
('150818583412', 6, '2018-08-15 11:58:34', 60, 12, 1200, '2018-19', 'ttn', 0),
('150818583413', 6, '2018-08-15 11:58:34', 60, 13, 1200, '2018-19', 'ttn', 0),
('150818583414', 6, '2018-08-15 11:58:34', 60, 14, 1200, '2018-19', 'ttn', 0),
('150818583415', 6, '2018-08-15 11:58:34', 60, 15, 1200, '2018-19', 'ttn', 0),
('150818583416', 6, '2018-08-15 11:58:34', 60, 16, 1200, '2018-19', 'ttn', 0),
('150818583470', 6, '2018-08-15 11:58:34', 60, 7, 1200, '2018-19', 'ttn', 0),
('15081858348', 6, '2018-08-15 11:58:34', 60, 8, 1200, '2018-19', 'ttn', 0),
('15081858349', 6, '2018-08-15 11:58:34', 60, 9, 1200, '2018-19', 'ttn', 0),
('240818265501', 8, '2018-08-24 17:26:55', 63, 0, 100, '2018-19', 'adm', 0),
('240818265512', 8, '2018-08-24 17:26:55', 63, 0, 300, '2018-19', 'ann', 0),
('240818265580', 8, '2018-08-24 17:26:55', 63, 8, 200, '2018-19', 'ttn', 0),
('240818304301', 9, '2018-08-24 17:30:43', 65, 0, 500, '2018-19', 'adm', 0),
('240818304310', 9, '2018-08-24 17:30:43', 65, 10, 1000, '2018-19', 'ttn', 0),
('240818304312', 9, '2018-08-24 17:30:43', 65, 0, 1500, '2018-19', 'ann', 0),
('240818304380', 9, '2018-08-24 17:30:43', 65, 8, 1000, '2018-19', 'ttn', 0),
('24081830439', 9, '2018-08-24 17:30:43', 65, 9, 1000, '2018-19', 'ttn', 0),
('240818370101', 10, '2018-08-24 17:37:01', 66, 0, 200, '2018-19', 'adm', 0),
('240818370112', 10, '2018-08-24 17:37:01', 66, 0, 600, '2018-19', 'ann', 0),
('240818370180', 10, '2018-08-24 17:37:01', 66, 8, 100, '2018-19', 'ttn', 0),
('240818374380', 11, '2018-08-24 17:37:43', 66, 8, 400, '2018-19', 'ttn', 0),
('24081837439', 11, '2018-08-24 17:37:43', 66, 9, 400, '2018-19', 'ttn', 0),
('300918003290', 17, '2018-09-30 08:00:32', 66, 9, 1000, '2018-19', 'ttn', 0),
('300918111590', 18, '2018-09-30 08:11:15', 66, 9, 1000, '2018-19', 'ttn', 0),
('300918261890', 12, '2018-09-30 06:26:18', 66, 9, 100, '2018-19', 'ttn', 0),
('300918340890', 13, '2018-09-30 06:34:08', 66, 9, 2000, '2018-19', 'ttn', 0),
('300918481490', 14, '2018-09-30 06:48:14', 66, 9, 1000, '2018-19', 'ttn', 0),
('300918501590', 15, '2018-09-30 06:50:15', 66, 9, 1000, '2018-19', 'ttn', 0),
('300918513590', 19, '2018-09-30 08:51:35', 66, 9, 1000, '2018-19', 'ttn', 0),
('300918573990', 16, '2018-09-30 07:57:39', 66, 9, 1000, '2018-19', 'ttn', 0),
('MOJO8a07005N85097613TN9', 20, '2018-10-07 11:05:05', 65, 9, 2000, '2018-19', 'ttn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_receipts`
--

CREATE TABLE `wp_wpsp_fees_receipts` (
  `slip_no` int(25) NOT NULL,
  `date` date DEFAULT NULL,
  `uid` int(15) DEFAULT NULL,
  `cid` int(10) DEFAULT NULL,
  `from_ttn` int(2) DEFAULT NULL,
  `to_ttn` int(2) DEFAULT NULL,
  `from_trn` int(2) DEFAULT NULL,
  `to_trn` int(2) DEFAULT NULL,
  `session` varchar(20) DEFAULT NULL,
  `adm` int(11) DEFAULT NULL,
  `ttn` varchar(11) DEFAULT NULL,
  `trans` int(11) DEFAULT NULL,
  `ann` varchar(11) DEFAULT NULL,
  `rec` int(11) DEFAULT NULL,
  `concession` int(11) DEFAULT NULL,
  `mop` varchar(20) DEFAULT NULL,
  `pno` varchar(50) DEFAULT NULL,
  `due_adm` int(11) DEFAULT NULL,
  `due_ttn` int(11) DEFAULT NULL,
  `due_trn` int(11) DEFAULT NULL,
  `due_ann` int(11) DEFAULT NULL,
  `due_rec` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_fees_receipts`
--

INSERT INTO `wp_wpsp_fees_receipts` (`slip_no`, `date`, `uid`, `cid`, `from_ttn`, `to_ttn`, `from_trn`, `to_trn`, `session`, `adm`, `ttn`, `trans`, `ann`, `rec`, `concession`, `mop`, `pno`, `due_adm`, `due_ttn`, `due_trn`, `due_ann`, `due_rec`, `status`) VALUES
(5, '2018-08-15', 60, 1, 6, 16, 16, 16, '2018-19', 0, '13200', 200, '0', 0, 0, '', '0', 0, 0, 0, 0, 0, 0),
(6, '2018-08-15', 60, 1, 7, 16, 0, 0, '2018-19', 0, '12000', 0, '0', 0, 0, 'Cash', '0', 0, 0, 0, 0, 0, 0),
(7, '2018-08-15', 60, 1, 8, 16, 0, 0, '2018-19', 0, '10800', 0, '0', 0, 0, '', '0', 0, 0, 0, 0, 0, 1),
(8, '2018-08-24', 63, 1, 8, 8, 0, 0, '2018-19', 100, '200', 0, '300', 0, 0, '', '0', 0, 0, 0, 0, 0, 0),
(9, '2018-08-24', 65, 2, 8, 10, 0, 0, '2018-19', 500, '3000', 0, '1500', 0, 0, '', '0', 0, 0, 0, 0, 0, 0),
(10, '2018-08-24', 66, 1, 8, 8, 0, 0, '2018-19', 200, '100', 0, '600', 0, 0, '', '0', 0, 400, 0, 0, 0, 0),
(11, '2018-08-24', 66, 1, 8, 9, 0, 0, '2018-19', 0, '800', 0, '0', 0, 0, '', '0', 0, 100, 0, 0, 0, 0),
(12, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '100', 0, '0', 0, 0, '', '0', 0, 0, 0, 0, 0, 0),
(13, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '2000', 0, '0', 0, 0, 'Cash', '0', 0, 0, 0, 0, 0, 0),
(14, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '1000', 0, '0', 0, 0, 'Cheque', '100000', 0, 0, 0, 0, 0, 0),
(15, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '1000', 0, '0', 0, 0, 'Cash', '0', 0, 0, 0, 0, 0, 0),
(16, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '1000', 0, '0', 0, 0, 'Cash', '0', 0, 0, 0, 0, 0, 0),
(17, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '1000', 0, '0', 0, 0, 'Cash', '0', 0, 0, 0, 0, 0, 0),
(18, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '1000', 0, '0', 0, 0, 'Cash', '0', 0, 0, 0, 0, 0, 0),
(19, '2018-09-30', 66, 1, 9, 9, 0, 0, '2018-19', 0, '1000', 0, '0', 0, 0, 'Cash', '0', 0, 0, 0, 0, 0, 0),
(20, '2018-10-07', 65, 2, 9, 9, NULL, 0, '2018-19', 0, '2000', 0, '0', 0, 0, 'NETBANKING', 'MOJO8a07005N85097613', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_settings`
--

CREATE TABLE `wp_wpsp_fees_settings` (
  `cid` int(11) NOT NULL,
  `admission_fees` int(11) DEFAULT NULL,
  `tution_fees` int(11) DEFAULT NULL,
  `annual_chg` int(11) DEFAULT NULL,
  `recreation_chg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_fees_settings`
--

INSERT INTO `wp_wpsp_fees_settings` (`cid`, `admission_fees`, `tution_fees`, `annual_chg`, `recreation_chg`) VALUES
(1, 2000, 1200, 1000, 500),
(2, 3000, 2000, 1000, 500);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fee_payment_history`
--

CREATE TABLE `wp_wpsp_fee_payment_history` (
  `payment_history_id` bigint(20) NOT NULL,
  `fees_pay_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `paid_date` date NOT NULL,
  `paid_by` bigint(20) NOT NULL,
  `paid_status` int(2) NOT NULL,
  `paymentdescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_follow_up`
--

CREATE TABLE `wp_wpsp_follow_up` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `visitor` int(11) DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_follow_up`
--

INSERT INTO `wp_wpsp_follow_up` (`id`, `date`, `visitor`, `comments`) VALUES
(1, '2018-05-15', 10, 'Called'),
(2, '2018-05-15', 2, 'Called but no response'),
(3, '2018-05-15', 2, 'Met');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_grade`
--

CREATE TABLE `wp_wpsp_grade` (
  `gid` int(15) NOT NULL,
  `g_name` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `g_point` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `mark_from` int(3) DEFAULT NULL,
  `mark_upto` int(3) DEFAULT NULL,
  `comment` varchar(60) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_import_history`
--

CREATE TABLE `wp_wpsp_import_history` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `imported_id` longtext NOT NULL,
  `time` datetime NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_inventory_items`
--

CREATE TABLE `wp_wpsp_inventory_items` (
  `item_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `session` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_inventory_items`
--

INSERT INTO `wp_wpsp_inventory_items` (`item_id`, `master_id`, `date`, `model`, `manufacturer`, `price`, `quantity`, `description`, `session`) VALUES
(1, 1, '2018-05-02', 'P001', 'Cello', 100, 10, 'Ink Pens', '2018-19'),
(2, 9, '2018-05-08', '90', 'nokia', 200, 20, '', '2018-19'),
(4, 7, '2018-05-11', 'HB', 'Rekha', 1200, 10, 'Books For Students', '2018-19'),
(5, 2, '2018-05-17', 'PKS', 'Natraj', 200, 20, 'Students use', '2018-19'),
(6, 3, '2018-05-17', 'PJ', 'SK', 200, 10, '', '2018-19'),
(7, 4, '2018-05-18', 'BK', 'REF', 3000, 3, '', '2018-19');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_inventory_master`
--

CREATE TABLE `wp_wpsp_inventory_master` (
  `master_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_inventory_master`
--

INSERT INTO `wp_wpsp_inventory_master` (`master_id`, `item_name`) VALUES
(2, 'pencil'),
(3, 'Book'),
(4, 'Duster'),
(5, ' '),
(6, 'Pen');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_leavedays`
--

CREATE TABLE `wp_wpsp_leavedays` (
  `id` bigint(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `leave_date` date DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_mark`
--

CREATE TABLE `wp_wpsp_mark` (
  `mid` bigint(20) NOT NULL,
  `subject_id` varchar(128) DEFAULT NULL,
  `class_id` int(15) DEFAULT NULL,
  `student_id` int(15) DEFAULT NULL,
  `exam_id` int(15) DEFAULT NULL,
  `mark` varchar(60) DEFAULT NULL,
  `attendance` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_mark_extract`
--

CREATE TABLE `wp_wpsp_mark_extract` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `field_id` bigint(20) DEFAULT NULL,
  `exam_id` int(12) DEFAULT NULL,
  `subject_id` int(12) DEFAULT NULL,
  `mark` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_mark_fields`
--

CREATE TABLE `wp_wpsp_mark_fields` (
  `field_id` bigint(20) NOT NULL,
  `subject_id` int(12) DEFAULT NULL,
  `field_text` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_messages`
--

CREATE TABLE `wp_wpsp_messages` (
  `mid` int(15) NOT NULL,
  `s_id` int(15) DEFAULT NULL,
  `r_id` int(15) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `msg` longtext,
  `del_stat` int(15) DEFAULT NULL,
  `m_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_notification`
--

CREATE TABLE `wp_wpsp_notification` (
  `nid` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `receiver` varchar(25) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_notification`
--

INSERT INTO `wp_wpsp_notification` (`nid`, `name`, `description`, `receiver`, `type`, `date`, `status`) VALUES
(1, 'Zainul Abideen', 'Dear Parents, Thanks for depositing the payment of the month July . *Regards SPI School', 'allp', 2, '2018-04-16 00:00:00', 0),
(2, 'Test Message', 'Dear Parents, Thanks for depositing the payment of the month ##Field## . *Regards SPI School', 'allp', 2, '2018-04-16 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_settings`
--

CREATE TABLE `wp_wpsp_settings` (
  `id` int(15) UNSIGNED NOT NULL,
  `option_name` varchar(50) DEFAULT NULL,
  `option_value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_settings`
--

INSERT INTO `wp_wpsp_settings` (`id`, `option_name`, `option_value`) VALUES
(1, 'sch_name', 'Scholar\\&#039;s Paradise International School'),
(2, 'sch_logo', 'http://localhost/SMS/wp-content/uploads/2018/03/logo1-bg-1.png'),
(3, 'sch_wrkinghrs', ''),
(4, 'sch_wrkingyear', ''),
(5, 'sch_holiday', ''),
(6, 'sch_addr', '14/112, Vikas Nagar'),
(7, 'sch_city', 'Lucknow'),
(8, 'sch_state', 'Uttar Pradesh'),
(9, 'sch_country', 'India'),
(10, 'sch_pno', '09808033480'),
(11, 'sch_fax', '123456'),
(12, 'sch_email', 'spischoollko.org'),
(13, 'sch_website', 'www.spischool.org'),
(14, 'date_format', 'm/d/Y'),
(15, 'absent_sms_alert', '1'),
(16, 'notification_sms_alert', '1'),
(26, 'due_date', '19'),
(27, 'session', '2018-19'),
(28, 'due_php_script_status', '0'),
(29, 'sch_sms_provider', ''),
(30, 'sch_sms_user', ''),
(31, 'sch_sms_password', ''),
(32, 'sch_sms_from_number', ''),
(33, 'sch_sms_slaneuser', 'amir.it2006@gmail.com'),
(34, 'sch_sms_slanepassword', 'mca786786'),
(35, 'sch_sms_slanesid', 'SPISCH'),
(37, 'sch_num_sms', '86'),
(38, 'sch_enable_payment_gateway', '1'),
(39, 'sch_session_start', '5');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_single_student_fees`
--

CREATE TABLE `wp_wpsp_single_student_fees` (
  `uid` int(11) NOT NULL,
  `admission_fees` int(11) DEFAULT NULL,
  `tution_fees` int(11) DEFAULT NULL,
  `annual_chg` int(11) DEFAULT NULL,
  `recreation_chg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_single_student_fees`
--

INSERT INTO `wp_wpsp_single_student_fees` (`uid`, `admission_fees`, `tution_fees`, `annual_chg`, `recreation_chg`) VALUES
(60, 10000, 20000, 30000, 40000),
(65, 500, 1000, 1500, 2000),
(66, 200, 500, 600, 800);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_student`
--

CREATE TABLE `wp_wpsp_student` (
  `sid` int(15) NOT NULL,
  `wp_usr_id` bigint(20) DEFAULT NULL,
  `parent_wp_usr_id` int(15) DEFAULT NULL,
  `s_rollno` varchar(15) DEFAULT NULL,
  `s_regno` varchar(15) DEFAULT NULL,
  `s_fname` varchar(30) DEFAULT NULL,
  `s_mname` varchar(30) DEFAULT NULL,
  `s_lname` varchar(30) DEFAULT NULL,
  `s_dob` date DEFAULT NULL,
  `s_gender` varchar(10) DEFAULT NULL,
  `s_address` varchar(200) DEFAULT NULL,
  `s_paddress` varchar(200) DEFAULT NULL,
  `s_country` varchar(20) DEFAULT NULL,
  `s_zipcode` varchar(10) DEFAULT NULL,
  `s_phone` varchar(25) DEFAULT NULL,
  `s_bloodgrp` varchar(20) DEFAULT NULL,
  `s_doj` date DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `s_pzipcode` varchar(10) DEFAULT NULL,
  `s_pcountry` varchar(20) DEFAULT NULL,
  `s_city` varchar(20) DEFAULT NULL,
  `s_pcity` varchar(20) DEFAULT NULL,
  `p_fname` varchar(30) DEFAULT NULL,
  `p_mname` varchar(30) DEFAULT NULL,
  `p_lname` varchar(30) DEFAULT NULL,
  `p_gender` varchar(10) DEFAULT NULL,
  `p_edu` varchar(50) DEFAULT NULL,
  `p_profession` varchar(60) DEFAULT NULL,
  `p_bloodgrp` varchar(10) DEFAULT NULL,
  `transport` int(1) DEFAULT NULL,
  `route_id` int(9) DEFAULT NULL,
  `s_additionalinfo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_student`
--

INSERT INTO `wp_wpsp_student` (`sid`, `wp_usr_id`, `parent_wp_usr_id`, `s_rollno`, `s_regno`, `s_fname`, `s_mname`, `s_lname`, `s_dob`, `s_gender`, `s_address`, `s_paddress`, `s_country`, `s_zipcode`, `s_phone`, `s_bloodgrp`, `s_doj`, `class_id`, `s_pzipcode`, `s_pcountry`, `s_city`, `s_pcity`, `p_fname`, `p_mname`, `p_lname`, `p_gender`, `p_edu`, `p_profession`, `p_bloodgrp`, `transport`, `route_id`, `s_additionalinfo`) VALUES
(25, 60, 61, '1', '18001', 'Waeez', '', 'Azeem', '1996-01-04', 'Male', '9/727 A, Eden Sollutions, Deenanath Bazar', '9/727 A, Eden Sollutions, Deenanath Bazar', 'India', '247001', '9808033480', '', '2018-04-29', 1, '247001', 'India', 'Saharanpur', 'Saharanpur', 'Shahid', '', 'Azeem', 'Male', 'MCA', 'Developer', '', 1, 0, NULL),
(26, 62, 61, '10', '18002', 'Zainul', '', 'Abideen', '2018-05-15', 'Male', '9/727 A, Eden Sollutions, Deenanath Bazar', '9/727 A, Eden Sollutions, Deenanath Bazar', '', '247001', '9808033480', '', '2018-05-17', 2, '247001', '', 'Saharanpur', 'Saharanpur', 'Shahid', '', 'Azeem', 'Male', 'MCA', 'Developer', '', 0, 0, NULL),
(27, 63, 64, '19', '18003', 'abdullah', '', 'azeem', '2018-08-03', 'Male', '9/727 A, Eden Sollutions, Deenanath Bazar', '9/727 A, Eden Sollutions, Deenanath Bazar', 'India', '247001', '9808033480', 'A+', '2018-08-22', 1, '247001', 'India', 'Saharanpur', 'Saharanpur', 'Rashid', '', 'Azeem', 'Male', 'MBA', 'Leader', 'A-', 0, 0, NULL),
(28, 65, 61, '3', '18004', 'Zainul', '', 'Abideen', '2018-08-01', 'Male', '9/727 A, Eden Sollutions, Deenanath Bazar', '9/727 A, Eden Sollutions, Deenanath Bazar', 'India', '247001', '9808033480', '', '2018-08-24', 2, '247001', 'India', 'Saharanpur', 'Saharanpur', 'Shahid', '', 'Azeem', 'Male', 'MCA', 'Developer', '', 0, 0, NULL),
(29, 66, 0, '0', '18005', 'Muhammad', 'Hammad', 'Siddique', '2018-08-09', 'Male', 'Rench ka pul, Kutubsher', 'Rench ka pul, Kutubsher', '', '247001', '9756000089', '', '2018-08-24', 1, '247001', '', 'Saharanpur', 'Saharanpur', 'Muhammad', 'Hammad', 'Siddique', 'Male', 'MBA', '', '', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_subject`
--

CREATE TABLE `wp_wpsp_subject` (
  `id` int(15) NOT NULL,
  `sub_code` varchar(8) DEFAULT NULL,
  `class_id` int(15) DEFAULT NULL,
  `sub_name` varchar(60) DEFAULT NULL,
  `sub_teach_id` varchar(15) DEFAULT NULL,
  `book_name` varchar(60) DEFAULT NULL,
  `sub_desc` varchar(250) DEFAULT NULL,
  `max_mark` int(4) DEFAULT NULL,
  `pass_mark` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_teacher`
--

CREATE TABLE `wp_wpsp_teacher` (
  `tid` int(11) NOT NULL,
  `wp_usr_id` bigint(20) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `empcode` varchar(60) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `dol` date DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `qualification` varchar(25) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `bloodgrp` varchar(5) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `whours` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_teacher`
--

INSERT INTO `wp_wpsp_teacher` (`tid`, `wp_usr_id`, `first_name`, `middle_name`, `last_name`, `zipcode`, `country`, `city`, `address`, `empcode`, `dob`, `doj`, `dol`, `phone`, `qualification`, `gender`, `bloodgrp`, `position`, `whours`) VALUES
(1, 2, 'Wolfie', 'Lorenzo', 'Gallahue', '42963', 'France', 'Saint-Etienne', '9716 Northland Parkway', 'Emp-01', '1988-10-10', '2018-03-12', NULL, '5884176019', 'Engineering', 'Male', 'A+', 'General Manager', '2'),
(2, 3, 'Judye', 'Laurella', 'Duhig', '360005', 'India', 'Ahmedabad', '731 Beilfuss Circle', 'Emp-02', '1990-06-04', '2018-03-12', NULL, '5884176021', 'Research and Development', 'Male', 'A-', 'Geological Engineer', '4');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_teacher_attendance`
--

CREATE TABLE `wp_wpsp_teacher_attendance` (
  `id` bigint(11) NOT NULL,
  `teacher_id` bigint(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `leave_date` date DEFAULT NULL,
  `reason` varchar(250) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_timetable`
--

CREATE TABLE `wp_wpsp_timetable` (
  `id` int(15) UNSIGNED NOT NULL,
  `class_id` int(10) NOT NULL,
  `time_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `day` int(2) NOT NULL,
  `heading` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_transactions_group`
--

CREATE TABLE `wp_wpsp_transactions_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_transactions_group`
--

INSERT INTO `wp_wpsp_transactions_group` (`group_id`, `group_name`) VALUES
(1, 'Fees Submission'),
(2, 'Rent'),
(4, 'General Expenses'),
(5, 'Taxes'),
(6, 'Refreshments'),
(7, 'Stationary');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_transport`
--

CREATE TABLE `wp_wpsp_transport` (
  `id` int(15) UNSIGNED NOT NULL,
  `bus_no` varchar(30) DEFAULT NULL,
  `bus_name` varchar(50) DEFAULT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `bus_route` mediumtext,
  `route_fees` varchar(5) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_visitors`
--

CREATE TABLE `wp_wpsp_visitors` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `p_name` varchar(50) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `c_name` varchar(50) DEFAULT NULL,
  `c_class` varchar(20) DEFAULT NULL,
  `c_dob` date DEFAULT NULL,
  `c_gender` tinytext,
  `v_purpose` varchar(20) DEFAULT NULL,
  `v_detail` varchar(100) DEFAULT NULL,
  `approach` varchar(20) DEFAULT NULL,
  `session` varchar(10) DEFAULT NULL,
  `follow_up` int(5) DEFAULT NULL,
  `converted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_visitors`
--

INSERT INTO `wp_wpsp_visitors` (`id`, `date`, `p_name`, `phone`, `email`, `address`, `city`, `state`, `zip`, `c_name`, `c_class`, `c_dob`, `c_gender`, `v_purpose`, `v_detail`, `approach`, `session`, `follow_up`, `converted`) VALUES
(2, '2018-05-15', 'Shahid ', 9808033480, 'zain@gmail.com', 'Eden Solutions\nDeenanath Bazar', 'SRE', 'UP', 226010, 'Waeez Azeem', '2', '2018-05-17', '', '', 'v_details', 'NFR', '2018-19', 3, 1),
(3, '2018-05-02', 'Shahid Azeem', 9997330770, 'zainulabd786@gmail.com', '9/727 A, Eden Solutions\nDeenanath Bazar', 'Saharanpur', 'Uttar Pradesh', 247001, 'Waeez Azeem', '1', '2018-05-18', 'M', 'OTH', 'Academic carriculum enquiry', 'BOA', '2018-19', 0, 0),
(5, '2018-05-02', 'Shahid ', 9808033480, 'zain@gmail.com', 'Eden Solutions\nDeenanath Bazar', 'SRE', 'UP', 226010, 'Waeez Azeem', '2', '2018-05-17', '', '', 'v_details', 'NFR', '2018-19', 0, 0),
(6, '2018-05-17', 'Abdul Rahman', 9808080808, 'edu@AMU.com', 'SGMU', 'LKO', 'UP', 226010, 'Abdul Kareem', '1', '2018-05-01', 'M', 'ADM', 'minto circle', 'BOA', '2018-19', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_workinghours`
--

CREATE TABLE `wp_wpsp_workinghours` (
  `id` int(5) UNSIGNED NOT NULL,
  `hour` varchar(20) DEFAULT NULL,
  `begintime` varchar(10) NOT NULL,
  `endtime` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `indo_nepal_dir`
--
ALTER TABLE `indo_nepal_dir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `wp_ffi_cache`
--
ALTER TABLE `wp_ffi_cache`
  ADD PRIMARY KEY (`feed_id`);

--
-- Indexes for table `wp_ffi_comments`
--
ALTER TABLE `wp_ffi_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_ffi_image_cache`
--
ALTER TABLE `wp_ffi_image_cache`
  ADD PRIMARY KEY (`url`);

--
-- Indexes for table `wp_ffi_options`
--
ALTER TABLE `wp_ffi_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_ffi_posts`
--
ALTER TABLE `wp_ffi_posts`
  ADD PRIMARY KEY (`post_id`,`post_type`,`feed_id`);

--
-- Indexes for table `wp_ffi_post_media`
--
ALTER TABLE `wp_ffi_post_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_ffi_snapshots`
--
ALTER TABLE `wp_ffi_snapshots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_ffi_streams`
--
ALTER TABLE `wp_ffi_streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_ffi_streams_sources`
--
ALTER TABLE `wp_ffi_streams_sources`
  ADD PRIMARY KEY (`feed_id`,`stream_id`);

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `wp_wpsp_assigned_inventory`
--
ALTER TABLE `wp_wpsp_assigned_inventory`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `wp_wpsp_attendance`
--
ALTER TABLE `wp_wpsp_attendance`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `wp_wpsp_bank_transactions`
--
ALTER TABLE `wp_wpsp_bank_transactions`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `wp_wpsp_cash_transactions`
--
ALTER TABLE `wp_wpsp_cash_transactions`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `wp_wpsp_class`
--
ALTER TABLE `wp_wpsp_class`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `wp_wpsp_events`
--
ALTER TABLE `wp_wpsp_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_exam`
--
ALTER TABLE `wp_wpsp_exam`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `wp_wpsp_fees`
--
ALTER TABLE `wp_wpsp_fees`
  ADD PRIMARY KEY (`fees_id`);

--
-- Indexes for table `wp_wpsp_fees_dues`
--
ALTER TABLE `wp_wpsp_fees_dues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_fees_payment`
--
ALTER TABLE `wp_wpsp_fees_payment`
  ADD PRIMARY KEY (`fees_pay_id`);

--
-- Indexes for table `wp_wpsp_fees_payment_record`
--
ALTER TABLE `wp_wpsp_fees_payment_record`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `wp_wpsp_fees_receipts`
--
ALTER TABLE `wp_wpsp_fees_receipts`
  ADD PRIMARY KEY (`slip_no`);

--
-- Indexes for table `wp_wpsp_fees_settings`
--
ALTER TABLE `wp_wpsp_fees_settings`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `wp_wpsp_fee_payment_history`
--
ALTER TABLE `wp_wpsp_fee_payment_history`
  ADD PRIMARY KEY (`payment_history_id`);

--
-- Indexes for table `wp_wpsp_follow_up`
--
ALTER TABLE `wp_wpsp_follow_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_grade`
--
ALTER TABLE `wp_wpsp_grade`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `wp_wpsp_import_history`
--
ALTER TABLE `wp_wpsp_import_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_inventory_items`
--
ALTER TABLE `wp_wpsp_inventory_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `wp_wpsp_inventory_master`
--
ALTER TABLE `wp_wpsp_inventory_master`
  ADD PRIMARY KEY (`master_id`);

--
-- Indexes for table `wp_wpsp_leavedays`
--
ALTER TABLE `wp_wpsp_leavedays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_mark`
--
ALTER TABLE `wp_wpsp_mark`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `wp_wpsp_mark_extract`
--
ALTER TABLE `wp_wpsp_mark_extract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_mark_fields`
--
ALTER TABLE `wp_wpsp_mark_fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `wp_wpsp_messages`
--
ALTER TABLE `wp_wpsp_messages`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `wp_wpsp_notification`
--
ALTER TABLE `wp_wpsp_notification`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `wp_wpsp_settings`
--
ALTER TABLE `wp_wpsp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_single_student_fees`
--
ALTER TABLE `wp_wpsp_single_student_fees`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `wp_wpsp_student`
--
ALTER TABLE `wp_wpsp_student`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `wp_wpsp_subject`
--
ALTER TABLE `wp_wpsp_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_teacher`
--
ALTER TABLE `wp_wpsp_teacher`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `wp_wpsp_teacher_attendance`
--
ALTER TABLE `wp_wpsp_teacher_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_timetable`
--
ALTER TABLE `wp_wpsp_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_transactions_group`
--
ALTER TABLE `wp_wpsp_transactions_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `wp_wpsp_transport`
--
ALTER TABLE `wp_wpsp_transport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_visitors`
--
ALTER TABLE `wp_wpsp_visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_wpsp_workinghours`
--
ALTER TABLE `wp_wpsp_workinghours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `indo_nepal_dir`
--
ALTER TABLE `indo_nepal_dir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wp_ffi_post_media`
--
ALTER TABLE `wp_ffi_post_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_ffi_snapshots`
--
ALTER TABLE `wp_ffi_snapshots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1980;
--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=955;
--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `wp_wpsp_assigned_inventory`
--
ALTER TABLE `wp_wpsp_assigned_inventory`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `wp_wpsp_attendance`
--
ALTER TABLE `wp_wpsp_attendance`
  MODIFY `aid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wp_wpsp_bank_transactions`
--
ALTER TABLE `wp_wpsp_bank_transactions`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1810071;
--
-- AUTO_INCREMENT for table `wp_wpsp_cash_transactions`
--
ALTER TABLE `wp_wpsp_cash_transactions`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1810102;
--
-- AUTO_INCREMENT for table `wp_wpsp_class`
--
ALTER TABLE `wp_wpsp_class`
  MODIFY `cid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wp_wpsp_events`
--
ALTER TABLE `wp_wpsp_events`
  MODIFY `id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wp_wpsp_exam`
--
ALTER TABLE `wp_wpsp_exam`
  MODIFY `eid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_fees`
--
ALTER TABLE `wp_wpsp_fees`
  MODIFY `fees_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_fees_dues`
--
ALTER TABLE `wp_wpsp_fees_dues`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_fees_payment`
--
ALTER TABLE `wp_wpsp_fees_payment`
  MODIFY `fees_pay_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_fee_payment_history`
--
ALTER TABLE `wp_wpsp_fee_payment_history`
  MODIFY `payment_history_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_follow_up`
--
ALTER TABLE `wp_wpsp_follow_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wp_wpsp_grade`
--
ALTER TABLE `wp_wpsp_grade`
  MODIFY `gid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_import_history`
--
ALTER TABLE `wp_wpsp_import_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_inventory_items`
--
ALTER TABLE `wp_wpsp_inventory_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `wp_wpsp_inventory_master`
--
ALTER TABLE `wp_wpsp_inventory_master`
  MODIFY `master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `wp_wpsp_leavedays`
--
ALTER TABLE `wp_wpsp_leavedays`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_mark`
--
ALTER TABLE `wp_wpsp_mark`
  MODIFY `mid` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_mark_extract`
--
ALTER TABLE `wp_wpsp_mark_extract`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_mark_fields`
--
ALTER TABLE `wp_wpsp_mark_fields`
  MODIFY `field_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_messages`
--
ALTER TABLE `wp_wpsp_messages`
  MODIFY `mid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_notification`
--
ALTER TABLE `wp_wpsp_notification`
  MODIFY `nid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wp_wpsp_settings`
--
ALTER TABLE `wp_wpsp_settings`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `wp_wpsp_student`
--
ALTER TABLE `wp_wpsp_student`
  MODIFY `sid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `wp_wpsp_subject`
--
ALTER TABLE `wp_wpsp_subject`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_teacher`
--
ALTER TABLE `wp_wpsp_teacher`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wp_wpsp_teacher_attendance`
--
ALTER TABLE `wp_wpsp_teacher_attendance`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_timetable`
--
ALTER TABLE `wp_wpsp_timetable`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_transactions_group`
--
ALTER TABLE `wp_wpsp_transactions_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `wp_wpsp_transport`
--
ALTER TABLE `wp_wpsp_transport`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_visitors`
--
ALTER TABLE `wp_wpsp_visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `wp_wpsp_workinghours`
--
ALTER TABLE `wp_wpsp_workinghours`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
