<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 5:37 PM */

namespace App\Models\Traits;

use App\Models\Element;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRelatedElement
{
    /**
     * @return BelongsTo
     */
    public function related_element()
    {
        return $this->belongsTo( Element::class, 'related_schema_property_id', 'id' );
    }
}
