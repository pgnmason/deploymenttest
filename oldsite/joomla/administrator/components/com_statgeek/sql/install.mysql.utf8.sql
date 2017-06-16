CREATE TABLE IF NOT EXISTS `#__statgeek_statgeek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `league` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `startdate` DATE NOT NULL,
  `enddate` DATE NOT NULL,
  `league` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hometeam` int(11) NOT NULL DEFAULT '0',
  `awayteam` int(11) NOT NULL DEFAULT '0',
  `homescore` int(11) NOT NULL DEFAULT '0',
  `awayscore` int(11) NOT NULL DEFAULT '0',
  `date` DATETIME NOT NULL,
  `season` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS #__statgeek_games_summary (
  `id` int(11) NOT NULL auto_increment,
  `game` int(11) NOT NULL,
  `summary` TEXT NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `sports` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS #__statgeek_map (
  `id` int(11) NOT NULL auto_increment,
  `stat` int(11) NOT NULL,
  `sport` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `abbreviation` varchar(256) NOT NULL,
  `sports` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_position_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `sport` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `state` varchar(256) NOT NULL,
  `published` varchar(256) NOT NULL,
  `league` int(11) NOT NULL,
  `details` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `team` int(11) NOT NULL,
  `bio` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS #__statgeek_players_profile (
  `id` int(11) NOT NULL auto_increment,
  `player` int(11) NOT NULL,
  `details` TEXT NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_coache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `team` int(11) NOT NULL,
  `bio` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS #__statgeek_coaches_profile (
  `id` int(11) NOT NULL auto_increment,
  `coach` int(11) NOT NULL,
  `details` TEXT NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_attribute_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;