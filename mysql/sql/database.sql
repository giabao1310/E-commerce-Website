-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: May 31, 2022 at 04:43 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidientu`
--
CREATE DATABASE vidientu;
USE vidientu;
-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `FrontIDCard` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `BackIdCard` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NumOfChangePass` int NOT NULL,
  `Token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `balance` double DEFAULT '0',
  `state` decimal(1,0) DEFAULT '0',
  `abnormal` int NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `FrontIDCard`, `BackIdCard`, `NumOfChangePass`, `Token`, `balance`, `state`, `abnormal`, `date`) VALUES
('325716809', '325716809Font.png', '325716809Back.png', 0, 'c1c35f66caba7656090604f0e4e22632', 1000000, '0', 0, '2022-05-31 04:08:31'),
('512603497', '512603497Font.png', '512603497Back.png', 0, '79c5f6479e76cec324152ad1e2849b13', 10000000, '0', 0, '2022-05-31 04:41:15'),
('admin', '', '', 4, 'ccf2713841186e8a7217a74cb7a354cf', 1000000, '1', 0, '2022-05-12 11:16:28');

--
-- Triggers `account`
--
DELIMITER $$
CREATE TRIGGER `T_remove_account` BEFORE DELETE ON `account` FOR EACH ROW BEGIN
  	DELETE FROM user WHERE OLD.username = username;
  	DELETE FROM password_storage WHERE OLD.username = username; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `password_storage`
--

CREATE TABLE `password_storage` (
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_storage`
--

INSERT INTO `password_storage` (`username`, `password`, `salt`) VALUES
('325716809', 'c0264e4afc3ae99648ec093561022ace', 'rXKqdJ|MND'),
('512603497', 'aa0651d6b06a5a0c14391ea8c5f3c5f4', '|uw#7dn%i3'),
('admin', 'c2077bcdcaafa5c1623029d23ad90539', '7$9CjBP3Q5');

-- --------------------------------------------------------

--
-- Table structure for table `phonecard_transaction`
--

CREATE TABLE `phonecard_transaction` (
  `transaction_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_card_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `service_fee` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phonecard_transaction`
--

INSERT INTO `phonecard_transaction` (`transaction_id`, `phone_card_id`, `service_fee`) VALUES
('R0018', '1111132591', 0),
('R0018', '1111142903', 0),
('R0018', '1111161342', 0),
('R0019', '3333337569', 0),
('R0019', '3333359418', 0),
('R0020', '3333328907', 0),
('R0020', '3333331498', 0),
('R0021', '3333304785', 0),
('R0021', '3333396187', 0),
('R0022', '3333321094', 0),
('R0022', '3333360425', 0),
('R0023', '1111116893', 0),
('R0023', '1111143892', 0),
('R0023', '1111147059', 0),
('R0023', '1111148625', 0),
('R0024', '1111103679', 0),
('R0024', '1111146251', 0),
('R0024', '1111159120', 0),
('R0024', '1111165108', 0),
('R0025', '1111131568', 0),
('R0025', '1111153249', 0),
('R0025', '1111158601', 0),
('R0025', '1111191605', 0),
('R0026', '1111142503', 0),
('R0026', '1111175013', 0),
('R0026', '1111189037', 0),
('R0026', '1111190147', 0),
('R0027', '1111102391', 0),
('R0027', '1111160751', 0),
('R0027', '1111164930', 0),
('R0027', '1111180972', 0),
('R0028', '1111136109', 0),
('R0028', '1111140872', 0),
('R0028', '1111181604', 0),
('R0028', '1111198723', 0),
('R0030', '3333341667', 0),
('R0030', '3333349856', 0),
('R0032', '1111129633', 0),
('R0032', '1111138421', 0),
('R0032', '1111176180', 0),
('R0032', '1111184272', 0),
('R0032', '1111192104', 0);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `transaction_type` int NOT NULL,
  `state` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `username`, `date`, `amount`, `note`, `transaction_type`, `state`) VALUES
