[?php use_helper('I18N', 'Date') ?]

<div id="sf_admin_container" class="sf_admin_list">

<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/list_messages', array('pager' => $pager)) ?]
</div>

<div id="sf_admin_content">
[?php if (!$pager->getNbResults()): ?]
<br />[?php echo __('<?php echo $this->getParameterValue('pager.no_results', 'No results') ?>') ?]
[?php else: ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager)) ?]
[?php endif; ?]
[?php include_partial('list_actions') ?]
</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
</div>

<div id="sf_admin_bar">
<?php if ($this->getParameterValue('list.filters') && $this->getParameterValue('list.displayfilter', true)): ?>
[?php if ($pager->getNbResults()): ?]
[?php include_partial('filters', array('filters' => $filters)) ?]
[?php endif; ?]
<?php endif; ?>
</div>

</div>
