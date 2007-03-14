[?php echo form_tag('<?php echo $this->getModuleName() ?>/edit', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
<?php if ('admin_double_list' == $this->getParameterValue('edit.fields.'.$column->getName().'.type')): ?>
  'onsubmit'  => 'double_list_submit(); return true;'
<?php break 2; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
)) ?]

<?php $hides = $this->getParameterValue('edit.hide', array()) ?>
<?php if ($hides): ?>
<?php foreach ($this->getColumns('edit.hide') as $column): ?>
<?php if (!$column->isPrimaryKey()): ?>
<?php $colMode = $this->getParameterValue('edit.fields.'.$column->getName().'.mode') ?>
<?php if ($colMode): ?>
[?php if ('<?php echo $colMode ?>' == $mode): ?]
<?php endif; ?>
[?php echo object_input_hidden_tag($<?php echo $this->getSingularName() ?>, '<?php echo $this->getColumnGetter($column, false) ?>') ?]
<?php if ($colMode): ?>
[?php endif; ?]
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>

<?php foreach ($this->getPrimaryKey() as $pk): ?>
[?php echo object_input_hidden_tag($<?php echo $this->getSingularName() ?>, 'get<?php echo $pk->getPhpName() ?>') ?]
<?php endforeach; ?>

<?php $first = true ?>
<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php
  if ($category[0] == '-')
  {
    $category_name = substr($category, 1);
    $collapse = true;

    if ($first)
    {
      $first = false;
      echo "[?php use_javascript(sfConfig::get('sf_admin_web_dir').'/js/collapse', 'last') ?]\n";
    }
  }
  else
  {
    $category_name = $category;
    $collapse = false;
  }
?>
<?php $catCredentials = $this->getParameterValue('edit.display.'.$category.'.credentials') ?>
<?php if ($catCredentials): $catCredentials = str_replace("\n", ' ', var_export($catCredentials, true)) ?>
[?php if ($sf_user->hasCredential(<?php echo $catCredentials ?>)): ?]
<?php endif; ?>
<?php $catMode = $this->getParameterValue('edit.display.'.$category.'.mode') ?>
<?php if ($catMode): ?>
[?php if ('<?php echo $catMode ?>' == $mode): ?]
<?php endif; ?>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($category_name)) ?>" <?php if ($collapse): ?> class="collapse"<?php endif; ?>>
<?php if ($category != 'NONE'): ?>
  <h2>[?php echo __('<?php echo $category_name ?>') ?]</h2>
<?php endif; ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
<?php if (in_array($column->getName(), $hides)) continue ?>
<?php $credentials = $this->getParameterValue('edit.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
[?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
<?php $colMode = $this->getParameterValue('edit.fields.'.$column->getName().'.mode') ?>
<?php if ($colMode): ?>
[?php if ('<?php echo $colMode ?>' == $mode): ?]
<?php endif; ?>
<div id="form_row_<?php echo $this->getSingularName() ?>_<?php echo $column->getName() ?>" class="form-row">
    [?php echo label_for('<?php echo $this->getParameterValue("edit.fields.".$column->getName().".label_for", $this->getSingularName()."[".$column->getName()."]") ?>', __($labels['<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}']), '<?php if ($column->isNotNull()): ?>class="required" <?php endif; ?>') ?]

  <div id="form_row_content_<?php echo $this->getSingularName() ?>_<?php echo $column->getName() ?>" class="content[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?] form-error[?php endif; ?]">
[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?]
      [?php echo form_error('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}', array('class' => 'form-error-msg')) ?]
[?php endif; ?]
      [?php $value = <?php echo $this->getColumnEditTag($column); ?>; echo $value ? $value : '&nbsp;' ?]

      <?php echo $this->getHelp($column, 'edit') ?>

    </div>
  </div>
<?php if ($colMode): ?>
[?php endif; ?]
<?php endif; ?>
<?php if ($credentials): ?>
[?php endif; ?]
<?php endif; ?>
<?php endforeach; ?>
</fieldset>
<?php if ($catMode): ?>
[?php endif; ?]
<?php endif; ?>
<?php if ($catCredentials): ?>
[?php endif; ?]
<?php endif; ?>
<?php endforeach; ?>

[?php include_partial('edit_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'mode' => $mode)) ?]

</form>

<ul class="sf_admin_actions">
<?php
/*
 * WARNING: delete is a form, it must be outside the main form
 */
 $editActions = $this->getParameterValue('edit.actions');
?>
  <?php if (null === $editActions || (null !== $editActions && array_key_exists('_delete', $editActions))): ?>
    <?php echo $this->addCredentialCondition($this->getButtonToAction('_delete', $editActions['_delete'], true), $editActions['_delete']) ?>
  <?php endif; ?>
</ul>
