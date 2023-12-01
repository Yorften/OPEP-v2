-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 01:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opep`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cartId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cartId`, `userId`) VALUES
(1, 5),
(3, 9),
(4, 10),
(5, 11),
(19, 12),
(20, 12),
(6, 13),
(7, 13),
(8, 13),
(9, 13),
(10, 13),
(11, 13),
(12, 13),
(13, 14),
(14, 15),
(15, 16),
(16, 17),
(17, 18),
(18, 19);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Alocasia'),
(2, 'Anthurium'),
(3, 'Calathea'),
(4, 'Ficus'),
(5, 'Monstera'),
(6, 'Philodendron');

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `commandId` int(11) NOT NULL,
  `commandDate` date NOT NULL,
  `cartId` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`commandId`, `commandDate`, `cartId`, `total`) VALUES
(18, '2023-11-29', 5, 1510),
(19, '2023-11-29', 14, 1431),
(20, '2023-11-29', 14, 604),
(21, '2023-11-29', 19, 6287),
(22, '2023-11-30', 19, 18717),
(23, '2023-11-30', 5, 663),
(24, '2023-11-30', 5, 1292);

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plantId` int(11) NOT NULL,
  `plantName` varchar(50) NOT NULL,
  `plantDesc` varchar(300) NOT NULL,
  `plantImage` varchar(200) NOT NULL,
  `plantPrice` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plantId`, `plantName`, `plantDesc`, `plantImage`, `plantPrice`, `categoryId`) VALUES
