<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 5:37 PM */

namespace App\Models\Traits;

use App\Models\ProfileProperty;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToProfileProperty
{
    public function profile_property(): ?BelongsTo
    {
        return $this->belongsTo(ProfileProperty::class, 'profile_property_id', 'id');
    }
}
