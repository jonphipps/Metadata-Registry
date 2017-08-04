<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToConcept;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedConcept;
use App\Models\Traits\HasStatus;
use Carbon\Carbon;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;
use Laracasts\Matryoshka\Cacheable;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * App\Models\ConceptAttribute
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int $concept_id
 * @property string $primary_pref_label
 * @property int $skos_property_id
 * @property string $object
 * @property int $scheme_id
 * @property int $related_concept_id
 * @property string $language
 * @property int $status_id
 * @property bool $is_concept_property
 * @property int $profile_property_id
 * @property int $last_import_id
 * @property bool $is_generated
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int|null $review_reciprocal
 * @property int|null $reciprocal_concept_property_id
 * @property-read \App\Models\Concept $concept
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttributeHistory[] $history
 * @property-read \App\Models\ConceptAttribute $inverse
 * @property-read \App\Models\ProfileProperty|null $profile_property
 * @property-read \App\Models\ConceptAttribute $reciprocal
 * @property-read \App\Models\Concept|null $related_concept
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\Status|null $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereConceptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereIsConceptProperty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereIsGenerated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereLastImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute wherePrimaryPrefLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereReciprocalConceptPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereRelatedConceptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereReviewReciprocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereSchemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereSkosPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ConceptAttribute withoutTrashed()
 * @mixin \Eloquent
 */
class ConceptAttribute extends Model
{
    const TABLE = 'reg_concept_property';
    protected $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use RevisionableTrait;
    use Cacheable;
    use Languages, HasStatus, BelongsToProfileProperty, BelongsToConcept, BelongsToRelatedConcept;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_by',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    protected $touches = [ 'concept' ];
    protected $revisionCreationsEnabled = true;
    protected $casts = [
        'id'                  => 'integer',
        'created_user_id'     => 'integer',
        'updated_user_id'     => 'integer',
        'concept_id'          => 'integer',
        'is_concept_property' => 'bool',
        'is_generated'        => 'bool',
        'language'            => 'string',
        'last_import_id'      => 'integer',
        'object'              => 'string',
        'primary_pref_label'  => 'string',
        'profile_property_id' => 'integer',
        'related_concept_id'  => 'integer',
        'scheme_id'           => 'integer',
        'skos_property_id'    => 'integer',
        'status_id'           => 'integer',
        'vocabulary_id'       => 'integer',
    ];

    /**
     * Create the event listeners for the saving and saved events
     * This lets us save revisions whenever a save is made, no matter the
     * http method.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function(ConceptAttribute $attribute) {
            //make sure we don't keep making new reciprocals
            if ($attribute->reciprocal_concept_property_id) {
                return;
            }
            $attribute->createHistory('added');
            if ($attribute->createReciprocal()) {
                //Sometimes we just update this attribute instead of creating a reciprocal.
                //This deletes the extra new history that was been added when we do that
                $attribute->history()->latest()->first()->delete();
            }
        });

        static::updated(function(ConceptAttribute $attribute) {
            if (count($attribute->dirtyData) === 1) {
                if ($attribute->isDirty('deleted_user_id') || $attribute->isDirty('deleted_by')) {
                    return;
                }
                if ($attribute->isDirty('related_concept_id')) {
                    $attribute->updateHistory();
                    return;
                }
                if ($attribute->isDirty('object')) {
                    if ($attribute->reciprocal_concept_property_id) {
                        $attribute->reciprocal->createHistory('deleted');
                        $attribute->reciprocal()->delete();
                    }
                    $attribute->createReciprocal();
                    return;
                }
            }
            $attribute->createHistory('updated');
        });

        static::deleted(function(ConceptAttribute $attribute) {
            $attribute->createHistory('deleted');
            if ($attribute->reciprocal_concept_property_id) {
                $reciprocal = self::find($attribute->reciprocal_concept_property_id);
                if ($reciprocal) {
                    $reciprocal->delete();
                }
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @param $vocabulary_id
     *
     * @return Carbon
     * @throws \InvalidArgumentException
     */
    public static function getLatestDateForVocabulary($vocabulary_id): Carbon
    {
        $created_at = self::getLatest($vocabulary_id, 'created_at');
        $updated_at = self::getLatest($vocabulary_id, 'updated_at');
        $deleted_at = self::getLatest($vocabulary_id, 'deleted_at');

        $date = collect([ $created_at, $updated_at, $deleted_at ])->max();
        try {
            return Carbon::createFromFormat(config('app.timestamp_format'), $date);
        }
        catch (InvalidArgumentException $e) {
            return null;
        }
    }

