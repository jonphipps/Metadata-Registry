<?php /** @var sfAdminGenerator $this */
$hs = $this->getParameterValue('list.hide', array()) ?>
<?php /** @var sfAdminColumn $column */
foreach ($this->getColumns('list.display') as $column): ?>
<?php if (in_array($column->getName(), $hs)) continue ?>
<?php $condition = $this->getParameterValue('list.fields.'.$column->getName().'.condition') ?>
<?php if ($condition): ?>
    [?php if (<?php echo $condition ?>): ?]
<?php endif; ?>
<?php $credentials = $this->getParameterValue('list.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
<?php if ($column->isLink()): ?>
    <?php echo $this->getClass('td', $column, 'list')?>[?php echo link_to(<?php echo $this->getColumnListTag($column) ?> ? <?php echo $this->getColumnListTag($column) ?> : __('-'), '<?php echo $this->getRestRoute('show') ?>?<?php echo $this->getPrimaryKeyUrlParams() ?>) ?]</td>
<?php else: ?>
<?php $helper = $this->getParameterValue('list.fields.'.$column->getName().'.helper') ?>
  <?php if ($helper): ?>
      <?php echo $this->getClass('td', $column, 'list')?>[?php $value = <?php echo $helper ?>(<?php echo $this->getColumnListTag($column) ?>); echo ($value) ? $value : '&nbsp;' ?]</td>
  <?php else: ?>
      <?php echo $this->getClass('td', $column, 'list')?>[?php $value = <?php echo $this->getColumnListTag($column) ?>; echo ($value) ? $value : '&nbsp;' ?]</td>
  <?php endif; ?>
<?php endif; ?>
<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>
<?php if ($condition): ?>
    [?php endif; ?]
<?php endif; ?>
<?php endforeach; ?>
