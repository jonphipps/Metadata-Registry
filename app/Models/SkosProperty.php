<?php namespace App\Models;

/**
 * App\Models\SkosProperty
 *
 * @property int $id
 * @property int $parent_id
 * @property int $inverse_id      id of the inverse property
 * @property string $name
 * @property string $uri
 * @property string $object_type  the type of the object for which this is the predicate
 * @property int $display_order   Display order of properties
 * @property int $picklist_order
 * @property string $label        The pretty label for the property
 * @property string $definition
 * @property string $comment
 * @property string $examples     Link to example usage
 * @property bool $is_required    boolean -- id this value required
 * @property bool $is_reciprocal  boolean - subject and object must both have this property
 * @property bool $is_singleton   boolean -- is this property allowed to repeat for a concept
 * @property bool $is_scheme      boolean - is in conceptScheme domain
 * @property bool $is_in_picklist boolean - is in the property picklist
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttributeHistory[] $ConceptAttributeHistory
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereParentId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereInverseId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereObjectType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereDisplayOrder( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty wherePicklistOrder( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereLabel( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereDefinition( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereComment( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereExamples( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsRequired( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsReciprocal( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsSingleton( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsScheme( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsInPicklist( $value )
 * @mixin \Eloquent
 */
class SkosProperty extends \Illuminate\Database\Eloquent\Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_skos_property';

    public $timestamps = false;

    protected $fillable = [
      'parent_id',
      'inverse_id',
      'name',
      'uri',
      'object_type',
      'display_order',
      'picklist_order',
      'label',
      'definition',
      'comment',
      'examples',
      'is_required',
      'is_reciprocal',
      'is_singleton',
      'is_scheme',
      'is_in_picklist',
    ];


    public function ConceptAttributeHistory()
    {
        return $this->hasMany(\App\Models\ConceptAttributeHistory::class, 'skos_property_id', 'id');
    }
}
