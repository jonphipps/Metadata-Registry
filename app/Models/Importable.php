<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Importable
 *
 * @mixin \Eloquent
 */
class Importable extends Model
{
    const TABLE   = 'importable';
    public $table = self::TABLE;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function projects(): ?BelongsToMany
    {
        return $this->morphedByMany(Project::class, 'importable')->withTimestamps();
    }

    public function vocabularies(): ?BelongsToMany
    {
        return $this->morphedByMany(Vocabulary::class, 'importable')->withTimestamps();
    }

    public function elementsets(): ?BelongsToMany
    {
        return $this->morphedByMany(Elementset::class, 'importable')->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
