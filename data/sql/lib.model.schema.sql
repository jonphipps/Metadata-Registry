
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- reg_agent
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_agent`;


CREATE TABLE `reg_agent`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`last_updated` DATETIME default 'CURRENT_TIMESTAMP',
	`org_email` VARCHAR(100) default 'null' NOT NULL,
	`org_name` VARCHAR(255) default 'null' NOT NULL,
	`ind_affiliation` VARCHAR(255),
	`ind_role` VARCHAR(45),
	`address1` VARCHAR(255),
	`address2` VARCHAR(255),
	`city` VARCHAR(45),
	`state` CHAR(2),
	`postal_code` VARCHAR(15),
	`country` CHAR(3),
	`phone` VARCHAR(45),
	`web_address` VARCHAR(255),
	`type` CHAR(15),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_agent_has_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_agent_has_user`;


CREATE TABLE `reg_agent_has_user`
(
	`user_id` INTEGER default null NOT NULL,
	`agent_id` INTEGER default 0 NOT NULL,
	`is_registrar_for` TINYINT default 1,
	`is_admin_for` TINYINT default 1,
	PRIMARY KEY (`user_id`,`agent_id`),
	KEY `user_id`(`user_id`),
	KEY `agent_id`(`agent_id`),
	CONSTRAINT `reg_agent_has_user_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_agent_has_user_FK_2`
		FOREIGN KEY (`agent_id`)
		REFERENCES `reg_agent` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_concept
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_concept`;


CREATE TABLE `reg_concept`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`last_updated` DATETIME default 'CURRENT_TIMESTAMP',
	`uri` VARCHAR(255) default 'null' NOT NULL,
	`pref_label` VARCHAR(255) default 'null' NOT NULL,
	`vocabulary_id` INTEGER,
	`is_top_concept` INTEGER,
	`status_id` INTEGER default 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `vocabulary_id_pref_label` (`vocabulary_id`, `pref_label`),
	KEY `vocabulary_id`(`vocabulary_id`),
	KEY `pref_label`(`pref_label`),
	KEY `status_id`(`status_id`),
	CONSTRAINT `reg_concept_FK_1`
		FOREIGN KEY (`vocabulary_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_FK_2`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_concept_history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_concept_history`;


CREATE TABLE `reg_concept_history`
(
	`sid` CHAR(32) default 'null' NOT NULL,
	`concept_property_id` INTEGER default null NOT NULL,
	`user_id` INTEGER default null NOT NULL,
	`changed_at` DATETIME default 'CURRENT_TIMESTAMP',
	`old_values` TEXT  NOT NULL,
	`new_values` TEXT  NOT NULL,
	PRIMARY KEY (`sid`,`concept_property_id`),
	KEY `user_id`(`user_id`),
	KEY `concept_property_id`(`concept_property_id`),
	CONSTRAINT `reg_concept_history_FK_1`
		FOREIGN KEY (`concept_property_id`)
		REFERENCES `reg_concept_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_concept_history_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_concept_property
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_concept_property`;


CREATE TABLE `reg_concept_property`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`last_updated` DATETIME default 'CURRENT_TIMESTAMP',
	`concept_id` INTEGER default null NOT NULL,
	`skos_property_id` INTEGER default null NOT NULL,
	`object` TEXT  NOT NULL,
	`scheme_id` INTEGER,
	`related_concept_id` INTEGER,
	`language` CHAR(6),
	`status_id` INTEGER,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`),
	KEY `concept_id`(`concept_id`),
	KEY `skos_property_id`(`skos_property_id`),
	KEY `scheme_id`(`scheme_id`),
	KEY `related_concept_id`(`related_concept_id`),
	KEY `status_id`(`status_id`),
	CONSTRAINT `reg_concept_property_FK_1`
		FOREIGN KEY (`concept_id`)
		REFERENCES `reg_concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_property_FK_2`
		FOREIGN KEY (`skos_property_id`)
		REFERENCES `reg_skos_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_concept_property_FK_3`
		FOREIGN KEY (`scheme_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_property_FK_4`
		FOREIGN KEY (`related_concept_id`)
		REFERENCES `reg_concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_property_FK_5`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_lookup` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_lookup
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_lookup`;


CREATE TABLE `reg_lookup`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type_id` INTEGER,
	`short_value` CHAR(20),
	`long_value` VARCHAR(255),
	`display_order` INTEGER,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`),
	KEY `display_order`(`type_id`, `display_order`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_skos_property
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_skos_property`;


CREATE TABLE `reg_skos_property`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER,
	`inverse_id` INTEGER,
	`name` VARCHAR(255) default 'null' NOT NULL,
	`uri` VARCHAR(255) default 'null' NOT NULL,
	`object_type` CHAR default 'null' NOT NULL,
	`display_order` INTEGER,
	`picklist_order` INTEGER,
	`label` VARCHAR(255),
	`definition` TEXT,
	`comment` TEXT,
	`examples` VARCHAR(255),
	`is_required` TINYINT default 0 NOT NULL,
	`is_reciprocal` TINYINT default 0 NOT NULL,
	`is_singleton` TINYINT default 0 NOT NULL,
	`is_scheme` TINYINT default 0 NOT NULL,
	`is_in_picklist` TINYINT default 1 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`),
	UNIQUE KEY `name` (`name`),
	UNIQUE KEY `uri` (`uri`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_status`;


CREATE TABLE `reg_status`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`display_order` INTEGER,
	`display_name` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`),
	KEY `display_order`(`display_order`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_user`;


CREATE TABLE `reg_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`last_updated` DATETIME default 'CURRENT_TIMESTAMP',
	`nickname` VARCHAR(50),
	`salutation` VARCHAR(5),
	`first_name` VARCHAR(100),
	`last_name` VARCHAR(100),
	`email` VARCHAR(100),
	`sha1_password` VARCHAR(40),
	`salt` VARCHAR(32),
	`want_to_be_moderator` TINYINT default 0,
	`is_moderator` TINYINT default 0,
	`is_administrator` TINYINT default 0,
	`deletions` INTEGER default 0,
	`password` VARCHAR(40),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_vocabulary
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary`;


CREATE TABLE `reg_vocabulary`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`agent_id` INTEGER,
	`created_at` DATETIME default 'null' NOT NULL,
	`last_updated` DATETIME default 'CURRENT_TIMESTAMP',
	`name` VARCHAR(255),
	`note` TEXT,
	`uri` VARCHAR(255),
	`url` VARCHAR(255),
	`base_domain` VARCHAR(255),
	`token` VARCHAR(45),
	`community` VARCHAR(45),
	`last_uri_id` INTEGER default 1000,
	PRIMARY KEY (`id`),
	KEY `agent_id`(`agent_id`),
	CONSTRAINT `reg_vocabulary_FK_1`
		FOREIGN KEY (`agent_id`)
		REFERENCES `reg_agent` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_vocabulary_has_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary_has_user`;


CREATE TABLE `reg_vocabulary_has_user`
(
	`vocabulary_id` INTEGER default null NOT NULL,
	`user_id` INTEGER default null NOT NULL,
	`is_maintainer_for` TINYINT default 1,
	`is_registrar_for` TINYINT default 1,
	`is_admin_for` TINYINT default 1,
	PRIMARY KEY (`vocabulary_id`,`user_id`),
	KEY `resource_id`(`vocabulary_id`),
	KEY `user_id`(`user_id`),
	CONSTRAINT `reg_vocabulary_has_user_FK_1`
		FOREIGN KEY (`vocabulary_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_vocabulary_has_user_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
