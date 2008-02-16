ALTER TABLE `reg_agent` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER last_updated;
ALTER TABLE `reg_agent` MODIFY COLUMN `country` CHAR(3) COLLATE utf8_general_ci DEFAULT NULL;
ALTER TABLE `reg_agent` MODIFY COLUMN `state` CHAR(2) COLLATE utf8_general_ci DEFAULT NULL;

ALTER TABLE `reg_user` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER last_updated ;
ALTER TABLE `reg_user` ADD INDEX `id` (`id`, `created_at`);

ALTER TABLE `reg_agent_has_user` ADD COLUMN `created_at` DATETIME DEFAULT NULL FIRST;
ALTER TABLE `reg_agent_has_user` ADD COLUMN `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER created_at;
ALTER TABLE `reg_agent_has_user` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER updated_at;

ALTER TABLE `reg_agent_has_user` MODIFY COLUMN `is_admin_for` TINYINT(1) DEFAULT '1';
ALTER TABLE `reg_agent_has_user` MODIFY COLUMN `user_id` INTEGER(11) NOT NULL DEFAULT '0';

ALTER TABLE `reg_agent_has_user` ADD UNIQUE `user_agent_id` (`user_id`, `agent_id`);

/* step 2 */

UPDATE
  reg_agent_has_user
  INNER JOIN reg_agent ON (reg_agent.id = reg_agent_has_user.agent_id)
  INNER JOIN reg_user  ON (reg_agent_has_user.user_id = reg_user.id)

SET
  reg_agent_has_user.created_at = reg_agent.created_at,
  reg_agent_has_user.updated_at = reg_user.created_at
 ;

/* step 3 */

ALTER TABLE `reg_vocabulary` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER created_at ;

ALTER TABLE `reg_vocabulary` ADD COLUMN `status_id` INTEGER(11) NOT NULL DEFAULT '1' COMMENT 'This will be the default status id for all concept properties for this vocabulary' AFTER last_uri_id;

ALTER TABLE `reg_vocabulary` ADD COLUMN `language` CHAR(6) COLLATE utf8_general_ci NOT NULL DEFAULT 'en' COMMENT 'This is the default language for all concept properties' AFTER status_id;

ALTER TABLE `reg_vocabulary` ADD COLUMN `created_user_id` INTEGER(11) DEFAULT NULL AFTER last_updated;

ALTER TABLE `reg_vocabulary` ADD COLUMN `updated_user_id` INTEGER(11) DEFAULT NULL AFTER created_user_id;

ALTER TABLE `reg_vocabulary` ADD COLUMN `child_updated_at` DATETIME DEFAULT NULL AFTER updated_user_id;

ALTER TABLE `reg_vocabulary` ADD COLUMN `child_updated_user_id` INTEGER(11) DEFAULT NULL AFTER child_updated_at;

ALTER TABLE `reg_vocabulary` MODIFY COLUMN `last_uri_id` INTEGER(11) DEFAULT '1000';

ALTER TABLE `reg_vocabulary` MODIFY COLUMN `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `reg_vocabulary` MODIFY COLUMN `created_at` DATETIME DEFAULT NULL;

ALTER TABLE `reg_vocabulary` ADD CONSTRAINT `vocabulary_status_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`);

