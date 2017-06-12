<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-26,  Time: 10:15 AM */

namespace App\Models\Traits;

trait HasLanguagesList
{
    /**
     * @param string $value
     *
     * @return array
     */
    public function getLanguagesAttribute( $value ): array
    {
        if ( empty( $value ) ) {
            $languages = [ $this->language ];

            if ( empty( $languages[0] ) ) {
                $languages = [ 'en' ];
            }
        } else {
            $languages = unserialize( $value, [ true ] );
        }

        return $languages;
    }

    /**
     * @param array $value
     */
    public function setLanguagesAttribute( array $value ): void
    {
        $this->attributes['languages'] = serialize( $value );
    }
}
