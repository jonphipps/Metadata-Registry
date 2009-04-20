<?php echo include_partial('rdf/rdfHead') ?>

<?php if ($timestamp): ?>
<!--
NOTICE: This is a TimeSlice of this Vocabulary as of:
  <?php echo date(DATE_W3C, $timestamp) ?>.

The most current complete Vocabulary may be retrieved from:
  <?php echo $vocabulary->getUri() ?>

-->
<?php endif; ?>

<?php echo include_partial('rdf/scheme', array(
      'vocabulary' => $vocabulary,
      'topConcepts' => $topConcepts,
      'timestamp' => $timestamp)); ?>

<?php foreach ($concepts as $concept): ?>
<?php $properties = $concept->getConceptPropertysRelatedByConceptId();
      echo include_partial('rdf/concept', array(
      'concept' => $concept,
      'vocabulary' => $vocabulary,
      'properties' => $properties,
      'skosProps' => $skosProps,
      'timestamp' => $timestamp)); ?>

<?php endforeach; ?>
</rdf:RDF>