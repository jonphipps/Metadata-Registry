<?php $vocabulary = $sf_user->getCurrentVocabulary() ?>
<h1><?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
<?php if ($sf_user->getCurrentVocabulary()): ?>
  <?php echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $vocabulary->getId()) ?>
  <br /><?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $vocabulary->getID()) ?>
  Adding new
 <?php endif; ?>
</h1>

