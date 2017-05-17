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
 * @property int $project_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $last_updated
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
 * @property int $status_id This will be the default status id for all concept properties for this vocabulary
 * @property string $language This is the default language for all concept properties
 * @property string|null $languages
 * @property int|null $profile_id
 * @property string $ns_type
 * @property string|null $prefixes
 * @property string|null $repo
 * @property string $prefix
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property int $child_updated_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Concept[] $concepts
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \App\Models\Profile|null $profile
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereAgentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereBaseDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereChildUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereChildUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereCommunity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereDeletedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLanguages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereLastUriId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereNsType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary wherePrefix($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary wherePrefixes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereRepo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vocabulary whereUrl($value)
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
            $languages = unserialize($value,[true]);
        }

        return $languages;
    }


    public function setLanguagesAttribute($value)
    {
        $this->attributes['languages'] = serialize($value);
    }


    public function getPrefixesAttribute($value)
    {
        return unserialize($value,[true]);
    }


    public function setPrefixesAttribute($value)
    {
        $this->attributes['prefixes'] = serialize($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(\App\Models\Profile::class, 'profile_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function concepts()
    {
        return $this->hasMany(Concept::class, 'vocabulary_id');
    }

  public function status()
  {
    return $this->belongsTo(\App\Models\Status::class, 'status_id', 'id');
  }

  /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
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
