<?php namespace App\Models;

/**
 * App\Models\ArcId2val
 *
 * @property int $id
 * @property bool $misc
 * @property string $val
 * @property bool $val_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcId2val whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcId2val whereMisc( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcId2val whereVal( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArcId2val whereValType( $value )
 * @mixin \Eloquent
 */
class ArcId2val extends \Illuminate\Database\Eloquent\Model
{
  protected $table = self::TABLE;
  const TABLE = 'arc_id2val';

  public $primaryKey = 'val_type';

  public $timestamps = false;

  public $incrementing = false;

  protected $fillable = [ 'misc', 'val' ];

}

