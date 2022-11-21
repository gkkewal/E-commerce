-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 09:51 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group28`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `aheadline` varchar(12) NOT NULL,
  `abio` varchar(500) NOT NULL,
  `aimage` varchar(60) NOT NULL DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `datetime`, `username`, `password`, `aname`, `aheadline`, `abio`, `aimage`) VALUES
(1, '', 'group28', 'group28', 'Group', '28', 'Project', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `a_name` varchar(45) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `bimage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand`, `bimage`) VALUES
(7, 'Bajaj', 'fan1.jpg'),
(9, 'havalls', 'fan1.jpg'),
(11, 'brand1', 'fan1.jpg'),
(14, 'brand2', 'fan1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date_and_time` datetime NOT NULL,
  `product_product_id` int(11) NOT NULL,
  `user_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `admin` varchar(50) DEFAULT NULL,
  `datetime` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `admin`, `datetime`, `status`) VALUES
(7, 'Fans', 'group-28', '23-February-2022 00:27:16', 1),
(8, 'Appliances', 'group-28', '23-February-2022 00:27:22', 1),
(9, 'Air Coolers', 'group-28', '23-February-2022 00:27:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(45) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(45) NOT NULL,
  `company_address` varchar(45) NOT NULL,
  `company_contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `c_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `feature_id` int(11) NOT NULL,
  `feature_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feeback_id` int(11) NOT NULL,
  `feedback` mediumtext,
  `user_user_id` int(11) NOT NULL,
  `order_detail_order_detail_id` int(11) NOT NULL,
  `order_detail_product_product_id` int(11) NOT NULL,
  `order_detail_order_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `product_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image_path`, `product_product_id`) VALUES
