-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 11:31 AM
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
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', '123456', '04-09-2021 05:28:27 PM');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `apid` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `nights` int(255) NOT NULL,
  `remind` int(100) DEFAULT 0,
  `check_in` date DEFAULT current_timestamp(),
  `check_out` date DEFAULT NULL,
  `employId` int(11) NOT NULL,
  `paid` int(50) DEFAULT NULL,
  `commnet` varchar(150) DEFAULT NULL,
  `employname` varchar(150) DEFAULT 'Patient',
  `Price` int(100) DEFAULT NULL,
  `client_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `apstatue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`apid`, `doctorSpecialization`, `doctorId`, `userId`, `nights`, `remind`, `check_in`, `check_out`, `employId`, `paid`, `commnet`, `employname`, `Price`, `client_name`, `client_phone`, `client_id`, `apstatue`) VALUES
(331, 'Single', 42, 0, 1, 0, '2024-07-31', '2024-08-01', 9, 500, '', 'User', 500, 'zeyad, , ', '123, , ', '84512, , ', 0),
(332, 'Single', 13, 0, 2, 0, '2024-07-31', '2024-08-02', 9, 1000, '', 'User', 500, 'zeyad, , ', '5412, , ', '2468, , ', 0),
(333, 'Single', 42, 0, 4, 0, '2024-07-31', '2024-08-04', 9, 1900, '', 'User', 500, 'qwfse, , ', '486512, , ', '9846512, , ', 0),
(334, 'Single', 42, 0, 1, 0, '2024-07-31', '2024-08-01', 9, 500, '', 'User', 500, 'Youssef, , ', '123, , ', '84512, , ', 0),
(335, 'Single', 42, 0, 2, 0, '2024-07-31', '2024-08-02', 9, 1000, '', 'User', 500, 'qwfse, , ', '5412, , ', '321, , ', 0),
(336, 'Single', 13, 0, 1, 0, '2024-07-31', '2024-08-01', 9, 500, '', 'User', 500, 'qwfse, , ', '5412, , ', '84512, , ', 0),
(337, 'Single', 42, 0, 1, 0, '2024-07-31', '2024-08-01', 9, 500, '', 'User', 500, 'Youssef, , ', '5412, , ', '1912, , ', 0),
(338, 'Single', 42, 0, 1, 0, '2024-07-31', '2024-08-01', 9, 500, '', 'User', 500, 'zeyad, , ', '486512, , ', '64512, , ', 0),
(339, 'Single', 42, 0, 2, 0, '2024-08-10', '2024-08-12', 9, 1000, '', 'User', 500, 'Youssef, , ', '486512, , ', '64512, , ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `doctorName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `statue` int(11) DEFAULT 0,
  `idap` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `docFees`, `statue`, `idap`) VALUES
(11, 'Triple', '1245', '2000', 0, 0),
(13, 'Single', '2547', '500', 0, 0),
(14, 'Double', '1025', '1020', 0, 0),
(42, 'Single', '1915', '500', 0, 0),
(45, 'Double', '9874', '1020', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(17, 'Single', '2021-09-04 12:21:30', NULL),
(19, 'Double', '2021-09-04 12:22:00', NULL),
(20, 'Triple', '2021-09-04 12:22:15', '2024-07-05 20:05:52'),
(39, 'Full Services', '2024-07-10 16:29:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employ`
--

CREATE TABLE `employ` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` date DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `employ_statue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employ`
--

INSERT INTO `employ` (`id`, `username`, `email`, `password`, `regdate`, `updationDate`, `role`, `employ_statue`) VALUES
(1, 'Zeyad Yaser', 'zeyad@z.com', '123456', '2024-05-19 11:32:15', '2024-08-01', 'System Admin', 1),
(9, 'User', 'user1@z.z', '123456', '2024-05-31 13:37:32', '2024-07-31', 'User', 1),
(17, 'Yassser', 'Yasser@z.z', '123456', '2024-07-31 20:45:46', '2024-08-01', 'User', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`apid`),
  ADD KEY `employId` (`employId`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employ`
--
ALTER TABLE `employ`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `apid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `employ`
--
ALTER TABLE `employ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
