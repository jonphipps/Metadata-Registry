<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\ProjectHasUser
 *
 * @property int $id
 * @property string|null $created_at
 * @property string $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $user_id
 * @property int $project_id
 * @property bool $is_registrar_for
 * @property bool $is_admin_for
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Access\User\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereAgentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser whereUserId($value)
 * @mixin \Eloquent
 */
class ProjectUser extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'project_user';

    use SoftDeletes;


    public function getDates()
    {
        return [ 'deleted_at' ];
    }


    protected $fillable = [ 'deleted_at', 'is_registrar_for', 'is_admin_for' ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      'id'               => 'integer',
      'user_id'          => 'integer',
      'project_id'         => 'integer',
      'is_registrar_for' => 'boolean',
      'is_admin_for'     => 'boolean',
    ];

    public static $rules = [
      'updated_at' => 'required|',
      'user_id'    => 'required|',
      'project_id'   => 'required|',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}