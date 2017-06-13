<?php

namespace App\Models;

use App\models\Import;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ImportInstruction
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $import_id
 * @property string $action
 * @property int $profile_property_id
 * @property string $profile_property_label
 * @property string $before_value
 * @property string $after_value
 * @property string $language
 * @property int $concept_property_id
 * @property int $schema_property_element_id
 * @property int $resource_id
 * @property string $resource_label
 * @property-read \App\Models\Import $import
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereAfterValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereBeforeValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereConceptPropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereImportId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereProfilePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereProfilePropertyLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereResourceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereResourceLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereSchemaPropertyElementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImportInstruction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImportInstruction extends Model
{
    const TABLE = 'import_instructions';
    protected $table = self::TABLE;
    protected $guarded = [ 'id' ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return BelongsTo
     */
    public function import(): ?BelongsTo
    {
        return $this->belongsTo(Import::class);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
