<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Access\User\User;
use App\Models\Traits\BelongsToElement;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedElement;
use App\Models\Traits\HasStatus;
use Carbon\Carbon;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;
use Laracasts\Matryoshka\Cacheable;
use Venturecraft\Revisionable\RevisionableTrait;
use function config;

/**
 * App\Models\ElementAttribute
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int $deleted_user_id
 * @property int $schema_property_id
 * @property int $profile_property_id
 * @property bool $is_schema_property
 * @property string $object
 * @property int $related_schema_property_id
 * @property string $language
 * @property int $status_id
 * @property int $last_import_id
 * @property bool $is_generated
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property bool $review_reciprocal
 * @property int $reciprocal_property_element_id
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Element $element
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property mixed $languages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttributeHistory[] $history
 * @property-read \App\Models\ElementAttribute $inverse
 * @property-read \App\Models\ProfileProperty $profile_property
 * @property-read \App\Models\ElementAttribute $reciprocal
 * @property-read \App\Models\Element|null $related_element
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\Status|null $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereDeletedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereIsGenerated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereIsSchemaProperty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereLastImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereReciprocalPropertyElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereRelatedSchemaPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereReviewReciprocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereSchemaPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttribute whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute withoutTrashed()
 * @mixin \Eloquent
 */
