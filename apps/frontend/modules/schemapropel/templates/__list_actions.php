<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/26 17:56:58
?>
<ul class="sf_admin_actions">
<?php if ($sf_user->hasCredential( array (   0 =>    array (     0 => 'administrator',     1 => 'schemamaintainer',     2 => 'schemaadmin',   ), ))): ?>
<li><?php $property = $sf_user->getAttribute('schema_property','',sfUser::ATTRIBUTE_NAMESPACE);
  $propertyId = ($property) ? '?schema_property_id=' . $property->getId() : '';
  echo button_to(__s('Add Statement'), 'schemapropel/create' . $propertyId . '', array (
  'title' => 'Create',
  'class' => 'sf_admin_action_create',
)) ?></li>

<?php else: ?>
&nbsp;
<?php endif; ?></ul>
