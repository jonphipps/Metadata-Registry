<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/jpAdminPlugin/images/show_icon.png', array('alt' => __('show'), 'title' => __('show'))), 'schemauser/show?id='.$schema_has_user->getId()) ?></li>
  <li><?php if ($sf_user->hasObjectCredential($schema_has_user->getSchemaId(), 'schema',  array (   0 =>    array (     0 => 'administrator',     1 => 'schemaadmin',     2 => 'schemamaintainer',     3 => 'agentadmin'   ), ))
  && $schema_has_user->getUserId() != $sf_user->getAttribute('subscriber_id','','subscriber')): ?>
<?php echo link_to(image_tag('/jpAdminPlugin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), 'schemauser/edit?id='.$schema_has_user->getId()) ?>
<?php else: ?>
&nbsp;
<?php endif; ?></li>
  <li><?php if ($sf_user->hasObjectCredential($schema_has_user->getSchemaId(), 'schema',  array (   0 =>    array (     0 => 'administrator',     1 => 'schemaadmin',     2 => 'agentadmin',   ), ))
  && $schema_has_user->getUserId() != $sf_user->getAttribute('subscriber_id','','subscriber')): ?>
<?php echo link_to(image_tag('/jpAdminPlugin/images/delete_icon.png', array('alt' => __('delete'), 'title' => __('delete'))), 'schemauser/delete?id='.$schema_has_user->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
)) ?>
<?php else: ?>
&nbsp;
<?php endif; ?></li>
</ul>
</td>
