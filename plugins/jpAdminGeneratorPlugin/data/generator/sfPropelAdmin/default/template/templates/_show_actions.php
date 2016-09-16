<ul class="sf_admin_actions">
<?php
  /** @var sfPropelAdminGenerator $this */
  $showActions  = $this->getParameterValue('show.actions');
  $urlFilters = $this->getParameterValue('list.urlfilters');
  if (false !== $showActions)
  {
    if (null !== $showActions)
    {
      foreach ($showActions as $actionName => $params)
      {
        $condition = isset( $params['condition'] ) ? $params['condition'] : false;
        if ($condition): ?>
          [?php if (<?php echo $condition ?>): ?]
        <?php endif;
        $params['only_for'] = $this->getParameterValue('edit.actions.'.$actionName.'.mode');
        //if the actioname is list or cancel and we have urlfilters
        //set a condition for each filter
        if ($urlFilters && in_array($actionName, [ '_list', '_cancel' ]) ):
          foreach ($urlFilters as $index => $urlFilter):
            //note that this will replace any route and query string set for show
            $params['route'] = str_replace('_id', '', $urlFilter) . '_' . $this->getModuleName() . $actionName;
            $params['query_string'] = ['sf_request' => $urlFilter];      ?>
            [?php if ($sf_request->getParameter('<?php echo $urlFilter ?>')): ?]
              <?php echo $this->addCredentialCondition($this->getLinkToAction($actionName, $params, true), $params, true, true, "show") ?>
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
