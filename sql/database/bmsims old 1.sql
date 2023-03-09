-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 02:56 PM
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
  `acc_id` text NOT NULL,
  `fullname` text NOT NULL,
  `event_title` text NOT NULL,
  `date_config` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs_programs`
--

INSERT INTO `tbl_logs_programs` (`log_id`, `acc_id`, `fullname`, `event_title`, `date_config`, `status`) VALUES
(1, '1', 'Administrator', 'Basketball', '2023-02-06', 'Added');

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
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_programs`
--

INSERT INTO `tbl_programs` (`program_id`, `event_title`, `event_datetime`, `place`, `description`) VALUES
(1, 'Basketball', '2023-02-27', 'Matain Court', 'Basketball league');

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
(13, 'denverkun', 'Denverson', 'Falcon', 'Caacbay', 'Male', 'Quezon City', '2000-06-09', 'Single', '#0494 National High Way, Matain, Subic, Zambales', '4', 'denverkunfalcon@gmail.com', '09496329271', '$2y$10$.CP4JL8p2cWS6V2G15j1k.XXily2SJXxQJB3mNni7J5CEnaPYCNlG'),
(14, 'badette', 'Bernadette', 'Falcon', 'Caacbay', 'Female', 'San Marcelino Zambales', '2001-07-05', 'Single', '#0494 National High-Way Matain, Subic, Zambales', '4', 'bernadettecaacbay@gmail.com', '09508482090', '$2y$10$xCihuh8nrakHKd1PVxp0W.sJsR7E4apZ.Q4XHiqjlrKWOQ5BJHLji'),
(15, 'Rjhay', 'Rjhay', 'Yap', 'Sazon', 'Male', 'San Marcelino Zambales', '2006-01-19', 'Single', '#0494 National High-Way Matain, Subic, Zambales', '4', 'jhaysazon@gmail.com', '09496329271', '$2y$10$O0AbJ3KaoBOGUkp7Gp7ro.Gy3oCTzpPSF5EDHmfTJsR4vV5KkPvYG'),
(16, 'berma', 'Berma', 'Falcon', 'Caacbay', 'Female', 'Zambales', '1968-09-22', 'Married', '#0494 National High-Way Matain,  Subic, Zambales', '4', 'bermacaacbay@gmail.com', '09193101414', '$2y$10$5jcTtsxryG5SGwqNB/zqg.jVKyrlbDcYJ/b.PGapEmZCGNpu15KEq'),
(17, 'Oswaldo', 'Oswaldo', 'Garon', 'Caacbay', 'Male', 'Pampanga', '1974-05-31', 'Married', '#0494 National High Way Matain, Subic, Zambales', '4', 'oswaldo@gmail.com', '09193101414', '$2y$10$faHsJyP4SMUwPE6AkzN18eia/FNes02G8btroSNYbo.YICqgC7o.a'),
(27, 'pau', 'Paulo', 'Dela Cruz', 'Luces', 'Male', 'Zambales', '2000-09-13', 'Single', 'Sample Only', '4', 'pau@gmail.com', '09123456789', '$2y$10$wOf.QNOs4V.OFh5GpyBsNOB0r6M8dB6qmvUP5lr17k6SmnMkbCBXG');

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
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_logs_request`
--
ALTER TABLE `tbl_logs_request`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_logs_resident`
--
ALTER TABLE `tbl_logs_resident`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
