-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 mai 2025 à 12:07
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp3`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

DROP TABLE IF EXISTS `abonne`;
CREATE TABLE IF NOT EXISTS `abonne` (
  `matricule_abonne` int NOT NULL AUTO_INCREMENT,
  `nom_abonne` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_naissance_abonne` date DEFAULT NULL,
  `date_adhesion_abonne` date DEFAULT NULL,
  `adresse_abonne` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone_abonne` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `csp_abonne` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`matricule_abonne`)
) ENGINE=InnoDB AUTO_INCREMENT=12347 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `abonne`
--

INSERT INTO `abonne` (`matricule_abonne`, `nom_abonne`, `date_naissance_abonne`, `date_adhesion_abonne`, `adresse_abonne`, `telephone_abonne`, `csp_abonne`) VALUES
(12345, 'Test', '2025-04-09', '2025-04-09', '1 rue du test, Boulevard de Strasbourg 31300 Toulouse', '0123456789', '1'),
(12346, 'Dupont Elodie', '2006-03-16', '2025-04-11', '2 rue du test ', '0123456789', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=12348 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `identifiant`, `mot_de_passe`) VALUES
(12346, 'cesar', '$2y$10$RJ3cDhXMeGKa2XTSucBzC.RIjw41RD.7mSR9EcugEs4/uRCS58vlK'),
(12347, 'cristhian', '$2y$10$Jc7uV1imVfnnOM3QbBOARuSL9Pw1OzzCrokxgg./ovCnCql0cIkzi');

-- --------------------------------------------------------

--
-- Structure de la table `associe`
--

DROP TABLE IF EXISTS `associe`;
CREATE TABLE IF NOT EXISTS `associe` (
  `code_catalogue` char(13) NOT NULL,
  `id_motcle` int NOT NULL,
  PRIMARY KEY (`code_catalogue`,`id_motcle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `associe`
--

INSERT INTO `associe` (`code_catalogue`, `id_motcle`) VALUES
('MIS01', 2),
('SIL01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id_auteur` int NOT NULL AUTO_INCREMENT,
  `nom_auteur` varchar(150) NOT NULL,
  PRIMARY KEY (`id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id_auteur`, `nom_auteur`) VALUES
(27, 'JRR Tolkien'),
(28, 'Victor Hugo');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `matricule_abonne` int NOT NULL,
  `date_demande` date NOT NULL,
  `cote_exemplaire` int NOT NULL,
  PRIMARY KEY (`matricule_abonne`),
  KEY `demande_ibfk_1` (`cote_exemplaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`matricule_abonne`, `date_demande`, `cote_exemplaire`) VALUES
(12345, '2025-05-07', 14);

-- --------------------------------------------------------

--
-- Structure de la table `ecrit`
--

DROP TABLE IF EXISTS `ecrit`;
CREATE TABLE IF NOT EXISTS `ecrit` (
  `code_catalogue` char(13) NOT NULL,
  `id_auteur` int NOT NULL,
  PRIMARY KEY (`code_catalogue`,`id_auteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `emprunte`
--

DROP TABLE IF EXISTS `emprunte`;
CREATE TABLE IF NOT EXISTS `emprunte` (
  `matricule_abonne` int DEFAULT NULL,
  `cote_exemplaire` int NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date DEFAULT NULL,
  `estrenouvele` tinyint(1) DEFAULT '0',
  `rendu` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cote_exemplaire`,`date_emprunt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `emprunte`
--

INSERT INTO `emprunte` (`matricule_abonne`, `cote_exemplaire`, `date_emprunt`, `date_retour`, `estrenouvele`, `rendu`) VALUES
(12345, 13, '2025-05-06', '2025-05-07', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `cote_exemplaire` int NOT NULL AUTO_INCREMENT,
  `nom_editeur` varchar(150) NOT NULL,
  `code_usure` varchar(15) DEFAULT NULL,
  `date_acquisition` date DEFAULT NULL,
  `emplacement_rayon` varchar(50) DEFAULT NULL,
  `code_catalogue` char(13) NOT NULL,
  `disponibilite` tinyint(1) NOT NULL DEFAULT '1',
  `etat_exemplaire` varchar(50) NOT NULL DEFAULT 'disponible',
  PRIMARY KEY (`cote_exemplaire`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`cote_exemplaire`, `nom_editeur`, `code_usure`, `date_acquisition`, `emplacement_rayon`, `code_catalogue`, `disponibilite`, `etat_exemplaire`) VALUES
(13, 'Altaya', 'MOYEN', '2025-05-04', 'T01', 'SIL01', 1, 'disponible'),
(14, 'Gallimard', 'NEUF', '2025-05-08', 'M02', 'MIS01', 1, 'disponible'),
(15, 'Larousse', 'BON', '2025-05-07', 'M02', 'MIS01', 1, 'disponible'),
(16, 'Gallimard', 'NEUF', '2025-05-07', 'S01', 'T01', 1, 'disponible');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `code_catalogue` char(13) COLLATE utf8mb4_general_ci NOT NULL,
  `titre_livre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `theme_livre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`code_catalogue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`code_catalogue`, `titre_livre`, `theme_livre`) VALUES
('MIS01', 'Les Misérables', 'révolution, injustice, rédemption'),
('SIL01', 'Le Silmarillion', 'Fantasy'),
('T01', 'Le Seigneur des Anneaux', 'Heroic-Fantasy');

-- --------------------------------------------------------

--
-- Structure de la table `livre_auteur`
--

DROP TABLE IF EXISTS `livre_auteur`;
CREATE TABLE IF NOT EXISTS `livre_auteur` (
  `code_catalogue` varchar(50) NOT NULL,
  `id_auteur` int NOT NULL,
  PRIMARY KEY (`code_catalogue`,`id_auteur`),
  KEY `id_auteur` (`id_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livre_auteur`
--

INSERT INTO `livre_auteur` (`code_catalogue`, `id_auteur`) VALUES
('MIS01', 28),
('SIL01', 27),
('T01', 27);

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

DROP TABLE IF EXISTS `motcle`;
CREATE TABLE IF NOT EXISTS `motcle` (
  `id_motcle` int NOT NULL AUTO_INCREMENT,
  `motcle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_motcle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `motcle`
--

INSERT INTO `motcle` (`id_motcle`, `motcle`) VALUES
(1, 'fantasy'),
(2, 'roman');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`cote_exemplaire`) REFERENCES `exemplaire` (`cote_exemplaire`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_demande_abonne` FOREIGN KEY (`matricule_abonne`) REFERENCES `abonne` (`matricule_abonne`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
