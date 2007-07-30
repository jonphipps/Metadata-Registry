<h1>
<?php if ($sf_params->get('id')): ?>
   <?php
     /** @var Concept $concept **/
     $concept = $concept_property_history->getConceptRelatedByConceptId();
   ?>
   <?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
   <?php if ($concept): ?>
      <?php echo link_to($concept->getVocabulary()->getName(), 'vocabulary/show?id=' . $concept->getVocabularyId()) ?>
      <br />&nbsp;&nbsp;<?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $concept->getVocabularyId()) ?>
      <?php echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID()) ?>
   <br />&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Properties: ', '/conceptprop/list?concept_id='
     . $concept->getID()) . link_to($concept_property_history->getSkosProperty(), '/conceptprop/show?id='
     . $concept_property_history->getConceptPropertyId()) ?>
   <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('History: ', '/history/list?concept_id='
     . $concept->getID()) .  ' as of ' . $concept_property_history->getCreatedAt() ?>
   <?php endif; ?>
<?php endif; ?>
</h1>
