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
  xmlns:reg="http://metadataregistry.org/uri/profile/RegAp/"
  xmlns:status="http://metadataregistry.org/uri/RegStatus/">

<?php if ($timestamp): ?>
<!--
NOTICE: This is a TimeSlice of this Schema as of:
  <?php echo date(DATE_W3C, $timestamp) ?>.

The most current complete Vocabulary may be retrieved from:
  <?php echo $schema->getUri() ?>

-->
<?php endif; ?>
<!-- Schema: <?php echo htmlspecialchars($schema->getName(), ENT_NOQUOTES, 'UTF-8'); ?> -->
<rdf:Description rdf:about="<?php echo $schema->getUri() ?>">
  <dc:title xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars($schema->getName(), ENT_NOQUOTES, 'UTF-8'); ?></dc:title>
  <dc:description xml:lang="<?php echo $schema->getLanguage();?>">An RDF vocabulary for describing the basic structure and content of concept schemes such as thesauri, classification schemes, subject heading lists, taxonomies, 'folksonomies', other types of controlled vocabulary, and also concept schemes embedded in glossaries and terminologies.</dc:description>
<?php if ($schema->getUrl()): ?>
  <foaf:homepage rdf:resource="<?php echo htmlspecialchars($schema->getUrl()); ?>"/>
<?php endif; ?>
</rdf:Description>
<?php $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyId();
      echo include_partial('rdf', array(
      'property' => $property,
      'schema' => $schema,
      'elements' => $elements,
      'timestamp' => $timestamp,
      'type' => 'Property')); ?>

</rdf:RDF>