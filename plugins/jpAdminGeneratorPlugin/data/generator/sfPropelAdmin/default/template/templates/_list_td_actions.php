<?php if ($this->getParameterValue('list.object_actions')): ?>
<td>
<ul class="sf_admin_td_actions">
<?php foreach ($this->getParameterValue('list.object_actions') as $actionName => $params): ?>
  <li><?php echo $this->addCredentialCondition($this->getLinkToAction($actionName, $params, true), $params) ?></li>
<?php endforeach; ?>
</ul>
</td>
<?php endif; ?>
