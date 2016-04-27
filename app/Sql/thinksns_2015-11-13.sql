# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.25)
# Database: thinksns
# Generation Time: 2015-11-13 09:31:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ts_event_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ts_event_type`;

CREATE TABLE `ts_event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ts_event_type` WRITE;
/*!40000 ALTER TABLE `ts_event_type` DISABLE KEYS */;

INSERT INTO `ts_event_type` (`id`, `name`)
VALUES
	(1,'音乐/演出'),
	(2,'展览'),
	(3,'电影'),
	(4,'讲座/沙龙'),
	(5,'戏剧/曲艺'),
	(8,'体育'),
	(9,'旅行'),
	(10,'公益'),
	(11,'其它');

/*!40000 ALTER TABLE `ts_event_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ts_event_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ts_event_user`;

CREATE TABLE `ts_event_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `contact` text,
  `action` char(10) NOT NULL DEFAULT 'attention',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ts_event_user` WRITE;
/*!40000 ALTER TABLE `ts_event_user` DISABLE KEYS */;

INSERT INTO `ts_event_user` (`id`, `eventId`, `uid`, `contact`, `action`, `status`, `cTime`)
VALUES
	(1,1,1,'张小姐，13466658978','admin',1,1322719451);

/*!40000 ALTER TABLE `ts_event_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
