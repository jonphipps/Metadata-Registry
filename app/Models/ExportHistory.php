<?php

namespace App\Models;

use App\Models\Access\User\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ExportHistory extends Model
{
    public $table = 'reg_export_history';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'vocabulary_id',
        'schema_id',
        'exclude_deprecated',
        'include_generated',
        'include_deleted',
        'selected_columns',
        'selected_language',
        'published_english_version',
        'published_language_version',
        'last_vocab_update',
        'profile_id'
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
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     **/
    public function vocabulary(): BelongsTo
    {
        return $this->belongsTo(Vocabulary::class);
    }

    /**
     * @return BelongsTo
     **/
    public function elementSet(): BelongsTo
    {
        return $this->belongsTo(ElementSet::class);
    }
}
