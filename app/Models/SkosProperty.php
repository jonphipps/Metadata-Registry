<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\SkosProperty
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $parent_id
 * @property int $inverse_id id of the inverse property
 * @property string $name
 * @property string $uri
 * @property string $object_type the type of the object for which this is the predicate
 * @property int $display_order Display order of properties
 * @property int $picklist_order
 * @property string $label The pretty label for the property
 * @property string $definition
 * @property string $comment
 * @property string $examples Link to example usage
 * @property bool $is_required boolean -- id this value required
 * @property bool $is_reciprocal boolean - subject and object must both have this property
 * @property bool $is_singleton boolean -- is this property allowed to repeat for a concept
 * @property bool $is_scheme boolean - is in conceptScheme domain
 * @property bool $is_in_picklist boolean - is in the property picklist
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttributeHistory[] $concept_attribute_history
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereDefinition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereDisplayOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereExamples($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereInverseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsInPicklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsReciprocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsRequired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsScheme($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereIsSingleton($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty wherePicklistOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SkosProperty whereUri($value)
 * @mixin \Eloquent
 */
class SkosProperty extends Model
{
    const TABLE = 'reg_skos_property';
    protected $table = self::TABLE;
    public $timestamps = false;
    protected $guarded = [ 'id' ];

    public function concept_attribute_history(): ?HasMany
    {
        return $this->hasMany( ConceptAttributeHistory::class,
            'skos_property_id',
            'id' );
    }
}
