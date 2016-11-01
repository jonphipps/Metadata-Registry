<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\RdfNamespace
 *
 * @property int $id
 * @property int $schema_id
 * @property string $created_at
 * @property \Carbon\Carbon $deleted_at
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property string $token
 * @property string $note
 * @property string $uri
 * @property string $schema_location
 * @property-read \App\Models\ElementSet $ElementSet
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RdfNamespace whereSchemaLocation($value)
 * @mixin \Eloquent
 */
class RdfNamespace extends Model
{
    protected $table = 'reg_rdf_namespace';

    use SoftDeletes;

    public function getDates()
    {
        return array('deleted_at');
    }

    protected $fillable = array('deleted_at', 'created_user_id', 'updated_user_id', 'token', 'note', 'uri',
        'schema_location');

    public function ElementSet()
    {
        return $this->belongsTo('App\Models\ElementSet', 'schema_id', 'id');
    }

}

