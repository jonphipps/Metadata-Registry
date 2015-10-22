<!-- Concept: <?php echo $concept->getPrefLabel(); ?>  -->
<?php
  $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';
  $language = $concept->getLanguage();
  $language = ($language) ? 'xml:lang="' . $language . '"' : '';
?>
    <skos:Concept rdf:about="<?php echo htmlspecialchars($concept->getUri()) . $ts?>" <?php echo $language; ?>>
      <skos:inScheme rdf:resource="<?php echo htmlspecialchars($vocabulary->getUri()) . $ts; ?>"/>
      <reg:status rdf:resource="<?php echo htmlspecialchars($status->getUri()); ?>"/>
			<reg:identifier rdf:resource="<?php echo $concept->getId(); ?>"/>
<?php if ($concept->getIsTopConcept()): ?>
      <skos:topConceptOf rdf:resource="<?php echo htmlspecialchars($vocabulary->getUri()); ?>"/>
<?php endif; ?>
<?php
/** @var \ConceptProperty $property */
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
  $skosPropName = $skosProp ? $skosProp->getName() : '';
  if (in_array($skos, $skosProps)): ?>
	    <skos:<?php echo $skosPropName ?> rdf:resource="<?php echo htmlspecialchars($property->getObject()); ?>"/>
<?php else: ?>
      <skos:<?php echo $skosPropName . $language; ?>><?php echo htmlspecialchars(html_entity_decode($property->getObject(), ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?></skos:<?php echo $skosPropName ?>>
<?php endif; ?>
<?php endforeach; ?>
    </skos:Concept>
