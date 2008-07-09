
<!--<?php echo $type; ?>: <?php echo $property->getLabel();?>-->
<?php $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';
      $language = $property->getLanguage();
      $status = $property->getStatus();
      $propType = $property->getType();
      $sub = ('subproperty' == $propType) ? 'subPropertyOf' : '';
      $sub = ('subclass' == $propType) ? 'subClassOf' : '';

/**
* @todo This does not at the moment handle history correctly (at all)
*       It also doesn't parse the indiviual elements (it's a bit of a hack)
**/

?>
<?php if ('Class' == $type): ?>
<rdfs:Class rdf:ID="<?php echo $property->getName() ?>">
<?php else: ?>
<rdf:Property rdf:about="<?php /** @var SchemaProperty **/ echo $property->getUri() ?>">
<?php endif; ?>
  <rdfs:label xml:lang="<?php echo $language ?>"><?php echo $property->getLabel() ?></rdfs:label>
<?php if ('subproperty' == $type):
  /** @var SchemaProperty **/
  $subproperty = $property->getSchemaPropertyRelatedByIsSubpropertyOf();
?>
<?php if ($subproperty):
  $uri = $subproperty->getUri();
?>
  <rdfs:<?php echo $sub ?> rdf:resource="<?php echo $uri ?>"/>
<?php endif; ?>
<?php endif; ?>
<?php if ($property->getComment()): ?>
  <rdfs:comment xml:lang="<?php echo $language ?>"><?php echo $property->getComment() ?></rdfs:comment>
<?php endif; ?>
<?php if ($property->getDefinition()): ?>
  <skos:definition xml:lang="<?php echo $language ?>">
    <?php echo $property->getDefinition() ?>
  </skos:definition>
<?php endif; ?>
  <rdfs:isDefinedBy rdf:resource="<?php echo $schema->getUri() ?>"/>
  <reg:status rdf:resource="<?php echo $status->getUri() ?>" />
<?php if ($property->getNote()): ?>
  <skos:note xml:lang="<?php echo $language ?>">
    <?php echo $property->getNote() . "\n" ?>
  </skos:note>
<?php endif; ?>
<?php if ('Class' == $type): ?>
</rdfs:Class>
<?php else: ?>
</rdf:Property>
<?php endif; ?>
