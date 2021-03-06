<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php $ts = ($timestamp) ? '/ts/' . date('YmdHis', $timestamp) : '';
/** @var Schema $schema */
$ns = $schema->getRdfNamespaces();
?>
<rdf:RDF
    <?php
    echo 'xml:base="' . htmlspecialchars($schema->getUri() . $ts) . '"';
    foreach ((array) $ns as $key => $uri) {
      echo "\n    xmlns:" . $key . '="' . $uri . '"';
    }
    ?>
>

<?php if ($timestamp): ?>
<!--
NOTICE: This is a TimeSlice of this Element Set as of:
  <?php echo date(DATE_W3C, $timestamp) ?>.

The most current complete Vocabulary may be retrieved from:
  <?php echo $schema->getUri() ?>

-->
<?php endif; ?>
<!-- Element Set: <?php echo htmlspecialchars(html_entity_decode($schema->getName(), ENT_QUOTES | ENT_HTML5, 'UTF-8'))
?> -->
<rdf:Description rdf:about="<?php echo $schema->getUri() ?>">
  <dc:title xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars(html_entity_decode($schema->getName(), ENT_QUOTES | ENT_HTML5, 'UTF-8')); ?></dc:title>
<?php if ($schema->getUrl()): ?>
  <foaf:homepage rdf:resource="<?php echo htmlspecialchars($schema->getUrl()); ?>"/>
<?php endif; ?>
<?php if ($schema->getNote()): ?>
  <skos:note  xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars(html_entity_decode($schema->getNote(), ENT_QUOTES | ENT_HTML5, 'UTF-8')); ?></skos:note>
<?php endif; ?>
<?php /*  <dc:creator>Alistair Miles</dc:creator>
  <dc:creator>Nikki Rogers</dc:creator>
  <dc:creator>Dave Beckett</dc:creator>
  <dc:contributor>Members of the public-esw-thes@w3.org mailing list.</dc:contributor>
  <dct:modified>2006-04-18</dct:modified>
  <dct:hasVersion rdf:resource="http://www.w3.org/2004/02/skos/core/history/2006-04-18"/>
  <foaf:homepage rdf:resource="http://www.w3.org/2004/02/skos/core/"/>
  <rdfs:seeAlso>
    <rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core_de">
      <dc:description xml:lang="en">Gives labels, comments and definitions in German.</dc:description>
    </rdf:Description>
  </rdfs:seeAlso>
  <rdfs:seeAlso>
    <rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core_fr">
      <dc:description xml:lang="en">Gives labels, comments and definitions in French.</dc:description>
    </rdf:Description>
  </rdfs:seeAlso>
  <rdfs:seeAlso>
    <rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core_nl">
      <dc:description xml:lang="en">Gives labels, comments and definitions in Dutch.</dc:description>
    </rdf:Description>
  </rdfs:seeAlso>
  <rdfs:seeAlso>
    <rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core_pt">
      <dc:description xml:lang="en">Gives labels, comments and definitions in Portuguese.</dc:description>
    </rdf:Description>
  </rdfs:seeAlso>
*/ ?>
</rdf:Description>
<?php $statusArray = array();
      $c = new Criteria();
      $c->add(ProfilePropertyPeer::IS_IN_RDF,1);
      $c->add(SchemaPropertyElementPeer::DELETED_AT,null,Criteria::ISNULL);
      //deprecated
      $c->add(BaseSchemaPropertyElementPeer::STATUS_ID, 8, Criteria::NOT_EQUAL);
    if ($classes): ?>

<!-- Classes -->

<?php /** @var \SchemaProperty $property */
        foreach ($classes as $property): ?>
<?php $statusId = $property->getStatusId();
      $statusArray[$statusId] = $statusId;

      $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyIdJoinProfileProperty($c);
      echo include_partial('schemaprop/rdf', array(
      'property' => $property,
      'schema' => $schema,
      'elements' => $elements,
      'timestamp' => $timestamp,
      'type' => 'Class')); ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($properties): ?>

<!-- Properties -->

<?php /** @var \SchemaProperty $property */
    foreach ($properties as $property): ?>
<?php $statusId = $property->getStatusId();
      $statusArray[$statusId] = $statusId;
      $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyIdJoinProfileProperty($c);
      echo include_partial('schemaprop/rdf', array(
      'property' => $property,
      'schema' => $schema,
      'elements' => $elements,
      'timestamp' => $timestamp,
      'type' => 'Property')); ?>
<?php endforeach; ?>
<?php endif; ?>

<?php echo include_partial('rdf/status', array(
      'statusArray' => $statusArray)); ?>
</rdf:RDF>
