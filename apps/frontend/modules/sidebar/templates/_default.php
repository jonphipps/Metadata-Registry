<?php use_helper('Global') ?>
<div id="panel_default">
<div class="subcontent-unit-border-orange">
  <div class="round-border-topleft"></div>
  <div class="round-border-topright"></div>
  <h1 class="orange"><?php echo __('Browse...') ?></h1>
  <ul>
    <li><?php echo link_to(__('Agents'), 'agent/list') ?>
<?php if ($sf_user->isAuthenticated())
{
  echo '&nbsp;&nbsp;' .  link_to(__('(Add)'), 'agent/create', array('title' => 'Register a new agent'));
}
?>
  </li>
  <li>
<?php echo link_to(__('Vocabularies'), 'vocabulary/list') ;
if ($sf_user->isAuthenticated() && $sf_user->getAttribute('agentCount','0','subscriber'))
{
  echo '&nbsp;&nbsp;' .  link_to(__('(Add)'), 'vocabulary/create', array('title' => 'Register a new vocabulary'));
} ?>
  </li>
  <li>
<?php echo link_to(__('Element Sets'), 'schema/list') ;
if ($sf_user->isAuthenticated() && $sf_user->getAttribute('agentCount','0','subscriber'))
{
  echo '&nbsp;&nbsp;' .  link_to(__('(Add)'), 'schema/create', array('title' => 'Register a new Element Set'));
} ?>
  </li>
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
-->
</div>
