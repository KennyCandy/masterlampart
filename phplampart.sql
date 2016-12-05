-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2016 at 04:02 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplampart`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `user_id_to` int(10) DEFAULT NULL,
  `register_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `user_id_to`, `register_datetime`) VALUES
(1, 10, 11, '2016-05-20 00:00:00'),
(2, 7, 20, '2016-04-27 00:00:00'),
(3, 6, 16, '2016-10-04 00:00:00'),
(4, 1, 13, '2016-08-08 00:00:00'),
(5, 7, 11, '2015-12-26 00:00:00'),
(6, 2, 17, '2016-11-02 00:00:00'),
(7, 5, 18, '2016-06-07 00:00:00'),
(8, 4, 11, '2016-11-04 00:00:00'),
(9, 10, 17, '2015-12-08 00:00:00'),
(10, 10, 12, '2016-11-22 00:00:00'),
(11, 6, 18, '2016-09-27 00:00:00'),
(12, 9, 15, '2016-09-03 00:00:00'),
(13, 9, 17, '2015-11-30 00:00:00'),
(14, 8, 20, '2016-05-31 00:00:00'),
(15, 2, 20, '2016-04-13 00:00:00'),
(16, 2, 15, '2016-10-24 00:00:00'),
(17, 3, 12, '2016-08-01 00:00:00'),
(18, 2, 20, '2016-08-16 00:00:00'),
(19, 2, 16, '2016-08-19 00:00:00'),
(20, 6, 20, '2016-09-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `user_id_to` int(10) DEFAULT NULL,
  `register_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `user_id`, `user_id_to`, `register_datetime`) VALUES
(1, 10, 18, '2016-07-29 00:00:00'),
(2, 5, 20, '2016-10-10 00:00:00'),
(3, 7, 11, '2015-12-17 00:00:00'),
(4, 9, 13, '2016-09-16 00:00:00'),
(5, 8, 18, '2016-02-19 00:00:00'),
(6, 5, 16, '2016-08-04 00:00:00'),
(7, 4, 19, '2016-08-24 00:00:00'),
(8, 6, 13, '2016-07-12 00:00:00'),
(9, 7, 12, '2016-07-27 00:00:00'),
(10, 1, 16, '2016-04-30 00:00:00'),
(11, 6, 18, '2015-12-03 00:00:00'),
(12, 9, 15, '2016-04-30 00:00:00'),
(13, 2, 12, '2016-10-03 00:00:00'),
(14, 3, 18, '2016-03-11 00:00:00'),
(15, 4, 16, '2016-09-05 00:00:00'),
(16, 9, 20, '2016-01-10 00:00:00'),
(17, 3, 16, '2016-01-07 00:00:00'),
(18, 3, 19, '2016-05-08 00:00:00'),
(19, 8, 11, '2016-03-29 00:00:00'),
(20, 8, 15, '2016-11-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `friend_relation`
--

CREATE TABLE `friend_relation` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `user_id_to` int(10) DEFAULT NULL,
  `register_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friend_relation`
--

INSERT INTO `friend_relation` (`id`, `user_id`, `user_id_to`, `register_datetime`) VALUES
(1, 10, 14, '2016-05-24 00:00:00'),
(2, 4, 19, '2016-01-17 00:00:00'),
(3, 3, 12, '2016-01-12 00:00:00'),
(4, 6, 16, '2016-01-24 00:00:00'),
(5, 8, 18, '2016-04-22 00:00:00'),
(6, 4, 13, '2016-01-31 00:00:00'),
(7, 10, 17, '2016-07-14 00:00:00'),
(8, 8, 18, '2016-07-17 00:00:00'),
(9, 5, 17, '2016-04-25 00:00:00'),
(10, 2, 15, '2016-09-30 00:00:00'),
(11, 7, 15, '2015-12-16 00:00:00'),
(12, 6, 18, '2015-12-06 00:00:00'),
(13, 9, 19, '2016-07-22 00:00:00'),
(14, 10, 14, '2016-05-01 00:00:00'),
(15, 2, 15, '2016-02-12 00:00:00'),
(16, 7, 15, '2016-02-20 00:00:00'),
(17, 9, 13, '2016-05-16 00:00:00'),
(18, 9, 13, '2016-06-04 00:00:00'),
(19, 4, 13, '2016-04-12 00:00:00'),
(20, 10, 14, '2016-07-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `user_id_to` int(10) DEFAULT NULL,
  `register_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`id`, `user_id`, `user_id_to`, `register_datetime`) VALUES
