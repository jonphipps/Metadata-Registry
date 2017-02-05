<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Prefix
 *
 * @property string $prefix
 * @property string $uri
 * @property int $rank
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Prefix wherePrefix( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Prefix whereUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Prefix whereRank( $value )
 * @mixin \Eloquent
 */
class Prefix extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_prefix';

    public $primaryKey = 'prefix';

    public $timestamps = false;

    public $incrementing = false;

    public $fillable = [
      "prefix",
      "uri",
      "rank",
    ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      "prefix" => "string",
      "uri"    => "string",
      "rank"   => "integer",
    ];

    public static $rules = [
      "prefix" => "required|max:40",
      "uri"    => "max:256",
    ];
}
