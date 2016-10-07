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
        $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      if ($userId) {
        $export_history->setUserId($userId);
      }

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

      $this->setFlash('notice', 'Your download should start automatically...');
      //generate a url for the csv download for the id of this record
      $this->setFlash('download', '@export_download' . '?id=' . $this->export_history->getId());

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
    $export = ExportHistoryPeer::retrieveByPK($this->getRequestParameter('id'));
    $this->forward404Unless($export, 'No filter has been selected.');

    $asTemplate    = '';
    $includeProlog = '';
    $populate      = '';
    $addLanguage   = $export->getSelectedLanguage();
    $schema = $export->getSchema();
    $vocabulary = $export->getVocabulary();
    $defaultLanguage = $schema ? $schema->getLanguage() : $vocabulary->getLanguage();

    if ($addLanguage) {
      $languages = [ $defaultLanguage, $addLanguage, ];
    } else {
      $languages = [ $defaultLanguage, ];
    }
    switch ($export->getCsvType()) {
      case "1": //empty template
        $asTemplate    = true;
        $populate      = false;
        $includeProlog = false;
        break;
      case "2": //populated template
        $asTemplate    = true;
        $populate      = true;
        $includeProlog = false;
        break;
      case "3": //sparse data
        $asTemplate    = false;
        $populate      = true;
        $includeProlog = false;
        break;
      case "4": //rich data
        $asTemplate    = true;
        $populate      = true;
        $includeProlog = false;
        break;
      default:
    }
    $this->setLayout(false);
    sfConfig::set('sf_escaping_strategy', false);

    $exportMe = new ExportVocab($export->getId(),
        '',
        $populate,
        $asTemplate,
        $includeProlog,
        (bool) $export->getIncludeDeleted(),
        (bool) $export->getExcludeDeprecated(),
        (bool) $export->getExcludeGenerated(),
        $languages,
        $export->getSelectedColumns());

//    $this->getResponse()->clearHttpHeaders();
//    $this->getResponse()->setHttpHeader('Content-Description','File Transfer');
    $this->getResponse()->setHttpHeader('Content-Type', 'text/csv; charset=UTF-8');
    $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="' . $exportMe->getFileName() . '"');
    $this->getResponse()->setHttpHeader('Pragma', '');
    $this->getResponse()->setHttpHeader('Cache-Control', '');
    $this->getResponse()->setHttpHeader('Expires', '0');
    $this->getResponse()->setHttpHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
    $this->getResponse()->setHttpHeader('Pragma', 'public');
    //echo "\xEF\xBB\xBF"; // UTF-8 BOM

//    $this->getResponse()->sendHttpHeaders();
    $exportMe->write();
    $this->export = $export;
    //$this->renderText($export->getPath() .  $export->getFileName());

    //return $this->redirect( 'schema/export?id=' . $this->getRequestParameter( 'id' ) );
    //return sfView::NONE;

  }

}
