-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Ven 03 Mai 2019 à 07:06
-- Version du serveur :  10.1.38-MariaDB-0ubuntu0.18.04.1
-- Version de PHP :  7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wallesmart`
--
CREATE DATABASE IF NOT EXISTS `wallesmart` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;
USE `wallesmart`;

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
  `c_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`),
  KEY `c_id_utilisateur` (`c_id_utilisateur`),
  KEY `c_id_conseiller` (`c_id_conseiller`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `conseil`:
--   `c_id_utilisateur`
--       `utilisateur` -> `ut_id`
--   `c_id_conseiller`
--       `utilisateur` -> `ut_id`
--

--
-- Vider la table avant d'insérer `conseil`
--

TRUNCATE TABLE `conseil`;
--
-- Contenu de la table `conseil`
--

INSERT IGNORE INTO `conseil` (`c_id`, `c_id_utilisateur`, `c_id_conseiller`, `c_conseil`, `c_date`) VALUES
(4, 5, 2, 'Attention au surmenage', '2019-02-05 05:27:45');

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

DROP TABLE IF EXISTS `droit`;
CREATE TABLE IF NOT EXISTS `droit` (
  `d_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `d_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `d_description` text COLLATE utf8_unicode_520_ci,
  PRIMARY KEY (`d_id`),
  UNIQUE KEY `d_nom` (`d_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `droit`:
--

--
-- Vider la table avant d'insérer `droit`
--

TRUNCATE TABLE `droit`;
--
-- Contenu de la table `droit`
--

INSERT IGNORE INTO `droit` (`d_id`, `d_nom`, `d_description`) VALUES
(1, 'edition des appli', 'ajouter / supprimer des appli'),
(2, 'edition des comptes', 'ajouter / supprimer / modifier un compte'),
(3, 'edition projet', 'ajouter / supprimer / modifier un projet'),
(4, 'gestion des droits', NULL),
(5, 'conseiller', 'droit de donner des conseils'),
(6, 'fichiers personnels', 'gérer ses propres fichiers'),
(7, 'accès autres fichiers', 'droit de consulter les fichiers de tiers'),
(14, 'MANAGE_PROJECT', NULL),
(15, 'MANAGE_USERS', NULL);

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
  `f_appli` tinyint(1) NOT NULL DEFAULT '0',
  `f_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `f_visible_awe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Faut demander, 1=Visible, 2=Cache',
  `f_dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`f_id`),
  KEY `f_id_ut` (`f_id_proprio`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `fichierappli`:
--   `f_id_proprio`
--       `utilisateur` -> `ut_id`
--

--
-- Vider la table avant d'insérer `fichierappli`
--

TRUNCATE TABLE `fichierappli`;
--
-- Contenu de la table `fichierappli`
--

INSERT IGNORE INTO `fichierappli` (`f_id`, `f_id_proprio`, `f_nom`, `f_url`, `f_appli`, `f_config`, `f_visible_awe`, `f_dateajout`) VALUES
(97, 89, 'MariaDB exemple', '2E3GME58D', 0, NULL, 1, '2019-05-01 03:25:39'),
(98, 89, 'PostgreSQL exemple', '2E5CQKJ2U', 0, NULL, 1, '2019-05-01 03:25:39'),
(99, 89, 'CSV exemple', '2E6UBUUT8', 0, NULL, 1, '2019-05-01 03:25:39'),
(100, 89, 'Access exemple', '2E5MMRQK9', 0, NULL, 1, '2019-05-01 03:25:39'),
(101, 89, 'REST exemple', '2E6SRTGQJ', 0, NULL, 1, '2019-05-01 03:25:39'),
(104, 94, 'trees.csv', '2E973J16Q', 0, NULL, 1, '2019-05-01 07:18:36'),

-- --------------------------------------------------------

--
-- Structure de la table `fichier_projet`
--

DROP TABLE IF EXISTS `fichier_projet`;
CREATE TABLE IF NOT EXISTS `fichier_projet` (
  `fp_id_fichier` int(11) UNSIGNED NOT NULL,
  `fp_id_projet` int(10) UNSIGNED NOT NULL,
  `fp_demande_acces` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=demande effectuee, 1=OK, 2=refus',
  `fp_demande_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fp_id_fichier`,`fp_id_projet`),
  KEY `fp_id_projet` (`fp_id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `fichier_projet`:
--   `fp_id_fichier`
--       `fichierappli` -> `f_id`
--   `fp_id_projet`
--       `projet` -> `p_id`
--

--
-- Vider la table avant d'insérer `fichier_projet`
--

TRUNCATE TABLE `fichier_projet`;
--
-- Contenu de la table `fichier_projet`
--

