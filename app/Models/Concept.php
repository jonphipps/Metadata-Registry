<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Concept
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $last_updated
 * @property int $created_user_id
 * @property int $updated_user_id
 * @property string $uri
 * @property string $pref_label
 * @property int $vocabulary_id
 * @property bool $is_top_concept
 * @property int $pref_label_id
 * @property int $status_id
 * @property string $language
 * @property-read \App\Models\Vocabulary $Vocabulary
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttribute[] $Properties
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereLastUpdated( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept wherePrefLabel( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereVocabularyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereIsTopConcept( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept wherePrefLabelId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereStatusId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereLanguage( $value )
 * @mixin \Eloquent
 */
class Concept extends Model
{
  protected $table = self::TABLE;
  const TABLE = 'reg_concept';

  protected $primaryKey = 'id';

  use SoftDeletes;

  public function vocabulary()
  {
    return $this->belongsTo('App\Models\Vocabulary', 'vocabulary_id', 'id');
  }


  public function properties()
  {
//        $properties = DB::table('reg_concept_property')
//            ->join('profile_property', 'profile_property.skos_id', '=', 'reg_concept_property.skos_property_id')
//            ->select(
//                'profile_property.uri',
//                'profile_property.label',
//                'reg_concept_property.object',
//                'reg_concept_property.language')
//            ->where('concept_id', $this->id)
//            ->whereNull('reg_concept_property.deleted_at')
//            ->orderBy('profile_property.export_order')
//            ->orderBy('reg_concept_property.language')
//            ->get();
//        return $properties;

    return $this->hasMany(ConceptAttribute::class, 'concept_id');
  }
}