ALTER TABLE `reg_vocabulary` ADD CONSTRAINT `reg_vocabulary_FK_2` FOREIGN KEY (`child_updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `reg_vocabulary` ADD CONSTRAINT `reg_vocabulary_FK_1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `reg_vocabulary` ADD CONSTRAINT `reg_vocabulary_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `reg_vocabulary_has_user` ADD COLUMN `created_at` DATETIME DEFAULT NULL FIRST;

ALTER TABLE `reg_vocabulary_has_user` ADD COLUMN `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER created_at;

ALTER TABLE `reg_vocabulary_has_user` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER updated_at;

ALTER TABLE `reg_vocabulary_has_user` MODIFY COLUMN `user_id` INTEGER(11) NOT NULL DEFAULT '0';

ALTER TABLE `reg_vocabulary_has_user` MODIFY COLUMN `vocabulary_id` INTEGER(11) NOT NULL DEFAULT '0';

ALTER TABLE `reg_vocabulary_has_user` ADD UNIQUE `resource_user_id` (`vocabulary_id`, `user_id`);



/* step 4 */

UPDATE
  reg_vocabulary_has_user
  INNER JOIN reg_vocabulary ON (reg_vocabulary.id = reg_vocabulary_has_user.vocabulary_id)
  INNER JOIN reg_user  ON (reg_vocabulary_has_user.user_id = reg_user.id)

SET
  reg_vocabulary_has_user.created_at = reg_vocabulary.created_at,
  reg_vocabulary_has_user.updated_at = reg_user.created_at
 ;

/* step 5 */

UPDATE
  `reg_vocabulary` `v`, `reg_vocabulary_has_user` `vu`
SET
  `v`.`updated_user_id` = `vu`.`user_id`,
  `v`.`created_user_id` = `vu`.`user_id`

WHERE
  `v`.`id` = `vu`.`vocabulary_id`
;

/* step 6 */

ALTER TABLE `reg_concept` MODIFY COLUMN `last_updated` DATETIME DEFAULT NULL;

ALTER TABLE `reg_concept` ADD COLUMN `language` CHAR(6) COLLATE utf8_general_ci NOT NULL DEFAULT 'en' AFTER status_id;

ALTER TABLE `reg_concept` ADD COLUMN `pref_label_id` INTEGER(11) DEFAULT NULL AFTER is_top_concept;

ALTER TABLE `reg_concept` ADD COLUMN `created_user_id` INTEGER(11) DEFAULT NULL AFTER last_updated;

ALTER TABLE `reg_concept` ADD COLUMN `updated_user_id` INTEGER(11) DEFAULT NULL after created_user_id;

ALTER TABLE `reg_concept` ADD COLUMN `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER created_at;

ALTER TABLE `reg_concept` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER updated_at;

ALTER TABLE `reg_concept` MODIFY COLUMN `status_id` INTEGER(11) NOT NULL DEFAULT '1';

ALTER TABLE `reg_concept` MODIFY COLUMN `pref_label` VARCHAR(255) COLLATE utf8_general_ci NOT NULL DEFAULT '';

ALTER TABLE `reg_concept` MODIFY COLUMN `is_top_concept` INTEGER(1) DEFAULT NULL;

ALTER TABLE `reg_concept` MODIFY COLUMN `uri` VARCHAR(255) COLLATE utf8_general_ci NOT NULL DEFAULT '';

ALTER TABLE `reg_concept` MODIFY COLUMN `last_updated` DATETIME DEFAULT NULL;

ALTER TABLE `reg_concept` ADD CONSTRAINT `reg_concept_FK_4` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `reg_concept` ADD CONSTRAINT `reg_concept_FK_3` FOREIGN KEY (`pref_label_id`) REFERENCES `reg_concept_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `reg_concept` ADD CONSTRAINT `reg_concept_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;



/* step 7 */

UPDATE
  reg_concept
  LEFT OUTER JOIN reg_vocabulary ON (reg_vocabulary.id = reg_concept.vocabulary_id)
  LEFT OUTER JOIN reg_vocabulary_has_user ON (reg_concept.vocabulary_id = reg_vocabulary_has_user.vocabulary_id)
SET
  reg_concept.status_id = reg_vocabulary.status_id,
  reg_concept.language = reg_vocabulary.language,
  reg_concept.updated_user_id = reg_vocabulary_has_user.user_id,
  reg_concept.created_user_id = reg_vocabulary_has_user.user_id,
  reg_concept.updated_at = reg_concept.last_updated
WHERE
  reg_vocabulary_has_user.is_registrar_for = 1
;
/* not every vocab has a registrar */
UPDATE
  reg_concept
  LEFT OUTER JOIN reg_vocabulary ON (reg_vocabulary.id = reg_concept.vocabulary_id)
  LEFT OUTER JOIN reg_vocabulary_has_user ON (reg_concept.vocabulary_id = reg_vocabulary_has_user.vocabulary_id)
SET
  reg_concept.status_id = reg_vocabulary.status_id,
  reg_concept.language = reg_vocabulary.language,
  reg_concept.updated_user_id = reg_vocabulary_has_user.user_id,
  reg_concept.created_user_id = reg_vocabulary_has_user.user_id,
  reg_concept.updated_at = reg_concept.last_updated
WHERE
  reg_vocabulary_has_user.is_maintainer_for = 1 AND
  reg_concept.updated_user_id IS NULL
;
/* this should fix up what's left */
UPDATE
  reg_concept
  LEFT OUTER JOIN reg_vocabulary ON (reg_vocabulary.id = reg_concept.vocabulary_id)
  LEFT OUTER JOIN reg_vocabulary_has_user ON (reg_concept.vocabulary_id = reg_vocabulary_has_user.vocabulary_id)
SET
  reg_concept.status_id = reg_vocabulary.status_id,
  reg_concept.language = reg_vocabulary.language,
  reg_concept.updated_user_id = reg_vocabulary_has_user.user_id,
  reg_concept.created_user_id = reg_vocabulary_has_user.user_id,
  reg_concept.updated_at = reg_concept.last_updated
WHERE
  reg_vocabulary_has_user.is_admin_for = 1 AND
  reg_concept.updated_user_id IS NULL
;
UPDATE
  reg_concept
  LEFT OUTER JOIN reg_concept_property ON (reg_concept.id = reg_concept_property.concept_id)
SET
  reg_concept.pref_label_id = reg_concept_property.id
WHERE
  reg_concept_property.skos_property_id = 19
;

/* step 8 */

ALTER TABLE `reg_concept_property` MODIFY COLUMN `last_updated` DATETIME DEFAULT NULL;

ALTER TABLE `reg_concept_property` ADD COLUMN `primary_pref_label` TINYINT(1) DEFAULT NULL AFTER concept_id;

ALTER TABLE `reg_concept_property` ADD COLUMN `created_user_id` INTEGER(11) DEFAULT NULL AFTER last_updated;

ALTER TABLE `reg_concept_property` ADD COLUMN `updated_user_id` INTEGER(11) DEFAULT NULL AFTER created_user_id;

ALTER TABLE `reg_concept_property` ADD COLUMN `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER created_at;

ALTER TABLE `reg_concept_property` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER updated_at;

ALTER TABLE `reg_concept_property` MODIFY COLUMN `status_id` INTEGER(11) DEFAULT '1';

ALTER TABLE `reg_concept_property` MODIFY COLUMN `language` CHAR(6) COLLATE utf8_general_ci DEFAULT 'en';

ALTER TABLE `reg_concept_property` MODIFY COLUMN `related_concept_id` INTEGER(11) DEFAULT NULL;

ALTER TABLE `reg_concept_property` MODIFY COLUMN `scheme_id` INTEGER(11) DEFAULT NULL;

ALTER TABLE `reg_concept_property` ADD CONSTRAINT `reg_concept_property_FK_1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `reg_concept_property` ADD CONSTRAINT `reg_concept_property_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;



/* step 9 */

UPDATE
  reg_concept_property
  RIGHT OUTER JOIN reg_concept ON (reg_concept.id = reg_concept_property.concept_id)
SET
  reg_concept_property.status_id = reg_concept.status_id,
  reg_concept_property.updated_user_id = reg_concept.updated_user_id,
  reg_concept_property.created_user_id = reg_concept.created_user_id,
  reg_concept_property.updated_at = reg_concept_property.last_updated
;
UPDATE
  reg_concept_property
SET
  reg_concept_property.primary_pref_label = 1
WHERE
  reg_concept_property.skos_property_id = 19
;


/* step 10 */

CREATE TABLE `reg_concept_property_history` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` ENUM('updated','added','deleted','force_deleted') DEFAULT NULL,
  `concept_property_id` INTEGER(11) DEFAULT NULL,
  `concept_id` INTEGER(11) DEFAULT NULL,
  `vocabulary_id` INTEGER(11) DEFAULT NULL,
  `skos_property_id` INTEGER(11) DEFAULT NULL,
  `object` TEXT COLLATE utf8_general_ci,
  `scheme_id` INTEGER(11) DEFAULT NULL COMMENT 'id of the related vocabulary when required',
  `related_concept_id` INTEGER(11) DEFAULT NULL COMMENT 'id of the related concept when required',
  `language` CHAR(6) COLLATE utf8_general_ci DEFAULT 'en' COMMENT 'This will be an RFC3066 language code, which means it can be en, eng, en-us, or eng-us -- iso639-1 (2-char codes), iso639-2 (3-char codes), and combined with iso3166 (2-char country codes)',
  `status_id` INTEGER(11) DEFAULT '1',
  `created_user_id` INTEGER(11) DEFAULT NULL COMMENT 'The ID of the user that created the property',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `concept_id` (`concept_id`),
  KEY `skos_property_id` (`skos_property_id`),
  KEY `scheme_id` (`scheme_id`),
  KEY `related_concept_id` (`related_concept_id`),
  KEY `status_id` (`status_id`),
  KEY `concept_property_id` (`concept_property_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  CONSTRAINT `reg_concept_property_fk1_new` FOREIGN KEY (`skos_property_id`) REFERENCES `reg_skos_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk2_new` FOREIGN KEY (`scheme_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk3_new` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk4_new` FOREIGN KEY (`related_concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_1` FOREIGN KEY (`concept_property_id`) REFERENCES `reg_concept_property` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_2` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_3` FOREIGN KEY (`concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION)
  ENGINE=InnoDB;


CREATE TABLE `reg_vocabulary_has_version` (
  `id` INTEGER(11) NOT NULL,
  `name` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `deleted_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  `created_user_id` INTEGER(11) DEFAULT NULL,
  `vocabulary_id` INTEGER(11) DEFAULT NULL,
  `concept_property_history_id` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `concept_property_history_id` (`concept_property_history_id`),
  CONSTRAINT `reg_vocabulary_has_version_FK_history` FOREIGN KEY (`concept_property_history_id`) REFERENCES `reg_concept_property_history` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_has_version_FK_user` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_has_version_FK_vocabulary` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION)
  ENGINE=InnoDB;



/* step 11 */

 INSERT INTO
  reg_concept_property_history
(
  created_at,
  action,
  concept_property_id,
  concept_id,
  vocabulary_id,
  skos_property_id,
  object,
  scheme_id,
  related_concept_id,
  language,
  status_id,
  created_user_id
)
SELECT
  reg_concept_property.created_at,
  'added',
  reg_concept_property.id,
  reg_concept_property.concept_id,
  reg_concept.vocabulary_id,
  reg_concept_property.skos_property_id,
  reg_concept_property.object,
  reg_concept_property.scheme_id,
  reg_concept_property.related_concept_id,
  reg_concept_property.language,
  reg_concept_property.status_id,
  reg_concept_property.created_user_id
FROM
  reg_concept_property
  LEFT OUTER JOIN reg_concept ON (reg_concept_property.concept_id = reg_concept.id)
  ;

/* step 12 */

UPDATE
  reg_concept_property
  LEFT OUTER JOIN reg_concept ON (reg_concept.id = reg_concept_property.concept_id)
  LEFT OUTER JOIN reg_vocabulary_has_user ON (reg_concept.vocabulary_id = reg_vocabulary_has_user.vocabulary_id)

SET
  reg_concept_property.updated_user_id = reg_vocabulary_has_user.user_id,
  reg_concept_property.created_user_id = reg_vocabulary_has_user.user_id

WHERE
  (reg_concept_property.updated_user_id IS NULL OR
  reg_concept_property.created_user_id IS NULL) AND
  reg_vocabulary_has_user.is_registrar_for = 1;

UPDATE
  reg_concept_property_history
  LEFT OUTER JOIN reg_vocabulary_has_user ON (reg_concept_property_history.vocabulary_id = reg_vocabulary_has_user.vocabulary_id)
SET
  reg_concept_property_history.created_user_id = reg_vocabulary_has_user.user_id

WHERE
  reg_concept_property_history.created_user_id IS NULL AND
  reg_vocabulary_has_user.is_registrar_for = 1;
;

UPDATE
  reg_concept
  LEFT OUTER JOIN reg_vocabulary_has_user ON (reg_concept.vocabulary_id = reg_vocabulary_has_user.vocabulary_id)
SET
  reg_concept.updated_user_id = reg_vocabulary_has_user.user_id,
  reg_concept.created_user_id = reg_vocabulary_has_user.user_id

WHERE
  reg_vocabulary_has_user.is_registrar_for = 1 AND
  (reg_concept.updated_user_id IS NULL OR
  reg_concept.created_user_id IS NULL)
;

ALTER TABLE `reg_vocabulary_has_user` DROP INDEX `user_id`;
ALTER TABLE `reg_vocabulary_has_user` DROP INDEX `resource_id`;

ALTER TABLE `reg_agent_has_user` DROP INDEX `agent_id`;
ALTER TABLE `reg_agent_has_user` DROP INDEX `user_id`;

/* step 13 */

ALTER TABLE `reg_vocabulary` ADD INDEX `child_updated_user_id` (`child_updated_user_id`);

ALTER TABLE `reg_vocabulary` ADD INDEX `created_user_id` (`created_user_id`);

ALTER TABLE `reg_vocabulary` ADD INDEX `last_updated_by_user_id` (`updated_user_id`);

ALTER TABLE `reg_vocabulary` ADD INDEX `status_id` (`status_id`);

ALTER TABLE `reg_concept_property` ADD INDEX `updated_user_id` (`updated_user_id`);

ALTER TABLE `reg_concept_property` ADD INDEX `created_user_id` (`created_user_id`);

ALTER TABLE `reg_concept` ADD INDEX `created_user_id` (`created_user_id`);

ALTER TABLE `reg_concept` ADD INDEX `last_updated_by_user_id` (`updated_user_id`);

ALTER TABLE `reg_concept` ADD INDEX `pref_label_id` (`pref_label_id`);
