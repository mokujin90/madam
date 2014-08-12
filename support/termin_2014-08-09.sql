# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Database: termin
# Generation Time: 2014-08-09 18:57:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Admin`;

CREATE TABLE `Admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;

INSERT INTO `Admin` (`id`, `login`, `password`)
VALUES
	(1,'admin','123');

/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Answer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Answer`;

CREATE TABLE `Answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `text` varchar(255) NOT NULL DEFAULT '',
  `hint` text,
  `abbr` varchar(50) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `min` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `Question` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Answer` WRITE;
/*!40000 ALTER TABLE `Answer` DISABLE KEYS */;

INSERT INTO `Answer` (`id`, `question_id`, `text`, `hint`, `abbr`, `icon`, `min`)
VALUES
	(6,9,'Наличными','','','icon-cloud-upload',0),
	(7,9,'Кредитная карта','','','icon-cloud-upload',0),
	(8,9,'Нет','','','icon-cloud-upload',0),
	(9,10,'5','','','icon-cloud-upload',0),
	(10,10,'12','','','icon-cloud-upload',0),
	(11,10,'414','','','icon-cloud-upload',0),
	(13,2,'123','','','icon-cloud-upload',0),
	(24,2,'Ответ 45','','','icon-cloud-upload',0),
	(25,2,'Ответ Б','','','icon-cloud-upload',0);

/*!40000 ALTER TABLE `Answer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Company
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Company`;

CREATE TABLE `Company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text,
  `zip` tinytext,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile_phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `country_id` int(3) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `booking_deadline` int(11) NOT NULL DEFAULT '1',
  `booking_interval` int(11) NOT NULL DEFAULT '1',
  `enable_mail_notice` tinyint(4) NOT NULL DEFAULT '0',
  `mail_notice_address` varchar(255) DEFAULT NULL,
  `enable_sms_notice` tinyint(4) NOT NULL DEFAULT '0',
  `sms_notice_phone` varchar(20) DEFAULT NULL,
  `hello_text` text,
  `select_timetable` tinyint(4) NOT NULL DEFAULT '0',
  `is_block` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `CountryRelation` (`country_id`),
  CONSTRAINT `CountryRelation` FOREIGN KEY (`country_id`) REFERENCES `Country` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Company` WRITE;
/*!40000 ALTER TABLE `Company` DISABLE KEYS */;

