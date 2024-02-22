-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2024 at 04:57 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelhelper`
--

-- --------------------------------------------------------

--
-- Table structure for table `metatags`
--

DROP TABLE IF EXISTS `metatags`;
CREATE TABLE IF NOT EXISTS `metatags` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canonical` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og:url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og:image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og:description` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og:title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og:site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og:see_also` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googledescription` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter:card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter:url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter:title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter:description` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter:image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metatags`
--

INSERT INTO `metatags` (`id`, `route`, `page_name`, `title`, `description`, `keywords`, `author`, `canonical`, `og:url`, `og:image`, `og:description`, `og:title`, `og:site_name`, `og:see_also`, `name`, `googledescription`, `image`, `twitter:card`, `twitter:url`, `twitter:title`, `twitter:description`, `twitter:image`, `views`, `created_at`, `updated_at`) VALUES
(1, 'homepage', 'Home page', 'Plusiunedevlopers | home page', NULL, NULL, 'Raj Varman', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:13:18'),
(2, 'register', 'Registration', 'Plusiunedevlopers | registration', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:13:34'),
(3, 'dashboard', 'Dashboard', 'Plusiunedevlopers | dashboard', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:14:02'),
(4, 'login', 'Login', 'Plusiunedevlopers | login', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:15:26'),
(5, 'users.index', 'User management', 'Plusiunedevlopers | user mng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:15:38'),
(6, 'theme.index', 'Theme mng', 'Plusiunedevlopers | thememng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:15:48'),
(10, 'favorites.index', 'Favorites', 'Plusiunedevlopers | favorites', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:15:58'),
(11, 'contact.index', 'Messages', 'Plusiunedevlopers | messages', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:16:09'),
(13, 'tag.index', 'Amenities', 'Plusiunedevlopers | tags', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:16:31'),
(14, 'category.index', 'Categories', 'Plusiunedevlopers | categories', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:16:46'),
(15, 'post.index', 'Blog', 'Plusiunedevlopers | blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:16:56'),
(16, 'social-urls.index', 'social urls', 'Plusiunedevlopers | social urls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:17:06'),
(17, 'meta.index', 'Meta tag mng', 'Plusiunedevlopers | meta tag mng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:17:18'),
(18, 'profile.show', 'Profile', 'Plusiunedevlopers | profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:17:29'),
(19, 'profile.change_password', 'change password', 'Plusiunedevlopers | change password', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:17:38'),
(20, 'blog', 'Blog', 'Plusiunedevlopers | blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:17:49'),
(21, 'blog.show', 'Show blog', 'Plusiunedevlopers | show blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:18:00'),
(25, 'contact', '', 'Plusiunedevlopers | contact mng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-26 23:00:42'),
(26, 'about', 'About us', 'Plusiunedevlopers | About us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2023-07-26 22:58:09'),
(27, 'about.index', 'About', 'Plusiunedevlopers | About', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:20:10'),
(28, 'testimonial.index', 'Testimonial', 'Plusiunedevlopers | Testimonial', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:20:20'),
(29, 'faq', 'faq', 'Plusiunedevlopers | faq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:20:31'),
(30, 'faq.index', 'Faq', 'Plusiunedevlopers | Faq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:20:39'),
(31, 'search', 'Search', 'Plusiunedevlopers | search', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:20:47'),
(32, 'service', '', 'Plusiunedevlopers | services', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:20:55'),
(33, 'team.index', '', 'Plusiunedevlopers | team mng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:21:03'),
(52, 'slider.index', 'slider page', 'Plusiunedevlopers | slider', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-04-18 20:25:03'),
(53, 'blog.recent', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(54, 'subscriptions.index', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
