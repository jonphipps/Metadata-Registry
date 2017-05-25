<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\ElementAttributeHistory
 *
 * @property int                               $id
 * @property \Carbon\Carbon                    $created_at
 * @property \Carbon\Carbon                    $updated_at
 * @property int                               $created_user_id
 * @property string                            $action
 * @property int                               $schema_property_element_id
 * @property int                               $schema_property_id
 * @property int                               $schema_id
 * @property int                               $profile_property_id
 * @property string                            $object
 * @property int                               $related_schema_property_id
 * @property string                            $language
 * @property int                               $status_id
 * @property string                            $change_note
 * @property int                               $import_id
 * @property int                               $created_by
 * @property-read \App\Models\Element          $Element
 * @property-read \App\Models\ElementAttribute $ElementAttribute
 * @property-read \App\Models\Elementset       $ElementSet
 * @property-read \App\Models\ProfileProperty  $ProfileProperty
 * @property-read \App\Models\Element          $RelatedElement
 * @property-read \App\Models\Status           $Status
 * @property-read \App\Models\Access\User\User $UserCreator
 * @property-read \App\Models\Import           $imports
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereAction( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereChangeNote( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereCreatedBy( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereImportId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereLanguage( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereObject( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereProfilePropertyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereRelatedSchemaPropertyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereSchemaId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereSchemaPropertyElementId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereSchemaPropertyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereStatusId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereUpdatedAt( $value )
 * @mixin \Eloquent
 */
class ElementAttributeHistory extends Model
{
    protected $table = self::TABLE;

    const TABLE = 'reg_schema_property_element_history';

    protected $fillable = [ 'action', 'object', 'language', 'change_note' ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id"                         => "integer",
        "created_user_id"            => "integer",
        "action"                     => "string",
        "schema_property_element_id" => "integer",
        "schema_property_id"         => "integer",
        "schema_id"                  => "integer",
        "profile_property_id"        => "integer",
        "object"                     => "string",
        "related_schema_property_id" => "integer",
        "language"                   => "string",
        "status_id"                  => "integer",
        "change_note"                => "string",
        "import_id"                  => "integer",
    ];

    public static $rules = [
        "created_at"  => "required|",
        "object"      => "max:65535",
        "language"    => "required|max:6",
        "change_note" => "max:65535",
    ];

    public function creator()
    {
        return $this->belongsTo( User::class, 'created_user_id', 'id' );
    }

    public function element_attribute()
    {
        return $this->belongsTo( \App\Models\ElementAttribute::class,
            'schema_property_element_id',
            'id' );
    }

    public function element()
    {
        return $this->belongsTo( \App\Models\Element::class, 'schema_property_id', 'id' );
    }

    public function elementset()
    {
        return $this->belongsTo( \App\Models\Elementset::class, 'schema_id', 'id' );
    }

    public function related_element()
    {
        return $this->belongsTo( \App\Models\Element::class, 'related_schema_property_id', 'id' );
    }

    public function status()
    {
        return $this->belongsTo( \App\Models\Status::class, 'status_id', 'id' );
    }

    public function profile_property()
    {
        return $this->belongsTo( \App\Models\ProfileProperty::class, 'profile_property_id', 'id' );
    }

    public function imports()
    {
        return $this->belongsTo( \App\Models\Import::class, 'import_id', 'id' );
    }
}
