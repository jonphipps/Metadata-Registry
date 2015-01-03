<?php

/**
 * Subclass for performing query and update operations on the 'reg_prefix' table.
 *
 *
 *
 * @package lib.model
 */
class PrefixPeer extends \BasePrefixPeer
{
    public static function populatePrefixes()
    {
        $xhtml    = simplexml_load_file( 'http://prefix.cc/popular/all' );
        $prefixes = array();
        foreach ( $xhtml->body->ol->li as $value )
        {
            $uri    = (string) $value['content'];
            $prefix = (string) $value->a;
            $rank   = (int) $value->span['content'];

            //lookup prefix by prefix
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

    public static function findByPrefix( $prefix )
    {
        $c = new Criteria();
        $c->add($prefix, PrefixPeer::PREFIX);

       return PrefixPeer::doSelectOne($c);

    }

    public static function findByUri( $uri, $findAll = false)
    {
        $c = new Criteria();
        $c->add($uri, PrefixPeer::URI);
        $c->addAscendingOrderByColumn(PrefixPeer::RANK);

        if ($findAll)
        {
          return PrefixPeer::doSelect($c);
        }
        else {
            return PrefixPeer::doSelectOne($c);
        }
    }
}
