# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.33-0+wheezy1)
# Database: swregistry_test_empty
# Generation Time: 2014-01-12 16:36:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table arc_g2t
# ------------------------------------------------------------

DROP TABLE IF EXISTS `arc_g2t`;

CREATE TABLE `arc_g2t` (
  `g` mediumint(8) unsigned NOT NULL,
  `t` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `gt` (`g`,`t`),
  KEY `tg` (`t`,`g`),
  KEY `g` (`g`),
  KEY `t` (`t`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=47 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;



# Dump of table arc_id2val
# ------------------------------------------------------------

DROP TABLE IF EXISTS `arc_id2val`;

CREATE TABLE `arc_id2val` (
  `id` mediumint(8) unsigned NOT NULL,
  `misc` tinyint(1) NOT NULL DEFAULT '0',
  `val` text COLLATE utf8_unicode_ci NOT NULL,
  `val_type` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`,`val_type`),
  KEY `v` (`val`(64)),
  KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=341 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;



# Dump of table arc_o2val
# ------------------------------------------------------------

DROP TABLE IF EXISTS `arc_o2val`;

CREATE TABLE `arc_o2val` (
  `id` mediumint(8) unsigned NOT NULL,
  `misc` tinyint(1) NOT NULL DEFAULT '0',
  `val` text COLLATE utf8_unicode_ci NOT NULL,
  `cid` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `v` (`val`(64)),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=118 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;



# Dump of table arc_s2val
# ------------------------------------------------------------

DROP TABLE IF EXISTS `arc_s2val`;

CREATE TABLE `arc_s2val` (
  `id` mediumint(8) unsigned NOT NULL,
  `misc` tinyint(1) NOT NULL DEFAULT '0',
  `val` text COLLATE utf8_unicode_ci NOT NULL,
  `cid` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `v` (`val`(64)),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=209 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;



# Dump of table arc_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `arc_setting`;

CREATE TABLE `arc_setting` (
  `k` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `val` text COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `k` (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;



# Dump of table arc_triple
# ------------------------------------------------------------

DROP TABLE IF EXISTS `arc_triple`;

CREATE TABLE `arc_triple` (
  `t` mediumint(8) unsigned NOT NULL,
  `s` mediumint(8) unsigned NOT NULL,
  `p` mediumint(8) unsigned NOT NULL,
  `o` mediumint(8) unsigned NOT NULL,
  `o_lang_dt` mediumint(8) unsigned NOT NULL,
  `o_comp` char(35) COLLATE utf8_unicode_ci NOT NULL,
  `s_type` tinyint(1) NOT NULL DEFAULT '0',
  `o_type` tinyint(1) NOT NULL DEFAULT '0',
  `misc` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `t` (`t`),
  KEY `os` (`o`,`s`),
  KEY `po` (`p`,`o`),
  KEY `misc` (`misc`),
  KEY `spo` (`s`,`p`,`o`),
  KEY `s` (`s`),
  KEY `p` (`p`),
  KEY `o` (`o`),
  KEY `o_lang_dt` (`o_lang_dt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=112 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;



# Dump of table profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `child_updated_at` datetime DEFAULT NULL,
  `child_updated_by` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `note` text,
  `uri` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) DEFAULT NULL,
  `base_domain` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(45) NOT NULL DEFAULT '',
  `community` varchar(45) DEFAULT NULL,
  `last_uri_id` int(11) DEFAULT '100000',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `language` char(6) NOT NULL DEFAULT 'en',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;

INSERT INTO `profile` (`id`, `agent_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `child_updated_at`, `child_updated_by`, `name`, `note`, `uri`, `url`, `base_domain`, `token`, `community`, `last_uri_id`, `status_id`, `language`)
VALUES
	(1,58,'2008-04-20 11:52:00','2008-04-20 11:52:00',NULL,36,36,NULL,NULL,NULL,'NSDL Registry Schema',NULL,'http://registry/uri/profile/registryschema',NULL,'http://registry/uri/profile/registryschema','registryschema','100000',100000,1,'en');

/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table profile_property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_property`;

CREATE TABLE `profile_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `profile_id` int(11) NOT NULL,
  `schema_id` int(11) DEFAULT NULL,
  `schema_property_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) NOT NULL DEFAULT '',
  `definition` text,
  `comment` text,
  `type` enum('property','subproperty') NOT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `language` varchar(6) NOT NULL DEFAULT 'en',
  `note` text,
  `display_order` int(11) DEFAULT NULL COMMENT 'Display order of properties',
  `picklist_order` int(11) DEFAULT NULL,
  `examples` varchar(255) DEFAULT NULL COMMENT 'Link to example usage',
  `is_required` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean -- id this value required',
  `is_reciprocal` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean - subject and object must both have this property',
  `is_singleton` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean -- is this property allowed to repeat for a concept',
  `is_in_picklist` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - is in the property picklist',
  `inverse_profile_property_id` int(11) DEFAULT NULL COMMENT 'id of the inverse property',
  `has_language` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Boolean that determines whether language attribute is displayed for this property',
  `is_attribute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean - is this an attribute? attribute''s aren''t editable outside the main form',
  `is_in_xsd` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - should this display in the XSD',
  `is_in_rdf` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - should this display in the RDF',
  `is_in_property_picklist` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - is in the property picklist',
  `is_in_class_picklist` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - is in the property picklist',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `profile_property` WRITE;
/*!40000 ALTER TABLE `profile_property` DISABLE KEYS */;

INSERT INTO `profile_property` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `profile_id`, `schema_id`, `schema_property_id`, `name`, `label`, `definition`, `comment`, `type`, `uri`, `status_id`, `language`, `note`, `display_order`, `picklist_order`, `examples`, `is_required`, `is_reciprocal`, `is_singleton`, `is_in_picklist`, `inverse_profile_property_id`, `has_language`, `is_attribute`, `is_in_xsd`, `is_in_rdf`, `is_in_property_picklist`, `is_in_class_picklist`)
VALUES
	(1,'2008-04-20 12:00:00','2008-04-20 16:00:00',NULL,36,36,NULL,1,NULL,NULL,'name','name',NULL,NULL,'property','reg:name',1,'en',NULL,1,1,NULL,1,0,1,0,NULL,1,1,1,1,0,0),
	(2,'2008-04-20 12:00:00','2008-04-20 16:00:00',NULL,36,36,NULL,1,NULL,NULL,'label','label',NULL,NULL,'property','rdfs:label',1,'en',NULL,2,2,NULL,1,0,0,1,NULL,1,0,1,1,1,1),
	(3,'2008-04-20 12:01:00','2008-04-20 16:01:01',NULL,36,36,NULL,1,NULL,NULL,'definition','description',NULL,NULL,'property','skos:definition',1,'en',NULL,3,3,NULL,0,0,0,1,NULL,1,0,1,1,1,1),
	(4,'2008-04-20 12:02:00','2008-04-20 16:02:00',NULL,36,36,NULL,1,NULL,NULL,'type','type',NULL,NULL,'property','rdf:type',1,'en',NULL,5,5,NULL,1,0,1,0,NULL,0,1,1,1,0,0),
	(5,'2008-04-20 00:02:00','2008-04-20 04:02:02',NULL,36,36,NULL,1,NULL,NULL,'comment','comment',NULL,NULL,'property','rdfs:comment',1,'en',NULL,4,4,NULL,0,0,0,1,NULL,1,0,1,1,1,1),
	(6,'2008-04-20 00:03:00','2008-04-20 16:03:00',NULL,36,36,NULL,1,NULL,NULL,'isSubpropertyOf','subpropertyOf',NULL,NULL,'property','rdfs:subPropertyOf',1,'en',NULL,6,6,NULL,0,0,0,1,8,0,0,1,1,1,0),
	(7,'2008-04-20 00:04:00','2008-04-20 04:04:00',NULL,36,36,NULL,1,NULL,NULL,'note','note',NULL,NULL,'property','skos:scopeNote',1,'en',NULL,8,8,NULL,0,0,0,1,NULL,1,0,1,1,1,1),
	(8,'2008-04-20 12:05:00','2008-04-20 16:05:00',NULL,36,36,NULL,1,NULL,NULL,'hasSubproperty','hasSubproperty',NULL,NULL,'property','reg:hasSubproperty',1,'en',NULL,7,7,NULL,0,0,0,0,6,0,1,1,1,1,0),
	(9,'2009-03-07 11:49:27','2009-03-07 16:49:27',NULL,36,36,NULL,1,NULL,NULL,'isSubclassOf','subClassOf','','','property','rdfs:subClassOf',1,'en','',8,8,'',0,0,0,0,10,0,0,1,1,0,1),
	(10,'2009-03-07 11:53:34','2009-03-07 16:53:34',NULL,36,36,NULL,1,NULL,NULL,'hasSubClass','hasSubClass',NULL,NULL,'property','reg:hasSubClass',1,'en',NULL,9,9,NULL,0,0,0,0,9,0,1,1,1,0,1),
	(11,'2009-03-07 11:57:15','2009-03-07 16:57:15',NULL,36,36,NULL,1,NULL,NULL,'domain','domain',NULL,NULL,'property','rdfs:domain',1,'en',NULL,10,10,NULL,0,0,0,1,NULL,0,0,1,1,1,0),
	(12,'2009-03-07 12:01:38','2009-03-07 17:01:38',NULL,36,36,NULL,1,NULL,NULL,'orange','range',NULL,NULL,'property','rdfs:range',1,'en',NULL,11,11,NULL,0,0,0,1,NULL,0,0,1,1,1,0),
	(13,'2009-03-07 12:01:38','2009-03-07 17:01:38',NULL,36,36,NULL,1,NULL,NULL,'uri','uri',NULL,NULL,'property','reg:uri',1,'en',NULL,12,12,NULL,1,0,1,0,NULL,0,1,1,0,0,0),
	(14,'2009-03-07 12:01:38','2009-03-07 17:01:38',NULL,36,36,NULL,1,NULL,NULL,'statusId','status',NULL,NULL,'property','reg:status',1,'en',NULL,12,12,NULL,1,0,1,0,NULL,0,1,1,0,0,0),
	(15,'2011-09-29 14:12:00','2011-09-29 14:20:25',NULL,36,36,NULL,1,NULL,NULL,'isInverseOf','inverseOf','','The property that determines that two given properties are inverse.','property','owl:inverseOf',1,'en','',14,14,'',0,1,0,1,NULL,0,0,0,1,1,0),
	(16,'2011-09-29 14:23:24','2011-09-29 14:23:24',NULL,36,36,NULL,1,NULL,NULL,'isSameAs','sameAs','','The property that determines that two given individuals are equal.','property','owl:sameAs',1,'en','',16,16,'',0,1,0,1,NULL,0,0,0,1,1,1),
	(17,'2011-09-29 14:26:25','2011-09-29 14:26:25',NULL,36,36,NULL,1,NULL,NULL,'propertyIsDisjointWith','propertyDisjointWith','','Used to specify that two properties are mutually disjoint, and it is defined as a property itself. ','property','owl:propertyDisjointWith',1,'en','',17,17,'',0,1,0,1,NULL,0,0,1,1,1,0),
	(18,'2011-09-29 14:28:57','2011-09-29 14:28:57',NULL,36,36,NULL,1,NULL,NULL,'isEquivalentClass','equivalentClass','','The property that determines that two given classes are equivalent, and that is used to specify datatype definitions.','property','owl:equivalentClass',1,'en','',19,19,'',0,1,0,1,NULL,0,0,1,1,0,1),
	(19,'2011-09-29 14:30:00','2011-09-29 14:30:00',NULL,36,36,NULL,1,NULL,NULL,'isEquivalentProperty','equivalentProperty','','','property','owl:equivalentProperty',1,'en','',20,20,'',0,1,0,1,NULL,0,0,1,1,1,0),
	(20,'2012-02-02 23:21:08','2012-02-02 23:21:08',NULL,36,36,NULL,1,NULL,NULL,'isDisjointWith','disjointWith','','The property that determines that two given properties are disjoint.','property','owl:disjointWith',1,'en','',18,18,'',0,1,0,1,NULL,0,0,1,1,1,1),
	(21,'2012-06-02 23:21:08','2012-06-02 23:21:08',NULL,36,36,NULL,1,NULL,NULL,'altLabel','altLabel',NULL,NULL,'property','skos:altLabel',1,'en',NULL,21,21,NULL,0,0,0,1,NULL,1,0,1,1,1,1);

/*!40000 ALTER TABLE `profile_property` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reg_agent
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_agent`;

CREATE TABLE `reg_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `org_email` varchar(100) NOT NULL DEFAULT '',
  `org_name` varchar(255) NOT NULL DEFAULT '',
  `ind_affiliation` varchar(255) DEFAULT NULL,
  `ind_role` varchar(45) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `postal_code` varchar(15) DEFAULT NULL,
  `country` char(3) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `web_address` varchar(255) DEFAULT NULL,
  `type` char(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=780;



# Dump of table reg_agent_has_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_agent_has_user`;

CREATE TABLE `reg_agent_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `agent_id` int(11) NOT NULL DEFAULT '0',
  `is_registrar_for` tinyint(1) DEFAULT '1',
  `is_admin_for` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_agent_id` (`user_id`,`agent_id`) USING BTREE,
  UNIQUE KEY `agent_user_id` (`agent_id`,`user_id`),
  CONSTRAINT `reg_agent_has_user_fk` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_agent_has_user_fk1` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=682 COMMENT='InnoDB free: 0 kB; (`user_id`) REFER `swregistry/reg_agents`';



# Dump of table reg_batch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_batch`;

CREATE TABLE `reg_batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `run_time` datetime DEFAULT NULL,
  `run_description` text,
  `object_type` varchar(20) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `event_time` datetime DEFAULT NULL,
  `event_type` varchar(20) DEFAULT NULL,
  `event_description` text,
  `registry_uri` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=328 PACK_KEYS=0 ROW_FORMAT=COMPACT COMMENT='InnoDB free: 5120 kB';



# Dump of table reg_collection
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_collection`;

CREATE TABLE `reg_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `vocabulary_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `pref_label` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `reg_collection_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_collection_fk1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_collection_fk2` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_collection_fk3` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_concept
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_concept`;

CREATE TABLE `reg_concept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `uri` varchar(255) NOT NULL DEFAULT '',
  `vocabulary_id` int(11) DEFAULT NULL,
  `is_top_concept` tinyint(1) DEFAULT NULL,
  `pref_label_id` int(11) DEFAULT NULL,
  `pref_label` varchar(255) NOT NULL DEFAULT '',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `language` char(6) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  UNIQUE KEY `vocabulary_id_pref_label` (`vocabulary_id`,`pref_label`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `pref_label` (`pref_label`),
  KEY `status_id` (`status_id`),
  KEY `pref_label_id` (`pref_label_id`),
  KEY `last_updated_by_user_id` (`updated_user_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `reg_concept_idx1` (`uri`),
  CONSTRAINT `concept_vocabulary_fk` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_FK_1` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`),
  CONSTRAINT `reg_concept_FK_3` FOREIGN KEY (`pref_label_id`) REFERENCES `reg_concept_property` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_FK_4` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=240;



# Dump of table reg_concept_property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_concept_property`;

CREATE TABLE `reg_concept_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `concept_id` int(11) NOT NULL,
  `primary_pref_label` tinyint(1) DEFAULT NULL,
  `skos_property_id` int(11) NOT NULL,
  `object` text NOT NULL,
  `scheme_id` int(11) DEFAULT NULL,
  `related_concept_id` int(11) DEFAULT NULL,
  `language` char(6) DEFAULT 'en',
  `status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
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
  CONSTRAINT `reg_concept_property_fk2` FOREIGN KEY (`scheme_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk3` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk4` FOREIGN KEY (`related_concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_FK_1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=140;



# Dump of table reg_concept_property_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_concept_property_history`;

CREATE TABLE `reg_concept_property_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` enum('updated','added','deleted','force_deleted') DEFAULT NULL,
  `concept_property_id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `vocabulary_id` int(11) DEFAULT NULL,
  `skos_property_id` int(11) DEFAULT NULL,
  `object` text,
  `scheme_id` int(11) DEFAULT NULL COMMENT 'id of the related vocabulary when required',
  `related_concept_id` int(11) DEFAULT NULL COMMENT 'id of the related concept when required',
  `language` char(6) DEFAULT 'en' COMMENT 'This will be an RFC3066 language code, which means it can be en, eng, en-us, or eng-us -- iso639-1 (2-char codes), iso639-2 (3-char codes), and combined with iso3166 (2-char country codes)',
  `status_id` int(11) DEFAULT '1',
  `created_user_id` int(11) DEFAULT NULL COMMENT 'The ID of the user that created the property',
  `change_note` text,
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
  KEY `reg_concept_property_history_idx1` (`created_at`),
  CONSTRAINT `reg_concept_property_fk1_new` FOREIGN KEY (`skos_property_id`) REFERENCES `reg_skos_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk2_new` FOREIGN KEY (`scheme_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk3_new` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_fk4_new` FOREIGN KEY (`related_concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_1` FOREIGN KEY (`concept_property_id`) REFERENCES `reg_concept_property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_2` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_concept_property_history_FK_3` FOREIGN KEY (`concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=151;



# Dump of table reg_discuss
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_discuss`;

CREATE TABLE `reg_discuss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `deleted_user_id` int(11) DEFAULT NULL,
  `uri` char(255) DEFAULT NULL,
  `schema_id` int(11) DEFAULT NULL,
  `schema_property_id` int(11) DEFAULT NULL,
  `schema_property_element_id` int(11) DEFAULT NULL,
  `vocabulary_id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `concept_property_id` int(11) DEFAULT NULL,
  `root_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `deleted_user_id` (`deleted_user_id`),
  KEY `schema_id` (`schema_id`),
  KEY `schema_property_id` (`schema_property_id`),
  KEY `schema_property_element_id` (`schema_property_element_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `concept_id` (`concept_id`),
  KEY `root_id` (`root_id`),
  KEY `parent_id` (`parent_id`),
  KEY `concept_property_id` (`concept_property_id`),
  KEY `uri` (`uri`),
  CONSTRAINT `reg_discuss_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk1` FOREIGN KEY (`deleted_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk2` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk3` FOREIGN KEY (`schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk4` FOREIGN KEY (`schema_property_element_id`) REFERENCES `reg_schema_property_element` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk5` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk6` FOREIGN KEY (`concept_id`) REFERENCES `reg_concept` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk7` FOREIGN KEY (`root_id`) REFERENCES `reg_discuss` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk8` FOREIGN KEY (`parent_id`) REFERENCES `reg_discuss` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_discuss_fk9` FOREIGN KEY (`concept_property_id`) REFERENCES `reg_concept_property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_file_import_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_file_import_history`;

CREATE TABLE `reg_file_import_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `map` longtext COMMENT 'stores the serialized column map array',
  `user_id` int(11) DEFAULT NULL,
  `vocabulary_id` int(11) DEFAULT NULL,
  `schema_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `schema_id` (`schema_id`),
  CONSTRAINT `reg_file_import_history_fk` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_file_import_history_fk1` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_file_import_history_fk2` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_lookup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_lookup`;

CREATE TABLE `reg_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL COMMENT 'This will be the lookup type and will reference the list of lookup types stored in this very same table',
  `short_value` char(20) DEFAULT NULL,
  `long_value` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `display_order` (`type_id`,`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reg_lookup` WRITE;
/*!40000 ALTER TABLE `reg_lookup` DISABLE KEYS */;

INSERT INTO `reg_lookup` (`id`, `type_id`, `short_value`, `long_value`, `display_order`)
VALUES
	(1,1,'Published','Published',7),
	(2,1,'New-Proposed','New-Proposed',1),
	(3,1,'Change-Proposed','Change-Proposed',2),
	(4,1,'Deprecate-Proposed','Deprecate-Proposed',3),
	(5,1,'New-Under Review','New-Under Review',4),
	(6,1,'Change-Under Review','Change-Under Review',5),
	(7,1,'Deprecate-Under Revi','Deprecate-Under Review',6),
	(8,1,'Deprecated','Deprecated',8),
	(9,1,'Not Approved','Not Approved',9);

/*!40000 ALTER TABLE `reg_lookup` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reg_rdf_namespace
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_rdf_namespace`;

CREATE TABLE `reg_rdf_namespace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schema_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `note` text,
  `uri` varchar(255) NOT NULL,
  `schema_location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schema_id` (`schema_id`),
  CONSTRAINT `reg_rdf_namespace_fk` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_schema
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema`;

CREATE TABLE `reg_schema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `child_updated_at` datetime DEFAULT NULL,
  `child_updated_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `note` text,
  `uri` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) DEFAULT NULL,
  `base_domain` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(45) NOT NULL DEFAULT '',
  `community` varchar(45) DEFAULT NULL,
  `last_uri_id` int(11) DEFAULT '100000',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `language` char(6) NOT NULL DEFAULT 'en',
  `profile_id` int(11) DEFAULT NULL,
  `ns_type` char(6) NOT NULL DEFAULT 'slash',
  UNIQUE KEY `id` (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `status_id` (`status_id`),
  KEY `last_updated_by_user_id` (`updated_user_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `child_updated_user_id` (`child_updated_user_id`),
  KEY `profile_id` (`profile_id`),
  KEY `reg_schema_idx1` (`uri`),
  KEY `reg_schema_idx2` (`name`),
  CONSTRAINT `schema_agent_fk` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `schema_FK_user_1` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `schema_FK_user_2` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `schema_profile_fk` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `schema_status_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_schema_property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema_property`;

CREATE TABLE `reg_schema_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `schema_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) NOT NULL,
  `definition` text,
  `comment` text,
  `type` enum('property','subproperty','class','subclass') NOT NULL DEFAULT 'property',
  `is_subproperty_of` int(11) DEFAULT NULL,
  `parent_uri` varchar(255) DEFAULT NULL,
  `uri` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `language` varchar(6) NOT NULL DEFAULT '',
  `note` text,
  `domain` varchar(255) DEFAULT NULL,
  `is_deprecated` tinyint(1) DEFAULT NULL COMMENT 'Boolean. Has this class/property been deprecated',
  `orange` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  KEY `schema_id` (`schema_id`),
  KEY `subproperty_id` (`is_subproperty_of`),
  KEY `status_id` (`status_id`),
  KEY `reg_schema_property_idx1` (`uri`),
  CONSTRAINT `reg_schema_property_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk2` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk3` FOREIGN KEY (`is_subproperty_of`) REFERENCES `reg_schema_property` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_fk4` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_schema_property_element
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema_property_element`;

CREATE TABLE `reg_schema_property_element` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `schema_property_id` int(11) NOT NULL,
  `profile_property_id` int(11) NOT NULL,
  `is_schema_property` tinyint(1) DEFAULT NULL,
  `object` text NOT NULL,
  `related_schema_property_id` int(11) DEFAULT NULL,
  `language` char(6) DEFAULT 'en',
  `status_id` int(11) DEFAULT '1',
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  KEY `schema_property_id` (`schema_property_id`),
  KEY `related_property_id` (`related_schema_property_id`),
  KEY `status_id` (`status_id`),
  KEY `profile_property_id` (`profile_property_id`),
  KEY `reg_schema_property_element_idx1` (`object`(1)),
  KEY `reg_schema_property_element_idx2` (`updated_at`),
  CONSTRAINT `reg_schema_property_element_fk` FOREIGN KEY (`profile_property_id`) REFERENCES `profile_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk2` FOREIGN KEY (`schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk3` FOREIGN KEY (`related_schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_property_fk4` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_schema_property_element_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_schema_property_element_history`;

CREATE TABLE `reg_schema_property_element_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_user_id` int(11) DEFAULT NULL,
  `action` enum('updated','added','deleted','force_deleted') DEFAULT NULL,
  `schema_property_element_id` int(11) DEFAULT NULL,
  `schema_property_id` int(11) DEFAULT NULL,
  `schema_id` int(11) DEFAULT NULL,
  `profile_property_id` int(11) DEFAULT NULL,
  `object` text,
  `related_schema_property_id` int(11) DEFAULT NULL,
  `language` char(6) DEFAULT 'en',
  `status_id` int(11) DEFAULT '1',
  `change_note` text,
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `schema_property_element_id` (`schema_property_element_id`),
  KEY `schema_property_id` (`schema_property_id`),
  KEY `schema_id` (`schema_id`),
  KEY `related_schema_property_id` (`related_schema_property_id`),
  KEY `status_id` (`status_id`),
  KEY `profile_property_id` (`profile_property_id`),
  KEY `reg_schema_property_element_history_idx1` (`created_at`),
  CONSTRAINT `reg_schema_property_element_history_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk1` FOREIGN KEY (`schema_property_element_id`) REFERENCES `reg_schema_property_element` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk2` FOREIGN KEY (`schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk3` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk4` FOREIGN KEY (`related_schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk5` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_history_fk6` FOREIGN KEY (`profile_property_id`) REFERENCES `profile_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reg_skos_property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_skos_property`;

CREATE TABLE `reg_skos_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `inverse_id` int(11) DEFAULT NULL COMMENT 'id of the inverse property',
  `name` varchar(255) NOT NULL COMMENT 'The name of the property',
  `uri` varchar(255) NOT NULL COMMENT 'The URI of the property',
  `object_type` enum('resource','literal') NOT NULL DEFAULT 'resource' COMMENT 'the type of the object for which this is the predicate',
  `display_order` int(11) DEFAULT NULL COMMENT 'Display order of properties',
  `picklist_order` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL COMMENT 'The pretty label for the property',
  `definition` text,
  `comment` text,
  `examples` varchar(255) DEFAULT NULL COMMENT 'Link to example usage',
  `is_required` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean -- id this value required',
  `is_reciprocal` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean - subject and object must both have this property',
  `is_singleton` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean -- is this property allowed to repeat for a concept',
  `is_scheme` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean - is in conceptScheme domain',
  `is_in_picklist` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - is in the property picklist',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `uri` (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains a list of available predicates for skos concepts co';

LOCK TABLES `reg_skos_property` WRITE;
/*!40000 ALTER TABLE `reg_skos_property` DISABLE KEYS */;

INSERT INTO `reg_skos_property` (`id`, `parent_id`, `inverse_id`, `name`, `uri`, `object_type`, `display_order`, `picklist_order`, `label`, `definition`, `comment`, `examples`, `is_required`, `is_reciprocal`, `is_singleton`, `is_scheme`, `is_in_picklist`)
VALUES
	(1,0,NULL,'altLabel','http://www.w3.org/2004/02/skos/core#altLabel','literal',1,110,'alternative label','An alternative lexical label for a resource.','Acronyms, abbreviations, spelling variants, and irregular plural/singular forms may be included among the alternative labels for a concept. Mis-spelled terms are normally included as hidden labels (see skos:hiddenLabel).','http://www.w3.org/2004/02/skos/core/examples/altLabel.rdf.xml',0,0,0,0,1),
	(3,NULL,16,'broader','http://www.w3.org/2004/02/skos/core#broader','resource',3,400,'has broader','A concept that is more general in meaning.','Broader concepts are typically rendered as parents in a concept hierarchy (tree).','http://www.w3.org/2004/02/skos/core/examples/broader.rdf.xml',0,0,0,0,1),
	(4,17,NULL,'changeNote','http://www.w3.org/2004/02/skos/core#changeNote','literal',4,320,'change note','A note about a modification to a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/changeNote.rdf.xml',0,0,0,0,1),
	(5,17,NULL,'definition','http://www.w3.org/2004/02/skos/core#definition','literal',NULL,205,'definition','A statement or formal explanation of the meaning of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/definition.rdf.xml',0,0,0,0,1),
	(6,17,NULL,'editorialNote','http://www.w3.org/2004/02/skos/core#editorialNote','literal',NULL,310,'editorial note','A note for an editor, translator or maintainer of the vocabulary.',NULL,'http://www.w3.org/2004/02/skos/core/examples/editorialNote.rdf.xml',0,0,0,0,1),
	(7,17,NULL,'example','http://www.w3.org/2004/02/skos/core#example','literal',NULL,210,'example','An example of the use of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/example.rdf.xml',0,0,0,0,1),
	(9,0,NULL,'hiddenLabel','http://www.w3.org/2004/02/skos/core#hiddenLabel','literal',NULL,120,'hidden label','A lexical label for a resource that should be hidden when generating visual displays of the resource, but should still be accessible to free text search operations.',NULL,'http://www.w3.org/2004/02/skos/core/examples/hiddenLabel.rdf.xml',0,0,0,0,1),
	(10,17,NULL,'historyNote','http://www.w3.org/2004/02/skos/core#historyNote','literal',NULL,330,'history note',NULL,'A note about the past state/use/meaning of a concept.','http://www.w3.org/2004/02/skos/core/examples/historyNote.rdf.xml',0,0,0,0,1),
	(11,NULL,0,'inScheme','http://www.w3.org/2004/02/skos/core#inScheme','resource',NULL,600,'in scheme','A concept scheme in which the concept is included.','A concept may be a member of more than one concept scheme.','http://www.w3.org/2004/02/skos/core/examples/inScheme.rdf.xml',1,0,0,0,0),
	(16,NULL,3,'narrower','http://www.w3.org/2004/02/skos/core#narrower','resource',NULL,410,'has narrower','A concept that is more specific in meaning.','Narrower concepts are typically rendered as children in a concept hierarchy (tree).','http://www.w3.org/2004/02/skos/core/examples/narrower.rdf.xml',0,0,0,0,1),
	(17,NULL,NULL,'note','http://www.w3.org/2004/02/skos/core#note','literal',NULL,200,'note','A general note, for any purpose.','This property may be used directly, or as a super-property for more specific note types.','http://www.w3.org/2004/02/skos/core/examples/note.rdf.xml',0,0,0,0,1),
	(19,0,NULL,'prefLabel','http://www.w3.org/2004/02/skos/core#prefLabel','literal',NULL,100,'preferred label','The preferred lexical label for a resource, in a given language.','No two concepts in the same concept scheme may have the same value for skos:prefLabel in a given language.','http://www.w3.org/2004/02/skos/core/examples/prefLabel.rdf.xml',1,0,0,0,1),
	(21,NULL,21,'related','http://www.w3.org/2004/02/skos/core#related','resource',NULL,420,'related to','A concept with which there is an associative semantic relationship.',NULL,'http://www.w3.org/2004/02/skos/core/examples/related.rdf.xml',0,1,0,0,1),
	(22,17,NULL,'scopeNote','http://www.w3.org/2004/02/skos/core#scopeNote','literal',NULL,300,'scope note','A note that helps to clarify the meaning of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/scopeNote.rdf.xml',0,0,0,0,1),
	(27,NULL,NULL,'label','http://www.w3.org/2000/01/rdf-schema#label','literal',NULL,90,'label','A human-readable name for the subject.',NULL,NULL,0,0,0,0,0),
	(28,NULL,29,'hasTopConcept','http://www.w3.org/2004/02/skos/core#hasTopConcept','literal',NULL,NULL,'has top concept','Relates, by convention, a concept scheme to a concept which is topmost in the broader/narrower concept hierarchies for that scheme, providing an entry point to these hierarchies.',NULL,NULL,0,0,0,0,0),
	(29,11,28,'topConceptOf','http://www.w3.org/2004/02/skos/core#topConceptOf','resource',NULL,610,'top concept of','Relates a concept to the concept scheme that it is a top level concept of.',NULL,NULL,0,0,0,0,0),
	(30,NULL,NULL,'notation','http://www.w3.org/2004/02/skos/core#notation','literal',NULL,140,'notation',NULL,NULL,NULL,0,0,0,0,1),
	(31,NULL,NULL,'ConceptScheme','http://www.w3.org/2004/02/skos/core#ConceptScheme','resource',NULL,NULL,'Concept Scheme','A set of concepts, optionally including statements about semantic relationships between those concepts.','A concept scheme may be defined to include concepts from different sources.',NULL,0,0,0,0,0),
	(32,37,33,'broadMatch','http://www.w3.org/2004/02/skos/core#broadMatch','resource',NULL,500,'has broader match','skos:broadMatch is used to state a hierarchical mapping link between two conceptual resources in different concept schemes.',NULL,NULL,0,0,0,0,1),
	(33,37,32,'narrowMatch','http://www.w3.org/2004/02/skos/core#narrowMatch','resource',NULL,510,'has narrower match','skos:narrowMatch is used to state a hierarchical mapping link between two conceptual resources in different concept schemes.',NULL,NULL,0,0,0,0,1),
	(34,37,34,'relatedMatch','http://www.w3.org/2004/02/skos/core#relatedMatch','resource',NULL,520,'has related match','skos:relatedMatch is used to state an associative mapping link between two conceptual resources in different concept schemes.',NULL,NULL,0,1,0,0,1),
	(35,37,35,'exactMatch','http://www.w3.org/2004/02/skos/core#exactMatch','resource',NULL,540,'has exact match','skos:exactMatch is used to link two concepts, indicating a high degree of confidence that the concepts can be used interchangeably across a wide range of information retrieval applications. skos:exactMatch is a transitive property, and is a sub-property of skos:closeMatch.','skos:exactMatch is disjoint with each of the properties skos:broadMatch and skos:relatedMatch.',NULL,0,1,0,0,1),
	(36,37,36,'closeMatch','http://www.w3.org/2004/02/skos/core#closeMatch','resource',NULL,530,'has close match','skos:closeMatch is used to link two concepts that are sufficiently similar that they can be used interchangeably in some information retrieval applications. In order to avoid the possibility of \"compound errors\" when combining mappings across more than two concept schemes, skos:closeMatch is not declared to be a transitive property.',NULL,NULL,0,1,0,0,1),
	(37,NULL,NULL,'mappingRelation','http://www.w3.org/2004/02/skos/core#mappingRelation','resource',NULL,490,'is in mapping relation with','Relates two concepts coming, by convention, from different schemes, and that have comparable meanings','These concept mapping relations mirror semantic relations, and the data model defined below is similar (with the exception of skos:exactMatch) to the data model defined for semantic relations. A distinct vocabulary is provided for concept mapping relations, to provide a convenient way to differentiate links within a concept scheme from links between concept schemes. However, this pattern of usage is not a formal requirement of the SKOS data model, and relies on informal definitions of best practice.',NULL,0,0,0,0,1);

/*!40000 ALTER TABLE `reg_skos_property` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reg_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_status`;

CREATE TABLE `reg_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_order` int(11) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reg_status` WRITE;
/*!40000 ALTER TABLE `reg_status` DISABLE KEYS */;

INSERT INTO `reg_status` (`id`, `display_order`, `display_name`, `uri`)
VALUES
	(1,7,'Published','http://metadataregistry.org/uri/RegStatus/1001'),
	(2,1,'New-Proposed','http://metadataregistry.org/uri/RegStatus/1002'),
	(3,2,'Change-Proposed','http://metadataregistry.org/uri/RegStatus/1003'),
	(4,3,'Deprecate-Proposed','http://metadataregistry.org/uri/RegStatus/1004'),
	(5,4,'New-Under Review','http://metadataregistry.org/uri/RegStatus/1005'),
	(6,5,'Change-Under Review','http://metadataregistry.org/uri/RegStatus/1006'),
	(7,6,'Deprecate-Under Review','http://metadataregistry.org/uri/RegStatus/1007'),
	(8,8,'Deprecated','http://metadataregistry.org/uri/RegStatus/1008'),
	(9,9,'Not Approved','http://metadataregistry.org/uri/RegStatus/1009');

/*!40000 ALTER TABLE `reg_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reg_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_user`;

CREATE TABLE `reg_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `salutation` varchar(5) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sha1_password` varchar(40) DEFAULT NULL,
  `salt` varchar(32) DEFAULT NULL,
  `want_to_be_moderator` tinyint(1) DEFAULT '0',
  `is_moderator` tinyint(1) DEFAULT '0',
  `is_administrator` tinyint(1) DEFAULT '0',
  `deletions` int(11) DEFAULT '0',
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=334;

LOCK TABLES `reg_user` WRITE;
/*!40000 ALTER TABLE `reg_user` DISABLE KEYS */;

INSERT INTO `reg_user` (`id`, `created_at`, `last_updated`, `deleted_at`, `nickname`, `salutation`, `first_name`, `last_name`, `email`, `sha1_password`, `salt`, `want_to_be_moderator`, `is_moderator`, `is_administrator`, `deletions`, `password`)
VALUES
	(1,'2006-03-24 17:29:24','2007-06-04 15:04:28',NULL,'joeadmin',NULL,'Joe','Admin','admin@example.com','ad595c0e9bc6b0a9be194ad5bbcb2cd82eaee6ce','1d4c1324f5cacadf382702601d32c107',NULL,0,1,0,NULL),
	(2,'2010-05-16 03:54:59','2010-05-16 07:54:59',NULL,'admin',NULL,NULL,NULL,'admin@foobar.com','a56b209fbde14d37a6cee7507d0017de93ead3cf','4a7e518b8b6bc8d25a35a72632900bb1',0,0,0,0,NULL);

/*!40000 ALTER TABLE `reg_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reg_vocabulary
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary`;

CREATE TABLE `reg_vocabulary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `child_updated_at` datetime DEFAULT NULL,
  `child_updated_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `note` text,
  `uri` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) DEFAULT NULL,
  `base_domain` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(45) NOT NULL DEFAULT '',
  `community` varchar(45) DEFAULT NULL,
  `last_uri_id` int(11) DEFAULT '1000',
  `status_id` int(11) NOT NULL DEFAULT '1' COMMENT 'This will be the default status id for all concept properties for this vocabulary',
  `language` char(6) NOT NULL DEFAULT 'en' COMMENT 'This is the default language for all concept properties',
  PRIMARY KEY (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `status_id` (`status_id`),
  KEY `last_updated_by_user_id` (`updated_user_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `child_updated_user_id` (`child_updated_user_id`),
  KEY `reg_vocabulary_idx1` (`uri`),
  KEY `reg_vocabulary_idx2` (`name`),
  CONSTRAINT `reg_vocabulary_FK_` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_FK_1` FOREIGN KEY (`updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_FK_2` FOREIGN KEY (`child_updated_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `vocabulary_agent_fk` FOREIGN KEY (`agent_id`) REFERENCES `reg_agent` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `vocabulary_status_fk` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1092;



# Dump of table reg_vocabulary_has_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary_has_user`;

CREATE TABLE `reg_vocabulary_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `vocabulary_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `is_maintainer_for` tinyint(1) DEFAULT '1',
  `is_registrar_for` tinyint(1) DEFAULT '1',
  `is_admin_for` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource_user_id` (`vocabulary_id`,`user_id`) USING BTREE,
  UNIQUE KEY `user_resource_id` (`user_id`,`vocabulary_id`),
  CONSTRAINT `reg_resource_has_user_fk1` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_has_user_fk` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=390 COMMENT='InnoDB free: 0 kB; (`agent_id`) REFER `swregistry/reg_agent`';



# Dump of table reg_vocabulary_has_version
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reg_vocabulary_has_version`;

CREATE TABLE `reg_vocabulary_has_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `vocabulary_id` int(11) DEFAULT NULL,
  `timeslice` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `name` (`name`),
  CONSTRAINT `reg_vocabulary_has_version_FK_user` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_vocabulary_has_version_FK_vocabulary` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table schema_has_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `schema_has_user`;

CREATE TABLE `schema_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `schema_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `is_maintainer_for` tinyint(1) DEFAULT '1',
  `is_registrar_for` tinyint(1) DEFAULT '1',
  `is_admin_for` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `schema_id` (`schema_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `schema_has_user_fk` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `schema_has_user_fk1` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table schema_has_version
# ------------------------------------------------------------

DROP TABLE IF EXISTS `schema_has_version`;

CREATE TABLE `schema_has_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `schema_id` int(11) DEFAULT NULL,
  `timeslice` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `schema_id` (`schema_id`),
  CONSTRAINT `schema_has_version_fk` FOREIGN KEY (`created_user_id`) REFERENCES `reg_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `schema_has_version_fk1` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