INSERT INTO `Company` (`id`, `name`, `address`, `description`, `zip`, `city`, `phone`, `mobile_phone`, `fax`, `email`, `site`, `country_id`, `url`, `booking_deadline`, `booking_interval`, `enable_mail_notice`, `mail_notice_address`, `enable_sms_notice`, `sms_notice_phone`, `hello_text`, `select_timetable`, `is_block`)
VALUES
	(1,'ООО Император','ул. Победы, 12','123','355019','Москва','123232131','12321312312','23123123123','email@email.ru','www.domain.de',1,'13',5,3,0,'321',1,'123','6',0,0),
	(2,'123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1,1,0,NULL,0,NULL,NULL,0,0),
	(3,'','','','','','',NULL,'','',NULL,1,'',1,1,0,NULL,0,NULL,NULL,0,0),
	(4,'','','','','','',NULL,'','',NULL,1,'1',1,1,0,NULL,0,NULL,NULL,0,0),
	(5,'1','4','2','5','3','6','','7','2@2.2','1',1,'9',1,1,0,NULL,0,NULL,NULL,0,0),
	(6,'1','4','2','5','3','6',NULL,'7','8',NULL,1,'9',1,1,0,NULL,0,NULL,NULL,0,0),
	(7,'1','4','2','5','3','6',NULL,'7','8','9',1,NULL,1,1,0,NULL,0,NULL,NULL,0,0),
	(8,'','','','','','',NULL,'','','',1,NULL,1,1,0,NULL,0,NULL,NULL,0,0),
	(9,'','','','','','',NULL,'','','',1,NULL,1,1,0,NULL,0,NULL,NULL,0,0);

/*!40000 ALTER TABLE `Company` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Company2License
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Company2License`;

CREATE TABLE `Company2License` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `license_id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `is_agree` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `employee_upgrade` int(11) NOT NULL DEFAULT '0',
  `sms_upgrade` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `license_id` (`license_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `company2license_ibfk_1` FOREIGN KEY (`license_id`) REFERENCES `License` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `company2license_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `Company` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Company2License` WRITE;
/*!40000 ALTER TABLE `Company2License` DISABLE KEYS */;

INSERT INTO `Company2License` (`id`, `license_id`, `company_id`, `is_agree`, `date`, `employee_upgrade`, `sms_upgrade`)
VALUES
	(1,1,1,1,'2014-07-29 21:11:52',0,0),
	(2,4,1,1,'2014-08-03 01:13:47',0,0),
	(3,1,1,1,'2014-08-03 01:14:13',100,0),
	(4,1,1,1,'2014-08-03 01:14:33',100,0),
	(5,1,1,1,'2014-08-03 01:14:37',100,0),
	(6,2,1,1,'2014-08-03 01:32:34',0,0),
	(7,1,1,0,'2014-08-03 01:33:16',0,0),
	(8,1,1,1,'2014-08-03 01:33:41',1,0),
	(9,3,1,0,'2014-08-03 01:33:58',0,0),
	(10,3,1,0,'2014-08-03 01:35:16',1,0),
	(11,3,1,0,'2014-08-03 01:35:18',2,0),
	(12,3,1,0,'2014-08-03 01:35:39',3,0),
	(13,3,1,0,'2014-08-03 01:35:42',4,0),
	(14,3,1,0,'2014-08-03 01:36:49',4,100),
	(15,3,1,0,'2014-08-03 01:36:52',4,200),
	(16,3,1,1,'2014-08-03 01:37:02',4,200),
	(17,2,1,1,'2014-08-05 13:43:40',0,0),
	(18,2,1,0,'2014-08-05 13:44:45',1,0),
	(19,2,1,0,'2014-08-05 13:44:48',2,0),
	(20,2,1,0,'2014-08-05 13:44:50',3,0),
	(21,2,1,0,'2014-08-05 13:44:52',4,0),
	(22,2,1,0,'2014-08-05 13:44:54',5,0),
	(23,5,1,0,'2014-08-05 13:45:14',0,0),
	(24,1,1,0,'2014-08-05 13:45:25',0,0),
	(25,2,1,0,'2014-08-05 15:13:10',0,0),
	(26,6,1,0,'2014-08-05 15:59:40',0,0),
	(27,1,1,0,'2014-08-05 16:00:01',0,0),
	(28,2,1,0,'2014-08-05 16:06:12',0,0),
	(29,1,2,1,'2014-08-05 16:06:12',0,0),
	(30,3,2,0,'2014-08-05 17:31:21',0,0),
	(31,3,2,1,'2014-08-05 17:31:55',1,0),
	(32,3,2,0,'2014-08-05 17:31:58',2,0),
	(33,7,2,0,'2014-08-05 17:32:19',0,0),
	(34,1,1,1,'2014-08-05 17:50:28',0,0),
	(35,1,1,1,'2014-08-05 17:50:30',0,0),
	(36,1,2,1,'2014-08-05 17:50:31',0,0),
	(37,1,1,1,'2014-08-05 17:50:33',0,0),
	(38,1,1,1,'2014-08-05 17:50:34',0,0),
	(39,1,2,1,'2014-08-05 17:50:34',0,0),
	(40,1,1,1,'2014-08-05 17:50:35',0,0),
	(41,1,1,1,'2014-08-05 17:50:42',0,0),
	(42,1,2,1,'2014-08-05 17:50:43',0,0),
	(43,1,2,1,'2014-08-05 17:50:47',0,0),
	(44,1,1,1,'2014-08-05 17:58:55',0,0),
	(45,1,1,1,'2014-08-05 18:16:50',0,0),
	(46,1,1,1,'2014-08-05 18:17:00',0,0),
	(47,1,1,1,'2014-08-05 18:17:02',0,0),
	(48,1,2,1,'2014-08-05 18:17:02',0,0),
	(49,1,2,1,'2014-08-05 18:17:02',0,0),
	(50,1,2,1,'2014-08-05 18:17:03',0,0),
	(51,1,1,1,'2014-08-05 18:17:08',0,0),
	(52,1,2,1,'2014-08-05 18:17:08',0,0),
	(53,1,1,1,'2014-08-06 11:02:28',0,0),
	(54,2,1,0,'2014-08-07 20:18:43',0,0),
	(55,1,3,1,'2014-08-08 17:20:53',0,0),
	(56,1,4,1,'2014-08-08 17:20:58',0,0),
	(57,1,5,1,'2014-08-08 17:21:42',0,0),
	(58,1,5,1,'2014-08-08 17:21:53',0,0),
	(59,1,5,1,'2014-08-08 17:21:57',0,0),
	(60,1,6,1,'2014-08-08 17:25:02',0,0),
	(61,1,7,1,'2014-08-08 17:26:11',0,0),
	(62,1,1,1,'2014-08-09 18:37:35',0,0),
	(63,1,1,1,'2014-08-09 18:37:49',0,0),
	(64,1,8,1,'2014-08-09 20:56:22',0,0),
	(65,2,1,0,'2014-08-09 21:58:23',0,0),
	(66,1,9,1,'2014-08-09 22:52:26',0,0);

/*!40000 ALTER TABLE `Company2License` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table CompanyField
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CompanyField`;

CREATE TABLE `CompanyField` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` enum('required','enabled','disabled') DEFAULT NULL,
  `validator` enum('numerical','char','mail') NOT NULL DEFAULT 'char',
  `position` int(11) DEFAULT NULL,
  `is_userfield` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `companyfield_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Company` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `CompanyField` WRITE;
/*!40000 ALTER TABLE `CompanyField` DISABLE KEYS */;

INSERT INTO `CompanyField` (`id`, `company_id`, `name`, `type`, `validator`, `position`, `is_userfield`)
VALUES
	(8,1,'Фирма','required','char',0,0),
	(9,1,'Язык программирования','enabled','char',2,0),
	(21,1,'Имя','enabled','numerical',3,1),
	(24,1,'E-mail','enabled','mail',1,0),
	(31,1,'Имя2','required','char',4,1),
	(36,1,'2','enabled','char',5,1),
	(37,1,'123','enabled','char',6,1),
	(38,1,'32','disabled','char',7,1);

/*!40000 ALTER TABLE `CompanyField` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Country`;

CREATE TABLE `Country` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Country` WRITE;
/*!40000 ALTER TABLE `Country` DISABLE KEYS */;

INSERT INTO `Country` (`id`, `name`)
VALUES
	(1,'Россия');

/*!40000 ALTER TABLE `Country` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table License
# ------------------------------------------------------------

DROP TABLE IF EXISTS `License`;

CREATE TABLE `License` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` int(11) unsigned NOT NULL DEFAULT '3',
  `control_dialog` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `group_event` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `email_confirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sms_confirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `email_reminder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sms_reminder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `multilanguage` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `event_confirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `email_event` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sms_event` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `caldav` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `email_help` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `phone_help` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `employee` int(11) unsigned NOT NULL DEFAULT '1',
  `max_employee` int(11) unsigned NOT NULL DEFAULT '1',
  `event` int(11) unsigned NOT NULL DEFAULT '30',
  `sms` int(11) unsigned NOT NULL DEFAULT '0',
  `max_sms` int(11) unsigned NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL DEFAULT '0',
  `base_lvl` tinyint(3) unsigned DEFAULT NULL,
  `is_system` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `request_text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `License` WRITE;
/*!40000 ALTER TABLE `License` DISABLE KEYS */;

INSERT INTO `License` (`id`, `question`, `control_dialog`, `group_event`, `email_confirm`, `sms_confirm`, `email_reminder`, `sms_reminder`, `multilanguage`, `event_confirm`, `email_event`, `sms_event`, `caldav`, `email_help`, `phone_help`, `employee`, `max_employee`, `event`, `sms`, `max_sms`, `price`, `base_lvl`, `is_system`, `request_text`)
VALUES
	(1,4,1,0,0,0,0,0,0,0,0,0,0,1,0,2,5,10,0,1,0,1,1,'Базовая лицензия'),
	(2,6,1,1,0,0,0,0,0,0,0,0,0,1,0,5,10,60,50,1,0,2,1,'Продвинутая лицензия'),
	(3,9,0,1,0,0,0,0,0,0,0,0,0,1,0,10,30,90,100,300,0,3,1,'Максимальная лицензия'),
	(4,18,0,0,0,0,0,0,0,0,0,0,0,1,0,1,1,30,0,1,0,NULL,0,''),
	(5,3,0,0,0,0,0,0,0,0,0,0,0,1,0,1,1,30,0,1,0,NULL,0,''),
	(6,3,0,0,0,0,0,0,0,0,0,0,0,1,0,1,1,10,0,1,0,NULL,0,''),
	(7,3,0,0,0,0,0,0,0,0,0,0,0,1,0,1,1,30,0,1,0,NULL,0,'');

/*!40000 ALTER TABLE `License` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Question
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Question`;

CREATE TABLE `Question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NOT NULL DEFAULT '',
  `hint` text,
  `position` int(11) DEFAULT NULL,
  `type` enum('radio','check','text') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Company` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Question` WRITE;
/*!40000 ALTER TABLE `Question` DISABLE KEYS */;

INSERT INTO `Question` (`id`, `company_id`, `text`, `hint`, `position`, `type`)
VALUES
	(2,1,'Выберите любимый ответ:','Или 2 ответа:',NULL,'check'),
	(9,1,'Выберите способ оплаты:','',NULL,'radio'),
	(10,1,'2 + 2 ?','',NULL,'radio'),
	(13,1,'31231','312312',NULL,'radio');

/*!40000 ALTER TABLE `Question` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Request
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Request`;

CREATE TABLE `Request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `is_allday` int(3) NOT NULL DEFAULT '0',
  `baikal_event_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Request` WRITE;
/*!40000 ALTER TABLE `Request` DISABLE KEYS */;

INSERT INTO `Request` (`id`, `user_id`, `create_date`, `start_time`, `end_time`, `is_allday`, `baikal_event_id`)
VALUES
	(46,19,'2014-08-02 17:04:28','2014-07-29 09:20:00','2014-07-29 09:30:00',0,NULL),
	(47,19,'2014-08-02 17:05:21','2014-07-30 08:30:00','2014-07-30 08:40:00',0,NULL),
	(48,19,'2014-08-02 17:58:08','2014-07-30 08:40:00','2014-07-30 08:50:00',0,NULL),
	(49,19,'2014-08-02 17:58:34','2014-07-30 11:00:00','2014-07-30 14:10:00',0,NULL),
	(50,19,'2014-08-02 18:31:36','2014-07-30 09:30:00','2014-07-30 09:40:00',0,NULL),
	(51,19,'2014-08-02 19:40:55','2014-07-30 09:40:00','2014-07-30 09:50:00',0,NULL),
	(52,19,'2014-08-02 19:40:55','2014-07-30 09:40:00','2014-07-30 09:50:00',0,NULL),
	(53,19,'2014-08-02 22:25:11','2014-07-30 09:30:00','2014-07-30 09:40:00',0,NULL),
	(54,19,'2014-08-02 22:28:43','2014-07-30 10:20:00','2014-07-30 10:30:00',0,NULL),
	(55,19,'2014-08-02 22:35:14','2014-07-30 10:20:00','2014-07-30 10:30:00',0,NULL),
	(58,19,'2014-08-02 22:57:03','2014-08-02 01:10:00','2014-08-02 01:20:00',0,NULL),
	(61,17,'2014-08-05 15:52:55','2014-08-02 03:00:00','2014-08-02 03:10:00',0,NULL),
	(65,17,'2014-08-05 15:58:36','2014-08-02 00:40:00','2014-08-02 00:50:00',0,NULL),
	(66,17,'2014-08-05 15:58:43','2014-08-02 00:50:00','2014-08-02 01:00:00',0,NULL),
	(72,17,'2014-08-05 15:59:19','2014-08-02 00:50:00','2014-08-02 01:00:00',0,NULL),
	(73,17,'2014-08-05 16:01:32','2014-08-02 00:30:00','2014-08-02 00:40:00',0,NULL),
	(75,17,'2014-08-05 16:05:24','2014-08-02 00:10:00','2014-08-02 00:20:00',0,NULL),
	(76,17,'2014-08-05 16:05:29','2014-08-02 00:20:00','2014-08-02 00:30:00',0,NULL),
	(77,17,'2014-08-05 16:05:43','2014-08-02 01:00:00','2014-08-02 01:10:00',0,NULL),
	(78,17,'2014-08-05 16:05:49','2014-08-02 01:10:00','2014-08-02 01:20:00',0,NULL),
	(80,17,'2014-08-06 11:21:46','2014-08-09 01:40:00','2014-08-09 01:50:00',0,NULL),
	(82,21,'2014-08-06 12:47:29','2014-08-14 08:20:00','2014-08-14 08:30:00',0,NULL),
	(83,21,'2014-08-06 12:48:15','2014-08-06 09:20:00','2014-08-06 09:30:00',0,NULL),
	(84,21,'2014-08-06 12:48:28','2014-08-06 09:50:00','2014-08-06 10:00:00',0,NULL),
	(87,19,'2014-08-07 20:20:17','2014-08-07 09:20:00','2014-08-07 09:30:00',0,NULL),
	(90,19,'2014-08-07 20:27:07','2014-08-07 09:30:00','2014-08-07 09:40:00',0,NULL),
	(91,19,'2014-08-07 20:28:59','2014-08-07 09:30:00','2014-08-07 09:40:00',0,NULL),
	(92,19,'2014-08-07 20:29:18','2014-08-07 09:50:00','2014-08-07 10:00:00',0,NULL),
	(93,19,'2014-08-07 20:29:56','2014-08-07 11:40:00','2014-08-07 11:50:00',0,NULL),
	(94,19,'2014-08-07 22:44:48','2014-08-07 08:30:00','2014-08-07 08:40:00',0,6),
	(95,19,'2014-08-07 22:47:49','2014-08-07 12:00:00','2014-08-07 13:00:00',0,7),
	(96,21,'2014-08-08 16:03:56','2014-08-08 09:10:00','2014-08-08 09:20:00',0,NULL),
	(97,28,'2014-08-08 16:04:14','2014-08-08 10:10:00','2014-08-08 10:20:00',0,NULL),
	(98,27,'2014-08-08 16:04:37','2014-08-08 09:00:00','2014-08-08 09:10:00',0,8),
	(99,27,'2014-08-08 16:04:54','2014-08-08 10:10:00','2014-08-08 10:20:00',0,9),
	(102,29,'2014-08-08 16:57:02','2014-08-08 11:20:00','2014-08-08 11:30:00',0,12),
	(103,29,'2014-08-08 16:57:06','2014-08-08 12:10:00','2014-08-08 12:20:00',0,13);

/*!40000 ALTER TABLE `Request` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table RequestField
# ------------------------------------------------------------

DROP TABLE IF EXISTS `RequestField`;

CREATE TABLE `RequestField` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) unsigned NOT NULL,
  `field_id` int(11) unsigned NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `request_id` (`request_id`),
  CONSTRAINT `requestfield_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `CompanyField` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `requestfield_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `Request` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `RequestField` WRITE;
/*!40000 ALTER TABLE `RequestField` DISABLE KEYS */;

INSERT INTO `RequestField` (`id`, `request_id`, `field_id`, `value`)
VALUES
	(122,46,8,'123'),
	(123,46,31,'123'),
	(126,48,8,'123'),
	(127,48,21,'312'),
	(128,48,31,'31231'),
	(129,49,8,'212'),
	(130,49,24,'2121@2313.123'),
	(131,49,9,'121'),
	(132,49,21,'21'),
	(133,49,31,'212'),
	(134,49,36,'212'),
	(135,49,37,'2121'),
	(142,50,8,'1'),
	(143,50,9,'12'),
	(144,50,21,'2'),
	(145,50,31,'Имя2'),
	(146,50,36,'2'),
	(147,50,37,'123'),
	(148,51,8,'1'),
	(149,51,9,'12'),
	(150,51,21,'2'),
	(151,51,31,'Имя2'),
	(152,51,36,'2'),
	(153,51,37,'123'),
	(154,47,8,'2232'),
	(155,47,31,'222'),
	(156,53,8,'TT'),
	(157,53,9,'12'),
	(158,53,21,'2'),
	(159,53,31,'Имя2'),
	(160,53,36,'2'),
	(161,53,37,'123'),
	(162,54,8,'1'),
	(163,54,31,'1'),
	(164,55,8,'1'),
	(165,55,31,'1'),
	(175,58,8,'1'),
	(176,58,31,'1'),
	(181,61,8,'2'),
	(182,61,31,'2'),
	(193,65,8,'1'),
	(194,65,31,'1'),
	(195,66,8,'1'),
	(196,66,31,'2'),
	(207,72,8,'2323'),
	(208,72,31,'323'),
	(213,73,8,'33'),
	(214,73,31,'23'),
	(219,76,8,'332'),
	(220,76,31,'22'),
	(221,77,8,'22'),
	(222,77,31,'22'),
	(225,78,8,'22'),
	(226,78,31,'22'),
	(235,75,8,'222'),
	(236,75,31,'2'),
	(237,80,8,'123'),
	(238,80,31,'311'),
	(241,82,8,'1'),
	(242,82,31,'1111'),
	(247,83,8,'2'),
	(248,83,31,'2'),
	(249,84,8,'222'),
	(250,84,9,'31231'),
	(251,84,21,'312312'),
	(252,84,31,'222'),
	(253,84,36,'31231'),
	(254,84,37,'312312'),
	(259,90,8,'2'),
	(260,90,31,'22'),
	(261,93,8,'Firm'),
	(262,93,24,'mail@m.mu'),
	(263,93,31,'Name'),
	(271,95,8,'Firm'),
	(272,95,24,'mail@m.m'),
	(273,95,21,'12'),
	(274,95,31,'name'),
	(275,96,8,'12313'),
	(276,96,31,'31313'),
	(277,97,8,'31231'),
	(278,97,31,'12312'),
	(279,98,8,'123123'),
	(280,98,31,'131231'),
	(281,99,8,'11'),
	(282,99,31,'111'),
	(287,102,8,'1'),
	(288,102,31,'1'),
	(289,103,8,'2'),
	(290,103,31,'2'),
	(291,94,8,'Firm'),
	(292,94,24,'mail@mail.my'),
	(293,94,31,'Zyyz');

/*!40000 ALTER TABLE `RequestField` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table RequestQuestion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `RequestQuestion`;

CREATE TABLE `RequestQuestion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) unsigned NOT NULL,
  `question_id` int(11) unsigned NOT NULL,
  `answer_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`),
  CONSTRAINT `requestquestion_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `Request` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `requestquestion_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `Question` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `requestquestion_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `Answer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `RequestQuestion` WRITE;
/*!40000 ALTER TABLE `RequestQuestion` DISABLE KEYS */;

INSERT INTO `RequestQuestion` (`id`, `request_id`, `question_id`, `answer_id`)
VALUES
	(124,46,9,6),
	(125,46,10,9),
	(128,48,9,6),
	(129,48,10,9),
	(130,49,9,6),
	(131,49,10,9),
	(144,50,2,13),
	(145,50,2,24),
	(146,50,2,25),
	(147,50,9,8),
	(148,50,10,11),
	(149,51,2,13),
	(150,51,2,24),
	(151,51,2,25),
	(152,51,9,8),
	(153,51,10,11),
	(154,47,9,6),
	(155,47,10,9),
	(156,53,2,13),
	(157,53,2,24),
	(158,53,2,25),
	(159,53,9,8),
	(160,53,10,11),
	(161,54,9,6),
	(162,54,10,9),
	(163,55,9,6),
	(164,55,10,9),
	(170,58,9,6),
	(171,58,10,9),
	(176,61,9,6),
	(177,61,10,9),
	(188,65,9,6),
	(189,65,10,9),
	(190,66,9,6),
	(191,66,10,9),
	(202,72,9,6),
	(203,72,10,9),
	(208,73,9,6),
	(209,73,10,9),
	(214,76,9,6),
	(215,76,10,9),
	(216,77,9,6),
	(217,77,10,9),
	(220,78,9,6),
	(221,78,10,9),
	(230,75,9,6),
	(231,75,10,9),
	(232,80,9,6),
	(233,80,10,9),
	(236,82,9,6),
	(237,82,10,9),
	(243,83,9,6),
	(244,83,10,9),
	(245,84,2,24),
	(246,84,9,6),
	(247,84,10,9),
	(252,90,9,6),
	(253,90,10,9),
	(254,93,9,6),
	(255,93,10,9),
	(260,95,9,6),
	(261,95,10,9),
	(262,96,9,6),
	(263,96,10,9),
	(264,97,9,6),
	(265,97,10,9),
	(266,98,9,6),
	(267,98,10,9),
	(268,99,9,6),
	(269,99,10,9),
	(274,102,9,6),
	(275,102,10,9),
	(276,103,9,6),
	(277,103,10,9),
	(278,94,9,6),
	(279,94,10,9);

/*!40000 ALTER TABLE `RequestQuestion` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Schedule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Schedule`;

CREATE TABLE `Schedule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `day` tinyint(3) unsigned NOT NULL,
  `start_hour` tinyint(3) unsigned NOT NULL,
  `start_min` tinyint(3) unsigned NOT NULL,
  `end_hour` tinyint(3) unsigned NOT NULL,
  `end_min` tinyint(3) unsigned NOT NULL,
  `enable` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Schedule` WRITE;
/*!40000 ALTER TABLE `Schedule` DISABLE KEYS */;

INSERT INTO `Schedule` (`id`, `user_id`, `day`, `start_hour`, `start_min`, `end_hour`, `end_min`, `enable`)
VALUES
	(13,1,0,2,0,16,0,0),
	(257,19,0,8,0,17,0,1),
	(258,19,0,18,0,20,0,1),
	(259,19,1,8,0,12,5,1),
	(260,19,1,14,20,14,25,0),
	(261,19,1,16,0,19,40,1),
	(262,19,2,8,0,17,0,1),
	(263,19,3,8,0,17,0,1),
	(264,19,4,8,0,17,0,1),
	(265,19,5,0,0,3,0,1),
	(266,19,6,0,0,5,0,0),
	(273,21,0,8,0,17,0,1),
	(274,21,1,8,0,17,0,1),
	(275,21,2,8,0,17,0,1),
	(276,21,3,8,0,17,0,1),
	(277,21,4,8,0,17,0,1),
	(294,17,0,0,0,4,0,0),
	(295,17,0,4,0,10,0,1),
	(296,17,0,10,0,19,0,0),
	(297,17,1,0,0,23,55,1),
	(298,17,5,0,0,4,0,1),
	(299,17,6,0,0,0,10,0),
	(310,28,0,8,0,17,0,1),
	(311,28,1,8,0,17,0,1),
	(312,28,2,8,0,17,0,1),
	(313,28,3,8,0,17,0,1),
	(314,28,4,8,0,17,0,1),
	(320,34,0,8,0,17,0,1),
	(321,34,1,8,0,17,0,1),
	(322,34,2,8,0,17,0,1),
	(323,34,3,8,0,17,0,1),
	(324,34,4,8,0,17,0,1),
	(325,35,0,8,0,17,0,1),
	(326,35,0,18,0,20,0,0),
	(327,35,1,8,0,17,0,1),
	(328,35,2,8,0,17,0,1),
	(329,35,3,8,0,17,0,1),
	(330,35,4,8,0,17,0,1);

/*!40000 ALTER TABLE `Schedule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_migration`;

CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_migration` WRITE;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;

INSERT INTO `tbl_migration` (`version`, `apply_time`)
VALUES
	('m000000_000000_base',1406097142),
	('m140723_062938_alter_question_table',1406097146),
	('m140723_082042_alter_user_table',1406106082),
	('m140725_074644_change_companyField',1406299266),
	('m140725_161444_change_company',1406318589),
	('m140725_224155_alter_company_table',1406328268),
	('m140727_140411_change_request',1406631458);

/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table User
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `login` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `is_owner` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `calendar_delimit` int(11) NOT NULL DEFAULT '10',
  `calendar_front_delimit` int(11) NOT NULL DEFAULT '-1',
  `caldav` varchar(255) DEFAULT NULL,
  `group_size` int(11) unsigned NOT NULL DEFAULT '1',
  `baikal_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Company` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`id`, `company_id`, `login`, `password`, `is_owner`, `name`, `lastname`, `description`, `calendar_delimit`, `calendar_front_delimit`, `caldav`, `group_size`, `baikal_user_id`)
VALUES
	(1,1,'1@1.1','1',1,'123','321','312312',20,60,'312321',1,NULL),
	(17,1,'w@21.4','2',0,'','','',10,-1,'',2,NULL),
	(19,1,'213@1231.123','2312',0,'','','',10,-1,'',2,NULL),
	(21,1,'213@1231.1232','22',0,'','','',10,-1,'',1,NULL),
	(24,2,'123@123.1','1',1,NULL,NULL,NULL,10,-1,NULL,1,NULL),
	(28,1,'18@18.18','12',0,'','','',10,-1,'',1,NULL),
	(30,4,'mokujin@mail.ru','pass',1,NULL,NULL,NULL,10,-1,NULL,1,NULL),
	(31,5,'1@1.11','1',1,NULL,NULL,NULL,10,-1,NULL,1,NULL),
	(32,6,'12@1.12','1',1,NULL,NULL,NULL,10,-1,NULL,1,NULL),
	(33,7,'1@2.2','1',1,NULL,NULL,NULL,10,-1,NULL,1,NULL),
	(34,7,'1@1.32','1',0,'','','',10,-1,NULL,1,NULL),
	(35,7,'1@1.2','1',0,'','','',10,-1,NULL,1,NULL),
	(36,8,'123@123.123','123',1,NULL,NULL,NULL,10,-1,NULL,1,NULL);

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table User2Answer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User2Answer`;

CREATE TABLE `User2Answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `answer_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `answer_id` (`answer_id`),
  CONSTRAINT `user2answer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `user2answer_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `Answer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
