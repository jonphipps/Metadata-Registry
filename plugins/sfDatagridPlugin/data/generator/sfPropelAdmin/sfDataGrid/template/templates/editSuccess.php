[?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?]

[?php use_stylesheet('<?php echo $this->getParameterValue('css', sfConfig::get('sf_admin_web_dir').'/css/main') ?>') ?]

<div id="sf_admin_container">

<?php if($this->getParameterValue('new.title')): ?>
[?php if($<?php echo $this->getSingularName() ?>->isNew()){ ?]
<h1><?php echo $this->getI18NString('new.title', 'edit '.$this->getModuleName()) ?></h1>
[?php }else{ ?]
<h1><?php echo $this->getI18NString('edit.title', 'edit '.$this->getModuleName()) ?></h1>
[?php } ?]
<?php else: ?>
<h1><?php echo $this->getI18NString('edit.title', 'edit '.$this->getModuleName()) ?></h1>
<?php endif; ?>
<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

<div id="sf_admin_content">
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_messages', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels)) ?]
<?php if($this->getParameterValue('edit.layout')){ ?>
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_form_layout', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels)) ?]
<?php }else{ ?>
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'labels' => $labels)) ?]
<?php } ?>
</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/edit_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</div>

</div>
