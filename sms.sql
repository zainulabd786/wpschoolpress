-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2018 at 06:22 AM
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
(33, 'active_plugins', 'a:1:{i:0;s:31:"SchoolWeb/SchoolWeb.php";}', 'yes'),
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
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
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
(109, 'cron', 'a:4:{i:1521442676;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1521469356;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1521469380;a:2:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}s:25:"delete_expired_transients";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(110, 'theme_mods_twentyseventeen', 'a:1:{s:18:"custom_css_post_id";i:-1;}', 'yes'),
(114, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.9.4.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.9.4.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.9.4-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.9.4-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.9.4";s:7:"version";s:5:"4.9.4";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.7";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1521427597;s:15:"version_checked";s:5:"4.9.4";s:12:"translations";a:0:{}}', 'no'),
(119, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1521427604;s:7:"checked";a:3:{s:13:"twentyfifteen";s:3:"1.9";s:15:"twentyseventeen";s:3:"1.4";s:13:"twentysixteen";s:3:"1.4";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'no'),
(121, '_site_transient_timeout_browser_49da57eac7f840522fef2b86e883cffa', '1521469372', 'no'),
(122, '_site_transient_browser_49da57eac7f840522fef2b86e883cffa', 'a:10:{s:4:"name";s:6:"Chrome";s:7:"version";s:13:"64.0.3282.186";s:8:"platform";s:7:"Windows";s:10:"update_url";s:29:"https://www.google.com/chrome";s:7:"img_src";s:43:"http://s.w.org/images/browsers/chrome.png?1";s:11:"img_src_ssl";s:44:"https://s.w.org/images/browsers/chrome.png?1";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;s:6:"mobile";b:0;}', 'no'),
(123, 'can_compress_scripts', '1', 'no'),
(128, 'recently_activated', 'a:0:{}', 'yes'),
(141, 'plugin_error', '', 'yes'),
(154, '_transient_is_multi_author', '0', 'yes'),
(166, '_site_transient_timeout_browser_9bb7b3178e07390e66ccfc3e17d20f2e', '1521616332', 'no'),
(167, '_site_transient_browser_9bb7b3178e07390e66ccfc3e17d20f2e', 'a:10:{s:4:"name";s:7:"Firefox";s:7:"version";s:4:"58.0";s:8:"platform";s:7:"Windows";s:10:"update_url";s:24:"https://www.firefox.com/";s:7:"img_src";s:44:"http://s.w.org/images/browsers/firefox.png?1";s:11:"img_src_ssl";s:45:"https://s.w.org/images/browsers/firefox.png?1";s:15:"current_version";s:2:"56";s:7:"upgrade";b:0;s:8:"insecure";b:0;s:6:"mobile";b:0;}', 'no'),
(226, '_site_transient_timeout_theme_roots', '1521429402', 'no'),
(227, '_site_transient_theme_roots', 'a:3:{s:13:"twentyfifteen";s:7:"/themes";s:15:"twentyseventeen";s:7:"/themes";s:13:"twentysixteen";s:7:"/themes";}', 'no'),
(228, '_site_transient_update_plugins', 'O:8:"stdClass":5:{s:12:"last_checked";i:1521427606;s:7:"checked";a:3:{s:19:"akismet/akismet.php";s:5:"4.0.2";s:9:"hello.php";s:3:"1.6";s:31:"SchoolWeb/SchoolWeb.php";s:3:"1.0";}s:8:"response";a:1:{s:19:"akismet/akismet.php";O:8:"stdClass":11:{s:2:"id";s:21:"w.org/plugins/akismet";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:5:"4.0.3";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:56:"https://downloads.wordpress.org/plugin/akismet.4.0.3.zip";s:5:"icons";a:3:{s:2:"1x";s:59:"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272";s:2:"2x";s:59:"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272";s:7:"default";s:59:"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272";}s:7:"banners";a:2:{s:2:"1x";s:61:"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904";s:7:"default";s:61:"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"4.9.4";s:13:"compatibility";O:8:"stdClass":0:{}}}s:12:"translations";a:0:{}s:9:"no_update";a:1:{s:9:"hello.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/hello-dolly";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:9:"hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";s:5:"icons";a:3:{s:2:"1x";s:63:"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=969907";s:2:"2x";s:63:"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907";s:7:"default";s:63:"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907";}s:7:"banners";a:2:{s:2:"1x";s:65:"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342";s:7:"default";s:65:"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342";}s:11:"banners_rtl";a:0:{}}}}', 'no');

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
(4, 25, '_edit_lock', '1520924395:1'),
(5, 25, '_edit_last', '1'),
(6, 25, '_wp_trash_meta_status', 'publish'),
(7, 25, '_wp_trash_meta_time', '1520924561'),
(8, 25, '_wp_desired_post_slug', 'sch-fee-man'),
(9, 27, '_edit_lock', '1520956885:1'),
(10, 27, '_edit_last', '1');

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
(1, 1, '2018-03-12 14:22:34', '2018-03-12 14:22:34', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2018-03-12 14:22:34', '2018-03-12 14:22:34', '', 0, 'http://localhost/SMS/?p=1', 0, 'post', '', 1),
(2, 1, '2018-03-12 14:22:34', '2018-03-12 14:22:34', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://localhost/SMS/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2018-03-12 14:22:34', '2018-03-12 14:22:34', '', 0, 'http://localhost/SMS/?page_id=2', 0, 'page', '', 0),
(3, 1, '2018-03-12 14:22:53', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2018-03-12 14:22:53', '0000-00-00 00:00:00', '', 0, 'http://localhost/SMS/?p=3', 0, 'post', '', 0),
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
(24, 1, '2018-03-13 06:57:56', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2018-03-13 06:57:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/SMS/?page_id=24', 0, 'page', '', 0),
(25, 1, '2018-03-13 07:00:56', '2018-03-13 07:00:56', '', 'Fees Management', '', 'trash', 'closed', 'closed', '', 'sch-fee-man__trashed', '', '', '2018-03-13 07:02:41', '2018-03-13 07:02:41', '', 0, 'http://localhost/SMS/?page_id=25', 0, 'page', '', 0),
(26, 1, '2018-03-13 07:00:56', '2018-03-13 07:00:56', '', 'Fees Management', '', 'inherit', 'closed', 'closed', '', '25-revision-v1', '', '', '2018-03-13 07:00:56', '2018-03-13 07:00:56', '', 25, 'http://localhost/SMS/25-revision-v1/', 0, 'revision', '', 0),
(27, 1, '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 'Fee', '', 'publish', 'closed', 'closed', '', 'sch-fee-man', '', '', '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 0, 'http://localhost/SMS/?page_id=27', 0, 'page', '', 0),
(28, 1, '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 'Fee', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2018-03-13 07:22:22', '2018-03-13 07:22:22', '', 27, 'http://localhost/SMS/27-revision-v1/', 0, 'revision', '', 0);

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
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:4:{s:64:"40b3220427e53b76245f1351f51117ff18068582527af5270d8caff6aa094227";a:4:{s:10:"expiration";i:1521432613;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.162 Safari/537.36";s:5:"login";i:1521259813;}s:64:"203394c40683747076dc83a436a69bd08426e4c724b1e8782f984b5a433b0209";a:4:{s:10:"expiration";i:1521522847;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.162 Safari/537.36";s:5:"login";i:1521350047;}s:64:"4d26413d9ec4814c8206a8d475f8d14c8ffaefa73fc93b7c9473e5e029e34012";a:4:{s:10:"expiration";i:1521553580;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.162 Safari/537.36";s:5:"login";i:1521380780;}s:64:"b374c3890468f29171d9bc89b05376475ee62547d1e7234beb7dcd826ab114e4";a:4:{s:10:"expiration";i:1521595755;s:2:"ip";s:3:"::1";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.162 Safari/537.36";s:5:"login";i:1521422955;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '3'),
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
(270, 19, 'dismissed_wp_pointers', '');

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
(2, 'Wolfie', '$P$B0Or.OnHKImMXkNOqVlrxfJ93DK5VC.', 'wolfie', 'Wolfiewpsp@yourdomain.com', '', '2018-03-12 14:25:23', '', 0, 'Wolfie'),
(3, 'Judye', '$P$BxAvJvkE60EfkfXYma9.RHX/0tFbc1/', 'judye', 'Judyewpsp@yourdomain.com', '', '2018-03-12 14:25:25', '', 0, 'Judye'),
(4, 'Erna', '$P$Boa0cdONIvs8etYSRGo6FguC6ww3ul.', 'erna', 'Ernawpsp@yourdomain.com', '', '2018-03-12 14:25:26', '', 0, 'Erna'),
(5, 'Joli', '$P$BO/ZEWIyff7jI6lCT/M/8jKGNGsZiw.', 'joli', 'Joliwpsp@yourdomain.com', '', '2018-03-12 14:25:27', '', 0, 'Joli'),
(6, 'Karilynn', '$P$BLzWVq4rdVufjG/UIkZo7T8GNZMP29.', 'karilynn', 'Karilynnwpsp@yourdomain.com', '', '2018-03-12 14:25:28', '', 0, 'Karilynn'),
(7, 'Aurelia', '$P$B35MFRHmyZHUt.w9MgDqmEml4KD2.k1', 'aurelia', 'Aureliawpsp@yourdomain.com', '', '2018-03-12 14:25:29', '', 0, 'Aurelia'),
(8, 'student_1520930127', '$P$Bz7Yv4ak0hbn/FBIKw4ypHPOEn9Am10', 'student_1520930127', 'student_1520930127@spischool.org', '', '2018-03-13 08:35:27', '1520930131:$P$B6QsaQj4YpbWMt6ve1Mi7vo.pne1qv0', 0, 'Zainul'),
(10, 'student_1520948684', '$P$BGyTy24jgOQATIOC5u8lNmk2/SquaQ0', 'student_1520948684', 'student_1520948684@spischool.org', '', '2018-03-13 13:44:44', '1520948685:$P$BH/L.Isq4u5O/wtVqfnAcTmeuhra0L.', 0, 'WAEEZ'),
(11, 'student_1521001564', '$P$Bbax63J7s1h7i9L.1Yh.RptMfZSO5K0', 'student_1521001564', 'student_1521001564@spischool.org', '', '2018-03-14 04:26:04', '1521001572:$P$BiY6Rkoiy/FcMU.SAFHv3L3wpSTBwo.', 0, 'Muhammad'),
(13, 'student_1521261829', '$P$BOn7edD4x8U9wn5LrQgJQZtejR5p7d.', 'student_1521261829', 'student_1521261829@spischool.org', '', '2018-03-17 04:43:49', '1521261832:$P$BHGk7nC8LTFZ28jAVv7.B/KygHg3vw/', 0, 'Muhammad'),
(15, 'student_1521262978', '$P$Bpf/JIntnQ3JIcTkzPQTKGd0kM/W8P/', 'student_1521262978', 'student_1521262978@spischool.org', '', '2018-03-17 05:02:58', '1521262979:$P$BoaS1jq8.z1b.h5bURq3V8uubaIqcG0', 0, 'Zainul'),
(16, 'student_1521263129', '$P$Bz9R5ZFKBjTHpUQDwgw3GvpKhKzhMn0', 'student_1521263129', 'student_1521263129@spischool.org', '', '2018-03-17 05:05:29', '1521263130:$P$BxZqpNZmtl5tRZUob8sHBo3nv/kl73.', 0, 'WAEEZ'),
(17, 'student_1521263699', '$P$BQV8IVAjybaYbdVtdEQcYJYWolN/OA/', 'student_1521263699', 'student_1521263699@spischool.org', '', '2018-03-17 05:14:59', '1521263700:$P$BxkQOSg//2TjsbqP1H8qr.vvPRdbTt0', 0, 'Zainul'),
(18, 'student_1521263867', '$P$BJL9RwA.BWSBpPPZO/K.r09tGGBHPh.', 'student_1521263867', 'student_1521263867@spischool.org', '', '2018-03-17 05:17:47', '1521263869:$P$Bgy21PE6D7vahq6V8pw8bNn5m6qTYn.', 0, 'WAEEZ'),
(19, 'student_1521369623', '$P$BSwIvg/BOhjufI1M/X92eNAGylgq430', 'student_1521369623', 'student_1521369623@spischool.org', '', '2018-03-18 10:40:23', '1521369626:$P$B96RcpSdSoAZzl6mtqzRF//t3S6L0b.', 0, 'M');

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
  `tid` varchar(20) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `sid` int(15) DEFAULT NULL,
  `from` text,
  `to` text,
  `amount` int(11) DEFAULT NULL,
  `fees_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_receipts`
--

CREATE TABLE `wp_wpsp_fees_receipts` (
  `slip_no` int(25) NOT NULL,
  `sid` int(15) DEFAULT NULL,
  `cid` int(10) DEFAULT NULL,
  `from` varchar(20) DEFAULT NULL,
  `to` varchar(20) DEFAULT NULL,
  `adm` int(11) DEFAULT NULL,
  `ttn` varchar(11) DEFAULT NULL,
  `trans` int(11) DEFAULT NULL,
  `ann` varchar(11) DEFAULT NULL,
  `rec` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_settings`
--

CREATE TABLE `wp_wpsp_fees_settings` (
  `cid` int(11) NOT NULL,
  `admission_fees` int(11) DEFAULT NULL,
  `tution_fees` int(11) DEFAULT NULL,
  `transport_chg` int(11) DEFAULT NULL,
  `annual_chg` int(11) DEFAULT NULL,
  `recreation_chg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpsp_fees_settings`
--

INSERT INTO `wp_wpsp_fees_settings` (`cid`, `admission_fees`, `tution_fees`, `transport_chg`, `annual_chg`, `recreation_chg`) VALUES
(1, 4000, 3000, 2000, 1000, 500),
(2, 5000, 4000, 3000, 2000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wpsp_fees_status`
--

CREATE TABLE `wp_wpsp_fees_status` (
  `sid` int(15) NOT NULL,
  `admission_fees` int(11) DEFAULT NULL,
  `tution_fees` int(11) DEFAULT NULL,
  `transport_chg` int(11) DEFAULT NULL,
  `annual_chg` int(11) DEFAULT NULL,
  `recreation_chg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'sch_name', 'Scholar''s Paradise International School'),
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
(15, 'absent_sms_alert', '0'),
(16, 'notification_sms_alert', '0');

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
  `p_bloodgrp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `wp_wpsp_attendance`
--
ALTER TABLE `wp_wpsp_attendance`
  ADD PRIMARY KEY (`aid`);

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
-- Indexes for table `wp_wpsp_fees_status`
--
ALTER TABLE `wp_wpsp_fees_status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `wp_wpsp_fee_payment_history`
--
ALTER TABLE `wp_wpsp_fee_payment_history`
  ADD PRIMARY KEY (`payment_history_id`);

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
-- Indexes for table `wp_wpsp_transport`
--
ALTER TABLE `wp_wpsp_transport`
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
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;
--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `wp_wpsp_attendance`
--
ALTER TABLE `wp_wpsp_attendance`
  MODIFY `aid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_class`
--
ALTER TABLE `wp_wpsp_class`
  MODIFY `cid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wp_wpsp_events`
--
ALTER TABLE `wp_wpsp_events`
  MODIFY `id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `wp_wpsp_fees_payment`
--
ALTER TABLE `wp_wpsp_fees_payment`
  MODIFY `fees_pay_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_fees_receipts`
--
ALTER TABLE `wp_wpsp_fees_receipts`
  MODIFY `slip_no` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_fees_status`
--
ALTER TABLE `wp_wpsp_fees_status`
  MODIFY `sid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_fee_payment_history`
--
ALTER TABLE `wp_wpsp_fee_payment_history`
  MODIFY `payment_history_id` bigint(20) NOT NULL AUTO_INCREMENT;
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
  MODIFY `nid` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_settings`
--
ALTER TABLE `wp_wpsp_settings`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `wp_wpsp_student`
--
ALTER TABLE `wp_wpsp_student`
  MODIFY `sid` int(15) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `wp_wpsp_transport`
--
ALTER TABLE `wp_wpsp_transport`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_wpsp_workinghours`
--
ALTER TABLE `wp_wpsp_workinghours`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
