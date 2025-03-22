-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 06:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CBA', 'College of Business Administration', '2024-03-12 08:21:03', '2024-03-12 08:21:03', '0000-00-00 00:00:00'),
(2, 'CTED', 'College of Teacher Education', '2024-03-12 08:21:17', '2024-05-11 21:42:40', '0000-00-00 00:00:00'),
(4, 'Administrator\'s Office', 'Office of the Campus Administrators', '2024-03-14 09:49:43', '2024-05-11 21:47:39', '0000-00-00 00:00:00'),
(6, 'CTECH', 'College of Technology', '2024-05-11 21:43:10', '2024-05-11 21:43:10', '0000-00-00 00:00:00'),
(7, 'CCJE', 'College of Criminal Justice Education', '2024-05-11 21:44:21', '2024-05-11 21:44:21', '0000-00-00 00:00:00'),
(8, 'Registrar', 'Office of the Campus Registrar', '2024-05-11 21:47:25', '2024-05-11 21:47:53', '0000-00-00 00:00:00'),
(9, 'GAD', 'Gender and Development', '2024-05-11 21:48:16', '2024-05-11 21:48:16', '0000-00-00 00:00:00'),
(10, 'Cashier', 'Office of the Campus Cashier', '2024-05-11 21:48:29', '2024-05-11 21:48:29', '0000-00-00 00:00:00'),
(11, 'Supply', 'Office of the Campus Supply', '2024-05-11 21:48:43', '2024-05-11 21:48:43', '0000-00-00 00:00:00'),
(12, 'Scholarship', 'Office of the Campus Scholarship', '2024-05-11 21:48:55', '2024-05-11 21:48:55', '0000-00-00 00:00:00'),
(13, 'Finance (Budget)', 'Office of the Campus Finance (Budget)', '2024-05-11 21:49:20', '2024-05-11 21:49:20', '0000-00-00 00:00:00'),
(14, 'Finance (Payroll)', 'Office of the Campus Finance (Payroll)', '2024-05-11 21:49:36', '2024-05-11 21:49:36', '0000-00-00 00:00:00'),
(15, 'Finance (Disbursing)', 'Office of the Campus Finance (Disbursing)', '2024-05-11 21:49:52', '2024-05-11 21:49:52', '0000-00-00 00:00:00'),
(16, 'HR', 'Human Resource Office', '2024-05-11 21:50:09', '2024-05-11 21:50:09', '0000-00-00 00:00:00'),
(17, 'SAS', 'Student Affairs Services', '2024-05-11 21:50:26', '2024-05-11 21:50:26', '0000-00-00 00:00:00'),
(18, 'Library', 'Office of the Campus Library', '2024-05-11 21:50:36', '2024-05-11 21:50:36', '0000-00-00 00:00:00'),
(19, 'C.A.R.E. Office', 'Office of the Campus C.A.R.E.', '2024-05-11 21:50:57', '2024-05-11 21:50:57', '0000-00-00 00:00:00'),
(20, 'Farm House', 'Office of the Campus Farm House', '2024-05-11 21:51:08', '2024-05-11 21:51:08', '0000-00-00 00:00:00'),
(21, 'Security Office', 'Office of the Campus Security', '2024-05-11 21:51:22', '2024-05-11 21:51:22', '0000-00-00 00:00:00'),
(22, 'Buildings and Grounds', 'Office of the Campus Buildings and Grounds', '2024-05-11 21:51:35', '2024-05-11 21:51:49', '0000-00-00 00:00:00'),
(23, 'Extension and Alumni', 'Office of the Campus Extension and Alumni', '2024-05-11 21:52:05', '2024-05-11 21:52:05', '0000-00-00 00:00:00'),
(24, 'Research', 'Office of the Campus Research', '2024-05-11 21:52:21', '2024-05-11 21:52:21', '0000-00-00 00:00:00'),
(25, 'SG, Cultural Affairs Office', 'Office of the Campus SG, Cultural Affairs Office', '2024-05-11 21:52:44', '2024-05-11 21:52:44', '0000-00-00 00:00:00'),
(26, 'TN', 'TN', '2024-05-11 21:52:52', '2024-05-11 21:52:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `name`, `designation`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 1, 'Dr. Carlito D. Acabal', 'Head', 'carlito', '$2y$15$jLX1nby.x8tvgm3K4AD/9OsM2HZaz7gp798Xmmaehi8siTiu6sAP6', '2024-05-11 21:45:21', '2024-05-11 21:45:21', '0000-00-00 00:00:00'),
(9, 6, 'Mr. Marlon A. Dagunan', 'Dean', 'marlon', '$2y$15$yreLjTNs1ZlpxfHVN8l6.uBFnyJa1XixG2U2Bct3z3LpDF1tVUoxi', '2024-05-11 21:45:43', '2024-05-11 21:45:43', '0000-00-00 00:00:00'),
(10, 7, 'Mrs. Karen T. Perater', 'Head', 'karen', '$2y$15$vNCe8w094oszr52WJIW.N.CcgUGzWCmMxIFIJ/Xh/1XvsUrXjheru', '2024-05-11 21:46:04', '2024-05-11 21:46:04', '0000-00-00 00:00:00'),
(11, 2, 'Dr. Gary I. Colina', 'Head', 'gary', '$2y$15$zTrgHEDp8JcfpopV9GfvkeQt8.vwlyiAgR9Y8uvuNtecickY8m026', '2024-05-11 21:46:29', '2024-05-11 21:46:29', '0000-00-00 00:00:00'),
(12, 20, 'Faith B. Patay', 'Head', 'faith', '$2y$15$CTQynunwvV4amL49cj1zxOPC12gXqQDQxwacVebTsfDluVJ7.Xgi6', '2024-05-11 22:05:29', '2024-05-11 22:05:29', '0000-00-00 00:00:00'),
(13, 4, 'Engr. Arcie S. Nogra', 'Campus Director', 'arcie', '$2y$15$seslXPstmpI1HySvkow4PebFbeddnakuK/N3hZMBEmMJ5iKsSx7Iy', '2024-05-11 22:06:49', '2024-05-11 22:06:49', '0000-00-00 00:00:00'),
(14, 18, 'Gie Ann R. Ayunting', 'Head', 'gie', '$2y$15$PXEZZZ/g22wQD93j6uxxbOhIMuTCerbW3J15Zdj7gardFnz95z0eq', '2024-05-11 22:08:26', '2024-05-11 22:08:26', '0000-00-00 00:00:00'),
(15, 23, 'Juan Dela Cruz', 'Head', 'juan', '$2y$15$znZlT.i7UCDuTN8BLBIEau7hx.6Vnk4D1GxRS.GrLIzdPQzig.2Ze', '2024-05-14 15:45:07', '2024-05-14 15:45:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `item_no` varchar(20) NOT NULL,
  `pr_no` varchar(20) NOT NULL,
  `iar_no` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `unit` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_cost` decimal(11,2) NOT NULL,
  `accuisition_date` date NOT NULL,
  `type` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `employee_id`, `item_no`, `pr_no`, `iar_no`, `name`, `description`, `unit`, `quantity`, `unit_cost`, `accuisition_date`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 14, 'MP-2022-0019', '0043-08-22M', '2022-12-0047', 'Basic Microeconomics', 'Basic Microeconomics by Baumol, W./2021', '4', 1, 1007.00, '2023-02-08', 'equipments', '2024-05-11 22:12:05', '2024-05-11 22:13:11', '0000-00-00 00:00:00'),
(6, 13, 'MP-2022-0014', '0046-11-21M', '2022-12-0041', 'Stand Fan', 'Stand Fan', '1', 2, 2500.00, '2022-08-11', 'equipments', '2024-05-11 22:48:11', '2024-05-11 22:48:11', '0000-00-00 00:00:00'),
(7, 13, 'ST-001-01', 'PR-001-01', 'IAR-001-01', 'Short Bondpaper', 'Hard Copy Short Bondpaper', '6', 100, 250.00, '2024-01-01', 'supplies', '2024-05-11 23:01:54', '2024-05-11 23:01:54', '0000-00-00 00:00:00'),
(8, 13, 'ST-001-02', 'PR-001-02', 'IAR-001-02', 'Long Bondpaper', 'Hardcopy Long Bondpaper', '6', 100, 270.00, '2024-01-01', 'supplies', '2024-05-12 07:57:04', '2024-05-12 07:57:04', '0000-00-00 00:00:00'),
(9, 13, 'ST-001-03', 'PR-001-03', 'IAR-001-03', 'A4 Bondpaper', 'Hardcopy A4 Bondpaper', '6', 100, 260.00, '2024-01-01', 'supplies', '2024-05-12 07:57:50', '2024-05-12 07:57:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ST 101', 'ST 101 is located at first floor of Science and Technology building.', '2024-03-12 08:18:28', '2024-03-14 09:52:43', '0000-00-00 00:00:00'),
(2, 'Room 102', 'Room 102 is located at first floor of annex building.', '2024-03-12 08:18:38', '2024-03-13 18:49:01', '0000-00-00 00:00:00'),
(3, 'Room 103', 'Room 103 is located at first floor of annex building.', '2024-04-13 22:04:13', '2024-04-13 22:04:13', '0000-00-00 00:00:00'),
(4, 'Stock Room', 'Stock Room', '2024-04-14 14:50:02', '2024-04-14 14:50:02', '0000-00-00 00:00:00'),
(5, 'Library', 'Campus Library\r\n', '2024-05-11 22:12:46', '2024-05-11 22:12:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `division` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `risNo` varchar(255) NOT NULL,
  `purpose` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `request_qty` int(11) NOT NULL,
  `available` varchar(3) NOT NULL,
  `issue_qty` int(11) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `requested_designation` varchar(255) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `approved_designation` varchar(255) NOT NULL,
  `approved_date` date NOT NULL,
  `issued_by` varchar(255) NOT NULL,
  `issued_designation` varchar(255) NOT NULL,
  `issued_date` date NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `received_designation` varchar(255) NOT NULL,
  `received_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `division`, `office`, `code`, `risNo`, `purpose`, `item_id`, `request_qty`, `available`, `issue_qty`, `remarks`, `requested_by`, `requested_designation`, `approved_by`, `approved_designation`, `approved_date`, `issued_by`, `issued_designation`, `issued_date`, `received_by`, `received_designation`, `received_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '', '20', '', '', 'For printing', 8, 2, '', 0, '', 12, '', '', '', '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', 'pending', '2024-05-12 10:16:28', '2024-05-12 10:16:28', '0000-00-00 00:00:00'),
(3, '', '4', '', '', 'For printing', 7, 2, '', 0, '', 13, '', '', '', '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', 'pending', '2024-05-12 14:21:42', '2024-05-12 14:21:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tracker`
--

CREATE TABLE `tracker` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `referenceNo` varchar(50) NOT NULL,
  `issueQty` int(11) NOT NULL,
  `balanceQty` int(11) NOT NULL,
  `thru` varchar(255) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracker`
--

INSERT INTO `tracker` (`id`, `item_id`, `department_id`, `employee_id`, `location_id`, `date`, `referenceNo`, `issueQty`, `balanceQty`, `thru`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 5, 18, 14, 5, '2023-02-08', 'PAR-123456', 1, 0, '', 'Transferred', '2024-05-11 22:14:56', '2024-05-11 22:14:56', '0000-00-00 00:00:00'),
(8, 6, 4, 13, 1, '2024-05-08', 'PAR-001', 1, 1, '', 'Transferred', '2024-05-11 22:58:51', '2024-05-11 22:58:51', '0000-00-00 00:00:00'),
(9, 6, 20, 12, 3, '2024-05-10', 'PAR-002', 1, 0, '', 'Transferred', '2024-05-11 22:59:26', '2024-05-11 22:59:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Unit', '2024-04-13 22:05:34', '2024-04-13 22:05:34', '0000-00-00 00:00:00'),
(2, 'Sets', '2024-04-13 22:05:47', '2024-04-13 22:14:28', '0000-00-00 00:00:00'),
(3, 'Pcs', '2024-04-13 22:05:59', '2024-04-13 22:15:36', '0000-00-00 00:00:00'),
(4, 'Copy', '2024-04-13 22:06:05', '2024-04-13 22:06:05', '0000-00-00 00:00:00'),
(5, 'Pack', '2024-04-14 14:48:19', '2024-04-14 14:48:19', '0000-00-00 00:00:00'),
(6, 'Ream', '2024-04-14 14:48:24', '2024-04-14 14:48:24', '0000-00-00 00:00:00'),
(7, 'Roll', '2024-04-14 14:48:30', '2024-04-14 14:48:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ruel', 'Ruel Erida', '$2y$15$VxMXfPB29EhYXkA67q2ATehOmTlGJo7RsX.ij1OqjkWTtbt7YM16.', '2024-03-01 00:00:00', '2024-03-01 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracker`
--
ALTER TABLE `tracker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tracker`
--
ALTER TABLE `tracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
