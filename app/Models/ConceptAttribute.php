<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ConceptAttribute
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string|null $deleted_at
 * @property string|null $last_updated
 * @property int|null $created_user_id
 * @property int|null $updated_user_id
 * @property int $concept_id
 * @property int|null $primary_pref_label
 * @property int|null $skos_property_id
 * @property string|null $object
 * @property int|null $scheme_id
 * @property int|null $related_concept_id
 * @property string|null $language
 * @property int|null $status_id
 * @property int $is_concept_property
 * @property int|null $profile_property_id
 * @property int $is_generated
 * @property-read \App\Models\Concept $concept
 * @property-read \App\Models\ProfileProperty|null $profileProperty
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereIsConceptProperty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereIsGenerated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute wherePrimaryPrefLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereRelatedConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereSchemeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereSkosPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereUpdatedUserId($value)
 * @mixin \Eloquent
 */
class ConceptAttribute extends Model
{

    protected $table = self::TABLE;
    const TABLE = 'reg_concept_property';

    protected $primaryKey = 'id';

    use SoftDeletes;


    public function concept()
    {
        return $this->belongsTo(\App\Models\Concept::class, 'concept_id', 'id');
    }


    public function profileProperty()
    {
        return $this->belongsTo(\App\Models\ProfileProperty::class, 'profile_property_id', 'id');
    }
}
