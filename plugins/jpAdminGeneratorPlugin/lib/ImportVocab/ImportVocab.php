<?php
/**
 * Created by jonphipps, on 2014-01-10 at 6:16 PM
 * for the registry.dev project
 */

namespace ImportVocab;

use Ddeboer\DataImport\Reader\ArrayReader;
use Ddeboer\DataImport\Reader\CsvReader;
use Ddeboer\DataImport\Workflow;
use Ddeboer\DataImport\Writer;
use Ddeboer\DataImport\Filter;
use Symfony\Component\Console\Output\ConsoleOutput;
use Ddeboer\DataImport\Filter\ValidatorFilter;

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
  public $prologRowCount;
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
   * @var MappingItemConverter
   */
  public $mapping;
  /**
   * @var array of column Reverse mapping values
   */
  public $columnMap = array();
  /**
   * @var array
   */
  public $prolog = array ();
  /**
   * @var CsvReader
   */
  public $reader;
  /**
   * @var array
   */
  public $results = array ();
  /** @var \Ddeboer\DataImport\Result */
  public $processPrologResults;
  /** @var \Ddeboer\DataImport\Result */
  public $DataWorkflowResults;
  /** @var \Ddeboer\DataImport\Result */
  public $ParentWorkflowResults;
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
  /** @var \Schema */
  public $vocabulary;
  /** @var int */
  public $importId;
  /** @var  \ProfileProperty[] */
  public $profileProperties;
  public $processPrologResult;

  /**
   * @param $type     string (schema|vocab)
   * @param $file     string
   * @param $vocabId  integer
   */
  public function __construct($type = '', $file = '', $vocabId = null)
  {

    //TODO: Major - process statements first and build elements from the statements, based on the profile. Even better, make elements virtual

    $this->type = $type;
    $this->file = $file;
    $this->vocabId = $vocabId;

    //TODO: make prolog array a class
    $this->prolog['columns'] = array();
    $this->prolog['meta'] = array();
    $this->prolog['prefix'] = array();
    $this->prolog['defaults'] = array();

    $this->results['errors']['error'] = array();
    $this->results['errors']['warning'] = array();
    $this->results['errors']['notice'] = array();

    $this->results['success']['rows'] = array();

    //TODO: these should get set somewhere
    $this->deleteMissing = false;
    $this->useSameAsForMatching = false;
    $this->useCuries = true;

    //TODO: store and retrieve this map from the database and associate with the agent(master template)/vocab(template)/batch(template)
    $this->setVocabularyParams();
    $this->mapping = $this->makeMap();
  }

  public function makeMap()
  {
    $profileProperties = $this->vocabulary->getAllProfileProperties(true);
    $languages = $this->vocabulary->getLanguages();
    $map = new MappingItemConverter();
    foreach ($profileProperties as $property) {
      /** @var \ProfileProperty $profile */
      $profile = $property['profile'];
      $this->profileProperties[$profile->getId()] = $profile;
      if (isset($property['languages'])) {
        foreach ($languages as $language) {
          {
            $map->addMapping($profile->getLabel() . " (" . $language . ")",  $property['id'] . " (" . $language . ")");
            $this->columnMap[$property['id'] . " (" . $language . ")"] = $profile->getLabel() . " (" . $language . ")";
          }
        }
      } else {
        $map->addMapping($profile->getLabel(), $property['id']);
        $this->columnMap[$property['id']] = $profile->getLabel();
        }
    }
    return $map;
  }


  public function  setVocabularyParams() {
    //use the prolog to look up correct resources in the database
    $criteria = new \Criteria();
    $criteria->add(\SchemaPeer::ID, $this->vocabId);
    /** @var $vocabulary \Schema */
    $vocabulary = \SchemaPeer::doSelectOne($criteria);
    if (!$vocabulary) {
      //TODO: turn this into a real error message and exit gracefully
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

  public function setCsvReader( $file )
  {
    if ( isset( $this->importFolder ) ) {
      $path = $this->importFolder . $file;
    } else {
      $path = $file;
    }
    if ( is_readable( $path ) ) {
      $splFile = new \SplFileObject( $path );
      $this->reader = new CsvReader( $splFile, "," );
      $this->reader->setHeaderRowNumber( 0, CsvReader::DUPLICATE_HEADERS_MERGE );

      return $this->reader;
    } else {
      return false;
    }
  }

  public function processProlog() {
    $testArray = array();
    $canRead = $this->setCsvReader($this->file);
    if ( !$canRead) {
      return false;
    }

    $workflow = new Workflow($this->reader);
    $output = new ConsoleOutput();
    // Don’t import the non-metadata
    $filter = new Filter\CallbackFilter(
      function ($row) {
        $i = trim($row['reg_id']);
        return !empty($i);
      }
    );
    /** @var $filter Filter\CallbackFilter */
    $workflow->addFilter($filter);
    $workflow->addItemConverter($this->mapping);
    $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
    $workflow->addWriter(
      new Writer\CallbackWriter(
        function ($row) {

          $this->setPrologColumns();

          //if the columns array is empty, set it from the headers
//                     if (! count($this->prolog['columns'])) {
//                         foreach ($row as $key => $column) {
//                             $this->prolog['columns'][$key]         = array();
//                             $this->prolog['columns'][$key]['lang'] = array();
//                             $this->prolog['columns'][$key]['type'] = array();
//                         }
//                     }
          //if this is meta store it in the array
          $meta = mb_strtolower(trim($row['reg_id']));
          switch ($meta) {
            case "uri":
            case "lang":
            case "type":
              foreach ($row as $column => $value) {
                $this->prolog[ 'columns' ][ $column ][ $meta ] = $value;
                if ('uri' != $meta) {
                  $this->prolog[ 'defaults' ][ $meta ] = $row[ $this->prolog[ 'key_column' ] ];
                }
              }
              break;
            case "meta":
            case "prefix":
              $this->prolog[ $meta ][ $row[ $this->prolog[ 'key_column' ] ] ] = $row[ $this->prolog[ 'value_column' ] ];
              break;
            default:
          }

          //if there's an error store it in the error array
          //if the error is fatal throw an exception
        }
      )
    );
    //$workflow->addWriter(new Writer\ArrayWriter($testArray));
    $this->processPrologResults = $workflow->process();
    //add the token and the base_domain to the prefixes
    if (!is_array($this->prolog[ 'meta' ][ 'token' ])) {
      if ( ! array_key_exists($this->prolog['meta']['token'], $this->prolog['prefix'])) {
        $this->prolog['prefix'][$this->prolog['meta']['token']] = $this->prolog['meta']['base_domain'];
      }
    }
    if (isset($this->prolog['meta']['status_id'])) {
      $this->status = $this->prolog['meta']['status_id'];
    }
    if (isset($this->prolog['meta']['user_id'])) {
      $this->userId = $this->prolog['meta']['user_id'];
    }
    //use the prolog to configure namespaces, look up correct resources in the database
    $this->getDataColumnIds();
    //store the row number of the first non-meta line
    $this->prologRowCount = $this->reader->count();

    return $this->prolog;

  }

  public function getDataColumnIds()
  {
    //use the prolog to look up correct resources in the database
    $dbKeys = [];
    /** @var $property \ProfileProperty */
    foreach ($this->profileProperties as $property) {
      $uri = $property->getUri();
      $dbKeys[$uri]['id'] = $property->getId();
      $dbKeys[$uri]['property'] = $property;
    }
    //get the iris
    foreach ($this->prolog['columns'] as $key => &$column) {
        if ( ! is_array($column['uri'])) {
          if (isset($dbKeys[$column['uri']])) {
            $column['id'] = $dbKeys[$column['uri']]['id'];
            if (isset($column['uri']) and isset($dbKeys[$column['uri']]['property'])
            ) {
              $property = $dbKeys[$column['uri']]['property'];
              /** @var \ProfileProperty $property */
              $column['property'] = $property;
              $column['name'] = $property->getName();
            }
          }
        } else {
          $count = count($column['uri']);
          for ($I = 0; $I < $count; $I ++) {
            if (isset($dbKeys[$column['uri'][$I]])) {
            $column['id'][$I] = $dbKeys[$column['uri'][$I]]['id'];
            if (isset($column['uri'][$I]) and isset($dbKeys[$column['uri'][$I]]['property'])) {
              $property = $dbKeys[$column['uri'][$I]]['property'];
              /** @var \ProfileProperty $property */
              $column['property'] = $property;
              $column['name'] = $property->getName();
            }
          }
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

  /**
   * spin through file again, now that the database is populated, and cleanup all of the parental relationships

   * @param int $schemaId
   *
   * @throws \Ddeboer\DataImport\Exception\ExceptionInterface
   * @throws \Exception
     */
    public function processParents($schemaId) {
      return;
    //get a list of all of the properties
      //foreach PropertyElement
      //if it's a 6 or 9 it has a reciprocal
      // check if the reciprocal exists
      // see if it has a related SchemaPropertyId
      //if it has an existing ID, make sure it can be retrieved
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
            $this->results['errors']['notice']['rows'][$this->rowCounter] = 'some error in this row';
          }

          //now do the individual added statements
          $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyIdJoinProfileProperty();
          /** @var \SchemaPropertyElement $element */
          foreach ($elements as $element) {
            $profileProperty = $element->getProfileProperty();
            if (! $profileProperty->getHasLanguage() && 'reg:uri' !== $profileProperty->getUri()) {
                $relatedProperty = \SchemaPropertyPeer::retrieveByUri($element->getObject());
                if ($relatedProperty and $element->getRelatedSchemaPropertyId() != $relatedProperty->getId())
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
    $results =$workflow->process();
    $this->ParentWorkflowResults = $results;
    //return $results;
    //use the prolog to configure namespaces, look up correct resources in the database
    //store the row number of the first non-meta line

  }

  public function processData()
  {
    $workflow = new Workflow($this->reader);
    $output = new ConsoleOutput();
    // Don’t import the non-metadata
    $filter = new Filter\CallbackFilter(function ($row) {
      if(is_numeric($row['reg_id'])) return true;
      if ( ! trim($row['reg_id'])) {
        foreach ($row as $item) {
          if ( ! is_array($item)) {
            if (trim($item)) {
              return true;
            }
          } else {
            foreach ($item as $foo) {
              if (trim($foo)) {
                return true;
              }
            }
          }
        }
      }

      return false;
    });
    $workflow->addItemConverter($this->mapping);
    /** @var $filter Filter\CallbackFilter */
    $workflow->addFilter($filter);
    $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
    //add a database writer
    $workflow->addWriter(new Writer\CallbackWriter(function ($row) {
      $this->setPrologColumns();

      if ( ! isset($row[14])) {
        $row[14] = $this->prolog['defaults']['statusId'];
      }
      $rowStatus = $row[14];
      $language = $this->prolog['defaults']['lang'];

      foreach ($row as $key => &$element) {
        $this->updateRowUris($key, $element);
      }

      $uri = $row[13];

      if (empty($row['reg_id'])) {
        //check for an existing property by uri
        $property = \SchemaPropertyPeer::retrieveByUri($uri);
        if (!$property) { //it's a new property
          $property = new \SchemaProperty();
          $property->setSchemaId($this->vocabId);
          $property->setCreatedUserId($this->userId);
          $property->setUpdatedUserId($this->userId);
          $property->setStatusId($rowStatus);
          $property->setLanguage($language);
          $property->save();
        }
      } else {
        $propertyId = $row['reg_id'];
        $property = \SchemaPropertyPeer::retrieveByPK($propertyId);
        unset($row['reg_id']);
      }
      if ($property) {
        if (8 == $rowStatus) {
          //it's been deprecated and we don't do anything else
          $property->setStatusId($rowStatus);
        } else {
          $dbElements = $property->getElementsForImport($this->profileProperties);
          foreach ($dbElements as $key => $dbElement) {
            $rowElement = isset($row[$key]) ? $row[$key] : null;
            if (is_array($rowElement)) {
              foreach ($rowElement as &$element) {
                $this->updateElement($element, $dbElement, $property);
              }
            } else {
              $this->updateElement($rowElement, $dbElement, $property);
            }
          }
          foreach ($row as $key => $value) {
            $dbElement = isset($dbElements[$key]) ? $dbElements[$key] : null;
            if ( ! empty($this->prolog['columns'][$key]['property'])) {
              $profileProperty = $this->prolog['columns'][$key]['property'];
              if (is_array($value)) {
                foreach ($value as &$oneValue) {
                  $language = $this->prolog['columns'][$key]['lang'][0];
                  $this->upsertElementFromRow($dbElement, $oneValue, $rowStatus, $property, $profileProperty,
                        $language);
                }
              } else {
                $language = $this->prolog['columns'][$key]['lang'];
                $this->upsertElementFromRow($dbElement, $value, $rowStatus, $property, $profileProperty, $language);
              }
            }
          }
        }

        $affectedRows = $property->save();
      }

      return;
      //build an array of references
      $newElements = [];
      $newElements2 = [];
      if ( ! isset($row['status'])) {
        $row[14] = $this->prolog['defaults']['statusId'];
      }
      foreach ($row as $key => $element) {
        //skip it there's no property id
        $columnKey = $this->prolog['columns'][$key];
        if ( ! $columnKey['id']) {
          continue;
        }

        if ( ! empty($columnKey['type']) and $this->useCuries) {
          $element = $this->getFqn($element);
        }

        $key2 = md5(strval($columnKey['id']) . strval($columnKey['lang']) . $element);
        $newElements[$key2] = [];
        $newElements[$key2] += $columnKey;
        $newElements[$key2]['val'] = $element;
        /** @var \ProfileProperty $profileProperty */
        if (isset($columnKey['property'])) {
          $profileProperty = $columnKey['property'];
          $var = array(
                'matchkey' => $key2,
                'val'      => $newElements[$key2],
          );
          if (isset($profileProperty) and $profileProperty->getHasLanguage()) {
            $newElements2[$columnKey['id']][$columnKey['lang']][] = $var;
          } else {
            $newElements2[$columnKey['id']][] = $var;
          }
        }
      }
      if ( ! empty($row['reg_id'])) {
        $property = \SchemaPropertyPeer::retrieveByPK($row['reg_id']);
        if ($property) {
          $dbElements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyIdJoinProfileProperty();
          $dbElements2 = [];
          /** @var \SchemaPropertyElement $dbElement */
          foreach ($dbElements as $dbElement) {
            if ($dbElement->getProfileProperty()->getHasLanguage()) {
              $dbElements2[$dbElement->getProfilePropertyId()][$dbElement->getLanguage()][] = &$dbElement;
            } else {
              $dbElements2[$dbElement->getProfilePropertyId()][] = &$dbElement;
            }
          }

          /** @var \SchemaPropertyElement $element */
          foreach ($dbElements as $element) {
            $language = $element->getLanguage();
            $profilePropertyId = $element->getProfilePropertyId();
            $key = md5(strval($profilePropertyId) . strval($language) . $element->getObject());
            //if the newelement key matches then
            if (isset($newElements[$key])) {
              if ($element->getProfileProperty()->getHasLanguage()) {
                $newElements2Array = $newElements2[$profilePropertyId][$language];
              } else {
                $newElements2Array = $newElements2[$profilePropertyId];
              }
              $count = count($newElements2Array);
              for ($I = 0; $I < $count; $I ++) {
                if ($newElements2Array[$I]['matchkey'] == $key) {
                  unset($newElements2Array[$I]);
                }
              }
              unset($newElements[$key]);
              $element->importStatus = 'match';
              continue;
            } else {
              if ($element->getProfileProperty()->getHasLanguage()) {
                if (isset($newElements2[$profilePropertyId][$language])) {
                  $count = count($newElements2[$profilePropertyId][$language]);
                  for ($I = 0; $I < $count; $I ++) {
                    if ($newElements2[$profilePropertyId][$language][$I]['val']['val'] == $element->getObject()) {
                      unset($newElements2[$profilePropertyId][$language][$I]);
                      $element->importStatus = 'match';
                      if ( ! count($newElements2[$profilePropertyId][$language])) {
                        unset($newElements2[$profilePropertyId][$language]);
                      }
                      continue;
                    }
                  }
                }
              } else {
                //compare the old values with the new with the same key
                $count = count($newElements2[$profilePropertyId]);
                for ($I = 0; $I < $count; $I ++) {
                  if (isset($newElements2[$profilePropertyId][$I])) {
                    if ($newElements2[$profilePropertyId][$I]['val']['val'] == $element->getObject()) {
                      unset($newElements2[$profilePropertyId][$I]);
                      $element->importStatus = 'match';
                      continue;
                    }
                  }
                }
              }
              //if the key matches then
              //if the value matches
              //delete the newElement
              //else the value doesn't match
              //if the newElement value is empty
              //delete the dbElement

            }

            $element->matchKey = $key;
          }
          //update the property values
          $property->save();
        } else {
          //there's no existing property an we have to create a new one
          $property = new \SchemaProperty();
        }
        foreach ($newElements as $key => $newElement) {
          if ( ! empty($newElement['id']) and ! isset($oldElements[$key])) {
            $profileProperty = $newElement['property'];
            //walk the old elements looking for a match on predicate + language
            /** @var \SchemaPropertyElement $oldElement */
            foreach ($dbElements as $oldElement) {
              /** @var \SchemaPropertyElement $oldOne */
              $oldOne = &$oldElement['element'];
              if ($newElement['id'] == $oldOne->getProfilePropertyId()) {
                /** @var \ProfileProperty $profileProperty */
                if (($profileProperty->getHasLanguage() and $newElement['lang'] == $oldOne->getLanguage())
                    or ! $profileProperty->getHasLanguage()
                ) {
                  if ( ! empty($newElement['val'])) {
                    $oldOne->setObject($newElement['val']);
                    $oldOne->setUpdatedUserId($this->userId);
                    $oldOne->setStatusId($row['status']);
                    //$oldOne->save();
                    $oldElement['status'] = "updated";
                  } else {
                    $oldOne->delete();
                    $oldElement['status'] = "deleted";
                  }
                  //update the property value
                  if ($profileProperty->getIsInForm()) {
                    $this->setPropertyValue($newElement['val'], $property, $profileProperty->getName(),
                          ! $profileProperty->getIsObjectProp());
                  }
                  break;
                }
              }
            }
            //we looked through them all, add a new one
            if ( ! empty($newElement['val'])) {
              $addMe = new \SchemaPropertyElement();
              $addMe->setObject($newElement['val']);
              //$addMe->setSchemaPropertyRelatedBySchemaPropertyId($property);
              $addMe->setCreatedUserId($this->userId);
              $addMe->setUpdatedUserId($this->userId);
              $addMe->setLanguage($newElement['lang']);
              $addMe->setProfilePropertyId($newElement['id']);
              $addMe->setStatusId($row['status']);
              $addMe->importId = $this->importId;
              //$addMe->save();
              $property->addSchemaPropertyElementRelatedBySchemaPropertyId($addMe);
              //update the property value
              if ($profileProperty->getIsInForm()) {
                $this->setPropertyValue($newElement['val'], $property, $profileProperty->getName(),
                      ! $profileProperty->getIsObjectProp());
              }
            }
          }
        }
        //update the property
        if ($property) {
          $property->setStatusId($row['status']);
          $property->save();
        }
      }
      //var_dump($row);
    }));

    /** @todo we need to make a second pass through to delete missing rows
     * for each schemaproperty in the database
     *   match to a row in the csv
     *   if the row value is empty and $this->deleteMissing
     *     delete the entire schemaproperty
     */

    $workResults = $workflow->process();
    $this->DataWorkflowResults = $workResults;

    /** @TODO need to make a second pass through to lookup and set $element->related_schema_property_id */
    $this->processParents($this->vocabId);
    //use the prolog to configure namespaces, look up correct resources in the database
    //store the row number of the first non-meta line

    return $workResults;
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
    //todo $this->mapping isn't correct
    //$import->setMap($this->mapping);
    $import->setResults($this->results);
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
      if (!empty($dbKeys[$uri]['id'])) {
        $value = $dbKeys[$uri]['id'];
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
                                                'error'  => "Could not find namespace for prefix used in headers: '" . $matches[1]
                                               . "' in column: '" . $key . "'"];
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
  private function setPropertyValue($value, $property, $key, $isLiteral, $onlyFirst = false)
  {
    if (is_array($value)) {
      if ($onlyFirst) {
        //only take the first one here
        $value = $isLiteral ? $value[0] : $this->getFqn($value[0]);
        $oldValue = $property->getByName(ucfirst($key));
        if ($oldValue != $value) {
          $property->setByName(ucfirst($key), $value);
        }

        return $key . "0";
      } else {
        foreach ($value as $unit) {
          $unit = $isLiteral ? $unit : $this->getFqn($unit);
          $oldValue = $property->getByName(ucfirst($key));
          if ($oldValue != $value) {
            $property->setByName(ucfirst($key), $unit);
          }
        }
      }
    } else {
      $value = $isLiteral ? $value : $this->getFqn($value);
      $oldValue = $property->getByName(ucfirst($key));
      if ($oldValue != $value) {
        $property->setByName(ucfirst($key), $value);
      }
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
  private function SetPropertyElement($key, $value, $propertyId, $updateTime, $rowStatusId, $cellLanguage, $cellType)
  {
    $profilePropertyId = $this->prolog['columns'][$key]['id'];
    if (is_array($profilePropertyId))
    {
      $profilePropertyId = $profilePropertyId[0];
    }

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

      /** @var \SchemaPropertyElement $element */
      $element = \SchemaPropertyElementPeer::lookupElement(
        $propertyId,
        $profilePropertyId,
        $value,
        $cellLanguage
      );

    if ($element) {
      if (1 === count($element)) {
        $element = $element[0];
        //make sure we handle the special case of subproperty and subclass
        if (empty($value) && $element->getIsSchemaProperty() && in_array($element->getProfilePropertyId(),[6,9]) )
        {
          return $StatementCounter;
        }
      }
      else {
        //it's ambiguous and we stop processing, logging an error to be dealt with later
        $error['Message'] = "Ambiguous update";
        $error['PropertyId'] = $propertyId;
        $error['ProfilePropertyId'] = $profilePropertyId;
        $error['UpdateValue'] = $value;

        $this->results['errors'][] = $error;
      }
    }

    //create a new propertyelement for each unmatched column
    //we didn't find an existing element, make a new one
    if (!$element && !empty($value)) {
      $element = new \SchemaPropertyElement;
      $element->setCreatedUserId($this->userId);
      $element->setCreatedAt($updateTime);
      $element->setProfilePropertyId($profilePropertyId);
      $element->setSchemaPropertyId($propertyId);
      $StatementCounter['status'] = 'created';
    }

    if (!$element)
    {
      return $StatementCounter;
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
    }
    if ($value != $element->getObject()) {
      if (!empty($value)) {
        $element->setObject($value);
      } else {
        $element->setDeletedAt($updateTime);
      }
    }

    if ($element->isNew() or $element->isModified()) {
      $element->setUpdatedUserId($this->userId);
      $element->setUpdatedAt($updateTime);
      $element->setStatusId($rowStatusId);
      $element->importId = $this->importId;
      $element->save();

      if ($StatementCounter['status'] != 'created') {
        $StatementCounter['status'] = 'modified';
      }

      if (is_array($element->getProfilePropertyId())) {
        $profilePropertyId = $element->getProfilePropertyId()[0];
      } else {
        $profilePropertyId = $element->getProfilePropertyId();
      }
      /** @var \ProfileProperty $profileProperty */
      $profileProperty = $this->profileProperties[$profilePropertyId];
      $StatementCounter['column'] = $key;
      $StatementCounter['id'] = $element->getId();
      $StatementCounter['propertyId'] = $element->getProfilePropertyId();
      $StatementCounter['object'] = $element->getObject();
      $StatementCounter['type'] = $cellType;
      $StatementCounter['language'] = $cellLanguage;
    }

    unset($element);
    return $StatementCounter;
  }


  private function setPrologColumns()
  {
    if (empty($this->prolog['meta_column'])) {
      //set the prolog columns
      $this->prolog['meta_column'] = $this->reader->getColumnHeaders()[0];
      $this->prolog['key_column'] = $this->mapping->getMappings()[$this->reader->getColumnHeaders()[1]];
      $this->prolog['value_column'] = $this->mapping->getMappings()[$this->reader->getColumnHeaders()[2]];
    }
  }

  /**
   * @param string $rowElement
   * @param array | \SchemaPropertyElement $dbElement
   * @param \SchemaProperty $property
   */
  private function updateElement(&$rowElement, &$dbElement, &$property)
  {
    if ( ! empty($rowElement)) {
      if ( ! is_array($dbElement)) {
        if ($rowElement === $dbElement->getObject()) {
          unset($rowElement);
        }
      } else {
        /** @var \SchemaPropertyElement $element */
        foreach ($dbElement as &$element) {
          $this->updateElement($rowElement, $element, $property);
        }
      }
    } else {
      //there's no matching column so delete the element
      $this->deleteElement($dbElement, $property);
    }
    return;
  }

  /**
   * @param \SchemaPropertyElement $dbElement
   * @param                        $value
   * @param                        $rowStatus
   * @param \SchemaProperty        $property
   * @param \ProfileProperty       $profileProperty
   * @param                        $language
   */
  private function upsertElementFromRow(&$dbElement, $value, $rowStatus, &$property, $profileProperty, $language)
  {
    if ( ! is_array($dbElement)) {
      if (empty($dbElement) and $value) {
        $dbElement = new \SchemaPropertyElement();
        $dbElement->setProfilePropertyId($profileProperty->getId());
        $dbElement->setSchemaPropertyId($property->getId());
        $dbElement->setLanguage($language);
        $property->addSchemaPropertyElementRelatedBySchemaPropertyId($dbElement);
      }
      if ($dbElement and $value !== $dbElement->getObject()) {
        if (empty($value))
        {
          $dbElement->delete();
        } else {
          $dbElement->setStatusId($rowStatus);
          $dbElement->setObject($value);
          $dbElement->setCreatedUserId($this->userId);
          $dbElement->setUpdatedUserId($this->userId);
          $dbElement->importId = $this->importId;
        }
        //$dbElement->save();
        if ($profileProperty->getIsInForm() and $property->getLanguage() == $dbElement->getLanguage()) {
          $this->setPropertyValue($value, $property, $profileProperty->getName(), ! $profileProperty->getIsObjectProp());
        }
      }
    } else {
      foreach ($dbElement as &$oneElement) {
        $this->upsertElementFromRow($oneElement, $value, $rowStatus, $property, $profileProperty, $language);
      }
    }
  }

  /**
   * @param $key
   * @param $element
   */
  private function updateRowUris($key, &$element)
  {
    if (! is_array($element)) {
      /** @var \ProfileProperty $property */
      if (isset($this->prolog['columns'][$key]['property'])) {
      $property = $this->prolog['columns'][$key]['property'];
        if ( ! empty($property->getIsObjectProp()) and $this->useCuries) {
          $element = $this->getFqn($element);
        }
      }
    } else {
      foreach ($element as &$oneElement) {
        $this->updateRowUris($key, $oneElement);
      }
    }
    return;
  }

  /**
   * @param \SchemaPropertyElement | \SchemaPropertyElement[] $dbElement
   * @param \SchemaProperty        $property
   *
   * @return int
   */
  private function deleteElement(&$dbElement, &$property)
  {
    if ( ! is_array($dbElement)) {
      //we don't delete derived properties at this stage
      if (in_array($dbElement->getProfilePropertyId(),[6,9]))
      {
        return 0;
      }
      $profileProperty = $this->profileProperties[$dbElement->getProfilePropertyId()];
      if ($profileProperty->getIsInForm() and $property->getLanguage() == $dbElement->getLanguage()) {
        $this->setPropertyValue('', $property, $profileProperty->getName(), ! $profileProperty->getIsObjectProp());
      }
      $dbElement->setUpdatedUserId($this->userId);
      $dbElement->importId = $this->importId;
      //$affectedRows = $dbElement->save();
      return $dbElement->delete();
    } else {
      $affectedRows = 0;
      /** @var \SchemaPropertyElement $element */
      foreach ($dbElement as &$element) {
        $affectedRows += $this->deleteElement($element, $property);
      }
      return $affectedRows;
    }
  }
}
