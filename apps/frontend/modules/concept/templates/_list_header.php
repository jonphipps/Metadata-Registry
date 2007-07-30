<?php use_helper('TruncateUri') ?>
<?php $vocabulary = $sf_user->getCurrentVocabulary() ?>
<h1><?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
<?php if ($sf_user->getCurrentVocabulary()): ?>
  <?php echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $vocabulary->getId()) ?>
  <br />Concepts
 <?php endif; ?>
</h1>