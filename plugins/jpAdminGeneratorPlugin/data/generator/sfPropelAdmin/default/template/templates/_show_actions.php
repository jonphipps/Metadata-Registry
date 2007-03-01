<ul class="sf_admin_actions">
<?php $showActions = $this->getParameterValue('show.actions'); ?>
<?php if ($showActions): ?>
   <?php foreach ($showActions as $actionName => $params): ?>
     <?php if ($actionName == '_delete') continue ?>
     <?php echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, true), $params) ?>
   <?php endforeach; ?>
<?php else: ?>
  <?php echo $this->getButtonToAction('_list', array(), true) ?>
<?php endif; ?>
</ul>