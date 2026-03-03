-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 12:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `name`, `email`, `mobile`, `password`) VALUES
(1, 'Dilmina Prabhashwara', 'admin@gmail.com', '0779634423', 'admin'),
(3, 'aif', 'aifazmi@gmail.com', '0877656789', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `footage`
--

CREATE TABLE `footage` (
  `id` int(11) NOT NULL,
  `images` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `Customer_id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `Customer_id`, `name`, `email`, `address`, `mobile`, `password`) VALUES
(62, 'CUST5616', 'Dilmina', 'dilmina@gmail.com', 'gallee', '0779634423', '1234'),
(63, '', '', '', '', '', ''),
(64, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_details`
--

CREATE TABLE `menu_details` (
  `id` int(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_details`
--

INSERT INTO `menu_details` (`id`, `item_name`, `description`, `price`, `category`, `image`) VALUES
(8, 'dss', 'sasdasda', '1111', 'Sri Lankan', '????\\0JFIF\\0\\0`\\0`\\0\\0??\\0C\\0\n\n\n\r\r??\\0C		\r\r??\\0\\0?\\0?\\\"\\0??\\0\\0\\0\\0\\0\\0\\0\\0\\0\\0\\0	\n??\\0?\\0\\');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `order_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `item_name`, `item_image`, `quantity`, `order_date`) VALUES
(26, 'Cheese Burger', 'double-bacon-cheeseburger-recipe-6.jpg', '1', '0000-00-00 00:00:00.000000'),
(27, 'Black ginger coffee', 'Photo_HowToFlavorCoffee_Ginger-min-683x1024.jpg', '1', '0000-00-00 00:00:00.000000'),
(29, 'Sausage burger', '8db6dcfcd9767b1e6fcb6570b6935108.jpg', '2', '0000-00-00 00:00:00.000000'),
(30, 'Cheese Burger', 'double-bacon-cheeseburger-recipe-6.jpg', '1', '0000-00-00 00:00:00.000000'),
(31, 'Cheese Burger', 'double-bacon-cheeseburger-recipe-6.jpg', '1', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `category`, `type`, `quantity`, `image`) VALUES
(48, 'beef bun', 'A beef bun is a savory snack that typically features a soft, fluffy bun filled with seasoned ground beef. The filling can include a variety of ingredients such as onions, garlic, and spices to enhance the flavor.', '130', 'Sri Lankan', 'Food', '30', 'Chinese-Curry-Beef-Buns-24-b-scaled.jpg'),
(49, 'Cheese Burger', 'A cheese burger is a classic American sandwich consisting of a grilled or fried beef patty topped with a slice of melted cheese, typically served in a soft, toasted bun. It often includes additional toppings such as lettuce, tomato, pickles, onions, ketch', '120', 'Sri Lankan', 'Food', '40', 'double-bacon-cheeseburger-recipe-6.jpg'),
(50, 'Fishbun', 'fish bun is a delightful snack featuring a soft, pillowy bun filled with a savory fish mixture. The filling typically consists of cooked and flaked fish, onions, spices, and sometimes vegetables like carrots or potatoes.', '80', 'Sri Lankan', 'Food', '50', 'Fish-Bun.jpg'),
(51, 'Sausage burger', 'sausage burger is a hearty and flavorful sandwich that features a grilled or pan-fried sausage patty, typically made from ground pork, beef, or a combination of both, seasoned with various spices. The sausage patty is served in a soft, toasted bun and oft', '130', 'Sri Lankan', 'Food', '50', '8db6dcfcd9767b1e6fcb6570b6935108.jpg'),
(52, 'BBQ burger', 'BBQ burger is a mouthwatering sandwich that combines a juicy beef patty with smoky barbecue sauce for a rich, savory flavor. Served in a toasted bun, this burger often includes additional toppings like crispy bacon, cheddar cheese, fried onions, lettuce, ', '150', 'Sri Lankan', 'Food', '50', 'AMAZING-BBQ-Black-Bean-Burgers-10-wholesome-ingredients-BIG-flavor-so-satisfying-vegan-glutenfree-burger-plantbased-recipe-minimalistbaker-8.jpg'),
(53, 'Chicken pizza', 'Chicken pizza is a delicious and versatile dish featuring a crispy pizza crust topped with savory tomato sauce, melted cheese, and tender pieces of cooked chicken. The chicken can be seasoned in various ways, such as with BBQ sauce,', '150', 'Sri Lankan', 'Food', '50', 'barbecue-chicken-pizza-0917.jpg'),
(54, 'Latte', 'latte is a popular espresso-based coffee drink made with a shot of rich, aromatic espresso and steamed milk. It is typically topped with a thin layer of frothy milk foam. The balance between the strong coffee flavor and the creamy milk creates a smooth', '100', 'Sri Lankan', 'Coffee', '50', 'th (11).jfif'),
(55, 'cappuccino ', 'cappuccino is a classic coffee drink made with equal parts of espresso, steamed milk, and milk foam. The espresso provides a strong, rich coffee flavor, while the steamed milk adds creaminess and the frothy milk foam creates a light, airy texture on top.', '140', 'Sri Lankan', 'Coffee', '50', 'cappucino-fotoliastock.jpg'),
(56, 'Mocha Hot Cofee', 'mocha hot coffee is a delicious blend of rich espresso, creamy steamed milk, and chocolate syrup or cocoa powder. The combination of the bold coffee flavor with the sweet and smooth chocolate creates a delightful and indulgent beverage. ', '250', 'European', 'Coffee', '50', '768baa302c5195ddedfa35ff5ccb7fa0.jpg'),
(57, 'Black ginger coffee', 'Black ginger coffee is a distinctive and flavorful coffee drink that combines the robust taste of black coffee with the spicy, aromatic notes of ginger. Typically made with freshly brewed black coffee and infused with ginger either through ginger syrup, f', '200', 'Indian', 'Coffee', '50', 'Photo_HowToFlavorCoffee_Ginger-min-683x1024.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `table_id` varchar(255) NOT NULL,
  `reservation_date` varchar(255) NOT NULL,
  `reservation_time` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `customer_name`, `table_id`, `reservation_date`, `reservation_time`, `notes`) VALUES
(1, 'Dilmina', '3', '2024-07-19', '01:46', 'rr'),
(5, 'aif', '12', '2025-12-02', '13:02', 'keep it ');

-- --------------------------------------------------------

--
-- Table structure for table `staflogin`
--

CREATE TABLE `staflogin` (
  `id` int(200) NOT NULL,
  `Staff_id` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staflogin`
--

INSERT INTO `staflogin` (`id`, `Staff_id`, `name`, `email`, `address`, `mobile`, `password`) VALUES
(5, '669b8569c5fca', 'Gihan sasanka', 'giahan@gmail.com', 'imaduwa', '077145258', '123'),
(7, 'STAFF7451', 'Aif', 'aif@gmail.com', 'galle', '0740103112', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tablecount`
--

CREATE TABLE `tablecount` (
  `id` int(200) NOT NULL,
  `table_number` varchar(200) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `is_available` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablecount`
--

INSERT INTO `tablecount` (`id`, `table_number`, `capacity`, `is_available`) VALUES
(3, '7', '2', '1'),
(4, '8', '4', '1'),
(5, '12', '2', '0'),
(6, '9', '3', '0'),
(7, '1', '2', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_details`
--
ALTER TABLE `menu_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staflogin`
--
ALTER TABLE `staflogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tablecount`
--
ALTER TABLE `tablecount`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `menu_details`
--
ALTER TABLE `menu_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staflogin`
--
ALTER TABLE `staflogin`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tablecount`
--
ALTER TABLE `tablecount`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
