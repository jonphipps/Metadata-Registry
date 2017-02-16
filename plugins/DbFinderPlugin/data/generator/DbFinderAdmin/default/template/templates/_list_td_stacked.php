<td colspan="<?php echo count($this->getColumns('list.display'))  ?>">
<?php if ($this->getParameterValue('list.params')): ?>
  <?php echo $this->getI18NString('list.params') ?>
<?php else: ?>
<?php $hides = $this->getParameterValue('list.hide', array()) ?>
<?php foreach ($this->getColumns('list.display') as $column): ?>
<?php if (in_array($column->getName(), $hides)) continue ?>
<?php if (list($moduleLink, $pkLink) = $this->DbFinderAdminGenerator->getColumnLink($column)): ?>
  [?php echo <?php echo $this->getColumnListTag($column) ?> ? sf_link_to(<?php echo $this->getColumnListTag($column) ?>, '<?php echo $moduleLink ?>/edit?<?php echo $pkLink ?>) : __s('-') ?]
  <?php else: ?>
  [?php echo <?php echo $this->getColumnListTag($column) ?> ?]
  <?php endif; ?>
   - 
<?php endforeach; ?>
<?php endif; ?>
</td>