<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-03-01,  Time: 6:16 PM */

namespace App\Helpers\Macros\Traits;

use Cache;

trait Languages
{
    public static function list( $language = '' )
    {
        $languages =
            unserialize( file_get_contents( base_path( 'data/symfony/i18n/en.dat' ), "r" ),
                [ true ] )['Languages'];
        foreach ( $languages as $key => $value ) {
            Cache::forever( 'language_' . $key, $value[0] );
        }

        return $language ? cache::get( 'language_' . $language ) : '';
    }

    public function getLanguageAttribute( $value )
    {
        return Cache::get( 'language_' . $value,
            function() use ( $value ) {
                return Languages::list( $value );
            } );
    }

    public function getDefaultLanguageAttribute( $value )
    {
        return $this->getLanguageAttribute( $value );
    }

    public function getCurrentLanguageAttribute( $value )
    {
        return $this->getLanguageAttribute( $value );
    }
}
