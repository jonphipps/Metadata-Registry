<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\RdfNamespace
 *
 * @property int $id
 * @property int $schema_id
 * @property string|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $created_user_id
 * @property int|null $updated_user_id
 * @property string $token
 * @property string|null $note
 * @property string $uri
 * @property string|null $schema_location
 * @property-read \App\Models\ElementSet $ElementSet
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereSchemaLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereUri($value)
 * @mixin \Eloquent
 */
class RdfNamespace extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_rdf_namespace';

    use SoftDeletes;


    public function getDates()
    {
        return [ 'deleted_at' ];
    }


    protected $fillable = [
      'deleted_at',
      'created_user_id',
      'updated_user_id',
      'token',
      'note',
      'uri',
      'schema_location',
    ];


    public function ElementSet()
    {
        return $this->belongsTo(\App\Models\ElementSet::class, 'schema_id', 'id');
    }
}
