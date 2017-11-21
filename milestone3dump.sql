-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2017 at 08:38 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `slack`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel_messages`
--
CREATE DATABASE `slack`;

USE `slack`;

CREATE TABLE `channel_messages` (
  `channel_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `msg_id` bigint(20) NOT NULL,
  `message` longtext,
  `image_path` varchar(100) DEFAULT NULL,
  `snippet` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` smallint(6) DEFAULT NULL,
  `dependency` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_messages`
--

INSERT INTO `channel_messages` (`channel_id`, `user_id`, `msg_id`, `message`, `image_path`, `snippet`, `created_time`, `type`, `dependency`) VALUES
(26, 'admin', 8, 'Opps', NULL, NULL, '2017-11-21 00:31:42', 1, 8),
(27, 'admin', 6, 'heyy', NULL, NULL, '2017-11-20 22:31:04', 1, 6),
(27, 'mater', 9, 'Hmm', NULL, NULL, '2017-11-21 07:01:43', 1, 9),
(27, 'mater', 10, 'Fine', NULL, NULL, '2017-11-21 07:01:46', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `direct_message`
--

CREATE TABLE `direct_message` (
  `user1` varchar(20) NOT NULL,
  `user2` varchar(20) NOT NULL,
  `direct_msg_id` int(11) NOT NULL,
  `direct_message` longtext NOT NULL,
  `url` varchar(20) NOT NULL,
  `direct_message_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emoticons`
--

CREATE TABLE `emoticons` (
  `emo_id` int(11) NOT NULL,
  `emo_name` varchar(10) NOT NULL,
  `image` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emoticons`
--

INSERT INTO `emoticons` (`emo_id`, `emo_name`, `image`) VALUES
(1, 'like', NULL),
(2, 'dislike', NULL);

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

--
-- Dumping data for table `inside_channel`
--

INSERT INTO `inside_channel` (`channel_id`, `user_id`, `joined_date`, `left_date`) VALUES
(26, 'admin', '2017-11-19 07:10:21', '0000-00-00 00:00:00'),
(26, 'mater', '2017-11-19 07:10:21', '0000-00-00 00:00:00'),
(27, 'admin', '2017-11-19 07:11:01', '0000-00-00 00:00:00'),
(27, 'mater', '2017-11-19 07:11:01', '0000-00-00 00:00:00'),
(27, 'porsche', '2017-11-19 07:11:01', '0000-00-00 00:00:00'),
(27, 'singhis', '2017-11-20 01:55:56', '0000-00-00 00:00:00'),
(28, 'admin', '2017-11-20 01:58:22', '0000-00-00 00:00:00'),
(28, 'chinga', '2017-11-20 01:58:22', '0000-00-00 00:00:00'),
(28, 'porsche', '2017-11-20 01:58:22', '0000-00-00 00:00:00'),
(29, 'admin', '2017-11-21 00:38:57', '0000-00-00 00:00:00'),
(29, 'singhis', '2017-11-21 00:38:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `message_type`
--

CREATE TABLE `message_type` (
  `ref_id` smallint(6) NOT NULL,
  `msg_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_type`
--

INSERT INTO `message_type` (`ref_id`, `msg_type`) VALUES
(1, 'post'),
(2, 'thread'),
(3, 'reply');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `msg_id` bigint(20) NOT NULL,
  `emo_id` int(11) NOT NULL,
  `users` longtext NOT NULL,
  `count` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`msg_id`, `emo_id`, `users`, `count`) VALUES
(6, 1, ';mater;', 1),
(6, 2, '', 0),
(8, 1, ';mater;', 1),
(8, 2, '', 0),
(9, 1, '', 0),
(9, 2, ';mater;', 1),
(10, 1, '', 0),
(10, 2, ';mater;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `reply_id` bigint(20) NOT NULL,
  `thread_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `what_i_do` varchar(128) DEFAULT NULL,
  `status` varchar(128) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `time_zone` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `skype` varchar(50) NOT NULL,
  `avatar` varchar(150) NOT NULL DEFAULT 'images/users/admin.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `password`, `first_name`, `last_name`, `display_name`, `role`, `what_i_do`, `status`, `phone_number`, `email`, `time_zone`, `skype`, `avatar`) VALUES
('admin', 'M0n@rch$', 'admin', '', 'admin', 'admin', NULL, '', '', '', '2017-11-21 19:38:00', '', 'images/users/admin.jpg'),
('chinga', '@chick', 'Chick', 'Hicks', 'Chick Hicks', 'user', NULL, '', '', 'chinga@cars.com', '2017-11-21 19:38:02', '', 'images/users/admin.jpg'),
('hornet', '@doc', 'Doc', ' Hudson', 'Doc  Hudson', 'user', NULL, '', '', 'hornet@rsprings.gov', '2017-11-21 19:38:04', '', 'images/users/admin.jpg'),
('iamami', '12345678Aa!', 'Amitabh', 'Bachan', '', 'user', NULL, '', '', 'amitab@ac.in', '2017-11-21 19:38:05', '', 'images/users/admin.jpg'),
('kachow', '@mcqueen', 'Lightning', 'McQueen', 'Lightning McQueen', 'user', NULL, '', '', 'kachow@rusteze.com', '2017-11-21 19:38:06', '', 'images/users/admin.jpg'),
('mater', '@mater', 'Tow', 'Mater', 'Tow Mater', 'user', NULL, '', '', 'mater@rsprings.gov', '2017-11-14 17:37:59', '', 'images/users/mater.jpg'),
('porsche', '@sally', 'Sally', 'Carrera', 'Sally Carrera', 'user', NULL, '', '', 'porsche@rsprings.gov', '2017-11-14 17:29:31', '', 'images/users/porsche.jpg'),
('singhis', '123', 'okay', 'singh', '', 'user', NULL, '', '', 'singh@s.com', '2017-11-21 19:38:08', '', 'images/users/admin.jpg'),
('topsecret', '@mcmissile', 'Finn', 'McMissile', 'Finn McMissile', 'user', NULL, '', '', 'topsecret@agent.org', '2017-11-21 19:38:10', '', 'images/users/admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `workspace`
--

CREATE TABLE `workspace` (
  `url` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `created_by` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workspace`
--

INSERT INTO `workspace` (`url`, `user_id`, `created_by`) VALUES
('musicf17.slack.com', 'admin', 0),
('musicf17.slack.com', 'chinga', 1),
('musicf17.slack.com', 'hornet', 0),
('musicf17.slack.com', 'iamami', 0),
('musicf17.slack.com', 'kachow', 0),
('musicf17.slack.com', 'mater', 0),
('musicf17.slack.com', 'porsche', 0),
('musicf17.slack.com', 'singhis', 0),
('musicf17.slack.com', 'topsecret', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workspace_channels`
--

CREATE TABLE `workspace_channels` (
  `channel_id` int(11) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  `url` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'unarchived'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workspace_channels`
--

INSERT INTO `workspace_channels` (`channel_id`, `channel_name`, `url`, `user_id`, `purpose`, `type`, `status`) VALUES
(26, 'general', 'musicf17.slack.com', 'mater', 'casual discussion', 'Public', 'unarchived'),
(27, 'jazz', 'musicf17.slack.com', 'mater', 'jazz news', 'Private', 'unarchived'),
(28, 'trial', 'musicf17.slack.com', 'porsche', '', 'Public', 'archived'),
(29, 'test1', 'musicf17.slack.com', 'admin', 'for you', 'Private', 'unarchived');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD PRIMARY KEY (`channel_id`,`user_id`,`msg_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `msg_id` (`msg_id`),
  ADD KEY `type` (`type`),
  ADD KEY `dependency` (`dependency`);

--
-- Indexes for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD PRIMARY KEY (`direct_msg_id`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`);

--
-- Indexes for table `emoticons`
--
ALTER TABLE `emoticons`
  ADD PRIMARY KEY (`emo_id`);

--
-- Indexes for table `inside_channel`
--
ALTER TABLE `inside_channel`
  ADD PRIMARY KEY (`channel_id`,`user_id`),
  ADD KEY `inside_channel_ibfk_1` (`user_id`);

--
-- Indexes for table `message_type`
--
ALTER TABLE `message_type`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`msg_id`,`emo_id`),
  ADD KEY `msg_id` (`msg_id`),
  ADD KEY `emo_id` (`emo_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `reply_id` (`reply_id`);

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
-- AUTO_INCREMENT for table `direct_message`
--
ALTER TABLE `direct_message`
  MODIFY `direct_msg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emoticons`
--
ALTER TABLE `emoticons`
  MODIFY `emo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD CONSTRAINT `channel_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `channel_messages_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `channel_messages_ibfk_4` FOREIGN KEY (`type`) REFERENCES `message_type` (`ref_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `channel_messages_ibfk_5` FOREIGN KEY (`dependency`) REFERENCES `channel_messages` (`msg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD CONSTRAINT `direct_message_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direct_message_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inside_channel`
--
ALTER TABLE `inside_channel`
  ADD CONSTRAINT `inside_channel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inside_channel_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_1` FOREIGN KEY (`emo_id`) REFERENCES `emoticons` (`emo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reactions_ibfk_2` FOREIGN KEY (`msg_id`) REFERENCES `channel_messages` (`msg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workspace`
--
ALTER TABLE `workspace`
  ADD CONSTRAINT `workspace_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  ADD CONSTRAINT `workspace_channels_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `workspace_channels_ibfk_2` FOREIGN KEY (`url`) REFERENCES `workspace` (`url`) ON DELETE CASCADE ON UPDATE CASCADE;
