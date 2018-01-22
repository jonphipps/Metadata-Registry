<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * App\Models\Prefix.
 *
 * @property string $prefix
 * @property string $uri
 * @property int $rank
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prefix wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prefix whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prefix whereUri($value)
 * @mixin \Eloquent
 */
class Prefix extends Model
{
    const TABLE          = 'reg_prefix';
    protected $table     = self::TABLE;
    public $primaryKey   = 'prefix';
    public $timestamps   = false;
    public $incrementing = false;
    public $fillable     = [
        'prefix',
        'uri',
        'rank',
    ];
    protected $casts = [
        'prefix' => 'string',
        'uri'    => 'string',
        'rank'   => 'integer',
    ];
    public static $rules = [
        'prefix' => 'required|max:40',
        'uri'    => 'max:256',
    ];
}
