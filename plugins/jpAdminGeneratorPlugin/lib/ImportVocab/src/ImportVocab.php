<?php
/**
 * Created by jonphipps, on 2014-01-10 at 6:16 PM
 * for the registry.dev project
 */

namespace ImportVocab;

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
class ImportVocab
{
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
     * @var array
     */
    public $errors = array();
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
    private $reader;
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
    public function __construct($type, $file, $vocabId)
    {
        $this->type    = $type;
        $this->file    = $file;
        $this->vocabId = $vocabId;

        // initialize database manager
        $databaseManager = new \sfDatabaseManager();
        $databaseManager->initialize();

        //TODO: make prolog array a class
        $this->prolog['columns']  = array();
        $this->prolog['meta']     = array();
        $this->prolog['prefix']   = array();
        $this->prolog['defaults'] = array();
        //TODO: set these values dynamically based on column position rather than actual hard-coded values
        $this->prolog['key_column']   = 'id';
        $this->prolog['value_column'] = 'owl:sameAs';

        $this->errors['error']   = array();
        $this->errors['warning'] = array();
        $this->errors['notice']  = array();

        //TODO: these should get set somewhere
        $this->deleteMissing        = false;
        $this->useSameAsForMatching = true;

        //TODO: store and retrieve this map from the database and associate with the agent(master template)/vocab(template)/batch(template)
        $this->mapping = array(
          "rdfs:label"             => "label",
          "skos:definition"        => "definition",
          "skos:scopeNote"         => "note",
          "rdfs:domain"            => "domain",
          "rdfs:range"             => "range",
          "rdfs:subPropertyOf"     => "subpropertyof",
          "reg:type"               => "type",
          "reg:name"               => "name",
          "id"                     => "uri",
          "owl:equivalentProperty" => "equivalentproperty",
          "owl:sameAs"             => "sameas",
          "owl:inverseOf"          => "inverseof",
          "skos:altLabel"          => "altlabel",
          "ParentProperty"         => "parent_uri",
          "reg:status"             => "status"
        );
    }

    public function  setVocabularyParams()
    {
        //use the prolog to look up correct resources in the database
        $criteria = new \Criteria();
        $criteria->add(\SchemaPeer::ID, $this->vocabId);
        /** @var $vocabulary \Schema */
        $vocabulary = \SchemaPeer::doSelectOne($criteria);
        if (! $vocabulary) {
            //TODO: turn this into a real error message and exit grcefully
            exit("No vocab!!!!!");
        }
        $this->vocabulary = $vocabulary;

        //if we didn't set it from the constructor we set default status from the vocab
        if (! $this->status) {
            $this->prolog['defaults']['statusId'] = $this->getStatusId($vocabulary->getStatusId());
        } else {
            $this->prolog['defaults']['statusId'] = $this->status;
        }

        //if the prolog never set the default language from the spreadsheet, set it here
        if (! isset($this->prolog['defaults']['lang'])) {
            $this->prolog['defaults']['lang'] = $vocabulary->getLanguage();
        }

        //if it hasn't been set already, set the userId from the vocabulary (which does a little bit more work)
        if (! $this->userId) {
            $this->setUserId();
        }
    }

    public function  setUserId($userId = null)
    {
        if ($userId) {
            $this->userId = $userId;
        } else {
            $criteria = new \Criteria();
            $criteria->add(\SchemaHasUserPeer::SCHEMA_ID, $this->vocabId);
            $criteria->add(\SchemaHasUserPeer::IS_ADMIN_FOR, true);
            $users = \SchemaHasUserPeer::doSelectJoinUser($criteria);
            if (! $users) {
                //TODO: turn this into a real error message and exit grcefully
                exit("No user ID found!!!!!");
            }

            /** @var $schemaUser \SchemaHasUser */
            $schemaUser   = $users[0];
            $this->userId = $schemaUser->getUser()->getId();
        }
    }

    public function setCsvReader($file)
    {
        $path = $this->importFolder . $file;
        if (is_readable($path)) {
            $splFile      = new \SplFileObject($path);
            $this->reader = new CsvReader($splFile, ",");
            $this->reader->setHeaderRowNumber(0);
            return $this->reader;
        } else {
            return false;
        }
    }

