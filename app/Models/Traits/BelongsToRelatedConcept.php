<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 5:37 PM */

namespace App\Models\Traits;

use App\Models\Concept;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRelatedConcept
{
    /**
     * @return BelongsTo
     */
    public function related_concept()
    {
        return $this->belongsTo( Concept::class, 'related_concept_id', 'id' );
    }
}
