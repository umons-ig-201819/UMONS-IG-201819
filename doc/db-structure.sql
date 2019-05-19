-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Mer 15 Mai 2019 à 17:19
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

-- --------------------------------------------------------

--
-- Structure de la table `conseil`
--

CREATE TABLE IF NOT EXISTS `conseil` (
  `c_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `c_id_utilisateur` int(11) UNSIGNED NOT NULL,
  `c_id_conseiller` int(10) UNSIGNED NOT NULL,
  `c_conseil` text COLLATE utf8_unicode_520_ci NOT NULL,
  `c_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`),
  KEY `c_id_utilisateur` (`c_id_utilisateur`),
  KEY `c_id_conseiller` (`c_id_conseiller`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `day` date NOT NULL,
  `value` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE IF NOT EXISTS `droit` (
  `d_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `d_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `d_description` text COLLATE utf8_unicode_520_ci,
  PRIMARY KEY (`d_id`),
  UNIQUE KEY `d_nom` (`d_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichierappli`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichier_projet`
--

CREATE TABLE IF NOT EXISTS `fichier_projet` (
  `fp_id_fichier` int(11) UNSIGNED NOT NULL,
  `fp_id_projet` int(10) UNSIGNED NOT NULL,
  `fp_demande_acces` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=demande effectuee, 1=OK, 2=refus',
  `fp_demande_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fp_id_fichier`,`fp_id_projet`),
  KEY `fp_id_projet` (`fp_id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pma__bookmark`
--

CREATE TABLE IF NOT EXISTS `pma__bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Structure de la table `pma__central_columns`
--

CREATE TABLE IF NOT EXISTS `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin,
  PRIMARY KEY (`db_name`,`col_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Structure de la table `pma__column_info`
--

CREATE TABLE IF NOT EXISTS `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__designer_settings`
--

CREATE TABLE IF NOT EXISTS `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Structure de la table `pma__export_templates`
--

CREATE TABLE IF NOT EXISTS `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Structure de la table `pma__favorite`
--

CREATE TABLE IF NOT EXISTS `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Structure de la table `pma__history`
--

CREATE TABLE IF NOT EXISTS `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__navigationhiding`
--

CREATE TABLE IF NOT EXISTS `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Structure de la table `pma__pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__recent`
--

CREATE TABLE IF NOT EXISTS `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Structure de la table `pma__relation`
--

CREATE TABLE IF NOT EXISTS `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Structure de la table `pma__savedsearches`
--

CREATE TABLE IF NOT EXISTS `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_coords`
--

CREATE TABLE IF NOT EXISTS `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_info`
--

CREATE TABLE IF NOT EXISTS `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Structure de la table `pma__tracking`
--

CREATE TABLE IF NOT EXISTS `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__userconfig`
--

CREATE TABLE IF NOT EXISTS `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__usergroups`
--

CREATE TABLE IF NOT EXISTS `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N',
  PRIMARY KEY (`usergroup`,`tab`,`allowed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Structure de la table `pma__users`
--

CREATE TABLE IF NOT EXISTS `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`,`usergroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `r_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `r_nom` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `r_description` text COLLATE utf8_unicode_520_ci,
  PRIMARY KEY (`r_id`),
  UNIQUE KEY `r_nom` (`r_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role_droit`
--

CREATE TABLE IF NOT EXISTS `role_droit` (
  `rd_id_role` int(11) UNSIGNED NOT NULL,
  `rd_id_droit` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`rd_id_role`,`rd_id_droit`),
  KEY `rd_id_droit` (`rd_id_droit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_fichier`
--

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

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_projet`
--

CREATE TABLE IF NOT EXISTS `utilisateur_projet` (
  `up_id_participant` int(11) UNSIGNED NOT NULL,
  `up_id_projet` int(11) UNSIGNED NOT NULL,
  `up_role_pour_ce_projet` varchar(255) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `up_gestion` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`up_id_participant`,`up_id_projet`),
  KEY `uth_id_thematique` (`up_id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_role`
--

CREATE TABLE IF NOT EXISTS `utilisateur_role` (
  `ur_id_ut` int(11) UNSIGNED NOT NULL,
  `ur_id_role` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`ur_id_ut`,`ur_id_role`),
  KEY `ur_id_role` (`ur_id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

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

ALTER TABLE `utilisateur` ADD `ut_reset` VARCHAR(255) NULL AFTER `ut_accepter_conseil`, ADD `ut_validreset` TIMESTAMP NULL AFTER `ut_reset`; 
