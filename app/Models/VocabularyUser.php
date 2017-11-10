<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToVocabulary;
use App\Models\Traits\HasLanguagesList;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\VocabularyUser
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $vocabulary_id
 * @property int $user_id
 * @property bool $is_maintainer_for
 * @property bool $is_registrar_for
 * @property bool $is_admin_for
 * @property array $languages
 * @property string $default_language
 * @property string $current_language
 * @property-read \App\Models\Access\User\User $creator
 * @property-read mixed $language
 * @property-read \App\Models\Vocabulary $vocabulary
 * @method bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyUser onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereCurrentLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereIsMaintainerFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VocabularyUser whereVocabularyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyUser withoutTrashed()
 * @mixin \Eloquent
 */
class VocabularyUser extends Model
{
    const TABLE = 'reg_vocabulary_has_user';
    public static $rules = [
        'updated_at'       => 'required|',
        'vocabulary_id'    => 'required|',
        'user_id'          => 'required|',
        'languages'        => 'max:65535',
        'default_language' => 'max:6',
        'current_language' => 'max:6',
    ];
    use SoftDeletes, Blameable, CreatedBy;
    use Languages, HasLanguagesList;
    use BelongsToVocabulary;
    protected $table = self::TABLE;
    protected $blameable = [
        'created' => 'user_id',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    protected $casts = [
        'id'                => 'integer',
        'vocabulary_id'     => 'integer',
        'user_id'           => 'integer',
        'is_maintainer_for' => 'boolean',
        'is_registrar_for'  => 'boolean',
        'is_admin_for'      => 'boolean',
        'languages'         => 'string',
        'default_language'  => 'string',
        'current_language'  => 'string',
    ];
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
