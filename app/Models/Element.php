<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Element
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_user_id
 * @property int|null $updated_user_id
 * @property int $schema_id
 * @property string $name
 * @property string $label
 * @property string|null $definition
 * @property string|null $comment
 * @property string $type
 * @property int|null $is_subproperty_of
 * @property string|null $parent_uri
 * @property string $uri
 * @property int $status_id
 * @property string $language
 * @property string|null $note
 * @property string|null $domain
 * @property string|null $orange
 * @property int|null $is_deprecated Boolean. Has this class/property been deprecated
 * @property string|null $url
 * @property string|null $lexical_alias
 * @property string $hash_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttribute[] $elementAttributes
 * @property-read \App\Models\ElementSet $elementSet
 * @property-read \App\Models\Status $status
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereCreatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereDefinition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereHashId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereIsDeprecated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereIsSubpropertyOf($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereLexicalAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereOrange($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereParentUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUrl($value)
 * @mixin \Eloquent
 */
class Element extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_schema_property';

    protected $primaryKey = 'id';
    use SoftDeletes, Languages;


    public function elementSet()
    {
        return $this->belongsTo(\App\Models\ElementSet::class, 'schema_id', 'id');
    }


    public function properties()
    {
        return $this->hasMany(\App\Models\ElementAttribute::class, 'schema_property_id', 'id');
    }

  public function status()
  {
    return $this->belongsTo(\App\Models\Status::class, 'status_id', 'id');
  }

  public function getLanguageAttribute($value)
  {
    return Cache::get('language_' . $value,
        function () use ($value) {
          return Languages::list($value);
        });
  }

}
