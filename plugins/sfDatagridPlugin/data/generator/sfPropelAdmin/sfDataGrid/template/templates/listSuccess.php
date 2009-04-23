[?php use_helper('I18N', 'Date') ?]

[?php use_stylesheet('<?php echo $this->getParameterValue('css', sfConfig::get('sf_admin_web_dir').'/css/main') ?>') ?]
<div id="sf_admin_container">

<h1><?php echo $this->getI18NString('list.title', $this->getModuleName().' list') ?></h1>

<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/list_header') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/list_messages') ?]
</div>

<div id="sf_admin_bar">
<?php if ($this->getParameterValue('list.filters')): ?>
[?php //include_partial('filters', array('filters' => $filters)) ?]
<?php endif; ?>
</div>

<div id="sf_admin_content">
[?php echo sfDatagrid::render('<?php echo $this->getClassName() ?>Datagrid', '<?php echo $this->getModuleName() ?>/datagrid'); ?]
[?php include_partial('list_actions') ?]
</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/list_footer') ?]
</div>

</div>
