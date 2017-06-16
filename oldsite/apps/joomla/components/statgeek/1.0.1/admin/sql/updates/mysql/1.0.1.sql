
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 50.63.233.119
-- Generation Time: Sep 09, 2013 at 05:25 AM
-- Server version: 5.0.96
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


--
-- Database: `bri1309408391312`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_attribute`
--
-- Creation: Aug 09, 2013 at 12:08 PM
-- Last update: Sep 06, 2013 at 09:15 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_attribute` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `ordering` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `abbreviation` varchar(11) NOT NULL,
  `label` varchar(200) NOT NULL,
  `field_type` varchar(30) NOT NULL default 'text',
  `field_data` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `#__statgeek_attribute`
--

INSERT INTO `#__statgeek_attribute` VALUES(1, 'height', 3, 1, 'Ht.', 'Height', 'text', '');
INSERT INTO `#__statgeek_attribute` VALUES(2, 'weight', 0, 1, 'Wt.', 'Weight', 'text', '');
INSERT INTO `#__statgeek_attribute` VALUES(3, 'address', 0, 2, 'Addr', 'Address', 'text', '');
INSERT INTO `#__statgeek_attribute` VALUES(4, 'number', 0, 1, 'No.', 'Number', 'integer', '0:99:1');
INSERT INTO `#__statgeek_attribute` VALUES(5, 'school', 0, 1, 'HS', 'High School', 'text', '');
INSERT INTO `#__statgeek_attribute` VALUES(7, 'city', 0, 2, 'City', 'City', 'text', '');
INSERT INTO `#__statgeek_attribute` VALUES(8, 'photo', 0, 1, 'photo', 'Player Photo', 'media', '');
INSERT INTO `#__statgeek_attribute` VALUES(9, 'state', 0, 2, 'State', 'State', 'text', '');
INSERT INTO `#__statgeek_attribute` VALUES(10, 'pfc_experience', 2, 0, 'pfcexp', 'PFC Years', 'integer', '0:50:1');
INSERT INTO `#__statgeek_attribute` VALUES(11, 'position', 0, 1, 'Pos', 'Player Position', 'sql', 'select * from #__statgeek_position where sports=1');
INSERT INTO `#__statgeek_attribute` VALUES(12, 'position', 1, 0, 'Pos.', 'Coach Position', 'sql', 'select * from #__statgeek_position where `type` = 0');
INSERT INTO `#__statgeek_attribute` VALUES(13, 'previous_experience', 5, 0, 'prevexp', 'Previous Experience', 'editor', '');
INSERT INTO `#__statgeek_attribute` VALUES(14, 'certificates', 4, 0, 'certs', 'Coaching Certificates', 'textarea', '');
INSERT INTO `#__statgeek_attribute` VALUES(15, 'coach_photo', 6, 0, 'photo', 'Coach Photo', 'media', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_coache`
--
-- Creation: Aug 09, 2013 at 11:29 AM
-- Last update: Sep 06, 2013 at 09:21 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_coache` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `team` int(11) NOT NULL,
  `bio` text NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__statgeek_coache`
--

INSERT INTO `#__statgeek_coache` VALUES(1, 'Jimmy', 'Beam', 1, '<p>Heavy Drinking, hard hat wearing son of a bitch</p>', '{"position":"5","pfc_experience":"6","certificates":"2008-2012 League Coach of the Year","previous_experience":"<p>This dude rawks, seriously!<\\/p>","coach_photo":"images\\/sampledata\\/fruitshop\\/tamarind.jpg"}');
INSERT INTO `#__statgeek_coache` VALUES(2, 'Terry', 'Brooks', 1, '<p>Balances Jimmy''s craziness with knowledge of the game</p>', '{"position":"6","pfc_experience":"2","certificates":"","previous_experience":"<p>Worked alongside the best<\\/p>","coach_photo":"images\\/sampledata\\/parks\\/animals\\/789px_spottedquoll_2005_seanmcclean.jpg"}');

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_coaches_profile`
--
-- Creation: Jun 27, 2013 at 09:01 AM
-- Last update: Jun 27, 2013 at 09:01 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_coaches_profile` (
  `id` int(11) NOT NULL auto_increment,
  `coach` varchar(150) NOT NULL default '',
  `details` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__statgeek_coaches_profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_game`
--
-- Creation: Aug 09, 2013 at 12:07 PM
-- Last update: Sep 06, 2013 at 08:54 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_game` (
  `id` int(11) NOT NULL auto_increment,
  `hometeam` int(11) NOT NULL default '0',
  `awayteam` int(11) NOT NULL default '0',
  `homescore` int(11) NOT NULL default '0',
  `awayscore` int(11) NOT NULL default '0',
  `date` datetime NOT NULL,
  `season` int(11) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `#__statgeek_game`
--

INSERT INTO `#__statgeek_game` VALUES(1, 2, 1, 5, 3, '2013-08-24 08:00:00', 1, '');
INSERT INTO `#__statgeek_game` VALUES(2, 2, 3, 3, 4, '2013-08-31 10:00:00', 1, '');
INSERT INTO `#__statgeek_game` VALUES(3, 1, 6, 6, 3, '2013-08-31 09:00:00', 1, '');
INSERT INTO `#__statgeek_game` VALUES(4, 3, 1, 1, 0, '2013-08-31 09:00:00', 1, '');
INSERT INTO `#__statgeek_game` VALUES(5, 6, 2, 6, 2, '2013-08-31 12:00:00', 1, '');
INSERT INTO `#__statgeek_game` VALUES(6, 1, 3, 3, 0, '2013-08-24 14:00:00', 1, '');
INSERT INTO `#__statgeek_game` VALUES(7, 6, 2, 4, 0, '2013-08-24 10:53:00', 1, '');
INSERT INTO `#__statgeek_game` VALUES(8, 3, 6, 2, 4, '2013-08-24 11:01:28', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_games_summary`
--
-- Creation: Jun 27, 2013 at 09:01 AM
-- Last update: Jun 27, 2013 at 09:01 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_games_summary` (
  `id` int(11) NOT NULL auto_increment,
  `game` int(11) NOT NULL,
  `summary` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__statgeek_games_summary`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_league`
--
-- Creation: Jun 27, 2013 at 09:16 AM
-- Last update: Sep 05, 2013 at 11:27 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_league` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL default '0',
  `league` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `#__statgeek_league`
--

INSERT INTO `#__statgeek_league` VALUES(1, 'PA West Under 12', 1, 1);
INSERT INTO `#__statgeek_league` VALUES(2, 'PA West Under 10', 1, 1);
INSERT INTO `#__statgeek_league` VALUES(3, 'PA West Under 11', 1, 1);
INSERT INTO `#__statgeek_league` VALUES(4, 'PA West Under 13', 1, 1);
INSERT INTO `#__statgeek_league` VALUES(5, 'PA West Juniors', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_map`
--
-- Creation: Jun 27, 2013 at 09:01 AM
-- Last update: Jun 27, 2013 at 09:01 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_map` (
  `id` int(11) NOT NULL auto_increment,
  `stat` int(11) NOT NULL,
  `sport` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__statgeek_map`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_player`
--
-- Creation: Aug 09, 2013 at 10:00 AM
-- Last update: Sep 06, 2013 at 09:33 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_player` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `team` int(11) NOT NULL,
  `bio` text NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `#__statgeek_player`
--

INSERT INTO `#__statgeek_player` VALUES(1, 'Tommy', 'John', 1, '<p>This is a good job. HMMM</p>', '{"weight":"Enough","number":"2","school":"Forest Hills","photo":"images\\/joomla_green.gif","position":"4","height":""}');
INSERT INTO `#__statgeek_player` VALUES(2, 'Jimmy', 'John', 1, '<p>He''s Tommy''s Brother</p>', '{"weight":"205","number":"55","school":"Forest Hills","photo":"images\\/powered_by.png","position":"1","height":""}');
INSERT INTO `#__statgeek_player` VALUES(3, 'Emily', 'Schock', 1, '<p>This is Emily''s profile.  Pretty Awesome!</p>', '{"weight":"128","number":"11","school":"Latrobe Area","photo":"images\\/sampledata\\/fruitshop\\/bananas_2.jpg","position":"3","height":"5'' 4\\""}');

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_player_stats`
--
-- Creation: Aug 16, 2013 at 08:05 AM
-- Last update: Sep 06, 2013 at 12:25 PM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_player_stats` (
  `id` int(11) NOT NULL auto_increment,
  `player` int(11) NOT NULL,
  `stat` varchar(200) NOT NULL,
  `team` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `game` int(11) NOT NULL default '-1',
  `value` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=183 ;

--
-- Dumping data for table `#__statgeek_player_stats`
--

INSERT INTO `#__statgeek_player_stats` VALUES(18, 2, 'yellow_cards', 1, 1, 6, 1);
INSERT INTO `#__statgeek_player_stats` VALUES(17, 2, 'minutes', 1, 1, 6, 20);
INSERT INTO `#__statgeek_player_stats` VALUES(16, 2, 'assists', 1, 1, 6, 1);
INSERT INTO `#__statgeek_player_stats` VALUES(15, 2, 'goals', 1, 1, 6, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(118, 1, 'shots_on_goal', 1, 1, 6, 4);
INSERT INTO `#__statgeek_player_stats` VALUES(19, 2, 'red_cards', 1, 1, 6, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(20, 2, 'shots', 1, 1, 6, 6);
INSERT INTO `#__statgeek_player_stats` VALUES(21, 2, 'saves', 1, 1, 6, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(22, 2, 'shots_on_goal', 1, 1, 6, 4);
INSERT INTO `#__statgeek_player_stats` VALUES(117, 1, 'saves', 1, 1, 6, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(116, 1, 'shots', 1, 1, 6, 4);
INSERT INTO `#__statgeek_player_stats` VALUES(115, 1, 'red_cards', 1, 1, 6, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(114, 1, 'yellow_cards', 1, 1, 6, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(113, 1, 'minutes', 1, 1, 6, 44);
INSERT INTO `#__statgeek_player_stats` VALUES(112, 1, 'assists', 1, 1, 6, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(111, 1, 'goals', 1, 1, 6, 1);
INSERT INTO `#__statgeek_player_stats` VALUES(142, 1, 'shots_on_goal', 1, 1, 5, 5);
INSERT INTO `#__statgeek_player_stats` VALUES(141, 1, 'saves', 1, 1, 5, 5);
INSERT INTO `#__statgeek_player_stats` VALUES(140, 1, 'shots', 1, 1, 5, 5);
INSERT INTO `#__statgeek_player_stats` VALUES(139, 1, 'red_cards', 1, 1, 5, 5);
INSERT INTO `#__statgeek_player_stats` VALUES(138, 1, 'yellow_cards', 1, 1, 5, 50);
INSERT INTO `#__statgeek_player_stats` VALUES(137, 1, 'minutes', 1, 1, 5, 90);
INSERT INTO `#__statgeek_player_stats` VALUES(136, 1, 'assists', 1, 1, 5, 5);
INSERT INTO `#__statgeek_player_stats` VALUES(135, 1, 'goals', 1, 1, 5, 5);
INSERT INTO `#__statgeek_player_stats` VALUES(143, 2, 'goals', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(144, 2, 'assists', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(145, 2, 'minutes', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(146, 2, 'yellow_cards', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(147, 2, 'red_cards', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(148, 2, 'shots', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(149, 2, 'saves', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(150, 2, 'shots_on_goal', 1, 0, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(182, 2, 'shots_on_goal', 1, 1, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(181, 2, 'saves', 1, 1, 1, 10);
INSERT INTO `#__statgeek_player_stats` VALUES(180, 2, 'shots', 1, 1, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(179, 2, 'red_cards', 1, 1, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(178, 2, 'yellow_cards', 1, 1, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(177, 2, 'minutes', 1, 1, 1, 55);
INSERT INTO `#__statgeek_player_stats` VALUES(176, 2, 'assists', 1, 1, 1, 0);
INSERT INTO `#__statgeek_player_stats` VALUES(175, 2, 'goals', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_position`
--
-- Creation: Aug 09, 2013 at 01:01 PM
-- Last update: Aug 09, 2013 at 01:05 PM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_position` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `abbreviation` varchar(256) NOT NULL,
  `sports` varchar(256) NOT NULL,
  `type` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `#__statgeek_position`
--

INSERT INTO `#__statgeek_position` VALUES(1, 'Goalkeeper', 'G', '1', 1);
INSERT INTO `#__statgeek_position` VALUES(2, 'Defender', 'D', '1', 1);
INSERT INTO `#__statgeek_position` VALUES(3, 'Midfielder', 'MF', '1', 1);
INSERT INTO `#__statgeek_position` VALUES(4, 'Forward', 'F', '1', 1);
INSERT INTO `#__statgeek_position` VALUES(5, 'Head Coach', 'HC', '1', 0);
INSERT INTO `#__statgeek_position` VALUES(6, 'Assistant Coach', 'AC', '1', 0);
INSERT INTO `#__statgeek_position` VALUES(7, 'Manager', 'Mgr', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_position_map`
--
-- Creation: Jun 27, 2013 at 09:01 AM
-- Last update: Jun 27, 2013 at 09:01 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_position_map` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `sport` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__statgeek_position_map`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_season`
--
-- Creation: Jun 27, 2013 at 09:16 AM
-- Last update: Sep 05, 2013 at 11:29 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_season` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL default '0',
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `league` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `#__statgeek_season`
--

INSERT INTO `#__statgeek_season` VALUES(1, '2013', 1, '2013-08-01', '2013-10-31', 1);
INSERT INTO `#__statgeek_season` VALUES(2, '2013', 1, '2013-09-07', '2013-11-22', 2);
INSERT INTO `#__statgeek_season` VALUES(3, '2013', 1, '2013-09-07', '2013-11-22', 4);
INSERT INTO `#__statgeek_season` VALUES(4, '2013', 1, '2013-09-07', '2013-11-22', 3);
INSERT INTO `#__statgeek_season` VALUES(5, '2013', 1, '2013-09-07', '2013-11-22', 5);

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_sport`
--
-- Creation: Jun 27, 2013 at 09:16 AM
-- Last update: Jun 27, 2013 at 09:24 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_sport` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `#__statgeek_sport`
--

INSERT INTO `#__statgeek_sport` VALUES(1, 'Soccer', 1);
INSERT INTO `#__statgeek_sport` VALUES(2, 'Football', 1);
INSERT INTO `#__statgeek_sport` VALUES(3, 'Baseball', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_stat`
--
-- Creation: Sep 09, 2013 at 05:05 AM
-- Last update: Sep 09, 2013 at 05:05 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_stat` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `ordering` int(11) NOT NULL,
  `sports` text NOT NULL,
  `type` int(11) NOT NULL default '1',
  `abbreviation` varchar(11) NOT NULL,
  `label` varchar(200) NOT NULL,
  `field_type` varchar(30) NOT NULL default '1',
  `field_data` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `#__statgeek_stat`
--

INSERT INTO `#__statgeek_stat` VALUES(1, 'goals', 0, ':1:', 1, 'G', 'Goals', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(2, 'assists', 0, ':1:', 1, 'A', 'Assists', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(3, 'minutes', 0, ':1:', 1, 'Min', 'Minutes', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(4, 'yellow_cards', 0, ':1:', 1, 'Yel', 'Yellow Cards', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(5, 'red_cards', 0, ':1:', 1, 'Red', 'Red Cards', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(6, 'shots', 0, ':1:', 1, 'Sh', 'Shots', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(7, 'saves', 0, ':1:', 1, 'S', 'Saves', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(8, 'shots_on_goal', 0, ':1:', 1, 'SOG', 'Shots on Goal', 'text', '');
INSERT INTO `#__statgeek_stat` VALUES(9, 'goals_against', 7, ':1:', 1, 'GA', 'Goals Agains', 'text', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_statgeek`
--
-- Creation: Jun 27, 2013 at 09:16 AM
-- Last update: Jun 27, 2013 at 09:16 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_statgeek` (
  `id` int(11) NOT NULL auto_increment,
  `config` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__statgeek_statgeek`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_stat_map`
--
-- Creation: Aug 15, 2013 at 05:20 AM
-- Last update: Aug 15, 2013 at 05:20 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_stat_map` (
  `id` int(11) NOT NULL auto_increment,
  `state` int(11) NOT NULL,
  `sport` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__statgeek_stat_map`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__statgeek_team`
--
-- Creation: Jun 27, 2013 at 09:16 AM
-- Last update: Sep 06, 2013 at 08:45 AM
--

CREATE TABLE IF NOT EXISTS `#__statgeek_team` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `state` varchar(256) NOT NULL,
  `published` varchar(256) NOT NULL,
  `league` int(11) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `#__statgeek_team`
--

INSERT INTO `#__statgeek_team` VALUES(1, 'PFC Menace', 'Pittsburgh', 'PA', '1', 1, '');
INSERT INTO `#__statgeek_team` VALUES(2, 'Washington FC Blasters', 'Washington', 'PA', '1', 1, '');
INSERT INTO `#__statgeek_team` VALUES(3, 'Philly FC Soul', 'Philadelphia ', 'PA', '1', 1, '');
INSERT INTO `#__statgeek_team` VALUES(4, 'PFC Blue Demons', 'Pittsburgh', 'PA', '1', 2, '');
INSERT INTO `#__statgeek_team` VALUES(5, 'PFC Red Birds', 'Pittsburgh', 'PA', '1', 3, '');
INSERT INTO `#__statgeek_team` VALUES(6, 'Erie FC Ramblers', 'Erie', 'PA', '1', 1, '');
