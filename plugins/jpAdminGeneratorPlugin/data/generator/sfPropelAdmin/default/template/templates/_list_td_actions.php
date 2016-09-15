<?php if ($this->getParameterValue('list.object_actions')): ?>
<td>
<ul class="sf_admin_td_actions">
<?php foreach ($this->getParameterValue('list.object_actions') as $actionName => $params):
  $condition = isset( $params['condition']) ? $params['condition'] : false ?>
  <?php if ($condition): ?>
  [?php if (<?php echo $condition ?>): ?]
  <?php endif; ?>
  <li><?php echo $this->addCredentialCondition($this->getLinkToAction($actionName, $params, true), $params, true, true, "list") ?></li>
  <?php if ($condition): ?>
  [?php endif; ?]
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</td>
<?php endif; ?>
