<?php use_helper('Global') ?>
<?php echo include_partial('sidebar/administration') ?>
<?php if ($sf_user->isAuthenticated()): ?>
<div id="panel_default">
  <h2><?php echo __('Register New...') ?></h2>
  <ul>
    <li><?php echo link_to(__('Resource Owner'), 'agent/create') ?></li>
  <?php if ($sf_user->getAttribute('agentCount','0','subscriber')): ?>
    <li><?php echo link_to(__('Vocabulary'), 'vocabulary/create') ?></li>
  <?php endif ?>
  </ul>
</div>
<?php endif ?>