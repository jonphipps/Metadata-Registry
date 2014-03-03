<?php
/**
 * This task is used to import either a vocabulary or an element set into an instance of the Registry
 *
 * It will look for the XSLT file data/transform/clay2propel.xsl
 *
 * @author  <jphipps@madcreek.com>
 *
 * usage :
 *   symfony import-vocabulary {type} {ID} {file path} -d ('delete existing' -- optional)
 *
 */

use ImportVocab\ImportVocab;

pake_desc('Import a file into a vocabulary');
pake_task('import-vocabulary');

pake_desc('Import a list of vocabulary files');
pake_task('import-list');

pake_desc('Repair references in an import batch');
pake_task('import-repair');

echo "\n";

//xdebug_break();

//we could also prepend these as arguments, but not today
//define('SF_APP', $app);
//define('SF_ENVIRONMENT', $env);
define('SF_APP', 'frontend');
define('SF_ENVIRONMENT', 'prod');
define('SF_ROOT_DIR', sfConfig::get('sf_root_dir'));
define('SF_DEBUG', false);

require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor'. DIRECTORY_SEPARATOR .'autoload.php');

require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR .
             'config' . DIRECTORY_SEPARATOR . 'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

//necessary to detect line endings in mac files
ini_set('auto_detect_line_endings', true);

$uploadPath  = SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

function run_import_repair($task, $args)
{
    //xdebug_break();
    if (count($args) < 1) {
        throw new Exception('You must provide a batch ID.');
    }
    $batchId = $args[0];
    //get the import history for the batchid
    $criteria = new Criteria();
    $criteria->add(\FileImportHistoryPeer::BATCH_ID, $batchId);
    $batch = \FileImportHistoryPeer::doSelect($criteria);
    if (empty($batch)) {
        throw new Exception('Not a valid batch ID.');
    }

    $criteria = new \Criteria();
    $criteria->add(\ProfilePropertyPeer::NAME, "isSameAs");
    /** @var $profileProperty \ProfileProperty */
    $profileProperty = \ProfilePropertyPeer::doSelectOne($criteria);
    $sameasId = $profileProperty->getId();

    //for each one in the list
    /** @var $history FileImportHistory */
    foreach ($batch as $history) {
        //get result array
        $results = unserialize($history->getResults());
        $rows = $results['success']['rows'];
        $userId = $history->getUserId();
        //for each row
        foreach ($rows as $row) {
            //get the references
            /** @var $property \SchemaProperty */
            $property = \SchemaPropertyPeer::retrieveByPK($row['id']);
            /** @var $ref \SchemaProperty */
            $ref = \SchemaPropertyPeer::retrieveByUri($property->getParentUri());
            if ($property and $ref) {
                $property->setIsSubpropertyOf($ref->getId());
                $property->saveSchemaProperty($userId);
            }
            //update the parent property
            if (isset($row['statements'])) {
            //for each statement
                foreach ($row['statements'] as $statement) {
                    //get the references

                    if ($sameasId != $statement['propertyId']) {
                        /** @var $ref \SchemaProperty */
                        $ref = \SchemaPropertyPeer::retrieveByUri($statement['object']);
                    } else {
                        //ref = the parent
                        $ref = $property;
                    }
                    /** @var $propertyElement \SchemaPropertyElement */
                    $propertyElement = \SchemaPropertyElementPeer::retrieveByPK($statement['id']);
                    if ($propertyElement and $ref) {
                        $propertyElement->setSchemaPropertyRelatedByRelatedSchemaPropertyId($ref);
                        $propertyElement->save();
                    }
                }
            }
        }
    }
}
/**
 * this is for importing a list of value vocabulary files.
 *
 * it's designed specifically to import the list of marc21 VES files,
 * but may be modified and expanded to support more things
 *
 * @param $task
 * @param $args
 *
 * @throws Exception
 */
