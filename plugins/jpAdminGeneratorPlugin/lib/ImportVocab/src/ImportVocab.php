<?php
/**
 * Created by jonphipps, on 2014-01-10 at 6:16 PM
 * for the registry.dev project
 */

namespace ImportVocab;

use Ddeboer\DataImport\ItemConverter\MappingItemConverter;
use Ddeboer\DataImport\Reader\ArrayReader;
use Ddeboer\DataImport\Reader\CsvReader;
use Ddeboer\DataImport\Workflow;
use Ddeboer\DataImport\Writer;
use Ddeboer\DataImport\Filter;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class ImportVocab
 *
 * @package ImportVocab
 */
class ImportVocab {
  const OWL_SAMEAS_PROPERTY_ID = 16;
  /**
   * @var integer
   */
  private $rowCounter;
  /**
   * @var \sfDatabaseManager
   */
  private $database;
  /**
   * @var boolean
   */
  public $deleteMissing;
  /**
   * @var string
   */
  public $file;
  /**
   * @var string
   */
  public $importFolder;
  /**
   * @var array of mapping values
   */
  public $mapping = array();
  /**
   * @var array
   */
  public $prolog = array();
  /**
   * @var CsvReader
   */
  public $reader;
  /**
   * @var array
   */
  public $results = array();
  /**
   * @var string
   */
  public $status;
  /**
   * @var string
   */
  public $type;
  /**
   * @var int
   */
  public $userId;
  /**
   * @var bool
   */
  public $useSameAsForMatching;
  /**
   * @var bool
   */
  public $useCuries;
  /**
   * @var int
   */
  public $vocabId;
  /**
   * @var \Schema
   */
  public $vocabulary;

  /**
   * @param        $type     string (schema|vocab)
   * @param        $file     string
   * @param        $vocabId  integer
   */
  public function __construct($type = '', $file = '', $vocabId = null) {
    $this->type = $type;
    $this->file = $file;
    $this->vocabId = $vocabId;

    //TODO: make prolog array a class
    $this->prolog['columns'] = array();
    $this->prolog['meta'] = array();
    $this->prolog['prefix'] = array();
    $this->prolog['defaults'] = array();

    //these values are set dynamically based on column position rather than actual hard-coded values in processProlog()
    $this->prolog['meta_column'] = ''; //column '0'
    $this->prolog['key_column'] = 'ID'; //column '1'
    $this->prolog['value_column'] = 'owl:sameAs'; //column '2'

    $this->results['errors']['error'] = array();
    $this->results['errors']['warning'] = array();
    $this->results['errors']['notice'] = array();

    $this->results['success']['rows'] = array();

    //TODO: these should get set somewhere
    $this->deleteMissing = false;
    $this->useSameAsForMatching = false;
    $this->useCuries = true;

    //TODO: store and retrieve this map from the database and associate with the agent(master template)/vocab(template)/batch(template)
    $this->mapping = array(
      "rdfs:comment"           => "comment",
      "rdfs:label"             => "label",
      "skos:definition"        => "definition",
      "skos:scopeNote"         => "note",
      "rdfs:domain"            => "domain",
      "rdfs:range"             => "orange",
      "rdfs:subPropertyOf"     => "subPropertyOf",
      "rdfs:subClassOf"        => "subClassOf",
      "reg:type"               => "type",
      "reg:name"               => "name",
      "owl:equivalentProperty" => "equivalentProperty",
      "owl:sameAs"             => "sameAs",
      "owl:inverseOf"          => "inverseOf",
      "skos:altLabel"          => "altLabel",
      "skos:broadMatch"        => "broadMatch",
      "skos:closeMatch"        => "closeMatch",
      "skos:narrowMatch"       => "narrowMatch",
      "ParentProperty"         => "parent_uri",
      "parent_class"           => "parent_class",
      "parent_property"        => "parent_property",
      "reg:status"             => "status"
    );
  }

