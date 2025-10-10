-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 04:41 AM
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
-- Database: `bakery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Cakes'),
(4, 'Cupcakes'),
(6, 'Jar Cakes'),
(8, 'Brownies');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_path`, `uploaded_at`) VALUES
(1, 'assets/images/photo_3_2025-02-16_21-38-23.jpg', '2025-04-12 16:15:45'),
(2, 'assets/images/photo_2_2025-02-16_21-38-37.jpg', '2025-04-12 16:15:57'),
(3, 'assets/images/photo_10_2025-02-16_21-38-23.jpg', '2025-04-12 16:16:06'),
(4, 'assets/images/photo_20_2025-02-16_21-38-23.jpg', '2025-04-12 16:16:17'),
(5, 'assets/images/photo_14_2025-02-16_21-38-23.jpg', '2025-04-12 16:16:29'),
(6, 'assets/images/photo_22_2025-02-16_21-38-23.jpg', '2025-04-12 16:16:43'),
(7, 'assets/images/photo_31_2025-02-16_21-38-23.jpg', '2025-04-12 16:16:52'),
(8, 'assets/images/photo_36_2025-02-16_21-37-42.jpg', '2025-04-12 16:17:05'),
(9, 'assets/images/photo_29_2025-02-16_21-38-23.jpg', '2025-04-12 16:17:18'),
(10, 'assets/images/photo_51_2025-02-16_21-37-07.jpg', '2025-04-12 16:17:28'),
(11, 'assets/images/photo_42_2025-02-16_21-37-07.jpg', '2025-04-12 16:17:35'),
(12, 'assets/images/photo_48_2025-02-16_21-38-23.jpg', '2025-04-12 16:17:54'),
(13, 'assets/images/photo_93_2025-02-16_21-37-42.jpg', '2025-04-12 16:18:01'),
(14, 'assets/images/photo_82_2025-02-16_21-37-42.jpg', '2025-04-12 16:18:09'),
(15, 'assets/images/photo_76_2025-02-16_21-38-23.jpg', '2025-04-12 16:18:25'),
(16, 'assets/images/photo_46_2025-02-16_21-38-23.jpg', '2025-04-12 16:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_notifications`
--

CREATE TABLE `order_notifications` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_notifications`
--

INSERT INTO `order_notifications` (`id`, `customer_name`, `customer_address`, `message`, `created_at`) VALUES
(1, 'vijay', 'Maninagar', 'Chocolate Cupcakes (6 pieces) (x3), Rainbow Cupcakes (6 pieces) (x1), Blueberry cupcakes (6 pieces) (x1)', '2025-04-11 16:05:31'),
(2, 'your father', 'skybell', 'Biscoff cake (x1), Rainbow Cupcakes (6 pieces) (x3)', '2025-04-12 13:04:50'),
(3, 'ddk', 'skybell', 'Pineapple Cake(500 gm) (x1), Biscoff cake (x2), Strawberry Cake(500 gm) (x1), Rainbow Cupcakes (6 pieces) (x1), Photo cake (500 gm) (x1), Blueberry cupcakes (6 pieces) (x1), Chocolate Cupcakes (6 pieces) (x2)', '2025-04-13 06:35:14'),
(4, 'monika darji', 'abc, xyz, pqr.', 'Chocolate Cupcakes (6 pieces) (x1)', '2025-04-14 08:13:17'),
(5, 'Harsh Gajjar', 'vastral ahmedabad', 'Photo cake (500 gm) (x1)', '2025-04-16 11:35:43'),
(6, 'Monika', 'Vadaj', 'Photo cake (500 gm) (x2), Rainbow Cupcakes (6 pieces) (x1)', '2025-04-26 06:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT 'cake.jpg',
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `created_at`) VALUES
(1, 'Chocolate Cake (500 gm)', 'Delicious chocolate cake filled with best quality compound and fresh baked. Mouth melting chocolate cake make you feel happy at each bite.', 500.00, '1744462273_photo_3_2025-02-16_21-38-37.jpg', 2, '2025-04-11 05:57:00'),
(2, 'Pineapple Cake(500 gm)', '\"Delight in the tropical sweetness of our freshly baked pineapple cake.Soft, moist layers are infused with real pineapple chunks and creamy frosting.Perfect for birthdays, celebrations, or simply satisfying your sweet cravings!\"', 450.00, '1744462263_photo_22_2025-02-16_21-38-37.jpg', 2, '2025-04-11 08:29:05'),
(3, 'Blueberry Cake (500 gm)', 'Bursting with juicy blueberries, this cake offers a perfect balance of sweet and tangy flavors.Topped with luscious cream, it\'s a dreamy treat for berry lovers', 550.00, '1744462245_photo_19_2025-02-16_21-38-23.jpg', 2, '2025-04-11 08:31:26'),
(4, 'Strawberry Cake(500 gm)', 'Layered with soft sponge and real strawberry compote, each bite is refreshingly sweet.Finished with creamy frosting and fresh strawberries for a delightful treat.', 500.00, '1744462228_photo_9_2025-02-16_21-35-21.jpg', 2, '2025-04-11 08:32:47'),
(5, 'Photo cake (500 gm)', 'Celebrate your special moments with a personalized photo cake that tells your story.Soft, creamy layers topped with your favorite picture as memorable as it is delicious.', 600.00, '1744462213_photo_31_2025-02-16_21-37-07.jpg', 2, '2025-04-11 08:34:07'),
(6, 'Blueberry cupcakes (6 pieces)', 'Delightfully moist cupcakes bursting with real blueberry flavor.Topped with creamy frosting for a perfect bite-sized treat', 600.00, '1744462195_photo_85_2025-02-16_21-37-07.jpg', 4, '2025-04-11 08:36:29'),
(7, 'Chocolate Cupcakes (6 pieces)', 'Rich and fluffy chocolate cupcakes baked to perfection.Finished with smooth, decadent chocolate frosting', 580.00, '1744462166_photo_3_2025-02-16_21-40-21.jpg', 4, '2025-04-11 08:37:56'),
(8, 'Rainbow Cupcakes (6 pieces)', 'Colorful layers of fluffy cupcake in every bite.Topped with creamy frosting and a burst of fun', 700.00, '1744462152_photo_31_2025-02-16_21-37-42.jpg', 4, '2025-04-11 08:38:51'),
(9, 'Biscoff cake', 'lorem', 60.00, '1744462101_photo_13_2025-02-16_21-38-23.jpg', 2, '2025-04-12 12:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` text NOT NULL,
  `address` text NOT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `address`, `role`, `created_at`) VALUES
