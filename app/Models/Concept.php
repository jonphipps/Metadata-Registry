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
 * @property int                                                                          $id
 * @property \Carbon\Carbon                                                               $created_at
 * @property \Carbon\Carbon                                                               $updated_at
 * @property \Carbon\Carbon                                                               $deleted_at
 * @property int                                                                          $created_user_id
 * @property int                                                                          $updated_user_id
 * @property string                                                                       $uri
 * @property string                                                                       $lexical_alias
 * @property string                                                                       $pref_label
 * @property string                                                                       $name
 * @property string                                                                       $label
 * @property int                                                                          $vocabulary_id
 * @property bool                                                                         $is_top_concept
 * @property int                                                                          $pref_label_id
 * @property int                                                                          $status_id
 * @property string                                                                       $language
 * @property int                                                                          $created_by
 * @property int                                                                          $updated_by
 * @property int                                                                          $deleted_by
 * @property-read \App\Models\Access\User\User                                            $creator
 * @property-read \App\Models\Access\User\User                                            $eraser
 * @property-read mixed                                                                   $current_language
 * @property-read mixed                                                                   $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttribute[] $properties
 * @property-read \App\Models\Status                                                      $status
 * @property-read \App\Models\Access\User\User                                            $updater
 * @property-read \App\Models\Vocabulary                                                  $vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereIsTopConcept($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereLexicalAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept wherePrefLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept wherePrefLabelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereVocabularyId($value)
 * @mixin \Eloquent
 */
class Concept extends Model
{
    const TABLE = 'reg_concept';
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return HasMany|null
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
