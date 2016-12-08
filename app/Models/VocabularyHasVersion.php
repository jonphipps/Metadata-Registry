<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\VocabularyHasVersion
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $created_user_id
 * @property integer $vocabulary_id
 * @property string $timeslice
 * @property-read \App\Models\User $UserCreator
 * @property-read \App\Models\Vocabulary $Vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereVocabularyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VocabularyHasVersion whereTimeslice($value)
 * @mixin \Eloquent
 */
class VocabularyHasVersion extends Model
{
    protected $table = 'reg_vocabulary_has_version';

    use SoftDeletes;

    protected $dates = ['deleted_at'];


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
        "vocabulary_id" => "integer"
    ];

    public static $rules = [
        "name" => "required|max:255"
    ];

    public function UserCreator()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id');
    }

    public function Vocabulary()
    {
        return $this->belongsTo('App\Models\Vocabulary', 'vocabulary_id', 'id');
    }

}

