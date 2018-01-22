<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Access\Permission\Permission.
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Role\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Permission\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Permission\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Permission\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Permission\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Permission\Permission whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\Permission\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use PermissionRelationship;
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
    protected $fillable = ['name', 'display_name', 'sort'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.permissions_table');
    }
}
