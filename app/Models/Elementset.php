<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Element;
use App\Models\Traits\BelongsToProfile;
use App\Models\Traits\BelongsToProject;
use App\Models\Traits\HasLanguagesList;
use App\Models\Traits\HasMembers;
use App\Models\Traits\HasPrefixesList;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Elementset
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int $deleted_user_id
 * @property string $child_updated_at
 * @property int $child_updated_user_id
 * @property int $agent_id
 * @property string $label
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
 * @property string $spreadsheet
 * @property string $worksheet
 * @property string $prefix
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Element[] $elements
 * @property-read \App\Models\Access\User\User $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \App\Models\Profile $profile
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User $updater
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereAgentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereBaseDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereChildUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereCommunity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereDeletedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereLanguages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereLastUriId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereNsType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset wherePrefix($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset wherePrefixes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereRepo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereSpreadsheet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Elementset whereWorksheet($value)
 * @mixin \Eloquent
 */
class Elementset extends Model
{
    const TABLE = 'reg_schema';
    public $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Cacheable;
    use Languages, HasLanguagesList, HasPrefixesList, HasMembers;
    use BelongsToProject, BelongsToProfile, HasStatus;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_user_id',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
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
        'repo'                  => 'string',
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
        'repo'        => 'required|max:255',
    ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @param int $projectId
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function selectElementSetsByProject( $projectId )
    {
        return Elementset::select( [ 'id', 'name', ] )
            ->where( 'agent_id', $projectId )
            ->orderBy( 'name' )
            ->get()
            ->mapWithKeys( function( $item ) {
                return [ $item['id'] => $item['name'] ];
            } );
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function elements()
    {
        return $this->hasMany( Element::class, 'schema_id', 'id' );
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getPrefixesAttribute( $value )
    {
        return unserialize( $value, [ true ] );
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setPrefixesAttribute( $value )
    {
        $this->attributes['prefixes'] = serialize( $value );
    }
}
