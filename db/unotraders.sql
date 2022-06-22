-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 05:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unotraders`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loggedIN` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_pic`, `remember_token`, `loggedIN`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@unotraders.com', NULL, '$2y$10$YilJMMcvdjIKYegAEqaQfeXV7iWF7iSibzP5rmBhHH8cvJDweMOa2', '1618818066_avatar5.png', NULL, 1, '2021-03-25 23:31:38', '2021-09-03 04:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `page`, `ad_image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'home', '1629114779_add1.svg', 1, '2021-08-16 06:22:59', '2021-08-16 06:22:59'),
(3, 'home', '1629114787_add2.svg', 1, '2021-08-16 06:23:07', '2021-08-16 06:23:07'),
(4, 'home', '1629114794_add3.svg', 1, '2021-08-16 06:23:14', '2021-12-07 23:21:29'),
(5, 'home', '1649058093_photo1.png', 1, '2022-04-04 02:08:59', '2022-04-04 02:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `appointment_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `trader_id`, `appointment_date`, `appointment_time`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(1, 16, 6, '2021-11-20', '17:00:00', 'cancel', 'Cancelled', '2021-09-15 12:27:12', '2021-11-10 03:41:06'),
(2, 16, 15, '2022-03-30', '16:00:00', 'sgs ujf j fujukf egsrg seragrh thrth', 'Rescheduled', '2021-09-20 22:06:22', '2022-03-22 03:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `link`, `banner_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner 1', 'https://www.google.com/', '1624439072_banner.jpg', 1, '2021-06-23 03:34:32', '2021-06-23 03:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `bazaar`
--

CREATE TABLE `bazaar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `product_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `added_usertype` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bazaar`
--

INSERT INTO `bazaar` (`id`, `category_id`, `sub_category_id`, `product`, `price`, `description`, `status`, `product_location`, `latitude`, `longitude`, `added_usertype`, `added_by`, `created_at`, `updated_at`) VALUES
(2, 1, 4, 'product 1', 0, '<p>test description of product 1</p>', 1, '', 0, 0, 'admin', 1, '2021-09-15 07:18:27', '2021-09-15 07:18:27'),
(3, 1, 0, 'dfghdfh', 0, '<p>rtyhgrdstyh yh t6ysrty</p>', 1, '', 0, 0, 'admin', 1, '2021-09-15 07:41:59', '2021-09-15 07:41:59'),
(5, 1, 4, 'product from ui', 0, 'new product details entered from ui fro testing', 1, '', 0, 0, 'provider', 15, '2021-09-16 01:41:07', '2021-09-16 01:41:43'),
(6, 1, 4, 'test ui update', 123, 'editing from ui trader', 1, '', 0, 0, 'provider', 15, '2021-10-18 04:44:53', '2021-11-19 01:11:33'),
(7, 1, 4, 'test from customer profile', 1000, 'test esription for product from customer profile', 1, 'Kochi, Kerala, India', 9.9312328, 76.26730409999999, 'customer', 16, '2021-10-19 03:27:40', '2022-06-09 02:19:41'),
(8, 5, 4, 'dgrtg trgrgt', 234, 'fhg hfh', 1, '', 0, 0, 'customer', 16, '2021-10-19 03:29:20', '2021-10-19 03:29:20'),
(9, 5, 0, 'test pro', 0, '<p>testing</p>', 1, '', 0, 0, 'admin', 1, '2022-04-04 01:54:25', '2022-04-04 01:54:25'),
(10, 1, 4, 'June 9 2022', 100, 'desc', 1, 'Kochi, Kerala, India', 9.9312328, 76.26730409999999, 'customer', 16, '2022-06-09 09:36:15', '2022-06-09 09:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `bazaar_category`
--

CREATE TABLE `bazaar_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_category` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bazaar_category`
--

INSERT INTO `bazaar_category` (`id`, `parent_category`, `category`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'New category bazaar', 'fgsd sdgtgrt srtg', 1, '2021-09-15 04:20:22', '2021-09-15 04:20:22'),
(4, 1, 'New category 1', 'dcds', 1, '2021-09-15 05:17:12', '2021-09-15 05:17:12'),
(5, 0, 'New category', '', 1, '2022-01-18 05:42:54', '2022-01-18 05:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `bazaar_images`
--

CREATE TABLE `bazaar_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bazaar_id` int(11) NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bazaar_images`
--

INSERT INTO `bazaar_images` (`id`, `bazaar_id`, `product_image`, `created_at`, `updated_at`) VALUES
(7, 2, '1631710107_photo1.png', '2021-09-15 07:18:27', '2021-09-15 07:18:27'),
(8, 2, '1631710107_photo2.png', '2021-09-15 07:18:27', '2021-09-15 07:18:27'),
(9, 3, '1631711519_photo4.jpg', '2021-09-15 07:41:59', '2021-09-15 07:41:59'),
(10, 3, '1631773867_photo1.png', '2021-09-16 01:01:07', '2021-09-16 01:01:07'),
(11, 3, '1631773867_photo2.png', '2021-09-16 01:01:07', '2021-09-16 01:01:07'),
(12, 3, '1631773867_photo3.jpg', '2021-09-16 01:01:07', '2021-09-16 01:01:07'),
(13, 5, '1631776267_photo2.png', '2021-09-16 01:41:07', '2021-09-16 01:41:07'),
(14, 5, '1631776267_photo3.jpg', '2021-09-16 01:41:07', '2021-09-16 01:41:07'),
(15, 5, '1631776267_photo4.jpg', '2021-09-16 01:41:07', '2021-09-16 01:41:07'),
(16, 6, '1634552093_photo1.png', '2021-10-18 04:44:53', '2021-10-18 04:44:53'),
(17, 6, '1634552093_photo2.png', '2021-10-18 04:44:53', '2021-10-18 04:44:53'),
(18, 6, '1634552093_photo3.jpg', '2021-10-18 04:44:53', '2021-10-18 04:44:53'),
(20, 7, '1634633860_photo2.png', '2021-10-19 03:27:40', '2021-10-19 03:27:40'),
(21, 7, '1634633860_photo3.jpg', '2021-10-19 03:27:40', '2021-10-19 03:27:40'),
(22, 7, '1634633860_photo4.jpg', '2021-10-19 03:27:40', '2021-10-19 03:27:40'),
(23, 8, '1634633960_photo1.png', '2021-10-19 03:29:20', '2021-10-19 03:29:20'),
(24, 8, '1634633960_photo2.png', '2021-10-19 03:29:20', '2021-10-19 03:29:20'),
(25, 8, '1634633960_photo3.jpg', '2021-10-19 03:29:20', '2021-10-19 03:29:20'),
(29, 9, '1649057732_photo3.jpg', '2022-04-04 02:05:32', '2022-04-04 02:05:32'),
(30, 10, '1654767375_photo1.png', '2022-06-09 09:36:15', '2022-06-09 09:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `main_category`, `parent_category`, `category`, `description`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Service', 0, 'Plumber', '', 1, '1618828645_builder.svg', '2021-04-19 05:07:25', '2021-04-22 04:12:09'),
(2, 'Service', 1, 'Electrician', '', 1, '1619084565_electrician.svg', '2021-04-22 04:12:45', '2021-04-22 04:12:45'),
(3, 'Service', 1, 'Builder', '', 1, '1619084586_builder.svg', '2021-04-22 04:13:06', '2022-01-17 04:03:12'),
(4, 'Service', 1, 'Painter', '', 1, '1619084604_painter.svg', '2021-04-22 04:13:24', '2022-01-17 04:03:23'),
(5, 'Service', 1, 'Roofer', '', 1, '1619084621_roofer.svg', '2021-04-22 04:13:41', '2021-04-22 04:13:41'),
(6, 'Service', 1, 'Gardener', '', 1, '1619084644_gardener.svg', '2021-04-22 04:14:04', '2022-01-17 04:03:34'),
(17, 'Service', 0, 'Real Estate', '', 1, '', '2022-01-17 04:06:31', '2022-01-17 04:06:31'),
(18, 'Service', 17, 'For Sale', '', 1, '', '2022-01-17 04:06:49', '2022-01-17 04:06:49'),
(19, 'Service', 17, 'To Share', '', 1, '', '2022-01-17 04:07:01', '2022-01-17 04:07:01'),
(20, 'Service', 17, 'To rent', '', 1, '', '2022-01-17 04:07:11', '2022-01-17 04:07:11'),
(21, 'Service', 0, 'Education', '', 1, '', '2022-01-17 04:07:31', '2022-01-17 04:07:31'),
(22, 'Service', 21, 'IT & Software', '', 1, '', '2022-01-17 04:07:49', '2022-01-17 04:07:49'),
(23, 'Service', 21, 'Management', '', 1, '', '2022-01-17 04:08:02', '2022-01-17 04:08:02'),
(24, 'Service', 21, 'Cooking', '', 1, '', '2022-01-17 04:08:14', '2022-01-17 04:08:14'),
(25, 'Service', 21, 'Hotel managment', '', 1, '', '2022-01-17 04:44:58', '2022-01-17 04:44:58'),
(26, 'Service', 0, 'New cat', '', 1, '', '2022-01-17 04:45:15', '2022-01-17 04:45:15'),
(27, 'Service', 0, 'New cat1', '', 1, '', '2022-01-17 04:52:36', '2022-01-17 04:52:36'),
(28, 'Service', 21, 'test edu cat', '', 1, '', '2022-01-17 05:21:22', '2022-01-17 05:21:22'),
(29, 'Seller', 0, 'seller cat', '', 1, '', '2022-01-17 05:36:53', '2022-01-17 05:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `iso_code` varchar(2) NOT NULL,
  `isd_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso_code`, `isd_code`) VALUES
(1, 'Afghanistan', 'AF', '93'),
(2, 'Albania', 'AL', '355'),
(3, 'Algeria', 'DZ', '213'),
(4, 'American Samoa', 'AS', '1-684'),
(5, 'Andorra', 'AD', '376'),
(6, 'Angola', 'AO', '244'),
(7, 'Anguilla', 'AI', '1-264'),
(8, 'Antarctica', 'AQ', '672'),
(9, 'Antigua and Barbuda', 'AG', '1-268'),
(10, 'Argentina', 'AR', '54'),
(11, 'Armenia', 'AM', '374'),
(12, 'Aruba', 'AW', '297'),
(13, 'Australia', 'AU', '61'),
(14, 'Austria', 'AT', '43'),
(15, 'Azerbaijan', 'AZ', '994'),
(16, 'Bahamas', 'BS', '1-242'),
(17, 'Bahrain', 'BH', '973'),
(18, 'Bangladesh', 'BD', '880'),
(19, 'Barbados', 'BB', '1-246'),
(20, 'Belarus', 'BY', '375'),
(21, 'Belgium', 'BE', '32'),
(22, 'Belize', 'BZ', '501'),
(23, 'Benin', 'BJ', '229'),
(24, 'Bermuda', 'BM', '1-441'),
(25, 'Bhutan', 'BT', '975'),
(26, 'Bolivia', 'BO', '591'),
(27, 'Bosnia and Herzegowina', 'BA', '387'),
(28, 'Botswana', 'BW', '267'),
(29, 'Bouvet Island', 'BV', '47'),
(30, 'Brazil', 'BR', '55'),
(31, 'British Indian Ocean Territory', 'IO', '246'),
(32, 'Brunei Darussalam', 'BN', '673'),
(33, 'Bulgaria', 'BG', '359'),
(34, 'Burkina Faso', 'BF', '226'),
(35, 'Burundi', 'BI', '257'),
(36, 'Cambodia', 'KH', '855'),
(37, 'Cameroon', 'CM', '237'),
(38, 'Canada', 'CA', '1'),
(39, 'Cape Verde', 'CV', '238'),
(40, 'Cayman Islands', 'KY', '1-345'),
(41, 'Central African Republic', 'CF', '236'),
(42, 'Chad', 'TD', '235'),
(43, 'Chile', 'CL', '56'),
(44, 'China', 'CN', '86'),
(45, 'Christmas Island', 'CX', '61'),
(46, 'Cocos (Keeling) Islands', 'CC', '61'),
(47, 'Colombia', 'CO', '57'),
(48, 'Comoros', 'KM', '269'),
(49, 'Congo Democratic Republic of', 'CG', '242'),
(50, 'Cook Islands', 'CK', '682'),
(51, 'Costa Rica', 'CR', '506'),
(52, 'Cote D\'Ivoire', 'CI', '225'),
(53, 'Croatia', 'HR', '385'),
(54, 'Cuba', 'CU', '53'),
(55, 'Cyprus', 'CY', '357'),
(56, 'Czech Republic', 'CZ', '420'),
(57, 'Denmark', 'DK', '45'),
(58, 'Djibouti', 'DJ', '253'),
(59, 'Dominica', 'DM', '1-767'),
(60, 'Dominican Republic', 'DO', '1-809'),
(61, 'Timor-Leste', 'TL', '670'),
(62, 'Ecuador', 'EC', '593'),
(63, 'Egypt', 'EG', '20'),
(64, 'El Salvador', 'SV', '503'),
(65, 'Equatorial Guinea', 'GQ', '240'),
(66, 'Eritrea', 'ER', '291'),
(67, 'Estonia', 'EE', '372'),
(68, 'Ethiopia', 'ET', '251'),
(69, 'Falkland Islands (Malvinas)', 'FK', '500'),
(70, 'Faroe Islands', 'FO', '298'),
(71, 'Fiji', 'FJ', '679'),
(72, 'Finland', 'FI', '358'),
(73, 'France', 'FR', '33'),
(75, 'French Guiana', 'GF', '594'),
(76, 'French Polynesia', 'PF', '689'),
(77, 'French Southern Territories', 'TF', NULL),
(78, 'Gabon', 'GA', '241'),
(79, 'Gambia', 'GM', '220'),
(80, 'Georgia', 'GE', '995'),
(81, 'Germany', 'DE', '49'),
(82, 'Ghana', 'GH', '233'),
(83, 'Gibraltar', 'GI', '350'),
(84, 'Greece', 'GR', '30'),
(85, 'Greenland', 'GL', '299'),
(86, 'Grenada', 'GD', '1-473'),
(87, 'Guadeloupe', 'GP', '590'),
(88, 'Guam', 'GU', '1-671'),
(89, 'Guatemala', 'GT', '502'),
(90, 'Guinea', 'GN', '224'),
(91, 'Guinea-bissau', 'GW', '245'),
(92, 'Guyana', 'GY', '592'),
(93, 'Haiti', 'HT', '509'),
(94, 'Heard Island and McDonald Islands', 'HM', '011'),
(95, 'Honduras', 'HN', '504'),
(96, 'Hong Kong', 'HK', '852'),
(97, 'Hungary', 'HU', '36'),
(98, 'Iceland', 'IS', '354'),
(99, 'India', 'IN', '91'),
(100, 'Indonesia', 'ID', '62'),
(101, 'Iran (Islamic Republic of)', 'IR', '98'),
(102, 'Iraq', 'IQ', '964'),
(103, 'Ireland', 'IE', '353'),
(104, 'Israel', 'IL', '972'),
(105, 'Italy', 'IT', '39'),
(106, 'Jamaica', 'JM', '1-876'),
(107, 'Japan', 'JP', '81'),
(108, 'Jordan', 'JO', '962'),
(109, 'Kazakhstan', 'KZ', '7'),
(110, 'Kenya', 'KE', '254'),
(111, 'Kiribati', 'KI', '686'),
(112, 'Korea, Democratic People\'s Republic of', 'KP', '850'),
(113, 'South Korea', 'KR', '82'),
(114, 'Kuwait', 'KW', '965'),
(115, 'Kyrgyzstan', 'KG', '996'),
(116, 'Lao People\'s Democratic Republic', 'LA', '856'),
(117, 'Latvia', 'LV', '371'),
(118, 'Lebanon', 'LB', '961'),
(119, 'Lesotho', 'LS', '266'),
(120, 'Liberia', 'LR', '231'),
(121, 'Libya', 'LY', '218'),
(122, 'Liechtenstein', 'LI', '423'),
(123, 'Lithuania', 'LT', '370'),
(124, 'Luxembourg', 'LU', '352'),
(125, 'Macao', 'MO', '853'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', '389'),
(127, 'Madagascar', 'MG', '261'),
(128, 'Malawi', 'MW', '265'),
(129, 'Malaysia', 'MY', '60'),
(130, 'Maldives', 'MV', '960'),
(131, 'Mali', 'ML', '223'),
(132, 'Malta', 'MT', '356'),
(133, 'Marshall Islands', 'MH', '692'),
(134, 'Martinique', 'MQ', '596'),
(135, 'Mauritania', 'MR', '222'),
(136, 'Mauritius', 'MU', '230'),
(137, 'Mayotte', 'YT', '262'),
(138, 'Mexico', 'MX', '52'),
(139, 'Micronesia, Federated States of', 'FM', '691'),
(140, 'Moldova', 'MD', '373'),
(141, 'Monaco', 'MC', '377'),
(142, 'Mongolia', 'MN', '976'),
(143, 'Montserrat', 'MS', '1-664'),
(144, 'Morocco', 'MA', '212'),
(145, 'Mozambique', 'MZ', '258'),
(146, 'Myanmar', 'MM', '95'),
(147, 'Namibia', 'NA', '264'),
(148, 'Nauru', 'NR', '674'),
(149, 'Nepal', 'NP', '977'),
(150, 'Netherlands', 'NL', '31'),
(151, 'Netherlands Antilles', 'AN', '599'),
(152, 'New Caledonia', 'NC', '687    '),
(153, 'New Zealand', 'NZ', '64'),
(154, 'Nicaragua', 'NI', '505'),
(155, 'Niger', 'NE', '227'),
(156, 'Nigeria', 'NG', '234'),
(157, 'Niue', 'NU', '683'),
(158, 'Norfolk Island', 'NF', '672'),
(159, 'Northern Mariana Islands', 'MP', '1-670'),
(160, 'Norway', 'NO', '47'),
(161, 'Oman', 'OM', '968'),
(162, 'Pakistan', 'PK', '92'),
(163, 'Palau', 'PW', '680'),
(164, 'Panama', 'PA', '507'),
(165, 'Papua New Guinea', 'PG', '675'),
(166, 'Paraguay', 'PY', '595'),
(167, 'Peru', 'PE', '51'),
(168, 'Philippines', 'PH', '63'),
(169, 'Pitcairn', 'PN', '64'),
(170, 'Poland', 'PL', '48'),
(171, 'Portugal', 'PT', '351'),
(172, 'Puerto Rico', 'PR', '1-787'),
(173, 'Qatar', 'QA', '974'),
(174, 'Reunion', 'RE', '262'),
(175, 'Romania', 'RO', '40'),
(176, 'Russian Federation', 'RU', '7'),
(177, 'Rwanda', 'RW', '250'),
(178, 'Saint Kitts and Nevis', 'KN', '1-869'),
(179, 'Saint Lucia', 'LC', '1-758'),
(180, 'Saint Vincent and the Grenadines', 'VC', '1-784'),
(181, 'Samoa', 'WS', '685'),
(182, 'San Marino', 'SM', '378'),
(183, 'Sao Tome and Principe', 'ST', '239'),
(184, 'Saudi Arabia', 'SA', '966'),
(185, 'Senegal', 'SN', '221'),
(186, 'Seychelles', 'SC', '248'),
(187, 'Sierra Leone', 'SL', '232'),
(188, 'Singapore', 'SG', '65'),
(189, 'Slovakia (Slovak Republic)', 'SK', '421'),
(190, 'Slovenia', 'SI', '386'),
(191, 'Solomon Islands', 'SB', '677'),
(192, 'Somalia', 'SO', '252'),
(193, 'South Africa', 'ZA', '27'),
(194, 'South Georgia and the South Sandwich Islands', 'GS', '500'),
(195, 'Spain', 'ES', '34'),
(196, 'Sri Lanka', 'LK', '94'),
(197, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '290'),
(198, 'St. Pierre and Miquelon', 'PM', '508'),
(199, 'Sudan', 'SD', '249'),
(200, 'Suriname', 'SR', '597'),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', '47'),
(202, 'Swaziland', 'SZ', '268'),
(203, 'Sweden', 'SE', '46'),
(204, 'Switzerland', 'CH', '41'),
(205, 'Syrian Arab Republic', 'SY', '963'),
(206, 'Taiwan', 'TW', '886'),
(207, 'Tajikistan', 'TJ', '992'),
(208, 'Tanzania, United Republic of', 'TZ', '255'),
(209, 'Thailand', 'TH', '66'),
(210, 'Togo', 'TG', '228'),
(211, 'Tokelau', 'TK', '690'),
(212, 'Tonga', 'TO', '676'),
(213, 'Trinidad and Tobago', 'TT', '1-868'),
(214, 'Tunisia', 'TN', '216'),
(215, 'Turkey', 'TR', '90'),
(216, 'Turkmenistan', 'TM', '993'),
(217, 'Turks and Caicos Islands', 'TC', '1-649'),
(218, 'Tuvalu', 'TV', '688'),
(219, 'Uganda', 'UG', '256'),
(220, 'Ukraine', 'UA', '380'),
(221, 'United Arab Emirates', 'AE', '971'),
(222, 'United Kingdom', 'GB', '44'),
(223, 'United States', 'US', '1'),
(224, 'United States Minor Outlying Islands', 'UM', '246'),
(225, 'Uruguay', 'UY', '598'),
(226, 'Uzbekistan', 'UZ', '998'),
(227, 'Vanuatu', 'VU', '678'),
(228, 'Vatican City State (Holy See)', 'VA', '379'),
(229, 'Venezuela', 'VE', '58'),
(230, 'Vietnam', 'VN', '84'),
(231, 'Virgin Islands (British)', 'VG', '1-284'),
(232, 'Virgin Islands (U.S.)', 'VI', '1-340'),
(233, 'Wallis and Futuna Islands', 'WF', '681'),
(234, 'Western Sahara', 'EH', '212'),
(235, 'Yemen', 'YE', '967'),
(236, 'Serbia', 'RS', '381'),
(238, 'Zambia', 'ZM', '260'),
(239, 'Zimbabwe', 'ZW', '263'),
(240, 'Aaland Islands', 'AX', '358'),
(241, 'Palestine', 'PS', '970'),
(242, 'Montenegro', 'ME', '382'),
(243, 'Guernsey', 'GG', '44-1481'),
(244, 'Isle of Man', 'IM', '44-1624'),
(245, 'Jersey', 'JE', '44-1534'),
(247, 'Curaçao', 'CW', '599'),
(248, 'Ivory Coast', 'CI', '225'),
(249, 'Kosovo', 'XK', '383');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `loc_latitude` double NOT NULL,
  `loc_longitude` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `username`, `country_code`, `mobile`, `address`, `location`, `loc_latitude`, `loc_longitude`, `status`, `profile_pic`, `created_at`, `updated_at`) VALUES
(16, 'Sony Customer', 'sonymangottil12@gmail.com', 'sonymangottil12', '91', '9495591928', 'test,test po dfgbd bgdfg ftgh sd fsdfs', 'Kolenchery, Kerala, India', 9.979653599999999, 76.47307959999999, 1, '1638868768_avatar5.png', '2021-05-20 23:00:24', '2022-04-29 05:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `diy_help`
--

CREATE TABLE `diy_help` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diy_help`
--

INSERT INTO `diy_help` (`id`, `user_type`, `user_id`, `title`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 'customer', 16, 'test', 'test cmnt', 1, '2022-03-04 07:13:47', '2022-03-04 07:13:47'),
(2, 'trader', 15, 'dfs', 'grsers ers r', 1, '2022-04-04 03:32:08', '2022-04-04 03:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `diy_help_comments`
--

CREATE TABLE `diy_help_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diy_help_comment_id` int(11) NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `diy_help_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diy_help_comments`
--

INSERT INTO `diy_help_comments` (`id`, `diy_help_comment_id`, `user_type`, `user_id`, `diy_help_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'customer', 16, 1, 'testing first comment', 1, '2022-03-04 07:19:49', '2022-03-04 07:19:49'),
(2, 0, 'customer', 16, 1, 'reply to first comnt', 1, '2022-03-04 07:23:36', '2022-03-04 07:23:36'),
(3, 2, 'customer', 16, 1, 'reply to', 1, '2022-03-04 07:24:25', '2022-03-04 07:24:25'),
(4, 2, 'trader', 15, 1, 'reply to sony', 1, '2022-03-04 07:26:09', '2022-03-04 07:26:09'),
(5, 0, 'trader', 15, 1, 'test from trader', 1, '2022-03-04 07:27:02', '2022-03-04 07:27:02'),
(6, 1, 'trader', 15, 1, 'reply', 1, '2022-03-04 07:28:13', '2022-03-04 07:28:13'),
(8, 5, 'customer', 16, 1, 'first reply', 1, '2022-05-26 12:30:57', '2022-05-26 12:30:57'),
(9, 5, 'customer', 16, 1, 'sd', 1, '2022-05-26 12:31:01', '2022-05-26 12:31:01'),
(10, 5, 'customer', 16, 1, 'cv', 1, '2022-05-26 12:31:13', '2022-05-26 12:31:13'),
(21, 0, 'customer', 16, 2, 'comment 1', 1, '2022-05-26 12:41:03', '2022-05-26 12:41:03'),
(22, 21, 'customer', 16, 2, 'reply 1', 1, '2022-05-26 12:41:09', '2022-05-26 12:41:09'),
(23, 0, 'customer', 16, 2, 'comment 2', 1, '2022-05-26 12:41:14', '2022-05-26 12:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `diy_help_images`
--

CREATE TABLE `diy_help_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diy_help_id` int(11) NOT NULL,
  `diy_help_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diy_help_images`
--

INSERT INTO `diy_help_images` (`id`, `diy_help_id`, `diy_help_image`, `created_at`, `updated_at`) VALUES
(1, 1, '1646397827_photo1.png', '2022-03-04 07:13:47', '2022-03-04 07:13:47'),
(2, 1, '1646397827_photo2.png', '2022-03-04 07:13:47', '2022-03-04 07:13:47'),
(3, 1, '1646397827_photo3.jpg', '2022-03-04 07:13:47', '2022-03-04 07:13:47'),
(4, 2, '1649062928_photo2.png', '2022-04-04 03:32:09', '2022-04-04 03:32:09'),
(5, 2, '1649062929_photo3.jpg', '2022-04-04 03:32:09', '2022-04-04 03:32:09'),
(6, 2, '1649062929_photo4.jpg', '2022-04-04 03:32:10', '2022-04-04 03:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(2, 'What is Lorem Ipsum?', '<p><span style=\"color: rgb(51, 51, 51); font-family: Poppins, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', 1, '2021-06-09 23:54:21', '2021-09-16 01:18:21'),
(3, 'What is lorem ipsum 2?', '<p><span style=\"color: rgb(51, 51, 51); font-family: Poppins, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', 1, '2021-09-16 01:18:36', '2021-09-16 01:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `favourite` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_type`, `user_id`, `trader_id`, `favourite`, `created_at`, `updated_at`) VALUES
(9, 'customer', 16, 15, 1, '2021-12-06 03:34:06', '2021-12-06 03:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `follow` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `user_type`, `user_id`, `trader_id`, `follow`, `created_at`, `updated_at`) VALUES
(4, 'provider', 14, 15, 1, '2021-12-14 23:45:49', '2021-12-14 23:45:49'),
(6, 'customer', 16, 15, 1, '2021-12-15 00:13:46', '2021-12-15 00:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_completion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `material_purchased` tinyint(4) NOT NULL,
  `job_views` int(11) NOT NULL,
  `quote_provided` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_type`, `user_id`, `category_id`, `sub_category_id`, `title`, `description`, `budget`, `job_completion`, `status`, `job_status`, `job_location`, `latitude`, `longitude`, `material_purchased`, `job_views`, `quote_provided`, `created_at`, `updated_at`) VALUES
(3, 'customer', 16, 1, 2, 'test job from ui', 'test job desc from ui by customer', '1000', 'In 2 Days', '1', 'Rejected', '', 49.2813825, 0, 0, 0, 0, '2021-10-27 12:03:27', '2021-10-27 12:03:27'),
(5, 'customer', 16, 3, 4, 'published job', 'published job desc', '2', 'In 2 Days', '1', 'Published', '', 0, 0, 0, 0, 0, '2021-10-27 22:49:41', '2021-10-27 22:49:41'),
(6, 'customer', 16, 0, 0, 'unpublished job', 'unpublished job 2 descsdfs', '3', 'In 1 Week', '1', 'Unpublished', 'Kochi, Kerala, India', 9.9312328, 76.26730409999999, 0, 0, 0, '2021-10-27 22:50:22', '2022-06-09 02:09:38'),
(7, 'customer', 16, 1, 5, 'completed job', 'completed job description', '5', 'In 2 Days', '1', 'Completed', '', 0, 0, 0, 0, 0, '2021-10-27 22:51:19', '2021-10-27 22:51:19'),
(8, 'customer', 16, 1, 2, 'draft job', 'draft job desc fgh rt gh ds', '1234', 'In 1 Week', '1', 'Published', '', 0, 0, 1, 0, 0, '2021-10-28 01:21:33', '2022-04-29 06:18:09'),
(9, 'customer', 16, 1, 5, 'title for post', 'description for post 1', '100', 'In 2 Days', '1', 'Published', '', 0, 0, 1, 0, 0, '2021-10-28 04:57:35', '2021-10-28 04:58:54'),
(10, 'customer', 16, 3, 4, 'fghd', 'f dgh', '123', 'In 2 Days', '1', 'Published', '', 0, 0, 1, 0, 0, '2021-11-02 23:38:54', '2021-11-02 23:38:54'),
(12, 'customer', 16, 1, 2, 'test for seek quote', 'test description for seek quote', '1000', 'In 1 Week', '1', 'Seek Quote', '', 0, 0, 1, 0, 0, '2021-11-02 23:54:46', '2021-11-02 23:54:46'),
(13, 'customer', 16, 21, 4, 'dfvgd', 'g frgdfg', 'frg', 'Urgent', '1', 'Seek Quote', '', 0, 0, 1, 0, 0, '2021-11-03 01:44:36', '2021-11-03 01:44:36'),
(15, 'customer', 16, 0, 0, 'ghjfgh', 'gfhjftg', 'fgh', 'In 2 Days', '1', 'Seek Quote', '', 0, 0, 0, 0, 0, '2021-11-03 01:47:30', '2021-11-03 01:47:30'),
(16, 'customer', 16, 0, 0, 'dfstg r', 't rtg', 't g', 'In 2 Days', '1', 'Seek Quote', '', 0, 0, 0, 0, 0, '2021-11-03 01:47:53', '2021-11-03 01:47:53'),
(18, 'customer', 16, 3, 4, 'gyhj', 'ghf', 'fgh', 'In 2 Days', '1', 'Seek Quote', '', 0, 0, 0, 0, 0, '2021-11-03 01:50:23', '2021-11-03 01:50:23'),
(19, 'customer', 16, 1, 5, 'ghj', 'gh', '45', 'Urgent', '1', 'Seek Quote', '', 0, 0, 0, 0, 0, '2021-11-03 01:51:02', '2021-11-03 01:51:02'),
(20, 'customer', 16, 1, 2, 'gfhj', 'f fg', '4567', 'In 1 Week', '1', 'Seek Quote', '', 0, 0, 0, 0, 0, '2021-11-08 07:50:39', '2021-11-08 07:50:39'),
(21, 'customer', 16, 3, 4, 'fgh', 'dfgh', '234', 'In 1 Week', '1', 'Seek Quote', '', 0, 0, 0, 0, 0, '2021-11-08 07:52:00', '2021-11-08 07:52:00'),
(22, 'customer', 16, 1, 5, 'fvhbgj', 'fghj', '576', 'Urgent', '1', 'Seek Quote', '', 0, 0, 0, 0, 1, '2021-11-08 07:52:41', '2022-06-06 09:45:53'),
(24, 'customer', 16, 0, 0, 'testing', 'dszfdsgbdg', '123', 'In 2 Days', '1', 'Ongoing', '', 0, 0, 1, 0, 0, '2022-03-04 01:27:42', '2022-06-06 09:49:59'),
(25, 'customer', 16, 1, 2, 'may 19', 'desc', '10', 'Urgent', '1', 'Published', '', 0, 0, 1, 0, 0, '2022-05-19 04:13:35', '2022-05-19 04:34:37'),
(26, 'customer', 16, 1, 2, 'may 19 2nd', 'sxdds', '12', 'In 2 Days', '1', 'Ongoing', '', 0, 0, 0, 0, 1, '2022-05-19 04:37:42', '2022-05-31 08:32:42'),
(27, 'customer', 16, 1, 2, 'June 9 2022', 'june 9th 2022 descriiption', '100', 'In 2 Days', '1', 'Ongoing', 'Kochi, Kerala, India', 9.9312328, 76.26730409999999, 0, 0, 0, '2022-06-09 09:05:16', '2022-06-13 10:16:14'),
(28, 'customer', 16, 1, 2, 'june 9 2nd', 'description', '100', 'In 1 Week', '1', 'Ongoing', 'Kochi, Kerala, India', 9.9312328, 76.26730409999999, 0, 0, 0, '2022-06-09 09:14:55', '2022-06-09 09:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_images`
--

CREATE TABLE `jobs_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs_images`
--

INSERT INTO `jobs_images` (`id`, `job_id`, `job_image`, `created_at`, `updated_at`) VALUES
(5, 3, '1635356007_photo1.png', '2021-10-27 12:03:27', '2021-10-27 12:03:27'),
(6, 3, '1635356007_photo2.png', '2021-10-27 12:03:27', '2021-10-27 12:03:27'),
(8, 5, '1635394781_photo4.jpg', '2021-10-27 22:49:41', '2021-10-27 22:49:41'),
(9, 6, '1635394822_photo1.png', '2021-10-27 22:50:22', '2021-10-27 22:50:22'),
(10, 7, '1635394879_photo2.png', '2021-10-27 22:51:19', '2021-10-27 22:51:19'),
(11, 7, '1635394879_photo3.jpg', '2021-10-27 22:51:19', '2021-10-27 22:51:19'),
(12, 8, '1635403893_photo2.png', '2021-10-28 01:21:33', '2021-10-28 01:21:33'),
(13, 8, '1635411802_photo3.jpg', '2021-10-28 03:33:22', '2021-10-28 03:33:22'),
(14, 9, '1635416855_photo1.png', '2021-10-28 04:57:35', '2021-10-28 04:57:35'),
(15, 9, '1635416855_photo2.png', '2021-10-28 04:57:35', '2021-10-28 04:57:35'),
(16, 10, '1635916134_photo1.png', '2021-11-02 23:38:54', '2021-11-02 23:38:54'),
(17, 11, '1635916157_photo1.png', '2021-11-02 23:39:17', '2021-11-02 23:39:17'),
(18, 12, '1635917086_photo1.png', '2021-11-02 23:54:46', '2021-11-02 23:54:46'),
(19, 12, '1635917086_photo2.png', '2021-11-02 23:54:46', '2021-11-02 23:54:46'),
(20, 13, '1635923676_avatar4.png', '2021-11-03 01:44:36', '2021-11-03 01:44:36'),
(22, 15, '1635923850_photo3.jpg', '2021-11-03 01:47:30', '2021-11-03 01:47:30'),
(23, 16, '1635923873_avatar5.png', '2021-11-03 01:47:53', '2021-11-03 01:47:53'),
(25, 18, '1635924023_photo3.jpg', '2021-11-03 01:50:23', '2021-11-03 01:50:23'),
(26, 19, '1635924062_photo4.jpg', '2021-11-03 01:51:02', '2021-11-03 01:51:02'),
(27, 8, '1636365327_photo1.png', '2021-11-08 04:25:27', '2021-11-08 04:25:27'),
(28, 8, '1636365327_photo4.jpg', '2021-11-08 04:25:27', '2021-11-08 04:25:27'),
(29, 20, '1636377639_photo3.jpg', '2021-11-08 07:50:39', '2021-11-08 07:50:39'),
(30, 20, '1636377639_photo4.jpg', '2021-11-08 07:50:39', '2021-11-08 07:50:39'),
(31, 21, '1636377720_photo1.png', '2021-11-08 07:52:00', '2021-11-08 07:52:00'),
(32, 21, '1636377720_photo2.png', '2021-11-08 07:52:00', '2021-11-08 07:52:00'),
(33, 21, '1636377720_photo3.jpg', '2021-11-08 07:52:00', '2021-11-08 07:52:00'),
(34, 22, '1636377761_photo2.png', '2021-11-08 07:52:41', '2021-11-08 07:52:41'),
(38, 24, '1646377062_photo1.png', '2022-03-04 01:27:42', '2022-03-04 01:27:42'),
(39, 24, '1646377062_photo2.png', '2022-03-04 01:27:42', '2022-03-04 01:27:42'),
(40, 24, '1646377062_photo3.jpg', '2022-03-04 01:27:42', '2022-03-04 01:27:42'),
(41, 25, '1652953415_photo1.png', '2022-05-19 04:13:35', '2022-05-19 04:13:35'),
(42, 25, '1652953415_photo2.png', '2022-05-19 04:13:35', '2022-05-19 04:13:35'),
(43, 26, '1652954862_photo3.jpg', '2022-05-19 04:37:42', '2022-05-19 04:37:42'),
(44, 27, '1654765516_photo1.png', '2022-06-09 09:05:16', '2022-06-09 09:05:16'),
(45, 27, '1654765516_photo2.png', '2022-06-09 09:05:16', '2022-06-09 09:05:16'),
(46, 28, '1654766095_photo3.jpg', '2022-06-09 09:14:56', '2022-06-09 09:14:56'),
(47, 28, '1654766096_photo4.jpg', '2022-06-09 09:14:56', '2022-06-09 09:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `job_quotes`
--

CREATE TABLE `job_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quote_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_request` tinyint(4) NOT NULL,
  `detail_req_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_req_details_reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seek_quote` tinyint(4) NOT NULL,
  `give_quote` tinyint(4) NOT NULL,
  `quoted_price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quote_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_quotes`
--

INSERT INTO `job_quotes` (`id`, `job_id`, `trader_id`, `customer_id`, `quote_details`, `status`, `detail_request`, `detail_req_details`, `detail_req_details_reply`, `seek_quote`, `give_quote`, `quoted_price`, `quote_reason`, `created_at`, `updated_at`) VALUES
(20, 26, 15, 16, '', 'Accepted', 0, '', '', 0, 1, '5', 'g', '2022-05-31 03:14:29', '2022-05-31 08:32:42'),
(22, 24, 15, 16, '', 'Accepted', 0, '', '', 0, 1, '10', 'jdsvgfujsyhdbf', NULL, '2022-06-06 09:49:59'),
(23, 22, 15, 16, '', 'Requested', 0, '', '', 0, 1, '10', 'quoting for job', '2022-06-06 09:45:53', '2022-06-06 09:45:53'),
(24, 28, 15, 16, '', 'Accepted', 0, '', '', 1, 1, '120', 'need 120', '2022-06-09 09:15:06', '2022-06-09 09:23:11'),
(25, 28, 11, 16, '', 'Requested', 0, '', '', 1, 0, '', '', '2022-06-09 09:17:11', '2022-06-09 09:17:11'),
(26, 27, 15, 16, '', 'Accepted', 0, '', '', 0, 1, '101', 'drtr ret y ry', '2022-06-13 09:34:22', '2022-06-13 10:34:19'),
(27, 27, 14, 16, '', 'Rejected', 0, '', '', 0, 1, '90', '', '2022-06-13 09:35:15', '2022-06-13 10:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `job_quote_details`
--

CREATE TABLE `job_quote_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_quote_id` int(11) NOT NULL,
  `job_quote_details_id` int(11) NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_quote_details`
--

INSERT INTO `job_quote_details` (`id`, `job_id`, `job_quote_id`, `job_quote_details_id`, `user_type`, `user_id`, `details`, `created_at`, `updated_at`) VALUES
(3, 26, 20, 0, 'provider', 15, 'more details', '2022-05-31 04:55:59', '2022-05-31 04:55:59'),
(4, 26, 20, 3, 'provider', 15, 'test', '2022-05-31 04:55:59', '2022-05-31 04:55:59'),
(5, 26, 20, 3, 'customer', 16, 'dfgy', '2022-05-30 04:55:59', NULL),
(6, 26, 20, 0, 'customer', 16, 'testingggg', '2022-05-31 07:17:26', '2022-05-31 07:17:26'),
(7, 26, 20, 3, 'customer', 16, 'gh', '2022-05-31 07:18:00', '2022-05-31 07:18:00'),
(8, 24, 22, 0, 'provider', 15, 'requesting more details for the job', '2022-06-06 09:47:41', '2022-06-06 09:47:41'),
(9, 24, 22, 8, 'customer', 16, 'reply with the details to trader', '2022-06-06 09:48:40', '2022-06-06 09:48:40'),
(10, 28, 24, 0, 'provider', 15, 'requesting more details for the completion', '2022-06-09 09:15:56', '2022-06-09 09:15:56'),
(11, 28, 24, 10, 'provider', 15, 'reply to customer', '2022-06-09 09:16:18', '2022-06-09 09:16:18'),
(12, 28, 24, 10, 'customer', 16, 'reply', '2022-06-09 09:16:43', '2022-06-09 09:16:43'),
(13, 22, 23, 0, 'provider', 15, 'dfg', '2022-06-10 07:11:12', '2022-06-10 07:11:12'),
(14, 28, 24, 0, 'provider', 15, 'fgg', '2022-06-13 08:53:53', '2022-06-13 08:53:53'),
(15, 27, 26, 0, 'provider', 15, 'fghdfgh', '2022-06-13 09:34:22', '2022-06-13 09:34:22'),
(16, 25, 27, 0, 'provider', 15, 'ghhj', '2022-06-13 09:35:15', '2022-06-13 09:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_bazaar` tinyint(4) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_trader` tinyint(4) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `is_job` tinyint(4) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_type`, `from_user_id`, `to_user_type`, `to_user_id`, `message`, `status`, `is_bazaar`, `product_id`, `is_trader`, `trader_id`, `is_job`, `job_id`, `created_at`, `updated_at`) VALUES
(50, 'trader', 15, 'customer', 16, 'testing again from trader messases', 0, 0, 0, 0, 0, 0, 0, '2022-06-02 21:51:53', '2022-06-02 21:51:53'),
(51, 'trader', 15, 'customer', 16, 'testing again', 0, 0, 0, 0, 0, 0, 0, '2022-06-02 21:52:00', '2022-06-02 21:52:00'),
(52, 'trader', 15, 'customer', 16, '', 0, 1, 8, 0, 0, 0, 0, '2022-06-03 03:25:05', '2022-06-03 03:25:05'),
(53, 'trader', 15, 'customer', 16, '', 0, 1, 8, 0, 0, 0, 0, '2022-06-03 03:28:01', '2022-06-03 03:28:01'),
(54, 'trader', 15, 'customer', 16, 'test from bazaar redirect', 0, 0, 0, 1, 15, 0, 0, '2022-06-03 03:28:18', '2022-06-03 03:28:18'),
(55, 'trader', 15, 'customer', 16, '', 0, 1, 8, 0, 0, 0, 0, '2022-06-03 03:38:19', '2022-06-03 03:38:19'),
(56, 'trader', 15, 'customer', 16, '', 0, 1, 8, 0, 0, 0, 0, '2022-06-06 09:36:30', '2022-06-06 09:36:30'),
(57, 'trader', 15, 'customer', 16, '', 0, 1, 8, 0, 0, 0, 0, '2022-06-06 09:37:06', '2022-06-06 09:37:06'),
(60, 'customer', 16, 'trader', 15, '', 0, 0, 0, 1, 15, 0, 0, '2022-06-08 02:21:53', '2022-06-08 02:21:53'),
(61, 'customer', 16, 'trader', 15, '', 0, 0, 0, 1, 15, 0, 0, '2022-06-08 07:04:23', '2022-06-08 07:04:23'),
(62, 'customer', 16, 'trader', 15, 'testing', 0, 0, 0, 0, 0, 0, 0, '2022-06-08 07:04:43', '2022-06-08 07:04:43'),
(63, 'customer', 16, 'trader', 15, '', 0, 1, 6, 0, 0, 0, 0, '2022-06-08 07:05:58', '2022-06-08 07:05:58'),
(64, 'customer', 16, 'trader', 15, '', 0, 1, 6, 0, 0, 0, 0, '2022-06-08 07:06:47', '2022-06-08 07:06:47'),
(65, 'customer', 16, 'trader', 15, '', 0, 1, 6, 0, 0, 0, 0, '2022-06-08 07:11:32', '2022-06-08 07:11:32'),
(66, 'customer', 16, 'trader', 15, 'xdf', 0, 0, 0, 0, 0, 0, 0, '2022-06-08 07:18:32', '2022-06-08 07:18:32'),
(67, 'customer', 16, 'trader', 15, '', 0, 0, 0, 0, 0, 1, 22, '2022-06-08 08:51:02', '2022-06-08 08:51:02'),
(68, 'customer', 16, 'trader', 15, '', 0, 0, 0, 1, 15, 0, 0, '2022-06-08 09:13:10', '2022-06-08 09:13:10'),
(69, 'customer', 16, 'trader', 14, '', 0, 0, 0, 1, 14, 0, 0, '2022-06-09 04:55:37', '2022-06-09 04:55:37'),
(70, 'customer', 16, 'customer', 16, '', 0, 1, 10, 0, 0, 0, 0, '2022-06-09 09:38:38', '2022-06-09 09:38:38'),
(71, 'customer', 16, 'customer', 16, '', 0, 1, 10, 0, 0, 0, 0, '2022-06-09 09:38:59', '2022-06-09 09:38:59'),
(72, 'customer', 16, 'customer', 16, '', 0, 1, 10, 0, 0, 0, 0, '2022-06-09 09:39:35', '2022-06-09 09:39:35'),
(73, 'customer', 16, 'customer', 16, '', 0, 1, 10, 0, 0, 0, 0, '2022-06-09 09:41:22', '2022-06-09 09:41:22'),
(74, 'trader', 15, 'customer', 16, '', 0, 0, 0, 0, 0, 0, 0, '2022-06-14 05:42:11', '2022-06-14 05:42:11'),
(76, 'trader', 15, 'trader', 15, '', 0, 0, 0, 1, 15, 0, 0, '2022-06-14 06:11:29', '2022-06-14 06:11:29'),
(84, 'trader', 15, 'trader', 14, 'Anu', 0, 0, 0, 1, 14, 0, 0, '2022-06-14 06:43:38', '2022-06-14 06:43:38'),
(86, 'trader', 15, 'customer', 16, 'June 9 2022', 0, 1, 10, 0, 0, 0, 0, '2022-06-14 06:47:05', '2022-06-14 06:47:05');

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
(4, '2021_03_29_050552_create_categories_table', 2),
(7, '2021_03_31_063916_create_providers_table', 5),
(18, '2014_10_12_000000_create_users_table', 6),
(19, '2014_10_12_100000_create_password_resets_table', 6),
(20, '2019_08_19_000000_create_failed_jobs_table', 6),
(21, '2021_03_29_054151_create_categories_table', 6),
(22, '2021_03_31_040602_create_services_table', 6),
(23, '2021_03_31_065436_create_providers_table', 6),
(24, '2021_04_01_063404_create_provider_documents_table', 6),
(25, '2021_04_01_075724_create_provider_services_table', 6),
(26, '2021_04_05_041524_create_provider_works_table', 6),
(27, '2021_04_05_083725_create_reviews_table', 6),
(28, '2021_04_05_092309_create_pages_table', 6),
(29, '2021_04_07_071345_create_banners_table', 6),
(30, '2021_04_08_100017_create_customers_table', 6),
(31, '2021_04_13_033446_create_provider_categories_table', 6),
(32, '2021_04_13_090035_create_provider_service_locations_table', 6),
(33, '2021_04_15_060112_create_settings_table', 7),
(34, '2021_06_10_035537_create_faqs_table', 7),
(35, '2021_08_16_102533_create_advertisements_table', 8),
(37, '2021_08_31_121336_alter_providers_table', 9),
(38, '2021_09_01_070826_create_trader_posts_table', 10),
(39, '2021_09_01_070853_create_trader_posts_images_table', 10),
(40, '2021_09_01_070906_create_trader_posts_likes_table', 10),
(41, '2021_09_01_070917_create_trader_posts_comments_table', 10),
(42, '2021_09_01_083723_alter_trader_posts_table', 11),
(43, '2021_09_01_084059_alter_trader_posts_table', 12),
(44, '2021_09_01_084226_alter_trader_posts_table', 13),
(45, '2021_09_01_104933_create_trader_offers_table', 14),
(46, '2021_09_01_105016_create_trader_offers_images_table', 14),
(47, '2021_09_01_130719_alter_providers1_table', 15),
(48, '2021_09_01_130840_alter_providers1_table', 16),
(49, '2021_09_01_132414_alter_providers_categories_table', 17),
(50, '2021_09_02_100530_create_reviews_table', 18),
(51, '2021_09_14_071852_create_trader_review_comments', 19),
(52, '2021_09_14_110831_alter_trader_posts_likes', 20),
(53, '2021_09_15_091609_create_bazaar_category_table', 21),
(54, '2021_09_15_091742_create_bazaar_table', 21),
(55, '2021_09_15_092206_create_bazaar_images_table', 21),
(56, '2021_09_15_174727_create_appointments_table', 22),
(57, '2021_09_20_075132_create_jobs_table', 23),
(58, '2021_09_20_075358_create_jobs_images_table', 23),
(59, '2021_09_24_071550_create_trader_offers_comments', 24),
(60, '2021_10_19_061709_create_products_wishlist_table', 25),
(61, '2021_10_19_085440_alter_bazaar_table', 26),
(62, '2021_10_21_050006_alter_customers_table', 27),
(63, '2021_10_26_071839_create_trader_posts_reports_table', 28),
(64, '2021_10_27_163441_alter_jobs_table', 29),
(65, '2021_10_27_163924_create_job_quotes_table', 29),
(66, '2021_11_08_125936_alter_job_quotes_table', 30),
(67, '2021_11_09_111408_alter_job_quotes1_table', 31),
(68, '2021_11_17_070934_alter_trader_offers_table', 32),
(69, '2021_12_01_071851_create_receipts_table', 33),
(70, '2021_12_01_115609_create_messages_table', 34),
(71, '2021_12_02_040938_create_follows_table', 35),
(72, '2021_12_02_051501_create_favourites_table', 36),
(73, '2021_12_06_114228_create_search_history_table', 37),
(74, '2021_12_06_120558_create_profile_visits_table', 37),
(75, '2021_12_07_085539_create_diy_help_table', 38),
(76, '2021_12_07_085838_create_diy_help_comments_table', 38),
(77, '2021_12_08_093850_create_trader_offer_likes_table', 39),
(78, '2021_12_15_034421_alter_follows_table', 40),
(79, '2021_12_15_034529_alter_favourites_table', 40),
(80, '2021_12_15_050002_alter_profile_visits_table', 41),
(81, '2021_12_15_094723_alter_search_history_table', 42),
(82, '2021_12_21_035319_alter_providers_21122021_table', 43),
(83, '2021_12_21_072603_alter_job_quotes_21122021_table', 44),
(84, '2022_01_14_094908_create_block_table', 45),
(85, '2022_01_19_042158_alter_bazaar_table_price', 46),
(86, '2022_02_03_085150_alter_providers_table_03022022', 47),
(87, '2022_02_07_044021_alter_provider_documents_table_07022022', 48),
(88, '2022_02_28_104144_create_packages_table', 49),
(89, '2022_03_04_041441_create_diy_help_images_table', 50),
(90, '2022_03_04_093132_alter_trader_post_comments_table', 51),
(91, '2022_03_04_111121_alter_trader_offers_comments_table', 52),
(92, '2022_03_04_123730_alter_diy_help_comments_table', 53),
(93, '2022_03_04_165150_alter_trader_review_comments_table', 54),
(94, '2022_03_22_040142_create_notifications_table', 55),
(95, '2022_03_28_081649_alter_notifications_table', 56),
(96, '2022_03_28_083125_alter_notifications_table_28032022', 57),
(97, '2022_03_28_083410_alter_notifications_table', 58),
(98, '2022_03_29_052108_alter_users_table_29032022', 59),
(99, '2022_04_11_070014_create_newsletter_table', 59),
(100, '2022_04_20_113434_alter_providers_table_20042022', 60),
(101, '2022_04_20_113445_alter_customers_table_20042022', 60),
(102, '2022_04_20_113454_alter_users_table_20042022', 61),
(103, '2022_05_03_100956_alter_messages_table_03052022', 61),
(104, '2022_05_31_040147_create_job_quote_details', 62),
(105, '2022_05_31_045502_alter_job_quotes_31052022', 63),
(106, '2022_06_03_093458_alter_messages_table_03062022', 64),
(107, '2022_06_09_072720_alter_jobs_table_09062022', 65),
(108, '2022_06_09_072945_alter_bazaar_table_09062022', 65);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sonymangottil@gmail.com', 1, '2022-04-11 01:59:53', '2022-04-11 01:59:53'),
(2, 'sumikuriakose8@gmail.com', 1, '2022-04-11 02:01:04', '2022-04-11 02:01:04'),
(3, 'sonymangottil12@gmail.com', 1, '2022-04-11 02:01:07', '2022-04-11 02:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `notification` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_type`, `user_id`, `from_user_type`, `from_user_id`, `notification`, `reference_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'trader', 15, 'customer', 16, ' made a comment for on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-03-21 22:56:49', '2022-03-21 22:56:49'),
(2, 'trader', 15, 'customer', 16, ' unblocked you.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-03-22 00:59:26', '2022-03-22 00:59:26'),
(3, 'trader', 15, 'customer', 16, ' rescheduled the appointment.', 'http://www.unotraders.local.com/trader/appointments', 0, '2022-03-22 03:09:45', '2022-03-22 03:09:45'),
(4, 'trader', 15, 'provider', 15, ' rescheduled the appointment.', 'http://www.unotraders.local.com/trader/appointments', 0, '2022-03-22 03:13:14', '2022-03-22 03:13:14'),
(5, 'customer', 16, 'provider', 15, 'requested a job quote.', 'http://www.unotraders.local.com/customer/profile', 0, '2022-03-28 04:36:58', '2022-03-28 04:36:58'),
(6, 'trader', 15, 'customer', 16, 'reviewed your profile.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-03-29 23:06:40', '2022-03-29 23:06:40'),
(7, 'customer', 16, 'provider', 15, 'accepted your job quote request.', 'http://www.unotraders.local.com/customer/jobs/seekquote', 0, '2022-04-07 22:38:20', '2022-04-07 22:38:20'),
(8, 'customer', 16, 'provider', 15, 'accepted your job quote request.', 'http://www.unotraders.local.com/customer/jobs/seekquote', 0, '2022-04-07 22:38:25', '2022-04-07 22:38:25'),
(9, 'customer', 16, 'provider', 15, 'requested a job quote.', 'http://www.unotraders.local.com/customer/profile', 0, '2022-04-11 22:14:31', '2022-04-11 22:14:31'),
(10, 'trader', 15, 'customer', 16, 'requested a job quote.', 'http://www.unotraders.local.com/trader/jobs-quote-requests', 0, '2022-04-11 22:18:19', '2022-04-11 22:18:19'),
(11, 'customer', 16, 'provider', 15, 'requested a job quote.', 'http://www.unotraders.local.com/customer/profile', 0, '2022-05-11 23:33:03', '2022-05-11 23:33:03'),
(12, 'customer', 16, 'provider', 15, 'accepted your job quote request.', 'http://www.unotraders.local.com/customer/jobs/seekquote', 0, '2022-05-12 03:39:45', '2022-05-12 03:39:45'),
(13, 'customer', 16, 'provider', 15, 'rejected your job quote request.', 'http://www.unotraders.local.com/customer/jobs/seekquote', 0, '2022-05-12 03:39:53', '2022-05-12 03:39:53'),
(14, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-16 00:43:27', '2022-05-16 00:43:27'),
(15, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-16 00:43:53', '2022-05-16 00:43:53'),
(16, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:25:36', '2022-05-17 01:25:36'),
(17, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:26:33', '2022-05-17 01:26:33'),
(18, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:27:44', '2022-05-17 01:27:44'),
(19, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:30:29', '2022-05-17 01:30:29'),
(20, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:31:23', '2022-05-17 01:31:23'),
(21, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:31:45', '2022-05-17 01:31:45'),
(22, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:34:52', '2022-05-17 01:34:52'),
(23, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:35:40', '2022-05-17 01:35:40'),
(24, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:36:50', '2022-05-17 01:36:50'),
(25, 'trader', 15, 'customer', 16, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:38:46', '2022-05-17 01:38:46'),
(26, 'trader', 15, 'customer', 16, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:40:42', '2022-05-17 01:40:42'),
(27, 'trader', 15, 'provider', 15, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:41:04', '2022-05-17 01:41:04'),
(28, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-17 01:44:04', '2022-05-17 01:44:04'),
(29, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 06:23:24', '2022-05-18 06:23:24'),
(30, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 06:23:40', '2022-05-18 06:23:40'),
(31, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:03:48', '2022-05-18 08:03:48'),
(32, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:05:10', '2022-05-18 08:05:10'),
(33, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:05:27', '2022-05-18 08:05:27'),
(34, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:06:06', '2022-05-18 08:06:06'),
(35, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:06:45', '2022-05-18 08:06:45'),
(36, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:08:36', '2022-05-18 08:08:36'),
(37, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:09:42', '2022-05-18 08:09:42'),
(38, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:10:24', '2022-05-18 08:10:24'),
(39, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:10:57', '2022-05-18 08:10:57'),
(40, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:11:23', '2022-05-18 08:11:23'),
(41, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:12:36', '2022-05-18 08:12:36'),
(42, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:14:35', '2022-05-18 08:14:35'),
(43, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 08:14:42', '2022-05-18 08:14:42'),
(44, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:29:39', '2022-05-18 22:29:39'),
(45, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:29:59', '2022-05-18 22:29:59'),
(46, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:35:26', '2022-05-18 22:35:26'),
(47, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:36:06', '2022-05-18 22:36:06'),
(48, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:36:15', '2022-05-18 22:36:15'),
(49, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:38:03', '2022-05-18 22:38:03'),
(50, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:38:14', '2022-05-18 22:38:14'),
(51, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:40:15', '2022-05-18 22:40:15'),
(52, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:40:26', '2022-05-18 22:40:26'),
(53, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:41:39', '2022-05-18 22:41:39'),
(54, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:42:09', '2022-05-18 22:42:09'),
(55, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:43:51', '2022-05-18 22:43:51'),
(56, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:44:01', '2022-05-18 22:44:01'),
(57, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:44:10', '2022-05-18 22:44:10'),
(58, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:46:12', '2022-05-18 22:46:12'),
(59, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 22:46:42', '2022-05-18 22:46:42'),
(60, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-18 23:34:13', '2022-05-18 23:34:13'),
(61, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-19 00:55:52', '2022-05-19 00:55:52'),
(62, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-19 02:05:55', '2022-05-19 02:05:55'),
(63, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-19 03:52:19', '2022-05-19 03:52:19'),
(64, 'trader', 15, 'customer', 16, 'requested a job quote.', 'http://www.unotraders.local.com/trader/jobs-quote-requests', 0, '2022-05-19 04:15:19', '2022-05-19 04:15:19'),
(65, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-05-19 04:16:13', '2022-05-19 04:16:13'),
(66, 'trader', 15, 'customer', 16, 'added more details for the job.', 'http://www.unotraders.local.com/trader/jobs-quote-requests', 0, '2022-05-19 04:16:53', '2022-05-19 04:16:53'),
(67, 'trader', 11, 'customer', 16, 'requested a job quote.', 'http://www.unotraders.local.com/trader/jobs-quote-requests', 0, '2022-05-19 04:33:11', '2022-05-19 04:33:11'),
(68, 'customer', 16, 'provider', 15, 'requested a job quote.', 'http://www.unotraders.local.com/customer/profile', 0, '2022-05-19 04:38:02', '2022-05-19 04:38:02'),
(69, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-19 06:47:12', '2022-05-19 06:47:12'),
(70, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-19 06:47:19', '2022-05-19 06:47:19'),
(71, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-23 05:14:00', '2022-05-23 05:14:00'),
(72, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-23 05:14:11', '2022-05-23 05:14:11'),
(73, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-23 05:14:31', '2022-05-23 05:14:31'),
(74, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-23 05:14:44', '2022-05-23 05:14:44'),
(75, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:24:06', '2022-05-24 00:24:06'),
(76, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:32:17', '2022-05-24 00:32:17'),
(77, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:33:44', '2022-05-24 00:33:44'),
(78, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:38:32', '2022-05-24 00:38:32'),
(79, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:39:23', '2022-05-24 00:39:23'),
(80, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:39:28', '2022-05-24 00:39:28'),
(81, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:41:09', '2022-05-24 00:41:09'),
(82, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:41:46', '2022-05-24 00:41:46'),
(83, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:42:07', '2022-05-24 00:42:07'),
(84, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:42:24', '2022-05-24 00:42:24'),
(85, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:42:56', '2022-05-24 00:42:56'),
(86, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:43:10', '2022-05-24 00:43:10'),
(87, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:43:45', '2022-05-24 00:43:45'),
(88, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:44:07', '2022-05-24 00:44:07'),
(89, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:46:00', '2022-05-24 00:46:00'),
(90, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:47:27', '2022-05-24 00:47:27'),
(91, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:48:34', '2022-05-24 00:48:34'),
(92, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:49:20', '2022-05-24 00:49:20'),
(93, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:49:45', '2022-05-24 00:49:45'),
(94, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:50:36', '2022-05-24 00:50:36'),
(95, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:50:57', '2022-05-24 00:50:57'),
(96, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-24 00:51:16', '2022-05-24 00:51:16'),
(97, 'trader', 15, 'provider', 15, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 01:42:07', '2022-05-26 01:42:07'),
(98, 'trader', 15, 'provider', 15, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 01:43:09', '2022-05-26 01:43:09'),
(99, 'trader', 15, 'provider', 15, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 01:47:39', '2022-05-26 01:47:39'),
(100, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 03:27:41', '2022-05-26 03:27:41'),
(101, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 03:29:09', '2022-05-26 03:29:09'),
(102, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:36:59', '2022-05-26 06:36:59'),
(103, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:37:20', '2022-05-26 06:37:20'),
(104, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:48:11', '2022-05-26 06:48:11'),
(105, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:48:26', '2022-05-26 06:48:26'),
(106, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:50:21', '2022-05-26 06:50:21'),
(107, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:50:56', '2022-05-26 06:50:56'),
(108, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:51:13', '2022-05-26 06:51:13'),
(109, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:51:57', '2022-05-26 06:51:57'),
(110, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:52:44', '2022-05-26 06:52:44'),
(111, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:54:03', '2022-05-26 06:54:03'),
(112, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:55:37', '2022-05-26 06:55:37'),
(113, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:55:49', '2022-05-26 06:55:49'),
(114, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:56:37', '2022-05-26 06:56:37'),
(115, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:57:29', '2022-05-26 06:57:29'),
(116, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 06:57:35', '2022-05-26 06:57:35'),
(117, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 07:00:35', '2022-05-26 07:00:35'),
(118, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 07:01:26', '2022-05-26 07:01:26'),
(119, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 07:01:38', '2022-05-26 07:01:38'),
(120, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 07:08:56', '2022-05-26 07:08:56'),
(121, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 07:09:04', '2022-05-26 07:09:04'),
(122, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 07:09:07', '2022-05-26 07:09:07'),
(123, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 10:57:27', '2022-05-26 10:57:27'),
(124, 'trader', 15, 'provider', 15, 'made a comment on your review.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 10:57:49', '2022-05-26 10:57:49'),
(125, 'trader', 6, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/6', 0, '2022-05-26 11:14:58', '2022-05-26 11:14:58'),
(126, 'trader', 6, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/6', 0, '2022-05-26 11:15:06', '2022-05-26 11:15:06'),
(127, 'trader', 6, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/6', 0, '2022-05-26 11:15:45', '2022-05-26 11:15:45'),
(128, 'trader', 6, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/6', 0, '2022-05-26 11:16:07', '2022-05-26 11:16:07'),
(129, 'trader', 6, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/6', 0, '2022-05-26 11:19:05', '2022-05-26 11:19:05'),
(130, 'trader', 6, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/6', 0, '2022-05-26 11:19:12', '2022-05-26 11:19:12'),
(131, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 11:25:21', '2022-05-26 11:25:21'),
(132, 'trader', 15, 'customer', 16, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 11:31:10', '2022-05-26 11:31:10'),
(133, 'trader', 15, 'customer', 16, 'commented on your offer.', 'http://www.unotraders.local.com/trader/details/15', 0, '2022-05-26 11:31:21', '2022-05-26 11:31:21'),
(134, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:28:33', '2022-05-26 12:28:33'),
(135, 'customer', 16, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:30:57', '2022-05-26 12:30:57'),
(136, 'customer', 16, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:31:01', '2022-05-26 12:31:01'),
(137, 'customer', 16, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:31:13', '2022-05-26 12:31:13'),
(138, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:31:36', '2022-05-26 12:31:36'),
(139, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:32:28', '2022-05-26 12:32:28'),
(140, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:34:03', '2022-05-26 12:34:03'),
(141, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:34:47', '2022-05-26 12:34:47'),
(142, 'trader', 15, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:35:20', '2022-05-26 12:35:20'),
(143, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:35:23', '2022-05-26 12:35:23'),
(144, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:37:31', '2022-05-26 12:37:31'),
(145, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:38:20', '2022-05-26 12:38:20'),
(146, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:38:48', '2022-05-26 12:38:48'),
(147, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:39:43', '2022-05-26 12:39:43'),
(148, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:41:03', '2022-05-26 12:41:03'),
(149, 'trader', 15, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:41:09', '2022-05-26 12:41:09'),
(150, 'trader', 15, 'customer', 16, 'commented on your post.', 'http://www.unotraders.local.com/diy-help', 0, '2022-05-26 12:41:14', '2022-05-26 12:41:14'),
(151, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/15', 0, '2022-05-27 01:54:19', '2022-05-27 01:54:19'),
(152, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/sonymangottil', 0, '2022-05-27 01:59:33', '2022-05-27 01:59:33'),
(153, 'trader', 15, 'provider', 15, 'replied to your comment.', 'http://www.unotraders.local.com/trader/profile/sonymangottil', 0, '2022-05-27 04:07:28', '2022-05-27 04:07:28'),
(154, 'trader', 15, 'provider', 15, 'commented on your post.', 'http://www.unotraders.local.com/trader/profile/sonymangottil', 0, '2022-05-27 04:07:33', '2022-05-27 04:07:33'),
(155, 'customer', 16, 'provider', 15, 'requested a job quote.', 'http://www.unotraders.local.com/customer/profile', 0, '2022-05-31 03:14:34', '2022-05-31 03:14:34'),
(156, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-05-31 04:22:22', '2022-05-31 04:22:22'),
(157, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-05-31 04:55:59', '2022-05-31 04:55:59'),
(158, 'trader', 15, 'customer', 16, 'requested a job quote.', 'http://www.unotraders.local.com/trader/jobs-quote-requests', 0, '2022-05-31 04:57:23', '2022-05-31 04:57:23'),
(159, 'customer', 16, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/jobs/details/26', 0, '2022-05-31 07:17:26', '2022-05-31 07:17:26'),
(160, 'customer', 16, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/jobs/details/26', 0, '2022-05-31 07:18:00', '2022-05-31 07:18:00'),
(161, 'customer', 16, 'provider', 15, 'provided a quote for your job.', 'http://www.unotraders.local.com/jobs/details/22', 0, '2022-06-06 09:46:02', '2022-06-06 09:46:02'),
(162, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-06-06 09:47:41', '2022-06-06 09:47:41'),
(163, 'customer', 16, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/jobs/details/24', 0, '2022-06-06 09:48:40', '2022-06-06 09:48:40'),
(164, 'trader', 15, 'customer', 16, 'rejected your job quote request', 'http://www.unotraders.local.com/jobs/details/24', 0, '2022-06-06 09:49:10', '2022-06-06 09:49:10'),
(165, 'trader', 15, 'customer', 16, 'accepted your job quote request', 'http://www.unotraders.local.com/jobs/details/24', 0, '2022-06-06 09:49:59', '2022-06-06 09:49:59'),
(166, 'trader', 15, 'customer', 16, 'requested a job quote.', 'http://www.unotraders.local.com/trader/jobs-quote-requests', 0, '2022-06-09 09:15:11', '2022-06-09 09:15:11'),
(167, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-06-09 09:15:56', '2022-06-09 09:15:56'),
(168, 'customer', 15, 'provider', 15, 'replied to your comment.', 'http://www.unotraders.local.com/jobs/details/28', 0, '2022-06-09 09:16:18', '2022-06-09 09:16:18'),
(169, 'customer', 16, 'customer', 16, 'replied to your comment.', 'http://www.unotraders.local.com/jobs/details/28', 0, '2022-06-09 09:16:43', '2022-06-09 09:16:43'),
(170, 'trader', 11, 'customer', 16, 'requested a job quote.', 'http://www.unotraders.local.com/trader/jobs-quote-requests', 0, '2022-06-09 09:17:14', '2022-06-09 09:17:14'),
(171, 'trader', 15, 'customer', 16, 'accepted your job quote request', 'http://www.unotraders.local.com/jobs/details/28', 0, '2022-06-09 09:23:11', '2022-06-09 09:23:11'),
(172, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-06-10 07:11:12', '2022-06-10 07:11:12'),
(173, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-06-13 08:53:53', '2022-06-13 08:53:53'),
(174, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-06-13 09:34:22', '2022-06-13 09:34:22'),
(175, 'customer', 16, 'provider', 15, 'requested more details for the job.', 'http://www.unotraders.local.com/customer/clarification-requests', 0, '2022-06-13 09:35:16', '2022-06-13 09:35:16'),
(176, 'trader', 14, 'customer', 16, 'rejected your job quote request', 'http://www.unotraders.local.com/jobs/details/27', 0, '2022-06-13 10:14:35', '2022-06-13 10:14:35'),
(177, 'trader', 15, 'customer', 16, 'rejected your job quote request', 'http://www.unotraders.local.com/jobs/details/27', 0, '2022-06-13 10:16:14', '2022-06-13 10:16:14'),
(178, 'trader', 15, 'customer', 16, 'accepted your job quote request', 'http://www.unotraders.local.com/jobs/details/27', 0, '2022-06-13 10:16:14', '2022-06-13 10:16:14'),
(179, 'trader', 15, 'customer', 16, 'rejected your job quote request', 'http://www.unotraders.local.com/jobs/details/27', 0, '2022-06-13 10:30:33', '2022-06-13 10:30:33'),
(180, 'trader', 15, 'customer', 16, 'accepted your job quote request', 'http://www.unotraders.local.com/jobs/details/27', 0, '2022-06-13 10:30:33', '2022-06-13 10:30:33'),
(181, 'trader', 15, 'customer', 16, 'rejected your job quote request', 'http://www.unotraders.local.com/jobs/details/27', 0, '2022-06-13 10:34:27', '2022-06-13 10:34:27'),
(182, 'trader', 15, 'customer', 16, 'accepted your job quote request', 'http://www.unotraders.local.com/jobs/details/27', 0, '2022-06-13 10:34:27', '2022-06-13 10:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_limit` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `description`, `price`, `price_type`, `package_limit`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Bronze', '<ul><li>10 jobs per month</li><li>unlimited enquiries</li><li>unlimited messages</li><li>live chat</li><li>24/7 support</li></ul>', '100', 'Monthly', 10, 1, '2022-02-28 06:01:03', '2022-02-28 06:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page`, `title`, `contents`, `image`, `banner_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'about-us', 'ABOUT UNO TRADERS', '<h6 style=\"margin: 10px 0px; padding: 0px; font-family: Poppins, sans-serif; font-weight: 700; line-height: 44px; color: rgb(35, 31, 32); font-size: 36px; text-transform: capitalize; background-color: rgb(246, 246, 246);\">We Work With You To Address Your Most Critical Business Priorities</h6><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 22px; text-align: justify; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\"></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 22px; text-align: justify; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">Consulto Specially Designed For Consulting And Finance Industry, Financial Advisors, Accountants, Consultants Or Other Finance And Consulting Related Businesses.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 22px; text-align: justify; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusm tmpor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat adipisicing elit,</p>', '', '', 1, '2021-04-19 02:21:41', '2021-04-19 03:39:54'),
(2, 'mission', 'Our Mission', '<span style=\"color: rgb(51, 51, 51); font-family: Poppins, sans-serif; text-align: justify;\">Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', '', '', 1, '2021-04-19 02:32:54', '2021-04-19 03:25:07'),
(3, 'vision', 'Our Vision', '<span style=\"color: rgb(51, 51, 51); font-family: Poppins, sans-serif; text-align: justify;\">Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', '', '', 1, '2021-04-19 03:25:24', '2021-04-19 03:25:24'),
(4, 'privacy-policy', 'Privacy Policy', '<p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 23px; text-align: justify; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h5 style=\"margin: 20px 0px 10px; padding: 0px; font-family: Poppins, sans-serif; font-weight: 700; line-height: 1.1; color: rgb(35, 31, 32); font-size: 20px; text-transform: capitalize; background-color: rgb(246, 246, 246);\">Where Can I Get Some?</h5><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 15px; list-style: decimal; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\"><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li></ul><h5 style=\"margin: 20px 0px 10px; padding: 0px; font-family: Poppins, sans-serif; font-weight: 700; line-height: 1.1; color: rgb(35, 31, 32); font-size: 20px; text-transform: capitalize; background-color: rgb(246, 246, 246);\">The Standard Lorem Ipsum Passage, Used Since The 1500s</h5><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 23px; text-align: justify; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', '', '', 1, '2021-04-19 03:25:51', '2021-04-19 03:42:26'),
(5, 'terms-and-conditions', 'Terms & Conditions', '<p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 23px; text-align: justify; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h5 style=\"margin: 20px 0px 10px; padding: 0px; font-family: Poppins, sans-serif; font-weight: 700; line-height: 1.1; color: rgb(35, 31, 32); font-size: 20px; text-transform: capitalize; background-color: rgb(246, 246, 246);\">Where Can I Get Some?</h5><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 15px; list-style: decimal; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\"><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li style=\"margin: 0px; padding: 5px 0px; width: 1125px; position: relative; line-height: 25px; border-bottom: none;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li></ul><h5 style=\"margin: 20px 0px 10px; padding: 0px; font-family: Poppins, sans-serif; font-weight: 700; line-height: 1.1; color: rgb(35, 31, 32); font-size: 20px; text-transform: capitalize; background-color: rgb(246, 246, 246);\">The Standard Lorem Ipsum Passage, Used Since The 1500s</h5><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 23px; text-align: justify; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', '', '', 1, '2021-04-19 03:26:12', '2021-04-19 03:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_wishlist`
--

CREATE TABLE `products_wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shortlist` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_visits`
--

CREATE TABLE `profile_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `contacted` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_visits`
--

INSERT INTO `profile_visits` (`id`, `user_type`, `user_id`, `trader_id`, `contacted`, `created_at`, `updated_at`) VALUES
(1, 'customer', 16, 15, 0, '2021-12-06 11:35:05', '2021-12-06 11:35:05'),
(2, 'customer', 16, 15, 1, '2021-12-06 11:41:45', '2021-12-06 11:41:45'),
(3, 'customer', 16, 15, 0, '2021-12-08 03:43:36', '2021-12-08 03:43:36'),
(4, 'customer', 16, 15, 0, '2021-12-08 03:43:54', '2021-12-08 03:43:54'),
(5, 'customer', 16, 15, 0, '2021-12-08 03:45:28', '2021-12-08 03:45:28'),
(6, 'customer', 16, 15, 0, '2021-12-08 03:45:41', '2021-12-08 03:45:41'),
(7, 'customer', 16, 15, 0, '2021-12-08 03:48:13', '2021-12-08 03:48:13'),
(8, 'customer', 16, 15, 0, '2021-12-08 03:49:13', '2021-12-08 03:49:13'),
(9, 'customer', 16, 15, 0, '2021-12-08 03:49:19', '2021-12-08 03:49:19'),
(10, 'customer', 16, 15, 0, '2021-12-08 03:49:55', '2021-12-08 03:49:55'),
(11, 'customer', 16, 15, 0, '2021-12-08 03:50:00', '2021-12-08 03:50:00'),
(12, 'customer', 16, 15, 0, '2021-12-08 03:52:10', '2021-12-08 03:52:10'),
(13, 'customer', 16, 15, 0, '2021-12-08 03:55:13', '2021-12-08 03:55:13'),
(14, 'customer', 16, 15, 0, '2021-12-08 03:57:28', '2021-12-08 03:57:28'),
(15, 'customer', 16, 15, 0, '2021-12-08 03:57:41', '2021-12-08 03:57:41'),
(16, 'customer', 16, 15, 0, '2021-12-08 03:58:47', '2021-12-08 03:58:47'),
(17, 'customer', 16, 15, 0, '2021-12-08 03:59:29', '2021-12-08 03:59:29'),
(18, 'customer', 16, 15, 0, '2021-12-08 04:00:24', '2021-12-08 04:00:24'),
(19, 'customer', 16, 15, 0, '2021-12-08 04:00:50', '2021-12-08 04:00:50'),
(20, 'customer', 16, 15, 0, '2021-12-08 04:01:26', '2021-12-08 04:01:26'),
(21, 'customer', 16, 15, 0, '2021-12-08 04:01:44', '2021-12-08 04:01:44'),
(22, 'customer', 16, 15, 0, '2021-12-08 04:02:20', '2021-12-08 04:02:20'),
(23, 'customer', 16, 15, 0, '2021-12-08 04:03:29', '2021-12-08 04:03:29'),
(24, 'customer', 16, 15, 0, '2021-12-08 04:03:50', '2021-12-08 04:03:50'),
(25, 'customer', 16, 15, 0, '2021-12-08 04:05:02', '2021-12-08 04:05:02'),
(26, 'customer', 16, 15, 0, '2021-12-08 04:05:17', '2021-12-08 04:05:17'),
(27, 'customer', 16, 15, 0, '2021-12-08 04:05:26', '2021-12-08 04:05:26'),
(28, 'customer', 16, 15, 0, '2021-12-08 04:05:43', '2021-12-08 04:05:43'),
(29, 'customer', 16, 15, 0, '2021-12-08 04:06:47', '2021-12-08 04:06:47'),
(30, 'customer', 16, 15, 0, '2021-12-08 04:41:33', '2021-12-08 04:41:33'),
(31, 'customer', 16, 15, 0, '2021-12-08 04:42:41', '2021-12-08 04:42:41'),
(32, 'customer', 16, 15, 0, '2021-12-08 04:43:29', '2021-12-08 04:43:29'),
(33, 'customer', 16, 15, 0, '2021-12-08 04:50:00', '2021-12-08 04:50:00'),
(34, 'customer', 16, 15, 0, '2021-12-08 04:54:04', '2021-12-08 04:54:04'),
(35, 'customer', 16, 15, 0, '2021-12-08 04:54:27', '2021-12-08 04:54:27'),
(36, 'customer', 16, 15, 0, '2021-12-08 04:55:09', '2021-12-08 04:55:09'),
(37, 'customer', 16, 15, 0, '2021-12-08 04:55:43', '2021-12-08 04:55:43'),
(38, 'customer', 16, 15, 0, '2021-12-08 04:56:01', '2021-12-08 04:56:01'),
(39, 'customer', 16, 15, 0, '2021-12-08 04:56:30', '2021-12-08 04:56:30'),
(40, 'customer', 16, 15, 0, '2021-12-08 04:56:40', '2021-12-08 04:56:40'),
(41, 'customer', 16, 15, 0, '2021-12-08 04:56:45', '2021-12-08 04:56:45'),
(42, 'customer', 16, 15, 0, '2021-12-08 04:56:50', '2021-12-08 04:56:50'),
(43, 'customer', 16, 15, 0, '2021-12-14 23:36:10', '2021-12-14 23:36:10'),
(44, 'customer', 16, 15, 1, '2021-12-14 23:36:16', '2021-12-14 23:36:16'),
(45, 'customer', 16, 15, 0, '2021-12-14 23:36:27', '2021-12-14 23:36:27'),
(46, 'provider', 14, 15, 1, '2021-12-14 23:45:49', '2021-12-14 23:45:49'),
(47, 'customer', 16, 15, 0, '2021-12-14 23:48:35', '2021-12-14 23:48:35'),
(48, 'customer', 16, 15, 0, '2021-12-14 23:48:36', '2021-12-14 23:48:36'),
(49, 'customer', 16, 15, 0, '2021-12-14 23:49:42', '2021-12-14 23:49:42'),
(50, 'provider', 15, 15, 0, '2021-12-14 23:50:06', '2021-12-14 23:50:06'),
(51, 'provider', 15, 15, 0, '2021-12-15 00:08:03', '2021-12-15 00:08:03'),
(52, 'provider', 15, 15, 0, '2021-12-15 00:08:03', '2021-12-15 00:08:03'),
(53, 'provider', 15, 15, 1, '2021-12-15 00:08:45', '2021-12-15 00:08:45'),
(54, 'provider', 15, 15, 0, '2021-12-15 00:12:58', '2021-12-15 00:12:58'),
(55, 'provider', 15, 15, 0, '2021-12-15 00:13:03', '2021-12-15 00:13:03'),
(56, 'provider', 14, 15, 0, '2021-12-15 00:13:11', '2021-12-15 00:13:11'),
(57, 'customer', 16, 15, 0, '2021-12-15 00:13:34', '2021-12-15 00:13:34'),
(58, 'customer', 16, 15, 0, '2021-12-15 00:13:43', '2021-12-15 00:13:43'),
(59, 'customer', 16, 15, 1, '2021-12-15 00:13:46', '2021-12-15 00:13:46'),
(60, 'provider', 15, 15, 0, '2021-12-15 00:14:03', '2021-12-15 00:14:03'),
(61, 'provider', 15, 15, 0, '2021-12-15 00:15:56', '2021-12-15 00:15:56'),
(62, 'provider', 15, 15, 0, '2021-12-15 00:16:22', '2021-12-15 00:16:22'),
(63, 'provider', 15, 15, 0, '2021-12-15 00:49:03', '2021-12-15 00:49:03'),
(64, 'provider', 15, 15, 0, '2021-12-15 00:57:26', '2021-12-15 00:57:26'),
(65, 'provider', 15, 15, 0, '2021-12-15 01:02:24', '2021-12-15 01:02:24'),
(66, 'provider', 15, 15, 0, '2021-12-15 01:03:00', '2021-12-15 01:03:00'),
(67, 'provider', 15, 15, 0, '2021-12-15 01:03:56', '2021-12-15 01:03:56'),
(68, 'provider', 15, 15, 0, '2021-12-15 01:05:44', '2021-12-15 01:05:44'),
(69, 'provider', 15, 15, 0, '2021-12-15 01:09:13', '2021-12-15 01:09:13'),
(70, 'provider', 15, 15, 0, '2021-12-15 01:10:07', '2021-12-15 01:10:07'),
(71, 'provider', 15, 15, 0, '2021-12-15 01:10:22', '2021-12-15 01:10:22'),
(72, 'provider', 15, 15, 0, '2021-12-15 01:10:37', '2021-12-15 01:10:37'),
(73, 'provider', 15, 15, 0, '2021-12-15 01:11:12', '2021-12-15 01:11:12'),
(74, 'provider', 15, 15, 0, '2021-12-15 01:11:42', '2021-12-15 01:11:42'),
(75, 'customer', 16, 15, 1, '2021-12-20 22:04:22', '2021-12-20 22:04:22'),
(76, 'customer', 16, 11, 1, '2021-12-20 22:06:11', '2021-12-20 22:06:11'),
(77, 'customer', 16, 15, 0, '2022-01-14 04:29:57', '2022-01-14 04:29:57'),
(78, 'customer', 16, 15, 0, '2022-01-14 04:31:02', '2022-01-14 04:31:02'),
(79, 'customer', 16, 15, 0, '2022-01-14 04:31:43', '2022-01-14 04:31:43'),
(80, 'customer', 16, 15, 0, '2022-01-14 04:32:01', '2022-01-14 04:32:01'),
(81, 'customer', 16, 15, 0, '2022-01-14 04:32:08', '2022-01-14 04:32:08'),
(82, 'customer', 16, 15, 0, '2022-01-14 04:32:30', '2022-01-14 04:32:30'),
(83, 'customer', 16, 15, 0, '2022-01-14 04:33:03', '2022-01-14 04:33:03'),
(84, 'customer', 16, 15, 0, '2022-01-14 04:34:30', '2022-01-14 04:34:30'),
(85, 'customer', 16, 15, 0, '2022-01-14 05:15:18', '2022-01-14 05:15:18'),
(86, 'customer', 16, 15, 0, '2022-01-14 05:17:27', '2022-01-14 05:17:27'),
(87, 'customer', 16, 15, 0, '2022-01-14 05:21:23', '2022-01-14 05:21:23'),
(88, 'customer', 16, 15, 0, '2022-01-14 05:23:39', '2022-01-14 05:23:39'),
(89, 'customer', 16, 15, 0, '2022-01-14 05:23:43', '2022-01-14 05:23:43'),
(90, 'customer', 16, 15, 0, '2022-01-14 05:53:33', '2022-01-14 05:53:33'),
(91, 'customer', 16, 15, 0, '2022-01-14 05:54:20', '2022-01-14 05:54:20'),
(92, 'customer', 16, 15, 0, '2022-01-14 06:03:41', '2022-01-14 06:03:41'),
(93, 'customer', 16, 15, 0, '2022-01-14 06:03:51', '2022-01-14 06:03:51'),
(94, 'customer', 16, 15, 0, '2022-01-14 06:04:05', '2022-01-14 06:04:05'),
(95, 'customer', 16, 15, 0, '2022-01-16 22:28:14', '2022-01-16 22:28:14'),
(96, 'provider', 15, 15, 0, '2022-01-17 01:18:16', '2022-01-17 01:18:16'),
(97, 'provider', 15, 15, 0, '2022-01-17 01:18:43', '2022-01-17 01:18:43'),
(98, 'customer', 16, 15, 0, '2022-01-17 12:16:35', '2022-01-17 12:16:35'),
(99, 'customer', 16, 15, 0, '2022-01-17 12:16:52', '2022-01-17 12:16:52'),
(100, 'customer', 16, 15, 0, '2022-01-17 12:40:35', '2022-01-17 12:40:35'),
(101, 'customer', 16, 15, 0, '2022-01-17 13:00:51', '2022-01-17 13:00:51'),
(102, 'customer', 16, 15, 0, '2022-01-17 22:35:19', '2022-01-17 22:35:19'),
(103, 'provider', 15, 15, 0, '2022-01-17 22:35:48', '2022-01-17 22:35:48'),
(104, 'provider', 15, 15, 0, '2022-01-17 22:36:18', '2022-01-17 22:36:18'),
(105, 'provider', 15, 15, 0, '2022-01-17 22:38:38', '2022-01-17 22:38:38'),
(106, 'provider', 15, 15, 0, '2022-01-17 22:39:53', '2022-01-17 22:39:53'),
(107, 'provider', 15, 15, 0, '2022-01-17 22:40:04', '2022-01-17 22:40:04'),
(108, 'provider', 15, 15, 0, '2022-01-17 22:41:23', '2022-01-17 22:41:23'),
(109, 'provider', 15, 15, 0, '2022-01-17 22:41:55', '2022-01-17 22:41:55'),
(110, 'provider', 15, 15, 0, '2022-01-17 22:42:42', '2022-01-17 22:42:42'),
(111, 'customer', 16, 15, 0, '2022-01-17 23:36:45', '2022-01-17 23:36:45'),
(112, 'customer', 16, 15, 0, '2022-01-17 23:55:23', '2022-01-17 23:55:23'),
(113, 'provider', 15, 15, 0, '2022-01-19 06:26:48', '2022-01-19 06:26:48'),
(114, 'provider', 15, 15, 0, '2022-01-19 06:31:01', '2022-01-19 06:31:01'),
(115, 'provider', 15, 15, 0, '2022-01-19 06:32:28', '2022-01-19 06:32:28'),
(116, 'provider', 15, 15, 0, '2022-01-19 06:32:50', '2022-01-19 06:32:50'),
(117, 'provider', 15, 15, 0, '2022-01-19 06:33:03', '2022-01-19 06:33:03'),
(118, 'provider', 15, 15, 0, '2022-01-19 06:43:10', '2022-01-19 06:43:10'),
(119, 'provider', 15, 15, 0, '2022-01-19 06:43:28', '2022-01-19 06:43:28'),
(120, 'provider', 15, 15, 0, '2022-01-19 06:44:16', '2022-01-19 06:44:16'),
(121, 'provider', 15, 15, 0, '2022-01-19 06:45:26', '2022-01-19 06:45:26'),
(122, 'provider', 15, 15, 0, '2022-01-19 06:45:48', '2022-01-19 06:45:48'),
(123, 'provider', 15, 15, 0, '2022-01-19 06:46:10', '2022-01-19 06:46:10'),
(124, 'provider', 15, 15, 0, '2022-01-19 06:47:59', '2022-01-19 06:47:59'),
(125, 'provider', 15, 15, 0, '2022-01-19 06:48:35', '2022-01-19 06:48:35'),
(126, 'provider', 15, 15, 0, '2022-01-19 06:49:49', '2022-01-19 06:49:49'),
(127, 'provider', 15, 15, 0, '2022-01-19 06:50:40', '2022-01-19 06:50:40'),
(128, 'provider', 15, 15, 0, '2022-01-19 06:50:49', '2022-01-19 06:50:49'),
(129, 'provider', 15, 15, 0, '2022-01-19 06:51:05', '2022-01-19 06:51:05'),
(130, 'provider', 15, 15, 0, '2022-01-19 06:53:05', '2022-01-19 06:53:05'),
(131, 'provider', 15, 15, 0, '2022-01-19 06:53:19', '2022-01-19 06:53:19'),
(132, 'provider', 15, 15, 0, '2022-01-19 06:53:53', '2022-01-19 06:53:53'),
(133, 'provider', 15, 15, 0, '2022-01-19 06:54:46', '2022-01-19 06:54:46'),
(134, 'provider', 15, 15, 0, '2022-01-19 06:54:54', '2022-01-19 06:54:54'),
(135, 'provider', 15, 15, 0, '2022-01-19 06:55:03', '2022-01-19 06:55:03'),
(136, 'provider', 15, 15, 0, '2022-01-19 06:55:38', '2022-01-19 06:55:38'),
(137, 'provider', 15, 15, 0, '2022-01-19 06:56:05', '2022-01-19 06:56:05'),
(138, 'provider', 15, 15, 0, '2022-01-19 06:56:37', '2022-01-19 06:56:37'),
(139, 'provider', 15, 15, 0, '2022-01-19 06:56:49', '2022-01-19 06:56:49'),
(140, 'provider', 15, 15, 0, '2022-01-19 06:56:56', '2022-01-19 06:56:56'),
(141, 'provider', 15, 15, 0, '2022-01-19 06:57:04', '2022-01-19 06:57:04'),
(142, 'provider', 15, 15, 0, '2022-01-19 06:59:16', '2022-01-19 06:59:16'),
(143, 'provider', 15, 15, 0, '2022-01-19 06:59:32', '2022-01-19 06:59:32'),
(144, 'provider', 15, 15, 0, '2022-01-19 06:59:43', '2022-01-19 06:59:43'),
(145, 'provider', 15, 15, 0, '2022-01-19 07:07:00', '2022-01-19 07:07:00'),
(146, 'provider', 15, 15, 0, '2022-01-19 07:07:27', '2022-01-19 07:07:27'),
(147, 'provider', 15, 15, 0, '2022-01-19 07:07:48', '2022-01-19 07:07:48'),
(148, 'provider', 15, 15, 0, '2022-01-19 07:11:56', '2022-01-19 07:11:56'),
(149, 'provider', 15, 15, 0, '2022-01-19 07:12:09', '2022-01-19 07:12:09'),
(150, 'provider', 15, 15, 0, '2022-01-19 07:13:30', '2022-01-19 07:13:30'),
(151, 'provider', 15, 15, 0, '2022-01-19 07:13:36', '2022-01-19 07:13:36'),
(152, 'provider', 15, 15, 0, '2022-01-20 03:09:43', '2022-01-20 03:09:43'),
(153, 'provider', 15, 15, 0, '2022-01-20 03:12:46', '2022-01-20 03:12:46'),
(154, 'provider', 15, 15, 0, '2022-02-04 01:23:18', '2022-02-04 01:23:18'),
(155, 'provider', 15, 15, 0, '2022-02-04 01:24:23', '2022-02-04 01:24:23'),
(156, 'provider', 15, 15, 0, '2022-02-04 01:24:41', '2022-02-04 01:24:41'),
(157, 'provider', 15, 15, 0, '2022-02-04 01:25:08', '2022-02-04 01:25:08'),
(158, 'provider', 15, 15, 0, '2022-02-04 01:25:17', '2022-02-04 01:25:17'),
(159, 'provider', 15, 15, 0, '2022-02-04 01:27:28', '2022-02-04 01:27:28'),
(160, 'provider', 15, 15, 0, '2022-02-06 23:15:50', '2022-02-06 23:15:50'),
(161, 'provider', 15, 15, 0, '2022-02-07 01:02:06', '2022-02-07 01:02:06'),
(162, 'customer', 16, 15, 0, '2022-02-07 03:34:27', '2022-02-07 03:34:27'),
(163, 'customer', 16, 15, 0, '2022-02-07 03:34:49', '2022-02-07 03:34:49'),
(164, 'customer', 16, 15, 0, '2022-02-07 03:37:25', '2022-02-07 03:37:25'),
(165, 'customer', 16, 15, 0, '2022-02-07 03:37:38', '2022-02-07 03:37:38'),
(166, 'customer', 16, 15, 0, '2022-02-07 03:37:56', '2022-02-07 03:37:56'),
(167, 'customer', 16, 15, 0, '2022-02-08 22:40:10', '2022-02-08 22:40:10'),
(168, 'customer', 16, 15, 0, '2022-02-14 05:56:49', '2022-02-14 05:56:49'),
(169, 'provider', 15, 15, 0, '2022-02-22 05:05:30', '2022-02-22 05:05:30'),
(170, 'provider', 15, 15, 0, '2022-02-22 05:36:05', '2022-02-22 05:36:05'),
(171, 'provider', 15, 15, 0, '2022-02-22 05:36:10', '2022-02-22 05:36:10'),
(172, 'provider', 15, 15, 0, '2022-02-22 05:36:50', '2022-02-22 05:36:50'),
(173, 'provider', 15, 15, 0, '2022-02-22 05:39:07', '2022-02-22 05:39:07'),
(174, 'provider', 15, 15, 0, '2022-02-22 05:40:58', '2022-02-22 05:40:58'),
(175, 'provider', 15, 15, 0, '2022-02-22 05:42:23', '2022-02-22 05:42:23'),
(176, 'provider', 15, 15, 0, '2022-02-22 05:42:28', '2022-02-22 05:42:28'),
(177, 'provider', 15, 15, 0, '2022-02-22 05:43:06', '2022-02-22 05:43:06'),
(178, 'provider', 15, 15, 0, '2022-02-22 05:44:15', '2022-02-22 05:44:15'),
(179, 'provider', 15, 15, 0, '2022-02-23 06:48:54', '2022-02-23 06:48:54'),
(180, 'provider', 15, 15, 0, '2022-02-23 06:51:42', '2022-02-23 06:51:42'),
(181, 'provider', 15, 15, 0, '2022-02-23 06:56:19', '2022-02-23 06:56:19'),
(182, 'provider', 15, 15, 0, '2022-02-23 07:00:18', '2022-02-23 07:00:18'),
(183, 'provider', 15, 15, 0, '2022-02-23 07:01:37', '2022-02-23 07:01:37'),
(184, 'provider', 15, 15, 0, '2022-02-23 07:03:34', '2022-02-23 07:03:34'),
(185, 'provider', 15, 15, 0, '2022-02-23 07:06:37', '2022-02-23 07:06:37'),
(186, 'provider', 15, 15, 0, '2022-02-23 07:07:02', '2022-02-23 07:07:02'),
(187, 'provider', 15, 15, 0, '2022-02-23 07:08:28', '2022-02-23 07:08:28'),
(188, 'provider', 15, 15, 0, '2022-02-23 07:09:05', '2022-02-23 07:09:05'),
(189, 'provider', 15, 15, 0, '2022-02-23 07:09:57', '2022-02-23 07:09:57'),
(190, 'provider', 15, 15, 0, '2022-02-23 07:10:46', '2022-02-23 07:10:46'),
(191, 'provider', 15, 15, 0, '2022-02-23 07:13:45', '2022-02-23 07:13:45'),
(192, 'provider', 15, 15, 0, '2022-02-23 07:14:04', '2022-02-23 07:14:04'),
(193, 'provider', 15, 15, 0, '2022-02-23 07:15:13', '2022-02-23 07:15:13'),
(194, 'provider', 15, 15, 0, '2022-02-23 07:15:37', '2022-02-23 07:15:37'),
(195, 'provider', 15, 15, 0, '2022-02-23 07:15:45', '2022-02-23 07:15:45'),
(196, 'provider', 15, 15, 0, '2022-02-23 07:15:47', '2022-02-23 07:15:47'),
(197, 'provider', 15, 15, 0, '2022-02-23 07:15:50', '2022-02-23 07:15:50'),
(198, 'provider', 15, 15, 0, '2022-02-23 07:15:52', '2022-02-23 07:15:52'),
(199, 'provider', 15, 15, 0, '2022-02-23 07:15:53', '2022-02-23 07:15:53'),
(200, 'customer', 16, 15, 0, '2022-03-02 01:09:11', '2022-03-02 01:09:11'),
(201, 'customer', 16, 15, 0, '2022-03-02 03:30:56', '2022-03-02 03:30:56'),
(202, 'customer', 16, 15, 0, '2022-03-02 03:40:09', '2022-03-02 03:40:09'),
(203, 'customer', 16, 15, 0, '2022-03-02 05:19:00', '2022-03-02 05:19:00'),
(204, 'provider', 15, 15, 0, '2022-03-02 05:33:03', '2022-03-02 05:33:03'),
(205, 'provider', 15, 14, 0, '2022-03-02 05:35:32', '2022-03-02 05:35:32'),
(206, 'provider', 15, 14, 0, '2022-03-02 05:36:25', '2022-03-02 05:36:25'),
(207, 'customer', 16, 15, 0, '2022-03-03 23:34:02', '2022-03-03 23:34:02'),
(208, 'customer', 16, 15, 0, '2022-03-04 00:52:41', '2022-03-04 00:52:41'),
(209, 'customer', 16, 15, 0, '2022-03-04 00:56:32', '2022-03-04 00:56:32'),
(210, 'customer', 16, 15, 0, '2022-03-04 01:00:53', '2022-03-04 01:00:53'),
(211, 'provider', 15, 15, 0, '2022-03-04 01:01:32', '2022-03-04 01:01:32'),
(212, 'customer', 16, 15, 0, '2022-03-04 01:01:48', '2022-03-04 01:01:48'),
(213, 'customer', 16, 15, 0, '2022-03-04 01:02:44', '2022-03-04 01:02:44'),
(214, 'customer', 16, 15, 0, '2022-03-04 01:04:52', '2022-03-04 01:04:52'),
(215, 'customer', 16, 15, 0, '2022-03-04 01:05:59', '2022-03-04 01:05:59'),
(216, 'customer', 16, 15, 0, '2022-03-04 01:08:08', '2022-03-04 01:08:08'),
(217, 'customer', 16, 15, 0, '2022-03-04 01:11:22', '2022-03-04 01:11:22'),
(218, 'customer', 16, 15, 0, '2022-03-04 01:11:53', '2022-03-04 01:11:53'),
(219, 'customer', 16, 15, 0, '2022-03-04 01:11:59', '2022-03-04 01:11:59'),
(220, 'customer', 16, 15, 0, '2022-03-04 01:12:17', '2022-03-04 01:12:17'),
(221, 'customer', 16, 15, 0, '2022-03-04 01:24:52', '2022-03-04 01:24:52'),
(222, 'customer', 16, 15, 0, '2022-03-04 01:25:44', '2022-03-04 01:25:44'),
(223, 'customer', 16, 15, 0, '2022-03-04 01:26:33', '2022-03-04 01:26:33'),
(224, 'customer', 16, 15, 0, '2022-03-04 01:27:48', '2022-03-04 01:27:48'),
(225, 'customer', 16, 15, 0, '2022-03-04 02:30:45', '2022-03-04 02:30:45'),
(226, 'customer', 16, 15, 0, '2022-03-04 02:31:03', '2022-03-04 02:31:03'),
(227, 'customer', 16, 15, 0, '2022-03-04 02:42:44', '2022-03-04 02:42:44'),
(228, 'customer', 16, 15, 0, '2022-03-04 02:43:15', '2022-03-04 02:43:15'),
(229, 'customer', 16, 15, 0, '2022-03-04 02:43:17', '2022-03-04 02:43:17'),
(230, 'customer', 16, 15, 0, '2022-03-04 02:44:44', '2022-03-04 02:44:44'),
(231, 'customer', 16, 15, 0, '2022-03-04 02:44:55', '2022-03-04 02:44:55'),
(232, 'customer', 16, 15, 0, '2022-03-04 02:45:26', '2022-03-04 02:45:26'),
(233, 'customer', 16, 15, 0, '2022-03-04 02:47:27', '2022-03-04 02:47:27'),
(234, 'customer', 16, 15, 0, '2022-03-04 02:47:45', '2022-03-04 02:47:45'),
(235, 'customer', 16, 15, 0, '2022-03-04 02:47:56', '2022-03-04 02:47:56'),
(236, 'customer', 16, 15, 0, '2022-03-04 02:48:07', '2022-03-04 02:48:07'),
(237, 'customer', 16, 15, 0, '2022-03-04 02:52:07', '2022-03-04 02:52:07'),
(238, 'customer', 16, 15, 0, '2022-03-04 02:53:01', '2022-03-04 02:53:01'),
(239, 'customer', 16, 15, 0, '2022-03-04 02:54:14', '2022-03-04 02:54:14'),
(240, 'customer', 16, 15, 1, '2022-03-04 02:56:02', '2022-03-04 02:56:02'),
(241, 'customer', 16, 15, 0, '2022-03-04 02:56:02', '2022-03-04 02:56:02'),
(242, 'customer', 16, 15, 0, '2022-03-04 03:15:53', '2022-03-04 03:15:53'),
(243, 'customer', 16, 15, 1, '2022-03-04 03:16:00', '2022-03-04 03:16:00'),
(244, 'customer', 16, 15, 0, '2022-03-04 03:16:00', '2022-03-04 03:16:00'),
(245, 'customer', 16, 15, 1, '2022-03-04 03:16:32', '2022-03-04 03:16:32'),
(246, 'customer', 16, 15, 1, '2022-03-04 03:17:15', '2022-03-04 03:17:15'),
(247, 'customer', 16, 15, 1, '2022-03-04 03:18:10', '2022-03-04 03:18:10'),
(248, 'customer', 16, 15, 0, '2022-03-04 03:18:28', '2022-03-04 03:18:28'),
(249, 'customer', 16, 15, 0, '2022-03-04 03:18:33', '2022-03-04 03:18:33'),
(250, 'customer', 16, 15, 0, '2022-03-04 03:48:23', '2022-03-04 03:48:23'),
(251, 'customer', 16, 15, 0, '2022-03-04 03:51:15', '2022-03-04 03:51:15'),
(252, 'customer', 16, 15, 0, '2022-03-04 03:51:34', '2022-03-04 03:51:34'),
(253, 'customer', 16, 15, 0, '2022-03-04 03:51:51', '2022-03-04 03:51:51'),
(254, 'customer', 16, 15, 0, '2022-03-04 03:52:10', '2022-03-04 03:52:10'),
(255, 'customer', 16, 15, 0, '2022-03-04 03:53:39', '2022-03-04 03:53:39'),
(256, 'customer', 16, 15, 0, '2022-03-04 03:55:35', '2022-03-04 03:55:35'),
(257, 'customer', 16, 15, 0, '2022-03-04 03:56:00', '2022-03-04 03:56:00'),
(258, 'customer', 16, 15, 0, '2022-03-04 03:56:50', '2022-03-04 03:56:50'),
(259, 'customer', 16, 15, 0, '2022-03-04 03:57:48', '2022-03-04 03:57:48'),
(260, 'customer', 16, 15, 0, '2022-03-04 04:05:54', '2022-03-04 04:05:54'),
(261, 'customer', 16, 15, 0, '2022-03-04 04:07:04', '2022-03-04 04:07:04'),
(262, 'customer', 16, 15, 0, '2022-03-04 04:07:10', '2022-03-04 04:07:10'),
(263, 'customer', 16, 15, 0, '2022-03-04 04:11:18', '2022-03-04 04:11:18'),
(264, 'customer', 16, 15, 0, '2022-03-04 04:11:38', '2022-03-04 04:11:38'),
(265, 'customer', 16, 15, 0, '2022-03-04 04:12:38', '2022-03-04 04:12:38'),
(266, 'customer', 16, 15, 0, '2022-03-04 04:14:30', '2022-03-04 04:14:30'),
(267, 'customer', 16, 15, 0, '2022-03-04 04:15:07', '2022-03-04 04:15:07'),
(268, 'customer', 16, 15, 0, '2022-03-04 04:15:40', '2022-03-04 04:15:40'),
(269, 'customer', 16, 15, 0, '2022-03-04 04:15:55', '2022-03-04 04:15:55'),
(270, 'customer', 16, 15, 0, '2022-03-04 04:19:13', '2022-03-04 04:19:13'),
(271, 'customer', 16, 15, 0, '2022-03-04 04:19:55', '2022-03-04 04:19:55'),
(272, 'customer', 16, 15, 0, '2022-03-04 04:23:35', '2022-03-04 04:23:35'),
(273, 'customer', 16, 15, 0, '2022-03-04 04:23:49', '2022-03-04 04:23:49'),
(274, 'customer', 16, 15, 0, '2022-03-04 04:24:03', '2022-03-04 04:24:03'),
(275, 'customer', 16, 15, 0, '2022-03-04 04:24:14', '2022-03-04 04:24:14'),
(276, 'customer', 16, 15, 0, '2022-03-04 04:24:40', '2022-03-04 04:24:40'),
(277, 'customer', 16, 15, 0, '2022-03-04 04:25:19', '2022-03-04 04:25:19'),
(278, 'customer', 16, 15, 0, '2022-03-04 04:25:32', '2022-03-04 04:25:32'),
(279, 'customer', 16, 15, 0, '2022-03-04 05:15:49', '2022-03-04 05:15:49'),
(280, 'customer', 16, 14, 0, '2022-03-04 05:18:03', '2022-03-04 05:18:03'),
(281, 'customer', 16, 15, 0, '2022-03-04 05:40:41', '2022-03-04 05:40:41'),
(282, 'customer', 16, 15, 0, '2022-03-04 05:54:06', '2022-03-04 05:54:06'),
(283, 'customer', 16, 15, 0, '2022-03-04 05:54:25', '2022-03-04 05:54:25'),
(284, 'customer', 16, 15, 0, '2022-03-04 05:56:10', '2022-03-04 05:56:10'),
(285, 'customer', 16, 15, 0, '2022-03-04 05:56:26', '2022-03-04 05:56:26'),
(286, 'customer', 16, 15, 0, '2022-03-04 05:56:45', '2022-03-04 05:56:45'),
(287, 'customer', 16, 15, 0, '2022-03-04 05:56:56', '2022-03-04 05:56:56'),
(288, 'customer', 16, 15, 0, '2022-03-04 05:57:12', '2022-03-04 05:57:12'),
(289, 'customer', 16, 15, 0, '2022-03-04 06:11:23', '2022-03-04 06:11:23'),
(290, 'customer', 16, 15, 0, '2022-03-04 06:24:04', '2022-03-04 06:24:04'),
(291, 'customer', 16, 15, 0, '2022-03-04 06:28:27', '2022-03-04 06:28:27'),
(292, 'customer', 16, 15, 0, '2022-03-04 06:29:10', '2022-03-04 06:29:10'),
(293, 'customer', 16, 15, 0, '2022-03-04 06:29:32', '2022-03-04 06:29:32'),
(294, 'customer', 16, 15, 0, '2022-03-04 06:32:17', '2022-03-04 06:32:17'),
(295, 'customer', 16, 15, 0, '2022-03-04 06:32:25', '2022-03-04 06:32:25'),
(296, 'provider', 15, 15, 0, '2022-03-04 11:47:02', '2022-03-04 11:47:02'),
(297, 'provider', 15, 15, 0, '2022-03-04 11:47:31', '2022-03-04 11:47:31'),
(298, 'provider', 15, 15, 0, '2022-03-04 11:47:42', '2022-03-04 11:47:42'),
(299, 'provider', 15, 15, 0, '2022-03-04 11:48:18', '2022-03-04 11:48:18'),
(300, 'provider', 15, 15, 0, '2022-03-04 11:48:35', '2022-03-04 11:48:35'),
(301, 'provider', 15, 15, 0, '2022-03-04 11:49:22', '2022-03-04 11:49:22'),
(302, 'provider', 15, 15, 0, '2022-03-04 11:49:32', '2022-03-04 11:49:32'),
(303, 'provider', 15, 15, 0, '2022-03-04 11:49:47', '2022-03-04 11:49:47'),
(304, 'provider', 15, 15, 0, '2022-03-04 11:50:07', '2022-03-04 11:50:07'),
(305, 'provider', 15, 15, 0, '2022-03-04 11:50:16', '2022-03-04 11:50:16'),
(306, 'provider', 15, 15, 0, '2022-03-04 23:51:25', '2022-03-04 23:51:25'),
(307, 'provider', 15, 15, 0, '2022-03-04 23:54:51', '2022-03-04 23:54:51'),
(308, 'provider', 15, 15, 0, '2022-03-04 23:55:22', '2022-03-04 23:55:22'),
(309, 'provider', 15, 15, 0, '2022-03-04 23:56:00', '2022-03-04 23:56:00'),
(310, 'provider', 15, 15, 0, '2022-03-05 00:51:39', '2022-03-05 00:51:39'),
(311, 'provider', 15, 15, 0, '2022-03-05 01:25:26', '2022-03-05 01:25:26'),
(312, 'provider', 15, 15, 0, '2022-03-05 01:25:37', '2022-03-05 01:25:37'),
(313, 'customer', 16, 15, 0, '2022-03-06 23:02:06', '2022-03-06 23:02:06'),
(314, 'customer', 16, 15, 0, '2022-03-06 23:02:19', '2022-03-06 23:02:19'),
(315, 'customer', 16, 15, 0, '2022-03-06 23:02:37', '2022-03-06 23:02:37'),
(316, 'customer', 16, 15, 0, '2022-03-06 23:11:23', '2022-03-06 23:11:23'),
(317, 'customer', 16, 15, 0, '2022-03-06 23:17:35', '2022-03-06 23:17:35'),
(318, 'customer', 16, 15, 0, '2022-03-06 23:17:40', '2022-03-06 23:17:40'),
(319, 'customer', 16, 15, 0, '2022-03-06 23:17:49', '2022-03-06 23:17:49'),
(320, 'customer', 16, 15, 0, '2022-03-06 23:17:53', '2022-03-06 23:17:53'),
(321, 'customer', 16, 15, 0, '2022-03-06 23:34:09', '2022-03-06 23:34:09'),
(322, 'customer', 16, 15, 0, '2022-03-06 23:34:51', '2022-03-06 23:34:51'),
(323, 'customer', 16, 15, 0, '2022-03-06 23:34:58', '2022-03-06 23:34:58'),
(324, 'customer', 16, 15, 0, '2022-03-06 23:35:07', '2022-03-06 23:35:07'),
(325, 'customer', 16, 15, 0, '2022-03-06 23:36:41', '2022-03-06 23:36:41'),
(326, 'customer', 16, 15, 0, '2022-03-07 00:01:43', '2022-03-07 00:01:43'),
(327, 'customer', 16, 15, 0, '2022-03-07 00:01:47', '2022-03-07 00:01:47'),
(328, 'customer', 16, 15, 0, '2022-03-07 02:07:13', '2022-03-07 02:07:13'),
(329, 'customer', 16, 15, 0, '2022-03-07 02:07:57', '2022-03-07 02:07:57'),
(330, 'customer', 16, 15, 0, '2022-03-07 02:51:23', '2022-03-07 02:51:23'),
(331, 'customer', 16, 15, 0, '2022-03-07 02:51:28', '2022-03-07 02:51:28'),
(332, 'customer', 16, 15, 0, '2022-03-07 03:47:17', '2022-03-07 03:47:17'),
(333, 'customer', 16, 15, 0, '2022-03-07 03:48:27', '2022-03-07 03:48:27'),
(334, 'customer', 16, 15, 1, '2022-03-07 03:48:38', '2022-03-07 03:48:38'),
(335, 'customer', 16, 15, 0, '2022-03-07 05:57:50', '2022-03-07 05:57:50'),
(336, 'customer', 16, 15, 0, '2022-03-07 05:58:57', '2022-03-07 05:58:57'),
(337, 'customer', 16, 15, 0, '2022-03-07 05:59:27', '2022-03-07 05:59:27'),
(338, 'customer', 16, 15, 0, '2022-03-07 06:03:54', '2022-03-07 06:03:54'),
(339, 'customer', 16, 15, 0, '2022-03-16 00:53:09', '2022-03-16 00:53:09'),
(340, 'provider', 15, 15, 0, '2022-03-21 21:58:30', '2022-03-21 21:58:30'),
(341, 'provider', 15, 15, 0, '2022-03-21 21:58:32', '2022-03-21 21:58:32'),
(342, 'provider', 15, 15, 0, '2022-03-21 22:06:25', '2022-03-21 22:06:25'),
(343, 'provider', 15, 15, 0, '2022-03-21 22:45:18', '2022-03-21 22:45:18'),
(344, 'customer', 16, 15, 0, '2022-03-21 22:45:38', '2022-03-21 22:45:38'),
(345, 'customer', 16, 15, 0, '2022-03-21 22:56:36', '2022-03-21 22:56:36'),
(346, 'customer', 16, 15, 0, '2022-03-21 22:56:49', '2022-03-21 22:56:49'),
(347, 'customer', 16, 15, 0, '2022-03-22 00:59:23', '2022-03-22 00:59:23'),
(348, 'customer', 16, 15, 0, '2022-03-22 00:59:27', '2022-03-22 00:59:27'),
(349, 'provider', 15, 15, 0, '2022-03-22 01:11:54', '2022-03-22 01:11:54'),
(350, 'provider', 15, 15, 0, '2022-03-22 01:12:05', '2022-03-22 01:12:05'),
(351, 'provider', 15, 15, 0, '2022-03-23 05:39:08', '2022-03-23 05:39:08'),
(352, 'provider', 15, 15, 0, '2022-03-28 04:19:05', '2022-03-28 04:19:05'),
(353, 'provider', 15, 15, 0, '2022-03-28 04:20:12', '2022-03-28 04:20:12'),
(354, 'provider', 15, 15, 0, '2022-03-28 04:24:04', '2022-03-28 04:24:04'),
(355, 'provider', 15, 15, 0, '2022-03-28 22:18:43', '2022-03-28 22:18:43'),
(356, 'customer', 16, 15, 0, '2022-03-29 23:02:24', '2022-03-29 23:02:24'),
(357, 'customer', 16, 15, 0, '2022-03-29 23:02:50', '2022-03-29 23:02:50'),
(358, 'customer', 16, 15, 0, '2022-03-29 23:06:01', '2022-03-29 23:06:01'),
(359, 'customer', 16, 15, 1, '2022-03-29 23:06:40', '2022-03-29 23:06:40'),
(360, 'customer', 16, 15, 0, '2022-03-29 23:06:41', '2022-03-29 23:06:41'),
(361, 'customer', 16, 15, 0, '2022-03-29 23:07:12', '2022-03-29 23:07:12'),
(362, 'customer', 16, 15, 0, '2022-03-29 23:08:38', '2022-03-29 23:08:38'),
(363, 'customer', 16, 15, 0, '2022-03-29 23:13:50', '2022-03-29 23:13:50'),
(364, 'customer', 16, 15, 0, '2022-03-29 23:14:49', '2022-03-29 23:14:49'),
(365, 'customer', 16, 15, 0, '2022-03-29 23:16:22', '2022-03-29 23:16:22'),
(366, 'customer', 16, 15, 0, '2022-04-04 00:36:29', '2022-04-04 00:36:29'),
(367, 'customer', 16, 15, 1, '2022-04-04 00:36:40', '2022-04-04 00:36:40'),
(368, 'provider', 15, 15, 0, '2022-04-04 02:54:29', '2022-04-04 02:54:29'),
(369, 'provider', 15, 15, 0, '2022-04-04 03:01:16', '2022-04-04 03:01:16'),
(370, 'provider', 15, 15, 0, '2022-04-04 03:05:10', '2022-04-04 03:05:10'),
(371, 'provider', 15, 15, 0, '2022-04-04 07:03:06', '2022-04-04 07:03:06'),
(372, 'provider', 15, 15, 0, '2022-04-04 07:07:23', '2022-04-04 07:07:23'),
(373, 'provider', 15, 15, 0, '2022-04-05 22:27:56', '2022-04-05 22:27:56'),
(374, 'provider', 15, 15, 0, '2022-04-05 22:31:07', '2022-04-05 22:31:07'),
(375, 'customer', 16, 15, 1, '2022-04-11 22:18:19', '2022-04-11 22:18:19'),
(376, 'provider', 15, 15, 0, '2022-04-12 23:58:27', '2022-04-12 23:58:27'),
(377, 'provider', 15, 15, 0, '2022-04-13 00:00:24', '2022-04-13 00:00:24'),
(378, 'provider', 15, 15, 0, '2022-04-18 05:21:09', '2022-04-18 05:21:09'),
(379, 'customer', 16, 15, 0, '2022-04-29 06:21:26', '2022-04-29 06:21:26'),
(380, 'provider', 15, 15, 0, '2022-05-03 05:31:05', '2022-05-03 05:31:05'),
(381, 'provider', 15, 15, 0, '2022-05-13 05:54:13', '2022-05-13 05:54:13'),
(382, 'provider', 15, 15, 0, '2022-05-16 00:43:28', '2022-05-16 00:43:28'),
(383, 'provider', 15, 15, 0, '2022-05-16 00:43:54', '2022-05-16 00:43:54'),
(384, 'provider', 15, 15, 0, '2022-05-16 00:48:25', '2022-05-16 00:48:25'),
(385, 'provider', 15, 15, 0, '2022-05-16 00:49:09', '2022-05-16 00:49:09'),
(386, 'provider', 15, 15, 0, '2022-05-16 00:49:34', '2022-05-16 00:49:34'),
(387, 'provider', 15, 15, 0, '2022-05-16 00:53:30', '2022-05-16 00:53:30'),
(388, 'provider', 15, 15, 0, '2022-05-16 01:01:03', '2022-05-16 01:01:03'),
(389, 'provider', 15, 15, 0, '2022-05-16 01:03:53', '2022-05-16 01:03:53'),
(390, 'provider', 15, 15, 0, '2022-05-16 01:10:00', '2022-05-16 01:10:00'),
(391, 'provider', 15, 15, 0, '2022-05-16 01:10:26', '2022-05-16 01:10:26'),
(392, 'provider', 15, 15, 0, '2022-05-16 01:10:42', '2022-05-16 01:10:42'),
(393, 'provider', 15, 15, 0, '2022-05-16 01:13:55', '2022-05-16 01:13:55'),
(394, 'provider', 15, 15, 0, '2022-05-17 01:25:36', '2022-05-17 01:25:36'),
(395, 'provider', 15, 15, 0, '2022-05-17 01:30:29', '2022-05-17 01:30:29'),
(396, 'provider', 15, 15, 0, '2022-05-17 01:31:18', '2022-05-17 01:31:18'),
(397, 'provider', 15, 15, 0, '2022-05-17 01:31:45', '2022-05-17 01:31:45'),
(398, 'provider', 15, 15, 0, '2022-05-17 01:40:54', '2022-05-17 01:40:54'),
(399, 'provider', 15, 15, 0, '2022-05-17 01:41:04', '2022-05-17 01:41:04'),
(400, 'provider', 15, 15, 0, '2022-05-17 01:43:56', '2022-05-17 01:43:56'),
(401, 'provider', 15, 15, 0, '2022-05-17 01:44:04', '2022-05-17 01:44:04'),
(402, 'provider', 15, 15, 0, '2022-05-17 03:08:45', '2022-05-17 03:08:45'),
(403, 'provider', 15, 15, 0, '2022-05-17 03:09:08', '2022-05-17 03:09:08'),
(404, 'provider', 15, 15, 0, '2022-05-17 03:09:20', '2022-05-17 03:09:20'),
(405, 'provider', 15, 15, 0, '2022-05-17 03:15:06', '2022-05-17 03:15:06'),
(406, 'provider', 15, 15, 0, '2022-05-17 03:27:42', '2022-05-17 03:27:42'),
(407, 'provider', 15, 15, 0, '2022-05-17 03:29:23', '2022-05-17 03:29:23'),
(408, 'provider', 15, 15, 0, '2022-05-17 03:31:37', '2022-05-17 03:31:37'),
(409, 'provider', 15, 15, 0, '2022-05-17 03:32:26', '2022-05-17 03:32:26'),
(410, 'provider', 15, 15, 0, '2022-05-17 03:37:16', '2022-05-17 03:37:16'),
(411, 'provider', 15, 15, 0, '2022-05-17 03:37:48', '2022-05-17 03:37:48'),
(412, 'provider', 15, 15, 0, '2022-05-17 03:38:15', '2022-05-17 03:38:15'),
(413, 'provider', 15, 15, 0, '2022-05-17 03:38:37', '2022-05-17 03:38:37'),
(414, 'provider', 15, 15, 0, '2022-05-17 03:42:55', '2022-05-17 03:42:55'),
(415, 'provider', 15, 15, 0, '2022-05-17 03:43:14', '2022-05-17 03:43:14'),
(416, 'provider', 15, 15, 0, '2022-05-17 03:43:45', '2022-05-17 03:43:45'),
(417, 'provider', 15, 15, 0, '2022-05-17 03:44:57', '2022-05-17 03:44:57'),
(418, 'provider', 15, 15, 0, '2022-05-17 03:58:36', '2022-05-17 03:58:36'),
(419, 'provider', 15, 15, 0, '2022-05-17 04:03:25', '2022-05-17 04:03:25'),
(420, 'provider', 15, 15, 0, '2022-05-17 04:15:19', '2022-05-17 04:15:19'),
(421, 'provider', 15, 15, 0, '2022-05-17 04:15:41', '2022-05-17 04:15:41'),
(422, 'provider', 15, 15, 0, '2022-05-17 04:16:58', '2022-05-17 04:16:58'),
(423, 'provider', 15, 15, 0, '2022-05-17 04:17:20', '2022-05-17 04:17:20'),
(424, 'provider', 15, 15, 0, '2022-05-17 04:18:14', '2022-05-17 04:18:14'),
(425, 'provider', 15, 15, 0, '2022-05-17 04:18:26', '2022-05-17 04:18:26'),
(426, 'provider', 15, 15, 0, '2022-05-17 04:20:07', '2022-05-17 04:20:07'),
(427, 'provider', 15, 15, 0, '2022-05-17 04:21:09', '2022-05-17 04:21:09'),
(428, 'provider', 15, 15, 0, '2022-05-17 04:21:46', '2022-05-17 04:21:46'),
(429, 'provider', 15, 15, 0, '2022-05-17 04:23:38', '2022-05-17 04:23:38'),
(430, 'provider', 15, 15, 0, '2022-05-17 04:24:58', '2022-05-17 04:24:58'),
(431, 'provider', 15, 15, 0, '2022-05-17 04:26:25', '2022-05-17 04:26:25'),
(432, 'provider', 15, 15, 0, '2022-05-17 04:26:54', '2022-05-17 04:26:54'),
(433, 'provider', 15, 15, 0, '2022-05-17 04:29:36', '2022-05-17 04:29:36'),
(434, 'provider', 15, 15, 0, '2022-05-17 04:31:06', '2022-05-17 04:31:06'),
(435, 'provider', 15, 15, 0, '2022-05-17 04:32:24', '2022-05-17 04:32:24'),
(436, 'provider', 15, 15, 0, '2022-05-17 04:33:07', '2022-05-17 04:33:07'),
(437, 'provider', 15, 15, 0, '2022-05-17 04:33:57', '2022-05-17 04:33:57'),
(438, 'provider', 15, 15, 0, '2022-05-17 04:34:20', '2022-05-17 04:34:20'),
(439, 'provider', 15, 15, 0, '2022-05-17 04:34:48', '2022-05-17 04:34:48'),
(440, 'provider', 15, 15, 0, '2022-05-17 04:35:29', '2022-05-17 04:35:29'),
(441, 'provider', 15, 15, 0, '2022-05-17 04:35:54', '2022-05-17 04:35:54'),
(442, 'provider', 15, 15, 0, '2022-05-17 04:37:13', '2022-05-17 04:37:13'),
(443, 'provider', 15, 15, 0, '2022-05-17 04:38:28', '2022-05-17 04:38:28'),
(444, 'provider', 15, 15, 0, '2022-05-17 04:39:32', '2022-05-17 04:39:32'),
(445, 'provider', 15, 15, 0, '2022-05-17 04:40:24', '2022-05-17 04:40:24'),
(446, 'provider', 15, 15, 0, '2022-05-17 04:41:13', '2022-05-17 04:41:13'),
(447, 'provider', 15, 15, 0, '2022-05-17 04:42:02', '2022-05-17 04:42:02'),
(448, 'provider', 15, 15, 0, '2022-05-17 05:44:25', '2022-05-17 05:44:25'),
(449, 'provider', 15, 15, 0, '2022-05-17 05:45:27', '2022-05-17 05:45:27'),
(450, 'provider', 15, 15, 0, '2022-05-17 05:45:31', '2022-05-17 05:45:31'),
(451, 'provider', 15, 15, 0, '2022-05-17 05:45:47', '2022-05-17 05:45:47'),
(452, 'provider', 15, 15, 0, '2022-05-17 05:46:02', '2022-05-17 05:46:02'),
(453, 'provider', 15, 15, 0, '2022-05-17 05:50:14', '2022-05-17 05:50:14'),
(454, 'provider', 15, 15, 0, '2022-05-17 05:51:18', '2022-05-17 05:51:18'),
(455, 'provider', 15, 15, 0, '2022-05-17 05:54:59', '2022-05-17 05:54:59'),
(456, 'provider', 15, 15, 0, '2022-05-17 05:56:32', '2022-05-17 05:56:32'),
(457, 'provider', 15, 15, 0, '2022-05-17 05:56:55', '2022-05-17 05:56:55'),
(458, 'provider', 15, 15, 0, '2022-05-17 05:57:11', '2022-05-17 05:57:11'),
(459, 'provider', 15, 15, 0, '2022-05-17 05:58:03', '2022-05-17 05:58:03'),
(460, 'provider', 15, 15, 0, '2022-05-17 06:17:01', '2022-05-17 06:17:01'),
(461, 'provider', 15, 15, 0, '2022-05-17 06:18:05', '2022-05-17 06:18:05'),
(462, 'provider', 15, 15, 0, '2022-05-17 06:18:47', '2022-05-17 06:18:47'),
(463, 'provider', 15, 15, 0, '2022-05-17 06:25:13', '2022-05-17 06:25:13'),
(464, 'provider', 15, 15, 0, '2022-05-17 06:57:21', '2022-05-17 06:57:21'),
(465, 'provider', 15, 15, 0, '2022-05-17 06:58:31', '2022-05-17 06:58:31'),
(466, 'provider', 15, 15, 0, '2022-05-17 06:58:57', '2022-05-17 06:58:57'),
(467, 'provider', 15, 15, 0, '2022-05-17 22:30:09', '2022-05-17 22:30:09'),
(468, 'provider', 15, 15, 0, '2022-05-17 22:30:12', '2022-05-17 22:30:12'),
(469, 'provider', 15, 15, 0, '2022-05-17 22:31:26', '2022-05-17 22:31:26'),
(470, 'provider', 15, 15, 0, '2022-05-17 22:31:38', '2022-05-17 22:31:38'),
(471, 'provider', 15, 15, 0, '2022-05-17 22:31:42', '2022-05-17 22:31:42'),
(472, 'provider', 15, 15, 0, '2022-05-17 22:35:09', '2022-05-17 22:35:09'),
(473, 'provider', 15, 15, 0, '2022-05-17 22:41:32', '2022-05-17 22:41:32'),
(474, 'provider', 15, 15, 0, '2022-05-17 22:41:39', '2022-05-17 22:41:39'),
(475, 'provider', 15, 15, 0, '2022-05-17 22:42:22', '2022-05-17 22:42:22'),
(476, 'provider', 15, 15, 0, '2022-05-18 06:23:24', '2022-05-18 06:23:24'),
(477, 'provider', 15, 15, 0, '2022-05-18 06:23:41', '2022-05-18 06:23:41'),
(478, 'provider', 15, 15, 0, '2022-05-18 06:40:38', '2022-05-18 06:40:38'),
(479, 'provider', 15, 15, 0, '2022-05-18 06:45:29', '2022-05-18 06:45:29'),
(480, 'provider', 15, 15, 0, '2022-05-18 06:46:19', '2022-05-18 06:46:19'),
(481, 'provider', 15, 15, 0, '2022-05-18 06:46:53', '2022-05-18 06:46:53'),
(482, 'provider', 15, 15, 0, '2022-05-18 07:12:29', '2022-05-18 07:12:29'),
(483, 'provider', 15, 15, 0, '2022-05-18 07:13:26', '2022-05-18 07:13:26'),
(484, 'provider', 15, 15, 0, '2022-05-18 07:14:50', '2022-05-18 07:14:50'),
(485, 'provider', 15, 15, 0, '2022-05-18 07:48:36', '2022-05-18 07:48:36'),
(486, 'provider', 15, 15, 0, '2022-05-18 07:49:37', '2022-05-18 07:49:37'),
(487, 'provider', 15, 15, 0, '2022-05-18 07:50:07', '2022-05-18 07:50:07'),
(488, 'provider', 15, 15, 0, '2022-05-18 07:51:11', '2022-05-18 07:51:11'),
(489, 'provider', 15, 15, 0, '2022-05-18 07:51:26', '2022-05-18 07:51:26'),
(490, 'provider', 15, 15, 0, '2022-05-18 08:03:17', '2022-05-18 08:03:17'),
(491, 'provider', 15, 15, 0, '2022-05-18 08:05:03', '2022-05-18 08:05:03'),
(492, 'provider', 15, 15, 0, '2022-05-18 08:05:19', '2022-05-18 08:05:19'),
(493, 'provider', 15, 15, 0, '2022-05-18 08:05:58', '2022-05-18 08:05:58'),
(494, 'provider', 15, 15, 0, '2022-05-18 08:06:09', '2022-05-18 08:06:09'),
(495, 'provider', 15, 15, 0, '2022-05-18 08:06:37', '2022-05-18 08:06:37'),
(496, 'provider', 15, 15, 0, '2022-05-18 08:08:32', '2022-05-18 08:08:32'),
(497, 'provider', 15, 15, 0, '2022-05-18 08:08:50', '2022-05-18 08:08:50'),
(498, 'provider', 15, 15, 0, '2022-05-18 08:09:39', '2022-05-18 08:09:39'),
(499, 'provider', 15, 15, 0, '2022-05-18 08:09:51', '2022-05-18 08:09:51'),
(500, 'provider', 15, 15, 0, '2022-05-18 08:10:20', '2022-05-18 08:10:20'),
(501, 'provider', 15, 15, 0, '2022-05-18 08:10:53', '2022-05-18 08:10:53'),
(502, 'provider', 15, 15, 0, '2022-05-18 08:11:20', '2022-05-18 08:11:20'),
(503, 'provider', 15, 15, 0, '2022-05-18 08:12:26', '2022-05-18 08:12:26'),
(504, 'provider', 15, 15, 0, '2022-05-18 08:12:33', '2022-05-18 08:12:33'),
(505, 'provider', 15, 15, 0, '2022-05-18 08:14:31', '2022-05-18 08:14:31'),
(506, 'provider', 15, 15, 0, '2022-05-18 22:16:42', '2022-05-18 22:16:42'),
(507, 'provider', 15, 15, 0, '2022-05-18 22:28:16', '2022-05-18 22:28:16'),
(508, 'provider', 15, 15, 0, '2022-05-18 22:29:33', '2022-05-18 22:29:33'),
(509, 'provider', 15, 15, 0, '2022-05-18 22:32:08', '2022-05-18 22:32:08'),
(510, 'provider', 15, 15, 0, '2022-05-18 22:32:51', '2022-05-18 22:32:51'),
(511, 'provider', 15, 15, 0, '2022-05-18 22:34:12', '2022-05-18 22:34:12'),
(512, 'provider', 15, 15, 0, '2022-05-18 22:35:20', '2022-05-18 22:35:20'),
(513, 'provider', 15, 15, 0, '2022-05-18 22:36:00', '2022-05-18 22:36:00'),
(514, 'provider', 15, 15, 0, '2022-05-18 22:37:57', '2022-05-18 22:37:57'),
(515, 'provider', 15, 15, 0, '2022-05-18 22:40:07', '2022-05-18 22:40:07'),
(516, 'provider', 15, 15, 0, '2022-05-18 22:41:27', '2022-05-18 22:41:27'),
(517, 'provider', 15, 15, 0, '2022-05-18 22:42:03', '2022-05-18 22:42:03'),
(518, 'provider', 15, 15, 0, '2022-05-18 22:43:46', '2022-05-18 22:43:46'),
(519, 'provider', 15, 15, 0, '2022-05-18 22:45:50', '2022-05-18 22:45:50'),
(520, 'provider', 15, 15, 0, '2022-05-18 22:46:05', '2022-05-18 22:46:05'),
(521, 'provider', 15, 15, 0, '2022-05-19 04:03:08', '2022-05-19 04:03:08'),
(522, 'provider', 15, 14, 0, '2022-05-19 04:03:14', '2022-05-19 04:03:14'),
(523, 'provider', 15, 11, 0, '2022-05-19 04:08:32', '2022-05-19 04:08:32'),
(524, 'provider', 15, 15, 0, '2022-05-19 04:09:05', '2022-05-19 04:09:05'),
(525, 'customer', 16, 15, 0, '2022-05-19 04:14:57', '2022-05-19 04:14:57'),
(526, 'customer', 16, 15, 1, '2022-05-19 04:15:19', '2022-05-19 04:15:19'),
(527, 'customer', 16, 11, 0, '2022-05-19 04:32:38', '2022-05-19 04:32:38'),
(528, 'customer', 16, 11, 1, '2022-05-19 04:33:11', '2022-05-19 04:33:11'),
(529, 'customer', 16, 11, 0, '2022-05-19 04:33:11', '2022-05-19 04:33:11'),
(530, 'customer', 16, 11, 0, '2022-05-19 04:33:43', '2022-05-19 04:33:43'),
(531, 'provider', 15, 15, 0, '2022-05-19 05:11:03', '2022-05-19 05:11:03'),
(532, 'provider', 15, 15, 0, '2022-05-25 03:48:34', '2022-05-25 03:48:34'),
(533, 'provider', 15, 15, 0, '2022-05-26 03:27:41', '2022-05-26 03:27:41'),
(534, 'provider', 15, 15, 0, '2022-05-26 03:29:10', '2022-05-26 03:29:10'),
(535, 'provider', 15, 15, 0, '2022-05-26 03:34:03', '2022-05-26 03:34:03'),
(536, 'provider', 15, 15, 0, '2022-05-26 03:34:34', '2022-05-26 03:34:34'),
(537, 'provider', 15, 15, 0, '2022-05-26 03:38:09', '2022-05-26 03:38:09'),
(538, 'provider', 15, 15, 0, '2022-05-26 03:48:40', '2022-05-26 03:48:40'),
(539, 'provider', 15, 15, 0, '2022-05-26 04:08:43', '2022-05-26 04:08:43'),
(540, 'provider', 15, 15, 0, '2022-05-26 04:15:00', '2022-05-26 04:15:00'),
(541, 'provider', 15, 15, 0, '2022-05-26 04:15:10', '2022-05-26 04:15:10'),
(542, 'provider', 15, 15, 0, '2022-05-26 06:36:44', '2022-05-26 06:36:44'),
(543, 'provider', 15, 15, 0, '2022-05-26 06:36:47', '2022-05-26 06:36:47'),
(544, 'provider', 15, 15, 0, '2022-05-26 06:36:50', '2022-05-26 06:36:50'),
(545, 'provider', 15, 15, 0, '2022-05-26 06:37:04', '2022-05-26 06:37:04'),
(546, 'provider', 15, 15, 0, '2022-05-26 06:48:07', '2022-05-26 06:48:07'),
(547, 'provider', 15, 15, 0, '2022-05-26 06:48:18', '2022-05-26 06:48:18'),
(548, 'provider', 15, 15, 0, '2022-05-26 06:49:04', '2022-05-26 06:49:04'),
(549, 'provider', 15, 15, 0, '2022-05-26 06:50:17', '2022-05-26 06:50:17'),
(550, 'provider', 15, 15, 0, '2022-05-26 06:50:52', '2022-05-26 06:50:52'),
(551, 'provider', 15, 15, 0, '2022-05-26 06:51:09', '2022-05-26 06:51:09'),
(552, 'provider', 15, 15, 0, '2022-05-26 06:51:42', '2022-05-26 06:51:42'),
(553, 'provider', 15, 15, 0, '2022-05-26 06:52:40', '2022-05-26 06:52:40'),
(554, 'provider', 15, 15, 0, '2022-05-26 06:53:59', '2022-05-26 06:53:59'),
(555, 'provider', 15, 15, 0, '2022-05-26 06:54:39', '2022-05-26 06:54:39'),
(556, 'provider', 15, 15, 0, '2022-05-26 06:55:26', '2022-05-26 06:55:26'),
(557, 'provider', 15, 15, 0, '2022-05-26 06:56:04', '2022-05-26 06:56:04'),
(558, 'provider', 15, 15, 0, '2022-05-26 06:56:21', '2022-05-26 06:56:21'),
(559, 'provider', 15, 15, 0, '2022-05-26 06:56:32', '2022-05-26 06:56:32'),
(560, 'provider', 15, 15, 0, '2022-05-26 06:57:24', '2022-05-26 06:57:24'),
(561, 'provider', 15, 15, 0, '2022-05-26 07:00:18', '2022-05-26 07:00:18'),
(562, 'provider', 15, 15, 0, '2022-05-26 07:01:21', '2022-05-26 07:01:21'),
(563, 'provider', 15, 15, 0, '2022-05-26 07:08:44', '2022-05-26 07:08:44'),
(564, 'provider', 15, 15, 0, '2022-05-26 07:08:59', '2022-05-26 07:08:59'),
(565, 'provider', 15, 15, 0, '2022-05-26 07:09:09', '2022-05-26 07:09:09'),
(566, 'provider', 15, 15, 0, '2022-05-26 07:09:27', '2022-05-26 07:09:27'),
(567, 'provider', 15, 15, 0, '2022-05-26 07:09:40', '2022-05-26 07:09:40'),
(568, 'provider', 15, 15, 0, '2022-05-26 10:57:15', '2022-05-26 10:57:15'),
(569, 'provider', 15, 15, 0, '2022-05-26 10:57:30', '2022-05-26 10:57:30'),
(570, 'provider', 15, 15, 0, '2022-05-27 01:38:56', '2022-05-27 01:38:56'),
(571, 'provider', 15, 15, 0, '2022-05-27 01:39:08', '2022-05-27 01:39:08'),
(572, 'provider', 15, 15, 0, '2022-05-27 01:40:02', '2022-05-27 01:40:02'),
(573, 'provider', 15, 15, 0, '2022-05-27 01:40:28', '2022-05-27 01:40:28'),
(574, 'provider', 15, 15, 0, '2022-05-27 01:40:41', '2022-05-27 01:40:41'),
(575, 'provider', 15, 15, 0, '2022-05-27 01:40:45', '2022-05-27 01:40:45'),
(576, 'provider', 15, 15, 0, '2022-05-27 01:40:56', '2022-05-27 01:40:56'),
(577, 'provider', 15, 15, 0, '2022-05-27 01:50:18', '2022-05-27 01:50:18'),
(578, 'provider', 15, 15, 0, '2022-05-27 01:50:39', '2022-05-27 01:50:39'),
(579, 'provider', 15, 15, 0, '2022-05-27 01:54:14', '2022-05-27 01:54:14'),
(580, 'provider', 15, 15, 0, '2022-05-27 01:59:26', '2022-05-27 01:59:26'),
(581, 'provider', 15, 15, 0, '2022-05-27 02:09:48', '2022-05-27 02:09:48'),
(582, 'provider', 15, 15, 0, '2022-05-27 03:57:17', '2022-05-27 03:57:17'),
(583, 'provider', 15, 15, 0, '2022-05-27 04:00:11', '2022-05-27 04:00:11'),
(584, 'provider', 15, 15, 0, '2022-05-27 04:00:36', '2022-05-27 04:00:36'),
(585, 'provider', 15, 15, 0, '2022-05-27 04:06:22', '2022-05-27 04:06:22'),
(586, 'provider', 15, 15, 0, '2022-05-27 04:07:18', '2022-05-27 04:07:18'),
(587, 'customer', 16, 15, 0, '2022-05-30 23:37:49', '2022-05-30 23:37:49'),
(588, 'customer', 16, 15, 0, '2022-05-30 23:42:13', '2022-05-30 23:42:13'),
(589, 'customer', 16, 15, 0, '2022-05-30 23:42:20', '2022-05-30 23:42:20'),
(590, 'provider', 15, 15, 0, '2022-05-31 03:59:24', '2022-05-31 03:59:24'),
(591, 'customer', 16, 15, 1, '2022-05-31 04:57:23', '2022-05-31 04:57:23'),
(592, 'provider', 15, 15, 0, '2022-05-31 04:57:44', '2022-05-31 04:57:44'),
(593, 'provider', 15, 15, 0, '2022-05-31 05:34:31', '2022-05-31 05:34:31'),
(594, 'provider', 15, 15, 0, '2022-06-01 04:28:00', '2022-06-01 04:28:00'),
(595, 'provider', 15, 14, 0, '2022-06-01 04:28:31', '2022-06-01 04:28:31'),
(596, 'provider', 15, 15, 0, '2022-06-01 04:29:09', '2022-06-01 04:29:09'),
(597, 'provider', 15, 15, 0, '2022-06-02 00:01:42', '2022-06-02 00:01:42'),
(598, 'provider', 15, 15, 0, '2022-06-02 00:12:10', '2022-06-02 00:12:10'),
(599, 'provider', 15, 15, 0, '2022-06-02 00:20:14', '2022-06-02 00:20:14'),
(600, 'provider', 15, 15, 0, '2022-06-02 00:21:24', '2022-06-02 00:21:24'),
(601, 'provider', 15, 15, 0, '2022-06-02 00:26:49', '2022-06-02 00:26:49'),
(602, 'provider', 15, 15, 0, '2022-06-02 00:28:53', '2022-06-02 00:28:53'),
(603, 'provider', 15, 15, 0, '2022-06-02 11:29:02', '2022-06-02 11:29:02'),
(604, 'provider', 15, 15, 0, '2022-06-02 11:46:48', '2022-06-02 11:46:48'),
(605, 'provider', 15, 15, 0, '2022-06-03 04:14:44', '2022-06-03 04:14:44'),
(606, 'customer', 16, 15, 0, '2022-06-03 04:21:33', '2022-06-03 04:21:33'),
(607, 'customer', 16, 15, 0, '2022-06-03 04:46:12', '2022-06-03 04:46:12'),
(608, 'provider', 15, 15, 0, '2022-06-03 04:48:52', '2022-06-03 04:48:52'),
(609, 'provider', 15, 15, 0, '2022-06-03 04:49:02', '2022-06-03 04:49:02'),
(610, 'customer', 16, 15, 0, '2022-06-03 04:50:52', '2022-06-03 04:50:52'),
(611, 'provider', 15, 15, 0, '2022-06-03 04:50:58', '2022-06-03 04:50:58'),
(612, 'provider', 15, 15, 0, '2022-06-03 04:51:07', '2022-06-03 04:51:07'),
(613, 'provider', 15, 15, 0, '2022-06-06 09:26:55', '2022-06-06 09:26:55'),
(614, 'provider', 15, 15, 0, '2022-06-06 09:38:11', '2022-06-06 09:38:11'),
(615, 'provider', 15, 15, 0, '2022-06-06 09:39:14', '2022-06-06 09:39:14'),
(616, 'provider', 15, 15, 0, '2022-06-06 09:47:04', '2022-06-06 09:47:04'),
(617, 'provider', 15, 15, 0, '2022-06-06 09:56:09', '2022-06-06 09:56:09'),
(618, 'customer', 16, 15, 0, '2022-06-08 02:16:32', '2022-06-08 02:16:32'),
(619, 'customer', 16, 15, 0, '2022-06-08 02:17:33', '2022-06-08 02:17:33'),
(620, 'customer', 16, 15, 0, '2022-06-08 02:18:15', '2022-06-08 02:18:15'),
(621, 'customer', 16, 15, 0, '2022-06-08 02:21:51', '2022-06-08 02:21:51'),
(622, 'customer', 16, 15, 0, '2022-06-08 07:04:17', '2022-06-08 07:04:17'),
(623, 'provider', 15, 15, 0, '2022-06-08 07:18:58', '2022-06-08 07:18:58'),
(624, 'provider', 15, 15, 0, '2022-06-09 04:21:42', '2022-06-09 04:21:42'),
(625, 'customer', 16, 14, 0, '2022-06-09 04:56:55', '2022-06-09 04:56:55'),
(626, 'provider', 15, 15, 0, '2022-06-09 06:29:31', '2022-06-09 06:29:31'),
(627, 'provider', 15, 15, 0, '2022-06-09 09:12:32', '2022-06-09 09:12:32'),
(628, 'customer', 16, 15, 1, '2022-06-09 09:15:11', '2022-06-09 09:15:11'),
(629, 'customer', 16, 11, 1, '2022-06-09 09:17:14', '2022-06-09 09:17:14'),
(630, 'provider', 15, 15, 0, '2022-06-09 09:26:41', '2022-06-09 09:26:41'),
(631, 'provider', 15, 15, 0, '2022-06-09 09:30:15', '2022-06-09 09:30:15'),
(632, 'provider', 15, 15, 0, '2022-06-09 09:32:19', '2022-06-09 09:32:19'),
(633, 'provider', 15, 15, 0, '2022-06-09 09:44:24', '2022-06-09 09:44:24'),
(634, 'provider', 15, 15, 0, '2022-06-10 02:26:59', '2022-06-10 02:26:59'),
(635, 'provider', 15, 15, 0, '2022-06-10 02:27:39', '2022-06-10 02:27:39'),
(636, 'provider', 15, 15, 0, '2022-06-10 02:27:54', '2022-06-10 02:27:54'),
(637, 'provider', 15, 15, 0, '2022-06-10 02:31:05', '2022-06-10 02:31:05'),
(638, 'provider', 15, 15, 0, '2022-06-10 02:33:58', '2022-06-10 02:33:58'),
(639, 'provider', 15, 15, 0, '2022-06-10 02:34:57', '2022-06-10 02:34:57'),
(640, 'provider', 15, 15, 0, '2022-06-10 02:35:00', '2022-06-10 02:35:00'),
(641, 'provider', 15, 15, 0, '2022-06-10 02:37:41', '2022-06-10 02:37:41'),
(642, 'provider', 15, 15, 0, '2022-06-10 02:38:12', '2022-06-10 02:38:12'),
(643, 'provider', 15, 15, 0, '2022-06-10 02:39:12', '2022-06-10 02:39:12'),
(644, 'provider', 15, 15, 0, '2022-06-10 02:39:42', '2022-06-10 02:39:42'),
(645, 'provider', 15, 15, 0, '2022-06-10 02:41:31', '2022-06-10 02:41:31'),
(646, 'provider', 15, 15, 0, '2022-06-10 02:42:41', '2022-06-10 02:42:41'),
(647, 'provider', 15, 15, 0, '2022-06-10 02:44:34', '2022-06-10 02:44:34'),
(648, 'provider', 15, 15, 0, '2022-06-10 02:44:56', '2022-06-10 02:44:56'),
(649, 'provider', 15, 15, 0, '2022-06-10 02:45:19', '2022-06-10 02:45:19'),
(650, 'provider', 15, 15, 0, '2022-06-10 02:45:26', '2022-06-10 02:45:26'),
(651, 'provider', 15, 15, 0, '2022-06-10 02:45:32', '2022-06-10 02:45:32'),
(652, 'provider', 15, 15, 0, '2022-06-10 02:45:39', '2022-06-10 02:45:39'),
(653, 'provider', 15, 15, 0, '2022-06-10 02:46:15', '2022-06-10 02:46:15'),
(654, 'provider', 15, 15, 0, '2022-06-10 02:46:52', '2022-06-10 02:46:52'),
(655, 'provider', 15, 15, 0, '2022-06-10 02:47:39', '2022-06-10 02:47:39'),
(656, 'provider', 15, 15, 0, '2022-06-10 02:48:52', '2022-06-10 02:48:52'),
(657, 'provider', 15, 15, 0, '2022-06-10 02:56:20', '2022-06-10 02:56:20'),
(658, 'provider', 15, 15, 0, '2022-06-10 02:57:16', '2022-06-10 02:57:16'),
(659, 'provider', 15, 15, 0, '2022-06-10 02:59:39', '2022-06-10 02:59:39'),
(660, 'provider', 15, 15, 0, '2022-06-10 02:59:59', '2022-06-10 02:59:59'),
(661, 'provider', 15, 15, 0, '2022-06-10 03:00:14', '2022-06-10 03:00:14'),
(662, 'provider', 15, 15, 0, '2022-06-10 03:00:39', '2022-06-10 03:00:39'),
(663, 'provider', 15, 15, 0, '2022-06-10 07:32:30', '2022-06-10 07:32:30'),
(664, 'provider', 15, 15, 0, '2022-06-10 07:33:21', '2022-06-10 07:33:21'),
(665, 'provider', 15, 15, 0, '2022-06-10 07:38:31', '2022-06-10 07:38:31'),
(666, 'provider', 15, 15, 0, '2022-06-10 07:39:20', '2022-06-10 07:39:20'),
(667, 'provider', 15, 15, 0, '2022-06-10 07:39:46', '2022-06-10 07:39:46'),
(668, 'provider', 15, 15, 0, '2022-06-10 07:44:18', '2022-06-10 07:44:18'),
(669, 'provider', 15, 15, 0, '2022-06-10 07:47:00', '2022-06-10 07:47:00'),
(670, 'provider', 15, 15, 0, '2022-06-10 07:55:48', '2022-06-10 07:55:48'),
(671, 'provider', 15, 15, 0, '2022-06-10 07:58:21', '2022-06-10 07:58:21'),
(672, 'provider', 15, 15, 0, '2022-06-10 08:00:32', '2022-06-10 08:00:32'),
(673, 'provider', 15, 15, 0, '2022-06-10 08:02:21', '2022-06-10 08:02:21'),
(674, 'provider', 15, 15, 0, '2022-06-10 08:03:33', '2022-06-10 08:03:33'),
(675, 'provider', 15, 15, 0, '2022-06-10 08:24:03', '2022-06-10 08:24:03');
INSERT INTO `profile_visits` (`id`, `user_type`, `user_id`, `trader_id`, `contacted`, `created_at`, `updated_at`) VALUES
(676, 'provider', 15, 15, 0, '2022-06-10 08:27:10', '2022-06-10 08:27:10'),
(677, 'provider', 15, 15, 0, '2022-06-10 08:30:13', '2022-06-10 08:30:13'),
(678, 'provider', 15, 15, 0, '2022-06-10 08:30:29', '2022-06-10 08:30:29'),
(679, 'provider', 15, 15, 0, '2022-06-13 03:14:47', '2022-06-13 03:14:47'),
(680, 'provider', 15, 15, 0, '2022-06-13 07:51:53', '2022-06-13 07:51:53'),
(681, 'provider', 15, 15, 0, '2022-06-13 09:00:22', '2022-06-13 09:00:22'),
(682, 'provider', 15, 15, 0, '2022-06-13 10:57:54', '2022-06-13 10:57:54'),
(683, 'provider', 15, 15, 0, '2022-06-14 07:42:26', '2022-06-14 07:42:26'),
(684, 'provider', 15, 15, 0, '2022-06-14 07:44:12', '2022-06-14 07:44:12'),
(685, 'provider', 15, 15, 0, '2022-06-14 07:44:41', '2022-06-14 07:44:41'),
(686, 'provider', 15, 15, 0, '2022-06-14 07:45:13', '2022-06-14 07:45:13'),
(687, 'provider', 15, 15, 0, '2022-06-14 07:45:30', '2022-06-14 07:45:30'),
(688, 'provider', 15, 15, 0, '2022-06-14 07:45:42', '2022-06-14 07:45:42'),
(689, 'provider', 15, 15, 0, '2022-06-14 07:49:09', '2022-06-14 07:49:09'),
(690, 'provider', 15, 15, 0, '2022-06-14 07:49:53', '2022-06-14 07:49:53'),
(691, 'provider', 15, 15, 0, '2022-06-14 07:50:34', '2022-06-14 07:50:34'),
(692, 'provider', 15, 15, 0, '2022-06-14 07:53:18', '2022-06-14 07:53:18'),
(693, 'provider', 15, 15, 0, '2022-06-14 07:54:15', '2022-06-14 07:54:15'),
(694, 'provider', 15, 15, 0, '2022-06-14 07:58:29', '2022-06-14 07:58:29'),
(695, 'provider', 15, 15, 0, '2022-06-14 08:00:45', '2022-06-14 08:00:45'),
(696, 'provider', 15, 15, 0, '2022-06-14 08:01:17', '2022-06-14 08:01:17'),
(697, 'provider', 15, 15, 0, '2022-06-14 08:01:46', '2022-06-14 08:01:46'),
(698, 'provider', 15, 15, 0, '2022-06-14 08:02:09', '2022-06-14 08:02:09'),
(699, 'provider', 15, 15, 0, '2022-06-14 08:02:11', '2022-06-14 08:02:11'),
(700, 'provider', 15, 15, 0, '2022-06-14 08:02:51', '2022-06-14 08:02:51'),
(701, 'provider', 15, 15, 0, '2022-06-14 08:03:23', '2022-06-14 08:03:23'),
(702, 'provider', 15, 15, 0, '2022-06-14 08:03:50', '2022-06-14 08:03:50'),
(703, 'provider', 15, 15, 0, '2022-06-14 08:08:18', '2022-06-14 08:08:18'),
(704, 'provider', 15, 15, 0, '2022-06-14 08:10:20', '2022-06-14 08:10:20'),
(705, 'provider', 15, 15, 0, '2022-06-14 08:11:01', '2022-06-14 08:11:01'),
(706, 'provider', 15, 15, 0, '2022-06-14 08:11:37', '2022-06-14 08:11:37'),
(707, 'provider', 15, 15, 0, '2022-06-14 08:11:47', '2022-06-14 08:11:47'),
(708, 'provider', 15, 15, 0, '2022-06-14 08:13:47', '2022-06-14 08:13:47'),
(709, 'provider', 15, 15, 0, '2022-06-14 08:15:31', '2022-06-14 08:15:31'),
(710, 'provider', 15, 15, 0, '2022-06-14 08:16:41', '2022-06-14 08:16:41'),
(711, 'provider', 15, 15, 0, '2022-06-14 08:20:41', '2022-06-14 08:20:41'),
(712, 'provider', 15, 15, 0, '2022-06-14 08:21:54', '2022-06-14 08:21:54'),
(713, 'provider', 15, 15, 0, '2022-06-14 08:23:12', '2022-06-14 08:23:12'),
(714, 'provider', 15, 15, 0, '2022-06-14 09:28:56', '2022-06-14 09:28:56'),
(715, 'provider', 15, 15, 0, '2022-06-14 09:32:31', '2022-06-14 09:32:31'),
(716, 'provider', 15, 15, 0, '2022-06-14 09:34:28', '2022-06-14 09:34:28'),
(717, 'provider', 15, 15, 0, '2022-06-14 09:34:31', '2022-06-14 09:34:31'),
(718, 'provider', 15, 15, 0, '2022-06-14 09:35:47', '2022-06-14 09:35:47'),
(719, 'provider', 15, 15, 0, '2022-06-14 09:36:54', '2022-06-14 09:36:54'),
(720, 'provider', 15, 15, 0, '2022-06-14 09:40:54', '2022-06-14 09:40:54'),
(721, 'provider', 15, 15, 0, '2022-06-14 09:41:07', '2022-06-14 09:41:07'),
(722, 'provider', 15, 15, 0, '2022-06-14 09:42:16', '2022-06-14 09:42:16'),
(723, 'provider', 15, 15, 0, '2022-06-14 09:43:44', '2022-06-14 09:43:44'),
(724, 'provider', 15, 15, 0, '2022-06-14 09:44:02', '2022-06-14 09:44:02'),
(725, 'provider', 15, 15, 0, '2022-06-14 09:44:11', '2022-06-14 09:44:11'),
(726, 'provider', 15, 15, 0, '2022-06-14 09:46:17', '2022-06-14 09:46:17'),
(727, 'provider', 15, 15, 0, '2022-06-14 09:47:56', '2022-06-14 09:47:56'),
(728, 'provider', 15, 15, 0, '2022-06-14 09:55:45', '2022-06-14 09:55:45'),
(729, 'provider', 15, 15, 0, '2022-06-14 09:55:48', '2022-06-14 09:55:48'),
(730, 'provider', 15, 15, 0, '2022-06-14 09:56:08', '2022-06-14 09:56:08'),
(731, 'provider', 15, 15, 0, '2022-06-15 05:54:35', '2022-06-15 05:54:35'),
(732, 'provider', 15, 15, 0, '2022-06-15 05:56:08', '2022-06-15 05:56:08'),
(733, 'provider', 15, 15, 0, '2022-06-15 05:56:52', '2022-06-15 05:56:52'),
(734, 'provider', 15, 15, 0, '2022-06-15 07:28:55', '2022-06-15 07:28:55'),
(735, 'provider', 15, 15, 0, '2022-06-15 07:29:53', '2022-06-15 07:29:53'),
(736, 'provider', 15, 15, 0, '2022-06-15 07:32:24', '2022-06-15 07:32:24'),
(737, 'provider', 15, 15, 0, '2022-06-15 07:35:17', '2022-06-15 07:35:17'),
(738, 'provider', 15, 15, 0, '2022-06-15 07:35:30', '2022-06-15 07:35:30'),
(739, 'provider', 15, 15, 0, '2022-06-15 07:36:14', '2022-06-15 07:36:14'),
(740, 'provider', 15, 15, 0, '2022-06-15 07:36:38', '2022-06-15 07:36:38'),
(741, 'provider', 15, 15, 0, '2022-06-15 07:41:16', '2022-06-15 07:41:16'),
(742, 'provider', 15, 15, 0, '2022-06-15 07:41:37', '2022-06-15 07:41:37'),
(743, 'provider', 15, 15, 0, '2022-06-15 07:42:54', '2022-06-15 07:42:54'),
(744, 'provider', 15, 15, 0, '2022-06-15 07:43:18', '2022-06-15 07:43:18'),
(745, 'provider', 15, 15, 0, '2022-06-15 07:47:22', '2022-06-15 07:47:22'),
(746, 'provider', 15, 15, 0, '2022-06-15 07:47:52', '2022-06-15 07:47:52'),
(747, 'provider', 15, 15, 0, '2022-06-15 07:48:13', '2022-06-15 07:48:13'),
(748, 'provider', 15, 15, 0, '2022-06-15 07:49:46', '2022-06-15 07:49:46'),
(749, 'provider', 15, 15, 0, '2022-06-16 03:46:05', '2022-06-16 03:46:05'),
(750, 'provider', 15, 15, 0, '2022-06-17 15:04:33', '2022-06-17 15:04:33'),
(751, 'provider', 15, 15, 0, '2022-06-20 05:07:20', '2022-06-20 05:07:20'),
(752, 'provider', 15, 15, 0, '2022-06-20 05:09:31', '2022-06-20 05:09:31'),
(753, 'provider', 15, 15, 0, '2022-06-20 05:09:52', '2022-06-20 05:09:52'),
(754, 'provider', 15, 15, 0, '2022-06-20 05:21:01', '2022-06-20 05:21:01'),
(755, 'provider', 15, 15, 0, '2022-06-20 05:23:47', '2022-06-20 05:23:47'),
(756, 'provider', 15, 15, 0, '2022-06-20 05:24:18', '2022-06-20 05:24:18'),
(757, 'provider', 15, 15, 0, '2022-06-20 05:24:52', '2022-06-20 05:24:52'),
(758, 'provider', 15, 15, 0, '2022-06-20 05:25:45', '2022-06-20 05:25:45'),
(759, 'provider', 15, 15, 0, '2022-06-20 05:26:28', '2022-06-20 05:26:28'),
(760, 'provider', 15, 15, 0, '2022-06-20 05:28:52', '2022-06-20 05:28:52'),
(761, 'provider', 15, 15, 0, '2022-06-20 05:29:29', '2022-06-20 05:29:29'),
(762, 'provider', 15, 15, 0, '2022-06-20 05:33:14', '2022-06-20 05:33:14'),
(763, 'provider', 15, 15, 0, '2022-06-20 05:33:30', '2022-06-20 05:33:30'),
(764, 'provider', 15, 15, 0, '2022-06-20 05:33:48', '2022-06-20 05:33:48'),
(765, 'provider', 15, 15, 0, '2022-06-20 05:34:24', '2022-06-20 05:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handyman` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `loc_latitude` double NOT NULL,
  `loc_longitude` double NOT NULL,
  `landmark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_latitude` double NOT NULL,
  `land_longitude` double NOT NULL,
  `landmark_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_location_radius` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_time_from` int(11) NOT NULL,
  `available_time_to` int(11) NOT NULL,
  `is_available` tinyint(4) NOT NULL,
  `appointment` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `reference` tinyint(4) NOT NULL,
  `rating` double(8,2) NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qrcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed_works` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `type`, `main_category`, `handyman`, `name`, `email`, `username`, `web_url`, `country_code`, `mobile`, `address`, `location`, `loc_latitude`, `loc_longitude`, `landmark`, `land_latitude`, `land_longitude`, `landmark_data`, `service_location_radius`, `available_time_from`, `available_time_to`, `is_available`, `appointment`, `status`, `featured`, `reference`, `rating`, `profile_pic`, `qrcode`, `completed_works`, `created_at`, `updated_at`) VALUES
(6, 'Company', '', 0, 'Vinod', 'vinod@legacit.com', 'vinod', '', '91', '9605591928', 'vinod, legacit', 'Cherthala, Kerala, India', 9.674136299999999, 76.3400963, '', 0, 0, '', '', 1619168400, 1619200800, 1, 0, 1, 0, 1, 5.00, '1619084995_avatar4.png', '1619084995_6.svg', '<p>completed works more precisely</p>', '2021-04-22 04:19:55', '2021-04-23 00:19:36'),
(7, 'Individual', '', 0, 'Kannan', 'kannan@gmail.com', 'kannan', '', '91', '9495591928', 'kannan, legacit', 'Alleppey, Kerala, India', 9.498066699999999, 76.3388484, '', 0, 0, '', '', 1619168880, 1619190480, 1, 0, 1, 1, 1, 2.00, '1619156404_download.png', '1619156404_7.svg', '<p>dfgs dfghs d gdsgf sdxfg dfgdf</p><p>d sf</p><p>gds</p><p>dfgdfgds dsfgdfgdftghfrth</p>', '2021-04-23 00:10:04', '2021-04-23 00:19:54'),
(9, '', '', 0, 'Provider 1', 'sony123@gmail.com', 'sony123', '', '91', '9605591928', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0.00, '', '', '', '2021-05-20 05:34:23', '2021-05-20 05:34:23'),
(10, 'Company', '', 0, 'Sony Kuriakose', 'sonymgottil@gmail.com', 'sonymgottil', '', '973', '9605591928', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, 0, -1, 0, 0, 0.00, '', '', '', '2021-05-20 05:43:40', '2021-09-03 04:48:35'),
(11, 'Company', 'Service', 0, 'bobby', 'bobby@legacit.com', 'bobby', 'legacit.com', '91', '9876543210', ';legacit', 'Kakkanad, Kerala, India', 10.0158605, 76.3418666, 'SmartCity Kochi, Infopark Road, Kakkanad, Kochi, Kerala, India', 10.0119353, 10.0119353, 'opp infopark', '', 1630573200, 1630605600, 1, 0, 1, 0, 1, 2.00, '1632141853_Sony Kuriakose.jpg', '1630506651_11.svg', '<p>dsfgdg</p>', '2021-09-01 09:00:51', '2021-09-01 22:32:56'),
(14, 'Individual', '', 0, 'Anu', 'sony@legacit.in', 'anualias', '', '91', '9495591928', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, 0, 1, 0, 0, 0.00, '1619156404_download.png', '1631793135_14.svg', '', '2021-09-16 06:22:15', '2021-09-16 06:22:15'),
(15, 'Individual', 'Service', 0, 'Sony Kuriakose', 'sonymangottil@gmail.com', 'sonymangottil', 'www.legacit.com', '91', '9605591928', 'legacit.\r\nkochi ,kakkanad,kochi\r\ndsxfgd dfgdg ergse', 'Legacit Infotech Pvt Ltd, Kochi, Kerala, India', 10.0126684, 76.36615669999999, 'Infopark Kochi, Infopark Campus, Kochi, Kerala, India', 10.0115718, 10.0115718, 'opp infopark kochi dfs wertyuighf dfg', '10', 1655100780, 1655061180, 1, 1, 1, 0, 0, 0.00, '1632141853_Sony Kuriakose.jpg', '1632141853_15.svg', 'completed works', '2021-09-20 07:14:13', '2022-06-13 11:07:20'),
(18, 'Individual', '', 0, 'Neha', 'neha@gmail.com', 'neha', '', '91', '8281055928', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0.00, '', '1652961714_18.svg', '', '2022-05-19 06:31:54', '2022-05-19 06:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `provider_categories`
--

CREATE TABLE `provider_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_categories`
--

INSERT INTO `provider_categories` (`id`, `provider_id`, `category_id`, `sub_category_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 7, 1, 0, 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(8, 7, 3, 0, 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(9, 6, 1, 0, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(10, 6, 2, 0, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(14, 11, 1, 2, 1, '2021-09-01 22:32:56', '2021-09-01 22:32:56'),
(169, 15, 1, 2, 1, '2022-06-09 09:33:15', '2022-06-09 09:33:15'),
(170, 15, 1, 5, 1, '2022-06-09 09:33:15', '2022-06-09 09:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `provider_documents`
--

CREATE TABLE `provider_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `proof_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_later` tinyint(4) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_documents`
--

INSERT INTO `provider_documents` (`id`, `provider_id`, `proof_type`, `id_type`, `id_number`, `document`, `upload_later`, `verified`, `status`, `created_at`, `updated_at`) VALUES
(7, 6, 'ID Proof', 'Aadhar Card', '12345', '1619084996_avatar.png', 0, 1, 1, '2021-04-22 04:19:56', '2021-04-23 00:19:27'),
(8, 6, 'Address Proof', 'Voter\'s ID', '6789', '1619084996_avatar2.png', 0, 1, 1, '2021-04-22 04:19:56', '2021-04-23 00:19:30'),
(9, 7, 'ID Proof', 'Aadhar Card', 'dfsgdsrg', '1619156404_avatar4.png', 0, 1, 1, '2021-04-23 00:10:04', '2021-04-23 00:19:45'),
(10, 7, 'Address Proof', 'Voter\'s ID', 'dfghfrtgh', '1619156404_avatar5.png', 0, 1, 1, '2021-04-23 00:10:04', '2021-04-23 00:19:50'),
(11, 9, 'ID Proof', '', '', '', 0, 0, 0, '2021-05-20 05:34:23', '2021-05-20 05:34:23'),
(12, 9, 'Address Proof', '', '', '', 0, 0, 0, '2021-05-20 05:34:23', '2021-05-20 05:34:23'),
(13, 10, 'ID Proof', '', '', '', 0, 0, 0, '2021-05-20 05:43:40', '2021-05-20 05:43:40'),
(14, 10, 'Address Proof', '', '', '', 0, 0, 0, '2021-05-20 05:43:40', '2021-05-20 05:43:40'),
(15, 11, 'ID Proof', 'Aadhar Card', '123', '1630506651_App Requirements - JoWalk.docx', 0, 1, 1, '2021-09-01 09:00:51', '2021-09-01 09:00:51'),
(16, 11, 'Address Proof', 'Voter\'s ID', '456', '1630506651_App Requirements - JoWalk_Ver 1.0.docx', 0, 1, 1, '2021-09-01 09:00:51', '2021-09-01 09:00:51'),
(21, 14, 'ID Proof', '', '', '', 0, 0, 0, '2021-09-16 06:22:15', '2021-09-16 06:22:15'),
(22, 14, 'Address Proof', '', '', '', 0, 0, 0, '2021-09-16 06:22:15', '2021-09-16 06:22:15'),
(23, 15, 'ID Proof', 'Voter\'s ID', '123', '1632141853_App Requirements - JoWalk.docx', 1, 1, 1, '2021-09-20 07:14:13', '2022-02-06 23:15:50'),
(24, 15, 'Address Proof', 'Driving License', '456', '1632141853_App Requirements - JoWalk_Ver 1.0.docx', 0, 1, 1, '2021-09-20 07:14:13', '2022-03-05 02:56:24'),
(25, 18, 'ID Proof', '', '', '', 0, 0, 0, '2022-05-19 06:31:54', '2022-05-19 06:31:54'),
(26, 18, 'Address Proof', '', '', '', 0, 0, 0, '2022-05-19 06:31:54', '2022-05-19 06:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `provider_services`
--

CREATE TABLE `provider_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_services`
--

INSERT INTO `provider_services` (`id`, `provider_id`, `service_id`, `status`, `created_at`, `updated_at`) VALUES
(8, 7, 1, 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(9, 7, 2, 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(10, 6, 1, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(11, 6, 2, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(12, 6, 3, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(16, 11, 6, 1, '2021-09-01 22:32:56', '2021-09-01 22:32:56'),
(226, 15, 1, 1, '2022-06-09 09:33:15', '2022-06-09 09:33:15'),
(227, 15, 3, 1, '2022-06-09 09:33:15', '2022-06-09 09:33:15'),
(228, 15, 5, 1, '2022-06-09 09:33:15', '2022-06-09 09:33:15'),
(229, 15, 6, 1, '2022-06-09 09:33:15', '2022-06-09 09:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `provider_service_locations`
--

CREATE TABLE `provider_service_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_service_locations`
--

INSERT INTO `provider_service_locations` (`id`, `provider_id`, `service_id`, `location`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(8, 7, 1, 'Alappuzha, Kerala, India', 9.498066699999999, 76, 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(9, 7, 2, 'Alappuzha, Kerala, India', 9.498066699999999, 76, 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(10, 6, 1, 'Alappuzha, Kerala, India', 9.4980667, 76, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(11, 6, 2, 'Alappuzha, Kerala, India', 9.4980667, 76, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(12, 6, 3, 'Alappuzha, Kerala, India', 9.4980667, 76, 1, '2021-04-23 00:12:30', '2021-04-23 00:12:30'),
(16, 11, 6, 'Kochi, Kerala, India', 9.9312328, 76, 1, '2021-09-01 22:32:56', '2021-09-01 22:32:56'),
(38, 15, 5, 'Edappally, Kochi, Kerala, India', 10.0260688, 76, 1, '2022-01-17 01:18:43', '2022-01-17 01:18:43'),
(39, 15, 5, 'Kakkanad, Kerala, India', 10.0158605, 76, 1, '2022-01-17 01:18:43', '2022-01-17 01:18:43'),
(40, 15, 6, 'Edappally, Kochi, Kerala, India', 10.0260688, 76, 1, '2022-01-17 01:18:43', '2022-01-17 01:18:43'),
(41, 15, 6, 'Kakkanad, Kerala, India', 10.0158605, 76, 1, '2022-01-17 01:18:43', '2022-01-17 01:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `provider_works`
--

CREATE TABLE `provider_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_works`
--

INSERT INTO `provider_works` (`id`, `provider_id`, `service_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 6, 0, '1619084996_photo1.png', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(7, 6, 0, '1619084996_photo2.png', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(8, 6, 0, '1619084996_photo3.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(9, 6, 0, '1619084996_photo4.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(10, 6, 0, '1619084996_prod-1.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(11, 6, 0, '1619084996_user1-128x128.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(12, 6, 0, '1619084996_user2-160x160.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(13, 6, 0, '1619084996_user3-128x128.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(14, 6, 0, '1619084996_user4-128x128.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(15, 6, 0, '1619084996_user5-128x128.jpg', 1, '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(16, 7, 0, '1619156404_photo1.png', 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(17, 7, 0, '1619156404_photo2.png', 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(18, 7, 0, '1619156404_photo3.jpg', 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(19, 7, 0, '1619156404_photo4.jpg', 1, '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(20, 11, 0, '1630506651_about.jpg', 1, '2021-09-01 09:00:51', '2021-09-01 09:00:51'),
(22, 15, 0, '1632141853_photo2.png', 1, '2021-09-20 07:14:13', '2021-09-20 07:14:13'),
(25, 15, 0, '1649075842_photo1.png', 1, '2022-04-04 07:07:22', '2022-04-04 07:07:22'),
(26, 15, 0, '1649075842_photo3.jpg', 1, '2022-04-04 07:07:23', '2022-04-04 07:07:23'),
(27, 15, 0, '1649075843_photo4.jpg', 1, '2022-04-04 07:07:23', '2022-04-04 07:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `receipt_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `user_type`, `user_id`, `title`, `remarks`, `status`, `receipt_image`, `created_at`, `updated_at`) VALUES
(5, 'provider', 15, 'fgh', 'ftghdst', 1, '1638429567_7.png', '2021-12-02 01:49:27', '2021-12-02 01:49:27'),
(6, 'provider', 15, 'new re', 'df', 1, '1638525747_user2-160x160.jpg', '2021-12-03 04:32:27', '2021-12-03 04:32:27'),
(7, 'provider', 15, 'sdfs', 'fdsf', 1, '1644227683_photo1.png', '2022-02-07 04:24:43', '2022-02-07 04:24:43'),
(14, 'customer', 16, 'gfgf', 'gfgf', 1, '1646217579_user7-128x128.jpg', '2022-03-02 05:09:39', '2022-03-02 05:09:39'),
(15, 'customer', 16, 'ytc', 'jgvhj', 1, '1646217591_avatar3.png', '2022-03-02 05:09:51', '2022-03-02 05:09:51'),
(23, 'provider', 15, 'sdf', 'sdfs', 1, '1649062811_photo1.png', '2022-04-04 03:30:12', '2022-04-04 03:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_completed` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reliability` int(11) NOT NULL,
  `tidiness` int(11) NOT NULL,
  `response` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `pricing` int(11) NOT NULL,
  `overall_exp` int(11) NOT NULL,
  `recommend` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `trader_id`, `user_id`, `work_completed`, `service_id`, `service_date`, `review`, `reliability`, `tidiness`, `response`, `accuracy`, `pricing`, `overall_exp`, `recommend`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 16, 'Yes', 1, '01-09-2021', 'test with user signed in', 1, 2, 3, 4, 5, 4, 'Yes', 1, '2021-09-02 05:42:21', '2021-09-02 05:42:21'),
(4, 15, 16, 'No', 0, '', 'dfsdf', 4, 3, 1, 1, 5, 4, 'Yes', 1, '2021-09-02 07:24:43', '2021-09-02 22:39:22'),
(5, 15, 16, 'Yes', 0, '', 'fgdf', 4, 5, 4, 5, 5, 5, 'Yes', 1, '2021-09-03 05:03:48', '2021-09-03 05:03:48'),
(6, 15, 16, 'Yes', 6, '24-09-2021', 'testig', 1, 1, 4, 5, 1, 4, 'Yes', 1, '2021-09-23 23:11:49', '2021-09-23 23:12:02'),
(7, 15, 16, 'Yes', 1, '17-03-2022', 'zfg', 2, 3, 4, 3, 3, 4, 'Yes', 1, '2022-03-29 23:06:40', '2022-03-29 23:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE `search_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `search_history` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `search_history`
--

INSERT INTO `search_history` (`id`, `user_type`, `user_id`, `trader_id`, `search_history`, `created_at`, `updated_at`) VALUES
(1, 'customer', 16, 15, '', '2021-12-07 04:41:59', NULL),
(2, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"3\"}', '2021-12-07 01:02:58', '2021-12-07 01:02:58'),
(3, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"3\"}', '2021-12-07 01:02:58', '2021-12-07 01:02:58'),
(4, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"3\"}', '2021-12-08 05:38:04', '2021-12-08 05:38:04'),
(5, 'provider', 14, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"3\"}', '2021-12-08 05:38:04', '2021-12-08 05:38:04'),
(6, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"8\"}', '2022-03-01 22:42:10', '2022-03-01 22:42:10'),
(7, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"8\"}', '2022-03-01 22:42:10', '2022-03-01 22:42:10'),
(8, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"3\"}', '2022-03-04 01:21:48', '2022-03-04 01:21:48'),
(9, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"3\"}', '2022-03-04 01:21:48', '2022-03-04 01:21:48'),
(10, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:35:30', '2022-03-04 02:35:30'),
(11, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:38:21', '2022-03-04 02:38:21'),
(12, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:39:48', '2022-03-04 02:39:48'),
(13, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:40:18', '2022-03-04 02:40:18'),
(14, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:42:28', '2022-03-04 02:42:28'),
(15, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:42:43', '2022-03-04 02:42:43'),
(16, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:51:10', '2022-03-04 02:51:10'),
(17, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:51:44', '2022-03-04 02:51:44'),
(18, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 02:52:03', '2022-03-04 02:52:03'),
(19, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:15:51', '2022-03-04 03:15:51'),
(20, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:16:10', '2022-03-04 03:16:10'),
(21, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:16:16', '2022-03-04 03:16:16'),
(22, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:16:18', '2022-03-04 03:16:18'),
(23, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:16:28', '2022-03-04 03:16:28'),
(24, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:16:33', '2022-03-04 03:16:33'),
(25, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:17:11', '2022-03-04 03:17:11'),
(26, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:17:16', '2022-03-04 03:17:16'),
(27, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:18:05', '2022-03-04 03:18:05'),
(28, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 03:18:10', '2022-03-04 03:18:10'),
(29, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-03-04 06:29:31', '2022-03-04 06:29:31'),
(30, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-04-11 12:02:16', '2022-04-11 12:02:16'),
(31, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-04-11 12:05:49', '2022-04-11 12:05:49'),
(32, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-04-11 12:06:17', '2022-04-11 12:06:17'),
(33, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-04-11 12:06:53', '2022-04-11 12:06:53'),
(34, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"9\"}', '2022-04-11 22:17:22', '2022-04-11 22:17:22'),
(35, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"9\"}', '2022-04-11 22:18:13', '2022-04-11 22:18:13'),
(36, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"9\"}', '2022-04-11 22:18:20', '2022-04-11 22:18:20'),
(37, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"9\"}', '2022-04-11 22:20:40', '2022-04-11 22:20:40'),
(38, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:14:47', '2022-05-19 04:14:47'),
(39, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:14:47', '2022-05-19 04:14:47'),
(40, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:15:19', '2022-05-19 04:15:19'),
(41, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:15:19', '2022-05-19 04:15:19'),
(42, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:16:24', '2022-05-19 04:16:24'),
(43, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:16:24', '2022-05-19 04:16:24'),
(44, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:32:27', '2022-05-19 04:32:27'),
(45, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-19 04:32:27', '2022-05-19 04:32:27'),
(46, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-30 23:42:07', '2022-05-30 23:42:07'),
(47, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-30 23:42:07', '2022-05-30 23:42:07'),
(48, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-31 04:57:09', '2022-05-31 04:57:09'),
(49, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-31 04:57:09', '2022-05-31 04:57:09'),
(50, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-31 04:57:24', '2022-05-31 04:57:24'),
(51, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"25\"}', '2022-05-31 04:57:24', '2022-05-31 04:57:24'),
(52, 'customer', 16, 15, '{\"category\":1,\"sub_category\":5,\"job\":\"22\"}', '2022-06-08 08:50:41', '2022-06-08 08:50:41'),
(53, 'customer', 16, 15, '{\"category\":\"1\",\"sub_category\":\"2\",\"job\":\"28\"}', '2022-06-09 09:14:56', '2022-06-09 09:14:56'),
(54, 'customer', 16, 11, '{\"category\":\"1\",\"sub_category\":\"2\",\"job\":\"28\"}', '2022-06-09 09:14:56', '2022-06-09 09:14:56'),
(55, 'customer', 16, 15, '{\"category\":\"1\",\"sub_category\":\"2\",\"job\":\"28\"}', '2022-06-09 09:15:11', '2022-06-09 09:15:11'),
(56, 'customer', 16, 11, '{\"category\":\"1\",\"sub_category\":\"2\",\"job\":\"28\"}', '2022-06-09 09:15:11', '2022-06-09 09:15:11'),
(57, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"28\"}', '2022-06-09 09:17:06', '2022-06-09 09:17:06'),
(58, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"28\"}', '2022-06-09 09:17:06', '2022-06-09 09:17:06'),
(59, 'customer', 16, 15, '{\"category\":1,\"sub_category\":2,\"job\":\"28\"}', '2022-06-09 09:17:14', '2022-06-09 09:17:14'),
(60, 'customer', 16, 11, '{\"category\":1,\"sub_category\":2,\"job\":\"28\"}', '2022-06-09 09:17:14', '2022-06-09 09:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category`, `sub_category`, `service`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Pipe Leakage Fix', '', 1, '2021-04-19 05:08:15', '2021-04-22 04:11:55'),
(2, 1, 0, 'Fitting', '', 1, '2021-04-22 04:16:41', '2021-04-22 04:16:41'),
(3, 2, 0, 'Check Leakage', '', 1, '2021-04-22 04:16:55', '2021-04-22 04:16:55'),
(4, 3, 0, 'Modification of house', '', 1, '2021-04-22 04:17:07', '2021-04-22 04:17:07'),
(5, 1, 2, 'Wall Painting', '', 1, '2021-04-22 04:17:19', '2021-09-01 08:04:54'),
(6, 1, 2, 'Roofing', '', 1, '2021-04-22 04:17:29', '2021-06-15 04:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_plus_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_map_api` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `description`, `phone_number`, `url`, `email`, `address`, `facebook_url`, `twitter_url`, `instagram_url`, `google_plus_url`, `linkedin_url`, `google_map_api`, `created_at`, `updated_at`) VALUES
(1, 'Uno Traders', '<font face=\"Poppins, sans-serif\" color=\"#ffffff\"><span style=\"font-size: 13px;\">Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since.</span></font>', '+123 456 78901', 'www.unotraders.com', 'sonymangottil@gmail.com', '<p><span style=\"color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">77408 Satterfield Motorway Suite 469 New</span><br style=\"margin: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\"><span style=\"color: rgb(51, 51, 51); font-family: Poppins, sans-serif; background-color: rgb(246, 246, 246);\">Antonetta, BC K3L6P6</span><br></p>', '', '', '', '', '', 'AIzaSyDNuI7bmvR7jew4NlQAc-cNXZfwmLxaqms', NULL, '2022-04-04 05:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `trader_offers`
--

CREATE TABLE `trader_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `likes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reactions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_offers`
--

INSERT INTO `trader_offers` (`id`, `trader_id`, `title`, `description`, `full_price`, `discount_price`, `valid_from`, `valid_to`, `status`, `likes`, `reactions`, `created_at`, `updated_at`) VALUES
(1, 6, 'dfxvgd', 'dsg', '100', '90', '02-09-2021 10:12 AM', '23-09-2021 10:12 AM', 1, '0', '0', '2021-09-01 23:12:52', '2021-11-17 01:47:16'),
(2, 6, 'test from ui', '', '1000', '950', '02-09-2021 11:00 AM', '30-09-2021 11:00 AM', 1, '0', '0', '2021-09-02 00:20:54', '2021-09-02 00:20:54'),
(3, 15, 'new test from ui', 'desc', '500', '489', '02-09-2021 11:21 AM', '30-09-2021 11:21 AM', 1, '0', '0', '2021-09-02 00:22:00', '2021-11-17 22:29:42'),
(4, 15, 'test product', 'description update from ui', '2000', '1899', '17-09-2021 12:51 PM', '26-09-2021 06:00 PM', 1, '0', '0', '2021-09-24 01:51:25', '2021-12-08 01:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `trader_offers_comments`
--

CREATE TABLE `trader_offers_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_comment_id` int(11) NOT NULL,
  `trader_offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_offers_comments`
--

INSERT INTO `trader_offers_comments` (`id`, `offer_comment_id`, `trader_offer_id`, `user_id`, `user_type`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 4, 15, 'provider', 'testtinnggggg', 1, '2021-09-24 01:56:31', '2021-12-08 01:59:32'),
(2, 0, 4, 16, 'customer', 'zfgdfg', 1, '2021-10-18 04:01:36', '2021-10-18 04:01:36'),
(3, 2, 4, 16, 'customer', 'reply to zfgdfg', 1, '2022-03-04 05:54:24', '2022-03-04 05:54:24'),
(4, 0, 4, 16, 'customer', 'new offer comment', 1, '2022-03-04 05:56:26', '2022-03-04 05:56:26'),
(5, 4, 4, 16, 'customer', 'reply to new offer comment', 1, '2022-03-04 05:56:44', '2022-03-04 05:56:44'),
(6, 4, 4, 16, 'customer', 'new reply', 1, '2022-03-04 05:56:56', '2022-03-04 05:56:56'),
(7, 0, 3, 16, 'customer', 'testinggggg', 1, '2022-03-04 05:57:12', '2022-03-04 05:57:12'),
(8, 0, 4, 16, 'customer', 'new offer comment from sony', 1, '2022-03-04 12:24:14', '2022-03-04 12:24:14'),
(9, 8, 4, 16, 'customer', 'reply from sk to sony', 1, '2022-03-04 12:24:29', '2022-03-04 12:24:29'),
(10, 8, 4, 16, 'customer', 'new reply', 1, '2022-03-04 12:24:37', '2022-03-04 12:24:37'),
(11, 8, 4, 16, 'customer', 'new reply 2', 1, '2022-03-04 12:24:57', '2022-03-04 12:24:57'),
(12, 8, 4, 16, 'customer', 'sdg rtrty', 1, '2022-05-17 01:38:46', '2022-05-17 01:38:46'),
(13, 4, 4, 16, 'customer', 'dsf gdsefrgsrg', 1, '2022-05-17 01:40:42', '2022-05-17 01:40:42'),
(14, 8, 4, 15, 'provider', 'df gdsftgser trtyrt', 1, '2022-05-17 01:41:04', '2022-05-17 01:41:04'),
(15, 0, 3, 15, 'provider', 'testt', 1, '2022-05-26 01:42:07', '2022-05-26 01:42:07'),
(16, 15, 3, 15, 'provider', 'test reply', 1, '2022-05-26 01:43:09', '2022-05-26 01:43:09'),
(17, 7, 3, 15, 'provider', 'sdfsdf', 1, '2022-05-26 01:47:39', '2022-05-26 01:47:39'),
(18, 0, 4, 16, 'customer', 'test offer', 1, '2022-05-26 11:31:10', '2022-05-26 11:31:10'),
(19, 18, 4, 16, 'customer', 'offer reply 1', 1, '2022-05-26 11:31:21', '2022-05-26 11:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `trader_offers_images`
--

CREATE TABLE `trader_offers_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_offer_id` int(11) NOT NULL,
  `offer_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_offers_images`
--

INSERT INTO `trader_offers_images` (`id`, `trader_offer_id`, `offer_image`, `created_at`, `updated_at`) VALUES
(1, 1, '1630557772_about.jpg', '2021-09-01 23:12:52', '2021-09-01 23:12:52'),
(2, 1, '1630557772_about-banner.jpg', '2021-09-01 23:12:52', '2021-09-01 23:12:52'),
(3, 2, '1630561854_about.jpg', '2021-09-02 00:20:54', '2021-09-02 00:20:54'),
(4, 2, '1630561854_about-banner.jpg', '2021-09-02 00:20:54', '2021-09-02 00:20:54'),
(5, 3, '1630561921_HARI6938.JPG', '2021-09-02 00:22:01', '2021-09-02 00:22:01'),
(6, 3, '1630561921_RAJV3140.JPG', '2021-09-02 00:22:01', '2021-09-02 00:22:01'),
(7, 3, '1630561921_RAJV3589.JPG', '2021-09-02 00:22:01', '2021-09-02 00:22:01'),
(8, 2, '1631770134_photo1.png', '2021-09-15 23:58:54', '2021-09-15 23:58:54'),
(9, 2, '1631770134_photo2.png', '2021-09-15 23:58:54', '2021-09-15 23:58:54'),
(12, 4, '1632468085_photo4.jpg', '2021-09-24 01:51:25', '2021-09-24 01:51:25'),
(13, 4, '1637135301_photo1.png', '2021-11-17 02:18:21', '2021-11-17 02:18:21'),
(15, 3, '1637207982_photo1.png', '2021-11-17 22:29:42', '2021-11-17 22:29:42'),
(16, 3, '1637207982_photo3.jpg', '2021-11-17 22:29:42', '2021-11-17 22:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `trader_offer_likes`
--

CREATE TABLE `trader_offer_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_offer_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_offer_likes`
--

INSERT INTO `trader_offer_likes` (`id`, `trader_offer_id`, `user_type`, `user_id`, `reaction`, `created_at`, `updated_at`) VALUES
(2, 4, 'customer', 16, 'HaHa', '2021-12-08 04:56:36', '2022-01-17 22:35:31'),
(3, 3, 'customer', 16, 'HaHa', '2021-12-08 04:56:49', '2021-12-08 04:56:49'),
(4, 4, 'provider', 15, 'Wow', '2022-01-17 22:36:00', '2022-01-17 22:41:46'),
(5, 3, 'provider', 15, 'Love', '2022-01-17 22:41:52', '2022-01-17 22:41:52'),
(6, 4, 'provider', 11, 'Like', '2022-01-17 22:49:36', '2022-01-17 22:49:36'),
(7, 2, 'customer', 16, 'HaHa', '2022-01-17 22:50:27', '2022-01-17 22:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `trader_posts`
--

CREATE TABLE `trader_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `emoji` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reactions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_posts`
--

INSERT INTO `trader_posts` (`id`, `trader_id`, `title`, `post_content`, `status`, `emoji`, `likes`, `reactions`, `created_at`, `updated_at`) VALUES
(1, 6, 'test', 'test mobhghtg', 1, '', '0', '0', '2021-09-01 22:55:41', '2021-09-01 22:55:41'),
(2, 6, 'test post new', 'nothing to say', 1, '', '0', '0', '2021-09-16 01:04:37', '2021-09-16 01:04:37'),
(3, 15, 'post 1 updated', 'post 1 content', 1, '', '0', '0', '2021-09-20 22:16:43', '2021-11-16 05:07:16'),
(4, 15, 'post 2 update', 'post 2 content updated', 1, '', '0', '0', '2021-09-20 22:33:49', '2021-11-17 01:29:49'),
(5, 15, 'sdfawrfdzsd', '<p>fszdfszdf</p>', 1, '', '0', '0', '2022-04-04 03:05:02', '2022-04-04 03:05:02'),
(6, 15, 'd', 'd', 1, '', '0', '0', '2022-05-27 01:50:37', '2022-05-27 01:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `trader_posts_comments`
--

CREATE TABLE `trader_posts_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_comment_id` int(11) NOT NULL,
  `trader_post_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_posts_comments`
--

INSERT INTO `trader_posts_comments` (`id`, `post_comment_id`, `trader_post_id`, `user_type`, `user_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 4, 'customer', 16, 'testingggg', 1, '2021-09-24 00:20:09', '2021-12-08 00:51:28'),
(2, 0, 4, 'provider', 15, 'thank you for the query', 0, '2021-09-24 00:27:24', '2021-12-08 01:25:11'),
(4, 1, 4, 'customer', 16, 'testing from customer profile', 1, '2021-10-18 01:37:33', '2021-10-18 01:37:33'),
(5, 1, 4, 'provider', 15, 'dfggdg dsfg dfg', 1, '2021-10-18 01:44:19', '2021-10-18 01:44:19'),
(6, 0, 4, 'provider', 15, 'trader update', 1, '2021-10-18 01:44:58', '2021-10-18 01:44:58'),
(7, 6, 4, 'customer', 16, 'last test from cust ui', 1, '2021-10-18 01:45:12', '2021-10-18 01:45:12'),
(8, 1, 4, 'customer', 16, 'reply to sony trader', 1, '2022-03-04 04:24:03', '2022-03-04 04:24:03'),
(9, 1, 4, 'customer', 16, 'new comment', 1, '2022-03-04 04:24:13', '2022-03-04 04:24:13'),
(10, 0, 4, 'customer', 16, 'new comment for post', 1, '2022-03-04 04:24:39', '2022-03-04 04:24:39'),
(11, 10, 4, 'customer', 16, 'reply to sony kuriakose from sony', 1, '2022-03-04 04:25:31', '2022-03-04 04:25:31'),
(12, 0, 1, 'customer', 16, 'reply to vinod', 1, '2022-03-04 12:08:45', '2022-03-04 12:08:45'),
(13, 12, 1, 'customer', 16, 'reply from sony', 1, '2022-03-04 12:08:58', '2022-03-04 12:08:58'),
(14, 12, 1, 'customer', 16, 'sony to vinod', 1, '2022-03-04 12:09:13', '2022-03-04 12:09:13'),
(15, 0, 1, 'customer', 16, 'new comment to vinod', 1, '2022-03-04 12:10:05', '2022-03-04 12:10:05'),
(16, 0, 4, 'provider', 15, 'testing', 1, '2022-05-16 00:43:27', '2022-05-16 00:43:27'),
(17, 16, 4, 'provider', 15, 'xdfvgdfgdfg', 1, '2022-05-16 00:43:53', '2022-05-16 00:43:53'),
(18, 0, 5, 'provider', 15, 'testing', 1, '2022-05-17 01:25:36', '2022-05-17 01:25:36'),
(19, 18, 5, 'provider', 15, 'testing to sony', 1, '2022-05-17 01:26:33', '2022-05-17 01:26:33'),
(20, 18, 5, 'provider', 15, 'testingvzfvdfg', 1, '2022-05-17 01:27:44', '2022-05-17 01:27:44'),
(21, 18, 5, 'provider', 15, 'dxfgdxfg tgdr t', 1, '2022-05-17 01:30:29', '2022-05-17 01:30:29'),
(22, 18, 5, 'provider', 15, 'srgs srgertr', 1, '2022-05-17 01:31:23', '2022-05-17 01:31:23'),
(23, 18, 5, 'provider', 15, 'srgs srgertr', 1, '2022-05-17 01:31:45', '2022-05-17 01:31:45'),
(24, 18, 5, 'customer', 16, 'sdzfgser sreg se', 1, '2022-05-17 01:34:52', '2022-05-17 01:34:52'),
(25, 18, 5, 'customer', 16, 'sdzfgser sreg se', 1, '2022-05-17 01:35:40', '2022-05-17 01:35:40'),
(26, 18, 5, 'customer', 16, 'dxfsdf dfg rtgdrtghhdt htyhyh t', 1, '2022-05-17 01:36:50', '2022-05-17 01:36:50'),
(27, 0, 5, 'provider', 15, 'dfd gdh', 1, '2022-05-17 01:44:04', '2022-05-17 01:44:04'),
(28, 0, 5, 'provider', 15, 'testing for reply button', 1, '2022-05-18 06:23:24', '2022-05-18 06:23:24'),
(29, 28, 5, 'provider', 15, 'testttiiingggg', 1, '2022-05-18 06:23:40', '2022-05-18 06:23:40'),
(59, 0, 5, 'provider', 15, 'testinf for all', 1, '2022-05-18 23:34:13', '2022-05-18 23:34:13'),
(69, 10, 4, 'provider', 15, 'h', 1, '2022-05-24 00:24:06', '2022-05-24 00:24:06'),
(73, 0, 3, 'provider', 15, 'test', 1, '2022-05-24 00:39:23', '2022-05-24 00:39:23'),
(88, 73, 3, 'provider', 15, 'reply', 1, '2022-05-24 00:50:36', '2022-05-24 00:50:36'),
(89, 73, 3, 'provider', 15, 'reply 2', 1, '2022-05-24 00:50:57', '2022-05-24 00:50:57'),
(90, 10, 4, 'provider', 15, 'reply 3', 1, '2022-05-24 00:51:16', '2022-05-24 00:51:16'),
(91, 0, 1, 'customer', 16, 'test from customer end', 1, '2022-05-26 11:14:58', '2022-05-26 11:14:58'),
(92, 0, 1, 'customer', 16, 'test from customer end', 1, '2022-05-26 11:15:06', '2022-05-26 11:15:06'),
(93, 0, 1, 'customer', 16, 'test from cust', 1, '2022-05-26 11:15:45', '2022-05-26 11:15:45'),
(94, 0, 1, 'customer', 16, 'testingggg', 1, '2022-05-26 11:16:07', '2022-05-26 11:16:07'),
(95, 94, 1, 'customer', 16, 'test testinggg', 1, '2022-05-26 11:19:05', '2022-05-26 11:19:05'),
(96, 94, 1, 'customer', 16, 'testinggg test', 1, '2022-05-26 11:19:12', '2022-05-26 11:19:12'),
(97, 59, 5, 'customer', 16, 'dfgdfg', 1, '2022-05-26 11:25:21', '2022-05-26 11:25:21'),
(98, 0, 6, 'provider', 15, 'dfygh', 1, '2022-05-27 01:54:19', '2022-05-27 01:54:19'),
(99, 0, 6, 'provider', 15, 'df', 1, '2022-05-27 01:59:33', '2022-05-27 01:59:33'),
(100, 99, 6, 'provider', 15, 'dffd', 1, '2022-05-27 04:07:28', '2022-05-27 04:07:28'),
(101, 0, 5, 'provider', 15, 'f', 1, '2022-05-27 04:07:33', '2022-05-27 04:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `trader_posts_images`
--

CREATE TABLE `trader_posts_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_post_id` int(11) NOT NULL,
  `post_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_posts_images`
--

INSERT INTO `trader_posts_images` (`id`, `trader_post_id`, `post_image`, `created_at`, `updated_at`) VALUES
(1, 1, '1630556741_about.jpg', '2021-09-01 22:55:41', '2021-09-01 22:55:41'),
(2, 2, '1631774077_photo1.png', '2021-09-16 01:04:37', '2021-09-16 01:04:37'),
(3, 2, '1631774077_photo2.png', '2021-09-16 01:04:37', '2021-09-16 01:04:37'),
(4, 2, '1631774077_photo3.jpg', '2021-09-16 01:04:37', '2021-09-16 01:04:37'),
(5, 2, '1631774077_photo4.jpg', '2021-09-16 01:04:37', '2021-09-16 01:04:37'),
(6, 3, '1632196003_photo1.png', '2021-09-20 22:16:43', '2021-09-20 22:16:43'),
(7, 3, '1632196003_photo2.png', '2021-09-20 22:16:43', '2021-09-20 22:16:43'),
(8, 3, '1632196003_photo3.jpg', '2021-09-20 22:16:43', '2021-09-20 22:16:43'),
(10, 4, '1632197029_photo4.jpg', '2021-09-20 22:33:49', '2021-09-20 22:33:49'),
(11, 4, '1637059007_photo1.png', '2021-11-16 05:06:47', '2021-11-16 05:06:47'),
(13, 3, '1637059036_photo4.jpg', '2021-11-16 05:07:16', '2021-11-16 05:07:16'),
(14, 5, '1649061302_photo1.png', '2022-04-04 03:05:02', '2022-04-04 03:05:02'),
(15, 5, '1649061302_photo2.png', '2022-04-04 03:05:03', '2022-04-04 03:05:03'),
(16, 5, '1649061303_photo3.jpg', '2022-04-04 03:05:03', '2022-04-04 03:05:03'),
(17, 6, '1653636037_photo2.png', '2022-05-27 01:50:39', '2022-05-27 01:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `trader_posts_likes`
--

CREATE TABLE `trader_posts_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_post_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_posts_likes`
--

INSERT INTO `trader_posts_likes` (`id`, `trader_post_id`, `user_type`, `user_id`, `reaction`, `created_at`, `updated_at`) VALUES
(5, 4, 'provider', 11, 'Love', '2021-09-14 06:44:38', '2021-09-15 23:48:32'),
(6, 1, 'customer', 16, 'Like', '2021-09-14 06:50:25', '2021-09-14 06:50:25'),
(7, 4, 'provider', 15, 'Love', '2021-09-20 22:44:48', '2022-05-15 23:58:33'),
(8, 3, 'provider', 15, 'Sad', '2021-09-20 22:48:18', '2021-12-06 11:43:00'),
(9, 4, 'customer', 16, 'HaHa', '2021-09-22 22:29:45', '2022-01-17 22:47:26'),
(10, 3, 'customer', 16, 'Like', '2021-09-22 22:33:31', '2021-12-08 04:06:51'),
(11, 4, 'provider', 14, 'Love', '2022-01-17 22:49:52', '2022-01-17 22:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `trader_posts_reports`
--

CREATE TABLE `trader_posts_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trader_post_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_posts_reports`
--

INSERT INTO `trader_posts_reports` (`id`, `trader_post_id`, `customer_id`, `description`, `created_at`, `updated_at`) VALUES
(7, 4, 16, 'testing the report section.', '2021-10-28 04:52:44', '2021-10-28 04:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `trader_review_comments`
--

CREATE TABLE `trader_review_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_comment_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_review_comments`
--

INSERT INTO `trader_review_comments` (`id`, `review_comment_id`, `review_id`, `user_id`, `user_type`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(5, 0, 6, 16, 'customer', 'testing for notification', 1, '2022-03-21 22:56:49', '2022-03-21 22:56:49'),
(6, 5, 6, 15, 'provider', 'reply 2', 1, '2022-05-26 03:27:41', '2022-05-26 03:27:41'),
(7, 0, 7, 15, 'provider', 'com 1', 1, '2022-05-26 03:29:09', '2022-05-26 03:29:09'),
(21, 0, 4, 15, 'provider', 'sd', 1, '2022-05-26 06:57:29', '2022-05-26 06:57:29'),
(22, 0, 5, 15, 'provider', 'ft', 1, '2022-05-26 06:57:35', '2022-05-26 06:57:35'),
(23, 21, 4, 15, 'provider', 'test', 1, '2022-05-26 07:00:35', '2022-05-26 07:00:35'),
(24, 21, 4, 15, 'provider', 'sdf', 1, '2022-05-26 07:01:26', '2022-05-26 07:01:26'),
(25, 21, 4, 15, 'provider', 'ddfg', 1, '2022-05-26 07:01:38', '2022-05-26 07:01:38'),
(26, 22, 5, 15, 'provider', 'dxgf', 1, '2022-05-26 07:08:56', '2022-05-26 07:08:56'),
(27, 0, 4, 15, 'provider', 'dghfh', 1, '2022-05-26 07:09:04', '2022-05-26 07:09:04'),
(28, 0, 4, 15, 'provider', 'dfghdfghjgj', 1, '2022-05-26 07:09:07', '2022-05-26 07:09:07'),
(29, 7, 7, 15, 'provider', 'comment2', 1, '2022-05-26 10:57:27', '2022-05-26 10:57:27'),
(30, 0, 4, 15, 'provider', 'dsg', 1, '2022-05-26 10:57:49', '2022-05-26 10:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loggedIN` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verify_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_id`, `username`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `profile_pic`, `loggedIN`, `status`, `remember_token`, `email_verify_token`, `password_reset_token`, `created_at`, `updated_at`) VALUES
(5, 'provider', 6, 'vinod', 'Vinod', 'vinod@legacit.com', '1', NULL, '', '', 0, 0, NULL, '', '', '2021-04-22 04:19:56', '2021-04-22 04:19:56'),
(6, 'provider', 7, 'kannan', 'Kannan', 'kannan@gmail.com', '2', NULL, '', '', 0, 0, NULL, '', '', '2021-04-23 00:10:04', '2021-04-23 00:10:04'),
(8, 'customer', 3, 'sony', 'Sony Kuriakose', 'sony@gmail.com', '3', NULL, '$2y$10$lqjHA4ons3020yAYDar84epOCz0dOXze/YWrg3BazChvRq2rXGt3O', '', 0, 0, NULL, '', '', '2021-05-20 04:57:07', '2021-05-20 04:57:07'),
(10, 'provider', 9, 'sony123', 'Provider 1', 'sony123@gmail.com', '4', NULL, '$2y$10$rVP/YRupevWNYE2ONlZLd./QpBcSmvjBo0F1LW14AQhs.WmR6kJc2', '', 0, 0, NULL, '', '', '2021-05-20 05:34:23', '2021-05-20 05:34:23'),
(11, 'provider', 10, 'sonymgottil', 'Sony Kuriakose', 'sonymgottil@gmail.com', '5', NULL, '$2y$10$8mOKylip8z/bHJW/DOMp7.E7PM8DSA6iBbmF6amyhwLAM..frcSay', '', 0, 0, NULL, '', '', '2021-05-20 05:43:40', '2021-05-20 05:43:40'),
(24, 'customer', 16, 'sonymangottil12', 'Sony Customer', 'sonymangottil12@gmail.com', '9495591928', '2021-05-21 02:13:37', '$2y$10$AUCKwtEhGGIyfHHyg8uzxuFeuqm/z5BJCHgzgXxkocvoBOjrOWLLO', '', 0, 1, NULL, 'D1y6ZXrTEik1ZREyYbeGmoKLcWyCmISC', 'vgyod2TDk6SXnFPJq06YTWD4717iF0sP', '2021-05-20 23:00:24', '2022-06-14 06:40:53'),
(25, 'provider', 11, 'bobby', 'bobby', 'bobby@legacit.com', '7', NULL, '', '', 0, 0, NULL, '', '', '2021-09-01 09:00:51', '2021-09-01 09:00:51'),
(28, 'provider', 14, 'anualias', 'Anu', 'anualias2010@gmail.com', '8', NULL, '$2y$10$ogtCQCzKfedFDPkh98pnXubq98IHI69r/kE9zud58RCPB1HqJRWk2', '', 1, 1, NULL, 'rYe5DxgowbQLnC9ljTLCNMEf17ogr3Ma', '', '2021-09-16 06:22:15', '2021-12-14 23:37:14'),
(29, 'provider', 15, 'sonymangottil', 'Sony Kuriakose', 'sonymangottil@gmail.com', '9605591928', NULL, '$2y$10$Z7iUFmTWXwbucTz4QhlaMeIid.noj83HAkBF1MhTuTunlsfeEkcYu', '', 1, 1, NULL, '', 'f0sG85DbqJM7ngB9S8qlzslf3s0GgjLC', '2021-09-20 07:14:13', '2022-06-14 06:41:31'),
(30, 'provider', 18, 'neha', 'Neha', 'neha@gmail.com', '8281055928', NULL, '$2y$10$HD6nllzwSDzbI7LKGy89GuZje1ExnVXokvKLD4SYsF8jm0C1IByqm', '', 0, 0, NULL, 'se1DfGMnLgzKFJPaa0p4NKv2LOLKQSIA', '', '2022-05-19 06:31:54', '2022-05-19 06:31:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bazaar`
--
ALTER TABLE `bazaar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bazaar_category`
--
ALTER TABLE `bazaar_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bazaar_images`
--
ALTER TABLE `bazaar_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diy_help`
--
ALTER TABLE `diy_help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diy_help_comments`
--
ALTER TABLE `diy_help_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diy_help_images`
--
ALTER TABLE `diy_help_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_images`
--
ALTER TABLE `jobs_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_quotes`
--
ALTER TABLE `job_quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_quote_details`
--
ALTER TABLE `job_quote_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products_wishlist`
--
ALTER TABLE `products_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_visits`
--
ALTER TABLE `profile_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_categories`
--
ALTER TABLE `provider_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_documents`
--
ALTER TABLE `provider_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_services`
--
ALTER TABLE `provider_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_service_locations`
--
ALTER TABLE `provider_service_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_works`
--
ALTER TABLE `provider_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_offers`
--
ALTER TABLE `trader_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_offers_comments`
--
ALTER TABLE `trader_offers_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_offers_images`
--
ALTER TABLE `trader_offers_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_offer_likes`
--
ALTER TABLE `trader_offer_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_posts`
--
ALTER TABLE `trader_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_posts_comments`
--
ALTER TABLE `trader_posts_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_posts_images`
--
ALTER TABLE `trader_posts_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_posts_likes`
--
ALTER TABLE `trader_posts_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_posts_reports`
--
ALTER TABLE `trader_posts_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_review_comments`
--
ALTER TABLE `trader_review_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bazaar`
--
ALTER TABLE `bazaar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bazaar_category`
--
ALTER TABLE `bazaar_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bazaar_images`
--
ALTER TABLE `bazaar_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `diy_help`
--
ALTER TABLE `diy_help`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diy_help_comments`
--
ALTER TABLE `diy_help_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `diy_help_images`
--
ALTER TABLE `diy_help_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobs_images`
--
ALTER TABLE `jobs_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `job_quotes`
--
ALTER TABLE `job_quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `job_quote_details`
--
ALTER TABLE `job_quote_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products_wishlist`
--
ALTER TABLE `products_wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `profile_visits`
--
ALTER TABLE `profile_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=766;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `provider_categories`
--
ALTER TABLE `provider_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `provider_documents`
--
ALTER TABLE `provider_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `provider_services`
--
ALTER TABLE `provider_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `provider_service_locations`
--
ALTER TABLE `provider_service_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `provider_works`
--
ALTER TABLE `provider_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trader_offers`
--
ALTER TABLE `trader_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trader_offers_comments`
--
ALTER TABLE `trader_offers_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `trader_offers_images`
--
ALTER TABLE `trader_offers_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `trader_offer_likes`
--
ALTER TABLE `trader_offer_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trader_posts`
--
ALTER TABLE `trader_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trader_posts_comments`
--
ALTER TABLE `trader_posts_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `trader_posts_images`
--
ALTER TABLE `trader_posts_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trader_posts_likes`
--
ALTER TABLE `trader_posts_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trader_posts_reports`
--
ALTER TABLE `trader_posts_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trader_review_comments`
--
ALTER TABLE `trader_review_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
