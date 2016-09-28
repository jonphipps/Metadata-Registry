<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * App\Models\Status
 *
 * @property integer $id
 * @property integer $display_order
 * @property string $display_name
 * @property string $uri
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Status whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Status whereDisplayOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Status whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Status whereUri($value)
 * @mixin \Eloquent
 */
class Status extends Model
{
    protected $table = 'reg_status';
}
