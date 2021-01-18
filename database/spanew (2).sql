-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 10:18 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spanew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fahim', 'fahimmbpi@gmail.com', '$2y$10$pAlKE3Ez5cm7HsatQrCF6uXIdzvCNEuFKcPxlGrTBILsXkSAKYnxe', 'images/admin/s2bmYopr2lIkU6J4dfNuyuroPqt6apNcaKZBUady.jpeg', 1, '2020-08-17 08:24:40', '2020-09-28 06:58:32'),
(2, 'muntasir', 'muntasir@gmail.com', '$2y$10$KJMPPkeoEtFwBqlM2ltn7.o/316tDixS/vCAdGZc.buDoVKWuyiTy', NULL, 1, '2020-09-28 02:54:48', '2020-09-28 02:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'size', 1, '2020-09-05 01:27:27', '2020-09-05 01:27:27'),
(2, 'color', 1, '2020-09-05 01:27:52', '2020-09-05 01:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_selected` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `isSerialize` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon_image`, `is_selected`, `status`, `isSerialize`, `created_at`, `updated_at`) VALUES
(1, 'mens Fashion', '1-Fashion', NULL, 1, 1, 3, '2020-09-14 01:15:02', '2020-09-14 01:21:06'),
(2, 'womens Fashin', '2-Fashion', NULL, 1, 1, 2, '2020-09-14 01:15:30', '2020-09-14 01:15:30'),
(3, 'computer laaptop', '3-laptop', NULL, 1, 1, 1, '2020-09-14 01:15:39', '2020-09-14 01:20:40'),
(4, 'Winter Collection', '4-Collection', NULL, 1, 1, NULL, '2020-09-14 05:21:59', '2020-09-14 05:22:54'),
(5, 'Mobile & tab', '1004-tab', NULL, 1, 1, NULL, '2020-09-19 05:33:55', '2020-09-19 05:33:55'),
(6, 'amni', '1005-amni', 'images/category/NaMA2l1tXjmijmCYscYTkuOxpQulzGiIybQ4gDy6.jpeg', 1, 1, NULL, '2020-09-21 13:06:03', '2020-09-21 13:06:03'),
(7, 'polo-t-shirt', '1006-polo-t-shirt', NULL, 1, 1, NULL, '2020-09-28 05:07:04', '2020-09-28 05:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `delivery_charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gunnarshire', 108, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(2, 'West Carli', 111, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(3, 'Candidoside', 109, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(4, 'South Reannashire', 73, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(5, 'Marlonmouth', 68, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(6, 'Angelinebury', 78, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(7, 'North Princehaven', 58, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(8, 'East Onaville', 116, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(9, 'Port Favianshire', 41, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(10, 'South Lorine', 119, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(11, 'West Carrie', 75, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(12, 'Port Caterinaborough', 103, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(13, 'Jadeburgh', 40, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(14, 'Connellyview', 83, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(15, 'South Helgahaven', 74, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(16, 'Dickensfurt', 83, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(17, 'East Rudolphmouth', 56, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(18, 'Josebury', 93, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(19, 'West Zackland', 73, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(20, 'Billyton', 56, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(21, 'Loyceton', 97, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(22, 'Schulistberg', 75, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(23, 'Port Anibalmouth', 119, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(24, 'Millsmouth', 75, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(25, 'West Vivianeton', 51, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(26, 'West Chaz', 98, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(27, 'East Lilyanbury', 43, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(28, 'South Yvonnebury', 62, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(29, 'Stephonhaven', 58, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(30, 'Quitzonfort', 69, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(31, 'East Johnpaul', 77, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(32, 'Lake Wiltonfurt', 48, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(33, 'Joaquinville', 51, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(34, 'Koeppfurt', 90, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(35, 'New Aminafurt', 115, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(36, 'Port Hunterville', 51, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(37, 'Theodoreburgh', 43, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(38, 'Lake Stefanieborough', 74, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(39, 'New Devinburgh', 43, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(40, 'North Catalinaborough', 102, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(41, 'Francofort', 67, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(42, 'Linnieton', 44, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(43, 'Lake Tryciaport', 82, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(44, 'Stehrstad', 110, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(45, 'Port Devenbury', 113, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(46, 'Lake Brendanmouth', 64, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(47, 'North Emersonfort', 74, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(48, 'North Enolastad', 59, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(49, 'North Zachariah', 63, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(50, 'Port Jack', 108, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(51, 'East Horace', 103, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(52, 'South Khalil', 93, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(53, 'Alliechester', 108, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(54, 'East Jeffery', 76, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(55, 'Huelstown', 70, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(56, 'Carterfort', 112, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(57, 'East Gloria', 72, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(58, 'Lake Sydneemouth', 100, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(59, 'North Germainefurt', 79, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(60, 'New Lelah', 92, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(61, 'Turnershire', 84, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(62, 'New Maud', 111, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(63, 'Port Irvingfurt', 80, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(64, 'South Chayamouth', 79, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(65, 'Zemlakmouth', 62, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(66, 'Schroedertown', 45, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(67, 'East Mariam', 75, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(68, 'South Tania', 87, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(69, 'Carlifort', 79, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(70, 'Wiegandmouth', 89, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(71, 'Port Kendall', 60, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(72, 'Jordybury', 64, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(73, 'Greenfelderview', 77, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(74, 'Bauchstad', 71, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(75, 'Mitchellport', 100, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(76, 'Lake Arvilla', 47, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(77, 'Ramiroland', 64, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(78, 'Abshireport', 67, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(79, 'Hillardport', 66, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(80, 'Mullermouth', 89, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(81, 'Dooleyside', 49, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(82, 'Lake Collin', 66, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(83, 'North Carrieshire', 120, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(84, 'West Elaina', 70, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(85, 'Albinfort', 80, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(86, 'New Reecefurt', 120, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(87, 'West Freddie', 46, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(88, 'Shyannebury', 101, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(89, 'North Arielle', 104, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(90, 'Meredithshire', 78, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(91, 'Conniemouth', 104, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(92, 'Lake Dustinhaven', 111, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(93, 'Kuhlmantown', 77, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(94, 'Lucieborough', 56, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(95, 'Mooreland', 86, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(96, 'North Nicolette', 62, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(97, 'South Sabina', 74, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(98, 'Camronborough', 91, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(99, 'Tannerview', 41, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(100, 'New Fredy', 111, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00'),
(101, 'Dhaka', 90, 1, '2020-09-21 23:14:36', '2020-09-21 23:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `expire_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Casey Hill MD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(2, 'Rollin Skiles', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(3, 'Hershel Yundt', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(4, 'Ned Dooley', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(5, 'Chanel Ruecker', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(6, 'Elliott Durgan DDS', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(7, 'Jacinthe Braun', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(8, 'Ova Bogan', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(9, 'Ericka O\'Conner', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(10, 'Krista Jast', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(11, 'Llewellyn Wiza', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(12, 'Liza Haley', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(13, 'Mikel Lind V', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(14, 'Mr. Manuela Gislason', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(15, 'Mona Wiza', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(16, 'Mrs. Leilani Howe PhD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(17, 'Lucy Kautzer', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(18, 'Frederik Nolan PhD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(19, 'Chauncey Fadel', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(20, 'Dr. Zoila Kemmer', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(21, 'Kenyon Parisian', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(22, 'Virginie Upton Jr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(23, 'Jedediah Hartmann', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(24, 'Mr. Torey Braun DDS', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(25, 'Solon Schaden', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(26, 'Carroll Feil', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(27, 'Dr. Westley Rice', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(28, 'Ms. Beverly Keeling', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(29, 'Prof. Peyton Romaguera II', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(30, 'Haskell Murphy', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(31, 'Lawrence Parker', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(32, 'Cortney Rosenbaum', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(33, 'Ms. Vivien Krajcik', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(34, 'Karen Strosin', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(35, 'Dr. Sincere Jacobson MD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(36, 'Celestino Hudson', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(37, 'Mr. Damian Romaguera IV', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(38, 'Leilani Cassin', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(39, 'Fletcher Mosciski DDS', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(40, 'Dr. Buster Shanahan Sr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(41, 'Amya McLaughlin', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(42, 'Mrs. Elza Kautzer DVM', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(43, 'Prof. Johnathon Beahan', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(44, 'Margaret Sipes Jr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(45, 'Dr. Osborne Fisher Sr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(46, 'Robert Purdy', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(47, 'Dawn Larson', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(48, 'Leila Balistreri PhD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(49, 'Jay Stark', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(50, 'Dayna Hackett', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(51, 'Holly O\'Conner', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(52, 'Ms. Clare Cremin', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(53, 'Shirley Witting', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(54, 'Mia Douglas', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(55, 'Arianna Waters', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(56, 'Eunice Barrows DDS', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(57, 'Dr. Austin Donnelly MD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(58, 'Catherine Runolfsdottir Sr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(59, 'Lila Kiehn', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(60, 'Antonetta Senger', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(61, 'Davon Gulgowski', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(62, 'Prof. Marina Jakubowski', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(63, 'Kamren Effertz', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(64, 'Markus Zboncak', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(65, 'Nedra Mills', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(66, 'Jared Kshlerin', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(67, 'Vickie Stehr', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(68, 'Mr. Jerod Waelchi Sr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(69, 'Nathaniel Ullrich', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(70, 'Jordane Renner', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(71, 'Alan Goodwin III', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(72, 'Michaela Feil', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(73, 'Dino Keebler', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(74, 'Tatum Block', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(75, 'Mariana Friesen', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(76, 'Dr. Adriana Conroy MD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(77, 'Stacy Wilkinson', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(78, 'Pattie Quitzon', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(79, 'Jerrod Conn', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(80, 'Cassie Osinski Jr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(81, 'Prof. Brayan Haag V', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(82, 'Dr. Julian Lind', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(83, 'Kristofer Connelly', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(84, 'Clark Gibson Jr.', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(85, 'Savannah Aufderhar', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(86, 'Marlen Zulauf', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(87, 'Bianka Heidenreich', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(88, 'Mrs. Vicky Lang', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(89, 'Kelton Feest', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(90, 'Andrew Schiller MD', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(91, 'Hipolito Morar', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(92, 'Dr. Al Rosenbaum II', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(93, 'Charlotte McClure', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(94, 'Amanda Schinner', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(95, 'Evert Terry', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(96, 'Jaiden Buckridge', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(97, 'Tito Shields', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(98, 'Christop Grady', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(99, 'Mr. Freddie Ruecker', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(100, 'Kaelyn Hill', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16'),
(101, 'sundorbhan', 1, '2020-09-21 23:14:20', '2020-09-21 23:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL COMMENT 'date',
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_admin_id` int(11) NOT NULL COMMENT 'store_admin_id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `date`, `purpose`, `amount`, `comment`, `insert_admin_id`, `created_at`, `updated_at`) VALUES
(3, '2020-09-27', 'test 2', 12454.00, 'gfgytfv', 1, '2020-09-27 01:15:29', '2020-09-27 02:08:57'),
(6, '2020-09-21', 'test', 150.00, '120', 1, '2020-09-27 01:40:22', '2020-09-27 02:02:31'),
(8, '2020-09-27', '1520', 1200.00, 'hghg', 1, '2020-09-27 03:51:24', '2020-09-27 03:51:24'),
(9, '2020-09-27', 'Dhaka', 150.00, '12', 1, '2020-09-27 03:54:59', '2020-09-27 03:54:59'),
(10, '2020-09-25', 'gajje', 1225.00, '12', 1, '2020-09-27 03:57:53', '2020-09-27 03:57:53'),
(11, '2020-09-28', 'jhyghfvhf', 120.00, '10', 1, '2020-09-28 07:00:40', '2020-09-28 07:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Fahim Chowdhury', '01795297424', 'Dhaka', 1, '2020-09-05 12:13:07', '2020-09-17 01:30:27'),
(2, 'Fahim', '01795297449', 'Muntasir', 0, '2020-09-05 12:27:14', '2020-09-05 12:27:14'),
(4, 'Fahim', '01795297420', 'Dhaka', 1, '2020-09-16 05:51:49', '2020-09-16 05:51:49'),
(5, 'Fahim', '01795297421', 'Dhaka', 1, '2020-09-16 05:53:19', '2020-09-16 05:53:19'),
(6, 'Fahim Muntasir', '01795297426', 'Dhaka', 18, '2020-09-17 00:52:51', '2020-09-17 00:52:51'),
(7, 'Fahim', '01770280894', 'Dhaka', 6, '2020-09-22 06:49:02', '2020-09-22 06:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `debits`
--

CREATE TABLE `debits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL COMMENT 'date',
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_admin_id` int(11) NOT NULL COMMENT 'store_admin_id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debits`
--

INSERT INTO `debits` (`id`, `date`, `purpose`, `amount`, `comment`, `insert_admin_id`, `created_at`, `updated_at`) VALUES
(1, '2020-09-26', 'Dhaka', 12000.00, '120', 1, '2020-09-27 04:00:31', '2020-09-27 04:12:39'),
(3, '2020-09-21', 'amni', 14000.00, 'heklk', 1, '2020-09-27 06:33:15', '2020-09-27 06:33:15'),
(4, '2020-09-27', 'amni 2', 150.00, '444', 1, '2020-09-27 06:40:07', '2020-09-27 06:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `name`, `company_name`, `phone`, `address`, `status`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Fahim', 'Mohasagor', '01795297424', 'Dhaka', 1, '$2y$10$tQwYydnk.wMIWUfnK0lkFeo2OCwIFBJNLewjpHT8kt9VqV4cwDTRG', '2020-09-06 08:13:33', '2020-09-06 08:13:33'),
(2, 'Kawser', 'nm clothing', '01795297425', 'Dhaka', 1, '$2y$10$hs0qZErVxuy.jUMISyJBoukILI8Uu64iVhpHVbDK0v9wyXSLcqW8K', '2020-09-19 01:19:28', '2020-09-19 01:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_08_13_074443_create_categories_table', 1),
(4, '2020_08_17_060825_create_admins_table', 1),
(5, '2020_08_18_122228_create_sub_categories_table', 2),
(6, '2020_08_19_053842_create_sub_sub_categories_table', 2),
(7, '2020_08_19_081000_create_sliders_table', 2),
(8, '2020_08_19_104901_create_attributes_table', 2),
(9, '2020_08_19_105047_create_variants_table', 2),
(10, '2020_08_23_052431_create_merchants_table', 3),
(11, '2020_08_23_064414_create_couriers_table', 3),
(12, '2020_08_23_064458_create_cities_table', 3),
(13, '2020_08_23_075702_create_comments_table', 3),
(14, '2020_08_23_093241_create_products_table', 3),
(15, '2020_08_23_093326_create_product_images_table', 3),
(16, '2020_08_24_051714_create_product_variants_table', 3),
(17, '2020_08_24_052410_create_product_attributes_table', 3),
(18, '2020_08_25_055640_create_coupons_table', 3),
(19, '2020_08_25_082149_create_product_barcodes_table', 3),
(20, '2020_08_26_111627_create_purchases_table', 3),
(21, '2020_08_29_113350_create_purchaseitems_table', 3),
(29, '2020_09_05_164925_create_orders_table', 5),
(30, '2020_09_05_165048_create_order_items_table', 5),
(31, '2020_09_05_172052_create_customers_table', 5),
(32, '2020_08_31_110050_create_offers_table', 6),
(35, '2014_10_12_000000_create_users_table', 7),
(38, '2020_09_27_054030_create_debits_table', 8),
(39, '2020_09_27_054933_create_credits_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `image`, `url`, `status`, `created_at`, `updated_at`) VALUES
(6, 'images/offer/3rRFCSbUJ2URuWQX1xxlJVZGrUAMakzc0I3u7Uxk.jpeg', '#', 1, '2020-09-20 04:11:27', '2020-09-20 04:11:27'),
(7, 'images/offer/ZO9xCVcHJ11d19jgp8ksg5koulAOnuNR7so5fkpt.jpeg', 'http://127.0.0.1:8000/public/category/products/1-Fashion', 1, '2020-09-20 04:23:38', '2020-09-20 04:23:38'),
(8, 'images/offer/8h3Va0woi56vEzUe8HITYgVCTwf8YFjPw0Xb8uT4.jpeg', '#', 1, '2020-09-20 04:23:46', '2020-09-20 04:23:46'),
(9, 'images/offer/de01jrJ9kBJgXZKsxdEzonYl0b8Gc3qf1LFdmACl.jpeg', '#', 1, '2020-09-20 04:29:32', '2020-09-20 04:29:32'),
(10, 'images/offer/f6HQvhc6Ih158W6l79eEK9zofrciPXvB7Z47SoWI.jpeg', '#', 1, '2020-09-22 00:02:18', '2020-09-22 00:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `order_type` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cutomer_phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `shipping_cost` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `paid` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `memo_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_admin_id` int(11) DEFAULT NULL,
  `pending_admin_id` int(11) DEFAULT NULL,
  `pending_date` date DEFAULT NULL,
  `approved_admin_id` int(11) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `shipment_admin_id` int(11) DEFAULT NULL,
  `shippment_date` date DEFAULT NULL,
  `delivered_admin_id` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `cancel_admin_id` int(11) DEFAULT NULL,
  `cancel_date` date DEFAULT NULL,
  `return_admin_id` int(11) DEFAULT NULL,
  `return_date` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_no`, `order_type`, `customer_id`, `cutomer_phone`, `city_id`, `courier_id`, `shipping_cost`, `discount`, `paid`, `total`, `status`, `memo_no`, `create_admin_id`, `pending_admin_id`, `pending_date`, `approved_admin_id`, `approved_date`, `shipment_admin_id`, `shippment_date`, `delivered_admin_id`, `delivery_date`, `cancel_admin_id`, `cancel_date`, `return_admin_id`, `return_date`, `created_at`, `updated_at`) VALUES
(2, 100, 1, 5, '01795297421', 1, NULL, 0, 0, 0, 157, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-16 06:04:21', '2020-09-16 06:04:21'),
(3, 102, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 315, 4, NULL, NULL, 1, '2020-09-19', 1, '2020-09-19', 1, '2020-09-19', NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-16 23:33:54', '2020-09-19 07:22:48'),
(4, 103, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 315, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-16 23:35:34', '2020-09-16 23:35:34'),
(5, 104, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 315, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-16 23:44:21', '2020-09-16 23:44:21'),
(6, 105, 1, 6, '01795297426', 18, NULL, 0, 0, 0, 157, 3, NULL, NULL, NULL, NULL, 1, '2020-09-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-17 00:52:51', '2020-09-19 05:35:02'),
(7, 106, 2, 1, '01795297424', 17, 18, 56, 50, 120, 430, 3, NULL, 1, NULL, NULL, 1, '2020-09-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-19 22:35:01', '2020-09-19 23:05:50'),
(8, 107, 1, 1, '01795297424', 1, 2, 0, 0, 0, 169, 1, '121121', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-20 01:51:39', '2020-09-20 01:52:33'),
(9, 108, 1, 1, '01795297424', 1, NULL, 108, 0, 0, 169, 3, NULL, NULL, NULL, NULL, 1, '2020-09-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-20 02:28:21', '2020-09-20 02:29:35'),
(10, 109, 1, 1, '01795297424', 1, NULL, 108, 0, 0, 242, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-20 03:05:26', '2020-09-20 03:05:26'),
(11, 110, 1, 1, '01795297424', 1, NULL, 108, 0, 0, 194, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-20 07:14:59', '2020-09-20 07:14:59'),
(12, 111, 1, 1, '01795297424', 17, NULL, 56, 0, 0, 532, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-22 05:49:20', '2020-09-22 05:49:20'),
(13, 112, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 532, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-22 05:49:40', '2020-09-22 05:49:40'),
(14, 113, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 532, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-22 05:51:30', '2020-09-22 05:51:30'),
(15, 114, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 532, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-22 05:52:48', '2020-09-22 05:52:48'),
(16, 115, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 532, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-22 05:53:07', '2020-09-22 05:53:07'),
(17, 116, 1, 7, '01770280894', 6, NULL, 78, 0, 0, 169, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-22 06:49:02', '2020-09-22 06:49:02'),
(18, 117, 1, 7, '01770280894', 6, NULL, 78, 0, 0, 169, 3, NULL, NULL, NULL, NULL, 1, '2020-09-23', NULL, NULL, NULL, NULL, 1, '2020-09-23', NULL, NULL, '2020-09-22 06:50:16', '2020-09-23 06:37:39'),
(19, 118, 2, 1, '01795297424', 17, 11, 56, 0, 0, 290, 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-09-27', NULL, NULL, '2020-09-27 04:46:02', '2020-09-27 07:17:40'),
(20, 119, 3, 1, '01795297424', 4, 15, 73, 0, 0, 160, 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-27 23:14:06', '2020-09-27 23:14:06'),
(21, 120, 2, 1, '01795297424', 4, 15, 73, 0, 0, 160, 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-27 23:21:38', '2020-09-27 23:21:38'),
(22, 121, 1, 1, '01795297424', 1, NULL, 0, 0, 0, 157, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-28 05:48:48', '2020-09-28 05:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `total`, `attribute_id`, `variant_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 130, 1, 0, 1, 1, '2020-09-16 06:04:21', '2020-09-16 06:04:21'),
(2, 3, 2, 130, 2, 0, 1, 1, '2020-09-16 23:33:54', '2020-09-16 23:33:54'),
(3, 4, 2, 130, 2, 0, 1, 2, '2020-09-16 23:35:34', '2020-09-16 23:35:34'),
(4, 5, 2, 130, 2, 0, 1, 1, '2020-09-16 23:44:21', '2020-09-16 23:44:21'),
(5, 6, 2, 130, 1, 0, 1, 1, '2020-09-17 00:52:51', '2020-09-17 00:52:51'),
(6, 7, 1, 160, 1, 0, NULL, NULL, '2020-09-19 22:35:01', '2020-09-19 22:35:01'),
(7, 7, 3, 270, 1, 0, NULL, NULL, '2020-09-19 22:35:01', '2020-09-19 22:35:01'),
(8, 8, 12, 140, 1, 0, 2, 4, '2020-09-20 01:51:39', '2020-09-20 01:51:39'),
(9, 9, 12, 140, 1, 0, 2, 4, '2020-09-20 02:28:21', '2020-09-20 02:28:21'),
(10, 10, 5, 30, 1, 150, 1, 3, '2020-09-20 03:05:26', '2020-09-20 03:05:26'),
(11, 10, 8, 170, 1, 1700, 2, 4, '2020-09-20 03:05:26', '2020-09-20 03:05:26'),
(12, 16, 6, 440, 1, 440, 2, 4, '2020-09-22 05:53:07', '2020-09-22 05:53:07'),
(13, 17, 12, 140, 1, 140, 2, 4, '2020-09-22 06:49:02', '2020-09-22 06:49:02'),
(14, 18, 7, 140, 1, 140, 1, 1, '2020-09-22 06:50:16', '2020-09-22 06:50:16'),
(15, 19, 1, 160, 1, 160, NULL, NULL, '2020-09-27 04:46:02', '2020-09-27 04:46:02'),
(16, 19, 2, 130, 1, 130, NULL, NULL, '2020-09-27 04:46:02', '2020-09-27 04:46:02'),
(17, 20, 1, 160, 1, 160, NULL, NULL, '2020-09-27 23:14:06', '2020-09-27 23:14:06'),
(18, 21, 1, 160, 1, 160, NULL, NULL, '2020-09-27 23:21:38', '2020-09-27 23:21:38'),
(19, 22, 11, 130, 1, 130, NULL, NULL, '2020-09-28 05:48:48', '2020-09-28 05:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `sub_sub_category_id` int(11) DEFAULT NULL,
  `product_code` int(11) NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `merchant_id`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `product_code`, `slug`, `stock`, `sale_price`, `discount`, `price`, `status`, `details`, `created_at`, `updated_at`) VALUES
(1, 'polo-tt--shirt', NULL, 1, 2, NULL, 1001, 'polo-tt--shirt-1001', -4, 180, 20, 160, 1, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'</p><p><strong>s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially&nbsp;</strong></p><ul><li>unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul>', '2020-09-14 02:15:32', '2020-09-27 23:21:38'),
(2, 'tshirt', NULL, 1, 2, NULL, 1002, 'tshirt-1002', 1, 280, 150, 130, 1, '<p><i><strong>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</strong>.</i></p>', '2020-09-14 02:17:19', '2020-09-27 07:17:40'),
(3, 'Panjabi', NULL, 1, 1, 3, 1003, 'Panjabi-1003', -1, 280, 10, 270, 1, '<p>It is <i>a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.&nbsp;</i></p><ul><li><i><strong>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, .</strong></i></li></ul>', '2020-09-14 02:19:24', '2020-09-19 22:35:01'),
(4, 'panjabi two', NULL, 1, 1, NULL, 1004, 'two-1004', 0, 280, 10, 270, 1, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2020-09-14 02:20:48', '2020-09-14 02:20:48'),
(5, 'panjaabi-three', NULL, 1, 1, 3, 1005, 'panjaabi-three-1005', -1, 180, 150, 30, 1, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-o<strong>r-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the year</strong>s, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2020-09-14 02:21:31', '2020-09-20 03:05:26'),
(6, 'simpple panjabi', NULL, 1, 1, 3, 1006, 'panjabi-1006', -5, 450, 10, 440, 1, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2020-09-14 02:23:09', '2020-09-22 05:53:07'),
(7, 'Shirt', NULL, 1, 2, NULL, 1007, 'Shirt-1007', 7, 150, 10, 140, 1, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2020-09-14 02:24:39', '2020-09-26 06:45:33'),
(8, 'simple shirtt', NULL, 1, 2, NULL, 1008, 'shirtt-1008', -1, 180, 10, 170, 1, '<p>It is a long established fact that a reader will be distracted by the readable content of <strong>a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</strong></p>', '2020-09-14 02:25:34', '2020-09-20 03:05:26'),
(9, 'three pices', NULL, 2, 6, NULL, 1009, 'pices-1009', 250, 150, 120, 30, 1, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing <i><strong>packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</strong></i></p>', '2020-09-14 02:28:20', '2020-09-26 06:44:29'),
(10, 'salwar kamiz', NULL, 2, 6, NULL, 1010, 'kamiz-1010', 0, 580, 10, 570, 2, '<p>salwar kamizsalwar kamizsalwar kamizsalwar kamiz</p>', '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(11, 'two peaces', NULL, 2, 6, NULL, 1011, 'peaces-1011', 151, 280, 150, 130, 1, '<p>jhfcvgfhchg nb</p>', '2020-09-14 04:09:07', '2020-09-28 05:48:48'),
(12, 'Hody', NULL, 1, 3, NULL, 1012, 'Hody-1012', 0, 150, 10, 140, 1, '<p>hello</p><p><strong>hjhjb</strong></p>', '2020-09-19 04:43:01', '2020-09-26 07:31:33'),
(13, 'jeans', NULL, 1, 1, 3, 1013, 'jeans-1013', 0, 120, 2, 118, 3, '<p>54545</p>', '2020-09-22 01:15:19', '2020-09-22 03:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-09-14 02:15:32', '2020-09-14 02:15:32'),
(2, 2, 1, '2020-09-14 02:17:19', '2020-09-14 02:17:19'),
(3, 3, 1, '2020-09-14 02:19:24', '2020-09-14 02:19:24'),
(4, 4, 1, '2020-09-14 02:20:48', '2020-09-14 02:20:48'),
(5, 5, 1, '2020-09-14 02:21:31', '2020-09-14 02:21:31'),
(6, 6, 2, '2020-09-14 02:23:09', '2020-09-14 02:23:09'),
(7, 7, 1, '2020-09-14 02:24:39', '2020-09-14 02:24:39'),
(8, 8, 2, '2020-09-14 02:25:34', '2020-09-14 02:25:34'),
(9, 9, 1, '2020-09-14 02:28:20', '2020-09-14 02:28:20'),
(10, 10, 2, '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(11, 12, 2, '2020-09-19 04:43:02', '2020-09-19 04:43:02'),
(12, 13, 1, '2020-09-22 01:15:19', '2020-09-22 01:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_barcodes`
--

CREATE TABLE `product_barcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `barcode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_barcodes`
--

INSERT INTO `product_barcodes` (`id`, `product_id`, `barcode`, `barcode_number`, `created_at`, `updated_at`) VALUES
(1, 1, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:58px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:72px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:80px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1001', '2020-09-14 02:15:32', '2020-09-14 02:15:32'),
(2, 2, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:60px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:72px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:80px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1002', '2020-09-14 02:17:19', '2020-09-14 02:17:19'),
(3, 3, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:50px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:56px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:74px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:84px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1003', '2020-09-14 02:19:24', '2020-09-14 02:19:24'),
(4, 4, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:50px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:58px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:74px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:80px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1004', '2020-09-14 02:20:48', '2020-09-14 02:20:48'),
(5, 5, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:58px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:74px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:82px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1005', '2020-09-14 02:21:31', '2020-09-14 02:21:31'),
(6, 6, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:50px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:58px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:74px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:80px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1006', '2020-09-14 02:23:09', '2020-09-14 02:23:09'),
(7, 7, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:50px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:60px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:76px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:82px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1007', '2020-09-14 02:24:39', '2020-09-14 02:24:39'),
(8, 8, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:60px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:76px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:82px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1008', '2020-09-14 02:25:34', '2020-09-14 02:25:34'),
(9, 9, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:58px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:72px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:78px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1009', '2020-09-14 02:28:20', '2020-09-14 02:28:20'),
(10, 10, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:60px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:76px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:82px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1010', '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(11, 11, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:54px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:60px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:74px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:78px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1011', '2020-09-14 04:09:07', '2020-09-14 04:09:07'),
(12, 12, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:48px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:56px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:70px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:80px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1012', '2020-09-19 04:43:01', '2020-09-19 04:43:01'),
(13, 13, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:50px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:56px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:74px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:84px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1013', '2020-09-22 01:15:19', '2020-09-22 01:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix_url` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://127.0.0.1:8000/storage/',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_image`, `prefix_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/products/YsYERI3zpZUPZ4jgdmdGMxbprbGrsFLFk72cTyHh.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:15:32', '2020-09-14 02:15:32'),
(2, 1, 'images/products/6XjDaVcrT8FfdkaG5uQTZl5pe5dQjBqwPNcCEpWj.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:15:32', '2020-09-14 02:15:32'),
(3, 1, 'images/products/htKy41MZopekFBomLO3IM5SVUH9hwnDHXPc1DXjw.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:15:32', '2020-09-14 02:15:32'),
(4, 2, 'images/products/1gNcTv6dKuudmGa7QoOc2MwBiiC5tbjloX4RfZjb.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:17:19', '2020-09-14 02:17:19'),
(5, 2, 'images/products/Rj5XsQ2kPADZLwnBthcTWSdDj6YuubR7IEflDCJF.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:17:19', '2020-09-14 02:17:19'),
(6, 3, 'images/products/dwNexaUYP2e5lSUqoeLMvaBEqIG0c7uzXYc0K1CG.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:19:24', '2020-09-14 02:19:24'),
(7, 4, 'images/products/quywmHkT5AxtxL2NFODEnrYuHqbmj0VSmgOjHMMw.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:20:48', '2020-09-14 02:20:48'),
(8, 5, 'images/products/XKlbA5iy3j2YdpQ1PdMgci1pqMXpO3E5BaG0bY4L.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:21:31', '2020-09-14 02:21:31'),
(9, 5, 'images/products/CURKKCRtrtvNl2qYpyN66IkgxWIGKH8MXV2FMkzG.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:21:31', '2020-09-14 02:21:31'),
(10, 6, 'images/products/wqZkEZSJj40yYQRnHLXk7p8tNOXOgSXCfbQqNVqW.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:23:09', '2020-09-14 02:23:09'),
(11, 7, 'images/products/ARaCcIG6FY90OW4eCCuxxZh4h8jRkuGjw2VbdQXq.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:24:39', '2020-09-14 02:24:39'),
(12, 7, 'images/products/iP8rCtIVwH825v8HZmhG9tfKiZCBPX6paaGtlWOv.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:24:39', '2020-09-14 02:24:39'),
(13, 7, 'images/products/4QCH5X60hu7dCjaIS70KpJPA5nVt03YoepVUEX42.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:24:39', '2020-09-14 02:24:39'),
(14, 8, 'images/products/VnW0kx8e2cCZYPv1ui2lU4QjoswnjVYQEHfFwnDd.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:25:34', '2020-09-14 02:25:34'),
(15, 8, 'images/products/1sJVNri3ITxYRF7t3thJ47sQxYieQgCSPiVQAsuU.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:25:34', '2020-09-14 02:25:34'),
(16, 8, 'images/products/tfygTgDQlgEXSUqU5k1IJKdBNaCO8l0LwQDyIs2Z.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:25:34', '2020-09-14 02:25:34'),
(17, 9, 'images/products/wyFczlI0C8LywVIinqayCsy3ltmlomV2t6fAEqbu.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:28:20', '2020-09-14 02:28:20'),
(18, 9, 'images/products/0UmfAP3y6Kf971TDOhr9iVfynIHAvfe5dhPM4sKw.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:28:20', '2020-09-14 02:28:20'),
(19, 10, 'images/products/YFjry4c1dM9zIZgv1nJc1khO7Hjvwrm0VEEkXHO6.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(20, 10, 'images/products/2tjjHbSqQ7DL5sZ7lJ3tkWXEVq5IIcG7LEj31NtB.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(21, 10, 'images/products/F7mpHh1bMMpHlkLMZ1HwVqGHUuijFLd69jb4VCk0.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(22, 11, 'images/products/fxb4K5MIo7GITboFlStK06sdSeGt0wWK4fjIvyqK.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 04:09:07', '2020-09-14 04:09:07'),
(23, 11, 'images/products/K7kpPOHlGzqxhTqOZeNSXCwFX8Y0gIRsCY0GfuJL.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-14 04:09:07', '2020-09-14 04:09:07'),
(24, 12, 'images/products/57sXmvZ36Ud6u3ghAKGmmeKbEMMT0IPcIet1ccFd.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-19 04:43:02', '2020-09-19 04:43:02'),
(25, 13, 'images/products/dCAQxH7zzdQvWFeCcCD72SXUN2ehiOgcnz2pKMm2.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-22 01:15:19', '2020-09-22 01:15:19'),
(26, 13, 'images/products/mZR73jd4v7W2ty2rrprdCcmf4jCW5KPC7dpVBCga.jpeg', 'http://127.0.0.1:8000/storage/', '2020-09-22 01:15:19', '2020-09-22 01:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `variant_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-09-14 02:15:32', '2020-09-14 02:15:32'),
(2, 1, 2, '2020-09-14 02:15:32', '2020-09-14 02:15:32'),
(3, 2, 1, '2020-09-14 02:17:19', '2020-09-14 02:17:19'),
(4, 2, 2, '2020-09-14 02:17:19', '2020-09-14 02:17:19'),
(5, 3, 1, '2020-09-14 02:19:24', '2020-09-14 02:19:24'),
(6, 3, 2, '2020-09-14 02:19:24', '2020-09-14 02:19:24'),
(7, 4, 1, '2020-09-14 02:20:48', '2020-09-14 02:20:48'),
(8, 4, 2, '2020-09-14 02:20:48', '2020-09-14 02:20:48'),
(9, 5, 2, '2020-09-14 02:21:31', '2020-09-14 02:21:31'),
(10, 5, 3, '2020-09-14 02:21:31', '2020-09-14 02:21:31'),
(11, 6, 4, '2020-09-14 02:23:09', '2020-09-14 02:23:09'),
(12, 6, 5, '2020-09-14 02:23:09', '2020-09-14 02:23:09'),
(13, 7, 1, '2020-09-14 02:24:39', '2020-09-14 02:24:39'),
(14, 7, 2, '2020-09-14 02:24:39', '2020-09-14 02:24:39'),
(15, 8, 4, '2020-09-14 02:25:34', '2020-09-14 02:25:34'),
(16, 8, 5, '2020-09-14 02:25:34', '2020-09-14 02:25:34'),
(17, 9, 1, '2020-09-14 02:28:20', '2020-09-14 02:28:20'),
(18, 9, 2, '2020-09-14 02:28:20', '2020-09-14 02:28:20'),
(19, 10, 4, '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(20, 10, 5, '2020-09-14 02:31:20', '2020-09-14 02:31:20'),
(21, 12, 4, '2020-09-19 04:43:02', '2020-09-19 04:43:02'),
(22, 12, 5, '2020-09-19 04:43:02', '2020-09-19 04:43:02'),
(23, 13, 1, '2020-09-22 01:15:19', '2020-09-22 01:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitems`
--

CREATE TABLE `purchaseitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `insert_quantity` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchaseitems`
--

INSERT INTO `purchaseitems` (`id`, `purchase_id`, `product_id`, `merchant_id`, `price`, `insert_quantity`, `stock`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 120, 10, 10, '2020-09-06 08:14:01', '2020-09-06 08:14:01'),
(2, 2, 11, 1, 200, 150, 150, '2020-09-19 01:18:00', '2020-09-19 01:18:00'),
(3, 3, 7, 1, 120, 2, 2, '2020-09-26 06:44:29', '2020-09-26 06:44:29'),
(4, 3, 9, 1, 125, 250, 250, '2020-09-26 06:44:29', '2020-09-26 06:44:29'),
(5, 4, 7, 1, 1250, 5, 5, '2020-09-26 06:45:33', '2020-09-26 06:45:33'),
(6, 4, 12, 1, 250, 20, 20, '2020-09-26 06:45:33', '2020-09-26 06:45:33'),
(7, 4, 11, 1, 150, 2, 2, '2020-09-26 06:45:33', '2020-09-26 06:45:33'),
(8, 5, 12, 1, 350, 120, 120, '2020-09-26 07:31:33', '2020-09-26 07:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT 0,
  `purchase_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `invoice_no`, `merchant_id`, `total`, `paid`, `purchase_date`, `created_at`, `updated_at`) VALUES
(1, 122, 1, 1200, 1200, '2020-09-06', '2020-09-06 08:14:01', '2020-09-06 08:14:01'),
(2, 1500, 1, 30000, 30000, '2020-09-19', '2020-09-19 01:18:00', '2020-09-19 01:18:00'),
(3, 1200, 1, 31490, 31490, '2020-09-26', '2020-09-26 06:44:29', '2020-09-26 06:44:29'),
(4, 150, 1, 11550, 11550, '2020-09-26', '2020-09-26 06:45:33', '2020-09-26 06:45:33'),
(5, 150, 1, 42000, 42000, '2020-09-26', '2020-09-26 07:31:33', '2020-09-26 07:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `url`, `slider_caption`, `status`, `position`, `created_at`, `updated_at`) VALUES
(4, 'images/slider/Nvq11XWUnLdyvWf2OH3nItxGmRIsXdBxyR9gNIzJ.jpeg', NULL, NULL, 1, 1, '2020-09-13 22:33:46', '2020-09-13 22:33:46'),
(5, 'images/slider/Nvq11XWUnLdyvWf2OH3nItxGmRIsXdBxyR9gNIzJ.jpeg', '#', NULL, 1, 1, '2020-09-13 22:33:46', '2020-09-13 22:33:46'),
(6, 'images/slider/lPdC9wBWLIWJ6DEHwu9kn8yKC6tQGSSzT2JB6q5R.jpeg', NULL, NULL, 1, 2, '2020-09-20 05:34:32', '2020-09-20 05:34:32'),
(7, 'images/slider/lPdC9wBWLIWJ6DEHwu9kn8yKC6tQGSSzT2JB6q5R.jpeg', NULL, NULL, 1, 2, '2020-09-20 05:34:32', '2020-09-20 05:34:32'),
(8, 'images/slider/lPdC9wBWLIWJ6DEHwu9kn8yKC6tQGSSzT2JB6q5R.jpeg', NULL, NULL, 1, 2, '2020-09-20 05:34:32', '2020-09-20 05:34:32'),
(9, 'images/slider/cmWFTkIEYO3tIkPZ2uQRKHTFwDRYL8hwhI0BOIM4.jpeg', '#', NULL, 1, 1, '2020-09-22 00:44:13', '2020-09-22 00:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `category_id`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'paanjaabi', '1-paanjaabi', 1, 1, NULL, '2020-09-14 01:16:24', '2020-09-14 01:16:24'),
(2, 't-sshirt', '2-shirt', 1, 1, NULL, '2020-09-14 01:16:40', '2020-09-14 01:16:40'),
(3, 'pants', '3-pants', 1, 1, NULL, '2020-09-14 01:17:03', '2020-09-14 01:17:03'),
(4, 'Bags', '4-bags', 2, 1, NULL, '2020-09-14 01:17:33', '2020-09-14 01:17:33'),
(5, 'cosmatics', '5-costomers', 2, 1, NULL, '2020-09-14 01:17:47', '2020-09-14 01:20:31'),
(6, 'three-pics', '6-three-pics', 2, 1, NULL, '2020-09-14 02:26:32', '2020-09-14 02:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_sub_categories`
--

INSERT INTO `sub_sub_categories` (`id`, `name`, `slug`, `category_id`, `subcategory_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'jeaans', '2-jeaans', 1, 3, NULL, 1, '2020-09-14 01:18:09', '2020-09-14 01:18:14'),
(2, 'grabatine', '3-grabatine', 1, 3, NULL, 1, '2020-09-14 01:18:34', '2020-09-14 01:18:34'),
(3, 'kabil panjabi', '1-panjabi', 1, 1, NULL, 1, '2020-09-14 01:19:19', '2020-09-14 01:19:19'),
(4, 'jewellry', '4-jewellry', 2, 5, NULL, 1, '2020-09-14 01:20:02', '2020-09-14 01:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile_no`, `email`, `email_verified_at`, `password`, `address`, `city_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fahim Chowdhury', '01795297424', 'fahimmbpiii@gmail.com', NULL, '$2y$10$ONXRHMwHJaTQ4EcmaCWPvu8/F2usyHEJSvTWvlFvV6F8E5vWAvEaS', 'Dhaka', 1, 1, NULL, '2020-09-16 04:56:11', '2020-09-17 01:35:09'),
(2, 'Fahim Muntasir', '01795297426', 'fahimmbpi@gmail.com', NULL, '$2y$10$.uUb7WA2Jq23k66NPn1Egumroh0.QOtkJcpLTQmb5SFuyHxd0alO.', 'Dhaka', 18, 1, NULL, '2020-09-17 00:52:07', '2020-09-17 00:52:51'),
(3, 'Fahim', '01770280894', NULL, NULL, '$2y$10$L/pcc8eLwoRPpXvzQ6XGP.PIVgb8VuHwf7VTGEs5jPSRdGdFIYSaa', 'Dhaka', 6, 1, NULL, '2020-09-22 06:44:42', '2020-09-22 06:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `name`, `attribute_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '10', 1, 1, '2020-09-05 01:28:03', '2020-09-05 01:28:03'),
(2, '11', 1, 1, '2020-09-05 01:28:12', '2020-09-05 01:28:12'),
(3, '12', 1, 1, '2020-09-05 01:28:19', '2020-09-05 01:28:19'),
(4, 'green', 2, 1, '2020-09-05 01:28:27', '2020-09-05 01:28:27'),
(5, 'red', 2, 1, '2020-09-05 01:28:39', '2020-09-05 01:28:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`) USING HASH;

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comments_name_unique` (`name`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `debits`
--
ALTER TABLE `debits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_barcodes`
--
ALTER TABLE `product_barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_name_unique` (`name`);

--
-- Indexes for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_sub_categories_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variants_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `debits`
--
ALTER TABLE `debits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_barcodes`
--
ALTER TABLE `product_barcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
