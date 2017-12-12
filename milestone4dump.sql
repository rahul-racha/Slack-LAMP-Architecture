-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2017 at 12:04 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

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
  `image_path` text,
  `file_path` text,
  `snippet` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` smallint(6) DEFAULT NULL,
  `dependency` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_messages`
--

INSERT INTO `channel_messages` (`channel_id`, `user_id`, `msg_id`, `message`, `image_path`, `file_path`, `snippet`, `created_time`, `type`, `dependency`) VALUES
(31, 'rkand002', 1, NULL, 'http://www.india-forums.com/bollywood/images/uploads/459_sun45.jpg', NULL, NULL, '2017-12-12 01:35:47', 1, 1),
(31, 'rkand002', 2, 'cutiee', NULL, NULL, NULL, '2017-12-12 01:35:59', 3, 1),
(31, 'rkand002', 3, NULL, NULL, 'files/index.php', NULL, '2017-12-12 03:25:45', 1, 3),
(31, 'rkand002', 4, '1', NULL, NULL, NULL, '2017-12-12 08:06:48', 1, 4),
(31, 'rkand002', 5, '2', NULL, NULL, NULL, '2017-12-12 08:06:54', 1, 5),
(31, 'rkand002', 6, '3', NULL, NULL, NULL, '2017-12-12 08:06:57', 1, 6),
(31, 'rkand002', 7, '4', NULL, NULL, NULL, '2017-12-12 08:07:06', 1, 7),
(31, 'rkand002', 8, '5', NULL, NULL, NULL, '2017-12-12 08:07:08', 1, 8),
(31, 'rkand002', 9, '6', NULL, NULL, NULL, '2017-12-12 08:07:10', 1, 9),
(31, 'rkand002', 11, '8', NULL, NULL, NULL, '2017-12-12 08:07:15', 1, 11),
(31, 'rkand002', 12, '9', NULL, NULL, NULL, '2017-12-12 08:07:18', 1, 12),
(31, 'rkand002', 13, '10', NULL, NULL, NULL, '2017-12-12 08:08:02', 1, 13),
(31, 'rkand002', 14, '11', NULL, NULL, NULL, '2017-12-12 08:08:04', 1, 14),
(31, 'rkand002', 15, '12', NULL, NULL, NULL, '2017-12-12 08:08:07', 1, 15),
(31, 'rkand002', 16, '13', NULL, NULL, NULL, '2017-12-12 08:08:09', 1, 16),
(31, 'rkand002', 17, '14', NULL, NULL, NULL, '2017-12-12 08:08:12', 1, 17),
(31, 'rkand002', 18, '15', NULL, NULL, NULL, '2017-12-12 08:08:15', 1, 18),
(31, 'rkand002', 19, '16', NULL, NULL, NULL, '2017-12-12 08:08:17', 1, 19),
(33, 'rkand002', 20, 'hello', NULL, NULL, NULL, '2017-12-12 18:37:23', 1, 20),
(33, 'rkand002', 21, '1', NULL, NULL, NULL, '2017-12-12 18:56:30', 1, 21),
(33, 'rkand002', 22, '2', NULL, NULL, NULL, '2017-12-12 18:56:33', 1, 22),
(33, 'rkand002', 23, '3', NULL, NULL, NULL, '2017-12-12 18:56:35', 1, 23),
(33, 'rkand002', 24, '4', NULL, NULL, NULL, '2017-12-12 18:56:37', 1, 24),
(33, 'rkand002', 25, '5', NULL, NULL, NULL, '2017-12-12 18:56:39', 1, 25),
(33, 'rkand002', 26, '6', NULL, NULL, NULL, '2017-12-12 18:56:41', 1, 26),
(33, 'rkand002', 27, '7', NULL, NULL, NULL, '2017-12-12 18:56:44', 1, 27),
(33, 'rkand002', 28, '8', NULL, NULL, NULL, '2017-12-12 18:56:46', 1, 28),
(33, 'rkand002', 29, '9', NULL, NULL, NULL, '2017-12-12 18:56:48', 1, 29),
(33, 'rkand002', 30, '10', NULL, NULL, NULL, '2017-12-12 18:56:50', 1, 30),
(33, 'rkand002', 31, '11', NULL, NULL, NULL, '2017-12-12 18:56:54', 1, 31),
(33, 'rkand002', 32, '12', NULL, NULL, NULL, '2017-12-12 18:56:56', 1, 32),
(33, 'rkand002', 33, '13', NULL, NULL, NULL, '2017-12-12 18:56:58', 1, 33),
(33, 'rkand002', 34, '14', NULL, NULL, NULL, '2017-12-12 18:57:01', 1, 34),
(33, 'rkand002', 35, '15', NULL, NULL, NULL, '2017-12-12 18:57:03', 1, 35),
(33, 'rkand002', 36, '16', NULL, NULL, NULL, '2017-12-12 18:57:06', 1, 36),
(33, 'rkand002', 37, '17', NULL, NULL, NULL, '2017-12-12 18:57:08', 1, 37),
(33, 'rkand002', 38, '18', NULL, NULL, NULL, '2017-12-12 18:57:11', 1, 38),
(33, 'rkand002', 39, '19', NULL, NULL, NULL, '2017-12-12 18:57:14', 1, 39),
(33, 'rkand002', 40, '20', NULL, NULL, NULL, '2017-12-12 18:57:16', 1, 40),
(33, 'rkand002', 41, '21', NULL, NULL, NULL, '2017-12-12 18:57:19', 1, 41),
(33, 'rkand002', 42, '22', NULL, NULL, NULL, '2017-12-12 18:57:21', 1, 42),
(33, 'rkand002', 43, '23', NULL, NULL, NULL, '2017-12-12 18:57:25', 1, 43),
(33, 'rkand002', 44, '24', NULL, NULL, NULL, '2017-12-12 18:57:29', 1, 44),
(33, 'rkand002', 45, '25', NULL, NULL, NULL, '2017-12-12 18:57:32', 1, 45),
(33, 'rkand002', 46, '26', NULL, NULL, NULL, '2017-12-12 18:57:35', 1, 46),
(33, 'rkand002', 47, '27', NULL, NULL, NULL, '2017-12-12 18:57:37', 1, 47),
(33, 'rkand002', 48, '28', NULL, NULL, NULL, '2017-12-12 18:57:40', 1, 48),
(33, 'rkand002', 49, '29', NULL, NULL, NULL, '2017-12-12 18:57:43', 1, 49),
(33, 'rkand002', 50, '30', NULL, NULL, NULL, '2017-12-12 18:57:45', 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `direct_message`
--

CREATE TABLE `direct_message` (
  `user1` varchar(20) NOT NULL,
  `user2` varchar(20) NOT NULL,
  `direct_msg_id` int(11) NOT NULL,
  `direct_message` longtext,
  `image_path` varchar(100) DEFAULT NULL,
  `snippet` text,
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
(30, 'admin', '2017-12-11 21:37:18', '0000-00-00 00:00:00'),
(30, 'porsche', '2017-12-11 21:37:18', '0000-00-00 00:00:00'),
(31, 'admin', '2017-12-12 00:28:26', '0000-00-00 00:00:00'),
(31, 'rkand002', '2017-12-12 00:28:26', '0000-00-00 00:00:00'),
(32, 'admin', '2017-12-12 06:02:34', '0000-00-00 00:00:00'),
(32, 'mater', '2017-12-12 06:03:56', '0000-00-00 00:00:00'),
(32, 'rkand002', '2017-12-12 06:02:34', '0000-00-00 00:00:00'),
(33, 'admin', '2017-12-12 18:37:06', '0000-00-00 00:00:00'),
(33, 'rkand002', '2017-12-12 18:37:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inside_direct_msg`
--

CREATE TABLE `inside_direct_msg` (
  `user_id` varchar(20) NOT NULL,
  `recipient` varchar(20) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 1, '', 0),
(1, 2, '', 0),
(3, 1, '', 0),
(3, 2, '', 0),
(6, 1, '', 0),
(6, 2, '', 0),
(7, 1, '', 0),
(7, 2, '', 0),
(8, 2, '', 0),
(11, 2, '', 0),
(12, 1, '', 0),
(12, 2, '', 0),
(13, 1, '', 0),
(13, 2, '', 0),
(14, 1, '', 0),
(14, 2, '', 0),
(15, 1, '', 0),
(16, 1, '', 0),
(17, 1, '', 0),
(18, 1, '', 0),
(19, 1, '', 0),
(20, 2, ';rkand002;', 1),
(21, 1, ';rkand002;', 1),
(22, 1, ';rkand002;', 1),
(30, 1, ';rkand002;', 1),
(31, 1, ';rkand002;', 1),
(35, 2, ';rkand002;', 1),
(41, 1, ';rkand002;', 1),
(42, 2, ';rkand002;', 1);

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
-- Table structure for table `token_table`
--

CREATE TABLE `token_table` (
  `user_id` varchar(20) CHARACTER SET latin1 NOT NULL,
  `token` text,
  `expire_time` timestamp NULL DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token_table`
--

INSERT INTO `token_table` (`user_id`, `token`, `expire_time`, `email`) VALUES
('jfbrunel', '9a0d9c83ae642cc83ea8811032bd63b6', '2017-12-13 05:08:41', NULL),
('porsche', '0035a5ec57ed3a33107f338fbded27c4e2cdc5bbf466dc83887ccfbc6c2ab1d9', '2017-12-12 06:20:45', NULL),
('rkand002', 'ef91f68697809d498f152d23fde943c1', '2017-12-13 05:03:36', NULL);

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
  `email` varchar(300) NOT NULL,
  `two_factor` tinyint(1) NOT NULL DEFAULT '0',
  `time_zone` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `skype` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL DEFAULT 'images/users/default-profile-pic.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `password`, `first_name`, `last_name`, `display_name`, `role`, `what_i_do`, `status`, `phone_number`, `email`, `two_factor`, `time_zone`, `skype`, `avatar`) VALUES
('admin', 'M0n@rch$', 'admin', '', 'admin', 'admin', NULL, '', '', '', 0, '2017-12-09 03:41:28', '', 'images/users/default-profile-pic.jpg'),
('chinga', '@chick', 'Chick', 'Hicks', 'Chick Hicks', 'user', NULL, '', '', 'chinga@cars.com', 0, '2017-12-09 03:41:33', '', 'images/users/default-profile-pic.jpg'),
('jfbrunel', 'Knrao@1966', 'justin', 'brunelle', '', 'user', NULL, '', '', 'jfbrunel@odu.edu', 1, '2017-12-12 23:03:35', '', 'https://www.gravatar.com/avatar/9d705713dac5aab5b24adecfa599050f?d=404&amp;s=500'),
('kachow', '@mcqueen', 'Lightning', 'McQueen', 'Lightning McQueen', 'user', NULL, '', '', 'kachow@rusteze.com', 0, '2017-12-09 03:41:53', '', 'images/users/default-profile-pic.jpg'),
('mater', '@mater', 'Tow', 'Mater', 'Tow Mater', 'user', NULL, '', '', 'sunnyracha14@gmail.com', 0, '2017-12-11 05:53:30', '', 'https://www.gravatar.com/avatar/44ddde8657d7f5b7dfaab2745f90294f?d=404&s=500'),
('mkuku', 'Qpalzm!123', 'mahesh', 'kukunooru', '', 'user', NULL, '', '', 'mahesh@kuku.com', 0, '2017-12-12 05:38:41', '', 'images/users/default-profile-pic.jpg'),
('porsche', '@sally', 'Sally', 'Carrera', 'Sally Carrera', 'user', NULL, '', '', 'porsche@rsprings.gov', 0, '2017-12-12 00:15:54', '', 'images/users/default-profile-pic.jpg'),
('rkand002', 'Knrao@1966', 'rohit', 'kandimalla', '', 'user', NULL, '', '', 'rkand002@odu.edu', 1, '2017-12-12 18:43:30', '', 'https://www.gravatar.com/avatar/a1d798da2397947120991acbd16141b9?d=404&amp;s=500'),
('topsecret', '@mcmissile', 'Finn', 'McMissile', 'Finn McMissile', 'user', NULL, '', '', 'topsecret@agent.org', 0, '2017-12-09 03:42:09', '', 'images/users/default-profile-pic.jpg');

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
('musicf17.slack.com', 'jfbrunel', 0),
('musicf17.slack.com', 'kachow', 0),
('musicf17.slack.com', 'mater', 0),
('musicf17.slack.com', 'mkuku', 0),
('musicf17.slack.com', 'porsche', 0),
('musicf17.slack.com', 'rkand002', 0),
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
(30, 'bla bla', 'musicf17.slack.com', 'porsche', 'bla bla', 'Private', 'unarchived'),
(31, 'temp', 'musicf17.slack.com', 'rkand002', '', 'Private', 'unarchived'),
(32, 'broh', 'musicf17.slack.com', 'rkand002', '', 'Public', 'unarchived'),
(33, 'doode', 'musicf17.slack.com', 'rkand002', '', 'Public', 'unarchived');

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
-- Indexes for table `token_table`
--
ALTER TABLE `token_table`
  ADD PRIMARY KEY (`user_id`),
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
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
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
-- Constraints for table `token_table`
--
ALTER TABLE `token_table`
  ADD CONSTRAINT `token_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
