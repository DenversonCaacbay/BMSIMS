-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2023 at 04:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmsims`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(20) NOT NULL,
  `username` text NOT NULL,
  `fullname` text NOT NULL,
  `password` text NOT NULL,
  `admin_power` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `username`, `fullname`, `password`, `admin_power`) VALUES
(1, 'admin', 'Administrator', '$2y$10$.MMi0dMVx03tNjvNXFrK2OsZ2DDgfynhgTz0LjZNX9Db/WG5FWySi', 1),
(2, 'Leo', 'Leo Angelo Novo', '$2y$10$4.nv8qatp9Sjm.t8bkXjj.MBUf6x7egYfDJYedq3dAhYWZAxPubbC', 0),
(3, 'Jane', 'Mary Jane Agabon', '$2y$10$UaMF/T2ePeSoQ4/bwJfH7./HHjK652mI0mik3TfsQiZIkL1gJvP86', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs_official`
--

CREATE TABLE `tbl_logs_official` (
  `log_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `staff` text NOT NULL,
  `position` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `date_config` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs_official`
--

INSERT INTO `tbl_logs_official` (`log_id`, `acc_id`, `staff`, `position`, `firstname`, `middlename`, `lastname`, `date_config`, `status`) VALUES
(1, 1, 'Administrator', 'Punong Barangay', 'Mario', 'G.', 'Balboa', '2023-02-03', 'Added'),
(2, 1, 'Administrator', 'Kagawad on Public Works & Infrastracture / Kids & Awards', 'Julius Cesar', 'C. ', 'Artagame', '2023-02-03', 'Added'),
(3, 1, 'Administrator', 'Kagawad on Education & Public Information Women & Family', 'Ferdinand', 'B.', 'Castillo', '2023-02-03', 'Added'),
(4, 1, 'Administrator', 'Kagawad on Ethics / Barangay Affairs / Human Rights and Legal Matters', 'Jean', 'F.', 'Gaylan', '2023-02-03', 'Added'),
(5, 1, 'Administrator', 'Kagawad Committee on Peace & Order', 'Oliveros', 'P.', 'Munoz', '2023-02-03', 'Added'),
(6, 1, 'Administrator', 'Kagawad Committee on Trades and Industry / Sports', 'Arturo', 'S.', 'Dela Cruz', '2023-02-03', 'Added'),
(7, 1, 'Administrator', 'Kagawad on Committee on Appropriation', 'Joan', 'B.', 'Bodota', '2023-02-03', 'Added'),
(8, 1, 'Administrator', 'Kagawad on Committee on Health & Sanitation / Environment Protection', 'Mylene', 'L.', 'Estrella', '2023-02-03', 'Added'),
(9, 1, 'Administrator', 'Barangay Secretary', 'Leo Angelo', 'E. ', 'Novo', '2023-02-03', 'Added'),
(10, 1, 'Administrator', 'Barangay Assistant Secretary', 'Mary Jane', ' ', 'Agabon', '2023-02-03', 'Added'),
(11, 1, 'Administrator', 'Barangay SK Chairperson', 'Ivygay', 'B. ', 'Espiritu', '2023-02-03', 'Added'),
(12, 1, 'Administrator', 'Barangay Treasurer', 'Marites', 'F. ', 'Sahagun', '2023-02-03', 'Added');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs_programs`
--

CREATE TABLE `tbl_logs_programs` (
  `log_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `event_title` text NOT NULL,
  `date_config` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs_request`
--

CREATE TABLE `tbl_logs_request` (
  `log_id` int(11) NOT NULL,
  `staff` text NOT NULL,
  `req_id` text NOT NULL,
  `tracking_id` text NOT NULL,
  `req_date` text NOT NULL,
  `fullname` text NOT NULL,
  `request_type` text NOT NULL,
  `purpose` text NOT NULL,
  `date_open` text NOT NULL,
  `date_close` text NOT NULL,
  `get_date` text NOT NULL,
  `payment_method` text NOT NULL,
  `reference_no` text NOT NULL,
  `amount` text NOT NULL,
  `date_paid` text NOT NULL,
  `payment_status` text NOT NULL,
  `request_status` text NOT NULL,
  `username` text NOT NULL,
  `date_config` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs_request`
--

INSERT INTO `tbl_logs_request` (`log_id`, `staff`, `req_id`, `tracking_id`, `req_date`, `fullname`, `request_type`, `purpose`, `date_open`, `date_close`, `get_date`, `payment_method`, `reference_no`, `amount`, `date_paid`, `payment_status`, `request_status`, `username`, `date_config`, `status`) VALUES
(1, 'Leo Angelo Novo', '5', '1SV7QONMAZ', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay Clearance', 'for work', 'None', 'None', 'Wednesday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun', '2023-02-04', 'Updated'),
(2, 'Leo Angelo Novo', '5', '1SV7QONMAZ', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay Clearance', 'for work', 'None', 'None', 'Wednesday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun', '2023-02-04', 'Deleted'),
(3, 'Leo Angelo Novo', '13', 'SEA86NGQZH', '2023-02-04', 'Denverson Falcon Caacbay', 'Residency', 'None', 'None', 'None', 'Wednesday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun', '2023-02-04', 'Updated');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs_resident`
--

CREATE TABLE `tbl_logs_resident` (
  `log_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `staff` text NOT NULL,
  `username` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `gender` text NOT NULL,
  `place_of_birth` text NOT NULL,
  `bdate` text NOT NULL,
  `civil_status` text NOT NULL,
  `address` text NOT NULL,
  `purok` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `date_config` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs_resident`
--

INSERT INTO `tbl_logs_resident` (`log_id`, `acc_id`, `staff`, `username`, `firstname`, `middlename`, `lastname`, `gender`, `place_of_birth`, `bdate`, `civil_status`, `address`, `purok`, `email`, `phone`, `password`, `date_config`, `status`) VALUES
(1, 25, 'Denverson Caacbay', 'pedro', 'Pedro', 'Pen', 'Duko', 'Male', 'Zambales', '2023-01-24', 'Single', '#0494 Matain Subic Zambles', '4', 'pedro@gmail.com', '09123456789', '$2y$10$DjkjESmtepiC6tdWHwncfOEbadEUO94H9qSsX8nGSkhTGdeB/HhVW', '2023-01-23', 'Added'),
(2, 25, 'Denverson Caacbay', 'susan', 'Susan', 'wala', 'Santon', 'Female', 'Olongapo City', '2000-09-12', 'Single', '4th floor sample building Matain Subic Zambales', '4', 'susan@gmail.com', '09123456789', '$2y$10$1KQq6JKOBMFw6i65qxdhzeAjwqD8dvFPKOrI4QVcBc7KVSJxAQCwq', '2023-01-23', 'Added'),
(3, 25, 'Denverson Caacbay', 'Juan', 'Juan', 'Dela', 'Cruz', 'Male', 'Olongapo Hospital', '2000-09-22', 'Single', '0923 Sample Matain Subic Zambales', '4', 'juan@gmail.com', '09123456789', 'pass123', '2023-01-23', 'Added'),
(4, 1, 'Administrator', 'Juan', 'Juan', 'Dela', 'Cruz', 'Male', 'Olongapo Hospital', '2000-09-22', 'Single', '0923 Sample Matain Subic Zambales', '4', 'juan@gmail.com', '09123456789', '', '2023-01-24', 'Deleted'),
(5, 1, 'Administrator', 'yru', 'Ronnie', ' ', 'lUY', 'Male', 'SSSD', '3433-03-04', 'Single', 'SSDSADS', '4', 'yru@gmail.com', '0912345678', '', '2023-01-24', 'Deleted'),
(6, 1, 'Administrator', 'jhay', 'Rjhay', 'Yap', 'Sazon', 'Male', 'Zambales', '20222-01-15', 'Single', '#0494 Matain, Subic, Zambales', '4', 'jhay@gmail.com', '09123456789', '', '2023-01-24', 'Deleted'),
(7, 1, 'Administrator', 'Badette', 'Bernadette', 'Falcon', 'Caacbay', 'Female', 'Zambales', '2001-07-05', 'Single', '#0494 Matain, Subic, Zambales', '4', 'badette@gmail.com', '09508482090', '$2y$10$q82GPb/t66MRkFiajyQ8yej5aushiyVm8xAyv.eOcQHE8CjZ/iRku', '2023-01-24', 'Deleted'),
(8, 1, 'Administrator', 'denver', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 Matain Subic Zambales', '4', 'denverkunfalcon@gmail.com', '09496329271', '$2y$10$VZZMKILhh.qgy9gCmY.4uuFlLLZNql0WnxABCtbL8GW2vja3wDZA.', '2023-01-24', 'Deleted'),
(12, 25, 'Denverson Caacbay', 'denver', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 Matain Subic Zambaes', '4', 'denver@gmail.com', '09123456789', 'pass123', '2023-01-24', 'Added'),
(13, 1, 'Administrator', 'denver', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 Matain Subic Zambaes', '4', 'denver@gmail.com', '09123456789', '1234', '2023-01-24', 'Update'),
(14, 1, 'Administrator', 'denver', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 Matain Subic Zambaes', '4', 'denver@gmail.com', '09123456789', '1234', '2023-01-24', 'Update'),
(15, 1, 'Administrator', 'denver', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 Matain Subic Zambaes', '4', 'denver@gmail.com', '09123456789', 'denverkun0913', '2023-01-30', 'Update'),
(16, 1, 'Administrator', 'denver', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 Matain Subic Zambaes', '4', 'denver@gmail.com', '09123456789', '$2y$10$tyU2tlIGkSTiOiMdpLpnZOYSyV14u6Vt5BM7Aaho3gYo.y96wy8Di', '2023-02-03', 'Deleted'),
(17, 1, 'Administrator', 'berma', 'Berma', 'Falcon', 'Caacbay', 'Female', 'Zambales', '1968-09-22', 'Marrieed', '#0494 National High-Way Matain,  Subic, Zambales', '4', 'bermacaacbay@gmail.com', '09193101414', 'pass123', '2023-02-03', 'Added');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs_sample`
--

CREATE TABLE `tbl_logs_sample` (
  `log_id` int(11) NOT NULL,
  `staff` text NOT NULL,
  `req_id` text NOT NULL,
  `tracking_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs_sample`
--

INSERT INTO `tbl_logs_sample` (`log_id`, `staff`, `req_id`, `tracking_id`) VALUES
(1, 'Leo Angelo Novo', '7', 'T7F1IJX3NA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs_staff`
--

CREATE TABLE `tbl_logs_staff` (
  `log_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `staff` text NOT NULL,
  `username` text NOT NULL,
  `fullname` text NOT NULL,
  `password` text NOT NULL,
  `date_config` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs_staff`
--

INSERT INTO `tbl_logs_staff` (`log_id`, `acc_id`, `staff`, `username`, `fullname`, `password`, `date_config`, `status`) VALUES
(1, 1, 'Administrator', 'Leo', 'Leo Angelo Novo', '$2y$10$N/.HPccTpT2yyS5PHXCIA.TuMpRZWa9vyjymG7oySrrqTx6wVarve', '2023-02-03', 'Added'),
(2, 1, 'Administrator', 'Jane', 'Mary Jane Agabon', '$2y$10$ZnSDECPufaRlppl1Dq2QquryaKqMQ34hppgH6PNLkRjMWAyGlWXZ6', '2023-02-03', 'Added');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_officials`
--

CREATE TABLE `tbl_officials` (
  `official_id` int(11) NOT NULL,
  `position` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_officials`
--

INSERT INTO `tbl_officials` (`official_id`, `position`, `firstname`, `middlename`, `lastname`) VALUES
(1, 'Punong Barangay', 'Mario', 'G.', 'Balboa'),
(2, 'Kagawad on Public Works & Infrastracture / Kids & Awards', 'Julius Cesar', 'C. ', 'Artagame'),
(3, 'Kagawad on Education & Public Information Women & Family', 'Ferdinand', 'B.', 'Castillo'),
(4, 'Kagawad on Ethics / Barangay Affairs / Human Rights and Legal Matters', 'Jean', 'F.', 'Gaylan'),
(5, 'Kagawad Committee on Peace & Order', 'Oliveros', 'P.', 'Munoz'),
(6, 'Kagawad Committee on Trades and Industry / Sports', 'Arturo', 'S.', 'Dela Cruz'),
(7, 'Kagawad on Committee on Appropriation', 'Joan', 'B.', 'Bodota'),
(8, 'Kagawad on Committee on Health & Sanitation / Environment Protection', 'Mylene', 'L.', 'Estrella'),
(9, 'Barangay Secretary', 'Leo Angelo', 'E. ', 'Novo'),
(10, 'Barangay Assistant Secretary', 'Mary Jane', ' ', 'Agabon'),
(11, 'Barangay SK Chairperson', 'Ivygay', 'B. ', 'Espiritu'),
(12, 'Barangay Treasurer', 'Marites', 'F. ', 'Sahagun');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programs`
--

CREATE TABLE `tbl_programs` (
  `program_id` int(11) NOT NULL,
  `event_title` text NOT NULL,
  `event_datetime` text NOT NULL,
  `place` text NOT NULL,
  `description` text NOT NULL,
  `remove` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_programs`
--

INSERT INTO `tbl_programs` (`program_id`, `event_title`, `event_datetime`, `place`, `description`, `remove`) VALUES
(1, 'sdsd', '0002-02-03', 'dfdfdf', 'dfsdsd', 0),
(2, 'Basketball', '2023-09-12', 'Matain Court', 'Basketball League', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `req_id` int(11) NOT NULL,
  `tracking_id` text NOT NULL,
  `req_date` text NOT NULL,
  `fullname` text NOT NULL,
  `request_type` text NOT NULL,
  `purpose` text NOT NULL,
  `date_open` text NOT NULL,
  `date_close` text NOT NULL,
  `get_date` text NOT NULL,
  `payment_method` text NOT NULL,
  `reference_no` text NOT NULL,
  `amount` text NOT NULL,
  `date_paid` text NOT NULL,
  `payment_status` text NOT NULL,
  `request_status` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`req_id`, `tracking_id`, `req_date`, `fullname`, `request_type`, `purpose`, `date_open`, `date_close`, `get_date`, `payment_method`, `reference_no`, `amount`, `date_paid`, `payment_status`, `request_status`, `username`) VALUES
(3, 'MVX3YT7R9Q', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay ID', 'None', 'None', 'None', 'Monday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(4, 'VZIS527WF8', '2023-02-04', 'Denverson Falcon Caacbay', 'Indigency', 'Financial', 'None', 'None', 'Tuesday', 'None', 'None', '0', 'None', 'None', 'Please Wait', 'denverkun'),
(6, '2JS6VHBTFW', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay Clearance', 'For School', 'None', 'None', 'Tuesday', 'Pick Up', 'None', '0', 'None', 'Checking', 'Please Wait', 'denverkun'),
(8, 'YQXMWHT0KG', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay ID', 'None', 'None', 'None', 'Monday', 'Pick Up', 'None', '0', 'None', 'Checking', 'Please Wait', 'denverkun'),
(9, 'RSP0M68VZ3', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay ID', 'None', 'None', 'None', 'Tuesday', 'Pick Up', 'None', '0', 'None', 'Checking', 'Please Wait', 'denverkun'),
(10, 'V49MB78F53', '2023-02-04', 'Denverson Falcon Caacbay', 'Indigency', 'Financial', 'None', 'None', 'Monday', 'None', 'None', '0', 'None', 'None', 'Please Wait', 'denverkun'),
(12, 'VZG41JW5PK', '2023-02-04', 'Denverson Falcon Caacbay', 'Residency', 'None', 'None', 'None', 'Tuesday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(13, 'SEA86NGQZH', '2023-02-04', 'Denverson Falcon Caacbay', 'Residency', 'None', 'None', 'None', 'Wednesday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(14, 'KEHVXI6NPO', '2023-02-04', 'Denverson Falcon Caacbay', 'Residency', 'None', 'None', 'None', 'Wednesday', 'Gcash2', '111111111111111111', '50', '2023-02-04', 'Checking', 'Please Wait', 'denverkun'),
(15, 'ZVE5CTMX6D', '2023-02-04', 'Denverson Falcon Caacbay', 'Business Closure', 'None', 'None', '2000-01-11', 'Wednesday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(16, 'X6K9JESOMF', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay ID', 'None', 'None', 'None', 'Tuesday', 'Gcash1', '222222222222222222', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(17, 'WVQY86LDBA', '2023-02-04', 'Denverson Falcon Caacbay', 'Business Permit', 'None', '11111-01-11', 'None', 'Tuesday', 'Pick Up', 'None', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(18, '86T0X21WNJ', '2023-02-04', 'Denverson Falcon Caacbay', 'Business Permit', 'None', '2111-02-22', 'None', 'Wednesday', 'Gcash4', '330333333', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(19, 'F7HVL8ZMI3', '2023-02-04', 'Denverson Falcon Caacbay', 'Business Closure', 'None', 'None', '2230-01-11', 'Monday', 'Gcash3', '122435345345345', '50', '2023-02-04', 'Paid', 'Approved', 'denverkun'),
(20, 'MZ8HRY7QU1', '2023-02-04', 'Denverson Falcon Caacbay', 'Barangay Clearance', 'For Work', 'None', 'None', 'Monday', 'Gcash', '1111111111', '50', '2023-02-04', 'Checking', 'Please Wait', 'denverkun');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `acc_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `gender` text NOT NULL,
  `place_of_birth` text NOT NULL,
  `bdate` text NOT NULL,
  `civil_status` text NOT NULL,
  `address` text NOT NULL,
  `purok` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`acc_id`, `username`, `firstname`, `middlename`, `lastname`, `gender`, `place_of_birth`, `bdate`, `civil_status`, `address`, `purok`, `email`, `phone`, `password`) VALUES
(13, 'denverkun', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 National High Way, Matain, Subic, Zambales', '4', 'denverkunfalcon@gmail.com', '09496329271', '$2y$10$KwrAvfxy0GEOx5qrcgJDaul1fnba1RMXF0qUVt6Gc9jmTu3yTubwa'),
(14, 'badette', 'Bernadette', 'Falcon', 'Caacbay', 'Female', 'San Marcelino Zambales', '2001-07-05', 'Single', '#0494 National High-Way Matain, Subic, Zambales', '4', 'bernadettecaacbay@gmail.com', '09508482090', '$2y$10$xCihuh8nrakHKd1PVxp0W.sJsR7E4apZ.Q4XHiqjlrKWOQ5BJHLji'),
(15, 'Rjhay', 'Rjhay', 'Yap', 'Sazon', 'Male', 'San Marcelino Zambales', '2006-01-19', 'Single', '#0494 National High-Way Matain, Subic, Zambales', '4', 'jhaysazon@gmail.com', '09496329271', '$2y$10$O0AbJ3KaoBOGUkp7Gp7ro.Gy3oCTzpPSF5EDHmfTJsR4vV5KkPvYG'),
(16, 'berma', 'Berma', 'Falcon', 'Caacbay', 'Female', 'Zambales', '1968-09-22', 'Marrieed', '#0494 National High-Way Matain,  Subic, Zambales', '4', 'bermacaacbay@gmail.com', '09193101414', '$2y$10$5jcTtsxryG5SGwqNB/zqg.jVKyrlbDcYJ/b.PGapEmZCGNpu15KEq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `tbl_logs_official`
--
ALTER TABLE `tbl_logs_official`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_logs_programs`
--
ALTER TABLE `tbl_logs_programs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_logs_request`
--
ALTER TABLE `tbl_logs_request`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_logs_resident`
--
ALTER TABLE `tbl_logs_resident`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_logs_sample`
--
ALTER TABLE `tbl_logs_sample`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_logs_staff`
--
ALTER TABLE `tbl_logs_staff`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_officials`
--
ALTER TABLE `tbl_officials`
  ADD PRIMARY KEY (`official_id`);

--
-- Indexes for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_logs_official`
--
ALTER TABLE `tbl_logs_official`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_logs_programs`
--
ALTER TABLE `tbl_logs_programs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_logs_request`
--
ALTER TABLE `tbl_logs_request`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_logs_resident`
--
ALTER TABLE `tbl_logs_resident`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_logs_sample`
--
ALTER TABLE `tbl_logs_sample`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_logs_staff`
--
ALTER TABLE `tbl_logs_staff`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_officials`
--
ALTER TABLE `tbl_officials`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
