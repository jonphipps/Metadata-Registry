<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

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
 * @property-read \App\Models\Concept $Concept
 * @property-read \App\Models\ConceptAttribute $ConceptAttribute
 * @property-read \App\Models\Concept $ObjectConcept
 * @property-read \App\Models\Vocabulary $ObjectScheme
 * @property-read \App\Models\SkosProperty $SkosProperty
 * @property-read \App\Models\Status $Status
 * @property-read \App\Models\Access\User\User $UserCreator
 * @property-read \App\Models\Vocabulary $Vocabulary
 * @property-read \App\Models\Import $imports
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
    protected $table = self::TABLE;
    const TABLE = 'reg_concept_property_history';

    protected $fillable = [ 'action', 'object', 'language', 'change_note' ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      "id"                  => "integer",
      "action"              => "string",
      "concept_property_id" => "integer",
      "concept_id"          => "integer",
      "vocabulary_id"       => "integer",
      "skos_property_id"    => "integer",
      "object"              => "string",
      "scheme_id"           => "integer",
      "related_concept_id"  => "integer",
      "language"            => "string",
      "status_id"           => "integer",
      "created_user_id"     => "integer",
      "change_note"         => "string",
      "import_id"           => "integer",
    ];

    public static $rules = [
      "created_at"  => "required|",
      "object"      => "max:65535",
      "language"    => "max:6",
      "change_note" => "max:65535",
    ];


  /** ===============
   * Accessors
   * ================
   */

    public function getObjectAttribute($value)
    {
        //TODO: Check to make sure the data in the database needs to be decoded
        return utf8_decode($value);
    }


    public function SkosProperty()
    {
        return $this->belongsTo(\App\Models\SkosProperty::class, 'skos_property_id', 'id');
    }


    public function imports()
    {
        return $this->belongsTo(\App\Models\Import::class, 'import_id', 'id');
    }


    public function ObjectScheme()
    {
        return $this->belongsTo(\App\Models\Vocabulary::class, 'scheme_id', 'id');
    }


    public function Status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id', 'id');
    }


    public function ObjectConcept()
    {
        return $this->belongsTo(\App\Models\Concept::class, 'related_concept_id', 'id');
    }


    public function UserCreator()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id');
    }


    public function ConceptAttribute()
    {
        return $this->belongsTo(\App\Models\ConceptAttribute::class, 'concept_property_id', 'id');
    }


    public function Vocabulary()
    {
        return $this->belongsTo(\App\Models\Vocabulary::class, 'vocabulary_id', 'id');
    }


    public function Concept()
    {
        return $this->belongsTo(\App\Models\Concept::class, 'concept_id', 'id');
    }
}
