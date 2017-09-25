SET FOREIGN_KEY_CHECKS=0;
# this updates from public beta

TRUNCATE    `swregistry_beta_new`.`users`;
insert into `swregistry_beta_new`.`users` (
       id, created_at, updated_at,   deleted_at, nickname, salutation, first_name, last_name, email, is_administrator, `password`, status, culture, confirmation_code, name, confirmed, remember_token)
select id, created_at, last_updated, deleted_at, nickname, salutation, first_name, last_name, email, is_administrator, `password`, status, culture, confirmation_code, name, confirmed, remember_token
from `swregistry_beta`.`reg_user`
;

SET FOREIGN_KEY_CHECKS=1;

# TODO: Update project prefixes and languages from an accumulated list of prefixes and languages in use by vocabularies and element sets

SET FOREIGN_KEY_CHECKS=0;

TRUNCATE    `swregistry_beta_new`.`reg_agent`;
INSERT INTO `swregistry_beta_new`.`reg_agent` (
       id, created_at, updated_at,   deleted_at, org_email, org_name, ind_affiliation, ind_role, address1, address2, city, state, postal_code, country, phone, web_address, type)
select id, created_at, last_updated, deleted_at, org_email, org_name, ind_affiliation, ind_role, address1, address2, city, state, postal_code, country, phone, web_address, type
from `swregistry`.`reg_agent`
;

TRUNCATE    `swregistry_beta_new`.`reg_agent_has_user`;
INSERT INTO `swregistry_beta_new`.`reg_agent_has_user` (
       id, created_at, updated_at, deleted_at, user_id, agent_id, is_registrar_for, is_admin_for)
select id, created_at, updated_at, deleted_at, user_id, agent_id, is_registrar_for, is_admin_for
from `swregistry`.`reg_agent_has_user`
;

SET FOREIGN_KEY_CHECKS=1;

SET FOREIGN_KEY_CHECKS=0;

TRUNCATE    `swregistry_beta_new`.`reg_vocabulary`;
INSERT INTO `swregistry_beta_new`.`reg_vocabulary`(
       id, agent_id, created_at, deleted_at, updated_at,   name, note, uri, url, base_domain, token, status_id, language, `languages`, profile_id, ns_type, `prefixes`, repo, prefix, created_user_id, updated_user_id, child_updated_at, child_updated_user_id)
select id, agent_id, created_at, deleted_at, last_updated, name, note, uri, url, base_domain, token, status_id, language, `languages`, profile_id, ns_type, `prefixes`, repo, prefix, created_user_id, updated_user_id, child_updated_at, child_updated_user_id
from      `swregistry`.`reg_vocabulary`
;

update `swregistry_beta_new`.`reg_vocabulary` set profile_id = 2;

TRUNCATE    `swregistry_beta_new`.`reg_vocabulary_has_user` ;
INSERT INTO `swregistry_beta_new`.`reg_vocabulary_has_user` (
       id, created_at, updated_at, deleted_at, vocabulary_id, user_id, is_maintainer_for, is_registrar_for, is_admin_for, `languages`, default_language, current_language)
select id, created_at, updated_at, deleted_at, vocabulary_id, user_id, is_maintainer_for, is_registrar_for, is_admin_for, `languages`, default_language, current_language
from `swregistry`.`reg_vocabulary_has_user`
;

#cleanup duplicates
update `swregistry`.`reg_concept` set uri = "http://purl.org/gem/instance/subject/GEM-S/foreign_languages" where id=190;
delete from `swregistry`.`reg_concept`where id=9326;
delete from `swregistry`.`reg_concept_property_history`where concept_id=9327;
delete from `swregistry`.`reg_concept_property`where concept_id=9327;
delete from `swregistry`.`reg_concept`where id=9327;

TRUNCATE    `swregistry_beta_new`.`reg_concept`;
INSERT INTO `swregistry_beta_new`.`reg_concept` (
       id, created_at, updated_at,   deleted_at, created_user_id, updated_user_id, uri, pref_label, vocabulary_id, is_top_concept, pref_label_id, status_id, language)
select id, created_at, last_updated, deleted_at, created_user_id, updated_user_id, uri, pref_label, vocabulary_id, is_top_concept, pref_label_id, status_id, language
from `swregistry`.`reg_concept`
where `swregistry`.`reg_concept`.id not in ()
;


