<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToElement;
use App\Models\Traits\BelongsToElementset;
use App\Models\Traits\BelongsToImport;
use App\Models\Traits\BelongsToProfileProperty;
use App\Models\Traits\BelongsToRelatedElement;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\ElementAttributeHistory
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $created_user_id
 * @property string $action
 * @property int $schema_property_element_id
 * @property int $schema_property_id
 * @property int $schema_id
 * @property int $profile_property_id
 * @property string $object
 * @property int $related_schema_property_id
 * @property string $language
 * @property int $status_id
 * @property string $change_note
 * @property int $import_id
 * @property int|null $created_by
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Element|null $element
 * @property-read \App\Models\ElementAttribute|null $element_attribute
 * @property-read \App\Models\Elementset|null $elementset
 * @property-read \App\Models\Import|null $import
 * @property-read \App\Models\ProfileProperty|null $profile_property
 * @property-read \App\Models\Element|null $related_element
 * @property-read \App\Models\Status|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereChangeNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereRelatedSchemaPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereSchemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereSchemaPropertyElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereSchemaPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ElementAttributeHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ElementAttributeHistory extends Model
{
    //TODO: Only store the things that change and get the rest from the related attribute.
    const TABLE = 'reg_schema_property_element_history';
    protected $table = self::TABLE;
    use Blameable, CreatedBy;
    use Cacheable;
    use Languages, HasStatus, BelongsToProfileProperty, BelongsToElementset, BelongsToElement, BelongsToImport, BelongsToRelatedElement;
    protected $blameable = [
        'created' => 'created_user_id',
    ];
    protected $guarded = [ 'id' ];
    protected $casts = [
        'id'                         => 'integer',
        'created_user_id'            => 'integer',  //CreatedBy
        'action'                     => 'string',
        'schema_property_element_id' => 'integer', //element_attribute
        'schema_property_id'         => 'integer', //BelongsToElement
        'schema_id'                  => 'integer', //BelongsToElementset
        'profile_property_id'        => 'integer', //BelongsToProfileProperty
        'object'                     => 'string',
        'related_schema_property_id' => 'integer', //BelongsToRelatedElement
        'language'                   => 'string',  //languages
        'status_id'                  => 'integer', //hasStatus
        'change_note'                => 'string',
        'import_id'                  => 'integer', //BelongsToImport
    ];
    public static $rules = [
        'created_at'  => 'required|',
        'object'      => 'max:65535',
        'language'    => 'required|max:10',
        'change_note' => 'max:65535',
    ];

    public function element_attribute(): ?BelongsTo
    {
        return $this->belongsTo( ElementAttribute::class,
            'schema_property_element_id',
            'id' );
    }

}
