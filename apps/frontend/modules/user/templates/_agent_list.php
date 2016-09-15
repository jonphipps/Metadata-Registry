   <ul class="plain_list">
   <?php $agents = $user->getAgentHasUsersJoinAgent() ?>
   <?php if (count($agents)): ?>
     <?php foreach ($agents as $agent): $thisAgent = $agent->getAgent(); ?>
       <li><?php echo link_to($thisAgent->getAgent(), '@agent_detail?id=' . $thisAgent->getId()) ?></li>
     <?php endforeach ?>
   <?php else: ?>
     <li>None</li>
   <?php endif; ?>
   </ul>
