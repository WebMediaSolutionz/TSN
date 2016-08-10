-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2015 at 07:23 PM
-- Server version: 5.5.42-37.1-log
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webmedj6_social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `user_id`, `name`, `creation_date`, `modified_date`) VALUES
(92, 71, 'memes', '2015-05-29 05:14:06', '2015-05-29 05:14:06'),
(93, 72, 'first album', NULL, NULL),
(94, 72, 'memes', NULL, NULL),
(95, 72, 'some album', NULL, NULL),
(96, 72, 'some other album', NULL, NULL),
(97, 72, 'sxsxs', NULL, NULL),
(98, 72, 'qqqqq', '2015-06-08 01:43:42', '2015-06-08 01:43:42'),
(99, 72, 'ttt', '2015-06-08 02:41:20', '2015-06-08 02:41:20'),
(100, 81, 'memes', '2015-06-09 10:33:04', '2015-06-09 10:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `track_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `value`, `user_id`, `post_id`, `picture_id`, `album_id`, `video_id`, `track_id`, `date`) VALUES
(68, 'blah', 78, 173, 0, 0, 0, 0, '2015-06-14 00:32:33'),
(69, 'one', 78, 182, 0, 0, 0, 0, '2015-06-14 17:17:43'),
(70, 'ddd', 78, 182, 0, 0, 0, 0, '2015-06-14 22:43:29'),
(71, 'blah', 81, 171, 0, 0, 0, 0, '2015-06-15 21:41:37'),
(72, 'blah 2', 81, 171, 0, 0, 0, 0, '2015-06-15 21:41:46'),
(73, 'blah', 81, 172, 0, 0, 0, 0, '2015-06-15 21:42:17'),
(74, 'blah 2', 81, 172, 0, 0, 0, 0, '2015-06-15 21:47:50'),
(75, 'ffbfb', 81, 0, 115, 0, 0, 0, '2015-06-15 22:12:57'),
(76, 'blah 3', 81, 171, 0, 0, 0, 0, '2015-06-19 21:59:55'),
(77, 'testing', 81, 182, 0, 0, 0, 0, '2015-06-19 22:00:12'),
(78, 'yessss', 78, 172, 0, 0, 0, 0, '2015-06-19 22:13:51'),
(79, 'blah', 78, 0, 0, 93, 0, 0, '2015-06-24 00:10:00'),
(80, 'aaaa', 78, 0, 115, 0, 0, 0, '2015-06-24 00:10:18'),
(81, 'blah 4', 81, 171, 0, 0, 0, 0, '2015-10-30 00:17:29'),
(82, 'blah', 81, 0, 115, 0, 0, 0, '2015-11-03 15:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `subject`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `conversations_users`
--

DROP TABLE IF EXISTS `conversations_users`;
CREATE TABLE IF NOT EXISTS `conversations_users` (
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversations_users`
--

INSERT INTO `conversations_users` (`conversation_id`, `user_id`, `active`) VALUES
(1, 72, 1),
(1, 78, 1),
(2, 72, 1),
(2, 71, 1),
(3, 79, 1),
(3, 71, 1),
(4, 81, 1),
(4, 72, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friend_lists`
--

DROP TABLE IF EXISTS `friend_lists`;
CREATE TABLE IF NOT EXISTS `friend_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `friend_lists`
--

INSERT INTO `friend_lists` (`id`, `name`, `user_id`) VALUES
(39, 'default', 71),
(40, 'default', 70),
(41, 'default', 72),
(44, 'default', 78),
(45, 'default', 79),
(46, 'default', 80),
(47, 'default', 81);

-- --------------------------------------------------------

--
-- Table structure for table `friend_lists_users`
--

DROP TABLE IF EXISTS `friend_lists_users`;
CREATE TABLE IF NOT EXISTS `friend_lists_users` (
  `friend_list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_lists_users`
--

INSERT INTO `friend_lists_users` (`friend_list_id`, `user_id`) VALUES
(41, 70),
(39, 70),
(40, 72),
(40, 71),
(41, 71),
(39, 72),
(39, 78),
(39, 79),
(44, 71),
(45, 71),
(46, 71),
(39, 80),
(47, 72),
(47, 78),
(44, 81),
(41, 81),
(41, 78),
(44, 80),
(44, 72),
(46, 78);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `track_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=253 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `comment_id`, `picture_id`, `album_id`, `video_id`, `track_id`, `date`) VALUES
(203, 81, 173, 0, 0, 0, 0, 0, '2015-06-14 00:11:42'),
(204, 72, 173, 0, 0, 0, 0, 0, '2015-06-14 00:12:16'),
(205, 80, 173, 0, 0, 0, 0, 0, '2015-06-14 00:21:09'),
(212, 81, 182, 0, 0, 0, 0, 0, '2015-06-14 16:46:12'),
(219, 78, 172, 0, 0, 0, 0, 0, '2015-06-14 22:00:07'),
(220, 78, 172, 0, 0, 0, 0, 0, '2015-06-14 22:00:11'),
(233, 78, 0, 69, 0, 0, 0, 0, '2015-06-14 22:44:32'),
(235, 78, 0, 70, 0, 0, 0, 0, '2015-06-15 01:01:50'),
(237, 78, 0, 0, 0, 93, 0, 0, '2015-06-15 02:12:26'),
(238, 78, 0, 0, 115, 0, 0, 0, '2015-06-15 02:12:40'),
(239, 78, 0, 0, 116, 0, 0, 0, '2015-06-15 02:17:58'),
(241, 81, 171, 0, 0, 0, 0, 0, '2015-06-15 21:41:55'),
(242, 81, 172, 0, 0, 0, 0, 0, '2015-06-15 22:05:55'),
(246, 72, 171, 0, 0, 0, 0, 0, '2015-06-19 21:44:46'),
(247, 72, 182, 0, 0, 0, 0, 0, '2015-06-19 22:01:07'),
(248, 81, 0, 0, 115, 0, 0, 0, '2015-06-21 20:03:38'),
(249, 78, 0, 77, 0, 0, 0, 0, '2015-06-24 00:09:32'),
(250, 78, 0, 75, 0, 0, 0, 0, '2015-06-24 00:10:10'),
(251, 81, 0, 81, 0, 0, 0, 0, '2015-10-30 00:18:26'),
(252, 81, 170, 0, 0, 0, 0, 0, '2015-11-16 23:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(10000) NOT NULL,
  `date` datetime DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `date`, `read`, `conversation_id`, `user_id`) VALUES
(1, 'testing', '2015-02-13 19:59:32', 1, 1, 72),
(2, 'hey', '2015-02-13 20:01:19', 1, 1, 72),
(3, 'yo', '2015-02-13 20:02:09', 1, 1, 78),
(4, 'xscdv', '2015-02-19 01:28:18', 1, 1, 72),
(5, 'testing', '2015-02-27 19:03:35', 1, 2, 72),
(6, 'yeah', '2015-02-27 19:03:45', 1, 1, 72),
(7, 'huh', '2015-02-27 19:04:02', 1, 2, 72),
(8, 'ddddd', '2015-03-23 02:00:39', 1, 3, 79),
(9, 'aaaaa', '2015-03-23 02:00:44', 1, 3, 79),
(10, 'xsxsx', '2015-03-23 02:01:27', 1, 3, 71),
(11, 'xsxsx', '2015-03-23 02:01:30', 1, 3, 71),
(12, 'test', '2015-06-08 02:47:13', 1, 1, 72),
(13, 'blah', '2015-06-09 04:20:09', 1, 2, 71),
(14, 'blah', '2015-11-03 15:53:47', 1, 4, 81),
(15, 'woye', '2015-11-03 15:53:57', 1, 4, 81),
(16, 'qqq', '2015-11-03 15:55:46', 1, 4, 72);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_initiator_user_id` int(11) NOT NULL,
  `item_owner_user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `track_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `user_id`, `action_initiator_user_id`, `item_owner_user_id`, `post_id`, `picture_id`, `album_id`, `video_id`, `track_id`, `comment_id`, `date`, `read`) VALUES
(66, 'liked', 81, 72, 81, 171, 0, 0, 0, 0, 0, '2015-06-19 21:34:32', 1),
(67, 'liked', 81, 72, 81, 171, 0, 0, 0, 0, 0, '2015-06-19 21:35:48', 1),
(68, 'liked', 81, 72, 81, 171, 0, 0, 0, 0, 0, '2015-06-19 21:37:04', 1),
(69, 'liked', 81, 72, 81, 171, 0, 0, 0, 0, 0, '2015-06-19 21:38:19', 1),
(70, 'liked', 81, 72, 81, 171, 0, 0, 0, 0, 0, '2015-06-19 21:44:46', 1),
(71, 'liked', 81, 72, 81, 171, 0, 0, 0, 0, 0, '2015-06-19 21:44:46', 1),
(72, 'commented', 72, 81, 81, 171, 0, 0, 0, 0, 0, '2015-06-19 21:59:55', 1),
(73, 'commented', 78, 81, 78, 182, 0, 0, 0, 0, 0, '2015-06-19 22:00:12', 1),
(74, 'commented', 78, 81, 78, 182, 0, 0, 0, 0, 0, '2015-06-19 22:00:12', 1),
(75, 'liked', 81, 72, 78, 182, 0, 0, 0, 0, 0, '2015-06-19 22:01:07', 1),
(76, 'liked', 78, 72, 78, 182, 0, 0, 0, 0, 0, '2015-06-19 22:01:07', 1),
(77, 'liked', 78, 72, 78, 182, 0, 0, 0, 0, 0, '2015-06-19 22:01:07', 1),
(78, 'commented', 81, 78, 72, 172, 0, 0, 0, 0, 0, '2015-06-19 22:13:51', 1),
(79, 'commented', 72, 78, 72, 172, 0, 0, 0, 0, 0, '2015-06-19 22:13:51', 1),
(80, 'liked', 78, 81, 72, 0, 115, 0, 0, 0, 0, '2015-06-21 20:03:38', 1),
(81, 'liked', 72, 81, 72, 0, 115, 0, 0, 0, 0, '2015-06-21 20:03:38', 1),
(82, 'liked', 81, 78, 81, 0, 0, 0, 0, 0, 77, '2015-06-24 00:09:32', 1),
(83, 'commented', 72, 78, 72, 0, 0, 93, 0, 0, 0, '2015-06-24 00:10:00', 1),
(84, 'liked', 81, 78, 81, 0, 0, 0, 0, 0, 75, '2015-06-24 00:10:10', 1),
(85, 'commented', 81, 78, 72, 0, 115, 0, 0, 0, 0, '2015-06-24 00:10:18', 0),
(86, 'commented', 72, 78, 72, 0, 115, 0, 0, 0, 0, '2015-06-24 00:10:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

DROP TABLE IF EXISTS `notification_settings`;
CREATE TABLE IF NOT EXISTS `notification_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(30) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `filetype` varchar(5) NOT NULL,
  `position` int(11) NOT NULL,
  `upload_date` datetime DEFAULT NULL,
  `caption` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `album_id`, `user_id`, `filename`, `thumbnail`, `filetype`, `position`, `upload_date`, `caption`) VALUES
(112, 92, 71, '1.jpg', '1_tn.jpg', '', 0, '2015-05-29 05:14:06', ''),
(113, 92, 71, '113.jpg', '113_tn.jpg', '', 0, '2015-05-29 05:15:12', ''),
(114, 92, 71, '114.jpg', '114_tn.jpg', '', 0, '2015-05-29 05:15:41', ''),
(115, 93, 72, '1.jpg', '1_tn.jpg', '', 0, NULL, ''),
(116, 93, 72, '116.jpg', '116_tn.jpg', '', 0, NULL, ''),
(117, 93, 72, '117.jpg', '117_tn.jpg', '', 0, NULL, ''),
(118, 93, 72, '118.jpg', '118_tn.jpg', '', 0, NULL, ''),
(119, 93, 72, '119.jpg', '119_tn.jpg', '', 0, NULL, ''),
(120, 93, 72, '120.jpg', '120_tn.jpg', '', 0, NULL, ''),
(121, 93, 72, '121.jpg', '121_tn.jpg', '', 0, NULL, ''),
(122, 93, 72, '122.jpg', '122_tn.jpg', '', 0, NULL, ''),
(123, 93, 72, '123.jpg', '123_tn.jpg', '', 0, NULL, ''),
(124, 93, 72, '124.jpg', '124_tn.jpg', '', 0, NULL, ''),
(125, 94, 72, '125.jpg', '125_tn.jpg', '', 0, NULL, ''),
(126, 94, 72, '126.jpg', '126_tn.jpg', '', 0, NULL, ''),
(127, 94, 72, '127.jpg', '127_tn.jpg', '', 0, NULL, ''),
(128, 95, 72, '128.jpg', '128_tn.jpg', '', 0, NULL, ''),
(129, 96, 72, '129.jpg', '129_tn.jpg', '', 0, NULL, ''),
(130, 97, 72, '130.jpg', '130_tn.jpg', '', 0, NULL, ''),
(131, 98, 72, '131.jpg', '131_tn.jpg', '', 0, NULL, ''),
(132, 99, 72, '132.jpg', '132_tn.jpg', '', 0, '2015-06-08 02:41:20', ''),
(133, 100, 81, '1.jpg', '1_tn.jpg', '', 0, '2015-06-09 10:33:04', ''),
(134, 100, 81, '134.jpg', '134_tn.jpg', '', 0, '2015-06-13 08:07:14', ''),
(135, 100, 81, '135.jpg', '135_tn.jpg', '', 0, '2015-06-13 08:07:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wall_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `value` varchar(3000) NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_type` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=183 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `wall_id`, `user_id`, `post_id`, `picture_id`, `value`, `post_date`, `post_type`) VALUES
(162, 71, 71, 0, 0, 'this is a test', '2015-04-01 18:21:06', 3),
(163, 71, 71, 0, 0, 'eefe', '2015-04-01 18:21:21', 3),
(164, 71, 71, 163, 0, 'tets', '2015-04-01 18:22:48', 5),
(165, 71, 80, 0, 0, '', NULL, 4),
(166, 80, 71, 0, 0, '', NULL, 4),
(170, 72, 72, 0, 0, 'aaa', '2015-06-08 02:46:33', 3),
(171, 81, 81, 0, 0, 'blah', '2015-06-09 05:04:30', 3),
(172, 72, 72, 0, 0, 'testing notifications', '2015-06-13 19:07:32', 3),
(174, 78, 81, 0, 0, '', '2015-06-13 23:57:09', 4),
(175, 81, 78, 0, 0, '', '2015-06-13 23:57:09', 4),
(176, 72, 81, 0, 0, '', '2015-06-13 23:59:38', 4),
(177, 81, 72, 0, 0, '', '2015-06-13 23:59:38', 4),
(178, 78, 72, 0, 0, '', '2015-06-14 00:19:50', 4),
(179, 72, 78, 0, 0, '', '2015-06-14 00:19:50', 4),
(180, 80, 78, 0, 0, '', '2015-06-14 00:21:01', 4),
(181, 78, 80, 0, 0, '', '2015-06-14 00:21:01', 4),
(182, 78, 78, 0, 0, 'this is a test', '2015-06-14 16:37:39', 3);

-- --------------------------------------------------------

--
-- Table structure for table `post_types`
--

DROP TABLE IF EXISTS `post_types`;
CREATE TABLE IF NOT EXISTS `post_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `user_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL DEFAULT '1',
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `email_notifications` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`user_id`, `theme_id`, `language`, `email_notifications`) VALUES
(78, 1, 'en', 1),
(71, 1, 'en', 1),
(72, 1, 'en', 1),
(70, 1, 'en', 1),
(79, 1, 'en', 1),
(80, 1, 'en', 1),
(81, 1, 'en', 1);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `description`) VALUES
(1, 'facebook', 'this theme is sort of a facebook replica'),
(2, 'fb-bootstrap', 'bootstrap version of the facebook theme'),
(3, 'ma', 'member''s area');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

