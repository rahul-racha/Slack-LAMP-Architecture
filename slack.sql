-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2017 at 04:24 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slack`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel_messages`
--

CREATE TABLE `channel_messages` (
  `channel_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `msg_id` varchar(20) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(10) NOT NULL,
  `dependency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `direct_message`
--

CREATE TABLE `direct_message` (
  `user1` varchar(20) NOT NULL,
  `user2` varchar(20) NOT NULL,
  `direct_msg_id` int(11) NOT NULL,
  `direct_message` varchar(2000) NOT NULL,
  `url` varchar(20) NOT NULL,
  `direct_message_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inside_channel`
--

CREATE TABLE `inside_channel` (
  `channel_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `left_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `display_name` varchar(20) NOT NULL,
  `what_i_do` varchar(128) DEFAULT NULL,
  `status` varchar(128) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `time_zone` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `skype` varchar(50) NOT NULL,
  `avatar` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workspace`
--

CREATE TABLE `workspace` (
  `url` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `created_by` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workspace_channels`
--

CREATE TABLE `workspace_channels` (
  `channel_id` int(11) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  `url` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `purpose` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD PRIMARY KEY (`channel_id`,`user_id`,`msg_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD PRIMARY KEY (`direct_msg_id`);

--
-- Indexes for table `inside_channel`
--
ALTER TABLE `inside_channel`
  ADD PRIMARY KEY (`channel_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `workspace`
--
ALTER TABLE `workspace`
  ADD PRIMARY KEY (`url`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  ADD PRIMARY KEY (`channel_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `url` (`url`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD CONSTRAINT `channel_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `inside_channel`
--
ALTER TABLE `inside_channel`
  ADD CONSTRAINT `inside_channel_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`),
  ADD CONSTRAINT `inside_channel_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `inside_channel_ibfk_3` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`);

--
-- Constraints for table `workspace`
--
ALTER TABLE `workspace`
  ADD CONSTRAINT `workspace_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  ADD CONSTRAINT `workspace_channels_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `workspace_channels_ibfk_2` FOREIGN KEY (`url`) REFERENCES `workspace` (`url`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
