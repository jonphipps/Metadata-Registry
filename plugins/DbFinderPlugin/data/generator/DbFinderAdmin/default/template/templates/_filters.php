[?php use_helper('Object') ?]

<?php if ($this->getParameterValue('list.filters')): ?>
<div class="sf_admin_filters">
[?php echo form_tag('<?php echo $this->getModuleName() ?>/list', array('method' => 'get')) ?]

  <fieldset>
    <h2>[?php echo __s('filters') ?]</h2>
<?php foreach ($this->getColumns('list.filters') as $column): $type = $this->DbFinderAdminGenerator->getColumnType($column); ?>
<?php $credentials = $this->getParameterValue('list.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
    <div class="form-row">
    <label for="filters_<?php echo $column->getName() ?>">[?php echo __s('<?php echo str_replace("'", "\\'", $this->getParameterValue('list.fields.'.$column->getName().'.name')) ?>:') ?]</label>
    <div class="content">
    [?php echo <?php echo $this->getColumnFilterTag($column) ?> ?]
<?php if ($this->getParameterValue('list.fields.'.$column->getName().'.filter_is_empty')): ?>
    <div>[?php echo checkbox_tag('filters[<?php echo $column->getName() ?>_is_empty]', 1, isset($filters['<?php echo $column->getName() ?>_is_empty']) ? $filters['<?php echo $column->getName() ?>_is_empty'] : null) ?]&nbsp;<label for="filters_<?php echo $column->getName() ?>_is_empty">[?php echo __s('is empty') ?]</label></div>
<?php endif; ?>
    </div>
    </div>
<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>

    <?php endforeach; ?>
  </fieldset>

  <ul class="sf_admin_actions">
    <li>[?php echo button_to(__s('reset'), '<?php echo $this->getModuleName() ?>/list?filter=filter', 'class=sf_admin_action_reset_filter') ?]</li>
    <li>[?php echo submit_tag(__s('filter'), 'name=filter class=sf_admin_action_filter') ?]</li>
  </ul>

</form>
</div>
<?php endif; ?>
