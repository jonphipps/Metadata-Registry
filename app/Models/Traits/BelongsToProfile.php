<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 1:27 PM */

namespace App\Models\Traits;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToProfile
{
    public function profile(): ?BelongsTo
    {
        return $this->belongsTo( Profile::class );
    }
}
