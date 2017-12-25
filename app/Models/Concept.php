<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToVocabulary;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Concept
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $created_user_id
 * @property int|null $updated_user_id
 * @property string $uri
 * @property string|null $lexical_alias
 * @property string $pref_label
 * @property int|null $vocabulary_id
 * @property int|null $is_top_concept
 * @property int|null $pref_label_id
 * @property int $status_id
 * @property string $language
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property string $label
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttribute[] $statements
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @property-read \App\Models\Vocabulary|null $vocabulary
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereIsTopConcept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereLexicalAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept wherePrefLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept wherePrefLabelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Concept whereVocabularyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept withoutTrashed()
 * @mixin \Eloquent
 */
class Concept extends Model
{
    const TABLE = 'reg_concept';
    const FORM_PROPERTIES = [ 45, 49, 59, 62, 74 ];
    protected $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Cacheable;
    use Languages, BelongsToVocabulary, HasStatus;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_by',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @param int $projectId
     *
     * @return array
     */
    public static function selectConceptsByProject($projectId): array
    {
        return \DB::table(ConceptAttribute::TABLE)
            ->join(Concept::TABLE,
                Concept::TABLE . '.id',
                '=',
                ConceptAttribute::TABLE . '.concept_id')
            ->join(Vocabulary::TABLE,
                Vocabulary::TABLE . '.id',
                '=',
                Concept::TABLE . '.vocabulary_id')
            ->select(ConceptAttribute::TABLE . '.concept_id as id',
                Vocabulary::TABLE . '.name as vocabulary',
                ConceptAttribute::TABLE . '.language',
                ConceptAttribute::TABLE . '.object as label')
            ->where([
                [ ConceptAttribute::TABLE . '.profile_property_id', 45, ],
                [ Vocabulary::TABLE . '.agent_id', $projectId, ],
            ])
            ->orderBy(Vocabulary::TABLE . '.name')
            ->orderBy(ConceptAttribute::TABLE . '.language')
            ->orderBy(ConceptAttribute::TABLE . '.object')
            ->get()
            ->mapWithKeys(function($item) {
                return [
                    $item->id . '_' . $item->language => $item->vocabulary .
                        ' - (' .
                        $item->language .
                        ') ' .
                        $item->label,
                ];
            })
            ->toArray();
    }

    public function updateFromStatements(array $statements = null): self
    {
        $language   = $this->language;
        if ( ! $statements) {
            $s          = collect($this->statements->whereIn('profile_property_id', self::FORM_PROPERTIES)->toArray());
            $s = $s->filter(function($item) use ($language) {
                return $item['language'] === $language || $item['language'] === '';
            })->keyBy(function($item) {
                return $item['profile_property_id'];
            });
            $prefLabelId = $s->where('profile_property_id', 45)->first()['id'];
            $statements = $s->map(function($item) {
                return $item['object'];
            });
            $statements['45-id'] = $prefLabelId;
        }

        if (isset($statements['62'])) {
            $this->uri = $statements['62'];
        }
        if (isset($statements['74'])) {
            $this->lexical_alias = $statements['74'];
        }
        if (isset($statements['45'])) {
            $this->pref_label = $statements['45'];
            if (isset($statements['45-id'])) {
                $this->pref_label_id = $statements['45-id'];
            }
        }
        if (isset($statements['59'])) {
            $this->status_id =
                is_numeric($statements['59'])? $statements['59']:
                    Status::getByName($statements['59'])->id;
        }

        $this->save();

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function statements(): ?HasMany
    {
        return $this->hasMany(ConceptAttribute::class, 'concept_id');
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
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->pref_label;
    }

    /**
     * @return string
     */
    public function getLabelAttribute(): string
    {
        return $this->pref_label;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * @param string $value
     *
     * @return string|void
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['pref_label'] = $value;
    }

    /**
     * @param string $value
     *
     * @return string|void
     */
    public function setLabelAttribute(string $value): void
    {
        $this->attributes['pref_label'] = $value;
    }
}
