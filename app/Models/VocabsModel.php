<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToProfile;
use App\Models\Traits\BelongsToProject;
use App\Models\Traits\HasImports;
use App\Models\Traits\HasLanguagesList;
use App\Models\Traits\HasMembers;
use App\Models\Traits\HasPrefixesList;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

abstract class VocabsModel extends Model
{
    public const TABLE ='';
    public $table = self::TABLE;

    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Cacheable;
    use Languages, HasLanguagesList, HasPrefixesList, HasMembers, HasImports;
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
        'repo'        => 'max:255',
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
    public static function selectByProject( $projectId )
    {
        return self::select( [ 'id', 'name', ] )
            ->where( 'agent_id', $projectId )
            ->orderBy( 'name' )
            ->get()
            ->mapWithKeys( function( $item ) {
                return [ $item['id'] => $item['name'] ];
            } );
    }

    /**
     * @param int $project_id
     *
     * @return string
     */
    public static function create_route(int $project_id): string {}
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */


    public function releases(): ?MorphToMany
    {
        return $this->morphToMany(Release::class, 'releaseable');
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getPrefixesAttribute($value)
    {
        return unserialize($value, [ true ]);
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
