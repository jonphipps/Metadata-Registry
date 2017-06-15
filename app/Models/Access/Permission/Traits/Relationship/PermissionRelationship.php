<?php

namespace App\Models\Access\Permission\Traits\Relationship;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class PermissionRelationship.
 */
trait PermissionRelationship
{
    public function roles(): ?BelongsToMany
    {
        return $this->belongsToMany( config( 'access.role' ),
            config( 'access.permission_role_table' ),
            'permission_id',
            'role_id' );
    }
}
