<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $agent_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property string|null $child_updated_at
 * @property int|null $child_updated_by
 * @property string $name
 * @property string|null $note
 * @property string $uri
 * @property string|null $url
 * @property string $base_domain
 * @property string $token
 * @property string|null $community
 * @property int|null $last_uri_id
 * @property int $status_id
 * @property string $language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementSet[] $ElementSets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProfileProperty[] $ProfileProperties
 * @property-read \App\Models\Status $Status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $Vocabularies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereAgentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereBaseDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereChildUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCommunity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereLastUriId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUrl($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'profile';

    use SoftDeletes;

  /*********************************
   * relationships
   **********************************/

    public function Status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id', 'id');
    }


    public function ProfileProperties()
    {
        return $this->hasMany(\App\Models\ProfileProperty::class, 'profile_id', 'id');
    }


    public function ElementSets()
    {
        return $this->hasMany(\App\Models\ElementSet::class, 'profile_id', 'id');
    }


    public function Vocabularies()
    {
        return $this->hasMany(\App\Models\Vocabulary::class, 'profile_id', 'id');
    }


  /*********************************
   * lookup functions
   **********************************/

    public function requiredProperties()
    {
        return $this->ProfileProperties()->whereIsRequired(true)->get();
    }
}
