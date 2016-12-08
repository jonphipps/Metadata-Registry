<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\ConceptAttribute
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $last_updated
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int $concept_id
 * @property bool $primary_pref_label
 * @property int $skos_property_id
 * @property string $object
 * @property int $scheme_id
 * @property int $related_concept_id
 * @property string $language
 * @property int $status_id
 * @property bool $is_concept_property
 * @property int $profile_property_id
 * @property bool $is_generated
 * @property-read \App\Models\Concept $Concept
 * @property-read \App\Models\ProfileProperty $ProfileProperty
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute wherePrimaryPrefLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereSkosPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereSchemeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereRelatedConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereIsConceptProperty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereIsGenerated($value)
 * @mixin \Eloquent
 */
class ConceptAttribute extends Model
{
    use SoftDeletes;
    protected $table = 'reg_concept_property';
    protected $primaryKey = 'id';

    public function Concept()
    {
        return $this->belongsTo('App\Models\Concept', 'concept_id', 'id');
    }

    public function ProfileProperty()
    {
        return $this->belongsTo('App\Models\ProfileProperty', 'profile_property_id', 'id');
    }

}
