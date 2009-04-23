[?php echo form_tag('<?php echo $this->getModuleName() ?>/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
<?php if (false !== strpos($this->getParameterValue('edit.fields.'.$column->getName().'.type'), 'admin_double_list')): ?>
  'onsubmit'  => 'double_list_submit(); return true;'
<?php break 2; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
)) ?]
<fieldset id="sf_datagrid_fieldset_none">
<?php foreach ($this->getPrimaryKey() as $pk): ?>
[?php echo object_input_hidden_tag($<?php echo $this->getSingularName() ?>, 'get<?php echo $pk->getPhpName() ?>') ?]
<?php endforeach; ?>

<?php $hides = $this->getParameterValue('edit.hide', array()) ?>
<?php
foreach($this->getColumnCategories('edit.layout') as $category):
?>
<div class="row-form">
	<?php foreach ($this->getColumns('edit.layout', $category) as $name => $column): ?>
	
		<?php if (in_array($column->getName(), $hides)) continue ?>
		<?php if ($column->isPrimaryKey()) continue ?>
		<?php $credentials = $this->getParameterValue('edit.fields.'.$column->getName().'.credentials') ?>
		<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
		    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
		<?php endif; ?>
		<div class="form-elem [?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?] form-error[?php endif; ?]">
		  [?php echo label_for('<?php echo $this->getParameterValue("edit.fields.".$column->getName().".label_for", $this->getSingularName()."[".$column->getName()."]") ?>', __($labels['<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}']), '<?php if ($column->isNotNull()): ?>class="required" <?php endif; ?>') ?]
		  [?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?]
		    [?php echo form_error('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}', array('class' => 'form-error-msg')) ?]
		  [?php endif; ?]
		
		  [?php $value = <?php echo $this->getColumnEditTag($column); ?>; echo $value ? $value : '&nbsp;' ?]
		  <?php echo $this->getHelp($column, 'edit') ?>
		</div>
		<?php if ($credentials): ?>
		    [?php endif; ?]
		<?php endif; ?>
	
	<?php endforeach; ?>
	</div>			
<?php
endforeach;
?>

[?php include_partial('edit_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</fieldset>
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
