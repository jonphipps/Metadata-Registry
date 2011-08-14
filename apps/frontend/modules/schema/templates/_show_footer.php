<?php slot('feeds');
  $rss['rel'] = "meta";
  $rss['title'] = 'Get RDF';
  echo auto_discovery_link_tag('rdf', '@rdf_schema?id='.$schema->getId(), $rss); ?>

  <?php echo auto_discovery_link_tag('rdf', $schema->getUri() . ".rdf", $rss); ?>

<?php end_slot() ?>
