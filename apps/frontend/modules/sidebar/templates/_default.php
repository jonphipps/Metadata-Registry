<?php use_helper('Global') ?>
<div id="panel_default">
<div class="subcontent-unit-border-orange">
  <div class="round-border-topleft"></div>
  <div class="round-border-topright"></div>
  <h1 class="orange"><?php echo __('Browse...') ?></h1>
  <ul>
    <li><?php echo link_to(__('Resource Owners'), 'agent/list') ?></li>
    <li><?php echo link_to(__('Vocabularies'), 'vocabulary/list') ?></li>
  </ul>
</div>

<!--
<?php if ($sf_user->isAuthenticated()): ?>
<div class="subcontent-unit-border-orange">
  <div class="round-border-topleft"></div>
  <div class="round-border-topright"></div>
  <h1 class="orange"><?php echo __('Register New...') ?></h1>
  <ul>
    <li><?php echo link_to(__('Resource Owner'), 'agent/create') ?></li>
  <?php if ($sf_user->getAttribute('agentCount','0','subscriber')): ?>
    <li><?php echo link_to(__('Vocabulary'), 'vocabulary/create') ?></li>
  <?php endif ?>
  </ul>
</div>
<?php endif ?>
</div>
-->
<?php if ($sf_user->hasCredential(array (0 => 'administrator' ))): ?>
<?php echo include_partial('sidebar/administration') ?>
<?php endif ?>