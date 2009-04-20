ALTER TABLE `reg_concept` MODIFY COLUMN `is_top_concept` TINYINT(4) DEFAULT NULL;
ALTER TABLE `reg_concept_property` DROP FOREIGN KEY `reg_concept_property_fk3`;
ALTER TABLE `reg_concept_property` ADD CONSTRAINT `reg_concept_property_fk3` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

