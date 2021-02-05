-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 07:07 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `a_id` int(5) NOT NULL,
  `c_id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `line_1` varchar(150) NOT NULL,
  `line_2` varchar(150) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `zip_code` int(9) NOT NULL,
  `landmark` varchar(150) DEFAULT NULL,
  `delivery_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`a_id`, `c_id`, `name`, `phone`, `line_1`, `line_2`, `city`, `zip_code`, `landmark`, `delivery_type`) VALUES
(10, 8, 'Rajat Bhardwaj', '9999999999', '123A', 'Vastu Nagar', 'Jaipur', 302020, 'Mansarovar', 1),
(18, 10, 'Vaidehi Kalra', '9999999999', 'Chambal Machinery', NULL, 'Shamgarh', 302020, 'Main Road', 1),
(19, 8, 'Rajat Bhardwaj', '9772709020', 'Shop No. 10', NULL, 'Mumbai', 500050, NULL, 2),
(20, 8, 'Devesh Bhardwaj', '9024074340', '123A, Vastu Nagar', 'Ganatpura, Mansarovar', 'Jaipur', 302020, 'near Vinayak Vihar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(5) NOT NULL,
  `c_name` varchar(40) NOT NULL,
  `c_phone` varchar(15) NOT NULL,
  `c_email` varchar(90) NOT NULL,
  `password` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_phone`, `c_email`, `password`) VALUES
(8, 'Rajat Bhardwaj', '9772709020', 'brajat9090@gmail.com', '16a732e32d83a82613e3ef1959dd3df7'),
(10, 'Vaidehi', '9772709020', 'kalravaidehi@gmail.com', '16a732e32d83a82613e3ef1959dd3df7'),
(11, 'Ravneet SIngh', '7225829631', 'ravneetpunj@gmail.com', '78ec43228e84527249df493b40593596');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(5) NOT NULL,
  `c_id` int(5) NOT NULL,
  `a_id` int(5) NOT NULL,
  `o_datetime` datetime NOT NULL,
  `o_type` varchar(20) NOT NULL,
  `o_status` varchar(20) NOT NULL,
  `deliver_datetime` datetime DEFAULT NULL,
  `total_amt` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `c_id`, `a_id`, `o_datetime`, `o_type`, `o_status`, `deliver_datetime`, `total_amt`) VALUES
(11, 8, 10, '2020-05-03 09:13:23', 'Deliver', 'Dispatched Item', NULL, 160),
(12, 8, 10, '2020-05-03 10:42:17', 'Deliver', 'Dispatched Item', NULL, 3800),
(13, 8, 10, '2020-10-07 11:23:03', 'Deliver', 'Dispatched Item', NULL, 470),
(14, 8, 10, '2020-10-07 12:13:25', 'Deliver', 'Packed', NULL, 210);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `oi_id` int(5) NOT NULL,
  `o_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`oi_id`, `o_id`, `p_id`, `quantity`) VALUES
(15, 11, 13, 1),
(16, 11, 26, 1),
(17, 12, 4, 2),
(18, 13, 15, 3),
(19, 13, 16, 1),
(20, 14, 16, 1),
(21, 14, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(5) NOT NULL,
  `p_cat` int(5) NOT NULL,
  `p_name` varchar(150) NOT NULL,
  `p_image` varchar(50) DEFAULT NULL,
  `p_price` float NOT NULL,
  `p_description` varchar(10000) DEFAULT NULL,
  `p_quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_cat`, `p_name`, `p_image`, `p_price`, `p_description`, `p_quantity`) VALUES
(2, 5, 'Basmati rice (2 KG)', '3.png', 70, 'High quality rice.', 0),
(3, 2, 'Pepsi soft drink (2 Ltr) test', '2.png', 70, 'Pepsi is a soft drink which refresses nnl', 0),
(4, 4, 'Royal Canin', '4.png', 1900, 'Royal Canin is a dog food which keeps your dog healthyhgjhb gvjbh m', 0),
(5, 8, 'Manchurian', '6.png', 25, 'Manchurian', 0),
(7, 5, 'Fortune Oil (5 ltr)', '1.png', 350, 'Fortune Oil is used in vegetables.', 5),
(13, 3, 'Lahsun Sev', '7.png', 90, 'Homemade namkeen by our own brand.', 2),
(14, 3, 'Britannia Toast', '8.png', 85, 'High quality crispy britannia brand toast.', 10),
(15, 2, 'Tropica orange juice', '13.png', 130, 'Tropica brandh orange juice', 0),
(16, 2, 'Coca Cola can cold drink', '15.png', 40, 'Coca cola cold drink.', 0),
(17, 3, 'Vim liquid', '17.png', 190, 'Vim liquid for utensils with power of lemon', 0),
(18, 3, 'Vim bar soap', '18.png', 70, 'Vim bar soap for utensils with scrub.', 3),
(19, 3, 'Odonil Room freshner', '19.png', 125, 'Odonil Room freshner perfect for room and washroom', 10),
(20, 4, 'Pedigree', '25.png', 25, 'Pedigree for adult dog.', 4),
(21, 4, 'Pedigree (1 KG)', '26.png', 200, 'Pedigree for adult dog.', 0),
(22, 4, 'Whiskas', '27.png', 295, 'Whiskas food for cat.', 5),
(23, 4, 'Pedigree chicken adult', '28.png', 371, 'Pedigree for adult dog contains chicken', 3),
(24, 5, 'Safal oil', '67.png', 85, 'Safal brand refind oil', 10),
(25, 8, 'McCain Vaggie Fingers', '75.png', 160, 'McCain veggie fingers. Fry and eat.', 3),
(26, 8, 'Fresh sweet corn', '70.png', 30, 'Fresh sweet corn', 4),
(27, 1, 'Test edited', '45.png', 25, 'Test', 5),
(28, 1, 'test', 'bpost-01-800x800_c.jpg', 200, 'dfxfsd', 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE `product_cat` (
  `pc_id` int(5) NOT NULL,
  `pc_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`pc_id`, `pc_name`) VALUES
(1, 'Pulses'),
(2, 'Beverages'),
(3, 'Household Supplies'),
(4, 'Pet Food'),
(5, 'Cooking Essentials'),
(6, 'Skin Care'),
(8, 'Gourmet Foods'),
(12, 'Cleaning');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `customer_address_fk` (`c_id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `customer_order_fk` (`c_id`),
  ADD KEY `address_order_fk` (`a_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`oi_id`),
  ADD KEY `order_order_item_fk` (`o_id`),
  ADD KEY `product_order_item_fk` (`p_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `product_cat_product_fk` (`p_cat`);

--
-- Indexes for table `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`pc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `a_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `oi_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `pc_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `customer_address_fk` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `address_order_fk` FOREIGN KEY (`a_id`) REFERENCES `address` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_order_fk` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_order_item_fk` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_order_item_fk` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_cat_product_fk` FOREIGN KEY (`p_cat`) REFERENCES `product_cat` (`pc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
