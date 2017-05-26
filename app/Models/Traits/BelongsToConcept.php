<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 5:37 PM */

namespace App\Models\Traits;

use App\Models\Concept;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToConcept
{
    /**
     * @return BelongsTo
     */
    public function concept()
    {
        return $this->belongsTo( Concept::class, 'concept_id', 'id' );
    }
}