('R0001', '236509187', '2022-05-19 02:50:04', 80000, 'Mua thẻ điện thoại', 2, 1),
('R0002', '236509187', '2022-05-21 02:28:49', -52500, 'Rút tiền', 1, 1),
('R0003', '236509187', '2022-05-21 02:30:39', -52500, '1231', 1, 1),
('R0005', '236509187', '2022-05-31 15:13:57', 6000000, 'hkjljkljkl', 3, 0),
('R0027', '236509187', '2022-05-31 19:23:50', 200000, 'Mua thẻ điện thoại', 2, 1),
('R0028', '236509187', '2022-05-31 19:37:50', 200000, 'Mua thẻ điện thoại', 2, 1),
('R0029', '502684731', '2022-05-31 04:01:22', -52500, 'Rút tiền', 1, 1),
('R0030', '502684731', '2022-05-31 04:03:43', 200000, 'Mua thẻ điện thoại', 2, 1),
('R0031', '325716809', '2022-05-31 04:26:54', -52500, 'Rút tiền về thẻ', 1, 1),
('R0032', '325716809', '2022-05-31 04:29:15', 500000, 'Mua thẻ điện thoại', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`token`, `role`) VALUES
('02d951c72357064788c9da495bd4366c', 0),
('10c539a35c072e20ab3a03668138b79d', 0),
('3ea10864693d8cd5d6738becdfc04783', 0),
('415c625a68a101669517b087858bc3fd', 0),
('483b7f84671ab3be182a8aab52a41c27', 0),
('4f51a07af3ab915833133118ce549b99', 0),
('4ff8fc9faf9c7205c49b1fa09bb1bae3', 0),
('79c5f6479e76cec324152ad1e2849b13', 0),
('7df50df821d9c186e7fbefd702dbbc32', 0),
('7f04ccffaefad6d64b9fa15bd651cba1', 0),
('818958d4d691f3f7ebf1d6d1159876d1', 0),
('81d5a123946ab19081cf1d6b08056889', 0),
('a603860057e0fc64965406537b2d332c', 0),
('aa9245bd2d2c6809fc922cf774983c91', 0),
('b3f6efb56fc30ed9634bd503ba1a8ea4', 0),
('c1c35f66caba7656090604f0e4e22632', 0),
('ccf2713841186e8a7217a74cb7a354cf', 999),
('ce77c017fbd456fe477908e5edbb97e5', 0),
('dab23b2aaa616b53123e4c6db50b733d', 0),
('f0125e130d0fc6e17a0361f9c128bbc8', 0),
('fdbc7b4236bdc33e60a86567e8fb01da', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_history`
--

CREATE TABLE `transfer_history` (
  `transfer_id` int NOT NULL,
  `usernameSender` varchar(20) NOT NULL,
  `usernameReceiver` varchar(20) NOT NULL,
  `receipt_id` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer_history`
--

INSERT INTO `transfer_history` (`transfer_id`, `usernameSender`, `usernameReceiver`, `receipt_id`) VALUES
(8, '236509187', '627914503', 'R0004'),
(9, '236509187', '627914503', 'R0005');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `FullName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Birthday` date NOT NULL,
  `Address` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserName`, `Phone`, `Email`, `FullName`, `Birthday`, `Address`) VALUES
('325716809', '0773996453', 'huuan04112002@gmail.com', 'Nguyễn Hữu An', '2022-05-10', 'Đương số 3, phường 2, Quận 2'),
('512603497', '52000533', 'huuan0411@gmail.com', 'Nguyễn Hữu An', '2022-05-13', 'Nhà 23, phường 3, Quận 2'),
('admin', '077399', 'admin@gmail.com', 'admin', '2022-05-18', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Token` (`Token`);

--
-- Indexes for table `password_storage`
--
ALTER TABLE `password_storage`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `phonecard_transaction`
--
ALTER TABLE `phonecard_transaction`
  ADD PRIMARY KEY (`transaction_id`,`phone_card_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`,`username`),
  ADD KEY `fk_username_transaction` (`username`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `transfer_history`
--
ALTER TABLE `transfer_history`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transfer_history`
--
ALTER TABLE `transfer_history`
  MODIFY `transfer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
