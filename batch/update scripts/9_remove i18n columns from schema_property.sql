ALTER TABLE reg_schema_property
ADD url VARCHAR(255) NOT NULL;
ALTER TABLE reg_schema_property DROP COLUMN name;
ALTER TABLE reg_schema_property DROP COLUMN label;
ALTER TABLE reg_schema_property DROP COLUMN definition;
ALTER TABLE reg_schema_property DROP COLUMN comment;
ALTER TABLE reg_schema_property DROP COLUMN language;
ALTER TABLE reg_schema_property DROP COLUMN note;
