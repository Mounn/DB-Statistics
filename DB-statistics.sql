-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versie:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Structuur van  tabel db-statistics.apis wordt geschreven
CREATE TABLE IF NOT EXISTS `apis` (
  `GameId` int(11) NOT NULL,
  `APIkey` varchar(255) NOT NULL,
  `Active` bit(1) NOT NULL,
  `ExpirationDate` datetime DEFAULT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `LastUpdatedAt` datetime DEFAULT NULL,
  `LastUpdatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`GameId`,`APIkey`),
  KEY `CreatedBy_FK` (`CreatedBy`),
  KEY `LastUpdatedBy_FK` (`LastUpdatedBy`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.donations wordt geschreven
CREATE TABLE IF NOT EXISTS `donations` (
  `DonationId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Amount` decimal(9,2) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`DonationId`),
  KEY `User_FK` (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.games wordt geschreven
CREATE TABLE IF NOT EXISTS `games` (
  `GameId` int(11) NOT NULL AUTO_INCREMENT,
  `GameName` varchar(125) DEFAULT NULL,
  `GameDesc` varchar(255) DEFAULT NULL,
  `Active` bit(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `LastUpdatedOn` datetime DEFAULT NULL,
  `LastUpdatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`GameId`),
  KEY `LastUpdated_FK` (`LastUpdatedBy`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.gamestatistics wordt geschreven
CREATE TABLE IF NOT EXISTS `gamestatistics` (
  `ignId` int(11) NOT NULL,
  `MatchId` int(11) NOT NULL,
  `LastUpdatedBy` int(11) DEFAULT NULL,
  `LastUpdatedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`ignId`,`MatchId`),
  KEY `Match_FK` (`MatchId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.igns wordt geschreven
CREATE TABLE IF NOT EXISTS `igns` (
  `ignId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `IGN` varchar(255) DEFAULT NULL,
  `GameId` int(11) NOT NULL,
  `Active` bit(1) NOT NULL,
  PRIMARY KEY (`ignId`),
  KEY `UserId1_FK` (`UserId`),
  KEY `GameId_FK` (`GameId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.matches wordt geschreven
CREATE TABLE IF NOT EXISTS `matches` (
  `MatchId` int(11) NOT NULL AUTO_INCREMENT,
  `MatchDate` datetime NOT NULL,
  `MatchOutcome` varchar(255) DEFAULT NULL,
  `MatchDuration` time DEFAULT NULL,
  `MatchMap` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MatchId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.matchstats wordt geschreven
CREATE TABLE IF NOT EXISTS `matchstats` (
  `MatchId` int(11) NOT NULL,
  `IGN` varchar(255) NOT NULL,
  `Kills` int(11) NOT NULL,
  `Deaths` int(11) NOT NULL,
  `Assists` int(11) NOT NULL,
  `Score` decimal(20,5) DEFAULT NULL,
  `Side` varchar(100) DEFAULT NULL,
  `Specials` varchar(255) DEFAULT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MatchId`,`IGN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.subscriptions wordt geschreven
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `SubId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `SubDate` datetime NOT NULL,
  `SubEndDate` datetime NOT NULL,
  `SubTypeId` int(11) NOT NULL,
  PRIMARY KEY (`SubId`),
  KEY `SubTypeId_FK` (`SubTypeId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.subscriptiontypes wordt geschreven
CREATE TABLE IF NOT EXISTS `subscriptiontypes` (
  `SubTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `SubName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Price` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`SubTypeId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel db-statistics.users wordt geschreven
CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) DEFAULT NULL,
  `UserMail` varchar(255) DEFAULT NULL,
  `UserRights` int(11) NOT NULL,
  `MasterToken` varchar(100) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `LastLoginDate` datetime DEFAULT NULL,
  `LastLoginIP` datetime DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
