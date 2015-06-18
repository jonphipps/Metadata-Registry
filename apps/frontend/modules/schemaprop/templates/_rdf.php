<!-- <?php echo $type; ?>: <?php
/** @var SchemaProperty $property */
$status = $property->getStatus();

if ($status->getId() == 8){
echo "DEPRECATED";
}else{
echo $property->getLabel();
}?> -->
<?php $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';
      /** @var SchemaProperty $property */
      $language = $property->getLanguage();
      $propType = $property->getType();
      $typeArray = array(
        'property' => "http://www.w3.org/1999/02/22-rdf-syntax-ns#Property",
        'class' => "http://www.w3.org/2002/07/owl#Class",
        'subproperty' => "http://www.w3.org/1999/02/22-rdf-syntax-ns#Property",
        'subclass' => "http://www.w3.org/2002/07/owl#Class",
      );
      $subArray = array(
        'subproperty' => "rdfs:subpropertyOf",
        'subclass' => "rdfs:subClassOf",
      );

/**
* @todo This does not at the moment handle history correctly (at all)
*       It also doesn't parse the indiviual elements (it's a bit of a hack)
**/
?>
<rdf:Description rdf:about="<?php /** @var SchemaProperty **/ echo $property->getUri() ?>">
  <rdfs:isDefinedBy rdf:resource="<?php echo $schema->getUri() ?>" />
  <reg:status rdf:resource="<?php echo $status->getUri(); ?>" />
<?php /** @var SchemaPropertyElement $element */
    foreach ($elements as $element) {
        /** @var ProfileProperty $property */
        $property = $element->getProfileProperty();
        $object = $element->getObject();
        $related = $element->getRelatedSchemaPropertyId();
        $uri = $property->getUri();
        if ('type' == $property->getName()) {
            $object = $typeArray[$object];
        }
        if ($object) {
            if ($property->getIsObjectProp()) {
                echo '  <' . $uri . ' rdf:resource="' . rtrim($object) . '" />' . PHP_EOL;
            } else {
                echo "  <" . $uri . ' xml:lang="' . $element->getLanguage() . '">'
                     . htmlspecialchars(html_entity_decode($object, ENT_QUOTES | ENT_HTML5, 'UTF-8'), ENT_NOQUOTES,
                            "UTF-8", false) . '</' . $uri . '>' . PHP_EOL;
            }
        }
        if ($related && empty($object)) {
            $relatedProperty = SchemaPropertyPeer::retrieveByPK($related);
            echo '<' . $uri . ' rdf:resource="' . $relatedProperty->getUri() . '" />' . PHP_EOL;
        }
    } ?>
</rdf:Description>