(1, 5, 12, '2016-01-19 00:00:00'),
(2, 5, 16, '2016-10-31 00:00:00'),
(3, 7, 16, '2016-06-13 00:00:00'),
(4, 2, 16, '2016-09-11 00:00:00'),
(5, 1, 17, '2016-10-18 00:00:00'),
(6, 4, 18, '2015-12-19 00:00:00'),
(7, 9, 16, '2016-04-01 00:00:00'),
(8, 8, 20, '2016-07-11 00:00:00'),
(9, 9, 16, '2016-02-06 00:00:00'),
(10, 3, 20, '2016-03-17 00:00:00'),
(11, 4, 17, '2015-12-27 00:00:00'),
(12, 2, 12, '2016-11-11 00:00:00'),
(13, 8, 20, '2016-03-12 00:00:00'),
(14, 3, 20, '2016-07-31 00:00:00'),
(15, 7, 16, '2016-05-28 00:00:00'),
(16, 5, 13, '2016-03-06 00:00:00'),
(17, 6, 17, '2016-02-17 00:00:00'),
(18, 7, 15, '2016-11-25 00:00:00'),
(19, 1, 15, '2016-07-08 00:00:00'),
(20, 5, 15, '2016-08-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(10) NOT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `register_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `level`, `name`, `register_datetime`) VALUES
(1, 1, 'John Hamster', '2016-11-01 00:00:00'),
(2, 3, 'Wayne Roberts', '2016-09-23 00:00:00'),
(3, 3, 'Wanda Wallace', '2016-06-12 00:00:00'),
(4, 3, 'Cynthia Rodriguez', '2016-11-13 00:00:00'),
(5, 3, 'Deborah Ward', '2016-02-24 00:00:00'),
(6, 3, 'Bonnie Olson', '2016-02-21 00:00:00'),
(7, 3, 'Roy Willis', '2016-09-20 00:00:00'),
(8, 1, 'Bobby Harris', '2016-04-05 00:00:00'),
(9, 2, 'Kelly Rice', '2016-02-16 00:00:00'),
(10, 1, 'Laura Chavez', '2016-04-05 00:00:00'),
(11, 2, 'Timothy Matthews', '2016-03-23 00:00:00'),
(12, 1, 'Johnny Andrews', '2016-03-20 00:00:00'),
(13, 2, 'Emily Austin', '2016-10-09 00:00:00'),
(14, 3, 'Phyllis Daniels', '2015-12-02 00:00:00'),
(15, 2, 'Samuel Wheeler', '2016-02-04 00:00:00'),
(16, 2, 'Richard Hanson', '2016-03-10 00:00:00'),
(17, 2, 'Anna Diaz', '2016-01-23 00:00:00'),
(18, 2, 'Dorothy Hernandez', '2016-03-17 00:00:00'),
(19, 1, 'Henry Nelson', '2016-05-19 00:00:00'),
(20, 1, 'Johnny Crawford', '2016-11-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `message_log`
--

CREATE TABLE `message_log` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `user_id_to` int(10) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `register_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_log`
--

INSERT INTO `message_log` (`id`, `user_id`, `user_id_to`, `message`, `register_datetime`) VALUES
(1, 5, 20, 'optimize efficient e-commerce', '2016-07-27 00:00:00'),
(2, 2, 18, 'cultivate compelling communities', '2016-11-02 00:00:00'),
(3, 8, 19, 'architect cross-platform convergence', '2015-12-24 00:00:00'),
(4, 3, 20, 'embrace end-to-end channels', '2016-08-05 00:00:00'),
(5, 4, 16, 'syndicate robust e-business', '2016-05-20 00:00:00'),
(6, 7, 14, 'generate leading-edge communities', '2016-03-14 00:00:00'),
(7, 5, 20, 'brand cutting-edge supply-chains', '2016-03-21 00:00:00'),
(8, 9, 19, 'scale bricks-and-clicks solutions', '2016-11-22 00:00:00'),
(9, 4, 13, 'repurpose collaborative experiences', '2016-01-04 00:00:00'),
(10, 4, 19, 'synergize robust synergies', '2016-05-27 00:00:00'),
(11, 6, 14, 'visualize back-end content', '2015-11-30 00:00:00'),
(12, 2, 16, 'exploit visionary e-commerce', '2016-07-30 00:00:00'),
(13, 10, 16, 'enable dynamic initiatives', '2015-12-22 00:00:00'),
(14, 1, 19, 'disintermediate seamless models', '2015-11-30 00:00:00'),
(15, 1, 11, 'evolve cutting-edge content', '2015-11-29 00:00:00'),
(16, 3, 13, 'incubate dot-com infrastructures', '2016-11-12 00:00:00'),
(17, 6, 18, 'target killer e-markets', '2016-03-12 00:00:00'),
(18, 6, 18, 'e-enable rich markets', '2016-01-28 00:00:00'),
(19, 3, 20, 'expedite web-enabled schemas', '2016-05-08 00:00:00'),
(20, 3, 12, 'enhance scalable infrastructures', '2016-09-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `content` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `user_id`, `token`, `content`, `type`, `status`) VALUES
(2, 111, '3c3bfbd59c85fe0cb445f393ec277f00', '', 'account', 1),
(3, 111, 'a7e15e42ab30e9f357a7d3a873e679a8', 'bolanisvn@gmail.com', 'email', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `fullname` varchar(32) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `birthday` date DEFAULT '0000-00-00',
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This is user table';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `sex`, `birthday`, `address`, `email`, `status`, `group_id`) VALUES
(1, 'trinhnguyen', '123123', 'trinh nguyen quoc', 1, '1992-02-12', '160 Nguyen Van Quy Quan 7', '1', 1, 1),
(2, 'sonvi', '123123', 'son vi hoang', 1, '1991-01-12', '120 Phu Nhuan', 'visan@gmail.com', 1, 1),
(3, 'brice2', 'R3QSJyO', 'Bobby Rice', 1, '1981-07-17', '5 Buhler Way', 'brice2@sun.com', 0, 1),
(101, 'trinhtrinh', '19d40526d4f412f467b7e06be025b921', 'trinhtrinh nguyen sasdasd', 1, '2013-02-08', 'Nguyen van quy q7 11', 'nguyenquoctrinhcttasda3@gmail.com', 1, 1),
(102, 'lala', '6a969262f945d2420387f561cc48d992', 'lalala nguyen', 1, '2012-03-02', 'lalala HCM', 'lala@gmail.com', 0, 1),
(103, 'lalala', '6a969262f945d2420387f561cc48d992', 'lalala nguyen', 1, '2011-07-04', 'asdasd', 'lalala@gmail.com', 1, 1),
(104, 'lalala1', '6a969262f945d2420387f561cc48d992', 'lalala Nguyen', 1, '1995-02-12', 'lalala at Sanfran', 'lalala1@gmail.com', 0, 1),
(105, 'lalala12', '6a969262f945d2420387f561cc48d992', 'lalala Nguyen', 1, '1995-02-12', 'lalala at Sanfran', 'lalala11@gmail.com', 0, 1),
(106, 'xzczxczxc', '63c4602ce36424359581869f28368fc5', 'sdasdasd', 1, '1995-02-12', 'lalala at Sanfran', 'lalala11sd@gmail.com', 0, 1),
(111, 'zxczxc', '170e71d5d2b37fb161a65ef5b16fc579', 'zxczxczxczx', 1, '2012-07-03', 'zxczxc zxczxc', 'bolanisvn@gmail.com', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_relation`
--
ALTER TABLE `friend_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_log`
--
ALTER TABLE `message_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `friend_relation`
--
ALTER TABLE `friend_relation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `message_log`
--
ALTER TABLE `message_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
