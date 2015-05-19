<?php

namespace ImportVocab;

use Ddeboer\DataImport\Workflow;
use Ddeboer\DataImport\Reader\ArrayReader;
use Ddeboer\DataImport\Writer\CsvWriter;
use Ddeboer\DataImport\ValueConverter\CallbackValueConverter;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;

class ExportVocab {

    /** @var  \Schema */
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
    private $includeProlog = true;

    /**
     * @param       $vocabId
     * @param       $userId
     * @param bool  $populate
     * @param bool  $asTemplate
     * @param array $languages
     *
     * @internal param bool $download
     */
    public function __construct($vocabId, $userId, $populate = false, $asTemplate = false, $includeProlog = true, $languages = array ())
    {
        $this->setSchema($vocabId);
        $this->setUser($userId);
        $this->setAsTemplate($asTemplate);
        $this->languages = $languages;
        $this->language = $this->getSchema()->getLanguage();
        $this->populate = $populate;
        $this->includeProlog = $includeProlog;

        $this->setPath(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'repos' . DIRECTORY_SEPARATOR
                       . 'agents' . DIRECTORY_SEPARATOR . $this->schema->getAgentId() . DIRECTORY_SEPARATOR);
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

    public function setSchema( $schemaId )
    {
        $this->schema = \SchemaPeer::retrieveByPK( $schemaId );
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

        $header = $this->getPrologHeader();
        if ($this->includeProlog) {
            $header[ 1 ][ 0 ] = 'uri';
            ksort($header[1]);
            $header[ 2 ][ 0 ] = 'lang';
            $header[ 2 ][ 1 ] = $this->getSchema()->getLanguage(); //default language
            ksort($header[2]);
            $header[ 3 ][ 0 ] = 'type';
            $header[ 3 ][ 1 ] = 'uri'; //default type
            ksort($header[3]);
        }

        foreach ( $header as $line )
        {
            $writer->writeItem( $line );
        }

        if ($this->includeProlog) {

            $metadata = $this->getMetadata();
            foreach ($metadata as $line) {
                $writer->writeItem($line);
            }

            $prefixRows = $this->getPrefixRows();
            foreach ($prefixRows as $line) {
                $writer->writeItem($line);
            }
        }
        //get the data
        if ( $this->populate )
        {
            $prefixes = $this->getPrefixes();
            $prefixPattern = array();
            $prefixReplacement = array();
            foreach ( $prefixes as $prefix => $namespace )
            {
                if (trim($prefix)) {
                    if ( ! is_int($prefix)) {
                        $prefixPattern[] = "|" . $namespace . "|";
                        $prefixReplacement[] = $prefix . ":";
                    }
                }
            }

            $map = $this->getHeaderMap();
            $c   = new \Criteria();
            $c->clearSelectColumns();
            $c->addSelectColumn(\SchemaPropertyPeer::ID);
            $c->add(\SchemaPropertyPeer::SCHEMA_ID,$this->schema->getId());
            $c->addAscendingOrderByColumn( \SchemaPropertyPeer::URI );
            $properties = \SchemaPropertyPeer::doSelectRS($c);
            /** @var \SchemaProperty $property */
            foreach ( $properties as $property )
            {
                $line    = array_fill( 0, $this->getHeaderCount(), '' );
                $line[0] = $property[0];
                $map     = $this->getHeaderMap();

                $ce = new \Criteria();
                $ce->add(\BaseSchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $property[0]);
                $elements = \SchemaPropertyElementPeer::doSelectJoinProfileProperty($ce);

                /** @var \SchemaPropertyElement $element */
                foreach ( $elements as $element )
                {
                    $profileProperty = $element->getProfileProperty();
                    $propertyId      = $element->getProfilePropertyId();
                    if ( in_array( $propertyId, [ 6, 9, ] ) and $element->getIsSchemaProperty() )
                    {
                        $language = 'parent';
                    }
                    else
                    {
                        $language = $profileProperty->getHasLanguage() ? $element->getLanguage() : '';
                    }
                    $index = $propertyId . $language;
                    if (isset($map[ $index ])) {
                        foreach ($map[ $index ] as &$column) {
                            if (false !== $column) {
                                $line[ $column ] = $element->getObject();
                                $column = false;
                                break;
                            }
                        }
                    }
                }

                $writer->writeItem( preg_replace( $prefixPattern, $prefixReplacement, $line ));

                unset($line);
                unset($elements);
            }
        }

        //add an empty line at the end
        $line = array_fill( 0, $this->getHeaderCount(), '' );
        $writer->writeItem( $line );
        $writer->finish();
    }

    public function getFileName( $type = "csv" )
    {
        $template = $this->isTemplate() ? "_template" : "";

        return $this->getSchema()->getToken() . $template . '.' . $type;
    }

    /**
     * @return boolean
     */
    public function isTemplate()
    {
        return $this->asTemplate;
    }

    public function getPrologHeader()
    {
        $rows      = array();
        $rows[0][0] = 'reg_id';

        $map = array();
        $languages = $this->getLanguages();

        //get the header
        if ( $this->asTemplate )
        {
            //get the headers from the profile instead of finding them for the schema
            $properties = $this->getSchema()->getAllProfileProperties( true );
        }
        else
        {
            $properties = $this->findColumns();
        }

        $column = 1;
        $swap[9] = "parent_class";
        $swap[6] = "parent_property";

        //repeat the lexical property headers for each language in the languages[]
        foreach ( $properties as $property )
        {
            /** @var \ProfileProperty $profile */
            $profile = $property['profile'];
            $label   = $profile->getLabel();
            $id = $profile->getId();

            if ( isset( $property['languages'] ) )
            {
                foreach ( $property['languages'] as $language => $languageCount )
                {
                    if ( in_array( $language, $languages ) )
                    {
                        for ( $I = 0; $I < $languageCount; $I ++ )
                        {
                            $rows[0][$column] = $label . " (" . $language . ")";
                            if ($this->includeProlog) {
                                $rows[ 1 ][ $column ] = $profile->getUri();
                                $rows[ 2 ][ $column ] = $language;
                                $rows[ 3 ][ $column ] = '';
                            }

                            $map[$id . $language][] = $column ;

                            $column ++;
                        }
                    }
                }
            }
            else
            {
                for ( $I = 0; $I < $property['count']; $I ++ )
                {
                    if ( isset( $swap[$id] ) and false !== $swap[$id] )
                    {
                        $rows[0][$column] = $swap[$id];
                        $swap[$id]        = false;
                        $map[$id . 'parent'][] = $column;
                        if ( $this->isTemplate() )
                        {
                            $I --;
                        }
                    }
                    else
                    {
                        $rows[0][$column] = $label;
                        $map[$id . ''][] = $column;
                    }
                    if ($this->includeProlog) {
                        $rows[ 1 ][ $column ] = $profile->getUri();
                        $rows[ 2 ][ $column ] = '';
                        $rows[ 3 ][ $column ] = $profile->getType();
                    }


                    $column ++;
                }
            }
        }

        $this->setHeaderMap($map);

        return $rows;
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
        $this->setColumns( $this->schema->findUsedProfileProperties() );

        return $this->getColumns();
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        if ( empty( $this->columns ) )
        {
            $this->getHeader();
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
            $this->setHeader( $this->getPrologHeader() );
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
        $rows = array_fill(0, 9, array_fill(0, $headerCount, ''));
        for ($I = 0; $I < 9; $I ++) {
            $rows[ $I ][ 0 ] = "meta";
        }
        $rows[ 0 ][ 1 ] = 'token';
        $rows[ 0 ][ 2 ] = $this->getSchema()->getToken();
        $rows[ 1 ][ 1 ] = 'label';
        $rows[ 1 ][ 2 ] = $this->getSchema()->getName();
        $rows[ 2 ][ 1 ] = 'schema_id';
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
        $rows[ 7 ][ 2 ] = 'schema';
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

    public function getPrefixes()
    {
        $prefixes = $this->schema->getPrefixes();
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
     */
    public function setPrefixes($prefixes)
    {
        $this->prefixes = $prefixes;
        $this->schema->setPrefixes($prefixes);
        $this->schema->save();
    }

    public function retrievePrefixes()
    {
        $prefixes = $this->schema->getPrefixes();
        $namespaces = \SchemaPropertyElementPeer::getNamespaceList($this->schema->getId());
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


}
