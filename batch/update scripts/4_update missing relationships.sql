update `reg_schema_property_element` as mas, `reg_schema_property` as rel, `profile_property`
set mas.`related_schema_property_id` = rel.`id`
WHERE mas.`object` IS NOT NULL
and mas.`object` = rel.`uri`
and mas.`related_schema_property_id` is NULL
and `profile_property`.id = mas.`profile_property_id`
and `profile_property`.`is_object_prop` = 1;
