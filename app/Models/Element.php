<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Element
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property int $schema_id
 * @property string $name
 * @property string $label
 * @property string $definition
 * @property string $comment
 * @property string $type
 * @property int $is_subproperty_of
 * @property string $parent_uri
 * @property string $uri
 * @property int $status_id
 * @property string $language
 * @property string $note
 * @property string $domain
 * @property string $orange
 * @property bool $is_deprecated Boolean. Has this class/property been deprecated
 * @property string $url
 * @property string $lexical_alias
 * @property string $hash_id
 * @property-read \App\Models\ElementSet $ElementSet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttribute[] $ElementAttributes
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUpdatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereSchemaId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereLabel( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereDefinition( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereComment( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereIsSubpropertyOf( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereParentUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereStatusId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereLanguage( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereNote( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereDomain( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereOrange( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereIsDeprecated( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereUrl( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereLexicalAlias( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element whereHashId( $value )
 * @mixin \Eloquent
 */
class Element extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_schema_property';

    protected $primaryKey = 'id';
    use SoftDeletes;


    public function ElementSet()
    {
        return $this->belongsTo(\App\Models\ElementSet::class, 'schema_id', 'id');
    }


    public function ElementAttributes()
    {
        return $this->hasMany(\App\Models\ElementAttribute::class, 'schema_property_id', 'id');
    }


    public function CreatedBy()
    {
    }
}
