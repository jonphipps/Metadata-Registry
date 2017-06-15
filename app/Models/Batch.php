<?php namespace App\Models;

use App\Models\Import;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Batch
 *
 * @property int $id
 * @property \Carbon\Carbon $run_time
 * @property string $run_description
 * @property string $object_type
 * @property int $object_id
 * @property \Carbon\Carbon $event_time
 * @property string $event_type
 * @property string $event_description
 * @property string $registry_uri
 * @property int $project_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereEventDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereEventTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereEventType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereProjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereRegistryUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereRunDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereRunTime($value)
 * @mixin \Eloquent
 */
class Batch extends Model
{
    const TABLE = 'reg_batch';
    protected $table = self::TABLE;
    public $timestamps = false;
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
    ];
    public static $rules = [
        'run_description'   => 'max:65535',
        'object_type'       => 'max:20',
        'event_type'        => 'max:20',
        'event_description' => 'max:65535',
        'registry_uri'      => 'max:255',
    ];

    public function imports(): ?HasMany
    {
        return $this->hasMany( Import::class, 'batch_id', 'id' );
    }

    public function project(): ?BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
