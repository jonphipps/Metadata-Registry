<?php namespace App\Models;

use App\Models\Access\User\User;
use App\Models\Traits\ElementSets;
use App\Models\Traits\Profiles;
use App\Models\Traits\Vocabularies;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $description
 * @property bool $is_private
 * @property string $repo
 * @property string $license
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
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property string $name
 * @property string $label
 * @property string $url
 * @property string $license_uri
 * @property string $base_domain
 * @property string $namespace_type
 * @property string $uri_strategy
 * @property string $uri_prepend
 * @property string $uri_append
 * @property int $starting_number
 * @property string $default_language
 * @property string $languages
 * @property string $prefixes
 * @property string $google_sheet_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementSet[] $elementSets
 * @property mixed $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $vocabularies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereAddress1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereAddress2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereBaseDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereGoogleSheetUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIndAffiliation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIndRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIsPrivate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLanguages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLicense($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLicenseUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereNamespaceType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereOrgEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereOrgName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project wherePostalCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project wherePrefixes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereRepo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereStartingNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUriAppend($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUriPrepend($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUriStrategy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereWebAddress($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    use CrudTrait, Cacheable, SoftDeletes, Profiles, Vocabularies, ElementSets;

    const TABLE = 'reg_agent';

    public static $rules = [];

    protected $table = self::TABLE;

    protected $dates = [ 'deleted_at' ];

    protected $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function badge( $count )
    {
        return '<span class="badge">' . $count . '</span>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany( User::class )->withPivot( 'is_registrar_for', 'is_admin_for' )->withTimestamps();
    }




    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function ScopePrivate( $query )
    {
        return $query->where( 'is_private', true );
    }

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function ScopePublic( $query )
    {
        return $query->where( 'is_private', '<>', 1 );
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getTitleAttribute()
    {
        return $this->attributes['org_name'];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setTitleAttribute(string $value)
    {
        $this->attributes['org_name'] = $value;
    }

}
