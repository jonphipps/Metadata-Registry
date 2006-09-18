<?php foreach ($this->getColumns('list.display') as $column): ?>
<?php $credentials = $this->getParameterValue('list.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>
  <th id="sf_admin_list_th_<?php echo $column->getName() ?>">
    <?php if ($column->isReal()): ?>
      [?php if ($sf_user->getAttribute('sort', null, 'sf_admin/<?php echo $this->getSingularName() ?>/sort') == '<?php echo $column->getName() ?>'): ?]
      [?php echo link_to(__('<?php echo str_replace("'", "\\'", $this->getParameterValue('list.fields.'.$column->getName().'.name')) ?>'), '<?php echo $this->getModuleName() ?>/list?sort=<?php echo $column->getName() ?>&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/<?php echo $this->getSingularName() ?>/sort') == 'asc' ? 'desc' : 'asc')) ?]
      [?php if ($sf_user->getAttribute('type', null, 'sf_admin/<?php echo $this->getSingularName() ?>/sort') == 'asc'): ?]
      [?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/Sort_Arrow_asc.gif', array('align' => 'absmiddle', 'alt' => __('Ascending Order'), 'title' => __('List has been sorted in ascending order'))) ?]
      [?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/<?php echo $this->getSingularName() ?>/sort') == 'desc'): ?]
      [?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/Sort_Arrow_desc.gif', array('align' => 'absmiddle', 'alt' => __('Descending Order'), 'title' => __('List has been sorted in descending order'))) ?]
      [?php endif; ?]
      [?php else: ?]
      [?php echo link_to(__('<?php echo str_replace("'", "\\'", $this->getParameterValue('list.fields.'.$column->getName().'.name')) ?>'), '<?php echo $this->getModuleName() ?>/list?sort=<?php echo $column->getName() ?>&type=asc') ?]
      [?php endif; ?]
    <?php else: ?>
    [?php echo __('<?php echo str_replace("'", "\\'", $this->getParameterValue('list.fields.'.$column->getName().'.name')) ?>') ?]
    <?php endif; ?>
    <?php echo $this->getHelpAsIcon($column, 'list') ?>
  </th>
<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>
<?php endforeach; ?>
