-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 09:42 AM
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
-- Database: `hbweb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin-cred`
--

CREATE TABLE `admin-cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin-cred`
--

INSERT INTO `admin-cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'Admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(57, 79, 'Deluxe Room', 500, 1000, 'D101', 'TestMail', '072', '                                    Kalmuani                                    '),
(58, 80, 'Simple Room', 300, 900, 'S101', 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(59, 81, 'Deluxe Room', 500, 1000, 'D102', 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(60, 82, 'Luxuary Room', 600, 1800, 'L101', 'aasath king', '0754834050', 'Ampara'),
(61, 83, 'Luxuary Room', 600, 1800, NULL, 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(62, 84, 'Super Deluxe Room', 750, 1500, NULL, 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(63, 85, 'Super Deluxe Room', 750, 1500, NULL, 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(64, 86, 'Super Deluxe Room', 750, 2250, NULL, 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(65, 87, 'Super Deluxe Room', 750, 1500, NULL, 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(66, 88, 'Simple Room', 300, 600, 's100', 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(67, 89, 'Deluxe Room', 500, 500, 'D521', 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(68, 90, 'Simple Room', 300, 900, NULL, 'TestMail', '072', 'Kalmuani'),
(69, 91, 'Deluxe Room', 500, 3000, NULL, 'TestMail', '072', '                                    Kalmuani                                    '),
(70, 92, 'Deluxe Room', 500, 2500, '120', 'TestMail', '072', '                                    Kalmuani                                    '),
(71, 93, 'Luxuary Room', 600, 1200, '126', 'TestMail', '072', '                                    Kalmuani                                    '),
(72, 94, 'Simple Room', 300, 600, 's102', 'TestMail', '072', '                                    Kalmuani                                    '),
(73, 95, 'Super Deluxe Room', 750, 1500, 'SD123', 'aasath king', '0754834050', '                                    saintha\r\nsd                                    '),
(74, 96, 'Deluxe Room', 500, 1000, NULL, 'aasath kamil', '0773400564', '312/A, Aljalal Road, Sainthamaruthu-04'),
(75, 97, 'Deluxe Room', 500, 1000, NULL, 'aasath kamil', '0773400564', '                                    312/A, Aljalal Road, Sainthamaruthu-04                                    '),
(76, 98, 'Simple Room', 300, 900, 'S100', 'aasath kamil', '0773400564', '                                    312/A, Aljalal Road, Sainthamaruthu-04                                    '),
(77, 99, 'Super Deluxe Room', 750, 1500, 'sd100', 'TestMail', '072', 'Kalmuani                                    '),
(78, 100, 'Super Deluxe Room', 750, 1500, 'sd102', 'aasath kamil', '0773400564', '  312/A, Aljalal Road, Sainthamaruthu-04                                    '),
(79, 101, 'Luxuary Room', 600, 600, NULL, 'TestMail', '072', '                                    Kalmuani                                    '),
(80, 102, 'Luxuary Room', 600, 600, NULL, 'TestMail', '072', '                                    Kalmuani                                    '),
(81, 103, 'Super Deluxe Room', 750, 1500, NULL, 'TestMail', '072', '                                    Kalmuani                                    '),
(82, 104, 'Luxuary Room', 600, 1200, NULL, 'TestMail', '072', '                                    Kalmuani                                    ');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(100) NOT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `rate_review` int(11) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_amt`, `trans_status`, `rate_review`, `datentime`) VALUES
(79, 39, 16, '2023-10-31', '2023-11-02', 1, NULL, 'booked', 'ORD_397240334', 1000, 'success', 1, '2023-08-16 19:43:59'),
(80, 37, 15, '2023-10-31', '2023-11-03', 1, NULL, 'booked', 'ORD_371927068', 900, 'success', 0, '2023-09-19 19:47:38'),
(81, 37, 16, '2023-10-31', '2023-11-02', 1, NULL, 'booked', 'ORD_372807408', 1000, 'success', 0, '2023-10-31 19:48:58'),
(82, 37, 17, '2023-10-31', '2023-11-03', 1, NULL, 'booked', 'ORD_373876001', 1800, 'success', 0, '2023-10-31 19:55:50'),
(83, 37, 17, '2023-10-31', '2023-11-03', 0, 1, 'cancelled', 'ORD_37783873', 1800, 'success', 0, '2023-10-31 20:00:50'),
(84, 37, 18, '2023-10-31', '2023-11-02', 0, 1, 'cancelled', 'ORD_378583790', 1500, 'success', 0, '2023-10-31 20:11:43'),
(85, 37, 18, '2023-10-31', '2023-11-02', 0, 1, 'cancelled', 'ORD_3794098', 1500, 'success', 0, '2023-10-31 20:15:43'),
(86, 37, 18, '2023-10-31', '2023-11-03', 0, 1, 'cancelled', 'ORD_377055576', 2250, 'success', 0, '2023-10-31 20:17:05'),
(87, 37, 18, '2023-10-31', '2023-11-02', 0, 1, 'cancelled', 'ORD_37451193', 1500, 'success', 0, '2023-10-31 20:21:03'),
(88, 37, 15, '2023-11-04', '2023-11-06', 1, NULL, 'booked', 'ORD_378626657', 600, 'success', 0, '2023-10-31 22:34:17'),
(89, 37, 16, '2023-11-03', '2023-11-04', 1, NULL, 'booked', 'ORD_378263158', 500, 'success', 0, '2023-11-02 15:32:34'),
(90, 39, 15, '2023-11-02', '2023-11-05', 0, NULL, 'pending', 'ORD_397772453', 900, 'pending', NULL, '2023-11-02 17:48:21'),
(91, 39, 16, '2023-11-10', '2023-11-16', 0, 1, 'cancelled', 'ORD_393330578', 3000, 'success', NULL, '2023-11-02 17:56:55'),
(92, 39, 16, '2023-11-10', '2023-11-15', 1, NULL, 'booked', 'ORD_398442830', 2500, 'success', 1, '2023-11-02 17:58:12'),
(93, 39, 17, '2023-11-02', '2023-11-04', 1, NULL, 'booked', 'ORD_399150374', 1200, 'success', 1, '2023-11-02 18:47:00'),
(94, 39, 15, '2023-11-08', '2023-11-10', 1, NULL, 'booked', 'ORD_395141699', 600, 'success', 1, '2023-11-02 19:40:52'),
(95, 37, 18, '2023-11-02', '2023-11-04', 1, NULL, 'booked', 'ORD_377881561', 1500, 'success', 1, '2023-11-02 19:58:35'),
(96, 40, 16, '2023-11-02', '2023-11-04', 0, NULL, 'pending', 'ORD_406901890', 1000, 'pending', NULL, '2023-11-02 22:23:11'),
(97, 40, 16, '2023-11-03', '2023-11-05', 0, 1, 'cancelled', 'ORD_402418119', 1000, 'success', NULL, '2023-11-02 22:24:35'),
(98, 40, 15, '2023-11-13', '2023-11-16', 1, NULL, 'booked', 'ORD_408625099', 900, 'success', 1, '2023-11-02 22:29:31'),
(99, 39, 18, '2023-11-28', '2023-11-30', 1, NULL, 'booked', 'ORD_39743451', 1500, 'success', 1, '2023-11-03 10:07:45'),
(100, 40, 18, '2023-11-28', '2023-11-30', 1, 1, 'cancelled', 'ORD_407659182', 1500, 'success', NULL, '2023-11-03 10:07:46'),
(101, 39, 17, '2023-11-05', '2023-11-06', 0, 1, 'cancelled', 'ORD_393503623', 600, 'success', NULL, '2023-11-05 08:06:26'),
(102, 39, 17, '2023-11-05', '2023-11-06', 0, 1, 'cancelled', 'ORD_394483150', 600, 'success', NULL, '2023-11-05 08:24:42'),
(103, 39, 18, '2023-11-05', '2023-11-07', 0, 1, 'cancelled', 'ORD_394134616', 1500, 'success', NULL, '2023-11-05 08:36:13'),
(104, 39, 17, '2023-11-05', '2023-11-07', 0, 1, 'cancelled', 'ORD_394491685', 1200, 'success', NULL, '2023-11-05 09:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(49, 'IMG_69598.png'),
(50, 'IMG_67374.png'),
(51, 'IMG_79892.png'),
(52, 'IMG_51523.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tw` varchar(50) NOT NULL,
  `fb` varchar(50) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `email`, `tw`, `fb`, `iframe`) VALUES
(1, 'Sea Breeze Hotel, Sainthmaruthu -09', 'https://goo.gl/maps/oC3q4pbhR2wCufjJ9', 672222865, 'seabreazehotel@gmail.com', 'www.twitter.com', 'https://web.facebook.com/p/SEA-BREEZE-Restaurant-1', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d349.7200069142583!2d81.84343025131581!3d7.395266162642402!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae53f2c1e5e453f:0x7919264b9b4db9f7!2sSea Breeze Hotel!5e0!3m2!1sen!2slk!4v1698942485688!5m2!1sen!2slk');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(65) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(13, 'IMG_30442.svg', 'Wifi', 'Stay connected with our high-speed Wi-Fi. Whether for work or leisure, enjoy fast and reliable internet in your room.'),
(14, 'IMG_42711.svg', 'Air Contionaring', 'Stay cool and refreshed on scorching days, or cozy up in warmth when the weather turns chilly. Relax, unwind, and rejuvenate in an atmosphere tailored to your personal comfort preferences'),
(15, 'IMG_92607.svg', 'Televsiion', 'Whether you\'re winding down after a day of exploring the city or catching up on your favorite shows, our hotel room television is designed to cater to your entertainment needs.'),
(17, 'IMG_95157.svg', 'Spa', 'Our Spa Room offers you the perfect retreat from the stresses of everyday life. As you step into this serene oasis, you\'ll immediately sense the calming ambiance that surrounds yo');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(8, 'Bedroom'),
(9, 'Balcony'),
(10, 'Kitchen'),
(16, 'Bathroom');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(1, 93, 17, 39, 4, 'Its Very good and need Rooms', 1, '2023-11-02 18:48:00'),
(2, 94, 15, 39, 3, 'Its Ok', 1, '2023-11-02 19:44:29'),
(3, 95, 18, 37, 5, 'Its very fantastic Room', 1, '2023-11-02 19:59:41'),
(4, 98, 15, 40, 4, 'Its very Fantastic', 1, '2023-11-02 22:32:18'),
(5, 99, 18, 39, 5, 'nice', 1, '2023-11-13 15:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(15, 'Single Room', 250, 15000, 1, 2, 1, 'Separate sitting area\r\nSoundproofed\r\nAir conditioning\r\nKitchen\r\nLED TV\r\nHypo-allergenic bedding\r\nPillow menu\r\nPremium bedding', 1, 0),
(16, 'Deluxe Room', 280, 17748, 2, 3, 2, 'Soundproofed\r\nAir conditioning\r\nLED TV\r\nHypo-allergenic bedding\r\nPillow menu\r\nPremium bedding\r\nEgyptian cotton linens\r\nPillowtop bed', 1, 0),
(17, 'Luxuary Room', 600, 600, 3, 8, 6, 'It is Luxary Room', 1, 0),
(18, 'Super Deluxe Room', 680, 750, 2, 8, 4, 'Its nice bedroom very comportable', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(78, 18, 13),
(79, 18, 15),
(80, 18, 17),
(87, 17, 13),
(88, 17, 14),
(89, 17, 15),
(90, 17, 17),
(94, 16, 13),
(95, 16, 14),
(96, 16, 15),
(97, 16, 17),
(98, 15, 13),
(99, 15, 14),
(100, 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(84, 18, 8),
(85, 18, 9),
(86, 18, 10),
(87, 18, 16),
(98, 17, 8),
(99, 17, 9),
(100, 17, 10),
(101, 17, 16),
(105, 16, 8),
(106, 16, 9),
(107, 16, 10),
(108, 16, 16),
(109, 15, 8),
(110, 15, 10),
(111, 15, 16);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(14, 17, 'IMG_41217.png', 1),
(18, 17, 'IMG_54953.jpg', 0),
(20, 16, 'IMG_96004.jpg', 1),
(21, 16, 'IMG_89881.jpg', 0),
(22, 15, 'IMG_20826.jpg', 1),
(23, 16, 'IMG_27712.jpg', 0),
(24, 18, 'IMG_42637.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Sea Breaze Hotels', 'Located in Ampara, Sainthamaruthu,  Sea Breeze Guest Inn provides accommodation with free bikes,\n                 free private parking, a garden and a shared lounge. Featuring a concierge service, \n                 this property also welcomes guests', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(37, 'aasath king', 'aasathking35@gmail.com', 'saintha\r\nsd', '0754834050', 33250, '2023-10-31', 'IMG_99621.jpg', '$2y$10$a0ZIKHooBUApT5KeTP09z.38fmVbEULKzPYnc1k3Mpn5uAvHRk5mC', 1, NULL, NULL, 1, '2023-10-31 19:01:17'),
(39, 'TestMail', 'testmail6208@gmail.com', 'Kalmuani', '072', 3256, '2023-10-31', 'IMG_74892.jpg', '$2y$10$wwrfRqCnu4lcnCMWpQE8buajbRogLKi4hscKc1kEUnKJthJQuFXBS', 1, '061e72783074701a1ca1a73ccebfdcde', NULL, 1, '2023-10-31 19:27:25'),
(40, 'aasath kamil', 'aasathkamil99@gmail.com', '312/A, Aljalal Road, Sainthamaruthu-04', '0773400564', 33250, '1999-06-21', 'IMG_23928.jpg', '$2y$10$/Yk3ZYZc3Pyw13RtP/hxyeygyrXDQRKwJDh46zolyHYMV44BBLzTm', 1, 'a69e7166870def7268a9dce153145887', NULL, 1, '2023-11-02 20:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` varchar(450) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`, `datentime`) VALUES
(41, 'aasath kamil', 'aasathking35@gmail.com', 'Abc', 'hello', '2023-11-02', 1, '2023-11-05 11:09:00'),
(42, 'aasath kamil', 'aasathking35@gmail.com', 'hello', 'Its Good', '2023-11-02', 1, '2023-11-05 11:09:00'),
(43, 'aasath kamil', 'aasathking35@gmail.com', 'hello', 'Its Good', '2023-11-02', 1, '2023-11-05 11:09:00'),
(45, 'aasath kamil', 'aasathking35@gmail.com', 'Room Problem', 'Room is Not Visible problem it very inconistents', '2023-11-05', 1, '2023-11-05 11:15:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin-cred`
--
ALTER TABLE `admin-cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room id` (`room_id`),
  ADD KEY `facilities id` (`facilities_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin-cred`
--
ALTER TABLE `admin-cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
