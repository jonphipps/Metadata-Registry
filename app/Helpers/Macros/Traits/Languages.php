<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-03-01,  Time: 6:16 PM */

namespace App\Helpers\Macros\Traits;

use Cache;
use Symfony\Component\Intl\Intl;

trait Languages
{
    public static function listLanguages($language = '')
    {
        if ($language) {
            return Intl::getLocaleBundle()->getLocaleName($language);
        }

        return Intl::getLocaleBundle()->getLocaleNames();
    }

    public function showLanguage($value = null)
    {
        $value = $value ?? config('app.locale');

        return Cache::get(
            'language_' . $value,
            function () use ($value) {
                return self::listLanguages($value);
            }
        );
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
            $string .= Intl::getLocaleBundle()->getLocaleName($key) . ', ';
        }

        return rtrim($string, ', ');
    }

    public function listLanguagesForSelect(): array
    {
        return Intl::getLocaleBundle()->getLocaleNames();
    }

    private function decodeLanguageArray()
    {
        $languageProp = $this->attributes['languages'];
        if (! empty($languageProp)) {
            try {
                /* @noinspection UnserializeExploitsInspection */
                return unserialize($languageProp);
            } catch (\ErrorException $e) {
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
