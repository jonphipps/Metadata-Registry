
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

--
-- FOREIGN KEYS [DROP]
-- 

ALTER TABLE reg_concept DROP FOREIGN KEY reg_concept_fk;
ALTER TABLE reg_concept DROP FOREIGN KEY reg_concept_FK_3;
ALTER TABLE reg_schema_property DROP FOREIGN KEY reg_schema_property_fk3;


--
-- reg_file_import_history
-- 

ALTER TABLE reg_file_import_history CHANGE COLUMN file_type file_type VARCHAR(10) NULL COMMENT '';

--
-- reg_schema
-- 

ALTER TABLE reg_schema
ADD languages TEXT;
ALTER TABLE reg_schema
ADD repo VARCHAR(255) NOT NULL;


--
-- reg_schema_property_element
-- 

DROP INDEX reg_schema_property_element_idx1 ON reg_schema_property_element;
DROP INDEX reg_schema_property_element_idx2 ON reg_schema_property_element;

--
-- reg_user
-- 

ALTER TABLE reg_user
ADD culture VARCHAR(7) DEFAULT 'en_US';

--
-- reg_vocabulary
-- 

ALTER TABLE reg_vocabulary
ADD languages TEXT;
ALTER TABLE reg_vocabulary
ADD profile_id INT(11);
ALTER TABLE reg_vocabulary
ADD ns_type CHAR(6) DEFAULT 'slash' NOT NULL;
CREATE INDEX profile_id ON reg_vocabulary (profile_id ASC);

--
-- reg_vocabulary_has_user
-- 

ALTER TABLE reg_vocabulary_has_user
ADD languages TEXT;
ALTER TABLE reg_vocabulary_has_user
ADD default_language CHAR(6) DEFAULT 'en';
ALTER TABLE reg_vocabulary_has_user
ADD current_language CHAR(6);

--
-- schema_has_user
-- 

ALTER TABLE schema_has_user
ADD languages TEXT;
ALTER TABLE schema_has_user
ADD default_language CHAR(6) DEFAULT 'en';
ALTER TABLE schema_has_user
ADD current_language CHAR(6);

--
-- vs_database_diagrams
-- 

DROP TABLE vs_database_diagrams;

--
-- FOREIGN KEYS [CREATE]
-- 

ALTER TABLE reg_vocabulary ADD CONSTRAINT reg_vocabulary_ibfk_1 FOREIGN KEY (profile_id) REFERENCES profile (id)
                                                                ON DELETE NO ACTION
                                                                ON UPDATE NO ACTION;

SET TIME_ZONE=@OLD_TIME_ZONE ;

SET SQL_MODE=@OLD_SQL_MODE ;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS ;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS ;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT ;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS ;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION ;
SET SQL_NOTES=@OLD_SQL_NOTES ;

