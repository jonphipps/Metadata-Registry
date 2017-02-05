<?php

namespace App\Models;

use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Vocabulary
 *
 * @property int $id
 * @property int $agent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $last_updated
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int $deleted_user_id
 * @property string $child_updated_at
 * @property int $child_updated_user_id
 * @property string $name
 * @property string $note
 * @property string $uri
 * @property string $url
 * @property string $base_domain
 * @property string $token
 * @property string $community
 * @property int $last_uri_id
 * @property int $status_id   This will be the default status id for all concept properties for this vocabulary
 * @property string $language This is the default language for all concept properties
 * @property string $languages
 * @property int $profile_id
 * @property string $ns_type
 * @property string $prefixes
 * @property string $repo
 * @property string $prefix
 * @property-read \App\Models\Profile $Profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Concept[] $concepts
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \App\Models\Access\User\User $updater
 * @property-read \App\Models\Access\User\User $eraser
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereAgentId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLastUpdated( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUpdatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereDeletedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereChildUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereChildUpdatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereNote( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUrl( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereBaseDomain( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereToken( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereCommunity( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLastUriId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereStatusId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLanguage( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLanguages( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereProfileId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereNsType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary wherePrefixes( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereRepo( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary wherePrefix( $value )
 * @mixin \Eloquent
 */
class Vocabulary extends Model
{

    const TABLE = 'reg_vocabulary';
    protected $table = self::TABLE;

    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;

    protected $blameable = [
      'created' => 'created_user_id',
      'updated' => 'updated_user_id',
      'deleted' => 'deleted_user_id',
    ];

    protected $dates = [ 'deleted_at', 'last_updated' ];

    protected $primaryKey = 'id';


    public function getLanguagesAttribute($value)
    {
        if (empty($value)) {
            $languages = [ $this->language ];

            if (empty($languages)) {
                $languages = [ 'en' ];
            }
        } else {
            $languages = unserialize($value);
        }

        return $languages;
    }


    public function setLanguagesAttribute($value)
    {
        $this->attributes['languages'] = serialize($value);
    }


    public function getPrefixesAttribute($value)
    {
        return unserialize($value);
    }


    public function setPrefixesAttribute($value)
    {
        $this->attributes['prefixes'] = serialize($value);
    }


    public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'profile_id', 'id');
    }


    public function project()
    {
        return $this->belongsTo(Project::class, 'agent_id', 'id');
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class, 'vocabulary_id');
    }


    public function users()
    {
        return $this->belongsToMany(Access\User\User::class, 'vocabulary_has_user', 'vocabulary_id', 'user_id')
                ->withTimestamps()
                ->withPivot(
                    'is_maintainer_for',
                    'is_registrar_for',
                    'is_admin_for',
                    'languages',
                    'default_language',
                    'current_language'
                );
    }
}
