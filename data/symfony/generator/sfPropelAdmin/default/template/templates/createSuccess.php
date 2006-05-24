[?php use_helpers('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?]

<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/create_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

<div id="sf_admin_content">

[?php if ($sf_request->hasErrors()): ?]
<div class="form-errors">
<h2>[?php echo __('There are some errors that keep this form from validating') ?]</h2>
<ul>
[?php foreach ($sf_request->getErrorNames() as $name): ?]
  <li>[?php echo $sf_request->getError($name) ?]</li>
[?php endforeach; ?]
</ul>
</div>
[?php elseif ($sf_flash->has('notice')): ?]
<div class="save-ok">
<h2>[?php echo __($sf_flash->get('notice')) ?]</h2>
</div>
[?php endif; ?]

[?php echo form_tag('<?php echo $this->getModuleName() ?>/edit', 'id=sf_admin_edit_form name=sf_admin_edit_form multipart=true') ?]

<?php foreach ($this->getPrimaryKey() as $pk): ?>
[?php echo object_input_hidden_tag($<?php echo $this->getSingularName() ?>, 'get<?php echo $pk->getPhpName() ?>') ?]
<?php endforeach; ?>

<?php foreach ($this->getColumnCategories('create.display') as $category): ?>
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
<fieldset class="<?php if ($collapse): ?> collapse<?php endif; ?>">
<?php if ($category != 'NONE'): ?><h2>[?php echo __('<?php echo $category_name ?>') ?]</h2>

<?php endif; ?>
<?php foreach ($this->getColumns('create.display', $category) as $name => $column): ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?php $credentials = $this->getParameterValue('create.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
<?php if ($this->getParameterValue('create.fields.'.$column->getName().'.type') == 'input_hidden_tag'): ?>
  [?php echo <?php echo $this->getColumnCreateTag($column) ?> ?]
<?php else: ?>
<div class="form-row">
  <label <?php if ($column->isNotNull()): ?>class="required" <?php endif; ?>for="<?php echo $this->getSingularName() ?>[<?php echo $column->getName() ?>]">[?php echo __('<?php echo $this->getParameterValue('create.fields.'.$column->getName().'.name') ?>:') ?]</label>
  <div class="content[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?] form-error[?php endif; ?]">
  [?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?]<div class="form-error-msg">&darr;&nbsp;[?php echo $sf_request->getError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}') ?]&nbsp;&darr;</div>[?php endif; ?]

  [?php echo <?php echo $this->getColumnCreateTag($column) ?> ?]
  <?php echo $this->getHelp($column, 'create') ?>
  </div>
</div>
<?php endif; ?>
<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>

<?php endforeach; ?>
</fieldset>
<?php endforeach; ?>

[?php echo include_partial('create_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]

</form>

</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/create_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>
