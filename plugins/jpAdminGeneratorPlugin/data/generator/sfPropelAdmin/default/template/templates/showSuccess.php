[?php
  /** @var sfContext $sf_context */
  /** @var sfParameterHolder $sf_flash */
  /** @var sfParameterHolder $sf_params */
  /** @var myWebRequest $sf_request */
  /** @var myUser $sf_user */
  /** @var sfPartialView $sf_view */
  /** @var <?php /** @var sfPropelAdminGenerator $this */
echo $this->getClassName() ?>  $<?php echo $this->getSingularName() ?> */
use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'Text') ?]

<div id="sf_admin_container">
<div id="sf_admin_header">
    [?php include_component_slot('tabnav', ['<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>,
    'breadcrumbs' => $breadcrumbs]) ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/show_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

<div id="sf_admin_content">
    <div class="show">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_messages', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels)) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/show', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels)) ?]
    </div>
</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/show_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>
</div>
