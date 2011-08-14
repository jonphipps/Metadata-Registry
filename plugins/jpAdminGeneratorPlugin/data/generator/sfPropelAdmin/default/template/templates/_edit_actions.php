<ul class="sf_admin_actions">
<?php
  $editActions = $this->getParameterValue('edit.actions');
  if (false !== $editActions)
  {
    if (null !== $editActions)
    {
      foreach ((array) $editActions as $actionName => $params)
      {
        $pkLink = false;
        if ($actionName == '_delete') continue;
        $params['only_for'] = $this->getParameterValue('edit.actions.'.$actionName.'.mode');

        if ($actionName == '_cancel')
        {
          $pkLink = true;
        }
  echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, $pkLink), $params, false, false);
      }
    }
    else
    {
  echo $this->getButtonToAction('_list', array(), false);
  echo $this->getButtonToAction('_save', array(), false);
  echo $this->getButtonToAction('_save_and_add', array(), false);
    }
  }
?>
</ul>