INSERT IGNORE INTO `fichier_projet` (`fp_id_fichier`, `fp_id_projet`, `fp_demande_acces`, `fp_demande_date`) VALUES
(97, 7, 1, '2019-05-01 07:34:34'),
(97, 8, 1, '2019-05-01 12:54:03'),
(98, 7, 1, '2019-05-01 07:34:34'),
(98, 8, 1, '2019-05-01 12:54:03'),
(99, 7, 1, '2019-05-01 07:34:34'),
(99, 8, 1, '2019-05-01 12:54:03'),
(100, 7, 1, '2019-05-01 07:34:34'),
(100, 8, 1, '2019-05-01 12:54:03'),
(101, 7, 1, '2019-05-01 07:34:34'),
(101, 8, 1, '2019-05-01 12:54:03'),
(104, 7, 1, '2019-05-01 07:34:34'),
(104, 8, 1, '2019-05-01 12:54:03');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `p_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `p_description` text COLLATE utf8_unicode_520_ci,
  `p_date_start` date NOT NULL,
  `p_date_end` date NOT NULL,
  `p_id_createur` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `t_nom` (`p_nom`),
  KEY `p_id_createur` (`p_id_createur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `projet`:
--   `p_id_createur`
--       `utilisateur` -> `ut_id`
--

--
-- Vider la table avant d'insérer `projet`
--

TRUNCATE TABLE `projet`;
--
-- Contenu de la table `projet`
--

