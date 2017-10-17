-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 17, 2017 at 08:26 AM
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
  `msg_id` int(11) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(10) NOT NULL,
  `dependency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_messages`
--

INSERT INTO `channel_messages` (`channel_id`, `user_id`, `msg_id`, `message`, `created_time`, `type`, `dependency`) VALUES
(1, 'chinga@cars.com', 1, 'Welcome to general messaging', '2017-10-17 03:29:06', '', 0),
(1, 'chinga@cars.com', 4, 'Yup, I am interested especially the rock scene in the 50s which was more about shock value', '2017-10-17 05:50:11', '', 0),
(1, 'hornet@rsprings.gov', 2, 'hey! that\'s great', '2017-10-17 05:45:05', '', 0),
(1, 'kachow@rusteze.com', 3, 'Anyone interested in rock?', '2017-10-17 05:48:23', '', 0),
(1, 'topsecret@agent.org', 5, 'Haha.. still how many are up for classical?', '2017-10-17 05:51:24', '', 0),
(4, 'hornet@rsprings.gov', 11, 'Its America\'s first indigenous form of music!', '2017-10-17 06:03:23', '', 0),
(4, 'mater@rsprings.gov', 6, 'Welcome to African traditional music', '2017-10-17 05:53:24', '', 0),
(5, 'mater@rsprings.gov', 7, 'How was the party last night?', '2017-10-17 05:54:51', '', 0),
(5, 'porsche@rsprings.gov', 15, 'It was amazing, you really missed it', '2017-10-17 06:07:48', '', 0),
(5, 'topsecret@agent.org', 17, 'Yea it was a wonderful resort, we should plan again in the next month', '2017-10-17 06:09:17', '', 0),
(6, 'hornet@rsprings.gov', 8, 'Believe me the music we are listening right now is derived from great classical composers created decades and centuries ago', '2017-10-17 05:57:13', '', 0),
(6, 'kachow@rusteze.com', 10, 'Woh! never knew about it', '2017-10-17 06:01:43', '', 0),
(6, 'mater@rsprings.gov', 14, 'Also, the most popular type of classical music to come out of the Baroque era', '2017-10-17 06:06:42', '', 0),
(7, 'hornet@rsprings.gov', 12, 'Its a grand collection of many musicians (more than eighty), grouped according to their instrument', '2017-10-17 06:04:46', '', 0),
(7, 'kachow@rusteze.com', 9, 'Welcome to orchestral music!', '2017-10-17 06:01:18', '', 0),
(7, 'mater@rsprings.gov', 13, 'Has anyone heard of chamber music?', '2017-10-17 06:05:41', '', 0),
(7, 'porsche@rsprings.gov', 16, 'Its a musical work composed specifically for a smaller instrumental arrangement', '2017-10-17 06:08:19', '', 0);

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

--
-- Dumping data for table `inside_channel`
--

INSERT INTO `inside_channel` (`channel_id`, `user_id`, `joined_date`, `left_date`) VALUES
(1, 'admin', '2017-10-17 06:20:55', '0000-00-00 00:00:00'),
(1, 'chinga@cars.com', '2017-10-09 19:08:53', '0000-00-00 00:00:00'),
(1, 'hornet@rsprings.gov', '2017-10-17 05:32:48', '0000-00-00 00:00:00'),
(1, 'kachow@rusteze.com', '2017-10-17 05:32:48', '0000-00-00 00:00:00'),
(1, 'mater@rsprings.gov', '2017-10-09 19:10:53', '0000-00-00 00:00:00'),
(1, 'porsche@rsprings.gov', '2017-10-17 05:32:48', '0000-00-00 00:00:00'),
(1, 'topsecret@agent.org', '2017-10-17 05:33:48', '0000-00-00 00:00:00'),
(4, 'admin', '2017-10-17 06:20:55', '0000-00-00 00:00:00'),
(4, 'chinga@cars.com', '2017-10-09 19:16:18', '0000-00-00 00:00:00'),
(4, 'hornet@rsprings.gov', '2017-10-17 05:34:11', '0000-00-00 00:00:00'),
(4, 'mater@rsprings.gov', '2017-10-09 19:26:18', '0000-00-00 00:00:00'),
(5, 'admin', '2017-10-17 06:20:55', '0000-00-00 00:00:00'),
(5, 'mater@rsprings.gov', '2017-10-10 00:34:55', '0000-00-00 00:00:00'),
(5, 'porsche@rsprings.gov', '2017-10-17 05:35:09', '0000-00-00 00:00:00'),
(5, 'topsecret@agent.org', '2017-10-17 05:35:09', '0000-00-00 00:00:00'),
(6, 'admin', '2017-10-17 06:20:55', '0000-00-00 00:00:00'),
(6, 'hornet@rsprings.gov', '2017-10-17 05:36:01', '0000-00-00 00:00:00'),
(6, 'kachow@rusteze.com', '2017-10-17 05:36:01', '0000-00-00 00:00:00'),
(6, 'mater@rsprings.gov', '2017-10-17 05:36:01', '0000-00-00 00:00:00'),
(7, 'admin', '2017-10-17 06:20:55', '0000-00-00 00:00:00'),
(7, 'chinga@cars.com', '2017-10-17 05:37:43', '0000-00-00 00:00:00'),
(7, 'hornet@rsprings.gov', '2017-10-17 05:37:43', '0000-00-00 00:00:00'),
(7, 'kachow@rusteze.com', '2017-10-17 05:59:08', '0000-00-00 00:00:00'),
(7, 'mater@rsprings.gov', '2017-10-17 05:37:43', '0000-00-00 00:00:00'),
(7, 'porsche@rsprings.gov', '2017-10-17 05:37:43', '0000-00-00 00:00:00');

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
  `email` varchar(20) NOT NULL,
  `time_zone` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `skype` varchar(50) NOT NULL,
  `avatar` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `password`, `first_name`, `last_name`, `display_name`, `what_i_do`, `status`, `phone_number`, `email`, `time_zone`, `skype`, `avatar`) VALUES
