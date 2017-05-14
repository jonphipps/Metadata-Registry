<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\ElementSetHasVersion
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $created_user_id
 * @property int $schema_id
 * @property \Carbon\Carbon|null $timeslice
 * @property int $created_by
 * @property-read \App\Models\ElementSet|null $ElementSet
 * @property-read \App\Models\Access\User\User|null $UserCreator
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereTimeslice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasVersion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ElementSetHasVersion extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'schema_has_version';

    use SoftDeletes;

    protected $dates = [ 'deleted_at', 'timeslice' ];

    protected $fillable = [ 'name', 'deleted_at', 'timeslice' ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      "id"              => "integer",
      "name"            => "string",
      "created_user_id" => "integer",
      "schema_id"       => "integer",
    ];

    public static $rules = [
      "name" => "required|max:255",
    ];


    public function UserCreator()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id');
    }


    public function ElementSet()
    {
        return $this->belongsTo(\App\Models\ElementSet::class, 'schema_id', 'id');
    }
}