  public function  setVocabularyParams() {
    //use the prolog to look up correct resources in the database
    $criteria = new \Criteria();
    $criteria->add(\SchemaPeer::ID, $this->vocabId);
    /** @var $vocabulary \Schema */
    $vocabulary = \SchemaPeer::doSelectOne($criteria);
    if (!$vocabulary) {
      //TODO: turn this into a real error message and exit grcefully
      exit("No vocab!!!!!");
    }
    $this->vocabulary = $vocabulary;

    //if we didn't set it from the constructor we set default status from the vocab
    if (!$this->status) {
      $this->prolog['defaults']['statusId'] = $this->getStatusId($vocabulary->getStatusId());
    }
    else {
      $this->prolog['defaults']['statusId'] = $this->status;
    }

    //if the prolog never set the default language from the spreadsheet, set it here
    if (!isset($this->prolog['defaults']['lang'])) {
      $this->prolog['defaults']['lang'] = $vocabulary->getLanguage();
    }

    //if it hasn't been set already, set the userId from the vocabulary (which does a little bit more work)
    if (!$this->userId) {
      $this->setUserId();
    }
  }

  public function  setUserId($userId = null) {
    if ($userId) {
      $this->userId = $userId;
    }
    else {
      $criteria = new \Criteria();
      $criteria->add(\SchemaHasUserPeer::SCHEMA_ID, $this->vocabId);
      $criteria->add(\SchemaHasUserPeer::IS_ADMIN_FOR, true);
      $users = \SchemaHasUserPeer::doSelectJoinUser($criteria);
      if (!$users) {
        //TODO: turn this into a real error message and exit grcefully
        exit("No user ID found!!!!!");
      }

      /** @var $schemaUser \SchemaHasUser */
      $schemaUser = $users[0];
      $this->userId = $schemaUser->getUser()->getId();
    }
  }

  public function setCsvReader($file) {
    $path = $this->importFolder . $file;
    if (is_readable($path)) {
      $splFile = new \SplFileObject($path);
      $this->reader = new CsvReader($splFile, ",");
      $this->reader->setHeaderRowNumber(0, CsvReader::DUPLICATE_HEADERS_MERGE);
      return $this->reader;
    }
    else {
      return false;
    }
  }

  public function processProlog() {
    $testArray = array();
    $this->setCsvReader($this->file);
    //set the prolog columns
    //Note: this makes a valid assumption about the content of the first 3 columns in a file containing an inline prolog
    $this->prolog['meta_column'] = $this->reader->getColumnHeaders()[0];
    $this->prolog['key_column'] = $this->reader->getColumnHeaders()[1];
    $this->prolog['value_column'] = $this->reader->getColumnHeaders()[2];

    $workflow = new Workflow($this->reader);
    $output = new ConsoleOutput();
    // Don’t import the non-metadata
    $filter = new Filter\CallbackFilter(
      function ($row) {
        $i = trim($row[$this->prolog['meta_column']]);
        return !empty($i);
      }
    );
    /** @var $filter Filter\CallbackFilter */
    $workflow->addFilter($filter);
    $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
    $workflow->addWriter(
      new Writer\CallbackWriter(
        function ($row) {
          //if the columns array is empty, set it from the headers
//                     if (! count($this->prolog['columns'])) {
//                         foreach ($row as $key => $column) {
//                             $this->prolog['columns'][$key]         = array();
//                             $this->prolog['columns'][$key]['lang'] = array();
//                             $this->prolog['columns'][$key]['type'] = array();
//                         }
//                     }
          //if this is meta store it in the array
          $meta = mb_strtolower(trim($row[$this->prolog['meta_column']]));
          switch ($meta) {
            case "uri":
            case "lang":
            case "type":
              //$this->prolog['columns'][$meta] = array();
              foreach ($row as $column => $value) {
                $mapped = empty($this->mapping[$column]) ? "" : $this->mapping[$column];
                if ('' != $mapped) {
                  $this->prolog['columns'][$mapped][$meta] = $value;
                }
                elseif ('uri' != $meta) {
                  $this->prolog['defaults'][$meta] = $row[$this->prolog['key_column']];
                }
              }
              break;
            case "meta":
            case "prefix":
              $this->prolog[$meta][$row[$this->prolog['key_column']]] = $row[$this->prolog['value_column']];
              break;
            default:
          }

          //if there's an error store it in the error array
          //if the error is fatal throw an exception
          //var_dump($this->prolog);
        }
      )
    );
    //$workflow->addWriter(new Writer\ArrayWriter($testArray));
    $workflow->process();
    //add the token and the base_domin to the prefixes
    $this->prolog['prefix'][$this->prolog['meta']['token']] = $this->prolog['meta']['base_domain'];
    $this->status = $this->prolog['meta']['status_id'];
    $this->userId = $this->prolog['meta']['user_id'];
    //use the prolog to configure namespaces, look up correct resources in the database
    //store the row number of the first non-meta line

  }