    /**
     * @param int    $vocabulary_id
     * @param string $field
     *
     * @return string
     */
    private static function getLatest($vocabulary_id, $field)
    {
        return \DB::table(ConceptAttribute::TABLE)
            ->join(Concept::TABLE, Concept::TABLE . '.id', '=', ConceptAttribute::TABLE . '.concept_id')
            ->select(ConceptAttribute::TABLE . '.' . $field)
            ->where(Concept::TABLE . '.vocabulary_id', $vocabulary_id)
            ->max(ConceptAttribute::TABLE . '.' . $field);
    }

    public function createHistory(string $action): ConceptAttributeHistory
    {
        return ConceptAttributeHistory::create([
            'action'              => $action,
            'concept_property_id' => $this->id,
            'concept_id'          => $this->concept_id,
            'vocabulary_id'       => $this->concept->vocabulary_id,
            'profile_property_id' => $this->profile_property_id,
            'object'              => $this->object,
            'language'            => $this->getAttributeFromArray('language'),
            'status_id'           => $this->status_id,
            //this should be set to null in the parent if there was no import
            'import_id'           => $this->last_import_id,
            //things we don't know yet. Must come from post-processing
            'scheme_id'           => null,
            'related_concept_id'  => null,
            //should be added to the concept model and not here
            'change_note'         => null,
        ]);
    }

    public function updateHistory()
    {
        $history = $this->history()->where('import_id', $this->last_import_id)->first();
        if ($history) {
            $history->update([ 'related_concept_id' => $this->related_concept_id ]);
        }
    }

    public function createReciprocal()
    {
        //is the object a uri?
        if ( ! filter_var($this->object, FILTER_VALIDATE_URL)) {
            return false;
        }

        //does the profile_property have a reciprocal?
        if ( ! $this->profile_property->is_reciprocal && $this->profile_property->inverse_profile_property_id === null ) {
            return false;
        }

        $reciprocalProperty = $this->profile_property->inverse_profile_property_id ?? $this->profile_property->id;

        //does it reference a known URI in a vocabulary I 'own'? (tricky -- what if it hasn't been created yet?)
        $relatedConcept = Concept::whereUri($this->object)->first();
        if ( ! $relatedConcept) {
            $this->update([ 'review_reciprocal' => true ]);
            return true;
        }
        if (auth()->user()->cant('edit', $relatedConcept)) {
            return false;
        }
        //gonna need a review reciprocals job
        //create the reciprocal
        $attribute = self::create([
            'related_concept_id'             => $this->concept->id,
            'object'                         => $this->concept->uri,
            'concept_id'                     => $relatedConcept->id,
            'status_id'                      => $this->status_id,
            'profile_property_id'            => $reciprocalProperty,
            'last_import_id'                 => $this->last_import_id,
            'is_generated'                   => true,
            'reciprocal_concept_property_id' => $this->id,
            'language'                       => null,
        ]);
        $this->update([ 'reciprocal_concept_property_id' => $attribute->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function history(): ?HasMany
    {
        return $this->hasMany(ConceptAttributeHistory::class, 'concept_property_id', 'id');
    }

     public function reciprocal(): ?HasOne
    {
        return $this->hasOne(ConceptAttribute::class, 'reciprocal_concept_property_id', 'id');
    }

    public function inverse(): ?HasOne
    {
        return $this->hasOne(ConceptAttribute::class, 'reciprocal_concept_property_id', 'id');
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
