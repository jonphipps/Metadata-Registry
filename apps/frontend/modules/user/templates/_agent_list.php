   <ul class="plain_list">
   <?php $agents = $user->getAgentHasUsersJoinAgent() ?>
   <?php foreach ($agents as $agent): $thisAgent = $agent->getAgent(); ?>
     <li><?php echo link_to($thisAgent->getAgent(), 'agent/show?id=' . $thisAgent->getId()) ?></li>
   <?php endforeach ?>
   </ul>