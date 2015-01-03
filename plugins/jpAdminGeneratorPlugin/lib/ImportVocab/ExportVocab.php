<?php

namespace ImportVocab;

class ExportVocab {

    /** @var  \Schema */
    private $schema;

    /** @var  \User */
    private $user;

    /** @var \ProfileProperty[] */
    private $columns  = array();
    private $prefixes = array();
    private $languages = array();

    public function __construct( $vocabId, $userId )
    {
        $this->setSchema( $vocabId );
        $this->setUser( $userId );
    }

    public function getCsvProlog()
    {
        // TODO: write logic here
    }

    public function findColumns( )
    {
        $this->setColumns($this->schema->findUsedProfileProperties());
    }

    public function findPrefixes(  )
    {
        // TODO: write logic here
    }

    public function findLanguages()
    {
        $this->setLanguages($this->schema->findLanguages());

    }

    /**
     * @return mixed
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
        return;
        $xhtml    = simplexml_load_file( 'http://prefix.cc/popular/all' );
        $prefixes = array();
        foreach ( $xhtml->body->ol->li as $value )
        {
            $uri    = (string) $value['content'];
            $prefix = (string) $value->a;
            $rank   = (int) $value->span['content'];
            if ( isset( $prefixes[$uri] ) )
            {
                if ( $rank < $prefixes[$uri]['rank'] )
                {
                    $prefixes[$uri]['rank']   = $rank;
                    $prefixes[$uri]['prefix'] = $prefix;
                }
            }
            else
            {
                $prefixes[$uri]['rank']   = $rank;
                $prefixes[$uri]['prefix'] = $prefix;
            }
        }

        return $prefixes;
    }
}