  public function getDataColumnIds() {
    //use the prolog to look up correct resources in the database
    $criteria = new \Criteria();
    $criteria->add(\ProfilePropertyPeer::PROFILE_ID, 1);
    $this->prolog['profileProperties'] = \ProfilePropertyPeer::doSelect($criteria);
    //get the curies
    /** @var $property \ProfileProperty */
    foreach ($this->prolog['profileProperties'] as $property) {
      $dbKeys[$property->getUri()] = $property->getId();
    }
    //get the iris
    foreach ($this->prolog['columns'] as $key => &$column) {
      if (!is_array($column['uri'])) {
        $column['id'] = $this->setColumnId($column['uri'], $dbKeys);
        $column['iri'] = $this->setColumnIri($column['uri'], $key);
      }
      else {
        $count = count($column['uri']);
        for ($I = 0; $I < $count; $I++) {
          $column['id'][$I] = $this->setColumnId($column['uri'][$I], $dbKeys);
          $column['iri'][$I] = $this->setColumnIri($column['uri'][$I], $key);
        }
      }
    }
  }

  public function getStatusId($status) {
    if (is_integer($status)) {
      return $status;
    }
    //is it a known text string
    $c = new \Criteria();
    $c->add(\StatusPeer::DISPLAY_NAME, $status);
    $statusObj = \StatusPeer::doSelectOne($c);
    if (isset($statusObj)) {
      return $statusObj->getId();
    }
    else {
      return false;
    }
  }

  public function processParents() {
    //spin through file again, now that the database is populated, and cleanup all of the parental relationships
    $this->setVocabularyParams();
    $reader = new ArrayReader($this->results['success']['rows']);
    $workflow = new Workflow($reader);
    $output = new ConsoleOutput();
    $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
    //add a database writer
    $workflow->addWriter(
      new Writer\CallbackWriter(
        function ($row) {
          //lookup the property
          $property = \SchemaPropertyPeer::retrieveByPK($row['id']);
          $updateTime = $property->getUpdatedAt();
          if ($property and $property->getParentUri()) {
            //usesameasformatch is set then update the URIS
            if ($this->useSameAsForMatching) {
              //lookup URI using sameas value
              $subproperty = \SchemaPropertyElementPeer::lookupElement(
                '',
                self::OWL_SAMEAS_PROPERTY_ID,
                $property->getParentUri()
              );
              if ($subproperty) {
                //get the uri of the parent property
                $parentProperty = $subproperty->getSchemaPropertyRelatedBySchemaPropertyId();
              }
            }
            else {
              $parentProperty = \SchemaPropertyPeer::retrieveByUri($property->getParentUri());
            }
            if ($parentProperty) {
              //get the uri of the parent property
              //update the parentpropertyuri
              if (!$this->useCuries) {
                $property->setParentUri($parentProperty->getUri());
              }
              //update the related schema id
              $property->setSchemaPropertyRelatedByIsSubpropertyOf($parentProperty);
              $property->setUpdatedAt($updateTime);
              $property->save();
            }
            else {
              //found a property, but didn't find a parent
              //record it if we should have found one
            }
            //update the statements
          }
          else {
            //we have an error!!!! log it
            $this->results['errors']['notice']['rows'][$this->rowCounter] = "some error in this row";
          }

          //now do the individual added statements
          $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyIdJoinProfileProperty();
          /** @var \SchemaPropertyElement $element */
          foreach ($elements as $element) {
            $profileProperty = $element->getProfileProperty();
            if (! $profileProperty->getHasLanguage() && 'reg:uri' != $profileProperty->getUri()) {
                $relatedProperty = \SchemaPropertyPeer::retrieveByUri($element->getObject());
                if ($relatedProperty)
                {
                  $element->setRelatedSchemaPropertyId($relatedProperty->getId());
                  $element->setUpdatedAt($updateTime);
                  $element->save();
              }
            }
          }
        }
      )
    );
    $workflow->process();
    //use the prolog to configure namespaces, look up correct resources in the database
    //store the row number of the first non-meta line

  }

