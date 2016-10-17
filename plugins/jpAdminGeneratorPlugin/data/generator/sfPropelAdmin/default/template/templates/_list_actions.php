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
$listActions  = $this->getParameterValue('list.actions');
$urlFilters = $this->getParameterValue('list.urlfilters');
$parents = $this->getParameterValue('parents');
if (false !== $listActions)
  {
    if (null !== $listActions)
    {
      $hasStringKeys = $this->has_string_keys($listActions);
      foreach ((array) $listActions as $actionName => $params)
      {
        if (!$hasStringKeys){
          $actionName = array_keys($listActions[$actionName])[0];
          $params = $params[$actionName];
        }
        $condition = isset( $params['condition'] ) ? $params['condition'] : false;
        if ( $condition ): ?>
          [?php if (<?php echo $condition ?>): ?]
        <?php endif;
        if ($parents):
          $masterRoute      = isset( $params['route'] ) ? $params['route'] : null;
          $masteQueryString = isset( $params['query_string'] ) ? $params['query_string'] : null;
          foreach ($parents as $module => $param):
            $params['route'] = $masterRoute ? $masterRoute : $module . '_' . $this->getModuleName() . $actionName;
            $params['query_string'] = $masteQueryString ? $masteQueryString : [ 'sf_request' => $param['getid'] ]; ?>
            [?php if ($sf_request->getParameter('<?php echo $param['requestid'] ?>')): ?]
              <?php echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, false), $params, true, false) ?>
            [?php endif; ?]
          <?php endforeach;
        else:
        echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, false), $params, true, false);
        endif;
        if ($condition): ?>
          [?php endif; ?]
        <?php endif;
      }
    }
    else
    {
    echo $this->getButtonToAction('_create', array(), false);
    }
  }
?>
</ul>
