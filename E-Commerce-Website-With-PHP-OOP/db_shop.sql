-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2019 at 04:12 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Irfan Chowdhury', 'admin', 'admin80@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'CANON'),
(2, 'SAMSUNG'),
(3, 'IPHONE'),
(4, 'ACER'),
(5, 'DELL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Computer'),
(2, 'Mobile'),
(3, 'Software'),
(4, 'Jewellery'),
(5, 'Foods'),
(6, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `compareId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_compare`
--

INSERT INTO `tbl_compare` (`compareId`, `customerId`, `productId`, `productName`, `price`, `image`) VALUES
(6, 0, 6, 'CC Camera', 800.25, 'uploads/a671b00b0b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customerId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customerId`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(7, 'Shahril Ahmed', 'Aturar, Dipu', 'Chittagong', 'Bangladeshe', '4332', '01829498634', 'sajid@gmail.com', '202cb962ac59075b964b07152d234b70'),
(8, 'Kawsar', 'Chittagong', 'Chittagong', 'Bangladeshe', '4330', '01829498634', 'kawsar@fmail.com', '202cb962ac59075b964b07152d234b70'),
(9, 'Irfan Chowdhury ', 'Muradpur,Panchlaish,Chittagong', 'Chittagong', 'Bangladesh', '4330', '01829498634', 'irfanchowdhury80@gmail.com', '202cb962ac59075b964b07152d234b70'),
(10, 'Arman Ul Alam', 'Aturar, Dipu', 'Chittagong', 'Bangladeshe', '4335', '0152122515', 'arman@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `customerId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(33, 9, 2, 'DELL 3010', 1, 900.50, 'uploads/3004010bc1.jpg', '2019-03-28 12:29:44', 2),
(38, 9, 5, 'FAN', 1, 600.00, 'uploads/0f19bc237c.jpg', '2019-03-28 15:01:44', 2),
(39, 9, 8, 'Frize', 3, 3000.00, 'uploads/5cda90e321.png', '2019-03-28 15:01:44', 2),
(40, 9, 6, 'CC Camera', 1, 800.25, 'uploads/a671b00b0b.jpg', '2019-03-28 15:01:44', 2),
(41, 9, 8, 'Frize', 1, 1000.00, 'uploads/5cda90e321.png', '2019-03-28 15:14:53', 1),
(43, 9, 1, 'Blender', 2, 1401.00, 'uploads/2c966c9082.png', '2019-03-28 15:34:27', 1),
(44, 9, 8, 'Frize', 1, 1000.00, 'uploads/5cda90e321.png', '2019-03-28 22:32:38', 0),
(45, 9, 7, 'iPhone XS', 1, 1200.00, 'uploads/d61a5319b3.png', '2019-03-28 23:07:53', 0),
(46, 9, 6, 'CC Camera', 1, 800.25, 'uploads/a671b00b0b.jpg', '2019-03-28 23:08:53', 0),
(47, 9, 2, 'DELL 3010', 2, 1801.00, 'uploads/3004010bc1.jpg', '2019-03-28 23:10:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(1, 'Blender', 6, 2, '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></p>', 700.50, 'uploads/2c966c9082.png', 0),
(2, 'DELL 3010', 1, 5, '<p><span>Dell is an American multinational computer technology company based in Round Rock, Texas, United States, that develops, sells, repairs, and supports computers and related products and services.</span><span>&nbsp;<a class=\"q ruhjFe NJLBac fl\" href=\"https://en.wikipedia.org/wiki/Dell\" data-ved=\"2ahUKEwjN0vCTkZvhAhViguYKHXEDC1AQmhMwGXoECAoQAg\">Wikipedia</a></span></p>', 900.50, 'uploads/3004010bc1.jpg', 1),
(3, 'Sound BOX', 6, 1, '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></p>', 505.22, 'uploads/455803b0e0.jpg', 1),
(4, 'IRON', 6, 4, '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></p>', 220.97, 'uploads/b94ab799e7.png', 0),
(5, 'FAN', 6, 2, '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></p>', 600.00, 'uploads/0f19bc237c.jpg', 0),
(6, 'CC Camera', 6, 4, '<p><span>Although the phrase is nonsense, it does have a long history. The phrase has been used for several centuries by typographers to show the most distinctive features of their fonts. It is used because the letters involved and the letter spacing in those combinations reveal, at their best, the weight, design, and other important features of the typeface.</span></p>', 800.25, 'uploads/a671b00b0b.jpg', 0),
(7, 'iPhone XS', 2, 3, '<p><span>Trade In: Trade-in values vary. iPhone XR and XS promotional pricing is after trade-in of iPhone 7 Plus in good condition. Additional trade in values require purchase of a new iPhone, subject to availability and limits. Sales tax may be assessed on full value of new iPhone. You must be 18 years or older. In-store trade-in requires presentation of a valid, government-issued photo ID (local law may require saving this information). Additional terms from Apple or Apple&rsquo;s trade-in partners may apply. Monthly pricing: Available to qualified customers and requires 0% APR, 24-month installment loan with Citizens One, and iPhone activation with AT&amp;T, Sprint, T-Mobile, or Verizon. Last installment payment may be less depending on remaining balance.&nbsp;&nbsp;</span>Full&nbsp; terms apply<span>.</span></p>', 1200.00, 'uploads/d61a5319b3.png', 0),
(8, 'Frize', 6, 2, '<p>Trade In: Trade-in values vary. iPhone XR and XS promotional pricing is after trade-in of iPhone 7 Plus in good condition. Additional trade in values require purchase of a new iPhone, subject to availability and limits. Sales tax may be assessed on full value of new iPhone. You must be 18 years or older. In-store trade-in requires presentation of a valid, government-issued photo ID (local law may require saving this information). Additional terms from Apple or Apple&rsquo;s trade-in partners may apply. Monthly pricing: Available to qualified customers and requires 0% APR, 24-month installment loan with Citizens One, and iPhone activation with AT&amp;T, Sprint, T-Mobile, or Verizon. Last installment payment may be less depending on remaining balance.&nbsp;&nbsp;Full&nbsp; terms apply.</p>', 1000.00, 'uploads/5cda90e321.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist`
--

CREATE TABLE `tbl_wlist` (
  `wlistId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wlist`
--

INSERT INTO `tbl_wlist` (`wlistId`, `customerId`, `productId`, `productName`, `price`, `image`) VALUES
(3, 9, 2, 'DELL 3010', 900.50, 'uploads/3004010bc1.jpg'),
(4, 9, 1, 'Blender', 700.50, 'uploads/2c966c9082.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`compareId`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  ADD PRIMARY KEY (`wlistId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `compareId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  MODIFY `wlistId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
