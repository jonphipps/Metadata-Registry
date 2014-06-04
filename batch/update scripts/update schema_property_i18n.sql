START TRANSACTION;
UPDATE swregistry.reg_schema_property_element SET reg_schema_property_element.profile_property_id=3 WHERE reg_schema_property_element.id=14195;
UPDATE swregistry.reg_schema_property_element_history SET reg_schema_property_element_history.profile_property_id=3 WHERE reg_schema_property_element_history.id=16796;
UPDATE swregistry.reg_schema_property_element SET reg_schema_property_element.profile_property_id=7 WHERE reg_schema_property_element.id=18780;
UPDATE swregistry.reg_schema_property_element_history SET reg_schema_property_element_history.profile_property_id =7 WHERE reg_schema_property_element_history.id =25526;

DELETE FROM swregistry.reg_schema_property_element WHERE reg_schema_property_element.id=14198;
DELETE FROM swregistry.reg_schema_property_element WHERE reg_schema_property_element.id=14154;

INSERT INTO
    swregistry.reg_schema_property_i18n
    (
        id,
        culture,
        label,
        definition
    )
SELECT
    label.schema_property_id AS `id`,
    label.language           AS `culture`,
    label.object             AS `label`,
    def.object               AS `definition`
FROM
    (
        SELECT
            *
        FROM
            swregistry.reg_schema_property_element
        WHERE
            reg_schema_property_element.language <> "en"
        AND reg_schema_property_element.profile_property_id = 2
        AND reg_schema_property_element.deleted_at IS NULL ) AS label
LEFT JOIN
    (
        SELECT
            *
        FROM
            swregistry.reg_schema_property_element
        WHERE
            reg_schema_property_element.language <> "en"
        AND reg_schema_property_element.profile_property_id = 3
        AND reg_schema_property_element.deleted_at IS NULL ) AS def
ON
    label.schema_property_id = def.schema_property_id
/*  Use the WHERE clause to eliminate ANY EXISTing i18n records */
WHERE label.schema_property_id <> 13749
AND label.schema_property_id <> 1802
AND label.schema_property_id <> 15536;


/* ***** Update the value of is_schema_property now that it's part of reg_schema_property_i18n */
UPDATE
    swregistry.reg_schema_property_element,
    swregistry.reg_schema_property_i18n
SET
    reg_schema_property_element.is_schema_property=1
WHERE
    reg_schema_property_element.language <> "en"
AND (
        reg_schema_property_element.profile_property_id = 2
    OR  reg_schema_property_element.profile_property_id = 3)
AND reg_schema_property_element.deleted_at IS NULL
AND reg_schema_property_element.schema_property_id=reg_schema_property_i18n.id
AND reg_schema_property_i18n.culture = reg_schema_property_element.language;

/* ******* Update the LANGUAGE section of the schema */
UPDATE swregistry.reg_schema JOIN
(
        SELECT
            DISTINCTROW i.culture,
            s.id as `id`,
            s.languages,
            concat('a:2:{i:0;s:2:"', i.culture, '";i:1;s:2:"en";}') AS `NEWlanguage`
        FROM
            swregistry.reg_schema               AS s,
            swregistry.reg_schema_property_i18n AS i,
            swregistry.reg_schema_property      AS p
        WHERE
            p.id=i.id
        AND p.schema_id=s.id
        AND i.culture<> 'en'
        and s.languages = '') AS tmp 
        on reg_schema.id=tmp.id
SET swregistry.reg_schema.languages =  tmp.NEWlanguage;

/* fix THE missing TRAILING slashes in reg_schema */
UPDATE reg_schema
SET reg_schema.uri = concat(reg_schema.uri,"/")
WHERE RIGHT(reg_schema.uri,1) <> '/'
AND RIGHT(reg_schema.uri,1) <> '#';

/* ******* make the lexicaluri field bigger */
ALTER TABLE
    swregistry.reg_schema_property_i18n MODIFY lexical_uri TEXT;

/* update lexical URIs in i18n */
UPDATE swregistry.reg_schema, swregistry.reg_schema_property, swregistry.reg_schema_property_i18n
SET reg_schema_property_i18n.lexical_uri = concat(reg_schema.uri,  reg_schema_property_i18n.name, ".", reg_schema_property_i18n.culture)
WHERE reg_schema_property.schema_id = reg_schema.id
AND reg_schema_property_i18n.id=reg_schema_property.id
and reg_schema_property_i18n.name <> '';

/* ******** update the property elements for lexical uris */
INSERT
INTO
    swregistry.reg_schema_property_element
    (
        created_at,
        updated_at,
        deleted_at,
        created_user_id,
        updated_user_id,
        schema_property_id,
        profile_property_id,
        is_schema_property,
        object,
        related_schema_property_id,
        language,
        status_id
    )
SELECT
    p.created_at,
    now() as updated_at,
    p.deleted_at,
    p.created_user_id,
    36 as updated_user_id,
    p.id as schema_property_id,
    26 as profile_property_id,
    1 as is_schema_property,
    i18n.lexical_uri as object,
    null as related_schema_property_id,
    i18n.culture as language,
    p.status_id as status_id
FROM
    swregistry.reg_schema_property_i18n as i18n, swregistry.reg_schema_property as p
WHERE i18n.id = p.id
AND i18n.lexical_uri <> '';

/* ******** update history */
INSERT
INTO
    swregistry.reg_schema_property_element_history
    (
        created_at,
        created_user_id,
        action,
        schema_property_element_id,
        schema_property_id,
        schema_id,
        profile_property_id,
        object,
        related_schema_property_id,
        language,
        status_id
    )
SELECT
    e.created_at as created_at,
    e.created_user_id as created_user_id,
    'added' as action,
    e.id as schema_property_element_id,
    p.id as schema_property_id,
    p.`schema_id` as schema_id,
    26 as profile_property_id,
    e.`object` as object,
    null as related_schema_property_id,
    e.`language` as language,
    p.status_id as status_id
FROM
    swregistry.reg_schema_property as p, `reg_schema_property_element` as e
WHERE e.schema_property_id = p.id
and e.`profile_property_id`=26
and e.`updated_user_id`=36;


COMMIT;