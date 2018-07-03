-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2018 at 11:56 PM
-- Server version: 10.2.15-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weddingwire`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `partner_firstname` varchar(255) NOT NULL,
  `partner_lastname` varchar(255) NOT NULL,
  `partner_role` varchar(255) NOT NULL,
  `proposal_date` date NOT NULL,
  `wedding_date` date NOT NULL,
  `budget_range` varchar(255) NOT NULL,
  `guest_range` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`user_id`, `first_name`, `last_name`, `user_role`, `partner_firstname`, `partner_lastname`, `partner_role`, `proposal_date`, `wedding_date`, `budget_range`, `guest_range`) VALUES
(13, 'David', 'Beckham', 'Groom', 'Venessa', 'Wangui', 'Bride', '2017-12-24', '2019-03-01', '500K-800K', '400-500');

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `total_budget` int(11) DEFAULT 0,
  `used_budget` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `userId`, `total_budget`, `used_budget`) VALUES
(1, 13, 800000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `budget_details`
--

CREATE TABLE `budget_details` (
  `expenseId` int(11) NOT NULL,
  `expense` text NOT NULL,
  `dueDate` varchar(255) DEFAULT NULL,
  `amount_spent` int(11) DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `vendor_contact` varchar(10) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `paid` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_details`
--

INSERT INTO `budget_details` (`expenseId`, `expense`, `dueDate`, `amount_spent`, `vendor`, `vendor_contact`, `notes`, `userId`, `paid`) VALUES
(1, 'Decorations', 'July 8, 2018', 12000, 'Flora explorer', '0', 'Read numbers', 13, 'true'),
(2, 'Florist', 'July 21, 2018', 20000, 'Maua Maua', '722145896', 'Delicious', 13, 'true'),
(4, 'Dresses', 'July 27, 2018', 12000, 'Porsche Designers', '0714555698', 'Pay a deposit ', 13, 'false'),
(5, 'Venue', 'July 21, 2018', 70000, 'Compuera Grounds', '0745896325', 'Ask for security', 13, 'true'),
(6, 'Food at reception', 'July 29, 2018', 150000, 'Njunguna\\\'s Catering', '0765321445', 'Check with the chef on the meals', 13, 'false'),
(8, 'Suits', 'July 22, 2018', 700, 'Smiles Collection', '711445669', '', 13, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `taskId` int(11) NOT NULL,
  `taskContent` text DEFAULT NULL,
  `dueDate` varchar(255) DEFAULT NULL,
  `taskNotes` text DEFAULT NULL,
  `completed` varchar(255) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`taskId`, `taskContent`, `dueDate`, `taskNotes`, `completed`, `userId`) VALUES
(8, 'Contact dress maker', 'July 20, 2018', 'Get number from Joan', 'false', 13),
(9, 'Start the wedding committe', 'July 15, 2018', '', 'true', 13),
(10, 'Find an extra brides maid', 'July 28, 2018', 'Ask Spaniard', 'true', 13),
(11, 'Select theme colours', 'July 22, 2018', 'Make sure Spaniard is there', 'false', 13),
(12, 'Ask Joan to be maid of honour', 'July 17, 2018', 'I hope she says yes', 'false', 13),
(13, 'Plan budget', 'December 28, 2018', '', 'false', 13),
(15, 'Outsource cars from friends', 'August 3, 2018', '', 'false', 13),
(18, 'Look for a florist', 'July 27, 2018', '', 'false', 13),
(19, 'Start my wedding vision board', 'October 25, 2018', 'Think big and beautifully', 'false', 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `username` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_code` text DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL,
  `account_setup` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `active`, `date_sent`, `reset_code`, `reset_expiry`, `account_setup`) VALUES
(13, 'waynewanyee@gmail.com', '$2y$10$iXUUtmCMsYlHqEZDJgaMyeqesZfboLMrhrui8JsztFZzgdBL8u006', 'Mushu', 1, '2018-06-17 18:47:58', 'a8f2a3e7-52c4-4f23-8d0c-4eeca436abd3', '2018-06-17 19:59:00', 1),
(17, 'stephwanyee@gmail.com', '$2y$10$1Iv.agOoJfqnN.DdnI.T.Oby7mGG2HM6jDHrQF88nfPjhIBCFRbiG', 'Wortell', 0, '2018-07-02 07:40:58', NULL, NULL, 0),
(18, 'stepwany8@gmail.com', '$2y$10$wDIsn6XWJB/qFsX38Vuoje9g9kD2uFqqI8kS55iQUWhmaEei/N5wW', 'admin', 1, '2018-07-02 07:42:48', NULL, NULL, 1),
(19, 'mark@mail.com', '$2y$10$qnT290f85Y8u/BjGq2qIQ.LEFHZSp1UVX813q/R.CAI73ICJlXP.O', 'Mark', 0, '2018-07-02 10:33:38', NULL, NULL, 0),
(20, 'rose@mail.com', '$2y$10$lfbUm8fSs4tnOlmMwY5EEuD/T.j6PvYkVVbwPeTIZlulS.AzZadQy', 'Realtor', 0, '2018-07-02 10:38:22', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD KEY `account_details_ibfk_1` (`user_id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `budget_details`
--
ALTER TABLE `budget_details`
  ADD PRIMARY KEY (`expenseId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`taskId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget_details`
--
ALTER TABLE `budget_details`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_details`
--
ALTER TABLE `account_details`
  ADD CONSTRAINT `account_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `budget_details`
--
ALTER TABLE `budget_details`
  ADD CONSTRAINT `budget_details_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `checklist_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
