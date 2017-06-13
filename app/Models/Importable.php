<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Importable
 *
 * @mixin \Eloquent
 */
class Importable extends Model
{
    const TABLE = 'importable';
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

    public function projects()
    {
        return $this->morphedByMany(Project::class, 'importable')->withTimestamps();
    }

    public function vocabularies()
    {
        return $this->morphedByMany(Vocabulary::class, 'importable')->withTimestamps();
    }

    public function elementsets()
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