  public function processData() {
    $this->setVocabularyParams();
    $workflow = new Workflow($this->reader);
    $output = new ConsoleOutput();
    // Don’t import the non-metadata
    $filter = new Filter\CallbackFilter(
      function ($row) {
        return !trim($row[$this->prolog['meta_column']]);
      }
    );
    $converter = new MappingItemConverter($this->mapping);
    $workflow->addItemConverter($converter);
    /** @var $filter Filter\CallbackFilter */
    $workflow->addFilter($filter);
    $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
    //add a database writer
    $workflow->addWriter(
      new Writer\CallbackWriter(
        function ($row) {
          //build an array of references
          //use the prefix to build the FQURI in the references
          //if it's a bad prefix, throw the cell away and report it as an error
          //if it's a required property, fail the row and report the error

          //the type is stored in reg:type.
          //if it's a subproperty and there's no parentproperty, it's an error
          //if it's a property and there's a parentproperty, it's an error

          //build the URI from the vocabulary base domain and the ID column
          //$record->setLabel($row);

          /**@todo map should come from linkage section and be stored in the registry
          &about,&type,&status,&equivalent,&label@en-US,&altLabel@en-US,&definition@en-US,&domain,&range,&category,&phase,&notes,&row_id */

          //executeImport:
          //    serialize the column map
          $results = array();

          try {
            //set the row counter

            $rowUri = $row[$this->prolog['key_column']];
            //lookup the URI (or the OMR ID if available) for a match
            //There always has to be a URI on either update or create
            //If there's a prolog, this will be the 'key_column'
            if (empty($rowUri)) {
              throw new \Exception('Missing URI for row: ' . $this->rowCounter);
            }

            if ($this->useCuries) {
              $uri = $this->getFqn($rowUri);
            }
            else {
              $uri = $this->vocabulary->getBaseDomain() . $rowUri;
            }
            $skipMap = array();
            $property = \SchemaPropertyPeer::retrieveByUri($uri);
            $updateTime = time();

            $rowLanguage = $this->prolog['defaults']['lang'];

            if (isset($row['status'])) {
              $rowStatusId = $this->getStatusId($row['status']);
            }
            else {
              $rowStatusId = $this->prolog['defaults']['statusId'];
            }

            $results['status'] = 'modified';
            $skipMap[] = "uri";
            $skipMap[] = "meta";

            if (!$property) {
              //          create a new property
              $results['status'] = 'created';
              /** @var \SchemaProperty * */
              $property = new \SchemaProperty;
              $property->setSchema($this->vocabulary);
              $property->setUri($uri);
              $property->setCreatedUserId($this->userId);
              $property->setCreatedAt($updateTime);
            }

            if ($property->getLanguage() !== $rowLanguage) {
              $property->setLanguage($rowLanguage);
            }
            $property->setStatusId($rowStatusId);
            $property->setUpdatedUserId($this->userId);
            $property->setUpdatedAt($updateTime);

            /** @TODO: match the language */

            foreach (array_keys($row) as $key) {
              $value = $row[$key];
              if (empty($value)) {
                continue;
              }
              //do the specials
              if ($key === 'parent_class' && isset($row['type']) && 'subclass' === strtolower($row['type'])) {
                $property->setParentUri($this->getFqn($value));
                $skipMap[] = $key;
                continue;
              }
              if ($key === 'parent_property' && isset($row['type']) && 'subproperty' === strtolower($row['type'])) {
                $property->setParentUri($this->getFqn($value));
                $skipMap[] = $key;
                continue;
              }
              //do the literals
              if (!empty($value) && in_array($key, array('domain', 'orange'))) {
                $skipMap[] = self::setPropertyValue($value, $property, $key, false, true);
                continue;
              }
              //do the nonliterals
              if (in_array($key, array('name', 'label', 'definition', 'comment', 'note'))) {
                $skipMap[] = self::setPropertyValue($value, $property, $key, true, true );
              }
            }

            if (empty($row["name"]) and !empty($row["label"])) {
              $property->setName(slugify($row["label"]));
            }

            $lowType = strtolower($row["type"]);
            if (isset($row["type"])) {
              $skipMap[] = "type";
              if ($property->getType() != $lowType) {
                $property->settype($lowType);
              }
            }

            //make sure this scrip has permission to write to php default session storage - /var/lib/php/session
            $property->saveSchemaProperty($this->userId);
            $propertyId = $property->getId();

            $results['id'] = $propertyId;
            $results['uri'] = $property->getUri();
            unset($property);

            //add the identifier column to the skip map
            $skipMap[] = $this->prolog['key_column'];
            $elements = \SchemaPropertyElementPeer::getNonSchemaPropertyElements($results['id']);
            $results['statements'] = array();

            /** @todo get the current list of non-form-editor statements, indexed by full property, object, language */
            /** @todo get the current list of non-form-editor statements, indexed by just the property */
            //use these indexes below to figure out whether the statement needs to be updated

            $StatementCounter = array();
            foreach (array_keys($row) as $key) {
              if (is_array($row[$key])) {
                $counter = 0;
                foreach ($row[$key] as $value) {
                  //we skip because we already did them
                  if (in_array($key . $counter, $skipMap) || empty($value)) {
                    $counter++;
                    continue;
                  }
                  $cellLanguage = $this->getColLangType($key, 'lang', false, $counter);
                  //data type must be explicit
                  $cellType = $this->getColLangType($key, 'type', false, $counter);

                  $results['statements'][] = self::SetPropertyElement($key, $value, $propertyId, $updateTime, $rowStatusId, $cellLanguage, $cellType);
                  $counter++;
                }
              }
              else {
                $value = $row[$key];
                //we skip because we already did them
                if (in_array($key, $skipMap) || empty($value)) {
                  continue;
                }
                $cellLanguage = $this->getColLangType($key, 'lang', false);
                //data type must be explicit
                $cellType = $this->getColLangType($key, 'type', false);
                $results['statements'][] = self::SetPropertyElement($key, $value, $propertyId, $updateTime, $rowStatusId, $cellLanguage, $cellType);
              }
            }

            $this->results['success']['rows'][] = $results;
          }
          catch(\Exception $e) {
            //            if there's an error of any kind, write to error log and continue
            echo "Error on row: " . $this->rowCounter . ", " . $uri . "\n" . $e . "\n";
          }
          $objects = $this->vocabulary->countSchemaPropertys();

          /* @todo if there's an error store it in the error array
              if the error is fatal throw an exception */

          //var_dump($row);
        }
      )
    );

    /** @todo we need to make a second pass through to delete missing rows
     * for each schemaproperty in the database
     *   match to a row in the csv
     *   if the row value is empty and $this->deleteMissing
     *     delete the entire schemaproperty
     */

    $workflow->process();

    /** @TODO need to make a second pass through to lookup and set $element->related_schema_property_id */
    $this->processParents();
    //use the prolog to configure namespaces, look up correct resources in the database
    //store the row number of the first non-meta line

  }

