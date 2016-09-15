<?php if ( ! $sf_request->getParameter('user_id')) {
  $user = $agent_has_user->getUser();
  echo link_to($user, '@user_detail?id=' . $user->getId());
} ?>
