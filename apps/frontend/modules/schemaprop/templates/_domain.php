<?php
$c = new Criteria();
$c->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID,11 );
/** @var SchemaProperty $schema_property */
$result = $schema_property->getSchemaPropertyElementsRelatedBySchemaPropertyId($c);
if (count($result)) {
    /** @var SchemaPropertyElement $domain */
    $domain = $result[0];
    //get the related property
    $relProperty = $domain->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
    if ($relProperty) {
        echo sf_link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relProperty->getId(), ['title' => $relProperty->getUri()]);
    } else {
        $relProperty = SchemaPropertyPeer::retrieveByUri($domain->getObject());
        if ($relProperty) {
            //the id was broken, let's fix it...
            $domain->setRelatedSchemaPropertyId($relProperty->getId());
            $domain->save();
            echo sf_link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relProperty->getId(),
                ['title' => $relProperty->getUri()]);
        } else {
            echo $domain->getObject();
        }
    }
}
