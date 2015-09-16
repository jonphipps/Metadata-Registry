<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
[?php include_partial('list_th_<?php echo $this->getParameterValue('list.layout', 'tabular') ?>') ?]
<?php if ($this->getParameterValue('list.object_actions')): ?>
  <th id="sf_admin_list_th_sf_actions">[?php echo __('Actions') ?]</th>
<?php endif; ?>
</tr>
</thead>
<tfoot>
<tr><th colspan="<?php echo $this->getParameterValue('list.object_actions') ? count($this->getColumns('list.display')) + 1 : count($this->getColumns('list.display')) ?>">
<div class="float-right">
[?php if ($pager->haveToPaginate()): ?]
  [?php $filterParam = ''; ?]
<?php $urlFilters = $this->getParameterValue('list.urlfilters') ?>
<?php if ($urlFilters): ?>
<?php foreach ($urlFilters as $field => $param): ?>
[?php if ($sf_params->has('filters[<?php echo $param ?>]')): ?]
    [?php $filterParam .= '&filters[<?php echo $param ?>]=' . $sf_params->get('filters[<?php echo $param ?>]'); ?]
[?php endif; ?]
<?php endforeach; ?>
<?php endif; ?>
  [?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/first.png', array('align' => 'absmiddle', 'alt' => __('First'), 'title' => __('First'))), '<?php echo $this->getModuleName() ?>/list?page=1' . $filterParam) ?]
  [?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/previous.png', array('align' => 'absmiddle', 'alt' => __('Previous'), 'title' => __('Previous'))), '<?php echo $this->getModuleName() ?>/list?page='.$pager->getPreviousPage() . $filterParam) ?]

  [?php foreach ($pager->getLinks() as $page): ?]
    [?php echo link_to_unless($page == $pager->getPage(), $page, '<?php echo $this->getModuleName() ?>/list?page='.$page . $filterParam) ?]
  [?php endforeach; ?]

  [?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/next.png', array('align' => 'absmiddle', 'alt' => __('Next'), 'title' => __('Next'))), '<?php echo $this->getModuleName() ?>/list?page='.$pager->getNextPage() . $filterParam) ?]
  [?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/last.png', array('align' => 'absmiddle', 'alt' => __('Last'), 'title' => __('Last'))), '<?php echo $this->getModuleName() ?>/list?page='.$pager->getLastPage() . $filterParam) ?]
[?php endif; ?]
</div>
[?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?]
</th></tr>
</tfoot>
<tbody>
[?php $i = 1; foreach ($pager->getResults() as $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ?]
<tr class="sf_admin_row_[?php echo $odd ?]">
[?php include_partial('list_td_<?php echo $this->getParameterValue('list.layout', 'tabular') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
[?php include_partial('list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</tr>
[?php endforeach; ?]
</tbody>
</table>
