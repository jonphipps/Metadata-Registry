<?php

namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use Cache;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Concept
 *
 * @property int                                                                          $id
 * @property \Carbon\Carbon                                                               $created_at
 * @property \Carbon\Carbon                                                               $updated_at
 * @property string                                                                       $deleted_at
 * @property int                                                                          $created_user_id
 * @property int                                                                          $updated_user_id
 * @property string                                                                       $uri
 * @property string                                                                       $lexical_alias
 * @property string                                                                       $pref_label
 * @property int                                                                          $vocabulary_id
 * @property bool                                                                         $is_top_concept
 * @property int                                                                          $pref_label_id
 * @property int                                                                          $status_id
 * @property string                                                                       $language
 * @property int                                                                          $created_by
 * @property int                                                                          $updated_by
 * @property int                                                                          $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttribute[] $properties
 * @property-read \App\Models\Status                                                      $status
 * @property-read \App\Models\Vocabulary                                                  $vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedBy( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereCreatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereDeletedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereDeletedBy( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereIsTopConcept( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereLanguage( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereLexicalAlias( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept wherePrefLabel( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept wherePrefLabelId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereStatusId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedBy( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUpdatedUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereUri( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Concept whereVocabularyId( $value )
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
        return $this->belongsTo( \App\Models\Vocabulary::class, 'vocabulary_id', 'id' );
    }

    public function properties()
    {
        return $this->hasMany( ConceptAttribute::class, 'concept_id' );
    }

    public function status()
    {
        return $this->belongsTo( \App\Models\Status::class, 'status_id', 'id' );
    }

    public function name()
    {
        return $this->pref_label;
    }

    public function getLanguageAttribute( $value )
    {
        return Cache::get( 'language_' . $value,
            function() use ( $value ) {
                return Languages::list( $value );
            } );
    }

    /**
     * @param int $projectId
     *
     * @return array
     */
    public static function selectConceptsByProject( $projectId )
    {
        return \DB::table( ConceptAttribute::TABLE )
            ->join( Concept::TABLE,
                Concept::TABLE . '.id',
                '=',
                ConceptAttribute::TABLE . '.concept_id' )
            ->join( Vocabulary::TABLE,
                Vocabulary::TABLE . '.id',
                '=',
                Concept::TABLE . '.vocabulary_id' )
            ->select( ConceptAttribute::TABLE .
                '.concept_id as id',
                Vocabulary::TABLE . '.name as vocabulary',
                ConceptAttribute::TABLE . '.language',
                ConceptAttribute::TABLE . '.object as label' )
            ->where( [
                [ ConceptAttribute::TABLE . '.profile_property_id', 45, ],
                [ Vocabulary::TABLE . '.agent_id', $projectId, ],
            ] )
            ->orderBy( Vocabulary::TABLE . '.name' )
            ->orderBy( ConceptAttribute::TABLE .
                '.language' )
            ->orderBy( ConceptAttribute::TABLE . '.object' )
            ->get()
            ->mapWithKeys( function( $item ) {
                return [
                    $item->id . '_' . $item->language => $item->vocabulary .
                        ' - (' .
                        $item->language .
                        ') ' .
                        $item->label,
                ];
            } )
            ->toArray();
    }

}
