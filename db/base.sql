# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.40-log)
# Database: nolimits
# Generation Time: 2016-06-17 06:37:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activation_codes
# ------------------------------------------------------------

CREATE TABLE `activation_codes` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  `code` char(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `expires` (`expires`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `activation_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table audit_logs
# ------------------------------------------------------------

CREATE TABLE `audit_logs` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `record_type` varchar(255) NOT NULL,
  `record_id` mediumint(8) NOT NULL,
  `action` varchar(255) NOT NULL,
  `before` text,
  `after` text,
  `created` int(10) NOT NULL,
  `ip_address` int(10) NOT NULL,
  `reason` text,
  `via` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `via` (`via`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table banned_reasons
# ------------------------------------------------------------

CREATE TABLE `banned_reasons` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table banned_reasons_users
# ------------------------------------------------------------

CREATE TABLE `banned_reasons_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `banned_reason_id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `banned_reason_id` (`banned_reason_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table faqs
# ------------------------------------------------------------

CREATE TABLE `faqs` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `order` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table file_favourites
# ------------------------------------------------------------

CREATE TABLE `file_favourites` (
  `file_id` mediumint(8) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  KEY `file_id` (`file_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `file_favourites_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `file_favourites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table file_logs
# ------------------------------------------------------------

CREATE TABLE `file_logs` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `file_id` mediumint(8) unsigned NOT NULL,
  `date_added` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `file_id` (`file_id`),
  KEY `date_added` (`date_added`),
  CONSTRAINT `fk_file` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table file_ratings
# ------------------------------------------------------------

CREATE TABLE `file_ratings` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `file_id` mediumint(8) unsigned NOT NULL,
  `technical` decimal(4,2) NOT NULL,
  `originality` decimal(4,2) NOT NULL,
  `adrenaline` decimal(4,2) NOT NULL,
  `comment` mediumtext NOT NULL,
  `date_added` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `file_ratings_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `file_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table files
# ------------------------------------------------------------

CREATE TABLE `files` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL,
  `name` varchar(245) NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `style_id` mediumint(8) unsigned NOT NULL,
  `date_added` int(10) unsigned NOT NULL,
  `last_edited` int(10) unsigned DEFAULT NULL,
  `description` longtext NOT NULL,
  `screenshot_ext` char(4) NOT NULL,
  `coaster_ext` varchar(8) NOT NULL,
  `downloads` mediumint(8) unsigned DEFAULT '0',
  `rating` decimal(4,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `enabled` (`status`),
  KEY `author_id` (`author_id`),
  KEY `style_id` (`style_id`),
  KEY `rating` (`rating`),
  KEY `recent_coaster_index` (`status`,`date_added`),
  KEY `rated_coaster_index` (`status`,`rating`),
  CONSTRAINT `fk_style1` FOREIGN KEY (`style_id`) REFERENCES `nolimits_coaster_styles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table forgotten_password_tokens
# ------------------------------------------------------------

CREATE TABLE `forgotten_password_tokens` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(60) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `created` (`created`),
  KEY `expires` (`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table migration_versions
# ------------------------------------------------------------

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table minion_migrations
# ------------------------------------------------------------

CREATE TABLE `minion_migrations` (
  `timestamp` varchar(14) NOT NULL,
  `description` varchar(100) NOT NULL,
  `group` varchar(100) NOT NULL,
  PRIMARY KEY (`timestamp`,`group`),
  UNIQUE KEY `MIGRATION_ID` (`timestamp`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table news
# ------------------------------------------------------------

CREATE TABLE `news` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned DEFAULT NULL,
  `category_id` mediumint(8) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` mediumtext NOT NULL,
  `date_added` int(10) unsigned NOT NULL,
  `last_edited` int(10) unsigned NOT NULL,
  `url` varchar(45) NOT NULL,
  `hits` mediumint(8) unsigned NOT NULL,
  `unique_hits` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `author_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `news_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table news_categories
# ------------------------------------------------------------

CREATE TABLE `news_categories` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  `lft` mediumint(8) unsigned NOT NULL,
  `rgt` mediumint(8) unsigned NOT NULL,
  `lvl` mediumint(8) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `scope` mediumint(8) unsigned NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`lvl`),
  KEY `url` (`url`),
  KEY `enabled` (`enabled`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table news_comments
# ------------------------------------------------------------

CREATE TABLE `news_comments` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `author_id` mediumint(8) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `date_added` int(10) unsigned NOT NULL,
  `lft` mediumint(8) NOT NULL,
  `rgt` mediumint(8) NOT NULL,
  `lvl` mediumint(8) NOT NULL,
  `news_id` mediumint(8) NOT NULL,
  `content` longtext NOT NULL,
  `last_edited` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enabled` (`enabled`),
  KEY `author_id` (`author_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table news_contents
# ------------------------------------------------------------

CREATE TABLE `news_contents` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` mediumint(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` mediumint(8) unsigned NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  CONSTRAINT `news_contents_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table nolimits_coaster_styles
# ------------------------------------------------------------

CREATE TABLE `nolimits_coaster_styles` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nolimits_id` mediumint(8) unsigned NOT NULL,
  `short` varchar(50) NOT NULL,
  `version` mediumint(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `short` (`short`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table permissions
# ------------------------------------------------------------

CREATE TABLE `permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `resource_id` mediumint(8) unsigned DEFAULT NULL,
  `permission` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table ratings_votes
# ------------------------------------------------------------

CREATE TABLE `ratings_votes` (
  `rating_id` mediumint(8) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `state` tinyint(4) NOT NULL,
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `rating_id` (`rating_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ratings_votes_ibfk_1` FOREIGN KEY (`rating_id`) REFERENCES `file_ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ratings_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table resources
# ------------------------------------------------------------

CREATE TABLE `resources` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table roles
# ------------------------------------------------------------

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parent` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table roles_users
# ------------------------------------------------------------

CREATE TABLE `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sessions
# ------------------------------------------------------------

CREATE TABLE `sessions` (
  `session_id` varchar(127) NOT NULL,
  `last_active` int(10) DEFAULT NULL,
  `contents` mediumtext,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table user_tokens
# ------------------------------------------------------------

CREATE TABLE `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` char(40) NOT NULL,
  `token` char(40) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(60) DEFAULT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `ip_address` int(10) unsigned NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '-10',
  `registration_ip_address` int(10) unsigned NOT NULL,
  `registration_date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`),
  KEY `ip_address` (`ip_address`),
  KEY `score` (`score`),
  KEY `registration_ip_address` (`registration_ip_address`),
  KEY `registration_date` (`registration_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table verification_token_types
# ------------------------------------------------------------

CREATE TABLE `verification_token_types` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table verification_tokens
# ------------------------------------------------------------

CREATE TABLE `verification_tokens` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(60) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `type_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `created` (`created`),
  KEY `expires` (`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
