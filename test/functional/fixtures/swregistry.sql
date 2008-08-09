SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `reg_agent` table : 
#

DROP TABLE IF EXISTS `reg_agent`;

CREATE TABLE `reg_agent` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `org_email` varchar(100) NOT NULL default '',
  `org_name` varchar(255) NOT NULL default '',
  `ind_affiliation` varchar(255) default NULL,
  `ind_role` varchar(45) default NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `city` varchar(45) default NULL,
  `state` char(2) default NULL,
  `postal_code` varchar(15) default NULL,
  `country` char(3) default NULL,
  `phone` varchar(45) default NULL,
  `web_address` varchar(255) default NULL,
  `type` char(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Structure for the `reg_status` table : 
#

DROP TABLE IF EXISTS `reg_status`;

CREATE TABLE `reg_status` (
  `id` int(11) NOT NULL auto_increment,
  `display_order` int(11) default NULL,
  `display_name` varchar(255) default NULL,
  `uri` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Structure for the `reg_user` table : 
#

DROP TABLE IF EXISTS `reg_user`;

CREATE TABLE `reg_user` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `nickname` varchar(50) default NULL,
  `salutation` varchar(5) default NULL,
  `first_name` varchar(100) default NULL,
  `last_name` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `sha1_password` varchar(40) default NULL,
  `salt` varchar(32) default NULL,
  `want_to_be_moderator` tinyint(1) default '0',
  `is_moderator` tinyint(1) default '0',
  `is_administrator` tinyint(1) default '0',
  `deletions` int(11) default '0',
  `password` varchar(40) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Structure for the `profile` table : 
#

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id` int(11) NOT NULL auto_increment,
  `agent_id` int(11) NOT NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `deleted_at` datetime default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `deleted_by` int(11) default NULL,
  `child_updated_at` datetime default NULL,
  `child_updated_by` int(11) default NULL,
  `name` varchar(255) NOT NULL default '',
  `note` text,
  `uri` varchar(255) NOT NULL default '',
  `url` varchar(255) default NULL,
  `base_domain` varchar(255) NOT NULL default '',
  `token` varchar(45) NOT NULL default '',
  `community` varchar(45) default NULL,
  `last_uri_id` int(11) default '100000',
  `status_id` int(11) NOT NULL default '1',
  `language` char(6) NOT NULL default 'en',
  UNIQUE KEY `profile_id` (`id`),
  KEY `profile_agent_id` (`agent_id`),
  KEY `profile_status_id` (`status_id`),
  KEY `profile_updated_by` (`updated_by`),
  KEY `profile_created_by` (`created_by`),
  KEY `profile_deleted_by` (`deleted_by`),
  KEY `profile_child_updated_by` (`child_updated_by`),
  CONSTRAINT `profile_agent_FK` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `profile_status_FK` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`),
  CONSTRAINT `profile_user_FK_1` FOREIGN KEY (`updated_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `profile_user_FK_2` FOREIGN KEY (`created_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `profile_user_FK_3` FOREIGN KEY (`deleted_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `profile_user_FK_4` FOREIGN KEY (`child_updated_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Structure for the `reg_schema` table : 
#

DROP TABLE IF EXISTS `reg_schema`;

CREATE TABLE `reg_schema` (
  `id` int(11) NOT NULL auto_increment,
  `agent_id` int(11) NOT NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `deleted_at` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `updated_user_id` int(11) default NULL,
  `child_updated_at` datetime default NULL,
  `child_updated_user_id` int(11) default NULL,
  `name` varchar(255) NOT NULL default '',
  `note` text,
  `uri` varchar(255) NOT NULL default '',
  `url` varchar(255) default NULL,
  `base_domain` varchar(255) NOT NULL default '',
  `token` varchar(45) NOT NULL default '',
  `community` varchar(45) default NULL,
  `last_uri_id` int(11) default '100000',
  `status_id` int(11) NOT NULL default '1',
  `language` char(6) NOT NULL default 'en',
  `profile_id` int(11) default NULL,
  UNIQUE KEY `id` (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `status_id` (`status_id`),
  KEY `last_updated_by_user_id` (`updated_user_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `child_updated_user_id` (`child_updated_user_id`),
  KEY `profile_id` (`profile_id`),
  CONSTRAINT `schema_agent_fk` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `schema_FK_user_1` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `schema_FK_user_2` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `schema_profile_fk` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `schema_status_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_schema_property` table : 
#

DROP TABLE IF EXISTS `reg_schema_property`;

CREATE TABLE `reg_schema_property` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `updated_user_id` int(11) default NULL,
  `schema_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL default '',
  `label` varchar(255) NOT NULL,
  `definition` text,
  `comment` text,
  `type` enum('property','subproperty','class','subclass') NOT NULL,
  `is_subproperty_of` int(11) default NULL,
  `parent_uri` varchar(255),
  `uri` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL default '0',
  `language` varchar(6) NOT NULL default '',
  `note` text,
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  KEY `schema_id` (`schema_id`),
  KEY `subproperty_id` (`is_subproperty_of`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `reg_schema_property_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk2` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk3` FOREIGN KEY (`is_subproperty_of`) REFERENCES `reg_schema_property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk4` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#
# Structure for the `profile_property` table : 
#

DROP TABLE IF EXISTS `profile_property`;

CREATE TABLE `profile_property` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `deleted_by` int(11) default NULL,
  `profile_id` int(11) NOT NULL,
  `schema_id` int(11) default NULL,
  `schema_property_id` int(11) default NULL,
  `name` varchar(255) NOT NULL default '',
  `label` varchar(255) NOT NULL default '',
  `definition` text,
  `comment` text,
  `type` enum('property','subproperty') NOT NULL,
  `uri` varchar(255) default NULL,
  `status_id` int(11) NOT NULL default '1',
  `language` varchar(6) NOT NULL default 'en',
  `note` text,
  `display_order` int(11) default NULL COMMENT 'Display order of properties',
  `picklist_order` int(11) default NULL,
  `examples` varchar(255) default NULL COMMENT 'Link to example usage',
  `is_required` tinyint(1) NOT NULL default '0' COMMENT 'boolean -- id this value required',
  `is_reciprocal` tinyint(1) NOT NULL default '0' COMMENT 'boolean - subject and object must both have this property',
  `is_singleton` tinyint(1) NOT NULL default '0' COMMENT 'boolean -- is this property allowed to repeat for a concept',
  `is_in_picklist` tinyint(1) NOT NULL default '1' COMMENT 'boolean - is in the property picklist',
  `inverse_profile_property_id` int(11) default NULL COMMENT 'id of the inverse property',
  UNIQUE KEY `profile_id` (`id`),
  KEY `profile_property_agent_id` (`profile_id`),
  KEY `profile_property_status_id` (`status_id`),
  KEY `profile_property_updated_by` (`updated_by`),
  KEY `profile_property_created_by` (`created_by`),
  KEY `profile_property_deleted_by` (`deleted_by`),
  KEY `inverse_profile_property_id` (`inverse_profile_property_id`),
  KEY `schema_id` (`schema_id`),
  KEY `schema_property_id` (`schema_property_id`),
  CONSTRAINT `profile_property_agent_FK` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_fk` FOREIGN KEY (`inverse_profile_property_id`) REFERENCES `profile_property` (`id`),
  CONSTRAINT `profile_property_schema` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_schema_property` FOREIGN KEY (`schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_status_FK` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`),
  CONSTRAINT `profile_property_user_FK_1` FOREIGN KEY (`updated_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_user_FK_2` FOREIGN KEY (`created_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_user_FK_3` FOREIGN KEY (`deleted_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Structure for the `reg_agent_has_user` table : 
#

DROP TABLE IF EXISTS `reg_agent_has_user`;

CREATE TABLE `reg_agent_has_user` (
  `id` int(11) NOT NULL auto_increment,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `created_at` datetime default NULL,
  `user_id` int(11) NOT NULL default '0',
  `agent_id` int(11) NOT NULL default '0',
  `is_registrar_for` tinyint(1) default '1',
  `is_admin_for` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_agent_id` USING BTREE (`user_id`,`agent_id`),
  UNIQUE KEY `agent_user_id` (`agent_id`,`user_id`),
  CONSTRAINT `reg_agent_has_user_fk` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_agent_has_user_fk1` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`user_id`) REFER `swregistry/reg_agents`';

#
# Structure for the `reg_vocabulary` table : 
#

DROP TABLE IF EXISTS `reg_vocabulary`;

CREATE TABLE `reg_vocabulary` (
  `id` int(11) NOT NULL auto_increment,
  `agent_id` int(11) NOT NULL,
  `created_at` datetime default NULL,
  `deleted_at` datetime default NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `created_user_id` int(11) default NULL,
  `updated_user_id` int(11) default NULL,
  `child_updated_at` datetime default NULL,
  `child_updated_user_id` int(11) default NULL,
  `name` varchar(255) NOT NULL default '',
  `note` text,
  `uri` varchar(255) NOT NULL default '',
  `url` varchar(255) default NULL,
  `base_domain` varchar(255) NOT NULL default '',
  `token` varchar(45) NOT NULL default '',
  `community` varchar(45) default NULL,
  `last_uri_id` int(11) default '1000',
  `status_id` int(11) NOT NULL default '1' COMMENT 'This will be the default status id for all concept properties for this vocabulary',
  `language` char(6) NOT NULL default 'en' COMMENT 'This is the default language for all concept properties',
  PRIMARY KEY  (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `status_id` (`status_id`),
  KEY `last_updated_by_user_id` (`updated_user_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `child_updated_user_id` (`child_updated_user_id`),
  CONSTRAINT `reg_vocabulary_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_FK_1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_FK_2` FOREIGN KEY (`child_updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `vocabulary_agent_fk` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `vocabulary_status_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_skos_property` table : 
#

DROP TABLE IF EXISTS `reg_skos_property`;

CREATE TABLE `reg_skos_property` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `inverse_id` int(11) default NULL COMMENT 'id of the inverse property',
  `name` varchar(255) NOT NULL COMMENT 'The name of the property',
  `uri` varchar(255) NOT NULL COMMENT 'The URI of the property',
  `object_type` enum('resource','literal') NOT NULL COMMENT 'the type of the object for which this is the predicate',
  `display_order` int(11) default NULL COMMENT 'Display order of properties',
  `picklist_order` int(11) default NULL,
  `label` varchar(255) default NULL COMMENT 'The pretty label for the property',
  `definition` text,
  `comment` text,
  `examples` varchar(255) default NULL COMMENT 'Link to example usage',
  `is_required` tinyint(1) NOT NULL default '0' COMMENT 'boolean -- id this value required',
  `is_reciprocal` tinyint(1) NOT NULL default '0' COMMENT 'boolean - subject and object must both have this property',
  `is_singleton` tinyint(1) NOT NULL default '0' COMMENT 'boolean -- is this property allowed to repeat for a concept',
  `is_scheme` tinyint(1) NOT NULL default '0' COMMENT 'boolean - is in conceptScheme domain',
  `is_in_picklist` tinyint(1) NOT NULL default '1' COMMENT 'boolean - is in the property picklist',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `uri` (`uri`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='Contains a list of available predicates for skos concepts co';

#
# Structure for the `reg_concept_property` table : 
#

DROP TABLE IF EXISTS `reg_concept_property`;

CREATE TABLE `reg_concept_property` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `last_updated` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `updated_user_id` int(11) default NULL,
  `concept_id` int(11) NOT NULL,
  `primary_pref_label` tinyint(1) default NULL,
  `skos_property_id` int(11) NOT NULL,
  `object` text NOT NULL,
  `scheme_id` int(11) default NULL,
  `related_concept_id` int(11) default NULL,
  `language` char(6) default 'en',
  `status_id` int(11) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `concept_id` (`concept_id`),
  KEY `skos_property_id` (`skos_property_id`),
  KEY `scheme_id` (`scheme_id`),
  KEY `related_concept_id` (`related_concept_id`),
  KEY `status_id` (`status_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  CONSTRAINT `reg_concept_property_fk` FOREIGN KEY (`concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk1` FOREIGN KEY (`skos_property_id`) REFERENCES `reg_skos_property` (`id`),
  CONSTRAINT `reg_concept_property_fk2` FOREIGN KEY (`scheme_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk3` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk4` FOREIGN KEY (`related_concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_FK_1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_concept` table : 
#

DROP TABLE IF EXISTS `reg_concept`;

CREATE TABLE `reg_concept` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `last_updated` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `updated_user_id` int(11) default NULL,
  `uri` varchar(255) NOT NULL default '',
  `vocabulary_id` int(11) default NULL,
  `is_top_concept` tinyint(1) default NULL,
  `pref_label_id` int(11) default NULL,
  `pref_label` varchar(255) NOT NULL default '',
  `status_id` int(11) NOT NULL default '1',
  `language` char(6) NOT NULL default 'en',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `vocabulary_id_pref_label` (`vocabulary_id`,`pref_label`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `pref_label` (`pref_label`),
  KEY `status_id` (`status_id`),
  KEY `pref_label_id` (`pref_label_id`),
  KEY `last_updated_by_user_id` (`updated_user_id`),
  KEY `created_user_id` (`created_user_id`),
  CONSTRAINT `concept_vocabulary_fk` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_FK_1` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`),
  CONSTRAINT `reg_concept_FK_3` FOREIGN KEY (`pref_label_id`) REFERENCES `reg_concept_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `reg_concept_FK_4` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_concept_property_history` table : 
#

DROP TABLE IF EXISTS `reg_concept_property_history`;

CREATE TABLE `reg_concept_property_history` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `action` enum('updated','added','deleted','force_deleted') default NULL,
  `concept_property_id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  `vocabulary_id` int(11) default NULL,
  `skos_property_id` int(11) default NULL,
  `object` text,
  `scheme_id` int(11) default NULL COMMENT 'id of the related vocabulary when required',
  `related_concept_id` int(11) default NULL COMMENT 'id of the related concept when required',
  `language` char(6) default 'en' COMMENT 'This will be an RFC3066 language code, which means it can be en, eng, en-us, or eng-us -- iso639-1 (2-char codes), iso639-2 (3-char codes), and combined with iso3166 (2-char country codes)',
  `status_id` int(11) default '1',
  `created_user_id` int(11) default NULL COMMENT 'The ID of the user that created the property',
  `change_note` text,
  PRIMARY KEY  (`id`),
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
  CONSTRAINT `reg_concept_property_history_FK_3` FOREIGN KEY (`concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_lookup` table : 
#

DROP TABLE IF EXISTS `reg_lookup`;

CREATE TABLE `reg_lookup` (
  `id` int(11) NOT NULL auto_increment,
  `type_id` int(11) default NULL COMMENT 'This will be the lookup type and will reference the list of lookup types stored in this very same table',
  `short_value` char(20) default NULL,
  `long_value` varchar(255) default NULL,
  `display_order` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `display_order` (`type_id`,`display_order`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Structure for the `reg_namespace` table : 
#

DROP TABLE IF EXISTS `reg_namespace`;

CREATE TABLE `reg_namespace` (
  `id` int(11) NOT NULL auto_increment,
  `schema_id` int(11) NOT NULL,
  `created_at` datetime default NULL,
  `deleted_at` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `updated_user_id` int(11) default NULL,
  `token` varchar(255) NOT NULL default '',
  `note` text,
  `uri` varchar(255) NOT NULL default '',
  `schema_location` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `schema_id` (`schema_id`),
  CONSTRAINT `reg_namespace_fk` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_schema_property_element` table : 
#

DROP TABLE IF EXISTS `reg_schema_property_element`;

CREATE TABLE `reg_schema_property_element` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `updated_user_id` int(11) default NULL,
  `schema_property_id` int(11) NOT NULL,
  `profile_property_id` int(11) NOT NULL,
  `is_schema_property` tinyint(1) default NULL,
  `object` text NOT NULL,
  `related_schema_property_id` int(11) default NULL,
  `language` char(6) default 'en',
  `status_id` int(11) default '1',
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  KEY `schema_property_id` (`schema_property_id`),
  KEY `related_property_id` (`related_schema_property_id`),
  KEY `status_id` (`status_id`),
  KEY `profile_property_id` (`profile_property_id`),
  CONSTRAINT `reg_schema_property_element_fk` FOREIGN KEY (`profile_property_id`) REFERENCES `profile_property` (`id`),
  CONSTRAINT `reg_schema_property_property_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk2` FOREIGN KEY (`schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk3` FOREIGN KEY (`related_schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk4` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_schema_property_element_history` table : 
#

DROP TABLE IF EXISTS `reg_schema_property_element_history`;

CREATE TABLE `reg_schema_property_element_history` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `created_user_id` int(11) default NULL,
  `action` enum('updated','added','deleted','force_deleted') default NULL,
  `schema_property_element_id` int(11) default NULL,
  `schema_property_id` int(11) default NULL,
  `schema_id` int(11) default NULL,
  `profile_property_id` int(11) default NULL,
  `object` text,
  `related_schema_property_id` int(11) default NULL,
  `language` char(6) default 'en',
  `status_id` int(11) default '1',
  `change_note` text,
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `schema_property_element_id` (`schema_property_element_id`),
  KEY `schema_property_id` (`schema_property_id`),
  KEY `schema_id` (`schema_id`),
  KEY `related_schema_property_id` (`related_schema_property_id`),
  KEY `status_id` (`status_id`),
  KEY `profile_property_id` (`profile_property_id`),
  CONSTRAINT `reg_schema_property_element_history_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk1` FOREIGN KEY (`schema_property_element_id`) REFERENCES `reg_schema_property_element` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk2` FOREIGN KEY (`schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk3` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk4` FOREIGN KEY (`related_schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk5` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk6` FOREIGN KEY (`profile_property_id`) REFERENCES `profile_property` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_vocabulary_has_user` table : 
#

DROP TABLE IF EXISTS `reg_vocabulary_has_user`;

CREATE TABLE `reg_vocabulary_has_user` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `deleted_at` datetime default NULL,
  `vocabulary_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `is_maintainer_for` tinyint(1) default '1',
  `is_registrar_for` tinyint(1) default '1',
  `is_admin_for` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `resource_user_id` USING BTREE (`vocabulary_id`,`user_id`),
  UNIQUE KEY `user_resource_id` (`user_id`,`vocabulary_id`),
  CONSTRAINT `reg_resource_has_user_fk1` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_has_user_fk` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`agent_id`) REFER `swregistry/reg_agent`';

#
# Structure for the `reg_vocabulary_has_version` table : 
#

DROP TABLE IF EXISTS `reg_vocabulary_has_version`;

CREATE TABLE `reg_vocabulary_has_version` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `created_at` datetime default NULL,
  `deleted_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `vocabulary_id` int(11) default NULL,
  `timeslice` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `name` (`name`),
  CONSTRAINT `reg_vocabulary_has_version_FK_user` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_has_version_FK_vocabulary` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `schema_has_user` table : 
#

DROP TABLE IF EXISTS `schema_has_user`;

CREATE TABLE `schema_has_user` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `deleted_at` datetime default NULL,
  `schema_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `is_maintainer_for` tinyint(1) default '1',
  `is_registrar_for` tinyint(1) default '1',
  `is_admin_for` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `schema_id` (`schema_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `schema_has_user_fk` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `schema_has_user_fk1` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `schema_has_version` table : 
#

DROP TABLE IF EXISTS `schema_has_version`;

CREATE TABLE `schema_has_version` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `created_at` datetime default NULL,
  `deleted_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `created_user_id` int(11) default NULL,
  `schema_id` int(11) default NULL,
  `timeslice` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `schema_id` (`schema_id`),
  CONSTRAINT `schema_has_version_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `schema_has_version_fk1` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for the `reg_agent` table  (LIMIT 0,500)
#

INSERT INTO `reg_agent` (`id`, `created_at`, `last_updated`, `deleted_at`, `org_email`, `org_name`, `ind_affiliation`, `ind_role`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `phone`, `web_address`, `type`) VALUES 
  (1,'2006-04-12 18:27:05','2006-07-06 19:14:01',NULL,'admin@example.com','Joe Admin','',NULL,'','','','NY','','','','','INDIVIDUAL');

COMMIT;

#
# Data for the `reg_status` table  (LIMIT 0,500)
#

INSERT INTO `reg_status` (`id`, `display_order`, `display_name`, `uri`) VALUES 
  (1,7,'Published','http://metadataregistry.org/uri/RegStatus/1001'),
  (2,1,'New-Proposed','http://metadataregistry.org/uri/RegStatus/1002'),
  (3,2,'Change-Proposed','http://metadataregistry.org/uri/RegStatus/1003'),
  (4,3,'Deprecate-Proposed','http://metadataregistry.org/uri/RegStatus/1004'),
  (5,4,'New-Under Review','http://metadataregistry.org/uri/RegStatus/1005'),
  (6,5,'Change-Under Review','http://metadataregistry.org/uri/RegStatus/1006'),
  (7,6,'Deprecate-Under Review','http://metadataregistry.org/uri/RegStatus/1007'),
  (8,8,'Deprecated','http://metadataregistry.org/uri/RegStatus/1008'),
  (9,9,'Not Approved','http://metadataregistry.org/uri/RegStatus/1009');

COMMIT;

#
# Data for the `reg_user` table  (LIMIT 0,500)
#

INSERT INTO `reg_user` (`id`, `created_at`, `last_updated`, `deleted_at`, `nickname`, `salutation`, `first_name`, `last_name`, `email`, `sha1_password`, `salt`, `want_to_be_moderator`, `is_moderator`, `is_administrator`, `deletions`, `password`) VALUES 
  (1,'2006-03-24 17:29:24','2007-06-04 11:04:28',NULL,'joeadmin',NULL,'Joe','Admin','admin@example.com','ad595c0e9bc6b0a9be194ad5bbcb2cd82eaee6ce','1d4c1324f5cacadf382702601d32c107',NULL,0,1,0,NULL);

COMMIT;

#
# Data for the `profile` table  (LIMIT 0,500)
#

INSERT INTO `profile` (`id`, `agent_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `child_updated_at`, `child_updated_by`, `name`, `note`, `uri`, `url`, `base_domain`, `token`, `community`, `last_uri_id`, `status_id`, `language`) VALUES 
  (1,1,'2008-04-20 11:52:00','2008-04-20 11:52:00',NULL,1,1,NULL,NULL,NULL,'Registry Schema',NULL,'http://registry/uri/profile/registryschema',NULL,'http://registry/uri/profile/registryschema','registryschema','100000',100000,1,'en');

COMMIT;

#
# Data for the `profile_property` table  (LIMIT 0,500)
#

INSERT INTO `profile_property` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `profile_id`, `name`, `label`, `definition`, `comment`, `type`, `uri`, `status_id`, `language`, `note`, `display_order`, `picklist_order`, `examples`, `is_required`, `is_reciprocal`, `is_singleton`, `is_in_picklist`, `inverse_profile_property_id`) VALUES 
  (1,'2008-04-20 12:00:00','2008-04-20 12:00:00',NULL,1,1,NULL,1,'name','name',NULL,NULL,'property','http://registry/uri/profile/registryschema',1,'en',NULL,1,1,NULL,1,0,1,1,NULL),
  (2,'2008-04-20 12:00:00','2008-04-20 12:00:00',NULL,1,1,NULL,1,'label','label',NULL,NULL,'property','http://registry/uri/profile/registryschema/100002',1,'en',NULL,2,2,NULL,1,0,-1,1,NULL),
  (3,'2008-04-20 12:01:00','2008-04-20 12:01:01',NULL,1,1,NULL,1,'definition','description',NULL,NULL,'property','http://registry/uri/profile/registryschema/100003',1,'en',NULL,3,3,NULL,0,0,0,1,NULL),
  (4,'2008-04-20 12:02:00','2008-04-20 12:02:00',NULL,1,1,NULL,1,'type','type',NULL,NULL,'property','http://registry/uri/profile/registryschema/100004',1,'en',NULL,5,5,NULL,1,0,1,1,NULL),
  (5,'2008-04-20 00:02:00','2008-04-20 00:02:02',NULL,1,1,NULL,1,'comment','comment',NULL,NULL,'property','http://registry/uri/profile/registryschema/10005',1,'en',NULL,4,4,NULL,0,0,0,1,NULL),
  (6,'2008-04-20 00:03:00','2008-04-20 12:03:00',NULL,1,1,NULL,1,'isSubpropertyOf','isSubpropertyOf',NULL,NULL,'property','http://registry/uri/profile/registryschema/100006',1,'en',NULL,6,6,NULL,0,1,0,1,NULL),
  (7,'2008-04-20 00:04:00','2008-04-20 00:04:00',NULL,1,1,NULL,1,'note','note',NULL,NULL,'property','http://registry/uri/profile/registryschema/10007',1,'en',NULL,8,8,NULL,0,0,0,1,NULL),
  (8,'2008-04-20 12:05:00','2008-04-20 12:05:00',NULL,1,1,NULL,1,'hasSubproperty','hasSubproperty',NULL,NULL,'property','http://registry/uri/profile/registryschema/100008',1,'en',NULL,7,7,NULL,0,1,0,1,NULL);

COMMIT;

#
# Data for the `reg_agent_has_user` table  (LIMIT 0,500)
#

INSERT INTO `reg_agent_has_user` (`id`, `updated_at`, `deleted_at`, `created_at`, `user_id`, `agent_id`, `is_registrar_for`, `is_admin_for`) VALUES 
  (1,'2008-01-23 16:09:28',NULL,'2008-01-23 16:09:28',1,1,1,1);

COMMIT;

#
# Data for the `reg_skos_property` table  (LIMIT 0,500)
#

INSERT INTO `reg_skos_property` (`id`, `parent_id`, `inverse_id`, `name`, `uri`, `object_type`, `display_order`, `picklist_order`, `label`, `definition`, `comment`, `examples`, `is_required`, `is_reciprocal`, `is_singleton`, `is_scheme`, `is_in_picklist`) VALUES 
  (1,27,NULL,'altLabel','http://www.w3.org/2004/02/skos/core#altLabel','literal',1,3,'alternative label','An alternative lexical label for a resource.','Acronyms, abbreviations, spelling variants, and irregular plural/singular forms may be included among the alternative labels for a concept. Mis-spelled terms are normally included as hidden labels (see skos:hiddenLabel).','http://www.w3.org/2004/02/skos/core/examples/altLabel.rdf.xml',0,0,0,0,1),
  (2,26,NULL,'altSymbol','http://www.w3.org/2004/02/skos/core#altSymbol','literal',2,NULL,'alternative symbolic label','An alternative symbolic label for a resource.',NULL,'http://www.w3.org/2004/02/skos/core/examples/altSymbol.rdf.xml',0,0,0,0,0),
  (3,NULL,16,'broader','http://www.w3.org/2004/02/skos/core#broader','resource',3,4,'has broader','A concept that is more general in meaning.','Broader concepts are typically rendered as parents in a concept hierarchy (tree).','http://www.w3.org/2004/02/skos/core/examples/broader.rdf.xml',0,0,0,0,1),
  (4,17,NULL,'changeNote','http://www.w3.org/2004/02/skos/core#changeNote','literal',4,8,'change note','A note about a modification to a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/changeNote.rdf.xml',0,0,0,0,1),
  (5,17,NULL,'definition','http://www.w3.org/2004/02/skos/core#definition','literal',NULL,2,'definition','A statement or formal explanation of the meaning of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/definition.rdf.xml',0,0,0,0,1),
  (6,17,NULL,'editorialNote','http://www.w3.org/2004/02/skos/core#editorialNote','literal',NULL,9,'editorial note','A note for an editor, translator or maintainer of the vocabulary.',NULL,'http://www.w3.org/2004/02/skos/core/examples/editorialNote.rdf.xml',0,0,0,0,1),
  (7,17,NULL,'example','http://www.w3.org/2004/02/skos/core#example','literal',NULL,10,'example','An example of the use of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/example.rdf.xml',0,0,0,0,1),
  (9,27,NULL,'hiddenLabel','http://www.w3.org/2004/02/skos/core#hiddenLabel','literal',NULL,12,'hidden label','A lexical label for a resource that should be hidden when generating visual displays of the resource, but should still be accessible to free text search operations.',NULL,'http://www.w3.org/2004/02/skos/core/examples/hiddenLabel.rdf.xml',0,0,0,0,1),
  (10,NULL,NULL,'historyNote','http://www.w3.org/2004/02/skos/core#historyNote','literal',NULL,11,'history note',NULL,'A note about the past state/use/meaning of a concept.','http://www.w3.org/2004/02/skos/core/examples/historyNote.rdf.xml',0,0,0,0,1),
  (11,NULL,NULL,'inScheme','http://www.w3.org/2004/02/skos/core#inScheme','resource',NULL,14,'in scheme','A concept scheme in which the concept is included.','A concept may be a member of more than one concept scheme.','http://www.w3.org/2004/02/skos/core/examples/inScheme.rdf.xml',1,0,0,0,1),
  (12,NULL,24,'isSubjectOf','http://www.w3.org/2004/02/skos/core#isSubjectOf','resource',NULL,NULL,'is subject of','A resource for which the concept is a subject.',NULL,'http://www.w3.org/2004/02/skos/core/examples/isSubjectOf.rdf.xml',0,0,0,0,0),
  (13,12,20,'isPrimarySubjectOf','http://www.w3.org/2004/02/skos/core#isPrimarySubjectOf','resource',NULL,NULL,'is primary subject of','A resource for which the concept is the primary subject.',NULL,NULL,0,0,0,0,0),
  (16,NULL,3,'narrower','http://www.w3.org/2004/02/skos/core#narrower','resource',NULL,5,'has narrower','A concept that is more specific in meaning.','Narrower concepts are typically rendered as children in a concept hierarchy (tree).','http://www.w3.org/2004/02/skos/core/examples/narrower.rdf.xml',0,0,0,0,1),
  (17,NULL,NULL,'note','http://www.w3.org/2004/02/skos/core#note','literal',NULL,13,'note','A general note, for any purpose.','This property may be used directly, or as a super-property for more specific note types.','http://www.w3.org/2004/02/skos/core/examples/note.rdf.xml',0,0,0,0,1),
  (18,26,NULL,'prefSymbol','http://www.w3.org/2004/02/skos/core#prefSymbol','literal',NULL,NULL,'preferred symbolic label','The preferred symbolic label for a resource.','No two concepts in the same concept scheme may have the same value for skos:prefSymbol.','http://www.w3.org/2004/02/skos/core/examples/prefSymbol.rdf.xml',0,0,0,0,0),
  (19,27,NULL,'prefLabel','http://www.w3.org/2004/02/skos/core#prefLabel','literal',NULL,1,'preferred label','The preferred lexical label for a resource, in a given language.','No two concepts in the same concept scheme may have the same value for skos:prefLabel in a given language.','http://www.w3.org/2004/02/skos/core/examples/prefLabel.rdf.xml',1,0,0,0,1),
  (20,24,NULL,'primarySubject','http://www.w3.org/2004/02/skos/core#primarySubject','literal',NULL,NULL,'has primary subject','A concept that is the primary subject of the resource.','A resource may have only one primary subject per concept scheme.','http://www.w3.org/2004/02/skos/core/examples/primarySubject.rdf.xml',0,0,0,0,0),
  (21,NULL,21,'related','http://www.w3.org/2004/02/skos/core#related','resource',NULL,6,'related to','A concept with which there is an associative semantic relationship.',NULL,'http://www.w3.org/2004/02/skos/core/examples/related.rdf.xml',0,1,0,0,1),
  (22,17,NULL,'scopeNote','http://www.w3.org/2004/02/skos/core#scopeNote','literal',NULL,7,'scope note','A note that helps to clarify the meaning of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/scopeNote.rdf.xml',0,0,0,0,1),
  (24,NULL,12,'subject','http://www.w3.org/2004/02/skos/core#subject','resource',NULL,NULL,'has subject','A concept that is a subject of the resource.','The following rule may be applied for this property: [(?d skos:subject ?x)(?x skos:broader ?y) implies (?d skos:subject ?y)]','http://www.w3.org/2004/02/skos/core/examples/subject.rdf.xml',0,0,0,0,0),
  (25,NULL,NULL,'subjectIndicator','http://www.w3.org/2004/02/skos/core#subjectIndicator','resource',NULL,NULL,'subject indicator','A subject indicator for a concept. [The notion of ''subject indicator'' is defined here with reference to the latest definition endorsed by the OASIS Published Subjects Technical Committee.]','This property allows subject indicators to be used for concept identification in place of or in addition to directly assigned URIs.','http://www.w3.org/2004/02/skos/core/examples/subjectIndicator.rdf.xml',0,0,0,0,0),
  (26,NULL,NULL,'symbol','http://www.w3.org/2004/02/skos/core#symbol','literal',NULL,NULL,'symbolic label','An image that is a symbolic label for the resource.','This property is roughly analagous to rdfs:label, but for labelling resources with images that have retrievable representations, rather than RDF literals.','http://www.w3.org/2004/02/skos/core/examples/symbol.rdf.xml',0,0,0,0,0),
  (27,NULL,NULL,'label','http://www.w3.org/2000/01/rdf-schema#label','literal',NULL,15,'label','A human-readable name for the subject.',NULL,NULL,0,0,0,0,1);

COMMIT;

#
# Data for the `reg_lookup` table  (LIMIT 0,500)
#

INSERT INTO `reg_lookup` (`id`, `type_id`, `short_value`, `long_value`, `display_order`) VALUES 
  (1,1,'Published','Published',7),
  (2,1,'New-Proposed','New-Proposed',1),
  (3,1,'Change-Proposed','Change-Proposed',2),
  (4,1,'Deprecate-Proposed','Deprecate-Proposed',3),
  (5,1,'New-Under Review','New-Under Review',4),
  (6,1,'Change-Under Review','Change-Under Review',5),
  (7,1,'Deprecate-Under Revi','Deprecate-Under Review',6),
  (8,1,'Deprecated','Deprecated',8),
  (9,1,'Not Approved','Not Approved',9);

COMMIT;

