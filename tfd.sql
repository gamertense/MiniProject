-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2017 at 03:27 PM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cu_id`, `food_id`, `quantity`) VALUES
(4, 1, 5, 1);

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
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `com_id` int(11) NOT NULL,
  `com_name` varchar(50) NOT NULL,
  `com_comment` text NOT NULL,
  `food_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`com_id`, `com_name`, `com_comment`, `food_id`) VALUES
(1, 'Antonio Jack', 'testawerawer', 2),
(2, 'John Doe', 'test', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cu_id` int(11) NOT NULL,
  `usertype` varchar(10) NOT NULL DEFAULT 'user',
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `disable` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cu_id`, `usertype`, `email`, `password`, `name`, `address`, `disable`) VALUES
(1, 'customer', 'a@a.com', '123', 'Antonio Jack', 'This is my new address23', 0),
(2, 'customer', 'b@b.com', '123', 'John Doe', 'John Doe\'s address', 1),
(3, 'admin', 'c@c.com', '123', 'Jane Doe', 'Jane Doe\'s address', 0),
(4, 'customer', 'd@d.com', '123', 'NewCustomer', 'address2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `food_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT '1',
  `ingredients` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`food_id`, `category_id`, `name`, `price`, `discount`, `image`, `in_stock`, `ingredients`) VALUES
