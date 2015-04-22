-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 22. Apr 2015 um 14:30
-- Server Version: 5.5.38-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `affilicon_quiz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `option`
--

CREATE TABLE IF NOT EXISTS `option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`option_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `option`
--

INSERT INTO `option` (`option_id`, `question_id`, `type`, `date_input`) VALUES
(3, 1, 1, '0000-00-00 00:00:00'),
(4, 2, 1, '2015-04-22 12:13:43');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `option_mc`
--

CREATE TABLE IF NOT EXISTS `option_mc` (
  `option_mc_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  PRIMARY KEY (`option_mc_id`),
  KEY `option_id` (`option_id`),
  KEY `option_id_2` (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `option_mc`
--

INSERT INTO `option_mc` (`option_mc_id`, `option_id`, `text`) VALUES
(1, 3, 'MC #1'),
(2, 3, 'MC #2'),
(3, 4, 'Lorem ipsum dolor sit amet #1?'),
(4, 4, 'Lorem ipsum dolor sit amet #2?'),
(5, 4, 'Lorem ipsum dolor sit amet #3?'),
(6, 4, 'Lorem ipsum dolor sit amet #5?');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `option_type`
--

CREATE TABLE IF NOT EXISTS `option_type` (
  `type` tinyint(4) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `option_type`
--

INSERT INTO `option_type` (`type`, `type_name`, `date_input`) VALUES
(1, 'MultipleChoice', '2015-04-22 08:44:16');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`question_id`, `question`, `date_input`) VALUES
(1, 'Wie gefällt Ihnen das TZT?', '2015-04-21 11:06:02'),
(2, 'Ein super geile Frage #2?', '2015-04-21 11:53:26'),
(3, 'fjhsakldjfhlkajshdf', '2015-04-22 18:39:46');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question2group`
--

CREATE TABLE IF NOT EXISTS `question2group` (
  `question2group_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `question_group_id` int(11) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question2group_id`),
  UNIQUE KEY `question_id` (`question_id`,`question_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `question2group`
--

INSERT INTO `question2group` (`question2group_id`, `question_id`, `question_group_id`, `date_input`) VALUES
(8, 3, 2, '2015-04-22 11:53:07'),
(10, 1, 2, '2015-04-22 11:53:16'),
(11, 2, 5, '2015-04-22 12:00:59'),
(12, 1, 3, '2015-04-22 12:01:17'),
(13, 3, 3, '2015-04-22 12:01:19'),
(14, 1, 7, '2015-04-22 12:05:49'),
(15, 2, 7, '2015-04-22 12:05:51'),
(17, 3, 5, '2015-04-22 12:20:05'),
(19, 2, 2, '2015-04-22 12:21:04');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_group`
--

CREATE TABLE IF NOT EXISTS `question_group` (
  `question_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_group_fake_id` varchar(8) NOT NULL,
  `name` varchar(150) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `question_group`
--

INSERT INTO `question_group` (`question_group_id`, `question_group_fake_id`, `name`, `date_input`) VALUES
(2, 'd3svYeje', 'Gruppe #11', '2015-04-21 11:36:32'),
(3, 'aAsudoGW', 'Gruppe #112', '2015-04-22 18:57:42'),
(4, 'P7VWeGVu', 'Gruppe #1123', '2015-04-22 18:57:47'),
(5, 'PjIUo0cL', 'Gruppe #1333666', '2015-04-22 18:58:35'),
(6, 'u4TrzBS3', 'asdfasdf2', '2015-04-22 19:00:31'),
(7, 'nBIQ4JJi', 'Stefans Gruppe', '2015-04-22 20:05:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
