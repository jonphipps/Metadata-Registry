<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 5:37 PM */

namespace App\Models\Traits;

use App\Models\Elementset;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToElementset
{
    public function elementset(): BelongsTo
    {
        return $this->belongsTo( Elementset::class, 'schema_id', 'id' );
    }
}
