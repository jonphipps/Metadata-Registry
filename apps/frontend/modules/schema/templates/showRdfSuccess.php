<?xml version="1.0" encoding="UTF-8"?>
<?php $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';?>
<!DOCTYPE rdf:RDF[
  <!ENTITY rdf "http://www.w3.org/1999/02/22-rdf-syntax-ns#">
  <!ENTITY rdfs "http://www.w3.org/2000/01/rdf-schema#">
  <!ENTITY dc "http://purl.org/dc/elements/1.1/">
  <!ENTITY dct "http://purl.org/dc/terms/">
  <!ENTITY foaf "http://xmlns.com/foaf/0.1/">
  <!ENTITY owl "http://www.w3.org/2002/07/owl#">
  <!ENTITY skos "http://www.w3.org/2004/02/skos/core#">
  <!ENTITY reg "http://metadataregistry.org/uri/profile/RegAp/">
  <!ENTITY status "http://metadataregistry.org/uri/RegStatus/">
]>
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
<rdf:Description rdf:about="">
  <dc:title xml:lang="<?php echo $schema->getLanguage();?>"><?php echo htmlspecialchars($schema->getName(), ENT_NOQUOTES, 'UTF-8'); ?></dc:title>
  <dc:description xml:lang="<?php echo $schema->getLanguage();?>">An RDF vocabulary for describing the basic structure and content of concept schemes such as thesauri, classification schemes, subject heading lists, taxonomies, 'folksonomies', other types of controlled vocabulary, and also concept schemes embedded in glossaries and terminologies.</dc:description>
<?php if ($schema->getUrl()): ?>
  <foaf:homepage rdf:resource="<?php echo htmlspecialchars($schema->getUrl()); ?>"/>
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
<?php if ($classes): ?>

<!-- Classes -->
<?php foreach ($classes as $property): ?>
<?php $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyId();
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
<?php foreach ($properties as $property): ?>
<?php $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyId();
      echo include_partial('schemaprop/rdf', array(
      'property' => $property,
      'schema' => $schema,
      'elements' => $elements,
      'timestamp' => $timestamp,
      'type' => 'Property')); ?>
<?php endforeach; ?>
<?php endif; ?>

</rdf:RDF>