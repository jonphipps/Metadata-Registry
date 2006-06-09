<?php echo '<?xml version="1.0" encoding = "UTF-8"?>' ?>

<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#" xmlns:skos="http://www.w3.org/2004/02/skos/core#" xmlns:dc="http://purl.org/dc/elements/1.1/">

    <!-- Scheme: <?php echo htmlspecialchars($vocabulary->getName(), ENT_NOQUOTES, 'UTF-8'); ?> -->
    <skos:ConceptScheme rdf:about="<?php echo htmlspecialchars($vocabulary->getUri()); ?>">
        <dc:title><?php echo htmlspecialchars($vocabulary->getName(), ENT_NOQUOTES, 'UTF-8'); ?></dc:title>
<?php foreach ($topConcepts as $topConcept): ?>
        <skos:hasTopConcept rdf:resource="<?php echo htmlspecialchars($topConcept->getUri()); ?>"/>
<?php endforeach; ?>
    </skos:ConceptScheme>

<?php foreach ($concepts as $concept): ?>
<?php $properties = $concept->getConceptPropertysRelatedByConceptId();
      echo include_partial('rdf/concept', array(
      'concept' => $concept,
      'vocabulary' => $vocabulary,
      'properties' => $properties,
      'skosProps' => $skosProps)); ?>

    <?php endforeach; ?>
</rdf:RDF>