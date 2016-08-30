<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/07 18:39:17
?>
<ul class="sf_admin_actions">
 <?php if ($sf_user->hasObjectCredential($agent_has_user->getAgentId(),
                                         'agent',
                                         [
                                             0 => [
                                                 0 => 'administrator',
                                                 1 => 'agentadmin',
                                             ],
                                         ]) && $agent_has_user->getUserId() != $sf_user->getAttribute('subscriber_id',
                                                                                                      '',
                                                                                                      'subscriber')
 ): ?>
  <li class="float-left-show"><?php if ($agent_has_user->getId()): ?><?php echo button_to(__('Delete'),
                                                                                          'agentuser/delete?id=' . $agent_has_user->getId(),
                                                                                          [
                                                                                              'post' => true,
                                                                                              'confirm' => __('Are you sure?'),
                                                                                              'title' => 'Delete',
                                                                                              'class' => 'sf_admin_action_delete',
                                                                                          ]) ?><?php endif; ?>
  </li>
 <?php endif; ?>
 <?php if ($sf_user->hasObjectCredential($agent_has_user->getAgentId(),
                                         'agent',
                                         [
                                             0 => [
                                                 0 => 'administrator',
                                                 1 => 'agentadmin',
                                             ],
                                         ]) && $agent_has_user->getUserId() != $sf_user->getAttribute('subscriber_id',
                                                                                                      '',
                                                                                                      'subscriber')
 ): ?>
  <li><?php echo button_to(__('Edit'),
                           'agentuser/edit?id=' . $agent_has_user->getId(),
                           [
                               'title' => 'Edit',
                               'class' => 'sf_admin_action_edit',
                           ]) ?></li>
 <?php endif; ?>
 <?php if ($sf_user->hasObjectCredential($agent_has_user->getAgentId(),
                                         'agent',
                                         [
                                             0 => [
                                                 0 => 'administrator',
                                                 1 => 'agentadmin',
                                             ],
                                         ]) && $agent_has_user->getUserId() != $sf_user->getAttribute('subscriber_id',
                                                                                                      '',
                                                                                                      'subscriber')
 ): ?>
  <li><?php if ($agent_has_user->getId()): ?><?php echo button_to(__('Add Member'),
                                                                  'agentuser/create',
                                                                  [
                                                                      'title' => 'Create',
                                                                      'class' => 'sf_admin_action_create',
                                                                  ]) ?><?php endif; ?>
  </li>
 <?php endif; ?>
</ul>
