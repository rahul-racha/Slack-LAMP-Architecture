-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2017 at 08:47 PM
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
CREATE DATABASE 'slack';
USE 'slack';

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
(37, 'mater', 1, 'Hello', NULL, NULL, NULL, '2017-12-12 18:32:45', 1, 1),
(37, 'porsche', 4, '1\r\n', NULL, NULL, NULL, '2017-12-12 18:34:08', 1, 4),
(37, 'porsche', 5, '2', NULL, NULL, NULL, '2017-12-12 18:34:12', 1, 5),
(37, 'porsche', 6, '3', NULL, NULL, NULL, '2017-12-12 18:34:15', 1, 6),
(37, 'porsche', 7, '4', NULL, NULL, NULL, '2017-12-12 18:34:17', 1, 7),
(37, 'porsche', 8, '5', NULL, NULL, NULL, '2017-12-12 18:34:19', 1, 8),
(37, 'porsche', 9, '6', NULL, NULL, NULL, '2017-12-12 18:34:21', 1, 9),
(37, 'porsche', 10, '7', NULL, NULL, NULL, '2017-12-12 18:34:23', 1, 10),
(37, 'porsche', 11, '8', NULL, NULL, NULL, '2017-12-12 18:34:27', 1, 11),
(37, 'porsche', 12, '9', NULL, NULL, NULL, '2017-12-12 18:34:30', 1, 12),
(37, 'porsche', 13, '10', NULL, NULL, NULL, '2017-12-12 18:34:32', 1, 13),
(37, 'porsche', 14, '11', NULL, NULL, NULL, '2017-12-12 18:34:35', 1, 14),
(37, 'porsche', 15, '12', NULL, NULL, NULL, '2017-12-12 18:34:38', 1, 15),
(37, 'porsche', 16, '13', NULL, NULL, NULL, '2017-12-12 18:34:40', 1, 16),
(37, 'porsche', 17, '14', NULL, NULL, NULL, '2017-12-12 18:34:43', 1, 17),
(37, 'porsche', 18, '15', NULL, NULL, NULL, '2017-12-12 18:34:46', 1, 18),
(38, 'porsche', 19, 'hi', NULL, NULL, NULL, '2017-12-12 18:35:09', 1, 19),
(38, 'porsche', 27, NULL, 'images/messages/disguise-1296221_1280.png', NULL, NULL, '2017-12-12 18:41:55', 1, 27),
(38, 'porsche', 28, NULL, NULL, 'files/Syllabus.pdf', NULL, '2017-12-12 18:42:31', 1, 28),
(38, 'porsche', 29, NULL, NULL, 'files/Test_ExportFile_201710_FALL_CS120G_20259_Exam 2- Requires Respondus LockDown Browser.zip', NULL, '2017-12-12 18:42:51', 1, 29),
(38, 'porsche', 30, NULL, NULL, 'files/proteinstructure-online.ppt', NULL, '2017-12-12 18:43:10', 1, 30),
(38, 'porsche', 31, NULL, NULL, 'files/cs723projectfall17.docx', NULL, '2017-12-12 18:43:27', 1, 31),
(38, 'porsche', 32, 'hello', NULL, NULL, NULL, '2017-12-12 18:48:23', 3, 19),
(38, 'singhis', 26, 'hello', NULL, NULL, NULL, '2017-12-12 18:39:57', 1, 26),
(39, 'mater', 2, 'how are you people doing', NULL, NULL, NULL, '2017-12-12 18:33:08', 1, 2),
(40, 'chinga', 49, 'hello', NULL, NULL, NULL, '2017-12-12 18:59:09', 1, 49),
(40, 'chinga', 50, 'ok', NULL, NULL, NULL, '2017-12-12 19:00:09', 3, 24),
(40, 'porsche', 23, NULL, 'images/messages/Screenshot (20).png', NULL, NULL, '2017-12-12 18:38:19', 1, 23),
(40, 'porsche', 24, 'This is how we are supposed to create channels', NULL, NULL, NULL, '2017-12-12 18:38:38', 1, 24),
(40, 'porsche', 33, 'great', NULL, NULL, NULL, '2017-12-12 18:48:46', 3, 23),
(40, 'porsche', 34, '1', NULL, NULL, NULL, '2017-12-12 18:48:52', 3, 25),
(40, 'porsche', 35, '2', NULL, NULL, NULL, '2017-12-12 18:48:54', 3, 25),
(40, 'porsche', 36, '3', NULL, NULL, NULL, '2017-12-12 18:48:56', 3, 25),
(40, 'porsche', 37, '4', NULL, NULL, NULL, '2017-12-12 18:48:59', 3, 25),
(40, 'porsche', 38, '5', NULL, NULL, NULL, '2017-12-12 18:49:01', 3, 25),
(40, 'porsche', 39, '6', NULL, NULL, NULL, '2017-12-12 18:49:03', 3, 25),
(40, 'porsche', 40, '7', NULL, NULL, NULL, '2017-12-12 18:49:06', 3, 25),
(40, 'porsche', 41, '8', NULL, NULL, NULL, '2017-12-12 18:49:08', 3, 25),
(40, 'porsche', 42, '9', NULL, NULL, NULL, '2017-12-12 18:49:11', 3, 25),
(40, 'porsche', 43, '10', NULL, NULL, NULL, '2017-12-12 18:49:15', 3, 25),
(40, 'rkand002', 47, NULL, 'images/messages/Screenshot (19).png', NULL, NULL, '2017-12-12 18:52:34', 1, 47),
(40, 'singhis', 25, 'thank you', NULL, NULL, NULL, '2017-12-12 18:39:38', 1, 25),
(41, 'mater', 3, '1', NULL, NULL, NULL, '2017-12-12 18:33:17', 1, 3),
(41, 'porsche', 20, '2', NULL, NULL, NULL, '2017-12-12 18:35:19', 1, 20),
(41, 'porsche', 21, '3', NULL, NULL, NULL, '2017-12-12 18:35:22', 1, 21),
(41, 'porsche', 22, '4', NULL, NULL, NULL, '2017-12-12 18:35:27', 1, 22),
(41, 'porsche', 44, '5', NULL, NULL, NULL, '2017-12-12 18:49:37', 3, 22),
(41, 'porsche', 45, NULL, NULL, NULL, '<?php\nif (!isset($_POST[\'submit\'])) {\n   echo \"<h1>Error</h1>\\n\n      <p>Accessing this page directly is not allowed.</p>\";\n   exit;\n}\n\n$email = preg_replace(\"([\\r\\n])\", \"\", $email);\n\n$find = \"/(content-type|bcc:|cc:)/i\";\nif (preg_match($find, $name) || preg_match($find, $email) || preg_match($find, $url) || preg_match($find, $comments)) {\n   echo \"<h1>Error</h1>\\n\n      <p>No meta/header injections, please.</p>\";\n   exit;\n}\n?>', '2017-12-12 18:50:24', 1, 45),
(41, 'rkand002', 46, 'great', NULL, NULL, NULL, '2017-12-12 18:51:12', 3, 45),
(41, 'rkand002', 48, 'hello', NULL, NULL, NULL, '2017-12-12 18:52:58', 1, 48);

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
(37, 'admin', '2017-12-12 18:27:23', '0000-00-00 00:00:00'),
(37, 'chinga', '2017-12-12 18:27:53', '0000-00-00 00:00:00'),
(37, 'mater', '2017-12-12 18:27:23', '0000-00-00 00:00:00'),
(37, 'porsche', '2017-12-12 18:27:31', '0000-00-00 00:00:00'),
(37, 'rkand002', '2017-12-12 18:27:47', '0000-00-00 00:00:00'),
(37, 'singhis ', '2017-12-12 18:27:23', '0000-00-00 00:00:00'),
(38, 'admin', '2017-12-12 18:28:37', '0000-00-00 00:00:00'),
(38, 'kachow', '2017-12-12 18:28:55', '0000-00-00 00:00:00'),
(38, 'mater', '2017-12-12 18:28:37', '0000-00-00 00:00:00'),
(38, 'porsche', '2017-12-12 18:28:46', '0000-00-00 00:00:00'),
(38, 'singhis', '2017-12-12 18:28:37', '0000-00-00 00:00:00'),
(38, 'topsecret', '2017-12-12 18:29:05', '0000-00-00 00:00:00'),
(39, 'admin', '2017-12-12 18:29:31', '0000-00-00 00:00:00'),
(39, 'hornet', '2017-12-12 18:29:43', '0000-00-00 00:00:00'),
(39, 'mater', '2017-12-12 18:29:31', '0000-00-00 00:00:00'),
(39, 'porsche', '2017-12-12 18:29:31', '0000-00-00 00:00:00'),
(39, 'rkand002', '2017-12-12 18:29:37', '0000-00-00 00:00:00'),
(40, 'admin', '2017-12-12 18:30:39', '0000-00-00 00:00:00'),
(40, 'chinga', '2017-12-12 18:30:39', '0000-00-00 00:00:00'),
(40, 'kachow', '2017-12-12 18:31:01', '0000-00-00 00:00:00'),
(40, 'mater', '2017-12-12 18:30:39', '0000-00-00 00:00:00'),
(40, 'porsche', '2017-12-12 18:30:48', '0000-00-00 00:00:00'),
(40, 'rkand002', '2017-12-12 18:31:19', '0000-00-00 00:00:00'),
(40, 'singhis', '2017-12-12 18:31:08', '0000-00-00 00:00:00'),
(40, 'topsecret', '2017-12-12 18:31:14', '0000-00-00 00:00:00'),
(41, 'admin', '2017-12-12 18:32:03', '0000-00-00 00:00:00'),
(41, 'mater', '2017-12-12 18:32:03', '0000-00-00 00:00:00'),
(41, 'porsche', '2017-12-12 18:32:03', '0000-00-00 00:00:00'),
(41, 'rkand002', '2017-12-12 18:32:10', '0000-00-00 00:00:00'),
(41, 'singhis', '2017-12-12 18:32:14', '0000-00-00 00:00:00');

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
(3, 2, ';porsche;', 1),
(5, 1, ';porsche;', 1),
(5, 2, '', 0),
(6, 1, ';porsche;', 1),
(8, 1, ';porsche;', 1),
(9, 1, ';singhis;rkand002;', 2),
(10, 1, ';singhis;admin;rkand002;', 3),
(11, 1, ';singhis;porsche;rkand002;chinga;', 4),
(11, 2, '', 0),
(12, 1, ';rkand002;chinga;', 2),
(12, 2, ';singhis;', 1),
(13, 1, ';singhis;rkand002;', 2),
(13, 2, ';chinga;', 1),
(14, 1, ';porsche;rkand002;', 2),
(14, 2, ';singhis;chinga;', 2),
(15, 1, ';singhis;rkand002;', 2),
(15, 2, ';chinga;', 1),
(16, 1, ';rkand002;chinga;', 2),
(16, 2, ';singhis;', 1),
(17, 1, ';rkand002;', 1),
(18, 1, ';rkand002;', 1),
(18, 2, ';porsche;', 1),
(19, 1, ';singhis;', 1),
(20, 1, ';singhis;', 1),
(20, 2, ';admin;', 1),
(21, 1, ';singhis;', 1),
(22, 1, ';rkand002;', 1),
(22, 2, ';admin;', 1),
(23, 1, ';singhis;admin;', 2),
(23, 2, ';rkand002;', 1),
(24, 1, ';singhis;', 1),
(24, 2, ';rkand002;', 1),
(25, 1, ';rkand002;', 1),
(26, 1, ';porsche;', 1),
(45, 1, ';porsche;', 1);

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
('rkand002', 'd1d2c0f5cb7e92ca6d06ba0ead8fa5a9', '2017-12-12 12:47:51', NULL),
('singhis', '32970dd9a8e6d954f30f6c6193983302', '2017-12-12 12:55:23', NULL);

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
('admin', 'M0n@rch$', 'admin', '', 'admin', 'admin', NULL, '', '', 'rohithkandimalla@gmail.com', 0, '2017-12-12 18:14:53', '', 'images/users/default-profile-pic.jpg'),
('chinga', '@chick', 'Chick', 'Hicks', 'Chick Hicks', 'user', NULL, '', '', 'chinga@cars.com', 0, '2017-12-09 03:41:33', '', 'images/users/default-profile-pic.jpg'),
('hornet', '@doc', 'Doc', ' Hudson', 'Doc  Hudson', 'user', NULL, '', '', 'hornet@rsprings.gov', 0, '2017-12-09 03:41:39', '', 'images/users/default-profile-pic.jpg'),
('iamami', '123', 'Amitabh', 'Bachan', '', 'user', NULL, '', '', 'amitab@ac.in', 0, '2017-12-12 18:14:25', '', 'images/users/default-profile-pic.jpg'),
('kachow', '@mcqueen', 'Lightning', 'McQueen', 'Lightning McQueen', 'user', NULL, '', '', 'kachow@rusteze.com', 0, '2017-12-09 03:41:53', '', 'images/users/default-profile-pic.jpg'),
('mater', '@mater', 'Tow', 'Mater', 'Tow Mater', 'user', NULL, '', '', 'rkand002@odu.edu', 0, '2017-12-12 18:14:00', '', 'https://www.gravatar.com/avatar/44ddde8657d7f5b7dfaab2745f90294f?d=404&s=500'),
('porsche', '@sally', 'Sally', 'Carrera', 'Sally Carrera', 'user', NULL, '', '', 'porsche@rsprings.gov', 0, '2017-12-09 02:26:09', '', 'images/users/default-profile-pic.jpg'),
('rkand002', '123', 'Rohit', 'K', '', 'user', NULL, '', '', 'rkand002@odu.edu', 0, '2017-12-12 18:14:20', '', 'https://www.gravatar.com/avatar/a1d798da2397947120991acbd16141b9?d=404&s=500'),
('singhis', '123', 'okay', 'singh', '', 'user', NULL, '', '', 'rohithkandimalla@gmail.com', 0, '2017-12-12 18:13:49', '', 'images/users/default-profile-pic.jpg'),
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
('musicf17.slack.com', 'hornet', 0),
('musicf17.slack.com', 'iamami', 0),
('musicf17.slack.com', 'kachow', 0),
('musicf17.slack.com', 'mater', 0),
('musicf17.slack.com', 'porsche', 0),
('musicf17.slack.com', 'rkand002', 0),
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
(37, 'General', 'musicf17.slack.com', 'mater', 'General purposes', 'Public', 'unarchived'),
(38, 'Testing', 'musicf17.slack.com', 'mater', 'this channel is for testing', 'Private', 'unarchived'),
(39, 'Milestone 1', 'musicf17.slack.com', 'mater', '', 'Public', 'archived'),
(40, 'Milestone 2', 'musicf17.slack.com', 'mater', '', 'Public', 'unarchived'),
(41, 'group 12', 'musicf17.slack.com', 'mater', '', 'Private', 'unarchived');

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
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
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
