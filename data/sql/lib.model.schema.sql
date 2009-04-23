
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- arc_g2t
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_g2t`;


CREATE TABLE `arc_g2t`
(
	`g` SMALLINT default  NOT NULL,
	`t` SMALLINT default  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `gt` (`g`, `t`),
	KEY `arc_g2t_I_1`(`g`),
	KEY `arc_g2t_I_2`(`t`),
	KEY `tg`(`t`, `g`),
	CONSTRAINT `arc_g2t_FK_1`
		FOREIGN KEY (`g`)
		REFERENCES `arc_id2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_g2t_FK_2`
		FOREIGN KEY (`t`)
		REFERENCES `arc_triple` (`t`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_id2val
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_id2val`;


CREATE TABLE `arc_id2val`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`misc` TINYINT default 0 NOT NULL,
	`val` TEXT  NOT NULL,
	`val_type` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`, `val_type`),
	KEY `v`(`val`),
	KEY `id_2`(`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_o2val
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_o2val`;


CREATE TABLE `arc_o2val`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cid` SMALLINT default  NOT NULL,
	`misc` TINYINT default 0 NOT NULL,
	`val` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `arc_o2val_I_1`(`cid`),
	KEY `v`(`val`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_s2val
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_s2val`;


CREATE TABLE `arc_s2val`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cid` SMALLINT default  NOT NULL,
	`misc` TINYINT default 0 NOT NULL,
	`val` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `arc_s2val_I_1`(`cid`),
	KEY `v`(`val`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_setting
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_setting`;


CREATE TABLE `arc_setting`
(
	`k` CHAR(32) default '' NOT NULL,
	`val` TEXT  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `arc_setting_U_1` (`k`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- arc_triple
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `arc_triple`;


CREATE TABLE `arc_triple`
(
	`t` SMALLINT default  NOT NULL,
	`s` SMALLINT default  NOT NULL,
	`p` SMALLINT default  NOT NULL,
	`o` SMALLINT default  NOT NULL,
	`o_lang_dt` SMALLINT default  NOT NULL,
	`o_comp` CHAR(35) default '' NOT NULL,
	`s_type` TINYINT default 0 NOT NULL,
	`o_type` TINYINT default 0 NOT NULL,
	`misc` TINYINT default 0 NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `arc_triple_U_1` (`t`),
	KEY `arc_triple_I_1`(`s`),
	KEY `arc_triple_I_2`(`p`),
	KEY `arc_triple_I_3`(`o`),
	KEY `arc_triple_I_4`(`o_lang_dt`),
	KEY `arc_triple_I_5`(`misc`),
	KEY `spo`(`s`, `p`, `o`),
	KEY `os`(`o`, `s`),
	KEY `po`(`p`, `o`),
	CONSTRAINT `arc_triple_FK_1`
		FOREIGN KEY (`s`)
		REFERENCES `arc_s2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_triple_FK_2`
		FOREIGN KEY (`p`)
		REFERENCES `arc_id2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_triple_FK_3`
		FOREIGN KEY (`o`)
		REFERENCES `arc_o2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `arc_triple_FK_4`
		FOREIGN KEY (`o_lang_dt`)
		REFERENCES `arc_id2val` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
