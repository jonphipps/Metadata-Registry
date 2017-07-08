<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToConcept;
use App\Models\Traits\BelongsToImport;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedConcept;
use App\Models\Traits\BelongsToVocabulary;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\ConceptAttributeHistory
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $action
 * @property int $concept_property_id
 * @property int $concept_id
 * @property int $vocabulary_id
 * @property int $skos_property_id
 * @property string $object
 * @property int $scheme_id
 * @property int $related_concept_id
 * @property string $language This will be an RFC3066 language code, which means it can be en, eng, en-us, or eng-us -- iso639-1 (2-char codes), iso639-2 (3-char codes), and combined with iso3166 (2-char country codes)
 * @property int $status_id
 * @property int $created_user_id
 * @property string $change_note
 * @property int $import_id
 * @property int $profile_property_id
 * @property int|null $created_by
 * @property-read \App\Models\Concept|null $concept
 * @property-read \App\Models\ConceptAttribute|null $concept_attribute
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \App\Models\Import|null $import
 * @property-read \App\Models\ProfileProperty|null $profile_property
 * @property-read \App\Models\Concept|null $related_concept
 * @property-read \App\Models\Status|null $status
 * @property-read \App\Models\Vocabulary|null $vocabulary
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereChangeNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereConceptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereConceptPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereRelatedConceptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereSchemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereSkosPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttributeHistory whereVocabularyId($value)
 * @mixin \Eloquent
 */
class ConceptAttributeHistory extends Model
{
    //TODO: Only store the things that change and get the rest from the related attribute
    const TABLE = 'reg_concept_property_history';
    protected $table = self::TABLE;
    use Blameable, CreatedBy;
    use Cacheable;
    use Languages, BelongsToVocabulary, HasStatus, BelongsToConcept, BelongsToProfileProperty, BelongsToImport, BelongsToRelatedConcept;
    protected $blameable = [
        'created' => 'created_user_id',
    ];
    protected $guarded = [ 'id' ];
    protected $casts = [
        'id'                  => 'integer',
        'action'              => 'string',
        'concept_property_id' => 'integer', //concept_attribute
        'concept_id'          => 'integer', //BelongsToConcept
        'vocabulary_id'       => 'integer', //BelongsToVocabulary
        'skos_property_id'    => 'integer', //obsolete
        'object'              => 'string',
        'scheme_id'           => 'integer', //obsolete
        'related_concept_id'  => 'integer', //BelongsToRelatedConcept
        'language'            => 'string',  //language
        'status_id'           => 'integer', //HasStatus
        'created_user_id'     => 'integer', //CreatedBy
        'change_note'         => 'string',
        'import_id'           => 'integer', //BelongsToImport
        'profile_property_id' => 'integer', //BelongsToProfileProperty
    ];
    public static $rules = [
        'created_at'  => 'required|',
        'object'      => 'max:65535',
        'language'    => 'max:6',
        'change_note' => 'max:65535',
    ];

    public function concept_attribute(): ?BelongsTo
    {
        return $this->belongsTo( ConceptAttribute::class, 'concept_property_id', 'id' );
    }
}
