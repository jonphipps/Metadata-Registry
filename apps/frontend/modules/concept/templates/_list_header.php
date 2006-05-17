<h1>
  Concepts <br />
  in <?php echo link_to('Vocabulary', 'vocabulary/list') ?>
<?php if ($sf_user->getCurrentVocabulary()): ?>
  <?php echo link_to($sf_user->getCurrentVocabulary()->getName(), 'vocabulary/show?id=' . $sf_user->getCurrentVocabulary()->getId()) ?>
 <?php endif; ?>
</h1>

