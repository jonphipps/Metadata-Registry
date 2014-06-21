START TRANSACTION;
SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT ;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS ;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION ;
SET NAMES utf8 ;
SET @OLD_TIME_ZONE=@@TIME_ZONE ;
SET TIME_ZONE='+00:00' ;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 ;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 ;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' ;
SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 ;

drop table if exists `reg_schema_property_i18n`;

CREATE TABLE `reg_schema_property_i18n` (
  `id` int(11) NOT NULL,
  `culture` varchar(7) NOT NULL DEFAULT 'en',
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `definition` text,
  `comment` text,
  `lexical_uri` text,
  `note` text,
  PRIMARY KEY (`id`,`culture`),
  KEY `reg_schema_property_idx2` (`id`),
  CONSTRAINT `reg_schema_property_i18n_ibfk_6` FOREIGN KEY (`id`) REFERENCES `reg_schema_property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO
    reg_schema_property_i18n
    (
        id,
        name,
        label,
        definition,
		comment,
		culture,
		note
    )
SELECT
    reg_schema_property.id AS `id`,
	reg_schema_property.name as name,
	reg_schema_property.label as label,
	reg_schema_property.definition as definition,
	reg_schema_property.comment as comment,
    reg_schema_property.language AS `culture`,
	reg_schema_property.note as note
FROM reg_schema_property;

SET TIME_ZONE=@OLD_TIME_ZONE ;

SET SQL_MODE=@OLD_SQL_MODE ;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS ;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS ;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT ;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS ;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION ;
SET SQL_NOTES=@OLD_SQL_NOTES ;
 
COMMIT;