<?php $type = $agent->getType() ? $agent->getType() : 'Individual' ?>
<?php echo radiobutton_tag("agent[type]", "Individual", $type == 'Individual'); ?>&nbsp;Individual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo radiobutton_tag("agent[type]", "Organization", $type == 'Organization'); ?>&nbsp;Organization