(2, 1, 'Som Tam', 30.00, 0, 'food-images/som-tam.jpg', 0, '2 cups shredded green papaya|5 cloves fresh garlic|10 green chilies|1/3 cup dried shrimps|1/2 cup tomato (wedged)|3 tablespoons lime juice|1 1/2 tablespoons palm sugar|2 tablespoons fish sauce|1/2 cup shredded carrot|1/2 cup sting bean (cut into 1'),
(3, 2, 'Spicy Noodle Salad', 40.00, 0, 'food-images/maxresdefault.jpg', 1, '1 (6.75 ounce) package thin rice noodles|1/4 cup Fresno chile peppers, cut into rings|1 teaspoon sesame oil|1/2 cup chopped peanuts|4 green onions, chopped|1/4 teaspoon salt|1 teaspoon brown sugar|3 tablespoons fish sauce|1/3 cup seasoned rice vinegar|3 cloves garlic, minced'),
(4, 1, 'Thai Basil Chicken', 45.00, 0, 'food-images/thai-chicken-basil-recipe.jpg', 1, '1 chicken breast|1 handful of Thai holy basil leaves|1/2 teaspoon sugar|1/2 teaspoon light soy sauce|1 teaspoon of oyster sauce|1 tablespoon oil for frying|4 â€“ 10 Thai chilies|5 cloves of garlic'),
(5, 1, 'Tom Yum Koong', 50.00, 10, 'food-images/3161c4_b4d35f6bdc724266969c13020d477eac.jpg', 1, '4 cups of water|2 tbsp. roasted chili paste (nam prik pao)|2 sprigs fresh cilantro|3/4 lb shrimps|12 fresh Thai chili peppers|3 fresh kaffir lime leave or 4 pc dried|3 slices fresh galangal root (smashed) or 2 pc dried|2 stalks fresh lemongrass'),
(7, 1, 'Porridge With Fish', 35.00, 0, 'food-images/Image.jpg', 1, '500 Grams Fish, cut into pieces||1 Teaspoon Preserved vegetable(seasoning)|1 Tablespoon Chicken stock|1 Stalk spring onion, chopped|2 Liters Water|10 Grams Ginger, skinned & julienned|2 Cups Cooked rice|Â½ Teaspoon Sesame oil|1 Tablespoon Light soy sauce'),
(8, 1, 'Thai Spicy Grilled Pork Salad', 50.00, 0, 'food-images/19510377-Moo-Nam-Tok-Thai-Spicy-Grilled-Pork-Salad-signature-dish-in-thailand-Stock-Photo.jpg', 1, '300 g. Pork Loin|1/2 Ladle of Chicken Stock|1/2 Tbsp. Ground Dried Chili |1/2 Tbsp. Sugar|1 Tbsp. Lime juice|Fried Chili|shallot|Long Coriander|Mint|Spring Onion'),
(9, 2, 'Special Fish Cakes', 55.00, 0, 'food-images/Thaifishcakes.jpg', 1, '300 g potatoes|1 tablespoon plain flour , plus extra for dusting|1 lemon|1 large free-range egg|a few sprigs of fresh flat-leaf parsley|100 g salmon fillet , skin on, scaled, pin-boned, from sustainable sources olive oil'),
(10, 1, 'Casseroled Shrimps With Glass Noodles', 50.00, 0, 'food-images/maxresdefault (1).jpg', 1, '1 kg large shrimp or 1 kg shrimp|2 1â„2 inches old ginger, peeled and smashed with cleaver|1 tablespoon canola oil|4 stalks cilantro (with roots intact)|3 cloves garlic, chopped|1 teaspoon white pepper|1 tablespoon fish sauce'),
(11, 1, 'Pork Stir-Fried With Garlic And Peppercorns', 40.00, 0, 'food-images/thai-fried-pork-with-garlic-and-pepper-recipe.jpg', 1, '300g pork strips|1 tbsp oyster sauce|1 tbsp soy sauce|1 tbsp sugar|1/4 teaspoon dried peppercorn|1 tbsp coriander stalks|3 cloves garlic'),
(12, 2, 'Fried Chicken', 35.00, 0, 'food-images/Crispy-Fried-Chicken_exps6445_PSG143429D03_05_5b_RMS.jpg', 1, '1 (4 pound) chicken, cut into pieces|2 quarts vegetable oil for frying|salt and pepper to taste|1 teaspoon paprika|2 cups all-purpose flour for coating|1 cup buttermilk'),
(13, 1, 'Green Chicken Curry', 40.00, 0, 'food-images/global-recipes-01_cropped-green_curry2.jpg', 1, '225g new potatoes , cut into chunks|50g boneless skinless chicken (breasts or thighs)|1 tsp caster sugar|2 tsp Thai fish sauce|400ml can coconut milk|1 garlic clove, chopped|1 tbsp vegetable or sunflower oil|100g green beans, trimmed and halved'),
(15, 2, 'Crispy Wonton', 30.00, 0, 'food-images/crispy-pork-wontons.jpg', 1, ''),
(17, 1, 'Honey Rost Duck', 70.00, 0, 'food-images/HoneyRoastedDuck.jpg', 1, '1.6kg duck|vegetable oil, for frying|300ml milk|6 garlic cloves|2 bunches watercress|4 tbsp honey|2 bay leaves|2 sprigs thyme'),
(18, 1, 'Quick-Fried Water Spinach Seasoned With Chili And Soy Sauce', 45.00, 0, 'food-images/maxresdefault (2).jpg', 1, '350g water spinach|1 tbsp oyster sauce |2-3 tbsp water|2 tsp sugar|1 tbsp fish sauce|1 tbsp yellow soybean paste|4-5 garlic cloves|2 tbsp oil');

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
(1, 3, 9, '2017-01-22', 3, 0),
(2, 2, 3, '2017-01-22', 1, 0),
(3, 3, 4, '2017-02-22', 3, 0),
(4, 2, 5, '2017-02-22', 1, 0),
(5, 3, 15, '2017-02-22', 3, 0),
(6, 1, 4, '2017-03-22', 1, 0),
(7, 2, 2, '2017-03-22', 1, 0),
(8, 2, 8, '2017-03-22', 1, 0),
(9, 2, 18, '2017-04-22', 3, 0),
(10, 1, 3, '2017-04-22', 2, 0),
(11, 1, 18, '2017-05-22', 2, 0),
(12, 1, 18, '2017-05-22', 3, 0),
(13, 1, 18, '2017-05-22', 2, 0),
(14, 1, 12, '2017-06-22', 2, 0),
(15, 1, 9, '2017-06-22', 3, 0),
(16, 3, 2, '2017-07-22', 3, 0),
(17, 2, 10, '2017-07-22', 2, 0),
(18, 2, 15, '2017-07-22', 3, 0),
(19, 2, 7, '2017-07-22', 1, 0),
(20, 2, 17, '2017-08-22', 1, 0),
(21, 3, 11, '2017-09-22', 1, 0),
(22, 3, 12, '2017-09-22', 1, 0),
(23, 3, 10, '2017-10-22', 3, 0),
(24, 1, 7, '2017-10-22', 2, 0),
(25, 3, 12, '2017-10-22', 2, 0),
(26, 3, 7, '2017-10-22', 2, 0);

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
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`com_id`);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
