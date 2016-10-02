<ul class="sf_admin_actions">
[?php /** @var myWebRequest $sf_request */ ?]
<?php
/** @var sfPropelAdminGenerator $this */
$editActions = $this->getParameterValue('edit.actions');
$parents = $this->getParameterValue('parents');

if (false !== $editActions)
  {
    if (null !== $editActions)
    {
      foreach ((array) $editActions as $actionName => $params)
      {
        $condition = isset( $params['condition'] ) ? $params['condition'] : false;
        $pkLink = false;
        if ($actionName == '_delete') continue;
        $params['only_for'] = $this->getParameterValue('edit.actions.'.$actionName.'.mode');

        if ($actionName == '_cancel')
        {
          $pkLink = false;
        }
        if ($condition) {
echo '[?php if (' . $condition . "): ?]\n";
        }
        //if the actioname is list or cancel and we have parents
        if ($parents && in_array($actionName, [ '_list', '_cancel' ]) ):
          foreach ($parents as $module => $param):
            //note that this will replace any route and query string set for show
          $params['route']        = $module . '_' . $this->getModuleName() . $actionName;
          $params['query_string'] = [ $param['requestid'] => $param['getid'] ];
echo "[?php if (\$sf_request->getParameter('". $param['requestid'] ."')): ?]\n" .
  $this->addCredentialCondition($this->getButtonToAction($actionName, $params, $pkLink), $params, false, false) . "\n" .
"[?php endif; ?]\n";
          endforeach;
        else:
  echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, $pkLink), $params, false, false);
        endif;
        if ($condition) {
echo "[?php endif; ?]\n";
        }
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