#delete duplicates from reg_concept_property
delete from `swregistry`.`reg_concept_property`
where id in (20982,20983,21385,21386,417,637,711,710,18447,15589,15781,16447,16003,17467,17352,17469,17351,17468,16,1028,1027,2402,24238,42075,41871,41869,41915,20173,24356,42076,42007,42005,42006,15609,16446,17098,17466,18246,16915,17134,17133,16548,19536,20866,19765,19587,19616,19946,19449,19441,20873,19440,20849,18840,20485,20848,20864,31573,32081,41596,41594,32814,41568,19621,19767);

TRUNCATE    `swregistry_beta_new`.`reg_concept_property` ;
INSERT INTO `swregistry_beta_new`.`reg_concept_property` (
       id, created_at, updated_at,   deleted_at, created_user_id, updated_user_id, concept_id, primary_pref_label, skos_property_id, object, scheme_id, related_concept_id, language, status_id, is_concept_property, profile_property_id, is_generated)
select id, created_at, last_updated, deleted_at, created_user_id, updated_user_id, concept_id, primary_pref_label, skos_property_id, object, scheme_id, related_concept_id, language, status_id, is_concept_property, profile_property_id, is_generated
from  `swregistry`.`reg_concept_property`
;
update `swregistry_beta_new`.`reg_concept_property` join profile_property on reg_concept_property.skos_property_id = profile_property.skos_id
set reg_concept_property.profile_property_id = profile_property.id;

TRUNCATE    `swregistry_beta_new`.`reg_concept_property_history` ;
INSERT INTO `swregistry_beta_new`.`reg_concept_property_history` (
       id, created_at, action, concept_property_id, concept_id, vocabulary_id, skos_property_id, object, scheme_id, related_concept_id, language, status_id, created_user_id, change_note, import_id)
select id, created_at, action, concept_property_id, concept_id, vocabulary_id, skos_property_id, object, scheme_id, related_concept_id, language, status_id, created_user_id, change_note, import_id
from `swregistry`.`reg_concept_property_history`
;
update `swregistry_beta_new`.`reg_concept_property_history` join profile_property on reg_concept_property_history.skos_property_id = profile_property.skos_id
set reg_concept_property_history.profile_property_id = profile_property.id;

# Cleanup updated_at dates
update reg_concept_property
set created_at = updated_at
where created_at is null;

update reg_concept_property
set updated_at = created_at
where updated_at is null;

update reg_concept
set updated_at = created_at
where updated_at is null;

# cleanup empty concept preflabels
# there are 4 duplicates
update `swregistry_beta_new`.`reg_concept_property`
set object = concat(object, ' (duplicate)')
where id in (39729,40972,40976,41024);

# there are 3 with no prefLabels
update `swregistry_beta_new`.`reg_concept`
set pref_label = concat('No prefLabel-',id)
where id in (8884,8944,9326);

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'fr';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45;
#add this to select in order of frequency
and p.language = 'it';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'es';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'la';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'de';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'pt';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'el';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'pl';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'eu';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'sv';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45
#add this to select in order of frequency
and p.language = 'ja';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

update `swregistry_beta_new`.`reg_concept_property` as p, `swregistry_beta_new`.`reg_concept` as c
set c.pref_label    = p.object,
    c.language      = p.language,
    c.pref_label_id = p.id
where c.pref_label is null
and p.concept_id = c.id
and p.profile_property_id = 45;
#add this to select in order of frequency
and p.language = 'fr';
# fr,it,es,la,de,pt,el,pl,eu,sv,ja and then random

SET FOREIGN_KEY_CHECKS=1;
SET FOREIGN_KEY_CHECKS=0;

TRUNCATE    `swregistry_beta_new`.`reg_schema`;
INSERT INTO `swregistry_beta_new`.`reg_schema` (
       id, agent_id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, child_updated_at, child_updated_user_id, name, note, uri, url, base_domain, token, community, last_uri_id, status_id, language, profile_id, ns_type, `prefixes`, `languages`, repo)
select id, agent_id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, child_updated_at, child_updated_user_id, name, note, uri, url, base_domain, token, community, last_uri_id, status_id, language, profile_id, ns_type, `prefixes`, `languages`, repo
from `swregistry`.`reg_schema`
;

TRUNCATE    `swregistry_beta_new`.`schema_has_user`;
DELETE from `swregistry`.`schema_has_user` where schema_id=24 and user_id=117;
INSERT INTO `swregistry_beta_new`.`schema_has_user` (
       id, created_at, updated_at, deleted_at, schema_id, user_id, is_maintainer_for, is_registrar_for, is_admin_for, `languages`, default_language, current_language)
