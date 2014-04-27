-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2011 at 10:52 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tinybbdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `notes` varchar(1000) NOT NULL,
  `admin_message` varchar(1000) NOT NULL,
  `rules` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`notes`, `admin_message`, `rules`) VALUES
('Admin home.', '[b]Welcome to the moderation panel![/b]\r\n\r\nMy name is admin, I''m your awesome administrator. Did you know this forum is powered by TinyBB 1.4? It''s awesome isn''t it?', '[b][u]Rule 1[/u][/b]\r\nDo not...\r\n\r\n[b][u]Rule 2[/u][/b]\r\nDo not...\r\n\r\n\r\nEct...');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `award_user` varchar(100) NOT NULL,
  `award_desc` varchar(500) NOT NULL,
  `award_img` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `awards`
--


-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `admin` varchar(3) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bio` varchar(500) NOT NULL,
  `online` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `email`, `ip`, `date`, `admin`, `avatar`, `name`, `bio`, `online`) VALUES
(76, 'admin', '64d7103eef2b14bbb2d0b57c38cc3fbee29ff72a', 'admin@yourdomain.com', '', '03-01-2011', '1', '', '', '', '1298199048');

-- --------------------------------------------------------

--
-- Table structure for table `tinybb_categories`
--

CREATE TABLE IF NOT EXISTS `tinybb_categories` (
  `cat_title` varchar(25) NOT NULL,
  `cat_desc` varchar(45) NOT NULL,
  `cat_id` int(12) NOT NULL AUTO_INCREMENT,
  `cat_icon` varchar(200) NOT NULL,
  `cat_admin` int(11) NOT NULL,
  `cat_order` varchar(20) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tinybb_categories`
--

INSERT INTO `tinybb_categories` (`cat_title`, `cat_desc`, `cat_id`, `cat_icon`, `cat_admin`, `cat_order`) VALUES
('First Category', 'This is the first ever category!', 1, '', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tinybb_news`
--

CREATE TABLE IF NOT EXISTS `tinybb_news` (
  `news_title` varchar(100) NOT NULL,
  `news_content` varchar(5000) NOT NULL,
  `news_author` varchar(100) NOT NULL,
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_date` text NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tinybb_news`
--

INSERT INTO `tinybb_news` (`news_title`, `news_content`, `news_author`, `news_id`, `news_date`) VALUES
('Example News Post', 'This is an example, edit or delete =)', 'TinyBB.net', 1, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `tinybb_replies`
--

CREATE TABLE IF NOT EXISTS `tinybb_replies` (
  `reply_author` varchar(25) NOT NULL,
  `reply_content` varchar(5000) NOT NULL,
  `reply_key` varchar(1000) NOT NULL,
  `thread_key` varchar(1000) NOT NULL,
  `date` text NOT NULL,
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=294 ;

--
-- Dumping data for table `tinybb_replies`
--


-- --------------------------------------------------------

--
-- Table structure for table `tinybb_settings`
--

CREATE TABLE IF NOT EXISTS `tinybb_settings` (
  `tinybb_title` varchar(100) NOT NULL,
  `tinybb_guest_access` varchar(1) NOT NULL,
  `tinybb_maintenance` varchar(1) NOT NULL,
  `tinybb_maintenance_message` varchar(200) NOT NULL,
  `tinybb_categories` varchar(1) NOT NULL,
  `tinybb_stats` varchar(1) NOT NULL DEFAULT '1',
  `tinybb_list_amount` varchar(10) NOT NULL,
  `tinybb_registration` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tinybb_settings`
--

INSERT INTO `tinybb_settings` (`tinybb_title`, `tinybb_guest_access`, `tinybb_maintenance`, `tinybb_maintenance_message`, `tinybb_categories`, `tinybb_stats`, `tinybb_list_amount`, `tinybb_registration`) VALUES
('TinyBB 1.4.2', '1', '1', 'Maintenance message.', '1', '1', '20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tinybb_threads`
--

CREATE TABLE IF NOT EXISTS `tinybb_threads` (
  `thread_title` varchar(25) NOT NULL,
  `thread_author` varchar(25) NOT NULL,
  `thread_content` varchar(5000) NOT NULL,
  `thread_key` varchar(1000) NOT NULL,
  `thread_lock` varchar(1) NOT NULL,
  `date` text NOT NULL,
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

--
-- Dumping data for table `tinybb_threads`
--

INSERT INTO `tinybb_threads` (`thread_title`, `thread_author`, `thread_content`, `thread_key`, `thread_lock`, `date`, `aid`, `cat_id`) VALUES
('Welcome to TinyBB 1.4', 'admin', 'Welcome to your new TinyBB 1.4 installation.\r\n\r\n----\r\nVersion release notes: 1.4.2 - This release fixes category listing IDs and thread listing ids\r\nDevelopers: Jake Steele; Tyler Brenlich\r\nVersion Data: Fixes Listing Errors', '444709648', '', '16-02-2011', 189, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