  /**
   * @param $column
   * @param string $type
   * @param bool $noDefault
   * @param bool $counter
   * @return bool
   */
  private function getColLangType($column, $type = 'lang', $noDefault = false, $counter = false) {
    //if the column language or type is empty, get the row language or type

    if (!empty($this->prolog['columns'][$column][$type])) {
      if (is_array($this->prolog['columns'][$column][$type])) {
        return $this->prolog['columns'][$column][$type][$counter];
      }
      else {
        return $this->prolog['columns'][$column][$type];
      }
    }
    else if (!$noDefault) {
      return $this->prolog['defaults'][$type];
    }
    return false;
  }

  private function getFqn($uri) {
    preg_match('/^(.*)\:/i', $uri, $matches);
    if (isset($matches[0])) {
      $pattern = '/^' . $matches[0] . '/';

      if (isset($this->prolog['prefix'][$matches[1]])) {
        return preg_replace($pattern, $this->prolog['prefix'][$matches[1]], $uri);
      }
    }
    //todo we should maybe do something a little different and return an error
    return $uri;
  }

  public function saveResults($batchId = '') {
    $batchLog = new \BatchPeer();
    if ($batchId) {
      $criteria = new \Criteria();
      $criteria->add(\BatchPeer::ID, $batchId);
      /** @var $batch \Batch */
      $batch = $batchLog::doSelectOne($criteria);
    }

    if (empty($batch)) {
      $batch = $batchLog->createBatchRecord(
        time(),
        "manual import from file",
        "schema",
        "manual import (testing)",
        "import",
        $this->vocabId,
        $this->vocabulary->getUri()
      );
    }
    //there's a bunch more stuff we should save here
    $import = new \FileImportHistory();
    $import->setFileName($this->file);
    $import->setFileType($this->type);
    $import->setMap(serialize($this->mapping));
    $import->setResults(serialize($this->results));
    $import->setUserId($this->userId);
    $import->setSchemaId($this->vocabId);
    $import->setBatch($batch);

    //$import->setBatch($batch);
    $import->save();

    return $batch->getId();
  }

