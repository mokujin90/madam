# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Database: baikal
# Generation Time: 2014-08-09 18:56:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table addressbooks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addressbooks`;

CREATE TABLE `addressbooks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `principaluri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uri` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `ctag` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `principaluri` (`principaluri`,`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `addressbooks` WRITE;
/*!40000 ALTER TABLE `addressbooks` DISABLE KEYS */;

INSERT INTO `addressbooks` (`id`, `principaluri`, `displayname`, `uri`, `description`, `ctag`)
VALUES
	(1,'principals/Ninja','Default Address Book','default','Default Address Book for NinjaDisplayName',1),
	(2,'principals/1','Default Address Book','default','Default Address Book for 1',1),
	(5,'principals/27','aa@aa.a2','default',NULL,1),
	(7,'principals/34','1@1.32','default',NULL,1),
	(8,'principals/35','1@1.2','default',NULL,1);

/*!40000 ALTER TABLE `addressbooks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table calendarobjects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `calendarobjects`;

CREATE TABLE `calendarobjects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calendardata` mediumblob,
  `uri` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `calendarid` int(10) unsigned NOT NULL,
  `lastmodified` int(11) unsigned DEFAULT NULL,
  `etag` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) unsigned NOT NULL,
  `componenttype` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstoccurence` int(11) unsigned DEFAULT NULL,
  `lastoccurence` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `calendarid` (`calendarid`,`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `calendarobjects` WRITE;
/*!40000 ALTER TABLE `calendarobjects` DISABLE KEYS */;

