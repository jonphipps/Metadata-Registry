<?php namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Batch
 *
 * @property int $id
 * @property \Carbon\Carbon|null $run_time
 * @property string $run_description
 * @property string $object_type
 * @property int $object_id
 * @property \Carbon\Carbon|null $event_time
 * @property string $event_type
 * @property string $event_description
 * @property string $registry_uri
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $project_id
 * @property int|null $user_id
 * @property string|null $next_step
 * @property array $step_data
 * @property int $total_count
 * @property int $handled_count
 * @property mixed|null $handled_array
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\Access\User\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereEventDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereEventTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereHandledArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereHandledCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereNextStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereObjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereRegistryUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereRunDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereRunTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereStepData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereUserId($value)
 * @mixin \Eloquent
 */
class Batch extends Model
{
    use BelongsToUser;

    const TABLE = 'reg_batch';
    protected $table = self::TABLE;
    protected $dates = [ 'run_time', 'event_time' ];
    protected $guarded = [ 'id' ];
    protected $casts = [
        'id'                => 'integer',
        'run_description'   => 'string',
        'object_type'       => 'string',
        'object_id'         => 'integer',
        'event_type'        => 'string',
        'event_description' => 'string',
        'registry_uri'      => 'string',
        'step_data'         => 'array',
        'handled_array'     => 'array',
    ];
    public static $rules = [
        'run_description'   => 'max:65535',
        'object_type'       => 'max:20',
        'event_type'        => 'max:20',
        'event_description' => 'max:65535',
        'registry_uri'      => 'max:255',
    ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @param Import|iterable $imports
     *
     * @return $this
     */
    public function addImports($imports)
    {
        if (is_iterable($imports)) {
            /** @noinspection NullPointerExceptionInspection */
            $this->imports()->saveMany($imports);
        } else {
            /** @noinspection NullPointerExceptionInspection */
            $this->imports()->save($imports);
        }

        return $this;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function dataHas($key): bool
    {
        $data = $this->step_data;

        return isset($data[ $key ]);
    }

    /**
     * @param string $key
     *
     * @return array|null
     */
    public function dataGet($key): ?array
    {
        $data = $this->step_data;

        return $data[ $key ] ?? null;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function imports(): ?HasMany
    {
        return $this->hasMany(Import::class, 'batch_id', 'id');
    }

    public function project(): ?BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getNextStepAttribute($value): string
    {
        return $value ?? 'spreadsheet';

    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
