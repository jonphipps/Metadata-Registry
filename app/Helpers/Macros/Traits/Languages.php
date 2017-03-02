<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-03-01,  Time: 6:16 PM */

namespace App\Helpers\Macros\Traits;

use Cache;

trait Languages
{
  public static function list($language = '')
  {
    foreach (unserialize(file_get_contents(base_path("data/symfony/i18n/en.dat"), "r"))['Languages'] as $key => $value)
    {
      Cache::forever('language_'.$key, $value[0]);
    }

    return $language ? cache::get('language_'.$language) : '';
  }
}
