<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\Discuss
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $created_user_id
 * @property int $deleted_user_id
 * @property string $uri
 * @property int $schema_id
 * @property int $schema_property_id
 * @property int $schema_property_element_id
 * @property int $vocabulary_id
 * @property int $concept_id
 * @property int $concept_property_id
 * @property int $root_id
 * @property int $parent_id
 * @property string $subject
 * @property string $content
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property-read \App\Models\Concept|null $Concept
 * @property-read \App\Models\ConceptAttribute|null $ConceptAttribute
 * @property-read \App\Models\Access\User\User|null $CreatedBy
 * @property-read \App\Models\Access\User\User|null $DeletedBy
 * @property-read \App\Models\Discuss|null $DiscussParent
 * @property-read \App\Models\Discuss|null $DiscussRoot
 * @property-read \App\Models\Element|null $Element
 * @property-read \App\Models\ElementAttribute|null $ElementAttribute
 * @property-read \App\Models\ElementSet|null $ElementSet
 * @property-read \App\Models\Vocabulary|null $Vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereConceptPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereDeletedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereRootId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereSchemaPropertyElementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereSchemaPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discuss whereVocabularyId($value)
 * @mixin \Eloquent
 */
class Discuss extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_discuss';

    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
      "id",
      "created_at",
      "updated_at",
      "deleted_at",
      "created_user_id",
      "deleted_user_id",
      "uri",
      "schema_id",
      "schema_property_id",
      "schema_property_element_id",
      "vocabulary_id",
      "concept_id",
      "concept_property_id",
      "root_id",
      "parent_id",
      "subject",
      "content",
    ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      "id"                         => "integer",
      "created_user_id"            => "integer",
      "deleted_user_id"            => "integer",
      "uri"                        => "string",
      "schema_id"                  => "integer",
      "schema_property_id"         => "integer",
      "schema_property_element_id" => "integer",
      "vocabulary_id"              => "integer",
      "concept_id"                 => "integer",
      "concept_property_id"        => "integer",
      "root_id"                    => "integer",
      "parent_id"                  => "integer",
      "subject"                    => "string",
      "content"                    => "string",
    ];

    public static $rules = [
      "uri"     => "max:255",
      "subject" => "max:255",
      "content" => "max:65535",
    ];


    public function CreatedBy()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id');
    }


    public function ConceptAttribute()
    {
        return $this->belongsTo(\App\Models\ConceptAttribute::class, 'concept_property_id', 'id');
    }


    public function DeletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_user_id', 'id');
    }


    public function ElementSet()
    {
        return $this->belongsTo(\App\Models\ElementSet::class, 'schema_id', 'id');
    }


    public function Element()
    {
        return $this->belongsTo(\App\Models\Element::class, 'schema_property_id', 'id');
    }


    public function ElementAttribute()
    {
        return $this->belongsTo(\App\Models\ElementAttribute::class, 'schema_property_element_id', 'id');
    }


    public function Vocabulary()
    {
        return $this->belongsTo(\App\Models\Vocabulary::class, 'vocabulary_id', 'id');
    }


    public function Concept()
    {
        return $this->belongsTo(\App\Models\Concept::class, 'concept_id', 'id');
    }


    public function DiscussRoot()
    {
        return $this->belongsTo(\App\Models\Discuss::class, 'root_id', 'id');
    }


    public function DiscussParent()
    {
        return $this->belongsTo(\App\Models\Discuss::class, 'parent_id', 'id');
    }
}
