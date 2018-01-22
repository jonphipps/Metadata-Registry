<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Import;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasImports
{
    public function imports(): ?MorphToMany
    {
        return $this->morphToMany(Import::class, 'importable')->withTimestamps();
    }

    public function getLatestImport(): ?Import
    {
        return $this->imports()->latest()->first();
    }

    /**
     * @param mixed $imports
     * $imports can be:
     *   a single Import,
     *   a Collection of Imports,
     *   a Collection of Import Ids,
     *   or an array of Import Ids
     *
     * @return $this
     */
    public function addImport($imports)
    {
        $this->imports()->attach($imports);

        return $this;
    }
}
