<?php echo form_tag('@concept_search', 'method=get') ?>
  <td><?php echo input_tag('concept_term', htmlspecialchars($searchTerm), array('class' => 'searchterm')) ?></td><td align="left"><?php echo submit_tag('Search Vocabularies', 'class=small') ?></td>
</form>