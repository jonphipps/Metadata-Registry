<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToProject;
use App\Models\Traits\HasLanguagesList;
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
 * @property array $languages
 * @property string $default_language
 * @property string $current_language
 * @property-read \App\Models\Access\User\User $creator
 * @property-read mixed $language
 * @property-read \App\Models\Project $project
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereAgentId($value)
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
    const TABLE = 'reg_agent_has_user';
    public static $rules = [
        'updated_at'       => 'required|',
        'user_id'          => 'required|',
        'agent_id'         => 'required|',
        'languages'        => 'max:65535',
        'default_language' => 'max:10',
        'current_language' => 'max:10',
    ];
    use SoftDeletes, Blameable, CreatedBy;
    use Languages, HasLanguagesList;
    use BelongsToProject;
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

}
