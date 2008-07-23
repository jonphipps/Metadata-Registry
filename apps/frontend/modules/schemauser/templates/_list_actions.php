<ul class="sf_admin_actions">
<?php $key = $sf_request->getParameter('schema_id','');
  if ('' != $key && $sf_user->hasObjectCredential($key, 'Schema', array (   0 => array (0 => 'administrator', 1 => 'schemaadmin', 2 => 'agentadmin'   ), ))
&& '' != $sf_request->getParameter('schema_id','')
&& count($sf_flash->get('newUsers', array()))): ?>
<li><?php echo button_to(__('Add Maintainer'), 'schemauser/create?schema_id=' . $sf_request->getParameter('schema_id','') . '', array (
  'title' => 'Create',
  'class' => 'sf_admin_action_create',
)) ?></li>

<?php else: ?>
&nbsp;
<?php endif; ?></ul>