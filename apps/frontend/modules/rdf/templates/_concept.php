<!-- Concept: <?php echo $concept->getPrefLabel(); ?>  -->
<?php
  $ts = ($timestamp) ? '/ts/' . date('YmdHis',$timestamp) : '';
  $language = $concept->getLanguage();
  $language = ($language) ? 'xml:lang="' . $language . '"' : '';
?>
    <skos:Concept rdf:about="<?php echo htmlspecialchars($concept->getUri()) . $ts?>" <?php echo $language; ?>>
      <skos:inScheme rdf:resource="<?php echo htmlspecialchars($vocabulary->getUri()) . $ts; ?>"/>
      <reg:status rdf:resource="<?php echo htmlspecialchars($status->getUri()); ?>"/>
      <reg:identifier rdf:resource="http://metadataregistry.org/concepts/<?php echo $concept->getId(); ?>"/>
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
  $skosProp = $property->getProfileProperty();
  $skosPropUri = $skosProp ? $skosProp->getUri() : '';
  if (in_array($skos, $skosProps)): ?>
	    <<?php echo $skosPropUri ?> rdf:resource="<?php echo htmlspecialchars($property->getObject()); ?>"/>
<?php else: ?>
      <<?php echo $skosPropUri . $language; ?>><?php echo htmlspecialchars(html_entity_decode($property->getObject(), ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?></<?php echo $skosPropUri ?>>
<?php endif; ?>
<?php endforeach; ?>
    </skos:Concept>
