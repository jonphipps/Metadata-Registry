<?php
$c = new Criteria();
$c->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID,12 );
/** @var SchemaProperty $schema_property */
$result = $schema_property->getSchemaPropertyElementsRelatedBySchemaPropertyId($c);
if (count($result)) {
    /** @var SchemaPropertyElement $domain */
    $domain = $result[0];
    //get the related property
    $relProperty = $domain->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
    if ($relProperty) {
        echo link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relProperty->getId(), ['title' => $relProperty->getUri()]);
    }
}
    ?>
