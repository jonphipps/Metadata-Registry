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
if (false !== $listActions)
  {
    if (null !== $listActions)
    {
      foreach ((array) $listActions as $actionName => $params)
      {
        $condition = isset( $params['condition'] ) ? $params['condition'] : false;
        if ( $condition ): ?>
          [?php if (<?php echo $condition ?>): ?]
        <?php endif;
        echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, false), $params, true, false);
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
