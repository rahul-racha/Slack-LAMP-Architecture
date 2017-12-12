-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2017 at 08:06 PM
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
(26, 'admin', 15, 'hha', NULL, NULL, NULL, '2017-11-28 23:03:08', 1, 15),
(26, 'mater', 11, 'heyy', NULL, NULL, NULL, '2017-11-21 19:46:42', 1, 11),
(26, 'mater', 12, 'yupp', NULL, NULL, NULL, '2017-11-21 19:46:47', 1, 12),
(26, 'mater', 13, NULL, 'https://stocklogos.com/sites/default/files/ferrari-logo_0.jpg', NULL, NULL, '2017-11-21 19:47:17', 1, 13),
(26, 'mater', 14, 'Hi', NULL, NULL, NULL, '2017-11-22 18:50:22', 1, 14),
(26, 'mater', 19, NULL, 'https://www.planwallpaper.com/static/images/canberra_hero_image_JiMVvYU.jpg', NULL, NULL, '2017-12-07 02:30:14', 1, 19),
(26, 'mater', 20, NULL, 'https://www.w3schools.com/css/css3_images.asp', NULL, NULL, '2017-12-07 02:39:13', 1, 20),
(26, 'mater', 21, 'tom', NULL, NULL, NULL, '2017-12-07 02:47:42', 1, 21),
(26, 'mater', 23, NULL, 'https://www.w3schools.com/css/paris.jpg', NULL, NULL, '2017-12-07 03:18:08', 1, 23),
(26, 'mater', 24, NULL, 'https://www.w3schools.com/css/lights600x400.jpg', NULL, NULL, '2017-12-07 03:36:35', 1, 24),
(26, 'mater', 25, NULL, 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', NULL, NULL, '2017-12-07 03:48:18', 1, 25),
(26, 'mater', 34, NULL, NULL, NULL, 'char *p = NULL;\n{\n    char c;\n    p = &c;\n}\n// Now p is dangling', '2017-12-07 22:24:39', 1, 34),
(26, 'mater', 41, NULL, NULL, 'files/Quiz 52.docx', NULL, '2017-12-08 08:54:49', 1, 41),
(26, 'mater', 43, '\"[1]) is the basic structural, functional, and biological unit of all known living organisms. A cell is the smallest unit of life that can replicate independently, and cells are often called the \"building blocks of life\". The study of cells is called cell biology.\r\n\r\nCells consist of cytoplasm enclosed within a membrane, which contains many biomolecules such as proteins and nucleic acids.[2] Organisms can be classified as unicellular (consisting of a single cell; including bacteria) or multicellular (including plants and animals).[3] While the number of cells in plants and animals varies from species to species, humans contain more than 10 trillion (1013) cells.[4] Most plant and animal cells are visible only under a microscope, with dimensions between 1 and 100 micrometres.[5]\r\n\r\nThe cell was discovered by Robert Hooke in 1665, who named the biological units for their resemblance to cells inhabited by Christian monks in a monastery.[6][7] Cell theory, first developed in 1839 by Matthias Jakob Schleiden and Theodor Schwann, states that all organisms are composed of one or more cells, that cells are the fundamental unit of structure and function in all living organisms, that all cells come from preexisting cells, and that all cells contain the hereditary information necessary for regulating cell functions and for transmitting information to the next generation of cells.[8] Cells emerged on Earth at least 3.5 billion years ago.[9][10][11]', NULL, NULL, NULL, '2017-12-08 08:56:29', 1, 43),
(26, 'mater', 44, 'hmm', NULL, NULL, NULL, '2017-12-08 08:56:48', 3, 43),
(27, 'admin', 17, 'hah', NULL, NULL, NULL, '2017-11-28 23:03:22', 1, 17),
(27, 'mater', 27, NULL, 'https://www.w3schools.com/css/lights600x400.jpg', NULL, NULL, '2017-12-07 07:16:04', 1, 27),
(27, 'mater', 37, NULL, 'images/messages/Gal-Gadot-Wallpaper-4.jpg', NULL, NULL, '2017-12-08 08:23:41', 1, 37),
(27, 'mater', 38, NULL, 'images/messages/jac1.jpg', NULL, NULL, '2017-12-08 08:24:59', 1, 38),
(27, 'mater', 39, NULL, 'images/messages/jac1.jpg', NULL, NULL, '2017-12-08 08:26:10', 1, 39),
(27, 'mater', 40, NULL, NULL, 'files/samp.json', NULL, '2017-12-08 08:28:02', 1, 40),
(27, 'mater', 42, 'The cell (from Latin cella, meaning \"small room\"', NULL, NULL, NULL, '2017-12-08 08:55:53', 1, 42),
(27, 'mater', 45, NULL, 'http://i1.wp.com/www.google.com/images/logo.gif', NULL, NULL, '2017-12-08 22:09:13', 1, 45),
(27, 'mater', 47, 'hmm\r\n', NULL, NULL, NULL, '2017-12-10 12:52:27', 1, 47),
(27, 'porsche', 46, 'Testing', NULL, NULL, NULL, '2017-12-09 02:28:03', 1, 46),
(27, 'singhis', 51, NULL, NULL, 'files/workonthis.zip', NULL, '2017-12-11 01:41:07', 1, 51),
(29, 'admin', 35, 'happy', NULL, NULL, NULL, '2017-12-07 22:41:18', 1, 35),
(29, 'admin', 36, 'yup', NULL, NULL, NULL, '2017-12-07 23:24:39', 3, 35),
(29, 'singhis', 48, NULL, 'https://lh3.googleusercontent.com/-XJOCtfgS0o4/Vxembf_ylfI/AAAAAAAANyw/AeF7kHGi_kERgmOe8sC986_KOQOUW4omgCCo/s128-Ic42/make%2Bin%2Bindia.png', NULL, NULL, '2017-12-10 13:11:54', 1, 48),
(29, 'singhis', 49, NULL, 'images/messages/Screenshot (20).png', NULL, NULL, '2017-12-10 13:12:15', 1, 49),
(29, 'singhis', 50, NULL, NULL, 'files/Quiz 51.docx', NULL, '2017-12-10 13:12:27', 1, 50);

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
(17, 2, ';admin;', 1),
(35, 1, ';admin;', 1),
(35, 2, '', 0),
(40, 1, ';mater;', 1),
(40, 2, '', 0);

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
('rkand002', 'e84c066c6e54bf921fa633f11b15c734da05881c7856ba70820b8309ee45f0be', '2017-12-11 13:34:57', NULL),
('singhis', '657ee7f92cad5919edb8a6eef1b8db130f383c783014a84e1915811458ebf81e', '2017-12-11 14:06:56', NULL);

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
('dumm', '1234567Aa@2', 'dummsuper', 'dum', '', 'user', NULL, '', '', 'zeno@od.com', 0, '2017-12-09 03:44:04', '', 'images/users/default-profile-pic.jpg'),
('hornet', '@doc', 'Doc', ' Hudson', 'Doc  Hudson', 'user', NULL, '', '', 'hornet@rsprings.gov', 0, '2017-12-09 03:41:39', '', 'images/users/default-profile-pic.jpg'),
('iamami', '12345678Aa!', 'Amitabh', 'Bachan', '', 'user', NULL, '', '', 'amitab@ac.in', 0, '2017-12-09 03:41:46', '', 'images/users/default-profile-pic.jpg'),
('kachow', '@mcqueen', 'Lightning', 'McQueen', 'Lightning McQueen', 'user', NULL, '', '', 'kachow@rusteze.com', 0, '2017-12-09 03:41:53', '', 'images/users/default-profile-pic.jpg'),
('mater', '@mater', 'Tow', 'Mater', 'Tow Mater', 'user', NULL, '', '', 'sunnyracha14@gmail.com', 0, '2017-12-11 05:53:30', '', 'https://www.gravatar.com/avatar/44ddde8657d7f5b7dfaab2745f90294f?d=404&s=500'),
('porsche', '@sally', 'Sally', 'Carrera', 'Sally Carrera', 'user', NULL, '', '', 'porsche@rsprings.gov', 0, '2017-12-09 02:26:09', '', 'images/users/default-profile-pic.jpg'),
('rkand002', '1234567Aa@2', 'Rohit', 'K', '', 'user', NULL, '', '', 'rkand002@odu.edu', 1, '2017-12-11 07:36:22', '', 'https://www.gravatar.com/avatar/a1d798da2397947120991acbd16141b9?d=404&s=500'),
('singhis', '123', 'okay', 'singh', '', 'user', NULL, '', '', 'rahul_rachamalla@outlook.com', 1, '2017-12-11 07:36:53', '', 'images/users/default-profile-pic.jpg'),
('topsecret', '@mcmissile', 'Finn', 'McMissile', 'Finn McMissile', 'user', NULL, '', '', 'topsecret@agent.org', 0, '2017-12-09 03:42:09', '', 'images/users/default-profile-pic.jpg'),
('yummy', '12345678Aa#3', 'yummy', 'yum', '', 'user', NULL, '', '', 'yum@odu.edu', 0, '2017-12-09 03:42:15', '', 'images/users/default-profile-pic.jpg');

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
('musicf17.slack.com', 'dumm', 0),
('musicf17.slack.com', 'hornet', 0),
('musicf17.slack.com', 'iamami', 0),
('musicf17.slack.com', 'kachow', 0),
('musicf17.slack.com', 'mater', 0),
('musicf17.slack.com', 'porsche', 0),
('musicf17.slack.com', 'rkand002', 0),
('musicf17.slack.com', 'singhis', 0),
('musicf17.slack.com', 'topsecret', 0),
('musicf17.slack.com', 'yummy', 0);

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