function run_import_list($task, $args)
{
    xdebug_break();

    //check the argument counts
    //check the argument counts
    if (count($args) < 1) {
        throw new Exception('You must provide a vocabulary type.');
    }

    if (count($args) < 2) {
        throw new Exception('You must provide a file name.');
    }

    //set the arguments
    $type     = strtolower($args[0]);
    $filePath = $args[1];
    $batchId =  $args[3];

    //does the file exist?
    if (! file_exists($filePath)) {
        throw new Exception('You must supply a valid file to import');
    }

    //is the file a valid type?
    if (preg_match('/^.+\.([[:alpha:]]{2,4})$/', $filePath, $matches)) {
        if (! in_array(
          strtolower($matches[1]),
          array(
            "json",
            "rdf",
            "csv",
            "xml"
          )
        )
        ) {
            throw new Exception('You must provide a valid file type based on the extension');
        }
    } else {
        throw new Exception("File type cannot be determined from the file extension");
    }

    /************************************************************
     *    Set Defaults Here                                      *
     *************************************************************/
    $fileType    = $matches[1];
    //todo: need to figure out a way to pass defaults dynamically

    $importTask = new pakeTask('import-vocabulary');

    //     parse file to get the fields/columns and data
    $file = fopen($filePath, "r");
    if (! $file) {
        throw new Exception("Can't read supplied file");
    }

    switch ($fileType) {
        case "csv":
            try {
                $reader = new aCsvReader($filePath);
            } catch(Exception $e) {
                throw new Exception("Not a happy CSV file! Error: " . $e);
            }
            $uploadPath = $GLOBALS['uploadPath'];
            ;
            if ('vocab' == $type) {
                // Get array of heading names found
                $headings = $reader->getHeadings();
                $fields   = VocabularyPeer::getFieldNames();

                try {
                    while ($row = $reader->getRow()) {
                        //        lookup the URI (or the OMR ID if available) for a match
                        if (empty($row["VES"])) {
                            //skip this one
                            break;
                        }

                        $uri        = $baseDomain . $row["VES"] . "#";
                        $vocab      = VocabularyPeer::getVocabularyByUri($uri);
                        $updateTime = time();

                        if (! $vocab) {
                            //          create a new concept or element
                            $vocab = new Vocabulary();
                            $vocab->setUri($uri);
                            $vocab->setCreatedAt($updateTime);
                            $vocab->setCreatedUserId($userId);
                            $vocab->setAgentId($agentID);
                            $vocab->setBaseDomain($baseDomain);
                            $vocab->setCommunity("Libraries, MARC21");
                            $vocab->setLanguage("en");
                            $vocab->setStatusId(1);
                        } else {
                            $vocab->setLastUpdated($updateTime);
                            $vocab->setUpdatedUserId($userId);
                        }

                        $vocab->setName(fixEncoding(rtrim($row['Name'])));
                        $vocab->setNote(fixEncoding(rtrim($row['Note'])));
                        $vocab->setToken($row['VES']);
                        $vocab->save();

                        //type
                        $args[0] = "vocab";
                        //vocabid
                        $args[2] = $vocab->getId();
                        //filepath
                        $args[1] = $GLOBALS['uploadPath'] . $row['VES'] . ".csv";
                        $args[3] = $batchId;
                        $args[4] = "-d";

                        run_import_vocabulary($importTask, $args);
                        $foo = $vocab->countConcepts();
                    }
                } catch(Exception $e) {
                    throw new Exception($e);
                }
            } else //it's a schema
            {
                try {
                    while ($row = $reader->getRow()) {

                        //NOTE: this is explicitly tuned to a particular import file
                        //TODO: generalize this import mapping

                        // lookup the URI (or the OMR ID if available) for a match
                        if (empty($row["URI"])) {
                            //skip this one
                            break;
                        }

                        $uri        = $row["URI"];
                        $schema     = SchemaPeer::getschemaByUri($uri);
                        $updateTime = time();

                        if (! $schema) {
                            //  create a new vocabulary
                            $schema = new Schema();
                            $schema->setUri($uri);
                            $schema->setCreatedAt($updateTime);
                            $schema->setCreatedUserId($userId);
                            $schema->setAgentId($agentID);
                            $schema->setBaseDomain($baseDomain);
                            $schema->setProfileId(1);
                        } else {
                            $schema->setUpdatedAt($updateTime);
                            $schema->setUpdatedUserId($userId);
                        }

                        $schema->setCommunity($row['Tags']);
                        $schema->setLanguage($row['Language']);
                        $schema->setNsType("slash");
                        $schema->setName($row['Label']);
                        $schema->setNote($row['Note']);
                        $schema->setStatusId(1);
                        $schema->setToken($row['Name']);
                        $schema->setUrl($row['URL']);
                        $schema->save();

                        //todo: create a new import batch here and pass it to the import args
                        //see importVocabulary->saveresults()
                        //$batchId =
                        //type
                        $args[0] = "schema";
                        //filepath
                        $args[1] = $GLOBALS['uploadPath'] . $row['File Name'];
                        //vocabid
                        $args[2] = $schema->getId();
                        $args[3] = $batchId;
                        $args[4] = "-d";

                        run_import_vocabulary($importTask, $args);
                        $foo = $schema->countSchemaPropertys();
                    }
                } catch(Exception $e) {
                    throw new Exception($e);
                }
            }
            break;
        default:
    }
}

/**
 * @param $task
 * @param $args
 *
 * Arg[0] is one of "schema" (element set), "vocab" or "vocabulary"
 * arg[1] is the vocabulary name.
 *        The file type is determined by the extension and must be one of "json", "rdf", "csv", "xml"
 * arg[2] is the vocabulary id
 * arg[3] is the batch id
 * arg[4] [optional] is -d
 *
 * @throws Exception
 */
