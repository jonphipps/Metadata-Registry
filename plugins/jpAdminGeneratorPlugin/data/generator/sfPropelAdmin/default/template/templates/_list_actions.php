<ul class="sf_admin_actions">
<?php debugbreak();
  $listActions = $this->getParameterValue('list.actions');
  if (false !== $listActions)
  {
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
  }
?>
</ul>