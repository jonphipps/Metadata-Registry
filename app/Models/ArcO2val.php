<?php namespace App\Models;

/**
 * App\Models\ArcO2val
 *
 * @property int $id
 * @property int $cid
 * @property bool $misc
 * @property string $val
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcO2val whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcO2val whereCid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcO2val whereMisc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcO2val whereVal($value)
 * @mixin \Eloquent
 */
class ArcO2val extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'arc_o2val';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = array('cid', 'misc', 'val');

}