function run_import_vocabulary($task, $args)
{
    //xdebug_break();

    //check the argument counts
    if (count($args) < 1) {
        throw new Exception('You must provide a vocabulary type.');
    }

    if (count($args) < 2) {
        throw new Exception('You must provide a file name.');
    }

    if (count($args) < 3) {
        throw new Exception('You must provide a vocabulary id.');
    }

    //set the arguments
    $type          = strtolower($args[0]);
    $filePath      = $args[1];
    $vocabId       = $args[2];
    $batchId       = $args[3];
    $deleteMissing = (isset($args[4]) && ("-d" == $args[4]));

    //do some basic validity checks

    if (! in_array(
      $type,
      array(
        "schema",
        "vocab",
        "vocabulary"
      )
    )
    ) {
        throw new Exception('You must import into a schema or a vocab');
    }

    if ("vocabulary" == $type) {
        $type = "vocab";
    }

    if (! is_numeric($vocabId)) {
        throw new Exception('You must provide a valid ID');
    }

    //does the file exist?
    if (! file_exists($filePath)) {
        //default to the site upload path
        $filePath = $GLOBALS['uploadPath'] . $filePath;
        if (! file_exists($filePath)) {
        throw new Exception('You must supply a valid file to import: ' . $filePath);
        }
    }

    //is the file a valid type?
    if (preg_match('/^.+\.([[:alpha:]]{2,4})$/', $filePath, $matches)) {
        if (! in_array(
          strtolower($matches[1]),
          array(
            "json",
            "rdf",
            "csv",
            "xml"
          )
        )
        ) {
            throw new Exception('You must provide a valid file type based on the extension');
        }
    } else {
        throw new Exception("File type cannot be determined from the file extension");
    }

    $fileType = $matches[1];

    //is the object a valid object?
    if ('vocab' == $type) {
        $vocabObj = VocabularyPeer::retrieveByPK($vocabId);
        if (is_null($vocabObj)) {
            throw new Exception('Invalid vocabulary ID');
        }

        //set some defaults
        $baseDomain = $vocabObj->getBaseDomain();
        $language   = $vocabObj->getLanguage();
        $statusId   = $vocabObj->getStatusId();
        $userId     = $vocabObj->getCreatedUserId();
        $agentId    = $vocabObj->getAgentId();

        //get a skos property id map
        $skosMap = SkosPropertyPeer::getPropertyNames();

        //there has to be a hash or a slash
        $tSlash = preg_match('@(/$)@i', $vocabObj->getUri()) ? '' : '/';
        $tSlash = preg_match('/#$/', $vocabObj->getUri()) ? '' : $tSlash;
    } else {
        $import               = new ImportVocab($type, $filePath, $vocabId);
    }

    /* From here on the process is the same regardless of UI */
    //     check to see if file has been uploaded before
    //          check import history for file name
    $importHistory = FileImportHistoryPeer::retrieveByLastFilePath($filePath);
    //          if reimport
    //               get last import history for filename
    //               unserialize column map
    //               match column names to AP based on map
    //     look for matches in unmatched field/column names to AP (ideal)
    //     csv table of data --
    //          row1: parsed field names/column headers
    //          row2: select dropdown with available fields from object AP (pre-select known matches)
    //                each select identified by column number
    //          row3: display datatype of selected field (updated dynamically when field selected)
    //          row4-13: first 10 rows of parsed data from file
    //     require a column that can match to 'URI' (maybe we'll allow an algorithm later)
    //     require columns that are required by AP
    //     on reimport there should be a flag to 'delete missing properties' from the current data
    //     note: at some point there will be a reimport process that allows URI changing
    //          this will require that there be an OMR identifier embedded in the incoming data

    switch ($fileType) {
        case "csv":
            if ('vocab' == $type) {
                // Get array of heading names found
                $headings = $reader->getHeadings();
                $fields   = ConceptPeer::getFieldNames();

                //set the map
                //      $map[] = array("property" => "Uri", "column" => "URILocal");
                //      $map[] = array("property" => "prefLabel", "column" => "skos:prefLabel");
                //      $map[] = array("property" => "definition", "column" => "skos:definition");
                //      $map[] = array("property" => "notation", "column" => "skos:notation");
                //      $map[] = array("property" => "scopeNote", "column" => "skos:scopeNote");

                $map = array(
                  "uri"        => "URILocal",
                  "prefLabel"  => "skos:prefLabel",
                  "definition" => "skos:definition",
                  "notation"   => "skos:notation",
                  "scopeNote"  => "skos:scopeNote"
                );

                $rows = 0;

                //executeImport:

                //    serialize the column map
                try {
                    while ($row = $reader->getRow()) {
                        $rows ++;
                        //        lookup the URI (or the OMR ID if available) for a match
                        $uri        = $baseDomain . $row[$map["uri"]];
                        $concept    = ConceptPeer::getConceptByUri($uri);
                        $updateTime = time();
                        $language   = (isset($map['language'])) ? $row[$map['language']] : $vocabObj->getLanguage();

                        if (! $concept) {
                            //          create a new concept or element
                            $concept = new Concept();
                            $concept->setVocabulary($vocabObj);
                            $concept->setUri($uri);
                            /**
                             * @todo Need to handle updates for topconcept here, just like language
                             **/
                            $concept->setIsTopConcept(false);
                            $concept->updateFromRequest(
                                    $userId,
                                      fixEncoding(rtrim($row[$map['prefLabel']])),
                                      $language,
                                      $statusId
                            );
                        } //don't update the concept if the preflabel matches
                        else if ($row[$map['prefLabel']] != $concept->getPrefLabel()) {
                            $concept->updateFromRequest($userId, fixEncoding(rtrim($row[$map['prefLabel']])));
                        }

                        //there needs to be a language to lookup the properties unless it's an objectProperty
                        $rowLanguage = (isset($map['language'])) ? $row[$map['language']] : $concept->getLanguage();

                        foreach ($map as $key => $value) {
                            //we skip because we already did them
                            if (! in_array(
                              $key,
                              array(
                                'uri',
                                'prefLabel',
                                'language'
                              )
                            )
                            ) {
                                $skosId = $skosMap[$key];
                                //check to see if the property already exists
                                $property =
                                  ConceptPropertyPeer::lookupProperty($concept->getId(), $skosId, $rowLanguage);

                                //create a new property for each unmatched column
                                if (! empty($row[$value])) {
                                    if (! $property) {
                                        $property = new ConceptProperty();
                                        $property->setCreatedUserId($userId);
                                        $property->setConceptId($concept->getId());
                                        $property->setCreatedAt($updateTime);
                                        $property->setSkosPropertyId($skosId);
                                    }

                                    if (($row[$value] != $property->getObject()) ||
                                        ($rowLanguage != $property->getLanguage())
                                    ) {
                                        /**
                                         * @todo We need a check here for skos objectproperties and handle differently
                                         **/
                                        if ($rowLanguage != $property->getLanguage()) {
                                            $property->setLanguage($rowLanguage);
                                        }
                                        if ($row[$value] != $property->getObject()) {
                                            $property->setObject(fixEncoding(rtrim($row[$value])));
                                        }
                                        $property->setUpdatedUserId($userId);
                                        $property->setUpdatedAt($updateTime);
                                        $property->save();
                                    }
                                } //the row value is empty
                                else if ($deleteMissing && $property) {
                                    $property->delete();
                                }
                            }
                        }

                        //          else
                        //               lookup and update concept or element
                        //               lookup and update each property
                        //          update the history for each property, action is 'import', should be a single timestamp for all (this should be automatic)
                        //          if 'delete missing properties' is true
                        //               delete each existing, non-required property that wasn't updated by the import
                    }
                } catch(Exception $e) {
                    //          catch
                    //            if there's an error of any kind, write to error log and continue
                    echo "Error on row: " . $rows . ", " . $uri . "\n" . $e . "\n";
                    continue;
                }
                $objects = $vocabObj->countConcepts();
            } else //it's an element set
            {
                $import->setCsvReader($import->file);
                $import->processProlog();
                $import->getDataColumnIds();
                $import->processData();
                //todo: $results should be a class
                $results[$vocabId] = $import->results;
                $bacthId = $import->saveResults($batchId);
            }
            break;
        case "json":
            break;
        case "rdf":
            break;
        case "xml":
            break;
        default:
    }

    /* output to stdout*/
    //          number of objects imported (link to history, filtered on timestamp of import)
    echo " Rows imported: " . count($results[$vocabId]['success']['rows']) . "\n From File:" . $filePath . "\nUse this ID for more in this batch: " . $bacthId;
    //          number of errors (link to error log)

}

function fixEncoding($in_str)
{
    //short circuit for now...
    return $in_str;

    $cur_encoding = mb_detect_encoding($in_str, 'UTF-8, ISO-8859-1', true);
    if ($cur_encoding == "UTF-8" && mb_check_encoding($in_str, "UTF-8")) {
        $newStr = $in_str;
    } else if ($cur_encoding == "ISO-8859-1" && mb_check_encoding($in_str, "ISO-8859-1")) {
        $newStr = mb_convert_encoding($in_str, "UTF-8", "ISO-8859-1");
    } else {
        $newStr = utf8_encode($in_str);
    }

    return $newStr;
}

function slugify($text)
{
    // replace all non letters or digits by -
    $text = preg_replace('/\W+/', '-', $text);

    // trim and lowercase
    $text = strtolower(trim($text, '-'));

    return $text;
}
