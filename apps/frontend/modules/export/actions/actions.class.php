<?php
use ImportVocab\ExportVocab;

/**
 * export actions.
 *
 * @package    registry
 * @subpackage export
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class exportActions extends autoExportActions
{

    /**
     *
     */
    public function preExecute()
    {
        $this->getCurrentSchema();

        parent::preExecute();
    }


  /**
   * Set defaults
   *
   * @param \ExportHistory $export_history
   *
   * @throws PropelException
   * @throws sfError404Exception
   */
  public function setDefaults($export_history)
  {
    $schemaObj = $this->getCurrentSchema();
    $schemaId  = $schemaObj->getId();

    if ('Vocabulary' == get_class($schemaObj)) {
      $export_history->setVocabularyId($schemaId);
    } else {
      $export_history->setSchemaId($schemaId);
    }
    $propertiesInUse = $schemaObj->getProfilePropertiesInUse();
    $props=[];
    if ($propertiesInUse) {
      foreach ($propertiesInUse as $index => $property) {
        $props[$index] = $property->getId();
      }
      $this->setFlash('propertiesInUse', json_encode($props));
    }

    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    if ($userId) {
      $export_history->setUserId($userId);
    }
    //todo: check if there was an export for this vocab for this user first, and then get the last for any vocab
    $lastExportForUser = ExportHistoryPeer::getLastExportForUser($userId);
    if ($lastExportForUser) {
      $export_history->setSelectedLanguage($lastExportForUser->getSelectedLanguage());
      $export_history->setSelectedColumns($lastExportForUser->getSelectedColumns());
    }

    parent::setDefaults($export_history);
  }


  /**
   * @throws sfStopException
   */
  public function executeEdit()
  {
    $this->export_history = $this->getExportHistoryOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $this->updateExportHistoryFromRequest();

      $this->saveExportHistory($this->export_history);

      //generate a url for the csv download for the id of this record
      /** @var sfWebController $controller */
      $controller   = $this->getController();
      $downloadLink = $controller->genUrl('@export_download?id=' . $this->export_history->getId());
      $this->setFlash('download', $downloadLink);
      //$this->getResponse()->addHttpMeta('refresh', '5; url=' . $downloadLink, false);
      $this->setFlash('notice', 'Your download should start automatically. If it doesn\'t, click <a href="'. $downloadLink . '">here</a>' );

      $this->setRedirectFilter();
      $url = $this->redirectFilter ? $this->redirectRoute . '_list' . $this->redirectFilter : '@homepage';
      $this->redirect($url);

    } else {
      $this->labels = $this->getLabels();
    }
  }


   /**
   * gets the current schema object
   *
   * @return schema current schema object
   * @throws PropelException
   * @throws sfError404Exception
   */
    public function getCurrentSchema()
    {
        //current schema is already set
        if (isset($this->schema)) {
            return $this->schema;
        }

        $schema = false;
        if ($this->getRequestParameter('id')) {
            $this->export_history = ExportHistoryPeer::retrieveByPK($this->getRequestParameter('id'));
            if (isset( $this->export_history )) {
                $schema = $this->export_history->getSchema();
                if ($this->export_history->getSchemaId()) {
                    $schema = $this->export_history->getSchema();
                }
                if ($this->export_history->getVocabularyId()) {
                    $schema = $this->export_history->getVocabulary();
                }
            }
        }
        if ($this->getRequestParameter('schema_id')) {
            $schema     = SchemaPeer::retrieveByPK($this->getRequestParameter('schema_id'));
            $this->type = 'schema';
        }
        if ($this->getRequestParameter('vocabulary_id')) {
            $schema     = VocabularyPeer::retrieveByPK($this->getRequestParameter('vocabulary_id'));
            $this->type = 'vocabulary';
        }

        if ($schema) {
            myActionTools::setLatestSchema($schema->getId());
        }

        $this->forward404Unless($schema, 'No filter has been selected.');

        $this->schema   = $schema;
        $this->schemaID = $schema->getId();
        $this->setFlash('hasLanguages', count($schema->getLanguagesNoDefault()) > 1);

        return $schema;
    }


  public function executeDownload()
  {
    /** @var ExportHistory $export */
    $export = ExportHistoryPeer::retrieveByPK($this->getRequestParameter('id'));
    $this->forward404Unless((bool) $export, 'No parent filter has been selected.');

    $this->setLayout(false);
    sfConfig::set('sf_escaping_strategy', false);

    $exportMe = new ExportVocab($export);
    $exportMe->write();
    $file = file_get_contents($exportMe->getPath() . $exportMe->getFileName());

    $this->getResponse()->clearHttpHeaders();
    $this->getResponse()->setHttpHeader('Content-Description','File Transfer');
    $this->getResponse()->setHttpHeader('Content-Type', 'text/csv; charset=UTF-8');
    $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="' . $exportMe->getFileName() . '"');
    $this->getResponse()->setHttpHeader('Expires', '0');
    $this->getResponse()->setHttpHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
    $this->getResponse()->setHttpHeader('Pragma', 'public');
    //echo "\xEF\xBB\xBF"; // UTF-8 BOM
    $this->getResponse()->setHttpHeader('Content-Length', strlen($file));

    //$this->export = $exportMe;
    $this->getResponse()->sendHttpHeaders();
    $this->renderText($file);

    //return $this->redirect( 'schema/export?id=' . $this->getRequestParameter( 'id' ) );
    return sfView::NONE;

  }

}
