<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasProfiles
{
    public function profiles(): ?HasMany
    {
        return $this->hasMany( Profile::class );
    }
}
