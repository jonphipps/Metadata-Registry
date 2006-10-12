<?php echo form_tag('@concept_search', 'method=get') ?>
  <?php echo input_tag('term', htmlspecialchars($searchTerm), array('class' => 'searchterm')) ?>&nbsp;<?php echo submit_tag('Search', 'class=small') ?>
</form>