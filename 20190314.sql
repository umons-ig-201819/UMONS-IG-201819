-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 14 Mars 2019 à 10:55
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

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

CREATE TABLE `conseil` (
  `c_id` int(10) UNSIGNED NOT NULL,
  `c_id_utilisateur` int(11) UNSIGNED NOT NULL,
  `c_id_conseiller` int(10) UNSIGNED NOT NULL,
  `c_conseil` text COLLATE utf8_unicode_520_ci NOT NULL,
  `c_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `conseil`
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

CREATE TABLE `droit` (
  `d_id` int(10) UNSIGNED NOT NULL,
  `d_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `d_description` text COLLATE utf8_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `droit`
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

CREATE TABLE `fichierappli` (
  `f_id` int(11) UNSIGNED NOT NULL,
  `f_id_proprio` int(11) UNSIGNED NOT NULL,
  `f_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `f_url` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `f_appli` tinyint(1) NOT NULL DEFAULT '0',
  `f_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `f_visible_awe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Faut demander, 1=Visible, 2=Cache',
  `f_dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `fichierappli`
--

INSERT INTO `fichierappli` (`f_id`, `f_id_proprio`, `f_nom`, `f_url`, `f_appli`, `f_config`, `f_visible_awe`, `f_dateajout`) VALUES
(1, 1, 'mon troupeau laitier', 'mes_vaches.txt', 2, NULL, 1, '2019-03-10 09:17:49');

-- --------------------------------------------------------

--
-- Structure de la table `fichier_projet`
--

CREATE TABLE `fichier_projet` (
  `fp_id_fichier` int(11) UNSIGNED NOT NULL,
  `fp_id_projet` int(10) UNSIGNED NOT NULL,
  `fp_demande_acces` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=demande effectuee, 1=OK, 2=refus',
  `fp_demande_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `p_id` int(10) UNSIGNED NOT NULL,
  `p_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `p_description` text COLLATE utf8_unicode_520_ci,
  `p_date_start` date NOT NULL,
  `p_date_end` date NOT NULL,
  `p_id_createur` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`p_id`, `p_nom`, `p_description`, `p_date_start`, `p_date_end`, `p_id_createur`) VALUES
(1, 'détection des chaleurs par podomètre', 'Etude de corrélation entre l\'activité physique des vaches et leur état hormonal', '2018-12-02', '2020-01-01', 2),
(2, 'rentabilité d\'un ha de terrain', 'nb tonne/ha en fonction des engrais utilisés', '2019-03-10', '2029-03-10', 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `r_id` int(10) UNSIGNED NOT NULL,
  `r_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `r_description` text COLLATE utf8_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `role`
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

CREATE TABLE `role_droit` (
  `rd_id_role` int(11) UNSIGNED NOT NULL,
  `rd_id_droit` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `role_droit`
--

INSERT INTO `role_droit` (`rd_id_role`, `rd_id_droit`) VALUES
(2, 1),
(1, 2),
(3, 3),
(5, 3),
(1, 4),
(1, 5),
(3, 5),
(4, 5),
(5, 5),
(3, 6),
(5, 6),
(4, 7),
(5, 7);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ut_id` int(10) UNSIGNED NOT NULL,
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
  `ut_accepter_conseil` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ut_id`, `ut_nom`, `ut_prenom`, `ut_date_naiss`, `ut_mail`, `ut_tel`, `ut_gsm`, `ut_sexe`, `ut_login`, `ut_password`, `ut_visible_awe`, `ut_accepter_conseil`) VALUES
(1, 'Durand', 'Jean', '1976-06-02', 'jeanjean@truc.com', '+3223765498', '+32487955612', 1, 'DurandJ', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 0),
(2, 'vanderelst', 'Nadine', '1991-12-09', 'nadine@bidule.fr', NULL, '0478111399', 0, 'supernadine', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 1),
(3, 'Truc', 'Marc', '1980-01-01', NULL, NULL, NULL, 1, 'truc', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(4, 'MACHIN', 'Mimie', '1968-07-30', 'mimie@outlook.com', '065778899', '0475323232', 0, 'machinmimie', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 1),
(5, 'De Bleeker', 'Sophie', '1989-03-31', 'debleekersophie@monmail.be', '003260998877', '0032483123456', 0, 'debleekersophie', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_fichier`
--

CREATE TABLE `utilisateur_fichier` (
  `uf_id_invite` int(11) UNSIGNED NOT NULL,
  `uf_id_fichier` int(11) UNSIGNED NOT NULL,
  `uf_lire` tinyint(1) NOT NULL DEFAULT '0',
  `uf_modifier` tinyint(1) NOT NULL DEFAULT '0',
  `uf_effacer` tinyint(1) NOT NULL DEFAULT '0',
  `uf_demande_acces` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=demande effectuee, 1=OK, 2=refus',
  `uf_demande_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `utilisateur_fichier`
--

INSERT INTO `utilisateur_fichier` (`uf_id_invite`, `uf_id_fichier`, `uf_lire`, `uf_modifier`, `uf_effacer`, `uf_demande_acces`, `uf_demande_date`) VALUES
(2, 1, 1, 0, 0, 0, '2019-03-14 09:09:02');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_projet`
--

CREATE TABLE `utilisateur_projet` (
  `up_id_participant` int(11) UNSIGNED NOT NULL,
  `up_id_projet` int(11) UNSIGNED NOT NULL,
  `up_role_pour_ce_projet` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `up_gestion` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `utilisateur_projet`
--

INSERT INTO `utilisateur_projet` (`up_id_participant`, `up_id_projet`, `up_role_pour_ce_projet`, `up_gestion`) VALUES
(1, 2, 'propriétaire du terrain', 0),
(3, 1, 'aide ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_role`
--

CREATE TABLE `utilisateur_role` (
  `ur_id_ut` int(11) UNSIGNED NOT NULL,
  `ur_id_role` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `utilisateur_role`
--

INSERT INTO `utilisateur_role` (`ur_id_ut`, `ur_id_role`) VALUES
(3, 1),
(4, 2),
(1, 3),
(5, 4),
(2, 5);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `conseil`
--
ALTER TABLE `conseil`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `c_id_utilisateur` (`c_id_utilisateur`),
  ADD KEY `c_id_conseiller` (`c_id_conseiller`);

--
-- Index pour la table `droit`
--
ALTER TABLE `droit`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `d_nom` (`d_nom`);

--
-- Index pour la table `fichierappli`
--
ALTER TABLE `fichierappli`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `f_id_ut` (`f_id_proprio`);

--
-- Index pour la table `fichier_projet`
--
ALTER TABLE `fichier_projet`
  ADD PRIMARY KEY (`fp_id_fichier`,`fp_id_projet`),
  ADD KEY `fp_id_projet` (`fp_id_projet`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `t_nom` (`p_nom`),
  ADD KEY `p_id_createur` (`p_id_createur`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`r_id`),
  ADD UNIQUE KEY `r_nom` (`r_nom`);

--
-- Index pour la table `role_droit`
--
ALTER TABLE `role_droit`
  ADD PRIMARY KEY (`rd_id_role`,`rd_id_droit`),
  ADD KEY `rd_id_droit` (`rd_id_droit`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ut_id`),
  ADD UNIQUE KEY `ut_login` (`ut_login`);

--
-- Index pour la table `utilisateur_fichier`
--
ALTER TABLE `utilisateur_fichier`
  ADD PRIMARY KEY (`uf_id_invite`,`uf_id_fichier`),
  ADD KEY `uf_id_fichier` (`uf_id_fichier`);

--
-- Index pour la table `utilisateur_projet`
--
ALTER TABLE `utilisateur_projet`
  ADD PRIMARY KEY (`up_id_participant`,`up_id_projet`),
  ADD KEY `uth_id_thematique` (`up_id_projet`);

--
-- Index pour la table `utilisateur_role`
--
ALTER TABLE `utilisateur_role`
  ADD PRIMARY KEY (`ur_id_ut`,`ur_id_role`),
  ADD KEY `ur_id_role` (`ur_id_role`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `conseil`
--
ALTER TABLE `conseil`
  MODIFY `c_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `droit`
--
ALTER TABLE `droit`
  MODIFY `d_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `fichierappli`
--
ALTER TABLE `fichierappli`
  MODIFY `f_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `r_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ut_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
