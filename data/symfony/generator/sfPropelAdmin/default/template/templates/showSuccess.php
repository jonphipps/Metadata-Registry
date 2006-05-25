[?php use_helpers('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'Text') ?]

<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

<div id="sf_admin_content">

[?php if ($sf_flash->has('notice')): ?]
<div class="save-ok">
<h2>[?php echo __($sf_flash->get('notice')) ?]</h2>
</div>
[?php endif ?]

<?php foreach ($this->getPrimaryKey() as $pk): ?>
[?php echo object_input_hidden_tag($<?php echo $this->getSingularName() ?>, 'get<?php echo $pk->getPhpName() ?>') ?]
<?php endforeach ?>

<?php foreach ($this->getColumnCategories('show.display') as $category): ?>
<?php
  if ($category[0] == '-')
  {
    $category_name = substr($category, 1);
    $collapse = true;
  }
  else
  {
    $category_name = $category;
    $collapse = false;
  }
?>
<fieldset class="<?php if ($collapse): ?> collapse<?php endif ?>">
<?php if ($category != 'NONE'): ?><h2>[?php echo __('<?php echo $category_name ?>') ?]</h2>

<?php endif ?>
<?php foreach ($this->getColumns('show.display', $category) as $name => $column): ?>
<?php $credentials = $this->getParameterValue('show.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif ?>
<div class="form-row">
  <label <?php if ($column->isNotNull()): ?>class="required" <?php endif ?>for="<?php echo $this->getSingularName() ?>[<?php echo $column->getName() ?>]">[?php echo __('<?php echo $this->getParameterValue('show.fields.'.$column->getName().'.name') ?>:') ?]</label>
  <div class="content[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?] form-error[?php endif ?]">
  [?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?]<div class="form-error-msg">&darr;&nbsp;[?php echo $sf_request->getError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}') ?]&nbsp;&darr;</div>[?php endif ?]

    [?php $showValue = <?php echo $this->getColumnShowTag($column) ?> ?]
    [?php if ($showValue): ?]
<?php $helper = $this->getParameterValue('show.fields.'.$column->getName().'.helper') ?>
<?php if ($helper): ?>
    [?php echo <?php echo $helper ?>(<?php echo $this->getColumnShowTag($column) ?>) ?]
<?php else: ?>
    [?php echo <?php echo $this->getColumnShowTag($column) ?> ?]
<?php endif ?>
  [?php else: ?]
    &nbsp;
  [?php endif ?]
  <?php echo $this->getHelp($column, 'show') ?>
  </div>
</div>
<?php if ($credentials): ?>
    [?php endif ?]
<?php endif ?>

<?php endforeach ?>
</fieldset>
<?php endforeach ?>

[?php echo include_partial('show_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]

<ul class="sf_admin_actions">
<?php
/*
 * WARNING: delete is a form, it must be outside the main form
 */
 $editActions = $this->getParameterValue('show.actions');
?>
  <?php if (!$editActions && isset($editActions['_delete'])): ?>
    <?php echo $this->addCredentialCondition($this->getButtonToAction('_delete', $editActions['_delete'], true), $editActions['_delete']) ?>
  <?php endif ?>
</ul>

</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>
