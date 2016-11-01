<?php

namespace App\Models\Access\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\Role\Traits\RoleAccess;
use App\Models\Access\Role\Traits\Scope\RoleScope;
use App\Models\Access\Role\Traits\Attribute\RoleAttribute;
use App\Models\Access\Role\Traits\Relationship\RoleRelationship;

/**
 * App\Models\Access\Role\Role
 *
 * @property int $id
 * @property string $name
 * @property bool $all
 * @property int $sort
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $edit_button
 * @property-read string $delete_button
 * @property-read string $action_buttons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Permission\Permission[] $permissions
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereAll($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereSort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role sort($direction = 'asc')
 * @mixin \Eloquent
 */
class Role extends Model
{
    use RoleScope,
		RoleAccess,
		RoleAttribute,
		RoleRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'all', 'sort'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.roles_table');
    }
}
