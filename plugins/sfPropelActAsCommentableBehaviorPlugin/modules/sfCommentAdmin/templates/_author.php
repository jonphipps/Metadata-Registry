<?php
$config_user = array('class'     => 'sfGuardUser',
                     'id_method' => 'getUserId',
                     'toString'  => 'toString',);
$config_user = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_user', $config_user);

if (!is_null($sf_comment->getAuthorName()))
{
  $author = $sf_comment->getAuthorName();
}
else
{
  $class = $config_user['class'];
  $toString = $config_user['toString'];
  $peer = sprintf('%sPeer', $class);

  if (is_callable(array($peer, 'retrieveByPk')))
  {
    $author = call_user_func(array($peer, 'retrieveByPk'), $sf_comment->getAuthorId());
    $author = (!is_null($author)) ? $author->$toString() : '';
  }
  else
  {
    $author = '';
  }
}

echo $author;