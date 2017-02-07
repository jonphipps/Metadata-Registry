<?php

use_helper('Javascript', 'Global');

function link_to_user_interested($user, $question)
{
  if ($user->isAuthenticated())
  {
    $interested = InterestPeer::retrieveByPk($question->getId(), $user->getSubscriberId());
    if ($interested)
    {
      // already interested
      return __s('interested!');
    }
    else
    {
      // didn't declare interest yet
      return link_to_remote(__s('interested?'), array(
        'url'      => 'user/interested?id='.$question->getId(),
        'update'   => array('success' => 'block_'.$question->getId()),
        'loading'  => "Element.show('indicator')",
        'complete' => "Element.hide('indicator');".visual_effect('pulsate', 'mark_'.$question->getId()),
      ));
    }
  }
  else
  {
    return link_to_login(__s('interested?'));
  }
}

function link_to_profile($user)
{
  if ($user->getNickname() == 'anonymous')
  {
    return __s('anonymous');
  }
  else
  {
    return sf_link_to($user->__toString(), '@user_profile?nickname='.$user->getNickname());
  }
}
