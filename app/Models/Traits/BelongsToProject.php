<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 1:10 PM */

namespace App\Models\Traits;

use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToProject
{
    public function project(): ?BelongsTo
    {
        return $this->belongsTo( Project::class, 'agent_id', 'id' );
    }

    public function getProjectIdAttribute($value)
    {
        return $this->agent_id;
    }
}
