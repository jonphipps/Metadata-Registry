
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- arc_g2t
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_g2t`;


CREATE TABLE `arc_g2t`
(
	`g` SMALLINT default  NOT NULL,
	`t` SMALLINT default  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `gt` (`g`, `t`),
	KEY `arc_g2t_I_1`(`g`),
	KEY `arc_g2t_I_2`(`t`),
	KEY `tg`(`t`, `g`),
	CONSTRAINT `arc_g2t_FK_1`
		FOREIGN KEY (`g`)
		REFERENCES `arc_id2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_g2t_FK_2`
		FOREIGN KEY (`t`)
		REFERENCES `arc_triple` (`t`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_id2val
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_id2val`;


CREATE TABLE `arc_id2val`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`misc` TINYINT default 0 NOT NULL,
	`val` TEXT  NOT NULL,
	`val_type` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`, `val_type`),
	KEY `v`(`val`),
	KEY `id_2`(`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_o2val
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_o2val`;


CREATE TABLE `arc_o2val`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cid` SMALLINT default  NOT NULL,
	`misc` TINYINT default 0 NOT NULL,
	`val` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `arc_o2val_I_1`(`cid`),
	KEY `v`(`val`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_s2val
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_s2val`;


CREATE TABLE `arc_s2val`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cid` SMALLINT default  NOT NULL,
	`misc` TINYINT default 0 NOT NULL,
	`val` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `arc_s2val_I_1`(`cid`),
	KEY `v`(`val`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_setting
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_setting`;


CREATE TABLE `arc_setting`
(
	`k` CHAR(32) default '' NOT NULL,
	`val` TEXT  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `arc_setting_U_1` (`k`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_triple
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_triple`;


CREATE TABLE `arc_triple`
(
	`t` SMALLINT default  NOT NULL,
	`s` SMALLINT default  NOT NULL,
	`p` SMALLINT default  NOT NULL,
	`o` SMALLINT default  NOT NULL,
	`o_lang_dt` SMALLINT default  NOT NULL,
	`o_comp` CHAR(35) default '' NOT NULL,
	`s_type` TINYINT default 0 NOT NULL,
	`o_type` TINYINT default 0 NOT NULL,
	`misc` TINYINT default 0 NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `arc_triple_U_1` (`t`),
	KEY `arc_triple_I_1`(`s`),
	KEY `arc_triple_I_2`(`p`),
	KEY `arc_triple_I_3`(`o`),
	KEY `arc_triple_I_4`(`o_lang_dt`),
	KEY `arc_triple_I_5`(`misc`),
	KEY `spo`(`s`, `p`, `o`),
	KEY `os`(`o`, `s`),
	KEY `po`(`p`, `o`),
	CONSTRAINT `arc_triple_FK_1`
		FOREIGN KEY (`s`)
		REFERENCES `arc_s2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_triple_FK_2`
		FOREIGN KEY (`p`)
		REFERENCES `arc_id2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_triple_FK_3`
		FOREIGN KEY (`o`)
		REFERENCES `arc_o2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_triple_FK_4`
		FOREIGN KEY (`o_lang_dt`)
		REFERENCES `arc_id2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `profile`;


CREATE TABLE `profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`agent_id` INTEGER default  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_at` DATETIME,
	`created_by` INTEGER,
	`updated_by` INTEGER,
	`deleted_by` INTEGER,
	`child_updated_at` DATETIME,
	`child_updated_by` INTEGER,
	`name` VARCHAR(255) default '' NOT NULL,
	`note` TEXT,
	`uri` VARCHAR(255) default '' NOT NULL,
	`url` VARCHAR(255),
	`base_domain` VARCHAR(255) default '' NOT NULL,
	`token` VARCHAR(45) default '' NOT NULL,
	`community` VARCHAR(45),
	`last_uri_id` INTEGER default 100000,
	`status_id` INTEGER default 1 NOT NULL,
	`language` CHAR(6) default 'en' NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `profile_id` (`id`),
	KEY `profile_agent_id`(`agent_id`),
	KEY `profile_status_id`(`status_id`),
	KEY `profile_updated_by`(`updated_by`),
	KEY `profile_created_by`(`created_by`),
	KEY `profile_deleted_by`(`deleted_by`),
	KEY `profile_child_updated_by`(`child_updated_by`),
	CONSTRAINT `profile_FK_1`
		FOREIGN KEY (`agent_id`)
		REFERENCES `reg_agent` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `profile_FK_2`
		FOREIGN KEY (`created_by`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `profile_FK_3`
		FOREIGN KEY (`updated_by`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `profile_FK_4`
		FOREIGN KEY (`deleted_by`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `profile_FK_5`
		FOREIGN KEY (`child_updated_by`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `profile_FK_6`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- profile_property
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `profile_property`;


CREATE TABLE `profile_property`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`created_by` INTEGER,
	`updated_by` INTEGER,
	`deleted_by` INTEGER,
	`profile_id` INTEGER default  NOT NULL,
	`schema_id` INTEGER,
	`schema_property_id` INTEGER,
	`name` VARCHAR(255) default '' NOT NULL,
	`label` VARCHAR(255) default '' NOT NULL,
	`definition` TEXT,
	`comment` TEXT,
	`type` CHAR default '' NOT NULL,
	`uri` VARCHAR(255),
	`status_id` INTEGER default 1 NOT NULL,
	`language` VARCHAR(6) default 'en' NOT NULL,
	`note` TEXT,
	`display_order` INTEGER,
	`picklist_order` INTEGER,
	`examples` VARCHAR(255),
	`is_required` TINYINT default 0 NOT NULL,
	`is_reciprocal` TINYINT default 0 NOT NULL,
	`is_singleton` TINYINT default 0 NOT NULL,
	`is_in_picklist` TINYINT default 1 NOT NULL,
	`inverse_profile_property_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `profile_property_I_1`(`schema_id`),
	KEY `profile_property_I_2`(`schema_property_id`),
	KEY `profile_property_I_3`(`inverse_profile_property_id`),
	KEY `profile_property_agent_id`(`profile_id`),
	KEY `profile_property_status_id`(`status_id`),
	KEY `profile_property_updated_by`(`updated_by`),
	KEY `profile_property_created_by`(`created_by`),
	KEY `profile_property_deleted_by`(`deleted_by`),
	CONSTRAINT `profile_property_FK_1`
		FOREIGN KEY (`created_by`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `profile_property_FK_2`
		FOREIGN KEY (`updated_by`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `profile_property_FK_3`
		FOREIGN KEY (`deleted_by`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `profile_property_FK_4`
		FOREIGN KEY (`profile_id`)
		REFERENCES `profile` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `profile_property_FK_5`
		FOREIGN KEY (`schema_id`)
		REFERENCES `reg_schema` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `profile_property_FK_6`
		FOREIGN KEY (`schema_property_id`)
		REFERENCES `reg_schema_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `profile_property_FK_7`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `profile_property_FK_8`
		FOREIGN KEY (`inverse_profile_property_id`)
		REFERENCES `profile_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_agent
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_agent`;


CREATE TABLE `reg_agent`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`last_updated` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`org_email` VARCHAR(100) default '' NOT NULL,
	`org_name` VARCHAR(255) default '' NOT NULL,
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
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`updated_at` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`created_at` DATETIME,
	`user_id` INTEGER default 0 NOT NULL,
	`agent_id` INTEGER default 0 NOT NULL,
	`is_registrar_for` TINYINT default 1,
	`is_admin_for` TINYINT default 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_agent_id` (`user_id`, `agent_id`),
	UNIQUE KEY `agent_user_id` (`agent_id`, `user_id`),
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
	`updated_at` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`last_updated` DATETIME,
	`created_user_id` INTEGER,
	`updated_user_id` INTEGER,
	`uri` VARCHAR(255) default '' NOT NULL,
	`vocabulary_id` INTEGER,
	`is_top_concept` TINYINT,
	`pref_label_id` INTEGER,
	`pref_label` VARCHAR(255) default '' NOT NULL,
	`status_id` INTEGER default 1 NOT NULL,
	`language` CHAR(6) default 'en' NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `vocabulary_id_pref_label` (`vocabulary_id`, `pref_label`),
	KEY `reg_concept_I_1`(`created_user_id`),
	KEY `reg_concept_I_2`(`vocabulary_id`),
	KEY `reg_concept_I_3`(`pref_label_id`),
	KEY `reg_concept_I_4`(`pref_label`),
	KEY `reg_concept_I_5`(`status_id`),
	KEY `last_updated_by_user_id`(`updated_user_id`),
	CONSTRAINT `reg_concept_FK_1`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_FK_2`
		FOREIGN KEY (`updated_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_FK_3`
		FOREIGN KEY (`vocabulary_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_FK_4`
		FOREIGN KEY (`pref_label_id`)
		REFERENCES `reg_concept_property` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	CONSTRAINT `reg_concept_FK_5`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
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
	`updated_at` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`last_updated` DATETIME,
	`created_user_id` INTEGER,
	`updated_user_id` INTEGER,
	`concept_id` INTEGER default  NOT NULL,
	`primary_pref_label` TINYINT,
	`skos_property_id` INTEGER default  NOT NULL,
	`object` TEXT  NOT NULL,
	`scheme_id` INTEGER,
	`related_concept_id` INTEGER,
	`language` CHAR(6) default 'en',
	`status_id` INTEGER default 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `reg_concept_property_U_1` (`id`),
	KEY `reg_concept_property_I_1`(`created_user_id`),
	KEY `reg_concept_property_I_2`(`updated_user_id`),
	KEY `reg_concept_property_I_3`(`concept_id`),
	KEY `reg_concept_property_I_4`(`skos_property_id`),
	KEY `reg_concept_property_I_5`(`scheme_id`),
	KEY `reg_concept_property_I_6`(`related_concept_id`),
	KEY `reg_concept_property_I_7`(`status_id`),
	CONSTRAINT `reg_concept_property_FK_1`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_property_FK_2`
		FOREIGN KEY (`updated_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_property_FK_3`
		FOREIGN KEY (`concept_id`)
		REFERENCES `reg_concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_property_FK_4`
		FOREIGN KEY (`skos_property_id`)
		REFERENCES `reg_skos_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_concept_property_FK_5`
		FOREIGN KEY (`scheme_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_property_FK_6`
		FOREIGN KEY (`related_concept_id`)
		REFERENCES `reg_concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_concept_property_FK_7`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_concept_property_history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_concept_property_history`;


CREATE TABLE `reg_concept_property_history`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME  NOT NULL,
	`action` CHAR,
	`concept_property_id` INTEGER,
	`concept_id` INTEGER,
	`vocabulary_id` INTEGER,
	`skos_property_id` INTEGER,
	`object` TEXT,
	`scheme_id` INTEGER,
	`related_concept_id` INTEGER,
	`language` CHAR(6) default 'en',
	`status_id` INTEGER default 1,
	`created_user_id` INTEGER,
	`change_note` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `reg_concept_property_history_U_1` (`id`),
	KEY `reg_concept_property_history_I_1`(`concept_property_id`),
	KEY `reg_concept_property_history_I_2`(`concept_id`),
	KEY `reg_concept_property_history_I_3`(`vocabulary_id`),
	KEY `reg_concept_property_history_I_4`(`skos_property_id`),
	KEY `reg_concept_property_history_I_5`(`scheme_id`),
	KEY `reg_concept_property_history_I_6`(`related_concept_id`),
	KEY `reg_concept_property_history_I_7`(`status_id`),
	KEY `reg_concept_property_history_I_8`(`created_user_id`),
	CONSTRAINT `reg_concept_property_history_FK_1`
		FOREIGN KEY (`concept_property_id`)
		REFERENCES `reg_concept_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_property_history_FK_2`
		FOREIGN KEY (`concept_id`)
		REFERENCES `reg_concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_property_history_FK_3`
		FOREIGN KEY (`vocabulary_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_property_history_FK_4`
		FOREIGN KEY (`skos_property_id`)
		REFERENCES `reg_skos_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_concept_property_history_FK_5`
		FOREIGN KEY (`scheme_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_property_history_FK_6`
		FOREIGN KEY (`related_concept_id`)
		REFERENCES `reg_concept` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_concept_property_history_FK_7`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_concept_property_history_FK_8`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL
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
	UNIQUE KEY `reg_lookup_U_1` (`id`),
	KEY `display_order`(`type_id`, `display_order`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_namespace
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_namespace`;


CREATE TABLE `reg_namespace`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`schema_id` INTEGER default  NOT NULL,
	`created_at` DATETIME,
	`deleted_at` DATETIME,
	`created_user_id` INTEGER,
	`updated_user_id` INTEGER,
	`token` VARCHAR(255) default '' NOT NULL,
	`note` TEXT,
	`uri` VARCHAR(255) default '' NOT NULL,
	`schema_location` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `reg_namespace_I_1`(`schema_id`),
	CONSTRAINT `reg_namespace_FK_1`
		FOREIGN KEY (`schema_id`)
		REFERENCES `reg_schema` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_schema
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema`;


CREATE TABLE `reg_schema`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`agent_id` INTEGER default  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_at` DATETIME,
	`created_user_id` INTEGER,
	`updated_user_id` INTEGER,
	`child_updated_at` DATETIME,
	`child_updated_user_id` INTEGER,
	`name` VARCHAR(255) default '' NOT NULL,
	`note` TEXT,
	`uri` VARCHAR(255) default '' NOT NULL,
	`url` VARCHAR(255),
	`base_domain` VARCHAR(255) default '' NOT NULL,
	`token` VARCHAR(45) default '' NOT NULL,
	`community` VARCHAR(45),
	`last_uri_id` INTEGER default 100000,
	`status_id` INTEGER default 1 NOT NULL,
	`language` CHAR(6) default 'en' NOT NULL,
	`profile_id` INTEGER,
	`ns_type` CHAR default 'slash' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `reg_schema_I_1`(`agent_id`),
	KEY `reg_schema_I_2`(`created_user_id`),
	KEY `reg_schema_I_3`(`child_updated_user_id`),
	KEY `reg_schema_I_4`(`status_id`),
	KEY `reg_schema_I_5`(`profile_id`),
	KEY `last_updated_by_user_id`(`updated_user_id`),
	CONSTRAINT `reg_schema_FK_1`
		FOREIGN KEY (`agent_id`)
		REFERENCES `reg_agent` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_FK_2`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_schema_FK_3`
		FOREIGN KEY (`updated_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_schema_FK_4`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_FK_5`
		FOREIGN KEY (`profile_id`)
		REFERENCES `profile` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_schema_property
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema_property`;


CREATE TABLE `reg_schema_property`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`created_user_id` INTEGER,
	`updated_user_id` INTEGER,
	`schema_id` INTEGER default  NOT NULL,
	`name` VARCHAR(255) default '' NOT NULL,
	`label` VARCHAR(255) default '' NOT NULL,
	`definition` TEXT,
	`comment` TEXT,
	`type` CHAR default '' NOT NULL,
	`is_subproperty_of` INTEGER,
	`parent_uri` VARCHAR(255),
	`uri` VARCHAR(255) default '' NOT NULL,
	`status_id` INTEGER default 0 NOT NULL,
	`language` VARCHAR(6) default '' NOT NULL,
	`note` TEXT,
	`domain` VARCHAR(255),
	`range` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `reg_schema_property_I_1`(`created_user_id`),
	KEY `reg_schema_property_I_2`(`updated_user_id`),
	KEY `reg_schema_property_I_3`(`schema_id`),
	KEY `reg_schema_property_I_4`(`status_id`),
	KEY `subproperty_id`(`is_subproperty_of`),
	CONSTRAINT `reg_schema_property_FK_1`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_schema_property_FK_2`
		FOREIGN KEY (`updated_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_schema_property_FK_3`
		FOREIGN KEY (`schema_id`)
		REFERENCES `reg_schema` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_FK_4`
		FOREIGN KEY (`is_subproperty_of`)
		REFERENCES `reg_schema_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reg_schema_property_FK_5`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_schema_property_element
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema_property_element`;


CREATE TABLE `reg_schema_property_element`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`created_user_id` INTEGER,
	`updated_user_id` INTEGER,
	`schema_property_id` INTEGER default  NOT NULL,
	`profile_property_id` INTEGER default  NOT NULL,
	`is_schema_property` TINYINT,
	`object` TEXT  NOT NULL,
	`related_schema_property_id` INTEGER,
	`language` CHAR(6) default 'en',
	`status_id` INTEGER default 1,
	PRIMARY KEY (`id`),
	KEY `reg_schema_property_element_I_1`(`created_user_id`),
	KEY `reg_schema_property_element_I_2`(`updated_user_id`),
	KEY `reg_schema_property_element_I_3`(`schema_property_id`),
	KEY `reg_schema_property_element_I_4`(`profile_property_id`),
	KEY `reg_schema_property_element_I_5`(`status_id`),
	KEY `related_property_id`(`related_schema_property_id`),
	CONSTRAINT `reg_schema_property_element_FK_1`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_FK_2`
		FOREIGN KEY (`updated_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_FK_3`
		FOREIGN KEY (`schema_property_id`)
		REFERENCES `reg_schema_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_FK_4`
		FOREIGN KEY (`profile_property_id`)
		REFERENCES `profile_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_FK_5`
		FOREIGN KEY (`related_schema_property_id`)
		REFERENCES `reg_schema_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_FK_6`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_schema_property_element_history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema_property_element_history`;


CREATE TABLE `reg_schema_property_element_history`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME  NOT NULL,
	`created_user_id` INTEGER,
	`action` CHAR,
	`schema_property_element_id` INTEGER,
	`schema_property_id` INTEGER,
	`schema_id` INTEGER,
	`profile_property_id` INTEGER,
	`object` TEXT,
	`related_schema_property_id` INTEGER,
	`language` CHAR(6) default 'en',
	`status_id` INTEGER default 1,
	`change_note` TEXT,
	PRIMARY KEY (`id`),
	KEY `reg_schema_property_element_history_I_1`(`created_user_id`),
	KEY `reg_schema_property_element_history_I_2`(`schema_property_element_id`),
	KEY `reg_schema_property_element_history_I_3`(`schema_property_id`),
	KEY `reg_schema_property_element_history_I_4`(`schema_id`),
	KEY `reg_schema_property_element_history_I_5`(`profile_property_id`),
	KEY `reg_schema_property_element_history_I_6`(`related_schema_property_id`),
	KEY `reg_schema_property_element_history_I_7`(`status_id`),
	CONSTRAINT `reg_schema_property_element_history_FK_1`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_history_FK_2`
		FOREIGN KEY (`schema_property_element_id`)
		REFERENCES `reg_schema_property_element` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_history_FK_3`
		FOREIGN KEY (`schema_property_id`)
		REFERENCES `reg_schema_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_history_FK_4`
		FOREIGN KEY (`schema_id`)
		REFERENCES `reg_schema` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_history_FK_5`
		FOREIGN KEY (`profile_property_id`)
		REFERENCES `profile_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_history_FK_6`
		FOREIGN KEY (`related_schema_property_id`)
		REFERENCES `reg_schema_property` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_schema_property_element_history_FK_7`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
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
	`name` VARCHAR(255) default '' NOT NULL,
	`uri` VARCHAR(255) default '' NOT NULL,
	`object_type` CHAR default '' NOT NULL,
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
	UNIQUE KEY `reg_skos_property_U_1` (`id`),
	UNIQUE KEY `reg_skos_property_U_2` (`name`),
	UNIQUE KEY `reg_skos_property_U_3` (`uri`)
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
	`uri` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `reg_status_U_1` (`id`),
	KEY `reg_status_I_1`(`display_order`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_user`;


CREATE TABLE `reg_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`last_updated` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
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
	PRIMARY KEY (`id`),
	KEY `id`(`id`, `created_at`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_vocabulary
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary`;


CREATE TABLE `reg_vocabulary`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`agent_id` INTEGER default  NOT NULL,
	`created_at` DATETIME,
	`deleted_at` DATETIME,
	`last_updated` DATETIME  NOT NULL,
	`created_user_id` INTEGER,
	`updated_user_id` INTEGER,
	`child_updated_at` DATETIME,
	`child_updated_user_id` INTEGER,
	`name` VARCHAR(255) default '' NOT NULL,
	`note` TEXT,
	`uri` VARCHAR(255) default '' NOT NULL,
	`url` VARCHAR(255),
	`base_domain` VARCHAR(255) default '' NOT NULL,
	`token` VARCHAR(45) default '' NOT NULL,
	`community` VARCHAR(45),
	`last_uri_id` INTEGER default 1000,
	`status_id` INTEGER default 1 NOT NULL,
	`language` CHAR(6) default 'en' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `reg_vocabulary_I_1`(`agent_id`),
	KEY `reg_vocabulary_I_2`(`created_user_id`),
	KEY `reg_vocabulary_I_3`(`child_updated_user_id`),
	KEY `reg_vocabulary_I_4`(`status_id`),
	KEY `last_updated_by_user_id`(`updated_user_id`),
	CONSTRAINT `reg_vocabulary_FK_1`
		FOREIGN KEY (`agent_id`)
		REFERENCES `reg_agent` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `reg_vocabulary_FK_2`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_vocabulary_FK_3`
		FOREIGN KEY (`updated_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_vocabulary_FK_4`
		FOREIGN KEY (`child_updated_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_vocabulary_FK_5`
		FOREIGN KEY (`status_id`)
		REFERENCES `reg_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reg_vocabulary_has_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary_has_user`;


CREATE TABLE `reg_vocabulary_has_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME  NOT NULL,
	`deleted_at` DATETIME,
	`vocabulary_id` INTEGER default 0 NOT NULL,
	`user_id` INTEGER default 0 NOT NULL,
	`is_maintainer_for` TINYINT default 1,
	`is_registrar_for` TINYINT default 1,
	`is_admin_for` TINYINT default 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `resource_user_id` (`vocabulary_id`, `user_id`),
	UNIQUE KEY `user_resource_id` (`user_id`, `vocabulary_id`),
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

#-----------------------------------------------------------------------------
#-- reg_vocabulary_has_version
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary_has_version`;


CREATE TABLE `reg_vocabulary_has_version`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '' NOT NULL,
	`created_at` DATETIME,
	`deleted_at` DATETIME,
	`updated_at` DATETIME,
	`created_user_id` INTEGER,
	`vocabulary_id` INTEGER,
	`timeslice` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `reg_vocabulary_has_version_U_1` (`id`),
	KEY `reg_vocabulary_has_version_I_1`(`name`),
	KEY `reg_vocabulary_has_version_I_2`(`created_user_id`),
	KEY `reg_vocabulary_has_version_I_3`(`vocabulary_id`),
	CONSTRAINT `reg_vocabulary_has_version_FK_1`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE SET NULL,
	CONSTRAINT `reg_vocabulary_has_version_FK_2`
		FOREIGN KEY (`vocabulary_id`)
		REFERENCES `reg_vocabulary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- schema_has_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `schema_has_user`;


CREATE TABLE `schema_has_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_at` DATETIME,
	`schema_id` INTEGER default 0 NOT NULL,
	`user_id` INTEGER default 0 NOT NULL,
	`is_maintainer_for` TINYINT default 1,
	`is_registrar_for` TINYINT default 1,
	`is_admin_for` TINYINT default 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `schema_has_user_U_1` (`id`),
	KEY `schema_has_user_I_1`(`schema_id`),
	KEY `schema_has_user_I_2`(`user_id`),
	CONSTRAINT `schema_has_user_FK_1`
		FOREIGN KEY (`schema_id`)
		REFERENCES `reg_schema` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `schema_has_user_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- schema_has_version
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `schema_has_version`;


CREATE TABLE `schema_has_version`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '' NOT NULL,
	`created_at` DATETIME,
	`deleted_at` DATETIME,
	`updated_at` DATETIME,
	`created_user_id` INTEGER,
	`schema_id` INTEGER,
	`timeslice` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `schema_has_version_U_1` (`id`),
	KEY `schema_has_version_I_1`(`created_user_id`),
	KEY `schema_has_version_I_2`(`schema_id`),
	CONSTRAINT `schema_has_version_FK_1`
		FOREIGN KEY (`created_user_id`)
		REFERENCES `reg_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `schema_has_version_FK_2`
		FOREIGN KEY (`schema_id`)
		REFERENCES `reg_schema` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
