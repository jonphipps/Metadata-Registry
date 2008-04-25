<?php

/**
 * Subclass for representing a row from the 'profile' table.
 *
 *
 *
 * @package lib.model
 */
class Profile extends BaseProfile
{
    /**
  * get the required properties for this profile
  *
  * @return array of Property objects
  */
  public function getRequiredProperties()
  {
    $c = new Criteria();
    $c->add(ProfilePropertyPeer::IS_REQUIRED,true);

    return $this->getProfilePropertys($c);

  }

}
