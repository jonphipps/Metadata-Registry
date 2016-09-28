<?php namespace App\Models;

/**
 * App\Models\Lookup
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $short_value
 * @property string $long_value
 * @property integer $display_order
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereShortValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereLongValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lookup whereDisplayOrder($value)
 * @mixin \Eloquent
 */
class Lookup extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'reg_lookup';

    public $timestamps = false;

    protected $fillable = array('type_id', 'short_value', 'long_value', 'display_order');

}

