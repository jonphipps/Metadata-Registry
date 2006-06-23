<?php echo form_tag('@concept_search') ?>
  <?php echo input_tag('search', htmlspecialchars($sf_params->get('search')), array('style' => 'width: 150px')) ?>&nbsp;<?php echo submit_tag('Search', 'class=small') ?>
</form>