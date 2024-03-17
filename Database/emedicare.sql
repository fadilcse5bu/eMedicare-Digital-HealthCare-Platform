-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 12:45 PM
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
-- Database: `emedicare`
--

-- --------------------------------------------------------

--
-- Table structure for table `advices`
--

CREATE TABLE `advices` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `prescriptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `doctorID` int(11) DEFAULT NULL,
  `patientID` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `serialNo` int(11) DEFAULT NULL,
  `chamberID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cc`
--

CREATE TABLE `cc` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `prescriptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chambers`
--

CREATE TABLE `chambers` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(200) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chambers`
--

INSERT INTO `chambers` (`ID`, `name`, `location`, `phone`) VALUES
(1, 'Rahat Anwar Hospital', 'Chandmari Barishal', '01946102102'),
(2, 'Royal City Hospital', 'Barishal', '01946102102'),
(3, 'Modern Medical Services', 'Barishal', '01946102102');

-- --------------------------------------------------------

--
-- Table structure for table `doctorinchambers`
--

CREATE TABLE `doctorinchambers` (
  `ID` int(11) NOT NULL,
  `doctorID` int(11) DEFAULT NULL,
  `chamberID` int(11) DEFAULT NULL,
  `helpline` varchar(255) DEFAULT NULL,
  `schedules` varchar(555) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorinchambers`
--

INSERT INTO `doctorinchambers` (`ID`, `doctorID`, `chamberID`, `helpline`, `schedules`) VALUES
(1, 1, 1, '01906399496', 'Saturday => 05:00 pm To 08:00 pm, Sunday => 05:00 pm To 08:00 pm, Monday => 05:00 pm To 08:00 pm, Tuesday => 05:00 pm To 08:00 pm, Wednesday => 05:00 pm To 08:00 pm, Thursday => 05:00 pm To 08:00 pm, Friday => Closed'),
(2, 2, 2, '01906399496', 'Saturday => 05:00 pm To 08:00 pm, Sunday => 05:00 pm To 08:00 pm, Monday => 05:00 pm To 08:00 pm, Tuesday => 05:00 pm To 08:00 pm, Wednesday => 05:00 pm To 08:00 pm, Thursday => 05:00 pm To 08:00 pm, Friday => Closed'),
(3, 3, 3, '01906399496', 'Saturday => 02:00 pm To 08:00 pm, Sunday => 02:00 pm To 08:00 pm, Monday => 02:00 pm To 08:00 pm, Tuesday => 02:00 pm To 08:00 pm, Wednesday => 02:00 pm To 08:00 pm, Thursday => 02:00 pm To 08:00 pm, Friday => Closed'),
(4, 4, 1, '01906399496', 'Saturday => 03:00 pm To 08:00 pm, Sunday => 03:00 pm To 08:00 pm, Monday => 03:00 pm To 08:00 pm, Tuesday => 03:00 pm To 08:00 pm, Wednesday => Closed, Thursday => 03:00 pm To 08:00 pm, Friday => Closed'),
(5, 1, 2, '01906399496', 'Saturday => 12:00 pm To 04:00 pm, Sunday => 12:00 pm To 04:00 pm, Monday => 12:00 pm To 04:00 pm, Tuesday => 12:00 pm To 04:00 pm, Wednesday => 12:00 pm To 04:00 pm, Thursday => 12:00 pm To 04:00 pm, Friday => Closed'),
(6, 5, 2, '01906399496', 'Saturday => 05:00 pm To 08:00 pm, Sunday => 05:00 pm To 08:00 pm, Monday => 05:00 pm To 08:00 pm, Tuesday => 05:00 pm To 08:00 pm, Wednesday => 05:00 pm To 08:00 pm, Thursday => 05:00 pm To 08:00 pm, Friday => Closed');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `degree` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `speciality` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `newCost` int(11) NOT NULL,
  `oldCost` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`ID`, `name`, `degree`, `designation`, `speciality`, `gender`, `newCost`, `oldCost`, `email`) VALUES
(1, 'Assistant Professor Dr. F R Khan', 'MBBS, MD (Medicine) BSMMU, FCPS (Gastro)', 'Assistant Professor (Medicine & Gastro-Liver Specialist) - Sher-e-Bangla Medical College & Hospital, Barisal', 'Gastroenterology, Medicine', 'M', 1000, 700, 'khan@gmail.com'),
(2, 'Dr. Kazi Towkia Rahman', 'MBBS (Dhaka), DGO (Dhaka), DMU (Dhaka), Obstetricians and Gynecologists and Surgeons', 'Consultant (Gynecology & Obstetrics) -Divisional Police Hospital, Barisal', 'Gynaecology and Infertility', 'F', 600, 500, 'towkia@gmail.com'),
(3, 'Dr. Sarwar Khan', 'MBBS (MMC), BCS (Health), FCPS (FP) Medicine, MRCP (PACE), London, UK', 'Registrar (Medicine) - Sher-e-Bangla Medical College Hospital, Barisal', 'Medicine', 'M', 600, 600, 'sarwar@gmail.com'),
(4, 'Dr. Tahura Akhtar', 'MBBS (Dhaka), BCS (Health), MCPS, FCPS (Gynecology & Obstetrics), Gynecology', 'Obstetrician & Surgeon, Registrar (Obstetrics & Gynecology) -Sher-e-Bangla Medical College & Hospital, Barisal', 'Gynaecology and Infertility', 'F', 700, 500, 'tahura@gmail.com'),
(5, 'Asst. Professor Dr. A H M Rafiqul Bari', 'MBBS (Dhaka), FCPS (Surgery), MS (Urology),', 'Assistant Professor (Department of Urology) - Sher-e-Bangla Medical College Hospital, Barisal.', 'Urologist, Surgeon', 'M', 700, 500, 'rafiqul@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `ID` int(11) NOT NULL,
  `brandName` varchar(255) DEFAULT NULL,
  `genericName` varchar(255) DEFAULT NULL,
  `advice` text DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `cautions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oe`
--

CREATE TABLE `oe` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `prescriptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` char(64) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `ID` int(11) NOT NULL,
  `doctorID` int(11) DEFAULT NULL,
  `patientID` int(11) DEFAULT NULL,
  `appointmentID` int(11) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rxmedicine`
--

CREATE TABLE `rxmedicine` (
  `ID` int(11) NOT NULL,
  `prescriptionID` int(11) DEFAULT NULL,
  `medicineID` int(11) DEFAULT NULL,
  `dose` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `advice` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobilenumber` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `date_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `mobilenumber`, `password`, `token`, `is_active`, `date_time`) VALUES
(2, 'Saidul', 'Islam', 'fadil.cse5.bu@gmail.com', '01703331096', '$2y$10$TvC8c/3hAtplhWPhekSk.udruzGKtSN20Kph9Kia7kHRJR7l.2Jau', 'f6b81ea6483527b34bb6cd643a8dbec8', '1', '2024-03-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advices`
--
ALTER TABLE `advices`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `prescriptionID` (`prescriptionID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `chamberID` (`chamberID`);

--
-- Indexes for table `cc`
--
ALTER TABLE `cc`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `prescriptionID` (`prescriptionID`);

--
-- Indexes for table `chambers`
--
ALTER TABLE `chambers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctorinchambers`
--
ALTER TABLE `doctorinchambers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `chamberID` (`chamberID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `oe`
--
ALTER TABLE `oe`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `prescriptionID` (`prescriptionID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `appointmentID` (`appointmentID`);

--
-- Indexes for table `rxmedicine`
--
ALTER TABLE `rxmedicine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `prescriptionID` (`prescriptionID`),
  ADD KEY `medicineID` (`medicineID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advices`
--
ALTER TABLE `advices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cc`
--
ALTER TABLE `cc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chambers`
--
ALTER TABLE `chambers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctorinchambers`
--
ALTER TABLE `doctorinchambers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oe`
--
ALTER TABLE `oe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rxmedicine`
--
ALTER TABLE `rxmedicine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advices`
--
ALTER TABLE `advices`
  ADD CONSTRAINT `advices_ibfk_1` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`ID`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`ID`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`patientID`) REFERENCES `patients` (`ID`),
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`chamberID`) REFERENCES `chambers` (`ID`);

--
-- Constraints for table `cc`
--
ALTER TABLE `cc`
  ADD CONSTRAINT `cc_ibfk_1` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`ID`);

--
-- Constraints for table `doctorinchambers`
--
ALTER TABLE `doctorinchambers`
  ADD CONSTRAINT `doctorinchambers_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`ID`),
  ADD CONSTRAINT `doctorinchambers_ibfk_2` FOREIGN KEY (`chamberID`) REFERENCES `chambers` (`ID`);

--
-- Constraints for table `oe`
--
ALTER TABLE `oe`
  ADD CONSTRAINT `oe_ibfk_1` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`ID`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`ID`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patients` (`ID`),
  ADD CONSTRAINT `prescriptions_ibfk_3` FOREIGN KEY (`appointmentID`) REFERENCES `appointments` (`ID`);

--
-- Constraints for table `rxmedicine`
--
ALTER TABLE `rxmedicine`
  ADD CONSTRAINT `rxmedicine_ibfk_1` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`ID`),
  ADD CONSTRAINT `rxmedicine_ibfk_2` FOREIGN KEY (`medicineID`) REFERENCES `medicines` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
