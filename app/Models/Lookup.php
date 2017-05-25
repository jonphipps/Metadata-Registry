<?php namespace App\Models;

/**
 * App\Models\Lookup
 *
 * @property int    $id
 * @property int    $type_id This will be the lookup type and will reference the list of lookup types stored in this very same table
 * @property string $short_value
 * @property string $long_value
 * @property int    $display_order
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereDisplayOrder( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereLongValue( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereShortValue( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereTypeId( $value )
 * @mixin \Eloquent
 */
class Lookup extends \Illuminate\Database\Eloquent\Model
{
    protected $table = self::TABLE;

    const TABLE = 'reg_lookup';

    public $timestamps = false;

    protected $fillable = [ 'type_id', 'short_value', 'long_value', 'display_order' ];
}
