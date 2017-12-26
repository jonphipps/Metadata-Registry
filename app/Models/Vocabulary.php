<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Vocabulary
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $agent_id
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int|null $deleted_user_id
 * @property string|null $child_updated_at
 * @property int $child_updated_user_id
 * @property string $name
 * @property string $note
 * @property string $uri
 * @property string $url
 * @property string $base_domain
 * @property string $token
 * @property string $community
 * @property int $last_uri_id
 * @property int $status_id
 * @property string $language This is the default language for all concept properties
 * @property string $languages
 * @property int $profile_id
 * @property string $ns_type
 * @property string $prefixes
 * @property string $repo
 * @property string $prefix
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int|null $child_updated_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Concept[] $concepts
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read mixed $project_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \App\Models\Profile|null $profile
 * @property-read \App\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Release[] $releases
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereBaseDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereChildUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereChildUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereCommunity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereDeletedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereLastUriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereNsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary wherePrefixes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereRepo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vocabulary whereUrl($value)
 * @mixin \Eloquent
 */
class Vocabulary extends VocabsModel
{
    public const TABLE = 'reg_vocabulary';
    public $table = self::TABLE;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @param int $project_id
     *
     * @return string
     */
    public static function create_route(int $project_id): string
    {
        return 'projects/' . $project_id . '/elementsets/create';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function concepts(): ?HasMany
    {
        return $this->hasMany( Concept::class, 'vocabulary_id' );
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
