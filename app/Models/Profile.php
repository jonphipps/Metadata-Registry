<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Profile
 *
 * @property integer $id
 * @property integer $agent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $child_updated_at
 * @property integer $child_updated_by
 * @property string $name
 * @property string $note
 * @property string $uri
 * @property string $url
 * @property string $base_domain
 * @property string $token
 * @property string $community
 * @property integer $last_uri_id
 * @property integer $status_id
 * @property string $language
 * @property-read \App\Models\Status $Status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProfileProperty[] $profileProperties
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementSet[] $ElementSets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $Vocabularies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereAgentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereChildUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereBaseDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCommunity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereLastUriId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereLanguage($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'profile';


    /*********************************
     * relationships
    **********************************/

    public function Status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }

    public function ProfileProperties()
    {
        return $this->hasMany('App\Models\ProfileProperty', 'profile_id', 'id');
    }

    public function ElementSets()
    {
        return $this->hasMany('App\Models\ElementSet', 'profile_id', 'id');
    }

    public function Vocabularies()
    {
        return $this->hasMany('App\Models\Vocabulary', 'profile_id', 'id');
    }


    /*********************************
     * lookup functions
    **********************************/

    public function requiredProperties()
    {
        return $this->ProfileProperties()->whereIsRequired(true)->get();
    }

}
