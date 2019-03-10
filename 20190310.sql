-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le :  Dim 10 mars 2019 à 08:49
-- Version du serveur :  10.2.8-MariaDB
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wallesmart`
--

-- --------------------------------------------------------

--
-- Structure de la table `conseil`
--

DROP TABLE IF EXISTS `conseil`;
CREATE TABLE IF NOT EXISTS `conseil` (
  `c_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `c_id_utilisateur` int(11) UNSIGNED NOT NULL,
  `c_id_conseiller` int(10) UNSIGNED NOT NULL,
  `c_conseil` text COLLATE utf8_unicode_520_ci NOT NULL,
  `c_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`c_id`),
  KEY `c_id_utilisateur` (`c_id_utilisateur`),
  KEY `c_id_conseiller` (`c_id_conseiller`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `conseil`
--

INSERT INTO `conseil` (`c_id`, `c_id_utilisateur`, `c_id_conseiller`, `c_conseil`, `c_date`) VALUES
(1, 2, 4, 'lave-toi les dents 2x/j', '2019-03-10 00:00:00'),
(2, 4, 1, 'Ne va pas dormir trop tard si tu dois te lever tôt le lendemain !', '2019-03-10 00:00:00'),
(3, 5, 1, 'appelez-moi quand vous voulez', '2019-03-10 09:46:07'),
(4, 5, 2, 'Attention au surmenage', '2019-02-05 05:27:45');

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

DROP TABLE IF EXISTS `droit`;
CREATE TABLE IF NOT EXISTS `droit` (
  `d_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `d_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `d_description` text COLLATE utf8_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`d_id`),
  UNIQUE KEY `d_nom` (`d_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `droit`
--

INSERT INTO `droit` (`d_id`, `d_nom`, `d_description`) VALUES
(1, 'edition des appli', 'ajouter / supprimer des appli'),
(2, 'edition des comptes', 'ajouter / supprimer / modifier un compte'),
(3, 'edition projet', 'ajouter / supprimer / modifier un projet'),
(4, 'gestion des droits', NULL),
(5, 'conseiller', 'droit de donner des conseils'),
(6, 'fichiers personnels', 'gérer ses propres fichiers'),
(7, 'accès autres fichiers', 'droit de consulter les fichiers de tiers');

-- --------------------------------------------------------

--
-- Structure de la table `fichierappli`
--

