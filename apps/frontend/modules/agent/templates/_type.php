<?php echo radiobutton_tag("agent[type]", "Individual", $agent->getType() == 'Individual'); ?>&nbsp;Individual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo radiobutton_tag("agent[type]", "Organization", $agent->getType() == 'Organization'); ?>&nbsp;Organization

