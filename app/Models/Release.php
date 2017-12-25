<?php

namespace App\Models;

use App\Models\Traits\BelongsToProject;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Release
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $user_id
 * @property int|null $agent_id
 * @property string $name
 * @property string|null $body
 * @property string $tag_name
 * @property string $target_commitish
 * @property int|null $is_draft
 * @property int|null $is_prerelease
 * @property mixed|null $github_response
 * @property-read mixed $project_id
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\Access\User\User|null $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Release onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereGithubResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereIsDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereIsPrerelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereTargetCommitish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Release withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Release withoutTrashed()
 * @mixin \Eloquent
 */
class Release extends Model
{
    use SoftDeletes, Cacheable;
    use CrudTrait;
    use BelongsToProject, BelongsToUser;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    public const TABLE = 'releases';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
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

    public function vocabularies(): ?MorphToMany
    {
        return $this->morphedByMany(Vocabulary::class, 'releaseable');
    }

    public function elementsets(): ?MorphToMany
    {
        return $this->morphedByMany(Elementset::class, 'releaseable');
    }

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
