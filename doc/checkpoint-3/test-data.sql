-- Test data

INSERT IGNORE INTO utilisateur (ut_nom, ut_prenom, ut_login, ut_password)
VALUES ('SMITH', 'John', 'smithy', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
       ('DUPONT', 'Pierre', 'pierrot', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
       ('AWE', 'AWE', 'AWE', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3')
;

INSERT IGNORE INTO utilisateur_role (ur_id_ut, ur_id_role)
SELECT ut_id, r_id FROM utilisateur, role
WHERE r_nom LIKE 'gestionnaire' AND ut_login LIKE 'smithy'
;

INSERT IGNORE INTO utilisateur_role (ur_id_ut, ur_id_role)
SELECT ut_id, r_id FROM utilisateur, role
WHERE r_nom LIKE 'scientifique' AND ut_login LIKE 'pierrot'
;


INSERT IGNORE INTO droit (d_nom)
VALUES ('MANAGE_PROJECT'), ('MANAGE_USERS');

INSERT IGNORE INTO role_droit (rd_id_role, rd_id_droit)
SELECT r_id,d_id FROM role, droit WHERE d_nom IN ('MANAGE_PROJECT','MANAGE_USERS')
AND r_nom LIKE 'gestionnaire'
;


INSERT IGNORE fichierappli (f_id_proprio, f_nom, f_url, f_visible_awe)
SELECT ut_id, 'MariaDB exemple','2E3GME58D',1 FROM utilisateur WHERE ut_login LIKE 'AWE'
;
INSERT IGNORE fichierappli (f_id_proprio, f_nom, f_url, f_visible_awe)
SELECT ut_id, 'PostgreSQL exemple','2E5CQKJ2U',1 FROM utilisateur WHERE ut_login LIKE 'AWE'
;
INSERT IGNORE fichierappli (f_id_proprio, f_nom, f_url, f_visible_awe)
SELECT ut_id, 'CSV exemple','2E6UBUUT8',1 FROM utilisateur WHERE ut_login LIKE 'AWE'
;
INSERT IGNORE fichierappli (f_id_proprio, f_nom, f_url, f_visible_awe)
SELECT ut_id, 'Access exemple','2E5MMRQK9',1 FROM utilisateur WHERE ut_login LIKE 'AWE'
;
INSERT IGNORE fichierappli (f_id_proprio, f_nom, f_url, f_visible_awe)
SELECT ut_id, 'REST exemple','2E6SRTGQJ',1 FROM utilisateur WHERE ut_login LIKE 'AWE'
;

