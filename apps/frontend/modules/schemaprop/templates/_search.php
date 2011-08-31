<?php echo form_tag('@schema_search', 'method=get') ?>
  <td><?php echo input_tag('sq', htmlspecialchars($searchTerm), array('class' => 'searchterm')) ?></td><td align="left"><?php echo submit_tag('Search Element Sets', 'class=small') ?></td>
</form>