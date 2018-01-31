<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Omr\VocabularyUser
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $vocabulary_id
 * @property int $user_id
 * @property int|null $is_maintainer_for
 * @property int|null $is_registrar_for
 * @property int|null $is_admin_for
 * @property string|null $languages
 * @property string|null $default_language
 * @property string|null $current_language
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\VocabularyUser onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereCurrentLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereIsMaintainerFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\VocabularyUser whereVocabularyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\VocabularyUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\VocabularyUser withoutTrashed()
 * @mixin \Eloquent
 */
class VocabularyUser extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql_omr';
    protected $table      = self::TABLE;
    protected $dates      = ['deleted_at'];

    public const TABLE = 'reg_vocabulary_has_user';
}
