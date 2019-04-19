-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2019 at 02:59 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbslab`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `name`, `info`, `cover`, `genre`) VALUES
(1, 'cormen, Introduction to algorithms', 'Coding related algorithms', '4.jpg', 'academics'),
(2, 'Harry Potter and the sorcerer\'s stone', 'Part of harry potter fictional series', '7.jpg', 'fiction'),
(3, 'Harry Potter and the prisoner of azkaban', 'Part of harry potter series', '9.jpg', 'fiction'),
(4, 'Harry potter and the chamber of secrets', 'Part of harry potter series', '10.jpeg', 'fiction'),
(5, 'Erwin Kresyzig', 'Maths problems', '5.jpg', 'academics'),
(6, 'Kurose and ross', 'networking book', '6.jpg', 'academics'),
(7, 'Hellen Keller', 'Autobiography of a young lady', '14.jpg', 'autobiography'),
(8, 'Dennis Ritchie', 'book for studying C', '15.jpg', 'academics'),
(9, 'Wings of fire', 'autobiography of APJ Abdul Kalam', '16.jpg', 'autobiography'),
(10, 'Networking Fundamentals', 'book for studying Networking', '17.jpg', 'academics'),
(11, 'Diary of a Young girl', 'Autobiography of anne frank', '18.jpg', 'autobiography'),
(12, 'Steve Jobs', 'autobiography of steve jobs', '19.jpg', 'autobiography'),
(13, 'Incredible Hulk', 'Life of hulk', '20.jpg', 'comics'),
(14, 'The amazing spider man', 'life story of spiderman', '21.jpg', 'comics'),
(15, 'Adventure Time', 'Short comic book for kids', '22.jpg', 'comics'),
(16, 'Database system concepts', 'Book for databsase management system', '23.jpeg', 'academics'),
(17, 'kelly armstrong', 'autobiography of kelly armstrong', '24.jpeg', 'autobiography'),
(18, 'Hulk and wolverine', 'Intersenting matchup between 2 marvel heroes', '25.jpeg', 'comics'),
(19, 'Captain Ginger', 'new superhero in town', '26.jpeg', 'comics'),
(20, 'George R martin', 'Story of game of thrones', '27.jpg', 'fiction'),
(21, 'Mein Kamph', 'autobiography of adolf hitler', '28.jpg', 'autobiography'),
(22, 'Tarzen', 'Adventures of tarzen', '29.jpg', 'comics');

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `yr` int(4) DEFAULT NULL,
  `batch` char(3) DEFAULT NULL,
  `rollno` int(3) DEFAULT NULL,
  `bookid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lender`
--

CREATE TABLE `lender` (
  `yr` int(4) DEFAULT NULL,
  `batch` char(3) DEFAULT NULL,
  `rollno` int(3) DEFAULT NULL,
  `bookid` int(11) DEFAULT NULL,
  `entry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lender`
--

INSERT INTO `lender` (`yr`, `batch`, `rollno`, `bookid`, `entry`) VALUES
(2018, 'bcs', 48, 1, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 1, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 2, '2016-11-05 09:45:23'),
(2018, 'bcs', 48, 3, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 4, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 5, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 6, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 7, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 8, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 9, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 10, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 11, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 12, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 13, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 14, '2015-11-05 09:45:23'),
(2018, 'bcs', 48, 15, '2015-11-05 09:45:23'),
(2018, 'bcs', 31, 16, '2015-11-05 09:45:23'),
(2018, 'bcs', 31, 17, '2015-11-05 09:45:23'),
(2018, 'bcs', 31, 18, '2015-11-05 09:45:23'),
(2018, 'bcs', 31, 19, '2015-11-05 09:45:23'),
(2018, 'bcs', 46, 20, '2015-11-05 09:45:23'),
(2018, 'bcs', 46, 21, '2015-11-05 09:45:23'),
(2018, 'bcs', 46, 22, '2015-11-05 09:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `byr` int(4) DEFAULT NULL,
  `bbatch` char(3) DEFAULT NULL,
  `brollno` int(3) DEFAULT NULL,
  `lyr` int(4) DEFAULT NULL,
  `lbatch` char(3) DEFAULT NULL,
  `lrollno` int(3) DEFAULT NULL,
  `bookid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `byr` int(4) DEFAULT NULL,
  `bbatch` char(3) DEFAULT NULL,
  `brollno` int(3) DEFAULT NULL,
  `lyr` int(4) DEFAULT NULL,
  `lbatch` char(3) DEFAULT NULL,
  `lrollno` int(3) DEFAULT NULL,
  `bookid` int(11) DEFAULT NULL,
  `entry` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`byr`, `bbatch`, `brollno`, `lyr`, `lbatch`, `lrollno`, `bookid`, `entry`, `status`) VALUES
(2018, 'bcs', 48, 2018, 'bcs', 31, 17, '2015-12-12 23:23:23', 0),
(2018, 'bcs', 48, 2018, 'bcs', 31, 19, '2015-12-12 23:23:23', 0),
(2018, 'bcs', 48, 2018, 'bcs', 31, 16, '2015-12-12 23:23:23', 0),
(2018, 'bcs', 48, 2018, 'bcs', 46, 20, '2015-12-12 23:23:23', 0),
(2018, 'bcs', 31, 2018, 'bcs', 48, 1, '2015-12-12 23:23:23', 0),
(2018, 'bcs', 31, 2018, 'bcs', 48, 2, '2015-12-12 23:23:23', 0),
(2018, 'bcs', 31, 2018, 'bcs', 48, 5, '2015-12-12 23:23:23', 0),
(2018, 'bcs', 46, 2018, 'bcs', 48, 4, '2015-12-12 23:23:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(80) DEFAULT NULL,
  `Yr` int(4) NOT NULL,
  `Batch` char(3) NOT NULL,
  `RollNo` int(11) NOT NULL,
  `Points` int(11) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Institute` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Yr`, `Batch`, `RollNo`, `Points`, `Password`, `Institute`, `pic`) VALUES
('aditi singh', 2018, 'bcs', 3, 5, '390acd12e87e5e719d03151eed9d9b77f4be8f34', 'ABV-IIITM', '11.png'),
('guna shekhar', 2018, 'bcs', 31, 10, 'e97f3492f74c6b2568f049630af27490531a2d16', 'ABV-IIITM', '11.png'),
('sakshi rai', 2018, 'bcs', 46, 5, 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'ABV-IIITM', '11.png'),
('Saniya Arora', 2018, 'bcs', 48, 5, '2cbe9ba5d8a84edcbd483f0905ba25a9e6bb2d8a', 'ABV-IIITM', '11.png'),
('Ankit Kumar', 2018, 'img', 10, 5, '06e3cee6dae89ba0b99f247481327cbbaeeb5cb9', 'ABV-IIITM', '1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Yr`,`Batch`,`RollNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
