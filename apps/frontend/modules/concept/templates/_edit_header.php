<?php $vocabulary = $sf_user->getCurrentVocabulary() ?>

<?php if ('edit' == $mode): ?>
<?php $title = __('Detail for %%pref_label%%',
array('%%pref_label%%' => $concept->getPrefLabel()));
$metaTitle = __('%%vocabulary%% :: Detail for %%pref_label%%',
array('%%vocabulary%%' => $vocabulary->getName(), '%%pref_label%%' => $concept->getPrefLabel()));
 ?>
<?php else: ?>
<?php $title = __('Creating new concept');
$metaTitle = __('%%vocabulary%% :: Creating new concept',
array('%%vocabulary%%' => $vocabulary->getName()));
 ?>
<?php endif;
  $sf_context->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $metaTitle); ?>

  <h1><?php echo link_to('Vocabulary:', 'vocabulary/list') ?>
<?php if ($vocabulary): ?>
  <?php echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $vocabulary->getId()) ?>
  <br /><?php echo link_to('Concepts: ', '/concept/list?vocabulary_id=' . $vocabulary->getID()) ?>
  <?php echo $title ?>
 <?php endif; ?>
</h1>
<?php if (!$sf_request->hasErrors()): ?>
<h2>&nbsp;Detail&nbsp;&nbsp;&nbsp;<?php echo link_to('Properties', '/concept/properties?id='.$concept->getId()) ?>&nbsp;&nbsp;&nbsp;<a href="#">History</a>&nbsp;&nbsp;&nbsp;<a href="#">Versions</a></h2>
<?php endif; ?>

