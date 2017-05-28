<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Access\User\User;
use App\Models\Traits\HasElementsets;
use App\Models\Traits\HasLanguagesList;
use App\Models\Traits\HasMembers;
use App\Models\Traits\HasPrefixesList;
use App\Models\Traits\HasProfiles;
use App\Models\Traits\HasVocabularies;
use Backpack\CRUD\CrudTrait;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
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
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Elementset[] $elementsets
 * @property-read \App\Models\Access\User\User $eraser
 * @property-read mixed $current_language
 * @property-read mixed $language
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read \App\Models\Access\User\User $updater
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
    const TABLE = 'reg_agent';
    protected $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use CrudTrait, Cacheable;
    use Languages, HasLanguagesList;
    use HasProfiles, HasVocabularies, HasElementsets, HasMembers, HasPrefixesList;
    protected $blameable = [
        'created' => 'created_by',
        'updated' => 'updated_by',
        'deleted' => 'deleted_by',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    protected $casts = [];
    protected $hidden = [
        'id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'org_email',
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
        'name',
    ];
    public static $rules = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function badge( $count )
    {
        return '<span class="badge">' . $count . '</span>';
    }

    public function getTitleLink()
    {
        return '<a href="' .
            route( 'frontend.project.show', [ 'id' => $this->id ] ) .
            '">' .
            $this->title .
            '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
    /**
     * @return string
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
    /**
     * @param string $value
     */
    public function setTitleAttribute( string $value )
    {
        $this->attributes['org_name'] = $value;
    }
}
