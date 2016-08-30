[?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'Text') ?]

<div id="sf_admin_container">
<div id="sf_admin_header">
    [?php include_component_slot('tabnav', ['<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>,
    'breadcrumbs' => $breadcrumbs]) ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/show_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

<div id="sf_admin_content">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_messages', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels)) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/show', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels)) ?]


</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>
</div>
