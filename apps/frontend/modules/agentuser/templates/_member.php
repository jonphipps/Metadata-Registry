<?php if ( ! $sf_request->getParameter('user_id')) {
  $user = $agent_has_user->getUser();
  echo sf_link_to($user, '@user_show?id=' . $user->getId());
} ?>
