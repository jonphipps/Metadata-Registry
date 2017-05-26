<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-26,  Time: 10:22 AM */

namespace App\Models\Traits;

trait HasPrefixesList
{
    public function getPrefixesAttribute( $value )
    {
        return unserialize( $value, [ true ] );
    }

    public function setPrefixesAttribute( $value )
    {
        $this->attributes['prefixes'] = serialize( $value );
    }
}
