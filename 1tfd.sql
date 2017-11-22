-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 12:31 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfd`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cu_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Main course'),
(2, 'Appetizer');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cu_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cu_id`, `email`, `password`, `name`, `address`) VALUES
(1, 'a@a.com', '123', 'Antonio Jack', 'This is my new address23'),
(2, 'b@b.com', '123', 'John Doe', 'John Doe\'s address'),
(3, 'c@c.com', '123', 'Jane Doe', 'Jane Doe\'s address');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `food_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `out_stock` int(1) NOT NULL DEFAULT '0' COMMENT '0 = in stock, 1 = out of stock',
  `ingredients` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`food_id`, `category_id`, `name`, `price`, `image`, `out_stock`, `ingredients`) VALUES
(2, 1, 'Som Tam', 30.00, 'food-images/som-tam.jpg', 1, '2 cups shredded green papaya|1/2 cup shredded carrot|1/2 cup sting bean (cut into 1\" long)'),
(3, 2, 'Spicy Noodle Salad', 40.00, 'food-images/maxresdefault.jpg', 0, ''),
(4, 1, 'Thai Basil Chicken', 45.00, 'food-images/thai-chicken-basil-recipe.jpg', 0, ''),
(5, 1, 'Tom Yum Koong', 50.00, 'food-images/3161c4_b4d35f6bdc724266969c13020d477eac.jpg', 0, ''),
(7, 1, 'Porridge With Fish', 35.00, 'food-images/Image.jpg', 0, ''),
(8, 1, 'Thai Spicy Grilled Pork Salad', 50.00, 'food-images/19510377-Moo-Nam-Tok-Thai-Spicy-Grilled-Pork-Salad-signature-dish-in-thailand-Stock-Photo.jpg', 0, ''),
(9, 2, 'Special Fish Cakes', 55.00, 'food-images/Thaifishcakes.jpg', 0, ''),
(10, 1, 'Casseroled Shrimps With Glass Noodles', 50.00, 'food-images/maxresdefault (1).jpg', 0, ''),
(11, 1, 'Pork Stir-Fried With Garlic And Peppercorns', 40.00, 'food-images/thai-fried-pork-with-garlic-and-pepper-recipe.jpg', 0, ''),
(12, 2, 'Fried Chicken', 35.00, 'food-images/Crispy-Fried-Chicken_exps6445_PSG143429D03_05_5b_RMS.jpg', 0, ''),
(13, 1, 'Green Chicken Curry', 40.00, 'food-images/global-recipes-01_cropped-green_curry2.jpg', 0, ''),
(15, 2, 'Crispy Wonton', 30.00, 'food-images/crispy-pork-wontons.jpg', 0, ''),
(17, 1, 'Honey Rost Duck', 70.00, 'food-images/HoneyRoastedDuck.jpg', 0, ''),
(18, 1, 'Quick-Fried Water Spinach Seasoned With Chili And Soy Sauce', 45.00, 'food-images/maxresdefault (2).jpg', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cu_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `isDelivered` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = not delivered, 1 otherwise'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cu_id`, `food_id`, `orderDate`, `quantity`, `isDelivered`) VALUES
(1, 3, 2, '2017-01-22', 1, 0),
(2, 1, 2, '2017-01-22', 2, 1),
(3, 2, 2, '2017-02-22', 3, 0),
(4, 2, 2, '2017-03-22', 3, 0),
(5, 2, 2, '2017-03-22', 2, 0),
(6, 1, 2, '2017-04-22', 2, 0),
(7, 1, 2, '2017-04-22', 3, 0),
(8, 2, 2, '2017-04-22', 2, 0),
(9, 3, 2, '2017-04-22', 2, 0),
(10, 3, 2, '2017-04-22', 3, 0),
(11, 3, 3, '2017-05-22', 2, 0),
(12, 1, 3, '2017-05-22', 1, 0),
(13, 1, 3, '2017-05-22', 1, 0),
(14, 3, 3, '2017-06-22', 1, 0),
(15, 2, 3, '2017-07-22', 2, 0),
(16, 2, 4, '2017-07-22', 3, 0),
(17, 1, 4, '2017-07-22', 1, 0),
(18, 3, 4, '2017-08-22', 3, 0),
(19, 3, 4, '2017-08-22', 3, 0),
(20, 1, 4, '2017-08-22', 3, 0),
(21, 3, 4, '2017-09-22', 2, 0),
(22, 1, 4, '2017-09-22', 1, 0),
(23, 2, 4, '2017-09-22', 1, 0),
(24, 2, 4, '2017-09-22', 2, 0),
(25, 2, 4, '2017-09-22', 2, 0),
(26, 1, 2, '2017-10-22', 1, 0),
(27, 3, 3, '2017-10-22', 3, 0),
(28, 3, 4, '2017-10-22', 2, 0),
(29, 1, 5, '2017-10-22', 1, 0),
(30, 2, 7, '2017-10-22', 1, 0),
(31, 3, 15, '2017-10-25', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `cu_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `cu_id` (`cu_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cu_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `categoryID` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cu_id` (`cu_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `cu_id` (`cu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `foods` (`food_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cu_id`) REFERENCES `customer` (`cu_id`);

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `categoryID` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cu_id`) REFERENCES `customer` (`cu_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`food_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `cu_id` FOREIGN KEY (`cu_id`) REFERENCES `customer` (`cu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
