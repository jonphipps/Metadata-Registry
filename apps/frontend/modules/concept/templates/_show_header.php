<?php $vocabulary = $sf_user->getCurrentVocabulary(); ?>
<?php $metaTitle = __('%%vocabulary%% :: Show detail for %%pref_label%%',
  array('%%vocabulary%%' => $vocabulary->getName(), '%%pref_label%%' => $concept->getPrefLabel()));
  $sf_context->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $metaTitle); ?>
<h1>
 <?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
 <?php if ($concept): ?>
    <?php echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $concept->getVocabularyId()) ?>
    <br />&nbsp;&nbsp;<?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $concept->getVocabularyId()) ?>
 <?php endif; ?>
 <?php if ($concept): ?>
    <?php echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID()) ?>
 <?php endif; ?>
</h1>
<?php include_partial('global/conceptnav', array('concept' => $concept)) ?>
