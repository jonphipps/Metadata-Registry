<?php

/**
 * Contains helper functions for feed building
 *
 * @version $Id$
 * @copyright 2009
 */

function getHistoryFeedEntryTitle($feedEntry)
{
  //entry title should be...
  //$vocabulary->name :: $concept->preflabel :: $property->label :: action
  $vocabName = '';

}



function getUserName($user)
{
  $nickname = $user->getNickname();
  $username = strval($user);
  if ($username != $nickname)
  {
    return $user . " (" . $nickname . ")";
  }
  else
  {
    return $username;
  }
}


?>