select id, created_at, updated_at, deleted_at, schema_id, user_id, is_maintainer_for, is_registrar_for, is_admin_for, `languages`, default_language, current_language
from `swregistry`.`schema_has_user`
;
INSERT INTO `swregistry_beta_new`.`schema_has_user` (`id`, `created_at`, `updated_at`, `deleted_at`, `schema_id`, `user_id`, `is_maintainer_for`, `is_registrar_for`, `is_admin_for`, `languages`, `default_language`, `current_language`) VALUES
	(130,'2015-07-10 16:21:47','2015-07-10 16:21:47',NULL,24,117,1,1,1,NULL,'en',NULL);

#cleanup duplicates
delete from `swregistry`.`reg_schema_property_element_history`where schema_property_id=30617;
delete from `swregistry`.`reg_schema_property_element`where schema_property_id=30617;
delete from `swregistry`.`reg_schema_property`where id=30617;

TRUNCATE    `swregistry_beta_new`.`reg_schema_property`;
INSERT INTO `swregistry_beta_new`.`reg_schema_property` (
       id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_id, name, label, definition, `comment`, type, is_subproperty_of, parent_uri, uri, status_id, language, note, domain, orange, is_deprecated, url, lexical_alias, hash_id)
select id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_id, name, label, definition, `comment`, type, is_subproperty_of, parent_uri, uri, status_id, language, note, domain, orange, is_deprecated, url, lexical_alias, hash_id
from `swregistry`.`reg_schema_property`
;

TRUNCATE    `swregistry_beta_new`.`reg_schema_property_element`;
INSERT INTO `swregistry_beta_new`.`reg_schema_property_element` (
       id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_property_id, profile_property_id, is_schema_property, object, related_schema_property_id, language, status_id, is_generated)
select id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_property_id, profile_property_id, is_schema_property, object, related_schema_property_id, language, status_id, is_generated
from `swregistry`.`reg_schema_property_element`
;

TRUNCATE    `swregistry_beta_new`.`reg_schema_property_element_history`;
INSERT INTO `swregistry_beta_new`.`reg_schema_property_element_history` (
       id, created_at, created_user_id, action, schema_property_element_id, schema_property_id, schema_id, profile_property_id, object, related_schema_property_id, language, status_id, change_note, import_id)
select id, created_at, created_user_id, action, schema_property_element_id, schema_property_id, schema_id, profile_property_id, object, related_schema_property_id, language, status_id, change_note, import_id
from `swregistry`.`reg_schema_property_element_history`
;

SET FOREIGN_KEY_CHECKS=1;
# IMPORTANT NOTE BELOW!!...

# meta
# populated from seeders:
#   profile
#   profile_property
#   skos_property
#   status

# populated from seeders until not needed (for boilerplate compatibility)
#   history
#   history_types
#   permissions
#   permissions_role
#   roles
#   role_user
#   some users for testing

SET FOREIGN_KEY_CHECKS=0;

# prefix can be populated by a seeder with live data from prefix.cc,
# but also contains prefixes defined in production and not pushed to prefix.cc
# this will eventually need to be refactored into a diff insert

TRUNCATE    `swregistry_beta_new`.`reg_prefix`;
INSERT INTO `swregistry_beta_new`.`reg_prefix` (
       prefix, uri, rank)
select prefix, uri, rank
from `swregistry`.`reg_prefix`
;

# IMPORTANT: data should be pulled from LIVE BETA when deployed
# this table has no production data
TRUNCATE    `swregistry_beta_new`.`reg_export_history`;
INSERT INTO `swregistry_beta_new`.`reg_export_history` (
       id, created_at, updated_at, user_id, vocabulary_id, schema_id, exclude_deprecated, include_generated, include_deleted, include_not_accepted, selected_columns, selected_language, published_english_version, published_language_version, last_vocab_update, profile_id, file, map)
select id, created_at, updated_at, user_id, vocabulary_id, schema_id, exclude_deprecated, include_generated, include_deleted, include_not_accepted, selected_columns, selected_language, published_english_version, published_language_version, last_vocab_update, profile_id, file, map
from `swregistry_beta`.`reg_export_history`
;

