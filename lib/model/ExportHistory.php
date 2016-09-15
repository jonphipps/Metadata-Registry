<?php

/**
 * Subclass for representing a row from the 'reg_export_history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ExportHistory extends BaseExportHistory
{

    /**
     * @return array
     */
    public function getLanguagesNoDefault()
    {
        if ($this->getSchemaId()) {
            return $this->getSchema()->getLanguagesNoDefault();
        }
        if ($this->getVocabularyId()) {
            return $this->getVocabulary()->getLanguagesNoDefault();
        }

        return [];

    }

}
