-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2013 at 09:17 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `created`, `modified`, `user_id`, `status`) VALUES
(51, 'Album1', '2013-04-30 16:17:33', '2013-04-30 16:24:03', 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'sport'),
(3, 'art');

-- --------------------------------------------------------

--
-- Table structure for table `categories_posts`
--

CREATE TABLE IF NOT EXISTS `categories_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `categories_posts`
--

INSERT INTO `categories_posts` (`id`, `category_id`, `post_id`) VALUES
(3, 1, 60),
(4, 3, 62),
(5, 1, 63),
(6, 1, 64),
(7, 1, 65),
(8, 1, 66),
(9, 1, 67),
(10, 3, 68),
(11, 3, 69),
(12, 3, 70),
(13, 3, 71),
(14, 3, 72),
(15, 3, 73),
(16, 3, 74);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `reported` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `created`, `post_id`, `user_id`, `status`, `reported`) VALUES
(1, 'hi', '2013-04-30 18:36:47', 74, 40, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image_dir` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `liked` int(11) DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `viewed` (`viewed`),
  KEY `album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `created`, `modified`, `image`, `image_dir`, `status`, `user_id`, `liked`, `viewed`, `album_id`) VALUES
(60, 'p1', '2013-04-30 16:17:33', '2013-04-30 16:17:33', '8691252715_7f5e5542eb.jpg', '60', 1, 40, 0, 0, 51),
(61, 'p2', '2013-04-30 16:18:18', '2013-04-30 16:18:18', '8691317213_8d747e74ab_m.jpg', '61', 1, 40, 0, 0, 51),
(62, 'p3', '2013-04-30 16:18:44', '2013-04-30 16:18:44', '8691381029_4fe8f8f9e9_m.jpg', '62', 1, 40, 0, 0, 51),
(63, 'p4', '2013-04-30 16:19:39', '2013-04-30 16:19:39', '8691465523_1b061311c2_m.jpg', '63', 1, 40, 0, 0, 51),
(64, 'p5', '2013-04-30 16:19:57', '2013-04-30 16:19:57', '8691472147_da864e82f0_n.jpg', '64', 1, 40, 0, 0, 51),
(65, 'p6', '2013-04-30 16:20:15', '2013-04-30 16:20:15', '8691496393_6038499914_m.jpg', '65', 1, 40, 0, 0, 51),
(66, 'p7', '2013-04-30 16:20:36', '2013-04-30 16:20:36', '8691715431_89facbf2fb_n.jpg', '66', 1, 40, 0, 0, 51),
(67, 'p8', '2013-04-30 16:20:57', '2013-04-30 16:20:57', '8692012439_d35b2c47d1_n.jpg', '67', 1, 40, 0, 0, 51),
(68, 'p10', '2013-04-30 16:21:18', '2013-04-30 16:21:18', '8691868671_22b1696f6d.jpg', '68', 1, 40, 0, 0, 51),
(69, 'p11', '2013-04-30 16:21:39', '2013-04-30 16:21:39', '8691706323_86489af64d_n.jpg', '69', 1, 40, 0, 0, 51),
(70, 'p12', '2013-04-30 16:22:04', '2013-04-30 16:22:04', '8692626073_8c4dda346b.jpg', '70', 1, 40, 0, 0, 51),
(71, 'p13', '2013-04-30 16:22:28', '2013-04-30 16:22:28', '8692374594_559fbe295c_n.jpg', '71', 1, 40, 0, 0, 51),
(72, 'p14', '2013-04-30 16:22:48', '2013-04-30 16:22:48', '8692914378_0e8bd8df73_n.jpg', '72', 1, 40, 0, 0, 51),
(73, 'p15', '2013-04-30 16:23:08', '2013-04-30 16:23:08', '8693127060_eb4ce74904.jpg', '73', 1, 40, 0, 0, 51),
(74, 'p16', '2013-04-30 16:23:43', '2013-04-30 16:23:43', '8694631154_cc67a63fd9_m.jpg', '74', 1, 40, 0, 0, 51),
(75, 'p17', '2013-04-30 16:24:03', '2013-04-30 16:24:03', '8693422936_e2d6460336_n.jpg', '75', 1, 40, 0, 0, 51);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `role` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_me` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banned` int(11) DEFAULT NULL,
  `facebook_id` bigint(20) unsigned DEFAULT NULL,
  `gender` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created`, `modified`, `role`, `status`, `email`, `avatar`, `avatar_dir`, `about_me`, `banned`, `facebook_id`, `gender`) VALUES
(40, 'Duong Nguyen Anh', '0d656860e45f40c3a3c977b0a454955d3db1fae8', '2013-04-29 11:10:26', '2013-04-29 11:10:26', 'author', 0, 'anhduongictk54@gmail.com', NULL, NULL, NULL, NULL, 100003228897109, 'male'),
(41, 'normal', 'd2825872c593c53baaa4b13b8628d597d6653601', '2013-04-29 11:14:38', '2013-04-29 11:14:38', 'author', 1, 'normal@gmail.com', NULL, NULL, '', 0, NULL, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `categories_posts`
--
ALTER TABLE `categories_posts`
  ADD CONSTRAINT `categories_posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `categories_posts_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
