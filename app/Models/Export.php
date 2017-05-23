<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 May 2017 17:01:29 +0000.
 */

namespace App\Models;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Reliese\Database\Eloquent\Model as Eloquent;
use const true;
use function unserialize;
use Backpack\CRUD\CrudTrait;

/**
 * App\Models\Export
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 * @property int $vocabulary_id
 * @property int $schema_id
 * @property bool $exclude_deprecated
 * @property bool $include_generated
 * @property bool $include_deleted
 * @property bool $include_not_accepted
 * @property \Illuminate\Support\Collection|null $selected_columns
 * @property string $selected_language
 * @property string $published_english_version
 * @property string $published_language_version
 * @property \Carbon\Carbon $last_vocab_update
 * @property int $profile_id
 * @property string $file
 * @property \Illuminate\Support\Collection|null $map
 * @property-read \App\Models\ElementSet $elementSet
 * @property-read \App\Models\Profile $profile
 * @property-read \App\Models\Access\User\User $user
 * @property-read \App\Models\Vocabulary $vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereExcludeDeprecated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereIncludeDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereIncludeGenerated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereIncludeNotAccepted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereLastVocabUpdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereMap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export wherePublishedEnglishVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export wherePublishedLanguageVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereSelectedColumns($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereSelectedLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Export whereVocabularyId($value)
 * @mixin \Eloquent
 */
class Export extends Eloquent
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const TABLE = 'reg_export_history';
    public $table = self::TABLE;

    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    protected $casts = [
        'user_id'              => 'int',
        'vocabulary_id'        => 'int',
        'schema_id'            => 'int',
        'exclude_deprecated'   => 'bool',
        'include_generated'    => 'bool',
        'include_deleted'      => 'bool',
        'include_not_accepted' => 'bool',
        'profile_id'           => 'int',
    ];

    protected $dates = [
        'last_vocab_update',
    ];

    protected $fillable = [
        'user_id',
        'vocabulary_id',
        'schema_id',
        'exclude_deprecated',
        'include_generated',
        'include_deleted',
        'include_not_accepted',
        'selected_columns',
        'selected_language',
        'published_english_version',
        'published_language_version',
        'last_vocab_update',
        'profile_id',
        'file',
        'map',
    ];

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getMapAttribute($value)
    {
        return $value ? collect(unserialize($value,[true])) : null;
    }

    /**
     * @param $value
     */
    public function setMapAttribute($value): void
    {
        $value ? $this->attributes['map'] = serialize($value) : null;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getSelectedColumnsAttribute($value)
    {
        return $value ? collect(unserialize($value,[true])) : null;
    }

    /**
     * @param $value
     */
    public function setSelectedColumnsAttribute($value): void
    {
        $value ? $this->attributes['selected_columns'] = serialize($value) : null;
    }

    /**
     * @return BelongsTo
     **/
    public function elementSet(): BelongsTo
    {
        return $this->belongsTo(ElementSet::class, 'schema_id');
    }

    /**
     * @return BelongsTo
     **/
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * @return BelongsTo
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     **/
    public function vocabulary(): BelongsTo
    {
        return $this->belongsTo(Vocabulary::class, 'vocabulary_id');
    }

    public static function findByExportFileName($name)
    {
        return self::whereFile($name)->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
