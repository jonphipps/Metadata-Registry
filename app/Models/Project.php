<?php namespace App\Models;

use App\Models\Access\User\User;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

class Project extends Model
{
    use CrudTrait, Cacheable, SoftDeletes;

    const TABLE = 'projects';

    public static $rules = [];

    protected $table = self::TABLE;

    protected $dates = [ 'deleted_at' ];

    protected $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $hidden = [
        'id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'repo',
        'url',
        'license',
        'uri_strategy',
        'uri_type',
        'uri_prepend',
        'uri_append',
        'created_by',
        'updated_by',
        'deleted_by',
        'starting_number',
        'license_uri',
        'default_language_id',
        'google_sheet_url',
    ];

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function ScopePrivate($query)
    {
        return $query->where('is_private', true);
    }

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function ScopePublic($query)
    {
        return $query->where('is_private', '<>', 1);
    }

    /**
     * @return array
     */
    public function conceptsForSelect()
    {
        return \DB::table(ConceptAttribute::TABLE)
            ->join(Concept::TABLE, Concept::TABLE . '.id', '=', ConceptAttribute::TABLE . '.concept_id')
            ->join(Vocabulary::TABLE, Vocabulary::TABLE . '.id', '=', Concept::TABLE . '.vocabulary_id')
            ->select(ConceptAttribute::TABLE . '.concept_id as id',
                Vocabulary::TABLE . '.name as vocabulary',
                ConceptAttribute::TABLE . '.language',
                ConceptAttribute::TABLE . '.object as label')
            ->where([
                [
                    ConceptAttribute::TABLE . '.profile_property_id',
                    45,
                ],
                [
                    Vocabulary::TABLE . '.project_id',
                    $this->id,
                ],
            ])
            ->orderBy(Vocabulary::TABLE . '.name')
            ->orderBy(ConceptAttribute::TABLE . '.language')
            ->orderBy(ConceptAttribute::TABLE . '.object')
            ->get()
            ->mapWithKeys(function($item) {
                return [
                    $item->id . '_' . $item->language => $item->vocabulary . ' - (' . $item->language . ') ' . $item->label,
                ];
            })
            ->toArray();
    }

    public function getVocabColumn()
    {
            $count = $this->vocabularies()->count();
            return $count ? '<a href="' . url('projects/' . $this->id . '/vocabularies') . '">' . self::badge($count) : '&nbsp;';
    }
     public function getElementColumn()
    {
            $count = $this->elementSets()->count();
            return $count ? '<a href="' . url('projects/' . $this->id . '/elementsets') . '">' . self::badge($count) : '&nbsp;';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elementSets()
    {
        return $this->hasMany(ElementSet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function elementSetsForSelect()
    {
        return ElementSet::select([
            'id',
            'name',
        ])->where('project_id', $this->id)->orderBy('name')->get()->mapWithKeys(function($item) {
            return [ $item['id'] => $item['name'] ];
        });
    }

    /**
     * @return array
     */
    public function elementsForSelect()
    {
        return \DB::table(ElementAttribute::TABLE)->join(Element::TABLE,
            Element::TABLE . '.id',
            '=',
            ElementAttribute::TABLE . '.schema_property_id')->join(ElementSet::TABLE, ElementSet::TABLE . '.id', '=', Element::TABLE . '.schema_id')->select(ElementAttribute::TABLE .
            '.schema_property_id as id',
            ElementSet::TABLE . '.name as ElementSet',
            ElementAttribute::TABLE . '.language',
            ElementAttribute::TABLE . '.object as label')->where([
            [
                ElementAttribute::TABLE . '.profile_property_id',
                2,
            ],
            [
                ElementSet::TABLE . '.project_id',
                $this->id,
            ],
        ])->orderBy(ElementSet::TABLE . '.name')->orderBy(ElementAttribute::TABLE . '.language')->orderBy(ElementAttribute::TABLE . '.object')->get()->mapWithKeys(function($item) {
            return [
                $item->id . '_' . $item->language => $item->ElementSet . ' - (' . $item->language . ') ' . $item->label,
            ];
        })->toArray();
        // $elements = [];
        // /** @var ElementSet[] $elementsets */
        // $elementsets =
        //     ElementSet::with('elements')
        //         ->where('project_id', $this->id)
        //         ->orderBy('name')
        //         ->get()
        //         ->groupBy('name');
        // foreach ($elementsets as $key => $elementset) {
        //   $elements[$key] =  $elementset->first()->elements->mapWithKeys(function ($item) use($key) {
        //     if (!empty($item['label'])) {
        //       return [ $item['id'] => "{$key} - " . $item['label'] ];
        //     }
        //   })->toArray();
        //   }
        // return $elements;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class)->withPivot('is_registrar_for', 'is_admin_for')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function vocabulariesForSelect()
    {
        return Vocabulary::select([
            'id',
            'name',
        ])->where('project_id', $this->id)->orderBy('name')->get()->mapWithKeys(function($item) {
            return [ $item['id'] => $item['name'] ];
        });
    }

    public static function badge($count)
    {
        return '<span class="badge">' . $count . '</span>';
    }
}
