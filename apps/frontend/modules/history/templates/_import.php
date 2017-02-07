<?php

/** @var \ConceptPropertyHistory $concept_property_history */
$property = $concept_property_history->getImportId();
if ($property) {
    echo sf_link_to($property, '@import_show?id=' . $concept_property_history->getImportId());
} else {
    echo "&nbsp;";
}