# data pulled from production
TRUNCATE    `swregistry_beta_new`.`reg_file_import_history`;
INSERT INTO `swregistry_beta_new`.`reg_file_import_history` (
       id, created_at, map, user_id, vocabulary_id, schema_id, file_name, source_file_name, file_type, batch_id, results, total_processed_count, error_count, success_count)
select id, created_at, map, user_id, vocabulary_id, schema_id, file_name, source_file_name, file_type, batch_id, results, total_processed_count, error_count, success_count
from `swregistry`.`reg_file_import_history`
;

TRUNCATE    `swregistry_beta_new`.`assigned_roles`;
INSERT INTO `swregistry_beta_new`.`assigned_roles` (
       id, user_id, role_id)
select id, user_id, role_id
from `swregistry_beta`.`assigned_roles`
;

TRUNCATE    `swregistry_beta_new`.`history`;
INSERT INTO `swregistry_beta_new`.`history` (
       id, type_id, user_id, entity_id, icon, class, text, assets, created_at, updated_at)
select id, type_id, user_id, entity_id, icon, class, text, assets, created_at, updated_at
from `swregistry_beta`.`history`
;

TRUNCATE    `swregistry_beta_new`.`password_resets`;
INSERT INTO `swregistry_beta_new`.`password_resets` (
       email, token, created_at, name)
select email, token, created_at, name
from `swregistry_beta`.`password_resets`
;

TRUNCATE    `swregistry_beta_new`.`social_logins`;
INSERT INTO `swregistry_beta_new`.`social_logins` (
       id, user_id, provider, provider_id, token, avatar, created_at, updated_at)
select id, user_id, provider, provider_id, token, avatar, created_at, updated_at
from `swregistry_beta`.`social_logins`
;

SET FOREIGN_KEY_CHECKS=1;
ALTER TABLE `reg_concept`
ADD `lower_uri` VARCHAR(255) AFTER `language`;
CREATE INDEX `reg_concept_lower_uri_index` ON `reg_concept` (`lower_uri` ASC);

update reg_concept
set lower_uri = lower(uri);

ALTER TABLE `reg_concept_property`
ADD `lower_uri` VARCHAR(255) AFTER `is_generated`;
CREATE INDEX `reg_concept_property_lower_uri_index` ON `reg_concept_property` (`lower_uri` ASC);

update reg_concept_property
set lower_uri = lower(left(object,255))
where object like 'http%';

update reg_concept_property cp, reg_concept  cc
set cp.related_concept_id = cc.id
where (cp.related_concept_id <> cc.id or cp.related_concept_id is null)
and cp.lower_uri = cc.lower_uri;

ALTER TABLE `reg_concept_property_history`
ADD `lower_uri` VARCHAR(255) AFTER `profile_property_id`;
CREATE INDEX `reg_concept_property_hist_lower_uri_index` ON `reg_concept_property_history` (`lower_uri` ASC);

update reg_concept_property_history
set lower_uri = lower(left(object,255))
where object like 'http%';

update reg_concept_property_history cp, reg_concept  cc
set cp.related_concept_id = cc.id
where (cp.related_concept_id <> cc.id or cp.related_concept_id is null)
and cp.lower_uri = cc.lower_uri;

--
-- drop indexes and remove 'lower' fields
--
DROP INDEX `reg_concept_lower_uri_index` ON `reg_concept`;
ALTER TABLE `reg_concept` DROP COLUMN `lower_uri`;

DROP INDEX `reg_concept_property_lower_uri_index` ON `reg_concept_property`;
ALTER TABLE `reg_concept_property` DROP COLUMN `lower_uri`;

DROP INDEX `reg_concept_property_hist_lower_uri_index` ON `reg_concept_property_history`;
ALTER TABLE `reg_concept_property_history` DROP COLUMN `lower_uri`;

# globally cleanup broken related element IDs

--
-- reg_schema_property
--

ALTER TABLE `swregistry_beta_new`.`reg_schema_property`
ADD `lower_uri` VARCHAR(255) AFTER `deleted_by`;
CREATE INDEX `reg_schema_property_lower_uri_index` ON `swregistry_beta_new`.`reg_schema_property` (`lower_uri` ASC);

update `swregistry_beta_new`.`reg_schema_property`
set lower_uri = lower(uri);

#related subproperty id is null
update `swregistry_beta_new`.reg_schema_property as sp, `swregistry_beta_new`.reg_schema_property as sps
set sps.is_subproperty_of = sp.id
where sps.parent_uri = sp.uri
and sps.is_subproperty_of is null;

