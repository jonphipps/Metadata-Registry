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
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $created_user_id
 * @property integer $updated_user_id
 * @property integer $schema_property_id
 * @property integer $profile_property_id
 * @property boolean $is_schema_property
 * @property string $object
 * @property integer $related_schema_property_id
 * @property string $language
 * @property integer $status_id
 * @property boolean $is_generated
 * @property-read \App\Models\ProfileProperty $ProfileProperty
 * @property-read \App\Models\Element $Element
 * @property-read \App\Models\Status $Status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttributeHistory[] $ElementAttributeHistory
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ElementAttribute whereUpdatedUserId( $value )
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

    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;

    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_user_id'
    ];

    protected $dates = [ 'deleted_at' ];

    protected $table = 'reg_schema_property_element';


    public function ProfileProperty()
    {
        return $this->belongsTo('App\Models\ProfileProperty', 'profile_property_id', 'id');
    }


    public function Element()
    {
        return $this->belongsTo('App\Models\Element', 'schema_property_id', 'id');
    }


    public function Status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }


    public function ElementAttributeHistory()
    {
        return $this->hasMany('App\Models\ElementAttributeHistory', '$schema_property_element_id', 'id');
    }
}
