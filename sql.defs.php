<?php

function SQLDefs($ObjectName) {
  $SqlDB = '';
  switch ($ObjectName) {
    case 'AppIDs':
      $SqlDB = 'CREATE TABLE IF NOT EXISTS `' . MySQL_Pre . 'AppIDs` ('
              . '`AppSlNo` bigint(20) NOT NULL AUTO_INCREMENT,'
              . '`AppID` varchar(4) NOT NULL,'
              . '`LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,'
              . ' PRIMARY KEY (`AppSlNo`)'
              . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8;';
      break;
    case 'Applications':
      $SqlDB = 'CREATE TABLE IF NOT EXISTS `' . MySQL_Pre . 'Applications` ('
              . '`AppID` bigint(20) NOT NULL AUTO_INCREMENT,'
              . '`SessionID` varchar(32) NOT NULL,'
              . '`ResID` int(11) NOT NULL,'
              . '`AppEmail` varchar(50) NOT NULL,'
              . '`AppMobile` varchar(10) NOT NULL,'
              . '`AppName` varchar(50) NOT NULL,'
              . '`GuardianName` varchar(50) NOT NULL,'
              . '`DOB` date NOT NULL,'
              . '`Sex` varchar(1) NOT NULL,'
              . '`Nationality` varchar(10) NOT NULL,'
              . '`Religion` varchar(20) NOT NULL,'
              . '`PreAddr` varchar(100) NOT NULL,'
              . '`PrePinCode` varchar(6) NOT NULL,'
              . '`PermAddr1` varchar(100) NOT NULL,'
              . '`PermPinCode` varchar(6) NOT NULL,'
              . '`BelongsFrom` varchar(3) NOT NULL,'
              . '`PhyHand` tinyint(1) NOT NULL,'
              . '`Qualification` varchar(80) NOT NULL,'
              . '`ComKnowledge` tinyint(1) NOT NULL,'
              . '`OrdTyping` tinyint(1) NOT NULL,'
              . '`Shorthand` tinyint(1) NOT NULL,'
              . '`GovServent` tinyint(1) NOT NULL,'
              . '`AppOQ` tinyint(1) NOT NULL,'
              . '`FiledOn` timestamp NULL DEFAULT NULL,'
              . '`Status` varchar(100) DEFAULT NULL,'
              . '`LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,'
              . 'PRIMARY KEY (`AppID`)'
              . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8';
      break;
    case 'Categories':
      $SqlDB = 'CREATE TABLE IF NOT EXISTS `' . MySQL_Pre . 'Categories` ('
              . '`CatgID` int(10) unsigned NOT NULL AUTO_INCREMENT,'
              . '`Category` varchar(45) NOT NULL,'
              . 'PRIMARY KEY (`CatgID`)'
              . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8';
      break;
    case 'Helpline':
      $SqlDB = 'CREATE TABLE IF NOT EXISTS `' . MySQL_Pre . 'Helpline` ('
              . '`HelpID` bigint(20) NOT NULL AUTO_INCREMENT,'
              . '`IP` text NOT NULL,'
              . '`AppName` varchar(80) NOT NULL,'
              . '`AppEmail` varchar(50) NOT NULL,'
              . '`SessionID` varchar(32) NOT NULL,'
              . '`TxtQry` longtext NOT NULL,'
              . '`Replied` int(1) NOT NULL DEFAULT \'0\','
              . '`ReplyTxt` varchar(300) DEFAULT NULL,'
              . '`QryTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,'
              . '`ReplyTime` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\','
              . 'PRIMARY KEY (`HelpID`)'
              . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8;';
      break;
    case 'Photos':
      $SqlDB = 'CREATE TABLE IF NOT EXISTS `' . MySQL_Pre . 'Photos` ('
              . '`PhotoID` bigint(20) NOT NULL AUTO_INCREMENT,'
              . '`FileName` varchar(45) DEFAULT NULL,'
              . '`File` longblob,'
              . '`Size` int(11) DEFAULT NULL,'
              . '`mime` varchar(45) DEFAULT NULL,'
              . '`UploadedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,'
              . 'PRIMARY KEY (`PhotoID`)'
              . ') ENGINE=InnoDB DEFAULT CHARSET=utf8;';
      break;
    case 'Posts':
      $SqlDB = 'CREATE TABLE IF NOT EXISTS `' . MySQL_Pre . 'Posts` ('
              . '`PostID` int(10) unsigned NOT NULL AUTO_INCREMENT,'
              . '`PostName` varchar(45) NOT NULL,'
              . '`PostGroup` varchar(45) NOT NULL,'
              . '`PayScale` varchar(45) NOT NULL,'
              . '`GradePay` varchar(45) NOT NULL,'
              . 'PRIMARY KEY (`PostID`)'
              . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8;';
      break;
    case 'Reserved':
      $SqlDB = 'CREATE TABLE IF NOT EXISTS `' . MySQL_Pre . 'Reserved` ('
              . '`ResID` int(10) unsigned NOT NULL AUTO_INCREMENT,'
              . '`PostID` int(10) unsigned NOT NULL,'
              . '`CatgID` int(10) unsigned NOT NULL,'
              . '`Vacancies` int(10) unsigned NOT NULL,'
              . '`Fees` int(11) NOT NULL,'
              . 'PRIMARY KEY (`ResID`)'
              . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8;';
      break;
  }
  return $SqlDB;
}

?>