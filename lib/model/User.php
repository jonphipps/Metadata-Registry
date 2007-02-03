<?php

/**
 * Subclass for representing a row from the 'reg_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class User extends BaseUser
{
  public function __toString()
  {
    if ($this->getLastName())
    {
      return ucfirst(strtolower($this->getFirstName())).' '.ucfirst(strtolower($this->getLastName()));
    }
    else
    {
      return $this->getNickname();
    }
  }

  public function setPassword($password)
  {
    $salt = md5(rand(100000, 999999).$this->getNickname().$this->getEmail());
    $this->setSalt($salt);
    $this->setSha1Password(sha1($salt.$password));
  }

  public function getAgentCount($userID) {
    $criteria = new Criteria();
  	$criteria->add(AgentHasUserPeer::USER_ID, $userID);
    $AgentCount = AgentHasUserPeer::doCount($criteria);

    return $AgentCount;
  }

  /**
  * alias for __toString
  *
  * @return string firstname, lastname
  */
  public function getUser()
  {
    return $this->__toString();
  }

} // User
