<?php $listActions = $this->getParameterValue('list.batch_actions') ?>
<?php if (!is_null($listActions)): ?>
<div id="sf_admin_batch_action_choice">
  [?php echo input_hidden_tag('page', $sf_request->getParameter('page', 1)) ?] 
  <select name="sf_admin_batch_action">
    <option value="">[?php echo __('Choose an action') ?]</option>
    <?php foreach ((array) $listActions as $actionName => $params): ?>
    <?php echo $this->addCredentialCondition($this->DbFinderAdminGenerator->getOptionToAction($actionName, $params), $params) ?>
    <?php endforeach; ?>
  </select>
  [?php echo submit_tag(__('Ok')) ?]
  </form>
</div>
<?php endif; ?>