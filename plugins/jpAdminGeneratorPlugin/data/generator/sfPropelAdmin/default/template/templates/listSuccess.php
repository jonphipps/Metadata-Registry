[?php
  /** @var sfContext $sf_context */
  /** @var sfParameterHolder $sf_flash */
  /** @var sfParameterHolder $sf_params */
  /** @var myWebRequest $sf_request */
  /** @var myUser $sf_user */
  /** @var sfPartialView $sf_view */
  /** @var <?php /** @var sfPropelAdminGenerator $this */
echo $this->getClassName() ?>  $<?php echo $this->getSingularName() ?> */
use_helper('I18N', 'Date', 'TruncateUri') ?]

<div id="sf_admin_container" class="sf_admin_list shadow">

<div id="sf_admin_header">
    [?php include_partial('<?php /** @var sfPropelAdminGenerator $this */
    echo $this->getModuleName() ?>/list_messages', array('pager' => $pager)) ?]
    [?php include_component_slot('tabnav', ['breadcrumbs' => $breadcrumbs]) ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
</div>

<div id="sf_admin_content">
[?php if (!$pager->getNbResults()): ?]
    <div class="no-results">
        <h2 class="message">[?php echo __s('There are no “%name%” at this time', array('%name%' =>
            '<?php echo sfInflector::humanize($this->getPluralName()) ?>')) ?]</h2>
    </div>
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
[?php if ($pager->getNbResults()) {
    include_partial('filters', [ 'filters' => $filters ]);
} ?]
<?php endif; ?>
</div>

</div>
