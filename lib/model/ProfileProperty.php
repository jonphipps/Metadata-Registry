<?php

/**
 * Subclass for representing a row from the 'profile_property' table.
 *
 *
 *
 * @package lib.model
 */
class ProfileProperty extends BaseProfileProperty
{
  /**
  * to string
  *
  * @return string
  */
  public function __toString()
  {
    return $this->getLabel();
  } //__toString
}
