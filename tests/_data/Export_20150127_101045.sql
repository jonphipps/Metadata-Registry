#
# SQL Export
# Created by Querious (945)
# Created: January 27, 2015 at 10:10:50 AM EST
# Encoding: Unicode (UTF-8)
#


DROP TABLE IF EXISTS `reg_file_import_history`;


CREATE TABLE `reg_file_import_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `map` longtext COMMENT 'stores the serialized column map array',
  `user_id` int(11) DEFAULT NULL,
  `vocabulary_id` int(11) DEFAULT NULL,
  `schema_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `source_file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(30) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `results` longtext COMMENT 'stores the serialized results of the import',
  `total_processed_count` int(11) DEFAULT NULL,
  `error_count` int(11) DEFAULT NULL,
  `success_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `schema_id` (`schema_id`),
  KEY `batch_id` (`batch_id`),
  CONSTRAINT `reg_file_import_history_fk` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`),
  CONSTRAINT `reg_file_import_history_fk1` FOREIGN KEY (`vocabulary_id`) REFERENCES `reg_vocabulary` (`id`),
  CONSTRAINT `reg_file_import_history_fk2` FOREIGN KEY (`schema_id`) REFERENCES `reg_schema` (`id`),
  CONSTRAINT `reg_file_import_history_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `reg_batch` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=COMPACT;




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `reg_file_import_history` WRITE;
ALTER TABLE `reg_file_import_history` DISABLE KEYS;
ALTER TABLE `reg_file_import_history` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


