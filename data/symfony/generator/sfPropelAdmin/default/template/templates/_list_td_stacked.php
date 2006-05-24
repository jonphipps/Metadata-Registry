<td colspan="<?php echo count($this->getColumns('list.display'))  ?>">
<?php if ($this->getParameterValue('list.params')): ?>
  <?php echo $this->getI18NString('list.params') ?>
<?php else: ?>
<?php foreach ($this->getColumns('list.display') as $column): ?>
  <?php if ($column->isLink()): ?>
  [?php echo link_to($this->getColumnListTag($column), '<?php echo $this->getModuleName() ?>/edit?<?php echo $this->getPrimaryKeyUrlParams() ?>) ?]
  <?php else: ?>
  [?php echo <?php echo $this->getColumnListTag($column) ?> ?]
  <?php endif; ?>
   - 
<?php endforeach; ?>
<?php endif; ?>
</td>