<ul class="sf_admin_actions">
<?php
/** @var sfPropelAdminGenerator $this */
$editActions = $this->getParameterValue('edit.actions');
$urlFilters  = $this->getParameterValue('list.urlfilters');

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
        //if the actioname is list or cancel and we have urlfilters
        //set a condition for each filter
        if ($urlFilters && in_array($actionName, [ '_list', '_cancel' ]) ):
          foreach ($urlFilters as $index => $urlFilter):
            //note that this will replace any route and query string set for show
            $params['route'] = str_replace('_id', '', $urlFilter) . '_' . $this->getModuleName() . $actionName;
            $params['query_string'] = ['sf_request' => $urlFilter];
echo "[?php if (\$sf_request->getParameter('". $urlFilter ."')): ?]\n" .
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
