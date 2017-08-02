-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2017 at 05:40 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruitfarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `icon` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `icon`) VALUES
(1, 'Berries', 'berries'),
(2, 'Citrus', 'citrus'),
(3, 'Drupes', 'drupes'),
(4, 'Melons', 'melons'),
(5, 'Pome', 'pome'),
(6, 'Tropical', 'tropical');

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE IF NOT EXISTS `command` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `statut` varchar(1000) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`id`, `id_produit`, `quantity`, `dat`, `statut`, `id_user`) VALUES
(1, 17, 2, '2017-06-10 10:14:13', 'paid', 2),
(2, 8, 5, '2017-06-10 10:14:13', 'paid', 2),
(3, 17, 8, '2017-07-03 07:21:24', 'paid', 1),
(9, 7, 12, '2017-07-03 09:26:04', 'paid', 3),
(10, 6, 12, '2017-07-03 09:33:26', 'paid', 3),
(13, 11, 4, '2017-07-03 11:15:59', 'paid', 4),
(14, 12, 4, '2017-07-09 21:42:30', 'done', 4),
(15, 6, 5, '2017-07-03 13:15:17', 'paid', 3),
(18, 17, 5, '2017-07-09 21:24:54', 'paid', 3),
(19, 18, 6, '2017-07-09 21:28:36', 'paid', 3),
(20, 18, 6, '2017-07-09 21:28:36', 'paid', 3),
(21, 13, 10, '2017-07-09 21:30:04', 'paid', 3),
(22, 10, 14, '2017-07-09 21:32:47', 'paid', 3),
(23, 6, 2, '2017-07-09 21:35:48', 'paid', 3),
(24, 18, 2, '2017-07-09 21:37:20', 'paid', 3),
(25, 16, 11, '2017-07-09 21:37:20', 'paid', 3),
(26, 2, 10, '2017-07-11 14:28:25', 'ordered', 1);

-- --------------------------------------------------------

--
-- Table structure for table `details_command`
--

