-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 09:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kali`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender` varchar(32) NOT NULL,
  `reciever` varchar(32) NOT NULL,
  `message` varchar(1024) NOT NULL,
  `message_time` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender`, `reciever`, `message`, `message_time`) VALUES
(6, 'kalimuthu', 'kama', 'hello kama you are doing a wounderful job!!', '2020-12-08 19:56'),
(7, 'palani', 'kalimuthu', 'yo!man you are doing good!!', '2020-12-08 20:07'),
(8, 'kalimuthu', 'kama', 'such a patriotic job you are doing!!', '2020-12-08 20:12'),
(9, 'kalimuthu', 'palani', 'hello palani how are you.', '2020-12-08 20:24');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `food_type` varchar(32) NOT NULL,
  `food_value` varchar(10) NOT NULL,
  `food_quantity` varchar(32) NOT NULL,
  `quantity_value` varchar(12) NOT NULL,
  `time_limit` varchar(5) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `posting_time` varchar(32) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `post_accepted` int(11) NOT NULL DEFAULT 0,
  `accept_time` varchar(32) NOT NULL,
  `picture` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `food_type`, `food_value`, `food_quantity`, `quantity_value`, `time_limit`, `active`, `user_id`, `posting_time`, `description`, `post_accepted`, `accept_time`, `picture`) VALUES
(46, 'veg curd rice', '', '23', '', '5', 0, 43, '2020-12-08 20:06', 'enjoy the meal my friends!!', 50, '', ''),
(47, 'saturday meals', '', '122', '', '2', 0, 50, '2020-12-12 14:51', 'enjoy meal!!', 43, '2020-12-13 15:07', ''),
(50, 'channa', '', '13', '', '1', 0, 50, '2020-12-13 15:23', 'delete', 43, '2020-12-13 16:18', ''),
(60, 'midday cravings', '', '12', '', '2', 0, 43, '2020-12-15 13:58', 'enjoy the meals!!', 0, '', 'images/post2eb4d65fb6.jpg'),
(61, 'evening snacks', '', '12', '', '2', 0, 43, '2020-12-15 16:29', 'hello!!', 0, '', 'images/post/819b92a342.png'),
(69, 'break fast', 'non-veg', '3', 'persons', '3', 1, 43, '2020-12-17 13:34', 'hello world!', 0, '', 'images/post/c3d3d9edc0.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_id` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email_code` varchar(32) NOT NULL,
  `password_recovery` int(11) NOT NULL DEFAULT 0,
  `user_type` int(11) NOT NULL DEFAULT 0,
  `allow_email` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 0,
  `address` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `contact_no1` varchar(32) NOT NULL,
  `contact_no2` varchar(32) NOT NULL,
  `liscense_no` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `profile_pic` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `email_id`, `password`, `email_code`, `password_recovery`, `user_type`, `allow_email`, `active`, `address`, `location`, `contact_no1`, `contact_no2`, `liscense_no`, `city`, `profile_pic`) VALUES
(43, 'kalimuthu', 'kalimuthu', 'kids welfare', 'cmkalimuthu@gmail.com', 'f24af46b6c5ad1a8359e8d98b4cc3289', '7401a4e5f0d5e67883e0864d24a74d5d', 0, 1, 1, 1, '11 a sathamangalam main road west anna nagar madurai-20', 'goolge/loc', '8248343334', '8248343334', 'askk12345', 'coimbatore', ''),
(44, 'palani', 'palanikumar', 'old age home', 'cmkalimuthukalee@gmail.com', 'c0315bd7bb2bf75ef0dc34609ea42b39', 'b5966469f17040a465f470f94b174ebc', 0, 0, 0, 1, '11 a sathamanagalm main road west annanagar madurai-20', 'google/loc', '9952318078', '9952318078', 'aram12345', 'madurai', ''),
(50, 'kama', 'kamakshi', 'childrens home', '17euit062@skcet.ac.in', '39f6bbdc984c6c6dcaad25dfb5104644', 'f4064201fe0a6f27a3a90c83db52446b', 0, 0, 0, 1, 'sunnambu kaalavasal saravanampatti coimbatore.', 'covai/google', '9042473040', '9042473040', 'life123456', 'coimbatore', 'images/profile/3c5475c5f7.jpg'),
(55, 'anbu illam', 'anbu illam', 'old age home', 'kalimuthu.c1999@gmail.com', '1ffdfe877ed079bf82d20a95e9efdf6a', '0a4ad78db63c8ce89c5e6b05ac66baab', 0, 0, 0, 1, 'ukkadam anbu illam coimbatore.', '9.9218293,78.1420123', '9898989898', '9898989898', 'anbu1234', 'coimbatore', ''),
(56, 'annai', 'annai', 'orphanage', '17euit064@skcet.ac.in', 'fcea920f7412b5da7be0cf42b8c93759', 'a5d5bdc07776a20166761653f5a22aa4', 0, 0, 0, 1, 'ramanathapurum coimbatore.', 'map/loc/anbuillam', '9898989898', '9999999999', 'annai1234', 'coimbatore', ''),
(57, 'ajith', 'ajith', 'catering service', 'smajitbalaji@yahoo.com', '433a0648aa55197250ca5db1cdd007c9', '82f61adb0ffb576112cfb25734f2dc45', 0, 0, 0, 1, 'lakshmi mills coimbatore.', 'maps/google/coimbatore', '9898989898', '9999999999', 'ajith1234', 'coimbatore', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
