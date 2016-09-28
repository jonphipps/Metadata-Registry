<?php namespace App\Models;

/**
 * App\Models\ArcTriple
 *
 * @property integer $t
 * @property integer $s
 * @property integer $p
 * @property integer $o
 * @property integer $o_lang_dt
 * @property string $o_comp
 * @property boolean $s_type
 * @property boolean $o_type
 * @property boolean $misc
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereT($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereS($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereP($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereO($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereOLangDt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereOComp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereSType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereOType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcTriple whereMisc($value)
 * @mixin \Eloquent
 */
class ArcTriple extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'arc_triple';

    public $primaryKey = 't';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = array('s', 'p', 'o', 'o_lang_dt', 'o_comp', 's_type', 'o_type', 'misc');

}

