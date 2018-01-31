<?php

namespace App\Models;

/**
 * App\Models\Lookup
 *
 * @property int $id
 * @property int|null $type_id This will be the lookup type and will reference the list of lookup types stored in this very same table
 * @property string|null $short_value
 * @property string|null $long_value
 * @property int|null $display_order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookup whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookup whereLongValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookup whereShortValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookup whereTypeId($value)
 * @mixin \Eloquent
 */
class Lookup extends \Illuminate\Database\Eloquent\Model
{
    const TABLE        = 'reg_lookup';
    protected $table   = self::TABLE;
    public $timestamps = false;
    protected $guarded = ['id'];
}
