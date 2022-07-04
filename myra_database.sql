-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 09:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myra`
--
CREATE DATABASE IF NOT EXISTS `myra` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `myra`;

-- --------------------------------------------------------

--
-- Table structure for table `auditsearch`
--

CREATE TABLE `auditsearch` (
  `searchId` int(11) NOT NULL,
  `searchKeyword` varchar(300) NOT NULL,
  `searchDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auditsearch`
--

INSERT INTO `auditsearch` (`searchId`, `searchKeyword`, `searchDateTime`) VALUES
(1, 'test', '0000-00-00 00:00:00'),
(2, 'bilangan staf akademik aktif', '0000-00-00 00:00:00'),
(3, 'bilangan staf akademik aktif', '0000-00-00 00:00:00'),
(4, 'bilangan staf akademik aktif', '0000-00-00 00:00:00'),
(5, 'bilangan staf akademik aktif', '2022-06-26 13:01:38'),
(6, 'adh-dariyat', '2022-06-26 13:01:45'),
(7, 'Test', '2022-06-26 13:02:07'),
(8, 'bilangan staf', '2022-06-26 13:02:30'),
(9, 'test', '2002-05-28 13:50:23'),
(10, 'test', '2002-01-11 10:10:10'),
(11, 'test', '2002-02-11 10:10:10'),
(12, 'test', '2002-03-11 10:10:10'),
(13, 'test', '2002-04-11 10:10:10'),
(14, 'test', '2002-07-11 10:10:10'),
(15, 'test', '2002-08-11 10:10:10'),
(16, 'test', '2002-09-11 10:10:10'),
(17, 'test', '2002-10-11 10:10:10'),
(18, 'test', '2002-11-11 10:10:10'),
(19, 'test', '2002-12-11 10:10:10'),
(20, 'Test', '2022-06-26 14:35:39'),
(21, 'Test', '2022-06-26 14:35:58'),
(22, 'Test', '2022-06-26 14:36:07'),
(23, 'Test', '2022-06-26 14:36:45'),
(24, 'Test', '2022-06-26 14:36:59'),
(25, 'Test', '2022-06-26 14:37:43'),
(26, 'Test', '2022-06-26 14:37:49'),
(27, 'Test', '2022-06-26 14:37:54'),
(28, 'Test', '2022-06-26 14:38:58'),
(29, 'Test', '2022-06-26 14:41:52'),
(30, 'Test', '2022-06-26 14:42:48'),
(31, 'Test', '2022-06-26 15:09:35'),
(32, 'Test', '2022-06-26 15:09:44'),
(33, 'bilangan staf akademik aktif', '2022-06-26 15:38:18'),
(34, 'Test', '2022-06-26 15:38:21'),
(35, 'bilangan staf akademik aktif', '2022-06-26 15:39:32'),
(36, 'a', '2022-06-26 15:39:50'),
(37, 'bilangan staf akademik aktif', '2022-06-30 00:11:26'),
(38, 'Test', '2022-06-30 00:11:43'),
(39, 'bilangan staf', '2022-06-30 00:11:49'),
(40, 'ijazah pertama', '2022-06-30 00:12:01'),
(41, 'ijazah pertama', '2022-06-30 00:12:10'),
(42, 'bilangan staf akademik aktif', '2022-06-30 00:12:33'),
(43, 'ijazah pertama', '2022-06-30 00:16:13'),
(44, 'ijazah pertama', '2022-06-30 00:16:19'),
(45, 'ijazah pertama', '2022-06-30 00:16:25'),
(46, 'staf akademik', '2022-07-04 15:00:10'),
(47, 'staf ', '2022-07-04 15:00:29'),
(48, 'staf', '2022-07-04 15:00:48'),
(49, 'staf', '2022-07-04 15:01:03'),
(50, 'staf', '2022-07-04 15:09:15'),
(51, 'staf', '2022-07-04 15:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `datastatus`
--

CREATE TABLE `datastatus` (
  `dataStatusId` int(11) NOT NULL,
  `dataStatusTitle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datastatus`
--

INSERT INTO `datastatus` (`dataStatusId`, `dataStatusTitle`) VALUES
(0, 'HIDDEN'),
(1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `myraaccessstatus`
--

CREATE TABLE `myraaccessstatus` (
  `statusId` int(44) NOT NULL,
  `statusTitle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myraaccessstatus`
--

INSERT INTO `myraaccessstatus` (`statusId`, `statusTitle`) VALUES
(0, 'INACTIVE'),
(1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `myraroleassignment`
--

CREATE TABLE `myraroleassignment` (
  `assignId` int(11) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `statusId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `USER_ID` varchar(14) NOT NULL,
  `token` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myraroleassignment`
--

INSERT INTO `myraroleassignment` (`assignId`, `createdAt`, `updatedAt`, `statusId`, `roleId`, `USER_ID`, `token`) VALUES
(34, '2022-06-24 14:26:46', '2022-06-29 16:14:32', 1, 2, '236900', '.zowkJXZbnJYehFsH~FAtkFF_uv5ziW6'),
(38, '2022-06-24 14:57:08', '2022-06-24 14:57:41', 1, 2, '90031560', '2hE1S~rL9kf_NdJu~gczYLGuFo1Rp~0w'),
(39, '2022-07-04 07:02:55', '2022-07-04 07:03:13', 0, 2, '180153', 'ZuRGHvdNrWkdXBIo9IFVz9a6j9tw81J-');

-- --------------------------------------------------------

--
-- Table structure for table `myraroles`
--

CREATE TABLE `myraroles` (
  `roleId` int(25) NOT NULL,
  `roleTitle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myraroles`
--

INSERT INTO `myraroles` (`roleId`, `roleTitle`) VALUES
(1, 'ADMINISTRATOR'),
(2, 'MODERATOR');

-- --------------------------------------------------------

--
-- Table structure for table `myrasection`
--

CREATE TABLE `myrasection` (
  `sectionId` int(11) NOT NULL,
  `sectionNumber` char(1) NOT NULL,
  `sectionTitleMalay` varchar(300) NOT NULL,
  `sectionTitleEnglish` varchar(300) NOT NULL,
  `sectionDescription` varchar(300) NOT NULL,
  `USER_ID` varchar(14) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `dataStatusId` int(11) NOT NULL DEFAULT 1,
  `token` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myrasection`
