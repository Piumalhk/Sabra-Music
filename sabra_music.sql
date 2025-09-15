-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2025 at 05:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sabra_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `purpose` text DEFAULT NULL,
  `pdf_attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `center_id`, `booking_date`, `start_time`, `end_time`, `status`, `purpose`, `pdf_attachment`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2025-10-10', '16:00:00', '19:00:00', 'rejected', 'Kodu yaththra2', 'bookings/Ww3I741HM6yeeix1DHzR6ktTmf27n5ZlXqPlDNRu.pdf', '2025-09-06 06:52:35', '2025-09-06 08:06:18'),
(2, 4, 3, '2025-09-22', '16:00:00', '20:00:00', 'approved', 'Survays night', 'bookings/rCrlWn0sy9bvZAvHCNfWSC9ZURUeu35EwYBF8VTw.pdf', '2025-09-06 08:55:36', '2025-09-08 15:21:20'),
(3, 4, 3, '2025-11-19', '18:00:00', '19:00:00', 'rejected', 'kali yugaya', 'bookings/BHM84A3pxVFFwi8J9lQexqN3W3zEayg0xJAyoETK.pdf', '2025-09-06 09:08:03', '2025-09-08 15:20:10'),
(4, 4, 5, '2025-11-30', '17:30:00', '20:30:00', 'approved', 'Focus night', 'bookings/kUBDAqkFuPCB6SJyINY9PJQ3TNqdR6oblMJi2Bz0.pdf', '2025-09-06 09:31:24', '2025-09-08 15:21:18'),
(5, 4, 3, '2025-12-10', '08:00:00', '13:00:00', 'rejected', 'Virtual Rival', 'bookings/9yUX2NmAPExZVczBoWrxuE4abhJgb5T6AkwE735h.pdf', '2025-09-07 11:52:58', '2025-09-08 15:20:06'),
(6, 4, 2, '2025-12-31', '13:30:00', '17:30:00', 'approved', 'Wassanaya', 'bookings/glhfH3AkM3sZdvOtjyh2E7uEFULSGr9mqKTvRIr3.pdf', '2025-09-07 12:34:40', '2025-09-08 15:21:14'),
(7, 4, 3, '2025-11-05', '14:00:00', '18:00:00', 'rejected', 'Nada gama', 'bookings/T7mWoeCEAm1VLQPbu27EkfilgNxe4niWCvgzArir.pdf', '2025-09-08 00:00:06', '2025-09-08 15:20:00'),
(8, 5, 2, '2025-10-10', '14:00:00', '18:00:00', 'approved', 'Adawwa', 'bookings/J2HvNT5AooDwPEqdNTZZabxYsgnPoB9rCElfgpJ5.pdf', '2025-09-08 12:13:32', '2025-09-08 15:21:02'),
(9, 5, 3, '2025-11-19', '15:30:00', '19:30:00', 'pending', 'Virtual Rival', 'bookings/62NmuN7UmeKXZN9jK9T5lp2HNyKmIbaUYYjLoIhi.pdf', '2025-09-10 14:30:28', '2025-09-10 14:45:37'),
(10, 5, 1, '2025-09-24', '06:44:00', '17:44:00', 'approved', 'event00789', 'bookings/16Hhs7lCMna9ZZUUsQ47hGGFhmCUcDis0tw8oU9u.pdf', '2025-09-10 14:44:46', '2025-09-10 15:06:11'),
(11, 4, 3, '2025-11-28', '14:40:00', '16:40:00', 'pending', 'Event1234', 'bookings/MWOmpCdIpPADq6U0LY9JZizU2Y6NUIhUzWx7i6un.pdf', '2025-09-11 00:38:41', '2025-09-11 00:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_per_hour` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `name`, `location`, `description`, `price_per_hour`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Art Center', 'Main Campus', 'A versatile space for art exhibitions and performances.', 50.00, NULL, 1, '2025-09-05 21:54:25', '2025-09-06 09:03:56'),
(2, 'Matta', 'East Wing', 'Traditional performance space with excellent acoustics.', 75.00, NULL, 1, '2025-09-05 21:54:25', '2025-09-06 09:03:56'),
(3, 'Pnibharatha Open Air Theater', 'North Campus', 'Outdoor theater for performances under the stars.', 100.00, NULL, 1, '2025-09-05 21:54:25', '2025-09-06 09:03:56'),
(5, 'Prof J.W. Dyananda Somasundara Auditorium', 'Faculty of Arts', 'Modern auditorium with state-of-the-art audio-visual facilities.', 150.00, NULL, 1, '2025-09-06 08:50:57', '2025-09-06 09:03:56'),
(6, 'Other', 'Various', 'Other campus venues available upon request.', 30.00, NULL, 1, '2025-09-06 08:50:57', '2025-09-06 09:03:56'),
(7, 'Prof J.W. Dyananda Somasundara Auditorium', 'Faculty of Arts', 'Modern auditorium with state-of-the-art audio-visual facilities.', 150.00, NULL, 1, '2025-09-06 08:50:57', '2025-09-06 08:50:57'),
(8, 'Other', 'Various', 'Other campus venues available upon request.', 30.00, NULL, 1, '2025-09-06 08:50:57', '2025-09-06 08:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `event_time`, `location`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Event001', 'hhhhhhhh', '2025-09-07', '17:00:00', 'Main gate', NULL, 'events/1757565533_evebt1.jpg', 'published', '2025-09-08 01:10:14', '2025-09-10 23:08:53'),
(10, 'Focus night', 'hiiiiiiiiiiiiii', '2022-06-09', '20:30:00', 'matta', NULL, 'events/1757565600_event3.jpg', 'published', '2025-09-08 01:29:06', '2025-09-10 23:10:00'),
(12, 'Event002', 'ggggggggggggggg', '2025-01-10', '04:50:00', 'Ground', NULL, 'events/1757565573_event2.jpg', 'published', '2025-09-08 01:48:09', '2025-09-10 23:09:33'),
(13, 'kkkkkkkkkkk', 'hhgfder', '2025-10-08', '03:33:00', 'Main gate', NULL, 'events/1757565428_event2.jpg', 'published', '2025-09-08 12:30:43', '2025-09-10 23:07:08'),
(14, 'Event003', 'kkkkkhytrdf', '2023-07-12', '02:34:00', 'Ground', NULL, 'events/1757354575_T@Ttrader.jpg', 'published', '2025-09-08 12:32:55', '2025-09-10 14:28:46'),
(15, 'gghhhh', 'hyyy', '2025-09-23', '16:37:00', 'Panibrabatha', NULL, 'events/1757565438_event3.jpg', 'published', '2025-09-09 13:37:55', '2025-09-10 23:07:18'),
(16, 'Event05', 'enjoy with friend', '2025-11-25', '16:30:00', 'Ground', NULL, 'events/1757565419_evebt1.jpg', 'published', '2025-09-10 14:26:46', '2025-09-10 23:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_06_025610_add_index_no_and_role_to_users_table', 1),
(6, '2025_09_06_030638_create_centers_table', 1),
(7, '2025_09_06_030656_create_bookings_table', 1),
(8, '2025_09_06_030711_create_events_table', 1),
(9, '2025_09_08_000000_add_is_active_to_users_table', 2),
(10, '2025_09_07_192649_create_events_table_if_not_exists', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `index_no` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `index_no`, `role`, `is_active`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$10$4W4iBtFZjS.UVhPR0l5U3.iMI0NHQKQbJNKt4NFGMMlnPB8rn8nKe', NULL, '2025-09-05 21:54:25', '2025-09-05 21:54:25', 'ADMIN001', 'admin', 1),
(2, 'Regular User', 'user@example.com', NULL, '$2y$10$Tumx.ZQ3zHmUcRbGCXVXM.yGki2PorF.x0DN81Ie3Ism3EJXsYihK', NULL, '2025-09-05 21:54:25', '2025-09-05 21:54:25', 'USER001', 'user', 1),
(3, 'yasith', 'yasith@gmail.com', NULL, '$2y$10$r3hD5lzBIctLHc/YGNbxjOVJmu0yxYSS5t6.QLCWqYjFMGW8hSkH2', NULL, '2025-09-05 23:40:20', '2025-09-05 23:40:20', '21CIS0069', 'user', 1),
(4, 'hasini', 'hasini@gmail.com', NULL, '$2y$10$oPdHi2ud8xCEDKbZTqUD8eQKC3jrOu3RPoZdIYEaExN0nNLx9DzLK', NULL, '2025-09-06 06:31:08', '2025-09-07 13:20:37', '21CIS1234', 'user', 0),
(5, 'ashini', 'ashini@gmail.com', NULL, '$2y$10$a4NGKXRoUdbM6Arq4oLREef0mrVFQRDvMKtqJDC/X18EsK0hlst/y', NULL, '2025-09-08 12:07:13', '2025-09-08 15:40:44', '21CIS5678', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_center_id_foreign` (`center_id`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_index_no_unique` (`index_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
