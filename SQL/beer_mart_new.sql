-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2016 at 04:24 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beer_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cemilan`
--

CREATE TABLE `cemilan` (
  `IdCemilan` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cemilan`
--

INSERT INTO `cemilan` (`IdCemilan`, `Nama`, `harga`, `stock`, `deskripsi`) VALUES
(1, 'Usus', 35000, 92, ''),
(2, 'Urat', 35000, 100, ''),
(3, 'Ceker', 35000, 100, ''),
(4, 'Kacang Bogor', 30000, 100, ''),
(5, 'Kacang Mede', 30000, 100, ''),
(6, 'Kacang Kulit', 0, 0, ''),
(7, 'Kacang Bawang', 0, 0, ''),
(8, 'Kacang Bandung', 0, 0, ''),
(9, 'Kacang Koro', 0, 0, ''),
(10, 'Kecimpring', 0, 0, ''),
(11, 'Keripik Singkong', 0, 0, ''),
(12, 'Keripik Paru', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `IdInvoice` int(11) NOT NULL,
  `idPengguna` int(11) DEFAULT NULL,
  `TotalHarga` int(11) DEFAULT NULL,
  `Tanggal` varchar(255) DEFAULT NULL,
  `Tipe` int(11) DEFAULT NULL,
  `IdPromo` int(11) DEFAULT NULL,
  `promo` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `NamaPending` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`IdInvoice`, `idPengguna`, `TotalHarga`, `Tanggal`, `Tipe`, `IdPromo`, `promo`, `status`, `NamaPending`) VALUES
(1, 1, 29325, '', 1, 1, '15%', 0, ''),
(2, 1, 31050, '', 1, 1, ',10%', 1, ''),
(3, 1, 34500, '', 1, 1, '', 0, ''),
(4, 1, 48875, '', 1, 1, '', 1, ''),
(5, 1, 39100, '', 1, 1, '', 0, ''),
(6, 1, 39100, '', 1, 1, '', 1, ''),
(7, 1, 39100, '', 1, 1, '', 0, ''),
(8, 1, 86250, '', 1, 1, '', 1, ''),
(9, 1, 0, '', 1, 1, '', 0, ''),
(10, 1, 0, '', 1, 1, '', 0, ''),
(11, 1, 122188, '', 1, 1, '', 1, ''),
(12, 1, 78660, '2016-10-11', 1, 1, ',10%', 0, ''),
(13, 1, 78660, '2016-10-11', 1, 1, ',10%', 0, ''),
(14, 1, 87400, '', 1, 1, '', 1, ''),
(15, 1, 87400, '', 1, 1, '', 0, ''),
(16, 1, 131100, '', 1, 1, '', 0, ''),
(17, 1, 0, '', 1, 1, '', 0, ''),
(18, 1, 131100, '', 1, 1, '', 0, ''),
(19, 1, 131100, '', 1, 1, '', 0, ''),
(20, 1, 87400, '', 1, 1, '', 0, ''),
(21, 1, 87400, '', 1, 1, '', 1, ''),
(22, 1, 111435, '', 1, 1, ',15%', 1, ''),
(23, 1, 131100, '', 1, 1, '', 1, ''),
(24, 1, 69000, '', 1, 1, '', 1, ''),
(25, 1, 708400, '', 1, 1, '', 0, ''),
(26, 1, 166750, '', 1, 1, '', 0, ''),
(27, 1, 122188, '2016-10-11', 1, 1, '', 0, ''),
(28, 1, 148580, '2016-10-11', 1, 1, ',20%', 0, ''),
(29, 1, 690000, '', 1, 1, '', 0, ''),
(30, 1, 34500, '', 1, 1, '', 1, ''),
(31, 1, 124200, '', 1, 1, ',10%', 0, ''),
(32, 1, 46000, '', 1, 1, '', 0, ''),
(33, 1, 103500, '', 1, 1, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `IdMakanan` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`IdMakanan`, `Nama`, `deskripsi`, `harga`, `stock`) VALUES
(1, 'Wagyu Steak', '', 90000, 2),
(2, 'Beef Burger', '', 55000, 0),
(3, 'Pizza', '', 50000, 0),
(4, 'Nasi Goreng', '', 30000, 0),
(5, 'French Fries Sausage', '', 30000, 0),
(6, 'Platter', '', 50000, 0),
(7, 'Spicy Tofu', '', 20000, 0),
(8, 'French Fries', '', 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Tipe` int(11) NOT NULL,
  `Diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Tipe`, `Diskon`) VALUES
(1, 0),
(2, 10),
(3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `IdMakanan` int(11) NOT NULL,
  `JumlahMakanan` int(11) NOT NULL,
  `IdMinuman` int(11) NOT NULL,
  `JumlahMinuman` int(11) NOT NULL,
  `IdCemilan` int(11) NOT NULL,
  `JumlahCemilan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`IdMenu`, `Nama`, `IdMakanan`, `JumlahMakanan`, `IdMinuman`, `JumlahMinuman`, `IdCemilan`, `JumlahCemilan`) VALUES
