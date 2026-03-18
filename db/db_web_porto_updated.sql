-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2026 at 03:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.30

CREATE DATABASE IF NOT EXISTS web_porto;
USE web_porto;

DROP TABLE IF EXISTS certificates;
DROP TABLE IF EXISTS experience;
DROP TABLE IF EXISTS skills;
DROP TABLE IF EXISTS social_links;
DROP TABLE IF EXISTS profile;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_porto`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `title`, `description`, `image_path`) VALUES
(1, 'CyberSecurity Certificate', 'Sertifikat pelatihan CyberSecurity sebagai dasar pemahaman keamanan sistem.', 'images/images_cyber.jpg'),
(2, 'Webiner siber Security 2024', 'Workshop Web Penetration Testing Dasar Untuk Keamanan Sistem Informasi', 'images/cert_20260313_182056_ca23366c.png'),
(4, 'Sertifikat Webiner Public Speaking', 'Webiner Public Speaking dengan Tema :\" Berani bicara: Kunci percaya diri dalam meneliti karir \"', 'images/cert_20260316_160423_92153298.png'),
(6, 'Sertifikat Knowledge Center', 'Kegiatan Knowledge Center yang Bertemakan: Catch the Opportunity Personal Branding & Beasiswa lewat Copywriting', 'images/cert_20260316_165131_05c03267.png');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `content`) VALUES
(1, 'Staff Biro Eden - INFORSA'),
(2, 'Project Python: Sistem Reservasi Restoran'),
(3, 'Project Java EnergiSense: projek yang membandingkan penggunaan listrik mana yang paling murah dan awet'),
(4, 'Sedang belajar menjadi Blue Team bagian SOC Analyst'),
(5, 'Sedang belajar bahasa pemograman Flutter/dart untuk Pemograman Aplikasi Bergerak dan html/css untuk Pemograman Berbasis Web');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `title` varchar(200) NOT NULL,
  `summary` text NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `title`, `summary`, `about`) VALUES
(1, 'Mochammad Rezky Ramadhan', 'CyberSecurity Enthusiast | Future SOC Analyst', 'Mahasiswa Sistem Informasi yang mendalami bidang CyberSecurity dan berfokus menjadi SOC Analyst profesional.', 'Nama saya Mochammad Rezky Ramadhan, mahasiswa Sistem Informasi angkatan 2024 yang saat ini menempuh semester 4 dan mendalami bidang CyberSecurity. Saya memiliki ketertarikan pada dunia keamanan sistem, monitoring ancaman, serta analisis insiden keamanan.');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int NOT NULL,
  `skill_name` varchar(100) NOT NULL,
  `percentage` int NOT NULL,
  `color_class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_name`, `percentage`, `color_class`) VALUES
(1, 'Python & Java', 40, 'bg-primary'),
(2, 'SOC Analyst', 15, 'bg-info'),
(3, 'Web Penetration', 5, 'bg-secondary');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int NOT NULL,
  `platform` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon_class` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `url`, `icon_class`) VALUES
(1, 'Instagram', 'https://www.instagram.com/mocha.rzy/', 'bi bi-instagram'),
(2, 'LinkedIn', 'https://www.linkedin.com/in/mochammad-rezky-ramadhan-128022330/', 'bi bi-linkedin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
