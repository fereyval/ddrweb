-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 27 Octobre 2014 à 00:26
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ddrweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE IF NOT EXISTS `billets` (
`id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `billets`
--

INSERT INTO `billets` (`id`, `titre`, `contenu`, `date_creation`) VALUES
(1, 'Salut les gens! Voici mon blog super non?', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2014-10-24 06:15:16'),
(2, 'Le PHP à la conquête du monde !', 'C''est officiel, l''éléPHPant a annoncé à la radio hier soir "J''ai l''intention de conquérir le monde !".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu''il n''en fallait pour dire "éléPHPant". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
`id` int(11) NOT NULL,
  `id_billet` int(11) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_billet`, `auteur`, `commentaire`, `date_commentaire`) VALUES
(1, 1, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53'),
(2, 1, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16'),
(3, 1, 'MultiKiller', '+1 !', '2010-03-25 17:12:52'),
(4, 2, 'John', 'Preum''s !', '2010-03-27 18:59:49'),
(5, 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu''on ne le pense !', '2010-03-27 22:02:13'),
(6, 1, 'firely', 'Yo tout le monde!', '2014-10-24 13:35:34');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
