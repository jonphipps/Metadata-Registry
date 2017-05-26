<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 1:10 PM */

namespace App\Models\Traits;

use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToProject
{
    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo( Project::class, 'agent_id', 'id' );
    }
}
