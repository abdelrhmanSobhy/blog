-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 03:36 AM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `image`, `user_id`, `created_at`) VALUES
(11, 'مائة سؤال عن الإسلام', 'كيف أعلن الأسلام حقوق الإنسان', 'img_68c9555f63cbb5.01828697.png', 5, '2025-09-16'),
(13, 'asdasd', '', 'img_68cb9684ac73c9.17963647.jpg', 5, '2025-09-18'),
(14, 'asdasdczxczxczxc', '', 'img_68cb96934c89f5.43920672.png', 5, '2025-09-18'),
(15, 'asdasdczxczxczxc', '', 'img_68cb9699e954b3.04610289.png', 5, '2025-09-18'),
(16, 'asdasdczxczxczxc', 'asdasdxzczxczxc', 'img_68cb96b0830d74.66883454.png', 5, '2025-09-18'),
(17, 'asdasdczxczxczxcxzczxczxczxc', 'asdasdxzczxczxc2weqweqwe', 'img_68cb96bb578907.05619652.png', 5, '2025-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'test user', 'test@user.com', '$2y$10$Etzw3W594D27kuNjGRkXruHxB8gA3f3IapbXRCvVrqXhbL8UIeC0q', '01025874685', '2025-09-08'),
(2, 'Abdou', 'abdousobhy@gmail.com', 'Ab@123456', '1099604109', '2025-09-13'),
(4, 'abdoi', 'kas@gamil.ocm', '$2y$10$CwQlMy02ryxJHpW6bkZdeuSm4mpvQ3HNDgKio2oKWv6bUSQ9QVR/W', '4556465', '2025-09-13'),
(5, 'name', 'name@gmail.com', '$2y$10$7cB6KMxOQSr3jd.3siqTnukFD3b62Mj6MwvG7rZfXiVg8s5kn3snW', '1231546', '2025-09-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_posts` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `users_posts` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