(1, 'Harsh Gajjar', 'harsh@87', 'admin@gmail.com', '65418797', '8866319009', 'vastral', 'admin', '2025-04-11 05:49:15'),
(2, 'Yash Kesur', 'yash@23', 'user@gmail.com', '65418797', '8526987451', 'odhav', 'user', '2025-04-11 06:08:17'),
(3, 'vijay patel', 'vijay@123', 'eshaagurjar@gmail.com', 'vijay$123', '4569874521', 'Maninagar', NULL, '2025-04-11 13:59:59'),
(4, 'Yash Kesur', 'yash11', '221260107031setice@gmail.com', '123456789', '9913408127', 'okokok', 'user', '2025-04-12 13:03:33'),
(5, 'Darshak', 'darshak@65', 'darshak345@gmail.com', '748596', '5478415692', 'Iskon', 'user', '2025-04-12 16:50:31'),
(6, 'ddd', 'Dkk', '11@mail.com', '65418797', '233', 'kkmal', 'admin', '2025-04-13 06:31:20'),
(7, 'monika darji', 'monika123', 'monika@gmail.com', '123456', '1234567890', 'abc, xyz, pqr.', 'user', '2025-04-14 08:12:12'),
(8, 'Haard ', 'haard@7', 'haard@gmail.com', 'haard', '4152639875', 'fghgdfsdgxdfbgh', 'user', '2025-04-16 11:34:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_notifications`
--
ALTER TABLE `order_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_notifications`
--
ALTER TABLE `order_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
