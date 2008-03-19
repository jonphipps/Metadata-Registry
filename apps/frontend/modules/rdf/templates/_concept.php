<!-- Concept: <?php echo $concept->getPrefLabel(); ?>  -->
    <skos:Concept rdf:about="<?php echo $concept->getUri(); ?>">
        <skos:inScheme rdf:resource="<?php echo $vocabulary->getUri(); ?>"/>
<?php
 foreach ($properties as $property): ?>
<?php
  $history = $property->getLastHistoryByTimestamp($timestamp);
  if ($history)
  {
    $property = $history;
  }
  $skos = $property->getSkosPropertyId();
  $skosProp = $property->getSkosProperty();
  if (in_array($skos, $skosProps)): ?>
        <skos:<?php echo $skosProp ?> rdf:resource="<?php echo htmlspecialchars($property->getObject()); ?>"/>
<?php else: ?>
        <skos:<?php echo $skosProp ?>><?php echo htmlspecialchars($property->getObject(), ENT_NOQUOTES, 'UTF-8'); ?></skos:<?php echo $skosProp ?>>
<?php endif; ?>
<?php endforeach; ?>
    </skos:Concept>
