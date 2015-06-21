#
# SQL Export
# Created by Querious (945)
# Created: January 27, 2015 at 10:19:22 AM EST
# Encoding: Unicode (UTF-8)
#


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
  `label` varchar(255) NOT NULL DEFAULT '',
  `definition` text,
  `comment` text,
  `type` enum('property','subproperty','class','subclass') NOT NULL DEFAULT 'property',
  `is_subproperty_of` int(11) DEFAULT NULL,
  `parent_uri` varchar(255) DEFAULT NULL,
  `uri` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `language` varchar(6) NOT NULL DEFAULT '',
  `note` text,
  `domain` varchar(255) DEFAULT NULL,
  `orange` varchar(255) DEFAULT NULL,
  `is_deprecated` tinyint(1) DEFAULT NULL COMMENT 'Boolean. Has this class/property been deprecated',
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 COMMENT='InnoDB free: 0 kB;';




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `reg_schema_property` WRITE;
ALTER TABLE `reg_schema_property` DISABLE KEYS;
INSERT INTO `reg_schema_property` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_user_id`, `updated_user_id`, `schema_id`, `name`, `label`, `definition`, `comment`, `type`, `is_subproperty_of`, `parent_uri`, `uri`, `url`, `status_id`, `language`, `note`, `domain`, `orange`, `is_deprecated`) VALUES 
	(1,'2015-01-11 01:51:30','2015-01-11 01:51:30',NULL,1,1,1,'subjectTo','subject to','This property associates a publication, i.e. an instance of F3 Manifestation Product Type, with an instance of E30 Right, which applies to all exemplars of that publication, as long as they are recognised as exemplars of that publication.','This property associates a publication, i.e. an instance of F3 Manifestation Product Type, with an instance of E30 Right, which applies to all exemplars of that publication, as long as they are recognised as exemplars of that publication. The rights covered by this property may include: acquisition or access authorisation; terms of availability; access restrictions on the Manifestation Product Type; etc.','property',NULL,NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/CLP104',NULL,1,'en','The rights covered by this property may include: acquisition or access authorisation; terms of availability; access restrictions on the Manifestation Product Type; etc.','http://iflastandards.info/ns/fr/frbr/frbroo/F3','http://www.cidoc-crm.org/cidoc-crm/E30_Right',NULL),
	(2,'2015-01-11 01:51:31','2015-01-11 01:51:31',NULL,1,1,1,'appliesTo','applies to',NULL,'Inverse of CLP104_subject_to.','property',NULL,NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/CLP104i',NULL,1,'en',NULL,'http://www.cidoc-crm.org/cidoc-crm/E30_Right','http://iflastandards.info/ns/fr/frbr/frbroo/F3',NULL),
	(3,'2015-01-11 01:51:32','2015-01-11 01:51:32',NULL,1,1,1,'rightHeldBy','right held by','This property associates a publication, i.e. an instance of F3 Manifestation Product Type, with an instance of E39 Actor, who holds an instance of E30 Right on all exemplars of that publication, as long as they are recognised as exemplars of that publication.','This property associates a publication, i.e. an instance of F3 Manifestation Product Type, with an instance of E39 Actor, who holds an instance of E30 Right on all exemplars of that publication, as long as they are recognised as exemplars of that publication.','property',NULL,NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/CLP105',NULL,1,'en',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/F3','http://www.cidoc-crm.org/cidoc-crm/E39_Actor',NULL),
	(4,'2015-01-11 01:51:32','2015-01-11 01:51:32',NULL,1,1,1,'Identifier','Identifier','This class comprises strings or codes assigned to instances of E1 CRM Entity in order to identify them uniquely and permanently within the context of one or more organisations. Such codes are often known as inventory numbers, registration codes, etc. and are typically composed of alphanumeric sequences.','This class comprises strings or codes assigned to instances of E1 CRM Entity in order to identify them uniquely and permanently within the context of one or more organisations. Such codes are often known as inventory numbers, registration codes, etc. and are typically composed of alphanumeric sequences. The class E42 Identifier is not normally used for machine-generated identifiers used for automated processing unless these are also used by human agents. [Adapted from the Scope Note of CIDOC CRM E42 Identifier ver. 5.0.1]','subclass',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/F12','http://iflastandards.info/ns/fr/frbr/frbroo/F13',NULL,1,'en','The class E42 Identifier is not normally used for machine-generated identifiers used for automated processing unless these are also used by human agents.',NULL,NULL,NULL),
	(5,'2015-01-11 01:51:33','2015-01-11 01:51:33',NULL,1,1,1,'KOS','KOS','This class comprises documents that establish controlled terminology (nomina) for consistent use. They may also describe relationships between entities and controlled terminology and relationships between entities.','This class comprises documents that establish controlled terminology (nomina) for consistent use. They may also describe relationships between entities and controlled terminology and relationships between entities. Note that any meaningful change in a Knowledge Organisation System (KOS) that affects the validity status of its elements defines a new release (Expression) of the KOS. Note that identifiers created following a rule in a KOS are to be regarded as being taken from this KOS, even though not explicitly spelled out. This definition of KOS reflects current library practice and not the use of the term in general.','subclass',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/F2','http://iflastandards.info/ns/fr/frbr/frbroo/F34',NULL,1,'en','Note that any meaningful change in a Knowledge Organisation System (KOS) that affects the validity status of its elements defines a new release (Expression) of the KOS. Note that identifiers created following a rule in a KOS are to be regarded as being taken from this KOS, even though not explicitly spelled out. This definition of KOS reflects current library practice and not the use of the term in general.',NULL,NULL,NULL),
	(6,'2015-01-11 01:51:34','2015-01-11 01:51:34',NULL,1,1,1,'NomenUseStatement','Nomen Use Statement','This class comprises statements relating a Thema with a particular Nomen and its usage in the context of a common Complex Work realized by one or more KOS.','This class comprises statements relating a Thema with a particular Nomen and its usage in the context of a common Complex Work realized by one or more KOS.','subclass',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/F2','http://iflastandards.info/ns/fr/frbr/frbroo/F35',NULL,1,'en',NULL,NULL,NULL,NULL),
	(7,'2015-01-11 01:51:34','2015-01-11 01:51:34',NULL,1,1,1,'isLogicalSuccessorOf','is logical successor of','This property associates an instance of F1 Work which logically continues the content of another instance of F1 Work with the latter.','This property associates an instance of F1 Work which logically continues the content of another instance of F1 Work with the latter.','subproperty',NULL,'http://www.cidoc-crm.org/cidoc-crm/P130_shows_features_of','http://iflastandards.info/ns/fr/frbr/frbroo/R1',NULL,1,'en',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/F1','http://iflastandards.info/ns/fr/frbr/frbroo/F1',NULL),
	(8,'2015-01-11 01:51:35','2015-01-11 01:51:35',NULL,1,1,1,'incorporates','incorporates','This property associates an instance of F22 Self-Contained Expression with an instance of F2 Expression that was included in it and that is a realisation of an independent work. The incorporated expression may be self-contained or fragmentary.','This property associates an instance of F22 Self-Contained Expression with an instance of F2 Expression that was included in it and that is a realisation of an independent work. The incorporated expression may be self-contained or fragmentary. This property makes it possible to recognise the autonomous status of the incorporated expression, which was created in a distinct context, and can be incorporated in many distinct self-contained expressions, and to highlight the difference between structural and accidental whole-part relationships between conceptual entities. It accounts for many cultural facts that are quite frequent and significant: the inclusion of a poem in an anthology, the re-use of an operatic aria in a new opera, the use of a reproduction of a painting for a book cover or a CD booklet, the integration of textual quotations, the presence of lyrics in a song that sets those lyrics to music, the presence of the text of a play in a movie based on that play, etc.','subproperty',NULL,'http://www.cidoc-crm.org/cidoc-crm/P148_has_component','http://iflastandards.info/ns/fr/frbr/frbroo/R14',NULL,1,'en','This property makes it possible to recognise the autonomous status of the incorporated expression, which was created in a distinct context, and can be incorporated in many distinct self-contained expressions, and to highlight the difference between structural and accidental whole-part relationships between conceptual entities. It accounts for many cultural facts that are quite frequent and significant: the inclusion of a poem in an anthology, the re-use of an operatic aria in a new opera, the use of a reproduction of a painting for a book cover or a CD booklet, the integration of textual quotations, the presence of lyrics in a song that sets those lyrics to music, the presence of the text of a play in a movie based on that play, etc.','http://iflastandards.info/ns/fr/frbr/frbroo/F22','http://iflastandards.info/ns/fr/frbr/frbroo/F2',NULL),
	(9,'2015-01-11 01:51:36','2015-01-11 01:51:36',NULL,1,1,1,'isRealisedInRecordingOfRecordingWork','is realised in Recording of Recording Work','This property associates an instance of F21 Recording Work with an instance of F26 Recording realising the instance of F21 Recording work.','This property associates an instance of F21 Recording Work with an instance of F26 Recording realising the instance of F21 Recording work. This is a shortcut of the more elaborated path through R22 was realised through, F29 Recording Event and R21 created, which should be used when information about the recording event is available.','subproperty',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/R3','http://iflastandards.info/ns/fr/frbr/frbroo/R13',NULL,1,'en','This is a shortcut of the more elaborated path through R22 was realised through, F29 Recording Event and R21 created, which should be used when information about the recording event is available.','http://iflastandards.info/ns/fr/frbr/frbroo/F21','http://iflastandards.info/ns/fr/frbr/frbroo/F26',NULL),
	(10,'2015-01-11 01:51:36','2015-01-11 01:51:36',NULL,1,1,1,'realisesRecordingWorkByRecording','realises Recording Work by Recording',NULL,'Inverse of R13_is_realised_in.','subproperty',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/R3i','http://iflastandards.info/ns/fr/frbr/frbroo/R13i',NULL,1,'en',NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/F26','http://iflastandards.info/ns/fr/frbr/frbroo/F21',NULL),
	(11,'2015-01-11 01:51:37','2015-01-11 01:51:37',NULL,1,1,1,'hasIssuingRule','has issuing rule','This property associates an instance of F18 Serial Work with the instance of E29 Design or Procedure that specifies the issuing policy planned by this Work, such as sequencing pattern, expected frequency and expected regularity.','This property associates an instance of F18 Serial Work with the instance of E29 Design or Procedure that specifies the issuing policy planned by this Work, such as sequencing pattern, expected frequency and expected regularity. This property is a shortcut of the full path: F18 Serial Work R23B was realised through F30 Publication Event P16 used specific object E29 Design or Procedure.','property',NULL,NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/R11',NULL,1,'en','This property is a shortcut of the full path: F18 Serial Work R23B was realised through F30 Publication Event P16 used specific object E29 Design or Procedure.','http://iflastandards.info/ns/fr/frbr/frbroo/F18','http://www.cidoc-crm.org/cidoc-crm/E29_Design_or_Procedure',NULL),
	(12,'2015-01-11 01:51:38','2015-01-11 01:51:38',NULL,1,1,1,'isIssuingRuleOf','is issuing rule of',NULL,'Inverse of R11_has_issuing_rule.','property',NULL,NULL,'http://iflastandards.info/ns/fr/frbr/frbroo/R11i',NULL,1,'en',NULL,'http://www.cidoc-crm.org/cidoc-crm/E29_Design_or_Procedure','http://iflastandards.info/ns/fr/frbr/frbroo/F18',NULL);
ALTER TABLE `reg_schema_property` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


