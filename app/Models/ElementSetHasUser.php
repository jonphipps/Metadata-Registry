<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\ElementSetHasUser
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property int $schema_id
 * @property int $user_id
 * @property bool $is_maintainer_for
 * @property bool $is_registrar_for
 * @property bool $is_admin_for
 * @property string $languages
 * @property string $default_language
 * @property string $current_language
 * @property-read \App\Models\ElementSet $ElementSet
 * @property-read \App\Models\Access\User\User $User
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereCurrentLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereIsMaintainerFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereLanguages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementSetHasUser whereUserId($value)
 * @mixin \Eloquent
 */
class ElementSetHasUser extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'schema_has_user';

    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
      'deleted_at',
      'is_maintainer_for',
      'is_registrar_for',
      'is_admin_for',
      'languages',
      'default_language',
      'current_language',
    ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      "id"                => "integer",
      "schema_id"         => "integer",
      "user_id"           => "integer",
      "is_maintainer_for" => "boolean",
      "is_registrar_for"  => "boolean",
      "is_admin_for"      => "boolean",
      "languages"         => "string",
      "default_language"  => "string",
      "current_language"  => "string",
    ];

    public static $rules = [
      "schema_id"        => "required|",
      "user_id"          => "required|",
      "languages"        => "max:65535",
      "default_language" => "required|max:6",
      "current_language" => "max:6",
    ];


    public function ElementSet()
    {
        return $this->belongsTo(\App\Models\ElementSet::class, 'schema_id', 'id');
    }


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
