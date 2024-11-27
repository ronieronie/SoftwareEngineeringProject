-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 03:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE `billing_details` (
  `id` int(11) NOT NULL,
  `bill_id` varchar(50) NOT NULL,
  `product_company` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_parts` varchar(50) NOT NULL,
  `packing_size` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `VAT` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_details`
--

INSERT INTO `billing_details` (`id`, `bill_id`, `product_company`, `product_name`, `product_parts`, `packing_size`, `price`, `qty`, `VAT`) VALUES
(180, '178', 'Power Go', 'MotorCycle Battery Rco Drive MF YTX4L', 'Battery', 'MEDIUM (W:15cm L:26cm H:18cm)', '3900', 2, '936'),
(181, '178', 'Dunlop', 'Dunlop Tires 50/90/17', 'Tires', 'MEDIUM (W:15cm L:26cm H:18cm)', '800', 2, '192'),
(183, '180', 'Power Go', 'Power Go MotorCycle Battery Rco Drive MF 12N5L', 'Battery', 'MEDIUM (W:15cm L:26cm H:18cm)', '5400', 1, '648'),
(184, '181', 'Dunlop', 'Dunlop Tires 60/80/17', 'Tires', 'MEDIUM (W:15cm L:26cm H:18cm)', '810', 50, '4860');

-- --------------------------------------------------------

--
-- Table structure for table `billing_header`
--

CREATE TABLE `billing_header` (
  `id` int(5) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `bill_type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `bill_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_header`
--

INSERT INTO `billing_header` (`id`, `full_name`, `bill_type`, `date`, `bill_no`) VALUES
(178, 'Ronie Cardoza', 'Cash', '2022-06-16', '00001'),
(179, 'Yuan De Guzman', 'Cash', '2022-06-16', '00179'),
(180, 'Carlwin Pingad', 'Cash', '2022-06-16', '00180'),
(181, 'Yuan De Guzman', 'Cash', '2022-06-16', '00181');

-- --------------------------------------------------------

--
-- Table structure for table `company_name`
--

CREATE TABLE `company_name` (
  `id` int(5) NOT NULL,
  `company_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_name`
--

INSERT INTO `company_name` (`id`, `company_name`) VALUES
(89853, 'Power Go '),
(89854, 'NCY'),
(89855, 'Dunlop');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(5) NOT NULL,
  `parts` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `parts`, `company_name`) VALUES
(99348, 'Battery', 'Power Go'),
(99349, 'Spring', 'NCY'),
(99350, 'Battery', 'NCY'),
(99351, 'Tires', 'Dunlop');

-- --------------------------------------------------------

--
-- Table structure for table `party_info`
--

CREATE TABLE `party_info` (
  `id` int(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `businessname` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `City` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `party_info`
--

INSERT INTO `party_info` (`id`, `firstname`, `lastname`, `businessname`, `contact`, `address`, `City`) VALUES
(60318, 'asd', 'asd', 'adasdas', 'asdada', 'dasdasd', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `parts` varchar(50) NOT NULL,
  `packing_size` varchar(50) NOT NULL,
  `product_sales` varchar(50) NOT NULL,
  `gross_sales` varchar(50) NOT NULL,
  `deductions` varchar(50) NOT NULL,
  `profit` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `cost_price` varchar(50) NOT NULL,
  `refund` varchar(50) NOT NULL,
  `returned` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_name`, `product_name`, `parts`, `packing_size`, `product_sales`, `gross_sales`, `deductions`, `profit`, `qty`, `cost_price`, `refund`, `returned`) VALUES
(95803, 'Power Go', 'MotorCycle Battery Rco Drive MF YTX4L ', 'Battery', 'MEDIUM (W:15cm L:26cm H:18cm)', '6864', '7800', '936', '0', '2', '150000', '0', '0'),
(95805, 'Power Go', 'Power Go MotorCycle Battery Rco Drive MF 12N5L', 'Battery', 'MEDIUM (W:15cm L:26cm H:18cm)', '4752', '5400', '648', '0', '1', '215000', '0', '0'),
(95806, 'NCY', 'NCY Compression Spring 1500 RPM mio 110/115', 'Spring', 'SMALL (W:13cm L:23cm H:16cm)', '0', '0', '0', '0', '0', '7500', '968', '5'),
(95807, 'NCY', 'NCY Compression Spring 1000 RPM mio 110/115', 'Spring', 'SMALL (W:13cm L:23cm H:16cm)', '0', '0', '0', '0', '0', '7500', '0', '0'),
(95808, 'Dunlop', 'Dunlop Tires 50/90/17', 'Tires', 'MEDIUM (W:15cm L:26cm H:18cm)', '1408', '1600', '192', '0', '2', '30000', '0', '0'),
(95809, 'Dunlop', 'Dunlop Tires 60/80/17', 'Tires', 'MEDIUM (W:15cm L:26cm H:18cm)', '35640', '40500', '4860', '0', '50', '48800', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(5) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `parts` varchar(50) NOT NULL,
  `packing_size` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `purchase_type` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `company_name`, `product_name`, `parts`, `packing_size`, `quantity`, `price`, `purchase_type`, `purchase_date`, `username`) VALUES
(98803, 'Power Go', 'MotorCycle Battery Rco Drive MF YTX4L', 'Battery', 'MEDIUM (W:15cm L:26cm H:18cm)', '50', '3000', 'Cash', '2022-06-16', 'admin'),
(98804, 'Power Go', 'Power Go MotorCycle Battery Rco Drive MF 12N5L', 'Battery', 'MEDIUM (W:15cm L:26cm H:18cm)', '50', '4300', 'Cash', '2022-06-16', 'admin'),
(98805, 'NCY', 'NCY Compression Spring 1500 RPM mio 110/115', 'Spring', 'SMALL (W:13cm L:23cm H:16cm)', '50', '150', 'Cash', '2022-06-16', 'admin'),
(98806, 'NCY', 'NCY Compression Spring 1000 RPM mio 110/115', 'Spring', 'SMALL (W:13cm L:23cm H:16cm)', '50', '150', 'Cash', '2022-06-16', 'admin'),
(98807, 'Dunlop', 'Dunlop Tires 50/90/17', 'Tires', 'MEDIUM (W:15cm L:26cm H:18cm)', '50', '600', 'Cash', '2022-06-16', 'admin'),
(98808, 'Dunlop', 'Dunlop Tires 60/80/17', 'Tires', 'MEDIUM (W:15cm L:26cm H:18cm)', '50', '610', 'Cash', '2022-06-16', 'admin'),
(98809, 'Dunlop', 'Dunlop Tires 60/80/17', 'Tires', 'MEDIUM (W:15cm L:26cm H:18cm)', '30', '610', 'Cash', '2022-06-16', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `return_products`
--

CREATE TABLE `return_products` (
  `id` int(5) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `return_date` varchar(50) NOT NULL,
  `product_company` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_parts` varchar(500) NOT NULL,
  `packing_size` varchar(50) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_qty` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `vat` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_products`
--

INSERT INTO `return_products` (`id`, `bill_no`, `return_date`, `product_company`, `product_name`, `product_parts`, `packing_size`, `product_price`, `product_qty`, `total`, `vat`) VALUES
(130, '00179', '2022-06-16', 'NCY', 'NCY Compression Spring 1500 RPM mio 110/115', 'Spring', 'SMALL (W:13cm L:23cm H:16cm)', '220', '5', '968', 132);

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `id` int(5) NOT NULL,
  `month` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `gross_sales` varchar(50) NOT NULL,
  `deductions` varchar(50) NOT NULL,
  `profit` int(11) NOT NULL,
  `totalcost` varchar(50) NOT NULL,
  `refund` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_report`
--

INSERT INTO `sales_report` (`id`, `month`, `total`, `gross_sales`, `deductions`, `profit`, `totalcost`, `refund`) VALUES
(1, 'January', '0', '0', '0', 0, '0', '0'),
(2, 'February', '0', '0', '0', 0, '0', '0'),
(3, 'March', '0', '0', '0', 0, '0', '0'),
(4, 'April', '0', '0', '0', 0, '0', '0'),
(5, 'May', '0', '0', '0', 0, '0', '0'),
(6, 'June', '48664', '55300', '6636', 0, '458800', '968'),
(7, 'July', '0', '0', '0', 0, '0', '0'),
(8, 'August', '0', '0', '0', 0, '0', '0'),
(9, 'September', '0', '0', '0', 0, '0', '0'),
(10, 'October', '0', '0', '0', 0, '0', '0'),
(11, 'November', '0', '0', '0', 0, '0', '0'),
(12, 'December', '0', '0', '0', 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `id` int(5) NOT NULL,
  `product_company` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `packing_size` varchar(50) NOT NULL,
  `product_parts` varchar(100) NOT NULL,
  `product_qty` varchar(100) NOT NULL,
  `selling_price` varchar(100) NOT NULL,
  `cost_price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`id`, `product_company`, `product_name`, `packing_size`, `product_parts`, `product_qty`, `selling_price`, `cost_price`) VALUES
(92486, 'Power Go', 'MotorCycle Battery Rco Drive MF YTX4L', 'MEDIUM (W:15cm L:26cm H:18cm)', 'Battery', '48', '3900', 3000),
(92487, 'Power Go', 'Power Go MotorCycle Battery Rco Drive MF 12N5L', 'MEDIUM (W:15cm L:26cm H:18cm)', 'Battery', '49', '5400', 4300),
(92488, 'NCY', 'NCY Compression Spring 1500 RPM mio 110/115', 'SMALL (W:13cm L:23cm H:16cm)', 'Spring', '50', '220', 150),
(92489, 'NCY', 'NCY Compression Spring 1000 RPM mio 110/115', 'SMALL (W:13cm L:23cm H:16cm)', 'Spring', '50', '220', 150),
(92490, 'Dunlop', 'Dunlop Tires 50/90/17', 'MEDIUM (W:15cm L:26cm H:18cm)', 'Tires', '48', '800', 600),
(92491, 'Dunlop', 'Dunlop Tires 60/80/17', 'MEDIUM (W:15cm L:26cm H:18cm)', 'Tires', '30', '810', 610);

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `id` int(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`id`, `firstname`, `lastname`, `username`, `password`, `status`, `email`, `role`) VALUES
(75174, 'admin', 'admin', 'admin', 'admin', 'Active', 'admin@gmail.com', 'Admin'),
(75175, 'Ronie', 'Cardoza', 'ronie123', '1234', 'Active', 'roniesy123@gmail.com', 'User'),
(75176, 'Bren', 'Franciso', 'bren123', '1234', 'Inactive', 'brenfranciso@gmail.com', 'User'),
(75177, 'Yuan ', 'De Guzman', 'yuan123', '1234', 'Active', 'yuan@gmail.com', 'User'),
(75178, 'Kurt', 'Raymundo', 'kurt123', '1234', 'Active', 'kurt@gmail.com', 'User'),
(75179, 'Carlwin', 'Pingad', 'bojak123', '1234', 'Inactive', 'carlwin123@gmail.com', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_header`
--
ALTER TABLE `billing_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_name`
--
ALTER TABLE `company_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party_info`
--
ALTER TABLE `party_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_products`
--
ALTER TABLE `return_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `billing_header`
--
ALTER TABLE `billing_header`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `company_name`
--
ALTER TABLE `company_name`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89856;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99354;

--
-- AUTO_INCREMENT for table `party_info`
--
ALTER TABLE `party_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60319;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95810;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98810;

--
-- AUTO_INCREMENT for table `return_products`
--
ALTER TABLE `return_products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92492;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75185;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
