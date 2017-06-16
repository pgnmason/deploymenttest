-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: db150a.pair.com
-- Generation Time: Feb 11, 2014 at 09:06 AM
-- Server version: 5.5.29
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dkremer_productsadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_acos`
--

CREATE TABLE IF NOT EXISTS `acl_acos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `acl_acos`
--

INSERT INTO `acl_acos` (`id`, `name`, `parent`) VALUES
(1, 'View Content', 0),
(2, 'Admin Functions', 0),
(3, 'Update Users', 2),
(4, 'View Users', 2),
(5, 'Support', 2),
(6, 'Delete Users', 2),
(7, 'Member Functions', 9),
(8, 'Promoter Functions', 9),
(9, 'User Functions', 0),
(10, 'Promoter Profile', 8),
(11, 'Flytunes Add', 8),
(12, 'Member Profile', 9),
(13, 'Change Permissions', 2),
(14, 'Contact Emails', 2);

-- --------------------------------------------------------

--
-- Table structure for table `acl_aros`
--

CREATE TABLE IF NOT EXISTS `acl_aros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `acl_aros`
--

INSERT INTO `acl_aros` (`id`, `name`, `parent`) VALUES
(1, 'User', 0),
(2, 'Backend User', 1),
(3, 'Super Administrator', 2),
(4, 'Administrator', 2),
(5, 'Support', 2),
(6, 'Front End User', 1),
(7, 'Promoter', 6),
(8, 'Member', 6),
(15, 'Guest', 6);

-- --------------------------------------------------------

--
-- Table structure for table `acl_perm`
--

CREATE TABLE IF NOT EXISTS `acl_perm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aco_id` int(11) NOT NULL,
  `aro_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aco_id` (`aco_id`),
  KEY `aro_id` (`aro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `acl_perm`
--

INSERT INTO `acl_perm` (`id`, `aco_id`, `aro_id`, `state`) VALUES
(3, 13, 2, -1),
(5, 5, 2, -1),
(6, 5, 5, 1),
(7, 2, 1, -1),
(8, 14, 5, -1),
(11, 5, 3, 1),
(12, 1, 1, 1),
(13, 13, 3, 1),
(14, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_mailbox`
--

CREATE TABLE IF NOT EXISTS `admin_mailbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) NOT NULL,
  `email` varchar(320) NOT NULL,
  `subject` varchar(882) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `data` text NOT NULL,
  `ticket` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `documentation` text NOT NULL,
  `edit_user` int(11) NOT NULL,
  `edit_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE IF NOT EXISTS `counters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `name`, `value`) VALUES
(1, 'support_tickets', 100008);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `name` varchar(300) NOT NULL,
  `parent` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `type`, `name`, `parent`, `order`, `description`) VALUES
(1, 'product', 'Consumer Electronics', 0, 0, '<p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;">Consumer electronics (abbreviated CE) are electronic equipment intended for everyday use, most often in entertainment, communications and office productivity.</p><p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;">Main products include radio receivers, television sets, MP3 players, video recorders, DVD players, digital cameras, camcorders, personal computers, video game consoles, telephones and mobile phones. Increasingly these products have become based on digital technologies, and have largely merged with the computer industry in what is increasingly referred to as the consumerization of information technology such as those invented by Apple Inc. and MIT Media Lab.</p><p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;">The largest consumer electronics companies are mostly from United States[1] and to lesser extent South Korea and Taiwan.</p><p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;">The latest consumer electronics are previewed yearly at the Consumer Electronics Show in Las Vegas, Nevada, at which many industry pioneers speak.</p>'),
(2, 'product', 'DVR, Blu-Ray, and DVD players', 1, 1, ''),
(4, 'product', 'Rifles', 6, 3, 'Long Range Guns'),
(6, 'product', 'Firearms', 0, 0, '<p>A firearm is a portable gun, being a barreled weapon that launches one or more projectiles often defined by the action of an explosive.[1][2][3] The first primitive firearms were invented in 13th century China when the man portable fire lance (a bamboo or metal tube that could shoot ignited gunpowder) was combined with projectiles such as scrap metal, broken porcelain, or darts/arrows.[4] The technology gradually spread through the rest of East Asia, South Asia, Middle East and then into Europe. In older firearms, the propellant was typically black powder, but modern firearms use smokeless powder or other propellants. Most modern firearms (with the notable exception of smoothbore firearms) have rifled barrels to impart spin to the projectile for improved flight stability.</p>'),
(7, 'product', 'Handguns', 6, 0, 'Handguns');

