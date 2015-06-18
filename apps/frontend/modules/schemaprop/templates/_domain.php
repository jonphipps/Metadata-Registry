<?php
$relPropertyId = $property->getIsSubpropertyOf();
$relPropertyUri = $property->getParentUri();
if ($relPropertyId) {
    //get the related concept
    $relProperty = SchemaPropertyPeer::retrieveByPK($relPropertyId);
    if ($relProperty) {
        echo link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relPropertyId, ['title' => $relPropertyUri]);
    }
}
    ?>
