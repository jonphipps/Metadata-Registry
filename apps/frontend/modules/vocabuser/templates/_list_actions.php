<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/12 17:53:11
?>
<ul class="sf_admin_actions">
<?php if ($sf_user->hasCredential( array (   0 => array (0 => 'administrator', 1 => 'vocabularyadmin', 2 => 'agentadmin'   ), ))
&& '' != $sf_request->getParameter('vocabulary_id','')
&& count($sf_flash->get('newUsers', array()))): ?>
<li><?php echo button_to(__('Add Maintainer'), 'vocabuser/create?vocabulary_id=' . $sf_request->getParameter('vocabulary_id','') . '', array (
  'title' => 'Create',
  'class' => 'sf_admin_action_create',
)) ?></li>

<?php else: ?>
&nbsp;
<?php endif; ?></ul>