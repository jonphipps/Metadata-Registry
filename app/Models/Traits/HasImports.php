<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Import;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasImports
{
    /**
     * @return MorphToMany
     */
    public function imports()
    {
        return $this->morphToMany(Import::class, 'importable');
    }
}
