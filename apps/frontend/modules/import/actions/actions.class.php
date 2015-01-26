<?php

/**
 * import actions.
 *
 * @package    registry
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class importActions extends autoimportActions
{
  public function preExecute()
  {
    $this->getCurrentSchema();

    parent::preExecute();
  }

  /**
   * Set defaults
   *
   * @param \FileImportHistory $file_import_history
   */
  public function setDefaults( $file_import_history )
  {
    $schemaObj = $this->getCurrentSchema();
    $schemaId = $schemaObj->getId();
    $file_import_history->setSchemaId( $schemaId );
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    $file_import_history->setUserId( $userId );

    /** @var sfWebRequest $request */
    $request = $this->getRequest();
    if ( ! $request->hasFileErrors() ) {
      $sourceFile = $request->getFile( "file_import_history[filename]" );
      $file_import_history->setSourceFileName( $sourceFile[ 'name' ] );
      $file_import_history->setFileType( $sourceFile[ 'type' ] );
    }

    parent::setDefaults( $file_import_history );
  }

  public function executeEdit()
  {
    parent::executeEdit();
    $foo = $this->file_import_history;
  }
  /**
   * gets the current schema object
   *
   * @return schema current schema object
   */
  public function getCurrentSchema()
  {
    $schema = myActionTools::findCurrentSchema();

    if ( ! $schema ) //we have to do it the hard way
    {
      $this->file_import_history = FileImportHistoryPeer::retrieveByPk($this->getRequestParameter('id'));
      if ( isset( $this->file_import_history ) ) {
        $schema = $this->file_import_history->getSchema();
        if ( $schema ) {
          myActionTools::setLatestSchema( $schema->getId() );
        }
      }
    }

    $this->forward404Unless( $schema, 'No Element Set has been selected.' );

    $this->schema = $schema;
    $this->schemaID = $schema->getId();

    return $schema;
  }
}