--

INSERT INTO `myrasection` (`sectionId`, `sectionNumber`, `sectionTitleMalay`, `sectionTitleEnglish`, `sectionDescription`, `USER_ID`, `createdAt`, `updatedAt`, `dataStatusId`, `token`) VALUES
(1, 'A', 'MAKLUMAT UMUM', 'GENERAL INFORMATION', '', '236900', '2022-06-24 16:01:20', NULL, 1, '.bMwSBCGyoX8yqckQOg0kqlOIMM2cNP7'),
(2, 'B', 'KUANTITI DAN KUALITI PENYELIDIK', 'QUANTITY AND QUALITY OF RESEARCHERS', '', '236900', '2022-06-24 16:10:29', NULL, 1, 'Riq.Sq3VohTVH1m6a5Cf6~zx_ZXRR9g2'),
(3, 'C', 'a', 'a', '<p>a</p>', '236900', '2022-07-04 06:56:06', NULL, 1, 'F~DXkkKcnbCGVpJZvNnwuJlPa30rjiax');

-- --------------------------------------------------------

--
-- Table structure for table `myrasectionhistory`
--

CREATE TABLE `myrasectionhistory` (
  `sectionHistoryId` int(11) NOT NULL,
  `sectionHistoryProcess` varchar(45) NOT NULL,
  `sectionId` int(11) NOT NULL,
  `USER_ID` varchar(14) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myrasectionhistory`
--

INSERT INTO `myrasectionhistory` (`sectionHistoryId`, `sectionHistoryProcess`, `sectionId`, `USER_ID`, `createdAt`) VALUES
(1, 'ADDED', 1, '236900', '2022-06-24 16:01:20'),
(2, 'ADDED', 2, '236900', '2022-06-24 16:10:29'),
(3, 'ADDED', 3, '236900', '2022-07-04 06:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `myrasubsection`
--

CREATE TABLE `myrasubsection` (
  `subSectionId` int(11) NOT NULL,
  `subSectionTitleMalay` varchar(300) NOT NULL,
  `subSectionTitleEnglish` varchar(300) NOT NULL,
  `subSectionDescription` text NOT NULL,
  `sectionId` int(11) NOT NULL,
  `USER_ID` varchar(14) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `dataStatusId` int(11) NOT NULL DEFAULT 1,
  `token` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myrasubsection`
--

INSERT INTO `myrasubsection` (`subSectionId`, `subSectionTitleMalay`, `subSectionTitleEnglish`, `subSectionDescription`, `sectionId`, `USER_ID`, `createdAt`, `updatedAt`, `dataStatusId`, `token`) VALUES
(1, '1. Bilangan staf akademik', 'Total number of academic staff', '<p><strong>Nota Umum:</strong></p>\r\n<ul>\r\n<li>Semua output daripada staf akademik yang tidak disenaraikan dalam senarai induk staf akademik IPT semasa tahun yang dinilai<strong> tidak diambilkira</strong>.</li>\r\n<li>Staf baharu pada tahun yang dinilai <strong>tidak boleh diambilkira</strong> sekiranya mereka berkhidmat kurang daripada enam (6) bulan. (Subseksyen A1(b)).</li>\r\n<li>Staf yang sedang cuti belajar <strong>tidak diambilikira</strong> sebagai <strong>Staf Aktif</strong>. (Subseksyen A1(b))</li>\r\n<li>Bilangan staf akademik mengikut gred jawatan seperti berikut:\r\n<ol>\r\n<li>Profesor</li>\r\n<li>Profesor Madya</li>\r\n<li>Pensyarah Kanan</li>\r\n<li>Pensyarah</li>\r\n<li>Felo Penyelidik</li>\r\n</ol>\r\n</li>\r\n<li>Contoh bidang Sains dan Teknologi (S&amp;T) mengikut fakulti <strong>(tidak terhad kepada)</strong>:\r\n<ul>\r\n<li>Sains Tulen dan Gunaan</li>\r\n<li>Teknologi dan Kejuruteraan</li>\r\n<li>Sains Kesihatan dan Klinikal</li>\r\n<li>Teknologi Maklumat dan Komunikasi</li>\r\n<li>Sains, Matematikdan Komputer</li>\r\n<li>Kejuruteraan, Pembuatan dan Pembinaan</li>\r\n</ul>\r\n</li>\r\n</ul>', 1, '236900', '2022-06-24 16:04:08', '2022-06-24 16:06:24', 1, 'ATxSZ4diFEbSNFFn2fL1D4uD5hzQnPLM'),
(2, '2. Bilangan pelajar sepenuh masa', 'Total number of full-time students', '<p><strong>Nota Umum</strong>:</p>\r\n<ul>\r\n<li>Pemastautin tetap adalah setara warganegara.</li>\r\n</ul>', 1, '236900', '2022-06-24 16:07:27', NULL, 1, '4E1rj5skL.qBue~TATX844aBe_I4_~0B');

-- --------------------------------------------------------

--
-- Table structure for table `myrasubsectionhistory`
--

CREATE TABLE `myrasubsectionhistory` (
  `subSectionHistoryId` int(11) NOT NULL,
  `subSectionHistoryProcess` varchar(45) NOT NULL,
  `subSectionId` int(11) NOT NULL,
  `USER_ID` varchar(14) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myrasubsectionhistory`
--

INSERT INTO `myrasubsectionhistory` (`subSectionHistoryId`, `subSectionHistoryProcess`, `subSectionId`, `USER_ID`, `createdAt`) VALUES
(1, 'ADDED', 1, '236900', '2022-06-24 16:04:08'),
(2, 'EDITED', 1, '236900', '2022-06-24 16:06:24'),
(3, 'ADDED', 2, '236900', '2022-06-24 16:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `myraterm`
--

CREATE TABLE `myraterm` (
  `termId` int(11) NOT NULL,
  `termTitleMalay` varchar(300) NOT NULL,
  `termTitleEnglish` varchar(300) NOT NULL,
  `termDescription` text NOT NULL,
  `subSectionId` int(11) NOT NULL,
  `USER_ID` varchar(14) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `dataStatusId` int(11) NOT NULL DEFAULT 1,
  `token` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myraterm`
--

INSERT INTO `myraterm` (`termId`, `termTitleMalay`, `termTitleEnglish`, `termDescription`, `subSectionId`, `USER_ID`, `createdAt`, `updatedAt`, `dataStatusId`, `token`) VALUES
(1, 'a) Bilangan staf akademik', 'Number of academic staff (including staff on study leave)', '<p>Bilangan staf akademik mengikut gred jawatan seperti berikut:</p>\r\n<ul>\r\n<li>Profesor</li>\r\n<li>Profesor Madya</li>\r\n<li>Pensyarah Kanan</li>\r\n<li>Pensyarah</li>\r\n<li>Felo Penyelidik</li>\r\n</ul>', 1, '236900', '2022-06-24 16:05:56', NULL, 1, 'DJlvRAyfbNiC4TWJogeAlvrjMN.U83LQ'),
(2, 'b) Bilangan staf akademik aktif', 'Number of active academic staff', '<p>Bilangan staf akademik aktif mengikut gred jawatan seperti berikut:</p>\r\n<ul>\r\n<li>Profesor</li>\r\n<li>Profesor Madya</li>\r\n<li>Pensyarah Kanan</li>\r\n<li>Pensyarah</li>\r\n<li>Felo Penyelidik</li>\r\n</ul>\r\n<p><strong>Nota Umum</strong>:</p>\r\n<p>......</p>', 1, '236900', '2022-06-24 16:08:56', NULL, 1, 'fsSa44cLBObbX2DEq1jPOzLHoUdKxttS'),
(3, 'a) Bilangan pelajar Ijazah Pertama warganegara dan bukan warganegara', 'Number of local and foreign Undergraduate students', '<p>Bilangan pelajar sepenuh masa meliputi Ijazah Pertama sahaja yang berdaftar (enrolmen) seperti berikut:</p>\r\n<ul>\r\n<li>Bachelor (Local)</li>\r\n<li>Bachelor (Foreign)</li>\r\n</ul>', 2, '236900', '2022-06-24 16:09:55', NULL, 1, 'xq0UHwE~INaWzJZdBeuhmyG8sEivOBFz');

-- --------------------------------------------------------

--
-- Table structure for table `myratermhistory`
--

CREATE TABLE `myratermhistory` (
  `termHistoryId` int(11) NOT NULL,
  `termHistoryProcess` varchar(45) NOT NULL,
  `termId` int(11) NOT NULL,
  `USER_ID` varchar(14) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myratermhistory`
--

INSERT INTO `myratermhistory` (`termHistoryId`, `termHistoryProcess`, `termId`, `USER_ID`, `createdAt`) VALUES
(1, 'ADDED', 1, '236900', '2022-06-24 16:05:56'),
(2, 'ADDED', 2, '236900', '2022-06-24 16:08:56'),
(3, 'ADDED', 3, '236900', '2022-06-24 16:09:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditsearch`
--
ALTER TABLE `auditsearch`
  ADD PRIMARY KEY (`searchId`);

--
-- Indexes for table `datastatus`
--
ALTER TABLE `datastatus`
  ADD PRIMARY KEY (`dataStatusId`);

--
-- Indexes for table `myraaccessstatus`
--
ALTER TABLE `myraaccessstatus`
  ADD PRIMARY KEY (`statusId`);

--
-- Indexes for table `myraroleassignment`
--
ALTER TABLE `myraroleassignment`
  ADD PRIMARY KEY (`assignId`);

--
-- Indexes for table `myraroles`
--
ALTER TABLE `myraroles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `myrasection`
--
ALTER TABLE `myrasection`
  ADD PRIMARY KEY (`sectionId`);

--
-- Indexes for table `myrasectionhistory`
--
ALTER TABLE `myrasectionhistory`
  ADD PRIMARY KEY (`sectionHistoryId`);

--
-- Indexes for table `myrasubsection`
--
ALTER TABLE `myrasubsection`
  ADD PRIMARY KEY (`subSectionId`);

--
-- Indexes for table `myrasubsectionhistory`
--
ALTER TABLE `myrasubsectionhistory`
  ADD PRIMARY KEY (`subSectionHistoryId`);

--
-- Indexes for table `myraterm`
--
ALTER TABLE `myraterm`
  ADD PRIMARY KEY (`termId`);

--
-- Indexes for table `myratermhistory`
--
ALTER TABLE `myratermhistory`
  ADD PRIMARY KEY (`termHistoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditsearch`
--
ALTER TABLE `auditsearch`
  MODIFY `searchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `myraroleassignment`
--
ALTER TABLE `myraroleassignment`
  MODIFY `assignId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `myrasection`
--
ALTER TABLE `myrasection`
  MODIFY `sectionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `myrasectionhistory`
--
ALTER TABLE `myrasectionhistory`
  MODIFY `sectionHistoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `myrasubsection`
--
ALTER TABLE `myrasubsection`
  MODIFY `subSectionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `myrasubsectionhistory`
--
ALTER TABLE `myrasubsectionhistory`
  MODIFY `subSectionHistoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `myraterm`
--
ALTER TABLE `myraterm`
  MODIFY `termId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `myratermhistory`
--
ALTER TABLE `myratermhistory`
  MODIFY `termHistoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
