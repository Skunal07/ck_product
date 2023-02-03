-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2023 at 09:52 AM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_title` varchar(50) NOT NULL,
  `product_description` text NOT NULL,
  `product_category_id` int NOT NULL,
  `product_image` varchar(80) NOT NULL,
  `product_tags` text NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0 is active , 1 is deactive',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `product_description`, `product_category_id`, `product_image`, `product_tags`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Jugular Printed Men Round Neck T-shirt', 'Good quality in this price, Full satisfied fabric qualiti also good', 1, 'fashion1.jpg', 'round neck ,skin color,full sleeves,good quality', '1', '2023-01-31 17:24:27', '2023-02-02 13:08:31'),
(2, 'Jugular Printed Men Round Neck T-shirt', 'Good quality in this price, Full satisfied fabric qualiti also good', 1, 'fashion1.jpg', 'round neck ,skin color,full sleeves,good quality', '0', '2023-01-31 17:24:31', '2023-01-31 17:25:06'),
(3, 'The Majesta Watch Band', 'Diamond Watch Accessory In 18Kt Rose Gold (7.94 gram) with Diamonds (0.5960 Ct)', 2, 'watch1.jpeg', 'Product Code081007-32589522,\r\nHeight23.0 mm,\r\nWidth23.38 mm,\r\nProduct Weight 8.06 gram.', '0', '2023-01-31 17:27:42', '2023-01-31 18:16:42'),
(6, 'Labbin casual sneakers shoes lightweight for Men', 'Labbin casual sneakers shoes lightweight for Men', 3, 'shoes1.jpg', 'white in color', '0', '2023-01-31 17:35:48', NULL),
(7, 'nothing', 'Splash, Water, and Dust Resistant 3 Rated IP68 (maximum depth of 6 meters up to 30 minutes) under IEC standard 60529.', 4, 'nothing.jpg', 'The big difference between the two iPhones is the improved camera capabilities in the iPhone 14, which include better (faster) low light photography and the Action Mode.', '0', '2023-01-31 17:37:26', '2023-02-02 13:11:18'),
(8, 'Iphone 14', 'Splash, Water, and Dust Resistant 3 Rated IP68 (maximum depth of 6 meters up to 30 minutes) under IEC standard 60529.', 4, 'phone1.jpg', '\r\nThe big difference between the two iPhones is the improved camera capabilities in the iPhone 14, which include better (faster) low light photography and the Action Mode.', '0', '2023-01-31 17:37:28', NULL),
(9, 'Hoodie', ' Best Trendy Hoodie: SKIMS Cozy Knit Unisex Hoodie', 1, 'a12.jpg', 'white color,pure cotton,beautiful', '0', '2023-02-02 07:16:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0 is active , 1 is deactive',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Fashions', '0', '2023-01-31 16:46:18', '2023-02-02 12:25:40'),
(2, 'watches', '1', '2023-01-31 16:46:18', '2023-02-03 03:49:43'),
(3, 'Shoes', '0', '2023-01-31 16:46:44', '2023-02-02 11:42:59'),
(4, 'Mobiles', '0', '2023-01-31 16:46:44', '2023-01-31 16:48:43'),
(5, 'Rings', '0', '2023-02-02 11:59:10', '2023-02-02 12:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comments` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`id`, `product_id`, `user_id`, `comments`, `created_date`, `modified_date`) VALUES
(8, 1, 3, 'nice', '2023-02-01 10:24:22', NULL),
(9, 1, 3, 'nice', '2023-02-01 10:28:44', NULL),
(11, 2, 3, 'omg', '2023-02-01 12:08:14', NULL),
(12, 8, 3, 'nice yarr', '2023-02-01 12:13:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_type` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0' COMMENT '0 is user,1 is admin',
  `status` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '1' COMMENT '1 is active,2is deactive',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_type`, `status`, `created_date`, `modified_date`, `token`) VALUES
(3, 'kunal02chd@gmail.com', '$2y$10$sv6NzbM3pIEO3Ae0bZrxqO2cwjsumtzH9beJiGASS2O3vflY6J5vG', '1', '1', '2023-02-01 06:14:00', '2023-02-02 04:09:11', ''),
(4, 'liza@gmail.com', '$2y$10$YZEPwLA.W2dc8xJg0Jqsp.wbgloAP7Bk525m1VdtvdAz9UQpxywia', '0', '1', '2023-02-01 07:12:31', '2023-02-02 10:45:02', NULL),
(6, 'rohit@gmail.com', '$2y$10$LDcQFGO8T7jOEKAzd3t5a.hPedJaM1VbWvuUU2xV1QKnyGxdrQQ0K', '0', '1', '2023-02-02 11:00:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contact` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profile_image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `first_name`, `last_name`, `contact`, `address`, `profile_image`, `created_date`, `modified_date`) VALUES
(3, 3, 'kunal', 'singh', '6230254103', 'chandigarh', 'luffy.jpg', '2023-02-01 06:14:00', '2023-02-01 11:44:57'),
(4, 4, 'lisa', 'ranga', '9417758852', 'chandigarh', 'a4.jpg', '2023-02-01 07:12:31', '2023-02-02 04:47:04'),
(6, 6, 'kunalrohit', 'sharma', '6230254410', 'Chandigarh', 'bc.jpg', '2023-02-02 11:00:46', '2023-02-02 12:39:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pd_ct_id` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userfk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `pd_ct_id` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `userfk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
