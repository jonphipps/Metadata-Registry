<?php if ( ! $sf_request->getParameter('agent_id')) {
  $agent = $agent_has_user->getAgent();
echo link_to($agent, '@agent_detail?id=' . $agent->getId());
} ?>

