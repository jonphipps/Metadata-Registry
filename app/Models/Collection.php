<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\Collection
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $last_updated
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int $vocabulary_id
 * @property string $name
 * @property string $uri
 * @property string $pref_label
 * @property int $status_id
 * @property-read \App\Models\Access\User\User $UserCreator
 * @property-read \App\Models\Access\User\User $UserUpdater
 * @property-read \App\Models\Vocabulary $Vocabulary
 * @property-read \App\Models\Status $Status
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereLastUpdated( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereUpdatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereVocabularyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection wherePrefLabel( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Collection whereStatusId( $value )
 * @mixin \Eloquent
 */
class Collection extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_collection';

    use SoftDeletes;


    public function getDates()
    {
        return [ 'deleted_at', 'last_updated' ];
    }


    protected $fillable = [ 'deleted_at', 'last_updated', 'name', 'uri', 'pref_label' ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      "id"              => "integer",
      "created_user_id" => "integer",
      "updated_user_id" => "integer",
      "vocabulary_id"   => "integer",
      "name"            => "string",
      "uri"             => "string",
      "pref_label"      => "string",
      "status_id"       => "integer",
    ];

    public static $rules = [
      "name"       => "required|max:255",
      "uri"        => "max:255",
      "pref_label" => "required|max:255",
      "status_id"  => "required|",
    ];


    public function UserCreator()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id');
    }


    public function UserUpdater()
    {
        return $this->belongsTo(User::class, 'updated_user_id', 'id');
    }


    public function Vocabulary()
    {
        return $this->belongsTo('App\Models\Vocabulary', 'vocabulary_id', 'id');
    }


    public function Status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }
}