(5, 'Corrupti quam fugia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a6fbeb4f08.40496695.avif', 767, 1),
(6, 'Ut eum cupidatat ut ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a776686563.01550973.avif', 743, 1),
(7, 'Omnis rerum soluta a', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a7fcba7165.10904732.avif', 663, 1),
(8, 'Cillum voluptate con', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a8040b4b38.08460861.avif', 47, 1),
(9, 'Ex velit voluptas ha', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a960ead941.96194964.avif', 688, 1),
(10, 'Magni ex officiis od', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a97cc34234.47961002.avif', 604, 1),
(11, 'Debitis laboris tene', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a99a508fc7.45531059.avif', 715, 1),
(12, 'Exercitationem modi ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a9a33cf527.14924931.avif', 938, 1),
(13, 'Numquam cumque ea et', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a9ab5cacd0.25106978.avif', 239, 1),
(14, 'Non tempor pariatur', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a9b436c903.09059382.avif', 575, 1),
(15, 'Natus earum eu dicta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564abffb21ff8.31232854.avif', 635, 2),
(16, 'In mollit in qui lib', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac0a5c9d42.26958955.avif', 928, 4),
(17, 'Est fugiat sit rem', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac1330c1c8.61787381.avif', 624, 4),
(18, 'Tempor illum reicie', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac4ba5dec9.95657717.avif', 732, 5),
(19, 'Laboris est et eveni', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac54ca4066.71954356.avif', 851, 5),
(20, 'Aliquip in molestiae', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac78492665.28278304.avif', 272, 2),
(21, 'Omnis voluptas ullam', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac814b8ba8.09852203.avif', 210, 2),
(22, 'Occaecat aspernatur ', 'Non amet id ea par', 'IMG-6564ac8bf3eb57.52155615.avif', 632, 2),
(23, 'Dolorem non quam dol', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564aca7b99fe6.74159729.avif', 132, 4),
(24, 'Labore harum volupta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acaf647e68.25344980.avif', 808, 4),
(25, 'Consequatur sunt ut', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acb9b46526.36304615.avif', 98, 4),
(26, 'Porro magna ea eiusm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564accd42fb62.20376249.avif', 770, 5),
(27, 'Accusamus nostrud ex', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acd5005a67.96209236.avif', 514, 6),
(28, 'Incidunt et possimu', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acde3e9cd6.12540958.avif', 807, 6),
(29, 'Et sunt sed culpa ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acec966e46.37369085.avif', 333, 5),
(30, 'Aperiam illum ut of', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acf36e1879.25065436.avif', 988, 6),
(31, 'Corporis cillum sapi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acfcdd76a9.64901956.avif', 249, 6),
(32, 'Ipsa exercitation i', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad0559e197.54279980.avif', 115, 6),
(33, 'Et aut blanditiis ip', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad1a97a4d4.85227686.avif', 524, 3),
(34, 'Ullamco et repellend', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad25339208.58745322.avif', 825, 3),
(35, 'Aut corrupti quo se', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad321127c3.90237164.avif', 916, 3),
(36, 'Magna do veritatis e', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad3ba61097.95977253.avif', 390, 6),
(37, 'Elit veniam incidi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad42226785.40658458.avif', 234, 3),
(38, 'Ullamco ducimus num', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad4fbbbb86.70473620.avif', 582, 5),
(39, 'Et ipsum est quaera', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad6bd4b5e8.88287235.avif', 637, 6),
(40, 'Corrupti alias simi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad88bc3bb3.89260818.avif', 457, 3),
(41, 'Est voluptates odio ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad949bfbb8.83024420.avif', 484, 5),
(42, 'Laboris ex cupiditat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad9e0a0a22.03768578.avif', 293, 3),
(43, 'Voluptatibus volupta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ada79a2542.37685311.avif', 609, 3),
(44, 'Alias voluptates fac', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564adb0165c15.55847651.avif', 131, 5),
(45, 'Quo illum et est ut', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564adb90a3139.86816290.avif', 494, 5);

-- --------------------------------------------------------

--
-- Table structure for table `plants_carts`
--

CREATE TABLE `plants_carts` (
  `plants_cartsId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `plantId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `isSelected` int(11) NOT NULL DEFAULT 0,
  `isCommanded` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plants_carts`
--

INSERT INTO `plants_carts` (`plants_cartsId`, `cartId`, `plantId`, `quantity`, `isSelected`, `isCommanded`) VALUES
(85, 19, 6, 4, 1, 21),
(86, 19, 7, 5, 1, 21),
(87, 19, 10, 16, 1, 22),
(88, 19, 40, 2, 1, 0),
(89, 19, 42, 1, 1, 22),
(90, 19, 16, 7, 1, 22),
(91, 19, 17, 1, 1, 22),
(92, 19, 23, 2, 1, 22),
(98, 14, 6, 1, 1, 19),
(99, 14, 9, 1, 1, 19),
(100, 14, 10, 1, 0, 20),
(101, 5, 6, 1, 1, 18),
(102, 5, 5, 1, 1, 18),
(103, 5, 7, 1, 1, 23),
(104, 5, 9, 1, 0, 24),
(105, 5, 10, 1, 0, 24),
(106, 19, 5, 1, 1, 22),
(107, 19, 43, 1, 1, 22),
(108, 19, 7, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'Client'),
(2, 'Admin'),
(3, 'Administrator'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(300) NOT NULL,
  `userPassword` mediumblob NOT NULL,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `isVerified`, `roleId`) VALUES
(1, 'Administrator', 'admin@youcode.ma', 0x243279243130243163554c354631787233587a4e42724d67335850364f6f636e61306d36507a6264307268503139762f486f6d49545253592e785743, 1, 3),
(2, 'giviqacy', 'lybokob@mailinator.com', 0x24327924313024594a2f4d55336e357067383354455536533933426e2e746b6f524345355172525357797472344b712f5346322e6a57766348355157, 0, 2),
(4, 'admin', 'mod@youcode.ma', 0x24327924313024694f774e46564f4e58443061626a74566739575832754742674a6338765030394170317944336d4c71573269466c7869656a5a3736, 1, 2),
(5, 'fyxyqicod', 'zaxozy@mailinator.com', 0x243279243130244c475962766a494b2e754a6c524759776f735363422e396f7037503134714c575032333132644a3471614f6858436d796c6461334b, 1, 1),
(8, 'linuga', 'vuwuryvo@mailinator.com', 0x2432792431302459685a5167643043744e523150626e3978725658564f6c687331424f494f6e4562384754595951486672594d66725a41394556444f, 0, 4),
(9, 'tived', 'jewitu@mailinator.com', 0x243279243130245051335175617653754c544d696e6a68554e58645475785273545744794d4935744c77306f50336c752e4a566e662f5a534b654d71, 1, 1),
(10, 'bicizizaqa', 'nyhajagy@mailinator.com', 0x24327924313024426577526f466f554a537552504e526a43356b62377530364643734a4b59655a6c3236336a37754e62322e6e68363859793952624b, 1, 1),
(11, 'client', 'lebywi@mailinator.com', 0x24327924313024304c4a443255306742744b7974584941397a4b4b56656a6b526a433045673869794741306a74554e48566536354e634e2e58774d6d, 1, 1),
(12, 'client2', 'seqedejel@mailinator.com', 0x2432792431302448656e674e64466d4c343257504a6c6b65494747507568584e6e4c30532e77584766737954505a7745773243315757755059423875, 1, 1),
(13, 'jykosot', 'piqid@mailinator.com', 0x243279243130246159354c54715878634342342e56364d394a63566e654431655a544531357766424f7370764a783566517477543854316158577657, 1, 1),
(14, 'client3', 'zaru@mailinator.com', 0x24327924313024394e447a4c744f47772e6f554d43574b57456d4e6d2e45705a41326c75444e7749706545744d633743484b4e396b36716851746e79, 0, 1),
(15, 'client4', 'fynuqirep@mailinator.com', 0x2432792431302446412e42523636632e4e544b2f5a63766143744a2e7537597a713274756b324b6b732e692f6d6239384251394c6f694e732e7a4f4f, 1, 1),
(16, 'xyvyboveri', 'fude@mailinator.com', 0x2432792431302453387a50394a3864746c6e777436737235552e314765634e45482f6f517733354b4464776264353571307964682f4a6c3231363243, 1, 1),
(17, 'myqysu', 'musubow@mailinator.com', 0x2432792431302459414c63716c3145776c796a7a58376253524b67714f692f636b467535547667774d48682f4e3475756431456a6175507779483357, 1, 1),
(18, 'zowimazu', 'gekuqek@mailinator.com', 0x243279243130243438624d53565a75526e62682f383054326a4f727565362f674f6461746c4c655652706f6c4f524246584c6e6f4957446e7a6f704b, 1, 1),
(19, 'gurupel', 'laxebowaq@mailinator.com', 0x24327924313024466b6a546d4f4d46682f48477831736d3153426c4375314e4733376d3578663459346c443267426b42726b747a30384d72652f7936, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `FK_User` (`userId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`commandId`),
  ADD KEY `fk_command_cart` (`cartId`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plantId`),
  ADD KEY `FK_Category` (`categoryId`);

--
-- Indexes for table `plants_carts`
--
ALTER TABLE `plants_carts`
  ADD PRIMARY KEY (`plants_cartsId`),
  ADD KEY `fk_cart` (`cartId`),
  ADD KEY `fk_plant` (`plantId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `FK_Role` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `commandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `plants_carts`
--
ALTER TABLE `plants_carts`
  MODIFY `plants_cartsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_User` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `commands`
--
ALTER TABLE `commands`
  ADD CONSTRAINT `fk_command_cart` FOREIGN KEY (`cartId`) REFERENCES `carts` (`cartId`);

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `FK_Category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`);

--
-- Constraints for table `plants_carts`
--
ALTER TABLE `plants_carts`
  ADD CONSTRAINT `fk_cart` FOREIGN KEY (`cartId`) REFERENCES `carts` (`cartId`),
  ADD CONSTRAINT `fk_plant` FOREIGN KEY (`plantId`) REFERENCES `plants` (`plantId`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Role` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
