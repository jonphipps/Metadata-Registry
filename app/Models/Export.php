<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 May 2017 17:01:29 +0000.
 */

namespace App\Models;

use App\Models\Traits\BelongsToElementset;
use App\Models\Traits\BelongsToProfile;
use App\Models\Traits\BelongsToVocabulary;
use Backpack\CRUD\CrudTrait;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use const true;
use function is_iterable;
use function unserialize;

/**
 * App\Models\Export
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
 * @property \Illuminate\Support\Collection|null $selected_columns
 * @property string|null $selected_language
 * @property string|null $published_english_version
 * @property string|null $published_language_version
 * @property \Carbon\Carbon|null $last_vocab_update
 * @property int $profile_id
 * @property string|null $file
 * @property \Illuminate\Support\Collection|null $map
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Elementset|null $elementset
 * @property-read mixed $languages
 * @property-read mixed $worksheet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import[] $imports
 * @property-read \App\Models\Profile|null $profile
 * @property-read \App\Models\Vocabulary|null $vocabulary
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereExcludeDeprecated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereIncludeDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereIncludeGenerated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereIncludeNotAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereLastVocabUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export wherePublishedEnglishVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export wherePublishedLanguageVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereSchemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereSelectedColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereSelectedLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Export whereVocabularyId($value)
 * @mixin \Eloquent
 */
class Export extends Model
{
    const TABLE = 'reg_export_history';
    public $table = self::TABLE;
    use CrudTrait;
    use Blameable, CreatedBy;
    use BelongsToProfile, BelongsToVocabulary, BelongsToElementset;
    protected $blameable = [
        'created' => 'user_id',
    ];
    protected $dates = [
        'last_vocab_update',
    ];
    protected $guarded = [ 'id' ];
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
    public static $rules = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function findByExportFileName(string $name, $extension = 'csv'): ?self
    {
        return self::whereFile( $name . '.' . $extension )->first();
    }

    /**
     * @param Import|iterable $imports
     *
     * @return $this
     */
    public function addImports($imports)
    {
        if (is_iterable($imports)) {
            $this->imports()->saveMany($imports);
        } else {
            $this->imports()->save($imports);
        }
        return $this;

    }

    /**
     * @return Import|null
     */
    public function getLatestImport(): ?Import
    {
        return $this->imports()->latest()->first();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function imports(): ?HasMany
    {
        return $this->hasMany(Import::class);
    }

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

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getMapAttribute($value)
    {
        return $value? collect(unserialize($value, [ true ])): null;
    }

    public function getWorksheetAttribute(): ?string
    {
        $arr = explode('_', $this->attributes['file']);

        return $arr[0] ?? null;
    }

    public function getLanguagesAttribute(): ?string
    {
        $arr = explode('_', $this->attributes['file']);

        return $arr[1] ?? null;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getSelectedColumnsAttribute( $value )
    {
        return $value ? collect( unserialize( $value, [ true ] ) ) : null;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    /**
     * @param $value
     */
    public function setMapAttribute( $value ): void
    {
        $value ? $this->attributes['map'] = serialize( $value ) : null;
    }

    /**
     * @param $value
     */
    public function setSelectedColumnsAttribute( $value ): void
    {
        $value ? $this->attributes['selected_columns'] = serialize( $value ) : null;
    }
}
