
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_blog
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_blog`;


CREATE TABLE `sf_blog`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`tagline` TEXT,
	`copyright` TEXT,
	`stripped_title` VARCHAR(255),
	`is_published` TINYINT default 0,
	`is_finished` TINYINT default 0,
	`display_extract` TINYINT default 1,
	`comment_policy` INTEGER default 2,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_blog_U_1` (`stripped_title`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_blog_post
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_blog_post`;


CREATE TABLE `sf_blog_post`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_blog_id` INTEGER,
	`author_id` INTEGER,
	`title` VARCHAR(255),
	`stripped_title` VARCHAR(255),
	`extract` TEXT,
	`content` TEXT,
	`is_published` TINYINT default 0,
	`allow_comments` TINYINT default 1,
	`nb_comments` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`published_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `stripped_title_published_at` (`stripped_title`, `published_at`),
	INDEX `sf_blog_post_FI_1` (`sf_blog_id`),
	CONSTRAINT `sf_blog_post_FK_1`
		FOREIGN KEY (`sf_blog_id`)
		REFERENCES `sf_blog` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_blog_post_FI_2` (`author_id`),
	CONSTRAINT `sf_blog_post_FK_2`
		FOREIGN KEY (`author_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_blog_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_blog_comment`;


CREATE TABLE `sf_blog_comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_blog_post_id` INTEGER,
	`author_name` VARCHAR(255),
	`author_email` VARCHAR(255),
	`author_url` VARCHAR(255),
	`content` TEXT,
	`status` INTEGER default 1,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sf_blog_comment_FI_1` (`sf_blog_post_id`),
	CONSTRAINT `sf_blog_comment_FK_1`
		FOREIGN KEY (`sf_blog_post_id`)
		REFERENCES `sf_blog_post` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_blog_tag
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_blog_tag`;


CREATE TABLE `sf_blog_tag`
(
	`sf_blog_post_id` INTEGER  NOT NULL,
	`tag` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`sf_blog_post_id`,`tag`),
	CONSTRAINT `sf_blog_tag_FK_1`
		FOREIGN KEY (`sf_blog_post_id`)
		REFERENCES `sf_blog_post` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_blog_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_blog_user`;


CREATE TABLE `sf_blog_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_blog_id` INTEGER,
	`user_id` INTEGER,
	`is_creator` TINYINT default 1,
	PRIMARY KEY (`id`),
	INDEX `sf_blog_user_FI_1` (`sf_blog_id`),
	CONSTRAINT `sf_blog_user_FK_1`
		FOREIGN KEY (`sf_blog_id`)
		REFERENCES `sf_blog` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_blog_user_FI_2` (`user_id`),
	CONSTRAINT `sf_blog_user_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_blog_log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_blog_log`;


CREATE TABLE `sf_blog_log`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`subject_class` VARCHAR(255),
	`subject_id` INTEGER,
	`subject_name` VARCHAR(255),
	`subject_link` VARCHAR(255),
	`verb` VARCHAR(255),
	`object_class` VARCHAR(255),
	`object_id` INTEGER,
	`object_name` VARCHAR(255),
	`object_link` VARCHAR(255),
	`complement_class` VARCHAR(255),
	`complement_id` INTEGER,
	`complement_name` VARCHAR(255),
	`complement_link` VARCHAR(255),
	`message` VARCHAR(255),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sf_blog_log_FI_1` (`user_id`),
	CONSTRAINT `sf_blog_log_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
