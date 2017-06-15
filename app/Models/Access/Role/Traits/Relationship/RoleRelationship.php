<?php

namespace App\Models\Access\Role\Traits\Relationship;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class RoleRelationship.
 */
trait RoleRelationship
{
    public function users(): ?BelongsToMany
    {
        return $this->belongsToMany( config( 'auth.providers.users.model' ),
            config( 'access.role_user_table' ),
            'role_id',
            'user_id' );
    }

    public function permissions(): ?BelongsToMany
    {
        return $this->belongsToMany( config( 'access.permission' ),
            config( 'access.permission_role_table' ),
            'role_id',
            'permission_id' )->orderBy( 'display_name', 'asc' );
    }
}
