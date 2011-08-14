<?php slot('feeds');
  $rss['rel'] = "meta";
  $rss['title'] = 'Get RDF';
  echo auto_discovery_link_tag('rdf', '@rdf_vocabulary?id='.$vocabulary->getId(), $rss); ?>

  <?php echo auto_discovery_link_tag('rdf', $vocabulary->getUri() . ".rdf", $rss); ?>

<?php end_slot() ?>
