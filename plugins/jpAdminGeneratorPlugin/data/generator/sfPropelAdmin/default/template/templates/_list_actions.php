<ul class="sf_admin_actions">
<?php
  $listActions = $this->getParameterValue('list.actions');
  if (false !== $listActions)
  {
    if (null !== $listActions)
    {
      foreach ((array) $listActions as $actionName => $params)
      {
    echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, false), $params, true, false);
      }
    }
    else
    {
    echo $this->getButtonToAction('_create', array(), false);
    }
  }
?>
</ul>