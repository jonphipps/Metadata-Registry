<!-- Concept: <?php echo $concept->getPrefLabel(); ?>  -->
<?php
  $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';
  $language = $concept->getLanguage();
  $language = ($language) ? 'xml:lang="' . $language . '"' : '';
?>
    <skos:Concept rdf:about="<?php echo $concept->getUri() . $ts?>" <?php echo $language; ?>>
        <skos:inScheme rdf:resource="<?php echo $vocabulary->getUri() . $ts; ?>"/>
        <skos:status rdf:resource="<?php echo $status->getUri(); ?>"/>
<?php if ($concept->getIsTopConcept()): ?>
        <skos:topConceptOf rdf:resource="<?php echo $vocabulary->getUri(); ?>"/>
<?php endif; ?>
<?php
 foreach ($properties as $property): ?>
<?php
  if($timestamp)
  {
    $history = $property->getLastHistoryByTimestamp($timestamp);
    if ($history)
    {
      $property = $history;
    }
  }
  $skos = $property->getSkosPropertyId();
  $language = $property->getLanguage();
  $language = ($language) ? ' xml:lang="' . $language . '"' : '';
  $skosProp = $property->getSkosProperty();
  if (in_array($skos, $skosProps)): ?>
        <skos:<?php echo $skosProp->getName() ?> rdf:resource="<?php echo htmlspecialchars($property->getObject()); ?>"/>
<?php else: ?>
        <skos:<?php echo $skosProp->getName() . $language; ?>><?php echo htmlspecialchars($property->getObject(), ENT_NOQUOTES, 'UTF-8')?></skos:<?php echo $skosProp->getName() ?>>
<?php endif; ?>
<?php endforeach; ?>
    </skos:Concept>
