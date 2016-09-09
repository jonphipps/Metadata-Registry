<?php echo form_tag('@schema_search', 'method=get') ?>
  <?php echo input_tag('sq', htmlspecialchars($searchTerm), array('class' => 'searchterm')) ?><?php echo submit_tag('Search Element Sets', 'class=small') ?>
<?php echo "</form>" ?>
