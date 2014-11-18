-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 18 2014 г., 11:42
-- Версия сервера: 5.6.15-log
-- Версия PHP: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `guest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `commbranch`
--

CREATE TABLE IF NOT EXISTS `commbranch` (
  `comm_branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `comm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  PRIMARY KEY (`comm_branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `commbranch`
--

INSERT INTO `commbranch` (`comm_branch_id`, `comm_id`, `user_id`, `ts`, `comment`) VALUES
(1, 61, 29, '2014-11-15 13:43:17', 'lalalal'),
(2, 61, 29, '2014-11-15 13:43:42', 'lalalal'),
(3, 61, 29, '2014-11-15 12:44:37', 'kkkk'),
(4, 54, 30, '2014-11-16 14:10:52', 'sfa'),
(8, 35, -1, '2014-11-17 09:16:33', 'sas'),
(6, 62, -1, '2014-11-17 09:29:00', 'sfa');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  PRIMARY KEY (`comm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comm_id`, `user_id`, `ts`, `comment`) VALUES
(35, -1, '2014-11-03 11:58:09', 'Anonim from Guest'),
(30, 30, '2014-11-03 11:44:18', 'comment'),
(36, -1, '2014-11-03 11:58:48', 'Anonim from anonim'),
(54, 29, '2014-11-04 14:17:35', 'comm from guest');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` char(12) NOT NULL,
  `password` text NOT NULL,
  `admin` int(1) DEFAULT NULL,
  `blocked` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `admin`, `blocked`) VALUES
(29, 'guest', '084e0343a0486ff05530df6c705c8bb4', 0, NULL),
(30, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, NULL),
(31, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 0, 1);
--
-- База данных: `php`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook_url` varchar(100) DEFAULT NULL,
  `twitter_handle` varchar(20) DEFAULT NULL,
  `bio` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--
-- База данных: `publications`
--

-- --------------------------------------------------------

--
-- Структура таблицы `classics`
--

CREATE TABLE IF NOT EXISTS `classics` (
  `author` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `category` varchar(16) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `isbn` char(13) NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `author` (`author`(20)),
  KEY `title` (`title`(20))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `classics`
--

INSERT INTO `classics` (`author`, `title`, `category`, `year`, `isbn`) VALUES
('Mark', 'Adventures', 'fiction', 1876, '9990009990009');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `name` varchar(128) DEFAULT NULL,
  `isbn` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`isbn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`name`, `isbn`) VALUES
('Bob', '9990009990009');

-- --------------------------------------------------------

--
-- Структура таблицы `urls`
--

CREATE TABLE IF NOT EXISTS `urls` (
  `id` int(11) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
