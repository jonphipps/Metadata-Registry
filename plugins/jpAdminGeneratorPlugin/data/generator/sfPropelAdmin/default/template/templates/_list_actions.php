<ul class="sf_admin_actions">
<?php
  $listActions = $this->getParameterValue('list.actions');
  if (null !== $listActions)
  {
    foreach ((array) $listActions as $actionName => $params)
    {
  echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, false), $params, false, false);
    }
  }
  else
  {
  echo $this->getButtonToAction('_create', array(), false);
  }
?>
</ul>