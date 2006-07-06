<?php use_helpers('I18N', 'Date') ?>

<div id="sf_admin_header">
<h1><?php echo __('Search results for ', array()) . "<em>'" . $sf_params->get('term') . "'</em>" ?></h1>
</div>

<div id="sf_admin_content">

<?php if(!$pager->getNbResults()): ?>
<?php echo __('no result') ?>
<?php else: ?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
  <th id="sf_admin_list_th_vocabulary">
		<?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'vocabulary_name'): ?>
		<?php echo link_to(__('Vocabulary'), 'conceptprop/search?sort=vocabulary_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc')) ?>
		(<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort')) ?>)
		<?php else: ?>
		<?php echo link_to(__('Vocabulary'), 'conceptprop/search?sort=vocabulary_name&type=asc') ?>
		<?php endif; ?>
  </th>
  <th id="sf_admin_list_th_concept_pref_label">
			 <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'concept_pref_label'): ?>
		<?php echo link_to(__('Concept'), 'conceptprop/search?sort=concept_pref_label&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc')) ?>
		(<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort')) ?>)
		<?php else: ?>
		<?php echo link_to(__('Concept'), 'conceptprop/search?sort=concept_pref_label&type=asc') ?>
		<?php endif; ?>
  </th>
  <th id="sf_admin_list_th_object">
			 <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'object'): ?>
		<?php echo link_to(__('Label'), 'conceptprop/search?sort=object&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc')) ?>
		(<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort')) ?>)
		<?php else: ?>
		<?php echo link_to(__('Label'), 'conceptprop/search?sort=object&type=asc') ?>
		<?php endif; ?>
  </th>
  <th id="sf_admin_list_th_skos_property_name">
			 <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'skos_property_name'): ?>
		<?php echo link_to(__('SKOS property'), 'conceptprop/search?sort=skos_property_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc')) ?>
		(<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort')) ?>)
		<?php else: ?>
		<?php echo link_to(__('SKOS property'), 'conceptprop/search?sort=skos_property_name&type=asc') ?>
		<?php endif; ?>
		</th>
  <th id="sf_admin_list_th_language">
		  <?php echo __('Language') ?>
			 </th>
  <th id="sf_admin_list_th_sf_actions"><?php echo __('Actions') ?></th>
</tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $concept_property): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
		<td><?php echo link_to($concept_property->getVocabularyName(), '/vocabulary/show?id=' . $concept_property->getVocabularyId()) ?></td>
		<td><?php echo link_to($concept_property->getConceptPrefLabel(), '/concept/show?id=' . $concept_property->getConceptId()) ?></td>
		<td><?php echo link_to($concept_property->getObject(), '/conceptprop/show?id=' . $concept_property->getId()) ?></td>
		<td><?php echo $concept_property->getSkosPropertyName() ?></td>
		<td><?php echo $concept_property->getLanguage() ?></td>
<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/sf/images/sf_admin/show_icon.png', array('alt' => __('show'), 'title' => __('show'))), 'concept/show?id='.$concept_property->getConceptId()) ?></li>
  <?php if ($sf_user->hasCredential(array (   0 => 'administrator', ))): ?>
<li><?php echo link_to(image_tag('/sf/images/sf_admin/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), 'concept/edit?id='.$concept_property->getConceptId()) ?></li>

<?php endif; ?></ul>
</td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="6">
<div class="float-right">
<?php if ($pager->haveToPaginate()): ?>
  <?php echo link_to(image_tag('/sf/images/sf_admin/first.png', 'align=absmiddle'), 'conceptprop/search?page=1') ?>
  <?php echo link_to(image_tag('/sf/images/sf_admin/previous.png', 'align=absmiddle'), 'conceptprop/search?page='.$pager->getPreviousPage()) ?>

  <?php foreach ($pager->getLinks() as $page): ?>
	 <?php echo link_to_unless($page == $pager->getPage(), $page, 'conceptprop/search?page='.$page) ?>
  <?php endforeach; ?>

  <?php echo link_to(image_tag('/sf/images/sf_admin/next.png', 'align=absmiddle'), 'conceptprop/search?page='.$pager->getNextPage()) ?>
  <?php echo link_to(image_tag('/sf/images/sf_admin/last.png', 'align=absmiddle'), 'conceptprop/search?page='.$pager->getLastPage()) ?>
<?php endif; ?>
</div>
<?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
</th></tr>
</tfoot>
</table>
<?php endif; ?>

<?php echo include_partial('list_actions') ?>

</div>

<div id="sf_admin_footer">
<?php include_partial('conceptprop/list_footer') ?>
</div>