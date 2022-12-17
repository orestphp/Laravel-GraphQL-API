<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MeasurementData
 *
 * @property int $id
 * @property string $data
 * @property int|null $measurement_id
 *
 * @property-read Carbon|null $created_at timestamp of creation
 * @property-read Carbon|null $updated_at timestamp of last update
 * @property-read Carbon|null $deleted_at timestamp of last update
 *
 * @property-read Measurement|null $measurement
 *
 * @mixin Builder
 *
 * @method static Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method static firstOrNew(array $attributes = [], array $values = [])
 * @method static firstOrFail($columns = ['*'])
 * @method static firstOrCreate(array $attributes, array $values = [])
 * @method static firstOr($columns = ['*'], Closure $callback = null)
 * @method static firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method static updateOrCreate(array $attributes, array $values = [])
 * @method null|static first($columns = ['*'])
 * @method static static findOrFail($id, $columns = ['*'])
 * @method static static findOrNew($id, $columns = ['*'])
 * @method static null|static find($id, $columns = ['*'])
 *
 * @package App\Models
 */
class MeasurementData extends Model
{
//    use HasFactory;
    use SoftDeletes;

    public function measurement(): BelongsTo
    {
        return $this->belongsTo(Measurement::class);
    }
}
