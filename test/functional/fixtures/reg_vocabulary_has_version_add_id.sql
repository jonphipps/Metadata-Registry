ALTER TABLE `reg_vocabulary_has_version` DROP FOREIGN KEY `reg_vocabulary_has_version_FK_history`;
ALTER TABLE `reg_vocabulary_has_version` DROP INDEX `concept_property_history_id`;
ALTER TABLE `reg_vocabulary_has_version` DROP COLUMN `concept_property_history_id`;

ALTER TABLE `reg_vocabulary_has_version` ADD COLUMN `timeslice` DATETIME DEFAULT NULL;
ALTER TABLE `reg_vocabulary_has_version` MODIFY COLUMN `id` INTEGER(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reg_vocabulary_has_version` ADD INDEX `name` (`name`);
ALTER TABLE `reg_vocabulary_has_version` ADD UNIQUE `id` (`id`);


