-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 10:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ict_service_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type_of_service` varchar(255) DEFAULT NULL,
  `service_details` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user`, `description`, `status`, `created_at`, `type_of_service`, `service_details`, `remarks`, `last_updated`) VALUES
(1, 'test.08.29.2024', '', 'In Progress', '2024-08-29 00:51:14', 'Email Reset', 'Reset Options: Microsoft 365 | DepED email for Reset: check@deped.gov.ph | SchoolID: SDO | Personal Email: check@gmail.com', 'Forgot password', '2024-08-30 05:52:58'),
(2, 'test.08.29.2024', '', 'Pending', '2024-08-29 00:52:43', 'Email Creation', 'Creation Options: Google Workplace and Microsoft 365 | Employee Name: Adrian Emmanuel G. Nueva  | SchoolID: 107944 | Plantilla Position: ICT I | Personal Email: check@gmail.com | Personal Number: 09167008097', 'not a DepED personel so cancel request', '2024-08-30 05:52:15'),
(3, 'test.08.29.2024', '', 'Pending', '2024-08-29 00:53:01', 'ICT', 'Computer Software Maintenance | Software Issue: software update', 'OS not installing, \r\nloading for more 1 week\r\nDel OS, sir matt\r\n', '2024-08-30 05:51:36'),
(4, 'test.08.29.2024', '', 'For CO Action', '2024-08-29 00:53:41', 'ICT', 'Computer Hardware Maintenance | Hardware Issue: Solid State Drive change ', 'parcel out for delivery', '2024-08-30 05:50:22'),
(5, 'test.08.29.2024', '', 'In Progress', '2024-08-29 00:55:52', 'ICT', 'Creation of IEC Materials | Format: Picture | Title: Presentation of Division ICT service request | Further details: Graphics ', 'Waiting for presentation', '2024-08-30 05:49:50'),
(6, 'test.08.29.2024', '', 'For RO Action', '2024-08-29 00:56:30', 'ICT', 'Printer Maintenance | Maker and Model: Brother DCP-T720DW | Issue: Magenta ', 'Fake Ink', '2024-08-30 05:53:21'),
(7, 'test16.8.2024', '', 'Completed', '2024-08-29 00:59:13', 'ICT', 'Technical Assistance | Venue: Onsite | Dates: 8/29/2024 | Duration: 8:00AM-5:00PM | Location: Conference Room 1, Division of General Trias City, Cavite\r\n ', 'good food', '2024-08-30 05:49:23'),
(8, 'test.08.29.2024', '', 'In Progress', '2024-08-29 00:59:52', 'ICT', 'Send documents to Official Email | Recipient email: check@gmail.com | Document for Sending: 01 BACKDROP.jpg', '', '2024-08-30 08:00:07'),
(21, 'Ma\'am Camille', '', 'Completed', '2024-08-30 05:40:49', 'ICT', 'Printer Maintenance | Maker and Model: Epson L3120 | Issue: Certification ', 'all good', '2024-08-30 05:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'admin', 'dc3565645d8002becb5fd7977aeef3e1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
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
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
