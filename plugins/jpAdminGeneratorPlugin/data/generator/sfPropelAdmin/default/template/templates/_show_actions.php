<ul class="sf_admin_actions">
<?php
  $showActions = $this->getParameterValue('show.actions');
  if (null !== $showActions)
  {
    foreach ($showActions as $actionName => $params)
    {
      if ($actionName == '_delete') continue;
      $params['only_for'] = $this->getParameterValue('edit.actions.'.$actionName.'.mode');
  echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, (strtolower($actionName) != '_create')), $params, false, true, "show");
    }
  }
  else
  {
  echo $this->getButtonToAction('_list', array(), false);
  }
?>
</ul>