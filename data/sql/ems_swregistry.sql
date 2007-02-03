# SQL Manager 2005 for MySQL 3.7.7.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : swregistry


SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `swregistry`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `swregistry`;

#
# Structure for the `reg_agent` table : 
#

CREATE TABLE `reg_agent` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `org_email` varchar(100) NOT NULL default '',
  `org_name` varchar(255) NOT NULL default '',
  `ind_affiliation` varchar(255) default NULL,
  `ind_role` varchar(45) default NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `city` varchar(45) default NULL,
  `state` char(2) default NULL COMMENT 'Get from list of 2-digit state codes',
  `postal_code` varchar(15) default NULL,
  `country` char(3) default NULL COMMENT 'Get from list of 3-digit country codes',
  `phone` varchar(45) default NULL,
  `web_address` varchar(255) default NULL,
  `type` char(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_agent_has_user` table : 
#

CREATE TABLE `reg_agent_has_user` (
  `user_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL default '0',
  `is_registrar_for` tinyint(1) default '1',
  `is_admin_for` tinyint(1) default '1' COMMENT 'boolean -- user is admin for agent',
  PRIMARY KEY  (`agent_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `agent_id` (`agent_id`),
  CONSTRAINT `reg_agent_has_user_fk` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_agent_has_user_fk1` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`user_id`) REFER `swregistry/reg_agents`';

#
# Structure for the `reg_concept` table : 
#

CREATE TABLE `reg_concept` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `uri` varchar(255) NOT NULL,
  `pref_label` varchar(255) NOT NULL COMMENT 'This is a denormalized, truncated clone of the prefLabel skos:property',
  `vocabulary_id` int(11) default NULL,
  `is_top_concept` int(1) default NULL COMMENT 'boolean -- this value is expressed in the conceptScheme using the inverse: hasTopConcept property',
  `status_id` int(11) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `vocabulary_id_pref_label` (`vocabulary_id`,`pref_label`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `pref_label` (`pref_label`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `concept_vocabulary_fk` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_concept_history` table :
#

CREATE TABLE `reg_concept_history` (
  `sid` char(32) NOT NULL COMMENT 'This is the PHP 32-character session ID',
  `concept_property_id` int(11) NOT NULL COMMENT 'id of property being changed',
  `user_id` int(11) NOT NULL,
  `changed_at` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'timestamp of the last update in this session',
  `old_values` text NOT NULL COMMENT 'this will be a serialized array of values',
  `new_values` text NOT NULL COMMENT 'this will be a serialized array of values',
  PRIMARY KEY  (`sid`,`concept_property_id`),
  KEY `user_id` (`user_id`),
  KEY `concept_property_id` (`concept_property_id`),
  CONSTRAINT `reg_concept_history_fk` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_history_fk1` FOREIGN KEY (`concept_property_id`) REFERENCES `reg_concept_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_concept_property` table :
#

CREATE TABLE `reg_concept_property` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `concept_id` int(11) NOT NULL,
  `skos_property_id` int(11) NOT NULL,
  `object` text NOT NULL,
  `scheme_id` int(11) default NULL COMMENT 'id of the related vocabulary when required',
  `related_concept_id` int(11) default NULL COMMENT 'id of the related concept when required',
  `language` char(6) default NULL COMMENT 'This will be an RFC3066 language code, which means it can be en, eng, en-us, or eng-us -- iso639-1 (2-char codes), iso639-2 (3-char codes), and combined with iso3166 (2-char country codes)',
  `status_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `concept_id` (`concept_id`),
  KEY `skos_property_id` (`skos_property_id`),
  KEY `scheme_id` (`scheme_id`),
  KEY `related_concept_id` (`related_concept_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `reg_concept_property_fk` FOREIGN KEY (`concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk1` FOREIGN KEY (`skos_property_id`) REFERENCES `reg_skos_property` (`id`),
  CONSTRAINT `reg_concept_property_fk2` FOREIGN KEY (`scheme_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk3` FOREIGN KEY (`status_id`) REFERENCES `reg_lookup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk4` FOREIGN KEY (`related_concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_lookup` table :
#

CREATE TABLE `reg_lookup` (
  `id` int(11) NOT NULL auto_increment,
  `type_id` int(11) default NULL COMMENT 'This will be the lookup type and will reference the list of lookup types stored in this very same table',
  `short_value` char(20) default NULL,
  `long_value` varchar(255) default NULL,
  `display_order` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `display_order` (`type_id`,`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_skos_property` table : 
#

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains a list of available predicates for skos concepts co';

#
# Structure for the `reg_status` table :
#

CREATE TABLE `reg_status` (
  `id` int(11) NOT NULL auto_increment,
  `display_order` int(11) default NULL,
  `display_name` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_user` table :
#

CREATE TABLE `reg_user` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_vocabulary` table :
#

CREATE TABLE `reg_vocabulary` (
  `id` int(11) NOT NULL auto_increment,
  `agent_id` int(11) default NULL,
  `created_at` datetime NOT NULL,
  `last_updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `name` varchar(255) default NULL,
  `note` text,
  `uri` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `base_domain` varchar(255) default NULL,
  `token` varchar(45) default NULL,
  `community` varchar(45) default NULL,
  `last_uri_id` int(11) default '1000' COMMENT 'this is the last concept id assigned to a concept uri in this vocabulary. It will be incremented by 1 every time a new concept uri is added to this vocabulary',
  PRIMARY KEY  (`id`),
  KEY `agent_id` (`agent_id`),
  CONSTRAINT `vocabulary_agent_fk` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `reg_vocabulary_has_user` table : 
#

CREATE TABLE `reg_vocabulary_has_user` (
  `vocabulary_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_maintainer_for` tinyint(1) default '1',
  `is_registrar_for` tinyint(1) default '1',
  `is_admin_for` tinyint(1) default '1',
  PRIMARY KEY  (`user_id`,`vocabulary_id`),
  KEY `resource_id` (`vocabulary_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reg_resource_has_user_fk1` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_has_user_fk` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`agent_id`) REFER `swregistry/reg_agent`';

