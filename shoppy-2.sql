-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 05:50 PM
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
-- Database: `shoppy-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `image` blob DEFAULT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productName` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `sellerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `changetransaction`
--

CREATE TABLE `changetransaction` (
  `changeTransactionID` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `transactionID` int(11) NOT NULL,
  `previousStatus` enum('on hold','on delivery','complete') NOT NULL,
  `currentStatus` enum('on hold','on delivery','complete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `changetransaction`
--

INSERT INTO `changetransaction` (`changeTransactionID`, `date`, `transactionID`, `previousStatus`, `currentStatus`) VALUES
(1, '2024-04-29', 1, 'on hold', 'complete'),
(2, '2024-04-29', 2, 'on hold', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `clicks`
--

CREATE TABLE `clicks` (
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clicks`
--

INSERT INTO `clicks` (`productID`, `userID`) VALUES
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(15, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(15, 11),
(13, 11),
(14, 11),
(13, 11),
(13, 11),
(16, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(14, 11),
(15, 11),
(15, 11),
(13, 11),
(15, 11),
(15, 11),
(15, 11),
(14, 11),
(14, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(14, 11),
(13, 11),
(14, 11),
(16, 11),
(16, 11),
(16, 11),
(16, 11),
(14, 11),
(16, 11),
(16, 11),
(16, 11),
(13, 11),
(13, 11),
(16, 11),
(16, 11),
(17, 11),
(13, 11),
(13, 11),
(13, 11),
(16, 11),
(16, 11),
(14, 11),
(13, 11),
(15, 11),
(16, 11),
(16, 11),
(16, 11),
(16, 11),
(17, 11),
(14, 11),
(13, 11),
(13, 11),
(16, 11),
(13, 11),
(13, 11),
(15, 11),
(16, 11),
(14, 11),
(14, 11),
(16, 11),
(13, 11),
(16, 11),
(13, 11),
(13, 11),
(14, 11),
(15, 11),
(16, 11),
(16, 11),
(16, 11),
(13, 11),
(13, 11),
(14, 11),
(15, 11),
(15, 11),
(14, 11),
(14, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(17, 11),
(16, 11),
(15, 11),
(14, 11),
(13, 11),
(15, 11),
(14, 11),
(14, 11),
(14, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(16, 11),
(13, 11),
(15, 11),
(16, 11),
(13, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(14, 11),
(1, 11),
(1, 11),
(1, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(15, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(13, 11),
(14, 11),
(15, 11),
(13, 11),
(14, 11),
(13, 11),
(13, 11),
(16, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(14, 11),
(15, 11),
(15, 11),
(13, 11),
(15, 11),
(15, 11),
(15, 11),
(14, 11),
(14, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(15, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(14, 11),
(13, 11),
(14, 11),
(16, 11),
(16, 11),
(16, 11),
(16, 11),
(14, 11),
(16, 11),
(16, 11),
(16, 11),
(13, 11),
(13, 11),
(16, 11),
(16, 11),
(17, 11),
(13, 11),
(13, 11),
(13, 11),
(16, 11),
(16, 11),
(14, 11),
(13, 11),
(15, 11),
(16, 11),
(16, 11),
(16, 11),
(16, 11),
(17, 11),
(14, 11),
(13, 11),
(13, 11),
(16, 11),
(13, 11),
(13, 11),
(15, 11),
(16, 11),
(14, 11),
(14, 11),
(16, 11),
(13, 11),
(16, 11),
(13, 11),
(13, 11),
(14, 11),
(15, 11),
(16, 11),
(16, 11),
(16, 11),
(13, 11),
(13, 11),
(14, 11),
(15, 11),
(15, 11),
(14, 11),
(14, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(17, 11),
(16, 11),
(15, 11),
(14, 11),
(13, 11),
(15, 11),
(14, 11),
(14, 11),
(14, 11),
(13, 11),
(13, 11),
(13, 11),
(13, 11),
(14, 11),
(16, 11),
(13, 11),
(15, 11),
(16, 11),
(13, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(1, 11),
(14, 11),
(1, 11),
(1, 11),
(1, 11),
(7, 11),
(7, 11),
(8, 11),
(7, 11),
(14, 11),
(15, 11),
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `sellerID` int(11) DEFAULT NULL,
  `productName` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `stocks` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tags` text DEFAULT NULL,
  `averageRating` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `sellerID`, `productName`, `image`, `description`, `stocks`, `price`, `tags`, `averageRating`) VALUES
(1, 1, 'Elixir of Life', NULL, 'Grants temporary immortality.', 50, 199.99, NULL, NULL),
(2, 1, 'Merlin’s Magic Wand', NULL, 'A wand of unparalleled power.', 20, 149.99, NULL, NULL),
(3, 1, 'Enchanted Cloak', NULL, 'Renders the wearer invisible.', 15, 99.99, NULL, NULL),
(4, 1, 'Book of Spells', NULL, 'Contains ancient and powerful spells.', 30, 89.99, NULL, NULL),
(5, 2, 'Gandalf’s Staff', NULL, 'A staff used by Gandalf himself.', 10, 299.99, NULL, NULL),
(6, 2, 'Wizard’s Hat', NULL, 'Boosts magical abilities.', 40, 49.99, NULL, NULL),
(7, 2, 'Crystal Ball', NULL, 'Used for scrying.', 25, 199.99, NULL, NULL),
(8, 2, 'Silver Robe', NULL, 'Protects from dark magic.', 10, 159.99, NULL, NULL),
(9, 2, 'Magic Carpet', NULL, 'Flies the rider at high speeds.', 5, 499.99, NULL, NULL),
(10, 3, 'Brewing Cauldron', NULL, 'Ideal for making magical potions.', 20, 129.99, NULL, NULL),
(11, 3, 'Witch’s Broom', NULL, 'Fast and reliable transportation.', 15, 89.99, NULL, NULL),
(12, 3, 'Potion Kit', NULL, 'Everything needed to start potion making.', 25, 69.99, NULL, NULL),
(13, 11, 'Pork Sisig', '????\0JFIF\0\0\0\0\0\0??\08Exif\0\0II*\0\0\0\0\0??\0\0\0\0\Z\0\0\0\0\0\0\0ALL RIGHTS RESERVED\0\0\0??\0,Photoshop 3.0\08BIM%\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0C\0\r\Z\Z\Z\Z#%\'%#//33//@@@@@@@@@@@@@@@??\0C\Z\Z&\Z\Z\Z\Z&0##0+.\'\'\'.+550055@@?@@@@@', 'Pork jowl and ears, pork belly, and chicken liver, which is usually seasoned with calamansi, onions, and chili peppers', 69, 100.00, 'Food', NULL),
(14, 11, 'Siomai Rice', '????\0JFIF\0\0H\0H\0\0??\0C\0\r2!=,.$2I@LKG@FEPZsbPUmVEFd?emw{???N`???}?s~?|??\0C\Z;!!;|SFS||||||||||||||||||||||||||||||||||||||||||||||||||??\0	?	?\"\0??\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0?\"i`\0???*\n', 'Budget meal for students', 69, 50.00, 'Food', NULL),
(15, 4, 'Butterbeer', '????\0JFIF\0\0\0\0\0\0??\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(??\0C\n\n\n\n(\Z\Z((((((((((((((((((((((((((((((((((((((((((((((((((??\0??\"\0??\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\Z\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0啦e ?I', '\"a little bit like less-sickly butterscotch\"', 69, 75.00, 'Food', NULL),
(16, 2, 'Snow Witch Robe', '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0??^?\0\0\0gAMA\0\0???a\0\0\0PLTE\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\Z\Z\Z						!!!\n\n\n\n	@BB010\r\r\r(\'&\rJKL:99///HHHWWV++*;;;tvvgiiIII\\]\\++*876&%%IIH\"\" uutggf?????VVT553*+)@BAmjh', 'Witch\'s robe in the color of snow.\r\n\r\nOnce worn by the snowy crone who the young Ranni encountered deep in the woods. She was a witch, and well versed in cold sorceries. It is said that the doll that houses Ranni\'s soul was modeled after her.\r\n\r\nThat old witch was Ranni\'s secret mentor.', 69, 9999.99, 'Clothes', NULL),
(17, 11, 'Bracelet', '????\0JFIF\0\0H\0H\0\0??\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(??\0C\n\n\n\n(\Z\Z((((((((((((((((((((((((((((((((((((((((((((((((((??\0	`	`\"\0??\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0??\0\0\0\0\0', 'Taylor Friendship Bracelet, Stretchable Nylon base', 69, 100.00, 'Clothes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producthistory`
--

CREATE TABLE `producthistory` (
  `productTransactionID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(20) NOT NULL,
  `transactionID` int(11) NOT NULL,
  `sellerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producthistory`
--

INSERT INTO `producthistory` (`productTransactionID`, `productID`, `quantity`, `transactionID`, `sellerID`) VALUES
(1, 1, 0, 1, 0),
(2, 6, 0, 2, 0),
(3, 10, 0, 3, 0),
(4, 7, 0, 4, 0),
(5, 12, 0, 5, 0),
(6, 2, 0, 6, 0),
(7, 8, 0, 7, 0),
(8, 11, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratinghistory`
--

CREATE TABLE `ratinghistory` (
  `ratingID` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `productOrSeller` enum('product','seller') NOT NULL,
  `userID` int(11) NOT NULL,
  `sellerID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `rate` tinyint(4) NOT NULL CHECK (`rate` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratinghistory`
--

INSERT INTO `ratinghistory` (`ratingID`, `date`, `productOrSeller`, `userID`, `sellerID`, `productID`, `rate`) VALUES
(1, '2024-04-29', 'product', 6, NULL, 1, 4),
(2, '2024-04-29', 'seller', 6, 1, NULL, 5),
(3, '2024-04-29', 'product', 6, NULL, 6, 5),
(4, '2024-04-29', 'seller', 6, 2, NULL, 4),
(5, '2024-04-29', 'product', 6, NULL, 10, 3),
(6, '2024-04-29', 'seller', 6, 3, NULL, 5),
(7, '2024-04-29', 'product', 5, NULL, 7, 4),
(8, '2024-04-29', 'seller', 5, 2, NULL, 4),
(9, '2024-04-29', 'product', 5, NULL, 12, 5),
(10, '2024-04-29', 'seller', 5, 3, NULL, 5),
(11, '2024-04-29', 'product', 10, NULL, 2, 5),
(12, '2024-04-29', 'seller', 10, 1, NULL, 5),
(13, '2024-04-29', 'product', 10, NULL, 8, 4),
(14, '2024-04-29', 'seller', 10, 2, NULL, 4),
(15, '2024-04-29', 'product', 10, NULL, 11, 4),
(16, '2024-04-29', 'seller', 10, 3, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `sellerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `dateStart` date NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `businessName` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `verified` enum('verified','notVerified','','') NOT NULL,
  `averageRating` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`sellerID`, `userID`, `shopName`, `dateStart`, `description`, `businessName`, `picture`, `verified`, `averageRating`) VALUES
(1, 1, 'Merlin’s Mystical Emporium', '2023-10-11', 'From potions to ancient scrolls, find all your magical needs fulfilled at Merlin’s.', '', 'feu.png', 'verified', NULL),
(2, 2, 'Gandalf’s Wands and Staves', '2023-10-12', 'Specializing in wands and staves crafted for the discerning wizard.', '', 'iarfa.jpg', 'verified', NULL),
(3, 3, 'Wanda’s Witchcraft Wares', '2023-10-13', 'Discover the finest in witchcraft supplies, from brooms to spell books.', '', 'ias.jpg', 'verified', NULL),
(4, 4, 'Dumbledore’s Magical Curiosities', '2023-10-14', 'Explore a collection of magical curiosities handpicked by Dumbledore himself.', '', 'ie.jpg', 'verified', NULL),
(11, 11, 'Nina Batumbakal', '2024-05-05', 'The TOP shop in Morayta', 'Nina Batumbakal', 'ithm.jpg', 'verified', NULL),
(12, 12, 'tiamat', '2024-05-06', 'i am dragon no matter what', '', '', '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('on hold','on delivery','complete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transactionID`, `userID`, `date`, `status`) VALUES
(1, 6, '2024-04-29', 'complete'),
(2, 6, '2024-04-29', 'complete'),
(3, 6, '2024-04-29', 'on hold'),
(4, 5, '2024-04-29', 'on hold'),
(5, 5, '2024-04-29', 'on hold'),
(6, 10, '2024-04-29', 'on hold'),
(7, 10, '2024-04-29', 'on hold'),
(8, 10, '2024-04-29', 'on hold'),
(9, 1, '2024-05-06', 'on hold'),
(12, 11, '2024-05-06', 'on hold'),
(13, 11, '2024-05-06', 'on hold'),
(14, 11, '2024-05-06', 'on hold'),
(15, 11, '2024-05-06', 'on hold');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `sirName` varchar(20) NOT NULL,
  `contactNumber` int(20) NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateMade` date NOT NULL DEFAULT current_timestamp(),
  `profilePicture` varchar(299) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `firstName`, `sirName`, `contactNumber`, `studentID`, `email`, `password`, `dateMade`, `profilePicture`, `bio`) VALUES
(1, 'MerlinMage', '', '', 0, 101, '', 'hashed_password1', '2023-10-01', NULL, 'Merlin, the wise and ancient wizard of mythical lore.'),
(2, 'GandalfGrey', '', '', 0, 102, '', 'hashed_password2', '2023-10-02', NULL, 'Gandalf the Grey, wanderer and guide.'),
(3, 'WandaWitch', '', '', 0, 103, '', 'hashed_password3', '2023-10-03', NULL, 'Wanda the Witch, master of spells and potions.'),
(4, 'Dumbledore', '', '', 0, 104, '', 'hashed_password4', '2023-10-04', NULL, 'Dumbledore, headmaster and sage of secrets.'),
(5, 'SarumanWhite', '', '', 0, 105, '', 'hashed_password5', '2023-10-05', NULL, 'Saruman the White, cunning and powerful.'),
(6, 'MorganaFey', '', '', 0, 106, '', 'hashed_password6', '2023-10-06', NULL, 'Morgana, enchantress from the Arthurian legend.'),
(7, 'RadagastBrown', '', '', 0, 107, '', 'hashed_password7', '2023-10-07', NULL, 'Radagast the Brown, friend to all creatures.'),
(8, 'ElminsterAumar', '', '', 0, 108, '', 'hashed_password8', '2023-10-08', NULL, 'Elminster Aumar, the sage of Shadowdale.'),
(9, 'Rincewind', '', '', 0, 109, '', 'hashed_password9', '2023-10-09', NULL, 'Rincewind, a wizard with a knack for survival.'),
(10, 'Voldemort', '', '', 0, 110, '', 'hashed_password10', '2023-10-10', NULL, 'He-Who-Must-Not-Be-Named, feared by all.'),
(11, 'abc123', 'hello', 'olleh', 2147483647, 2022051801, '2022051801@feu.edu.ph', 'e99a18c428cb38d5f260853678922e03', '2024-05-05', 'Screenshot (119).png', 'hello, ako si olleh'),
(12, 'tamat', '', '', 0, NULL, '2022037221@feu.edu.ph', '05b00c31c6a87c6b4c7db9bbebc6169d', '2024-05-06', 'verified.png', NULL),
(13, 'MATTTETE', '', '', 0, NULL, '20200@feu.edu.ph', 'b3dcba0f798163f1a1af6625ae260010', '2024-05-06', 'user (1).png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `FK` (`userID`,`sellerID`);

--
-- Indexes for table `changetransaction`
--
ALTER TABLE `changetransaction`
  ADD PRIMARY KEY (`changeTransactionID`),
  ADD KEY `fk_ChangeTransaction_transactionID` (`transactionID`);

--
-- Indexes for table `clicks`
--
ALTER TABLE `clicks`
  ADD KEY `:)` (`productID`),
  ADD KEY `{:` (`userID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `fk_sellerID` (`sellerID`);

--
-- Indexes for table `producthistory`
--
ALTER TABLE `producthistory`
  ADD PRIMARY KEY (`productTransactionID`),
  ADD KEY `fk_ProductHistory_productID` (`productID`),
  ADD KEY `fk_ProductHistory_transactionID` (`transactionID`);

--
-- Indexes for table `ratinghistory`
--
ALTER TABLE `ratinghistory`
  ADD PRIMARY KEY (`ratingID`),
  ADD KEY `fk_RatingHistory_userID` (`userID`),
  ADD KEY `fk_RatingHistory_sellerID` (`sellerID`),
  ADD KEY `fk_RatingHistory_productID` (`productID`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`sellerID`),
  ADD KEY `fk_userID` (`userID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `fk_Transactions_userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `changetransaction`
--
ALTER TABLE `changetransaction`
  MODIFY `changeTransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `producthistory`
--
ALTER TABLE `producthistory`
  MODIFY `productTransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ratinghistory`
--
ALTER TABLE `ratinghistory`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `sellerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `changetransaction`
--
ALTER TABLE `changetransaction`
  ADD CONSTRAINT `fk_ChangeTransaction_transactionID` FOREIGN KEY (`transactionID`) REFERENCES `transactions` (`transactionID`);

--
-- Constraints for table `clicks`
--
ALTER TABLE `clicks`
  ADD CONSTRAINT `:)` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `{:` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_sellerID` FOREIGN KEY (`sellerID`) REFERENCES `sellers` (`sellerID`);

--
-- Constraints for table `producthistory`
--
ALTER TABLE `producthistory`
  ADD CONSTRAINT `fk_ProductHistory_productID` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `fk_ProductHistory_transactionID` FOREIGN KEY (`transactionID`) REFERENCES `transactions` (`transactionID`);

--
-- Constraints for table `ratinghistory`
--
ALTER TABLE `ratinghistory`
  ADD CONSTRAINT `fk_RatingHistory_productID` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `fk_RatingHistory_sellerID` FOREIGN KEY (`sellerID`) REFERENCES `sellers` (`sellerID`),
  ADD CONSTRAINT `fk_RatingHistory_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_Transactions_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
