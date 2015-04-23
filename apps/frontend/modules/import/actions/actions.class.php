<?php
use ImportVocab\ImportVocab;

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
    if ($request->hasFile( "file_import_history[filename]") and ! $request->hasFileErrors() ) {
      $sourceFile = $request->getFile( "file_import_history[filename]" );
      $file_import_history->setSourceFileName( $sourceFile[ 'name' ] );
      $file_import_history->setFileType( $sourceFile[ 'type' ] );
    }

    parent::setDefaults( $file_import_history );
  }

  /**
   * @throws sfStopException
   */
  public function executeEdit()
  {
    /** @var \FileImportHistory file_import_history */
    $this->file_import_history = $this->getFileImportHistoryOrCreate();

    if ( $this->getRequest()->getMethod() == sfRequest::POST ) {
      $this->updateFileImportHistoryFromRequest();
      //need an id
      $this->saveFileImportHistory( $this->file_import_history );
      $schemaId = $this->file_import_history->getSchemaId();

      $filePath = sfConfig::get( 'sf_upload_dir' ) . DIRECTORY_SEPARATOR .
                  'csv' . DIRECTORY_SEPARATOR .
                  $this->file_import_history->getFileName();
      $import = new ImportVocab( 'schema', $filePath, $schemaId );
      $import->importId = $this->file_import_history->getId();
      $prolog = $import->processProlog();
      //todo we need a validation check to make sure that if there's a schema_id in the prolog that it matches the current ID
      if (isset($prolog['meta']['schema_id']) and $prolog['meta']['schema_id'] != $schemaId)
      {
        $this->getRequest()->setError('Schema Id match', 'The Schema Id in the file you are importing does not match the Schema Id of this
        Element Set');
        $this->setFlash( 'error', 'The Schema Id ('. $prolog['meta']['schema_id'] .') in the file you are importing
        does not match the Schema Id (' . $schemaId . ') of this Element Set. They must be the same Schema' );
        return $this->redirect( 'import/create?schema_id=' . $this->file_import_history->getId() );

      }
      //todo we need to check to make sure the user is an admin
      $user = $this->getUser();
      if ( ! $user->hasCredential(array (
            0 => array (
                  0 => 'administrator',
                  1 => 'schemaadmin',
            ),
      ))
      ) {
        $this->setFlash('error', 'You must be an administrator of this Element Set to import.');

        return $this->redirect('import/create?schema_id=' . $this->file_import_history->getId());
      }
      //todo update the prefixes table with prefixes
      //todo update the schema table with prefixes
      $schema = $this->getCurrentSchema();
      $schemaPrefixes = $schema->getPrefixes();
      $countSchemaPrefixes = count($schemaPrefixes);
      $importPrefixes = $import->prolog['prefix'];
      foreach ($importPrefixes as $prefix => $url) {
        if (!array_key_exists($prefix,$schemaPrefixes))
        {
          $schemaPrefixes[$prefix] = $url;
        }
      }
      if (count($schemaPrefixes) != $countSchemaPrefixes)
      {
        $schema->setPrefixes($schemaPrefixes);
        $schema->save();
      }

      //todo display some sort of progress indicator on the page, or enqueue the process and send a results email
      $import->processData();
      $this->file_import_history->setResults($import->results);
      $this->file_import_history->setMap($import->mapping);
      $this->file_import_history->setTotalProcessedCount( $import->DataWorkflowResults->getTotalProcessedCount());
      $this->file_import_history->setErrorCount($import->DataWorkflowResults->getErrorCount());
      $this->file_import_history->setSuccessCount($import->DataWorkflowResults->getSuccessCount());

      $newFilePath = sfConfig::get( 'sf_repos_dir' ) . DIRECTORY_SEPARATOR .
                     'agents' . DIRECTORY_SEPARATOR .
                     $this->file_import_history->getSchema()->getAgentId() . DIRECTORY_SEPARATOR .
                     $this->file_import_history->getSourceFileName();
      $this->getRequest()->moveToRepo($filePath, $newFilePath);


      $this->saveFileImportHistory( $this->file_import_history );
      $this->setFlash( 'notice', 'Your file has been imported' );
      unset ($import);

      return $this->redirect( 'import/show?id=' . $this->file_import_history->getId() );
    } else {
      $this->labels = $this->getLabels();
    }
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
