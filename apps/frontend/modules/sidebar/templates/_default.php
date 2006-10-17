<?php use_helper('Global') ?>
<?php echo include_partial('sidebar/administration') ?>
<div id="panel_default">
<?php if ($sf_user->isAuthenticated()): ?>
  <h2><?php echo __('Register New...') ?></h2>
  <ul>
    <li><?php echo link_to(__('Resource Owner'), 'agent/create') ?></li>
  <?php if ($sf_user->getAttribute('agentCount','0','subscriber')): ?>
    <li><?php echo link_to(__('Vocabulary'), 'vocabulary/create') ?></li>
  <?php endif ?>
  </ul>
<?php else: ?>
  <h2><?php echo __('Browse...') ?></h2>
  <ul>
    <li><?php echo link_to(__('Resource Owners'), 'agent/list') ?></li>
    <li><?php echo link_to(__('Vocabularies'), 'vocabulary/list') ?></li>
  </ul>
<?php endif ?>
</div>
