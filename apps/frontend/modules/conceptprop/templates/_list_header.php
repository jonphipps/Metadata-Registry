<h1>
<?php if ($sf_params->get('concept_id') || $sf_user->getAttribute('concept_id', null, 'sf_admin/concept_property/filters')): ?>
   <?php $concept = $sf_user->getCurrentConcept() ?>
   <?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
   <?php if ($concept): ?>
      <?php echo link_to($concept->getVocabulary()->getName(), 'vocabulary/show?id=' . $concept->getVocabularyId()) ?>
      <br />&nbsp;&nbsp;<?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $concept->getVocabularyId()) ?>
   <?php endif; ?>
   <?php if ($concept): ?>
      <?php echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID()) ?>
   <?php endif; ?>
<?php else: ?>
List of all properties
<?php endif; ?>
</h1>
<?php include_partial('global/conceptnav', array('concept' => $concept)) ?>
