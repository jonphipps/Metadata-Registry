<?php

namespace ImportVocab;

use Ddeboer\DataImport\Workflow;
use Ddeboer\DataImport\Reader\ArrayReader;
use Ddeboer\DataImport\Writer\CsvWriter;
use Ddeboer\DataImport\ValueConverter\CallbackValueConverter;

class ExportVocab {

    /** @var  \Schema */
    private $schema;

    /** @var  \User */
    private $user;

    /** @var \ProfileProperty[] */
    private $columns   = array();
    private $prefixes  = array();
    private $languages = array();

    public function __construct( $vocabId, $userId )
    {
        $this->setSchema( $vocabId );
        $this->setUser( $userId );
    }

    public function getCsvProlog()
    {
        // TODO: write logic here
        //get the header

    }

    public function findColumns()
    {
        $this->setColumns( $this->schema->findUsedProfileProperties() );
    }

    public function findLanguages()
    {
        $this->setLanguages( $this->schema->findLanguages() );
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
    public function getColumns()
    {
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
    public function getPrefixes()
    {
        return $this->prefixes;
    }

    /**
     * @param array $prefixes
     */
    public function setPrefixes( $prefixes )
    {
        $this->prefixes = $prefixes;
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

    public function retrievePrefixes()
    {
        $n          = $this->schema->getPrefixes();
        $namespaces = \SchemaPropertyElementPeer::getNamespaceList( $this->schema->getId() );
        //there weren't any stored so try to find some
        foreach ( $namespaces as $uri )
        {
            $prefix = \PrefixPeer::findByUri( $uri );
            if ( $prefix )
            {
                $n[$prefix->getPrefix()] = $uri;
            }
            else
            {
                //looks for an alternative match
                $key = array_search( $uri, $n );
                if ( $key === false )
                {
                    $n[] = $uri;
                }
            }
        }
        //there weren't any stored at all and we found some so update the record
        if ( count( $n ) )
        {
            $this->schema->setPrefixes( $n );
        }

        return $n;
    }
}
