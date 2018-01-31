<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Elementset
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int|null $deleted_user_id
 * @property string|null $child_updated_at
 * @property int $child_updated_user_id
 * @property int $agent_id
 * @property string|null $label
 * @property string $name
 * @property string $note
 * @property string $uri
 * @property string $url
 * @property string $base_domain
 * @property string $token
 * @property string $community
 * @property int $last_uri_id
 * @property int $status_id
 * @property string $language
 * @property int $profile_id
 * @property string $ns_type
 * @property string $prefixes
 * @property string $languages
 * @property string $repo
 * @property string|null $spreadsheet
 * @property string|null $worksheet
 * @property string $prefix
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Element[] $elements
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read mixed $project_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \App\Models\Profile|null $profile
 * @property-read \App\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Release[] $releases
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereBaseDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereChildUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereCommunity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereDeletedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereLastUriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereNsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset wherePrefixes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereRepo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereSpreadsheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elementset whereWorksheet($value)
 * @mixin \Eloquent
 */
class Elementset extends VocabsModel
{
    public const TABLE = 'reg_schema';
    public $table      = self::TABLE;

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

    /**
     * @param int $project_id
     *
     * @return string
     */
    public static function title(int $project_id): string
    {
        return 'projects/' . $project_id . '/elementsets/create';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function elements(): ?HasMany
    {
        return $this->hasMany(Element::class, 'schema_id', 'id');
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
