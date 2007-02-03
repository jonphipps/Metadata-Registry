# SQL Manager 2005 for MySQL 3.7.7.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : registry


SET FOREIGN_KEY_CHECKS=0;

USE `registry`;

#
# Structure for the `agent` table : 
#

CREATE TABLE `agent` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `org_email` varchar(100) character set latin1 NOT NULL,
  `org_name` varchar(255) character set latin1 NOT NULL,
  `ind_affiliation` varchar(255) character set latin1 default NULL,
  `ind_role` varchar(45) character set latin1 default NULL,
  `address1` varchar(255) character set latin1 default NULL,
  `address2` varchar(255) character set latin1 default NULL,
  `city` varchar(45) character set latin1 default NULL,
  `state` char(2) character set latin1 default NULL,
  `postal_code` varchar(15) character set latin1 default NULL,
  `country` char(3) character set latin1 default NULL,
  `phone` varchar(45) character set latin1 default NULL,
  `web_address` varchar(255) character set latin1 default NULL,
  `type` char(15) character set latin1 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB';

#
# Structure for the `agent_user` table : 
#

CREATE TABLE `agent_user` (
  `user_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `is_registrar_for` tinyint(4) default '1',
  `is_admin_for` tinyint(4) default '1',
  PRIMARY KEY  (`user_id`,`agent_id`),
  KEY `user_id` (`user_id`),
  KEY `agent_id` (`agent_id`),
  CONSTRAINT `agent_user_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `agent_user_FK_2` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `concept` table :
#

CREATE TABLE `concept` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00',
  `uri` varchar(255) character set latin1 NOT NULL,
  `pref_label` varchar(255) character set latin1 NOT NULL,
  `scheme_id` int(11) default NULL,
  `is_top_concept` tinyint(1) default NULL,
  `status_id` int(11) default '1',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `vocabulary_id_pref_label` (`scheme_id`,`pref_label`),
  KEY `vocabulary_id` (`scheme_id`),
  KEY `pref_label` (`pref_label`),
  KEY `status_id` (`status_id`),
  KEY `concept_FI_3` (`user_id`),
  CONSTRAINT `concept_FK_1` FOREIGN KEY (`scheme_id`) REFERENCES `scheme` (`id`),
  CONSTRAINT `concept_FK_2` FOREIGN KEY (`status_id`) REFERENCES `lookup` (`id`),
  CONSTRAINT `concept_FK_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`status_id`) REFER `registry/lookup`(`id';

#
# Structure for the `concept_property` table :
#

CREATE TABLE `concept_property` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `concept_id` int(11) NOT NULL,
  `ontology_id` int(11) NOT NULL,
  `object` text character set latin1 NOT NULL,
  `language` char(6) character set latin1 default NULL,
  `related_scheme_id` int(11) default NULL,
  `related_concept_id` int(11) default NULL,
  `createdby_user_id` int(11) NOT NULL,
  `updatedby_user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `concept_id` (`concept_id`),
  KEY `property_id` (`ontology_id`),
  KEY `scheme_id` (`related_scheme_id`),
  KEY `related_concept_id` (`related_concept_id`),
  KEY `status_id` (`status_id`),
  KEY `User_property_FK1` (`createdby_user_id`),
  KEY `User_property_FK2` (`updatedby_user_id`),
  CONSTRAINT `concept_property_FK_1` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE,
  CONSTRAINT `concept_property_FK_2` FOREIGN KEY (`ontology_id`) REFERENCES `ontology` (`id`),
  CONSTRAINT `concept_property_FK_3` FOREIGN KEY (`related_scheme_id`) REFERENCES `scheme` (`id`),
  CONSTRAINT `concept_property_FK_4` FOREIGN KEY (`related_concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE,
  CONSTRAINT `concept_property_FK_5` FOREIGN KEY (`createdby_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `concept_property_FK_6` FOREIGN KEY (`status_id`) REFERENCES `lookup` (`id`),
  CONSTRAINT `concept_property_FK_7` FOREIGN KEY (`updatedby_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`concept_id`) REFER `registry/concept`(`';

#
# Structure for the `concept_scheme` table :
#

CREATE TABLE `concept_scheme` (
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `concept_id` int(11) default NULL,
  `scheme_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  KEY `concept_id` (`concept_id`),
  KEY `scheme_id` (`scheme_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `concept_scheme_FK_3` FOREIGN KEY (`scheme_id`) REFERENCES `scheme` (`id`),
  CONSTRAINT `concept_scheme_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `concept_scheme_FK_2` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `lookup` table : 
#

CREATE TABLE `lookup` (
  `id` int(11) NOT NULL auto_increment,
  `type_id` int(11) default NULL,
  `short_value` char(20) character set latin1 default NULL,
  `long_value` varchar(255) character set latin1 default NULL,
  `display_order` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `display_order` (`type_id`,`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB';

#
# Structure for the `namespace` table : 
#

CREATE TABLE `namespace` (
  `id` int(11) NOT NULL auto_increment,
  `qname` varchar(20) default NULL,
  `uri` varchar(255) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `ontology` table : 
#

CREATE TABLE `ontology` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `inverse_id` int(11) default NULL,
  `name` varchar(255) character set latin1 NOT NULL,
  `uri` varchar(255) character set latin1 NOT NULL,
  `object_type` char(1) character set latin1 NOT NULL,
  `display_order` int(11) default NULL,
  `picklist_order` int(11) default NULL,
  `label` varchar(255) character set latin1 default NULL,
  `definition` text character set latin1,
  `comment` text character set latin1,
  `examples` varchar(255) character set latin1 default NULL,
  `is_required` tinyint(1) NOT NULL default '0',
  `is_reciprocal` tinyint(1) NOT NULL default '0',
  `is_singleton` tinyint(1) NOT NULL default '0',
  `is_scheme` tinyint(1) NOT NULL default '0',
  `is_in_picklist` tinyint(1) NOT NULL default '1',
  `namespace_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `uri` (`uri`),
  KEY `namespace_id` (`namespace_id`),
  CONSTRAINT `ontology_FK_1` FOREIGN KEY (`namespace_id`) REFERENCES `namespace` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`namespace_id`) REFER `registry/namespac';

#
# Structure for the `scheme` table :
#

CREATE TABLE `scheme` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00',
  `agent_id` int(11) default NULL,
  `name` varchar(255) character set latin1 default NULL,
  `note` text character set latin1,
  `uri` varchar(255) character set latin1 default NULL,
  `url` varchar(255) character set latin1 default NULL,
  `base_domain` varchar(255) character set latin1 default NULL,
  `token` varchar(45) character set latin1 default NULL,
  `community` varchar(45) character set latin1 default NULL,
  `last_uri_id` int(11) default '1000',
  `default_language` char(10) character set latin1 default NULL,
  `default_status_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `default_status_id` (`default_status_id`),
  CONSTRAINT `scheme_FK_1` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`),
  CONSTRAINT `scheme_FK_2` FOREIGN KEY (`default_status_id`) REFERENCES `lookup` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`agent_id`) REFER `registry/agent`(`id`)';

#
# Structure for the `scheme_user` table : 
#

CREATE TABLE `scheme_user` (
  `scheme_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_maintainer_for` tinyint(1) default '1',
  `is_registrar_for` tinyint(1) default '1',
  `is_admin_for` tinyint(1) default '1',
  PRIMARY KEY  (`scheme_id`,`user_id`),
  KEY `resource_id` (`scheme_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `vocabulary_user_FK_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `schemeversion` table : 
#

CREATE TABLE `schemeversion` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `scheme_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `version_label` char(255) character set latin1 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ConceptVersion_AK2` (`created_at`),
  UNIQUE KEY `ConceptVersion_AK2_uc6` (`created_at`),
  UNIQUE KEY `created_at` (`created_at`),
  UNIQUE KEY `ConceptVersion_AK3` (`version_label`),
  UNIQUE KEY `ConceptVersion_AK3_uc7` (`version_label`),
  KEY `concept_ConceptVersion_FK1` (`scheme_id`),
  KEY `User_ConceptVersion_FK1` (`user_id`),
  CONSTRAINT `schemeversion_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `schemeversion_FK_2` FOREIGN KEY (`scheme_id`) REFERENCES `scheme` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB; (`user_id`) REFER `registry/user`(`id`); ';

#
# Structure for the `schemeversion_concept` table : 
#

CREATE TABLE `schemeversion_concept` (
  `schemeversion_id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  KEY `schemeversion_id` (`schemeversion_id`),
  KEY `concept_id` (`concept_id`),
  CONSTRAINT `schemeversion_concept_FK_2` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`),
  CONSTRAINT `schemeversion_concept_FK_1` FOREIGN KEY (`schemeversion_id`) REFERENCES `schemeversion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `user` table :
#

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00',
  `nickname` varchar(50) character set latin1 default NULL,
  `salutation` varchar(5) character set latin1 default NULL,
  `first_name` varchar(100) character set latin1 default NULL,
  `last_name` varchar(100) character set latin1 default NULL,
  `email` varchar(100) character set latin1 default NULL,
  `password` varchar(40) character set latin1 default NULL,
  `sha1_password` varchar(40) character set latin1 default NULL,
  `salt` varchar(32) character set latin1 default NULL,
  `want_to_be_moderator` tinyint(1) default '0',
  `is_moderator` tinyint(1) default '0',
  `is_administrator` tinyint(1) default '0',
  `deletions` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 0 kB';

