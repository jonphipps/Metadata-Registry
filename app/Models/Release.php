<?php

namespace App\Models;

use App\Models\Traits\BelongsToProject;
use App\Models\Traits\BelongsToUser;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Release
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $published_at
 * @property int|null $user_id
 * @property int|null $agent_id
 * @property string $name
 * @property string|null $body
 * @property string $tag_name
 * @property string $target_commitish
 * @property bool $is_draft
 * @property bool $is_prerelease
 * @property array $github_response
 * @property-read mixed $github_created_at
 * @property-read mixed $html_url
 * @property-read mixed $project_id
 * @property-read mixed $tarball_url
 * @property-read mixed $zipball_url
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release wherePublishedAt($value)
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

    public const TABLE    = 'releases';
    protected $table      = self::TABLE;
    protected $primaryKey = 'id';
    public $timestamps    = true;
    protected $guarded    = ['id'];
    protected $casts      = [
        'github_response' => 'array',
        'is_draft'        => 'bool',
        'is_prerelease'   => 'bool',
    ];
    protected $appends = [
        'tarball_url',
        'zipball_url',
        'html_url',
        'github_created_at',
    ];
    // protected $fillable = [];
    protected $hidden = ['github_response'];
    protected $dates  = [
        'github_created_at',
        'published_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @param $tagName
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function findByTagName($tagName)
    {
        return static::where('tag_name', $tagName)->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function vocabularies(): ?BelongsToMany
    {
        return $this->morphedByMany(Vocabulary::class, 'releaseable')->withTimestamps();
    }

    public function elementsets(): ?BelongsToMany
    {
        return $this->morphedByMany(Elementset::class, 'releaseable')->withTimestamps();
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

    //these all retrieve data from the json github_response
    public function getTarballUrlAttribute()
    {
        return $this->getAttribute('github_response')['tarball_url'];
    }

    public function getHtmlUrlAttribute()
    {
        return $this->getAttribute('github_response')['html_url'];
    }

    public function getZipballUrlAttribute()
    {
        return $this->getAttribute('github_response')['zipball_url'];
    }

    public function getGithubCreatedAtAttribute()
    {
        return Carbon::parse($this->getAttribute('github_response')['created_at'])->toDateTimeString();
    }
}
