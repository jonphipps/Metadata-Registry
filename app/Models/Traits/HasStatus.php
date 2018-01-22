<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 5:53 PM */

namespace App\Models\Traits;

use App\Models\Status;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasStatus
{
    public function status(): ?BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
