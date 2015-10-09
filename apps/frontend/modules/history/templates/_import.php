<?php

/** @var \ConceptPropertyHistory $concept_property_history */
$property = $concept_property_history->getImportId();
if ($property) {
    echo link_to($property, '/import/show?id=' . $concept_property_history->getImportId());
} else {
    echo "&nbsp;";
}
