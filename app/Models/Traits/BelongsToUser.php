<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-25,  Time: 1:10 PM */

namespace App\Models\Traits;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    public function user(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function member(): ?BelongsTo
    {
        return $this->user();
    }
}
