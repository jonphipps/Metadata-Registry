<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * App\Models\Status
 *
 * @property int $id
 * @property int|null $display_order
 * @property string|null $display_name
 * @property string|null $uri
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereUri($value)
 * @mixin \Eloquent
 */
class Status extends Model
{
    const TABLE = 'reg_status';
    protected $table = self::TABLE;
}
