<?php $vocabulary = $sf_user->getCurrentVocabulary() ?>
<h1><?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
<?php if ($sf_user->getCurrentVocabulary()): ?>
  <?php echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $vocabulary->getId()) ?>
  <br /><?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $vocabulary->getID()) . $concept->getPrefLabel() ?>
 <?php endif; ?>
</h1>
<h2>&nbsp;Detail&nbsp;&nbsp;&nbsp;<?php echo link_to('Properties', '/concept/properties?id='.$concept->getId()) ?>&nbsp;&nbsp;&nbsp;<a href="#">History</a>&nbsp;&nbsp;&nbsp;<a href="#">Versions</a></h2>

