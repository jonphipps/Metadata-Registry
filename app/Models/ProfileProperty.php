<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProfileProperty
 *
 * @property int $id
 * @property int $skos_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $profile_id
 * @property int|null $skos_parent_id
 * @property string $name
 * @property string $label
 * @property string|null $definition
 * @property string|null $comment
 * @property string $type
 * @property string|null $uri
 * @property int $status_id
 * @property string $language
 * @property string|null $note
 * @property int|null $display_order Display order of properties
 * @property int|null $export_order Display order of properties
 * @property int|null $picklist_order
 * @property string|null $examples Link to example usage
 * @property int $is_required boolean -- id this value required
 * @property int $is_reciprocal boolean - subject and object must both have this property
 * @property int $is_singleton boolean -- is this property allowed to repeat for a concept
 * @property int $is_in_picklist boolean - is in the property picklist
 * @property int $is_in_export
 * @property int|null $inverse_profile_property_id id of the inverse property
 * @property int $is_in_class_picklist boolean - is in the property picklist
 * @property int $is_in_property_picklist boolean - is in the property picklist
 * @property int $is_in_rdf boolean - should this display in the RDF
 * @property int $is_in_xsd boolean - should this display in the XSD
 * @property int $is_attribute boolean - is this an attribute? attribute's aren't editable outside the main form
 * @property int $has_language Boolean that determines whether language attribute is displayed for this property
 * @property int $is_object_prop
 * @property int $is_in_form
 * @property string $namespce
 * @property-read \App\Models\Profile $Profile
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDefinition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDisplayOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereExamples($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereExportOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereHasLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereInverseProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsAttribute($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInClassPicklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInExport($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInForm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInPicklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInPropertyPicklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInRdf($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInXsd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsObjectProp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsReciprocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsRequired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsSingleton($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereNamespce($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty wherePicklistOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereSkosId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereSkosParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereUri($value)
 * @mixin \Eloquent
 */
class ProfileProperty extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'profile_property';

    use SoftDeletes;

    public function getNameAttribute($value)
    {
        //this is necessary to use the legacy database, where range was at one time a reserved word
        if ('orange' === $value) {
            return 'range';
        } else {
            return $value;
        }
    }


    public function Profile()
    {
        return $this->belongsTo(\App\Models\Profile::class, 'profile_id', 'id');
    }
}