#related subproperty uri is null
update `swregistry_beta_new`.reg_schema_property as sp, `swregistry_beta_new`.reg_schema_property as sps
set sps.parent_uri = sp.uri
where sps.is_subproperty_of = sp.id
and sps.parent_uri = '';

--
-- reg_schema_property_element
--

ALTER TABLE `swregistry_beta_new`.`reg_schema_property_element`
ADD `lower_uri` VARCHAR(255) AFTER `deleted_by`;
CREATE INDEX `reg_schema_property_element_lower_uri_index` ON `swregistry_beta_new`.`reg_schema_property_element` (`lower_uri` ASC);

update `swregistry_beta_new`.reg_schema_property_element
set lower_uri = lower(left(object,255))
where object like 'http%';

update `swregistry_beta_new`.reg_schema_property_element cp, `swregistry_beta_new`.reg_schema_property  cc
set cp.related_schema_property_id = cc.id
where (cp.related_schema_property_id <> cc.id or cp.related_schema_property_id is null)
and cp.lower_uri = cc.lower_uri;

--
-- reg_schema_property_element_history
--

ALTER TABLE `swregistry_beta_new`.`reg_schema_property_element_history`
ADD `lower_uri` VARCHAR(255) AFTER `created_by`;
CREATE INDEX `reg_schema_propel_hist_rel_schema_lower_uri_index` ON `swregistry_beta_new`.`reg_schema_property_element_history` (`lower_uri` ASC);

update `swregistry_beta_new`.reg_schema_property_element_history
set lower_uri = lower(left(object,255))
where object like 'http%';

update `swregistry_beta_new`.reg_schema_property_element_history cp, `swregistry_beta_new`.reg_schema_property  cc
set cp.related_schema_property_id = cc.id
where (cp.related_schema_property_id <> cc.id or cp.related_schema_property_id is null)
and cp.lower_uri = cc.lower_uri;

--
-- drop indexes and remove 'lower' fields
--
DROP INDEX `reg_schema_property_lower_uri_index` ON `swregistry_beta_new`.`reg_schema_property`;
ALTER TABLE `swregistry_beta_new`.`reg_schema_property` DROP COLUMN `lower_uri`;

DROP INDEX `reg_schema_property_element_lower_uri_index` ON `swregistry_beta_new`.`reg_schema_property_element`;
ALTER TABLE `swregistry_beta_new`.`reg_schema_property_element` DROP COLUMN `lower_uri`;

DROP INDEX `reg_schema_propel_hist_rel_schema_lower_uri_index` ON `swregistry_beta_new`.`reg_schema_property_element_history`;
ALTER TABLE `swregistry_beta_new`.`reg_schema_property_element_history` DROP COLUMN `lower_uri`;

select object, concept_id, profile_property_id, skos_property_id, language,  related_concept_id, count(*) from reg_concept_property
group by object, concept_id, profile_property_id, skos_property_id, language,  related_concept_id
having count(*)>1;

#this will find duplicates. Run this before and after cleanup
select object, schema_property_id, profile_property_id, language, deleted_at, related_schema_property_id, count(*) from reg_schema_property_element
group by object, schema_property_id, profile_property_id, language, deleted_at, related_schema_property_id
having count(*)>1
order by profile_property_id, schema_property_id;