  /**
   * @param $uri
   * @param $dbKeys
   * @return mixed
   */
  public function setColumnId(&$uri, $dbKeys) {
    $value = false;
    if (!empty($uri)) {
      if (!empty($dbKeys[$uri])) {
        $value = $dbKeys[$uri];
      }
    }
    return $value;
  }

  /**
   * @param $uri
   * @param $key
   * @return mixed
   */
  private function setColumnIri($uri, $key) {
    $value = false;
    preg_match('/^(.*)\:/i', $uri, $matches);
    if (isset($matches[0])) {
      $pattern = '/^' . $matches[0] . '/';
      if (isset($this->prolog['prefix'][$matches[1]])) {
        $value = preg_replace($pattern, $this->prolog['prefix'][$matches[1]], $key);
      }
      else {
        $this->results['errors']['error'][] = [
                                                'action' => "getIri",
                                                'error'  => "Could not find namespace for prefix used in headers: " . $matches[1]
                                              ] . "in column '" . $key . "'";
      }
    }
    return $value;
  }

  /**
   * @param $value
   * @param \SchemaProperty $property
   * @param $key
   * @param $isLiteral
   * @param $onlyFirst
   * @return string the key that was processed
   */
  private function setPropertyValue($value, $property, $key, $isLiteral, $onlyFirst = false) {
    if (is_array($value)) {
      if ($onlyFirst) {
        //only take the first one here
        $value = $isLiteral ? $value[0] : $this->getFqn($value[0]);
        $property->setByName(ucfirst($key), $value);
        return $key . "0";
      }
      else {
        foreach ($value as $unit) {
          $unit = $isLiteral ? $unit : $this->getFqn($unit);
          $property->setByName(ucfirst($key), $unit);
        }
      }
    }
    else {
      $value = $isLiteral ? $value : $this->getFqn($value);
      $property->setByName(ucfirst($key), $value);
    }
    return $key;
  }

