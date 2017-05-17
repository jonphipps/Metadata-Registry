<?php namespace App\Models;

use App\Models\Access\User\User;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $last_updated
 * @property \Carbon\Carbon|null $deleted_at
 * @property string $org_email
 * @property string $org_name
 * @property string $ind_affiliation
 * @property string $ind_role
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 * @property string $phone
 * @property string $web_address
 * @property string $type
 * @property string|null $repo
 * @property int $is_private
 * @property string|null $license
 * @property string|null $description
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementSet[] $elementSets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $vocabularies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereAddress1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereAddress2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIndAffiliation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIndRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereIsPrivate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereLicense($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereOrgEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereOrgName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project wherePostalCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereRepo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereWebAddress($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
  const TABLE = 'projects';
  public static $rules = [ ];

  use CrudTrait, Cacheable, SoftDeletes;
  protected $table = self::TABLE;
  protected $dates = [ 'deleted_at', 'last_updated' ];
  protected $guarded = [];
  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [ ];

  protected $hidden = [

  ];

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
   * @param Builder $query
   *
   * @return mixed
   */
  public function ScopePrivate($query)
  {
    return $query->where('is_private', true);
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function profiles()
  {
    return $this->hasMany(Profile::class, 'project_id', 'id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function members()
  {
    return $this->belongsToMany(User::class)
        ->withPivot('is_registrar_for', 'is_admin_for')
        ->withTimestamps();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function elementSets()
  {
    return $this->hasMany(ElementSet::class, 'project_id', 'id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function elementSetsForSelect()
  {
    return ElementSet::select([ 'id', 'name' ])
        ->where('project_id', $this->id)
        ->orderBy('name')
        ->get()
        ->mapWithKeys(function ($item) {
          return [ $item['id'] => $item['name'] ];
        });
  }

  /**
   * @return array
   */
  public function elementsForSelect()
  {
    return \DB::table(ElementAttribute::TABLE)
        ->join(Element::TABLE,
               Element::TABLE . '.id',
               '=',
               ElementAttribute::TABLE . '.schema_property_id')
        ->join(ElementSet::TABLE, ElementSet::TABLE . '.id', '=', Element::TABLE . '.schema_id')
        ->select(ElementAttribute::TABLE . '.schema_property_id as id',
                 ElementSet::TABLE . '.name as ElementSet',
                 ElementAttribute::TABLE . '.language',
                 ElementAttribute::TABLE . '.object as label')
        ->where([ [ ElementAttribute::TABLE . '.profile_property_id', 2 ],
                    [ ElementSet::TABLE . '.project_id', $this->id ] ])
        ->orderBy(ElementSet::TABLE . '.name')
        ->orderBy(ElementAttribute::TABLE . '.language')
        ->orderBy(ElementAttribute::TABLE . '.object')
        ->get()
        ->mapWithKeys(function ($item) {
          return [ $item->id . '_' . $item->language => $item->ElementSet .
              ' - (' .
              $item->language .
              ') ' .
              $item->label ];
        })
        ->toArray();
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
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function vocabularies()
  {
    return $this->hasMany(Vocabulary::class, 'project_id', 'id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function vocabulariesForSelect()
  {
    return Vocabulary::select(['id', 'name'])
        ->where('project_id', $this->id)
        ->orderBy('name')
        ->get()
        ->mapWithKeys(function ($item) {
          return [ $item['id'] => $item['name'] ];
        });
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
        ->where([ [ ConceptAttribute::TABLE . '.profile_property_id', 45 ],
                    [ Vocabulary::TABLE . '.project_id', $this->id ] ])
        ->orderBy(Vocabulary::TABLE . '.name')
        ->orderBy(ConceptAttribute::TABLE . '.language')
        ->orderBy(ConceptAttribute::TABLE . '.object')
        ->get()
        ->mapWithKeys(function ($item) {
          return [ $item->id . '_' . $item->language => $item->vocabulary .
              ' - (' .
              $item->language .
              ') ' .
              $item->label ];
        })
        ->toArray();
  }

}
