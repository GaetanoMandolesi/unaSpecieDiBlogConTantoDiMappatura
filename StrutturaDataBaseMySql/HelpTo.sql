-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Ott 02, 2020 alle 17:31
-- Versione del server: 5.6.33-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_realizzare`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `HelpTo`
--

CREATE TABLE IF NOT EXISTS `HelpTo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(25) NOT NULL,
  `luogo` varchar(150) NOT NULL,
  `descrizione` text NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `longitudine` varchar(10) DEFAULT NULL,
  `latitudine` varchar(10) DEFAULT NULL,
  `e_mail` varchar(50) DEFAULT NULL,
  `settore_interesse` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=919 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
