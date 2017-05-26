<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereEventDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereEventTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereEventType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch whereObjectType($value)
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

    public function imports()
    {
        return $this->hasMany( \App\Models\Import::class, 'batch_id', 'id' );
    }
}
