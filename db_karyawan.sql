-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 05:51 AM
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
-- Database: `db_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `key_results`
--

CREATE TABLE `key_results` (
  `id_kr` int(10) NOT NULL,
  `key_result` varchar(350) NOT NULL,
  `target_q1` varchar(10) NOT NULL,
  `target_q2` varchar(10) NOT NULL,
  `unit_target` varchar(10) NOT NULL,
  `complexity` int(3) NOT NULL,
  `id_objective` int(10) NOT NULL,
  `progress_q1` varchar(10) DEFAULT NULL,
  `progress_q2` varchar(10) DEFAULT NULL,
  `unit_progress` varchar(10) DEFAULT NULL,
  `assignor_rate_q1` int(3) DEFAULT NULL,
  `assignor_rate_q2` int(3) DEFAULT NULL,
  `id_assignor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `key_results`
--

INSERT INTO `key_results` (`id_kr`, `key_result`, `target_q1`, `target_q2`, `unit_target`, `complexity`, `id_objective`, `progress_q1`, `progress_q2`, `unit_progress`, `assignor_rate_q1`, `assignor_rate_q2`, `id_assignor`) VALUES
(1, 'Tercapainya efisiensi cost bidang Sarana sebesar Rp 228.000.000,-', '57000000', '57000000', 'Rupiah', 3, 1, '3', '3', 'Laporan', 3, 3, 4),
(4, 'Tersedianya laporan FCCS setiap bulan', '3', '3', 'Laporan', 3, 1, NULL, NULL, NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `objectives`
--

CREATE TABLE `objectives` (
  `id_objective` int(10) NOT NULL,
  `objective` varchar(350) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `objectives`
--

INSERT INTO `objectives` (`id_objective`, `objective`, `id_user`) VALUES
(1, 'Mendorong efisiensi cost bidang SDM & Umum', 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(10) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Karyawan'),
(3, 'Assigner');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nama_user` varchar(250) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_role` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `no_hp`, `id_role`, `username`, `password`) VALUES
(1, 'Admin', '6285213921331', 1, 'adminadmin1', 'adminadmin1'),
(3, 'Valen Rionald', '6285213921332', 2, 'valenvalen1', '$2y$10$/TPFF/nRKFYdFWlfrDr0rOfNpN.vSgc9/ZyMJMVM78ytSwZUlCMEm'),
(4, 'Christian Yuda', '6285213921335', 3, 'yudayuda1', '$2y$10$TWPt3bSS/DO1wFggQwyHreYSApvIEyUubDOl3jhXYHTqzRs7.N9LW'),
(5, 'Eoni', '6285213921330', 2, 'enieni1', 'enieni1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `key_results`
--
ALTER TABLE `key_results`
  ADD PRIMARY KEY (`id_kr`),
  ADD KEY `key_results_ibfk_1` (`id_assignor`),
  ADD KEY `objective` (`id_objective`);

--
-- Indexes for table `objectives`
--
ALTER TABLE `objectives`
  ADD PRIMARY KEY (`id_objective`),
  ADD KEY `user` (`id_user`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `Role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `key_results`
--
ALTER TABLE `key_results`
  MODIFY `id_kr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `objectives`
--
ALTER TABLE `objectives`
  MODIFY `id_objective` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `key_results`
--
ALTER TABLE `key_results`
  ADD CONSTRAINT `key_results_ibfk_1` FOREIGN KEY (`id_assignor`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `objective` FOREIGN KEY (`id_objective`) REFERENCES `objectives` (`id_objective`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objectives`
--
ALTER TABLE `objectives`
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
