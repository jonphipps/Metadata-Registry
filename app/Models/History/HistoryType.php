<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\History\HistoryType
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\History\HistoryType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\History\HistoryType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\History\HistoryType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\History\HistoryType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HistoryType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];
}
