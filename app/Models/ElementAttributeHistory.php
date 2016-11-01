<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\ElementAttributeHistory
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
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
 * @property-read \App\Models\Access\User\User $UserCreator
 * @property-read \App\Models\ElementAttribute $ElementAttribute
 * @property-read \App\Models\Element $Element
 * @property-read \App\Models\ElementSet $ElementSet
 * @property-read \App\Models\Element $RelatedElement
 * @property-read \App\Models\Status $Status
 * @property-read \App\Models\ProfileProperty $ProfileProperty
 * @property-read \App\Models\FileImportHistory $FileImportHistory
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereSchemaPropertyElementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereSchemaPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereRelatedSchemaPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereChangeNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttributeHistory whereImportId($value)
 * @mixin \Eloquent
 */
class ElementAttributeHistory extends Model
{

    protected $table = 'reg_schema_property_element_history';

    protected $fillable = array('action', 'object', 'language', 'change_note');

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
        "created_user_id" => "integer",
        "action" => "string",
        "schema_property_element_id" => "integer",
        "schema_property_id" => "integer",
        "schema_id" => "integer",
        "profile_property_id" => "integer",
        "object" => "string",
        "related_schema_property_id" => "integer",
        "language" => "string",
        "status_id" => "integer",
        "change_note" => "string",
        "import_id" => "integer"
    ];

    public static $rules = [
        "created_at" => "required|",
        "object" => "max:65535",
        "language" => "required|max:6",
        "change_note" => "max:65535"
    ];

    public function UserCreator()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id');
    }

    public function ElementAttribute()
    {
        return $this->belongsTo('App\Models\ElementAttribute', 'schema_property_element_id', 'id');
    }

    public function Element()
    {
        return $this->belongsTo('App\Models\Element', 'schema_property_id', 'id');
    }

    public function ElementSet()
    {
        return $this->belongsTo('App\Models\ElementSet', 'schema_id', 'id');
    }

    public function RelatedElement()
    {
        return $this->belongsTo('App\Models\Element', 'related_schema_property_id', 'id');
    }

    public function Status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }

    public function ProfileProperty()
    {
        return $this->belongsTo('App\Models\ProfileProperty', 'profile_property_id', 'id');
    }

    public function FileImportHistory()
    {
        return $this->belongsTo('App\Models\FileImportHistory', 'import_id', 'id');
    }

}