(1, 'Menu 1', 1, 2, 1, 2, 0, 0),
(2, 'Menu 1', 0, 0, 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `minuman`
--

CREATE TABLE `minuman` (
  `IdMinuman` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `tipe` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `minuman`
--

INSERT INTO `minuman` (`IdMinuman`, `Nama`, `deskripsi`, `harga`, `stock`, `tipe`) VALUES
(1, 'Bintang Besar', '', 37000, 92, 0),
(2, 'Bintang Small', '', 25000, 87, 0),
(3, 'Bintang Draught', '', 30000, 100, 0),
(4, 'Bintang Radler', '', 25000, 98, 0),
(5, 'Heineken Large', '', 46000, 100, 0),
(6, 'Heinken Small', '', 30000, 100, 0),
(7, 'Anker Large', '', 37000, 100, 0),
(8, 'San Miguel Small', '', 28000, 100, 0),
(9, 'San Miguel Light Small', '', 28000, 100, 0),
(10, 'Carlsberg Small', '', 30000, 100, 0),
(11, 'Guiness Small', '', 35000, 100, 0),
(12, 'Guiness Large', '', 42000, 100, 0),
(13, 'Jack Daniels', '', 600000, 10, 0),
(14, 'Jose Cervo', '', 600000, 10, 0),
(15, 'Chivas Regal 12 Y O', '', 700000, 10, 0),
(16, 'Martel', '', 1100000, 5, 0),
(17, 'Hennesy', '', 1100000, 5, 0),
(18, 'Red Lable', '', 550000, 10, 0),
(19, 'Black Lable', '', 650000, 5, 0),
(20, 'Bacardi', '', 550000, 10, 0),
(21, 'Smirnoff', '', 500000, 5, 0),
(22, 'Absolut', '', 550000, 10, 0),
(23, 'Gordon Dry GIn', '', 500000, 5, 0),
(24, 'Martini Dry', '', 650000, 5, 0),
(25, 'Martini Rosso', '', 600000, 5, 0),
(26, 'Vodka', '', 40000, 80, 1),
(27, 'Tequila', '', 45000, 80, 1),
(28, 'Whisky', '', 45000, 80, 1),
(29, 'Bacardi Single', '', 40000, 80, 1),
(30, 'Orange Juice', '', 20000, 2, 2),
(31, 'Lemon Juice', '', 20000, 0, 2),
(32, 'Ice Choco Blend', '', 20000, 0, 2),
(33, 'Ice Capp Blend', '', 20000, 0, 2),
(34, 'Coke', '', 20000, 100, 0),
(35, 'Sprite', '', 20000, 100, 0),
(36, 'Mineral Water', '', 10000, 100, 0),
(37, 'Pocca Green Tea', '', 25000, 100, 0),
(38, 'Tonic Water', '', 25000, 100, 0),
(39, 'Red Bull', '', 20000, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `idPaket` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `idMinuman` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `IdPengguna` int(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`IdPengguna`, `pass`, `jenis`) VALUES
(1, 'cilukba', 1),
(2, 'cilukbe', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `IdPesanan` int(11) NOT NULL,
  `IdInvoice` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_cemilan`
--

CREATE TABLE `pesanan_cemilan` (
  `IdPesanan` int(11) DEFAULT NULL,
  `IdCemilan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_makanan`
--

CREATE TABLE `pesanan_makanan` (
  `IdPesanan` int(11) DEFAULT NULL,
  `IdMakanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_minuman`
--

CREATE TABLE `pesanan_minuman` (
  `IdPesanan` int(11) DEFAULT NULL,
  `IdMinuman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_rokok`
--

CREATE TABLE `pesanan_rokok` (
  `IdPesanan` int(11) DEFAULT NULL,
  `IdRokok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `IdPromo` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `Diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`IdPromo`, `Nama`, `Diskon`) VALUES
(1, 'cilukba', 10),
(2, 'cilukba', 15),
(3, 'cilukba', 20);

-- --------------------------------------------------------

--
-- Table structure for table `rokok`
--

CREATE TABLE `rokok` (
  `IdRokok` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rokok`
--

INSERT INTO `rokok` (`IdRokok`, `Nama`, `deskripsi`, `harga`, `stock`) VALUES
(1, 'Djarum Icy Menthol', '', 30000, 80),
(2, 'Djarum Cokelat', '', 30000, 100),
(3, 'Djarum MLD', '', 30000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `IdTemp` int(11) NOT NULL,
  `Tipe` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `tipe` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`tipe`, `username`, `hash`) VALUES
(0, 'admin', '$2y$10$8cGQdgK7x1zno6JPmzvD0uW6WIHkJ363jilMPHx0avrFQ7M7WKU2S'),
(1, 'kasir', '$2y$10$6cOXSCxC/WBfEAAbKYfO0uQfTmBpQ1QegBeAw0iLWHqqlzAQkKiAG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cemilan`
--
ALTER TABLE `cemilan`
  ADD PRIMARY KEY (`IdCemilan`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`IdInvoice`),
  ADD KEY `idPengguna` (`idPengguna`),
  ADD KEY `Tipe` (`Tipe`),
  ADD KEY `IdPromo` (`IdPromo`);

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`IdMakanan`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Tipe`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indexes for table `minuman`
--
ALTER TABLE `minuman`
  ADD PRIMARY KEY (`IdMinuman`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`idPaket`),
  ADD KEY `idMinuman` (`idMinuman`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`IdPengguna`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`IdPesanan`),
  ADD KEY `IdInvoice` (`IdInvoice`);

--
-- Indexes for table `pesanan_cemilan`
--
ALTER TABLE `pesanan_cemilan`
  ADD KEY `IdPesanan` (`IdPesanan`),
  ADD KEY `IdCemilan` (`IdCemilan`);

--
-- Indexes for table `pesanan_makanan`
--
ALTER TABLE `pesanan_makanan`
  ADD KEY `IdPesanan` (`IdPesanan`),
  ADD KEY `IdMakanan` (`IdMakanan`);

--
-- Indexes for table `pesanan_minuman`
--
ALTER TABLE `pesanan_minuman`
  ADD KEY `IdPesanan` (`IdPesanan`),
  ADD KEY `IdMinuman` (`IdMinuman`);

--
-- Indexes for table `pesanan_rokok`
--
ALTER TABLE `pesanan_rokok`
  ADD KEY `IdPesanan` (`IdPesanan`),
  ADD KEY `IdRokok` (`IdRokok`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`IdPromo`);

--
-- Indexes for table `rokok`
--
ALTER TABLE `rokok`
  ADD PRIMARY KEY (`IdRokok`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`IdTemp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`idPengguna`) REFERENCES `pengguna` (`IdPengguna`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`Tipe`) REFERENCES `member` (`Tipe`),
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`IdPromo`) REFERENCES `promo` (`IdPromo`);

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`idMinuman`) REFERENCES `minuman` (`IdMinuman`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`IdInvoice`) REFERENCES `invoice` (`IdInvoice`);

--
-- Constraints for table `pesanan_cemilan`
--
ALTER TABLE `pesanan_cemilan`
  ADD CONSTRAINT `pesanan_cemilan_ibfk_1` FOREIGN KEY (`IdPesanan`) REFERENCES `pesanan` (`IdPesanan`),
  ADD CONSTRAINT `pesanan_cemilan_ibfk_2` FOREIGN KEY (`IdCemilan`) REFERENCES `cemilan` (`IdCemilan`);

--
-- Constraints for table `pesanan_makanan`
--
ALTER TABLE `pesanan_makanan`
  ADD CONSTRAINT `pesanan_makanan_ibfk_1` FOREIGN KEY (`IdPesanan`) REFERENCES `pesanan` (`IdPesanan`),
  ADD CONSTRAINT `pesanan_makanan_ibfk_2` FOREIGN KEY (`IdMakanan`) REFERENCES `makanan` (`IdMakanan`);

--
-- Constraints for table `pesanan_minuman`
--
ALTER TABLE `pesanan_minuman`
  ADD CONSTRAINT `pesanan_minuman_ibfk_1` FOREIGN KEY (`IdPesanan`) REFERENCES `pesanan` (`IdPesanan`),
  ADD CONSTRAINT `pesanan_minuman_ibfk_2` FOREIGN KEY (`IdMinuman`) REFERENCES `minuman` (`IdMinuman`);

--
-- Constraints for table `pesanan_rokok`
--
ALTER TABLE `pesanan_rokok`
  ADD CONSTRAINT `pesanan_rokok_ibfk_1` FOREIGN KEY (`IdPesanan`) REFERENCES `pesanan` (`IdPesanan`),
  ADD CONSTRAINT `pesanan_rokok_ibfk_2` FOREIGN KEY (`IdRokok`) REFERENCES `rokok` (`IdRokok`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
