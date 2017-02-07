<?php use_helper('I18N', 'Date') ?>
<div id="sf_admin_container" class="sf_admin_list">
<div id="sf_admin_header">
<h1><?php echo __s('Search results for ', array()) . "<em>'" . $sf_params->get('concept_term') . "'</em>" ?></h1>
</div>

<div id="sf_admin_content">

<?php if(!$pager->getNbResults()): ?>
<?php echo __s('no result') ?>
<?php else: ?>
<table cellspacing="0" class="sf_admin_list" width="100%">
<thead>
<tr>
  <th id="sf_admin_list_th_vocabulary">
		<?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'vocabulary_name'): ?>
		<?php echo sf_link_to(__s('Vocabulary'), 'conceptprop/search?sort=vocabulary_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc') . '&concept_term=' . $sf_params->get('concept_term')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'absmiddle', 'alt' => __s('Ascending Order'), 'title' => __s('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'absmiddle', 'alt' => __s('Descending Order'), 'title' => __s('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

		<?php echo sf_link_to(__s('Vocabulary'), 'conceptprop/search?sort=vocabulary_name&type=asc&concept_term=' . $sf_params->get('concept_term')) ?>
		<?php endif; ?>
  </th>
  <th id="sf_admin_list_th_concept_pref_label">
			 <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'concept_pref_label'): ?>
		<?php echo sf_link_to(__s('Concept'), 'conceptprop/search?sort=concept_pref_label&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc') . '&concept_term=' . $sf_params->get('concept_term')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'absmiddle', 'alt' => __s('Ascending Order'), 'title' => __s('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'absmiddle', 'alt' => __s('Descending Order'), 'title' => __s('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

		<?php echo sf_link_to(__s('Concept'), 'conceptprop/search?sort=concept_pref_label&type=asc&concept_term=' . $sf_params->get('concept_term')) ?>
		<?php endif; ?>
  </th>
  <th id="sf_admin_list_th_object">
			 <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'object'): ?>
		<?php echo sf_link_to(__s('Label'), 'conceptprop/search?sort=object&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc') . '&concept_term=' . $sf_params->get('concept_term')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'absmiddle', 'alt' => __s('Ascending Order'), 'title' => __s('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'absmiddle', 'alt' => __s('Descending Order'), 'title' => __s('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

		<?php echo sf_link_to(__s('Label'), 'conceptprop/search?sort=object&type=asc&concept_term=' . $sf_params->get('concept_term')) ?>
		<?php endif; ?>
  </th>
  <th id="sf_admin_list_th_skos_property_name">
			 <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/concept_search/sort') == 'skos_property_name'): ?>
		<?php echo sf_link_to(__s('SKOS property'), 'conceptprop/search?sort=skos_property_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/concept_search/sort') == 'asc' ? 'desc' : 'asc') . '&concept_term=' . $sf_params->get('concept_term')) ?>

   <?php if ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'asc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_asc.png', array('align' => 'absmiddle', 'alt' => __s('Ascending Order'), 'title' => __s('List has been sorted in ascending order'))) ?>
      <?php elseif ($sf_user->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'desc'): ?>
      <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/s_desc.png', array('align' => 'absmiddle', 'alt' => __s('Descending Order'), 'title' => __s('List has been sorted in descending order'))) ?>
      <?php endif; ?>
      <?php else: ?>

		<?php echo sf_link_to(__s('SKOS property'), 'conceptprop/search?sort=skos_property_name&type=asc&concept_term=' . $sf_params->get('concept_term')) ?>
		<?php endif; ?>
		</th>
  <th id="sf_admin_list_th_language">
		  <?php echo __s('Language') ?>
			 </th>
<?php if ($sf_user->hasCredential(array (   0 => 'administrator', ))): ?>
  <th id="sf_admin_list_th_sf_actions"><?php echo __s('Actions') ?></th>
<?php endif; ?>
</tr>
</thead>
<tfoot>
<tr><th colspan="5">
<div class="float-right">
<?php if ($pager->haveToPaginate()): ?>
  <?php echo sf_link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/first.png', 'align=absmiddle'), 'conceptprop/search?page=1&concept_term=' . $sf_params->get('concept_term')) ?>
  <?php echo sf_link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/previous.png', 'align=absmiddle'), 'conceptprop/search?page='.$pager->getPreviousPage() . '&concept_term=' . $sf_params->get('concept_term')) ?>

  <?php foreach ($pager->getLinks() as $page): ?>
   <?php echo link_to_unless($page == $pager->getPage(), $page, 'conceptprop/search?page='.$page . '&concept_term=' . $sf_params->get('concept_term')) ?>
  <?php endforeach; ?>

  <?php echo sf_link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/next.png', 'align=absmiddle'), 'conceptprop/search?page='.$pager->getNextPage() . '&concept_term=' . $sf_params->get('concept_term')) ?>
    <?php echo sf_link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/last.png', 'aligConceptPropertyle'), 'conceptprop/search?page='.$pager->getLastPage() . '&concept_term=' . $sf_params->get('concept_term')) ?>
<?php endif; ?>
</div>
<?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
</th></tr>
</tfoot>
<tbody>
<?php $i = 1;
/** @var \ConceptProperty $concept_property */
foreach ($pager->getResults() as $concept_property): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
		<td><?php echo sf_link_to(htmlspecialchars(html_entity_decode($concept_property->getVocabularyName(), ENT_QUOTES | ENT_HTML5, 'UTF-8')), '/vocabulary/show?id=' . $concept_property->getVocabularyId()) ?></td>
		<td><?php echo sf_link_to(htmlspecialchars(html_entity_decode($concept_property->getConceptPrefLabel(), ENT_QUOTES | ENT_HTML5, 'UTF-8')), '/concept/show?id=' . $concept_property->getConceptId()) ?></td>
		<td><?php echo sf_link_to(htmlspecialchars(html_entity_decode($concept_property->getObject(), ENT_QUOTES | ENT_HTML5, 'UTF-8')), '/conceptprop/show?id=' . $concept_property->getId()) ?></td>
		<td><?php echo $concept_property->getSkosPropertyName() ?></td>
		<td><?php echo $concept_property->getLanguage() ?></td>
<?php if ($sf_user->hasCredential(array (   0 => 'administrator', ))): ?>
<td>
<ul class="sf_admin_td_actions">
<li><?php echo sf_link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/edit_icon.png', array('alt' => __s('edit'), 'title' => __s('edit'))), 'concept/edit?id='.$concept_property->getConceptId()) ?></li>
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
<?php include_partial('conceptprop/list_footer') ?>
</div>
</div>
