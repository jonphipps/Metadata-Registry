<?php echo form_tag('@concept_search', 'method=get') ?>
  <?php echo input_tag('concept_term', htmlspecialchars($searchTerm), array('class' => 'searchterm')) ?><?php echo submit_tag('Search Vocabularies', 'class=small') ?>
<?php echo "</form>" ?>
