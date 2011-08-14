<div id="form_row_agent_has_user_user_id" class="form-row">
    <?php echo label_for('agent_has_user[user_id]', __($labels['agent_has_user{user_id}']), 'class="required" ') ?>

  <div id="form_row_content_agent_has_user_user_id" class="content<?php if ($sf_request->hasError('agent_has_user{user_id}')): ?> form-error<?php endif; ?>">
<?php if ($sf_request->hasError('agent_has_user{user_id}')): ?>
      <?php echo form_error('agent_has_user{user_id}', array('class' => 'form-error-msg')) ?>
<br /><?php endif; ?>
      <?php $value = object_select_tag($agent_has_user, 'getUserId', array (
  'related_class' => 'User',
  'control_name' => 'agent_has_user[user_id]',
  'peer_method' => 'getNewUsersForAgent',
  'include_blank' => false,
  'agent_id' => '%%agent_id%%',
)); echo $value ? $value : '&nbsp;' ?>


    </div>
  </div>
