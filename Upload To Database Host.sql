-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2024 at 11:06 AM
-- Server version: 11.1.2-MariaDB-1:11.1.2+maria~ubu2004
-- PHP Version: 8.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `actvationkeys`
--

-- --------------------------------------------------------

--
-- Table structure for table `activationLog`
--

CREATE TABLE `activationLog` (
  `id` int(11) NOT NULL,
  `keyUsed` varchar(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `IP` varchar(45) NOT NULL,
  `outcome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activationLog`
--

INSERT INTO `activationLog` (`id`, `keyUsed`, `Code`, `date`, `IP`, `outcome`) VALUES
(1, '1j3b5pw9hldb0bmpea9tjz6b4k9gro6dq0z1nfdv', '0242AC120002', '2023-12-12', '0.0.0.0', 'HWID does not match. HWID is: 0242AC120002'),
(2, '1j3b5pw9hldb0bmpea9tjz6b4k9gro6dq0z1nfdv', '0242AC120002', '2023-12-12', '0.0.0.0', 'HWID does not match. HWID is: 0242AC120002'),
(3, '1j3b5pw9hldb0bmpea9tjz6b4k9gro6dq0z1nfdv', '0242AC120002', '2023-12-12', '0.0.0.0', 'HWID does not match. HWID is: 0242AC120002'),
(4, '1j3b5pw9hldb0bmpea9tjz6b4k9gro6dq0z1nfdv', '0242AC120002', '2023-12-12', '0.0.0.0', 'HWID does not match. HWID is: 0242AC120002'),
(5, '1j3b5pw9hldb0bmpea9tjz6b4k9gro6dq0z1nfdv', '0242AC120002', '2023-12-12', '0.0.0.0', 'HWID does not match. HWID is: 0242AC120002');

-- --------------------------------------------------------

--
-- Table structure for table `apiKey`
--

CREATE TABLE `apiKey` (
  `id` int(11) NOT NULL,
  `apiKey` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apiKey`
--

INSERT INTO `apiKey` (`id`, `apiKey`) VALUES
(2, 'q4367wve09876t9er8m7tofdsghslkdfhguw9reh9g8reg');

-- --------------------------------------------------------

--
-- Table structure for table `apiLogs`
--

CREATE TABLE `apiLogs` (
  `id` int(11) NOT NULL,
  `apiKeyUsed` text NOT NULL,
  `action` text NOT NULL,
  `ip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apiLogs`
--

INSERT INTO `apiLogs` (`id`, `apiKeyUsed`, `action`, `ip`) VALUES
(3, 'q4367wve09876t9er8m7tofdsghslkdfhguw9reh9g8reg', 'view_audit_key_for_id_34', '0.0.0.0'),
(4, 'q4367wve09876t9er8m7tofdsghslkdfhguw9reh9g8reg', 'view_current_products', '0.0.0.0'),
(5, 'q4367wve09876t9er8m7tofdsghslkdfhguw9reh9g8reg', 'view_all_actvation_key', '0.0.0.0'),
(6, 'q4367wve09876t9er8m7tofdsghslkdfhguw9reh9g8reg', 'view_audit_keyusage_for_1j3b5pw9hldb0bmpea9tjz6b4k9gro6dq0z1nfdv', '0.0.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `keys_table`
--

CREATE TABLE `keys_table` (
  `id` int(11) NOT NULL,
  `key_value` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `expire_date` date NOT NULL,
  `Notes` text NOT NULL,
  `hwid` text NOT NULL,
  `ProductId` text NOT NULL,
  `isTrial` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keys_table`
--

INSERT INTO `keys_table` (`id`, `key_value`, `owner`, `value`, `enabled`, `expire_date`, `Notes`, `hwid`, `ProductId`, `isTrial`) VALUES
(28, '73', 'Demo Key', '1', 1, '0001-01-01', 'This is a Demo key for the Java Demo\r\nChange the HWID and see it if it works on your pc', '8AD4891380AA54EE75B057FDE4A7A0E5EB8EE6A7A0E5EB8D00155DBBA0B6', '2', 0),
(61, 'ft3rijz9t0cz9zv3s18dcrvhypd4qgkx6kuppu9c', 'test', '3', 1, '2023-12-28', 'A trial Key made with the email example@example.com', '', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productInfo`
--

CREATE TABLE `productInfo` (
  `Version` text NOT NULL,
  `Messages` text NOT NULL,
  `id` int(7) NOT NULL,
  `file_name` text NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productInfo`
--

INSERT INTO `productInfo` (`Version`, `Messages`, `id`, `file_name`, `productID`) VALUES
('1.0', 'Added the ability for one instance to act as a DRM server for many programs.\r\nAll old version will now not activate', 17, 'V1.0_DRM Java Examlpe.zip', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productName` text NOT NULL,
  `id` int(11) NOT NULL,
  `Decription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productName`, `id`, `Decription`) VALUES
('Java Demo Program', 2, 'This is the demo for the java program');

-- --------------------------------------------------------

--
-- Table structure for table `usedTrialEmails`
--

CREATE TABLE `usedTrialEmails` (
  `email` text NOT NULL,
  `actvationKey` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usedTrialEmails`
--

INSERT INTO `usedTrialEmails` (`email`, `actvationKey`, `id`) VALUES
('email@email.com', 'ihvytjyb8q2gwa3y1jjznf2uh8un8l4zv44kcuwd', 1),
('test@example.com', 'ft3rijz9t0cz9zv3s18dcrvhypd4qgkx6kuppu9c', 2);

-- --------------------------------------------------------

--
-- Table structure for table `UsedTrialHWID`
--

CREATE TABLE `UsedTrialHWID` (
  `id` int(11) NOT NULL,
  `actvationKey` text NOT NULL,
  `HWID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES
(4, 'demo', 'demo', 'demo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activationLog`
--
ALTER TABLE `activationLog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apiKey`
--
ALTER TABLE `apiKey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apiLogs`
--
ALTER TABLE `apiLogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys_table`
--
ALTER TABLE `keys_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_value` (`key_value`);

--
-- Indexes for table `productInfo`
--
ALTER TABLE `productInfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usedTrialEmails`
--
ALTER TABLE `usedTrialEmails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `UsedTrialHWID`
--
ALTER TABLE `UsedTrialHWID`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activationLog`
--
ALTER TABLE `activationLog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `apiKey`
--
ALTER TABLE `apiKey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `apiLogs`
--
ALTER TABLE `apiLogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keys_table`
--
ALTER TABLE `keys_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `productInfo`
--
ALTER TABLE `productInfo`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usedTrialEmails`
--
ALTER TABLE `usedTrialEmails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `UsedTrialHWID`
--
ALTER TABLE `UsedTrialHWID`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
