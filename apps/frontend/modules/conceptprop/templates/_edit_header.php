<h1>
<?php if ($sf_params->get('id')): ?>
   <?php $vocabulary = $sf_user->getCurrentVocabulary() ?>
   <?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
   <?php if ($vocabulary): ?>
      <?php echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $vocabulary->getId()) ?>
      <br />&nbsp;&nbsp;<?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $vocabulary->getID()) ?>
   <?php endif; ?>
   <?php $concept = $sf_user->getCurrentConcept() ?>
   <?php if ($concept): ?>
      <?php echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID()) ?>
   <?php endif; ?>
   <br />&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Properties: ', '/conceptprop/list?concept_id=' . $concept->getID()) . "Editing " .  $concept_property->getSkosPropertyName() ?>
<?php endif; ?>
</h1>
