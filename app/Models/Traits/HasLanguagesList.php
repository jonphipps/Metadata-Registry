<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-26,  Time: 10:15 AM */

namespace App\Models\Traits;

trait HasLanguagesList
{
    public function getLanguagesAttribute( $value )
    {
        if ( empty( $value ) ) {
            $languages = [ $this->language ];

            if ( empty( $languages ) ) {
                $languages = [ 'en' ];
            }
        } else {
            $languages = unserialize( $value, [ true ] );
        }

        return $languages;
    }

    public function setLanguagesAttribute( $value )
    {
        $this->attributes['languages'] = serialize( $value );
    }
}
