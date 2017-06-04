<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToConcept;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedConcept;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\ConceptAttribute
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
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
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property-read \App\Models\Concept $concept
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \App\Models\Access\User\User $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \App\Models\ProfileProperty $profile_property
 * @property-read \App\Models\Concept $related_concept
 * @property-read \App\Models\Access\User\User $updater
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereIsConceptProperty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereIsGenerated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute wherePrimaryPrefLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereRelatedConceptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereSchemeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereSkosPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute whereUpdatedUserId($value)
 * @mixin \Eloquent
 */
class ConceptAttribute extends Model
{
    const TABLE = 'reg_concept_property';
    protected $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Cacheable;
    use Languages, BelongsToProfileProperty, BelongsToConcept, BelongsToRelatedConcept;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_by',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    protected $touches = [ 'concept' ];

    public function history()
    {
        return $this->hasMany(ConceptAttributeHistory::class, 'concept_property_id', 'id');
    }

}
