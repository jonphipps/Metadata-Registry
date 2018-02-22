<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Releasable
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $published_at
 * @property int|null $release_id
 * @property int|null $releaseable_id
 * @property string|null $releaseable_type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable whereReleaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable whereReleaseableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable whereReleaseableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Releasable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Releasable extends Model
{
    protected $dates = ['published_at'];

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'releaseables';

    /*
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /*
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    // public $timestamps = false;

    /*
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    // protected $guarded = ['id'];

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [];

    /*
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];

    /*
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = [];

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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
