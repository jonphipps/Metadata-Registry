
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_webpanel_bugs
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_webpanel_bugs`;


CREATE TABLE `sf_webpanel_bugs`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50),
	`module_name` VARCHAR(150),
	`action_name` VARCHAR(150),
	`app_name` VARCHAR(50),
	`date_added` DATETIME,
	`description` TEXT,
	`url` VARCHAR(255),
	`solved` SMALLINT(1) default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
