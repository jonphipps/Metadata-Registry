<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\Agent
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $last_updated
 * @property \Carbon\Carbon $deleted_at
 * @property string $org_email
 * @property string $org_name
 * @property string $ind_affiliation
 * @property string $ind_role
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 * @property string $phone
 * @property string $web_address
 * @property string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $Profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $Users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementSet[] $Schemas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $Vocabularies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereOrgEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereOrgName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereIndAffiliation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereIndRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereAddress1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereAddress2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent wherePostalCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereWebAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Agent whereType($value)
 * @mixin \Eloquent
 */
class Agent extends Model
{
    use SoftDeletes;

    protected $table = 'reg_agent';

    protected $dates = ['deleted_at', 'last_updated'];


    protected $fillable = array('last_updated', 'deleted_at', 'org_email', 'org_name', 'ind_affiliation', 'ind_role',
        'address1', 'address2', 'city', 'state', 'postal_code', 'country', 'phone', 'web_address', 'type');

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'org_email' => 'string',
        'org_name' => 'string',
        'ind_affiliation' => 'string',
        'ind_role' => 'string',
        'address1' => 'string',
        'address2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'postal_code' => 'string',
        'country' => 'string',
        'phone' => 'string',
        'web_address' => 'string',
        'type' => 'string'
    ];

    public static $rules = [
        'last_updated' => 'required|',
        'org_email' => 'required|max:100',
        'org_name' => 'required|max:255',
        'ind_affiliation' => 'max:255',
        'ind_role' => 'max:45',
        'address1' => 'max:255',
        'address2' => 'max:255',
        'city' => 'max:45',
        'state' => 'max:2',
        'postal_code' => 'max:15',
        'country' => 'max:3',
        'phone' => 'max:45',
        'web_address' => 'max:255',
        'type' => 'max:15'
    ];

    public function Profiles()
    {
        return $this->hasMany('App\Models\Profile', 'agent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Users()
    {
        return $this->belongsToMany('App\Models\User', AgentHasUser::TABLE)
            ->withPivot('is_registrar_for', 'is_admin_for')
            ->withTimestamps();
    }

    public function Schemas()
    {
        return $this->hasMany('App\Models\ElementSet', 'agent_id', 'id');
    }

    public function Vocabularies()
    {
        return $this->hasMany('App\Models\Vocabulary', 'agent_id', 'id');
    }

}
