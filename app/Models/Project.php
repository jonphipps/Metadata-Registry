<?php namespace App\Models;

use App\Models\Access\User\User;
use app\Models\ProjectHasUser;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Project
 *
 * @property int $id
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
 * @property string $repo
 * @property bool $is_private
 * @property string $license
 * @property string $description
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $Profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $Users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementSet[] $Schemas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $Vocabularies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLastUpdated( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereOrgEmail( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereOrgName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIndAffiliation( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIndRole( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereAddress1( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereAddress2( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCity( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereState( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project wherePostalCode( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCountry( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project wherePhone( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereWebAddress( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereRepo( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIsPrivate( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLicense( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDescription( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCreatedBy( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUpdatedBy( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDeletedBy( $value )
 * @mixin \Eloquent
 */
class Project extends Model
{
  protected $table = self::TABLE;
  const TABLE = 'reg_agent';

  use SoftDeletes;

  protected $dates = [ 'deleted_at', 'last_updated' ];

  protected $fillable = [
      'last_updated',
      'deleted_at',
      'org_email',
      'org_name',
      'ind_affiliation',
      'ind_role',
      'address1',
      'address2',
      'city',
      'state',
      'postal_code',
      'country',
      'phone',
      'web_address',
      'type',
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
      'id'              => 'integer',
      'org_email'       => 'string',
      'org_name'        => 'string',
      'ind_affiliation' => 'string',
      'ind_role'        => 'string',
      'address1'        => 'string',
      'address2'        => 'string',
      'city'            => 'string',
      'state'           => 'string',
      'postal_code'     => 'string',
      'country'         => 'string',
      'phone'           => 'string',
      'web_address'     => 'string',
      'type'            => 'string',
  ];

  public static $rules = [
      'last_updated'    => 'required|',
      'org_email'       => 'required|max:100',
      'org_name'        => 'required|max:255',
      'ind_affiliation' => 'max:255',
      'ind_role'        => 'max:45',
      'address1'        => 'max:255',
      'address2'        => 'max:255',
      'city'            => 'max:45',
      'state'           => 'max:2',
      'postal_code'     => 'max:15',
      'country'         => 'max:3',
      'phone'           => 'max:45',
      'web_address'     => 'max:255',
      'type'            => 'max:15',
  ];


  public function Profiles()
  {
    return $this->hasMany(Profile::class, 'agent_id', 'id');
  }


  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function Users()
  {
    return $this->belongsToMany(User::class, ProjectHasUser::TABLE)->withPivot('is_registrar_for', 'is_admin_for')
        ->withTimestamps();
  }


  public function Schemas()
  {
    return $this->hasMany(ElementSet::class, 'agent_id', 'id');
  }


  public function Vocabularies()
  {
    return $this->hasMany(Vocabulary::class, 'agent_id', 'id');
  }

}
