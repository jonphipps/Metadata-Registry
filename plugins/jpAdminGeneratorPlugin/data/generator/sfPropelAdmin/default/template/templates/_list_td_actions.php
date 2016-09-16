<?php /** @var sfPropelAdminGenerator $this */
if ($this->getParameterValue('list.object_actions')): ?>
<td>
<ul class="sf_admin_td_actions">
<?php $urlFilters = $this->getParameterValue('list.urlfilters');
foreach ($this->getParameterValue('list.object_actions') as $actionName => $params):
  $condition = isset( $params['condition']) ? $params['condition'] : false ?>
  <?php if ($condition): ?>
  [?php if (<?php echo $condition ?>): ?]
  <?php endif;
  //if the actioname is show and we have urlfilters
  //set a condition for each filter
  if ($urlFilters && in_array($actionName, [ '_show', '_edit' ])):
    foreach ($urlFilters as $index => $urlFilter):
      //note that this will replace any route and query string set for show
      $params['route'] = str_replace('_id', '', $urlFilter) . '_' . $this->getModuleName() . $actionName;
      $params['query_string'] = ['sf_request' => $urlFilter];      ?>
      [?php if ($sf_request->getParameter('<?php echo $urlFilter ?>')): ?]
        <li><?php echo $this->addCredentialCondition($this->getLinkToAction($actionName, $params, true), $params, true, true, "list") ?></li>
      [?php endif; ?]
    <?php endforeach;?>
  <?php else: ?>
    <li><?php echo $this->addCredentialCondition($this->getLinkToAction($actionName, $params, true), $params, true, true, "list") ?></li>
  <?php endif; ?>
  <?php if ($condition): ?>
  [?php endif; ?]
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</td>
<?php endif; ?>
