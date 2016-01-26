<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php $ts = ($timestamp) ? '/ts/' . date('YmdHis', $timestamp) : '';

$c = new Criteria();
$c->add(ProfilePropertyPeer::IS_IN_RDF, 1);
$c->add(SchemaPropertyElementPeer::DELETED_AT, null, Criteria::ISNULL);
//deprecated
$c->add(BaseSchemaPropertyElementPeer::STATUS_ID, 8, Criteria::NOT_EQUAL);
$elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyIdJoinProfileProperty($c);
$ns['dc'] = 'http://purl.org/dc/elements/1.1/';
$ns['foaf'] = 'http://xmlns.com/foaf/0.1/';
$ns['rdf'] = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
$ns['skos'] = 'http://www.w3.org/2004/02/skos/core#';

/** @var SchemaPropertyElement $element */
foreach ($elements as $element) {
    $uri = $element->getProfileProperty()->getUri();
    preg_match("/^(.*):/us", $uri, $matches);
    if ( ! isset($ns[$matches[1]])) {
        $prefix = PrefixPeer::findByPrefix($matches[1]);
        $ns[$matches[1]] = $prefix->getUri();
    }
}
ksort($ns);
?>
<rdf:RDF
<?php
echo '    xml:base="' .  htmlspecialchars($schema->getUri() . $ts) . '"';
foreach ($ns as $key => $uri) {
    echo "\n    xmlns:" . $key . '="' . $uri . '"';
}
?>
>

<?php if ($timestamp): ?>
<!--
NOTICE: This is a TimeSlice of this Element Set as of:
  <?php echo date(DATE_W3C, $timestamp) ?>.

The most current complete Element Set may be retrieved from:
  <?php echo $schema->getUri() ?>

-->
<?php endif; ?>
<!-- Element Set: <?php echo htmlspecialchars(html_entity_decode($schema->getName(), ENT_QUOTES | ENT_HTML5, 'UTF-8')); ?> -->
<rdf:Description rdf:about="<?php echo $schema->getUri() ?>">
  <dc:title xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars(html_entity_decode($schema->getName(), ENT_QUOTES | ENT_HTML5, 'UTF-8')); ?></dc:title>
<?php if ($schema->getNote()): ?>
  <skos:note  xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars(html_entity_decode($schema->getNote(), ENT_QUOTES | ENT_HTML5, 'UTF-8')); ?></skos:note>
<?php endif; ?>
<?php if ($schema->getUrl()): ?>
  <foaf:homepage rdf:resource="<?php echo htmlspecialchars($schema->getUrl()); ?>"/>
<?php endif; ?>
</rdf:Description>
    
<?php $statusArray = array();
        /** @var SchemaProperty $property */
      $statusId = $property->getStatusId();
      $statusArray[$statusId] = $statusId;
      echo include_partial('rdf', array(
      'property' => $property,
      'schema' => $schema,
      'elements' => $elements,
      'timestamp' => $timestamp,
      'type' => 'Property')); ?>
<?php echo include_partial('rdf/status', array(
      'statusArray' => $statusArray)); ?>
</rdf:RDF>
