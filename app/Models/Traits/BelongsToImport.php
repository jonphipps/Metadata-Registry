<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 5:37 PM */

namespace App\Models\Traits;

use App\Models\Import;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToImport
{
    /**
     * @return BelongsTo
     */
    public function import()
    {
        return $this->belongsTo( Import::class, 'import_id', 'id' );
    }
}
