<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToProject;
use App\Models\Traits\BelongsToUser;
use Backpack\CRUD\CrudTrait;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProjectUser
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $user_id
 * @property int $agent_id
 * @property bool $is_registrar_for
 * @property bool $is_admin_for
 * @property bool $is_maintainer_for
 * @property mixed $languages
 * @property string $default_language
 * @property string $current_language
 * @property int $authorized_as
 * @property-read \App\Models\Access\User\User $creator
 * @property-read mixed $project_id
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Access\User\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereAuthorizedAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereCurrentLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereIsMaintainerFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser withoutTrashed()
 * @mixin \Eloquent
 */
class ProjectUser extends Model
{
    public const TABLE = 'reg_agent_has_user';
    public const AUTH_ADMIN = 0;
    public const AUTH_MAINTAINER = 1;
    public const AUTH_LANGUAGE_MAINTAINER = 2;
    public const AUTH_VIEWER = 3;

    public static $rules = [
        'updated_at'       => 'required|',
        'user_id'          => 'required|',
        'agent_id'         => 'required|',
    ];
    use CrudTrait, SoftDeletes, Blameable, CreatedBy;
    use Languages;
    use BelongsToProject, BelongsToUser;
    protected $table = self::TABLE;
    protected $blameable = [
        'created' => 'user_id',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    protected $casts = [
        'id'                => 'integer',
        'user_id'           => 'integer',
        'agent_id'          => 'integer',
        'is_registrar_for'  => 'boolean',
        'is_maintainer_for' => 'boolean',
        'is_admin_for'      => 'boolean',
        'languages'         => 'text',
        'default_language'  => 'string',
        'current_language'  => 'string',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setAuthorizedAsAttribute($value)
    {
        if ($value === self::AUTH_ADMIN) { //project admin
            $this->attributes['is_admin_for']      = 1;
            $this->attributes['is_maintainer_for'] = 1;
        }
        if ($value === self::AUTH_LANGUAGE_MAINTAINER || $value === self::AUTH_MAINTAINER) { //project maintainer
            $this->attributes['is_admin_for']      = 0;
            $this->attributes['is_maintainer_for'] = 1;
        }
        if ($value === self::AUTH_VIEWER) { //project member
            $this->attributes['is_admin_for']      = 0;
            $this->attributes['is_maintainer_for'] = 0;
        }
    }

}
