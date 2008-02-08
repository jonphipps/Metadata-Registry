<?php $vocabulary = $sf_user->getCurrentVocabulary() ?>
<h1><?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
<?php if ($vocabulary):
  $title = __('Maintainers of %%vocabulary%%',
  array('%%vocabulary%%' => $vocabulary->getName()));
  $sf_context->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $title); ?>
  <?php echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $vocabulary->getId()) ?>
 <?php endif; ?>
</h1>
<?php include_partial('global/vocabnav', array('vocabulary' => $vocabulary)) ?>
