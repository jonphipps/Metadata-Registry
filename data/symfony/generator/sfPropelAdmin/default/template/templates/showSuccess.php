[?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'Text') ?]

<div id="sf_admin_container">
<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

<div id="sf_admin_content">

[?php if ($sf_flash->has('notice')): ?]
<div class="save-ok">
<h2>[?php echo __($sf_flash->get('notice')) ?]</h2>
</div>
[?php endif; ?]

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
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($category_name)) ?>" class="<?php if ($collapse): ?> collapse<?php endif; ?>">
<?php if ($category != 'NONE'): ?><h2>[?php echo __('<?php echo $category_name ?>') ?]</h2>

<?php endif; ?>
<?php foreach ($this->getColumns('show.display', $category) as $name => $column): ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?php $credentials = $this->getParameterValue('show.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
<div id="form_row_<?php echo $this->getSingularName() ?>_<?php echo $column->getName() ?>" class="form-row">
  [?php echo label_for('<?php echo $this->getParameterValue("edit.fields.".$column->getName().".label_for", $this->getSingularName()."[".$column->getName()."]") ?>', __('<?php echo str_replace("'", "\\'", $this->getParameterValue('show.fields.'.$column->getName().'.name')) ?>:'), '<?php if ($column->isNotNull()): ?>class="required" <?php endif; ?>') ?]
  <div id="form_row_content_<?php echo $this->getSingularName() ?>_<?php echo $column->getName() ?>" class="content[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?] form-error[?php endif; ?]">

    [?php $showValue = <?php echo $this->getColumnShowTag($column) ?> ?]
    [?php if ($showValue): ?]
<?php $helper = $this->getParameterValue('show.fields.'.$column->getName().'.helper') ?>
<?php if ($helper): ?>
    [?php echo <?php echo $helper ?>(<?php echo $this->getColumnShowTag($column) ?>) ?]
<?php else: ?>
    [?php echo <?php echo $this->getColumnShowTag($column) ?> ?]
<?php endif; ?>
  [?php else: ?]
    &nbsp;
  [?php endif; ?]
  <?php if ($this->getParameterValue('show.helptype') == 'div'): echo $this->getHelp($column, 'show'); elseif ($this->getParameterValue('show.helptype') == 'icon'): echo $this->getHelpAsIcon($column, 'show'); endif; ?>
  </div>
</div>
<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>

<?php endforeach; ?>
</fieldset>
<?php endforeach; ?>

[?php include_partial('show_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]

<ul class="sf_admin_actions">
<?php
/*
 * WARNING: delete is a form, it must be outside the main form
 */
 $editActions = $this->getParameterValue('show.actions');
?>
  <?php if (isset($editActions['_delete'])): ?>
    <?php echo $this->addCredentialCondition($this->getButtonToAction('_delete', $editActions['_delete'], true), $editActions['_delete']) ?>
  <?php endif; ?>
</ul>

</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>
</div>