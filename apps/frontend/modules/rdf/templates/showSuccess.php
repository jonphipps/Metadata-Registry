<?php echo '<?xml version="1.0" encoding = "UTF-8"?>' ?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#" xmlns:skos="http://www.w3.org/2004/02/skos/core#" xmlns:dc="http://purl.org/dc/elements/1.1/">

    <!-- <?php echo $vocabulary->getName(); ?> -->
    <skos:ConceptScheme rdf:about="<?php echo $vocabulary->getUri(); ?>">
        <dc:title><?php echo $vocabulary->getName(); ?></dc:title>
        <skos:hasTopConcept rdf:resource="http://metadataregistry.org/NSDLEdLvl#1001"/>
        <skos:hasTopConcept rdf:resource="http://metadataregistry.org/NSDLEdLvl#1018"/>
    </skos:ConceptScheme>

    <!-- NSDL Education Level vocabulary -->
    <skos:ConceptScheme rdf:about="http://metamanagement.comm.nsdl.org/EdLevelFinal.htm">
        <dc:title>NSDL Education Level Vocabulary, Final Version</dc:title>
        <dc:language>en</dc:language>
        <skos:hasTopConcept rdf:resource="http://metadataregistry.org/NSDLEdLvl#1001"/>
        <skos:hasTopConcept rdf:resource="http://metadataregistry.org/NSDLEdLvl#1018"/>
    </skos:ConceptScheme>

    <!-- <?php echo $concept ?>  -->
    <skos:Concept rdf:about="http://metadataregistry.org/NSDLEdLvl#1000">
    <skos:Concept rdf:about="<?php echo $concept->getUri(); ?>">
    <?php foreach ($properties as $property): ?>
        <skos:<?php echo $property ?>><?php echo $property ?></skos:<?php echo $property ?>>>
    <?php endforeach; ?>
        <skos:prefLabel>Grades Pre-K to 12</skos:prefLabel>
        <skos:narrower rdf:resource="http://metadataregistry.org/NSDLEdLvl#1001"/>
        <skos:narrower rdf:resource="http://metadataregistry.org/NSDLEdLvl#1009"/>
        <skos:narrower rdf:resource="http://metadataregistry.org/NSDLEdLvl#1013"/>
    </skos:Concept>

</rdf:RDF>