CREATE TABLE IF NOT EXISTS `details_command` (
  `id` int(11) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `id_command` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `user` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `statut` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details_command`
--

INSERT INTO `details_command` (`id`, `product`, `quantity`, `price`, `id_command`, `id_user`, `user`, `address`, `phone`, `city`, `statut`) VALUES
(1, 'Lemon', 2, 80, 1, 2, 'Normal User', '123 Home Town', '0767646462', 'Nairobi', 'done'),
(2, 'Banana', 5, 125, 2, 2, 'Normal User', '123 Home Town', '079844353', 'Nairobi', 'done'),
(3, 'Lemon', 8, 320, 3, 1, 'Super User', '123 Home Town', '075763556', 'Nairobi', 'done'),
(4, 'Pineapple', 7, 490, 8, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(5, 'Guava', 12, 360, 9, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(6, 'apple', 12, 480, 10, 3, 'Dennis Mwarw', '43 returu', '0708533383', 'Deutna', 'done'),
(7, 'Pumpkin', 2, 160, 11, 3, 'Dennis Mwarw', '43 returu', '0712983630', 'Deutna', 'done'),
(8, 'Lemon', 1, 40, 12, 3, 'Dennis Mwarw', '43 returu', '0712983630', 'Deutna', 'done'),
(9, 'Blueberry', 4, 120, 13, 4, 'Sally Rehema', 'guja road', '077764542', 'Kauir', 'done'),
(10, 'Grapes', 4, 120, 14, 4, 'Sally Rehema', 'guja road', '077764542', 'Kauir', 'done'),
(11, 'apple', 5, 200, 15, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(12, 'Lemon', 5, 200, 18, 3, 'Malet Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(13, 'Lime', 6, 270, 19, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(14, 'Lime', 6, 270, 20, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(15, 'Tomato', 10, 400, 21, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(16, 'Coconut', 14, 700, 22, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(17, 'apple', 2, 80, 23, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(18, 'Lime', 2, 90, 24, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(19, 'Raspberry', 11, 440, 25, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(20, 'Citrus', 5, 200, 26, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done'),
(21, 'Citrus', 5, 200, 26, 3, 'Dennis Mwarw', '43 returu', '0703604942', 'Deutna', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `date_ordered` varchar(20) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `buyer_id`, `buyer_name`, `date_ordered`, `total_price`, `status`, `address`, `phone`, `city`) VALUES
(1, 3, 'Dennis Mwarw', 'July, 15 2017', '200', 'delivered', '43 returu', '0703604942', 'Duey'),
(3, 3, 'Dennis Mwarw', 'July, 15 2017', '80', 'delivered', '43 returu', '0703604942', 'Duey'),
(4, 3, 'Dennis Mwarw', 'July 17, 2017', '80', 'paid', '43 returu', '0703604942', 'Kisii'),
(5, 3, 'Dennis Mwarw', 'July 17, 2017', '100', 'paid', '43 returu', '0703604942', 'Deutna'),
(6, 5, 'Levis Kamau', 'July 17, 2017', '125', 'paid', '3 Zambia Avenue, Kenyatta University', '07089988', 'Nairobi'),
(7, 6, 'Ben Mwau', 'July 17, 2017', '160', 'paid', '43 Nyuki Road', '078394622', 'Ayydao'),
(8, 6, 'Ben Mwau', 'July 17, 2017', '240', 'paid', '43 Nyuki Road', '078394622', 'Ayydao');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(61) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `item_id`, `item_name`, `price`, `quantity`, `status`) VALUES
(1, 1, 6, 'apple', 40, 1, 1),
(2, 1, 14, 'Papaya', 90, 1, 1),
(3, 1, 9, 'Pineapple', 70, 2, 1),
(4, 3, 14, 'Papaya', 90, 3, 1),
(5, 3, 17, 'Lemon', 40, 2, 1),
(6, 4, 17, 'Lemon', 40, 2, 1),
(7, 5, 10, 'Coconut', 50, 2, 1),
(8, 6, 8, 'Banana', 25, 5, 1),
(9, 7, 6, 'apple', 40, 4, 1),
(10, 8, 17, 'Lemon', 40, 6, 1),
(11, 9, 2, 'Citrus', 40, 5, 1),
(12, 9, 5, 'Watermelon', 70, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `picture`, `id_produit`) VALUES
(1, 'straw berry1.jpg', 1),
(2, 'straw berry2.jpg', 1),
(3, 'straw berry2.jpg', 1),
(4, 'citrus1.jpg', 2),
(5, 'citrus2.jpg', 2),
(6, 'citrus3.jpg', 2),
(7, 'oranges3.jpg', 3),
(8, 'oranges1.jpg', 3),
(9, 'oranges2.jpg', 3),
(10, 'plum1.png', 4),
(11, 'plum2.png', 4),
(12, 'plum3.png', 4),
(13, 'melon2.jpg', 5),
(14, 'melon.jpg', 5),
(15, '', 5),
(16, 'apple1.jpg', 6),
(17, 'apple2.jpg', 6),
(18, '', 6),
(19, 'guava1.jpg', 7),
(20, 'guava2.jpg', 7),
(21, '', 7),
(22, 'banana2.jpg', 8),
(23, 'banana3.jpg', 8),
(24, '', 8),
(25, 'pineapple.jpg', 9),
(26, '', 9),
(27, '', 9),
(28, 'coconut2.jpg', 10),
(29, 'coconut3.jpg', 10),
(30, 'coconut1.jpg', 10),
(31, 'blue berry3.jpg', 11),
(32, 'blue berry1.jpg', 11),
(33, '', 11),
(34, 'grapes2.jpg', 12),
(35, 'grapes1.jpg', 12),
(36, '', 12),
(37, 'tomatoes1.jpg', 13),
(38, 'tomatoes2.jpg', 13),
(39, 'tomatoes3.jpg', 13),
(40, 'papaya1.jpg', 14),
(41, 'papaya2.jpg', 14),
(42, '', 14),
(43, 'pumpkin2.jpg', 15),
(44, 'pumkin1.jpg', 15),
(45, 'pumkin2.jpg', 15),
(46, 'raspbery1.jpg', 16),
(47, 'raspbery2.jpg', 16),
(48, '', 16),
(49, 'lemon3.jpg', 17),
(50, 'lemon.jpg', 17),
(51, 'lemon1.jpg', 17),
(52, 'limes2.jpg', 18),
(53, 'limes.jpg', 18),
(54, '', 18),
(55, '', 19),
(56, '', 19),
(57, '', 19);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` int(11) NOT NULL,
  `id_picture` int(11) NOT NULL,
  `thumbnail` varchar(1000) NOT NULL,
  `promo` varchar(1000) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '50'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `id_category`, `name`, `description`, `price`, `id_picture`, `thumbnail`, `promo`, `quantity`) VALUES
