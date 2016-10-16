<?php
use ImportVocab\ImportVocab;

/**
 * import actions.
 *
 * @package    registry
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 * @property   \FileImportHistory  $file_import_history
 */
class importActions extends autoImportActions
{
  //use DispatchesJobs;

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

    if ('Vocabulary' == get_class($schemaObj)) {
      $file_import_history->setVocabularyId($schemaId);
    } else {
      $file_import_history->setSchemaId($schemaId);
    }
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
   * @return string|void
   * @throws sfStopException
     */
  public function executeEdit()
  {
    /** @var \FileImportHistory file_import_history */
    $this->file_import_history = $this->getFileImportHistoryOrCreate();
    $this->labels = $this->getLabels();

    if ( $this->getRequest()->getMethod() == sfRequest::POST ) {
      $this->updateFileImportHistoryFromRequest();
      //need an id
      if ($this->file_import_history->getVocabularyId()) {
        $schemaId = $this->file_import_history->getVocabularyId();
        $type = 'vocabulary';
      } else {
        $schemaId = $this->file_import_history->getSchemaId();
        $type = 'schema';
      }
      $filePath =
            sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR
            . $this->file_import_history->getFileName();
      $import = new ImportVocab($type, $filePath, $schemaId);
      $prolog = $import->processProlog();
      if ( ! $prolog) {
        $message =
              "Something went seriously wrong and we couldn't process your file at all (wish we could be more helpful)";
        return $this->handleImportError($message, $filePath);
      }

      $type_id = ('vocabulary' === $type) ? 'vocabulary_id' : 'schema_id';
      //check to make sure that if there's a schema_id in the prolog that it matches the current ID
      if (isset($prolog['meta'][$type_id])) {
        if (is_array($prolog['meta'][$type_id])) {
          $message =
                "You have a duplicate of one of the prolog columns ('reg_id', 'uri', 'type') in your data<br />We can't process the file until it's removed.";
          return $this->handleImportError($message, $filePath);
        }
        if ($prolog['meta'][$type_id] != $schemaId) {
          $message = "The " . $type . "_id in the file you are importing (" . $prolog['meta'][$type_id] . ") does not match the Element Set Id of this
        Element Set (" . $schemaId . ")<br />You may be trying to import into the wrong Element Set?";
          return $this->handleImportError($message, $filePath);
        }
      } else {
        $message = "Your file is missing a " . $type . "_id entry in the 'meta' section and we won't process it without one";
        return $this->handleImportError($message, $filePath);
      }
      //todo identify and warn of more processing errors with the prolog
      //check to make sure the user is an admin
      /** @var myUser $user */
      $user = $this->getUser();
      if ( ! $user->hasCredential(array(
            0 => array(
                  0 => 'administrator',
                  1 => 'schemaadmin',
                  2 => 'vocabularyadmin',
            ),
      ))
      ) {
        $message = 'You must be an administrator of this Element Set to import.';
        return $this->handleImportError($message, $filePath);
      }
      $this->file_import_history->setResults("Queued for processing.");
      $this->saveFileImportHistory($this->file_import_history);

      $environment = SF_ENVIRONMENT;
      $importId    = $this->file_import_history->getId();

      //Laravel
      // $job = ( new importVocabulary($schemaId, $filePath, $importId, $environment, $type) )->onQueue('import');
      // $this->dispatch($job);
      $job  = Resque::enqueue('import',
          'ImportVocab\ImportJob',
          [
              $schemaId,
              $filePath,
              $importId,
              $environment,
              $type,
          ],
          true);

      $this->file_import_history->setToken($job);
      $this->file_import_history->save();

      $job2 = Resque::enqueue('import',
          'ImportVocab\UpdateRelatedJob',
          [
              $environment,
              $importId,
          ],
          true);

      $this->setFlash('notice',
          'Your file has been accepted and queued for processing. Check back in a few minutes for the results');

      unset ( $import );

      return $this->redirect('@' . $type . '_import_show?id=' . $importId . '&' . $type_id . '=' . $schemaId);
    }

  }

  /**
   * gets the current schema object
   *
   * @return schema current schema object
   */
  public function getCurrentSchema()
  {

    $schema  = false;
    if ($this->getRequestParameter('id')) {
      $this->file_import_history = FileImportHistoryPeer::retrieveByPk($this->getRequestParameter('id'));
      if (isset($this->file_import_history)) {
        $schema = $this->file_import_history->getSchema();
        if ($this->file_import_history->getSchemaId()) {
          $schema = $this->file_import_history->getSchema();
        }
        if ($this->file_import_history->getVocabularyId()) {
          $schema = $this->file_import_history->getVocabulary();
        }
      }
    }
    if ($this->getRequestParameter('schema_id')) {
      $schema = SchemaPeer::retrieveByPk($this->getRequestParameter('schema_id'));
      $this->type = 'schema';
    }
    if ($this->getRequestParameter('vocabulary_id')) {
      $schema = VocabularyPeer::retrieveByPk($this->getRequestParameter('vocabulary_id'));
      $this->type = 'vocabulary';
     }

    if ($schema) {
      myActionTools::setLatestSchema($schema->getId());
    }

    $this->forward404Unless( $schema, 'No filter has been selected.' );

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
