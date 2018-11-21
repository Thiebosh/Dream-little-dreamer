-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 09 nov. 2018 à 17:09
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
/*ligne ajoutée pour parer à l'exception levée : retire au niveau global le paramètre incriminé*/
SET GLOBAL SQL_MODE = (SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `ad_livraison`, `tel`, `email`, `genre`, `password`) VALUES
(1, 'DUPRE', 'Eric', '3 rue des prairies 90900 Prairie', '09 09 09 09 09', 'dupre.eric@monemail.com', 0, '92ef03e89f7c476e91e30c3777fdb7d7110ed256'),
(2, 'LEFOU', 'Luc', '11 rue de la folie 11111 Fous', '01 01 01 01 01', 'lefou.luc@monemail.com', 0, 'd311b1c8e5fe83187cf2d83c8e080dbcff9fc4ef'),
(3, 'LELION', 'Julie', '7 rue de la savane 12345 Au-soleil', '07 07 07 07 07', 'lelion.julie@monemail.com', 1, 'a7feaf25b4a1eaf5a5c7ad6a4955b3b0ddafe210'),
(4, 'DELAROSE', 'Marc', '10 rue du jardin 10100 Jardinier', '03 03 03 03 03', 'delarose.marc@monemail.com', 0, 'a45b3ee646ec485d69c415143202cac1abb93560'),
(5, 'PIONNER', 'Sophie', '4 rue des pions 17170 Grotte', '04 04 04 04 04', 'pionner.sophie@monemail.com', 1, '0acc7fadbc8e372aa5774ce7d593474e2e61f159');

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
  `est_provisoire` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `num_commande`, `id_client`, `id_produit`, `qte_achetee`, `ad_livraison`, `est_provisoire`) VALUES
(1, 1, 3, 1, 3, '7 rue de la savane 12345 Au-soleil', 0),
(2, 1, 3, 4, 1, '7 rue de la savane 12345 Au-soleil', 0),
(3, 2, 1, 4, 3, '3 rue des prairies 90900 Prairie', 0),
(4, 2, 1, 1, 7, '3 rue des prairies 90900 Prairie', 0),
(9, 3, 1, 3, 3, '3 rue des prairies 90900 Prairie', 0),
(10, 4, 1, 3, 6, '3 rue des prairies 90900 Prairie', 0),
(11, 5, 1, 4, 8, '3 rue des prairies 90900 Prairie', 0),
(12, 5, 1, 3, 5, '3 rue des prairies 90900 Prairie', 0),
(13, 5, 1, 2, 7, '3 rue des prairies 90900 Prairie', 1),
(14, 5, 1, 1, 5, '3 rue des prairies 90900 Prairie', 1);

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
(1, 'Lampes', 'Lampe de chevet enfant', 'Toute mignonne, cette lampe à poser éclairera doucement la chambre de votre enfant tout en la décorant délicatement.', 15, 20),
(2, 'Lampes', 'Plafonnier Mapple', 'Cette lampe fait apparaitre une véritable forêt de feuilles et assure incontestablement un éclairage chalheureux. ', 113, 40),
(3, 'Bougies', 'Bougie ananas rose', 'Bougie de cire contenue dans une boîte en porcelaine en forme d\'ananas avec couvercle. ', 186, 5),
(4, 'Bougies', 'Lot de 3 bougies led horizon doré', 'Pratiques, la flamme ne brûle pas et elles ne s\'éteignent pas au moindre courant d\'air. ', 92, 20);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
