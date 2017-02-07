<?php namespace App\Models;

/**
 * App\Models\ArcTriple
 *
 * @property int $t
 * @property int $s
 * @property int $p
 * @property int $o
 * @property int $o_lang_dt
 * @property string $o_comp
 * @property bool $s_type
 * @property bool $o_type
 * @property bool $misc
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereT( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereS( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereP( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereO( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereOLangDt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereOComp( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereSType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereOType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereMisc( $value )
 * @mixin \Eloquent
 */
class ArcTriple extends \Illuminate\Database\Eloquent\Model
{
    protected $table = self::TABLE;
    const TABLE = 'arc_triple';

    public $primaryKey = 't';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [ 's', 'p', 'o', 'o_lang_dt', 'o_comp', 's_type', 'o_type', 'misc' ];
}
