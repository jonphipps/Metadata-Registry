[?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?]

<div id="sf_admin_container">
<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

<div id="sf_admin_content">

<?php
/**
* @todo make the error message an admin config parameter.
**/
 ?>
[?php if ($sf_request->hasErrors()): ?]
<div class="form-errors">
<h2>[?php echo __('Please correct the errors indicated below...') ?]</h2>
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

[?php echo form_tag('<?php echo $this->getModuleName() ?>/edit', 'id=sf_admin_edit_form name=sf_admin_edit_form multipart=true onsubmit=double_list_submit(); return true;') ?]

<?php foreach ($this->getPrimaryKey() as $pk): ?>
[?php echo object_input_hidden_tag($<?php echo $this->getSingularName() ?>, 'get<?php echo $pk->getPhpName() ?>') ?]
<?php endforeach; ?>

<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
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
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($category_name)) ?>"<?php if ($collapse): ?> class="collapse"<?php endif; ?>>
<?php if ($category != 'NONE'): ?><h2>[?php echo __('<?php echo $category_name ?>') ?]</h2>

<?php endif; ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
<?php $credentials = $this->getParameterValue('edit.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
<?php if ($this->getParameterValue('edit.fields.'.$column->getName().'.type') == 'input_hidden_tag'): ?>
  [?php echo <?php echo $this->getColumnEditTag($column) ?> ?]
<?php else: ?>
<div id="form_row_<?php echo $this->getSingularName() ?>_<?php echo $column->getName() ?>" class="form-row">
  [?php echo label_for('<?php echo $this->getParameterValue("edit.fields.".$column->getName().".label_for", $this->getSingularName()."[".$column->getName()."]") ?>', __('<?php $label_name = str_replace("'", "\\'", $this->getParameterValue('edit.fields.'.$column->getName().'.name')); echo $label_name ?><?php if ($label_name): ?>:<?php endif ?>'), '<?php if ($column->isNotNull()): ?>class="required" <?php endif; ?>') ?]
  <div id="form_row_content_<?php echo $this->getSingularName() ?>_<?php echo $column->getName() ?>" class="content[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?] form-error[?php endif; ?]">
  [?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?]
    [?php echo form_error('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}', array('class' => 'form-error-msg')) ?]
  [?php endif; ?]

  [?php $value = <?php echo $this->getColumnEditTag($column); ?>; echo $value ? $value : '&nbsp;' ?]
  </div>
<?php if ($this->getParameterValue('edit.helptype') == 'div'): echo $this->getHelp($column, 'edit'); elseif ($this->getParameterValue('edit.helptype') == 'icon'): echo $this->getHelpAsIcon($column, 'edit'); endif; ?>
</div>
<?php endif; ?>
<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>

<?php endforeach; ?>
</fieldset>
<?php endforeach; ?>

[?php include_partial('edit_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]

</form>

<ul class="sf_admin_actions">
<?php
/*
 * WARNING: delete is a form, it must be outside the main form
 */
 $editActions = $this->getParameterValue('edit.actions');
?>
  <?php if (!$editActions || isset($editActions['_delete'])): ?>
    <?php echo $this->addCredentialCondition($this->getButtonToAction('_delete', $editActions['_delete'], true), $editActions['_delete']) ?>
  <?php endif; ?>
</ul>

</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>
</div>