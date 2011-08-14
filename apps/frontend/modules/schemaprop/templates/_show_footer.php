<?php slot('feeds');
  $rss['rel'] = "meta";
  $rss['title'] = 'Get RDF';
  echo auto_discovery_link_tag('rdf', '@rdf_schema_prop?id='.$schema_property->getId(), $rss); ?>

  <?php echo auto_discovery_link_tag('rdf', $schema_property->getUri() . ".rdf", $rss); ?>

<?php end_slot() ?>
