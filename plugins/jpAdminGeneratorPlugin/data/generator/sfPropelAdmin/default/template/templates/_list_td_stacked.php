[?php
  /** @var sfContext $sf_context */
  /** @var sfParameterHolder $sf_flash */
  /** @var sfParameterHolder $sf_params */
  /** @var myWebRequest $sf_request */
  /** @var myUser $sf_user */
  /** @var sfPartialView $sf_view */
  /** @var <?php /** @var sfPropelAdminGenerator $this */
echo $this->getClassName() ?>  $<?php echo $this->getSingularName() ?> */
  ?]
<td colspan="<?php echo count($this->getColumns('list.display'))  ?>">
<?php if ($this->getParameterValue('list.params')): ?>
  <?php echo $this->getI18NString('list.params') ?>
<?php else: ?>
<?php $hides = $this->getParameterValue('list.hide', array()) ?>
<?php foreach ($this->getColumns('list.display') as $column): ?>
<?php if (in_array($column->getName(), $hides)) continue ?>
<?php $condition = $this->getParameterValue('list.fields.'.$column->getName().'.condition') ?>
<?php if ($condition): ?>
[?php if (<?php echo $condition ?>): ?]
<?php endif; ?>
  <?php if ($column->isLink()): ?>
  [?php echo link_to(<?php echo $this->getColumnListTag($column) ?> ? <?php echo $this->getColumnListTag($column) ?> : __('-'), '<?php echo $this->getModuleName() ?>/edit?<?php echo $this->getPrimaryKeyUrlParams() ?>) ?]
  <?php else: ?>
<?php $helper = $this->getParameterValue('list.fields.'.$column->getName().'.helper') ?>
<?php if ($helper): ?>
  [?php $value = <?php echo $helper ?>(<?php echo $this->getColumnListTag($column) ?>); echo ($value) ? $value : '&nbsp;' ?]
<?php else: ?>
  [?php $value = <?php echo $this->getColumnListTag($column) ?>; echo ($value) ? $value : '&nbsp;' ?]
<?php endif; ?>
  <?php endif; ?>
   -
<?php if (isset($credentials) && $credentials): ?>
[?php endif; ?]
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
</td>
