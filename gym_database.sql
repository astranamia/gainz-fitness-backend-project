-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2026 at 02:41 PM
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
-- Database: `gym_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceStatus` varchar(50) NOT NULL,
  `AttendanceInfo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceStatus`, `AttendanceInfo`) VALUES
('ABSENT', 'Absent From Workout Schedule'),
('ATTENDED', 'Attended Workout Schedule'),
('PENDING', 'Pending Workout Schedule');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `MembershipType` varchar(50) NOT NULL,
  `MembershipDesc` varchar(50) NOT NULL,
  `MembershipRateMonthly` decimal(10,2) NOT NULL,
  `MembershipRateYearly` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`MembershipType`, `MembershipDesc`, `MembershipRateMonthly`, `MembershipRateYearly`) VALUES
('BASIC', 'Basic Package', 1000.00, 800.00),
('MID', 'Mid Package', 1300.00, 1000.00),
('PRO', 'Pro Package', 1800.00, 1500.00);

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `SpecType` varchar(50) NOT NULL,
  `SpecDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`SpecType`, `SpecDesc`) VALUES
('STRENGTH', 'Strength Coach');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `TrainerID` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `SpecializationType` varchar(50) NOT NULL,
  `RatePerHour` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`TrainerID`, `LastName`, `FirstName`, `SpecializationType`, `RatePerHour`) VALUES
(1, 'Ramos', 'Leonard', 'STRENGTH', 300.00),
(2, 'Cruz', 'Jean', 'STRENGTH', 300.00),
(3, 'Dela Cruz', 'Leon', 'STRENGTH', 300.00),
(4, 'Jugo', 'Jin', 'STRENGTH', 300.00),
(5, 'Pasana', 'Jillion', 'STRENGTH', 300.00),
(6, 'Bautista', 'Lij', 'STRENGTH', 300.00),
(7, 'Isla', 'Jeo', 'STRENGTH', 300.00),
(8, 'Pabuna', 'Prins', 'STRENGTH', 300.00),
(9, 'Lopez', 'Liam', 'STRENGTH', 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `UserAge` int(11) NOT NULL,
  `UserGender` varchar(1) NOT NULL,
  `UserWeight` decimal(10,2) NOT NULL,
  `UserHeight` decimal(10,2) NOT NULL,
  `MembershipType` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserPassword_hash` varchar(255) NOT NULL,
  `UserPhoneNo` varchar(50) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `LastName`, `FirstName`, `UserAge`, `UserGender`, `UserWeight`, `UserHeight`, `MembershipType`, `UserEmail`, `UserPassword_hash`, `UserPhoneNo`, `RegistrationDate`, `isAdmin`) VALUES
(1, 'Dela Cruz', 'Wally', 21, 'M', 70.00, 140.00, 'BASIC', 'juandelacruz@gmail.com', '$2y$10$hRxvEcLCGwVg8T8.EiEV0uxiwlAGdgdwIxe6zTWAKcMvNLdB285.u', '09911234567', '2026-11-13 12:39:08', 0),
(2, 'Ibarra', 'Cristososmo', 30, 'M', 80.00, 158.00, 'PRO', 'cristoibarra@gmail.com', '$2y$10$fcugKe/0xePPUgwOLn1INuHl3rYYvBQ2lMHApDV2Y2alKrKPmAQqe', '09918837462', '2026-11-13 12:40:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `workoutschedule`
--

CREATE TABLE `workoutschedule` (
  `ScheduleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TrainerID` int(11) NOT NULL,
  `ScheduleStart` datetime NOT NULL,
  `ScheduleEnd` datetime NOT NULL,
  `AttendanceStatus` varchar(50) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workoutschedule`
--

INSERT INTO `workoutschedule` (`ScheduleID`, `UserID`, `TrainerID`, `ScheduleStart`, `ScheduleEnd`, `AttendanceStatus`) VALUES
(1, 1, 3, '2026-11-15 08:00:00', '2026-11-15 10:00:00', 'PENDING');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceStatus`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`MembershipType`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`SpecType`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`TrainerID`),
  ADD KEY `fk_specialization` (`SpecializationType`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`),
  ADD UNIQUE KEY `UserPhoneNo` (`UserPhoneNo`),
  ADD KEY `MembershipType` (`MembershipType`);

--
-- Indexes for table `workoutschedule`
--
ALTER TABLE `workoutschedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `fk_user_schedule` (`UserID`),
  ADD KEY `fk_trainer_schedule` (`TrainerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `TrainerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workoutschedule`
--
ALTER TABLE `workoutschedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trainer`
--
ALTER TABLE `trainer`
  ADD CONSTRAINT `fk_specialization` FOREIGN KEY (`SpecializationType`) REFERENCES `specialization` (`SpecType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_membershiptype` FOREIGN KEY (`MembershipType`) REFERENCES `membership` (`MembershipType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workoutschedule`
--
ALTER TABLE `workoutschedule`
  ADD CONSTRAINT `fk_trainer_schedule` FOREIGN KEY (`TrainerID`) REFERENCES `trainer` (`TrainerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_schedule` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
