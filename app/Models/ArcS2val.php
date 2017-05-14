<?php namespace App\Models;

/**
 * App\Models\ArcS2val
 *
 * @property int $id
 * @property int $cid
 * @property bool $misc
 * @property string $val
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcS2val whereCid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcS2val whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcS2val whereMisc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcS2val whereVal($value)
 * @mixin \Eloquent
 */
class ArcS2val extends \Illuminate\Database\Eloquent\Model
{
    protected $table = self::TABLE;
    const TABLE = 'arc_s2val';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [ 'cid', 'misc', 'val' ];
}
