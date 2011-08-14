
<!--<?php echo $type; ?>: <?php echo $property->getLabel();?>-->
<?php $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';
      $language = $property->getLanguage();
      $status = $property->getStatus();
      $propType = $property->getType();
      $typeArray = array(
        'property' => "http://www.w3.org/1999/02/22-rdf-syntax-ns#Property",
        'class' => "http://www.w3.org/2002/07/owl#Class",
        'subproperty' => "http://www.w3.org/1999/02/22-rdf-syntax-ns#Property",
        'subclass' => "http://www.w3.org/2002/07/owl#Class"
      );
      $subArray = array(
        'subproperty' => "rdfs:subpropertyOf",
        'subclass' => "rdfs:subClassOf"
      );

/**
* @todo This does not at the moment handle history correctly (at all)
*       It also doesn't parse the indiviual elements (it's a bit of a hack)
**/
?>
<rdf:Description rdf:about="<?php /** @var SchemaProperty **/ echo $property->getUri() ?>">
  <rdfs:isDefinedBy rdf:resource="<?php echo $schema->getUri() ?>" />
  <reg:status rdf:resource="<?php echo $status->getUri(); ?>" />
<?php foreach ($elements as $element):
        $property = $element->getProfileProperty();
        $object = $element->getObject();
        $related = $element->getRelatedSchemaPropertyId();
        $uri = $property->getUri();
        if ('type' == $property->getName())
        {
          $object = $typeArray[$object];
        } ?>
<?php if ($object): ?>
<?php  if ($property->getHasLanguage()): ?>
  <<?php echo $uri ?> xml:lang="<?php /** @var SchemaPropertyElement **/ echo $element->getLanguage() ?>"><?php echo htmlspecialchars($object, ENT_NOQUOTES, "UTF-8", false) ?></<?php echo $uri ?>>
<?php else: ?>
  <<?php echo $uri ?> rdf:resource="<?php echo rtrim($object) ?>" />
<?php endif; ?>
<?php endif; ?>
<?php if ($related && empty($object)):
  $relatedProperty = SchemaPropertyPeer::retrieveByPK($related); ?>
  <<?php echo $uri ?> rdf:resource="<?php echo $relatedProperty->getUri() ?>" />
<?php endif; ?>
<?php endforeach; ?>
</rdf:Description>

