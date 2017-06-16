CREATE TABLE IF NOT EXISTS `#__statgeek_statgeek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `published` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `league` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `startdate` DATE NOT NULL,
  `enddate` DATE NOT NULL,
  `league` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hometeam` int(11) NOT NULL DEFAULT '0',
  `awayteam` int(11) NOT NULL DEFAULT '0',
  `homescore` int(11) NOT NULL DEFAULT '0',
  `awayscore` int(11) NOT NULL DEFAULT '0',
  `date` DATE NOT NULL,
  `season` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `sports` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `abbreviation` varchar(256) NOT NULL,
  `sports` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `state` varchar(256) NOT NULL,
  `published` varchar(256) NOT NULL,
  `details` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `team` varchar(256) NOT NULL,
  `bio` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_coache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `team` varchar(256) NOT NULL,
  `bio` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__statgeek_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `sport` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;