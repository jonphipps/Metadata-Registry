<?php

/**
 * Subclass for representing a row from the 'reg_file_import_history' table.
 *
 *
 *
 * @package lib.model
 */
class FileImportHistory extends BaseFileImportHistory
{
  function __toString()
  {
    return $this->getCreatedAt();
  }

  /**
   * @return string
   */
  public function getMap()
  {
    return unserialize( $this->map );
  }

  /**
   * @param string $map
   */
  public function setMap( $map )
  {
    parent::setMap( serialize( $map ) );
  }

  /**
   * @return string
   */
  public function getResults()
  {
    return unserialize( $this->results );
  }

  /**
   * @param string $results
   */
  public function setResults( $results )
  {
    parent::setResults( serialize( $results ) );
  }
}
