<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Profile;

trait HasProfiles
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany( Profile::class );
    }
}
