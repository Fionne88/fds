-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 03:38 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fds`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `adminName` varchar(45) DEFAULT NULL,
  `userName` varchar(45) DEFAULT NULL,
  `mobileNumber` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `registrationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `adminName`, `userName`, `mobileNumber`, `email`, `password`, `registrationDate`) VALUES
(1, 'Administrator', 'admin', '0164112222', 'admin@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', '2019-04-05 07:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(100) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `categoryName`, `dateCreated`) VALUES
(1, 'Chinese', '2019-11-14 01:49:28'),
(2, 'Burgers', '2019-11-14 01:49:35'),
(3, 'Halal', '2019-11-14 01:49:39'),
(4, 'Western', '2019-11-14 01:49:48'),
(5, 'Fast Food', '2019-11-14 01:49:53'),
(6, 'japanese', '2019-11-19 03:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(100) DEFAULT NULL,
  `itemName` varchar(100) DEFAULT NULL,
  `itemPrice` varchar(20) DEFAULT NULL,
  `itemDesc` varchar(500) DEFAULT NULL,
  `image` varchar(120) DEFAULT NULL,
  `itemQty` varchar(100) DEFAULT NULL,
  `restName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `categoryName`, `itemName`, `itemPrice`, `itemDesc`, `image`, `itemQty`, `restName`) VALUES
(1, 'Chinese', 'Hokkien Mee', '6.00', '                            	', 'e4e686e582b05fe8022b10c966b45c91.jpg', '50', 'Kedai Makan 888'),
(2, 'Chinese', 'Lam mee', '6.00', '                                                 	', '6c30867bf9b732cfc01c89ef0cc3cd9c.jpg', '50', 'Kedai Makan 888'),
(3, 'Western', 'Chicken Gordon Bleu', '19.90', '                                                 	', '2314605a6454dfdf1c90276d820bf1a0.jpg', '0', NULL),
(4, 'Western', 'Black Pepper', '19.90', '                                                 	', '30ba42ce5737deadc67882afdf8ef9a8.jpg', '50', NULL),
(5, 'Chinese', 'Test noodle', '6.00', '                                                 	', '6c30867bf9b732cfc01c89ef0cc3cd9c.jpg', '50', 'golden bowl');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foodtracking`
--

CREATE TABLE `tbl_foodtracking` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `statusDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orderCancelled` int(1) DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_foodtracking`
--

INSERT INTO `tbl_foodtracking` (`id`, `orderId`, `remark`, `status`, `statusDate`, `orderCancelled`, `adminId`) VALUES
(1, 779770472, 'confirm', 'Order Confirmed', '2019-11-14 02:55:27', NULL, NULL),
(2, 186758565, 'change my mins', 'Order Cancelled', '2019-11-14 03:24:40', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) DEFAULT NULL,
  `orderNumber` varchar(100) DEFAULT NULL,
  `buildingNo` varchar(255) DEFAULT NULL,
  `streetName` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `orderTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderFinalStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`id`, `userId`, `orderNumber`, `buildingNo`, `streetName`, `area`, `city`, `orderTime`, `orderFinalStatus`) VALUES
(1, '1', '779770472', '20', 'Tanjung Farlim', 'Georgetown', 'Georgetown', '2019-11-14 02:54:43', 'Order Confirmed'),
(2, '1', '186758565', '12', 'Sultan ahmad shah', 'Georgetown', 'Georgetown', '2019-11-14 03:23:41', 'Order Cancelled'),
(3, '1', '662587091', '20', 'Tanjung Farlim', 'Georgetown', 'Georgetown', '2019-11-14 05:55:04', NULL),
(4, '1', '515105492', '20', 'Tanjung Farlim', 'Georgetown', 'Georgetown', '2019-11-19 09:34:36', NULL),
(5, '1', '368921721', '20', 'Tanjung Farlim', 'Georgetown', 'Georgetown', '2019-11-19 10:25:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `foodId` int(11) DEFAULT NULL,
  `isOrderPlaced` int(11) DEFAULT NULL,
  `orderNumber` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `userId`, `foodId`, `isOrderPlaced`, `orderNumber`) VALUES
(1, 1, 1, 1, '779770472'),
(2, 1, 0, 1, '779770472'),
(3, 1, 1, 1, '779770472'),
(4, 1, 1, 1, '779770472'),
(5, 1, 1, 1, '779770472'),
(6, 1, 1, 1, '186758565'),
(7, 1, 2, 1, '186758565'),
(8, 1, 1, 1, '662587091'),
(9, 1, 4, 1, '662587091'),
(10, 1, 1, 1, '515105492'),
(14, 1, 1, 1, '368921721');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurant`
--

CREATE TABLE `tbl_restaurant` (
  `id` int(11) NOT NULL,
  `restName` varchar(100) DEFAULT NULL,
  `restAddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_restaurant`
--

INSERT INTO `tbl_restaurant` (`id`, `restName`, `restAddress`) VALUES
(1, 'golden bowl', 'jalan sultan azlan shah');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `mobileNumber` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `firstName`, `lastName`, `email`, `mobileNumber`, `password`, `registrationDate`) VALUES
(1, 'Jeon', 'Bunny', 'thffionne95@gmail.com', '0129382473', 'e10adc3949ba59abbe56e057f20f883e', '2019-11-14 01:45:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantId` (`restName`),
  ADD KEY `restaurantName` (`restName`);

--
-- Indexes for table `tbl_foodtracking`
--
ALTER TABLE `tbl_foodtracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserId` (`userId`,`orderNumber`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserId` (`userId`,`foodId`,`orderNumber`);

--
-- Indexes for table `tbl_restaurant`
--
ALTER TABLE `tbl_restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_foodtracking`
--
ALTER TABLE `tbl_foodtracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_restaurant`
--
ALTER TABLE `tbl_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
