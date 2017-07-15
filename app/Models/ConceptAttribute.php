<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToConcept;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedConcept;
use Carbon\Carbon;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
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
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \App\Models\Concept $concept
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttributeHistory[] $history
 * @property-read \App\Models\ProfileProperty|null $profile_property
 * @property-read \App\Models\Concept|null $related_concept
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute wherePrimaryPrefLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConceptAttribute whereRelatedConceptId($value)
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
    use Languages, BelongsToProfileProperty, BelongsToConcept, BelongsToRelatedConcept;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_by',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];
    protected $touches = [ 'concept' ];
    protected $revisionCreationsEnabled = true;

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

    public function history()
    {
        return $this->hasMany(ConceptAttributeHistory::class, 'concept_property_id', 'id');
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
}
