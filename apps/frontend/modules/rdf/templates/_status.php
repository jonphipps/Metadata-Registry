<!-- Status properties used in this document  -->
<?php foreach ($statusArray as $statusId):
         $status = StatusPeer::retrieveByPK($statusId);
         /**
         * @todo Use the real vocabulary instead of the separate table in the DB
         **/
?>
    <skos:Concept rdf:about="<?php echo $status->getUri() ?>">
        <skos:prefLabel xml:lang="en"><?php echo $status->getDisplayName() ?></skos:prefLabel>
    </skos:Concept>
<?php endforeach; ?>
