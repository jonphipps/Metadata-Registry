<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Omr\SchemaUser
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $schema_id
 * @property int $user_id
 * @property int|null $is_maintainer_for
 * @property int|null $is_registrar_for
 * @property int|null $is_admin_for
 * @property string|null $languages
 * @property string $default_language
 * @property string|null $current_language
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\SchemaUser onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereCurrentLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereIsMaintainerFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereSchemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\SchemaUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\SchemaUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\SchemaUser withoutTrashed()
 * @mixin \Eloquent
 */
class SchemaUser extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql_omr';
    protected $table      = self::TABLE;
    protected $dates      = ['deleted_at'];

    public const TABLE = 'schema_has_user';
}
