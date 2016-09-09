<?php $type = $agent->getType() ? $agent->getType() : 'Individual' ?>
<?php echo radiobutton_tag("agent[type]", "Individual", $type == 'Individual'); ?>&nbsp;
<span style="margin: 0 3em 0 .5em;">Individual</span>
    <?php echo radiobutton_tag("agent[type]", "Organization", $type == 'Organization'); ?>
<span style="margin-left: .5em; ">Organization</span>

