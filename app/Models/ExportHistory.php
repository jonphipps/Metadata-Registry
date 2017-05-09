<?php

namespace App\Models;

use App\Models\Access\User\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\ExportHistory
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 * @property int $vocabulary_id
 * @property int $schema_id
 * @property bool $exclude_deprecated
 * @property bool $include_generated
 * @property bool $include_deleted
 * @property bool $include_not_accepted
 * @property string $selected_columns
 * @property string $selected_language
 * @property string $published_english_version
 * @property string $published_language_version
 * @property \Carbon\Carbon|null $last_vocab_update
 * @property int $profile_id
 * @property string|null $file
 * @property string|null $map
 * @property-read \App\Models\ElementSet|null $elementSet
 * @property-read \App\Models\Profile|null $profile
 * @property-read \App\Models\Access\User\User|null $user
 * @property-read \App\Models\Vocabulary|null $vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereExcludeDeprecated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereIncludeDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereIncludeGenerated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereIncludeNotAccepted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereLastVocabUpdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereMap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory wherePublishedEnglishVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory wherePublishedLanguageVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereSelectedColumns($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereSelectedLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ExportHistory whereVocabularyId($value)
 * @mixin \Eloquent
 */
class ExportHistory extends Model
{
    public $table = 'reg_export_history';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

	protected $dates = [
		'last_vocab_update'
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
		'map'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'vocabulary_id' => 'integer',
        'schema_id' => 'integer',
        'exclude_deprecated' => 'boolean',
        'include_generated' => 'boolean',
        'include_deleted' => 'boolean',
        'include_not_accepted' => 'boolean',
        'selected_columns' => 'string',
        'selected_language' => 'string',
        'published_english_version' => 'string',
        'published_language_version' => 'string',
        'profile_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

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

    /**
     * @return BelongsTo
     **/
    public function elementSet(): BelongsTo
    {
        return $this->belongsTo(ElementSet::class, 'schema_id');
    }

    public function profile()
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }
}
