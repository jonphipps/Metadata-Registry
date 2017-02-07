<?php

/** @var SchemaPropertyElementHistory $schema_property_element_history */
$property = $schema_property_element_history->getImportId();
if ($property) {
    echo sf_link_to($property, '/import/show?id=' . $schema_property_element_history->getImportId());
}
