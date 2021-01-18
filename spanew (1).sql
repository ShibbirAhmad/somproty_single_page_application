-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2020 at 02:35 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(1, 'fahim', 'fahimmbpi@gmail.com', '$2y$10$pAlKE3Ez5cm7HsatQrCF6uXIdzvCNEuFKcPxlGrTBILsXkSAKYnxe', NULL, 1, '2020-08-17 08:24:40', '2020-08-17 08:24:40');

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
  `icon_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_selected` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon_image`, `is_selected`, `status`, `created_at`, `updated_at`) VALUES
(1, 'electronice', NULL, 0, 1, '2020-09-01 07:15:53', '2020-09-12 01:24:26'),
(2, 'fashion', NULL, 1, 1, '2020-09-01 07:16:01', '2020-09-01 07:16:01'),
(3, 'hghg', 'images/category/DFgNuj5I0pnDKZ0FSpwQJwItiaOGoG1gxdBM7W7q.jpeg', 1, 0, '2020-09-04 09:48:03', '2020-09-04 09:48:03');

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
(100, 'New Fredy', 111, 1, '2020-09-05 00:41:00', '2020-09-05 00:41:00');

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
(100, 'Kaelyn Hill', 1, '2020-09-05 00:42:16', '2020-09-05 00:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Fahim', '01795297424', 'Dhaka', '2020-09-05 12:13:07', '2020-09-05 12:13:07'),
(2, 'Fahim', '01795297449', 'Muntasir', '2020-09-05 12:27:14', '2020-09-05 12:27:14');

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
(1, 'Fahim', 'Mohasagor', '01795297424', 'Dhaka', 1, '$2y$10$tQwYydnk.wMIWUfnK0lkFeo2OCwIFBJNLewjpHT8kt9VqV4cwDTRG', '2020-09-06 08:13:33', '2020-09-06 08:13:33');

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
(23, '2014_10_12_000000_create_users_table', 4),
(29, '2020_09_05_164925_create_orders_table', 5),
(30, '2020_09_05_165048_create_order_items_table', 5),
(31, '2020_09_05_172052_create_customers_table', 5),
(32, '2020_08_31_110050_create_offers_table', 6);

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
(3, 'images/offer/EXFWR6ugXLngzMXceD4ASFhtN8vBERzzXbJZXfTt.png', '#', 1, '2020-09-11 23:38:24', '2020-09-11 23:38:24'),
(4, 'images/offer/hvx7mBbmwNIZPIydlxG6UpWM4rVMVK6UUzy8RYI6.png', '###', 1, '2020-09-12 00:06:15', '2020-09-12 00:06:15'),
(5, 'images/offer/Pj8t2GprEDXVDxcrWXRXgEw3Q17tAjGPcOPeexEo.png', '####', 1, '2020-09-12 00:34:54', '2020-09-12 00:34:54');

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
(1, 100, 2, 1, '01795297424', 3, 1, 109, 0, 0, 110, 1, '45545454545748787', 1, NULL, NULL, 1, '2020-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-05 12:13:07', '2020-09-08 01:09:01'),
(2, 101, 1, 1, '01795297424', 17, 8, 56, 0, 0, 670, 5, '4656', 1, NULL, NULL, 1, '2020-09-06', 1, '2020-09-12', 1, '2020-09-12', NULL, NULL, NULL, NULL, '2020-09-05 12:15:36', '2020-09-12 04:27:14'),
(3, 102, 3, 1, '01795297424', 17, NULL, 56, 0, 0, 670, 5, '45', 1, 1, '2020-09-12', 1, '2020-09-12', 1, '2020-09-12', 1, '2020-09-12', 1, '2020-09-12', NULL, NULL, '2020-09-05 12:15:54', '2020-09-12 04:27:21'),
(4, 103, 2, 1, '', 17, 16, 56, 0, 10, 670, 5, '', 1, NULL, NULL, 1, '2020-09-12', 1, '2020-09-12', 1, '2020-09-12', 1, '2020-09-12', NULL, NULL, '2020-09-05 12:18:42', '2020-09-12 04:27:12'),
(5, 104, 2, 1, '01795297424', 17, 16, 56, 20, 10, 670, 3, '', 1, NULL, NULL, 1, '2020-09-12', NULL, NULL, NULL, NULL, 1, '2020-09-12', NULL, NULL, '2020-09-05 12:19:48', '2020-09-12 04:27:05'),
(6, 105, 2, 1, '', 17, 18, 56, 0, 0, 110, 5, '', 1, NULL, NULL, 1, '2020-09-06', 1, '2020-09-12', 1, '2020-09-12', NULL, NULL, NULL, NULL, '2020-09-05 12:24:31', '2020-09-12 04:27:11'),
(7, 106, 2, 1, '', 17, 18, 56, 0, 0, 110, 5, '', 1, NULL, NULL, 1, '2020-09-06', 1, '2020-09-12', 1, '2020-09-12', NULL, NULL, NULL, NULL, '2020-09-05 12:24:35', '2020-09-12 04:26:46'),
(8, 107, 2, 1, '', 17, 5, 56, 0, 0, 110, 5, '4454', 1, NULL, NULL, 1, '2020-09-06', 1, '2020-09-06', 1, '2020-09-08', NULL, NULL, NULL, NULL, '2020-09-05 12:25:04', '2020-09-08 04:45:22'),
(9, 108, 2, 2, '', 16, 6, 83, 0, 0, 110, 3, '133', 1, NULL, NULL, 1, '2020-09-12', NULL, NULL, NULL, NULL, 1, '2020-09-06', NULL, NULL, '2020-09-05 12:27:14', '2020-09-12 04:27:09'),
(10, 109, 2, 1, '', 16, 1, 83, 0, 0, 360, 5, '133', 1, NULL, NULL, NULL, NULL, 1, '2020-09-08', 1, '2020-09-12', 1, '2020-09-06', NULL, NULL, '2020-09-06 08:19:32', '2020-09-12 04:27:08'),
(11, 110, 2, 1, '', 15, NULL, 74, 0, 0, 230, 3, NULL, 1, 1, '2020-09-12', 1, '2020-09-12', NULL, NULL, NULL, NULL, 1, '2020-09-12', NULL, NULL, '2020-09-08 01:08:26', '2020-09-12 04:27:09');

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
  `attribute_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `attribute_id`, `variant_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 110, 1, NULL, NULL, '2020-09-05 12:13:07', '2020-09-05 12:13:07'),
(2, 2, 1, 110, 5, NULL, NULL, '2020-09-05 12:15:36', '2020-09-05 12:15:36'),
(3, 2, 3, 120, 1, 1, 1, '2020-09-05 12:15:36', '2020-09-05 12:15:36'),
(4, 3, 1, 110, 5, NULL, NULL, '2020-09-05 12:15:54', '2020-09-05 12:15:54'),
(5, 3, 3, 120, 1, 1, 1, '2020-09-05 12:15:54', '2020-09-05 12:15:54'),
(6, 4, 1, 110, 5, NULL, NULL, '2020-09-05 12:18:42', '2020-09-05 12:18:42'),
(7, 4, 3, 120, 1, 1, 1, '2020-09-05 12:18:42', '2020-09-05 12:18:42'),
(8, 5, 1, 110, 5, NULL, NULL, '2020-09-05 12:19:48', '2020-09-05 12:19:48'),
(9, 5, 3, 120, 1, 1, 1, '2020-09-05 12:19:48', '2020-09-05 12:19:48'),
(10, 6, 1, 110, 1, NULL, NULL, '2020-09-05 12:24:31', '2020-09-05 12:24:31'),
(11, 7, 1, 110, 1, NULL, NULL, '2020-09-05 12:24:35', '2020-09-05 12:24:35'),
(12, 8, 1, 110, 1, NULL, NULL, '2020-09-05 12:25:04', '2020-09-05 12:25:04'),
(13, 9, 1, 110, 1, NULL, NULL, '2020-09-05 12:27:14', '2020-09-05 12:27:14'),
(14, 10, 3, 120, 3, NULL, NULL, '2020-09-06 08:19:32', '2020-09-06 08:19:32'),
(15, 11, 1, 110, 1, NULL, NULL, '2020-09-08 01:08:26', '2020-09-08 01:08:26'),
(16, 11, 2, 120, 1, NULL, NULL, '2020-09-08 01:08:26', '2020-09-08 01:08:26');

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
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `merchant_id`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `product_code`, `slug`, `stock`, `sale_price`, `discount`, `price`, `status`, `details`, `created_at`, `updated_at`) VALUES
(1, 'jeans', NULL, 2, NULL, NULL, 1001, 'jeans-1001', 18, 120, 10, 110, '1', '<p>htgftjhgfgh</p>', '2020-09-04 10:32:35', '2020-09-12 04:26:53'),
(2, 'pents', NULL, 1, 1, NULL, 1002, 'pents-1002', 0, 120, NULL, 120, '1', '<p>jyhghg</p>', '2020-09-04 10:33:33', '2020-09-12 04:25:58'),
(3, 'jenas', NULL, 2, NULL, NULL, 1003, 'jenas-1003', 13, 120, NULL, 120, '1', '<p>gfhgjhg</p>', '2020-09-05 01:30:08', '2020-09-12 04:26:53');

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
(1, 3, 1, '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(2, 3, 2, '2020-09-05 01:30:08', '2020-09-05 01:30:08');

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
(1, 1, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:58px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:72px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:80px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1001', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(2, 2, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:52px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:60px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:72px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:80px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1002', '2020-09-04 10:33:33', '2020-09-04 10:33:33'),
(3, 3, '<div style=\"font-size:0;position:relative;width:114px;height:30px;\">\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:22px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:30px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:38px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:50px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:56px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:66px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:74px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:84px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:88px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:30px;position:absolute;left:98px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:30px;position:absolute;left:106px;top:0px;\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:30px;position:absolute;left:110px;top:0px;\">&nbsp;</div>\r\n</div>\r\n', '1003', '2020-09-05 01:30:08', '2020-09-05 01:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/products/IDOsVHqiEhdXkQOKR3dI8i4WPL4m0PxaMkwsX3I6.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(2, 1, 'images/products/FK4KY2HAxN9UV5HAENIozw4OUZhm80Tb1LAkyjiu.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(3, 1, 'images/products/jAe9MDkCMjPaVvcUKcJKfIHTCiQwllhaDR593RAO.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(4, 1, 'images/products/Mjt0hx8ZJlXLDOwr4KhfGbFXNeQLVgDAdf4qpdOe.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(5, 1, 'images/products/pNrajhcSalKGEybfVuTChjM9PJ4WyOcnPvVyBccK.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(6, 1, 'images/products/hR6Tmvbro6qaPiAzKMUYn9ZA6DTBrJYePe0ukUym.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(7, 1, 'images/products/Pll2RADXKYnrJTx9M3wwGL63W1HmNRqk3TxpDICI.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(8, 1, 'images/products/78Yyjw6lXsKGyO6zCAh4f2V4DIpmnhsGOnRJebPo.jpeg', '2020-09-04 10:32:35', '2020-09-04 10:32:35'),
(9, 2, 'images/products/bFkx2YGkI3jcfPpdK0o7J9O2kS31mW3Jo7fnqh9V.jpeg', '2020-09-04 10:33:33', '2020-09-04 10:33:33'),
(10, 2, 'images/products/vPNYfac5wzbSASbqY3GUi9Tu7IIFNs4QhFsc3n88.jpeg', '2020-09-04 10:33:33', '2020-09-04 10:33:33'),
(11, 2, 'images/products/RF1r5Zs2D4olZxEBlxWFuG3qt4eWbag9sGL0rU8A.jpeg', '2020-09-04 10:33:33', '2020-09-04 10:33:33'),
(12, 2, 'images/products/CsSYgeahGHvWfYvtH9Gq2Q0XeuBhLOxxG5qkqaOS.jpeg', '2020-09-04 10:33:33', '2020-09-04 10:33:33'),
(13, 3, 'images/products/uKGzwUy454r2KZhw2ib8CLFmbc8jFrNgTanvYtha.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(14, 3, 'images/products/tpMrYF2Wfcz56v5Bs8JxB4ziZgPsZmsiErTKnxsC.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(15, 3, 'images/products/p0kJvBmqxVGGCgrFOY3KXcrjghI21execduOHrPm.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(16, 3, 'images/products/zisw46pXXJ4pMvSB8mdrwNazrXcXatmsmQFLzoTx.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(17, 3, 'images/products/x41Qpv6Be49dMq8CBvXxqf6k1bj3Q9vfRoPQKXZI.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(18, 3, 'images/products/fltnLO8HzyG350188q6CwIDYWG7u4WLu1WicoeyA.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(19, 3, 'images/products/BOxH8B6naggwKqoaGImayU6jBgcygLUw5zpPyoMF.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(20, 3, 'images/products/MHj4OalS68gYG7P5wWnAoll5GwDKepOmZLvaUg8H.jpeg', '2020-09-05 01:30:08', '2020-09-05 01:30:08');

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
(1, 3, 1, '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(2, 3, 1, '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(3, 3, 4, '2020-09-05 01:30:08', '2020-09-05 01:30:08'),
(4, 3, 1, '2020-09-05 01:30:08', '2020-09-05 01:30:08');

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
(1, 1, 3, 1, 120, 10, 10, '2020-09-06 08:14:01', '2020-09-06 08:14:01');

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
(1, 122, 1, 1200, 1200, '2020-09-06', '2020-09-06 08:14:01', '2020-09-06 08:14:01');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `url`, `slider_caption`, `status`, `created_at`, `updated_at`) VALUES
(3, 'images/slider/gINA9u90Wckeoj3hVo72vlypuXZWAncAx8Funm1C.jpeg', NULL, NULL, 1, '2020-09-09 23:37:01', '2020-09-09 23:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'computer', 1, 1, NULL, '2020-09-01 07:16:24', '2020-09-01 07:16:24'),
(2, 'pc', 1, 1, NULL, '2020-09-01 07:16:33', '2020-09-01 07:16:33'),
(3, 'laptop 2', 1, 1, NULL, '2020-09-12 04:24:37', '2020-09-12 04:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `sub_sub_categories` (`id`, `name`, `category_id`, `subcategory_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mouse', 1, 1, NULL, 1, '2020-09-09 23:05:56', '2020-09-09 23:05:56'),
(2, 'keyboard', 1, 1, NULL, 1, '2020-09-09 23:06:08', '2020-09-09 23:06:08'),
(3, 'pendrive', 1, 2, NULL, 1, '2020-09-09 23:06:31', '2020-09-09 23:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Reggie Langosh', 'zaria.price@example.net', '1978492286', 'Mayertburgh', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'URPGLfXDA7', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(2, 'Chelsea Williamson', 'madelyn.ebert@example.com', '595058873', 'Daynetown', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'a5d8UfuKFU', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(3, 'Dr. Mckenna Gutkowski DVM', 'buddy.schumm@example.net', '2135635583', 'New Xzavier', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pvdRpLEPki', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(4, 'Zita Kiehn V', 'nikko16@example.com', '142538101', 'East Malcolm', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8V32FqZi0H', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(5, 'Marina Hintz', 'marcellus.mitchell@example.com', '1499214668', 'Alessandromouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tMLC5HL8Gv', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(6, 'Drake Champlin', 'stephon.bradtke@example.net', '995986907', 'Willmsstad', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hTk7DoQT70', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(7, 'Rosella D\'Amore', 'bauch.margret@example.org', '698575216', 'Gabriellaland', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '10pX2jZefL', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(8, 'Monserrate Bayer', 'jennings.goodwin@example.net', '185277039', 'Port Austyntown', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QDbQ5G9Vao', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(9, 'Mr. Alf Kuvalis', 'zemlak.derick@example.net', '1727100612', 'South Noah', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3FngE7EF4i', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(10, 'Mara Mills MD', 'strosin.delmer@example.com', '574488346', 'Elianeville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'EwudD8nvZf', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(11, 'Hobart Medhurst', 'rabbott@example.net', '32273014', 'New Maribel', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'm2270ymIDw', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(12, 'Elmore Luettgen', 'heathcote.briana@example.net', '1039120323', 'North Norbertmouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IlPObZsQk0', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(13, 'Dr. Eden Koss III', 'marty.dare@example.net', '542731906', 'Eichmannville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gcnkYk4BJ0', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(14, 'Ila Rath MD', 'qdickens@example.com', '1412403903', 'Naderton', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'bTIOnFI7dS', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(15, 'Mrs. Leslie Heathcote II', 'bradford36@example.net', '2023085912', 'East Therese', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4X5DGndDp7', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(16, 'Felicia Bailey', 'erica27@example.net', '1736260061', 'Leschstad', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'g0I3vzfgyA', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(17, 'Miss Edna Hyatt', 'rath.adell@example.net', '1753155035', 'Cummingstown', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IAcuci2zzg', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(18, 'Chanelle Stokes', 'tyrel08@example.org', '1148136318', 'Leuschkebury', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8EyFt1CEy5', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(19, 'Skyla Windler MD', 'blanda.zachariah@example.com', '358486433', 'Hudsonmouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Gc4y96lbwS', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(20, 'Katharina Kuvalis PhD', 'xthiel@example.net', '138196265', 'South Arnoport', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kIOhUzQCQt', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(21, 'Maximilian Cruickshank', 'tiffany73@example.org', '1583266823', 'Freddyfort', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'f6qxrDmtn5', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(22, 'Germaine Cronin', 'aorn@example.com', '280825179', 'East Raina', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mLaT9rjkDy', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(23, 'Florence Prohaska', 'pstroman@example.org', '1373177187', 'Germanfort', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vmc52HQXIK', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(24, 'Horacio Raynor', 'kiana.dicki@example.com', '1778805648', 'Helmerport', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1rXYmD7HXj', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(25, 'Vance Blanda', 'demario68@example.org', '317160046', 'Lake Alana', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LAMG4Dj5V2', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(26, 'Danika Crist', 'christiansen.cletus@example.org', '2058405497', 'West Madilyn', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lFAKt5iEb3', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(27, 'Willie Will', 'leon.luettgen@example.net', '523183766', 'East Jewell', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'eQ2IEUOF30', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(28, 'Jewel Fay DDS', 'kharvey@example.com', '2047262620', 'Terryburgh', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TVUVN1kCU1', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(29, 'Mrs. Virginia Heaney III', 'fkoss@example.com', '220293231', 'Bruenview', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'z4vbdpBVTN', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(30, 'Claudie Quigley', 'nbartoletti@example.com', '1688512605', 'North Beulahland', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Oiw8cMzLET', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(31, 'Elvis Koss', 'weimann.imelda@example.com', '1249243790', 'Shieldsmouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'bxyEuDKTay', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(32, 'Xander Schiller', 'rchamplin@example.com', '1520250249', 'South Ellieside', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0N9Hz9LNID', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(33, 'Darrin Conroy', 'neha.anderson@example.org', '2135124382', 'Roseton', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gTR7OZ9LKs', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(34, 'Reba Gulgowski', 'santina52@example.com', '1216200217', 'Lake Alfordville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'iyzSvarjNU', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(35, 'Wallace Brown', 'henri64@example.com', '1176338143', 'Andreannetown', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v7nR11nOrU', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(36, 'Ambrose Hoppe', 'mclaughlin.isaias@example.net', '463329252', 'Cronastad', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ixNL8PbNn2', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(37, 'Dr. Bethany Hermann', 'mlueilwitz@example.com', '1569878385', 'Port Jaceyport', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BCDzEJqzgy', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(38, 'Christy Cummerata', 'bhaley@example.com', '1543662566', 'Kirkmouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FyUX9skNOR', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(39, 'Leta Corkery', 'rylan45@example.net', '1247143149', 'Claudiefurt', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kJQmAx7pUY', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(40, 'Carli Corkery Sr.', 'orn.linnea@example.com', '2033535796', 'Angelineburgh', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fDteQfS4Ff', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(41, 'Norval Smith', 'beahan.jade@example.org', '2015980750', 'Enochview', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0dzVGcFQDz', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(42, 'Miss Shyann Wuckert MD', 'xhahn@example.com', '598870297', 'South Catalinahaven', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SmSJHlpSJw', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(43, 'Dr. Foster Moore', 'jalyn47@example.com', '2099949401', 'South Ernest', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OahS1VR2Sg', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(44, 'Prof. Delilah Feest', 'norris.batz@example.org', '2082575179', 'Norbertland', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nzcQSWTQQN', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(45, 'Mrs. Noemi Harber', 'ondricka.athena@example.org', '1662151888', 'Kristofferland', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hJMrOUg2px', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(46, 'Araceli Dibbert', 'virginia.goodwin@example.org', '1317425828', 'Juwanburgh', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tS6MafXsKU', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(47, 'Corine Rempel', 'marjory.schumm@example.net', '535493950', 'Sporerport', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F3d8DYCWrP', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(48, 'Ally Skiles', 'qkovacek@example.net', '1874507821', 'Leuschkemouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aFeynnDuDv', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(49, 'May Bergnaum Sr.', 'mayra.goodwin@example.net', '395335880', 'Treuteltown', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'benGVi7c78', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(50, 'Prof. Rogers Lockman', 'elwyn.robel@example.org', '299011901', 'Lake Bennie', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IdwQtsuod1', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(51, 'Jody VonRueden', 'corwin.bernadette@example.net', '1807326018', 'Bellamouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KDVMmHk9hl', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(52, 'Darrell Beatty', 'uwest@example.net', '372287262', 'Tressieborough', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '33phJdUC9i', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(53, 'Nico Marks', 'agislason@example.com', '1330014026', 'Abernathyville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LVBjbXYXFP', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(54, 'Glenda Mitchell Sr.', 'lucinda.satterfield@example.com', '660624509', 'Roxannestad', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YGtkGedME6', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(55, 'Gregory Fay', 'fritsch.jocelyn@example.org', '1879211590', 'Fatimashire', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rkiIKeUDfc', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(56, 'Dr. Gustave Paucek Sr.', 'curt.lockman@example.net', '1915001809', 'Collinsville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KgntYMObYg', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(57, 'Marquise Glover', 'dominic19@example.org', '1100431829', 'South Brendafort', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TfZgc1hwof', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(58, 'Martine Goodwin Jr.', 'camille99@example.org', '973455250', 'Hellershire', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'r0Gy8oqyeX', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(59, 'Magali Hand', 'gwuckert@example.com', '1517562021', 'West Bertrandberg', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fIJIxtuaKh', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(60, 'Delpha Franecki', 'skiles.jerrold@example.net', '622096140', 'Rohanhaven', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '45cfcBUmZz', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(61, 'Miss Tara Schultz II', 'mmurphy@example.com', '1215626707', 'Kianastad', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KdgNkiN2Ky', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(62, 'Yasmin Balistreri', 'powlowski.corbin@example.org', '1060563601', 'Botsfordhaven', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wHQuvfp6lQ', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(63, 'Bethany Cole', 'dtremblay@example.org', '2005743386', 'Okunevaville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8mQAqdOCoK', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(64, 'Destiney Langworth', 'ara.treutel@example.org', '855464992', 'Brandynstad', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YrFIozJzrk', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(65, 'Guy Stroman', 'tcole@example.org', '717306231', 'Port Frederic', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KSVLLw2zAV', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(66, 'Lucius Padberg', 'elody68@example.net', '1104157565', 'Lake Declanfurt', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3ZPCFy6WHM', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(67, 'Finn Kertzmann', 'beryl18@example.org', '330231945', 'West Lia', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Y21rd7Hm0m', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(68, 'Dr. Viviane Jacobi', 'ernser.sonia@example.com', '1812209128', 'Wolfland', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fS6ScBR7zs', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(69, 'Jannie Quitzon', 'ysauer@example.net', '364063402', 'South Anyamouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uAswuYCuf9', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(70, 'Eddie Kuhn', 'hartmann.alfreda@example.com', '2071376731', 'Haagfurt', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dBJKAU6a5q', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(71, 'Mr. Donny Shields', 'conroy.esmeralda@example.org', '1751434380', 'Joannyview', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'j1CKEEPad7', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(72, 'Pierre Altenwerth', 'willa96@example.com', '1094738494', 'West Linwoodview', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tb1xfccYjD', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(73, 'Penelope Purdy', 'wlittel@example.org', '510824471', 'Port Emmanuellehaven', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cAT6pI3YWX', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(74, 'Eldora Hodkiewicz', 'mayer.brycen@example.org', '1492821616', 'Burdettechester', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oYpLENNGTJ', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(75, 'Ms. Anastasia Baumbach Sr.', 'enrique.mayer@example.net', '1590948706', 'South Kennedimouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D1bewXnuwA', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(76, 'Larry Farrell DVM', 'tyrese.hyatt@example.net', '812997152', 'Port Marisaton', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'twazvkUqhl', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(77, 'Athena Daugherty', 'fferry@example.net', '663950832', 'Rempelfurt', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'JbcnJbUsuN', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(78, 'Eulalia Greenholt', 'joan.yundt@example.net', '95368975', 'Oswaldborough', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DdhWwQHBGr', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(79, 'Sanford Murazik', 'bruen.jayne@example.com', '582160942', 'Rosariofurt', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ypRIL2Lxt2', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(80, 'Zoie Shields', 'gusikowski.hudson@example.com', '1799753263', 'Roryville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4Zsu8bYhQk', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(81, 'Katheryn Dickens', 'cali97@example.com', '450211269', 'Kimberlyview', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FAJ6YpIDm1', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(82, 'Evans Skiles', 'runolfsdottir.adeline@example.org', '374993256', 'Haileyburgh', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6PLIJH66C6', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(83, 'Kari Heidenreich', 'rutherford.merl@example.com', '108498196', 'New Tia', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6CGLz6Xx8K', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(84, 'Duane Kessler I', 'kdeckow@example.org', '1472152110', 'Kirlinmouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Qev1n8LrGj', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(85, 'Augusta Ondricka', 'cummings.asia@example.org', '1460276875', 'Kerluketon', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9e79On5LEn', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(86, 'Aidan Spencer', 'wlowe@example.com', '242662713', 'Kuhicport', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pMTZFSlWor', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(87, 'Santiago Emmerich', 'purdy.isabelle@example.org', '1988840100', 'New Cicero', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GVXgSoJGfE', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(88, 'Stone Daniel', 'orland74@example.com', '2057484865', 'Corwinside', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'h6BVgsh5b2', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(89, 'Eugenia Cummerata', 'chad80@example.net', '624215031', 'Miltonville', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tML9ZWmeQ1', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(90, 'Tianna Gutkowski', 'tnikolaus@example.net', '1143520041', 'East Abelmouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GWdU3L7Hq3', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(91, 'Prof. Erica Haag PhD', 'haylee40@example.net', '677411794', 'Smithamhaven', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'e2UW6A7C9M', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(92, 'Claire Ward', 'laila03@example.net', '1919693731', 'Gissellehaven', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F2Nn8b3z6I', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(93, 'Mallie Goodwin', 'kromaguera@example.org', '506281481', 'Port Ignatius', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LHDC4QfocJ', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(94, 'Lionel Spinka', 'hyatt.nedra@example.com', '601745325', 'Ebertburgh', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NtUkLgctF1', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(95, 'Polly Ward', 'dayton.lemke@example.net', '1931137999', 'Donnaborough', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ra7pGidz5i', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(96, 'Prof. Jordan Rempel', 'gwitting@example.net', '1613315665', 'South Katarinaborough', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HfiyIPWyfV', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(97, 'Ms. Laisha McClure DDS', 'daija.flatley@example.net', '316563808', 'South Cecelia', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9AHMhQ41JT', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(98, 'Lynn Halvorson', 'brody70@example.com', '1165041551', 'Sipeshaven', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LH7dLbLU0n', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(99, 'Isabell Reilly', 'gbaumbach@example.net', '886537171', 'South Eloisamouth', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dV6sngPV2D', '2020-09-04 11:14:48', '2020-09-04 11:14:48'),
(100, 'Derek Deckow MD', 'avis.volkman@example.com', '950895113', 'Watersstad', '2020-09-04 11:14:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NiJ3eS8wuZ', '2020-09-04 11:14:48', '2020-09-04 11:14:48');

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_barcodes`
--
ALTER TABLE `product_barcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
