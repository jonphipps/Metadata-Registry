<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\VocabularyHasUser
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $vocabulary_id
 * @property integer $user_id
 * @property boolean $is_maintainer_for
 * @property boolean $is_registrar_for
 * @property boolean $is_admin_for
 * @property string $languages
 * @property string $default_language
 * @property string $current_language
 * @property-read \App\Models\User $User
 * @property-read \App\Models\Vocabulary $Vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereVocabularyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereIsMaintainerFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereIsRegistrarFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereIsAdminFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereLanguages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasUser whereCurrentLanguage($value)
 * @mixin \Eloquent
 */
class VocabularyHasUser extends Model
{
    protected $table = 'reg_vocabulary_has_user';

    use SoftDeletes;



    protected $dates = ['deleted_at'];


    protected $fillable = array('deleted_at', 'is_maintainer_for', 'is_registrar_for', 'is_admin_for', 'languages',
        'default_language', 'current_language');

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
        "vocabulary_id" => "integer",
        "user_id" => "integer",
        "is_maintainer_for" => "boolean",
        "is_registrar_for" => "boolean",
        "is_admin_for" => "boolean",
        "languages" => "string",
        "default_language" => "string",
        "current_language" => "string"
    ];

    public static $rules = [
        "updated_at" => "required|",
        "vocabulary_id" => "required|",
        "user_id" => "required|",
        "languages" => "max:65535",
        "default_language" => "max:6",
        "current_language" => "max:6"
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function Vocabulary()
    {
        return $this->belongsTo('App\Models\Vocabulary', 'vocabulary_id', 'id');
    }

}