INSERT IGNORE INTO `projet` (`p_id`, `p_nom`, `p_description`, `p_date_start`, `p_date_end`, `p_id_createur`) VALUES
(1, 'detection des chaleurs par podometre', 'Etude de corrélation entre l\'activité physique des ', '2018-12-02', '2020-01-01', 2),
(2, 'rentabilité d\'un ha de terrain', 'nb tonne/ha en fonction des engrais utilisés', '2019-03-10', '2029-03-10', 2),
(6, 'test', 'test', '2019-04-02', '2020-05-12', 2),
(7, 'exemple de projet', '', '2019-05-01', '2021-04-14', 94),
(8, 'Projet_vache', 'Test vaches', '2019-04-29', '2019-05-03', 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `r_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `r_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `r_description` text COLLATE utf8_unicode_520_ci,
  PRIMARY KEY (`r_id`),
  UNIQUE KEY `r_nom` (`r_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `role`:
--

--
-- Vider la table avant d'insérer `role`
--

TRUNCATE TABLE `role`;
--
-- Contenu de la table `role`
--

INSERT IGNORE INTO `role` (`r_id`, `r_nom`, `r_description`) VALUES
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
-- RELATIONS POUR LA TABLE `role_droit`:
--   `rd_id_droit`
--       `droit` -> `d_id`
--   `rd_id_role`
--       `role` -> `r_id`
--

--
-- Vider la table avant d'insérer `role_droit`
--

TRUNCATE TABLE `role_droit`;
--
-- Contenu de la table `role_droit`
--

INSERT IGNORE INTO `role_droit` (`rd_id_role`, `rd_id_droit`) VALUES
(1, 2),
(1, 4),
(1, 14),
(1, 15),
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
  `ut_visible_awe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Non, 1=Oui, 2=Faut demander',
  `ut_accepter_conseil` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ut_id`),
  UNIQUE KEY `ut_login` (`ut_login`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `utilisateur`:
--

--
-- Vider la table avant d'insérer `utilisateur`
--

TRUNCATE TABLE `utilisateur`;
--
-- Contenu de la table `utilisateur`
--

INSERT IGNORE INTO `utilisateur` (`ut_id`, `ut_nom`, `ut_prenom`, `ut_date_naiss`, `ut_mail`, `ut_tel`, `ut_gsm`, `ut_sexe`, `ut_login`, `ut_password`, `ut_visible_awe`, `ut_accepter_conseil`) VALUES
(1, 'Cools', 'Aurélie', '1994-02-03', '', '', '', 0, 'coooools', '3cef74c61d65cdc5aa487c7ab7854c7ec88d1e32', 0, 0),
(2, 'vanderelst', 'Nadine', '1991-12-09', 'nadine@bidule.fr', '1234567', '0478111399', 0, 'supernadine', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 1),
(3, 'Truc', 'Marc', '1980-01-01', NULL, NULL, NULL, 1, 'truc', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(4, 'MACHIN', 'Mimie', '1968-07-30', 'mimie@outlook.com', '065778899', '0475323232', 0, 'machinmimie', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 1),
(5, 'De Bleeker', 'Sophie', '1989-03-31', 'debleekersophie@monmail.be', '003260998877', '0032483123456', 0, 'debleekersophie', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 1),
(6, 'Sample', 'Database', NULL, NULL, NULL, NULL, NULL, '', '', 2, 0),
(8, 'rombaux', 'michael', '0000-00-00', 'rbx@hotmail.com', '', '', NULL, 'michael', '7c222fb2927d828af22f592134e8932480637c0d', 0, 0),
(74, 'fr', 'roo', '1990-02-28', 'francois.robberts@bbri.be', '783', '783', 1, 'courgax', 'e6fb06210fafc02fd7479ddbed2d042cc3a5155e', 0, 0),
(75, 'Genin', 'Emilie', '1986-12-26', '', '', '', 0, 'emilie', '5c0b21179ff86dcb6f0abf64805ee2d1af6966e3', 0, 0),
(87, 'mi', 'autre', '1978-05-02', '', '', '', 1, 'mimi', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 1),
(88, 'DUPONT', 'Pierre', NULL, NULL, NULL, NULL, NULL, 'pierrot', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(89, 'AWE', 'AWE', NULL, NULL, NULL, NULL, NULL, 'AWE', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(94, 'SMITH', 'John', NULL, NULL, NULL, NULL, NULL, 'smithy', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(95, 'pol', 'jean', '0000-00-00', '', '', '', 1, 'polpol', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_fichier`
--

DROP TABLE IF EXISTS `utilisateur_fichier`;
CREATE TABLE IF NOT EXISTS `utilisateur_fichier` (
  `uf_id_invite` int(11) UNSIGNED NOT NULL,
  `uf_id_fichier` int(11) UNSIGNED NOT NULL,
  `uf_lire` tinyint(1) NOT NULL DEFAULT '0',
  `uf_modifier` tinyint(1) NOT NULL DEFAULT '0',
  `uf_effacer` tinyint(1) NOT NULL DEFAULT '0',
  `uf_demande_acces` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=demande effectuee, 1=OK, 2=refus',
  `uf_demande_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uf_id_invite`,`uf_id_fichier`),
  KEY `uf_id_fichier` (`uf_id_fichier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `utilisateur_fichier`:
--   `uf_id_fichier`
--       `fichierappli` -> `f_id`
--   `uf_id_invite`
--       `utilisateur` -> `ut_id`
--

--
-- Vider la table avant d'insérer `utilisateur_fichier`
--

TRUNCATE TABLE `utilisateur_fichier`;
--
-- Contenu de la table `utilisateur_fichier`
--

INSERT IGNORE INTO `utilisateur_fichier` (`uf_id_invite`, `uf_id_fichier`, `uf_lire`, `uf_modifier`, `uf_effacer`, `uf_demande_acces`, `uf_demande_date`) VALUES
(2, 100, 1, 0, 0, 0, '2019-05-02 12:38:15'),

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_projet`
--

DROP TABLE IF EXISTS `utilisateur_projet`;
CREATE TABLE IF NOT EXISTS `utilisateur_projet` (
  `up_id_participant` int(11) UNSIGNED NOT NULL,
  `up_id_projet` int(11) UNSIGNED NOT NULL,
  `up_role_pour_ce_projet` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `up_gestion` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`up_id_participant`,`up_id_projet`),
  KEY `uth_id_thematique` (`up_id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- RELATIONS POUR LA TABLE `utilisateur_projet`:
--   `up_id_projet`
--       `projet` -> `p_id`
--   `up_id_participant`
--       `utilisateur` -> `ut_id`
--

--
-- Vider la table avant d'insérer `utilisateur_projet`
--

TRUNCATE TABLE `utilisateur_projet`;
--
-- Contenu de la table `utilisateur_projet`
--

INSERT IGNORE INTO `utilisateur_projet` (`up_id_participant`, `up_id_projet`, `up_role_pour_ce_projet`, `up_gestion`) VALUES
(1, 1, NULL, 1),
(2, 1, NULL, 1),
(2, 2, NULL, 1),
(4, 1, NULL, 1),
(4, 2, NULL, 1),
(5, 1, NULL, 1),
(5, 2, NULL, 1),
(6, 1, NULL, 1),
(6, 2, NULL, 1),
(87, 1, NULL, 0),
(87, 8, NULL, 0),
(88, 6, NULL, 0);

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
-- RELATIONS POUR LA TABLE `utilisateur_role`:
--   `ur_id_role`
--       `role` -> `r_id`
--   `ur_id_ut`
--       `utilisateur` -> `ut_id`
--

--
-- Vider la table avant d'insérer `utilisateur_role`
--

TRUNCATE TABLE `utilisateur_role`;
--
-- Contenu de la table `utilisateur_role`
--

INSERT IGNORE INTO `utilisateur_role` (`ur_id_ut`, `ur_id_role`) VALUES
(1, 3),
(2, 1),
(2, 3),
(2, 4),
(3, 1),
(4, 2),
(5, 4),
(8, 3),
(8, 6),
(74, 2),
(75, 5),
(87, 6),
(88, 5),
(94, 1),
(95, 6);

--
-- Contraintes pour les tables exportées
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
