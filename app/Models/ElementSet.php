<?php namespace App\Models;

use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ElementSet
 *
 * @property int $id
 * @property int $agent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
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
 * @property int $status_id
 * @property string $language
 * @property int $profile_id
 * @property string $ns_type
 * @property string $prefixes
 * @property string $languages
 * @property string $repo
 * @property string $prefix
 * @property-read \App\Models\Profile $Profile
 * @property-read \App\Models\Status $Status
 * @property-read \App\Models\Project $Agent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Element[] $Elements
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \App\Models\Access\User\User $updater
 * @property-read \App\Models\Access\User\User $eraser
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereAgentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereDeletedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereChildUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereBaseDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereCommunity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereLastUriId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereNsType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet wherePrefixes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereLanguages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet whereRepo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSet wherePrefix($value)
 * @mixin \Eloquent
 */
class ElementSet extends Model
{

    const TABLE = 'reg_schema';
    
    public $table = self::TABLE;

    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;

    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_user_id'
    ];

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
        'deleted_at',
        'name',
        'note',
        'uri',
        'url',
        'base_domain',
        'token',
        'community',
        'last_uri_id',
        'language',
        'ns_type',
        'prefixes',
        'languages',
        'repo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                    => 'integer',
        'agent_id'              => 'integer',
        'created_user_id'       => 'integer',
        'updated_user_id'       => 'integer',
        'child_updated_user_id' => 'integer',
        'name'                  => 'string',
        'note'                  => 'string',
        'uri'                   => 'string',
        'url'                   => 'string',
        'base_domain'           => 'string',
        'token'                 => 'string',
        'community'             => 'string',
        'last_uri_id'           => 'integer',
        'status_id'             => 'integer',
        'language'              => 'string',
        'profile_id'            => 'integer',
        'ns_type'               => 'string',
        'prefixes'              => 'string',
        'languages'             => 'string',
        'repo'                  => 'string'
    ];

    public static $rules = [
        'agent_id'    => 'required|',
        'name'        => 'required|max:255',
        'note'        => 'max:65535',
        'uri'         => 'required|max:255',
        'url'         => 'max:255',
        'base_domain' => 'required|max:255',
        'token'       => 'required|max:45',
        'community'   => 'max:45',
        'status_id'   => 'required|',
        'language'    => 'required|max:6',
        'ns_type'     => 'required|max:6',
        'prefixes'    => 'max:65535',
        'languages'   => 'max:65535',
        'repo'        => 'required|max:255'
    ];


    public function Profile()
    {
        return $this->belongsTo('App\Models\Profile', 'profile_id', 'id');
    }


    public function Status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }


    public function Agent()
    {
        return $this->belongsTo(Project::class, 'agent_id', 'id');
    }


    public function Elements()
    {
        return $this->hasMany('App\Models\Element', 'schema_id', 'id');
    }

}
