<?php

/**
 * export actions.
 *
 * @package    registry
 * @subpackage export
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class exportActions extends autoexportActions
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
     * @return void
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

        parent::setDefaults($export_history);
    }


    /**
     * gets the current schema object
     *
     * @return schema current schema object
     */
    public function getCurrentSchema()
    {
        //current schema is already set
        if (isset($this->schema)) {
            return $this->schema;
        }

        $schema = false;
        if ($this->getRequestParameter('id')) {
            $this->export_history = ExportHistoryPeer::retrieveByPk($this->getRequestParameter('id'));
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
            $schema     = SchemaPeer::retrieveByPk($this->getRequestParameter('schema_id'));
            $this->type = 'schema';
        }
        if ($this->getRequestParameter('vocabulary_id')) {
            $schema     = VocabularyPeer::retrieveByPk($this->getRequestParameter('vocabulary_id'));
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

}
