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
 * @method bool|null forceDelete()
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
    const FORM_PROPERTIES = [ 1, 2, 3, 4, 5, 6, 7, 9, 11, 12, 13, 14, 27 ];
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

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */


    /**
     * @param int $projectId
     *
     * @return array
     */
    public static function SelectElementsByProject($projectId)
    {
        return \DB::table(ElementAttribute::TABLE)
            ->join(Element::TABLE,
                Element::TABLE . '.id',
                '=',
                ElementAttribute::TABLE . '.schema_property_id')
            ->join(Elementset::TABLE,
                Elementset::TABLE . '.id',
                '=',
                Element::TABLE . '.schema_id')
            ->select(ElementAttribute::TABLE . '.schema_property_id as id',
                Elementset::TABLE . '.name as Elementset',
                ElementAttribute::TABLE . '.language',
                ElementAttribute::TABLE . '.object as label')
            ->where([
                [ ElementAttribute::TABLE . '.profile_property_id', 2, ],
                [ Elementset::TABLE . '.agent_id', $projectId, ],
            ])
            ->orderBy(Elementset::TABLE . '.name')
            ->orderBy(ElementAttribute::TABLE . '.language')
            ->orderBy(ElementAttribute::TABLE . '.object')
            ->get()
            ->mapWithKeys(function($item) {
                return [
                    $item->id . '_' . $item->language => $item->Elementset .
                        ' - (' .
                        $item->language .
                        ') ' .
                        $item->label,
                ];
            })
            ->toArray();
    }

    public function updateFromStatements(array $statements = null): self
    {
        $language    = $this->language;
        if (!$statements) {
            $s          =
                collect($this->statements->whereIn('profile_property_id', self::FORM_PROPERTIES)->toArray());
            $statements = $s->filter(function($item) use ($language) {
                return $item['language'] === $language || $item['language'] === '';
            })->keyBy(function($item) {
                return $item['profile_property_id'];
            })->map(function($item) {
                return $item['object'];
            });
        }
        if (isset($statements['1'])) {
            $this->name = $statements['1'];
        }
        if (isset($statements['2'])) {
            $this->label = $statements['2'];
        }
        if (isset($statements['3'])) {
            $this->definition = $statements['3'];
        }
        if (isset($statements['4'])) {
            $this->type = $statements['4'];
        }
        if (isset($statements['5'])) {
            $this->comment = $statements['5'];
        }
        if (strtolower($this->type) === 'property') {
            if (isset($statements['6'])) {
                $this->parent_uri = $statements['6'];
            }
        } else {
            if (isset($statements['9'])) {
                $this->parent_uri = $statements['9'];
            }
        }
        if (isset($statements['7'])) {
            $this->note = $statements['7'];
        }
        if (isset($statements['11'])) {
            $this->domain = $statements['11'];
        }
        if (isset($statements['12'])) {
            $this->orange = $statements['12'];
        }
        if (isset($statements['13'])) {
            $this->uri = $statements['13'];
        }
        if (isset($statements['14'])) {
            $this->status_id =
                is_numeric($statements['14']) ? $statements['14'] :
                    Status::getByName($statements['14'])->id;
        }
        if (isset($statements['27'])) {
            $this->lexical_alias = $statements['27'];
        }
        //$this->url    = $statements["45"];
        $this->save();

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function statements(): ?HasMany
    {
        return $this->hasMany(ElementAttribute::class, 'schema_property_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
