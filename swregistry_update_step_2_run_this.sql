
--
-- reg_concept_property
--

ALTER TABLE reg_concept_property
ADD is_concept_property TINYINT(1) DEFAULT 0 NOT NULL;

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

ALTER TABLE reg_schema_property
ADD url VARCHAR(255),
ADD lexical_alias VARCHAR(255);

--
-- reg_schema_property_element_history
--

ALTER TABLE reg_schema_property_element_history
ADD import_id INT(11);
CREATE INDEX reg_schema_property_element_history_fk7 ON reg_schema_property_element_history (import_id ASC);

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
-- schema_has_user
--

ALTER TABLE schema_has_user
ADD languages TEXT;
ALTER TABLE schema_has_user
ADD default_language CHAR(6) DEFAULT 'en' NOT NULL;
ALTER TABLE schema_has_user
ADD current_language CHAR(6);

--
-- update property/class
--

update reg_schema_property
set type='Property'
where type='subproperty' OR type='property';
update reg_schema_property
set type='Class'
where type='subclass' OR type='class';

update reg_schema_property_element
set object='Property'
WHERE profile_property_id=4
      AND (object='subproperty' OR object='property');
update reg_schema_property_element
set object='Class'
WHERE profile_property_id=4
      and (object='subclass' OR object='class');

--
-- FOREIGN KEYS [CREATE]
--

ALTER TABLE reg_schema_property_element_history ADD CONSTRAINT reg_schema_property_element_history_fk7 FOREIGN KEY (import_id) REFERENCES reg_file_import_history (id)
                                                                                                       ON DELETE RESTRICT
                                                                                                       ON UPDATE RESTRICT;
ALTER TABLE reg_vocabulary ADD CONSTRAINT reg_vocabulary_ibfk_1 FOREIGN KEY (profile_id) REFERENCES profile (id)
                                                                ON DELETE NO ACTION
                                                                ON UPDATE NO ACTION;