DROP TABLE IF EXISTS `track`;
CREATE TABLE IF NOT EXISTS `track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(30) NOT NULL,
  `filetype` varchar(5) NOT NULL,
  `position` int(11) NOT NULL,
  `upload_date` datetime DEFAULT NULL,
  `caption` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `album_id`, `user_id`, `filename`, `filetype`, `position`, `upload_date`, `caption`) VALUES
(1, 1, 71, '1.mp3', 'mp3', 1, '2015-02-28 04:11:47', 'yeppp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `sex` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `ip` varchar(25) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(30) DEFAULT '0',
  `state` varchar(30) DEFAULT '0',
  `country` varchar(50) DEFAULT '0',
  `zipcode` varchar(15) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `interested_in` varchar(30) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `work` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `interests` varchar(5000) DEFAULT NULL,
  `verification_key` varchar(40) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `middlename`, `sex`, `birthdate`, `username`, `password`, `ip`, `address`, `city`, `province`, `state`, `country`, `zipcode`, `relationship`, `interested_in`, `school`, `major`, `level`, `work`, `position`, `occupation`, `interests`, `verification_key`, `verified`) VALUES
(71, 'max', 'mckenzy I', '', 'm', '1982-07-15', 'max@webmediasolutionz.com', 'password01', '', '', '', '0', '0', '0', '', '0', 'w', '', '', '', '', '', '', '', 'd69ce5b86ae94a93b2ab2c764eecfd551d127f83', 0),
(72, 'Mei', 'Maza', '', 'f', '1978-11-20', 'info@webmediasolutionz.com', 'password01', '', '', '', '0', '0', '0', '', '0', 'm', '', '', '', '', '', '', '', '', 1),
(78, 'max', 'mckenzy III', '', 'm', '1982-07-15', 'support@webmediasolutionz.com', 'password01', '', '', '', '0', '0', '0', '', '0', 'w', '', '', '', '', '', '', '', '', 1),
(79, 'max', 'mckenzy IV', '', 'm', '1982-07-15', 'mmaaddmmaaxxx@gmail.com', 'password01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0),
(80, 'mei', 'maza', NULL, 'f', '2015-11-20', 'meimaza@ymail.com', 'nino0041', NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(81, 'max', 'mckenzy', '', 'm', '1982-07-15', 'max@webmediasolutionz.com', 'password01', '', '', '', '0', '0', '0', '', '0', 'w', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(30) NOT NULL,
  `filetype` varchar(5) NOT NULL,
  `position` int(11) NOT NULL,
  `upload_date` datetime DEFAULT NULL,
  `caption` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `album_id`, `user_id`, `filename`, `filetype`, `position`, `upload_date`, `caption`) VALUES
(1, 1, 71, '1.mp4', 'mp4', 1, '2015-02-28 03:14:26', 'yep');

-- --------------------------------------------------------

--
-- Table structure for table `wall`
--

DROP TABLE IF EXISTS `wall`;
CREATE TABLE IF NOT EXISTS `wall` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wall`
--

INSERT INTO `wall` (`id`) VALUES
(71),
(72),
(78),
(79);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
