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
  * default string
  *
  * @return string
  */
  public function __toString()
  {
    return $this->getName();
  }

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

   /**
  * get the uneditable-in-list properties for this profile
  *
  * @return array of Property objects
  */
  public function getNoEditProperties()
  {
    $c = new Criteria();
    $c->add(ProfilePropertyPeer::IS_ATTRIBUTE,true);

    return $this->getProfilePropertys($c);

  }

}