(1, 1, 'Strawberry', 'A great fruit from Tomasa in Ghana. Highly nutritious and very delicious. In stock today.', 50, 1, 'straw berry.jpg', '', 39),
(2, 2, 'Citrus', 'A great fruit from Tomasa in Ghana. Highly nutritious and very delicious. In stock today.', 40, 2, 'citrus3.jpg', '', 10),
(3, 2, 'Orange', 'A great fruit from Tomasa in Ghana. Highly nutritious and very delicious. In stock today.', 35, 3, 'oranges4.jpg', '', 50),
(4, 3, 'Plum', 'The best fruit from all over Africa. Great in n vitamins and amino acids.', 20, 4, 'plum.png', '', 50),
(5, 4, 'Watermelon', 'A great fruit with numerous benefits to the human body', 70, 5, 'melon1.jpg', '', 49),
(6, 5, 'apple', 'A great real fruit known all over the world. Useful for making everyone healthy and strong with vitamin A, B and C.', 40, 6, 'apple2.png', '', 38),
(7, 6, 'Guava', 'The best local fruits we have available. Full of many nutrients and vitamins to keep you healthy.', 30, 7, 'guava.jpg', '', 50),
(8, 6, 'Banana', 'Very much locally available and full of health benefits for the user. A good choice for healthy living,', 25, 8, 'banana1.jpg', '', 45),
(9, 6, 'Pineapple', 'Very much locally available and full of health benefits for the user. A good choice for healthy living,', 70, 9, 'pineapple1.jpg', '', 29),
(10, 6, 'Coconut', 'Very much locally available and full of health benefits for the user. A good choice for healthy living,', 50, 10, 'coconut.jpg', '', 48),
(11, 1, 'Blueberry', 'Highly nutritious and very delicious. Very healthy choice for better living.', 30, 11, 'blue berry2.jpg', '', 50),
(12, 1, 'Grapes', 'Highly nutritious and very delicious. Very healthy choice for better living.', 30, 12, 'grapes.jpg', '', 50),
(13, 1, 'Tomato', 'Highly nutritious and very delicious. Very healthy choice for better living.', 40, 13, 'tomatoes.jpg', '', 50),
(14, 4, 'Papaya', 'Highly nutritious and very delicious. Very healthy choice for better living.', 90, 14, 'papaya.jpg', '', 32),
(15, 4, 'Pumpkin', 'Highly nutritious and very delicious. Very healthy choice for better living.', 80, 15, 'pumkin.jpg', '', 50),
(16, 1, 'Raspberry', 'Highly nutritious and very delicious. Very healthy choice for better living.', 40, 16, 'raspbery.jpg', '', 39),
(17, 2, 'Lemon', 'Highly nutritious and very delicious. Very healthy choice for better living.', 40, 17, 'lemon2.jpg', '', 24),
(18, 2, 'Lime', 'Highly nutritious and very delicious. Very healthy choice for better living.', 45, 18, 'limes1.jpg', '', 48);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(1000) NOT NULL,
  `lastname` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `phone` varchar(1000) NOT NULL,
  `role` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `address`, `city`, `phone`, `role`) VALUES
(1, 'admin', 'Super', 'User', '21232f297a57a5a743894a0e4a801fc3', '123 Home Town', 'Nairobi', '070863538', 'admin'),
(2, 'user@ymail.com', 'Normal', 'User', 'f3b32717d5322d7ba7c505c230785468', '123 Home Town', 'Nairobi', '0798045354', 'client'),
(3, 'ngugieinstein@gmail.com', 'Dennis', 'Mwarw', '827ccb0eea8a706c4c34a16891f84e7b', '43 returu', 'Deutna', '0703604942', 'client'),
(4, 'sally@yahoo.com', 'Sally', 'Rehema', '827ccb0eea8a706c4c34a16891f84e7b', 'guja road', 'Kauir', '0722124515', 'client'),
(5, 'levycenjehia@gmail.com', 'Levis', 'Kamau', '827ccb0eea8a706c4c34a16891f84e7b', '3 Zambia Avenue, Kenyatta University', 'Nairobi', '07089988', 'client'),
(6, 'benerd@briglobe.com', 'Ben', 'Mwau', '827ccb0eea8a706c4c34a16891f84e7b', '43 Nyuki Road', 'Ayydao', '078394622', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details_command`
--
ALTER TABLE `details_command`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `details_command`
--
ALTER TABLE `details_command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
