<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public static function allNames()
    {
        return self::pluck('name')->toArray();
    }
}