DROP TABLE IF EXISTS `fichierappli`;
CREATE TABLE IF NOT EXISTS `fichierappli` (
  `f_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `f_id_proprio` int(11) UNSIGNED NOT NULL,
  `f_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `f_url` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `f_appli` tinyint(1) NOT NULL DEFAULT 0,
  `f_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `f_visibleAWE` tinyint(1) NOT NULL DEFAULT 0,
  `f_dateajout` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`f_id`),
  KEY `f_id_ut` (`f_id_proprio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `fichierappli`
--

INSERT INTO `fichierappli` (`f_id`, `f_id_proprio`, `f_nom`, `f_url`, `f_appli`, `f_config`, `f_visibleAWE`, `f_dateajout`) VALUES
(1, 1, 'mon troupeau laitier', 'mes_vaches.txt', 0, NULL, 1, '2019-03-10 09:17:49');

-- --------------------------------------------------------

--
-- Structure de la table `fichier_projet`
--

DROP TABLE IF EXISTS `fichier_projet`;
CREATE TABLE IF NOT EXISTS `fichier_projet` (
  `fp_id_fichier` int(11) UNSIGNED NOT NULL,
  `fp_id_projet` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`fp_id_fichier`,`fp_id_projet`),
  KEY `fp_id_projet` (`fp_id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `p_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `p_description` text COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `p_date_start` date NOT NULL,
  `p_date_end` date NOT NULL,
  `p_id_createur` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `t_nom` (`p_nom`),
  KEY `p_id_createur` (`p_id_createur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`p_id`, `p_nom`, `p_description`, `p_date_start`, `p_date_end`, `p_id_createur`) VALUES
(1, 'détection des chaleurs par podomètre', 'Etude de corrélation entre l\'activité physique des vaches et leur état hormonal', '2018-12-02', '2020-01-01', 2),
(2, 'rentabilité d\'un ha de terrain', 'nb tonne/ha en fonction des engrais utilisés', '2019-03-10', '2029-03-10', 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `r_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `r_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `r_description` text COLLATE utf8_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`r_id`),
  UNIQUE KEY `r_nom` (`r_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`r_id`, `r_nom`, `r_description`) VALUES
(1, 'gestionnaire', NULL),
(2, 'développeur', NULL),
(3, 'agriculteur', NULL),
(4, 'conseiller', NULL),
(5, 'scientifique', NULL),
(6, 'citoyen', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role_droit`
--

DROP TABLE IF EXISTS `role_droit`;
CREATE TABLE IF NOT EXISTS `role_droit` (
  `rd_id_role` int(11) UNSIGNED NOT NULL,
  `rd_id_droit` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`rd_id_role`,`rd_id_droit`),
  KEY `rd_id_droit` (`rd_id_droit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `role_droit`
--

INSERT INTO `role_droit` (`rd_id_role`, `rd_id_droit`) VALUES
(1, 2),
(1, 4),
(1, 5),
(2, 1),
(3, 3),
(3, 5),
(3, 6),
(4, 5),
(4, 7),
(5, 3),
(5, 5),
(5, 6),
(5, 7);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ut_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ut_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `ut_prenom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `ut_date_naiss` date DEFAULT NULL,
  `ut_mail` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `ut_tel` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `ut_gsm` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `ut_sexe` int(10) UNSIGNED DEFAULT NULL,
  `ut_login` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `ut_password` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `ut_visible_awe` tinyint(1) NOT NULL DEFAULT 0,
  `ut_accepter_conseil` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ut_id`),
  UNIQUE KEY `ut_login` (`ut_login`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ut_id`, `ut_nom`, `ut_prenom`, `ut_date_naiss`, `ut_mail`, `ut_tel`, `ut_gsm`, `ut_sexe`, `ut_login`, `ut_password`, `ut_visible_awe`, `ut_accepter_conseil`) VALUES
(1, 'Durand', 'Jean', '1976-06-02', 'jeanjean@truc.com', '+3223765498', '+32487955612', 1, 'DurandJ', '1234', 1, 0),
(2, 'vanderelst', 'Nadine', '1991-12-09', 'nadine@bidule.fr', NULL, '0478111399', 0, 'supernadine', '1234', 1, 1),
(3, 'Truc', 'Marc', '1980-01-01', NULL, NULL, NULL, 1, 'truc', '9999', 0, 0),
(4, 'MACHIN', 'Mimie', '1968-07-30', 'mimie@outlook.com', '065778899', '0475323232', 0, 'machinmimie', '1111', 1, 1),
(5, 'De Bleeker', 'Sophie', '1989-03-31', 'debleekersophie@monmail.be', '003260998877', '0032483123456', 0, 'debleekersophie', '8888', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_fichier`
--

DROP TABLE IF EXISTS `utilisateur_fichier`;
CREATE TABLE IF NOT EXISTS `utilisateur_fichier` (
  `uf_id_invite` int(11) UNSIGNED NOT NULL,
  `uf_id_fichier` int(11) UNSIGNED NOT NULL,
  `uf_lire` tinyint(1) NOT NULL DEFAULT 0,
  `uf_modifier` tinyint(1) NOT NULL DEFAULT 0,
  `uf_effacer` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`uf_id_invite`,`uf_id_fichier`),
  KEY `uf_id_fichier` (`uf_id_fichier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `utilisateur_fichier`
--

INSERT INTO `utilisateur_fichier` (`uf_id_invite`, `uf_id_fichier`, `uf_lire`, `uf_modifier`, `uf_effacer`) VALUES
(2, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_projet`
--

DROP TABLE IF EXISTS `utilisateur_projet`;
CREATE TABLE IF NOT EXISTS `utilisateur_projet` (
  `up_id_participant` int(11) UNSIGNED NOT NULL,
  `up_id_projet` int(11) UNSIGNED NOT NULL,
  `up_role_pour_ce_projet` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `up_gestion` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`up_id_participant`,`up_id_projet`),
  KEY `uth_id_thematique` (`up_id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `utilisateur_projet`
--

INSERT INTO `utilisateur_projet` (`up_id_participant`, `up_id_projet`, `up_role_pour_ce_projet`, `up_gestion`) VALUES
(1, 2, 'propriétaire du terrain', 0),
(3, 1, 'aide ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_role`
--

DROP TABLE IF EXISTS `utilisateur_role`;
CREATE TABLE IF NOT EXISTS `utilisateur_role` (
  `ur_id_ut` int(11) UNSIGNED NOT NULL,
  `ur_id_role` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`ur_id_ut`,`ur_id_role`),
  KEY `ur_id_role` (`ur_id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `utilisateur_role`
--

INSERT INTO `utilisateur_role` (`ur_id_ut`, `ur_id_role`) VALUES
(1, 3),
(2, 5),
(3, 1),
(4, 2),
(5, 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conseil`
--
ALTER TABLE `conseil`
  ADD CONSTRAINT `conseil_ibfk_1` FOREIGN KEY (`c_id_utilisateur`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conseil_ibfk_2` FOREIGN KEY (`c_id_conseiller`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fichierappli`
--
ALTER TABLE `fichierappli`
  ADD CONSTRAINT `fichierappli_ibfk_2` FOREIGN KEY (`f_id_proprio`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fichier_projet`
--
ALTER TABLE `fichier_projet`
  ADD CONSTRAINT `fichier_projet_ibfk_1` FOREIGN KEY (`fp_id_fichier`) REFERENCES `fichierappli` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fichier_projet_ibfk_2` FOREIGN KEY (`fp_id_projet`) REFERENCES `projet` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`p_id_createur`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `role_droit`
--
ALTER TABLE `role_droit`
  ADD CONSTRAINT `role_droit_ibfk_1` FOREIGN KEY (`rd_id_droit`) REFERENCES `droit` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_droit_ibfk_2` FOREIGN KEY (`rd_id_role`) REFERENCES `role` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur_fichier`
--
ALTER TABLE `utilisateur_fichier`
  ADD CONSTRAINT `utilisateur_fichier_ibfk_1` FOREIGN KEY (`uf_id_fichier`) REFERENCES `fichierappli` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_fichier_ibfk_2` FOREIGN KEY (`uf_id_invite`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur_projet`
--
ALTER TABLE `utilisateur_projet`
  ADD CONSTRAINT `utilisateur_projet_ibfk_1` FOREIGN KEY (`up_id_projet`) REFERENCES `projet` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_projet_ibfk_2` FOREIGN KEY (`up_id_participant`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur_role`
--
ALTER TABLE `utilisateur_role`
  ADD CONSTRAINT `utilisateur_role_ibfk_1` FOREIGN KEY (`ur_id_role`) REFERENCES `role` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_role_ibfk_2` FOREIGN KEY (`ur_id_ut`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
