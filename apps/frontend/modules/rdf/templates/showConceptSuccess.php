<?php echo include_partial('rdf/rdfHead') ?>

    <!-- WARNING: This is a single-concept fragment -->

<?php echo include_partial('rdf/scheme', array(
      'vocabulary' => $vocabulary,
      'topConcepts' => $topConcepts)); ?>

<?php echo include_partial('rdf/concept', array(
      'concept' => $concept,
      'vocabulary' => $vocabulary,
      'properties' => $properties,
      'skosProps' => $skosProps)) ?>

</rdf:RDF>