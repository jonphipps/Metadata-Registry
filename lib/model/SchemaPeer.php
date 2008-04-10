<?php

/**
 * Subclass for performing query and update operations on the 'reg_schema' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPeer extends BaseSchemaPeer
{
  public function __toString()
  {
    return $this->getName();
  }

}
