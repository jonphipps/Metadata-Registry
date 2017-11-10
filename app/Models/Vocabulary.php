<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Access\User\User;
use App\Models\Traits\BelongsToProfile;
use App\Models\Traits\BelongsToProject;
use App\Models\Traits\HasImports;
use App\Models\Traits\HasLanguagesList;
use App\Models\Traits\HasMembers;
use App\Models\Traits\HasPrefixesList;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Vocabulary
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $agent_id
 * @property int|null $created_user_id
 * @property int|null $updated_user_id
 * @property int|null $deleted_user_id
 * @property string|null $child_updated_at
 * @property int|null $child_updated_user_id
 * @property string $name
 * @property string|null $note
 * @property string $uri
 * @property string|null $url
 * @property string $base_domain
 * @property string $token
 * @property string|null $community
 * @property int|null $last_uri_id
 * @property int $status_id
 * @property string $language This is the default language for all concept properties
 * @property array $languages
 * @property int|null $profile_id
 * @property string $ns_type
 * @property string|null $prefixes
 * @property string|null $repo
 * @property string $prefix
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int|null $child_updated_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Concept[] $concepts
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \App\Models\Profile|null $profile
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @method bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary onlyTrashed()
 * @method static bool|null restore()
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary withoutTrashed()
 * @mixin \Eloquent
 */
class Vocabulary extends Model
{
    const TABLE = 'reg_vocabulary';
    protected $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Cacheable;
    use Languages, HasLanguagesList, HasPrefixesList;
    use BelongsToProject, BelongsToProfile, HasStatus, HasMembers, HasImports;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_user_id',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @param int $projectId
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function selectVocabulariesByProject( $projectId )
    {
        return Vocabulary::select( [ 'id', 'name', ] )
            ->where( 'agent_id', $projectId )
            ->orderBy( 'name' )
            ->get()
            ->mapWithKeys( function( $item ) {
                return [ $item['id'] => $item['name'] ];
            } );
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
