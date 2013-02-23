-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: 10.25.140.23:3306
-- Generation Time: Feb 23, 2013 at 03:05 PM
-- Server version: 5.1.52-log
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_AppIDs`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_AppIDs` (
  `AppSlNo` bigint(20) NOT NULL AUTO_INCREMENT,
  `AppID` varchar(4) NOT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AppSlNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15792 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Applications`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Applications` (
  `AppID` bigint(20) NOT NULL AUTO_INCREMENT,
  `SessionID` varchar(32) NOT NULL,
  `ResID` int(11) NOT NULL,
  `AppEmail` varchar(50) NOT NULL,
  `AppMobile` varchar(10) NOT NULL,
  `AppName` varchar(50) NOT NULL,
  `GuardianName` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Sex` varchar(1) NOT NULL,
  `Nationality` varchar(10) NOT NULL,
  `Religion` varchar(20) NOT NULL,
  `PreAddr` varchar(100) NOT NULL,
  `PrePinCode` varchar(6) NOT NULL,
  `PermAddr1` varchar(100) NOT NULL,
  `PermPinCode` varchar(6) NOT NULL,
  `BelongsFrom` varchar(3) NOT NULL,
  `PhyHand` tinyint(1) NOT NULL,
  `Qualification` varchar(80) NOT NULL,
  `ComKnowledge` tinyint(1) NOT NULL,
  `OrdTyping` tinyint(1) NOT NULL,
  `Shorthand` tinyint(1) NOT NULL,
  `GovServent` tinyint(1) NOT NULL,
  `AppOQ` tinyint(1) NOT NULL,
  `FiledOn` timestamp NULL DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AppID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Categories`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Categories` (
  `CatgID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Category` varchar(45) NOT NULL,
  PRIMARY KEY (`CatgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_FieldNames`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_FieldNames` (
  `FieldName` varchar(20) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`FieldName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Helpline`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Helpline` (
  `HelpID` bigint(20) NOT NULL AUTO_INCREMENT,
  `IP` text NOT NULL,
  `AppName` varchar(80) NOT NULL,
  `AppEmail` varchar(50) NOT NULL,
  `SessionID` varchar(32) NOT NULL,
  `TxtQry` longtext NOT NULL,
  `Replied` int(1) NOT NULL DEFAULT '0',
  `ReplyTxt` varchar(300) DEFAULT NULL,
  `QryTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ReplyTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`HelpID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Logs`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Logs` (
  `LogID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `SessionID` varchar(32) DEFAULT NULL,
  `IP` varchar(15) DEFAULT NULL,
  `Referrer` longtext,
  `UserAgent` longtext,
  `UserID` varchar(20) DEFAULT NULL,
  `URL` longtext,
  `Action` longtext,
  `Method` varchar(10) DEFAULT NULL,
  `URI` longtext,
  `AccessTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LogID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3663 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Photos`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Photos` (
  `PhotoID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(45) DEFAULT NULL,
  `File` longblob,
  `Size` int(11) DEFAULT NULL,
  `mime` varchar(45) DEFAULT NULL,
  `UploadedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PhotoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Posts`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Posts` (
  `PostID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PostName` varchar(45) NOT NULL,
  `PostGroup` varchar(45) NOT NULL,
  `PayScale` varchar(45) NOT NULL,
  `GradePay` varchar(45) NOT NULL,
  PRIMARY KEY (`PostID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Reserved`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Reserved` (
  `ResID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PostID` int(10) unsigned NOT NULL,
  `CatgID` int(10) unsigned NOT NULL,
  `Vacancies` int(10) unsigned NOT NULL,
  `Fees` int(11) NOT NULL,
  PRIMARY KEY (`ResID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Users`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Users` (
  `UserID` varchar(255) DEFAULT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `UserPass` varchar(255) DEFAULT NULL,
  `PartMapID` int(10) NOT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `LoginCount` int(10) DEFAULT '0',
  `LastLoginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PartMapID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eRecruitment_Visits`
--

CREATE TABLE IF NOT EXISTS `eRecruitment_Visits` (
  `PageID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `PageURL` text NOT NULL,
  `VisitCount` bigint(20) NOT NULL DEFAULT '1',
  `LastVisit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PageTitle` text,
  `VisitorIP` text NOT NULL,
  PRIMARY KEY (`PageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
