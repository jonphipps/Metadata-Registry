
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- agent
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `agent`;


CREATE TABLE `agent`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
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
#-- agent_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `agent_user`;


CREATE TABLE `agent_user`
(
	`user_id` INTEGER default null NOT NULL,
	`agent_id` INTEGER default null NOT NULL,
	`is_registrar_for` TINYINT(1) default 1,
	`is_admin_for` TINYINT(1) default 1,
	PRIMARY KEY (`user_id`,`agent_id`),
	KEY `user_id`(`user_id`),
	KEY `agent_id`(`agent_id`),
	CONSTRAINT `agent_user_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `agent_user_FK_2`
		FOREIGN KEY (`agent_id`)
		REFERENCES `agent` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- concept
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `concept`;


CREATE TABLE `concept`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME default 'CURRENT_TIMESTAMP',
	`updated_at` DATETIME default '0000-00-00 00:00:00',
	`uri` VARCHAR(255) default 'null' NOT NULL,
	`pref_label` VARCHAR(255) default 'null' NOT NULL,
	`scheme_id` INTEGER,
	`is_top_concept` TINYINT,
	`status_id` INTEGER default 1,
	`user_id` INTEGER default null NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `vocabulary_id_pref_label` (`scheme_id`, `pref_label`),
	KEY `vocabulary_id`(`scheme_id`),
	KEY `pref_label`(`pref_label`),
	KEY `status_id`(`status_id`),
	KEY `concept_FI_3`(`user_id`),
	CONSTRAINT `concept_FK_1`
		FOREIGN KEY (`scheme_id`)
		REFERENCES `scheme` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_FK_2`
		FOREIGN KEY (`status_id`)
		REFERENCES `lookup` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- concept_property
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `concept_property`;


CREATE TABLE `concept_property`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME default 'null' NOT NULL,
	`updated_at` DATETIME default 'null' NOT NULL,
	`concept_id` INTEGER default null NOT NULL,
	`ontology_id` INTEGER default null NOT NULL,
	`object` TEXT  NOT NULL,
	`language` CHAR(6),
	`related_scheme_id` INTEGER,
	`related_concept_id` INTEGER,
	`createdby_user_id` INTEGER default null NOT NULL,
	`updatedby_user_id` INTEGER default null NOT NULL,
	`status_id` INTEGER default null NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`),
	KEY `concept_id`(`concept_id`),
	KEY `property_id`(`ontology_id`),
	KEY `scheme_id`(`related_scheme_id`),
	KEY `related_concept_id`(`related_concept_id`),
	KEY `status_id`(`status_id`),
	KEY `User_property_FK1`(`createdby_user_id`),
	KEY `User_property_FK2`(`updatedby_user_id`),
	CONSTRAINT `concept_property_FK_1`
		FOREIGN KEY (`concept_id`)
		REFERENCES `concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `concept_property_FK_2`
		FOREIGN KEY (`ontology_id`)
		REFERENCES `ontology` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_property_FK_3`
		FOREIGN KEY (`related_scheme_id`)
		REFERENCES `scheme` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_property_FK_4`
		FOREIGN KEY (`related_concept_id`)
		REFERENCES `concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `concept_property_FK_5`
		FOREIGN KEY (`createdby_user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_property_FK_6`
		FOREIGN KEY (`updatedby_user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_property_FK_7`
		FOREIGN KEY (`status_id`)
		REFERENCES `lookup` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- concept_scheme
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `concept_scheme`;


CREATE TABLE `concept_scheme`
(
	`created_at` DATETIME default 'CURRENT_TIMESTAMP',
	`concept_id` INTEGER,
	`scheme_id` INTEGER,
	`user_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `concept_id`(`concept_id`),
	KEY `scheme_id`(`scheme_id`),
	KEY `user_id`(`user_id`),
	CONSTRAINT `concept_scheme_FK_1`
		FOREIGN KEY (`concept_id`)
		REFERENCES `concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_scheme_FK_2`
		FOREIGN KEY (`scheme_id`)
		REFERENCES `scheme` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `concept_scheme_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- lookup
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `lookup`;


CREATE TABLE `lookup`
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
#-- namespace
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `namespace`;


CREATE TABLE `namespace`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`qname` VARCHAR(20),
	`uri` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- ontology
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ontology`;


CREATE TABLE `ontology`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER,
	`inverse_id` INTEGER,
	`name` VARCHAR(255) default 'null' NOT NULL,
	`uri` VARCHAR(255) default 'null' NOT NULL,
	`object_type` CHAR(1) default 'null' NOT NULL,
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
	`namespace_id` INTEGER default null NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`),
	UNIQUE KEY `name` (`name`),
	UNIQUE KEY `uri` (`uri`),
	KEY `namespace_id`(`namespace_id`),
	CONSTRAINT `ontology_FK_1`
		FOREIGN KEY (`namespace_id`)
		REFERENCES `namespace` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- scheme
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `scheme`;


CREATE TABLE `scheme`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME default 'CURRENT_TIMESTAMP',
	`updated_at` DATETIME default '0000-00-00 00:00:00',
	`agent_id` INTEGER,
	`name` VARCHAR(255),
	`note` TEXT,
	`uri` VARCHAR(255),
	`url` VARCHAR(255),
	`base_domain` VARCHAR(255),
	`token` VARCHAR(45),
	`community` VARCHAR(45),
	`last_uri_id` INTEGER default 1000,
	`default_language` CHAR(10),
	`default_status_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `agent_id`(`agent_id`),
	KEY `default_status_id`(`default_status_id`),
	CONSTRAINT `scheme_FK_1`
		FOREIGN KEY (`agent_id`)
		REFERENCES `agent` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `scheme_FK_2`
		FOREIGN KEY (`default_status_id`)
		REFERENCES `lookup` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- scheme_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `scheme_user`;


CREATE TABLE `scheme_user`
(
	`scheme_id` INTEGER default null NOT NULL,
	`user_id` INTEGER default null NOT NULL,
	`is_maintainer_for` TINYINT default 1,
	`is_registrar_for` TINYINT default 1,
	`is_admin_for` TINYINT default 1,
	PRIMARY KEY (`scheme_id`,`user_id`),
	KEY `resource_id`(`scheme_id`),
	KEY `user_id`(`user_id`),
	CONSTRAINT `scheme_user_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- schemeversion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `schemeversion`;


CREATE TABLE `schemeversion`
(
	`id` INTEGER default null NOT NULL,
	`created_at` DATETIME default 'CURRENT_TIMESTAMP',
	`scheme_id` INTEGER default null NOT NULL,
	`user_id` INTEGER default null NOT NULL,
	`version_label` CHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `ConceptVersion_AK2` (`created_at`),
	UNIQUE KEY `ConceptVersion_AK2_uc6` (`created_at`),
	UNIQUE KEY `created_at` (`created_at`),
	UNIQUE KEY `ConceptVersion_AK3` (`version_label`),
	UNIQUE KEY `ConceptVersion_AK3_uc7` (`version_label`),
	KEY `concept_ConceptVersion_FK1`(`scheme_id`),
	KEY `User_ConceptVersion_FK1`(`user_id`),
	CONSTRAINT `schemeversion_FK_1`
		FOREIGN KEY (`scheme_id`)
		REFERENCES `scheme` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `schemeversion_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- schemeversion_concept
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `schemeversion_concept`;


CREATE TABLE `schemeversion_concept`
(
	`schemeversion_id` INTEGER,
	`concept_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `schemeversion_id`(`schemeversion_id`),
	KEY `concept_id`(`concept_id`),
	CONSTRAINT `schemeversion_concept_FK_1`
		FOREIGN KEY (`schemeversion_id`)
		REFERENCES `schemeversion` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `schemeversion_concept_FK_2`
		FOREIGN KEY (`concept_id`)
		REFERENCES `concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME default 'CURRENT_TIMESTAMP',
	`updated_at` DATETIME default '0000-00-00 00:00:00',
	`nickname` VARCHAR(50),
	`salutation` VARCHAR(5),
	`first_name` VARCHAR(100),
	`last_name` VARCHAR(100),
	`email` VARCHAR(100),
	`password` VARCHAR(40),
	`sha1_password` VARCHAR(40),
	`salt` VARCHAR(32),
	`want_to_be_moderator` TINYINT default 0,
	`is_moderator` TINYINT default 0,
	`is_administrator` TINYINT default 0,
	`deletions` INTEGER default 0,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
