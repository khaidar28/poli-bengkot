-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 02:41 PM
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
-- Database: `poli_bengkot`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) NOT NULL,
  `id_periksa` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(4, 15, 1),
(5, 15, 3),
(6, 15, 5),
(7, 16, 1),
(8, 16, 3),
(9, 16, 6),
(12, 17, 4),
(13, 17, 7),
(14, 18, 1),
(15, 18, 3),
(16, 18, 4),
(17, 18, 6),
(18, 18, 7),
(19, 19, 3),
(20, 19, 4),
(21, 19, 5),
(22, 19, 8),
(23, 20, 1),
(24, 20, 4),
(25, 20, 6),
(26, 20, 8);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `alamat`, `no_hp`) VALUES
(7, 'Khaidar ali', 'Ds. Kwagean gending Rt 03 Rw 01', '08765987868'),
(8, 'Budiman nuradi', 'Mangkang kulon, Semarang', '0875675675757'),
(9, 'Joko susano', 'Semarang timur', '08567834579'),
(10, 'Gunawan rosi', 'Jetak kidul 2', '08564789817'),
(11, 'Indahsari eka', 'Srondol utara', '08679689012'),
(12, 'Jaya utama', 'Semarang barat', '08765987868'),
(13, 'Tarmuji anto', 'Pegaden tengah, Wonopringgo', '08996546283'),
(14, 'Heru slamet', 'Salaman mloyo', '0877563478');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varbinary(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 0x2050617261636574616d6f6c, 'Tablet 300gr', 3500),
(3, 0x50616e61646f6c, 'Tablet', 17000),
(4, 0x416e74696d6f, 'Tablet', 5000),
(5, 0x426f64726578, 'Kapsul', 4000),
(6, 0x416d6f78696c696e, 'Sirup', 25000),
(7, 0x4d69786167726970, 'Tablet', 3800),
(8, 0x546f6c616b20616e67696e, 'Sirup', 2000),
(9, 0x4f6261742070616e6173, 'tablet', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'Yusiane', 'Ds. Kwagean gending Rt 03 Rw 01', '08564789817'),
(2, 'Aulia ', 'Mangkang kulon ', '08765987868'),
(3, 'Budiman jaya', 'Wonogiri selatan', '08567834579'),
(4, 'Dadang dudung', 'wopy kulon', '08679689012'),
(5, 'Syahputra putra', 'Banyumanik barat', '0875675675757'),
(6, 'Rizqi darmawan', 'Anjasmoro selatan', '08765987868'),
(7, 'Slamet', 'Pusponjolo', '08564893867');

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `tgl_periksa` datetime DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `id_dokter`, `id_pasien`, `tgl_periksa`, `catatan`) VALUES
(15, 7, 2, '2024-07-15 09:03:00', 'Banyak minum air putih'),
(16, 9, 5, '2024-07-24 07:00:00', 'banyak rehat'),
(17, 8, 3, '2024-07-25 10:00:00', 'Tidur  yang teratur '),
(18, 13, 6, '2024-07-17 20:45:00', 'Cepat sembuh '),
(19, 10, 1, '2024-07-20 09:20:00', 'Banyak minum air putih'),
(20, 14, 7, '2024-07-25 13:25:00', 'Banyak olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin12', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'khaidar29', '202cb962ac59075b964b07152d234b70'),
(3, 'a112013107', 'bd93b91d4a5e9a7a5fcd1fad5b9cb999'),
(4, 'bayu aji', '8d6eb42e041cfde5519ccc4a285d5c25'),
(5, 'Gunawan', '5fa72358f0b4fb4f2c5d7de8c9a41846'),
(6, 'coki', '62cadae65f54888f214aa0673003ab59'),
(7, 'user', '62cadae65f54888f214aa0673003ab59'),
(8, 'user13', '62cadae65f54888f214aa0673003ab59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_periksa` (`id_periksa`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`),
  ADD CONSTRAINT `periksa_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