INSERT INTO `calendarobjects` (`id`, `calendardata`, `uri`, `calendarid`, `lastmodified`, `etag`, `size`, `componenttype`, `firstoccurence`, `lastoccurence`)
VALUES
	(1,X'424547494E3A5643414C454E4441520A2020202020202020202020202020202056455253494F4E3A322E300A2020202020202020202020202020202043414C5343414C453A475245474F5249414E0A20202020202020202020202020202020424547494E3A564556454E540A2020202020202020202020202020202044545354414D503A3230313430383037543230323031375A0A20202020202020202020202020202020445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039323030300A202020202020202020202020202020204454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039333030300A2020202020202020202020202020202053554D4D4152593A0A202020202020202020202020202020204445534352495054494F4E3A0A20202020202020202020202020202020434C4153533A5055424C49430A202020202020202020202020202020205549443A38372D63616C6461767465726D696E0A20202020202020202020202020202020454E443A564556454E540A20202020202020202020202020202020454E443A5643414C454E4441520A20202020202020202020202020202020','87-caldavtermin.ics',1,1407428417,'78c97b4d1e3d0fb548cf625cc41f1b45',457,'VEVENT',1407388800,1407389400),
	(2,X'424547494E3A5643414C454E4441520A2020202020202020202020202020202056455253494F4E3A322E300A2020202020202020202020202020202043414C5343414C453A475245474F5249414E0A20202020202020202020202020202020424547494E3A564556454E540A2020202020202020202020202020202044545354414D503A3230313430383037543230323233355A0A20202020202020202020202020202020445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039323030300A202020202020202020202020202020204454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039333030300A2020202020202020202020202020202053554D4D4152593A0A202020202020202020202020202020204445534352495054494F4E3A0A20202020202020202020202020202020434C4153533A5055424C49430A202020202020202020202020202020205549443A38382D63616C6461767465726D696E0A20202020202020202020202020202020454E443A564556454E540A20202020202020202020202020202020454E443A5643414C454E4441520A20202020202020202020202020202020','88-caldavtermin.ics',1,1407428555,'d73119b0980aa77d9de21d7ca593f53f',457,'VEVENT',1407388800,1407389400),
	(3,X'424547494E3A5643414C454E4441520A56455253494F4E3A322E300A0A2020202020202020202020202020202043414C5343414C453A475245474F5249414E0A20202020202020202020202020202020424547494E3A564556454E540A2020202020202020202020202020202044545354414D503A3230313430383037543230323534305A0A20202020202020202020202020202020445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039323030300A202020202020202020202020202020204454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039333030300A2020202020202020202020202020202053554D4D4152593A0A202020202020202020202020202020204445534352495054494F4E3A0A20202020202020202020202020202020434C4153533A5055424C49430A202020202020202020202020202020205549443A38392D63616C6461767465726D696E0A20202020202020202020202020202020454E443A564556454E540A20202020202020202020202020202020454E443A5643414C454E4441520A20202020202020202020202020202020','89-caldavtermin.ics',1,1407428740,'d436fcc1ea6b9caa3b3a07843ad69e5f',442,'VEVENT',1407388800,1407389400),
	(4,X'424547494E3A5643414C454E4441520A56455253494F4E3A322E300A43414C5343414C453A475245474F5249414E0A20202020202020202020202020202020424547494E3A564556454E540A2020202020202020202020202020202044545354414D503A3230313430383037543230323730375A0A20202020202020202020202020202020445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039333030300A202020202020202020202020202020204454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383037543039343030300A2020202020202020202020202020202053554D4D4152593A0A202020202020202020202020202020204445534352495054494F4E3A0A20202020202020202020202020202020434C4153533A5055424C49430A202020202020202020202020202020205549443A39302D63616C6461767465726D696E0A20202020202020202020202020202020454E443A564556454E540A20202020202020202020202020202020454E443A5643414C454E4441520A20202020202020202020202020202020','90-caldavtermin.ics',1,1407428827,'9b2ee1311144f908a7e283a71b6ec55f',425,'VEVENT',1407389400,1407390000),
	(5,X'424547494E3A5643414C454E4441520A56455253494F4E3A322E300A43414C5343414C453A475245474F5249414E0A424547494E3A564556454E540A44545354414D503A3230313430383037543230323935365A0A445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383037543131343030300A4454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383037543131353030300A53554D4D4152593A0A4445534352495054494F4E3A0A434C4153533A5055424C49430A5549443A39332D63616C6461767465726D696E0A454E443A564556454E540A454E443A5643414C454E444152','93-caldavtermin.ics',1,1407428996,'61cfac3bd4603973faf327f9175e8b98',248,'VEVENT',1407397200,1407397800),
	(6,X'424547494E3A5643414C454E4441520A56455253494F4E3A322E300A43414C5343414C453A475245474F5249414E0A424547494E3A564556454E540A44545354414D503A3230313430383037543232343434385A0A445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383037543038333030300A4454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383037543038343030300A53554D4D4152593AD0A4D0B8D180D0BCD0B03A204669726D3B20452D6D61696C3A206D61696C406D61696C2E6D793B20D098D0BCD18F323A205A79797A3B200A4445534352495054494F4E3A452D6D61696C3A206D61696C406D61696C2E6D793B200A434C4153533A5055424C49430A5549443A39342D63616C6461767465726D696E0A454E443A564556454E540A454E443A5643414C454E444152','94-caldavtermin.ics',1,1407437088,'a6e8c7e532f7b617b0713247a464b27a',325,'VEVENT',1407385800,1407386400),
	(7,X'424547494E3A5643414C454E4441520A56455253494F4E3A322E300A43414C5343414C453A475245474F5249414E0A424547494E3A564556454E540A44545354414D503A3230313430383037543232343734395A0A445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383037543132303030300A4454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383037543133303030300A53554D4D4152593AD0A4D0B8D180D0BCD0B03A204669726D3B20D098D0BCD18F323A206E616D653B200A4445534352495054494F4E3A452D6D61696C3A206D61696C406D2E6D3B20D098D0BCD18F3A2031323B200A434C4153533A5055424C49430A5549443A39352D63616C6461767465726D696E0A454E443A564556454E540A454E443A5643414C454E444152','95-caldavtermin.ics',1,1407437451,'cb88fcdc76206ee16606adc2139e2ec4',311,'VEVENT',1407398400,1407402000),
	(8,X'424547494E3A5643414C454E4441520A56455253494F4E3A322E300A43414C5343414C453A475245474F5249414E0A424547494E3A564556454E540A44545354414D503A3230313430383038543136303433375A0A445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383038543039303030300A4454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383038543039313030300A53554D4D4152593AD0A4D0B8D180D0BCD0B03A203132333132333B20D098D0BCD18F323A203133313233313B200A4445534352495054494F4E3A0A434C4153533A5055424C49430A5549443A39382D63616C6461767465726D696E0A454E443A564556454E540A454E443A5643414C454E444152','98-caldavtermin.ics',5,1407499477,'1e90d96c3bc648fd81e044c097e501c7',285,'VEVENT',1407474000,1407474600),
	(9,X'424547494E3A5643414C454E4441520A56455253494F4E3A322E300A43414C5343414C453A475245474F5249414E0A424547494E3A564556454E540A44545354414D503A3230313430383038543136303435345A0A445453544152543B545A49443D4575726F70652F4D6F73636F773A3230313430383038543130313030300A4454454E443B545A49443D4575726F70652F4D6F73636F773A3230313430383038543130323030300A53554D4D4152593AD0A4D0B8D180D0BCD0B03A2031313B20D098D0BCD18F323A203131313B200A4445534352495054494F4E3A0A434C4153533A5055424C49430A5549443A39392D63616C6461767465726D696E0A454E443A564556454E540A454E443A5643414C454E444152','99-caldavtermin.ics',5,1407499494,'60843bd8358a9ed998a3cb80e95dbfcb',278,'VEVENT',1407478200,1407478800);

