<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToElement;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedElement;
use App\Models\Traits\HasStatus;
use Carbon\Carbon;
use function config;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\ElementAttribute
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
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
 * @property bool $is_generated
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \App\Models\Element $element
 * @property-read \App\Models\Access\User\User $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttributeHistory[] $history
 * @property-read \App\Models\ProfileProperty $profile_property
 * @property-read \App\Models\Element $related_element
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User $updater
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereDeletedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereIsGenerated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereIsSchemaProperty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereRelatedSchemaPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereSchemaPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereUpdatedUserId($value)
 * @mixin \Eloquent
 */
class ElementAttribute extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_schema_property_element';
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Cacheable;
    use Languages, HasStatus, BelongsToProfileProperty, BelongsToElement, BelongsToRelatedElement;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_user_id',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $touches = [ 'element' ];

    public function history(): ?HasMany
    {
        return $this->hasMany(ElementAttributeHistory::class, 'schema_property_element_id', 'id');
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

        $date = collect([ $created_at, $updated_at, $deleted_at ])->max();
        try {
            return Carbon::createFromFormat(config('app.timestamp_format'), $date);
        }
        catch (InvalidArgumentException $e) {
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
        return \DB::table(ElementAttribute::TABLE)
            ->join(Element::TABLE, Element::TABLE . '.id', '=', ElementAttribute::TABLE . '.schema_property_id')
            ->select(ElementAttribute::TABLE . '.' . $field)
            ->where(Element::TABLE . '.schema_id', $elementset_id)
            ->max(ElementAttribute::TABLE . '.' . $field);
    }
}
