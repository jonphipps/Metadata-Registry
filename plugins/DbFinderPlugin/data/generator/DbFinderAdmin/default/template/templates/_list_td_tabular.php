<?php $hs = $this->getParameterValue('list.hide', array()) ?>
<?php foreach ($this->getColumns('list.display') as $column): ?>
<?php if (in_array($column->getName(), $hs)) continue ?>
<?php $credentials = $this->getParameterValue('list.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
  <?php if (list($moduleLink, $pkLink) = $this->DbFinderAdminGenerator->getColumnLink($column)): ?>
  <td>[?php echo <?php echo $this->getColumnListTag($column) ?> ? link_to(<?php echo $this->getColumnListTag($column) ?>, '<?php echo $moduleLink ?>/edit?<?php echo $pkLink ?>) : __('-') ?]</td>
<?php else: ?>
  <td>[?php echo <?php echo $this->getColumnListTag($column) ?> ?]</td>
  <?php endif; ?>
<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>
<?php endforeach; ?>
