<?php use_helper('Global') ?>

<!-- This is the start of the menu -->
<div id="mainMenu">
	<a>Resources</a>
	<a>Agents</a>
<?php if ($sf_user->hasCredential(array (0 => 'administrator' ))): ?>
	<a>Members</a>
<?php endif ?>
</div>
<div id="submenu">
	<!-- The first sub menu -->
	<div id="submenu_1">
		<?php echo link_to(__('Vocabularies'), 'vocabulary/list') ?>
		<a href="#">Element Sets</a>
		<a href="#">Application Profiles</a>
	</div>
	<!-- Second sub menu -->
	<div id="submenu_2">
		<?php echo link_to(__('List'), 'agent/list') ?>
	</div>
<?php if ($sf_user->hasCredential(array (0 => 'administrator' ))): ?>
	<!-- Third sub menu -->
	<div id="submenu_3">
		<?php echo link_to(__('List'), 'user/list') ?>
	</div>
<?php endif ?>
</div>
