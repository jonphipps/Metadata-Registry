<h1><?php echo $this->getModuleName() ?></h1>

<table>
<thead>
<tr>
<?php foreach ($this->getTableMap()->getColumns() as $column): ?>
  <th><?php echo sfInflector::humanize(sfInflector::underscore($column->getPhpName())) ?></th>
<?php endforeach ?>
</tr>
</thead>
<tbody>
[?php foreach ($<?php echo $this->getPluralName() ?> as $<?php echo $this->getSingularName() ?>): ?]
<tr>
<?php foreach ($this->getTableMap()->getColumns() as $column): ?>
  <?php if ($column->isPrimaryKey()): ?>
  <td>[?php echo link_to($<?php echo $this->getSingularName() ?>->get<?php echo $column->getPhpName() ?>(), '<?php echo $this->getModuleName() ?>/show?<?php echo $this->getPrimaryKeyUrlParams() ?>) ?]</td>
  <?php else: ?>
  <td>[?php echo $<?php echo $this->getSingularName() ?>->get<?php echo $column->getPhpName() ?>() ?]</td>
  <?php endif ?>
<?php endforeach ?>
</tr>
[?php endforeach ?]
</tbody>
</table>

[?php echo link_to ('create', '<?php echo $this->getModuleName() ?>/create') ?]