#copy data into this table to remove most duplicates
DROP TABLE IF EXISTS `reg_schema_property_element_copy`;
CREATE TABLE `reg_schema_property_element_copy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_user_id` int(10) unsigned DEFAULT NULL,
  `updated_user_id` int(10) unsigned DEFAULT NULL,
  `deleted_user_id` int(10) unsigned DEFAULT NULL,
  `schema_property_id` int(10) unsigned NOT NULL,
  `profile_property_id` int(10) unsigned NOT NULL,
  `is_schema_property` tinyint(1) DEFAULT NULL,
  `object` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_schema_property_id` int(10) unsigned DEFAULT NULL,
  `language` char(12) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `status_id` int(10) unsigned DEFAULT '1',
  `last_import_id` int(10) unsigned DEFAULT NULL,
  `is_generated` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `review_reciprocal` tinyint(1) DEFAULT NULL,
  `reciprocal_property_element_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reg_schema_property_element_unique_index` (`deleted_at`,`language`,`object`(750),`profile_property_id`,`related_schema_property_id`,`schema_property_id`) USING BTREE,
  KEY `reg_schema_property_element_created_user_id_index` (`created_user_id`),
  KEY `reg_schema_property_element_updated_user_id_index` (`updated_user_id`),
  KEY `reg_schema_property_element_deleted_user_id_index` (`deleted_user_id`),
  KEY `reg_schema_property_element_schema_property_id_index` (`schema_property_id`),
  KEY `reg_schema_property_element_profile_property_id_index` (`profile_property_id`),
  KEY `reg_schema_property_element_related_schema_property_id_index` (`related_schema_property_id`),
  KEY `reg_schema_property_element_status_id_index` (`status_id`),
  KEY `reg_schema_property_element_created_by_index` (`created_by`),
  KEY `reg_schema_property_element_updated_by_index` (`updated_by`),
  KEY `reg_schema_property_element_deleted_by_index` (`deleted_by`),
  KEY `reg_schema_property_element_reciprocal_property_element_id_index` (`reciprocal_property_element_id`),
  FULLTEXT KEY `full` (`object`),
  CONSTRAINT `reg_schema_property_element_copy_ibfk_1` FOREIGN KEY (`profile_property_id`) REFERENCES `profile_property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_10` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_11` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_3` FOREIGN KEY (`reciprocal_property_element_id`) REFERENCES `reg_schema_property_element` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_4` FOREIGN KEY (`created_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_5` FOREIGN KEY (`updated_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_6` FOREIGN KEY (`schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_7` FOREIGN KEY (`related_schema_property_id`) REFERENCES `reg_schema_property` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_8` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reg_schema_property_element_copy_ibfk_9` FOREIGN KEY (`deleted_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=323287 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `reg_schema_property_element_copy` (
       id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_property_id, profile_property_id, is_schema_property, object, related_schema_property_id, language, status_id, is_generated)
select id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_property_id, profile_property_id, is_schema_property, object, related_schema_property_id, language, status_id, is_generated
from `reg_schema_property_element`;

#delete the ones it didn't catch
delete from reg_schema_property_element_copy
where id in (184361,184365,184369,184373,184386,184377,184357,18194,14198,184362,184366,184370,184374,184387,184378,184358,184364,184368,184372,184376,184389,184380,184381,184360);

delete from reg_schema_property_element_copy
where id in (17380,17239,17438,222643,222702,121855,121941,121957,121961,121901,121896,121871,121604,121614,121624,121815,121827,121846,121866,121890,121912,121924,121936,121951,222658,222705);

delete from reg_schema_property_element_copy
where id in (222618,222698,222633,222700,222628,222699,222599,222694,222617,222697,222604,222695,222648,222703,222653,222704,222638,222701,222614,222696,7374,7365,7383,4523,4532,97424,184363,184367,184371,184375,184388,184379,184359);

#copy the data back
truncate `reg_schema_property_element`;
INSERT IGNORE INTO `reg_schema_property_element` (
       id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_property_id, profile_property_id, is_schema_property, object, related_schema_property_id, language, status_id, is_generated)
select id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_property_id, profile_property_id, is_schema_property, object, related_schema_property_id, language, status_id, is_generated
from `reg_schema_property_element_copy`;

DROP TABLE IF EXISTS `reg_schema_property_element_copy`;

#there should be no dupes now
select object, schema_property_id, profile_property_id, language, deleted_at, related_schema_property_id, count(*) from reg_schema_property_element
group by object, schema_property_id, profile_property_id, language, deleted_at, related_schema_property_id
having count(*)>1
order by profile_property_id, schema_property_id;

#this will show the dupes and should be run before and after cleanup.
select object, concept_id, profile_property_id, skos_property_id, language,  related_concept_id, count(*) from reg_concept_property
group by object, concept_id, profile_property_id, skos_property_id, language,  related_concept_id
having count(*)>1;

#this will delete them.
delete from reg_concept_property
where id in (20982,20983,21385,21386,417,637,711,710,18447,15589,15781,16447,16003,17467,17352,17469,17351,17468,16,1028,1027,2402,24238,42075,41871,41869,41915,20173,24356,42076,42007,42005,42006,15609,16446,17098,17466,18246,16915,17134,17133,16548,19536,20866,19765,19587,19616,19946,19449,19441,20873,19440,20849,18840,20485,20848,20864,31573,32081,41596,41594,32814,41568,19621,19767);
