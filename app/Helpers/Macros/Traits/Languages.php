<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-03-01,  Time: 6:16 PM */

namespace App\Helpers\Macros\Traits;

use Cache;

trait Languages
{
    public static function listLanguages( $language = '' )
    {
        //todo: cache all of the ??.dat language files and check relative speed of retrieval
        $languages =
            unserialize( file_get_contents( base_path( 'data/symfony/i18n/en.dat' )),
                [ true ] )['Languages'];
        foreach ( $languages as $key => $value ) {
            Cache::forever( 'language_' . $key, $value[0] );
        }

        return $language ? Cache::get( 'language_' . $language ) : '';
    }

    public function showLanguage( $value = null)
    {
        $value = $value ?? config('app.locale');
        return Cache::get( 'language_' . $value,
            function() use ( $value ) {
                return self::listLanguages( $value );
            } );
    }

    public function showLanguagesCommaDelimited(): string
    {
        $keys = $this->decodeLanguageArray();
        if (empty($keys)) {
            return '';
        }
        ksort($keys);
        $string = '';
        foreach ($keys as $key) {
            $string .= Cache::get('language_' . $key,
                    function() use ($key) {
                        return self::listLanguages($key);
                    }) . ', ';
        }

        return rtrim($string, ', ');
    }

    public function listLanguagesForSelect(): array
    {
        $keys = $this->decodeLanguageArray();
        $keys = $keys ?? [ 'en' ];
        ksort($keys);
        $array = [];
        foreach ($keys as $key) {
            $array[ $key ] = Cache::get('language_' . $key,
                function() use ($key) {
                    return self::listLanguages($key);
                });
        }

        return $array;
    }

    private function decodeLanguageArray()
    {
        $languageProp = $this->attributes['languages'];
        if(!empty($languageProp)){
            try {
                /** @noinspection UnserializeExploitsInspection */
                return unserialize($languageProp);
            }
            catch (\ErrorException $e) {
                return json_decode($languageProp);
            }
        }
    }

    public function getLanguagesAttribute()
    {
        return $this->decodeLanguageArray();
    }

    public function setLanguagesAttribute($value): void
    {
        $this->attributes['languages'] = serialize($value);
    }

 }
