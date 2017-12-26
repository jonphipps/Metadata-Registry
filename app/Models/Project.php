<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\HasElementsets;
use App\Models\Traits\HasImports;
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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string|null $description
 * @property int|null $is_private
 * @property string|null $repo
 * @property string|null $license
 * @property string $org_email
 * @property string $org_name
 * @property string|null $ind_affiliation
 * @property string|null $ind_role
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $web_address
 * @property string|null $type
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $name
 * @property string|null $label
 * @property string|null $url
 * @property string|null $license_uri
 * @property string|null $base_domain
 * @property string|null $namespace_type
 * @property string|null $uri_strategy
 * @property string|null $uri_prepend
 * @property string|null $uri_append
 * @property int|null $starting_number
 * @property string|null $default_language
 * @property string|null $languages
 * @property string|null $prefixes
 * @property string|null $google_sheet_url
 * @property int|null $repo_is_valid
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Elementset[] $elementsets
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Batch[] $importBatches
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Release[] $releases
 * @property-read \App\Models\Access\User\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $vocabularies
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereBaseDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereGoogleSheetUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereIndAffiliation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereIndRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereIsPrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereLicenseUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereNamespaceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereOrgEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereOrgName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project wherePrefixes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereRepo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereRepoIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereStartingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUriAppend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUriPrepend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUriStrategy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereWebAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project withoutTrashed()
 * @mixin \Eloquent
 */
class Project extends Model
{
    const TABLE = 'reg_agent';
    public static $rules = [];
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use CrudTrait, Cacheable;
    use Languages;
    use HasProfiles, HasVocabularies, HasElementsets, HasMembers, HasPrefixesList, HasImports;
    protected $table = self::TABLE;
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

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getTitleLink(): string
    {
        return '<a href="' . route('frontend.crud.projects.show', [ 'id' => $this->id ]) . '">' . $this->title . '</a>';
    }

    public static function badge($count): string
    {
        return '<span class="badge">' . $count . '</span>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function importBatches(): ?HasMany
    {
        return $this->hasMany(Batch::class);
    }

    public function imports(): ?HasManyThrough
    {
        return $this->hasManyThrough(Import::class, Batch::class);
    }

    public function releases(): ?HasMany
    {
        return $this->hasMany(Release::class, 'agent_id', 'id');
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
    public function ScopePrivate($query)
    {
        return $query->where('is_private', true);
    }

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function ScopePublic($query)
    {
        return $query->where('is_private', '<>', 1);
    }


    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
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
    public function setTitleAttribute(string $value)
    {
        $this->attributes['org_name'] = $value;
    }
}
