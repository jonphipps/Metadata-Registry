<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\BelongsToElementset;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Element
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $created_user_id
 * @property int|null $updated_user_id
 * @property int|null $deleted_user_id
 * @property int $schema_id
 * @property string|null $name
 * @property string|null $label
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
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \App\Models\Elementset $elementset
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttribute[] $statements
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereDefinition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereDeletedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereHashId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereIsDeprecated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereIsSubpropertyOf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereLexicalAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereOrange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereParentUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereSchemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Element whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Element withoutTrashed()
 * @mixin \Eloquent
 */
class Element extends Model
{
    const TABLE = 'reg_schema_property';
    protected $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Cacheable;
    use Languages, HasStatus, BelongsToElementset;
    protected $blameable = [
        'created' => 'created_user_id',
        'updated' => 'updated_user_id',
        'deleted' => 'deleted_user_id',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];

    public function statements(): ?HasMany
    {
        return $this->hasMany( ElementAttribute::class, 'schema_property_id', 'id' );
    }

    /**
     * @param int $projectId
     *
     * @return array
     */
    public static function SelectElementsByProject( $projectId )
    {
        return \DB::table( ElementAttribute::TABLE )
            ->join( Element::TABLE,
                Element::TABLE . '.id',
                '=',
                ElementAttribute::TABLE . '.schema_property_id' )
            ->join( Elementset::TABLE,
                Elementset::TABLE . '.id',
                '=',
                Element::TABLE . '.schema_id' )
            ->select( ElementAttribute::TABLE .
                '.schema_property_id as id',
                Elementset::TABLE . '.name as Elementset',
                ElementAttribute::TABLE . '.language',
                ElementAttribute::TABLE . '.object as label' )
            ->where( [
                [ ElementAttribute::TABLE . '.profile_property_id', 2, ],
                [ Elementset::TABLE . '.agent_id', $projectId, ],
            ] )
            ->orderBy( Elementset::TABLE . '.name' )
            ->orderBy( ElementAttribute::TABLE .
                '.language' )
            ->orderBy( ElementAttribute::TABLE . '.object' )
            ->get()
            ->mapWithKeys( function( $item ) {
                return [
                    $item->id . '_' . $item->language => $item->Elementset .
                        ' - (' .
                        $item->language .
                        ') ' .
                        $item->label,
                ];
            } )
            ->toArray();
    }
}