-- --------------------------------------------------------

--
-- Table structure for table `product_manufacturers`
--

CREATE TABLE IF NOT EXISTS `product_manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `order` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_manufacturers`
--

INSERT INTO `product_manufacturers` (`id`, `category`, `name`, `order`, `data`) VALUES
(2, 0, 'Widgets', 0, ''),
(3, 0, 'Widget Maker Industries', 1, ''),
(4, 0, 'Nate''s Widgets are us', 0, ''),
(5, 0, 'Smith & Wesson', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_products`
--

CREATE TABLE IF NOT EXISTS `product_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` text NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product_products`
--

INSERT INTO `product_products` (`id`, `manufacturer`, `category`, `name`, `image`, `description`, `order`) VALUES
(5, '5', 7, 'Smith & Wesson M&P Compact .40 S&W', 'images/uploads/109003_01_lg-2.jpg', '<p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;">Meet the M&P Compact Pistol from Smith & Wesson.</p><p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;"><span style="line-height: 1.428571429;">Reinforced polymer chassis, superior ergonomics, ambidextrous controls, proven safety features. The new standard in reliability when your job is to serve and protect and your life is on the line.</span></p><p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;"><span style="line-height: 1.428571429;">Available in 40S&W, 9mm and 357Sig.</span></p><p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;"><span style="line-height: 1.428571429;">In the design of the M&P, we considered the needs of military and law enforcement from every conceivable angle. No other polymer pistol offers this combination of versatility, durability and safety. ALL BACKED BY OUR SMITH & WESSON LIFETIME SERVICE POLICY.Â </span></p>', 0),
(6, '5', 4, 'Model M&P15 - 300 WhisperÂ®', 'images/uploads/811003_01_lg.jpg', '<p style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAALHRFWHRDcmVhdGlvbiBUaW1lAEZyaSAxMiBOb3YgMjAxMCAxOTowNzowMiArMTIwMOGr8p4AAAAHdElNRQfaCwwGBxwduq16AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAAfJJREFUeNqVkk1vElEUhp87X4CIFhhMG0toMC5K3Lgxbro10bhxY2Jc+CO666Y/oP/DxFVjTKM7l1apTdM0JSU0LSg0WqaUjwE6MDNebGpKBYlndc+55zw5H6/gim2UUd0qs5Uy6VaTa7EYdtOmUN7naHER92q+dtnZ2UFpHTOTXWfuwxrfYlNUHz1lxvdIVyx6MuXHPwFeBLW2z+29Pepr7ziUof7SEq1CibCEmKMAymXH6SD6LrpzRndQPIjNz9P3odu2URlhQ4C+ghcM0JpLEchkzrv7eIDS62JYP2lPBJS2cIMhyrMpwo+fMbW8jLhhc2t3F906pjoK8GcH29vonoenRDk1m5zcvUM6ZuJvZEnmcljT09hbR6iVIuLJw/PxhgAOPOj26Gk1nEQCNWAQ7XS4bxvw8hWuGedeo4iR+/y7+OtfgM1N9OIBwnFQ5SLdZJJ2JML17BdqEuYHgmiahsjnx4zw/i2fslm8dht/YQHx/AWpfI50/ZTKm9d8lykiHkf4/hjA6ipnF++VFRS7T1AoaDejyCEYlHmWNeEKF9YISz30CBkGirxKUIZGamAsQG2hux66BAipi1A6g/5fAM/HkGrUFfmr6wSSiWHJTwQoPrq8hCYEGDoh0xzfwUhyIY9ROkRrNKQ65e1P6uM7+AW+ibcHEM1ixAAAAABJRU5ErkJggg==); background-position: 841px 0px; background-repeat: no-repeat no-repeat;">Features &amp; Benefits&nbsp;</p><p><ul><li><span style="line-height: 1.428571429;">Built on the M&amp;P15 platform</span></li><li><span style="line-height: 1.428571429;">5R Rifling</span></li><li><span style="line-height: 1.428571429;">MCRâ„¢ - Maximum corrosion resistant barrel finish</span></li><li><span style="line-height: 1.428571429;">Low recoil and muzzle blast</span></li><li><span style="line-height: 1.428571429;">Barrel threaded to 5/8-24</span></li><li><span style="line-height: 1.428571429;">1 in 7.5" barrel twisted rate</span></li><li><span style="line-height: 1.428571429;">Chromed firing pin</span></li></ul><span style="line-height: 1.428571429;">Availability subject to applicable federal, state and local laws, regulations, and ordinances.&nbsp;</span></p>', 1),
(7, 'images/uploads/468676_e18c1fccb75240ecb2e8ceb8222659d0-1.pdf', 2, 'Curtis Compact DVD Player- DVD1041', 'images/uploads/spin_prod_391301601.jpg', '<p><b>Description </b>Item # 05757139000P Model # DVD1041</p><p>Compact Curtis DVD Player Packs a Big Punch for Such a Little Guy</p><p><br></p><p>Enjoy all your favorite films from pretty much anywhere with this Curtis Compact DVD Player from Sears. Whoever said bigger is better never met this powerful little guy. A true space saver, this tiny little DVD player is incognito in pretty much any environment, so you never have to worry about it overpowering your decor or cluttering up your countertops, table space or entertainment center. It''s welcome in the den or family room, but works especially well in a bedroom, kitchen, home office or any room where you might be short on space. It''s even small enough to stash along on your next family trip.</p><p><br></p><p>This Curtis DVD Player also offers 500 lines definition, so you know your viewing experience will be pristine. It comes with a full-function remote control as well, so you can sit back, relax and enjoy the show the whole way through. Additional features include two-channel output and different level lock, fragment selection. All the essentials in one compact little design, and at a price that you can smile about. Seriously, go ahead and grin about it!</p><p><br></p><p>This Curtis Compact DVD Player from Sears offers everything you need in one little space-saving design</p><p>The perfect fit for any room or on-the-go, this DVD player takes up less space and blends effortlessly into any environment</p><p>Plays your entire prized DVD collection, and does double-duty by letting you listen to your favorite CDs as well</p><p>More than 500 lines definition brings you clear image quality</p><p>Full-function remote control gives you all the power, and none of the pacing back and forth or frustration</p><p>Different level lock, fragment selection</p><p>Two-channel output</p><p><b>Added on May 26, 2010</b></p>', 0),
(8, 'images/uploads/pdfsboltinfilterspiftf201.pdf', 1, 'New Product', 'images/uploads/all-access-cash_landing_enter-1.jpg', 'This is a new product description', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `data` text,
  `lastaccess` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `send_email` int(11) NOT NULL,
  `register_date` int(11) NOT NULL,
  `last_visit` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group`, `firstname`, `lastname`, `username`, `email`, `pass`, `salt`, `send_email`, `register_date`, `last_visit`, `active`) VALUES
(2, 3, 'Nate', 'Mason', 'admin', 'mandawgus@gmail.com', 'f86946d85052aa860265db02ce4e9c1f0e616e9e21ddd8ac6c74ac2bc3221a7fbe2dd02bbb927e10ca8d0f594e17401e0dff6dd549312aebc0a97d535ee99429', 'zcBfcArpxdvgugDnHyaFe', 1, 1283374551, 1283374551, 1),
(3, 5, 'Nate', 'Mason', 'mandawgus', 'nate@fargodesignco.com', '232520e6e0a50d267b20e0059b1e68122f646fa79334aad64dfd527994ea5b5155585ef12cfaf70613e78b1a97016c054bdbbc27c32837dffc8a5cffe1533b88', 'bfztnnujytFxBHHcnHzrk', 1, 1283375808, 1283375808, 1),
(4, 4, 'Product', 'Admin', 'dkremer', 'admin@bricklayertech.com', '7258729ca7e07526f88aee7daccf43e6072575502ccf1c634addf5ffaf65e510a52a85a7108968663700962806c9eba9c622535fb9acb0d9b5725b2ac87c1ba0', '', 0, 1391720226, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_perm`
--
ALTER TABLE `acl_perm`
  ADD CONSTRAINT `acl_ibfk_1` FOREIGN KEY (`aro_id`) REFERENCES `acl_aros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_ibfk_2` FOREIGN KEY (`aco_id`) REFERENCES `acl_acos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_perm_ibfk_1` FOREIGN KEY (`aro_id`) REFERENCES `acl_aros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `acl_aros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
