<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $lat
 * @property float $lon
 * @property Carbon|null $date
 * @property string $image_path
 * @property int $user_id
 *
 * @property-read Carbon|null $created_at timestamp of creation
 * @property-read Carbon|null $updated_at timestamp of last update
 * @property-read Carbon|null $deleted_at timestamp of last update
 *
 * @package App\Models
 */
class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'lat',
        'lon',
        'date',
        'image_path',
        'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subProjects(): HasMany
    {
        return $this->hasMany(SubProject::class);
    }
}
