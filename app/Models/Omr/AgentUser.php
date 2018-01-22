<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Omr\AgentUser.
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $user_id
 * @property int $agent_id
 * @property int|null $is_registrar_for
 * @property int|null $is_admin_for
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\AgentUser onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\AgentUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\AgentUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\AgentUser withoutTrashed()
 * @mixin \Eloquent
 */
class AgentUser extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql_omr';
    protected $table      = self::TABLE;
    protected $dates      = ['deleted_at'];

    public const TABLE = 'reg_agent_has_user';
}
