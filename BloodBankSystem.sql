-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 28, 2019 at 01:30 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BloodBankSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `BANKS`
--

CREATE TABLE `BANKS` (
  `BCODE` int(11) NOT NULL,
  `NAME` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `LOCATION` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `NO_OF(A)` int(50) DEFAULT NULL,
  `NO_OF(B)` int(50) DEFAULT NULL,
  `NO_OF(AB)` int(50) DEFAULT NULL,
  `NO_OF(O)` int(50) DEFAULT NULL,
  `NO_OF(-O)` int(50) DEFAULT NULL,
  `NO_OF(-A)` int(50) DEFAULT NULL,
  `NO_OF(-B)` int(50) DEFAULT NULL,
  `NO_OF(-AB)` int(50) DEFAULT NULL,
  `Supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BANKS`
--

INSERT INTO `BANKS` (`BCODE`, `NAME`, `LOCATION`, `NO_OF(A)`, `NO_OF(B)`, `NO_OF(AB)`, `NO_OF(O)`, `NO_OF(-O)`, `NO_OF(-A)`, `NO_OF(-B)`, `NO_OF(-AB)`, `Supplier`) VALUES
(123, 'Helal', 'shobra', 101, 103, 201, 100, 10, 90, 50, 8, 123),
(125, 'Egyptian Red Crescent', 'EL AZBAKEYA', 7, 2, 6, 140, 5, 50, 4, 15, 123),
(167, 'Salam', 'Salam', 67, 12, 60, 14, 3, 12, 44, 55, 123),
(789, 'National Blood Transfusion Center', 'Wezaret Zra3a', 71, 22, 46, 14, 100, 12, 40, 105, 123);

-- --------------------------------------------------------

--
-- Table structure for table `Donation`
--

CREATE TABLE `Donation` (
  `Bag_Number` int(11) NOT NULL,
  `DSSN` int(50) DEFAULT NULL,
  `Bankcode` int(50) DEFAULT NULL,
  `Donation_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Blood_Type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `HIV` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `C` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Accepted_or_not` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Donation`
--

INSERT INTO `Donation` (`Bag_Number`, `DSSN`, `Bankcode`, `Donation_Date`, `Blood_Type`, `HIV`, `C`, `Accepted_or_not`) VALUES
(1, 2147483647, 123, '2019-01-28 12:18:36', 'A+', 'false', 'false', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `Donors`
--

CREATE TABLE `Donors` (
  `SSN` int(250) NOT NULL,
  `FNAME` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `FATHERNAME` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `LNAME` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `BLOOD_TYPE` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `ADDRESS` varchar(250) CHARACTER SET utf16 DEFAULT NULL,
  `PHONE` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donors`
--

INSERT INTO `Donors` (`SSN`, `FNAME`, `FATHERNAME`, `LNAME`, `BLOOD_TYPE`, `ADDRESS`, `PHONE`) VALUES
(2147483647, 'Habiba', 'Ahmed', 'Shara', 'A+', 'Manial', '01151280909');

-- --------------------------------------------------------

--
-- Table structure for table `Hospital`
--

CREATE TABLE `Hospital` (
  `Hcode` int(50) NOT NULL,
  `Bankcode` int(50) DEFAULT NULL,
  `Name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Hospital`
--

INSERT INTO `Hospital` (`Hcode`, `Bankcode`, `Name`, `Location`, `Phone`) VALUES
(23, 123, 'HelalHospital', 'shobra', '0223564898'),
(55, 125, 'ERD', 'Azbakya', '0223417990');

-- --------------------------------------------------------

--
-- Table structure for table `Issuning`
--

CREATE TABLE `Issuning` (
  `Exchange_Code` int(11) NOT NULL,
  `BankCode` int(11) DEFAULT NULL,
  `HospitalCode` int(11) DEFAULT NULL,
  `Exchange_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `No_of_Bags` int(50) DEFAULT NULL,
  `Blood_Type` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Issuning`
--

INSERT INTO `Issuning` (`Exchange_Code`, `BankCode`, `HospitalCode`, `Exchange_Date`, `No_of_Bags`, `Blood_Type`) VALUES
(1, 789, 55, '2019-01-28 11:57:15', 100, 'O-'),
(2, 789, 55, '2019-01-28 11:57:15', 100, 'O-'),
(3, 789, 55, '2019-01-28 11:57:15', 100, 'O-'),
(4, 123, 55, '0000-00-00 00:00:00', 30, 'O-'),
(5, 125, 55, '0000-00-00 00:00:00', 20, 'O-'),
(6, 789, 55, '0000-00-00 00:00:00', 100, 'O-'),
(7, 789, 55, '0000-00-00 00:00:00', 100, 'O-'),
(8, 123, 55, '0000-00-00 00:00:00', 31, 'O-'),
(9, 125, 55, '0000-00-00 00:00:00', 25, 'O-'),
(10, 125, 55, '0000-00-00 00:00:00', 2, 'A-'),
(11, 125, 55, '2019-01-28 12:14:59', 50, 'A-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BANKS`
--
ALTER TABLE `BANKS`
  ADD PRIMARY KEY (`BCODE`),
  ADD KEY `Supplier` (`Supplier`);

--
-- Indexes for table `Donation`
--
ALTER TABLE `Donation`
  ADD PRIMARY KEY (`Bag_Number`),
  ADD KEY `DSSN` (`DSSN`),
  ADD KEY `Bankcode` (`Bankcode`);

--
-- Indexes for table `Donors`
--
ALTER TABLE `Donors`
  ADD PRIMARY KEY (`SSN`);

--
-- Indexes for table `Hospital`
--
ALTER TABLE `Hospital`
  ADD PRIMARY KEY (`Hcode`),
  ADD KEY `Bankcode` (`Bankcode`);

--
-- Indexes for table `Issuning`
--
ALTER TABLE `Issuning`
  ADD PRIMARY KEY (`Exchange_Code`),
  ADD KEY `Issuning_ibfk_1` (`BankCode`),
  ADD KEY `Issuning_ibfk_2` (`HospitalCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Donation`
--
ALTER TABLE `Donation`
  MODIFY `Bag_Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Issuning`
--
ALTER TABLE `Issuning`
  MODIFY `Exchange_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BANKS`
--
ALTER TABLE `BANKS`
  ADD CONSTRAINT `BANKS_ibfk_1` FOREIGN KEY (`Supplier`) REFERENCES `BANKS` (`BCODE`) ON UPDATE CASCADE;

--
-- Constraints for table `Donation`
--
ALTER TABLE `Donation`
  ADD CONSTRAINT `Donation_ibfk_1` FOREIGN KEY (`DSSN`) REFERENCES `Donors` (`SSN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Donation_ibfk_2` FOREIGN KEY (`Bankcode`) REFERENCES `BANKS` (`BCODE`) ON UPDATE CASCADE;

--
-- Constraints for table `Hospital`
--
ALTER TABLE `Hospital`
  ADD CONSTRAINT `Hospital_ibfk_1` FOREIGN KEY (`Bankcode`) REFERENCES `BANKS` (`BCODE`) ON UPDATE CASCADE;

--
-- Constraints for table `Issuning`
--
ALTER TABLE `Issuning`
  ADD CONSTRAINT `Issuning_ibfk_1` FOREIGN KEY (`BankCode`) REFERENCES `BANKS` (`BCODE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Issuning_ibfk_2` FOREIGN KEY (`HospitalCode`) REFERENCES `Hospital` (`Hcode`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
