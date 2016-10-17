[?php
  /** @var sfContext $sf_context */
  /** @var sfParameterHolder $sf_flash */
  /** @var sfParameterHolder $sf_params */
  /** @var myWebRequest $sf_request */
  /** @var myUser $sf_user */
  /** @var sfPartialView $sf_view */
  /** @var <?php /** @var sfPropelAdminGenerator $this */
echo $this->getClassName() ?>  $<?php echo $this->getSingularName() ?> */
  ?]
<ul class="sf_admin_actions">
<?php
$editActions = $this->getParameterValue('edit.actions');
$parents = $this->getParameterValue('parents');

if (false !== $editActions)
  {
    if (null !== $editActions)
    {
      $hasStringKeys = $this->has_string_keys($editActions);
      foreach ((array) $editActions as $actionName => $params)
      {
        if ( ! $hasStringKeys) {
          $actionName = array_keys($editActions[$actionName])[0];
          $params     = $params[$actionName];
        }
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
        if ($parents && in_array($actionName, [ '_list', '_cancel', '_delete' ]) ):
          $masterRoute = isset( $params['route'] ) ? $params['route'] : null;
          $masteQueryString = isset( $params['query_string'] ) ? $params['query_string'] : null;
          foreach ($parents as $module => $param):
            //note that this will replace any route and query string set for show
          $params['route']        = $masterRoute ? $masterRoute : $module . '_' . $this->getModuleName() . $actionName;
          $params['query_string'] = $masteQueryString ? $masteQueryString: [ $param['requestid'] => $param['getid'] ];
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
