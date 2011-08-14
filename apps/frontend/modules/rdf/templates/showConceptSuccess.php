<?php echo include_partial('rdf/rdfHead')?>


<!-- NOTICE: This is a single-concept fragment -->
<?php if ($timestamp): ?>

<!--
NOTICE: This is a TimeSlice of this Concept as of:
  <?php echo date(DATE_W3C, $timestamp) ?>.

The most current complete Concept may be retrieved from:
  <?php echo $concept->getUri() ?>

-->
<?php endif; ?>

<?php echo include_partial('rdf/scheme', array(
      'vocabulary'  => $vocabulary,
      'topConcepts' => $topConcepts,
      'timestamp'   => $timestamp)); ?>

<?php $status = $concept->getStatus();
      $statusId = $concept->getStatusId();
      $statusArray[$statusId] = $statusId;

      echo include_partial('rdf/concept', array(
      'concept' => $concept,
      'vocabulary' => $vocabulary,
      'properties' => $properties,
      'skosProps'  => $skosProps,
      'timestamp'  => $timestamp,
      'status'     => $status)); ?>

<?php echo include_partial('rdf/status', array(
      'statusArray' => $statusArray)); ?>

</rdf:RDF>