('admin', 'M0n@rch$', 'admin', '', '', NULL, '', '', '', '2017-10-17 06:14:00', '', ''),
('chinga@cars.com', '@chick', 'Chick', 'Hicks', '', NULL, '', '', '', '2017-10-17 02:40:35', '', ''),
('hornet@rsprings.gov', '@doc', 'Doc', ' Hudson', '', NULL, '', '', '', '2017-10-17 02:45:42', '', ''),
('kachow@rusteze.com', '@mcqueen', 'Lightning', 'McQueen', '', NULL, '', '', '', '2017-10-17 02:45:42', '', ''),
('mater@rsprings.gov', '@mater', 'Tow', 'Mater', '', NULL, '', '', '', '2017-10-17 02:39:57', '', ''),
('porsche@rsprings.gov', '@sally', 'Sally', 'Carrera', '', NULL, '', '', '', '2017-10-17 02:46:36', '', ''),
('topsecret@agent.org', '@mcmissile', 'Finn', 'McMissile', '', NULL, '', '', '', '2017-10-17 02:40:56', '', '');

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
('musicf17.slack.com', 'chinga@cars.com', 1),
('musicf17.slack.com', 'hornet@rsprings.gov', 0),
('musicf17.slack.com', 'kachow@rusteze.com', 0),
('musicf17.slack.com', 'mater@rsprings.gov', 0),
('musicf17.slack.com', 'porsche@rsprings.gov', 0),
('musicf17.slack.com', 'topsecret@agent.org', 0);

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
-- Dumping data for table `workspace_channels`
--

INSERT INTO `workspace_channels` (`channel_id`, `channel_name`, `url`, `user_id`, `purpose`) VALUES
(1, 'general', 'musicf17.slack.com', 'chinga@cars.com', ''),
(4, 'jazz', 'musicf17.slack.com', 'mater@rsprings.gov', ''),
(5, 'random', 'musicf17.slack.com', 'mater@rsprings.gov', ''),
(6, 'classical', 'musicf17.slack.com', 'hornet@rsprings.gov', ''),
(7, 'orchestral', 'musicf17.slack.com', 'kachow@rusteze.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD PRIMARY KEY (`channel_id`,`user_id`,`msg_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indexes for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD PRIMARY KEY (`direct_msg_id`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`);

--
-- Indexes for table `inside_channel`
--
ALTER TABLE `inside_channel`
  ADD PRIMARY KEY (`channel_id`,`user_id`),
  ADD KEY `inside_channel_ibfk_1` (`user_id`);

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
-- AUTO_INCREMENT for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD CONSTRAINT `channel_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `channel_messages_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`);

--
-- Constraints for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD CONSTRAINT `direct_message_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user_info` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `direct_message_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user_info` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `inside_channel`
--
ALTER TABLE `inside_channel`
  ADD CONSTRAINT `inside_channel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inside_channel_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`);

--
-- Constraints for table `workspace`
--
ALTER TABLE `workspace`
  ADD CONSTRAINT `workspace_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  ADD CONSTRAINT `workspace_channels_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `workspace_channels_ibfk_2` FOREIGN KEY (`url`) REFERENCES `workspace` (`url`);
