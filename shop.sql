-- phpMyAdmin SQL Dump
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1

--
-- Database: `inventory`
--

-- --------------------------------------------------------

-- username : hannah@gmail.com
-- password : 1234

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'To Identify User',
  `email` varchar(255) NOT NULL,
  `full name` varchar(255) NOT NULL COMMENT 'Username To Login',
  `password` varchar(255) NOT NULL COMMENT 'Password To Login',
  `groupId` int(11) NOT NULL DEFAULT '0' COMMENT 'Identify User Group'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `full name`, `password`, `groupId`) VALUES
(1, 'hannah@gmail.com', 'hannah atta', '1234', 1),
(2, 'ahmed@info.com', 'Ahmed Ali', '1233', 0),
(4, 'Gamal@hotmail', 'Gamal Khalid', '133', 0);


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL COMMENT 'To Identify Product',
  `pro_name` varchar(255) NOT NULL,
  `pro_cat` varchar(255) NOT NULL,
  `pro_brand` int(11) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_qty` int(11) NOT NULL,
  `pro_category` varchar(255),
  `status` int(11) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_cat`, `pro_brand`, `pro_price`, `pro_qty`, `pro_category`, `status`) VALUES
(1, 'Samsung A72', 'Mobil Phone', '2', '68000', '100', '', '1'),
(2, 'Samsung S50', 'Mobil Phone', '2', '80000', '55', '', ''),
(3, 'HP', 'Computer', '1', '608000', '70', '', '');


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL COMMENT 'To Identify User',
  `cat_name` varchar(255) NOT NULL,
  `parent_cat` int(11),
  `c_status` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `parent_cat`, `c_status`) VALUES
(1, 'Software', 1, 1),
(2, 'Mobil Phone', 2, 0),
(3, 'Computer', '', 0);


-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL COMMENT 'To Identify User',
  `brand_name` varchar(255) NOT NULL,
  `status` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `status`) VALUES
(1, 'Samsung', 1),
(2, 'HP', 0),
(3, 'LG', 0);
