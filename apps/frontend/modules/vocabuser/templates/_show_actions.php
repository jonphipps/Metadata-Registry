<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/07 18:39:17
?>
<ul class="sf_admin_actions">
<?php if ($sf_user->hasObjectCredential($vocabulary_has_user->getVocabularyId(), 'vocabulary',  array (   0 =>    array (     0 => 'administrator',     1 => 'vocabularyadmin',     2 => 'agentadmin',   ), ))
  && $vocabulary_has_user->getUserId() != $sf_user->getAttribute('subscriber_id','','subscriber')): ?>
<li class="float-left-show"><?php if ($vocabulary_has_user->getId()): ?>
<?php echo button_to(__('Delete'), 'vocabuser/delete?id='.$vocabulary_has_user->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'title' => 'Delete',
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
 <?php endif; ?>
<?php if ($sf_user->hasObjectCredential($vocabulary_has_user->getVocabularyId(), 'vocabulary',  array (   0 =>    array (     0 => 'administrator',     1 => 'vocabularyadmin',     2 => 'agentadmin',   ), ))
 && $vocabulary_has_user->getUserId() != $sf_user->getAttribute('subscriber_id','','subscriber')): ?>
<li><?php echo button_to(__('Edit'), 'vocabuser/edit?id='.$vocabulary_has_user->getId(), array (
  'title' => 'Edit',
  'class' => 'sf_admin_action_edit',
)) ?></li>
 <?php endif; ?>
<?php if ($sf_user->hasObjectCredential($vocabulary_has_user->getVocabularyId(), 'vocabulary',  array (   0 =>    array (     0 => 'administrator',     1 => 'vocabularyadmin',     2 => 'agentadmin',   ), ))
&& count($sf_flash->get('newUsers', array()))): ?>
<li><?php if ($vocabulary_has_user->getId()): ?>
<?php echo button_to(__('Add Maintainer'), 'vocabuser/create', array (
  'title' => 'Create',
  'class' => 'sf_admin_action_create',
)) ?><?php endif; ?>
</li>
 <?php endif; ?>
</ul>