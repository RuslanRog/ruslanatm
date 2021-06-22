-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2021 at 06:34 AM
-- Server version: 5.7.29-log
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atm_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `live_data` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cvv` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_name` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `card_number`, `pin`, `live_data`, `cvv`, `card_name`) VALUES
(1, 2, '1111222233334444', '2349', '0924', '123', 'Visa'),
(2, 2, '1122334455667788', '1140', '1123', '563', 'Visa Gold'),
(3, 3, '3452203433332414', '0045', '0424', '783', 'Visa'),
(4, 3, '2131222132365771', '2345', '0722', '129', 'MasterCard'),
(5, 1, '3451117828749965', '9346', '0424', '120', 'Visa'),
(6, 4, '8912452333344337', '8340', '0524', '125', 'MasterCard'),
(7, 4, '8071224333344876', '7341', '0322', '143', 'Visa'),
(8, 5, '7601124533344567', '0345', '0223', '723', 'MasterCard');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `atm_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` int(3) NOT NULL,
  `date_operation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `card_id`, `atm_number`, `balance`, `action`, `date_operation`) VALUES
(1, 1, '6765767', '20000', 20000, '2021-06-09 10:22:41'),
(2, 2, '6765767', '10000', 100, '2021-06-09 13:25:43'),
(3, 2, '6765767', '9900', -100, '2021-06-09 13:38:03'),
(4, 3, '6765767', '1000', 100, '2021-06-09 14:05:53'),
(5, 3, '6765767', '800', -200, '2021-06-09 15:30:13'),
(6, 4, '6765767', '500', -500, '2021-06-09 15:30:13'),
(7, 5, '6765767', '800', -200, '2021-06-09 09:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `patronymic`) VALUES
(1, 'Vasia', 'Pupkin', 'Oleseevich'),
(2, 'Jorik', 'Homa', 'Dingo'),
(3, 'Ihor', 'Petrovych', 'Hlushchenko'),
(4, 'Ostap', 'Kuzmych', 'Okhrimenko'),
(5, 'Andrij', 'Danylovych', 'Datsenko');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
