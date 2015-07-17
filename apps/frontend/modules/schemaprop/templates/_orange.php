<?php
$c = new Criteria();
$c->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, 12);
/** @var SchemaProperty $schema_property */
$result = $schema_property->getSchemaPropertyElementsRelatedBySchemaPropertyId($c);
if (count($result)) {
    /** @var SchemaPropertyElement $range */
    $range = $result[0];
    //get the related property
    $relProperty = $range->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
    if ($relProperty) {
        echo link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relProperty->getId(),
            ['title' => $relProperty->getUri()]);
    } else {
        $relProperty = SchemaPropertyPeer::retrieveByUri($range->getObject());
        if ($relProperty) {
            //the id was broken, let's fix it...
            $range->setRelatedSchemaPropertyId($relProperty->getId());
            $range->save();
            echo link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relProperty->getId(),
                ['title' => $relProperty->getUri()]);
        } else {
            echo $range->getObject();
        }
    }
}
