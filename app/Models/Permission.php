<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

/*
 * This Model is for abstraction in this project, we provide access by Role, not Permission
 */
class Permission extends SpatiePermission
{
    public static function allNames()
    {
        return self::pluck('name')->toArray();
    }
}
