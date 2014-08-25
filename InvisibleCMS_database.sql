-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              5.5.38-0ubuntu0.14.04.1 - (Ubuntu)
-- S.O. server:                  debian-linux-gnu
-- HeidiSQL Versione:            8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dump della struttura di tabella mycms.pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255),
  `body` longtext,
  `template` varchar(255),
  `inmenu` tinyint(1) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella mycms.pages: 4 rows
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `title`, `body`, `template`, `inmenu`, `slug`) VALUES
	(1, 'Home', 'Ciao carla questa è la home page!aaaaa!!', 'home', 1, 'home'),
	(2, 'Circa me', 'Ciao, sono figo sono bello sono fotomodello!!!', 'about', 1, 'circa-me'),
	(3, 'Provaprova', 'ciao', 'home', 1, 'provaprova'),
	(14, 'ciaoci', 'ciaociao', 'home', 1, 'ciaoci');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


-- Dump della struttura di tabella mycms.sections
DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dump dei dati della tabella mycms.sections: ~4 rows (circa)
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` (`id`, `page_id`, `title`, `body`) VALUES
	(2, 1, 'Sinistra', 'Dolor sit amet.'),
	(10, 1, 'Ciao', 'Mondo'),
	(11, 1, 'Lato', 'Sinistro'),
	(13, 3, 'Sinistra', 'Ciao mondo2');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
