
--
-- FOREIGN KEYS [DROP]
--

ALTER TABLE reg_concept DROP FOREIGN KEY reg_concept_FK_1;

--
-- reg_batch
--


--
-- reg_concept
--


--
-- reg_concept_property
--

ALTER TABLE reg_concept_property
ADD is_concept_property TINYINT(1) DEFAULT 0 NOT NULL;

--
-- reg_concept_property_history
--


--
-- reg_file_import_history
--

ALTER TABLE reg_file_import_history CHANGE COLUMN map map TEXT NULL COMMENT 'stores the serialized column map array';
ALTER TABLE reg_file_import_history CHANGE COLUMN file_type file_type VARCHAR(30) NULL COMMENT '';
ALTER TABLE reg_file_import_history CHANGE COLUMN results results TEXT NULL COMMENT 'stores the serialized results of the import';

--
-- reg_lookup
--


--
-- reg_schema
--

ALTER TABLE reg_schema
ADD prefixes TEXT;
ALTER TABLE reg_schema
ADD languages TEXT;
ALTER TABLE reg_schema
ADD repo VARCHAR(255) NOT NULL;

--
-- reg_schema_property
--

ALTER TABLE reg_schema_property CHANGE COLUMN type type ENUM('property','class') DEFAULT 'property' NOT NULL COMMENT '';
ALTER TABLE reg_schema_property
ADD url VARCHAR(255);
ALTER TABLE reg_schema_property
ADD lexical_alias VARCHAR(255);

--
-- reg_schema_property_element
--

ALTER TABLE reg_schema_property_element CHANGE COLUMN language language CHAR(6) NOT NULL COMMENT '';
ALTER TABLE reg_schema_property_element ADD COLUMN `is_generated` TINYINT NOT NULL DEFAULT 0 AFTER `status_id`;
DROP INDEX reg_schema_property_element_idx1 ON reg_schema_property_element;
CREATE INDEX reg_schema_property_element_idx1 ON reg_schema_property_element (object(150) ASC);

--
-- reg_schema_property_element_history
--

ALTER TABLE reg_schema_property_element_history CHANGE COLUMN language language CHAR(6) NOT NULL COMMENT '';
ALTER TABLE reg_schema_property_element_history
ADD import_id INT(11);
CREATE INDEX reg_schema_property_element_history_fk7 ON reg_schema_property_element_history (import_id ASC);

--
-- reg_skos_property
--


--
-- reg_status
--


--
-- reg_user
--

ALTER TABLE reg_user
ADD culture VARCHAR(7) DEFAULT 'en_US';
DROP INDEX id ON reg_user;

--
-- reg_vocabulary
--

ALTER TABLE reg_vocabulary
ADD languages TEXT;
ALTER TABLE reg_vocabulary
ADD profile_id INT(11);
ALTER TABLE reg_vocabulary
ADD ns_type ENUM('hash','slash') DEFAULT 'slash' NOT NULL;
CREATE INDEX profile_id ON reg_vocabulary (profile_id ASC);

--
-- reg_vocabulary_has_user
--

ALTER TABLE reg_vocabulary_has_user
ADD languages TEXT;
ALTER TABLE reg_vocabulary_has_user
ADD default_language CHAR(6) DEFAULT 'en';
ALTER TABLE reg_vocabulary_has_user
ADD current_language CHAR(6) DEFAULT 'en';

--
-- reg_vocabulary_has_version
--

--
-- schema_has_user
--

ALTER TABLE schema_has_user
ADD languages TEXT;
ALTER TABLE schema_has_user
ADD default_language CHAR(6) DEFAULT 'en' NOT NULL;
ALTER TABLE schema_has_user
ADD current_language CHAR(6);

--
-- schema_has_version
--

--
-- update property/class
--

update reg_schema_property
set type='property'
where type='subproperty' OR type='property';
update reg_schema_property
set type='class'
where type='subclass' OR type='class';

update reg_schema_property_element
set object='property'
WHERE profile_property_id=4
      AND (object='subproperty' OR object='property');
update reg_schema_property_element
set object='class'
WHERE profile_property_id=4
      and (object='subclass' OR object='class');

ALTER TABLE `reg_schema_property`
CHANGE COLUMN `type` `type`
ENUM('property','class')
CHARACTER SET utf8
COLLATE utf8_general_ci
  NOT NULL
  DEFAULT 'property'
COMMENT ''
AFTER `comment`;

--
-- update related
--

-- fix no uri
UPDATE reg_schema_property_element, reg_schema_property
set reg_schema_property_element.object = reg_schema_property.uri
where reg_schema_property_element.related_schema_property_id = reg_schema_property.id
AND reg_schema_property_element.object = '';

-- fix empty or broken related id
update reg_schema_property_element, reg_schema_property
set reg_schema_property_element.related_schema_property_id = reg_schema_property.id
WHERE reg_schema_property_element.object = reg_schema_property.uri
  and reg_schema_property_element.related_schema_property_id <> reg_schema_property.id;

--
-- remove language from elements that don't have language
--

UPDATE reg_schema_property_element as e, profile_property as p
set e.language=NULL
WHERE e.profile_property_id = p.id
      and p.has_language=0
      and e.language<>'';

--
-- FOREIGN KEYS [CREATE]
--

ALTER TABLE reg_schema_property_element_history ADD CONSTRAINT reg_schema_property_element_history_fk7 FOREIGN KEY (import_id) REFERENCES reg_file_import_history (id)
                                                                                                       ON DELETE RESTRICT
                                                                                                       ON UPDATE RESTRICT;
ALTER TABLE reg_vocabulary ADD CONSTRAINT reg_vocabulary_ibfk_1 FOREIGN KEY (profile_id) REFERENCES profile (id)
                                                                ON DELETE NO ACTION
                                                                ON UPDATE NO ACTION;
