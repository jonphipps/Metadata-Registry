<?php

/**
 * Subclass for performing query and update operations on the 'reg_prefix' table.
 *
 *
 *
 * @package lib.model
 */
class PrefixPeer extends \BasePrefixPeer {

    public static function populatePrefixes($xhtml)
    {
        $c        = new Criteria();
        $prefixes = self::doSelect( $c );
        foreach ( $xhtml->body->ol->li as $value )
        {
            $uri    = (string) $value['content'];
            $prefix = (string) $value->a;
            $rank   = (int) $value->span['content'];

            //lookup prefix by prefix
            $old = self::findByPrefix( $prefix );
            if ( ! $old )
            {
                $old = new \Prefix();
                $old->setPrefix($prefix);
            }
            $old->setUri( $uri );
            $old->setRank( $rank );
            $old->save();
        }

        return $prefixes;
    }

    public static function findByPrefix( $prefix )
    {
        $c = new Criteria();
        $c->add( PrefixPeer::PREFIX, $prefix );

        return PrefixPeer::doSelectOne( $c );
    }

    public static function findByUri( $uri, $findAll = false )
    {
        $c = new Criteria();
        $c->add( PrefixPeer::URI, $uri );
        $c->addAscendingOrderByColumn( PrefixPeer::RANK );

        if ( $findAll )
        {
            return PrefixPeer::doSelect( $c );
        }
        else
        {
            return PrefixPeer::doSelectOne( $c );
        }
    }

    public static function getIndexedArrayIndexedByPrefix()
    {
        $prefixes = array();
        $c        = new Criteria();
        $results  = self::doSelect( $c );
        /** @var \Prefix[] $results */
        foreach ( $results as $value )
        {
            $prefix                    = $value->getPrefix();
            $prefixes[$prefix]['uri']  = $value->getUri();
            $prefixes[$prefix]['id']   = $value->getId();
            $prefixes[$prefix]['rank'] = $value->getRank();
        }

        return $prefixes;
    }

    public static function getIndexedArrayIndexedByUri()
    {
        $prefixes = array();
        $c        = new Criteria();
        $results  = self::doSelect( $c );
        /** @var \Prefix[] $results */
        foreach ( $results as $value )
        {
            $index = $value->getUri();
            $rank  = $value->getRank();

            //lookup prefix by uri
            if ( isset( $prefixes[$index] ) )
            {
                // lower rank number means more popular (??)
                if ( $rank < $prefixes[$index]['rank'] )
                {
                    $prefixes[$index]['rank']   = $rank;
                    $prefixes[$index]['prefix'] = $value->getPrefix();
                    $prefixes[$index]['id']     = $value->getId();
                }
            }
        }

        return $prefixes;
    }

    /**
     * @return SimpleXMLElement
     */
    public static function getPrefixcc()
    {
        $xhtml = simplexml_load_file( 'http://prefix.cc/popular/all' );

        return $xhtml;
    }
}
