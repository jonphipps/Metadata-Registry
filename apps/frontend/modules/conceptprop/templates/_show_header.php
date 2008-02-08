<h1>
<?php if ($sf_params->get('id')): ?>
   <?php $concept = $sf_user->getCurrentConcept() ?>
   <?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
   <?php if ($concept): ?>
      <?php echo link_to($concept->getVocabulary()->getName(), 'vocabulary/show?id=' . $concept->getVocabularyId()) ?>
      <br />&nbsp;&nbsp;<?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $concept->getVocabularyId()) ?>
   <?php endif; ?>
   <?php $concept = $sf_user->getCurrentConcept() ?>
   <?php if ($concept): ?>
      <?php echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID()) ?>
   <?php endif; ?>
   <br />&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Properties: ', '/conceptprop/list?concept_id=' . $concept->getID()) . $concept_property->getSkosPropertyName() ?>
<?php endif; ?>
</h1>
<?php include_partial('global/propertynav', array('concept_property' => $concept_property)) ?>