(22, 'Fan_Banner.jpg', 1),
(23, 'mixer-banner.jpg', 1),
(24, 'banner.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offers_id` int(11) NOT NULL,
  `offers_name` varchar(45) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `payable_amount` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `user_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_cancel` tinyint(1) NOT NULL,
  `tracking_id` varchar(40) NOT NULL,
  `refund_of_cancel` int(11) DEFAULT NULL,
  `product_product_id` int(11) NOT NULL,
  `order_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` mediumint(10) UNSIGNED NOT NULL,
  `productonhand` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `datetime` varchar(50) DEFAULT NULL,
  `admin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `price`, `productonhand`, `description`, `brand`, `subcategory_id`, `image`, `status`, `datetime`, `admin`) VALUES
(1, 'Ceiling fan', 455, 5, '1250 mm Sweep Indigo White', 'havalls', 11, 'FAN (2).jpg', 0, '23-February-2022 00:28:59', 'Group28'),
(3, 'STEALTH AIR1', 459, 5, '1250 mm Sweep Indigo White', 'havalls', 11, 'FAN (2).jpg', 0, '23-February-2022 20:40:59', 'Group28'),
(4, 'STEALTH AIR2', 3000, 5, '1250 mm Sweep Indigo White', 'havalls', 11, 'FAN (2).jpg', 0, '23-February-2022 20:47:07', 'Group28'),
(5, 'STEALTH AIR3', 3000, 5, '1250 mm Sweep Indigo Blue', 'havalls', 12, 'FAN (2).jpg', 0, '23-February-2022 20:49:52', 'Group28'),
(6, 'STEALTH AIR', 1000, 5, '1250 mm Sweep Indigo Blue', 'brand1', 11, 'IRON.jpg', 0, '23-February-2022 20:51:42', 'Group28');

-- --------------------------------------------------------

--
-- Table structure for table `product_feature`
--

CREATE TABLE `product_feature` (
  `product_value` varchar(45) DEFAULT NULL,
  `product_product_id` int(11) NOT NULL,
  `feature_feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `product_has_offers`
--

CREATE TABLE `product_has_offers` (
  `product_product_id` int(11) NOT NULL,
  `offers_offers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_has_supplier`
--

CREATE TABLE `product_has_supplier` (
  `price` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL,
  `supplier_idsupplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Purchase_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `purchase_type` varchar(50) NOT NULL,
  `purchase_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Purchase_Purchase_id` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_man`
--

CREATE TABLE `service_man` (
  `service_man_id` int(11) NOT NULL,
  `service_man_name` varchar(45) NOT NULL,
  `service_man_exp` int(11) NOT NULL,
  `service_man_mobile` varchar(10) NOT NULL,
  `service_man_qualification` varchar(45) NOT NULL,
  `service_man_add` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `s_name` varchar(45) NOT NULL,
  `country_country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `subcategory_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `admin` varchar(50) DEFAULT NULL,
  `datetime` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`subcategory_id`, `name`, `category_id`, `admin`, `datetime`, `status`) VALUES
(11, 'ceilngfan', 7, 'group-28', '23-February-2022 00:27:35', 0),
(12, 'Wall Fan', 7, 'group-28', '23-February-2022 00:27:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supp_name` varchar(50) NOT NULL,
  `supp_contact` bigint(10) UNSIGNED NOT NULL,
  `supp_email` varchar(50) NOT NULL,
  `supp_add` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supp_name`, `supp_contact`, `supp_email`, `supp_add`) VALUES
(2, 'group-28', 1234567899, 'kewalgondalia9099@gmail.com', 'Ahmedabad'),
(3, 'Keyur', 9099909912, 'kewalgondali9099@gmail.com', 'qqqqqqqqqqqqqqq');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `address` mediumtext,
  `doj` varchar(50) NOT NULL,
  `area_area_id` int(11) DEFAULT NULL,
  `company_company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `gender`, `password`, `email`, `phone`, `is_admin`, `img`, `address`, `doj`, `area_area_id`, `company_company_id`) VALUES
(1, 'Kewal', 'Gondalia', 'M', 'group28', 'kewalgondalia9099@gmail.com', 9099123432, NULL, NULL, NULL, '23-February-2022 10:35:50', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`),
  ADD UNIQUE KEY `pin_code_UNIQUE` (`pin_code`),
  ADD KEY `fk_address_city1_idx` (`city_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_UNIQUE` (`brand`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_product_id`,`user_user_id`),
  ADD KEY `fk_cart_product1_idx` (`product_product_id`),
  ADD KEY `fk_cart_user1_idx` (`user_user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `fk_city_state1_idx` (`state_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `c_name_UNIQUE` (`c_name`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feeback_id`),
  ADD KEY `fk_feedback_user1_idx` (`user_user_id`),
  ADD KEY `fk_feedback_order_detail1_idx` (`order_detail_order_detail_id`,`order_detail_product_product_id`,`order_detail_order_order_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_images_product1_idx` (`product_product_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offers_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_order_user1_idx` (`user_user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`,`product_product_id`,`order_order_id`),
  ADD KEY `fk_order_detail_product1_idx` (`product_product_id`),
  ADD KEY `fk_order_detail_order1_idx` (`order_order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_product_sub_category1_idx` (`subcategory_id`);

--
-- Indexes for table `product_feature`
--
ALTER TABLE `product_feature`
  ADD PRIMARY KEY (`product_product_id`,`feature_feature_id`),
  ADD KEY `fk_product_feature_feature1_idx` (`feature_feature_id`);

--
-- Indexes for table `product_has_offers`
--
ALTER TABLE `product_has_offers`
  ADD PRIMARY KEY (`product_product_id`,`offers_offers_id`),
  ADD KEY `fk_product_has_offers_offers1_idx` (`offers_offers_id`),
  ADD KEY `fk_product_has_offers_product1_idx` (`product_product_id`);

--
-- Indexes for table `product_has_supplier`
--
ALTER TABLE `product_has_supplier`
  ADD PRIMARY KEY (`product_product_id`,`supplier_idsupplier`),
  ADD KEY `fk_product_has_supplier_supplier1_idx` (`supplier_idsupplier`),
  ADD KEY `fk_product_has_supplier_product1_idx` (`product_product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`Purchase_Purchase_id`,`product_product_id`),
  ADD KEY `fk_Purchase_details_Purchase1_idx` (`Purchase_Purchase_id`),
  ADD KEY `fk_Purchase_details_product1_idx` (`product_product_id`);

--
-- Indexes for table `service_man`
--
ALTER TABLE `service_man`
  ADD PRIMARY KEY (`service_man_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`),
  ADD UNIQUE KEY `state_name_UNIQUE` (`s_name`),
  ADD KEY `fk_state_country1_idx` (`country_country_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_sub_category_category1_idx` (`category_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supp_name` (`supp_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_user_area1_idx` (`area_area_id`),
  ADD KEY `fk_user_company1_idx` (`company_company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feeback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offers_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Purchase_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_man`
--
ALTER TABLE `service_man`
  MODIFY `service_man_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `fk_address_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_order_detail1` FOREIGN KEY (`order_detail_order_detail_id`,`order_detail_product_product_id`,`order_detail_order_order_id`) REFERENCES `order_detail` (`order_detail_id`, `product_product_id`, `order_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_images_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_detail_order1` FOREIGN KEY (`order_order_id`) REFERENCES `order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_detail_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_feature`
--
ALTER TABLE `product_feature`
  ADD CONSTRAINT `fk_product_feature_feature1` FOREIGN KEY (`feature_feature_id`) REFERENCES `feature` (`feature_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_feature_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_has_offers`
--
ALTER TABLE `product_has_offers`
  ADD CONSTRAINT `fk_product_has_offers_offers1` FOREIGN KEY (`offers_offers_id`) REFERENCES `offers` (`offers_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_has_offers_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_has_supplier`
--
ALTER TABLE `product_has_supplier`
  ADD CONSTRAINT `fk_product_has_supplier_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_has_supplier_supplier1` FOREIGN KEY (`supplier_idsupplier`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `fk_Purchase_details_Purchase1` FOREIGN KEY (`Purchase_Purchase_id`) REFERENCES `purchase` (`Purchase_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Purchase_details_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fk_state_country1` FOREIGN KEY (`country_country_id`) REFERENCES `country` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `fk_sub_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_area1` FOREIGN KEY (`area_area_id`) REFERENCES `area` (`area_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_company1` FOREIGN KEY (`company_company_id`) REFERENCES `company` (`company_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
