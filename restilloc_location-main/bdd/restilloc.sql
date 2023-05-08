-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 nov. 2022 à 16:54
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restilloc`
--

-- --------------------------------------------------------

--
-- Structure de la table `cabinet_expertise`
--

DROP TABLE IF EXISTS `cabinet_expertise`;
CREATE TABLE IF NOT EXISTS `cabinet_expertise` (
  `id_cabinet` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cabinet` varchar(50) DEFAULT NULL,
  `adresse_cabinet` varchar(50) DEFAULT NULL,
  `cp_cabinet` varchar(50) DEFAULT NULL,
  `ville_cabinet` varchar(50) DEFAULT NULL,
  `tel_cabinet` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cabinet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(50) DEFAULT NULL,
  `prenom_client` varchar(50) DEFAULT NULL,
  `adresse_client` varchar(50) DEFAULT NULL,
  `cp_client` varchar(50) DEFAULT NULL,
  `ville_client` varchar(50) DEFAULT NULL,
  `tel_client` varchar(50) DEFAULT NULL,
  `portable_client` varchar(50) DEFAULT NULL,
  `email_client` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `adresse_client`, `cp_client`, `ville_client`, `tel_client`, `portable_client`, `email_client`) VALUES
(15, 'Friedrich', 'Siméon', '12 rue séllenik', '67000', 'Strasbourg', '', '', ''),
(14, 'Pava', 'Eric', '14 rue sellenick', '67000', 'Strasbourg', '', '', ''),
(12, 'Oiknine', 'Dylan', '46 Boulevard Clemenceau', '67000', 'Strasbourg', '', '', 'oikninedylan@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `dossier_restitution`
--

DROP TABLE IF EXISTS `dossier_restitution`;
CREATE TABLE IF NOT EXISTS `dossier_restitution` (
  `id_dossier` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_vehicule` varchar(50) DEFAULT NULL,
  `dossier_expert` varchar(50) DEFAULT NULL,
  `dossier_rendez_vous` varchar(50) DEFAULT NULL,
  `dossier_date` varchar(50) DEFAULT NULL,
  `piece` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `quantite` varchar(50) DEFAULT NULL,
  `peinture` varchar(50) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `id_vehicule` int(11) NOT NULL,
  PRIMARY KEY (`id_dossier`),
  UNIQUE KEY `id_vehicule` (`id_vehicule`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `expert`
--

DROP TABLE IF EXISTS `expert`;
CREATE TABLE IF NOT EXISTS `expert` (
  `id_expert` int(11) NOT NULL AUTO_INCREMENT,
  `nom_expert` varchar(50) DEFAULT NULL,
  `prenom_expert` varchar(50) DEFAULT NULL,
  `tel_expert` varchar(50) DEFAULT NULL,
  `mail_expert` varchar(50) DEFAULT NULL,
  `id_cabinet` int(11) NOT NULL,
  PRIMARY KEY (`id_expert`),
  KEY `id_cabinet` (`id_cabinet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `garage`
--

DROP TABLE IF EXISTS `garage`;
CREATE TABLE IF NOT EXISTS `garage` (
  `id_garage` int(11) NOT NULL AUTO_INCREMENT,
  `nom_garage` varchar(50) DEFAULT NULL,
  `adresse_garage` varchar(50) DEFAULT NULL,
  `cp_garage` varchar(50) DEFAULT NULL,
  `ville_garage` varchar(50) DEFAULT NULL,
  `tel_garage` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_garage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id_marque` int(11) NOT NULL AUTO_INCREMENT,
  `nom_marque` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_marque`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id_marque`, `nom_marque`) VALUES
(1, 'PEUGEOT'),
(3, 'CITROEN'),
(4, 'WOLFVAGEN'),
(5, 'HONDA'),
(6, 'VOLVO');

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `id_modele` int(11) NOT NULL AUTO_INCREMENT,
  `nom_modele` varchar(50) DEFAULT NULL,
  `id_marque` int(11) NOT NULL,
  PRIMARY KEY (`id_modele`),
  KEY `id_marque` (`id_marque`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id_modele`, `nom_modele`, `id_marque`) VALUES
(1, '308 GTI', 1),
(2, '307 GTI', 1),
(3, '3008', 1),
(4, '206', 1),
(5, '207', 1),
(6, '208', 1),
(7, 'C4', 3),
(8, 'C5', 3),
(9, 'C3', 3),
(10, 'PICASSO', 3),
(11, 'GOLF TDI', 4),
(12, 'TOUAREG', 4),
(13, 'S2000', 5),
(14, 'CIVIC', 5),
(15, 'CR-V', 5),
(16, 'XC60', 6),
(17, 'XC40', 6);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

DROP TABLE IF EXISTS `rendez_vous`;
CREATE TABLE IF NOT EXISTS `rendez_vous` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `id_garage` int(11) NOT NULL,
  `id_expert` int(11) NOT NULL,
  PRIMARY KEY (`id_client`),
  KEY `id_garage` (`id_garage`),
  KEY `id_expert` (`id_expert`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id_vehicule` int(11) NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(50) DEFAULT NULL,
  `motorisation` varchar(50) DEFAULT NULL,
  `date_circulation` varchar(30) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `id_modele` int(11) NOT NULL,
  PRIMARY KEY (`id_vehicule`),
  KEY `id_client` (`id_client`),
  KEY `id_modele` (`id_modele`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `immatriculation`, `motorisation`, `date_circulation`, `id_client`, `id_modele`) VALUES
(1, '4HGIJX89PY', NULL, '22/08/2023/12:20', 15, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
