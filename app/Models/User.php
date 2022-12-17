<?php

namespace App\Models;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Contracts\HasApiTokens as HasApiTokensContract;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property int $id
 * @property string $name displayed name
 * @property string $email email
 * @property Carbon|null $email_verified_at timestamp of email verification
 * @property string $password
 * @property string|null $remember_token
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $ic
 * @property string $dic
 * @property string $street
 * @property string $building_number
 * @property string $city
 * @property string $zip
 * @property string $country
 * @property string|null $avatar user avatar saved in base64
 * @property-read Carbon|null $created_at timestamp of creation
 * @property-read Carbon|null $updated_at timestamp of last update
 * @property-read Carbon|null $deleted_at timestamp of last update
 *
 * @package App\Models\Models
 */
class User extends Authenticatable implements HasApiTokensContract
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    protected $guard_name = 'sanctum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'company_name',
        'ic',
        'dic',
        'street',
        'building_number',
        'city',
        'zip',
        'country',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

}