class ElementAttribute extends Model
{
    protected $table = self::TABLE;
    const TABLE      = 'reg_schema_property_element';
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use RevisionableTrait;
    use Cacheable;
    use Languages, HasStatus, BelongsToProfileProperty, BelongsToElement, BelongsToRelatedElement;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_user_id',
    ];
    protected $dates                    = ['deleted_at'];
    protected $touches                  = ['element'];
    protected $guarded                  = ['id'];
    protected $revisionCreationsEnabled = true;
    protected $casts                    = [
        'id'                             => 'integer',
        'created_user_id'                => 'integer',
        'updated_user_id'                => 'integer',
        'deleted_user_id'                => 'integer',
        'schema_property_id'             => 'integer',
        'profile_property_id'            => 'integer',
        'is_schema_property'             => 'bool',
        'object'                         => 'string',
        'related_schema_property_id'     => 'integer',
        'language'                       => 'string',
        'status_id'                      => 'integer',
        'last_import_id'                 => 'integer',
        'is_generated'                   => 'bool',
        'review_reciprocal'              => 'bool',
        'reciprocal_property_element_id' => 'integer',
    ];

    /**
     * Create the event listeners for the saving and saved events
     * This lets us save revisions whenever a save is made, no matter the
     * http method.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (ElementAttribute $attribute) {
            //make sure we don't keep making new reciprocals
            if ($attribute->reciprocal_property_element_id) {
                return;
            }
            $attribute->createHistory('added');
            if ($attribute->createReciprocal()) {
                //Sometimes we just update this attribute instead of creating a reciprocal.
                //This deletes the extra new history that was been added when we do that
                $attribute->history()->latest()->first()->delete();
            }
        });
        static::updated(function (ElementAttribute $attribute) {
            if (\count($attribute->dirtyData) === 1) {
                if ($attribute->isDirty('deleted_user_id') || $attribute->isDirty('deleted_by')) {
                    return;
                }
                if ($attribute->isDirty('related_schema_property_id')) {
                    $attribute->updateHistory();

                    return;
                }
                if ($attribute->isDirty('object')) {
                    if ($attribute->reciprocal_property_element_id) {
                        $attribute->reciprocal->createHistory('deleted');
                        $attribute->reciprocal()->delete();
                    }
                    $attribute->createReciprocal();

                    return;
                }
            }
            $attribute->createHistory('updated');
        });

        static::deleted(function (ElementAttribute $attribute) {
            $attribute->createHistory('deleted');
            if ($attribute->reciprocal_property_element_id) {
                $reciprocal = self::find($attribute->reciprocal_property_element_id);
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

    public function createHistory(string $action): ElementAttributeHistory
    {
        return ElementAttributeHistory::create([
            'action'                     => $action,
            'created_user_id'            => $this->updated_user_id,
            'schema_property_element_id' => $this->id,
            'schema_property_id'         => $this->schema_property_id,
            'schema_id'                  => $this->element->schema_id,
            'profile_property_id'        => $this->profile_property_id,
            'object'                     => $this->object,
            'language'                   => $this->getAttributeFromArray('language'),
            'status_id'                  => $this->status_id,
            //this should be set to null in the parent if there was no import
            'import_id'                  => $this->last_import_id,
            //things we don't know yet. Must come from post-processing
            'related_schema_property_id' => null,
            //should be added to the schema_property model and not here
            'change_note'                => null,
        ]);
    }

    public function updateHistory()
    {
        $history = $this->history()->where('import_id', $this->last_import_id)->first();
        if ($history) {
            $history->update(['related_schema_property_id' => $this->related_schema_property_id]);
        }
    }

    /**
     * @param $elementset_id
     *
     * @return Carbon
     * @throws InvalidArgumentException
     */
    public static function getLatestDateForElementSet($elementset_id): Carbon
    {
        $created_at = self::getLatest($elementset_id, 'created_at');
        $updated_at = self::getLatest($elementset_id, 'updated_at');
        $deleted_at = self::getLatest($elementset_id, 'deleted_at');

        $date = collect([$created_at, $updated_at, $deleted_at])->max();
        try {
            return Carbon::createFromFormat(config('app.timestamp_format'), $date);
        } catch (InvalidArgumentException $e) {
            return null;
        }
    }

    /**
     * @param int    $elementset_id
     * @param string $field
     *
     * @return string
     */
    private static function getLatest($elementset_id, $field)
    {
        return \DB::table(self::TABLE)
            ->join(Element::TABLE, Element::TABLE . '.id', '=', self::TABLE . '.schema_property_id')
            ->select(self::TABLE . '.' . $field)
            ->where(Element::TABLE . '.schema_id', $elementset_id)
            ->max(self::TABLE . '.' . $field);
    }

    public function createReciprocal()
    {
        //is the object a uri?
        if (! filter_var($this->object, FILTER_VALIDATE_URL)) {
            return false;
        }

        //does the profile_property have a reciprocal?
        if (! $this->profile_property->is_reciprocal && $this->profile_property->inverse_profile_property_id === null) {
            return false;
        }

        $reciprocalProperty = $this->profile_property->inverse_profile_property_id ?? $this->profile_property->id;

        //does it reference a known URI in a vocabulary I 'own'? (tricky -- what if it hasn't been created yet?)
        $relatedElement = Element::whereUri($this->object)->first();
        if (! $relatedElement) {
            $this->update(['review_reciprocal' => true]);

            return true;
        }
        //todo: this should probably be findOrFail(), the error caught and added to error log
        $user = User::find($this->updated_user_id);
        if (!$user) {
            return false;
        }

        if ($user->cant('update', $relatedElement)) {
            return false;
        }

        //todo: gonna need a review reciprocals job
        //create the reciprocal
        $attribute = self::create([
            'related_schema_property_id'     => $this->element->id,
            'object'                         => $this->element->uri,
            'schema_property_id'             => $relatedElement->id,
            'status_id'                      => $this->status_id,
            'profile_property_id'            => $reciprocalProperty,
            'last_import_id'                 => $this->last_import_id,
            'is_generated'                   => true,
            'reciprocal_property_element_id' => $this->id,
            'language'                       => null,
            'created_user_id'                => $this->updated_user_id,
            'updated_user_id'                => $this->updated_user_id,
        ]);
        $this->update(['reciprocal_property_element_id' => $attribute->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function history(): ?HasMany
    {
        return $this->hasMany(ElementAttributeHistory::class, 'schema_property_element_id', 'id');
    }

    public function reciprocal(): ?HasOne
    {
        return $this->hasOne(self::class, 'reciprocal_property_element_id', 'id');
    }

    public function inverse(): ?HasOne
    {
        return $this->hasOne(self::class, 'reciprocal_property_element_id', 'id');
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
