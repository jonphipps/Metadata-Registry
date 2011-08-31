<?php use_helper('I18N', 'Date') ?>
<div id="sf_admin_container" class="sf_admin_list">
<div id="sf_admin_header">
<h1><?php echo __('Search results for ', array()) . "<em>'" . $sf_params->get('sq') . "'</em>" ?></h1>
</div>

<div id="sf_admin_content">

<?php if(!$pager->getNbResults()): ?>
<?php echo __('no result') ?>
<?php else: ?>
<table cellspacing="0" class="sf_admin_list" width="100%">
<thead>
<tr>
  <th id="sf_admin_list_th_schema_name">
		<?php if ($sf_user->getAttribute('sort', null, 'sf_admin/schema_search/sort') == 'schema_name'): ?>
		<?php echo link_to(__('Schema'), 'schemaprop/search?sort=schema_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/schema_search/sort') == 'asc' ? 'desc' : 'asc') . '&sq=' . $sf_params->get('sq')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'middle', 'alt' => __('Ascending Order'), 'title' => __('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'middle', 'alt' => __('Descending Order'), 'title' => __('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

		<?php echo link_to(__('Schema'), 'schemaprop/search?sort=schema_name&type=asc&sq=' . $sf_params->get('sq')) ?>
		<?php endif; ?>
  </th>


  <th id="sf_admin_list_th_schema_prop_label">
			 <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/schema_search/sort') == 'schema_prop_label'): ?>
		<?php echo link_to(__('Property'), 'schemaprop/search?sort=schema_prop_label&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/schema_search/sort') == 'asc' ? 'desc' : 'asc') . '&sq=' . $sf_params->get('sq')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'middle', 'alt' => __('Ascending Order'), 'title' => __('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'middle', 'alt' => __('Descending Order'), 'title' => __('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

		<?php echo link_to(__('Property'), 'schemaprop/search?sort=schema_prop_label&type=asc&sq=' . $sf_params->get('sq')) ?>
		<?php endif; ?>
  </th>


  <th id="sf_admin_list_th_type">
       <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/schema_search/sort') == 'type'): ?>
    <?php echo link_to(__('Type'), 'schemaprop/search?sort=type&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/schema_search/sort') == 'asc' ? 'desc' : 'asc') . '&sq=' . $sf_params->get('sq')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'middle', 'alt' => __('Ascending Order'), 'title' => __('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'middle', 'alt' => __('Descending Order'), 'title' => __('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

    <?php echo link_to(__('Type'), 'schemaprop/search?sort=type&type=asc&sq=' . $sf_params->get('sq')) ?>
    <?php endif; ?>
  </th>


  <th id="sf_admin_list_th_language">
       <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/schema_search/sort') == 'language'): ?>
    <?php echo link_to(__('Language'), 'schemaprop/search?sort=language&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/schema_search/sort') == 'asc' ? 'desc' : 'asc') . '&sq=' . $sf_params->get('sq')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'middle', 'alt' => __('Ascending Order'), 'title' => __('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'middle', 'alt' => __('Descending Order'), 'title' => __('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

    <?php echo link_to(__('Language'), 'schemaprop/search?sort=language&type=asc&sq=' . $sf_params->get('sq')) ?>
    <?php endif; ?>
  </th>

<?php if ($sf_user->hasCredential(array (   0 => 'administrator', ))): ?>
  <th id="sf_admin_list_th_sf_actions"><?php echo __('Actions') ?></th>
<?php endif; ?>
</tr>
</thead>

<tfoot>
<tr><th colspan="5">
<div class="float-right">
<?php if ($pager->haveToPaginate()): ?>
  <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/first.png', 'align=middle'), 'schemaprop/search?page=1&sq=' . $sf_params->get('sq')) ?>
  <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/previous.png', 'align=middle'), 'schemaprop/search?page='.$pager->getPreviousPage() . '&sq=' . $sf_params->get('sq')) ?>

  <?php foreach ($pager->getLinks() as $page): ?>
   <?php echo link_to_unless($page == $pager->getPage(), $page, 'schemaprop/search?page='.$page . '&sq=' . $sf_params->get('sq')) ?>
  <?php endforeach; ?>

  <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/next.png', 'align=middle'), 'schemaprop/search?page='.$pager->getNextPage() . '&sq=' . $sf_params->get('sq')) ?>
  <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/last.png', 'align=middle'), 'schemaprop/search?page='.$pager->getLastPage() . '&sq=' . $sf_params->get('sq')) ?>
<?php endif; ?>
</div>
<?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
</th></tr>
</tfoot>

<tbody>
<?php $i = 1; foreach ($pager->getResults() as $property): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
		<td><?php echo link_to($property->getSchema()->getName(), '/schema/show?id=' . $property->getschemaId()) ?></td>
		<td><?php echo link_to($property->getLabel(), '/schemaprop/show?id=' . $property->getId()) ?></td>
    <td><?php if ($property->getIsSubpropertyOf())
              {
                echo link_to($property->getType(), $property->getParentUri());
              }
              else
              {
                echo $property->getType();
              } ?></td>
		<td><?php echo $property->getLanguage() ?></td>
<?php if ($sf_user->hasCredential(array (   0 => 'administrator', ))): ?>
<td>
<ul class="sf_admin_td_actions">
<li><?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), 'schemaprop/edit?id='.$property->getId()) ?></li>
</ul>
</td>
<?php endif; ?></tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>

<?php echo include_partial('list_actions') ?>

</div>

<div id="sf_admin_footer">
<?php include_partial('schemaprop/list_footer') ?>
</div>
</div>