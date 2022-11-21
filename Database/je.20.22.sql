-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2022 at 08:06 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `je.20.22`
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
  `aname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `datetime`, `username`, `password`, `aname`) VALUES
(1, 'January-08-2022 18:36:38', 'group28', 'group28', 'bca');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Bajaj'),
(11, 'brand1'),
(12, 'brand2');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `admin`, `datetime`) VALUES
(12, 'Water Heaters', 'group-28', '04-January-2022 19:54:10'),
(13, 'Personal Grooming', 'group-28', '04-January-2022 19:54:33'),
(14, 'Air Coolers', 'group-28', '04-January-2022 19:54:51'),
(15, 'Lighting', 'group-28', '04-January-2022 19:55:20'),
(16, 'Switchgears', 'group-28', '04-January-2022 19:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `productonhand` int(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `subcategory_id` int(10) NOT NULL,
  `image` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `productonhand`, `description`, `brand`, `subcategory_id`, `image`, `datetime`, `admin`) VALUES
(1, 'Samsung 6S', 2323, 333, '23erfewsdfewsedf', 'Bajaj', 1, '', '08-January-2022 21:06:13', 'Group28'),
(2, 'Samsung 6S', 23432, 333, 'ffdswsdfdwsdf', 'Bajaj', 2, 'flower.png', '08-January-2022 21:55:40', 'Group28'),
(3, 'Samsung J', 343, 71, 'wedfdwwwsdfdwsdfcdwsdf', 'brand1', 1, 'burrito.jpg', '08-January-2022 22:04:54', 'Group28');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(10) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `supplier_name` varchar(10) NOT NULL,
  `purchase_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `brand`, `product_name`, `quantity`, `price`, `supplier_name`, `purchase_type`) VALUES
(1, 'brand1', 'Samsung J', 22, 33, 'group-28', 'CHASE'),
(2, 'brand1', 'Samsung J', 22, 33, 'group-28', 'CHASE'),
(3, 'Bajaj', 'Samsung 6S', 34, 34, 'group-28', 'CHASE'),
(4, 'Bajaj', 'Samsung 6S', 222, 3333, 'group-28', 'CHEQUE'),
(5, 'Bajaj', 'Samsung 6S', 222, 3333, 'group-28', 'CHEQUE'),
(6, 'Bajaj', 'Samsung 6S', 22, 23, 'group28gg', 'CHASE'),
(7, 'Bajaj', 'Samsung 6S', 33, 222, 'group28gg', 'CHASE'),
(8, 'brand1', 'Samsung J', 22, 22, 'group28gg', 'CHASE'),
(9, 'brand1', 'Samsung J', 22, 22, 'group28gg', 'CHASE'),
(10, 'brand1', 'Samsung J', 22, 22, 'group28gg', 'CHASE'),
(11, 'Bajaj', 'Samsung 6S', 56, 56, 'group28gg', 'select');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(10) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category_id`, `admin`, `datetime`) VALUES
(1, 'hp', 14, 'group-28', '08-January-2022 21:05:28'),
(2, 'samsung', 14, 'group-28', '08-January-2022 21:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `contact`, `email`, `address`) VALUES
(1, 'group28gg', 123456789, 'kewalgondalia9099@gmail.com', 'Uttamnagar\r\nNikol road , bapu Nagar'),
(2, 'group-28', 2147483647, 'kewalgondalia9099@gmail.com', 'Uttamnagar\r\nNikol road , bapu Nagar'),
(3, 'group-28', 2147483647, 'kewalgondalia9099@gmail.com', 'Uttamnagar\r\nNikol road , bapu Nagar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand` (`brand`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory` (`subcategory_id`) USING BTREE;

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
