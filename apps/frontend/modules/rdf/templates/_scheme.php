<!-- Scheme: <?php echo htmlspecialchars($vocabulary->getName(), ENT_NOQUOTES, 'UTF-8'); ?> -->
    <skos:ConceptScheme rdf:about="<?php echo htmlspecialchars($vocabulary->getUri()); ?>">
        <dc:title><?php echo htmlspecialchars($vocabulary->getName(), ENT_NOQUOTES, 'UTF-8'); ?></dc:title>
<?php foreach ($topConcepts as $topConcept): ?>
        <skos:hasTopConcept rdf:resource="<?php echo htmlspecialchars($topConcept->getUri()); ?>"/>
<?php endforeach; ?>
    </skos:ConceptScheme>
