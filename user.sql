-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 18, 2023 at 03:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(225) NOT NULL,
  `l_name` varchar(225) NOT NULL,
  `b_day` date DEFAULT NULL,
  `gender` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `contact_no` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `b_day`, `gender`, `address`, `email`, `contact_no`) VALUES
(3, 'Michaels', 'Johnson', '1987-12-03', 'male', '789 Oak St, Village', 'michael.johnson@example.com', '4561237890'),
(4, 'Emilys', 'Williams', '1992-10-15', 'female', '101 Pine St, Hamlet', 'emily.williams@example.com', '7894561230'),
(5, 'Chris', 'Brown', '1985-06-30', 'male', '222 Cedar St, County', 'chris.brown@example.com', '3216549870'),
(8, 'Jessica', 'Garcia', '1989-11-05', 'female', '555 Pine St, City', 'jessica.garcia@example.com', '6547893210'),
(9, 'David', 'Rodriguez', '1991-07-08', 'male', '666 Oak St, Village', 'david.rodriguez@example.com', '3214569870'),
(10, 'Sophia', 'Lopez', '1997-02-28', 'female', '777 Elm St, Town', 'sophia.lopez@example.com', '7893216540'),
(11, 'Matthew', 'Hernandez', '1986-03-12', 'male', '888 Cedar St, County', 'matthew.hernandez@example.com', '1478523690'),
(12, 'Olivia', 'Gonzalez', '1994-01-19', 'female', '999 Maple St, Suburb', 'olivia.gonzalez@example.com', '9638527410'),
(13, 'Andrew', 'Perez', '1996-06-05', 'male', '111 Birch St, Town', 'andrew.perez@example.com', '2583691470'),
(14, 'Ava', 'Torres', '1998-09-30', 'female', '222 Pine St, City', 'ava.torres@example.com', '7896541230'),
(15, 'Daniel', 'Sanchez', '1999-11-27', 'male', '333 Oak St, Village', 'daniel.sanchez@example.com', '6543219870'),
(16, 'Chloe', 'Rivera', '1990-08-14', 'female', '444 Elm St, Town', 'chloe.rivera@example.com', '3219876540'),
(17, 'James', 'Nguyen', '1987-12-01', 'male', '555 Cedar St, County', 'james.nguyen@example.com', '1478523690'),
(18, 'Mia', 'Kim', '1992-05-09', 'female', '666 Maple St, Suburb', 'mia.kim@example.com', '9876543210'),
(19, 'Ethan', 'Chan', '1994-10-22', 'male', '777 Birch St, Town', 'ethan.chan@example.com', '3691478520'),
(20, 'Isabella', 'Wong', '1991-03-17', 'female', '888 Pine St, City', 'isabella.wong@example.com', '8523691470'),
(21, 'jhon', 'doe', '1993-04-18', 'male', '333 Maple St, Suburb', 'sarah.davis@example.com', '4567891230'),
(22, 'teresita', 'cuago', '2023-12-23', 'female', 'earth', 'teresita.cuago@mail.com', '09456265');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
