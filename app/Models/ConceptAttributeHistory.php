<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToImport;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedConcept;
use App\Models\Traits\BelongsToVocabulary;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\ConceptAttributeHistory
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
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
 * @property int $created_by
 * @property-read \App\Models\ConceptAttribute $concept_attribute
 * @property-read \App\Models\Access\User\User $creator
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \App\Models\Import $import
 * @property-read \App\Models\ProfileProperty $profile_property
 * @property-read \App\Models\Concept $related_concept
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Vocabulary $vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereChangeNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereConceptPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereImportId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereRelatedConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereSchemeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereSkosPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereVocabularyId($value)
 * @mixin \Eloquent
 */
class ConceptAttributeHistory extends Model
{
    const TABLE = 'reg_concept_property_history';
    protected $table = self::TABLE;
    use Blameable, CreatedBy;
    use Cacheable;
    use Languages, BelongsToVocabulary, HasStatus, BelongsToProfileProperty, BelongsToImport, BelongsToRelatedConcept;
    protected $blameable = [
        'created' => 'created_user_id',
    ];
    protected $guarded = [ 'id' ];
    protected $casts = [
        'id'                  => 'integer',
        'action'              => 'string',
        'concept_property_id' => 'integer',
        'concept_id'          => 'integer',
        'vocabulary_id'       => 'integer',
        'skos_property_id'    => 'integer',
        'object'              => 'string',
        'scheme_id'           => 'integer',
        'related_concept_id'  => 'integer',
        'language'            => 'string',
        'status_id'           => 'integer',
        'created_user_id'     => 'integer',
        'change_note'         => 'string',
        'import_id'           => 'integer',
    ];
    public static $rules = [
        'created_at'  => 'required|',
        'object'      => 'max:65535',
        'language'    => 'max:6',
        'change_note' => 'max:65535',
    ];

    public function concept_attribute()
    {
        return $this->belongsTo( ConceptAttribute::class, 'concept_property_id', 'id' );
    }
}
