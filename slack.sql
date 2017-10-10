-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2017 at 02:42 AM
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
(1, 'chinga', 1, 'general - hai Rohit', '2017-10-10 00:37:39', '', 0),
(1, 'chinga', 2, 'general - hai Varsha', '2017-10-10 00:37:39', '', 0),
(4, 'chinga', 3, 'jazz - hai Rohit', '2017-10-10 00:37:39', '', 0),
(4, 'chinga', 4, 'jazz - hai Varsha', '2017-10-10 00:37:39', '', 0);

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
(1, 'chinga', '2017-10-09 19:08:53', '0000-00-00 00:00:00'),
(1, 'mater', '2017-10-09 19:10:53', '0000-00-00 00:00:00'),
(4, 'chinga', '2017-10-09 19:16:18', '0000-00-00 00:00:00'),
(4, 'mater', '2017-10-09 19:26:18', '0000-00-00 00:00:00'),
(5, 'mater', '2017-10-10 00:34:55', '0000-00-00 00:00:00');

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
('chinga', '@chick', '', '', '', NULL, '', '', '', '2017-10-09 19:01:54', '', ''),
('mater', '@mater', '', '', '', NULL, '', '', '', '2017-10-09 19:02:42', '', ''),
('topsecret', 'mcmissile', '', '', '', NULL, '', '', '', '2017-09-26 16:42:19', '', '');

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
('musicf17.slack.com', 'chinga', 1),
('musicf17.slack.com', 'mater', 0);

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
(1, 'general', 'musicf17.slack.com', 'chinga', ''),
(4, 'jazz', 'musicf17.slack.com', 'mater', ''),
(5, 'random', 'musicf17.slack.com', 'mater', '');

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
-- AUTO_INCREMENT for table `workspace_channels`
--
ALTER TABLE `workspace_channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD CONSTRAINT `channel_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `channel_messages_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`);

--
-- Constraints for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD CONSTRAINT `direct_message_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `direct_message_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `inside_channel`
--
ALTER TABLE `inside_channel`
  ADD CONSTRAINT `inside_channel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `inside_channel_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `workspace_channels` (`channel_id`);

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
