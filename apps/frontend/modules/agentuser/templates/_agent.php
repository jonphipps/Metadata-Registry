<?php if ( ! $sf_request->getParameter('agent_id')) {
  $agent = $agent_has_user->getAgent();
echo sf_link_to($agent, '@agent_show?id=' . $agent->getId());
} ?>

