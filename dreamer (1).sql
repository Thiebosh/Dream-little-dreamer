-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 09 oct. 2018 à 14:01
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dreamer`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(28) NOT NULL,
  `prenom` varchar(28) NOT NULL,
  `ad_livraison` varchar(255) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `genre` tinyint(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `ad_livraison`, `tel`, `email`, `genre`, `password`) VALUES
(1, 'DUPRE', 'Eric', '3 rue des prairies 90900 Prairie', '09 09 09 09 09', 'dupre.eric@monemail.com', 0, 'pasteque'),
(2, 'LEFOU', 'Luc', '11 rue de la folie 11111 Fous', '01 01 01 01 01', 'lefou.luc@monemail.com', 0, 'patate'),
(3, 'LELION', 'Julie', '7 rue de la savane 12345 Au-soleil', '07 07 07 07 07', 'lelion.julie@monemail.com', 1, 'nuages'),
(4, 'DELAROSE', 'Marc', '10 rue du jardin 10100 Jardinier', '03 03 03 03 03', 'delarose.marc@monemail.com', 0, 'raisin'),
(5, 'PIONNER', 'Sophie', '4 rue des pions 17170 Grotte', '04 04 04 04 04', 'pionner.sophie@monemail.com', 1, 'eclipse');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_commande` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `qte_achetee` int(11) NOT NULL,
  `ad_livraison` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `num_commande`, `id_client`, `id_produit`, `qte_achetee`, `ad_livraison`) VALUES
(1, 1, 3, 1, 3, '7 rue de la savane 12345 Au-soleil'),
(2, 1, 3, 4, 1, '7 rue de la savane 12345 Au-soleil');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(28) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `type`, `nom`, `description`, `quantite`, `prix`) VALUES
(1, 'Lampe', 'Lampe de chevet enfant', 'Toute mignonne , cette lampe à poser éclairera doucement la chambre de votre enfant tout en la décorant délicatement.', 100, 20),
(2, 'Lampe', 'Plaffonier Mapple', 'Cette lampe fait apparaitre une véritable forêt de feuilles et assure incontestablement un éclairage chalheureux. ', 120, 40),
(3, 'Bougie', 'Bougie ananas rose', 'Bougie de cire contenue dans une boîte en porcelaine en forme d\'ananas avec couvercle. ', 200, 5),
(4, 'Bougie', 'Lot de 3 bougies led horizon doré', 'Pratiques, la flamme ne brûle pas et elles ne s\'éteignent pas au moindre courant d\'air. ', 80, 20);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
