<?php

namespace ImportVocab;

use Carbon\Carbon;
use Ddeboer\DataImport\Writer\CsvWriter;
use League\Flysystem\Adapter\Local as Adapter;
use League\Flysystem\Filesystem;
use sfConfig;

class ExportVocab {

    /** @var  \Schema|\Vocabulary */
    private $schema;

    /** @var  \User */
    private $user;

    /** @var \ProfileProperty[] */
    private $columns    = array();
    private $prefixes   = array();
    private $language;
    private $languages  = array();
    private $path       = '';
    private $asTemplate = false;
    private $header     = array();
    private $headerCount;
    private $headerMap = array();
    private $populate = false;
    private $exportId;
    /**
     * @var bool
     */
    private $includeDeleted;
    /**
     * @var bool
     */
    private $excludeDeprecated;
    /**
     * @var bool
     */
    private $excludeGenerated;
    /**
     * @var string
     */
    private $type;
  private $fileName;
  private $selectedColumns = [];
  private $includeNotAccepted;


  /**
   * @param \ExportHistory $export
   *
   * @throws \PropelException
   */
  public function __construct(\ExportHistory $export)
  {
    $addLanguage = $export->getSelectedLanguage();
    $schema      = $export->getSchema();
    $vocabulary  = $export->getVocabulary();

    $defaultLanguage = sfConfig::get('app_default_language');

    if ($schema) {
      $defaultLanguage = $schema->getLanguage();
      $this->schema    = $export->getSchema();
      $this->type      = 'schema';
    }
    if ($vocabulary) {
      $defaultLanguage = $vocabulary->getLanguage();
      $this->schema    = $export->getVocabulary();
      $this->type      = 'vocabulary';
    }

    $this->profile = $this->getSchema()->getProfile();

    if ($addLanguage) {
      $languages = [ $defaultLanguage, $addLanguage, ];
    } else {
      $languages = [ $defaultLanguage, ];
    }
    $this->languages = $languages;
    $this->language  = $defaultLanguage;

    $this->setUser($export->getUserId());

        $asTemplate = true;
        $populate   = true;

    $this->setAsTemplate($asTemplate);
    $this->populate = $populate;

    $this->setPath(SF_ROOT_DIR . DIRECTORY_SEPARATOR .
        'web' . DIRECTORY_SEPARATOR .
        'repos' . DIRECTORY_SEPARATOR .
        'agents' . DIRECTORY_SEPARATOR .
        $this->schema->getAgentId() . DIRECTORY_SEPARATOR .
        'exports' . DIRECTORY_SEPARATOR);

    $this->includeDeleted    = $export->getIncludeDeleted();
    $this->excludeDeprecated = $export->getExcludeDeprecated();
    $this->excludeGenerated  = $export->getExcludeGenerated();
    $this->includeNotAccepted = $export->getIncludeNotAccepted();

    $this->selectedColumns = $export->getSelectedColumns();
    $this->exportId = $export->getId();
    $this->setFileName();
  }

    /**
     * @param boolean $asTemplate
     */
    public function setAsTemplate( $asTemplate )
    {
        $this->asTemplate = $asTemplate;
    }

    /**
     * @return \Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

  public function getPath( )
  {
    return $this->path;
  }
  /**
     * @param string $path
     */
    public function setPath( $path )
    {
        $this->path = $path;
    }

    public function findLanguages()
    {
        $this->setLanguages( $this->schema->findLanguages() );
    }

