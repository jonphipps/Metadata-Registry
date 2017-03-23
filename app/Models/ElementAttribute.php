<?php namespace App\Models;

use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property-read \App\Models\ProfileProperty $ProfileProperty
 * @property-read \App\Models\Element $Element
 * @property-read \App\Models\Status $Status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttributeHistory[] $ElementAttributeHistory
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \App\Models\Access\User\User $updater
 * @property-read \App\Models\Access\User\User $eraser
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereUpdatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereDeletedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereSchemaPropertyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereProfilePropertyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereIsSchemaProperty( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereObject( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereRelatedSchemaPropertyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereLanguage( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereStatusId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereIsGenerated( $value )
 * @mixin \Eloquent
 */
class ElementAttribute extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_schema_property_element';

    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;

    protected $blameable = [
      'created' => 'created_user_id',
      'updated' => 'updated_user_id',
      'deleted' => 'deleted_user_id',
    ];

    protected $dates = [ 'deleted_at' ];


    public function ProfileProperty()
    {
        return $this->belongsTo(\App\Models\ProfileProperty::class, 'profile_property_id', 'id');
    }


    public function Element()
    {
        return $this->belongsTo(\App\Models\Element::class, 'schema_property_id', 'id');
    }


    public function Status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id', 'id');
    }


    public function ElementAttributeHistory()
    {
        return $this->hasMany(\App\Models\ElementAttributeHistory::class, '$schema_property_element_id', 'id');
    }
}
