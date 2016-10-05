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
  /** @var sfPropelAdminGenerator $this */
$showActions = $this->getParameterValue('show.actions');
$parents     = $this->getParameterValue('parents');

  if (false !== $showActions)
  {
    if (null !== $showActions)
    {
      $hasStringKeys = $this->has_string_keys($showActions);
      foreach ((array)$showActions as $actionName => $params)
      {
        if ( ! $hasStringKeys) {
          $actionName = array_keys($showActions[$actionName])[0];
          $params     = $params[$actionName];
        }
        $condition = isset( $params['condition'] ) ? $params['condition'] : false;
        if ($condition): ?>
          [?php if (<?php echo $condition ?>): ?]
        <?php endif;
        $params['only_for'] = $this->getParameterValue('edit.actions.'.$actionName.'.mode');
        //if the actioname is list or cancel and we have urlfilters
        //set a condition for each filter
        if ($parents && in_array($actionName, [ '_list', '_cancel', '_delete', '_edit' ]) ):
          foreach ($parents as $module => $param):
            //note that this will replace any route and query string set for show
            $params['route'] = $module . '_' . $this->getModuleName() . $actionName;
            $params['query_string'] = [ $param['requestid'] => $param['getid'] ];    ?>
            [?php if ($sf_request->getParameter('<?php echo $param['requestid'] ?>')): ?]
            <?php if (in_array($actionName, [ '_delete', '_edit' ])) {
              $params['query_string']['id'] = 'id';
               echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, false, 'show'), $params, false, true, "show");
            } else {
              echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, true), $params, true, true, "show");
            } ?>
            [?php endif; ?]
          <?php endforeach;?>
        <?php else:
            echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, (strtolower($actionName) != '_create'), 'show'), $params, false, true, "show");
        endif;
        if ($condition): ?>
          [?php endif; ?]
        <?php endif;
      }
    }
    else
    {
    echo $this->getButtonToAction('_list', array(), false);
    }
  }
?>
</ul>
