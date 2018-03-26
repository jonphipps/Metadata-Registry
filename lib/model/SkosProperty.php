<?php

/**
 * Subclass for representing a row from the 'reg_skos_property' table.
 *
 *
 *
 * @package lib.model
 */
class SkosProperty extends BaseSkosProperty
{
  public function __toString()
  {
    return $this->getLabel();
  }

  public function getSkosProperty()
  {
    return $this->getName();
  }

    /**
     * description
     *
     * @return int
     */
  public static function getPrefLabelId()
  {
    //fixme: This is clearly not the best way to do this
    return 19;
  }

} // SkosProperty
