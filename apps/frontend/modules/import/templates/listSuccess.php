<?php
// auto-generated by sfPropelAdmin
// date: 2015/04/19 20:23:51
?>
<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container" class="sf_admin_list">

<div id="sf_admin_header">
<?php include_component_slot('tabnav', [ 'breadcrumbs' => $breadcrumbs ]) ?>
<?php include_partial('import/list_header', array('pager' => $pager)) ?>
<?php include_partial('import/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<br /><?php echo __s('No results') ?>
<?php else: ?>
<?php include_partial('import/list', array('pager' => $pager)) ?>
<?php endif; ?>
<?php include_partial('list_actions', array ( 'schema' => $schema, )) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('import/list_footer', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_bar">
</div>

</div>