  /**
   * @param $key
   * @param $value
   * @param $propertyId
   * @param $updateTime
   * @param $rowStatusId
   * @param $cellLanguage
   * @param $cellType
   * @return array $results
   * @throws \PropelException
   */
  private function SetPropertyElement($key, $value, $propertyId, $updateTime, $rowStatusId, $cellLanguage, $cellType) {
    $profilePropertyId = $this->prolog['columns'][$key]['id'];

    //check to see if the property already exists
    //note that this also checks the object value as well, so there's no way to update or delete an existing triple
    //the sheet would have to contain the identifier for the triple

    //actually there is. We look for exact matches and skip the update of an exact match,
    //but then we look at just the old properties that are left -- the ones where the property matches but the object doesn't
    //and we update those. If we have any properties left after that, we add them as new.
    //We need to add an instruction to the spreadsheet to treat an empty property cell as a skip or a delete
    //and if an empty cell means delete, then we delete those

    //get the language for this thing
    //if there's a prolog set for the language for this column, use it
    //use the default for the import (already set above)
    //fall back to the default language of the vocabulary

    //get the fqn if using curies
    if ($cellType and $this->useCuries) {
      $value = $this->getFqn($value);
    }

    $StatementCounter['status'] = 'skipped';

    /** @var $element \SchemaPropertyElement */
    $element = \SchemaPropertyElementPeer::lookupElement(
      $propertyId,
      $profilePropertyId,
      $value,
      $cellLanguage
    );

    //create a new propertyelement for each unmatched column
    //we didn't find an existing element, make a new one
    if (!$element) {
      $element = new \SchemaPropertyElement;
      $element->setCreatedUserId($this->userId);
      $element->setCreatedAt($updateTime);
      $element->setProfilePropertyId($profilePropertyId);
      $element->setSchemaPropertyId($propertyId);
      $StatementCounter['status'] = 'created';
    }

    if (($value != $element->getObject())
        || ($cellLanguage != $element->getLanguage())
    ) {
      /**
       * @todo We need a check here for objectproperties and handle differently
       *       if it's a URI, and it uses namespaces, and we have the namespace, do the substitution
       **/
      if (!$cellType and $cellLanguage) {
        if ($cellLanguage != $element->getLanguage()) {
          $element->setLanguage($cellLanguage);
        }
      }

      if ($value != $element->getObject()) {
        $element->setObject($value);
      }

      $element->setUpdatedUserId($this->userId);
      $element->setUpdatedAt($updateTime);
      $element->setStatusId($rowStatusId);

      $element->save();

      if ($StatementCounter['status'] != 'created') {
        $StatementCounter['status'] = 'modified';
      }
    }

    if (is_array($element->getProfilePropertyId())) {
      $profilePropertyId = $element->getProfilePropertyId()[0];
    }
    else {
      $profilePropertyId = $element->getProfilePropertyId();
    }
    /** @var \ProfileProperty $profileProperty */
    $profileProperty = $this->prolog['profileProperties'][$profilePropertyId];
    $StatementCounter['column'] = $key;
    $StatementCounter['id'] = $element->getId();
    $StatementCounter['propertyId'] = $element->getProfilePropertyId();
    $StatementCounter['object'] = $element->getObject();
    $StatementCounter['type'] = $cellType;
    $StatementCounter['language'] = $cellLanguage;

    unset($element);
    return $StatementCounter;
  }

}
