<?php

namespace App\Models\History;

use App\Models\History\Traits\Relationship\HistoryRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\History\History.
 *
 * @property int $id
 * @property int|null $type_id
 * @property int|null $user_id
 * @property int|null $entity_id
 * @property string|null $icon
 * @property string|null $class
 * @property string|null $text
 * @property string|null $assets
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\History\HistoryType $type
 * @property-read \App\Models\Access\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereAssets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History\History whereUserId($value)
 * @mixin \Eloquent
 */
class History extends Model
{
    use HistoryRelationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_id', 'user_id', 'entity_id', 'icon', 'class', 'text', 'assets'];
}
