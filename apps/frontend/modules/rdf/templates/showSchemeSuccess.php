<?php echo include_partial('rdf/rdfHead') ?>

<?php echo include_partial('rdf/scheme', array(
      'vocabulary' => $vocabulary,
      'topConcepts' => $topConcepts)); ?>

<?php foreach ($concepts as $concept): ?>
<?php $properties = $concept->getConceptPropertysRelatedByConceptId();
      echo include_partial('rdf/concept', array(
      'concept' => $concept,
      'vocabulary' => $vocabulary,
      'properties' => $properties,
      'skosProps' => $skosProps)); ?>

<?php endforeach; ?>
</rdf:RDF>