<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToElementset;
use App\Models\Traits\HasLanguagesList;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ElementsetUser
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $schema_id
 * @property int $user_id
 * @property bool $is_maintainer_for
 * @property bool $is_registrar_for
 * @property bool $is_admin_for
 * @property array $languages
 * @property string $default_language
 * @property string $current_language
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \App\Models\Elementset $elementset
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementsetUser onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereCurrentLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereIsMaintainerFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereSchemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementsetUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementsetUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementsetUser withoutTrashed()
 * @mixin \Eloquent
 */
class ElementsetUser extends Model
{
    const TABLE = 'schema_has_user';
    public static $rules = [
        'schema_id'        => 'required|',
        'user_id'          => 'required|',
        'languages'        => 'max:65535',
        'default_language' => 'required|max:6',
        'current_language' => 'max:6',
    ];
    use SoftDeletes, Blameable, CreatedBy;
    use Languages, HasLanguagesList;
    use BelongsToElementset;
    protected $table = self::TABLE;
    protected $blameable = [
        'created' => 'user_id',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    protected $casts = [
        'id'                => 'integer',
        'schema_id'         => 'integer',
        'user_id'           => 'integer',
        'is_maintainer_for' => 'boolean',
        'is_registrar_for'  => 'boolean',
        'is_admin_for'      => 'boolean',
        'languages'         => 'string',
        'default_language'  => 'string',
        'current_language'  => 'string',
    ];
}
