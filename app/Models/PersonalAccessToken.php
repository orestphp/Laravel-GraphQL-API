<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    protected $table = 'personal_access_tokens';

    /**
     * Tinker:
     *     0 => "aggregate"
    1 => "average"
    2 => "avg"
    3 => "count"
    4 => "dd"
    5 => "doesntExist"
    6 => "dump"
    7 => "exists"
    8 => "explain"
    9 => "getBindings"
    10 => "getConnection"
    11 => "getGrammar"
    12 => "insert"
    13 => "insertGetId"
    14 => "insertOrIgnore"
    15 => "insertUsing"
    16 => "max"
    17 => "min"
    18 => "raw"
    19 => "sum"
    20 => "toSql"

     */
}
