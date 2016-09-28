<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\ConceptAttributeHistory
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property string $action
 * @property integer $concept_property_id
 * @property integer $concept_id
 * @property integer $vocabulary_id
 * @property integer $skos_property_id
 * @property string $object
 * @property integer $scheme_id
 * @property integer $related_concept_id
 * @property string $language
 * @property integer $status_id
 * @property integer $created_user_id
 * @property string $change_note
 * @property integer $import_id
 * @property-read \App\Models\SkosProperty $SkosProperty
 * @property-read \App\Models\FileImportHistory $FileImportHistory
 * @property-read \App\Models\Vocabulary $ObjectScheme
 * @property-read \App\Models\Status $Status
 * @property-read \App\Models\Concept $ObjectConcept
 * @property-read \App\Models\User $UserCreator
 * @property-read \App\Models\ConceptAttribute $ConceptAttribute
 * @property-read \App\Models\Vocabulary $Vocabulary
 * @property-read \App\Models\Concept $Concept
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereConceptPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereVocabularyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereSkosPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereSchemeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereRelatedConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereChangeNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttributeHistory whereImportId($value)
 * @mixin \Eloquent
 */
class ConceptAttributeHistory extends Model
{
    protected $table = 'reg_concept_property_history';

    protected $fillable = array('action', 'object', 'language', 'change_note');


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
        "action" => "string",
        "concept_property_id" => "integer",
        "concept_id" => "integer",
        "vocabulary_id" => "integer",
        "skos_property_id" => "integer",
        "object" => "string",
        "scheme_id" => "integer",
        "related_concept_id" => "integer",
        "language" => "string",
        "status_id" => "integer",
        "created_user_id" => "integer",
        "change_note" => "string",
        "import_id" => "integer"
    ];

    public static $rules = [
        "created_at" => "required|",
        "object" => "max:65535",
        "language" => "max:6",
        "change_note" => "max:65535"
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
        return $this->belongsTo('App\Models\SkosProperty', 'skos_property_id', 'id');
    }

    public function FileImportHistory()
    {
        return $this->belongsTo('App\Models\FileImportHistory', 'import_id', 'id');
    }

    public function ObjectScheme()
    {
        return $this->belongsTo('App\Models\Vocabulary', 'scheme_id', 'id');
    }

    public function Status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }

    public function ObjectConcept()
    {
        return $this->belongsTo('App\Models\Concept', 'related_concept_id', 'id');
    }

    public function UserCreator()
    {
        return $this->belongsTo('App\Models\User', 'created_user_id', 'id');
    }

    public function ConceptAttribute()
    {
        return $this->belongsTo('App\Models\ConceptAttribute', 'concept_property_id', 'id');
    }

    public function Vocabulary()
    {
        return $this->belongsTo('App\Models\Vocabulary', 'vocabulary_id', 'id');
    }

    public function Concept()
    {
        return $this->belongsTo('App\Models\Concept', 'concept_id', 'id');
    }

}
