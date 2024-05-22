-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 03:47 AM
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
-- Database: `online-agriculture-market`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `OrderName` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `farmerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `OrderName`, `Price`, `Quantity`, `Total`, `UserID`, `farmerID`) VALUES
(8, 'Tomatoe', 500, 4, 2000, 7, 7),
(9, 'Galic', 200, 5, 1000, 7, 7),
(10, 'Ccummber', 500, 4, 2000, 7, 7),
(11, 'Onion', 1000, 2, 2000, 7, 7),
(12, 'Mango', 1000, 2, 2000, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `ProductName` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `FarmerID` int(11) DEFAULT NULL,
  `updatedAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `ProductName`, `Price`, `FarmerID`, `updatedAt`) VALUES
(10, 'Tomatoe', 500, 7, '2024-05-21'),
(11, 'Carrot', 200, 7, '2024-05-21'),
(12, 'Galic', 200, 7, '2024-05-21'),
(13, 'Onion', 1000, 9, '2024-05-21'),
(14, 'Ccummber', 500, 9, '2024-05-21'),
(15, 'Mango', 1000, 9, '2024-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserName`, `Email`, `Password`, `UserType`) VALUES
(7, 'doe', 'doe@email.com', '$2y$10$Wg06TnPV5WhGk1/yDnuLIuDEqW12764aMzsgL5lzchOciAXhTe.Si', 'farmer'),
(8, 'ben', 'ben@email.com', '$2y$10$GaCyMPSarYs8aKABWoCtjuEet08xXAgvlOlZc7TKOkOri/L6uUzEO', 'buyer'),
(9, 'tim', 'tim@email.com', '$2y$10$kXNHhGU5PDSebTObmf9dVu5e4gWPCpWD0NiBvy.ay/gNrc6Y9bxSa', 'farmer'),
(10, 'admin', 'admin@email.com', '$2y$10$.QN1Dp1xeph7Fu2r7K90tukijwNOqsLFMAd5Xcw4T6xEqO78wUhRe', 'admin'),
(11, 'admin', 'admin@email.com', '$2y$10$cWnbmpVinSCJkzL8/G/j5uw0DMgpDdauUdyUXtnl17AM9CByrm90a', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProductID` (`UserID`),
  ADD KEY `farmerID` (`farmerID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FarmerID` (`FarmerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`farmerID`) REFERENCES `products` (`FarmerID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`FarmerID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
