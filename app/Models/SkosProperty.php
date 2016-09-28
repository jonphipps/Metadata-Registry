<?php namespace App\Models;

/**
 * App\Models\SkosProperty
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $inverse_id
 * @property string $name
 * @property string $uri
 * @property string $object_type
 * @property integer $display_order
 * @property integer $picklist_order
 * @property string $label
 * @property string $definition
 * @property string $comment
 * @property string $examples
 * @property boolean $is_required
 * @property boolean $is_reciprocal
 * @property boolean $is_singleton
 * @property boolean $is_scheme
 * @property boolean $is_in_picklist
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttributeHistory[] $ConceptAttributeHistory
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereInverseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereDisplayOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty wherePicklistOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereDefinition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereExamples($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsRequired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsReciprocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsSingleton($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsScheme($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsInPicklist($value)
 * @mixin \Eloquent
 */
class SkosProperty extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'reg_skos_property';

    public $timestamps = false;

    protected $fillable = array('parent_id', 'inverse_id', 'name', 'uri', 'object_type', 'display_order',
        'picklist_order', 'label', 'definition', 'comment', 'examples', 'is_required', 'is_reciprocal', 'is_singleton',
        'is_scheme', 'is_in_picklist');

    public function ConceptAttributeHistory()
    {
        return $this->hasMany('App\Models\ConceptAttributeHistory', 'skos_property_id', 'id');
    }

}

