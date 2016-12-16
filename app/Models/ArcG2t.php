<?php namespace App\Models;

/**
 * App\Models\ArcG2t
 *
 * @property int $g
 * @property int $t
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcG2t whereG( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcG2t whereT( $value )
 * @mixin \Eloquent
 */
class ArcG2t extends \Illuminate\Database\Eloquent\Model
{
  protected $table = self::TABLE;
  const TABLE = 'arc_g2t';

  public $primaryKey = 't';

  public $timestamps = false;

  public $incrementing = false;

  protected $fillable = [];

}