/*!40000 ALTER TABLE `calendarobjects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table calendars
# ------------------------------------------------------------

DROP TABLE IF EXISTS `calendars`;

CREATE TABLE `calendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `principaluri` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uri` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ctag` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `calendarorder` int(10) unsigned NOT NULL DEFAULT '0',
  `calendarcolor` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` text COLLATE utf8_unicode_ci,
  `components` varchar(21) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transparent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `principaluri` (`principaluri`,`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `calendars` WRITE;
/*!40000 ALTER TABLE `calendars` DISABLE KEYS */;

INSERT INTO `calendars` (`id`, `principaluri`, `displayname`, `uri`, `ctag`, `description`, `calendarorder`, `calendarcolor`, `timezone`, `components`, `transparent`)
VALUES
	(1,'principals/Ninja','DisplayCalendarName','default',4,'DescritpionCalendar',0,'','','VEVENT,VTODO,VJOURNAL',0),
	(2,'principals/1','Default calendar','default',1,'Default calendar',0,'','','VEVENT,VTODO',0),
	(5,'principals/27','Termin Calendar','default',5,'Termin Calendar',0,NULL,NULL,'VEVENT',0),
	(7,'principals/34','Termin Calendar','default',1,'Termin Calendar',0,NULL,NULL,'VEVENT',0),
	(8,'principals/35','Termin Calendar','default',1,'Termin Calendar',0,NULL,NULL,'VEVENT',0);

/*!40000 ALTER TABLE `calendars` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cards`;

CREATE TABLE `cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `addressbookid` int(11) unsigned NOT NULL,
  `carddata` mediumblob,
  `uri` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastmodified` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table groupmembers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groupmembers`;

CREATE TABLE `groupmembers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `principal_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `principal_id` (`principal_id`,`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table principals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `principals`;

CREATE TABLE `principals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vcardurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uri` (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `principals` WRITE;
/*!40000 ALTER TABLE `principals` DISABLE KEYS */;

INSERT INTO `principals` (`id`, `uri`, `email`, `displayname`, `vcardurl`)
VALUES
	(1,'principals/Ninja','ninja@ninja.ninja','NinjaDisplayName',NULL),
	(2,'principals/1','a@a.a','1',NULL),
	(5,'principals/27','aa@aa.a2','aa@aa.a2',NULL),
	(7,'principals/34','1@1.32','1@1.32',NULL),
	(8,'principals/35','1@1.2','1@1.2',NULL);

/*!40000 ALTER TABLE `principals` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `digesta1` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `digesta1`)
VALUES
	(1,'Ninja','8390c4511c838f0e72948a086fb520c8'),
	(2,'1','0dbeee36ce164e870bd0b6449a9e5d86'),
	(5,'27','554e026218f6b0e9e7f49c8fc9768dbf'),
	(7,'34','dea590814ea1b59d8c6c7084b8724ff7'),
	(8,'35','610259cfa351dda4e564adf16c0ea1f8');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;