    public function write()
    {
        $adapter = new Adapter("/");
        $filesystem = new Filesystem($adapter);
        if ( ! $filesystem->has($this->path)) {
            $filesystem->createDir($this->path);
        }

        $filename = $this->path . $this->getFileName();

        $writer   = new CsvWriter( "," );
        $writer->setStream( fopen( $filename, 'w' ) );

        //get the header array, which also contains the profilePropertyId map
        $headerArray = $this->getColumnArray();
        $this->setHeaderCount(count($headerArray));
        $columnCount = $this->getHeaderCount();

        //set the row headers
        $row = [];
        for ($i = 0; $i < $columnCount; $i++) {
          $row[$i] = $headerArray[$i]['label'];
        }

      //fix up the status if it's numeric
      $statusKey = array_search('*statusId', array_column($headerArray, 'label'));
      if ($statusKey !== false) {
        //change the row label to reflect the change from id to string
        $row[$statusKey] = '*status';
        //get the statuses array for later
        $statuses = \StatusPeer::getStatusForSelect();
      }

      $writer->writeItem($row);

      //get the data
        if ( $this->populate ) {
          $prefixes          = $this->getPrefixes();
          $prefixPattern     = [];
          $prefixReplacement = [];
          foreach ($prefixes as $prefix => $namespace) {
            if (trim($prefix)) {
              if ( ! is_int($prefix)) {
                $prefixPattern[]     = "|" . $namespace . "|";
                $prefixReplacement[] = $prefix . ":";
              }
            }
          }

          $dataArray = $this->schema->getDataForExport($this->excludeDeprecated,
              $this->excludeGenerated,
              $this->includeDeleted, $this->includeNotAccepted,
              $this->languages);

          //turn the data array into populated rows
          foreach ($dataArray as $rowId => $rowArray) {
            $row    = [];
            $row[0] = $rowId;
            //make sure we're accessing the header array in order
            for ($i = 1; $i < $columnCount; $i++) {
              if (isset( $rowArray[$headerArray[$i]['id']][$headerArray[$i]['language']][0] )) {
                //grab the item[0] in the language array and remove it
                $row[$i] = array_shift($rowArray[$headerArray[$i]['id']][$headerArray[$i]['language']]);
              } else {
                $row[$i] = '';
              }
            }
            //convert the statusId to a string, if it's not
            if ($statusKey and isset( $row[$statusKey] )) {
              $row[$statusKey] = isset( $statuses[$row[$statusKey]] ) ? $statuses[$row[$statusKey]] : $row[$statusKey];
            }

            $writer->writeItem(preg_replace($prefixPattern, $prefixReplacement, $row));
          }
        }
      $writer->finish();
    }


  public function setFileName($type = "csv")
  {
    $date     = Carbon::create();
    $date->setToStringFormat('Ymd\THis');
    $template = $this->isTemplate() ? "_" . $date . "_" . $this->exportId . '_0' : "";

    //handle special characters in token that result in invalid filename
    $token = urlencode(utf8_encode(urldecode($this->getSchema()->getToken())));
    $languageToken = '';
    if ($this->getLanguages()) {
      foreach ($this->getLanguages() as $language) {
        $languageToken .= $language . '-';
      }
      $languageToken = rtrim($languageToken, "-");
    }

    $this->fileName = $token . "_" . $languageToken . $template . '.' . $type;
  }

    /**
     * @return boolean
     */
    public function isTemplate()
    {
        return $this->asTemplate;
    }


  public function getColumnArray()
  {
    $swap[9] = "parent_class";
    $swap[6] = "parent_property";

    $headerArray     = [];
    $columnCounts    = $this->findColumns();
    $selectedColumns = $this->selectedColumns;
    $column          = 1; //we reserve column 0 for the reg_id
    $max             = count($selectedColumns) - 1;
    $headerArray[0]['label'] = 'reg_id';
    $headerArray[0]['id'] = null;
    $headerArray[0]['language'] = '';
    for ($I = 0; $I < $max; $I++) {
      $id              = $selectedColumns[$I];
      /** @var \ProfileProperty $ProfileProperty */
      $ProfileProperty = \ProfilePropertyPeer::retrieveByPK($id);
      if ($ProfileProperty->getHasLanguage()) {
        foreach ($this->languages as $language) {
          $languageCount = isset( $columnCounts[$id][$language] ) ? $columnCounts[$id][$language] : 1;
          for ($counter = 0; $counter < $languageCount; $counter++) {
            $headerArray[$column]['label']    = $ProfileProperty->getLabelForExport($counter, $language);
            $headerArray[$column]['id']       = $id;
            $headerArray[$column]['language'] = $language;
            $column++;
          }
        }
      } else {
        $languageCount = isset( $columnCounts[$id][''] ) ? $columnCounts[$id][''] : 1;
        for ($counter = 0; $counter < $languageCount; $counter++) {
          $headerArray[$column]['label']    = $ProfileProperty->getLabelForExport($counter);
          $headerArray[$column]['id']       = $id;
          $headerArray[$column]['language'] = '';
          $column++;
        }
      }
    }

    return $headerArray;
  }


  /**
   * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     */
    public function setLanguages( $languages )
    {
        $this->languages = $languages;
    }

  public function findColumns()
  {
    $propertiesInUse = $this->schema->getColumnCounts($this->excludeDeprecated,
        $this->excludeGenerated,
        $this->includeDeleted,  $this->languages);
    $this->setColumns($propertiesInUse);

    return $this->getColumns();
  }