    public function processProlog()
    {
        $testArray = array();
        $this->setCsvReader($this->file);
        $workflow = new Workflow($this->reader);
        $output   = new ConsoleOutput();
        // Don’t import the non-metadata
        $filter = new Filter\CallbackFilter(function ($row) {
            return trim($row['meta']);
        });
        /** @var $filter Filter\CallbackFilter */
        $workflow->addFilter($filter);
        $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
        $workflow->addWriter(
                 new Writer\CallbackWriter(function ($row) {
                     //if the columns array is empty, set it from the headers
//                     if (! count($this->prolog['columns'])) {
//                         foreach ($row as $key => $column) {
//                             $this->prolog['columns'][$key]         = array();
//                             $this->prolog['columns'][$key]['lang'] = array();
//                             $this->prolog['columns'][$key]['type'] = array();
//                         }
//                     }
                     //if this is meta store it in the array
                     $meta = mb_strtolower(trim($row['meta']));
                     switch ($meta) {
                         case "uri":
                         case "lang":
                         case "type":
                             //$this->prolog['columns'][$meta] = array();
                             foreach ($row as $column => $value) {
                                 if ('meta' != $column) {
                                     $this->prolog['columns'][$column][$meta] = $value;
                                 } elseif ('uri' != $meta) {
                                     $this->prolog['defaults'][$meta] = $row[$this->prolog['key_column']];
                                 }
                             }
                             break;
                         case "meta":
                         case "prefix":
                             $this->prolog[$meta][$row[$this->prolog['key_column']]] =
                               $row[$this->prolog['value_column']];
                             break;
                         default:
                     }

                     //if there's an error store it in the error array
                     //if the error is fatal throw an exception
                     var_dump($this->prolog);
                 })
        );
        $workflow->addWriter(new Writer\ArrayWriter($testArray));
        $workflow->process();
        //use the prolog to configure namespaces, look up correct resources in the database
        //store the row number of the first non-meta line

    }

    public function getDataColumnIds()
    {
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
        foreach ($this->prolog['columns'] as &$column) {
            if (isset($column['uri'])) {
                if (isset($dbKeys[$column['uri']])) {
                    $column['id'] = $dbKeys[$column['uri']];
                }
            }
        }

        foreach ($this->prolog['columns'] as $key => &$column) {
            if ('id' != $key) {
                preg_match('/^(.*)\:/i', $column['uri'], $matches);
                if (isset($matches[0])) {
                    $pattern = '/^' . $matches[0] . '/';

                    if (isset($this->prolog['prefix'][$matches[1]])) {
                        $column['iri'] = preg_replace($pattern, $this->prolog['prefix'][$matches[1]], $key);
                    } else {
                        $this->errors['error'][] = [
                                                     'action' => "getIri",
                                                     'error'  =>
                                                       "Could not find namespace for prefix used in headers: " .
                                                       $matches[1]
                                                   ] . "in column '" . $key . "'";
                    }
                }
            }
        }
    }

    public function getStatusId($status)
    {
        if (is_integer($status)) {
            return $status;
        }
        //is it a known text string
        $c = new \Criteria();
        $c->add(\StatusPeer::DISPLAY_NAME, $status);
        $statusObj = \StatusPeer::doSelectOne($c);
        if (isset($statusObj)) {
            return $statusObj->getId();
        } else {
            return false;
        }
    }

