<?php slot('feeds');
  $rss['rel'] = "meta";
  $rss['title'] = 'Get RDF';
  echo auto_discovery_link_tag('rdf', '@rdf_concept?id='.$concept->getId(), $rss); ?>

  <?php echo auto_discovery_link_tag('rdf', $concept->getUri() . ".rdf", $rss); ?>

<?php end_slot() ?>