    /**
     * @return array
     */
    public function getColumns()
    {
        if ( 0 === count( $this->columns ) )
        {
            $this->findColumns();
        }

        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns( $columns )
    {
        $this->columns = $columns;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        if ( empty( $this->header ) )
        {
            $this->setHeader( $this->getColumnArray() );
        }

        return $this->header;
    }

    /**
     * @param array $header
     */
    public function setHeader( $header )
    {
        $this->header = $header;
        if ( isset( $header[0] ) )
        {
            $this->setHeaderCount( count( $header[0] ) );
        }
    }

    public function getMetadata()
    {
        $headerCount = $this->getHeaderCount();
        ($this->schema instanceof \Vocabulary) ? $type = 'vocabulary' : $type = 'schema';
        $rows = array_fill(0, 9, array_fill(0, $headerCount, ''));
        for ($I = 0; $I < 9; $I ++) {
            $rows[ $I ][ 0 ] = "meta";
        }
        $rows[ 0 ][ 1 ] = 'token';
        $rows[ 0 ][ 2 ] = $this->getSchema()->getToken();
        $rows[ 1 ][ 1 ] = 'label';
        $rows[ 1 ][ 2 ] = $this->getSchema()->getName();
        $rows[ 2 ][ 1 ] = "{$type}_id";
        $rows[ 2 ][ 2 ] = $this->getSchema()->getId();
        $rows[ 3 ][ 1 ] = 'uri';
        $rows[ 3 ][ 2 ] = $this->getSchema()->getUri();
        $rows[ 4 ][ 1 ] = 'note';
        $rows[ 4 ][ 2 ] = $this->getSchema()->getNote();
        $rows[ 5 ][ 1 ] = 'tags';
        $rows[ 5 ][ 2 ] = $this->getSchema()->getCommunity();
        $rows[ 6 ][ 1 ] = 'base_domain';
        $rows[ 6 ][ 2 ] = $this->getSchema()->getBaseDomain();
        $rows[ 7 ][ 1 ] = 'type';
        $rows[ 7 ][ 2 ] = $type;
        $rows[ 8 ][ 1 ] = 'agent_id';
        $rows[ 8 ][ 2 ] = $this->getSchema()->getAgentId();
        if ($this->getUser()) {
            $rows[ 9 ][ 0 ] = "meta";
            $rows[ 9 ][ 1 ] = 'user_id';
            $rows[ 9 ][ 2 ] = $this->getUser()->getId();
        }

        return $rows;
    }

    /**
     * @return mixed
     */
    public function getHeaderCount()
    {
        if ( empty( $this->headerCount ) )
        {
            $this->getHeader();
        }

        return $this->headerCount;
    }

    /**
     * @param mixed $headerCount
     */
    public function setHeaderCount( $headerCount )
    {
        $this->headerCount = $headerCount;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }


  /**
   * @param $userId
   */
  public function setUser( $userId )
    {
        $this->user = \UserPeer::retrieveByPK( $userId );
    }

    /**
     * @return array
     */
    public function getPrefixRows()
    {
        $prefixes    = $this->getPrefixes();
        //add the column header prefixes (hacky)
        //todo get the column header prefixes from profile properties
        $prefixes['owl'] = 'http://www.w3.org/2002/07/owl#';
        $prefixes['rdfs'] = 'http://www.w3.org/2000/01/rdf-schema#';
        $prefixes['reg'] = 'http://metadataregistry.org/uri/profile/RegAp/';
        $prefixes['skos'] = 'http://www.w3.org/2004/02/skos/core#';

        $headerCount = $this->getHeaderCount();
        $rowCount    = count( $prefixes );
        $n           = array_fill( 0, $rowCount, array_fill( 0, $headerCount, '' ) );
        $I           = 0;
        foreach ( $prefixes as $key => $prefix )
        {
            $n[ $I ][ 0 ] = "prefix";
            $n[ $I ][ 1 ] = ( ! is_int($key)) ? $key : '';
            $n[ $I ][ 2 ] = $prefix;
            $I ++;
        }

        return $n;
    }


  /**
   * @param bool $reset
   *
   * @return array
   */
  public function getPrefixes($reset = false)
    {
        $prefixes = [];
        if ( ! $reset) {
            $prefixes = $this->schema->getPrefixes();
        }
        if (empty($prefixes)) {
            $prefixes = $this->retrievePrefixes();
            $this->setPrefixes($prefixes);
        } else {
            $this->prefixes = $this->schema->getPrefixes();
        }

        return $this->prefixes;
    }

    /**
     * @param array $prefixes
     * @return array
     */
    private function getDefaultPrefix($prefixes = null)
    {
        $default = [$this->schema->getToken() => $this->schema->getUri()];
        //if the uri matches the default but there is no hash key
        if ($prefixes) {
            if (array_search($this->schema->getUri(), $prefixes) === 0) {
                unset($prefixes[0]);
                $default = array_merge($default, $prefixes);
            }
        }

        return $default;
    }

    /**
     * @param array $prefixes
     */
    public function setPrefixes($prefixes)
    {
        if ($prefixes) {
            $this->prefixes = $prefixes;
            $this->schema->setPrefixes($prefixes);
            $this->schema->save();
        }
    }

    public function retrievePrefixes()
    {
        $prefixes = $this->schema->getPrefixes();
        if ('schema' === $this->type) {
            $namespaces = \SchemaPropertyElementPeer::getNamespaceList($this->schema->getId());
        } else {
            $namespaces = \VocabularyPeer::getNamespaceList($this->schema->getId());
        }
        //check the retrieved namespaces for a match to existing prefixes
        foreach ($namespaces as $uri) {
            //if we find the uri in existing schema prefixes, move on
            if ($prefixes and array_search($uri, $prefixes) !== false) {
                continue;
            }
            //look for it in Prefixes table
            $namespacePrefix = \PrefixPeer::findByUri($uri);
            if ($namespacePrefix) {
                //add it to the prefix array
                $prefixes[ $namespacePrefix->getPrefix() ] = $uri;
            } //check it against the schema token
            elseif (trim($uri, "/#") == trim($this->schema->getUri(), "#/")) {
                $prefixes[ $this->schema->getToken() ] = $uri;
            } else {
                $prefixes[ ] = $uri;
            }
        }
        if (empty($prefixes)) {
            $prefixes = $this->getDefaultPrefix();
        }

        return $prefixes;
    }

    /**
     * @return array
     */
    public function getHeaderMap()
    {
        if ( empty( $this->headerMap ) )
        {
            //map is created when headers are requested
            $this->getHeader();
        }

        return $this->headerMap;
    }

    /**
     * @param array $headerMap
     */
    public function setHeaderMap( $headerMap )
    {
        $this->headerMap = $headerMap;
    }

    public function output()
    {
        $filename = $this->getFileName();

        header( 'Content-Type: text/csv; charset=UTF-8' );
        header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
    }

    public function findUsedSchemaProfileProperties()
    {
        $c = new \Criteria();
        $c->add( \SchemaPropertyPeer::SCHEMA_ID, $this->getSchema()->getId() );
        $c->clearSelectColumns();
        $c->addSelectColumn( \SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID );
        $c->addSelectColumn( \SchemaPropertyElementPeer::PROFILE_PROPERTY_ID );
        $c->addSelectColumn( \SchemaPropertyElementPeer::LANGUAGE );
        $c->addAscendingOrderByColumn( \SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID );
        $c->addJoin( \SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, \SchemaPropertyPeer::ID );

        $foo     = array();
        $results = \SchemaPropertyElementPeer::doSelectRS( $c );
        unset( $c );

        foreach ( $results as $result )
        {
            if ( ! isset( $foo[$result[0]][$result[1]][$result[2]] ) )
            {
                $foo[$result[0]][$result[1]][$result[2]] = 1;
            }
            else
            {
                $foo[$result[0]][$result[1]][$result[2]] ++;
            }
        }

        $bar = self::buildColumnArray( $foo );

        return $bar;
    }

    public function findUsedVocabularyProfileProperties()
    {
        $c = new \Criteria();
        $c->add( \ConceptPeer::VOCABULARY_ID, $this->getSchema()->getId() );
        $c->clearSelectColumns();
        $c->addSelectColumn( \ConceptPropertyPeer::CONCEPT_ID );
        $c->addSelectColumn( \ProfilePropertyPeer::ID );
        $c->addSelectColumn( \ConceptPropertyPeer::LANGUAGE );
        $c->addAscendingOrderByColumn( \ConceptPropertyPeer::CONCEPT_ID );
        $c->addJoin( \ConceptPropertyPeer::CONCEPT_ID, \ConceptPeer::ID );
        $c->addJoin( \ConceptPropertyPeer::SKOS_PROPERTY_ID, \ProfilePropertyPeer::SKOS_ID );

        $foo     = array();
        $results = \ConceptPropertyPeer::doSelectRS( $c );
        unset( $c );

        foreach ( $results as $result )
        {
            if ( ! isset( $foo[$result[0]][$result[1]][$result[2]] ) )
            {
                $foo[$result[0]][$result[1]][$result[2]] = 1;
            }
            else
            {
                $foo[$result[0]][$result[1]][$result[2]] ++;
            }
        }

        $bar = self::buildColumnArray( $foo );

        return $bar;
    }

    public function getAllProfileProperties($forExport = false)
    {
      $columns = [];
      $languages = $this->getLanguages();
      if ('schema' === $this->type) {
        $columnCounts = $this->schema->getColumnCounts($this->excludeDeprecated, $this->excludeGenerated, $this->includeDeleted);
      } else {
        $columnCounts = \VocabularyPeer::getColumnCounts($this->getSchema()->getId());
      }
      $profile = $this->profile;

      if ($forExport) {//get the selected columns
        $selectedColumns = $this->columns;

        //populate the properties
        /** @var int $selectedColumn */
        foreach ($selectedColumns as $index => $selectedColumn) {
          $property = \ProfilePropertyPeer::retrieveByPK($selectedColumn);
          $propertyId = $property->getId();
          $columns[$index]['profile'] = $property;
          $columns[$index]['id'] = $selectedColumn;
          if ($property->getHasLanguage()) {
            foreach ($languages as $language) {
              $columns[$index]['languages'][$language] = isset( $columnCounts[$propertyId][$language] ) ? $columnCounts[$propertyId][$language] : 1;
            }
          } else {
            $columns[$index]['count'] = isset( $columnCounts[$propertyId] ) ? $columnCounts[$propertyId][''] : 1;
          }
        }
      } else {
        $c = new \Criteria();
        $c->addAscendingOrderByColumn(\ProfilePropertyPeer::EXPORT_ORDER);
        $propertys = $profile->getProfilePropertys($c);

        /** @var \profileProperty $property */
        foreach ((array) $propertys as $property) {
          $propertyId                       = $property->getId();
          $exportOrder                      = $property->getExportOrder();
          $columns[$exportOrder]['profile'] = $property;
          $columns[$exportOrder]['id']      = $propertyId;
          if ($property->getHasLanguage()) {
            foreach ($languages as $language) {
              $columns[$exportOrder]['languages'][$language] = isset( $columnCounts[$propertyId][$language] ) ? $columnCounts[$propertyId][$language] : 1;
            }
          } else {
            $columns[$exportOrder]['count'] = isset( $columnCounts[$propertyId] ) ? $columnCounts[$propertyId][''] : 1;
          }
        }
      }
        return $columns;
    }

    /**
     * @param $foo
     * @return array
     */
    protected static function buildColumnArray( $foo )
    {
        $bar = array();
        if ( count( $foo ) )
        {
            foreach ( $foo as $value )
            {
                foreach ( $value as $key => $langArray )
                {
                    /** @var \ProfileProperty $profile */
                    $profile                = \ProfilePropertyPeer::retrieveByPK( $key );
                    $order                  = $profile->getExportOrder();
                    $bar[$order]['profile'] = $profile;
                    $bar[$order]['id']      = $key;

                    foreach ( $langArray as $lang => $count )
                    {
                        if ( $profile->getHasLanguage() )
                        {
                            if ( ! isset( $bar[$order]['languages'][$lang] ) )
                            {
                                $bar[$order]['languages'][$lang] = 1;
                            }
                            else if ( $bar[$order]['languages'][$lang] < $count )
                            {
                                $bar[$order]['languages'][$lang] = $count;
                            }
                        }
                        else
                        {
                            if ( ! isset( $bar[$order]['count'] ) )
                            {
                                $bar[$order]['count'] = 1;
                            }
                            else if ( $bar[$order]['count'] < $count )
                            {
                                $bar[$order]['count'] = $count;
                            }
                        }
                    }
                }
            }
        }

        ksort($bar, SORT_NUMERIC);
        return $bar;
    }


  /**
   * @return mixed
   */
  public function getFileName()
  {
    return $this->fileName;
  }

}