    public function processParents()
    {
        //spin through file again, now that the database is populated, and cleanup all of the parental relationships
        $this->setVocabularyParams();
        $workflow = new Workflow($this->reader);
        $output   = new ConsoleOutput();
        // Don’t import the non-metadata
        $filter = new Filter\CallbackFilter(function ($row) {
            return ! trim($row['meta']);
        });
        $workflow->setGlobalMapping($this->mapping);
        /** @var $filter Filter\CallbackFilter */
        $workflow->addFilter($filter);
        $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
        //add a database writer
        $workflow->addWriter(
                 new Writer\CallbackWriter(function ($row) {
                     //lookup the property
                     $uri      = $this->vocabulary->getBaseDomain() . $row["uri"];
                     $property = \SchemaPropertyPeer::retrieveByUri($uri);
                     if ($property) {
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
                                 //update the parentpropertyuri
                                 $property->setParentUri($parentProperty->getUri());
                                 //update the related schema id
                                 $property->setSchemaPropertyRelatedByIsSubpropertyOf($parentProperty);
                             };
                             $property->save();
                         }
                         //update the statements
                     } else {
                         //we have an error!!!! log it
                     }
                 })
        );
        $workflow->process();
        //use the prolog to configure namespaces, look up correct resources in the database
        //store the row number of the first non-meta line

    }

    public function processData()
    {
        $this->setVocabularyParams();
        $workflow = new Workflow($this->reader);
        $output   = new ConsoleOutput();
        // Don’t import the non-metadata
        $filter = new Filter\CallbackFilter(function ($row) {
            return ! trim($row['meta']);
        });
        $workflow->setGlobalMapping($this->mapping);
        /** @var $filter Filter\CallbackFilter */
        $workflow->addFilter($filter);
        $workflow->addWriter(new Writer\ConsoleProgressWriter($output, $this->reader));
        //add a database writer
        $workflow->addWriter(
                 new Writer\CallbackWriter(function ($row) {
                     //build an array of references
                     //use the prefix to build the FQURI in the references
                     //if it's a bad prefix, throw the cell away and report it as an error
                     //if it's a required property, fail the row and report the error

                     //the type is stored in reg:type.
                     //if it's a subproperty and there's no parentproperty, it's an error
                     //if it's a property and there's a parentproperty, it's an error

                     //build the URI from the vocabulary base domain and the ID column
                     //$record->setLabel($row);

                     //todo map should come from linkage section and be stored in the registry
                     //&about,&type,&status,&equivalent,&label@en-US,&altLabel@en-US,&definition@en-US,&domain,&range,&category,&phase,&notes,&row_id

                     //executeImport:
                     //    serialize the column map
                     try {
                         //set the row counter
                         $this->rowCounter ++;

                         //lookup the URI (or the OMR ID if available) for a match
                         //There always has to be a URI on either update or create
                         if (! isset($row["uri"])) {
                             throw new \Exception('Missing URI for row: ' . $this->rowCounter);
                         }

                         //TODO NOW write a function to check mapped values for array
                         $uri        = $this->vocabulary->getBaseDomain() . $row["uri"];
                         $skipMap    = array();
                         $property   = \SchemaPropertyPeer::retrieveByUri($uri);
                         $updateTime = time();

                         $rowLanguage = $this->prolog['defaults']['lang'];

                         if (isset($row['status'])) {
                             $rowStatusId = $this->getStatusId($row['status']);
                         } else {
                             $rowStatusId = $this->prolog['defaults']['statusId'];
                         }

                         if (! $property) {
                             //          create a new property
                             /** @var \SchemaProperty * */
                             $property = new \SchemaProperty;
                             $property->setSchema($this->vocabulary);
                             $property->setUri($uri);
                             $skipMap[] = "uri";
                             $skipMap[] = "meta";
                             $property->setCreatedUserId($this->userId);
                             $property->setCreatedAt($updateTime);
                         }

                         $property->setLanguage($rowLanguage);
                         $property->setStatusId($rowStatusId);
                         $property->setUpdatedUserId($this->userId);
                         $property->setUpdatedAt($updateTime);

                         //TODO: match the language
                         if (isset($row["label"])) {
                             $property->setLabel($row["label"]);
                             $skipMap[] = "label";
                         }

                         if (isset($row["name"])) {
                             $property->setName($row["name"]);
                             $skipMap[] = "name";
                         } else {
                             $property->setName($row["uri"]);
                             $skipMap[] = "name";
//                        } elseif (isset($row["label"])) {
//                            $property->setName(slugify($row["label"]));
                         }
                         if (isset($row["type"])) {
                             $property->settype(strtolower($row["type"]));
                             $skipMap[] = "type";
                         }

                         //TODO: match the language
                         if (isset($row["definition"])) {
                             $property->setDefinition($row["definition"]);
                             $skipMap[] = "definition";
                         }

                         if (isset($row["domain"])) {
                             $property->setDomain($this->getFqn($row["domain"]));
                             $skipMap[] = "domain";
                         }

                         if (isset($row["parent_uri"])) {
                             $property->setParentUri($this->getFqn($row["parent_uri"]));
                             $skipMap[] = "parent_uri";
                         }

                         if (isset($row["range"])) {
                             $property->setOrange($this->getFqn($row["range"]));
                             $skipMap[] = "range";
                         }

                         //TODO: match the language
                         if (is_array("note")) {
                             $note = '';
                             foreach ("note" as $key => $value) {
                                 $caption = ! empty($row[$value]) ? " (" . $row[$value] . ")" : ' (no caption)';
                                 $note .= ! empty($row[$key]) ? $key . ": " . $row[$key] . $caption . "<br />" : "";
                             }
                             $property->setNote($note);
                             $skipMap[] = "note";
                         } else {
                             if (isset($row["note"])) {
                                 $property->setNote($row["note"]);
                                 $skipMap[] = "note";
                             }
                         }
                         //make sure this scrip has permission to write to php default session storage - /var/lib/php/session
                         $property->saveSchemaProperty($this->userId);

                         foreach ($row as $key => $value) {
                             //we skip because we already did them
                             if (! in_array($key, $skipMap)
                             ) {
                                 $mappedkey = array_search($key, $this->mapping);

                                 if (isset($this->prolog['columns'][$mappedkey]['id'])) {
                                     $elementId = $this->prolog['columns'][$mappedkey]['id'];
                                 } else {
                                     FIXME: //log an error here and exit
                                     exit("could not continue. mapping error");
                                 }
                                 $propertyId = $property->getId();
                                 //check to see if the property already exists
                                 //note that this also checks the object value as well, so there's no way to update or delete an existing triple
                                 //the sheet would have to contain the identifier for the triple
                                 /** @var $element \SchemaPropertyElement */
                                 $element = \SchemaPropertyElementPeer::lookupElement(
                                                                      $this->vocabulary->getId(),
                                                                        $elementId,
                                                                        $row[$key]
                                 );

                                 //get the language for this thing
                                 //if there's a prolog set for the language for this column, use it
                                 //use the default for the import (already set above)
                                 //fall back to the default language of the vocabulary
                                 //create a new property for each unmatched column
                                 if (! empty($row[$key])) {
                                     //we didn't find an existing element, make a new one
                                     if (! $element) {
                                         $element = new \SchemaPropertyElement;
                                         $element->setCreatedUserId($this->userId);
                                         $element->setCreatedAt($updateTime);
                                         $element->setProfilePropertyId($elementId);
                                         $element->setSchemaPropertyId($propertyId);
                                     }

                                     $cellLanguage = $this->getColLangType($mappedkey, 'lang');
                                     //data type must be explicit
                                     $cellType = $this->getColLangType($mappedkey, 'type', true);

                                     if (($row[$key] != $element->getObject()) ||
                                         ($cellLanguage != $element->getLanguage())
                                     ) {
                                         /**
                                          * @todo We need a check here for objectproperties and handle differently
                                          *       if it's a URI, and it uses namespaces, and we have the namespace, do the substitution
                                          **/
                                         if (! $cellType and $cellLanguage) {
                                             if ($cellLanguage != $element->getLanguage()) {
                                                 $element->setLanguage($cellLanguage);
                                             }
                                         } else {
                                             //check if it's a URI and massage the namespace
                                             $row[$key] = $this->getFqn($row[$key]);
                                         }
                                         if ($row[$key] != $element->getObject()) {
                                             $element->setObject($row[$key]);
                                         }
                                         $element->setUpdatedUserId($this->userId);
                                         $element->setUpdatedAt($updateTime);
                                         $element->setStatusId($rowStatusId);
                                         $element->save();
                                     }
                                 } //the row value is empty
                                 else if ($this->deleteMissing && $element) {
                                     $element->delete();
                                 }
                             }
                         }

                         //          else
                         //               lookup and update concept or element
                         //               lookup and update each property
                         //          update the history for each property, action is 'import', should be a single timestamp for all (this should be automatic)
                         //          if 'delete missing properties' is true
                         //               delete each existing, non-required property that wasn't updated by the import

                     } catch(\Exception $e) {
                         //          catch
                         //            if there's an error of any kind, write to error log and continue
                         echo "Error on row: " . $this->rowCounter . ", " . $uri . "\n" . $e . "\n";
                     }
                     $objects = $this->vocabulary->countSchemaPropertys();

                     //if there's an error store it in the error array
                     //if the error is fatal throw an exception
                     var_dump($row);
                 })
        );
        $workflow->process();
        //use the prolog to configure namespaces, look up correct resources in the database
        //store the row number of the first non-meta line

    }

    private function getColLangType($column, $type = 'lang', $noDefault = false)
    {
        //if the column language or type is empty, get the row language or type

        if (! empty($this->prolog['columns'][$column][$type])) {
            return $this->prolog['columns'][$column][$type];
        } else if (! $noDefault) {
            return $this->prolog['defaults'][$type];
        }
        return false;
    }

    private function getFqn($uri)
    {
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
}
