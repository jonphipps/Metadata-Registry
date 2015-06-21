#
# SQL Export
# Created by Querious (945)
# Created: January 27, 2015 at 10:14:44 AM EST
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 COMMENT='InnoDB free: 0 kB;';




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `reg_schema_property` WRITE;
ALTER TABLE `reg_schema_property` DISABLE KEYS;
ALTER TABLE `reg_schema_property` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


