<ul class="sf_admin_actions">
<?php
  $editActions = $this->getParameterValue('edit.actions');
  if (null !== $editActions)
  {
    foreach ((array) $editActions as $actionName => $params)
    {
      if ($actionName == '_delete') continue;
      $params['only_for'] = $this->getParameterValue('edit.actions.'.$actionName.'.mode');

      if ($actionName == '_cancel')
      {
        $params['only_for'] = 'edit';
        $params['action'] = 'show';
echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, true), $params, false, false);
        $params['only_for'] = 'create';
        $params['action'] = 'list';
      }
echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, false), $params, false, false);
    }
  }
  else
  {
echo $this->getButtonToAction('_list', array(), false);
echo $this->getButtonToAction('_save', array(), false);
echo $this->getButtonToAction('_save_and_add', array(), false);
  }
?>
</ul>
