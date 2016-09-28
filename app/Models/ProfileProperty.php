<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\ProfileProperty
 *
 * @property integer $id
 * @property integer $skos_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $profile_id
 * @property integer $skos_parent_id
 * @property string $name
 * @property string $label
 * @property string $definition
 * @property string $comment
 * @property string $type
 * @property string $uri
 * @property integer $status_id
 * @property string $language
 * @property string $note
 * @property integer $display_order
 * @property integer $export_order
 * @property integer $picklist_order
 * @property string $examples
 * @property boolean $is_required
 * @property boolean $is_reciprocal
 * @property boolean $is_singleton
 * @property boolean $is_in_picklist
 * @property boolean $is_in_export
 * @property integer $inverse_profile_property_id
 * @property boolean $is_in_class_picklist
 * @property boolean $is_in_property_picklist
 * @property boolean $is_in_rdf
 * @property boolean $is_in_xsd
 * @property boolean $is_attribute
 * @property boolean $has_language
 * @property boolean $is_object_prop
 * @property boolean $is_in_form
 * @property string $namespace
 * @property-read \App\Models\Profile $Profile
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereSkosId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereSkosParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDefinition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereDisplayOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereExportOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty wherePicklistOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereExamples($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsRequired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsReciprocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsSingleton($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInPicklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInExport($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereInverseProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInClassPicklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInPropertyPicklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInRdf($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInXsd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsAttribute($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereHasLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsObjectProp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereIsInForm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileProperty whereNamespace($value)
 * @mixin \Eloquent
 */
class ProfileProperty extends Model
{
    use SoftDeletes;

    protected $table = 'profile_property';

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
        return $this->belongsTo('App\Models\Profile', 'profile_id', 'id');
    }


}
