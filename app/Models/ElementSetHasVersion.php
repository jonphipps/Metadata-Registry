<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\ElementSetHasVersion
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $created_user_id
 * @property integer $schema_id
 * @property \Carbon\Carbon $timeslice
 * @property-read \App\Models\User $UserCreator
 * @property-read \App\Models\ElementSet $ElementSet
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereTimeslice($value)
 * @mixin \Eloquent
 */
class ElementSetHasVersion extends Model
{
    protected $table = 'schema_has_version';

    use SoftDeletes;


    protected $dates = ['deleted_at', 'timeslice'];



    protected $fillable = array('name', 'deleted_at', 'timeslice');

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
        "name" => "string",
        "created_user_id" => "integer",
        "schema_id" => "integer"
    ];

    public static $rules = [
        "name" => "required|max:255"
    ];

    public function UserCreator()
    {
        return $this->belongsTo('App\Models\User', 'created_user_id', 'id');
    }

    public function ElementSet()
    {
        return $this->belongsTo('App\Models\ElementSet', 'schema_id', 'id');
    }

}

