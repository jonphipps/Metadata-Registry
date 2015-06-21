#
# SQL Export
# Created by Querious (945)
# Created: January 24, 2015 at 6:51:56 PM EST
# Encoding: Unicode (UTF-8)
#


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
  `name` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) NOT NULL DEFAULT '',
  `definition` text,
  `comment` text,
  `type` enum('property','subproperty','class','subclass') NOT NULL DEFAULT 'property',
  `uri` varchar(255) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `language` varchar(6) NOT NULL DEFAULT 'en',
  `note` text,
  `display_order` int(11) DEFAULT NULL COMMENT 'Display order of properties',
  `export_order` int(11) DEFAULT NULL COMMENT 'Display order of properties',
  `picklist_order` int(11) DEFAULT NULL,
  `examples` varchar(255) DEFAULT NULL COMMENT 'Link to example usage',
  `is_required` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean -- id this value required',
  `is_reciprocal` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean - subject and object must both have this property',
  `is_singleton` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean -- is this property allowed to repeat for a concept',
  `is_in_picklist` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - is in the property picklist',
  `is_in_export` tinyint(1) NOT NULL DEFAULT '1',
  `inverse_profile_property_id` int(11) DEFAULT NULL COMMENT 'id of the inverse property',
  `is_in_class_picklist` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - is in the property picklist',
  `is_in_property_picklist` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - is in the property picklist',
  `is_in_rdf` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - should this display in the RDF',
  `is_in_xsd` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'boolean - should this display in the XSD',
  `is_attribute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'boolean - is this an attribute? attribute''s aren''t editable outside the main form',
  `has_language` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Boolean that determines whether language attribute is displayed for this property',
  `is_object_prop` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `profile_property_status_id` (`status_id`),
  KEY `profile_property_updated_by` (`updated_by`),
  KEY `profile_property_created_by` (`created_by`),
  KEY `profile_property_deleted_by` (`deleted_by`),
  KEY `inverse_profile_property_id` (`inverse_profile_property_id`),
  KEY `profile_id` (`profile_id`) USING BTREE,
  CONSTRAINT `profile_property_agent_FK` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_fk` FOREIGN KEY (`inverse_profile_property_id`) REFERENCES `profile_property` (`id`),
  CONSTRAINT `profile_property_status_FK` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`),
  CONSTRAINT `profile_property_user_FK_1` FOREIGN KEY (`updated_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_user_FK_2` FOREIGN KEY (`created_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `profile_property_user_FK_3` FOREIGN KEY (`deleted_by`) REFERENCES `reg_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1170;




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `profile_property` WRITE;
ALTER TABLE `profile_property` DISABLE KEYS;
INSERT INTO `profile_property` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `profile_id`, `name`, `label`, `definition`, `comment`, `type`, `uri`, `status_id`, `language`, `note`, `display_order`, `export_order`, `picklist_order`, `examples`, `is_required`, `is_reciprocal`, `is_singleton`, `is_in_picklist`, `is_in_export`, `inverse_profile_property_id`, `is_in_class_picklist`, `is_in_property_picklist`, `is_in_rdf`, `is_in_xsd`, `is_attribute`, `has_language`, `is_object_prop`) VALUES 
	(1,'2008-04-20 12:00:00','2008-04-20 15:00:00',NULL,36,36,NULL,1,'name','name',NULL,NULL,'property','reg:name',1,'en',NULL,1,3,1,NULL,1,0,1,0,1,NULL,0,0,1,1,1,1,0),
	(2,'2008-04-20 12:00:00','2008-04-20 15:00:00',NULL,36,36,NULL,1,'label','label',NULL,NULL,'property','rdfs:label',1,'en',NULL,2,4,2,NULL,1,0,0,1,1,NULL,1,1,1,1,0,1,0),
	(3,'2008-04-20 12:01:00','2008-04-20 15:01:01',NULL,36,36,NULL,1,'definition','description',NULL,NULL,'property','skos:definition',1,'en',NULL,3,6,3,NULL,0,0,0,1,1,NULL,1,1,1,1,0,1,0),
	(4,'2008-04-20 12:02:00','2008-04-20 15:02:00',NULL,36,36,NULL,1,'type','type',NULL,NULL,'property','rdf:type',1,'en',NULL,5,2,5,NULL,1,0,1,0,1,NULL,0,0,1,1,1,0,1),
	(5,'2008-04-20 00:02:00','2008-04-20 03:02:02',NULL,36,36,NULL,1,'comment','comment',NULL,NULL,'property','rdfs:comment',1,'en',NULL,4,8,4,NULL,0,0,0,1,1,NULL,1,1,1,1,0,1,0),
	(6,'2008-04-20 00:03:00','2008-04-20 15:03:00',NULL,36,36,NULL,1,'isSubpropertyOf','subPropertyOf',NULL,NULL,'property','rdfs:subPropertyOf',1,'en',NULL,6,14,6,NULL,0,0,0,1,1,8,0,1,1,1,0,0,1),
	(7,'2008-04-20 00:04:00','2008-04-20 03:04:00',NULL,36,36,NULL,1,'note','note',NULL,NULL,'property','skos:scopeNote',1,'en',NULL,8,7,8,NULL,0,0,0,1,1,NULL,1,1,1,1,0,1,0),
	(8,'2008-04-20 12:05:00','2008-04-20 15:05:00',NULL,36,36,NULL,1,'hasSubproperty','hasSubproperty',NULL,NULL,'property','reg:hasSubproperty',1,'en',NULL,7,15,7,NULL,0,0,0,0,0,6,0,0,1,1,1,0,1),
	(9,'2009-03-07 11:49:27','2009-03-07 14:49:27',NULL,36,36,NULL,1,'isSubclassOf','subClassOf','','','property','rdfs:subClassOf',1,'en','',9,12,9,'',0,0,0,0,1,10,1,0,1,1,0,0,1),
	(10,'2009-03-07 11:53:34','2009-03-07 14:53:34',NULL,36,36,NULL,1,'hasSubClass','hasSubClass',NULL,NULL,'property','reg:hasSubClass',1,'en',NULL,10,13,10,NULL,0,0,0,0,0,9,1,0,1,1,1,0,1),
	(11,'2009-03-07 11:57:15','2009-03-07 14:57:15',NULL,36,36,NULL,1,'domain','domain',NULL,NULL,'property','rdfs:domain',1,'en',NULL,11,9,11,NULL,0,0,0,1,1,NULL,0,1,1,1,0,0,1),
	(12,'2009-03-07 12:01:38','2009-03-07 15:01:38',NULL,36,36,NULL,1,'orange','range',NULL,NULL,'property','rdfs:range',1,'en',NULL,12,10,12,NULL,0,0,0,1,1,NULL,0,1,1,1,0,0,1),
	(13,'2009-03-07 12:01:38','2009-03-07 15:01:38',NULL,36,36,NULL,1,'uri','uri',NULL,NULL,'property','reg:uri',1,'en',NULL,0,1,13,NULL,1,0,1,0,1,NULL,0,0,0,1,1,0,1),
	(14,'2009-03-07 12:01:38','2009-03-07 15:01:38',NULL,36,36,NULL,1,'statusId','status',NULL,NULL,'property','reg:status',1,'en',NULL,27,26,27,NULL,1,0,1,0,1,NULL,0,0,0,1,1,0,1),
	(15,'2011-09-29 14:12:00','2011-09-29 10:20:25',NULL,36,36,NULL,1,'isInverseOf','inverseOf','','The property that determines that two given properties are inverse.','property','owl:inverseOf',1,'en','',15,16,15,'',0,1,0,1,1,NULL,0,1,1,0,0,0,1),
	(16,'2011-09-29 14:23:24','2011-09-29 10:23:24',NULL,36,36,NULL,1,'isSameAs','sameAs','','The property that determines that two given individuals are equal.','property','owl:sameAs',1,'en','',16,17,16,'',0,1,0,1,1,NULL,1,1,1,0,0,0,1),
	(17,'2011-09-29 14:26:25','2011-09-29 10:26:25',NULL,36,36,NULL,1,'propertyIsDisjointWith','propertyDisjointWith','','Used to specify that two properties are mutually disjoint, and it is defined as a property itself. ','property','owl:propertyDisjointWith',1,'en','',17,18,17,'',0,1,0,1,1,NULL,0,1,1,1,0,0,1),
	(18,'2011-09-29 14:28:57','2011-09-29 10:28:57',NULL,36,36,NULL,1,'isEquivalentClass','equivalentClass','','The property that determines that two given classes are equivalent, and that is used to specify datatype definitions.','property','owl:equivalentClass',1,'en','',19,20,19,'',0,1,0,1,1,NULL,1,0,1,1,0,0,1),
	(19,'2011-09-29 14:30:00','2011-09-29 10:30:00',NULL,36,36,NULL,1,'isEquivalentProperty','equivalentProperty','','','property','owl:equivalentProperty',1,'en','',20,21,20,'',0,1,0,1,1,NULL,0,1,1,1,0,0,1),
	(20,'2012-02-02 23:21:08','2012-02-02 18:21:08',NULL,36,36,NULL,1,'isDisjointWith','disjointWith','','The property that determines that two given properties are disjoint.','property','owl:disjointWith',1,'en','',18,19,18,'',0,1,0,1,1,NULL,1,1,1,1,0,0,1),
	(21,'2012-06-02 23:21:08','2012-06-02 19:21:08',NULL,36,36,NULL,1,'altLabel','altLabel',NULL,NULL,'property','skos:altLabel',1,'en',NULL,21,22,21,NULL,0,0,0,1,1,NULL,1,1,1,1,0,1,0),
	(23,'2014-01-18 04:04:02','2014-01-17 23:04:02',NULL,36,36,NULL,1,'narrowMatch','narrowMatch',NULL,NULL,'property','skos:narrowMatch',1,'en',NULL,24,25,24,NULL,0,0,0,1,1,NULL,1,1,1,1,0,0,1),
	(24,'2014-01-18 04:04:01','2014-01-17 23:04:01',NULL,36,36,NULL,1,'closeMatch','closeMatch',NULL,NULL,'property','skos:closeMatch',1,'en',NULL,23,24,23,NULL,0,0,0,1,1,NULL,1,1,1,1,0,0,1),
	(25,'2014-01-18 04:04:00','2014-01-17 23:04:00',NULL,36,36,NULL,1,'broadMatch','broadMatch',NULL,NULL,'property','skos:broadMatch',1,'en',NULL,22,23,22,NULL,0,0,0,1,1,NULL,1,1,1,1,0,0,1),
	(26,'2011-09-29 14:23:24','2011-09-29 10:23:24',NULL,36,36,NULL,1,'hasUnconstrained','hasUnconstrained','','','property','reg:hasUnconstrained',1,'en','',26,11,26,'',0,1,1,1,1,NULL,1,1,1,0,0,0,1),
	(27,'2011-09-29 14:23:24','2011-09-29 10:23:24',NULL,36,36,NULL,1,'lexicalAlias','lexicalAlias','','','property','reg:lexicalAlias',1,'en','',25,5,25,'',0,0,0,1,1,NULL,1,1,1,0,0,1,1);
ALTER TABLE `profile_property` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


