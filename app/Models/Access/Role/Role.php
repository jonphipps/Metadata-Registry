<?php

namespace App\Models\Access\Role;

use App\Models\Access\Role\Traits\Attribute\RoleAttribute;
use App\Models\Access\Role\Traits\Relationship\RoleRelationship;
use App\Models\Access\Role\Traits\RoleAccess;
use App\Models\Access\Role\Traits\Scope\RoleScope;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Access\Role\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property int $all
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $action_buttons
 * @property-read string $delete_button
 * @property-read string $edit_button
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Permission\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role sort($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role whereAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Role\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    use RoleScope, RoleAccess, RoleAttribute, RoleRelationship;
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
    protected $fillable = ['name', 'display_name', 'all', 'sort'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.roles_table');
    }
}
