<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Import;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasImports
{
    /**
     * @return MorphToMany|null
     */
    public function imports(): ?MorphToMany
    {
        return $this->morphToMany(Import::class, 'importable')->withTimestamps();
    }

    /**
     * @return Import|null
     */
    public function getLatestImport(): ?Import
    {
        return $this->imports()->latest()->first();
    }

    /**
     * @param $import
     *
     * @return $this
     */
    public function addImport($import)
    {
        $this->imports()->attach($import->id);
        return $this;
    }
}
