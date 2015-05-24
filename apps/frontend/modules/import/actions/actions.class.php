<?php
use ImportVocab\ImportJob;
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

  public function executeEdit()
  {
    /** @var \FileImportHistory file_import_history */
    $this->file_import_history = $this->getFileImportHistoryOrCreate();
    $this->labels = $this->getLabels();

    if ( $this->getRequest()->getMethod() == sfRequest::POST ) {
      $this->updateFileImportHistoryFromRequest();
      //need an id
      $schemaId = $this->file_import_history->getSchemaId();

      $filePath =
            sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR
            . $this->file_import_history->getFileName();
      $import = new ImportVocab('schema', $filePath, $schemaId);
      $prolog = $import->processProlog();
      if ( ! $prolog) {
        $message =
              "Something went seriously wrong and we couldn't process your file at all (wish we could be more helpful)";
        $this->handleImportError($message, $filePath);
      }
      //check to make sure that if there's a schema_id in the prolog that it matches the current ID
      if (isset($prolog['meta']['schema_id'])) {
        if (is_array($prolog['meta']['schema_id'])) {
          $message =
                "You have a duplicate of one of the prolog columns ('reg_id', 'uri', 'type') in your data<br />We can't process the file until it's removed.";
          $this->handleImportError($message, $filePath);
        }
        if ($prolog['meta']['schema_id'] != $schemaId) {
          $message = "The Schema Id in the file you are importing (" . $prolog['meta']['schema_id'] . ") does not match the Element Set Id of this
        Element Set (" . $schemaId . ")<br />You may be trying to import into the wrong Element Set?";
          $this->handleImportError($message, $filePath);
        }
      } else {
        $message = "Your file is missing a Schema ID in the 'meta' section and we won't process it without one";
        $this->handleImportError($message, $filePath);
      }
      //todo identify and warn of more processing errors with the prolog
      //check to make sure the user is an admin
      /** @var myUser $user */
      $user = $this->getUser();
      if ( ! $user->hasCredential(array(
            0 => array(
                  0 => 'administrator',
                  1 => 'schemaadmin',
            ),
      ))
      ) {
        $message = 'You must be an administrator of this Element Set to import.';
        $this->handleImportError($message, $filePath);
      }
      $this->file_import_history->setResults("Queued for processing.");
      $this->saveFileImportHistory($this->file_import_history);
      $this->setFlash('notice',
            'Your file has been accepted and queued for processing. Check back in a few minutes for the results');
      unset ($import);
      $environment = SF_ENVIRONMENT;

      //todo it's at this point that we push this onto a queue for processing
      $job = Resque::push('ImportVocab\ImportJob', array(
                  $schemaId,
                  $filePath,
                  $this->file_import_history->getId(),
                  $environment
            ));
      $job2 = Resque::push('ImportVocab\UpdateRelatedJob', array(
            $schemaId,
            $this->file_import_history->getId(),
            $this->file_import_history->getUserId(),
            $environment
      ));

      return $this->redirect('import/show?id=' . $this->file_import_history->getId());
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

  private function handleImportError($message, $filePath)
  {
    if (is_file($filePath)) {
      unlink($filePath);
    }
    $this->getRequest()->setError('file_import_history{filename}', $message);

    return sfView::SUCCESS;
  }
}
