SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `AWARDS` (
  `AwardID` int(11) NOT NULL,
  `AwardDescription` varchar(50) NOT NULL,
  `AwardYear` smallint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `AWARDS` (`AwardID`, `AwardDescription`, `AwardYear`) VALUES
(1, 'Best developer', 2018),
(2, 'Nobel Peace Prize', 2020);

CREATE TABLE `EDUCATIONS` (
  `EducationID` smallint(6) NOT NULL,
  `SchoolName` varchar(100) NOT NULL,
  `Department` varchar(100) DEFAULT NULL,
  `GraduatedYear` smallint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `EDUCATIONS` (`EducationID`, `SchoolName`, `Department`, `GraduatedYear`) VALUES
(1, 'Example University', 'Computer Engineer (Bachelor)', 2018),
(2, 'Example University', 'Computer Engineer (Master degree)', 0);


CREATE TABLE `EXPERIENCES` (
  `ExperiencesID` smallint(6) NOT NULL,
  `CompanyName` varchar(150) NOT NULL,
  `CompanyDescription` varchar(300) NOT NULL,
  `StartMonth` tinyint(4) NOT NULL,
  `StartYear` smallint(6) NOT NULL,
  `EndMonth` tinyint(4) DEFAULT NULL,
  `EndYear` smallint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `EXPERIENCES` (`ExperiencesID`, `CompanyName`, `CompanyDescription`, `StartMonth`, `StartYear`, `EndMonth`, `EndYear`) VALUES
(1, 'Example Company', 'Example Position', 1, 2015, 2, 2018),
(2, 'Example Company', 'Example Position', 4, 2017, 0, 0);


CREATE TABLE `GENERAL_INFORMATION` (
  `HeaderText` varchar(30) NOT NULL DEFAULT 'I am LEGEND',
  `NameSurname` varchar(100) NOT NULL DEFAULT 'Name Surname',
  `ShortText` varchar(100) NOT NULL DEFAULT 'Software Developer',
  `BirthDate` varchar(40) NOT NULL DEFAULT '12 July 1987',
  `Address` varchar(100) NOT NULL DEFAULT 'Paris, France',
  `EMail` varchar(100) NOT NULL DEFAULT 'example@examle.com',
  `Phone` varchar(30) NOT NULL DEFAULT '+1 222 222 22 22',
  `AboutMe` varchar(5000) NOT NULL,
  `GoogleMap` varchar(1000) DEFAULT NULL,
  `Facebook` varchar(50) DEFAULT NULL,
  `Instagram` varchar(50) DEFAULT NULL,
  `Twitter` varchar(50) DEFAULT NULL,
  `Skype` varchar(50) DEFAULT NULL,
  `SkypeConnectionType` varchar(10) DEFAULT NULL,
  `Tumblr` varchar(50) DEFAULT NULL,
  `Youtube` varchar(50) DEFAULT NULL,
  `Linkedin` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `GENERAL_INFORMATION` (`HeaderText`, `NameSurname`, `ShortText`, `BirthDate`, `Address`, `EMail`, `Phone`, `AboutMe`, `GoogleMap`, `Facebook`, `Instagram`, `Twitter`, `Skype`, `SkypeConnectionType`, `Tumblr`, `Youtube`, `Linkedin`) VALUES
('Hello Word!', 'Name Surname', 'Software Developer', '12 July 1987', 'New York', 'example@example.com', '+1 222 222 222 222', '<b>About me</b><div><b><br></b></div><div><b><br></b></div>', '22.053693,35.891553', 'facebook', 'instagram', 'twitter', 'skype', 'chat', 'tumblr', 'Youtube', 'linkedin');


CREATE TABLE `INBOX` (
  `MessageID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `EMail` varchar(100) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Message` text NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `IP` varchar(15) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `INBOX` (`MessageID`, `Name`, `EMail`, `Phone`, `Message`, `Status`, `IP`, `Date`) VALUES
(1, 'JOHN SILVER', 'john.silver@example.com', '+1 2293333333', 'Hello', 0, '111.112.314.156', '2020-05-11 15:23:22');


CREATE TABLE `MY_BLOG` (
  `BlogID` int(11) NOT NULL,
  `BlogTitle` varchar(120) NOT NULL,
  `BlogShortDescription` varchar(1000) NOT NULL,
  `BlogLongDescription` text DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 1,
  `Date` datetime NOT NULL,
  `Hint` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `MY_BLOG` (`BlogID`, `BlogTitle`, `BlogShortDescription`, `BlogLongDescription`, `Active`, `Date`, `Hint`) VALUES
(1, 'What is PHP?', 'Brief information about PHP.&nbsp;In the rest of the detailed post<b>﻿</b><br>', '<b>PHP</b> (stands for: Hypertext Preprocessor, previously Personal Home Page) is a programming language with a large user area and audience. HTML is embedded in the format and was created for server-side communications.<br><b>PHP</b>; collecting form data, managing files on the server, organizing databases, etc. It can perform various server-side functions such as. The main reason for calling the scripting language is that there is no need for any compilation process. You can write code with PHP and run it directly.<br><b>PHP</b> codes are written between <b>\"&lt;? Php\" and \"?&gt;\" </b>Tags.<br><b>PHP</b>; It can run independently from Windows, Linux or other programs. Instead of rewriting every page in <b>HTML</b>, you can create the structure sections with a single PHP file and print it out on each page without writing it again, managing and dynamic web pages. This is the most important feature that distinguishes it from other scripting languages.<br><br>It was inspired by <b><i>PERL and C</i></b> languages.<br>', 1, '2020-05-17 00:03:46', 0);


CREATE TABLE `MY_REFERENCES` (
  `ReferenceID` smallint(6) NOT NULL,
  `ReferenceName` varchar(100) NOT NULL,
  `URL` varchar(100) DEFAULT NULL,
  `Date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `MY_REFERENCES` (`ReferenceID`, `ReferenceName`, `URL`, `Date`) VALUES
(1, 'Codecanyon', 'https://codecanyon.net', '2020-05-17 20:08:35'),
(2, 'NaNi Home', '', '2020-05-17 20:09:10');


CREATE TABLE `PROJECTS` (
  `ProjectID` smallint(6) NOT NULL,
  `CategoryID` smallint(6) NOT NULL,
  `ProjectName` varchar(30) NOT NULL,
  `ShortDescription` varchar(50) NOT NULL,
  `LongDescription` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `PROJECTS` (`ProjectID`, `CategoryID`, `ProjectName`, `ShortDescription`, `LongDescription`) VALUES
(1, 1, 'Example.com', 'Example.com', '<p>Example Project<br></p>'),
(2, 2, 'Demo Project', 'Example Mobile App', '<p><h3><b><i>Example Mobile App</i></b><br></h3><p></p><p><a target=\"_blank\" rel=\"nofollow\" href=\"https://api.tufine.com.tr/apps/ios/1.5.0.ipa\"><img alt=\"\" src=\"https://www.tufine.com.tr/themes/leo_otis/img/modules/appagebuilder/images/apple-store-icon.png\" title=\"Image: https://www.tufine.com.tr/themes/leo_otis/img/modules/appagebuilder/images/apple-store-icon.png\"></a>&nbsp;<a target=\"_blank\" rel=\"nofollow\" href=\"https://play.google.com/store/apps/details?id=nani.home\"><img alt=\"\" src=\"https://www.tufine.com.tr/themes/leo_otis/img/modules/appagebuilder/images/google-play-icon.png\" title=\"Image: https://www.tufine.com.tr/themes/leo_otis/img/modules/appagebuilder/images/google-play-icon.png\"></a></p><br></p>');


CREATE TABLE `PROJECT_CATEGORIES` (
  `CategoryID` smallint(6) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `PROJECT_CATEGORIES` (`CategoryID`, `CategoryName`) VALUES
(2, 'Mobile'),
(1, 'Web');


CREATE TABLE `SITE_LOGS` (
  `ID` int(11) NOT NULL,
  `RefererURL` varchar(333) NOT NULL,
  `UserIP` varchar(50) NOT NULL,
  `CountryCode` varchar(10) NOT NULL,
  `RequestURL` varchar(200) NOT NULL,
  `Date` datetime NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `SITE_SETTINGS` (
  `UserName` varchar(32) NOT NULL,
  `UserPassword` varchar(32) NOT NULL,
  `SiteTitle` varchar(80) NOT NULL,
  `MetaKeys` varchar(3000) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Theme` varchar(5) NOT NULL DEFAULT 'light',
  `Hex` varchar(6) NOT NULL DEFAULT '07cb79',
  `Css` varchar(12) NOT NULL DEFAULT 'green',
  `AboutMe` tinyint(4) NOT NULL DEFAULT 1,
  `Experiences` tinyint(4) NOT NULL DEFAULT 1,
  `Skills` tinyint(4) NOT NULL DEFAULT 1,
  `Projects` tinyint(4) NOT NULL DEFAULT 1,
  `Educations` tinyint(4) NOT NULL DEFAULT 1,
  `Message` tinyint(4) NOT NULL DEFAULT 1,
  `References` tinyint(4) NOT NULL DEFAULT 1,
  `Blog` tinyint(1) NOT NULL DEFAULT 1,
  `Awards` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `SITE_SETTINGS` (`UserName`, `UserPassword`, `SiteTitle`, `MetaKeys`, `Description`, `Theme`, `Hex`, `Css`, `AboutMe`, `Experiences`, `Skills`, `Projects`, `Educations`, `Message`, `References`, `Blog`, `Awards`) VALUES
('demo', 'demo', 'Professional CV Site', 'Professional, CV, Site', 'Description', 'light', '56c8d2', 'turquoise', 1, 1, 1, 1, 1, 1, 1, 1, 1);


CREATE TABLE `SKILL` (
  `SkillID` smallint(6) NOT NULL,
  `SkillDescription` varchar(100) NOT NULL,
  `Percent` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `SKILL` (`SkillID`, `SkillDescription`, `Percent`) VALUES
(13, 'PHP', 97),
(14, 'Angular Cli', 95),
(15, 'HTML5', 95),
(16, 'SCSS', 95),
(17, 'JAVA', 52),
(18, 'Kotlin', 40),
(19, 'React Native', 60),
(20, 'İonic', 70),
(21, 'NativeScript', 65),
(22, 'Flutter', 40);


CREATE TABLE `SQL_QUERY_ERROR` (
  `id` int(11) NOT NULL,
  `Query` text DEFAULT NULL,
  `Page` text DEFAULT NULL,
  `Error` text DEFAULT NULL,
  `ErrorNo` text DEFAULT NULL,
  `IP` varchar(15) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `AWARDS`
  ADD PRIMARY KEY (`AwardID`);

ALTER TABLE `EDUCATIONS`
  ADD PRIMARY KEY (`EducationID`);

ALTER TABLE `EXPERIENCES`
  ADD PRIMARY KEY (`ExperiencesID`);

ALTER TABLE `GENERAL_INFORMATION`
  ADD PRIMARY KEY (`HeaderText`),
  ADD UNIQUE KEY `HeaderText` (`HeaderText`);

ALTER TABLE `INBOX`
  ADD PRIMARY KEY (`MessageID`);

ALTER TABLE `MY_BLOG`
  ADD PRIMARY KEY (`BlogID`);

ALTER TABLE `MY_REFERENCES`
  ADD PRIMARY KEY (`ReferenceID`);

ALTER TABLE `PROJECTS`
  ADD PRIMARY KEY (`ProjectID`);

ALTER TABLE `PROJECT_CATEGORIES`
  ADD PRIMARY KEY (`CategoryID`);

ALTER TABLE `SITE_LOGS`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `SITE_SETTINGS`
  ADD UNIQUE KEY `UserName` (`UserName`);

ALTER TABLE `SKILL`
  ADD PRIMARY KEY (`SkillID`);

ALTER TABLE `SQL_QUERY_ERROR`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `AWARDS`
  MODIFY `AwardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `EDUCATIONS`
  MODIFY `EducationID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `EXPERIENCES`
  MODIFY `ExperiencesID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `INBOX`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `MY_BLOG`
  MODIFY `BlogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

ALTER TABLE `MY_REFERENCES`
  MODIFY `ReferenceID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `PROJECTS`
  MODIFY `ProjectID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `PROJECT_CATEGORIES`
  MODIFY `CategoryID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `SITE_LOGS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

ALTER TABLE `SKILL`
  MODIFY `SkillID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `SQL_QUERY_ERROR`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;
