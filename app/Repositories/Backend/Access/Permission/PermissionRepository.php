<?php

namespace App\Repositories\Backend\Access\Permission;

use App\Models\Access\Permission\Permission;
use App\Repositories\BaseRepository;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Permission::class;
}
