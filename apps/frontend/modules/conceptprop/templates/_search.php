<?php echo form_tag('@concept_search', 'method=GET') ?>
  <?php echo input_tag('term', htmlspecialchars($searchTerm), array('style' => 'width: 150px')) ?>&nbsp;<?php echo submit_tag('Search', 'class=small') ?>
</form>