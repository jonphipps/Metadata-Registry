[?php /** @var myWebRequest $sf_request */
(strlen($sf_request->getParameter('id'))) ? $mode = 'edit' : $mode = 'create' ?]
[?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?]
[?php use_javascript(sfConfig::get('sf_prototype_web_dir').'/prototype.min.js', 'first') ?]
[?php use_javascript(sfConfig::get('sf_admin_web_dir').'/js/setfocus', 'last') ?]

<div id="sf_admin_container">

<div id="sf_admin_header">
    [?php include_component_slot('tabnav', ['breadcrumbs' => $breadcrumbs]) ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/edit_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'mode' => $mode)) ?]
</div>

<div id="sf_admin_content">
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_messages', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels, 'mode' => $mode)) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels, 'mode' => $mode)) ?]
</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'mode' => $mode)) ?]
</div>

</div>
