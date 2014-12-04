# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: typo3.ecom.local (MySQL 5.5.40-0ubuntu0.14.04.1)
# Datenbank: dev.t3lts-6.2
# Erstellungsdauer: 2014-11-27 23:24:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle tx_t3locations_domain_model_territory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tx_t3locations_domain_model_territory`;

CREATE TABLE `tx_t3locations_domain_model_territory` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(11) unsigned NOT NULL DEFAULT '0',
  `crdate` int(11) unsigned NOT NULL DEFAULT '0',
  `cruser_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `t3ver_oid` int(11) NOT NULL DEFAULT '0',
  `t3ver_id` int(11) NOT NULL DEFAULT '0',
  `t3ver_wsid` int(11) NOT NULL DEFAULT '0',
  `t3ver_label` varchar(255) NOT NULL DEFAULT '',
  `t3ver_state` tinyint(4) NOT NULL DEFAULT '0',
  `t3ver_stage` int(11) NOT NULL DEFAULT '0',
  `t3ver_count` int(11) NOT NULL DEFAULT '0',
  `t3ver_tstamp` int(11) NOT NULL DEFAULT '0',
  `t3ver_move_id` int(11) NOT NULL DEFAULT '0',
  `sys_language_uid` int(11) NOT NULL DEFAULT '0',
  `l10n_parent` int(11) NOT NULL DEFAULT '0',
  `l10n_diffsource` mediumblob,
  PRIMARY KEY (`uid`),
  KEY `parent` (`pid`),
  KEY `t3ver_oid` (`t3ver_oid`,`t3ver_wsid`),
  KEY `language` (`l10n_parent`,`sys_language_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tx_t3locations_domain_model_territory` WRITE;
/*!40000 ALTER TABLE `tx_t3locations_domain_model_territory` DISABLE KEYS */;

INSERT INTO `tx_t3locations_domain_model_territory` (`uid`, `verified`, `title`)
VALUES
	(1,1,'Africa'),
	(2,1,'Oceania'),
	(3,1,'Americas'),
	(4,1,'Asia'),
	(5,1,'Europe'),
	(6,1,'Eastern Asia'),
	(7,1,'South-eastern Asia'),
	(8,1,'Central Asia'),
	(9,1,'Western Asia'),
	(10,1,'Southern Europe'),
	(11,1,'Eastern Europe'),
	(12,1,'Northern Europe'),
	(13,1,'Western Europe'),
	(14,1,'Middle East'),
	(15,1,'Southern Asia'),
	(16,1,'South America'),
	(17,1,'Central America'),
	(18,1,'Northern America'),
	(19,1,'Caribbean'),
	(20,1,'Western Africa'),
	(21,1,'Eastern Africa'),
	(22,1,'Northern Africa'),
	(23,1,'Middle Africa'),
	(24,1,'Southern Africa'),
	(25,1,'Australia and New Zealand'),
	(26,1,'Melanesia'),
	(27,1,'Micronesian Region'),
	(28,1,'Polynesia');

/*!40000 ALTER TABLE `tx_t3locations_domain_model_territory` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
