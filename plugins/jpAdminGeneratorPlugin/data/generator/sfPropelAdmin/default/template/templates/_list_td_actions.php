[?php /** @var myWebRequest $sf_request */ ?]
<?php /** @var sfPropelAdminGenerator $this */
if ($this->getParameterValue('list.object_actions')): ?>
<td>
<ul class="sf_admin_td_actions">
<?php $parents                = $this->getParameterValue('parents');
foreach ($this->getParameterValue('list.object_actions') as $actionName => $params):
  $condition = isset( $params['condition']) ? $params['condition'] : false ?>
  <?php if ($condition): ?>
  [?php if (<?php echo $condition ?>): ?]
  <?php endif;
  //if the actioname is in the list and we have parents
  //set a condition for each filter
  if ($parents && in_array($actionName, [ '_show', '_edit', '_delete' ])):
    //foreach ($parents as $index => $parent):
    foreach ($parents as $module => $param):
      //note that this will replace any route and query string set for show
      $params['route'] = $module . '_' . $this->getModuleName() . $actionName;
      $params['query_string'] = [$param['requestid'] => $param['getid']];      ?>
      [?php if ($sf_request->getParameter('<?php echo $param['requestid'] ?>')): ?]
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
