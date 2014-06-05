<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';?>
<rdf:RDF xmlns="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xml:base="<?php echo htmlspecialchars($schema->getUri() . $ts); ?>"
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:skos="http://www.w3.org/2004/02/skos/core#"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:dct="http://purl.org/dc/terms/"
  xmlns:owl="http://www.w3.org/2002/07/owl#"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
  xmlns:reg="http://metadataregistry.org/uri/profile/RegAp/">

<?php if ($timestamp): ?>
<!--
NOTICE: This is a TimeSlice of this Element Set as of:
  <?php echo date(DATE_W3C, $timestamp) ?>.

The most current complete Element Set may be retrieved from:
  <?php echo $schema->getUri() ?>

-->
<?php endif; ?>
<!-- Element Set: <?php echo htmlspecialchars($schema->getName(), ENT_NOQUOTES, 'UTF-8'); ?> -->
<rdf:Description rdf:about="<?php echo $schema->getUri() ?>">
  <dc:title xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars($schema->getName(), ENT_NOQUOTES, 'UTF-8'); ?></dc:title>
<?php if ($schema->getNote()): ?>
  <skos:note  xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars($schema->getNote(), ENT_NOQUOTES, 'UTF-8'); ?></skos:note>
<?php endif; ?>
<?php if ($schema->getUrl()): ?>
  <foaf:homepage rdf:resource="<?php echo htmlspecialchars($schema->getUrl()); ?>"/>
<?php endif; ?>
</rdf:Description>
<?php $statusArray = array();
      $statusId = $property->getStatusId();
      $statusArray[$statusId] = $statusId;
      $c = new Criteria();
      $c->add(ProfilePropertyPeer::IS_IN_RDF,1);
      $c->add(SchemaPropertyElementPeer::DELETED_AT, null, Criteria::ISNULL);
      //deprecated
      $c->add(BaseSchemaPropertyElementPeer::STATUS_ID, 8, Criteria::NOT_EQUAL);
      $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyIdJoinProfileProperty($c);
      echo include_partial('rdf', array(
      'property' => $property,
      'schema' => $schema,
      'elements' => $elements,
      'timestamp' => $timestamp,
      'type' => 'Property')); ?>
<?php echo include_partial('rdf/status', array(
      'statusArray' => $statusArray)); ?>
</rdf:RDF>
