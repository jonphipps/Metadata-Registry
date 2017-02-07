   <ul class="plain_list">
   <?php $agents = $user->getAgentHasUsersJoinAgent() ?>
   <?php if (count($agents)): ?>
     <?php foreach ($agents as $agent): $thisAgent = $agent->getAgent(); ?>
       <li><?php echo sf_link_to($thisAgent->getAgent(), '@agent_show?id=' . $thisAgent->getId()) ?></li>
     <?php endforeach ?>
   <?php else: ?>
     <li>None</li>
   <?php endif; ?>
   </ul>
