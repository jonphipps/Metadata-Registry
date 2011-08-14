<ul class="sf_admin_actions">
<?php if ($sf_user->hasObjectCredential($schema_has_user->getSchemaId(), 'schema',  array (   0 =>    array (     0 => 'administrator',     1 => 'schemaadmin',     2 => 'agentadmin',   ), ))
  && $schema_has_user->getUserId() != $sf_user->getAttribute('subscriber_id','','subscriber')): ?>
<li class="float-left-show"><?php if ($schema_has_user->getId()): ?>
<?php echo button_to(__('Delete'), 'schemauser/delete?id='.$schema_has_user->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'title' => 'Delete',
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
 <?php endif; ?>
<?php if ($sf_user->hasObjectCredential($schema_has_user->getSchemaId(), 'schema',  array (   0 =>    array (     0 => 'administrator',     1 => 'schemaadmin',     2 => 'agentadmin',   ), ))
 && $schema_has_user->getUserId() != $sf_user->getAttribute('subscriber_id','','subscriber')): ?>
<li><?php echo button_to(__('Edit'), 'schemauser/edit?id='.$schema_has_user->getId(), array (
  'title' => 'Edit',
  'class' => 'sf_admin_action_edit',
)) ?></li>
 <?php endif; ?>
<?php if ($sf_user->hasObjectCredential($schema_has_user->getSchemaId(), 'schema',  array (   0 =>    array (     0 => 'administrator',     1 => 'schemaadmin',     2 => 'agentadmin',   ), ))
&& count($sf_flash->get('newUsers', array()))): ?>
<li><?php if ($schema_has_user->getId()): ?>
<?php echo button_to(__('Add Maintainer'), 'schemauser/create', array (
  'title' => 'Create',
  'class' => 'sf_admin_action_create',
)) ?><?php endif; ?>
</li>
 <?php endif; ?>
</ul>